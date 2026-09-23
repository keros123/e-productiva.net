<?php

    session_start();
    include_once "../modelo/aprendicesCertificadosModelo.php";

    class aprendicesCertificadosControl {
        public function ctrCargarAprendicesCertificados() {
            $objResspuesta = aprendicesCertificadosModelo::mdlCargarAprendicesCertificados();
            echo json_encode($objResspuesta);
        }
    }

    if (isset($_SESSION["usuario"])) {
        if (isset($_POST["aprendicesCertificadosData"])) {
            $objResspuesta = new aprendicesCertificadosControl();
            $objResspuesta->ctrCargarAprendicesCertificados();
        }
    }