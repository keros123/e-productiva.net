<?php

include_once "conexion.php";
include_once "../helpers/crearEmail.php";

class rUsuarioModelo
{

    public static function mdlEmailRecuperacion($email, $documento, $tipoRecuperacion)
    {
        try {

            if ($tipoRecuperacion == "funcionario") {
                // ✅ FIX: LOWER(:email) — el ":" debe estar DENTRO del paréntesis
                $objRecuperar = conexion::conectar()->prepare("SELECT idfuncionario FROM funcionario WHERE LOWER(email) = LOWER(:email)");
                $objRecuperar->bindParam(":email", $email);
            } else {
                $objRecuperar = conexion::conectar()->prepare("SELECT idaprendiz FROM aprendiz WHERE LOWER(email) = LOWER(:email) AND documento = :documento");
                $objRecuperar->bindParam(":email", $email);
                $objRecuperar->bindParam(":documento", $documento);
            }

            $objRecuperar->execute();
            $datosUsuario = $objRecuperar->fetch();
            $objRecuperar = null;

            if ($datosUsuario != null) {

                $idUsuario   = $datosUsuario[0];
                $emailUsuario = $email;

                // ✅ MEJORA: random_int() es criptográficamente seguro (usa CSPRNG del SO)
                // rand() es predecible y no apto para códigos de seguridad
                $codp1 = random_int(10, 99);
                $codp2 = random_int(10, 99);
                $codp3 = random_int(0, 9);
                $codp4 = random_int(0, 9);
                $codpa = chr(random_int(ord('A'), ord('Z')));
                $codpz = chr(random_int(ord('A'), ord('Z')));
                $cod   = [$codp1, $codpa, $codp2, $codpz, $codp3, $codp4];
                shuffle($cod);
                $cod_recuperacion = implode('', $cod);

                if ($tipoRecuperacion == "funcionario") {
                    $objRecuperar = conexion::conectar()->prepare("INSERT INTO recuperacion_contrasena(codigo_recuperacion, fecha_hora_creacion, funcionario_idfuncionario) VALUES (:codigo, NOW(), :idusuario)");
                } else {
                    $objRecuperar = conexion::conectar()->prepare("INSERT INTO recuperacion_contrasena_aprendiz(codigo_recuperacion, fecha_hora_creacion, aprendiz_idaprendiz) VALUES (:codigo, NOW(), :idusuario)");
                }
                $objRecuperar->bindParam(":codigo",    $cod_recuperacion);
                $objRecuperar->bindParam(":idusuario", $idUsuario);

                if ($objRecuperar->execute()) {

                    $objRecuperar = null;

                    // La plantilla define $mensaje_email con $cod_recuperacion disponible
                    include '../vista/modulos/plantillaEmailRecuperacion.php';

                    $mail = crearEmail('seguimientos@eproductiva.net', 'Código de Verificación');
                    $mail->addAddress($emailUsuario);
                    $mail->Subject = "Alerta SGD — Código de Recuperación";
                    $mail->Body    = $mensaje_email;
                    $mail->AltBody = strip_tags($mensaje_email);

                    if ($mail->send()) {
                        $mensaje = ["codigo" => "200"];
                    } else {
                        $mensaje = ["codigo" => "425", "mensaje" => "Hubo un error al enviar el correo"];
                    }

                } else {
                    $mensaje = ["codigo" => "425", "mensaje" => "No se pudo registrar el código de recuperación"];
                }

            } else {
                $mensaje = ["codigo" => "425", "mensaje" => "El usuario no existe o los datos no coinciden"];
            }

        } catch (\Exception $e) {
            $mensaje = ["codigo" => "500", "mensaje" => "Error interno: " . $e->getMessage()];
        }

        return $mensaje;
    }

    public static function mdlActualizarContraseña($codVerificacion, $nuevaContraseña, $tipoRecuperacion)
    {
        try {

            if ($tipoRecuperacion == "funcionario") {
                $select   = "SELECT * FROM recuperacion_contrasena WHERE codigo_recuperacion = :codigo";
                $update   = "UPDATE funcionario SET password = :password1 WHERE idfuncionario = :idusuario";
                $delete_1 = "DELETE FROM recuperacion_contrasena WHERE id_recuperacion = :idrec";
                $delete_2 = "DELETE FROM recuperacion_contrasena WHERE fecha_hora_creacion <= NOW() - INTERVAL '10 minutes'";
            } else {
                $select   = "SELECT * FROM recuperacion_contrasena_aprendiz WHERE codigo_recuperacion = :codigo";
                $update   = "UPDATE aprendiz SET password_aprendiz = :password1 WHERE idaprendiz = :idusuario";
                $delete_1 = "DELETE FROM recuperacion_contrasena_aprendiz WHERE id_recuperacion = :idrec";
                $delete_2 = "DELETE FROM recuperacion_contrasena_aprendiz WHERE fecha_hora_creacion <= NOW() - INTERVAL '10 minutes'";
            }

            $objRecuperar = conexion::conectar()->prepare($select);
            $objRecuperar->bindParam(":codigo", $codVerificacion);
            $objRecuperar->execute();
            $datosVerificacion = $objRecuperar->fetch();
            $objRecuperar = null;

            if ($datosVerificacion != null) {

                $idRecuperacion  = $datosVerificacion[0];
                $horaCodigo      = $datosVerificacion[2];
                $idUsuario       = $datosVerificacion[3];
                $fechaHoraActual = date('Y-m-d H:i:s');

                // Diferencia en minutos usando timestamps — simple y sin riesgo de DateInterval->invert
                $minutos = abs(strtotime($fechaHoraActual) - strtotime($horaCodigo)) / 60;

                if ($minutos <= 10) {
                    $contraseña   = $nuevaContraseña;
                    $objRecuperar = conexion::conectar()->prepare($update);
                    $objRecuperar->bindParam(":password1", $contraseña);
                    $objRecuperar->bindParam(":idusuario", $idUsuario);

                    if ($objRecuperar->execute()) {
                        $objRecuperar = null;

                        $objRecuperar = conexion::conectar()->prepare($delete_1);
                        $objRecuperar->bindParam(":idrec", $idRecuperacion);
                        $objRecuperar->execute();
                        $objRecuperar = null;

                        $objRecuperar = conexion::conectar()->prepare($delete_2);
                        $objRecuperar->execute();
                        $objRecuperar = null;

                        $mensaje = ["codigo" => "200"];
                    } else {
                        $mensaje = ["codigo" => "425", "mensaje" => "No se pudo actualizar la contraseña"];
                    }
                } else {
                    $objRecuperar = conexion::conectar()->prepare($delete_2);
                    $objRecuperar->execute();
                    $objRecuperar = null;
                    $mensaje = ["codigo" => "425", "mensaje" => "El código ingresado ha caducado"];
                }

            } else {
                $mensaje = ["codigo" => "425", "mensaje" => "El código ingresado no es válido"];
            }

        } catch (\Exception $e) {
            $mensaje = ["codigo" => "500", "mensaje" => "Error interno: " . $e->getMessage()];
        }

        return $mensaje;
    }
}
