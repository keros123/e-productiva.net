<?php

session_start();
include_once "../modelo/fichaModelo.php";

class fichaControl{

    public $idFicha;
    public $numeroFicha;
    public $caracterizacion;
    public $fecha_inicio;
    public $fecha_fin_lectiva;
    public $fecha_fin_practica;
    public $estadoFicha;
    public $tipoPrograma;
    public $lineaRedTecnologica;
    public $fichaCompleta;

    public function ctrcargarSelectEstadoFicha(){
        $objRespuesta = fichaModelo::mdlcargarSelectEstadoFicha();
        echo json_encode($objRespuesta);
    }

    public function ctrAgregarFicha(){
        $objRespuesta = fichaModelo::mdlAgregarFicha($this->numeroFicha,$this->caracterizacion,$this->fecha_inicio,$this->fecha_fin_lectiva,$this->fecha_fin_practica,$this->estadoFicha, $this->tipoPrograma,$this->lineaRedTecnologica);
        echo json_encode($objRespuesta);
    }

    public function ctrcargarTablaFichas(){
        $objRespuesta = fichaModelo::mdlcargarTablaFichas();
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarFicha(){
        $objRespuesta = fichaModelo::mdlEliminarFicha($this->idFicha,$this->fichaCompleta);
        echo json_encode($objRespuesta);
    }

    public function ctrEditarFicha(){
        $objRespuesta = fichaModelo::mdlEditarFicha($this->idFicha,$this->numeroFicha,$this->caracterizacion,$this->fecha_inicio,$this->fecha_fin_lectiva,$this->fecha_fin_practica,$this->estadoFicha,$this->tipoPrograma,$this->lineaRedTecnologica,$this->fichaCompleta);
        echo json_encode($objRespuesta);
    }

    public function ctrCargarSelectFichas () {
        $objRespuesta = fichaModelo::mdlCargarSelectFichas();
        echo json_encode($objRespuesta);
    }

    public function ctrListarTablaFichaSeleccionada(){
        $objRespuesta = fichaModelo::mdlListarTablaFichaSeleccionada($this->idFicha);
        echo json_encode($objRespuesta);
    }

    public function ctrListarTablaFichaEtapaPractica(){
        $objRespuesta = fichaModelo::mdlListarTablaFichaEtapaPractica($this->idFicha);
        echo json_encode($objRespuesta);
    }

    //modulo actualizado

    public function ctrCargarTipoPrograma () {
        $objRespuesta = fichaModelo::mdlCargarTipoPrograma ();
        echo json_encode($objRespuesta);
    }

    public function ctrSubirArchivoFormato165() {
        $objRespuesta = fichaModelo::mdlSubirArchivoFormato165($_FILES['archivoFormato165'], $this->idFicha);
        echo json_encode($objRespuesta);
    }

    public function ctrObtenerArchivoFormato165() {
        $objRespuesta = fichaModelo::mdlObtenerArchivoFormato165($this->idFicha);
        echo json_encode($objRespuesta);
    }

}

if (isset($_SESSION["usuario"])) {
    if (isset($_POST["cargarSelectEstadoFicha"])){
        $objFicha = new fichaControl();
        $objFicha->ctrcargarSelectEstadoFicha();
    }
    
    if (isset($_POST["numeroFicha"],$_POST["caracterizacion"],$_POST["fechaInicio"],$_POST["finLectiva"],$_POST["finPractica"],$_POST["estadoFicha"],$_POST["tipoPrograma"],$_POST["lineaRedTecnologica"])){
        $objFicha = new fichaControl();
        $objFicha -> numeroFicha = $_POST["numeroFicha"];
        $objFicha -> caracterizacion = $_POST["caracterizacion"];
        $objFicha -> fecha_inicio = $_POST["fechaInicio"];
        $objFicha -> fecha_fin_lectiva = $_POST["finLectiva"];
        $objFicha -> fecha_fin_practica = $_POST["finPractica"];
        $objFicha -> estadoFicha = $_POST["estadoFicha"];
        $objFicha -> tipoPrograma = $_POST["tipoPrograma"]; //tipo programa
        $objFicha -> lineaRedTecnologica = $_POST["lineaRedTecnologica"];
        $objFicha->ctrAgregarFicha();
    }
    
    if (isset($_POST["cargarTablaFichas"])){
        $objFicha = new fichaControl();
        $objFicha->ctrcargarTablaFichas();
    }
    
    if (isset($_POST["idFicha"],$_POST["EliminarFichaCompleta"])){
        $objFicha = new fichaControl();
        $objFicha -> idFicha = $_POST["idFicha"];
        $objFicha -> fichaCompleta = $_POST["EliminarFichaCompleta"];
        $objFicha->ctrEliminarFicha();
    }
    
    
    if (isset($_POST["numeroFichaEdit"],$_POST["caracterizacionEdit"],$_POST["estadoFichaEdit"],$_POST["idFichaEdit"],$_POST["fechaInicioEdit"],$_POST["finLectivaEdit"],$_POST["finPracticaEdit"],$_POST["tipoProgramaEdit"],$_POST["idRed"],$_POST["fichaCompleta"])){
        $objFicha = new fichaControl();
        $objFicha -> numeroFicha = $_POST["numeroFichaEdit"];
        $objFicha -> caracterizacion = $_POST["caracterizacionEdit"];
        $objFicha -> estadoFicha = $_POST["estadoFichaEdit"];
        $objFicha -> idFicha = $_POST["idFichaEdit"];
        $objFicha -> fecha_inicio = $_POST["fechaInicioEdit"];
        $objFicha -> fecha_fin_lectiva = $_POST["finLectivaEdit"];
        $objFicha -> fecha_fin_practica = $_POST["finPracticaEdit"];
        $objFicha -> tipoPrograma = $_POST["tipoProgramaEdit"];
        $objFicha -> lineaRedTecnologica = $_POST["idRed"];
        $objFicha -> fichaCompleta = $_POST["fichaCompleta"];
        $objFicha->ctrEditarFicha();
    }
    
    if (isset($_POST["cargarSelectFichas"])) {
        $objRespuesta = new fichaControl();
        $objRespuesta->ctrCargarSelectFichas();
    }
    
    if (isset($_POST["fichaAprendicesSelecionada"])){
        $objRespuesta = new fichaControl();
        $objRespuesta->idFicha = $_POST["fichaAprendicesSelecionada"];
        $objRespuesta->ctrListarTablaFichaSeleccionada();
    }
    
    if (isset($_POST["fichaAprendicesEtapaPractica"])){
        $objRespuesta = new fichaControl();
        $objRespuesta->idFicha = $_POST["fichaAprendicesEtapaPractica"];
        $objRespuesta->ctrListarTablaFichaEtapaPractica();
    }
    
    
    if (isset($_POST["CargarTipoPrograma"])) {
        $objRespuesta = new fichaControl ();
        $objRespuesta -> ctrCargarTipoPrograma ();
    }

    if (isset($_FILES["archivoFormato165"]) && isset($_POST["idFichaFormato165"])) {
        $objFicha = new fichaControl();
        $objFicha->idFicha = $_POST["idFichaFormato165"];
        $objFicha->ctrSubirArchivoFormato165();
    }

    if (isset($_POST["obtenerArchivoFormato165"])) {
        $objFicha = new fichaControl();
        $objFicha->idFicha = $_POST["idFichaFormato165"];
        $objFicha->ctrObtenerArchivoFormato165();
    }

}