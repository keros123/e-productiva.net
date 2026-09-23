<?php
include_once "conexion.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include_once "emailBitacoraRechazada.php";
include_once "../helpers/crearEmail.php";

class BitacorasModelo
{

    public static function mdlListarBitacoras($idAprendiz)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM bitacora WHERE aprendiz_idaprendiz=:aprendiz_idaprendiz");
            $objRespuesta->bindParam(":aprendiz_idaprendiz", $idAprendiz);
            $objRespuesta->execute();
            $listaBitacoras = $objRespuesta->fetchAll();

            if (count($listaBitacoras) >= 1) {
                $mensaje = array("codigo" => "200", "mensaje" => $listaBitacoras);
            } else {
                $mensaje = array("codigo" => "202", "mensaje" => "no hay bitacoras registradas");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }

    public static function mdlSeleccionarBitacora($idBitacora)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM bitacora WHERE idbitacora=:idbitacora");
            $objRespuesta->bindParam(":idbitacora", $idBitacora);
            $objRespuesta->execute();
            $listaBitacora = $objRespuesta->fetch();

            if ($listaBitacora != null) {
                $mensaje = array("codigo" => "200", "mensaje" => $listaBitacora);
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "no fue posible encontrar la bitacora seleccionada");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }

    public static function mdlRegistrarBitacoras($idAprendiz, $razon_social, $direccion_empresa, $telefono_empresa, $email_empresa, $nombre_jefe, $apellido_jefe, $telefono_jefe, $email_jefe, $fecha_inicio_practica, $fecha_final_practica)
    {
        $mensaje = array();
        $aprendiz = self::duracionPrograma($idAprendiz);
        $tiempo = 0;

        if ($aprendiz["codigo"] == 200) {
            $tiempo = $aprendiz["mensaje"]["duracion_practica"] * 2;
            try {
                for ($i = 1; $i <= $tiempo; $i++) {
                    $objRespuesta = Conexion::conectar()->prepare("INSERT INTO bitacora(razon_social,direccion_empresa,telefono_empresa,email_empresa,nombre_jefe,apellido_jefe,telefono_jefe,email_jefe,fecha_inicio_practica,fecha_final_practica,aprendiz_idaprendiz,codigo_bitacora,estado)VALUES(:razon_social,:direccion_empresa,:telefono_empresa,:email_empresa,:nombre_jefe,:apellido_jefe,:telefono_jefe,:email_jefe,:fecha_inicio_practica,:fecha_final_practica,:aprendiz_idaprendiz,:codigo_bitacora,:estado)");
                    $codigoFormateado = substr(strval(100 + $i), -2);
                    $estado = 0; // Inicialmente sin entregar
                    $objRespuesta->bindParam(":razon_social", $razon_social);
                    $objRespuesta->bindParam(":direccion_empresa", $direccion_empresa);
                    $objRespuesta->bindParam(":telefono_empresa", $telefono_empresa);
                    $objRespuesta->bindParam(":email_empresa", $email_empresa);
                    $objRespuesta->bindParam(":nombre_jefe", $nombre_jefe);
                    $objRespuesta->bindParam(":apellido_jefe", $apellido_jefe);
                    $objRespuesta->bindParam(":telefono_jefe", $telefono_jefe);
                    $objRespuesta->bindParam(":email_jefe", $email_jefe);
                    $objRespuesta->bindParam(":fecha_inicio_practica", $fecha_inicio_practica);
                    $objRespuesta->bindParam(":fecha_final_practica", $fecha_final_practica);
                    $objRespuesta->bindParam(":aprendiz_idaprendiz", $idAprendiz);
                    $objRespuesta->bindParam(":codigo_bitacora", $codigoFormateado);
                    $objRespuesta->bindParam(":estado", $estado);

                    if ($objRespuesta->execute()) {
                        $objRespuesta = null;
                        $mensaje = array("codigo" => "200", "mensaje" => "datos registrados correctamente");
                    } else {
                        $mensaje = array("codigo" => "401", "mensaje" => "no fue posible registrar la bitacora " . $codigoFormateado);
                        break;
                    }
                }
            } catch (Exception $e) {
                $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
            }
        } else {
            $mensaje = array("codigo" => "401", "mensaje" => "Error al cargar las bitacoras.");
        }
        return $mensaje;
    }

    public static function mdlEditarBitacoras($idBitacora, $razon_social, $direccion_empresa, $telefono_empresa, $email_empresa, $nombre_jefe, $apellido_jefe, $telefono_jefe, $email_jefe, $fecha_inicio_practica, $fecha_final_practica)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE bitacora SET razon_social=:razon_social,direccion_empresa=:direccion_empresa,telefono_empresa=:telefono_empresa,email_empresa=:email_empresa,nombre_jefe=:nombre_jefe,apellido_jefe=:apellido_jefe,telefono_jefe=:telefono_jefe,email_jefe=:email_jefe,fecha_inicio_practica=:fecha_inicio_practica,fecha_final_practica=:fecha_final_practica WHERE idBitacora=:idBitacora");
            $objRespuesta->bindParam(":razon_social", $razon_social);
            $objRespuesta->bindParam(":direccion_empresa", $direccion_empresa);
            $objRespuesta->bindParam(":telefono_empresa", $telefono_empresa);
            $objRespuesta->bindParam(":email_empresa", $email_empresa);
            $objRespuesta->bindParam(":nombre_jefe", $nombre_jefe);
            $objRespuesta->bindParam(":apellido_jefe", $apellido_jefe);
            $objRespuesta->bindParam(":telefono_jefe", $telefono_jefe);
            $objRespuesta->bindParam(":email_jefe", $email_jefe);
            $objRespuesta->bindParam(":fecha_inicio_practica", $fecha_inicio_practica);
            $objRespuesta->bindParam(":fecha_final_practica", $fecha_final_practica);
            $objRespuesta->bindParam(":idBitacora", $idBitacora);

            if ($objRespuesta->execute()) {
                $objRespuesta = null;
                $mensaje = array("codigo" => "200", "mensaje" => "datos modificados correctamente");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "no fue posible modificar datos");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlSubirArchivoBitacora($idBitacora, $archivoBitacora, $idAprendiz)
    {
        $fichaAprendiz    = $_SESSION["ficha"];
        $documentoAprendiz = $_SESSION["documento"];
        $mensaje = array();

        // --- 1. Validar extensión permitida (PDF y Excel) ---
        $extensionesPermitidas = ['pdf', 'xlsx', 'xls'];
        $splitFile  = explode('.', $archivoBitacora['name']);
        $extension  = strtolower(end($splitFile));

        if (!in_array($extension, $extensionesPermitidas)) {
            return array("codigo" => "400", "mensaje" => "Solo se permiten archivos en formato PDF o Excel (.pdf, .xlsx, .xls)");
        }

        // --- 2. Validar tamaño máximo (5 MB) ---
        $maxTamano = 5 * 1024 * 1024; // 5 MB en bytes
        if ($archivoBitacora['size'] > $maxTamano) {
            return array("codigo" => "400", "mensaje" => "El archivo no puede superar los 5 MB");
        }

        // --- 3. Crear / verificar carpeta destino ---
        $objRespuestaFolder = BitacorasModelo::mdlCrearFolderBitacoras($fichaAprendiz, $documentoAprendiz);
        if ($objRespuestaFolder["codigo"] != "200") {
            return array("codigo" => "401", "mensaje" => $objRespuestaFolder["mensaje"]);
        }

        // --- 4. Eliminar archivo anterior solo si existe ---
        $objBitacora = BitacorasModelo::mdlSeleccionarBitacora($idBitacora);
        if (!empty($objBitacora["mensaje"]["url_bitacora"])) {
            BitacorasModelo::mdlEliminarArchivoBitacora($objBitacora["mensaje"]["url_bitacora"]);
        }

        // --- 5. Mover el archivo al servidor ---
        $nombreArchivo = uniqid('DOC-') . '.' . $extension;
        $rutaPrincipal = $objRespuestaFolder["ruta"] . $nombreArchivo;
        $rutaFinal     = "../" . $rutaPrincipal;

        if (!move_uploaded_file($archivoBitacora['tmp_name'], $rutaFinal)) {
            return array("codigo" => "425", "mensaje" => "Error al mover el archivo al servidor");
        }

        // --- 6. Actualizar BD; si falla, eliminar el archivo recién subido (rollback) ---
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE bitacora SET url_bitacora=:url_bitacora, estado=:estado WHERE idbitacora=:idbitacora");
            $estado = 1; // Entregado
            $objRespuesta->bindParam(":url_bitacora", $rutaPrincipal);
            $objRespuesta->bindParam(":estado", $estado);
            $objRespuesta->bindParam(":idbitacora", $idBitacora);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Bitácora subida correctamente");
            } else {
                // Rollback: eliminar archivo subido
                if (file_exists($rutaFinal)) {
                    unlink($rutaFinal);
                }
                $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar la bitácora en la base de datos");
            }
            $objRespuesta = null;
        } catch (Exception $e) {
            // Rollback: eliminar archivo subido
            if (file_exists($rutaFinal)) {
                unlink($rutaFinal);
            }
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }


    public static function mdlCambiarEstadoBitacora($idBitacora, $nuevoEstado, $novedad = null,$nombreFuncionario,$documentoFuncionario)
    {
        $mensaje = array();

        // -- Mejora #1: Tabla de transiciones válidas --
        // 0 = Sin entregar | 1 = Entregado | 2 = Aprobado | 3 = Rechazado
        $transicionesPermitidas = [
            0 => [1],     // Sin entregar → Entregado
            1 => [2, 3],  // Entregado   → Aprobado | Rechazado
            3 => [1],     // Rechazado   → Entregado (reentrega tras corrección)
        ];

        // -- Mejora #2: Validar novedad obligatoria al rechazar --
        if ($nuevoEstado == 3 && empty($novedad)) {
            return array("codigo" => "400", "mensaje" => "Debe ingresar una novedad para rechazar la bitácora");
        }

        try {
            // Obtener estado actual
            $bitacoraActual = self::mdlSeleccionarBitacora($idBitacora);

            // -- Mejora #4: Código 404 cuando no existe --
            if ($bitacoraActual["codigo"] != "200") {
                return array("codigo" => "404", "mensaje" => "Bitácora no encontrada");
            }

            $estadoActual = (int) $bitacoraActual["mensaje"]["estado"];
            $nuevoEstado  = (int) $nuevoEstado;

            // -- Mejora #1: Verificar transición permitida --
            if (!isset($transicionesPermitidas[$estadoActual]) ||
                !in_array($nuevoEstado, $transicionesPermitidas[$estadoActual])) {

                $estadosTexto = [0 => "Sin entregar", 1 => "Entregado", 2 => "Aprobado", 3 => "Rechazado"];
                $actual  = $estadosTexto[$estadoActual]  ?? "Desconocido ($estadoActual)";
                $nuevo   = $estadosTexto[$nuevoEstado]   ?? "Desconocido ($nuevoEstado)";
                return array("codigo" => "403", "mensaje" => "Transición no permitida: '$actual' → '$nuevo'");
            }

            // Verificar archivo al aprobar una bitácora rechazada
            if ($estadoActual == 3 && $nuevoEstado == 1) {
                if (empty($bitacoraActual["mensaje"]["url_bitacora"])) {
                    return array("codigo" => "403", "mensaje" => "Debe subir el archivo de la bitácora antes de re-entregarla");
                }
            }

            // -- Mejora #3: UPDATE atómico para evitar race conditions --
            if ($nuevoEstado == 3) {
                $objRespuesta = Conexion::conectar()->prepare(
                    "UPDATE bitacora SET estado=:estado,novedad=:novedad,nombre_funcionario=:nombre_funcionario,documento_funcionario=:documento_funcionario WHERE idbitacora=:idbitacora AND estado=:estadoActual"
                );
                $objRespuesta->bindParam(":novedad", $novedad);
            } else {
                $objRespuesta = Conexion::conectar()->prepare(
                    "UPDATE bitacora SET estado=:estado,nombre_funcionario=:nombre_funcionario,documento_funcionario=:documento_funcionario WHERE idbitacora=:idbitacora AND estado=:estadoActual"
                );
            }

            $objRespuesta->bindParam(":estado",      $nuevoEstado,  \PDO::PARAM_INT);
            $objRespuesta->bindParam(":nombre_funcionario",$nombreFuncionario,  \PDO::PARAM_STR);
            $objRespuesta->bindParam(":documento_funcionario",$documentoFuncionario, \PDO::PARAM_STR);
            $objRespuesta->bindParam(":estado",      $nuevoEstado,  \PDO::PARAM_INT);
            $objRespuesta->bindParam(":idbitacora",  $idBitacora,   \PDO::PARAM_INT);
            $objRespuesta->bindParam(":estadoActual", $estadoActual, \PDO::PARAM_INT);

            $objRespuesta->execute();

            // -- Mejora #3: Si rowCount == 0 hubo concurrencia o inconsistencia --
            if ($objRespuesta->rowCount() === 0) {
                $objRespuesta = null;
                return array("codigo" => "409", "mensaje" => "El estado de la bitácora fue modificado por otro proceso. Recargue e intente de nuevo.");
            }

            // -- Mejora #5: Cerrar statement PDO --
            $objRespuesta = null;

            $estadosTexto = [1 => "Entregado", 2 => "Aprobado", 3 => "Rechazado"];
            $estadoTexto  = $estadosTexto[$nuevoEstado] ?? "Desconocido";

            // -- Mejora #6: Correo y estado reflejado en respuesta --
            $correoEnviado = true;
            if ($nuevoEstado == 3) {
                $envioCorreo = self::enviarCorreoBitacoraRechazada($idBitacora, $novedad);
                if ($envioCorreo["codigo"] != "200") {
                    error_log("Error enviando correo de bitácora rechazada: " . $envioCorreo["mensaje"]);
                    $correoEnviado = false;
                }
            }

            $mensajeRespuesta = "Estado cambiado a: $estadoTexto";
            if ($nuevoEstado == 3 && !$correoEnviado) {
                $mensajeRespuesta .= ". (Advertencia: no se pudo enviar la notificación por correo)";
            }

            $mensaje = array("codigo" => "200", "mensaje" => $mensajeRespuesta);

        } catch (Exception $e) {
            // -- Mejora #4: Código 500 para errores internos de servidor --
            $mensaje = array("codigo" => "500", "mensaje" => "Error interno: " . $e->getMessage());
        }

        return $mensaje;
    }

    // Método para enviar correo de bitácora rechazada
    public static function enviarCorreoBitacoraRechazada($idBitacora, $novedad)
    {
        try {
            // Obtener información completa de la bitácora y aprendiz
            $sql = "SELECT 
                        b.codigo_bitacora,
                        b.novedad,
                        a.nombres,
                        a.apellidos,
                        a.email,
                        f.numero_ficha,
                        f.caracterizacion,
                        func.nombres AS nombreInstructor,
                        func.apellidos AS apellidoInstructor
                    FROM bitacora b
                    INNER JOIN aprendiz a ON b.aprendiz_idaprendiz = a.idaprendiz
                    INNER JOIN ficha f ON a.ficha_idficha = f.idficha
                    LEFT JOIN ficha_has_funcionario fhf ON f.idficha = fhf.ficha_idficha
                    LEFT JOIN funcionario func ON fhf.funcionario_idfuncionario = func.idfuncionario
                    WHERE b.idbitacora = :idbitacora
                    LIMIT 1";

            $objConsulta = Conexion::conectar()->prepare($sql);
            $objConsulta->bindParam(":idbitacora", $idBitacora);
            $objConsulta->execute();
            $info = $objConsulta->fetch();
            $objConsulta = null;

            if (!$info) {
                return array("codigo" => "401", "mensaje" => "No se encontró información para enviar el correo");
            }

            $plantilla = new mdlPlantillaEmailBitacoraRechazada();
            $cuerpoEmail = $plantilla->crearCuerpoMensajeBitacoraRechazada(
                $info['nombres'] . ' ' . $info['apellidos'],
                $info['codigo_bitacora'],
                $info['nombreInstructor'] . ' ' . $info['apellidoInstructor'],
                $info['numero_ficha'],
                $info['caracterizacion'],
                $novedad
            );

            // Validar que el aprendiz tenga correo registrado
            if (empty($info['email'])) {
                return array("codigo" => "422", "mensaje" => "El aprendiz no tiene correo registrado");
            }

            // Crear instancia de PHPMailer usando el helper centralizado
            $mail = crearEmail('seguimientos@eproductiva.net', 'Sistema de Bitácoras CIMM');

            // Destinatario
            $mail->addAddress($info['email'], $info['nombres'] . ' ' . $info['apellidos']);

            // Contenido del correo
            $mail->Subject  = "Bitácora " . $info['codigo_bitacora'] . " - Rechazada";
            $mail->Body     = $cuerpoEmail;
            $mail->AltBody  = strip_tags($cuerpoEmail);

            $mail->send();

            return array("codigo" => "200", "mensaje" => "Correo enviado correctamente");
        } catch (Exception $e) {
            return array("codigo" => "500", "mensaje" => "Error enviando correo: " . $e->getMessage());
        }
    }

    public static function mdlCrearFolderBitacoras($fichaAprendiz, $documentoAprendiz)
    {
        $mensaje = array();

        // crear directorio principal
        $error = false;
        if (!file_exists('../archivos')) {
            if (!mkdir('../archivos', 0777, true)) {
                $error = true;
            }
        }

        if (!$error) {
            if (!file_exists('../archivos/aprendices')) {
                if (!mkdir('../archivos/aprendices', 0777, true)) {
                    $error = true;
                }
            }

            if (!$error) {
                if (!file_exists('../archivos/aprendices/' . $fichaAprendiz)) {
                    if (!mkdir('../archivos/aprendices/' . $fichaAprendiz, 0777, true)) {
                        $error = true;
                    }
                }

                if (!$error) {
                    if (!file_exists('../archivos/aprendices/' . $fichaAprendiz . '/' . $documentoAprendiz)) {
                        if (!mkdir('../archivos/aprendices/' . $fichaAprendiz . '/' . $documentoAprendiz, 0777, true)) {
                            $error = true;
                        }
                    }

                    if (!$error) {
                        if (!file_exists('../archivos/aprendices/' . $fichaAprendiz . '/' . $documentoAprendiz . '/bitacoras')) {
                            if (!mkdir('../archivos/aprendices/' . $fichaAprendiz . '/' . $documentoAprendiz . '/bitacoras', 0777, true)) {
                                $error = true;
                            }
                        }

                        if (!$error) {
                            $ruta = 'archivos/aprendices/' . $fichaAprendiz . '/' . $documentoAprendiz . '/bitacoras/';
                            $mensaje = array("codigo" => "200", "mensaje" => "directorio creado con exito", "ruta" => $ruta);
                        } else {
                            $mensaje = array("codigo" => "401", "mensaje" => "no fue posible crear el directorio para las bitacoras del aprendiz con documento " . $documentoAprendiz . " de la ficha " . $fichaAprendiz);
                        }
                    } else {
                        $mensaje = array("codigo" => "401", "mensaje" => "no fue posible crear el directorio el aprendiz con documento " . $documentoAprendiz);
                    }
                } else {
                    $mensaje = array("codigo" => "401", "mensaje" => "no fue posible crear el directorio para la ficha " . $fichaAprendiz);
                }
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "no fue posible crear el directorio principal de aprendices");
            }
        } else {
            $mensaje = array("codigo" => "401", "mensaje" => "no fue posible crear el directorio principal de archivos");
        }

        return $mensaje;
    }

    public static function mdlEliminarArchivoBitacora($ruta)
    {
        $mensaje = "";
        if (file_exists('../' . $ruta)) {
            try {
                if (unlink('../' . $ruta)) {
                    $mensaje = "ok";
                } else {
                    $mensaje = "error";
                }
            } catch (Exception $th) {
                $mensaje = $th;
            }
        }
        return $mensaje;
    }

    public static function duracionPrograma($idaprendiz)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM aprendiz INNER JOIN ficha ON ficha_idficha = idficha INNER JOIN tipo_programa ON tipo_programa_idtipo_programa = idtipo_programa WHERE idaprendiz = :idaprendiz");
            $objRespuesta->bindParam(":idaprendiz", $idaprendiz);

            if ($objRespuesta->execute()) {
                $aprendiz = $objRespuesta->fetch();
                $objRespuesta = null;
                $mensaje = array("codigo" => "200", "mensaje" => $aprendiz);
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "no fue posible modificar datos");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }
}