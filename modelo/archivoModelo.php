<?php
session_start();
include_once "conexion.php";
include_once "subirArchivoModelo.php";
include_once "usuarioModelo.php";

class ArchivosModelo{

    public static function mdlSubirArchivo($archivo,$usuario,$tipoUsuario,$tipoSolicitud){

        $nombre_campo = "";
        if ($tipoSolicitud == null){
            $nombre_campo = "url_foto";
        }

        $objRespuesta = subirArchivo::mdlSubirArchivos($archivo,$usuario,$tipoUsuario,$tipoSolicitud);
        if($objRespuesta["codigo"] == "202"){
            $objRespuesta = usuarioModelo::mdlEditarRutaArchivo($usuario,$tipoUsuario,$objRespuesta["mensaje"],$nombre_campo);
            if ($objRespuesta["codigo"] == "202"){
                $mensaje = array("codigo"=>"202","mensaje"=>$objRespuesta["mensaje"]);
                $_SESSION["foto"] = $objRespuesta["mensaje"];
                $objRespuesta = null;
            }else{
                $mensaje = array("codigo"=>"425","mensaje"=>"error al realizar cambios");
            }
        }

        return $mensaje;

    }

}