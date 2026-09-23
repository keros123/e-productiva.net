<?php
include_once "conexion.php";
include_once "../helpers/crearEmail.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class RadicadoModelo
{

    public static function mdlValidarEstadoAprendiz($idAprendiz)
    {
        try {
            $db = Conexion::conectar();

            // 1. Obtener datos del aprendiz
            $stmt = $db->prepare("
                SELECT a.estado_aprendiz_idestado_aprendiz, a.nombres, a.apellidos,
                       f.numero_ficha, f.caracterizacion
                FROM aprendiz a
                INNER JOIN ficha f ON f.idficha = a.ficha_idficha
                WHERE a.idaprendiz = :idaprendiz
            ");

            
            $stmt->bindParam(":idaprendiz", $idAprendiz);
            $stmt->execute();
            $aprendiz = $stmt->fetch();
            $stmt = null;

            // Guard: aprendiz no encontrado
            if (!$aprendiz) {
                return ["codigo" => "401", "mensaje" => "No fue posible encontrar el aprendiz seleccionado."];
            }

            $estadoAprendiz = $aprendiz["estado_aprendiz_idestado_aprendiz"];

            // Guard: documentos ya radicados
            if ($estadoAprendiz == self::ESTADO_POR_CERTIFICAR) {
                return ["codigo" => "401", "mensaje" => "El aprendiz ya no cuenta con documentos por radicar."];
            }

            // Guard: estado no habilitado para radicar (2 = En formación, 9 = Etapa práctica finalizada)
            if (!in_array($estadoAprendiz, self::ESTADOS_PERMITIDOS_RADICAR)) {
                return ["codigo" => "401", "mensaje" => "Para poder radicar los documentos de certificación es necesario que el aprendiz tenga radicado y aprobado el seguimiento final."];
            }

            // Guard: seguimientos no aprobados
            if (!self::validarSeguimientosAprobados($idAprendiz, $db)) {
                return ["codigo" => "401", "mensaje" => "Para poder radicar los documentos de certificación es necesario que el aprendiz tenga aprobados todos los seguimientos."];
            }

            // 2. Verificar documentos de certificación (solo columnas necesarias)
            $stmt = $db->prepare("
                SELECT idcertificacion, titulo_documento, url_documento, estado_archivo
                FROM certificacion
                WHERE aprendiz_idaprendiz = :aprendiz_idaprendiz
            ");
            $stmt->bindParam(":aprendiz_idaprendiz", $idAprendiz);
            $stmt->execute();
            $certificados = $stmt->fetchAll();
            $stmt = null;

            // 3. Verificar bitácoras (solo columnas necesarias)
            $stmt = $db->prepare("
                SELECT codigo_bitacora, url_bitacora
                FROM bitacora
                WHERE aprendiz_idaprendiz = :aprendiz_idaprendiz
            ");
            $stmt->bindParam(":aprendiz_idaprendiz", $idAprendiz);
            $stmt->execute();
            $bitacoras = $stmt->fetchAll();
            $stmt = null;

            // 4. Construir lista de documentos faltantes e IDs a actualizar
            $documentosFaltantes = [];
            $idsParaRadicar      = [];

            foreach ($certificados as $cert) {
                // Solo se re-radican documentos sin radicar (null/"") o rechazados ("3").
                // Los ya radicados ("1") y aprobados ("2") no se tocan.
                $sinRadicar = $cert["estado_archivo"] === null || $cert["estado_archivo"] === "";
                $rechazado  = $cert["estado_archivo"] === "3";

                if ($sinRadicar || $rechazado) {
                    $idsParaRadicar[] = $cert["idcertificacion"];
                }

                if (empty($cert["url_documento"])) {
                    $documentosFaltantes[] = ["titulo" => $cert["titulo_documento"]];
                }
            }

            foreach ($bitacoras as $bitacora) {
                if (empty($bitacora["url_bitacora"])) {
                    $documentosFaltantes[] = ["titulo" => "Bitácora Número " . $bitacora["codigo_bitacora"]];
                }
            }

            // Guard: hay archivos pendientes por subir
            if (!empty($documentosFaltantes)) {
                return [
                    "codigo"          => "402",
                    "mensaje"         => "Para poder radicar los documentos de certificación debe haber subido la siguiente lista de archivos que hacen falta: ",
                    "listaDocumentos" => $documentosFaltantes
                ];
            }

            // 5. Actualizar estado de certificación a "radicado"
            $estadoRadicado  = "1";
            $listaIds        = implode(",", $idsParaRadicar);
            $stmt = $db->prepare("UPDATE certificacion SET estado_archivo = :estado_archivo WHERE idcertificacion IN($listaIds)");
            $stmt->bindParam(":estado_archivo", $estadoRadicado);

            if (!$stmt->execute()) {
                error_log("RadicadoModelo: fallo al actualizar certificacion para aprendiz $idAprendiz");
                return ["codigo" => "401", "mensaje" => "No fue posible radicar los documentos, por favor intente más tarde."];
            }

            // 6. Actualizar estado del aprendiz a "por certificar" (6)
            $stmt = $db->prepare("UPDATE aprendiz SET estado_aprendiz_idestado_aprendiz = :estado WHERE idaprendiz = :idaprendiz");
            $nuevaEstado = 6;
            $stmt->bindParam(":estado", $nuevaEstado);
            $stmt->bindParam(":idaprendiz", $idAprendiz);

            if (!$stmt->execute()) {
                error_log("RadicadoModelo: fallo al actualizar estado del aprendiz $idAprendiz");
                return ["codigo" => "401", "mensaje" => "No fue posible actualizar el estado del aprendiz, por favor intente más tarde."];
            }

            // 7. Enviar correo de notificación
            $nombreAprendiz  = $aprendiz["nombres"] . " " . $aprendiz["apellidos"];
            $correoResultado = self::enviarCorreoRadicacion($nombreAprendiz, $aprendiz["numero_ficha"], $aprendiz["caracterizacion"]);
            $correoEnviado   = isset($correoResultado["codigo"]) && $correoResultado["codigo"] === "200";

            $mensajeAdicional = $correoEnviado
                ? " Se ha enviado una notificación por correo electrónico."
                : " La notificación por correo no pudo ser enviada, pero los documentos fueron radicados correctamente.";

            return ["codigo" => "200", "mensaje" => "Documentos radicados correctamente." . $mensajeAdicional, "aprendiz" => $idAprendiz];

        } catch (Exception $e) {
            error_log("RadicadoModelo::mdlValidarEstadoAprendiz - " . $e->getMessage());
            return ["codigo" => "401", "mensaje" => $e->getMessage()];
        }
    }

    // IDs de tipo de seguimiento definidos en la tabla tipo_seguimiento
    private const TIPO_PARCIAL   = 1;
    private const TIPO_FINAL     = 2;
    private const TIPO_MOMENTO_1 = 3;
    private const TIPO_MOMENTO_2 = 4;
    private const TIPO_MOMENTO_3 = 5;

    private static function validarSeguimientosAprobados($idAprendiz, $db): bool
    {
        try {
            // Busca el seguimiento más reciente no fragmentado del aprendiz.
            // No se filtra por estado_etapa_practica porque cuando el aprendiz
            // llega a estado 9 (Etapa práctica finalizada) el seguimiento ya
            // no tiene estado_etapa_practica = 1 y la validación fallaba.
            $stmt = $db->prepare("
                SELECT idseguimiento
                FROM seguimiento
                WHERE aprendiz_idaprendiz = :aprendiz_id
                  AND (etapa_fragmentada IS NULL OR etapa_fragmentada <> 1)
                ORDER BY idseguimiento DESC
                LIMIT 1
            ");
            
            $stmt->bindParam(":aprendiz_id", $idAprendiz);
            $stmt->execute();
            $seguimiento = $stmt->fetch(PDO::FETCH_ASSOC);
            $stmt = null;

            // Guard: si no existe un seguimiento activo, no puede radicar
            if (!$seguimiento) {
                return false;
            }

            $idSeguimiento = $seguimiento['idseguimiento'];

            // 2. Buscar ÚNICAMENTE los tipos de visita aprobados (estado_reporte = 1)
            //    del seguimiento activo. Esto evita sumar visitas de seguimientos
            //    anteriores o cancelados (falso positivo).
            $stmt = $db->prepare("
                SELECT tipo_seguimiento_idtipo_seguimiento
                FROM visita_seguimiento
                WHERE seguimiento_idseguimiento = :idseguimiento
                  AND estado_reporte = '1'
            ");
            $stmt->bindParam(":idseguimiento", $idSeguimiento);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt = null;

            if (empty($rows)) {
                return false;
            }

            // Extraer los tipos en un array plano, p.ej. [3, 4, 5] o [1, 2]
            $tiposAprobados = array_column($rows, 'tipo_seguimiento_idtipo_seguimiento');

            // Opción A: Modalidad por momentos.
            // El Momento 3 aprobado es suficiente para radicar, ya que algunos
            // aprendices solo tienen ese momento y no el 1 ni el 2.
            $tieneMomentos = in_array(self::TIPO_MOMENTO_3, $tiposAprobados);

            // Opción B: Modalidad parcial/final (Ambos seguimientos o solo el Final)
            $tieneParcialFinal = (in_array(self::TIPO_PARCIAL, $tiposAprobados) && in_array(self::TIPO_FINAL, $tiposAprobados))
                              || in_array(self::TIPO_FINAL, $tiposAprobados);

            return $tieneMomentos || $tieneParcialFinal;

        } catch (Exception $e) {
            error_log("RadicadoModelo::validarSeguimientosAprobados - " . $e->getMessage());
            return false;
        }
    }
    // -------------------------------------------------------------------------
    // Estados del aprendiz (tabla estado_aprendiz)
    // -------------------------------------------------------------------------
    private const ESTADO_EN_FORMACION          = 2;  // En formación
    private const ESTADO_POR_CERTIFICAR        = 6;  // Por certificar (ya radicó)
    private const ESTADO_ETAPA_PRACTICA_FIN    = 9;  // Etapa práctica finalizada

    // Estados que permiten iniciar el proceso de radicación
    private const ESTADOS_PERMITIDOS_RADICAR   = [self::ESTADO_EN_FORMACION, self::ESTADO_ETAPA_PRACTICA_FIN];

    // -------------------------------------------------------------------------
    // Configuración SMTP
    // IMPORTANTE: migrar estos valores a variables de entorno (.env) para
    // evitar exponer credenciales en el repositorio.
    // -------------------------------------------------------------------------
    // private const MAIL_TO        = 'macipagauta@sena.edu.co';
    private const MAIL_TO     = 'certificacioncimm@sena.edu.co';

    public static function enviarCorreoRadicacion($nombre_aprendiz, $numero_ficha, $caracterizacion)
    {
        try {
            include '../vista/modulos/emailDocumentosRadicados.php';

            $mail = crearEmail('seguimientos@eproductiva.net', 'Notificación de Radicación de Documentos');
            $mail->addAddress(self::MAIL_TO);
            $mail->Subject = "Radicación de Documentos - Aprendiz: " . $nombre_aprendiz;
            $mail->Body    = $cuerpoMensaje;
            $mail->AltBody = strip_tags($cuerpoMensaje);

            $mail->send();
            return ["codigo" => "200"];

        } catch (Exception $e) {
            error_log("RadicadoModelo::enviarCorreoRadicacion - " . $e->getMessage());
            return ["codigo" => "500", "mensaje" => "Error al enviar el correo: " . $e->getMessage()];
        }
    }
}