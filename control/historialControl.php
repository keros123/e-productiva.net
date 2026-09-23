<?php
    session_start();
    include_once "../modelo/historialModelo.php";

    class historialControl {
        public $tipo;

        public function ctrCargarHistorial () {
            $objRespuesta = historialModelo::mdlCargarHistorial($this->tipo);
            echo json_encode($objRespuesta);
        }
    }

    if (isset($_SESSION["usuario"])) {
        if (isset($_POST["tipoHistorial"])) {
            $objRespuesta = new historialControl ();
            $objRespuesta -> tipo = $_POST["tipoHistorial"];
            $objRespuesta -> ctrCargarHistorial();
        }
    }