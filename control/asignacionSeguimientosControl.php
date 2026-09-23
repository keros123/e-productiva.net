<?php
session_start();
include_once "../modelo/asignacionSeguimientosModelo.php";

class AsignacionSeguimientosControl{

    public $idvisita_seguimiento;
    public $idSeguimiento;
    public $estado_etapa;
    public $idInstructor;
    public $tipoSeguimiento;
    public $fechaVencimiento;
    public $ubicacion;
    
    public function ctrListarSeguimientosPreAsignacion(){
        $objRespuesta = AsignacionSeguimientosModelo::mdlListarSeguimientosPreAsignacion();
        echo json_encode($objRespuesta);
    }


    public function ctrEliminarPreAsignado(){
        $objRespuesta = AsignacionSeguimientosModelo::mdlEliminarSeguimientosPreAsignado($this->idSeguimiento,$this->estado_etapa,$this->idvisita_seguimiento);
        echo json_encode($objRespuesta);
    }

    public function ctrListarInstructor(){
        $objRespuesta = AsignacionSeguimientosModelo::mdlListarInstructor();
        echo json_encode($objRespuesta);
    }

    public function ctrSeguimientosInstructor(){
        $objRespuesta = AsignacionSeguimientosModelo::mdlSeguimientosInstructor($this->idInstructor);
        echo json_encode($objRespuesta);
    }

    public function ctrListarTipoSeguimiento(){
        $objRespuesta = AsignacionSeguimientosModelo::mdlListarTipoSeguimiento();
        echo json_encode($objRespuesta);
    }


    public function ctrRegistrarSeguimientoAsignado(){
        $objRespuesta = AsignacionSeguimientosModelo::mdlRegistrarSeguimientoAsignado($this->idInstructor,$this->tipoSeguimiento,$this->fechaVencimiento,$this->idSeguimiento, $this->ubicacion);
        echo json_encode($objRespuesta);
    }


}

if (isset($_SESSION["usuario"])) {
    if (isset($_POST["listarPreAsignados"]) == "ok"){
        $objSeguimientos = new AsignacionSeguimientosControl();
        $objSeguimientos->ctrListarSeguimientosPreAsignacion();
    }
    
    if (isset($_POST["eliminarPreAsignado"]) == "ok"){
        $objPreAsignado = new AsignacionSeguimientosControl();
        $objPreAsignado->idvisita_seguimiento = $_POST["seguimientoPreAsignado"];
        $objPreAsignado->idSeguimiento = $_POST["idSeguimiento"];
        $objPreAsignado->estado_etapa = $_POST["estadoEtapa"];
        $objPreAsignado->ctrEliminarPreAsignado();
    }
    
    if (isset($_POST["listarInstructor"]) == "ok"){
        $objInstructor = new AsignacionSeguimientosControl();
        $objInstructor->ctrListarInstructor();
    }
    
    if (isset($_POST["listarSeguimientosInstructor"]) == "ok"){
        $objSeguimientosInstructor = new AsignacionSeguimientosControl();
        $objSeguimientosInstructor->idInstructor = $_POST["idInstructor"];
        $objSeguimientosInstructor->ctrSeguimientosInstructor();
    }
    
    if (isset($_POST["listarTipoSeguimiento"]) == "ok"){
        $objTipoSeguimiento = new AsignacionSeguimientosControl();
        $objTipoSeguimiento->ctrListarTipoSeguimiento();
    }
    
    if (isset($_POST["RegistrarSeguimientoPractica"]) == "ok"){
        $objRegistroSeguimiento = new AsignacionSeguimientosControl();
        $objRegistroSeguimiento->idInstructor = $_POST["instructor"];
        $objRegistroSeguimiento->tipoSeguimiento = $_POST["tipoSeguimiento"];
        $objRegistroSeguimiento->fechaVencimiento = $_POST["fechaVencimiento"];
        $objRegistroSeguimiento->idSeguimiento = $_POST["idSeguimiento"];
        $objRegistroSeguimiento->ubicacion = $_POST["ubicacion_seguimiento"];
        $objRegistroSeguimiento->ctrRegistrarSeguimientoAsignado();
    }
}