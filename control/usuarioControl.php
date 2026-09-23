<?php
session_start();

include_once "../modelo/usuarioModelo.php";

class usuarioControl{
    public $usuario;
    public $password;
    public $tipoDocumento;
    public $documento;
    public $ficha;
    public $id;
    public $ingreso;

    public function ctrAutenticarAprendiz(){
        $objRespuesta = usuarioModelo::mdlAutenticarAprendiz($this->tipoDocumento,$this->documento,$this->ficha,$this->password);
        echo json_encode($objRespuesta);
    }

    public function ctrAutenticarFuncionario(){
        $objRespuesta = usuarioModelo::mdlAutenticarFuncionario($this->usuario,$this->password);
        echo json_encode($objRespuesta);
    }

    public function ctrCargarSelectDocumento(){
        $objRespuesta = usuarioModelo::mdlCargarSelectDocumento();
        echo json_encode($objRespuesta);
    }


    public function ctrCargarSelectTipoFuncionario(){
        $objRespuesta = usuarioModelo::mdlcargarSelectTipoFuncionario();
        echo json_encode($objRespuesta);
    }

    public function ctrCargarSelectEstadoAprendiz(){
        $objRespuesta = usuarioModelo::mdlcargarSelectEstadoAprendiz();
        echo json_encode($objRespuesta);
    }

    public function ctrActualizarContrasenaPrimerInicioUsuario () {
        $objRespuesta = usuarioModelo::mdlActualizarContraseñaPrimerInicioUsuario ($this->usuario, $this->password, $this->id);
        echo json_encode($objRespuesta);
    }


    public function ctrIngresoFuncionarioMasivo(){
        $objRespuesta = usuarioModelo::mdlIngresoMasivo($this->ingreso);
        echo json_encode($objRespuesta);
    }
}

if (isset($_POST["tipoDocumentoAprendiz"],$_POST["documentoAprendiz"],$_POST["fichaAprendiz"],$_POST["passwordAprendiz"])){
    $objUsuario = new usuarioControl();
    $objUsuario->tipoDocumento = $_POST["tipoDocumentoAprendiz"];
    $objUsuario->documento = $_POST["documentoAprendiz"];
    $objUsuario->ficha = $_POST["fichaAprendiz"];
    $objUsuario->password = $_POST["passwordAprendiz"];
    $objUsuario->ctrAutenticarAprendiz();
}

if (isset($_POST["usuarioFuncionario"],$_POST["passwordFuncionario"])){
    $objUsuario = new usuarioControl();
    $objUsuario->usuario = $_POST["usuarioFuncionario"];
    $objUsuario->password = $_POST["passwordFuncionario"];
    $objUsuario->ctrAutenticarFuncionario();
}

if (isset($_POST["cargarSelectDocumento"]) || isset($_POST["selectAccountDocumento"])){
    $objUsuario = new usuarioControl();
    $objUsuario->ctrCargarSelectDocumento();
}

if (isset($_SESSION["usuario"])) {
    if (isset($_POST["cargarSelectTipoFuncionario"])){
        $objUsuario = new usuarioControl();
        $objUsuario->ctrCargarSelectTipoFuncionario();
    }

    if (isset($_POST["cargarSelectEstadoAprendiz"])){
        $objUsuario = new usuarioControl();
        $objUsuario->ctrCargarSelectEstadoAprendiz();
    }

    if (isset($_POST["passwordPrimerInicio"],$_POST["idUsuarioPrimerInicio"],$_POST["tipoUsuarioPrimerInicio"])){
        $objUsuario = new usuarioControl();
        $objUsuario-> usuario = $_POST["tipoUsuarioPrimerInicio"];
        $objUsuario-> id = $_POST["idUsuarioPrimerInicio"];
        $objUsuario-> password = $_POST["passwordPrimerInicio"];
        $objUsuario->ctrActualizarContrasenaPrimerInicioUsuario();
    }


    if (isset($_POST["cambiarIngresoMasivo"]) == "ok"){
        $objIngreso = new usuarioControl();
        $objIngreso->ingreso = $_POST["estadoIngreso"];
        $objIngreso->ctrIngresoFuncionarioMasivo();
    }
}
