<?php
    session_start();
    include_once "../modelo/certificarAprendizModelo.php";

    class certificarAprendizControl {
        public $id;

        public function ctrCertificarAprendiz () {
            $objRespuesta = certificarAprendizModelo::mdlCertificarAprendiz($this->id);
            echo json_encode($objRespuesta);
        }

        public function ctrSeguimientosAprendizCertificacion () {
            $objRespuesta = certificarAprendizModelo::mdlSeguimientosAprendizCertificacion($this->id);
            echo json_encode($objRespuesta);
        }
        
    }

    if (isset($_SESSION["usuario"])) {
        if (isset($_POST["idAprendiz"])) {
            $objcertificar = new certificarAprendizControl();
            $objcertificar -> id = $_POST["idAprendiz"];
            $objcertificar -> ctrCertificarAprendiz();
        }

        if (isset($_POST["idAprendizSeguimientos"])) {
            $objSeguimientos = new certificarAprendizControl();
            $objSeguimientos -> id = $_POST["idAprendizSeguimientos"];
            $objSeguimientos -> ctrSeguimientosAprendizCertificacion();
        }
    }