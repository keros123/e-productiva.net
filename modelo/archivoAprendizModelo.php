<?php
include_once "conexion.php";

class ArchivoAprendizModelo
{

    public static function mdlSubirArchivos($archivo, $usuarioId)
    {
        if (!$archivo || !isset($archivo['tmp_name']) || empty($archivo['tmp_name'])) {
            return array("codigo" => "401", "mensaje" => "No se recibió ningún archivo");
        }

        // Validar archivo
        $validacion = self::mdlValidarArchivo($archivo);

        if ($validacion["codigo"] == "200") {
            $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
            $documentoAprendiz = isset($_SESSION["documento"]) ? preg_replace('/\D/', '', $_SESSION["documento"]) : 'doc';
            $nombreArchivo = "GFPI-F-165_{$documentoAprendiz}." . $extension;
            $_FILES['archivo'] = $archivo;

            // Llamar al método existente
            return self::mdlSubirArchivo(
                $archivo['name'],
                $nombreArchivo,
                '',
                $archivo['type'],
                $archivo['size'],
                $usuarioId
            );
        } else {
            return $validacion;
        }
    }

    public static function mdlSubirArchivo($nombreOriginal, $nombreArchivo, $rutaArchivo, $tipoArchivo, $tamañoArchivo, $usuarioId = 1)
    {
        $mensaje = array();
        try {
            // Crear directorio si no existe
            $objRespuestaFolder = self::mdlCrearFolderArchivos($usuarioId);

            if ($objRespuestaFolder["codigo"] == "200") {
                // Ruta final
                $rutaCompleta = $objRespuestaFolder["ruta"] . $nombreArchivo;
                $rutaFinal    = "../" . $rutaCompleta;

                // Si ya tiene archivo, eliminar el anterior (si existiera)
                $archivoExistente = self::mdlObtenerArchivoPorUsuario($usuarioId);
                if ($archivoExistente["codigo"] == "200" && !empty($archivoExistente["mensaje"]["ruta_archivo"])) {
                    self::mdlEliminarArchivo($archivoExistente["mensaje"]["ruta_archivo"]);
                }

                if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaFinal)) {
                    $metadatos = array(
                        "nombre_original" => $nombreOriginal,
                        "nombre_archivo"  => $nombreArchivo,
                        "ruta_archivo"    => $rutaCompleta,
                        "tipo_archivo"    => $tipoArchivo,
                        "tamaño_archivo"  => $tamañoArchivo,
                        "usuario_id"      => $usuarioId,
                        "fecha_subida"    => date('Y-m-d H:i:s')
                    );


                    $archivoMetadatos = "../" . $objRespuestaFolder["ruta"] . "metadata.json";
                    if (file_put_contents($archivoMetadatos, json_encode($metadatos))) {

                        try {
                            $cn = Conexion::conectar();
                            if (method_exists($cn, 'setAttribute')) {
                                $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            }

                            $docSesion = isset($_SESSION["documento"]) ? $_SESSION["documento"] : null;

                            $sqlFind = "SELECT idaprendiz, url_archivoFormato
                            FROM aprendiz
                            WHERE idaprendiz = :id OR documento = :id";
                            if ($docSesion) {
                                $sqlFind .= " OR documento = :doc";
                            }
                            $sqlFind .= " LIMIT 1";

                            $find = $cn->prepare($sqlFind);
                            $find->bindParam(":id", $usuarioId);
                            if ($docSesion) $find->bindParam(":doc", $docSesion);
                            $find->execute();
                            $row = $find->fetch(PDO::FETCH_ASSOC);

                            if (!$row || !isset($row["idaprendiz"])) {
                                @unlink($rutaFinal);
                                @unlink($archivoMetadatos);
                                $mensaje = array(
                                    "codigo" => "401",
                                    "mensaje" => "No se pudo actualizar url_archivoFormato: verifique que usuarioId corresponda a idaprendiz o documento."
                                );
                            } else {
                                $realId = $row["idaprendiz"];
                                $up = $cn->prepare("UPDATE aprendiz SET url_archivoFormato = :url WHERE idaprendiz = :realId");
                                $up->bindParam(":url", $rutaCompleta);
                                $up->bindParam(":realId", $realId);
                                $up->execute();

                                $chk = $cn->prepare("SELECT url_archivoFormato FROM aprendiz WHERE idaprendiz = :realId LIMIT 1");
                                $chk->bindParam(":realId", $realId);
                                $chk->execute();
                                $grabado = $chk->fetchColumn();

                                if ($grabado === $rutaCompleta) {
                                    $mensaje = array("codigo" => "200", "mensaje" => "Archivo subido correctamente", "ruta" => $rutaCompleta);
                                } else {
                                    @unlink($rutaFinal);
                                    @unlink($archivoMetadatos);
                                    $mensaje = array(
                                        "codigo" => "401",
                                        "mensaje" => "No se pudo actualizar url_archivoFormato (verificación fallida)."
                                    );
                                }
                            }
                        } catch (Exception $e) {
                            @unlink($rutaFinal);
                            @unlink($archivoMetadatos);
                            $mensaje = array("codigo" => "401", "mensaje" => "Error BD: " . $e->getMessage());
                        }
                    } else {
                        @unlink($rutaFinal);
                        $mensaje = array("codigo" => "401", "mensaje" => "Error al guardar metadatos del archivo");
                    }
                } else {
                    $mensaje = array("codigo" => "401", "mensaje" => "Error al mover el archivo");
                }
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => $objRespuestaFolder["mensaje"]);
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlObtenerArchivoPorUsuario($usuarioId)
    {
        $mensaje = array();
        try {
            $objRespuestaFolder = self::mdlCrearFolderArchivos($usuarioId);

            if ($objRespuestaFolder["codigo"] == "200") {
                $archivoMetadatos = "../" . $objRespuestaFolder["ruta"] . "metadata.json";

                if (file_exists($archivoMetadatos)) {
                    $contenido  = file_get_contents($archivoMetadatos);
                    $metadatos  = json_decode($contenido, true);

                    if ($metadatos && isset($metadatos["usuario_id"]) && $metadatos["usuario_id"] == $usuarioId) {
                        $rutaArchivoFisico = "../" . $metadatos["ruta_archivo"];
                        if (file_exists($rutaArchivoFisico)) {
                            $mensaje = array("codigo" => "200", "mensaje" => $metadatos);
                        } else {
                            @unlink($archivoMetadatos);
                            $mensaje = array("codigo" => "202", "mensaje" => "No hay archivos registrados");
                        }
                    } else {
                        $mensaje = array("codigo" => "202", "mensaje" => "No hay archivos registrados");
                    }
                } else {
                    $mensaje = array("codigo" => "202", "mensaje" => "No hay archivos registrados");
                }
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => $objRespuestaFolder["mensaje"]);
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    // Carpeta del aprendiz si no existe
    public static function mdlCrearFolderArchivos($usuarioId)
    {
        $mensaje = array();
        $error   = false;

        $fichaAprendiz     = isset($_SESSION["ficha"]) ? $_SESSION["ficha"] : null;
        $documentoAprendiz = isset($_SESSION["documento"]) ? $_SESSION["documento"] : null;

        if (!$fichaAprendiz || !$documentoAprendiz) {
            return array("codigo" => "401", "mensaje" => "No se encontraron datos de aprendiz en la sesión (ficha/documento).");
        }

        // ../archivos
        if (!file_exists('../archivos')) {
            if (!mkdir('../archivos', 0777, true)) {
                $error = true;
            }
        }

        if (!$error) {
            $baseAprendices = '../archivos/aprendices';
            if (!file_exists($baseAprendices)) {
                if (!mkdir($baseAprendices, 0777, true)) {
                    $error = true;
                }
            }

            if (!$error) {
                $dirFicha = $baseAprendices . '/' . $fichaAprendiz;
                if (!file_exists($dirFicha)) {
                    if (!mkdir($dirFicha, 0777, true)) {
                        $error = true;
                    }
                }

                if (!$error) {
                    $dirAprendiz = $dirFicha . '/' . $documentoAprendiz;
                    if (!file_exists($dirAprendiz)) {
                        if (!mkdir($dirAprendiz, 0777, true)) {
                            $error = true;
                        }
                    }

                    if (!$error) {
                        $ruta = 'archivos/aprendices/' . $fichaAprendiz . '/' . $documentoAprendiz . '/';
                        $mensaje = array("codigo" => "200", "mensaje" => "Directorio creado con éxito", "ruta" => $ruta);
                    } else {
                        $mensaje = array("codigo" => "401", "mensaje" => "No fue posible crear el directorio del aprendiz con documento " . $documentoAprendiz);
                    }
                } else {
                    $mensaje = array("codigo" => "401", "mensaje" => "No fue posible crear el directorio para la ficha " . $fichaAprendiz);
                }
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "No fue posible crear el directorio principal de aprendices");
            }
        } else {
            $mensaje = array("codigo" => "401", "mensaje" => "No fue posible crear el directorio principal");
        }

        return $mensaje;
    }

    public static function mdlEliminarArchivo($ruta)
    {
        if (file_exists('../' . $ruta)) {
            try {
                unlink('../' . $ruta);
                return "ok";
            } catch (Exception $e) {
                return "error";
            }
        }
        return "ok";
    }

    public static function mdlValidarArchivo($archivo)
    {
        $extensionesPermitidas = array('pdf', 'xls', 'xlsx');
        $tamañoMaximo = 10 * 1024 * 1024; // 10MB

        $extension = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));

        if (!in_array($extension, $extensionesPermitidas)) {
            return array("codigo" => "401", "mensaje" => "Tipo de archivo no permitido. Solo se permiten PDF y Excel.");
        }

        if ($archivo['size'] > $tamañoMaximo) {
            return array("codigo" => "401", "mensaje" => "El archivo es demasiado grande. Máximo 10MB.");
        }

        if ($archivo['error'] !== UPLOAD_ERR_OK) {
            return array("codigo" => "401", "mensaje" => "Error al subir el archivo.");
        }

        return array("codigo" => "200", "mensaje" => "Archivo válido");
    }

    public static function mdlDescargarArchivo($usuarioId, $forzarNombreDescarga = null)
    {
        //Obtener la url del archivo
        $row = null;
        try {
            $cn = Conexion::conectar();
            if (method_exists($cn, 'setAttribute')) {
                $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            $stmt = $cn->prepare("SELECT url_archivoFormato, documento FROM aprendiz WHERE idaprendiz = :id LIMIT 1");
            $stmt->bindParam(":id", $usuarioId);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // si falla la consulta
            $row = null;
        }

        // URL en BD
        if ($row && !empty($row["url_archivoFormato"])) {
            $rutaRelativa = ltrim($row["url_archivoFormato"], "/");
            $rutaFisica   = "../" . $rutaRelativa;

            if (file_exists($rutaFisica) && is_file($rutaFisica)) {
                // Nombre de descarga
                $ext = pathinfo($rutaFisica, PATHINFO_EXTENSION);
                $doc = isset($row["documento"]) ? preg_replace('/\D/', '', $row["documento"]) : '';
                $nombreDescarga = $forzarNombreDescarga ?: (
                    $doc ? "GFPI-F-165_{$doc}" . ($ext ? "." . $ext : "") : basename($rutaFisica)
                );

                $mime = "application/octet-stream";
                if (function_exists('finfo_open')) {
                    $finfo = finfo_open(FILEINFO_MIME_TYPE);
                    if ($finfo) {
                        $det = finfo_file($finfo, $rutaFisica);
                        if ($det) $mime = $det;
                        finfo_close($finfo);
                    }
                }

                // Cabeceras y salida
                $filesize = filesize($rutaFisica);
                header("Content-Description: File Transfer");
                header("Content-Type: $mime");
                header('Content-Disposition: attachment; filename="' . basename($nombreDescarga) . '"');
                header("Content-Transfer-Encoding: binary");
                header("Content-Length: " . $filesize);
                header("Cache-Control: no-store, no-cache, must-revalidate");
                header("Pragma: no-cache");
                header("Expires: 0");
                readfile($rutaFisica);
                exit;
            }
        }

        http_response_code(404);
        echo "Archivo no encontrado";
        return;
    }
}
