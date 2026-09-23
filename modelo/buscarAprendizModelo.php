<?php

include_once "conexion.php";

class buscarAprendizModelo
{

    public static function mdlBuscarPorDocumento($documento)
    {
        $mensaje = [];
        $infoAprendiz = null;
        $bitacoras = null;
        $seguimientos = null;
        $certificacion = null;
        try {
            $objInfoAprendiz = Conexion::conectar()->prepare("SELECT * FROM aprendiz a
            INNER JOIN ficha ON idficha = ficha_idficha
            INNER JOIN estado_aprendiz ON a.estado_aprendiz_idestado_aprendiz = estado_aprendiz.idestado_aprendiz
            INNER JOIN tipo_documento ON tipo_documento_idtipo_documento = idtipo_documento
            WHERE a.documento = :documento");
            $objInfoAprendiz->bindParam(":documento", $documento);

            if ($objInfoAprendiz->execute()) {
                $infoAprendiz = $objInfoAprendiz->fetch();
                if ($infoAprendiz != null) {
                    $bitacoras = self::infoBitacoras($infoAprendiz["idaprendiz"]);
                    $seguimientos = self::infoSeguimientos($infoAprendiz["idaprendiz"]);
                    $certificacion = self::infoCertificacion($infoAprendiz["idaprendiz"]);
                    $etapaPractica = self::infoEtapaPractica($infoAprendiz["idaprendiz"]);

                    $mensaje = ["codigo" => "200", "mensaje" => "Peticion completada.", "informacionAprendiz" => $infoAprendiz, "bitacoras" => $bitacoras["resultado"], "seguimientos" => $seguimientos["resultado"], "certificacion" => $certificacion["resultado"], "etapaPractica" => $etapaPractica["resultado"]];
                } else {
                    $mensaje = ["codigo" => "202", "mensaje" => "El numero de documento ingresado no se encuentra en la base de datos.", "informacionAprendiz" => "", "bitacoras" => "", "seguimientos" => "", "certificacion" => ""];
                }
            }
            $objInfoAprendiz = null;
        } catch (Exception $e) {
            $mensaje = ["codigo" => "202", "mensaje" => $e->getMessage(), "informacionAprendiz" => "", "bitacoras" => "", "seguimientos" => "", "certificacion" => ""];
        }
        return $mensaje;
    }


    public static function infoEtapaPractica($idAprendiz)
    {
        $mensaje = [];
        $resultadoConsulta = [];
        try {
            $objConsulta = Conexion::conectar()->prepare("SELECT seguimiento.fecha_inicio_practica,seguimiento.fecha_fin_practica_seguimiento,seguimiento.observacion_seguimiento, empresa.nit_empresa, empresa.nombre_empresa , empresa.direccion_empresa, modalidad.nombre_modalidad FROM seguimiento INNER JOIN empresa ON empresa.idempresa = seguimiento.empresa_idempresa INNER JOIN modalidad ON seguimiento.modalidad_idmodalidad = modalidad.idmodalidad WHERE aprendiz_idaprendiz = :aprendiz_idaprendiz");

            $objConsulta->bindParam(":aprendiz_idaprendiz", $idAprendiz);
            if ($objConsulta->execute()) {
                $resultadoConsulta = $objConsulta->fetchAll();
                $mensaje = ["codigo" => "200", "mensaje" => "sin errores en la consulta", "resultado" => $resultadoConsulta];
            }
        } catch (Exception $e) {
            $mensaje = ["codigo" => "202", "mensaje" => $e->getMessage(), "resultado" => $resultadoConsulta];
        }

        return $mensaje;
    }

    public static function infoBitacoras($idAprendiz)
    {
        $mensaje = [];
        $resultadoConsulta = [];
        try {
            $objConsulta = Conexion::conectar()->prepare("SELECT * FROM bitacora WHERE aprendiz_idaprendiz = :idAprendiz");
            $objConsulta->bindParam(":idAprendiz", $idAprendiz);
            if ($objConsulta->execute()) {
                $resultadoConsulta = $objConsulta->fetchAll();
                $mensaje = ["codigo" => "200", "mensaje" => "sin errores en la consulta", "resultado" => $resultadoConsulta];
            }
            $objConsulta = null;
        } catch (Exception $e) {
            $mensaje = ["codigo" => "202", "mensaje" => $e->getMessage(), "resultado" => $resultadoConsulta];
        }
        return $mensaje;
    }

    public static function infoSeguimientos($idAprendiz)
    {
        $mensaje = [];
        $resultadoConsulta = [];
        try {
            $objConsulta = Conexion::conectar()->prepare("SELECT * FROM visita_seguimiento 
                            INNER JOIN seguimiento ON seguimiento_idseguimiento = idseguimiento 
                            INNER JOIN tipo_seguimiento ON tipo_seguimiento_idtipo_seguimiento = idtipo_seguimiento 
                            INNER JOIN modalidad ON modalidad.idmodalidad = seguimiento.modalidad_idmodalidad 
                            INNER JOIN funcionario ON funcionario_idfuncionario = idfuncionario 
                            INNER JOIN estado_visita_seguimiento ON estado_visita_seguimiento_idestado_visita_seguimiento = idestado_visita_seguimiento  
                            WHERE aprendiz_idaprendiz = :idAprendiz  ORDER BY modalidad.idmodalidad ASC");
 
            $objConsulta->bindParam(":idAprendiz", $idAprendiz);
            if ($objConsulta->execute()) {
                $resultadoConsulta = $objConsulta->fetchAll();
                $mensaje = ["codigo" => "200", "mensaje" => "sin errores en la consulta", "resultado" => $resultadoConsulta];
            }
            $objConsulta = null;
        } catch (Exception $e) {
            $mensaje = ["codigo" => "202", "mensaje" => $e->getMessage(), "resultado" => $resultadoConsulta];
        }
        return $mensaje;
    }

    public static function infoCertificacion($idAprendiz)
    {
        $mensaje = [];
        $resultadoConsulta = [];
        try {
            $objConsulta = Conexion::conectar()->prepare("SELECT * FROM certificacion WHERE aprendiz_idaprendiz = :idAprendiz");
            $objConsulta->bindParam(":idAprendiz", $idAprendiz);
            if ($objConsulta->execute()) {
                $resultadoConsulta = $objConsulta->fetchAll();
                $mensaje = ["codigo" => "200", "mensaje" => "sin errores en la consulta", "resultado" => $resultadoConsulta];
            }
            $objConsulta = null;
        } catch (Exception $e) {
            $mensaje = ["codigo" => "202", "mensaje" => $e->getMessage(), "resultado" => $resultadoConsulta];
        }
        return $mensaje;
    }
   
}
