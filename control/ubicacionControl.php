<?php
session_start();
include_once "../modelo/ubicacionModelo.php";


class UbicacionControl{

    public $idDepartamento;
    public $idMunicipio;

    public function ctrListarDepartamentos(){
        $objRespuesta = UbicacionModelo::mdlListarDepartamentos();
        echo json_encode($objRespuesta);
    }

    public function ctrListarMunicipios(){
        $objRespuesta = UbicacionModelo::mdlListarMunicipios($this->idDepartamento);
        echo json_encode($objRespuesta);
    }

}

if (isset($_SESSION["usuario"])) {
    if (isset($_POST["cargarSelectAccount"])){
        $objDepartamentos = new UbicacionControl();
        $objDepartamentos->ctrListarDepartamentos();
    }
    
    
    if (isset($_POST["cargarSelectAccountMunicipios"])){
        $objMunicipios = new UbicacionControl();
        $objMunicipios->idDepartamento = $_POST["idDepartamento"];
        $objMunicipios->ctrListarMunicipios();
    }
}