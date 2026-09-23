<?php
session_start();
include_once "../modelo/actualizacion_datos_usuarioModelo.php";

class actualizacion_datos_usuarioControl {
    public $nombres = null;
    public $apellidos = null;
    public $tipoDocumento = null;
    public $numeroDocumento = null;
    public $numeroDocumentoAnterior = null;
    public $email = null; 
    public $telefono = null;
    public $municipio = null;
    public $direccion = null;
    public $password = null;
    public $tipoUsuario = null;

    public function ctrActualizarUsuario(){
        $objRespuesta = actualizacion_datos_usuarioModelo::mdlActualizarUsuario($this->nombres,$this->apellidos,$this->tipoDocumento,$this->numeroDocumento,$this->numeroDocumentoAnterior,$this->email,$this->telefono,$this->municipio,$this->direccion,$this->password,$this->tipoUsuario);
        echo json_encode($objRespuesta);
    }
}

if (isset($_SESSION["usuario"])) {
    if (isset($_POST["tipoUsuario"])){
        $objUsuario = new actualizacion_datos_usuarioControl();
        $objUsuario->tipoUsuario = $_POST["tipoUsuario"];
        $objUsuario->nombres = $_POST["nombres"];
        $objUsuario->apellidos = $_POST["apellidos"];
        $objUsuario->tipoDocumento = $_POST["tipoDocumento"];
        $objUsuario->numeroDocumento = $_POST["numeroDocumento"];
        $objUsuario->numeroDocumentoAnterior = $_POST["numeroDocumentoAnterior"];
        $objUsuario->email = $_POST["email"];
        $objUsuario->telefono = $_POST["telefono"];
        if ($_POST["tipoUsuario"] <= 9){
            $objUsuario->municipio = $_POST["municipio"];
            $objUsuario->direccion = $_POST["direccion"];
        }
        $objUsuario->password = $_POST["password"];
        $objUsuario->ctrActualizarUsuario();
    }
}






