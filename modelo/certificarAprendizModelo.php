<?php

include_once "conexion.php";
include_once "../helpers/crearEmail.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class certificarAprendizModelo
{

    /* ------------------------------- Validar Estado seguimiento ------------------------------------------- */
    /* Fecha de Creacion :  27/08/2023           Desarrollador: Humberto benavides                            */
    /* Parametros : idAprendiz                                                                                */
    /* Retorno : mensaje de exito si se certifica el aprendiz, la funcion se encargar de limpiar base de datos 
                y carpeta de archivos                                                                        */
    /* -------------------------------------------------------------------------------------------------------*/
    /* --------------------------------------Control de cambios ----------------------------------------------*/
    /* Desarrollador: Marco Antonio Cipagauta                  fecha:  23/09/2025                             */
    /* Descripcion: se bloqueo eliminada de archivos y limpieza de base de datos para conservar la integridad
                    de la informacion debido a peticion de cordinacion academica para conservar el historial  */
    /*--------------------------------------------------------------------------------------------------------*/
    public static function mdlCertificarAprendiz($id)
    {
        // Guard: verificar que los documentos estén aprobados
        $requisitos = self::mdlComprobarRequisitos($id);
        if ($requisitos["codigo"] != "200") {
            return ["codigo" => "202", "mensaje" => $requisitos["mensaje"]];
        }

        // Crear el respaldo del aprendiz y actualizar su estado a certificado
        $respaldo = self::mdlCrearRespaldoAprendiz($id);
        if ($respaldo["codigo"] != "200") {
            return ["codigo" => "202", "mensaje" => "El respaldo no pudo ser creado, intenta de nuevo más tarde."];
        }

        $rutaFolderAprendiz = "../archivos/aprendices/" . $respaldo["mensaje"]["numero_ficha"] . "/" . $respaldo["mensaje"]["documento"];

        // Suspendido por petición de coordinación: conservar archivos del aprendiz
        // $vaciarFolders = self::mdlVaciarFolders($rutaFolderAprendiz);
        $vaciarFolders = ["codigo" => "200"];

        if ($vaciarFolders["codigo"] != "200") {
            return ["codigo" => "202", "mensaje" => "Ha ocurrido un error al limpiar el folder base."];
        }

        // Suspendido por petición de coordinación: conservar historial en base de datos
        // $limpiarBaseDatos = self::mdlLimpiarBaseDatos($id);
        $limpiarBaseDatos = ["codigo" => "200"];

        if ($limpiarBaseDatos["codigo"] != "200") {
            return ["codigo" => "202", "mensaje" => "Ha ocurrido un error al certificar al aprendiz."];
        }

        // Enviar correo de notificación al aprendiz (no crítico — la certificación ya fue exitosa)
        try {
            // El include define $cuerpoEmailNotificacion usando datos del scope actual
            include "../vista/modulos/emailNotificacionEsperarCertificado.php";

            $mail = crearEmail('seguimientos@eproductiva.net', 'Notificación de espera de certificado');
            $mail->addAddress($respaldo["mensaje"]["email"]);
            $mail->Subject = "Certificado en proceso";
            $mail->Body    = $cuerpoEmailNotificacion;
            $mail->AltBody = strip_tags($cuerpoEmailNotificacion);
            $mail->send();
        } catch (Exception $e) {
            error_log("certificarAprendizModelo::mdlCertificarAprendiz - Error al enviar correo: " . $e->getMessage());
        }

        return ["codigo" => "200", "mensaje" => "El aprendiz se ha certificado exitosamente."];
    }

    // Documentos de certificación requeridos según tipo de programa
    private const DOCS_REQUERIDOS_TECNICO    = 4; // Certificado laboral, CC, Destrucción carnet, APE
    private const DOCS_REQUERIDOS_TECNOLOGO  = 5; // + Certificado asistencia pruebas TyT

    public static function mdlComprobarRequisitos($id)
    {
        $mensaje = [];
        try {
            $objConsulta = Conexion::conectar()->prepare("SELECT certificacion.*, tipo_programa.*
                FROM certificacion INNER JOIN
                aprendiz ON aprendiz_idaprendiz = idaprendiz
                INNER JOIN ficha ON ficha_idficha = idficha
                INNER JOIN tipo_programa ON tipo_programa_idtipo_programa = idtipo_programa
                WHERE idaprendiz = :idaprendiz");
            $objConsulta->bindParam(":idaprendiz", $id);
            if ($objConsulta->execute()) {
                $objrequisitos = $objConsulta->fetchAll();
                $tipoPrograma  = null;
                $contadorCumplimientoRequisitos = 0;

                foreach ($objrequisitos as $item) {
                    if ($item["estado_archivo"] == 2) {
                        $contadorCumplimientoRequisitos += 1;
                    }
                    $tipoPrograma = $item["nombre_programa"];
                }

                $requeridos = ($tipoPrograma == "Tecnólogo")
                    ? self::DOCS_REQUERIDOS_TECNOLOGO
                    : self::DOCS_REQUERIDOS_TECNICO;

                if ($contadorCumplimientoRequisitos >= $requeridos) {
                    $mensaje = ["codigo" => "200", "mensaje" => $objrequisitos];
                } else {
                    $mensaje = ["codigo" => "202", "mensaje" => "El aprendiz no cumple con las condiciones para certificarse."];
                }

            } else {
                $mensaje = ["codigo" => "202", "mensaje" => "Error al generar la consulta"];
            }
            $objConsulta = null;
        } catch (Exception $e) {
            $mensaje = ["codigo" => "202", "mensaje" => $e->getMessage()];
        }
        return $mensaje;
    }

    public static function mdlCrearRespaldoAprendiz($id)
    {
        $mensaje = [];
        $respaldo = self::mdlBuscarRespaldo($id);

        if ($respaldo["codigo"] !== "200") {
            return ["codigo" => "202", "mensaje" => "el aprendiz no existe"];
        }

        try {
            $pdo = Conexion::conectar();
            
            // 1. Obtener información de empresa y ubicación
            $stmtEmpresa = $pdo->prepare("
                SELECT e.nombre_empresa, e.direccion_empresa, m.nomb_muni, d.nomb_depa 
                FROM seguimiento s 
                INNER JOIN empresa e ON s.empresa_idempresa = e.idempresa 
                INNER JOIN municipios m ON e.municipios_codi_muni = m.codi_muni 
                INNER JOIN departamentos d ON m.departamentos_codi_depa = d.codi_depa 
                WHERE s.aprendiz_idaprendiz = :idaprendiz
            ");
            $stmtEmpresa->bindParam(":idaprendiz", $id);
            $stmtEmpresa->execute();
            $datosEmpresa = $stmtEmpresa->fetch(PDO::FETCH_ASSOC);

            // 2. Preparar valores comunes
            $info = $respaldo["mensaje"];
            $params = [
                ":nombres"           => $info["nombres"],
                ":apellidos"         => $info["apellidos"],
                ":documento"         => $info["documento"],
                ":telefono"          => $info["telefono"],
                ":email"             => $info["email"],
                ":foto"              => (!empty($info["url_foto"])) ? $info["url_foto"] : "assets/img/interface/profile.png",
                ":numeroficha"       => $info["numero_ficha"],
                ":caracterizacion"   => $info["caracterizacion"],
                ":modalidad"         => $info["nombre_modalidad"],
                ":finpractica"       => $info["fecha_fin_practica_seguimiento"],
                ":password_aprendiz" => $info["password_aprendiz"],
                ":nombre_empresa"    => $datosEmpresa['nombre_empresa'] ?? 'No disponible',
                ":direccion_empresa" => $datosEmpresa['direccion_empresa'] ?? 'No disponible',
                ":municipio"         => $datosEmpresa['nomb_muni'] ?? 'No disponible',
                ":departamento"      => $datosEmpresa['nomb_depa'] ?? 'No disponible'
            ];

            // 3. Verificar existencia para decidir INSERT o UPDATE
            $existe = self::mdlverificarExistencia($info);
            
            if ($existe["codigo"] == "201") {
                // INSERT
                $sql = "INSERT INTO aprendices_certificados (nombres, apellidos, documento, telefono, email, foto, numero_ficha, caracterizacion, modalidad, fin_practica, fecha_certificacion, password_aprendiz, nombre_empresa, direccion_empresa, municipio, departamento) 
                        VALUES (:nombres, :apellidos, :documento, :telefono, :email, :foto, :numeroficha, :caracterizacion, :modalidad, :finpractica, :fecha_certificacion, :password_aprendiz, :nombre_empresa, :direccion_empresa, :municipio, :departamento)";
                $params[":fecha_certificacion"] = date('Y-m-d');
            } else if ($existe["codigo"] == "200") {
                // UPDATE
                $sql = "UPDATE aprendices_certificados SET nombres = :nombres, apellidos = :apellidos, documento = :documento, telefono = :telefono, email = :email, foto = :foto, numero_ficha = :numeroficha, caracterizacion = :caracterizacion, modalidad = :modalidad, fin_practica = :finpractica, password_aprendiz = :password_aprendiz, fecha_certificacion = NOW(), nombre_empresa = :nombre_empresa, direccion_empresa = :direccion_empresa, municipio = :municipio, departamento = :departamento 
                        WHERE idaprendices_certificados = :id";
                $params[":id"] = $existe["mensaje"]["idaprendices_certificados"];
            } else {
                return ["codigo" => "202", "mensaje" => "error en la consulta de existencia"];
            }

            // 4. Ejecutar consulta unificada
            $stmtFinal = $pdo->prepare($sql);
            foreach ($params as $key => $value) {
                $stmtFinal->bindValue($key, $value);
            }

            if ($stmtFinal->execute()) {
                // 5. Actualizar estado del aprendiz a "Certificado" (ID 1)
                $stmtEstado = $pdo->prepare("UPDATE aprendiz SET estado_aprendiz_idestado_aprendiz = 1 WHERE idaprendiz = :idaprendiz");
                
                if ($stmtEstado->execute([":idaprendiz" => $id])) {
                    $mensaje = ["codigo" => "200", "mensaje" => $info];
                } else {
                    $mensaje = ["codigo" => "202", "mensaje" => "Respaldo creado, pero hubo un error al actualizar el estado del aprendiz"];
                }
            } else {
                $mensaje = ["codigo" => "202", "mensaje" => "error al ejecutar la persistencia del respaldo"];
            }

        } catch (Exception $e) {
            $mensaje = ["codigo" => "202", "mensaje" => $e->getMessage()];
        }

        return $mensaje;
    }

    public static function mdlverificarExistencia($respaldo)
    {
        $mensaje = [];
        try {
            $objExisteRegistro = Conexion::conectar()->prepare("SELECT * FROM aprendices_certificados WHERE documento = :documento AND numero_ficha = :numeroficha");
            $objExisteRegistro->bindParam(":documento", $respaldo["documento"]);
            $objExisteRegistro->bindParam(":numeroficha", $respaldo["numero_ficha"]);
            $objExisteRegistro->execute();
            $aprendiz = $objExisteRegistro->fetch();
            if ($aprendiz != null) {
                $mensaje = ["codigo" => "200", "mensaje" => $aprendiz];
            } else {
                $mensaje = ["codigo" => "201", "mensaje" => $aprendiz];
            }
            $objExisteRegistro = null;
        } catch (Exception $e) {
            $mensaje = ["codigo" => "202", "mensaje" => $e->getMessage()];
        }
        return $mensaje;
    }

    public static function mdlBuscarRespaldo($id)
    {
        $mensaje = [];
        $respaldo = null;
        try {
            $objConsulta = Conexion::conectar()->prepare("SELECT * FROM aprendiz INNER JOIN ficha ON ficha_idficha = idficha INNER JOIN seguimiento ON idaprendiz = aprendiz_idaprendiz INNER JOIN modalidad ON modalidad_idmodalidad = idmodalidad WHERE idaprendiz = :idaprendiz");
            $objConsulta->bindParam(":idaprendiz", $id);
            if ($objConsulta->execute()) {
                $respaldo = $objConsulta->fetch();
                $respaldoBD = $objConsulta->fetchAll();
                $mensaje = ["codigo" => "200", "mensaje" => $respaldo, "respaldoBD" => $respaldoBD];
            }
            $objConsulta = null;
        } catch (Exception $e) {
            $mensaje = ["codigo" => "202", "mensaje" => $e->getMessage()];
        }
        return $mensaje;
    }

    public static function mdlVaciarFolders($rutaFolderAprendiz)
    {
        $mensaje = [];
        $errorFicheros = 0;
        $errorFolders = 0;
        $contenidoFolder = scandir($rutaFolderAprendiz);
        foreach ($contenidoFolder as $item) {
            $subRuta = null;
            if ($item == "." || $item == "..") {
            } else {
                if (is_dir($rutaFolderAprendiz . "/" . $item)) {
                    $contenidoSubFolder = scandir($rutaFolderAprendiz . "/" . $item);
                    foreach ($contenidoSubFolder as $subItem) {
                        if ($subItem == "." || $subItem == "..") {
                        } else {
                            if (file_exists($rutaFolderAprendiz . "/" . $item . "/" . $subItem)) {
                                if (!unlink($rutaFolderAprendiz . "/" . $item . "/" . $subItem)) {
                                    $errorFicheros += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($errorFicheros == 0) {
            foreach ($contenidoFolder as $item) {
                $subRuta = null;
                if ($item == "." || $item == "..") {
                } else {
                    if (is_dir($rutaFolderAprendiz . "/" . $item)) {
                        if (file_exists($rutaFolderAprendiz . "/" . $item)) {
                            if (!rmdir($rutaFolderAprendiz . "/" . $item)) {
                                $errorFolders += 1;
                            }
                        }
                    }
                }
            }
            if ($errorFolders == 0) {
                $mensaje = ["codigo" => "200", "mensaje" => "El proceso de limpieza a sido exitoso."];
            } else {
                $mensaje = ["codigo" => "202", "mensaje" => "han ocurido " . $errorFolders . " durante el proceso de eliminar folders."];
            }
        } else {
            $mensaje = ["codigo" => "202", "mensaje" => "han ocurido " . $errorFicheros . " durante el proceso de eliminar ficheros."];
        }
        return $mensaje;
    }

    public static function mdlLimpiarBaseDatos($idaprendiz)
    {
        $mensaje = [];
        $datosEtapaSeguimientos = self::consultarEtapaPractica($idaprendiz);
        if ($datosEtapaSeguimientos != "404") {
            $error = 0;
            $ordenLimpieza =
                [
                    "DELETE FROM bitacora WHERE aprendiz_idaprendiz = :id",
                    "DELETE FROM certificacion WHERE aprendiz_idaprendiz = :id",
                    "DELETE FROM recuperacion_contrasena_aprendiz WHERE aprendiz_idaprendiz = :id",
                    "DELETE FROM visita_seguimiento WHERE seguimiento_idseguimiento = :id",
                    "DELETE FROM seguimiento WHERE aprendiz_idaprendiz = :id",
                    "DELETE FROM aprendiz WHERE idaprendiz = :id"
                ];
            for ($i = 0; $i < count($ordenLimpieza); $i++) {
                try {
                    if ($i !== 3) {
                        $sql = $ordenLimpieza[$i];
                        $objConsulta = Conexion::conectar()->prepare($sql);
                        $objConsulta->bindParam(":id", $idaprendiz);
                        if (!$objConsulta->execute()) {
                            $error += 1;
                        }
                        $objConsulta = null;
                    } else {
                        for ($j = 0; $j < count($datosEtapaSeguimientos); $j++) {
                            $sql = $ordenLimpieza[$i];
                            $objConsulta = Conexion::conectar()->prepare($sql);
                            $objConsulta->bindParam(":id", $datosEtapaSeguimientos[$j]["idseguimiento"]);
                            if (!$objConsulta->execute()) {
                                $error += 1;
                            }
                            $objConsulta = null;
                        }
                    }
                } catch (Exception $e) {
                    $error += 1;
                }
            }
            if ($error == 0) {
                $mensaje = ["codigo" => "200", "mensaje" => "la limpieza se realizo con exito."];
            } else {
                $mensaje = ["codigo" => "202", "mensaje" => "hubo un error al limpiar la base de datos."];
            }
        } else {
            $mensaje = ["codigo" => "202", "mensaje" => "hubo un error al consultar las etapas practicas."];
        }
        return $mensaje;
    }

    public static function mdlSeguimientosAprendizCertificacion($id)
    {
        $mensaje = null;
        try {
            $sql = "SELECT * FROM visita_seguimiento INNER JOIN tipo_seguimiento ON tipo_seguimiento_idtipo_seguimiento = idtipo_seguimiento INNER JOIN seguimiento ON seguimiento_idseguimiento = idseguimiento INNER JOIN funcionario ON funcionario.idfuncionario = visita_seguimiento.funcionario_idfuncionario WHERE aprendiz_idaprendiz = :id";
            $objConsulta = Conexion::conectar()->prepare($sql);
            $objConsulta->bindParam(":id", $id);
            if ($objConsulta->execute()) {
                $mensaje = $objConsulta->fetchAll();
            }
            $objConsulta = null;
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
        }
        return $mensaje;
    }

    public static function consultarEtapaPractica($id)
    {
        $mensaje = null;
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM seguimiento WHERE aprendiz_idaprendiz = :id");
            $objRespuesta->bindParam(":id", $id);
            $objRespuesta->execute();
            $mensaje = $objRespuesta->fetchAll();
            $objRespuesta = null;
            if ($mensaje == null) {
                $mensaje = "404";
            }
        } catch (Exception $e) {
            $mensaje = "404";
        }
        return $mensaje;
    }
}
