<?php

    session_start();
    include_once "../modelo/modeloSeguimientosAsignados.php";

    class controlSeguimientosAsignados {
        public $id;
        public $tipoUsuario;
        public $aprendiz;
        public $ficha;
        public $archivo;
        public $rutaActual;
        public $imagenJuicioEvaluativo;
        public $rutaJuicio;

        public function ctrCargarSeguimientosAsignados () {
            $objRespuesta = modeloSeguimientosAsignados::mdlCargarSeguimientosAsignados($this->id);
            echo json_encode($objRespuesta);
        }

        public function ctrSubirReporteSeguimiento () {
            $objRespuesta = modeloSeguimientosAsignados::mdlSubirReporteSeguimiento($this->tipoUsuario,$this->aprendiz,$this->id,$this->ficha,$this->archivo,$this->rutaActual,$this->imagenJuicioEvaluativo,$this->rutaJuicio);
            echo json_encode($objRespuesta);
        }
    }

    if (isset($_SESSION["usuario"])) {
        if (isset($_POST["seguimientosAsignados"])) {
            $objRespuesta = new controlSeguimientosAsignados ();
            $objRespuesta -> id = $_SESSION["id"];
            $objRespuesta -> ctrCargarSeguimientosAsignados ();
        }
    
        if (isset($_POST["tipoUsuario"],$_POST["aprendiz"],$_POST["idVisita"],$_POST["ficha"],$_FILES["archivo"])) {
            $objRespuesta = new controlSeguimientosAsignados ();
            $objRespuesta -> tipoUsuario = $_POST["tipoUsuario"];
            $objRespuesta -> aprendiz = $_POST["aprendiz"];
            $objRespuesta -> id = $_POST["idVisita"];
            $objRespuesta -> ficha = $_POST["ficha"];
            $objRespuesta -> archivo = $_FILES["archivo"];
            $objRespuesta -> rutaActual = $_POST["rutaActual"];
            $objRespuesta->imagenJuicioEvaluativo = ($_FILES['imagenJuicioEvaluativo']['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK ? $_FILES['imagenJuicioEvaluativo'] : null;
            $objRespuesta -> rutaJuicio = $_POST["rutaJuicio"];
            $objRespuesta -> ctrSubirReporteSeguimiento();
        }
    }