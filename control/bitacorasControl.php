<?php
session_start();

include_once "../modelo/bitacorasModelo.php";

class BitacorasControl{
    public $idAprendiz;
    public $idBitacora;
    public $razon_social;
    public $direccion_empresa;
    public $telefono_empresa;
    public $email_empresa;
    public $nombre_jefe;
    public $apellido_jefe;
    public $telefono_jefe;
    public $email_jefe;
    public $fecha_inicio_practica;
    public $fecha_final_practica;
    public $archivo_bitacora;
    public $estado;
    public $nombreFuncionario;
    public $documentoFuncionario;

    public function ctrListarBitacoras(){
        $objRespuesta = BitacorasModelo::mdlListarBitacoras($this->idAprendiz);
        echo json_encode($objRespuesta);
    }

    public function ctrRegistrarBitacoras(){
        $objRespuesta = BitacorasModelo::mdlRegistrarBitacoras($this->idAprendiz,$this->razon_social,$this->direccion_empresa,$this->telefono_empresa,$this->email_empresa,$this->nombre_jefe,$this->apellido_jefe,$this->telefono_jefe,$this->email_jefe,$this->fecha_inicio_practica,$this->fecha_final_practica,$this->estado);
        echo json_encode($objRespuesta);
    }

    public function ctrEditarBitacoras(){
        $objRespuesta = BitacorasModelo::mdlEditarBitacoras($this->idBitacora,$this->razon_social,$this->direccion_empresa,$this->telefono_empresa,$this->email_empresa,$this->nombre_jefe,$this->apellido_jefe,$this->telefono_jefe,$this->email_jefe,$this->fecha_inicio_practica,$this->fecha_final_practica);
        echo json_encode($objRespuesta);
    }

    public function ctrSubirArchivoBitacoras(){
        $objRespuesta = BitacorasModelo::mdlSubirArchivoBitacora($this->idBitacora,$this->archivo_bitacora,$this->idAprendiz);
        echo json_encode($objRespuesta);
    }

    // Nuevo método para cambiar estado
    public function ctrCambiarEstadoBitacora(){
        $novedad = isset($_POST["novedad"]) ? $_POST["novedad"] : null;
        $objRespuesta = BitacorasModelo::mdlCambiarEstadoBitacora($this->idBitacora, $this->estado, $novedad,$this->nombreFuncionario,$this->documentoFuncionario);
        echo json_encode($objRespuesta);
    }
}

if (isset($_SESSION["usuario"])) {
    if (isset($_POST["listarBitacoras"])){
        $objBitacoras = new BitacorasControl();
        $objBitacoras->idAprendiz = $_POST["aprendiz"];
        $objBitacoras->ctrListarBitacoras();
    }
    
    if (isset($_POST["RegistrarBitacoras"]) == "ok"){
        $objBitacoras = new BitacorasControl();
        $objBitacoras->idAprendiz = $_POST["aprendiz"];
        $objBitacoras->razon_social = $_POST["razon_social"];
        $objBitacoras->direccion_empresa = $_POST["direccion_empresa"];
        $objBitacoras->telefono_empresa = $_POST["telefono_empresa"];
        $objBitacoras->email_empresa = $_POST["email_empresa"];
        $objBitacoras->nombre_jefe = $_POST["nombre_jefe"];
        $objBitacoras->apellido_jefe = $_POST["apellido_jefe"];
        $objBitacoras->telefono_jefe = $_POST["telefono_jefe"];
        $objBitacoras->email_jefe = $_POST["email_jefe"];
        $objBitacoras->fecha_inicio_practica = $_POST["fecha_inicial_practica"];
        $objBitacoras->fecha_final_practica = $_POST["fecha_final_practica"];
        $objBitacoras->ctrRegistrarBitacoras();
    }
    
    if (isset($_POST["editarBitacoras"]) == "ok"){
        $objBitacoras = new BitacorasControl();
        $objBitacoras->idBitacora = $_POST["idBitacora"];
        $objBitacoras->razon_social = $_POST["razon_social"];
        $objBitacoras->direccion_empresa = $_POST["direccion_empresa"];
        $objBitacoras->telefono_empresa = $_POST["telefono_empresa"];
        $objBitacoras->email_empresa = $_POST["email_empresa"];
        $objBitacoras->nombre_jefe = $_POST["nombre_jefe"];
        $objBitacoras->apellido_jefe = $_POST["apellido_jefe"];
        $objBitacoras->telefono_jefe = $_POST["telefono_jefe"];
        $objBitacoras->email_jefe = $_POST["email_jefe"];
        $objBitacoras->fecha_inicio_practica = $_POST["fecha_inicial_practica"];
        $objBitacoras->fecha_final_practica = $_POST["fecha_final_practica"];
        $objBitacoras->ctrEditarBitacoras();
    }
    
    if (isset($_POST["subirArchivoBitacoras"]) == "ok"){
        $objBitacoras = new BitacorasControl();
        $objBitacoras->idBitacora = $_POST["idBitacora"];
        $objBitacoras->archivo_bitacora = $_FILES["archivoBitacora"];
        $objBitacoras->idAprendiz = $_POST["aprendiz"];
        $objBitacoras->ctrSubirArchivoBitacoras();
    }

    if (isset($_POST["cambiarEstadoBitacora"]) == "ok"){
        $objBitacoras = new BitacorasControl();
        $objBitacoras->idBitacora = $_POST["idBitacora"];
        $objBitacoras->estado = $_POST["estado"];
        $objBitacoras->nombreFuncionario = $_SESSION["nombreCompleto"];
        $objBitacoras->documentoFuncionario = $_SESSION["documento"];
        $objBitacoras->ctrCambiarEstadoBitacora();
    }
}
