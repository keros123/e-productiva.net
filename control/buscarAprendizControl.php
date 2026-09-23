<?php
    session_start();
    include_once "../modelo/buscarAprendizModelo.php";

    class buscarAprendizControl{
        public $documento;
        public function ctrBuscarPorDocumento () {
            $objRespuesta = buscarAprendizModelo::mdlBuscarPorDocumento($this->documento);
            echo json_encode($objRespuesta);
        }
    }

    if (isset($_SESSION["usuario"])) {
        if (isset($_POST["BuscarAprendiz"])) {
            $objControl = new buscarAprendizControl();
            $objControl -> documento = $_POST["documento"];
            $objControl -> ctrBuscarPorDocumento();
        }
    }