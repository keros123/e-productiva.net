<?php

    include_once "conexion.php";

    class asignacionFichasModelo {

        public static function mdlListarFichasAsignadas ($idFuncionario) {
            try {
                $sql = "SELECT * FROM ficha INNER JOIN ficha_has_funcionario ON ficha.idficha=ficha_has_funcionario.ficha_idficha INNER JOIN estado_ficha ON ficha.estado_ficha_idestado_ficha=estado_ficha.idestado_ficha WHERE ficha_has_funcionario.funcionario_idfuncionario = :idFuncionario";
                $objAsignar = conexion::conectar()->prepare($sql);
                $objAsignar->bindparam(":idFuncionario", $idFuncionario);
                $objAsignar->execute();
                $datos = $objAsignar -> fetchAll();
                $objAsignar = null;

            } catch (Exception $e) {
                $datos = $e->getMessage();
            }
            return $datos;
        }

        public static function mdlListarFichas () {
            try {
                $sql = "SELECT * FROM ficha INNER JOIN estado_ficha ON ficha.estado_ficha_idestado_ficha=estado_ficha.idestado_ficha";
                $objAsignar = conexion::conectar()->prepare($sql);
                $objAsignar->execute();
                $datos = $objAsignar -> fetchAll();
                $objAsignar = null;
            } catch (Exception $e) {
                $datos = $e->getMessage();
            }
            return $datos;
        }

        public static function mdlAsignarFicha ($idFuncionario,$idFicha,$fichaCompleta,$instructor) {
            $datos = null;
            $mensaje=[];
            try {
                $objAsignar = conexion::conectar()->prepare("SELECT * FROM ficha_has_funcionario WHERE ficha_idficha=:idFicha AND funcionario_idfuncionario=:idFuncionario");
                $objAsignar->bindparam(":idFicha",$idFicha);
                $objAsignar->bindparam(":idFuncionario",$idFuncionario);
                $objAsignar->execute();
                $datos = $objAsignar->fetch();
                $objAsignar = null;
                if ($datos != null) {
                    $mensaje = ["codigo"=>"425","mensaje"=>"La ficha ya ha sido asignada al funcionario"];
                }else {
                    $objAsignar = conexion::conectar()->prepare("INSERT INTO ficha_has_funcionario(ficha_idficha, funcionario_idfuncionario) VALUES (:idFicha,:idFuncionario)");
                    $objAsignar->bindparam(":idFicha",$idFicha);
                    $objAsignar->bindparam(":idFuncionario",$idFuncionario);
                    if ($objAsignar->execute()) {
                        $objAsignar = null;
                        $fecha = date("Y-m-d H:i:s");
                        $responsable = $_SESSION["nombreCompleto"];
                        $proceso = "Asigno ficha";
                        $descripcion = "Se asigno la ficha ".$fichaCompleta." a el instructor ".$instructor;
                        $sql = "INSERT INTO procesos_fichas(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                        $objAsignar = conexion::conectar()->prepare($sql);
                        $objAsignar->bindparam(":fecha",$fecha);
                        $objAsignar->bindparam(":responsable",$responsable);
                        $objAsignar->bindparam(":proceso",$proceso);
                        $objAsignar->bindparam(":descripcion",$descripcion);
                        if ($objAsignar->execute()) {
                            $objAsignar = null;
                            $mensaje = ["codigo"=>"200","mensaje"=>"La ficha fue asignada correctamente"];
                        }else{
                            $mensaje = array("codigo"=>"425","mensaje"=>"hubo un error al asignar la ficha");
                        }
                    }
                }
            } catch (Exception $e) {
                $mensaje = ["codigo"=>"425","mensaje"=>"Hubo un error al Asignar la Ficha","msg"=>$e->getMessage()];
            }            
            return $mensaje;
        }

        public static function mdlDesasignarFicha ($idFuncionario,$idFicha,$fichaCompleta,$instructor) {
            try {
                $objAsignar = conexion::conectar()->prepare("DELETE FROM ficha_has_funcionario WHERE ficha_idficha=:idFicha AND funcionario_idfuncionario=:idFuncionario");
                $objAsignar->bindparam(":idFicha",$idFicha);
                $objAsignar->bindparam(":idFuncionario",$idFuncionario);
                if ($objAsignar->execute()) {
                    $objAsignar = null;
                    $fecha = date("Y-m-d H:i:s");
                    $responsable = $_SESSION["nombreCompleto"];
                    $proceso = "Desasigno ficha";
                    $descripcion = "Se desasigno la ficha ".$fichaCompleta." a el instructor ".$instructor;
                    $sql = "INSERT INTO procesos_fichas(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                    $objAsignar = conexion::conectar()->prepare($sql);
                    $objAsignar->bindparam(":fecha",$fecha);
                    $objAsignar->bindparam(":responsable",$responsable);
                    $objAsignar->bindparam(":proceso",$proceso);
                    $objAsignar->bindparam(":descripcion",$descripcion);
                    if ($objAsignar->execute()) {
                        $objAsignar = null;
                        $mensaje = ["codigo"=>"200","mensaje"=>"Ficha desvinculada correctamente"];
                    }else{
                        $mensaje = array("codigo"=>"425","mensaje"=>"hubo un error al desvincular la ficha");
                    }
                }
            } catch (Exception $e) {
                $mensaje = ["codigo"=>"425","mensaje"=>"Hubo un error al Desasignar la Ficha","msg"=>$e->getMessage()];
            }
            return $mensaje;
        }
        
    }