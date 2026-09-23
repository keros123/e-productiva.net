<?php   
    include_once "conexion.php";

    class aprendicesCertificadosModelo {
        public static function mdlCargarAprendicesCertificados() {
            $mensaje = null;
            try {
                $sql = "SELECT * FROM aprendices_certificados ORDER BY fecha_certificacion DESC";
                $objRespuesta = Conexion::conectar()->prepare($sql);
                $objRespuesta->execute();
                $mensaje = $objRespuesta->fetchAll();
                $objRespuesta = null;
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
            return $mensaje;
        }
    }