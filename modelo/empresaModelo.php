<?php
include_once "conexion.php";

class EmpresaModelo{

    public static function mdlListarEmpresas(){
        $mensaje = array();
        try {
            $objRepuesta = Conexion::conectar()->prepare("SELECT * FROM empresa INNER JOIN municipios ON empresa.municipios_codi_muni = municipios.codi_muni INNER JOIN departamentos ON municipios.departamentos_codi_depa = departamentos.codi_depa");
            $objRepuesta->execute();
            $listaEmpresas = $objRepuesta->fetchAll();
            $mensaje = array("codigo"=>"200","mensaje"=>$listaEmpresas);
            $objRepuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlRegistrarEmpresa($nombreEmpresa,$municipio,$direccion,$telefono,$nit){
        $mensaje = array();
        try {
            $objRepuesta = Conexion::conectar()->prepare("INSERT INTO empresa(nombre_empresa,direccion_empresa,telefono_empresa,nit_empresa,municipios_codi_muni)VALUES(:nombre_empresa,:direccion_empresa,:telefono_empresa,:nit_empresa,:municipios_codi_muni)");
            $objRepuesta->bindParam(":nombre_empresa",$nombreEmpresa);
            $objRepuesta->bindParam(":direccion_empresa",$direccion);
            $objRepuesta->bindParam(":telefono_empresa",$telefono);
            $objRepuesta->bindParam(":nit_empresa",$nit);
            $objRepuesta->bindParam(":municipios_codi_muni",$municipio);
            if ($objRepuesta->execute()){
                $objRespuesta = null;
                $fecha = date("Y-m-d H:i:s");
                $responsable = $_SESSION["nombreCompleto"];
                $proceso = "Creo empresa";
                $descripcion = "Se creo la empresa ".$nombreEmpresa;
                $sql = "INSERT INTO procesos_empresas(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                $objRespuesta = conexion::conectar()->prepare($sql);
                $objRespuesta->bindparam(":fecha",$fecha);
                $objRespuesta->bindparam(":responsable",$responsable);
                $objRespuesta->bindparam(":proceso",$proceso);
                $objRespuesta->bindparam(":descripcion",$descripcion);
                if ($objRespuesta->execute()) {
                    $objRespuesta = null;
                    $mensaje = ["codigo"=>"200","mensaje"=>"Empresa registrada correctamente"];
                }else{
                    $mensaje = ["codigo"=>"425","mensaje"=>"hubo un error al crear la empresa"];
                }
            }else{
                $mensaje = array("codigo"=>"401","mensaje"=>"Error al registrar empresa");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }

        return $mensaje;
    }



    public static function mdlEditarEmpresa($idEmpresa,$nombreEmpresa,$municipio,$direccion,$telefono,$nit){
        $mensaje = array();
        try {
            $sql = "SELECT * FROM empresa INNER JOIN municipios ON empresa.municipios_codi_muni = municipios.codi_muni INNER JOIN departamentos ON municipios.departamentos_codi_depa = departamentos.codi_depa WHERE idempresa = :empresa";
            $objRepuesta = Conexion::conectar()->prepare($sql);
            $objRepuesta->bindParam(":empresa",$idEmpresa);
            if ($objRepuesta -> execute()) {
                $datosAnterioresEmpresa = $objRepuesta -> fetch();
                $objRepuesta = null;
                $objRepuesta = Conexion::conectar()->prepare("UPDATE empresa SET nombre_empresa=:nombre_empresa ,direccion_empresa=:direccion_empresa,telefono_empresa=:telefono_empresa,nit_empresa=:nit_empresa,municipios_codi_muni=:municipios_codi_muni WHERE idempresa=:idempresa");
                $objRepuesta->bindParam(":nombre_empresa",$nombreEmpresa);
                $objRepuesta->bindParam(":direccion_empresa",$direccion);
                $objRepuesta->bindParam(":telefono_empresa",$telefono);
                $objRepuesta->bindParam(":nit_empresa",$nit);
                $objRepuesta->bindParam(":municipios_codi_muni",$municipio);
                $objRepuesta->bindParam(":idempresa",$idEmpresa);
                if ($objRepuesta->execute()){
                    $objRespuesta = null;
                    $fecha = date("Y-m-d H:i:s");
                    $responsable = $_SESSION["nombreCompleto"];
                    $proceso = "Edito Empresa";
                    $cambios = '';
                    if ($datosAnterioresEmpresa["nombre_empresa"] != $nombreEmpresa) {
                        $cambios .= "Antes ".$datosAnterioresEmpresa["nombre_empresa"].", Ahora ".$nombreEmpresa.".";
                    }
                    if ($datosAnterioresEmpresa["municipios_codi_muni"] != $municipio) {
                        $cambios .= "Antes ".$datosAnterioresEmpresa["nomb_muni"]." - ".$datosAnterioresEmpresa["nomb_depa"];
                    }
                    if ($cambios == '') {
                        $cambiosTotales = 'No hay cambios';
                    }else{
                        $cambiosTotales = "cambios: ".$cambios;;
                    }
                    $descripcion = "Se edito la empresa ".$nombreEmpresa.". ".$cambiosTotales;
                    $sql = "INSERT INTO procesos_empresas(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                    $objRespuesta = conexion::conectar()->prepare($sql);
                    $objRespuesta->bindparam(":fecha",$fecha);
                    $objRespuesta->bindparam(":responsable",$responsable);
                    $objRespuesta->bindparam(":proceso",$proceso);
                    $objRespuesta->bindparam(":descripcion",$descripcion);
                    if ($objRespuesta->execute()) {
                        $objRespuesta = null;
                        $mensaje = ["codigo"=>"200","mensaje"=>"Empresa modificada correctamente"];
                    }else{
                        $mensaje = ["codigo"=>"401","mensaje"=>"Error al modificar empresa"];
                    }
                }else{
                    $mensaje = array("codigo"=>"401","mensaje"=>"Error al modificar empresa");
                }
            }else{
                $mensaje = array("codigo"=>"401","mensaje"=>"Error al modificar empresa");
            }
            
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }

        return $mensaje;
    }


    public static function mdlEliminarEmpresa($idEmpresa,$empresaCompleta){
        $mensaje = array();
        try {
            $objRepuesta = Conexion::conectar()->prepare("DELETE FROM empresa WHERE idempresa=:idempresa");
            $objRepuesta->bindParam(":idempresa",$idEmpresa);
            if ($objRepuesta->execute()){
                $objRespuesta = null;
                $fecha = date("Y-m-d H:i:s");
                $responsable = $_SESSION["nombreCompleto"];
                $proceso = "Elimino empresa";
                $descripcion = "Se elimino la empresa ".$empresaCompleta;
                $sql = "INSERT INTO procesos_empresas(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                $objRespuesta = conexion::conectar()->prepare($sql);
                $objRespuesta->bindparam(":fecha",$fecha);
                $objRespuesta->bindparam(":responsable",$responsable);
                $objRespuesta->bindparam(":proceso",$proceso);
                $objRespuesta->bindparam(":descripcion",$descripcion);
                if ($objRespuesta->execute()) {
                    $objRespuesta = null;
                    $mensaje = ["codigo"=>"200","mensaje"=>"Empresa eliminada correctamente"];
                }else{
                    $mensaje = ["codigo"=>"425","mensaje"=>"hubo un error al eliminar la empresa"];
                }
            }else{
                $mensaje = array("codigo"=>"401","mensaje"=>"No es posible eliminar una empresa que ya fue asignada a un seguimiento");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }

        return $mensaje;
    }


}
