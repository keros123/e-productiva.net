<?php
session_start();
include_once "../modelo/archivoModelo.php";

class ArchivosControl{
    public $archivo;
    public $usuario;
    public $tipoUsuario;
    public $tipoSolicitud = null;

    public function ctrSubirArchivo(){
        $objRespuesta = ArchivosModelo::mdlSubirArchivo($this->archivo,$this->usuario,$this->tipoUsuario,$this->tipoSolicitud);
        echo json_encode($objRespuesta);
    }
}


if (isset($_SESSION["usuario"])) {
    if (isset($_FILES["subirArchivoImagen"])){
        $objArchivo = new ArchivosControl();
        $objArchivo->archivo = $_FILES["subirArchivoImagen"];
        $objArchivo->usuario = $_POST["usuarioArchivo"];
        $objArchivo->tipoUsuario = $_POST["tipoUsuarioArchivo"];
        $objArchivo->ctrSubirArchivo();
    }
}