<?php
session_start();
include_once "../modelo/registroMasivoModelo.php";

class restroMasivoControl{

    public $archivo;
    public $ficha;
    public $id;

    public function ctrSubirArchivoRegistroMasivoAprendices(){
        $objRespuesta = registroMasivoModelo::mdlRegistroMasivoAprendices($this->archivo,$this->ficha,$this->id);
        echo json_encode($objRespuesta);
    }
}

if (isset($_SESSION["usuario"])) {
    if (isset($_FILES["archivo_xls"],$_POST["ficha"],$_POST["fichaId"])){
        $objArchivo = new restroMasivoControl();
        $objArchivo->archivo = $_FILES["archivo_xls"];
        $objArchivo->ficha = $_POST["ficha"];
        $objArchivo->id = $_POST["fichaId"];
        $objArchivo->ctrSubirArchivoRegistroMasivoAprendices();
    }
}