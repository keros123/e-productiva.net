<?php
class SeguimientoOtraAlternativaModelo{

    //urldocumento, $idaprendiz para idseguimiento, funcionario, tiposeguimiento, fechas, estadovisita, asignacion, notificado, estadoReporte
    public static function mdlCrearPrimerSeguimiento($documentoAlternativaPractica, $idAprendiz, $funcionario, $tipoSeguimiento, $fechas, $estadoVisita, $asignacion, $instructorNotificado, $estadoReporte) {
        $mensaje = array();
        try {
            $etapaPractica = self::buscarEtapaPractica($idAprendiz);
            if ($etapaPractica["codigo"] == "200") {
                $documento = self::subirDocumento($documentoAlternativaPractica, $idAprendiz);
                if ($documento["codigo"] == "200") {
                    $objRespuesta = Conexion::conectar()->prepare("INSERT INTO visita_seguimiento(seguimiento_idseguimiento,funcionario_idfuncionario,tipo_seguimiento_idtipo_seguimiento,fecha_radicado,fecha_vencimiento,fecha_entrega,estado_visita_seguimiento_idestado_visita_seguimiento,asignacion,instructor_notificado,estado_reporte,url_documento)VALUES(:seguimiento_idseguimiento,:funcionario_idfuncionario,:tipo_seguimiento_idtipo_seguimiento,:fecha_radicado,:fecha_vencimiento,:fecha_entrega,:estado_visita_seguimiento_idestado_visita_seguimiento,:asignacion,:instructor_notificado,:estado_reporte,:url_documento)");
                    $objRespuesta->bindParam(":seguimiento_idseguimiento",$etapaPractica["mensaje"]["idseguimiento"]);
                    $objRespuesta->bindParam(":funcionario_idfuncionario",$funcionario);
                    $objRespuesta->bindParam(":tipo_seguimiento_idtipo_seguimiento",$tipoSeguimiento);
                    $objRespuesta->bindParam(":fecha_radicado",$fechas);
                    $objRespuesta->bindParam(":fecha_vencimiento",$fechas);
                    $objRespuesta->bindParam(":fecha_entrega",$fechas);
                    $objRespuesta->bindParam(":estado_visita_seguimiento_idestado_visita_seguimiento",$estadoVisita);
                    $objRespuesta->bindParam(":asignacion",$asignacion);
                    $objRespuesta->bindParam(":instructor_notificado", $instructorNotificado);
                    $objRespuesta->bindParam(":estado_reporte", $estadoReporte);
                    $objRespuesta->bindParam(":url_documento", $documento["mensaje"]);
    
                    if ($objRespuesta->execute()){
                        $objEtapaPractica = Conexion::conectar()->prepare("UPDATE seguimiento SET estado_etapa=:estado_etapa WHERE idseguimiento=:idseguimiento");
                        $objEtapaPractica->bindParam(":estado_etapa",$tipoSeguimiento);
                        $objEtapaPractica->bindParam(":idseguimiento",$etapaPractica["mensaje"]["idseguimiento"]);
                        if ($objEtapaPractica->execute()){
                            $mensaje = array("codigo"=>"200","mensaje"=>"estado de estapa practica actualizado correctamente");
                        }else{
                            $mensaje = array("codigo"=>"401","mensaje"=>"no fue posible asignar el seguimiento");
                        }
    
                        if ($mensaje["codigo"] == "200"){
                            $mensaje = array("codigo"=>"200","mensaje"=>"seguimiento registrado correctamente");
                        }
                        $objEtapaPractica = null;
                        $objRespuesta = null;
                    }else{
                        $mensaje = array("codigo"=>"401","mensaje"=>"no fue posible asignar el seguimiento");
                    }
                }else {
                    $mensaje = array("codigo"=>"201","mensaje"=>"no fue posible asignar el seguimiento");//documento no se subio
                }
            }else {
                $mensaje = array("codigo"=>"401","mensaje"=>"no fue posible asignar el seguimiento");//no se encontro etapa practica
            }
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }

    public static function subirDocumento($documentoAlternativaPractica,$idAprendiz) {
        $mensaje = array();
        $ruta = null;
        try {
            $objConsulta = Conexion::conectar()->prepare("SELECT * FROM aprendiz INNER JOIN ficha ON ficha_idficha = idficha WHERE idaprendiz = :idaprendiz");
            $objConsulta -> bindParam(":idaprendiz", $idAprendiz);
            if ($objConsulta -> execute()) {
                $datosAprendiz = $objConsulta->fetch();
                $error = false;
                $ruta = "archivos/aprendices/".$datosAprendiz["numero_ficha"]."/".$datosAprendiz["documento"];

                if (!file_exists('../'.$ruta."/seguimiento")){
                    if(!mkdir('../'.$ruta."/seguimiento", 0777, true)){
                        $error = true;
                    }
                }
                if ($error != true) {
                    $splitFile = explode('.', $documentoAlternativaPractica['name']);
                    $nombreArchivo = uniqid('Seguimiento-') . '.' . end($splitFile);
                    $rutaReporte = "../".$ruta."/seguimiento"."/".$nombreArchivo;
                    $rutaReporteBD = $ruta."/seguimiento"."/".$nombreArchivo;
                    if (move_uploaded_file($documentoAlternativaPractica['tmp_name'],$rutaReporte)) {
                        $mensaje = array("codigo" => "200", "mensaje" => $rutaReporteBD);
                    }
                }else {
                    $mensaje = array("codigo"=>"202", "mensaje" => "error al crear el folder");
                }
            }
            $objConsulta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo" => "202", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function buscarEtapaPractica($idAprendiz) {
        $mensaje = array();
        try {
            $estado_etapa_practica = 1;
            // etapa_fragmentada puede ser NULL en registros recién creados.
            // En SQL: NULL <> 1 evalúa a NULL (no TRUE), por lo que se debe incluir IS NULL.
            $objConsulta = Conexion::conectar()->prepare("SELECT * FROM seguimiento WHERE aprendiz_idaprendiz = :idaprendiz AND estado_etapa_practica = :estado_etapa_practica AND (etapa_fragmentada IS NULL OR etapa_fragmentada <> 1) ORDER BY idseguimiento DESC LIMIT 1");
            $objConsulta -> bindParam(":idaprendiz", $idAprendiz);
            $objConsulta -> bindParam(":estado_etapa_practica", $estado_etapa_practica);
            if ($objConsulta -> execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => $objConsulta->fetch());
            }
            $objConsulta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo" => "202", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlEliminarVisita($idSeguimiento) {
        $mensaje = [];
        // Eliminar los archivos adjuntos de TODAS las visitas del seguimiento
        $visita = self::mdlVisita($idSeguimiento);
        if ($visita["codigo"] == "200") {
            try {
                // Eliminar TODOS los registros de visita asociados al seguimiento
                $objConsulta = Conexion::conectar()->prepare("DELETE FROM visita_seguimiento WHERE seguimiento_idseguimiento = :idseguimiento");
                $objConsulta->bindParam(":idseguimiento", $idSeguimiento);
                if ($objConsulta->execute()) {
                    $mensaje = ["codigo"=>"200", "mensaje"=>"Todas las visitas del seguimiento fueron eliminadas, junto con sus documentos adjuntos."];
                } else {
                    $mensaje = ["codigo"=>"401", "mensaje"=>"Error durante el proceso."];
                }
            } catch (Exception $e) {
                $mensaje = ["codigo"=>"401", "mensaje"=>$e->getMessage()];
            }
        } else {
            $mensaje = ["codigo"=>"401", "mensaje" =>"Error al eliminar los archivos adjuntos."];
        }
        return $mensaje;
    }

    public static function mdlVisita($idSeguimiento) {
        $mensaje = [];
        try {
            // Obtener TODAS las visitas del seguimiento sin filtrar por tipo
            $objConsulta = Conexion::conectar()->prepare("SELECT * FROM visita_seguimiento WHERE seguimiento_idseguimiento = :idseguimiento");
            $objConsulta->bindParam(":idseguimiento", $idSeguimiento);
            if ($objConsulta->execute()) {
                $dataVisitas = $objConsulta->fetchAll();
                if (!empty($dataVisitas)) {
                    // Eliminar el archivo adjunto de cada visita encontrada
                    foreach ($dataVisitas as $dataVisita) {
                        if (isset($dataVisita["url_documento"]) && !empty($dataVisita["url_documento"])) {
                            self::mdlEliminarArchivo($dataVisita["url_documento"]);
                        }
                    }
                }
                // Si no hay registros también es válido continuar
                $mensaje = ["codigo"=>"200", "mensaje" =>"archivos procesados correctamente"];
            }
            $objConsulta = null;
        } catch (Exception $e) {
            $mensaje = ["codigo"=>"401", "mensaje" =>$e->getMessage()];
        }
        return $mensaje;
    }

    public static function mdlEliminarArchivo($ruta){
        $mensaje = "200";
        // Validar que la ruta no sea vacía o nula para evitar operaciones en el directorio raíz
        if (empty($ruta)) {
            return "200";
        }
        if (file_exists('../'.$ruta)) {
            try {
                if (unlink('../'.$ruta)){
                    $mensaje = "200";
                }else{
                    $mensaje = "202";
                }
            } catch (Exception $e) {
                $mensaje = $e;
            }
        }
        return $mensaje;
    }

}