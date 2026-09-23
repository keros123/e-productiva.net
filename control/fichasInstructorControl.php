<?php
    
    session_start();
    include_once "../modelo/fichasInstructorModelo.php";

    class fichasInstructorControl {
        
        public $id;
        public $avalPatrocinio;
        public $fichaCompleta;
        public $nombreCompleto;


        public function ctrListarFichasAsignadas () {
            $objRespuesta = fichasInstructorModelo::mdlListarFichasAsignadas ($this->id);
            echo json_encode($objRespuesta);
        }

        public function ctrListarAprendicesAsignados () {
            $objRespuesta = fichasInstructorModelo::mdlListarAprendicesAsignados ($this->id);
            echo json_encode($objRespuesta);
        }

        public function ctrActualizarAvalPatrocinio () {
            $objRespuesta = fichasInstructorModelo::mdlActualizarAvalPatrocinio ($this->id, $this->avalPatrocinio,$this->nombreCompleto, $this->fichaCompleta);
            echo json_encode($objRespuesta);
        }
    }

    if (isset($_SESSION["usuario"])) {
        if (isset($_POST["idInstructor"])) {
            $objFichasInstructor = new fichasInstructorControl ();
            $objFichasInstructor -> id = $_POST["idInstructor"];
            $objFichasInstructor -> ctrListarFichasAsignadas ();
        }
    
        if (isset($_POST["idFicha"])) {
            $objFichasInstructor = new fichasInstructorControl ();
            $objFichasInstructor -> id = $_POST["idFicha"];
            $objFichasInstructor -> ctrListarAprendicesAsignados ();
        }
    
        if (isset($_POST["avalAprendiz"],$_POST["idAprendiz"],$_POST["fichaCompleta"],$_POST["nombreCompleto"])) {
            $objFichasInstructor = new fichasInstructorControl ();
            $objFichasInstructor -> id = $_POST["idAprendiz"];
            $objFichasInstructor -> avalPatrocinio = $_POST["avalAprendiz"];
            $objFichasInstructor -> fichaCompleta = $_POST["fichaCompleta"];
            $objFichasInstructor -> nombreCompleto = $_POST["nombreCompleto"];
            $objFichasInstructor -> ctrActualizarAvalPatrocinio ();
        }
    }