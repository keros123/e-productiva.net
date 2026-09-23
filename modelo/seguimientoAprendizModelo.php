<?php

    include_once "conexion.php";

    class seguimientoAprendizModelo {

        public static function mdlListarSeguimientosAsignados ($idAprendiz) {
            try {
                $asignacion = "2";
                $sql = "SELECT * FROM visita_seguimiento INNER JOIN funcionario ON visita_seguimiento.funcionario_idfuncionario = funcionario.idfuncionario INNER JOIN seguimiento ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento INNER JOIN empresa ON seguimiento.empresa_idempresa = empresa.idempresa INNER JOIN estado_visita_seguimiento ON visita_seguimiento.estado_visita_seguimiento_idestado_visita_seguimiento = estado_visita_seguimiento.idestado_visita_seguimiento INNER JOIN tipo_seguimiento ON visita_seguimiento.tipo_seguimiento_idtipo_seguimiento = tipo_seguimiento.idtipo_seguimiento WHERE seguimiento.aprendiz_idaprendiz = :idAprendiz AND asignacion=:asignacion";
                $objConsulta = conexion::conectar()->prepare($sql);
                $objConsulta->bindparam(":idAprendiz",$idAprendiz);
                $objConsulta->bindparam(":asignacion",$asignacion);
                $objConsulta->execute();
                $datos = $objConsulta -> fetchAll();
                $objConsulta = null;
            } catch (Exception $e) {
                $datos = $e -> getMessage();
            }
            return $datos;
        }

        public static function mdlEditarDireccion($idVisita,$direccion){
            $mensaje = array();
            try {
                $objRespuesta = Conexion::conectar()->prepare("UPDATE visita_seguimiento SET direccion_visita=:direccion_visita WHERE idvisita_seguimiento=:idvisita_seguimiento");
                $objRespuesta->bindParam(":direccion_visita",$direccion);
                $objRespuesta->bindParam(":idvisita_seguimiento",$idVisita);
                if ($objRespuesta->execute()){
                    $mensaje = array("codigo"=>"200","mensaje"=>"dirección editada correctamente");
                }else{
                    $mensaje = array("codigo"=>"401","mensaje"=>"error al editar datos por favor intentelo nuevamente");
                }
            } catch (Exception $e) {
                $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
            }
            return $mensaje;
        }
    }