<?php
session_start();
include_once "../modelo/radicacionModelo.php";

class RadicacionControl{

    public $idAprendiz;

    public function ctrValidarEstadoAprendiz(){
        $objRespuesta = RadicadoModelo::mdlValidarEstadoAprendiz($this->idAprendiz);
        echo json_encode($objRespuesta);
    }

}

if (isset($_SESSION["usuario"])) {
    if (isset($_POST["infoAprendiz"])){
        $objInfoAprendiz = new RadicacionControl();
        $objInfoAprendiz->idAprendiz = $_POST["infoAprendiz"];
        $objInfoAprendiz->ctrValidarEstadoAprendiz();
    }
}
