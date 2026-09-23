<?php
    session_start();
    include_once "../modelo/enviarSeguimientosModelo.php";

    class enviarSeguimientosControl {
        public $objSeguimiento;
        public $notificado;
        public $instructor;

        public function ctrEnviarSeguimientosAprendiz() {
            $objRespusta = enviarSeguimientosModelo::mdlEnviarSeguimientosAprendiz($this->objSeguimiento,$this->notificado,$this->instructor);
            echo json_encode($objRespusta);
        }

        public function ctrEnviarSeguimientosEmailInstructor() {
            $objRespusta = enviarSeguimientosModelo::mdlCorreoInstructor($this->objSeguimiento);
            echo json_encode($objRespusta);
        }
    }
    
    if (isset($_SESSION["usuario"])) {
        if (isset($_POST["objDatosCorreoAprendiz"],$_POST["notificado"])) {
            $objRespusta = new enviarSeguimientosControl();
            $objRespusta -> objSeguimiento = json_decode($_POST["objDatosCorreoAprendiz"], true);
            $objRespusta -> notificado = $_POST["notificado"];
            $objRespusta -> instructor = $_POST["instructor"];
            $objRespusta -> ctrEnviarSeguimientosAprendiz();
        }
    
        if (isset($_POST["objDatosCorreoInstructor"])) {
            $objRespusta = new enviarSeguimientosControl();
            $objRespusta -> objSeguimiento = json_decode($_POST["objDatosCorreoInstructor"], true);
            $objRespusta -> ctrEnviarSeguimientosEmailInstructor();
        }
    }