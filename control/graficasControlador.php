<?php
session_start();
include_once "../modelo/graficasModelo.php";

class DatosControlador{

    public $year;
    
    public function ctrListarSegumientos(){
        $objlistaSeguimientos =  DatosSeguimientos::mdlListarSeguimientos($this->year);
        echo json_encode($objlistaSeguimientos);
    }

    // public function ctrListarRealizados(){
    //     $objSeguimientosR = DatosSeguimientos::mdlListarRealizados();
    //     echo json_encode($objSeguimientosR);
    // }
    // public function ctrListarPendientes(){
    //     $objSeguimientosP = DatosSeguimientos::mdlListarPendientes();
    //     echo json_encode($objSeguimientosP);
    // }

    // public function ctrListarAsignados(){
    //     $objSeguimientosP = DatosSeguimientos::mdlListarAsignados();
    //     echo json_encode($objSeguimientosP);
    // }
    // public function ctrListarTotal(){
    //     $objSeguimientosP = DatosSeguimientos::mdlListarTotal();
    //     echo json_encode($objSeguimientosP);
    // }
    
    // public function ctrListarVencidos(){
    //     $objSeguimientosV = DatosSeguimientos::mdlVencidos();
    //     echo json_encode($objSeguimientosV);
    // }
    public function ctrListarGrafica(){
        $objSeguimientosG = DatosSeguimientos::mdlgraficas($this->year);
        echo json_encode($objSeguimientosG);
    }
    public function ctrListarResumenCertificacion(){
        $objCertificacion = DatosSeguimientos::mdlDatosCertificacion();
        echo json_encode($objCertificacion);
    }

    public function ctrCargarYears() {
        $objRespuesta = DatosSeguimientos::mdlCargarYears();
        echo json_encode($objRespuesta);
    }
    
}

if (isset($_SESSION["usuario"])) {
    if (isset($_POST["listarSeguimientos"]) == "ok"){
        $objlistaSeguimientos = new DatosControlador();
        $objlistaSeguimientos -> year = $_POST["yearG1"];
        $objlistaSeguimientos->ctrListarSegumientos();
    }
    
    // if(isset($_POST["listarRealizados"])== "ok"){
    //     $objSeguimientosR = new DatosControlador();
    //     $objSeguimientosR->ctrListarRealizados();
    // }
    
    // if(isset($_POST["listarPendientes"])== "ok"){
    //     $objSeguimientosP = new DatosControlador();
    //     $objSeguimientosP->ctrListarPendientes();
    // }
    
    // if(isset($_POST["listarAsignados"])== "ok"){
    //     $objSeguimientosA = new DatosControlador();
    //     $objSeguimientosA->ctrListarAsignados();
    // }
    
    // if(isset($_POST["listarTotal"])== "ok"){
    //     $objSeguimientosT = new DatosControlador();
    //     $objSeguimientosT->ctrListarTotal();
    // }
    // if(isset($_POST["listarVencidos"])== "ok"){
    //     $objSeguimientosV = new DatosControlador();
    //     $objSeguimientosV->ctrListarVencidos();
    // }
    
    if(isset($_POST["listarGrafica"])== "ok"){
        $objSeguimientosG = new DatosControlador();
        $objSeguimientosG -> year = $_POST["yearG2"];
        $objSeguimientosG->ctrListarGrafica();
    }
    
    if(isset($_POST["listarResumenCertificacion"])== "ok"){
        $objCertificacion = new DatosControlador();
        $objCertificacion->ctrListarResumenCertificacion();
    }

    if(isset($_POST["cargarYears"])) {
        $objRespuesta = new DatosControlador();
        $objRespuesta -> ctrCargarYears();
    }
}



