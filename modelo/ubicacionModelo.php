<?php
include_once "conexion.php";

class UbicacionModelo{

    public static function mdlListarDepartamentos(){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT codi_depa,nomb_depa FROM departamentos");
            $objRespuesta->execute();
            $mensaje = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlListarMunicipios($idDepartamento){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM municipios WHERE departamentos_codi_depa = :departamentos_codi_depa");
            $objRespuesta->bindParam(":departamentos_codi_depa",$idDepartamento);
            $objRespuesta->execute();
            $mensaje = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }

}





