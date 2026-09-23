<?php
include_once "conexion.php";

class fichaCertificacionModelo {

    public static function mdlcargarTablaFichasPorCertificar(){
        $mensaje = array();
        try {
            $sql = "SELECT ficha.*, estado_ficha.*, tipo_programa.*, red_tecnologica.*, linea_tecnologica.*
            FROM ficha 
            INNER JOIN estado_ficha ON ficha.estado_ficha_idestado_ficha = estado_ficha.idestado_ficha 
            INNER JOIN tipo_programa ON ficha.tipo_programa_idtipo_programa = tipo_programa.idtipo_programa 
            INNER JOIN red_tecnologica ON ficha.red_tecnologica_idred_tecnologica = red_tecnologica.idred_tecnologica 
            INNER JOIN linea_tecnologica ON red_tecnologica.linea_tecnologica_idlinea_tecnologica = linea_tecnologica.idlinea_tecnologica 
            INNER JOIN aprendiz ON ficha.idficha = aprendiz.ficha_idficha 
            WHERE aprendiz.estado_aprendiz_idestado_aprendiz = 6 
            GROUP BY ficha.idficha, estado_ficha.idestado_ficha, tipo_programa.idtipo_programa, red_tecnologica.idred_tecnologica, linea_tecnologica.idlinea_tecnologica";
            $objRespuesta = Conexion::conectar()->prepare($sql);
            $objRespuesta->execute();
            $mensaje = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlcargarListaAprendices ($idFicha) {

        try {
            $sql = "SELECT * FROM aprendiz INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha INNER JOIN tipo_documento ON aprendiz.tipo_documento_idtipo_documento = tipo_documento.idtipo_documento INNER JOIN estado_aprendiz ON aprendiz.estado_aprendiz_idestado_aprendiz = estado_aprendiz.idestado_aprendiz INNER JOIN seguimiento ON idaprendiz = aprendiz_idaprendiz INNER JOIN modalidad ON modalidad_idmodalidad = idmodalidad WHERE ficha.idficha = :idficha AND aprendiz.estado_aprendiz_idestado_aprendiz = 6 AND ( seguimiento.etapa_fragmentada IS NULL OR seguimiento.etapa_fragmentada <> 1 )";
            $objFichasCertificacion = conexion::conectar()->prepare($sql);
            $objFichasCertificacion->bindparam(":idficha", $idFicha);
            if ($objFichasCertificacion->execute()) {
                $datos = $objFichasCertificacion -> fetchAll();
                $objFichasCertificacion = null;
            } else {
                $objFichasCertificacion = null;
                $datos = "Hubo un error";
            }
        } catch (Exception $e) {
            $datos = $e->getMessage();
        }
        return $datos;
    }

    public static function mdllistarDocumentos($idAprendiz){
        try {
            $sql = "SELECT c.idcertificacion, c.titulo_documento, c.novedad_archivo, c.url_documento, c.estado_archivo, a.email
                    FROM certificacion c
                    INNER JOIN aprendiz a ON c.aprendiz_idaprendiz = a.idaprendiz
                    WHERE c.aprendiz_idaprendiz = :idAprendiz";
            $objRespuesta = Conexion::conectar()->prepare($sql);
            $objRespuesta->bindParam(":idAprendiz", $idAprendiz);
            $objRespuesta->execute();
            $datos = $objRespuesta->fetchAll();
            $objRespuesta = null;
            return $datos;
        } catch (Exception $e) {
            return array("mensaje" => $e->getMessage());
        }
    }
}
