<?php
    session_start();
    include_once "../modelo/linea_red_TecnologicaModelo.php";

    class lineaRedTecnologicaControl {
        public $nombre;
        public $nombreLinea;
        public $nombreRed;
        public $idRed;
        public $idLinea;

        public function ctrAgregarLineaTecnologica () {
            $objRespuesta = lineaRedTecnologicaModelo::mdlAgregarLineaTecnologica($this->nombre);
            echo json_encode($objRespuesta);
        }
        public function ctrEditarLineaTecnologica () {
            $objRespuesta = lineaRedTecnologicaModelo::mdlEditarLineaTecnologica($this->nombre,$this->idLinea,$this->nombreLinea);
            echo json_encode($objRespuesta);
        }
        public function ctrEliminarLineaTecnologica () {
            $objRespuesta = lineaRedTecnologicaModelo::mdlEliminarLineaTecnologica($this->idLinea,$this->nombreLinea);
            echo json_encode($objRespuesta);
        }
        public function ctrlistarLineaTecnologica () {
            $objRespuesta = lineaRedTecnologicaModelo::mdllistarLineaTecnologica();
            echo json_encode($objRespuesta);
        }

        public function ctrlistarRedTecnologica () {
            $objRespuesta = lineaRedTecnologicaModelo::mdllistarRedTecnologica($this->idLinea);
            echo json_encode($objRespuesta);
        }
        public function ctrAgregarRedTecnologica () {
            $objRespuesta = lineaRedTecnologicaModelo::mdlAgregarRedTecnologica($this->nombre,$this->idLinea,$this->nombreLinea);
            echo json_encode($objRespuesta);
        }
        public function ctrEditarRedTecnologica () {
            $objRespuesta = lineaRedTecnologicaModelo::mdlEditarRedTecnologica($this->nombre,$this->idRed,$this->idLinea,$this->nombreLinea,$this->nombreRed);
            echo json_encode($objRespuesta);
        }
        public function ctrEliminarRedTecnologica () {
            $objRespuesta = lineaRedTecnologicaModelo::mdlEliminarRedTecnologica($this->idRed,$this->nombreRed,$this->nombreLinea);
            echo json_encode($objRespuesta);
        }

        //linea red tecnologica ficha
        public function ctrListarLineaRedTecnologica () {
            $objRespuesta = lineaRedTecnologicaModelo::mdlListarLineaRedTecnologica ();
            echo json_encode($objRespuesta);
        }

    }

    if (isset($_SESSION["usuario"])) {
        if (isset($_POST["lineaTecnologica"])) {
            $objLinea = new lineaRedTecnologicaControl ();
            $objLinea -> nombre = $_POST["lineaTecnologica"];
            $objLinea -> ctrAgregarLineaTecnologica ();
        }
        if (isset($_POST["editLineaTecnologica"],$_POST["editIdLineaTecnologica"],$_POST["editlinea"])) {
            $objLinea = new lineaRedTecnologicaControl ();
            $objLinea -> nombre = $_POST["editLineaTecnologica"];
            $objLinea -> idLinea = $_POST["editIdLineaTecnologica"];
            $objLinea -> nombreLinea = $_POST["editlinea"];
            $objLinea -> ctrEditarLineaTecnologica ();
        }
        if (isset($_POST["tabla_linea"])) {
            $objLinea = new lineaRedTecnologicaControl ();
            $objLinea -> ctrlistarLineaTecnologica ();
        }
        if (isset($_POST["eliminarIdLineaTecnologica"],$_POST["eliminarLineaTecnologica"])) {
            $objLinea = new lineaRedTecnologicaControl ();
            $objLinea -> idLinea = $_POST["eliminarIdLineaTecnologica"];
            $objLinea -> nombreLinea = $_POST["eliminarLineaTecnologica"];
            $objLinea -> ctrEliminarLineaTecnologica ();
        }
    
        //red
        if (isset($_POST["tabla_red"],$_POST["red_lineaTecnologica"])) {
            $objRed = new lineaRedTecnologicaControl ();
            $objRed -> idLinea = $_POST["red_lineaTecnologica"];
            $objRed -> ctrlistarRedTecnologica ();
        }
        if (isset($_POST["redTecnologica"],$_POST["idLineaTecnologica_red"],$_POST["lineaDeLaRed"])) {
            $objLinea = new lineaRedTecnologicaControl ();
            $objLinea -> nombre = $_POST["redTecnologica"];
            $objLinea -> nombreLinea = $_POST["lineaDeLaRed"];
            $objLinea -> idLinea = $_POST["idLineaTecnologica_red"];
            $objLinea -> ctrAgregarRedTecnologica ();
        }
        if (isset($_POST["editRedTecnologica"],$_POST["editIdRedTecnologica"],$_POST["lineaDeRedTecnologica"],$_POST["editNombreLineaDeLaRed"],$_POST["editNombreRed"])) {
            $objLinea = new lineaRedTecnologicaControl ();
            $objLinea -> nombre = $_POST["editRedTecnologica"];
            $objLinea -> nombreLinea = $_POST["editNombreLineaDeLaRed"];
            $objLinea -> nombreRed = $_POST["editNombreRed"];
            $objLinea -> idRed = $_POST["editIdRedTecnologica"];
            $objLinea -> idLinea = $_POST["lineaDeRedTecnologica"];
            $objLinea -> ctrEditarRedTecnologica ();
        }
        if (isset($_POST["eliminarRedTecnologica"],$_POST["eliminarLineaDeLaRed"],$_POST["eliminarIdRedTecnologica"])) {
            $objLinea = new lineaRedTecnologicaControl ();
            $objLinea -> idRed = $_POST["eliminarIdRedTecnologica"];
            $objLinea -> nombreRed = $_POST["eliminarRedTecnologica"];
            $objLinea -> nombreLinea = $_POST["eliminarLineaDeLaRed"];
            $objLinea -> ctrEliminarRedTecnologica ();
        }
    
        //linea red tecnologica ficha
    
        if (isset($_POST["tabla_linea_red"])) {
            $objFicha = new lineaRedTecnologicaControl ();
            $objFicha -> ctrListarLineaRedTecnologica ();
        }
    }