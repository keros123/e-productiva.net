<?php
session_start();
include_once "../modelo/generarPdfCertificadoModelo.php";

class generarPdfCertificacionControl {
    public $idAprendiz;

    public function ctrGenerarPdf(){
        $objRespuesta = generarPdfCertificacionModelo::mdlGenerarPdf($this->idAprendiz);
        echo json_encode($objRespuesta);
    }
}

if(isset($_SESSION["usuario"])) {
    if (isset($_POST["idAprendiz"])) {
        $objGenerar = new generarPdfCertificacionControl();
        $objGenerar->idAprendiz = $_POST["idAprendiz"]; 
        $objGenerar->ctrGenerarPdf();
    }
}