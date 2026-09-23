<?php
include_once "conexion.php";

class certificacionModelo
{

    public static function mdlInsertarCerticacion()
    {
        $mensaje = array();

        try {
            $idAprendiz = $_SESSION["id"];
            $tipoPrograma = $_SESSION["idtipo_programa"];

            // 1. Instanciar una única conexión
            $conexion = Conexion::conectar();

            // 2. Obtener la lista de certificaciones existentes para el aprendiz
            $queryCertificados = "SELECT titulo_documento FROM certificacion WHERE aprendiz_idaprendiz = :aprendiz_idaprendiz";
            $objRespuesta = $conexion->prepare($queryCertificados);
            $objRespuesta->bindParam(":aprendiz_idaprendiz", $idAprendiz);
            
            if (!$objRespuesta->execute()) {
                throw new Exception("Error al consultar las certificaciones actuales.");
            }
            
            $listaCertificados = $objRespuesta->fetchAll(PDO::FETCH_COLUMN, 0);

            // 3. Obtener el nombre del programa
            $queryPrograma = "SELECT nombre_programa FROM tipo_programa WHERE idtipo_programa = :idtipo_programa";
            $objRespuesta = $conexion->prepare($queryPrograma);
            $objRespuesta->bindParam(":idtipo_programa", $tipoPrograma);
            
            if (!$objRespuesta->execute()) {
                throw new Exception("Error al consultar el tipo de programa.");
            }

            $datosTipoPrograma = $objRespuesta->fetch();
            if (!$datosTipoPrograma) {
                // Manejo de error si el programa no existe
                throw new Exception("El tipo de programa registrado para el aprendiz no es válido.");
            }

            $nombrePrograma = $datosTipoPrograma["nombre_programa"];

            // 4. Definir lista de certificados requeridos base
            $listaCertificadosPrograma = array(
                "Certificado laboral",
                "Copia documento de identidad",
                "Evidencia destruccion carnet",
                "Certificado de validacion agencia publica de empleo"
            );
        
            if ($nombrePrograma == "Tecnólogo") {
                $listaCertificadosPrograma[] = "Certificado asistencia pruebas TyT";
            }

            // Filtrar los certificados que realmente necesitamos insertar (los que no tiene)
            // array_diff nos ahorra el condicional in_array del foreach
            $certificadosFaltantes = array_diff($listaCertificadosPrograma, $listaCertificados);

            // 5. Inserción optimizada de los certificados faltantes
            if (!empty($certificadosFaltantes)) {
                
                $conexion->beginTransaction();

                // Preparamos el INSERT UNA SOLA VEZ fuera del bucle (Optimización de rendimiento altísima)
                $sqlInsert = "INSERT INTO certificacion (titulo_documento, url_documento, aprendiz_idaprendiz) VALUES (:titulo_documento, :url_documento, :aprendiz_idaprendiz)";
                $objInsert = $conexion->prepare($sqlInsert);
                
                // Mapeamos el aprendiz (es el mismo para todos) y empujamos la URL vacia
                $urlVacia = "";
                $objInsert->bindParam(":url_documento", $urlVacia);
                $objInsert->bindParam(":aprendiz_idaprendiz", $idAprendiz);

                // Pasamos el título por referencia (este valor cambia por cada iteración del bucle)
                $objInsert->bindParam(":titulo_documento", $tituloActual);

                foreach ($certificadosFaltantes as $certificado) {
                    $tituloActual = $certificado; // Actualizamos la referencia para el bindParam
                    
                    if (!$objInsert->execute()) {
                        throw new Exception("Error al instertar el certificado: " . $certificado);
                    }
                }

                $conexion->commit();
            }

            $mensaje = array("codigo" => "200", "mensaje" => "Certificaciones validadas y creadas correctamente.");

        } catch (Exception $e) {
            if (isset($conexion) && $conexion->inTransaction()) {
                $conexion->rollBack();
            }
            $mensaje = array("codigo" => "500", "mensaje" => "Error al procesar la solicitud: " . $e->getMessage());
        }
    
        return $mensaje;
    }
    
    public static function mdlInsertarNuevaCerticacion($titulo_documento, $url_documento, $idAprendiz)
{
    try {
        $documentoExistente = self::mdlSeleccionarDocumento($titulo_documento, $idAprendiz);

        if ($documentoExistente['codigo'] == '200') {
            $documentoUrl = $documentoExistente["mensaje"]["url_documento"];
            if ($documentoUrl != "" || $documentoUrl != null) {
                self::mdlEliminarArchivoDocumento($documentoExistente["mensaje"]["url_documento"]);
            }
            $sql = "UPDATE certificacion SET url_documento = :url_documento,estado_archivo = NULL WHERE titulo_documento = :titulo_documento AND aprendiz_idaprendiz = :aprendiz_idaprendiz";
            $objRespuesta = Conexion::conectar()->prepare($sql);
            $objRespuesta->bindParam(":titulo_documento", $titulo_documento);
            $objRespuesta->bindParam(":url_documento", $url_documento);
            $objRespuesta->bindParam(":aprendiz_idaprendiz", $idAprendiz);

            if ($objRespuesta->execute()){
                $objRespuesta = null;
                $estado = 9; // por certificar
                $objRespuesta = Conexion::conectar()->prepare("UPDATE aprendiz SET estado_aprendiz_idestado_aprendiz=:estado WHERE idaprendiz=:idaprendiz");
                $objRespuesta->bindParam(":estado",$estado);
                $objRespuesta->bindParam(":idaprendiz",$idAprendiz);
                if($objRespuesta->execute()){
                    $objRespuesta = null;
                    return ["codigo" => "200", "mensaje" => "Certificación actualizada correctamente"];
                }else{
                    return ["codigo" => "401", "mensaje" => "Error al cambiar el estado del aprendiz por favor comuniquese con el administrador"];
                }
            }else{
                return ["codigo" => "401", "mensaje" => "Error al actualizar el archivo"];
            }
           
        } else {
            $sql = "INSERT INTO certificacion (titulo_documento, url_documento, aprendiz_idaprendiz) VALUES (:titulo_documento, :url_documento, :aprendiz_idaprendiz)";
            $objRespuesta = Conexion::conectar()->prepare($sql);
            $objRespuesta->bindParam(":titulo_documento", $titulo_documento);
            $objRespuesta->bindParam(":url_documento", $url_documento);
            $objRespuesta->bindParam(":aprendiz_idaprendiz", $idAprendiz);
            $objRespuesta->execute();

            return ["codigo" => "200", "mensaje" => "Certificación insertada correctamente"];
        }
    } catch (Exception $e) {
        return ["codigo" => "500", "mensaje" => "Error al procesar la solicitud: " . $e->getMessage()];
    }
}

public static function mdlSeleccionarDocumento($titulo_documento, $idAprendiz)
{
    try {
        $objRespuesta = Conexion::conectar()->prepare(
            "SELECT * FROM certificacion WHERE titulo_documento=:titulo_documento AND aprendiz_idaprendiz=:aprendiz_idaprendiz"
        );
        $objRespuesta->bindParam(":titulo_documento", $titulo_documento);
        $objRespuesta->bindParam(":aprendiz_idaprendiz", $idAprendiz);
        $objRespuesta->execute();
        $certificacion = $objRespuesta->fetch();

        if ($certificacion != null) {
            return ["codigo" => "200", "mensaje" => $certificacion];
        } else {
            return ["codigo" => "404", "mensaje" => "El certificado no existe"];
        }
    } catch (Exception $e) {
        return ["codigo" => "500", "mensaje" => $e->getMessage()];
    }
}
    
public static function mdlListarCertificaciones($idAprendiz)
{
        self::mdlInsertarCerticacion();
    try {
        $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM certificacion WHERE aprendiz_idaprendiz = :aprendiz_idaprendiz");
        $objRespuesta->bindParam(":aprendiz_idaprendiz", $idAprendiz);
        $objRespuesta->execute();
        $listaCertificados = $objRespuesta->fetchAll();
        $objRespuesta = null;

        if (count($listaCertificados) > 0) {
            return ["codigo" => "200", "mensaje" => $listaCertificados];
        } else {
            return ["codigo" => "404", "mensaje" => "No se encontraron certificaciones para este aprendiz"];
        }
    } catch (Exception $e) {
        return ["codigo" => "500", "mensaje" => "Error al obtener la lista de certificaciones: " . $e->getMessage()];
    }
}


    public static function mdlEliminarRegistro($idcertificacion)
    {
        try {

            $documento = self::mdlSeleccionarDocumentoCertificacion($idcertificacion);

            if ($documento['codigo'] == '200') {
                $documentoUrl = $documento["mensaje"]["url_documento"];
                if ($documentoUrl != "" || $documentoUrl != null) {
                    self::mdlEliminarArchivoDocumento($documento["mensaje"]["url_documento"]);
                }
            }
            $objRespuesta = Conexion::conectar()->prepare("UPDATE certificacion SET url_documento = NULL , estado_archivo = NULL WHERE idcertificacion = :id_certificacion");
            $objRespuesta->bindParam(":id_certificacion", $idcertificacion);
            $objRespuesta->execute();
            $numFilasAfectadas = $objRespuesta->rowCount();
            $objRespuesta = null;
            if ($numFilasAfectadas > 0) {
                $objRespuesta = Conexion::conectar()->prepare("SELECT aprendiz_idaprendiz FROM certificacion WHERE idcertificacion=:idcertificacion");
                $objRespuesta->bindParam(":idcertificacion",$idcertificacion);
                $objRespuesta->execute();
                $objAprendiz = $objRespuesta->fetch();
                $objRespuesta = null;
                if ($objAprendiz != null){
                    $idAprendiz = $objAprendiz["aprendiz_idaprendiz"];
                    $estado = 9; // por certificar
                    $objRespuesta = Conexion::conectar()->prepare("UPDATE aprendiz SET estado_aprendiz_idestado_aprendiz=:estado WHERE idaprendiz=:idaprendiz");
                    $objRespuesta->bindParam(":estado",$estado);
                    $objRespuesta->bindParam(":idaprendiz",$idAprendiz);
                    if($objRespuesta->execute()){
                        $objRespuesta = null;
                        return ["codigo" => "200", "mensaje" => "URL del documento eliminada correctamente"];
                    }else{
                        return ["codigo" => "401", "mensaje" => "Error al cambiar el estado del aprendiz por favor comuniquese con el administrador"];
                    }
                }
            } else {
                return ["codigo" => "401", "mensaje" => "No se encontró la URL del documento para eliminar"];
            }
        } catch (Exception $e) {
            return ["codigo" => "500", "mensaje" => $e->getMessage()];
        }
    }
    
    public static function mdlCrearFolderCertificacion($fichaAprendiz, $documentoAprendiz)
    {
        try {
            $ruta = "archivos/aprendices/{$fichaAprendiz}/{$documentoAprendiz}/certificacion/";

            if (!file_exists("../{$ruta}")) {
                if (!mkdir("../{$ruta}", 0777, true)) {
                    return ["codigo" => "401", "mensaje" => "No fue posible crear el directorio para la certificación"];
                }
            }

            return ["codigo" => "200", "mensaje" => "Directorio creado correctamente", "ruta" => $ruta];
        } catch (Exception $e) {
            return ["codigo" => "500", "mensaje" => "Error al crear el directorio: " . $e->getMessage()];
        }
    }

    public static function mdlSeleccionarDocumentoCertificacion($idcertificacion)
    {
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM certificacion WHERE idcertificacion = :idcertificacion");
            $objRespuesta->bindParam(":idcertificacion", $idcertificacion);
            $objRespuesta->execute();
            $certificacion = $objRespuesta->fetch();
            if ($certificacion != null) {
                return ["codigo" => "200", "mensaje" => $certificacion];
            } else {
                return ["codigo" => "404", "mensaje" => "El certificado no existe"];
            }
        } catch (Exception $e) {
            return ["codigo" => "500", "mensaje" => $e->getMessage()];
        }
    }
    
    public static function mdlSeleccionarDocumentoPorTitulo($titulo_documento, $idAprendiz)
    {
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM certificacion WHERE titulo_documento=:titulo_documento AND aprendiz_idaprendiz=:aprendiz_idaprendiz");
            $objRespuesta->bindParam(":titulo_documento", $titulo_documento);
            $objRespuesta->bindParam(":aprendiz_idaprendiz", $idAprendiz);
            $objRespuesta->execute();
            $documento = $objRespuesta->fetch();
    
            return $documento;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public static function mdlEliminarArchivoDocumento($ruta)
    {
        try {
            if (file_exists("../{$ruta}")) {
                if (unlink("../{$ruta}")) {
                    return ["codigo" => "200", "mensaje" => "Archivo eliminado correctamente"];
                } else {
                    return ["codigo" => "401", "mensaje" => "No fue posible eliminar el archivo"];
                }
            } else {
                return ["codigo" => "401", "mensaje" => "El archivo no existe"];
            }
        } catch (Exception $e) {
            return ["codigo" => "500", "mensaje" => $e->getMessage()];
        }
    }
}
