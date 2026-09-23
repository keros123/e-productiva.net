<?php

session_start();
include_once "../modelo/seguimientoAprendizModelo.php";

class seguimientoAprendizControl
{
    public $idAprendiz;
    public $idFuncionario;
    public $idSeguimiento;
    public $idVisitaSeguimiento;
    public $direccionVisitaSeguimiento;

    public function ctrListarSeguimientosAsignados()
    {
        $objRespuesta = seguimientoAprendizModelo::mdlListarSeguimientosAsignados($this->idAprendiz);
        echo json_encode($objRespuesta);
    }

    public function ctrEditarDireccionVisita()
    {
        $objRespuesta = seguimientoAprendizModelo::mdlEditarDireccion($this->idVisitaSeguimiento, $this->direccionVisitaSeguimiento);
        echo json_encode($objRespuesta);
    }
}

if (isset($_SESSION["usuario"])) {
    if (isset($_POST["listarSeguimientosAsignados"])) {
        $objRespuesta = new seguimientoAprendizControl();
        $objRespuesta->idAprendiz = $_SESSION["id"];
        $objRespuesta->ctrListarSeguimientosAsignados();
    }

    if (isset($_POST["editarDireccionVisita"]) == "ok") {
        $objRespuesta = new seguimientoAprendizControl();
        $objRespuesta->idVisitaSeguimiento = $_POST["visita"];
        $objRespuesta->direccionVisitaSeguimiento = $_POST["direccion"];
        $objRespuesta->ctrEditarDireccionVisita();
    }
}
