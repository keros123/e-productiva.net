<?php

// Captura cualquier salida accidental (warnings, notices) para no corromper el JSON
ob_start();

// Control de errores global para depuración en hosting
set_exception_handler(function ($exception) {
    if (ob_get_length()) {
        ob_end_clean();
    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        "codigo" => "500",
        "mensaje" => "Excepcion no manejada: " . $exception->getMessage(),
        "archivo" => $exception->getFile(),
        "linea" => $exception->getLine()
    ]);
    exit;
});

set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
        return false;
    }
    if (ob_get_length()) {
        ob_end_clean();
    }
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        "codigo" => "500",
        "mensaje" => "Error de PHP ($errno): $errstr",
        "archivo" => $errfile,
        "linea" => $errline
    ]);
    exit;
});

register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== null && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        if (ob_get_length()) {
            ob_end_clean();
        }
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode([
            "codigo" => "500",
            "mensaje" => "Error Fatal de PHP: " . $error['message'],
            "archivo" => $error['file'],
            "linea" => $error['line']
        ]);
        exit;
    }
});

session_start();
include_once "../modelo/seguimientoModelo.php";


class SeguimientoControl{
    public $idSeguimiento;
    public $fechaInicioPractica;
    public $fechaFinalPractica;
    public $modalidad;
    public $aprendiz;
    public $empresa;
    public $datosSeguimiento;
    public $documentoAlternativaPractica;
    public $observacion_seguimiento;
    public $estadoEtapaPractica;
    public $idInstructor;

    public function ctrListarModalidades(){
        $objRespuesta = SeguimientoModelo::mdlListarModalidades();
        ob_end_clean();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($objRespuesta);
        exit;
    }

    public function ctrListarEtapaPractica(){
        $objRespuesta = SeguimientoModelo::mdlListarEtapaPractica();
        ob_end_clean();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($objRespuesta);
        exit;
    }

    public function ctrRegistrarEtapaPractica(){
        $objRespuesta = SeguimientoModelo::mdlRegistrarEtapaPractica($this->fechaInicioPractica,$this->fechaFinalPractica,$this->modalidad,$this->aprendiz,$this->empresa,$this->datosSeguimiento,$this->documentoAlternativaPractica,$this->idInstructor);
        ob_end_clean();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($objRespuesta);
        exit;
    }

    public function ctrEliminarEtapaPractica(){
        $objRespuesta = SeguimientoModelo::mdlEliminarEtapaPractica($this->idSeguimiento,$this->aprendiz,$this->datosSeguimiento, $this->modalidad);
        ob_end_clean();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($objRespuesta);
        exit;
    }

    public function ctrEditarEtapaPractica(){
        $objRespuesta = SeguimientoModelo::mdlEditarEtapaPractica($this->idSeguimiento,$this->fechaInicioPractica,$this->fechaFinalPractica,$this->modalidad,$this->empresa, $this->estadoEtapaPractica,$this->observacion_seguimiento,$this->documentoAlternativaPractica);
        ob_end_clean();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($objRespuesta);
        exit;
    }

    public function ctrListarInstructores(){
        $objRespuesta = SeguimientoModelo::mdlListarInstructores();
        ob_end_clean();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($objRespuesta);
        exit;
    }
}

// Si no hay sesión activa, devolver JSON de error en lugar de respuesta vacía
if (!isset($_SESSION["usuario"])) {
    ob_end_clean();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(["codigo" => "401", "mensaje" => "Sesión no iniciada o expirada. Por favor inicie sesión nuevamente."]);
    exit;
}

// Usamos isset() correctamente: devuelve bool, no se compara con string
if (isset($_POST["listarModalidades"])) {
    $objModalidad = new SeguimientoControl();
    $objModalidad->ctrListarModalidades();
}

if (isset($_POST["listarEtapaPractica"])) {
    $objEtapaPractica = new SeguimientoControl();
    $objEtapaPractica->ctrListarEtapaPractica();
}

if (isset($_POST["registrarEtapaPractica"])) {
    $objEtapaPractica = new SeguimientoControl();
    $objEtapaPractica->fechaInicioPractica = $_POST["fechaInicioPractica"];
    $objEtapaPractica->fechaFinalPractica = $_POST["fechaFinPractica"];
    $objEtapaPractica->modalidad = $_POST["modalidad"];
    $objEtapaPractica->aprendiz = $_POST["aprendiz"];
    $objEtapaPractica->empresa = $_POST["empresa"];
    $objEtapaPractica->idInstructor = $_POST["instructor"];
    $objEtapaPractica->datosSeguimiento = ["ficha"=>$_POST["fichaValor"],"aprendiz"=>$_POST["aprendizValor"],"empresa"=>$_POST["empresaValor"], "email"=>$_POST["emailValor"]];
    if ($_POST["modalidad"] == 1) {
        $objEtapaPractica->documentoAlternativaPractica = $_POST["documentoAlternativa"];
    } else {
        $objEtapaPractica->documentoAlternativaPractica = $_FILES["documentoAlternativa"];
    }
    $objEtapaPractica->ctrRegistrarEtapaPractica();
}

if (isset($_POST["eliminarEtapaPractica"])) {
    $objEtapaPractica = new SeguimientoControl();
    $objEtapaPractica->idSeguimiento = $_POST["idseguimiento"];
    $objEtapaPractica->aprendiz = $_POST["idaprendiz"];
    $objEtapaPractica->datosSeguimiento = $_POST["detallesEtapaPractica"];
    $objEtapaPractica->modalidad = $_POST["modalidad"];
    $objEtapaPractica->ctrEliminarEtapaPractica();
}

if (isset($_POST["editarEtapaPractica"])) {
    $objEtapaPractica = new SeguimientoControl();
    $objEtapaPractica->idSeguimiento = $_POST["idSeguimiento"];
    $objEtapaPractica->fechaInicioPractica = $_POST["fechaInicioPractica"];
    $objEtapaPractica->fechaFinalPractica = $_POST["fechaFinPractica"];
    $objEtapaPractica->modalidad = $_POST["modalidad"];
    $objEtapaPractica->empresa = $_POST["empresa"];
    $objEtapaPractica->estadoEtapaPractica = $_POST["estadoEtapaPractica"];
    $objEtapaPractica->observacion_seguimiento = $_POST["observacion_seguimiento"];
    $docPost = isset($_POST["documentoAlternativa"]) ? $_POST["documentoAlternativa"] : null;
    if ($_POST["modalidad"] == 1 || $docPost == "no aplica" || !isset($_FILES["documentoAlternativa"]) || $_FILES["documentoAlternativa"]["error"] != 0) {
        $objEtapaPractica->documentoAlternativaPractica = "no aplica";
    } else {
        $objEtapaPractica->documentoAlternativaPractica = $_FILES["documentoAlternativa"];
    }
    $objEtapaPractica->ctrEditarEtapaPractica();
}

if (isset($_POST["listarInstructores"])) {
    $objInstructores = new SeguimientoControl();
    $objInstructores->ctrListarInstructores();
}

// Catch-all: si ninguna accion fue ejecutada, devolver diagnostico
// Esto nunca deberia ocurrir en condiciones normales
$postKeys = array_keys($_POST);
if (ob_get_length() === 0 || ob_get_contents() === '') {
    ob_end_clean();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode([
        "codigo"  => "400",
        "mensaje" => "Ninguna accion coincidio. Claves POST recibidas: [" . implode(', ', $postKeys) . "]"
    ]);
}