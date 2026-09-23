<?php

include_once "conexion.php";
include_once "plantillaEmail.php";
include_once "../helpers/crearEmail.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class detalleUsuarioModelo
{
    public static function mdlInfoAprendiz($id)
    {
        $datos = '';
        try {
            $sql = "SELECT aprendiz.*, tipo_documento.*, ficha.*, estado_aprendiz.*,seguimiento.*,empresa.*,modalidad.* FROM aprendiz 
                    INNER JOIN tipo_documento ON aprendiz.tipo_documento_idtipo_documento = tipo_documento.idtipo_documento 
                    INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha 
                    INNER JOIN estado_aprendiz ON aprendiz.estado_aprendiz_idestado_aprendiz = estado_aprendiz.idestado_aprendiz 
                    INNER JOIN seguimiento ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz
                    INNER JOIN empresa ON seguimiento.empresa_idempresa = empresa.idempresa
                    INNER JOIN modalidad ON seguimiento.modalidad_idmodalidad = modalidad.idmodalidad
                    WHERE idaprendiz = :id";

            $objConsulta = conexion::conectar()->prepare($sql);
            $objConsulta->bindparam(":id", $id);
            $objConsulta->execute();
            $datos = $objConsulta->fetch();
            $objConsulta = null;
        } catch (Exception $e) {
            $datos = $e->getMessage();
        }
        return $datos;
    }


    public static function mdlSeguimientoAprendiz($id)
    {
        $datos = '';
        try {
            $sql = "SELECT * FROM seguimiento INNER JOIN empresa ON seguimiento.empresa_idempresa = empresa.idempresa INNER JOIN modalidad ON seguimiento.modalidad_idmodalidad = modalidad.idmodalidad WHERE aprendiz_idaprendiz = :id";
            $objConsulta = conexion::conectar()->prepare($sql);
            $objConsulta->bindparam(":id", $id);
            $objConsulta->execute();
            $datos = $objConsulta->fetchAll();
            $objConsulta = null;
        } catch (Exception $e) {
            $datos = $e->getMessage();
        }
        return $datos;
    }

    public static function mdlDetalleSeguimientoAprendiz($id, $dirigido)
    {
        $datos = '';
        $asignacion = "2";
        try {
            $sql = "SELECT *, visita_seguimiento.fecha_radicado AS fecha_radicado_visita, funcionario.nombres AS nombresfuncionario, funcionario.apellidos AS apellidosfuncionario, funcionario.url_foto AS url_foto_instructor, funcionario.email AS email_instructor, modalidad.idmodalidad AS modalidad_idmodalidad, modalidad.nombre_modalidad AS nombre_modalidad FROM visita_seguimiento INNER JOIN funcionario ON visita_seguimiento.funcionario_idfuncionario = funcionario.idfuncionario INNER JOIN tipo_seguimiento ON visita_seguimiento.tipo_seguimiento_idtipo_seguimiento = tipo_seguimiento.idtipo_seguimiento INNER JOIN estado_visita_seguimiento ON visita_seguimiento.estado_visita_seguimiento_idestado_visita_seguimiento = estado_visita_seguimiento.idestado_visita_seguimiento INNER JOIN seguimiento ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento INNER JOIN modalidad ON seguimiento.modalidad_idmodalidad = modalidad.idmodalidad INNER JOIN aprendiz ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz WHERE aprendiz.idaprendiz = :id AND asignacion=:asignacion ORDER BY modalidad.idmodalidad ASC";
            $objConsulta = conexion::conectar()->prepare($sql);
            $objConsulta->bindparam(":id", $id);
            $objConsulta->bindparam(":asignacion", $asignacion);
            $objConsulta->execute();

            $datos = ["datos" => $objConsulta->fetchAll(), "dirigido" => $dirigido];
            $objConsulta = null;
        } catch (Exception $e) {
            $datos = ["datos" => $e->getMessage(), "dirigido" => ""];
        }
        return $datos;
    }

    public static function mdlDetalleBitacorasAprendiz($id)
    {
        $datos = '';
        try {
            $sql = "SELECT * FROM bitacora WHERE aprendiz_idaprendiz = :id";
            $objConsulta = conexion::conectar()->prepare($sql);
            $objConsulta->bindparam(":id", $id);
            $objConsulta->execute();
            $datos = $objConsulta->fetchAll();
            $objConsulta = null;
        } catch (Exception $e) {
            $datos = $e->getMessage();
        }
        return $datos;
    }

    // funcionario

    public static function mdlInfoFuncionario($id)
    {
        $datos = '';
        try {
            $sql = "SELECT * FROM funcionario INNER JOIN tipo_documento ON funcionario.tipo_documento_idtipo_documento = tipo_documento.idtipo_documento INNER JOIN tipo_funcionario ON funcionario.tipo_funcionario_idtipo_funcionario = tipo_funcionario.idtipo_funcionario INNER JOIN municipios ON funcionario.municipios_codi_muni = municipios.codi_muni INNER JOIN departamentos ON municipios.departamentos_codi_depa = departamentos.codi_depa WHERE idfuncionario = :id";
            $objConsulta = conexion::conectar()->prepare($sql);
            $objConsulta->bindparam(":id", $id);
            $objConsulta->execute();
            $datos = $objConsulta->fetchAll();
            $objConsulta = null;
        } catch (Exception $e) {
            $datos = $e->getMessage();
        }
        return $datos;
    }

    public static function mdlCargarNovedades($id)
    {
        $datos = '';
        try {
            $sql = "SELECT * FROM novedad_visita_seguimiento WHERE visita_seguimiento_idvisita_seguimiento = :id ORDER BY fecha_hora_novedad DESC";
            $objConsulta = conexion::conectar()->prepare($sql);
            $objConsulta->bindparam(":id", $id);
            $objConsulta->execute();
            $datos = $objConsulta->fetchAll();
            $objConsulta = null;
        } catch (Exception $e) {
            $datos = $e->getMessage();
        }
        return $datos;
    }


    public static function mdlSeguimientosFuncionario($idFuncionario)
    {
        $mensaje = array();
        try {
            // $objRespuesta = Conexion::conectar()->prepare("SELECT visita_seguimiento.fecha_radicado,ficha.numero_ficha,ficha.caracterizacion,aprendiz.nombres,aprendiz.apellidos,aprendiz.documento,tipo_seguimiento.nombre_tipo_seguimiento,estado_visita_seguimiento.nombre_estado_visita_seguimiento,visita_seguimiento.idvisita_seguimiento,visita_seguimiento.url_documento,visita_seguimiento.estado_reporte,visita_seguimiento.ubicacion_seguimiento FROM funcionario INNER JOIN visita_seguimiento ON funcionario.idfuncionario = visita_seguimiento.funcionario_idfuncionario INNER JOIN tipo_seguimiento ON visita_seguimiento.tipo_seguimiento_idtipo_seguimiento = tipo_seguimiento.idtipo_seguimiento INNER JOIN estado_visita_seguimiento ON visita_seguimiento.estado_visita_seguimiento_idestado_visita_seguimiento = estado_visita_seguimiento.idestado_visita_seguimiento INNER JOIN seguimiento ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento INNER JOIN aprendiz ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha WHERE idfuncionario=:idfuncionario ORDER BY seguimiento.fecha_radicado DESC");
            $objRespuesta = Conexion::conectar()->prepare("SELECT 
            visita_seguimiento.fecha_radicado,
            ficha.numero_ficha,
            ficha.caracterizacion,
            aprendiz.nombres,
            aprendiz.apellidos,
            aprendiz.documento,
            tipo_seguimiento.nombre_tipo_seguimiento,
            estado_visita_seguimiento.nombre_estado_visita_seguimiento,
            visita_seguimiento.idvisita_seguimiento,
            visita_seguimiento.url_documento,
            visita_seguimiento.estado_reporte,
            visita_seguimiento.ubicacion_seguimiento 
            FROM funcionario 
            INNER JOIN visita_seguimiento ON funcionario.idfuncionario = visita_seguimiento.funcionario_idfuncionario 
            INNER JOIN tipo_seguimiento ON visita_seguimiento.tipo_seguimiento_idtipo_seguimiento = tipo_seguimiento.idtipo_seguimiento 
            INNER JOIN estado_visita_seguimiento ON visita_seguimiento.estado_visita_seguimiento_idestado_visita_seguimiento = estado_visita_seguimiento.idestado_visita_seguimiento 
            INNER JOIN seguimiento ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento 
            INNER JOIN aprendiz ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz 
            INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha 
            WHERE idfuncionario=:idfuncionario 
            ORDER BY seguimiento.fecha_radicado DESC");
            $objRespuesta->bindParam("idfuncionario", $idFuncionario);
            $objRespuesta->execute();
            $listaSeguimientos = $objRespuesta->fetchAll();
            $mensaje = array("codigo" => "200", "mensaje" => $listaSeguimientos);
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlCambiarEstadoVisitaSeguimiento($idVisitaSeguimiento, $estadoVisitaSeguimiento, $novedad, $enviarCorreo = "si")
    {
        $mensaje = array("codigo" => "200");
        $fechaRadicadoNovedad = date("Y-m-d H:i:s");
        $nombreFuncionario = $_SESSION["nombreCompleto"];

        // Primero registramos la novedad si existe
        if ($novedad != "null") {
            try {
                $objRespuesta = Conexion::conectar()->prepare("INSERT INTO novedad_visita_seguimiento(fecha_hora_novedad,autor,novedad,visita_seguimiento_idvisita_seguimiento)VALUES(:fecha_hora_novedad,:autor,:novedad,:visita_seguimiento_idvisita_seguimiento)");
                $objRespuesta->bindParam(":fecha_hora_novedad", $fechaRadicadoNovedad);
                $objRespuesta->bindParam(":autor", $nombreFuncionario);
                $objRespuesta->bindParam(":novedad", $novedad);
                $objRespuesta->bindParam(":visita_seguimiento_idvisita_seguimiento", $idVisitaSeguimiento);

                if (!$objRespuesta->execute()) {
                    $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar la novedad");
                }
                $objRespuesta = null;
            } catch (Exception $e) {
                $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
            }
        }

        // Si todo va bien hasta ahora, procedemos con el cambio de estado
        if ($mensaje["codigo"] == "200") {
            try {
                $idAprendiz = null;
                $tipoSeguimiento = null;

                // Consultar datos del seguimiento
                $objRespuesta = Conexion::conectar()->prepare("SELECT aprendiz.idaprendiz,visita_seguimiento.tipo_seguimiento_idtipo_seguimiento 
            FROM visita_seguimiento 
            INNER JOIN seguimiento 
            ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento 
            INNER JOIN aprendiz 
            ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz 
            WHERE visita_seguimiento.idvisita_seguimiento = :id");
                $objRespuesta->bindParam(":id", $idVisitaSeguimiento);
                $objRespuesta->execute();
                $objVisitaSeguimiento = $objRespuesta->fetch();
                $objRespuesta = null;

                if ($objVisitaSeguimiento != null) {
                    $idAprendiz = $objVisitaSeguimiento["idaprendiz"];
                    $tipoSeguimiento = $objVisitaSeguimiento["tipo_seguimiento_idtipo_seguimiento"];

                    // Cambiar estado solo si es un seguimiento final
                    if ($tipoSeguimiento == "2" || $tipoSeguimiento == "5") {
                        if ($estadoVisitaSeguimiento == 1) {
                            $estadoAprendiz = 9; // En proceso de certificación
                        } else {
                            $estadoAprendiz = 2; // en formación
                        }
                        $objRespuesta = Conexion::conectar()->prepare("UPDATE aprendiz SET estado_aprendiz_idestado_aprendiz = :estado_aprendiz_idestado_aprendiz WHERE idaprendiz=:idaprendiz");
                        $objRespuesta->bindParam(":estado_aprendiz_idestado_aprendiz", $estadoAprendiz);
                        $objRespuesta->bindParam(":idaprendiz", $idAprendiz);
                        if (!$objRespuesta->execute()) {
                            $mensaje = array("codigo" => "401", "mensaje" => "Error al modificar el estado del aprendiz");
                        }
                        $objRespuesta = null;
                    }
                }

                // Si todo sigue bien, actualizamos el estado del reporte
                if ($mensaje["codigo"] == "200") {
                    $objRespuesta = Conexion::conectar()->prepare("UPDATE visita_seguimiento SET estado_reporte=:estado_reporte WHERE idvisita_seguimiento=:idvisita_seguimiento");
                    $objRespuesta->bindParam(":estado_reporte", $estadoVisitaSeguimiento);
                    $objRespuesta->bindParam(":idvisita_seguimiento", $idVisitaSeguimiento);
                    if ($objRespuesta->execute()) {
                        $mensaje = array("codigo" => "200", "mensaje" => "Estado modificado correctamente");

                        // Solo enviamos el correo si el parámetro enviarCorreo es "si"
                        if ($enviarCorreo == "si") {
                            // Obtener el email del funcionario
                            $objRespuesta = Conexion::conectar()->prepare("SELECT funcionario.email FROM visita_seguimiento INNER JOIN funcionario ON visita_seguimiento.funcionario_idfuncionario = funcionario.idfuncionario WHERE visita_seguimiento.idvisita_seguimiento = :id");
                            $objRespuesta->bindParam(":id", $idVisitaSeguimiento);
                            $objRespuesta->execute();
                            $emailData = $objRespuesta->fetch();
                            $objRespuesta = null;

                            if ($emailData && isset($emailData['email'])) {
                                $emailFuncionario = $emailData['email'];

                                self::enviarCorreoEstadoSeguimiento($idVisitaSeguimiento, $novedad, "administrador", $emailFuncionario);
                            }
                        }
                    } else {
                        $mensaje = array("codigo" => "401", "mensaje" => "Error al modificar el estado por favor intentelo mas tarde");
                    }
                    $objRespuesta = null;
                }
            } catch (Exception $e) {
                $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
            }
        }

        return $mensaje;
    }


    // Método para enviar correo con el estado del seguimiento
    private static function enviarCorreoEstadoSeguimiento($id, $novedad, $creador, $emailNovedad)
    {
        $mensaje = [];
        $fecha = date("Y-m-d H:i:s");
        $autor = $_SESSION["nombreCompleto"];

        if ($creador == "administrador") {
            // Obtener información del aprendiz y ficha para incluir en el correo
            $infoAprendiz = self::obtenerInfoAprendizPorVisitaSeguimiento($id);

            include '../vista/modulos/plantillaEmailNovedades.php';

            $mail = crearEmail('seguimientos@eproductiva.net', 'Novedad Reporte de Seguimiento');
            $mail->addAddress($emailNovedad);
            $mail->Subject = "Novedad Reporte Seguimiento - Aprendiz: " . $infoAprendiz['nombreAprendiz'] . " " . $infoAprendiz['apellidosAprendiz'];
            $mail->Body    = $cuerpoMensajeNovedadReporte;
            $mail->AltBody = strip_tags($cuerpoMensajeNovedadReporte);

            $mail->send();
        }

        return $mensaje;
    }

    // Método para obtener información del aprendiz a partir del ID de visita seguimiento
    private static function obtenerInfoAprendizPorVisitaSeguimiento($idVisitaSeguimiento)
    {
        try {
            $sql = "SELECT 
                aprendiz.nombres AS nombreAprendiz, 
                aprendiz.apellidos AS apellidosAprendiz,
                ficha.numero_ficha,
                ficha.caracterizacion
            FROM visita_seguimiento 
            INNER JOIN seguimiento ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento
            INNER JOIN aprendiz ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz
            INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha
            WHERE visita_seguimiento.idvisita_seguimiento = :id";

            $objConsulta = conexion::conectar()->prepare($sql);
            $objConsulta->bindParam(":id", $idVisitaSeguimiento);
            $objConsulta->execute();
            $datos = $objConsulta->fetch(PDO::FETCH_ASSOC);
            $objConsulta = null;

            return $datos;
        } catch (Exception $e) {
            return $e;
        }
    }
}
