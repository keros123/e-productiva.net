<?php
session_start();
include_once "../modelo/archivoAprendizModelo.php";

class ArchivosAprendizControl {
    public $archivo;
    public $usuarioId;

    public function ctrSubirArchivo() {
        $objRespuesta = ArchivoAprendizModelo::mdlSubirArchivos($this->archivo, $this->usuarioId);
        echo json_encode($objRespuesta);
    }

    public function ctrObtenerArchivo() {
        $objRespuesta = ArchivoAprendizModelo::mdlObtenerArchivoPorUsuario($this->usuarioId);
        echo json_encode($objRespuesta);
    }
}

if (isset($_SESSION["id"]) || isset($_SESSION["usuario"])) {

    if (isset($_GET["descargarArchivo"]) && $_GET["descargarArchivo"] === "ok") {
        $usuarioId = $_GET["usuarioId"] ?? null;

        if (!$usuarioId) {
            http_response_code(400);
            echo "ID de usuario requerido";
            exit;
        }
        ArchivoAprendizModelo::mdlDescargarArchivo($usuarioId);

    }

    if (isset($_POST["subirArchivo"]) && $_POST["subirArchivo"] === "ok") {
        $objArchivos = new ArchivosAprendizControl();
        $objArchivos->archivo   = $_FILES["archivo"] ?? null;
        $objArchivos->usuarioId = $_POST["usuarioId"] ?? null;
        if (!$objArchivos->usuarioId) {echo json_encode(array("codigo" => "401", "mensaje" => "ID de usuario requerido"));exit;}
        $objArchivos->ctrSubirArchivo();
    }

    if (isset($_POST["obtenerArchivo"]) && $_POST["obtenerArchivo"] === "ok") {
        $objArchivos = new ArchivosAprendizControl();
        $objArchivos->usuarioId = $_POST["usuarioId"] ?? null;
        if (!$objArchivos->usuarioId) { echo json_encode(array("codigo" => "401", "mensaje" => "ID de usuario requerido"));exit;}
        $objArchivos->ctrObtenerArchivo();
    }

} else {
    echo json_encode(array("codigo" => "403", "mensaje" => "Sesión no válida"));
}
