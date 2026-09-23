<?php

session_start();
include_once "../modelo/detalleUsuarioModelo.php";

class detalleUsuarioControl
{
    public $id;
    public $dirigido;
    public $estadoSeguimiento;
    public $novedad;
    public $enviarCorreo;

    public function ctrInfoAprendiz()
    {
        $objRespuesta = detalleUsuarioModelo::mdlInfoAprendiz($this->id);
        echo json_encode($objRespuesta);
    }

    public function ctrSeguimientoAprendiz()
    {
        $objRespuesta = detalleUsuarioModelo::mdlSeguimientoAprendiz($this->id);
        echo json_encode($objRespuesta);
    }

    public function ctrDetalleSeguimientoAprendiz()
    {
        $objRespuesta = detalleUsuarioModelo::mdlDetalleSeguimientoAprendiz($this->id, $this->dirigido);
        echo json_encode($objRespuesta);
    }

    public function ctrDetalleBitacorasAprendiz()
    {
        $objRespuesta = detalleUsuarioModelo::mdlDetalleBitacorasAprendiz($this->id);
        echo json_encode($objRespuesta);
    }

    public function ctrInfoFuncionario()
    {
        $objRespuesta = detalleUsuarioModelo::mdlInfoFuncionario($this->id);
        echo json_encode($objRespuesta);
    }

    public function ctrCargarNovedades()
    {
        $objRespuesta = detalleUsuarioModelo::mdlCargarNovedades($this->id);
        echo json_encode($objRespuesta);
    }

    public function ctrSeguimientosFuncionario(){
        $objRespuesta = detalleUsuarioModelo::mdlSeguimientosFuncionario($this->id);
        echo  json_encode($objRespuesta);
    }

    public function ctrCambiarEstadoVisitaSeguimiento(){
        $objRespuesta = detalleUsuarioModelo::mdlCambiarEstadoVisitaSeguimiento($this->id, $this->estadoSeguimiento, $this->novedad, $this->enviarCorreo);
        echo json_encode($objRespuesta);
    }

}

if (isset($_SESSION["usuario"])) {
    if (isset($_POST["infoAprendiz"])) {
        $objRespuesta = new detalleUsuarioControl();
        $objRespuesta->id = $_POST["infoAprendiz"];
        $objRespuesta->ctrInfoAprendiz();
    }
    
    if (isset($_POST["seguimientoAprendiz"])) {
        $objRespuesta = new detalleUsuarioControl();
        $objRespuesta->id = $_POST["seguimientoAprendiz"];
        $objRespuesta->ctrSeguimientoAprendiz();
    }
    
    // NOTA: en realidad recibe id de aprendiz 
    if (isset($_POST["idSeguimiento"], $_POST["dirigido"])) {
        $objRespuesta = new detalleUsuarioControl();
        $objRespuesta->id = $_POST["idSeguimiento"];
        $objRespuesta->dirigido = $_POST["dirigido"];
        $objRespuesta->ctrDetalleSeguimientoAprendiz();
    }
    
    if (isset($_POST["idBitacoras"])) {
        $objRespuesta = new detalleUsuarioControl();
        $objRespuesta->id = $_POST["idBitacoras"];
        $objRespuesta->ctrDetalleBitacorasAprendiz();
    }
    
    // funcionario
    if (isset($_POST["infoFuncionario"])) {
        $objRespuesta = new detalleUsuarioControl();
        $objRespuesta->id = $_POST["infoFuncionario"];
        $objRespuesta->ctrInfoFuncionario();
    }
    
    // novedad
    if (isset($_POST["idVisita"])) {
        $objRespuesta = new detalleUsuarioControl();
        $objRespuesta->id = $_POST["idVisita"];
        $objRespuesta->ctrCargarNovedades();
    }
    
    if (isset($_POST["listarSeguimientosFuncionario"]) == "ok"){
        $objRespuesta = new detalleUsuarioControl();
        $objRespuesta->id = $_POST["idFuncionarioSeguimiento"];
        $objRespuesta->ctrSeguimientosFuncionario();
    }
    
    if (isset($_POST["cambiarEstadoVisitaSeguimiento"]) == "ok"){
        $objRespuesta = new detalleUsuarioControl();
        $objRespuesta->id = $_POST["visitaSeguimiento"];
        $objRespuesta->estadoSeguimiento = $_POST["estadoVisitaSeguimiento"];
        $objRespuesta->novedad = $_POST["novedad"];
        
        // Recibimos el nuevo parámetro
        $objRespuesta->enviarCorreo = isset($_POST["enviarCorreo"]) ? $_POST["enviarCorreo"] : "si";
        
        $objRespuesta->ctrCambiarEstadoVisitaSeguimiento();
    }
}
