<?php
session_start();
include_once "../modelo/aprendizCertificacionModelo.php";

class AprendizCertificacionControl{

    public $idAprendiz;
    public $estadoArchivo;
    public $idCertificacion;
    public $novedad;
    public $email;

    public function ctrCambiarEstadoArchivo(){
        $objRespuesta = AprendizCertificacionModelo::mdlCambiarEstadoArchivo($this->idCertificacion,$this->idAprendiz,$this->estadoArchivo,$this->novedad,$this->email);
        echo json_encode($objRespuesta);
    }

}


if (isset($_SESSION["usuario"])) {
    if (isset($_POST["estadoCertificacion"],$_POST["aprendizCertificacion"],$_POST["archivoCertificacion"],$_POST["email"])){
        $objCambioEstado = new AprendizCertificacionControl();
        $objCambioEstado->estadoArchivo = $_POST["estadoCertificacion"];
        $objCambioEstado->idAprendiz = $_POST["aprendizCertificacion"];
        $objCambioEstado->idCertificacion = $_POST["archivoCertificacion"];
        $objCambioEstado->email = $_POST["email"];
        if (isset($_POST["novedadCertificacion"])){
            $objCambioEstado->novedad = $_POST["novedadCertificacion"];
        }else{
            $objCambioEstado->novedad = "";
        }
    
        $objCambioEstado->ctrCambiarEstadoArchivo();
    }
}