<?php

session_start();
include_once "../modelo/aprendizModelo.php";

class aprendizControl {

    public $idAprendiz;
    public $ficha;
    public $tipoDoc;
    public $documento;
    public $nombres;
    public $apellidos;
    public $telefono;
    public $email;
    public $estado;
    public $passwordAprendiz;
    public $fichaCompleta;
    public $nombreCompleto;
    public $registrados;
    public $novedad;

    public function ctrIngresarAprendiz(){
        $objRespuesta = aprendizModelo::mdlIngresarAprendiz($this->ficha,$this->tipoDoc,$this->documento,$this->nombres,$this->apellidos,$this->telefono,$this->email,$this->estado,$this->passwordAprendiz,$this->fichaCompleta);
        echo json_encode($objRespuesta);
    }

    public function ctrCargarTablaAprendices(){
        $objRespuesta = aprendizModelo::mdlCargarTablaAprendices();
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarAprendiz () {
        $objRespuesta = aprendizModelo::mdlEliminarAprendiz($this->idAprendiz,$this->fichaCompleta,$this->nombreCompleto);
        echo json_encode ($objRespuesta);
    }

    public function ctrEditarAprendiz(){
        $objRespuesta = aprendizModelo::mdlEditarAprendiz($this->ficha,$this->tipoDoc,$this->documento,$this->nombres,$this->apellidos,$this->telefono,$this->email,$this->estado,$this->idAprendiz,$this->fichaCompleta,$this->nombreCompleto,$this->novedad);
        echo json_encode($objRespuesta);
    }

    // Agregar un método específico para agregar novedades
    public function ctrAgregarNovedad(){
        $objRespuesta = aprendizModelo::mdlEditarAprendiz($this->ficha,$this->tipoDoc,$this->documento,$this->nombres,$this->apellidos,$this->telefono,$this->email,$this->estado,$this->idAprendiz,$this->fichaCompleta,$this->nombreCompleto,$this->novedad);
        echo json_encode($objRespuesta);
    }

    public function ctrTotalRegistroMasivo(){
        $objRespuesta = aprendizModelo::mdlTotalRegistroMasivo($this->registrados, $this->ficha);
        echo json_encode($objRespuesta);
    }

    public function ctrAprendizCancelado () {
        $objRespuesta = aprendizModelo::mdlAprendizCancelado($this->documento, $this->idAprendiz, $this->ficha);
        echo json_encode($objRespuesta);
    }
}

if (isset($_SESSION["usuario"])) {
    if (isset($_POST["fichaAprendiz"],$_POST["tipoDocAprendiz"],$_POST["documentoAprendiz"],$_POST["nombresAprendiz"],$_POST["apellidosAprendiz"],$_POST["numeroAprendiz"],$_POST["emailAprendiz"],$_POST["estadoAprendiz"], $_POST["passwordAprendiz"], $_POST["fichaCompleta"] )) {
        $objAprendiz = new aprendizControl();
        $objAprendiz->ficha = $_POST["fichaAprendiz"];
        $objAprendiz->fichaCompleta = $_POST["fichaCompleta"];
        $objAprendiz->tipoDoc = $_POST["tipoDocAprendiz"];
        $objAprendiz->documento = $_POST["documentoAprendiz"];
        $objAprendiz->nombres = $_POST["nombresAprendiz"];
        $objAprendiz->apellidos = $_POST["apellidosAprendiz"];
        $objAprendiz->telefono = $_POST["numeroAprendiz"];
        $objAprendiz->email = $_POST["emailAprendiz"];
        $objAprendiz->estado = $_POST["estadoAprendiz"];
        $objAprendiz->passwordAprendiz = $_POST["passwordAprendiz"];
        $objAprendiz->ctrIngresarAprendiz();
    }
    
    if (isset($_POST["cargarTablaAprendices"])) {
        $objAprendiz = new aprendizControl ();
        $objAprendiz -> ctrCargarTablaAprendices ();
    }
    
    if (isset($_POST["idAprendiz"],$_POST["nombreCompletoEliminar"],$_POST["fichaCompletaEliminar"])) {
        $objAprendiz = new aprendizControl ();
        $objAprendiz -> idAprendiz = $_POST["idAprendiz"];
        $objAprendiz -> nombreCompleto = $_POST["nombreCompletoEliminar"];
        $objAprendiz -> fichaCompleta = $_POST["fichaCompletaEliminar"];
        $objAprendiz -> ctrEliminarAprendiz ();
    }
    
    if (isset($_POST["fichaAprendizEdit"],$_POST["tipoDocAprendizEdit"],$_POST["documentoAprendizEdit"],$_POST["nombresAprendizEdit"],$_POST["apellidosAprendizEdit"],$_POST["numeroAprendizEdit"],$_POST["emailAprendizEdit"],$_POST["estadoAprendizEdit"],$_POST["idAprendizEdit"],$_POST["fichaCompletaEdit"],$_POST["nombreCompleto"])) {
        $objAprendiz = new aprendizControl();
        $objAprendiz->ficha = $_POST["fichaAprendizEdit"];
        $objAprendiz->fichaCompleta = $_POST["fichaCompletaEdit"];
        $objAprendiz->nombreCompleto = $_POST["nombreCompleto"];
        $objAprendiz->tipoDoc = $_POST["tipoDocAprendizEdit"];
        $objAprendiz->documento = $_POST["documentoAprendizEdit"];
        $objAprendiz->nombres = $_POST["nombresAprendizEdit"];
        $objAprendiz->apellidos = $_POST["apellidosAprendizEdit"];
        $objAprendiz->telefono = $_POST["numeroAprendizEdit"];
        $objAprendiz->email = $_POST["emailAprendizEdit"];
        $objAprendiz->estado = $_POST["estadoAprendizEdit"];
        $objAprendiz->idAprendiz = $_POST["idAprendizEdit"];
        

        if(isset($_POST["novedad"])) {
            $objAprendiz->novedad = $_POST["novedad"];
        }
        
        $objAprendiz->ctrEditarAprendiz();
    }
    
    
    if (isset($_POST["registrados"])) {
        $objAprendiz = new aprendizControl();
        $objAprendiz -> registrados = $_POST["registrados"];
        $objAprendiz -> ficha = $_POST["ficha"];
        $objAprendiz -> ctrTotalRegistroMasivo();
    }

    if (isset($_POST["cancelarAprendiz"]) == "ok") {
        $objAprendiz = new aprendizControl();
        $objAprendiz->documento = $_POST["documentoAprendizCancelado"];
        $objAprendiz->idAprendiz = $_POST["idAprendizCancelado"];
        $objAprendiz->ficha = $_POST["fichaCancelado"];
        $objAprendiz->ctrAprendizCancelado();
    }
}