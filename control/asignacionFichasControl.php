<?php

    session_start();
    include_once "../modelo/asignacionFichasModelo.php";

    class asignacionFichasControl {
        
        public $idFuncionario;
        public $idFicha;
        public $fichaCompleta;
        public $instructor;

        public function ctrListarFichasAsignadas () {
            $objRespuesta = asignacionFichasModelo::mdlListarFichasAsignadas($this->idFuncionario);
            echo json_encode($objRespuesta);
        }

        public function ctrListarFichas () {
            $objRespuesta = asignacionFichasModelo::mdlListarFichas();
            echo json_encode($objRespuesta);
        }

        public function ctrAsignarFicha () {
            $objRespuesta = asignacionFichasModelo::mdlAsignarFicha($this->idFuncionario, $this->idFicha, $this->fichaCompleta, $this->instructor);
            echo json_encode($objRespuesta);
        }

        public function ctrDesasignarFicha () {
            $objRespuesta = asignacionFichasModelo::mdlDesasignarFicha($this->idFuncionario, $this->idFicha, $this->fichaCompleta, $this->instructor);
            echo json_encode($objRespuesta);
        }
    }

    if (isset($_SESSION["usuario"])) {
        if (isset($_POST["idfuncionarioListar"])) {
            $objAsignar = new asignacionFichasControl ();
            $objAsignar -> idFuncionario = $_POST["idfuncionarioListar"];
            $objAsignar -> ctrListarFichasAsignadas ();
        }
    
        if (isset($_POST["cargartablaFichasAsignadas"])) {
            $objAsignar = new asignacionFichasControl ();
            $objAsignar -> ctrListarFichas ();
        }
    
        if (isset($_POST["idFuncionarioAsignarFicha"],$_POST["idficha"],$_POST["fichaCompleta"],$_POST["instructor"])) {
            $objAsignar = new asignacionFichasControl ();
            $objAsignar -> idFuncionario = $_POST["idFuncionarioAsignarFicha"];
            $objAsignar -> idFicha = $_POST["idficha"];
            $objAsignar -> fichaCompleta = $_POST["fichaCompleta"];
            $objAsignar -> instructor = $_POST["instructor"];
            $objAsignar -> ctrAsignarFicha ();
        }
    
        if (isset($_POST["idFuncionarioDesasignar"],$_POST["idfichaDesasignar"],$_POST["fichaCompletaDes"],$_POST["instructorDes"])) {
            $objAsignar = new asignacionFichasControl ();
            $objAsignar -> idFuncionario = $_POST["idFuncionarioDesasignar"];
            $objAsignar -> idFicha = $_POST["idfichaDesasignar"];
            $objAsignar -> fichaCompleta = $_POST["fichaCompletaDes"];
            $objAsignar -> instructor = $_POST["instructorDes"];
            $objAsignar -> ctrDesasignarFicha ();
        }
    }