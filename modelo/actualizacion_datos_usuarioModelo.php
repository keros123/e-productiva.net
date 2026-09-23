<?php
include_once "conexion.php";

class actualizacion_datos_usuarioModelo {

    public static function mdlActualizarUsuario($nombres,$apellidos,$tipoDocumento,$numeroDocumento,$numeroDocumentoAnterior,$email,$telefono,$municipio,$direccion,$password,$tipoUsuario){
        $mensaje = array();
        try {
            if ($tipoUsuario <= 9){
                $objActualizar = conexion::conectar()->prepare("UPDATE funcionario SET nombres = :nombres, apellidos = :apellidos, tipo_documento_idtipo_documento = :tipodoc, documento = :documento, email = :email, telefono = :telefono, municipios_codi_muni = :municipio, direccion = :direccion, password = :password1 WHERE documento = :documentoold");
                $objActualizar->bindparam(":nombres",$nombres);
                $objActualizar->bindparam(":apellidos",$apellidos);
                $objActualizar->bindparam(":tipodoc",$tipoDocumento);
                $objActualizar->bindparam(":documento",$numeroDocumento);
                $objActualizar->bindparam(":email",$email);
                $objActualizar->bindparam(":telefono",$telefono);
                $objActualizar->bindparam(":municipio",$municipio);
                $objActualizar->bindparam(":direccion",$direccion);
                $objActualizar->bindparam(":password1",$password);
                $objActualizar->bindparam(":documentoold",$numeroDocumentoAnterior);
            }else{
                $objActualizar = conexion::conectar()->prepare("UPDATE aprendiz SET nombres = :nombres, apellidos = :apellidos, tipo_documento_idtipo_documento = :tipodoc, documento = :documento, email = :email, telefono = :telefono, password_aprendiz = :password  WHERE documento = :documentoold");
                $objActualizar->bindparam(":nombres",$nombres);
                $objActualizar->bindparam(":apellidos",$apellidos);
                $objActualizar->bindparam(":tipodoc",$tipoDocumento);
                $objActualizar->bindparam(":documento",$numeroDocumento);
                $objActualizar->bindparam(":email",$email);
                $objActualizar->bindparam(":telefono",$telefono);
                $objActualizar->bindparam(":password",$password);
                $objActualizar->bindparam(":documentoold",$numeroDocumentoAnterior);
            }

            if ($objActualizar->execute()){
                $mensaje = ["codigo"=>"200","mensaje"=>"Datos actualizados correctamente."];
            }else{
                $mensaje = ["codigo"=>"401","mensaje"=>"No fue posible actualizar datos por favor intentalo mas tarde."];
            }
            $objActualizar = null;
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }
}