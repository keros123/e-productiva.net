<?php 

include_once "../modelo/rUsuarioModelo.php";

class rUsuarioControl {

    public $codVerificacion;
    public $email;
    public $nuevaContraseña;
    public $documento;
    public $tipoRecuperacion;

    public function ctrEmailRecuperacion () {
        $objRespuesta = rUsuarioModelo::mdlEmailRecuperacion($this->email,$this->documento,$this->tipoRecuperacion);
        echo json_encode($objRespuesta);
    }

    public function ctrActualizarContraseña () {
        $objRespuesta = rUsuarioModelo::mdlActualizarContraseña($this->codVerificacion,$this->nuevaContraseña,$this->tipoRecuperacion);
        echo json_encode($objRespuesta);
    }

    public function ctrEmailRecuperacionAprendiz () {
        $objRespuesta = rUsuarioModelo::mdlEmailRecuperacion($this->email,$this->documento,$this->tipoRecuperacion);
        echo json_encode($objRespuesta);
    }
}

if (isset($_POST["emailRecuperacion"],$_POST["tipoRecuperacion"])) {
    $objRecuperacion = new rUsuarioControl ();
    $objRecuperacion -> email = $_POST["emailRecuperacion"];
    $objRecuperacion -> documento = "no aplica";
    $objRecuperacion -> tipoRecuperacion = $_POST["tipoRecuperacion"];
    $objRecuperacion -> ctrEmailRecuperacion ();
}

if (isset($_POST["codVerificacion"],$_POST["confirmarPassword"],$_POST["tipoCambio"])) {
    $objRecuperacion = new rUsuarioControl ();
    $objRecuperacion -> codVerificacion = $_POST["codVerificacion"];
    $objRecuperacion -> nuevaContraseña = $_POST["confirmarPassword"];
    $objRecuperacion -> tipoRecuperacion = $_POST["tipoCambio"];
    $objRecuperacion -> ctrActualizarContraseña ();
}

if (isset($_POST["codVerificacion_aprendiz"],$_POST["confirmarPassword_aprendiz"],$_POST["tipoCambio_aprendiz"])) {
    $objRecuperacion = new rUsuarioControl ();
    $objRecuperacion -> codVerificacion = $_POST["codVerificacion_aprendiz"];
    $objRecuperacion -> nuevaContraseña = $_POST["confirmarPassword_aprendiz"];
    $objRecuperacion -> tipoRecuperacion = $_POST["tipoCambio_aprendiz"];
    $objRecuperacion -> ctrActualizarContraseña ();
}

if (isset($_POST["emailRecuperacion_aprendiz"],$_POST["tipoRecuperacion_aprendiz"])) {
    $objRecuperacion = new rUsuarioControl ();
    $objRecuperacion -> email = $_POST["emailRecuperacion_aprendiz"];
    $objRecuperacion -> documento = $_POST["documento_aprendiz"];
    $objRecuperacion -> tipoRecuperacion = $_POST["tipoRecuperacion_aprendiz"];
    $objRecuperacion -> ctrEmailRecuperacionAprendiz ();
}