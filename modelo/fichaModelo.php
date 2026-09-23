<?php
include_once "conexion.php";


class fichaModelo{

    public static function mdlcargarSelectEstadoFicha(){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM estado_ficha");
            $objRespuesta->execute();
            $mensaje = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlAgregarFicha($numeroFicha,$caracterizacion,$fecha_inicio,$fecha_fin_lectiva,$fecha_fin_practica,$estadoFicha,$tipoPrograma,$lineaRedTecnologica){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("INSERT INTO ficha(numero_ficha,caracterizacion, fecha_inicio, fecha_fin_lectiva, fecha_fin_practica, estado_ficha_idestado_ficha, tipo_programa_idtipo_programa, red_tecnologica_idred_tecnologica)VALUES(:numeroFicha,:caracterizacion,:fecha_inicio,:fecha_fin_lectiva,:fecha_fin_practica,:estadoFicha,:tipoPrograma,:lineaRedTecnologica)");
            $objRespuesta->bindparam(":numeroFicha",$numeroFicha);
            $objRespuesta->bindparam(":caracterizacion",$caracterizacion);
            $objRespuesta->bindparam(":fecha_inicio",$fecha_inicio);
            $objRespuesta->bindparam(":fecha_fin_lectiva",$fecha_fin_lectiva);
            $objRespuesta->bindparam(":fecha_fin_practica",$fecha_fin_practica);
            $objRespuesta->bindparam(":estadoFicha",$estadoFicha);
            $objRespuesta->bindparam(":tipoPrograma",$tipoPrograma);
            $objRespuesta->bindparam(":lineaRedTecnologica",$lineaRedTecnologica);
            if ($objRespuesta->execute()) {
                $objRespuesta = null;
                $fecha = date("Y-m-d H:i:s");
                $responsable = $_SESSION["nombreCompleto"];
                $proceso = "Creo ficha";
                $descripcion = "Se creo la ficha ".$numeroFicha." - ".$caracterizacion;
                $sql = "INSERT INTO procesos_fichas(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                $objRespuesta = conexion::conectar()->prepare($sql);
                $objRespuesta->bindparam(":fecha",$fecha);
                $objRespuesta->bindparam(":responsable",$responsable);
                $objRespuesta->bindparam(":proceso",$proceso);
                $objRespuesta->bindparam(":descripcion",$descripcion);
                if ($objRespuesta->execute()) {
                    $objRespuesta = null;
                    $mensaje = array("codigo"=>"200","mensaje"=>"Ficha registrada correctamente");
                }else{
                    $mensaje = array("codigo"=>"425","mensaje"=>"hubo un error al registar la ficha");
                }
            }else{
                $mensaje = array("codigo"=>"425","mensaje"=>"hubo un error al registar la ficha");
            }
            
        } catch (Exception $e) {
            $mensaje = array("mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlcargarTablaFichas(){
        $mensaje = array();
        try {
            $sql = "SELECT * FROM ficha INNER JOIN estado_ficha ON ficha.estado_ficha_idestado_ficha = estado_ficha.idestado_ficha INNER JOIN tipo_programa ON ficha.tipo_programa_idtipo_programa = tipo_programa.idtipo_programa INNER JOIN red_tecnologica ON ficha.red_tecnologica_idred_tecnologica = red_tecnologica.idred_tecnologica INNER JOIN linea_tecnologica ON red_tecnologica.linea_tecnologica_idlinea_tecnologica = linea_tecnologica.idlinea_tecnologica";
            $objRespuesta = Conexion::conectar()->prepare($sql);
            $objRespuesta->execute();
            $mensaje = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlEliminarFicha($idFicha,$ficha){
        $mensaje = array();
        try {
            $conexion = Conexion::conectar();

            // 1. Verificar si la ficha tiene aprendices asociados
            $sqlAprendices = "SELECT COUNT(*) as total FROM aprendiz WHERE ficha_idficha = :idFicha";
            $objAprendices = $conexion->prepare($sqlAprendices);
            $objAprendices->bindparam(":idFicha", $idFicha);
            $objAprendices->execute();
            $resultado = $objAprendices->fetch();
            
            if ($resultado && $resultado['total'] > 0) {
                return array("codigo"=>"401", "mensaje"=>"No es posible eliminar la ficha porque tiene aprendices asignados.");
            }

            // 2. Iniciar transacción
            $conexion->beginTransaction();

            // 3. Eliminar la ficha
            $sqlFicha = "DELETE FROM ficha WHERE idficha = :idFicha";
            $objFicha = $conexion->prepare($sqlFicha);
            $objFicha->bindparam(":idFicha", $idFicha);
            
            if (!$objFicha->execute()) {
                throw new Exception("No es posible eliminar la ficha porque se encuentra asociada a otros registros.");
            }

            // 4. Insertar log de procesos
            $fecha = date("Y-m-d H:i:s");
            $responsable = $_SESSION["nombreCompleto"];
            $proceso = "Elimino ficha";
            $descripcion = "Se elimino la ficha " . $ficha;
            
            $sqlLog = "INSERT INTO procesos_fichas(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
            $objLog = $conexion->prepare($sqlLog);
            $objLog->bindparam(":fecha", $fecha);
            $objLog->bindparam(":responsable", $responsable);
            $objLog->bindparam(":proceso", $proceso);
            $objLog->bindparam(":descripcion", $descripcion);
            
            if (!$objLog->execute()) {
                throw new Exception("Hubo un error al registrar el proceso de eliminación.");
            }

            // 5. Confirmar transacción
            $conexion->commit();
            $mensaje = array("codigo"=>"200", "mensaje"=>"Registro eliminado correctamente");

        } catch (Exception $e) {
            if (isset($conexion) && $conexion->inTransaction()) {
                $conexion->rollBack();
            }
            $errorMsg = $e->getMessage();
            if (strpos($errorMsg, 'SQLSTATE[23000]') !== false || strpos($errorMsg, '1451') !== false) {
                $errorMsg = "No es posible eliminar la ficha porque está asignada a otros registros u otro módulo.";
            }
            $mensaje = array("codigo"=>"401", "mensaje"=>$errorMsg);
        }
        return $mensaje;
    }

    public static function mdlEditarFicha($idFicha,$numeroFicha,$caracterizacion,$fecha_inicio,$fecha_fin_lectiva,$fecha_fin_practica,$estadoFicha,$tipoPrograma,$lineaRedTecnologica,$fichaCompleta){
        $mensaje = array();
        try {
            $sql = "SELECT * FROM ficha INNER JOIN estado_ficha ON ficha.estado_ficha_idestado_ficha = estado_ficha.idestado_ficha INNER JOIN tipo_programa ON ficha.tipo_programa_idtipo_programa = tipo_programa.idtipo_programa INNER JOIN red_tecnologica ON ficha.red_tecnologica_idred_tecnologica = red_tecnologica.idred_tecnologica INNER JOIN linea_tecnologica ON red_tecnologica.linea_tecnologica_idlinea_tecnologica = linea_tecnologica.idlinea_tecnologica WHERE idficha = :ficha";
            $objRespuesta = conexion::conectar()->prepare($sql);
            $objRespuesta -> bindparam(":ficha",$idFicha);
            if ($objRespuesta->execute()) {
                $datosAnterioresFicha = $objRespuesta->fetch();
                $objRespuesta = null;
                $objRespuesta = Conexion::conectar()->prepare("UPDATE ficha SET numero_ficha=:numeroFicha,caracterizacion=:caracterizacion,fecha_inicio=:fecha_inicio,fecha_fin_lectiva=:fecha_fin_lectiva,fecha_fin_practica=:fecha_fin_practica,estado_ficha_idestado_ficha=:estadoFicha, tipo_programa_idtipo_programa = :tipoPrograma, red_tecnologica_idred_tecnologica = :lineaRedTecnologica WHERE idficha=:idFicha");
                $objRespuesta->bindparam(":numeroFicha",$numeroFicha);
                $objRespuesta->bindparam(":caracterizacion",$caracterizacion);
                $objRespuesta->bindparam(":fecha_inicio",$fecha_inicio);
                $objRespuesta->bindparam(":fecha_fin_lectiva",$fecha_fin_lectiva);
                $objRespuesta->bindparam(":fecha_fin_practica",$fecha_fin_practica);
                $objRespuesta->bindparam(":estadoFicha",$estadoFicha);
                $objRespuesta->bindparam(":idFicha",$idFicha);
                $objRespuesta->bindparam(":tipoPrograma",$tipoPrograma);
                $objRespuesta->bindparam(":lineaRedTecnologica",$lineaRedTecnologica);
                if ($objRespuesta->execute()) {
                    $objRespuesta = null;
                    $fecha = date("Y-m-d H:i:s");
                    $responsable = $_SESSION["nombreCompleto"];
                    $proceso = "Edito ficha";
                    
                    $cambios = '';
                    if ($datosAnterioresFicha["numero_ficha"] != $numeroFicha) {
                        $cambios .= "Antes ".$datosAnterioresFicha["numero_ficha"].", Ahora ".$numeroFicha.".";
                    }
                    if ($datosAnterioresFicha["caracterizacion"] != $caracterizacion) {
                        $cambios .= "Antes ".$datosAnterioresFicha["caracterizacion"].", Ahora ".$caracterizacion.".";
                    }
                    if ($datosAnterioresFicha["fecha_inicio"] != $fecha_inicio) {
                        $cambios .= "Antes ".$datosAnterioresFicha["fecha_inicio"].", Ahora ".$fecha_inicio.".";
                    }
                    if ($datosAnterioresFicha["fecha_fin_lectiva"] != $fecha_fin_lectiva) {
                        $cambios .= "Antes ".$datosAnterioresFicha["fecha_fin_lectiva"].", Ahora ".$fecha_fin_lectiva.".";
                    }
                    if ($datosAnterioresFicha["fecha_fin_practica"] != $fecha_fin_practica) {
                        $cambios .= "Antes ".$datosAnterioresFicha["fecha_fin_practica"].", Ahora ".$fecha_fin_practica.".";
                    }
                    if ($datosAnterioresFicha["estado_ficha_idestado_ficha"] != $estadoFicha) {
                        $cambios .= "Antes ".$datosAnterioresFicha["nombre_estado_ficha"].". ";
                    }
                    if ($datosAnterioresFicha["tipo_programa_idtipo_programa"] != $tipoPrograma) {
                        $cambios .= "Antes ".$datosAnterioresFicha["nombre_tipo_programa"].". ";
                    }
                    if ($datosAnterioresFicha["red_tecnologica_idred_tecnologica"] != $lineaRedTecnologica) {
                        $cambios .= "Antes ".$datosAnterioresFicha["nombre_linea_tecnologica"]." - ".$datosAnterioresFicha["nombre_red_tecnologica"]." .";
                    }
                    if ($cambios == '') {
                        $cambiosTotales = 'No hay cambios';
                    }else{
                        $cambiosTotales = "cambios: ".$cambios;;
                    }


                    $descripcion = "Se edito la ficha ".$fichaCompleta.". ".$cambiosTotales;
                    $sql = "INSERT INTO procesos_fichas(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                    $objRespuesta = conexion::conectar()->prepare($sql);
                    $objRespuesta->bindparam(":fecha",$fecha);
                    $objRespuesta->bindparam(":responsable",$responsable);
                    $objRespuesta->bindparam(":proceso",$proceso);
                    $objRespuesta->bindparam(":descripcion",$descripcion);
                    if ($objRespuesta->execute()) {
                        $objRespuesta = null;
                        $mensaje = array("codigo"=>"200","mensaje"=>"Ficha Editada correctamente");
                    }else{
                        $mensaje = array("codigo"=>"425","mensaje"=>"hubo un error al editar la ficha");
                    }
                }else{
                    $mensaje = array("codigo"=>"425","mensaje"=>"hubo un error al editar la ficha");
                }
            }else{
                $mensaje = array("codigo"=>"425","mensaje"=>"hubo un error al editar la ficha");
            }
            
            
        } catch (Exception $e) {
            $mensaje = array("mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlCargarSelectFichas () {
        $mensaje = [];
        try {
            $objRespuesta = conexion::conectar()->prepare("SELECT * FROM ficha F, estado_ficha E  WHERE F.estado_ficha_idestado_ficha=E.idestado_ficha");
            $objRespuesta->execute();
            $mensaje = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
        }
        return $mensaje;
    }


    public static function mdlListarTablaFichaSeleccionada($idFicha){
        $mensaje = array();
        try {
            $objRespuesta = conexion::conectar()->prepare("SELECT * FROM aprendiz INNER JOIN ficha ON ficha.idficha = aprendiz.ficha_idficha INNER JOIN estado_aprendiz ON aprendiz.estado_aprendiz_idestado_aprendiz = estado_aprendiz.idestado_aprendiz INNER JOIN tipo_documento ON aprendiz.tipo_documento_idtipo_documento = tipo_documento.idtipo_documento WHERE aprendiz.ficha_idficha=:ficha_idficha");
            
            $objRespuesta->bindParam(":ficha_idficha",$idFicha);
            $objRespuesta->execute();
            $mensaje = array("codigo"=>"200","mensaje"=>$objRespuesta->fetchAll());
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"201","mensaje"=>"error al cargar datos de aprendices");
        }

        return $mensaje;
    }


    public static function mdlListarTablaFichaEtapaPractica($idFicha){
        $mensaje = array();
        $estadoAprendiz = 2; // formacion
        $estadoAprendizDos = 9; //en proceso de certificacion
        $etapa_practica = "2"; //ya ha sido registrado
        try {
            $objRespuesta = conexion::conectar()->prepare("SELECT * FROM aprendiz INNER JOIN ficha ON ficha.idficha = aprendiz.ficha_idficha INNER JOIN estado_aprendiz ON aprendiz.estado_aprendiz_idestado_aprendiz = estado_aprendiz.idestado_aprendiz INNER JOIN tipo_documento ON aprendiz.tipo_documento_idtipo_documento = tipo_documento.idtipo_documento WHERE aprendiz.ficha_idficha=:ficha_idficha AND (aprendiz.estado_aprendiz_idestado_aprendiz = :estado_aprendiz_idestado_aprendiz OR aprendiz.estado_aprendiz_idestado_aprendiz = :estadoDos) AND aprendiz.etapa_practica < :etapa_practica");

            $objRespuesta->bindParam(":ficha_idficha",$idFicha);
            $objRespuesta->bindParam(":estado_aprendiz_idestado_aprendiz",$estadoAprendiz);
            $objRespuesta->bindParam(":estadoDos",$estadoAprendizDos);
            $objRespuesta->bindParam(":etapa_practica",$etapa_practica);

            $objRespuesta->execute();
            $mensaje = array("codigo"=>"200","mensaje"=>$objRespuesta->fetchAll());
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"201","mensaje"=>"error al cargar datos de aprendices");
        }

        return $mensaje;
    }

    //modulo actualizado

    public static function mdlCargarTipoPrograma () {
        $datos = null;
        try {
            $objRespuesta = conexion::conectar()->prepare("SELECT * FROM tipo_programa");
            $objRespuesta->execute();
            $datos = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $datos = $e -> getMessage ();
        }

        return $datos;
    }

    public static function mdlSubirArchivoFormato165($archivo, $idficha) {
        $mensaje = array();
        try {
            // Obtener datos de la ficha
            $objRespuesta = Conexion::conectar()->prepare("SELECT numero_ficha FROM ficha WHERE idficha = :idficha");
            $objRespuesta->bindparam(":idficha", $idficha);
            $objRespuesta->execute();
            $ficha = $objRespuesta->fetch();
            $objRespuesta = null;

            if (!$ficha) {
                return array("codigo" => "401", "mensaje" => "Ficha no encontrada");
            }

            // Crear directorio si no existe (siguiendo la estructura de aprendices)
            $directorio = "../archivos/aprendices/" . $ficha['numero_ficha'];
            if (!file_exists($directorio)) {
                mkdir($directorio, 0777, true);
            }

            // Nombre del archivo
            $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
            $nombreArchivo = "Formato_165_" . $ficha['numero_ficha'] . "." . $extension;
            $rutaCompleta = $directorio . "/" . $nombreArchivo;
            $rutaRelativa = "archivos/aprendices/" . $ficha['numero_ficha'] . "/" . $nombreArchivo;

            // Validar archivo
            if (!in_array($extension, ['pdf', 'xls', 'xlsx'])) {
                return array("codigo" => "401", "mensaje" => "Tipo de archivo no permitido. Solo PDF y Excel.");
            }

            if ($archivo['size'] > 10 * 1024 * 1024) { // 10MB
                return array("codigo" => "401", "mensaje" => "Archivo demasiado grande. Máximo 10MB.");
            }

            // Eliminar archivo anterior si existe
            $archivosExistentes = glob($directorio . "/Formato_165_" . $ficha['numero_ficha'] . ".*");
            foreach ($archivosExistentes as $archivoExistente) {
                unlink($archivoExistente);
            }

            // Subir archivo
            if (move_uploaded_file($archivo['tmp_name'], $rutaCompleta)) {
                // Actualizar BD
                $objRespuesta = Conexion::conectar()->prepare("UPDATE ficha SET url_archivo_formato_165 = :url WHERE idficha = :idficha");
                $objRespuesta->bindparam(":url", $rutaRelativa);
                $objRespuesta->bindparam(":idficha", $idficha);
                if ($objRespuesta->execute()) {
                    $mensaje = array("codigo" => "200", "mensaje" => "Archivo subido correctamente", "ruta" => $rutaRelativa);
                } else {
                    unlink($rutaCompleta);
                    $mensaje = array("codigo" => "401", "mensaje" => "Error al actualizar la base de datos");
                }
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al subir el archivo");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlObtenerArchivoFormato165($idficha) {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT numero_ficha, url_archivo_formato_165 FROM ficha WHERE idficha = :idficha");
            $objRespuesta->bindparam(":idficha", $idficha);
            $objRespuesta->execute();
            $ficha = $objRespuesta->fetch();
            $objRespuesta = null;

            if ($ficha && $ficha['url_archivo_formato_165']) {
                $rutaFisica = "../" . $ficha['url_archivo_formato_165'];
                if (file_exists($rutaFisica)) {
                    $mensaje = array("codigo" => "200", "mensaje" => $ficha['url_archivo_formato_165']);
                } else {
                    $mensaje = array("codigo" => "202", "mensaje" => "Archivo no encontrado en el servidor");
                }
            } else {
                $mensaje = array("codigo" => "202", "mensaje" => "No hay archivo registrado");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

}