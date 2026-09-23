<?php

session_start();
include_once "../modelo/seguimientosPorTipoModelo.php";

class seguimientosPorTipoControl
{
    public $tipo;
    public $estado;
    public $id;
    public $novedad;
    public $creador;
    public $emailNovedad;
    public $ubicacion;
    public $idseguimiento;
    public $idAprendiz;
    public $idInstructor;
    public $fechaVencimiento;
    public $url_archivo;

    public function ctrListarSeguimientosPorTipo()
    {
        $objRespuesta = seguimientosPorTipoModelo::mdlListarSeguimientosPorTipo($this->tipo, $this->estado);
        echo json_encode($objRespuesta);
    }

    public function ctrListarDetallesSeguimiento()
    {
        $objRespuesta = seguimientosPorTipoModelo::mdlListarDetallesSeguimiento($this->id);
        echo json_encode($objRespuesta);
    }

    public function ctrCrearNovedad()
    {
        $objRespuesta = seguimientosPorTipoModelo::mdlCrearNovedad($this->id,$this->novedad,$this->creador,$this->emailNovedad);
        echo json_encode($objRespuesta);
    }

    public function ctrCambiarEstadoReporte()
    {
        $objRespuesta = seguimientosPorTipoModelo::mdlCambiarEstadoReporte($this->id,$this->estado);
        echo json_encode($objRespuesta);
    }


    public function ctrCambiarTipoSeguimiento(){
        $objRespuesta = seguimientosPorTipoModelo::mdlCambiarTipoSeguimiento($this->id,$this->tipo,$this->ubicacion);
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarVisitaSeguimiento(){
        $objRespuesta = seguimientosPorTipoModelo::mdlEliminarVisitaSeguimiento($this->id,$this->tipo,$this->idseguimiento,$this->idAprendiz,$this->url_archivo);
        echo json_encode($objRespuesta);
    }

    public function ctrReasignarInstructor(){
        $objRespuesta = seguimientosPorTipoModelo::mdlReasignarInstructor($this->id,$this->idInstructor,$this->fechaVencimiento);
        echo json_encode($objRespuesta);
    }
}

if (isset($_SESSION["usuario"])) {
    if (isset($_POST["tipoSeguimiento"], $_POST["estado"])) {
        $objRespuesta = new seguimientosPorTipoControl();
        $objRespuesta->estado = $_POST["estado"];
        $objRespuesta->tipo = $_POST["tipoSeguimiento"];
        $objRespuesta->ctrListarSeguimientosPorTipo();
    }

    if (isset($_POST["idSeguimiento"])) {
        $objRespuesta = new seguimientosPorTipoControl();
        $objRespuesta->id = $_POST["idSeguimiento"];
        $objRespuesta->ctrListarDetallesSeguimiento();
    }

    if (isset($_POST["novedad"],$_POST["idVisita"],$_POST["creador"],$_POST["emailNovedad"])) {
        $objRespuesta = new seguimientosPorTipoControl();
        $objRespuesta->id = $_POST["idVisita"];
        $objRespuesta->novedad = $_POST["novedad"];
        $objRespuesta->creador = $_POST["creador"];
        $objRespuesta->emailNovedad = $_POST["emailNovedad"];
        $objRespuesta->ctrCrearNovedad();
    }

    if (isset($_POST["estadoReporte"],$_POST["idVisitaReporte"])) {
        $objRespuesta = new seguimientosPorTipoControl();
        $objRespuesta->id = $_POST["idVisitaReporte"];
        $objRespuesta->estado = $_POST["estadoReporte"];
        $objRespuesta->ctrCambiarEstadoReporte();
    }

    if (isset($_POST["cambiarTipoSeguimiento"]) == "ok"){
        $objRespuesta = new seguimientosPorTipoControl();
        $objRespuesta->id = $_POST["idVisitaSeguimiento"];
        $objRespuesta->tipo = $_POST["idTipoSeguimiento"];
        $objRespuesta->ubicacion = $_POST["ubicacion"];
        $objRespuesta->ctrCambiarTipoSeguimiento();
    } 

    if (isset($_POST["eliminarSeguimiento"]) == "ok"){
        $objRespuesta = new seguimientosPorTipoControl();
        $objRespuesta->id = $_POST["visita_seguimiento"];
        $objRespuesta->tipo = $_POST["tipoSeguimiento"];
        $objRespuesta->idseguimiento = $_POST["seguimiento"];
        $objRespuesta->idAprendiz = $_POST["aprendiz"];
        $objRespuesta->url_archivo = $_POST["url_archivo"];
        $objRespuesta->ctrEliminarVisitaSeguimiento();
    }


    if (isset($_POST["reasignarInstructor"]) == "ok"){
        $objRespuesta = new seguimientosPorTipoControl();
        $objRespuesta->id = $_POST["visitaSeguimiento"];
        $objRespuesta->idInstructor = $_POST["funcionario"];
        $objRespuesta->fechaVencimiento = $_POST["fechaVencimiento"];
        $objRespuesta->ctrReasignarInstructor();
    }

}
