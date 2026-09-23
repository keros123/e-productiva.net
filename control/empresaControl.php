<?php

session_start();
include_once "../modelo/empresaModelo.php";

class EmpresaControl{
    public $idEmpresa;
    public $nombreEmpresa;
    public $empresaCompleta;
    public $municipio;
    public $telefono;
    public $direccion;
    public $nitEmpresa;

    public function ctrListarEmpresas(){
        $objRespuesta = EmpresaModelo::mdlListarEmpresas();
        echo json_encode($objRespuesta);
    }


    public function ctrRegistrarEmpresa(){
        $objRespuesta = EmpresaModelo::mdlRegistrarEmpresa($this->nombreEmpresa,$this->municipio,$this->direccion,$this->telefono, $this->nitEmpresa);
        echo json_encode($objRespuesta);
    }


    public function ctrEditarEmpresa(){
        $objRespuesta = EmpresaModelo::mdlEditarEmpresa($this->idEmpresa,$this->nombreEmpresa,$this->municipio,$this->direccion,$this->telefono, $this->nitEmpresa);
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarEmpresa(){
        $objRespuesta = EmpresaModelo::mdlEliminarEmpresa($this->idEmpresa,$this->empresaCompleta);
        echo json_encode($objRespuesta);
    }
}


if (isset($_SESSION["usuario"])) {
    if (isset($_POST["listarEmpresas"]) && $_POST["listarEmpresas"] == "ok"){
        $objEmpresa = new EmpresaControl();
        $objEmpresa->ctrListarEmpresas();
    }
    
    if (isset($_POST["registrarEmpresa"]) && $_POST["registrarEmpresa"] == "ok"){
        $objEmpresa = new EmpresaControl();
        $objEmpresa->nombreEmpresa = $_POST["nombreEmpresa"];
        $objEmpresa->municipio = $_POST["municipio"];
        $objEmpresa->direccion = $_POST["direccionEmpresa"];
        $objEmpresa->telefono = $_POST["telefonoEmpresa"];
        $objEmpresa->nitEmpresa = $_POST["nitEmpresa"];
        $objEmpresa->ctrRegistrarEmpresa();
    }
    
    if (isset($_POST["editarEmpresa"]) && $_POST["editarEmpresa"] == "ok"){
        $objEmpresa = new EmpresaControl();
        $objEmpresa->idEmpresa = $_POST["idEmpresa"];
        $objEmpresa->nombreEmpresa = $_POST["nombreEmpresa"];
        $objEmpresa->direccion = $_POST["direccionEmpresa"];
        $objEmpresa->telefono = $_POST["telefonoEmpresa"];
        $objEmpresa->municipio = $_POST["municipio"];
        $objEmpresa->nitEmpresa = $_POST["nitEmpresa"];
        $objEmpresa->ctrEditarEmpresa();
    }
    
    if (isset($_POST["eliminarEmpresa"]) && $_POST["eliminarEmpresa"] == "ok"){
        $objEmpresa = new EmpresaControl();
        $objEmpresa->idEmpresa = $_POST["idEmpresa"];
        $objEmpresa->empresaCompleta = $_POST["empresaCompleta"];
        $objEmpresa->ctrEliminarEmpresa();
    }
}

