<?php

include_once "conexion.php";
include_once "../helpers/crearEmail.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class AprendizCertificacionModelo
{

    public static function mdlCambiarEstadoArchivo($idCertificacion, $idAprendiz, $estadoArchivo, $novedad, $email)
    {
        $mensaje = array();
        $proceso = 200;
        if ($estadoArchivo == 3) {
            $nombreArchivoModificado = self::nombreArchivoModificado($idCertificacion);

            $novedadNotificada = self::notificarNovedadArchivoCertificacion($novedad, $email, $nombreArchivoModificado);
            if ($novedadNotificada["codigo"] == "200") {
                $proceso = 200;
            } else {
                $proceso = 401;
            }
        }

        if ($proceso == 200) {
            try {
                // Al rechazar (estado 3) se limpia url_documento para obligar al aprendiz
                // a subir un nuevo archivo antes de poder re-radicar.
                if ($estadoArchivo == 3) {
                    $objRespuesta = Conexion::conectar()->prepare("UPDATE certificacion SET estado_archivo=:estado_archivo, novedad_archivo=:novedad_archivo, url_documento = NULL WHERE idcertificacion=:idcertificacion");
                } else {
                    $objRespuesta = Conexion::conectar()->prepare("UPDATE certificacion SET estado_archivo=:estado_archivo, novedad_archivo=:novedad_archivo WHERE idcertificacion=:idcertificacion");
                }
                $objRespuesta->bindParam(":estado_archivo", $estadoArchivo);
                $objRespuesta->bindParam(":novedad_archivo", $novedad);
                $objRespuesta->bindParam(":idcertificacion", $idCertificacion);
                if ($objRespuesta->execute()) {
                    $mensaje = array("codigo" => "200", "mensaje" => "estado modificado correctamente");
                } else {
                    $mensaje = array("codigo" => "401", "mensaje" => "error al modificar el estado");
                }
                $objRespuesta = null;
            } catch (Exception $e) {
                $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
            }
        } else {
            $mensaje = array("codigo" => "401", "mensaje" => "No fue posible cambiar el estado");
        }
        return $mensaje;
    }

    public static function notificarNovedadArchivoCertificacion($novedadRecibida, $email, $nombreArchivo)
    {
        $autor = "SGD-CIMM";
        $fecha = date('Y-m-d');
        $novedad = "El archivo: " . $nombreArchivo[0] . " fue rechazado. <br> Novedad Proceso: " . $novedadRecibida;
        include '../vista/modulos/plantillaEmailNovedades.php';
        $mensaje = [];
        try {

            $mail = crearEmail('seguimientos@eproductiva.net', 'Alerta Certificación.');
            $mail->addAddress($email);
            $mail->addCC('certificacion9304@sena.edu.co');
            $mail->isHTML(true);
            $mail->Subject = "Novedad archivo de certificación radicado";
            $mail->Body    = $cuerpoMensajeNovedadReporte;
            $mail->AltBody = strip_tags($cuerpoMensajeNovedadReporte);
            if ($mail->send()) {
                $mensaje = ["codigo" => "200"];
            } else {
                $mensaje = ["codigo" => "425"];
            }
        } catch (Exception $e) {
            $mensaje = ["codigo" => "425"];
        }
        return $mensaje;
    }

    public static function nombreArchivoModificado($idCertificacion)
    {
        $nombreArchivo = null;
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT titulo_documento FROM certificacion WHERE idcertificacion = :idcertificacion");
            $objRespuesta->bindParam(":idcertificacion", $idCertificacion);
            if ($objRespuesta->execute()) {
                $nombreArchivo = $objRespuesta->fetch();
            }
            $objRespuesta = null;
        } catch (Exception $e) {
            $nombreArchivo = $e;
        }
        return $nombreArchivo;
    }
}
