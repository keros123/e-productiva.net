<?php
session_start();
require ('../vendor/autoload.php');
use Encryption\Encryption;
use Encryption\Exceptions\EncryptException;


class encriptarControl{

    public $key = "Ines";

    public function ctrEncriptarDatosFicha($idFicha,$ficha,$caracterizacion,$peticion){
        $mensaje = array();
        try {
            $objEncriptacion = Encryption::getEncryptionObject();
            $iv = $objEncriptacion->generateIv();
            $_SESSION["iv"] = $iv;
            $_SESSION["key"] = $this->key;

            $idFicha = $objEncriptacion->encrypt($idFicha, $this->key, $iv);
            $ficha = $objEncriptacion->encrypt($ficha, $this->key, $iv);
            $caracterizacion = $objEncriptacion->encrypt($caracterizacion, $this->key, $iv);
            $mensaje = array("codigo"=>"200","idFicha"=>$idFicha,"ficha"=>$ficha,"caracterizacion"=>$caracterizacion);
        } catch (EncryptException $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e);
        }

        if ($peticion == 'js'){
            echo json_encode($mensaje);
        }else{
            return $mensaje;
        }
        
    }


    public function ctrDesencriptarDatosFicha($idFicha,$ficha,$caracterizacion,$peticion){
        $mensaje = array();
        try {
            $objEncriptacion = Encryption::getEncryptionObject();
            $idFicha = $objEncriptacion->decrypt($idFicha, $this->key, $_SESSION["iv"]);
            $ficha = $objEncriptacion->decrypt($ficha, $this->key, $_SESSION["iv"]);
            $caracterizacion = $objEncriptacion->decrypt($caracterizacion, $this->key, $_SESSION["iv"]);

            $mensaje = array("codigo"=>"200","idFicha"=>$idFicha,"ficha"=>$ficha,"caracterizacion"=>$caracterizacion);
        } catch (EncryptException $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e);
        }

        if ($peticion == 'js'){
            echo json_encode($mensaje);
        }else{
            return $mensaje;
        }
    }

}

if (isset($_SESSION["usuario"])) {
    if (isset($_POST["idFicha"],$_POST["ficha"],$_POST["caracterizacion"],$_POST["peticion"])){
        $objEncriptar = new encriptarControl();
        $objEncriptar->ctrEncriptarDatosFicha($_POST["idFicha"],$_POST["ficha"],$_POST["caracterizacion"],$_POST["peticion"]);
    }
}