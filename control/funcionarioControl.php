<?php

session_start();
include_once "../modelo/funcionarioModelo.php";

class funcionarioControl
{

    public $idfuncionario;
    public $nombres;
    public $apellidos;
    public $tipoDocumento;
    public $numeroDocumento;
    public $email;
    public $telefono;
    public $municipio;
    public $direccion;
    public $tipoFuncionario;
    public $nombreCompleto;
    public $idDepartamento;
    public $idMunicipio;
    public $ingreso;

    public function ctrRegistrarFuncionario()
    {
        $objRespuesta = funcionarioModelo::mdlregistrarFuncionario(
            $this->nombres,
            $this->apellidos,
            $this->tipoDocumento,
            $this->numeroDocumento,
            $this->email,
            $this->telefono,
            $this->municipio,
            $this->direccion,
            $this->tipoFuncionario
        );
        echo json_encode($objRespuesta);
    }

    public function ctrEditarFuncionario()
    {
        $objRespuesta = funcionarioModelo::mdlEditarFuncionario(
            $this->idfuncionario,
            $this->nombres,
            $this->apellidos,
            $this->tipoDocumento,
            $this->numeroDocumento,
            $this->email,
            $this->telefono,
            $this->municipio,
            $this->direccion,
            $this->tipoFuncionario,
            $this->nombreCompleto
        );
        echo json_encode($objRespuesta);
    }

    public function ctrCargarSelectTipoFuncionario()
    {
        $objRespuesta = funcionarioModelo::mdlcargarSelectTipoFuncionario();
        echo json_encode($objRespuesta);
    }

    public function ctrListarDepartamentos()
    {
        $objRespuesta = funcionarioModelo::mdlListarDepartamentos();
        echo json_encode($objRespuesta);
    }

    public function ctrListarMunicipios()
    {
        $objRespuesta = funcionarioModelo::mdlListarMunicipios($this->idDepartamento);
        echo json_encode($objRespuesta);
    }

    public function ctrListarMunicipiosEdit()
    {
        $objRespuesta = funcionarioModelo::mdlListarMunicipiosEdit();
        echo json_encode($objRespuesta);
    }

    public function ctrCargarFuncionarios()
    {
        $objRespuesta = funcionarioModelo::mdlCargarFuncionarios();
        echo json_encode($objRespuesta);
    }

    public function ctrEliminarFuncionario()
    {
        $objRespuesta = funcionarioModelo::mdlEliminarFuncionario($this->idfuncionario, $this->nombreCompleto);
        echo json_encode($objRespuesta);
    }

    public function ctrEditarIngresoIndividual(){
        $objRespuesta = funcionarioModelo::mdlEditarIngresoIndividual($this->idfuncionario,$this->ingreso);
        echo json_encode($objRespuesta);
    }
}

if (isset($_SESSION["usuario"])) {
    if (isset(
        $_POST["nombres"],
        $_POST["apellidos"],
        $_POST["tipoDocumento"],
        $_POST["nDocumento"],
        $_POST["email"],
        $_POST["telefono"],
        $_POST["municipio"],
        $_POST["direccion"],
        $_POST["tipoFuncionario"]
    )) {
        $objActualizar = new funcionarioControl();
        $objActualizar->nombres = $_POST["nombres"];
        $objActualizar->apellidos = $_POST["apellidos"];
        $objActualizar->tipoDocumento = $_POST["tipoDocumento"];
        $objActualizar->numeroDocumento = $_POST["nDocumento"];
        $objActualizar->email = $_POST["email"];
        $objActualizar->telefono = $_POST["telefono"];
        $objActualizar->municipio = $_POST["municipio"];
        $objActualizar->direccion = $_POST["direccion"];
        $objActualizar->tipoFuncionario = $_POST["tipoFuncionario"];
    
        $objActualizar->ctrRegistrarFuncionario();
    }
    
    if (isset(
        $_POST["idFuncionarioEdit"],
        $_POST["nombresEdit"],
        $_POST["apellidosEdit"],
        $_POST["tipoDocumentoEdit"],
        $_POST["nDocumentoEdit"],
        $_POST["emailEdit"],
        $_POST["telefonoEdit"],
        $_POST["municipioEdit"],
        $_POST["direccionEdit"],
        $_POST["tipoFuncionarioEdit"],
        $_POST["editNombreCompleto"]
    )) {
        $objActualizar = new funcionarioControl();
        $objActualizar->idfuncionario = $_POST["idFuncionarioEdit"];
        $objActualizar->nombres = $_POST["nombresEdit"];
        $objActualizar->apellidos = $_POST["apellidosEdit"];
        $objActualizar->tipoDocumento = $_POST["tipoDocumentoEdit"];
        $objActualizar->numeroDocumento = $_POST["nDocumentoEdit"];
        $objActualizar->email = $_POST["emailEdit"];
        $objActualizar->telefono = $_POST["telefonoEdit"];
        $objActualizar->municipio = $_POST["municipioEdit"];
        $objActualizar->direccion = $_POST["direccionEdit"];
        $objActualizar->tipoFuncionario = $_POST["tipoFuncionarioEdit"];
        $objActualizar->nombreCompleto = $_POST["editNombreCompleto"];
    
        $objActualizar->ctrEditarFuncionario();
    }
    
    
    if (isset($_POST["cargarSelectTipoFuncionario"])) {
        $objfuncionario = new funcionarioControl();
        $objfuncionario->ctrCargarSelectTipoFuncionario();
    }
    
    if (isset($_POST["cargarSelectDepartamentos"])) {
        $objDepartamentos = new funcionarioControl();
        $objDepartamentos->ctrListarDepartamentos();
    } else {
        if (isset($_POST["cargarSelectDepartamentosEdit"])) {
            $objDepartamentos = new funcionarioControl();
            $objDepartamentos->ctrListarDepartamentos();
        }
    }
    
    
    if (isset($_POST["cargarSelectMunicipios"])) {
        $objMunicipios = new funcionarioControl();
        $objMunicipios->idDepartamento = $_POST["idDepartamento"];
        $objMunicipios->ctrListarMunicipios();
    } else {
        if (isset($_POST["cargarSelectMunicipiosEdit1"])) {
            $objMunicipios = new funcionarioControl();
            $objMunicipios->idDepartamento = $_POST["idDepartamentoEdit"];
            $objMunicipios->ctrListarMunicipios();
        } else {
            if (isset($_POST["cargarSelectMunicipiosEdit"])) {
                $objMunicipios = new funcionarioControl();
                $objMunicipios->ctrListarMunicipiosEdit();
            }
        }
    }
    
    
    if (isset($_POST["cargarFuncionarios"]) == "ok") {
        $objfuncionario = new funcionarioControl();
        $objfuncionario->ctrCargarFuncionarios();
    }
    
    if (isset($_POST["idFuncionario"], $_POST["nombreCompleto"])) {
        $objMunicipios = new funcionarioControl();
        $objMunicipios->idfuncionario = $_POST["idFuncionario"];
        $objMunicipios->nombreCompleto = $_POST["nombreCompleto"];
        $objMunicipios->ctrEliminarFuncionario();
    }
    
    if (isset($_POST["editarIngreso"])){
        $objFuncionario = new funcionarioControl();
        $objFuncionario->idfuncionario = $_POST["funcionario"];
        $objFuncionario->ingreso = $_POST["ingreso"];
        $objFuncionario->ctrEditarIngresoIndividual();
    }    
}