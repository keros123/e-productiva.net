<?php
session_start();
include_once "../modelo/registroMasivoEtapaPracticaModelo.php";

class RegistroMasivoEtapaPracticaControl{

    public $archivo;


    public function ctrRegistroEtapaPractica(){
        $objRespuesta = RegistroMasivoEtapaPracticaModelo::mdlRegistroEtapaPractica($this->archivo);
        echo json_encode($objRespuesta);
    }  
}

if (isset($_SESSION["usuario"])) {
    if (isset($_POST["registroMasivoEtapaPractica"]) == "ok"){
        $objRegistroEtapaPractica = new RegistroMasivoEtapaPracticaControl();
        $objRegistroEtapaPractica->archivo = $_FILES["archivoEtapaPractica"];
        $objRegistroEtapaPractica->ctrRegistroEtapaPractica();
    }
}
