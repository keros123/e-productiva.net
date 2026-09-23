<?php

include_once "conexion.php";

class AsignacionSeguimientosModelo{

    public static function mdlListarSeguimientosPreAsignacion(){
        $mensaje = array();
        $asinacion = "2";
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT *,aprendiz.nombres as nombreAprendiz,aprendiz.apellidos as apellidoAprendiz,funcionario.documento as documentoFuncionario,funcionario.nombres as nombresFuncionario,funcionario.apellidos as apellidosFuncionario FROM visita_seguimiento INNER JOIN tipo_seguimiento ON visita_seguimiento.tipo_seguimiento_idtipo_seguimiento = tipo_seguimiento.idtipo_seguimiento INNER JOIN seguimiento ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento INNER JOIN aprendiz ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha INNER JOIN empresa ON seguimiento.empresa_idempresa = empresa.idempresa INNER JOIN funcionario ON visita_seguimiento.funcionario_idfuncionario = funcionario.idfuncionario WHERE visita_seguimiento.asignacion != :asignacion");
            $objRespuesta->bindParam(":asignacion",$asinacion);
            $objRespuesta->execute();
            $listaSeguimientosPreAsignados = $objRespuesta->fetchAll();
            $objRespuesta = null;
            $mensaje = array("codigo"=>"200","mensaje"=>$listaSeguimientosPreAsignados);
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlEliminarSeguimientosPreAsignado($idSeguimiento,$estado_etapa,$idvisita_seguimiento){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("DELETE FROM visita_seguimiento WHERE idvisita_seguimiento = :idvisita_seguimiento");
            $objRespuesta->bindParam(":idvisita_seguimiento",$idvisita_seguimiento);
            if ($objRespuesta->execute()){
                $nuevoEstado = "";
                if ($estado_etapa == "2"){
                    $nuevoEstado = "1";
                }
                $objActualizarSeguimiento = Conexion::conectar()->prepare("UPDATE seguimiento SET estado_etapa=:estado_etapa WHERE idseguimiento=:idseguimiento");
                $objActualizarSeguimiento->bindParam(":idseguimiento",$idSeguimiento);
                $objActualizarSeguimiento->bindParam(":estado_etapa",$nuevoEstado);
                if ($objActualizarSeguimiento->execute()){
                    $mensaje = array("codigo"=>"200","mensaje"=>"estado de seguimiento modificado correctamente");
                    $objActualizarSeguimiento = null;
                }else{
                    $mensaje = array("codigo"=>"401","mensaje"=>"error al modificar estado de seguimiento");
                }

                if ($mensaje["codigo"] == "200"){
                    $mensaje = array("codigo"=>"200","mensaje"=>"Seguimiento preasignado eliminado correctamente");
                }
            }else{
                $mensaje = array("codigo"=>"401","mensaje"=>"error al eliminar Seguimiento preasignado");
            }

            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlListarInstructor(){
        $mensaje = array();
        $tipoFuncionario = 1;
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM funcionario WHERE tipo_funcionario_idtipo_funcionario = :tipo_funcionario_idtipo_funcionario");
            $objRespuesta->bindParam(":tipo_funcionario_idtipo_funcionario",$tipoFuncionario);
            $objRespuesta->execute();
            $listaInstructores = $objRespuesta->fetchAll();
            $mensaje = array("codigo"=>"200","mensaje"=>$listaInstructores);
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlSeguimientosInstructor($idInstructor){
        $mensaje = array();
        $asinacion = "2";
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT *,aprendiz.nombres as nombreAprendiz,aprendiz.email as emailAprendiz ,funcionario.email as emailFuncionario, aprendiz.documento as documentoAprendiz,aprendiz.apellidos as apellidoAprendiz,funcionario.documento as documentoFuncionario,funcionario.nombres as nombresFuncionario,funcionario.apellidos as apellidosFuncionario, visita_seguimiento.fecha_radicado as fecha_radicado_visita, aprendiz.telefono as telefonoAprendiz FROM visita_seguimiento INNER JOIN tipo_seguimiento ON visita_seguimiento.tipo_seguimiento_idtipo_seguimiento = tipo_seguimiento.idtipo_seguimiento INNER JOIN seguimiento ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento INNER JOIN aprendiz ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha INNER JOIN empresa ON seguimiento.empresa_idempresa = empresa.idempresa INNER JOIN funcionario ON visita_seguimiento.funcionario_idfuncionario = funcionario.idfuncionario INNER JOIN municipios ON empresa.municipios_codi_muni = municipios.codi_muni INNER JOIN modalidad ON seguimiento.modalidad_idmodalidad = modalidad.idmodalidad WHERE visita_seguimiento.asignacion != :asignacion AND funcionario.idfuncionario = :idfuncionario");
            $objRespuesta->bindParam(":asignacion",$asinacion);
            $objRespuesta->bindParam(":idfuncionario",$idInstructor);
            $objRespuesta->execute();
            $listaSeguimientosPreAsignados = $objRespuesta->fetchAll();
            $objRespuesta = null;
            $mensaje = array("codigo"=>"200","mensaje"=>$listaSeguimientosPreAsignados);
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlListarTipoSeguimiento(){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM tipo_seguimiento");
            $objRespuesta->execute();
            $listaTipoSeguimiento = $objRespuesta->fetchAll();
            $objRespuesta = null;
            $mensaje = array("codigo"=>"200","mensaje"=>$listaTipoSeguimiento);
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlRegistrarSeguimientoAsignado($idInstructor,$tipoSeguimiento,$fechaVencimiento,$idSeguimiento, $ubicacion){
        $mensaje = array();
        $fechaRadicado = date("Y-m-d");
        $asignacion = "1";
        $estadoSeguimiento = 1;

        // Usamos una única conexión para poder manejar la transacción
        $pdo = Conexion::conectar();

        try {
            // ── Inicio de la transacción ──────────────────────────────────────
            $pdo->beginTransaction();

            // PASO 1: Registrar la visita de seguimiento
            $objRespuesta = $pdo->prepare("INSERT INTO visita_seguimiento(seguimiento_idseguimiento,funcionario_idfuncionario,tipo_seguimiento_idtipo_seguimiento,fecha_radicado,fecha_vencimiento,estado_visita_seguimiento_idestado_visita_seguimiento,asignacion,ubicacion_seguimiento)VALUES(:seguimiento_idseguimiento,:funcionario_idfuncionario,:tipo_seguimiento_idtipo_seguimiento,:fecha_radicado,:fecha_vencimiento,:estado_visita_seguimiento_idestado_visita_seguimiento,:asignacion,:ubicacion)");

            $objRespuesta->bindParam(":seguimiento_idseguimiento", $idSeguimiento);
            $objRespuesta->bindParam(":funcionario_idfuncionario", $idInstructor);
            $objRespuesta->bindParam(":tipo_seguimiento_idtipo_seguimiento", $tipoSeguimiento);
            $objRespuesta->bindParam(":fecha_radicado", $fechaRadicado);
            $objRespuesta->bindParam(":fecha_vencimiento", $fechaVencimiento);
            $objRespuesta->bindParam(":estado_visita_seguimiento_idestado_visita_seguimiento", $estadoSeguimiento);
            $objRespuesta->bindParam(":asignacion", $asignacion);
            $objRespuesta->bindParam(":ubicacion", $ubicacion);

            if (!$objRespuesta->execute()) {
                // Si el INSERT falla, revertimos y salimos
                $pdo->rollBack();
                return array("codigo" => "401", "mensaje" => "No fue posible registrar la visita de seguimiento");
            }

            // PASO 2: Actualizar la etapa del seguimiento
            $objEtapaPractica = $pdo->prepare("UPDATE seguimiento SET estado_etapa=:estado_etapa WHERE idseguimiento=:idseguimiento");
            $objEtapaPractica->bindParam(":estado_etapa", $tipoSeguimiento);
            $objEtapaPractica->bindParam(":idseguimiento", $idSeguimiento);

            if (!$objEtapaPractica->execute()) {
                // Si el UPDATE falla, revertimos el INSERT anterior también
                $pdo->rollBack();
                return array("codigo" => "401", "mensaje" => "No fue posible actualizar la etapa del seguimiento");
            }

            // ── Ambas operaciones exitosas: confirmar cambios ─────────────────
            $pdo->commit();
            $mensaje = array("codigo" => "200", "mensaje" => "Seguimiento registrado correctamente");

        } catch (Exception $e) {
            // Ante cualquier excepción inesperada, revertimos todo
            if ($pdo->inTransaction()) {
                $pdo->rollBack();
            }
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }

}