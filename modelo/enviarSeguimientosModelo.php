<?php

include_once "conexion.php";
include_once "../helpers/crearEmail.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class enviarSeguimientosModelo
{
    public static function mdlEnviarSeguimientosAprendiz($objSeguimiento, $notificado, $instructor)
    {
        if ($notificado == 1) {
            $mes = date('M');
            $ano = date('Y');
            $error = 0;
            $completo = 0;
            $total = 0;
            $mensaje = [];
            $mensajeConsulta = [];
            $asignado = 2;
            $mensajePersonalizado = null;
            $formatoEmail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
            $aprendizEmailNoValido = null;

            foreach ($objSeguimiento as $Aprendiz) {
                if ($Aprendiz["asignacion"] != 2) {
                    if (preg_match($formatoEmail, $Aprendiz["emailAprendiz"])) {
                        $p1 = '<tr style="justify-content: center; align-items: center;text-align: center;">';
                        $p2 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["nombre_tipo_seguimiento"] . '</td>';
                        $p3 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["nombreAprendiz"] . " " . $Aprendiz["apellidoAprendiz"] . '</td>';
                        $p4 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["documentoAprendiz"] . '</td>';
                        $p5 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["telefonoAprendiz"] . '</td>';
                        $p6 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["nombre_empresa"] . '</td>';
                        $p7 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["numero_ficha"] . '</td>';
                        $p8 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["nomb_muni"] . '</td>'; //ciudad
                        $p9 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["fecha_vencimiento"] . '</td>';
                        $p10 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["caracterizacion"] . '</td>';
                        // $p11 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">'.$Aprendiz["nombre_linea_tecnologica"]." - ".$Aprendiz["nombre_red_tecnologica"].'</td>';
                        $p12 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["nombre_modalidad"] . '</td>';
                        if ($Aprendiz["ubicacion_seguimiento"] == null || $Aprendiz["ubicacion_seguimiento"] == "") {
                            $Aprendiz["ubicacion_seguimiento"] == "No aplica";
                        }
                        $p13 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["ubicacion_seguimiento"] . '</td>';
                        $p14 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["nombresFuncionario"] . " " . $Aprendiz["apellidosFuncionario"] . '</td>';
                        $p15 = '</tr>';
                        $seguimientoRegistro = $p1 . $p2 . $p3 . $p4 . $p5 . $p6 . $p7 . $p8 . $p9 . $p10 . $p12 . $p13 . $p14 . $p15;

                        $mensajePersonalizado = '<p><h4>Cordial saludo,</h4><br><p>';
                        $mensajePersonalizado .= '<p>Estimado aprendiz le informamos del seguimiento programado para su etapa práctica, el instructor designado se comunicara con usted para cumplir con el debido proceso, recuerde tener sus datos actualizados correctamente en la plataforma y estar al día con el compromiso de las bitácoras.</p>';
                        $alertaSeguimientos = "";
                        include '../vista/modulos/emailSeguimientos.php';

                        $mail = crearEmail('seguimientos@eproductiva.net', 'Seguimientos Programados aprendiz mes ' . $mes);
                        $mail->addAddress($Aprendiz["emailAprendiz"]);
                        $mail->addCC('eproductiva9304@sena.edu.co');
                        $mail->Subject = "Seguimientos Programados aprendiz " . $mes . " " . $ano;
                        $mail->Body    = $cuerpoMensaje;
                        $mail->AltBody = strip_tags($cuerpoMensaje);
                        if ($mail->send()) {
                            $completo++;
                            $mensajeEmail = ["codigo" => "200"];
                        } else {
                            $error++;
                            $mensajeEmail = ["codigo" => "425"];
                        }

                        if ($mensajeEmail["codigo"] == "200") {
                            try {
                                $objConsulta = conexion::conectar()->prepare("UPDATE visita_seguimiento SET asignacion = :asignado WHERE idvisita_seguimiento = :id");
                                $objConsulta->bindParam(":asignado", $asignado);
                                $objConsulta->bindParam(":id", $Aprendiz["idvisita_seguimiento"]);

                                if ($objConsulta->execute()) {
                                    $mensajeConsulta = ["codigo" => "200", "mensaje" => "Seguimientos notificados exitosamente. $completo / $total Correctos.", "instructor" => $instructor];
                                } else {
                                    $mensajeConsulta = ["codigo" => "425", "mensaje" => "Error al notificar los seguimientos intente otra vez. $completo / $total Correctos.", "instructor" => $instructor];
                                }
                                $objConsulta = null;
                            } catch (Exception $e) {
                                $mensajeConsulta = ["codigo" => "425", "mensaje" => "Error al notificar los seguimientos intente otra vez. $completo / $total Correctos.", "instructor" => $instructor];
                            }
                        }
                    } else {
                        $error++;
                        $aprendizEmailNoValido .= $Aprendiz["documentoAprendiz"] . " - " . $Aprendiz["nombreAprendiz"] . " " . $Aprendiz["apellidoAprendiz"] . ", ";
                    }
                    $total++;
                }
            }
            if ($aprendizEmailNoValido != null) {
                $mensaje = ["codigo" => "200", "mensaje" => "Seguimientos notificados exitosamente. $completo / $total Correctos. aprendiz/aprendices con email invalido $aprendizEmailNoValido por favor verificar la direccion de correo electronico de los aprendices mencionados luego intentar de nuevo.", "instructor" => $instructor];
            } else {
                $mensaje = ["codigo" => "200", "mensaje" => "Seguimientos notificados exitosamente. $completo / $total Correctos.", "instructor" => $instructor];
            }
        } else {
            $mensaje = ["codigo" => "425", "mensaje" => "Error al notificar los seguimientos."];
        }
        return $mensaje;
    }

    public static function mdlCorreoInstructor($objSeguimiento)
    {

        $mes = date('M');
        $ano = date('Y');
        $datos = null;
        $estado = 1;
        $mensaje = [];


        foreach ($objSeguimiento as $Aprendiz) {

            if ($Aprendiz["instructor_notificado"] != 1) {

                $p1 = '<tr style="justify-content: center; align-items: center;text-align: center;">';
                $p2 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["nombre_tipo_seguimiento"] . '</td>';
                $p3 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["nombreAprendiz"] . " " . $Aprendiz["apellidoAprendiz"] . '</td>';
                $p4 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["documentoAprendiz"] . '</td>';
                $p5 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["telefonoAprendiz"] . '</td>';
                $p6 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["nombre_empresa"] . '</td>';
                $p7 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["numero_ficha"] . '</td>';
                $p8 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["nomb_muni"] . '</td>'; //ciudad
                $p9 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["fecha_vencimiento"] . '</td>';
                $p10 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["caracterizacion"] . '</td>';
                // $p11 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">'.$Aprendiz["nombre_linea_tecnologica"]." - ".$Aprendiz["nombre_red_tecnologica"].'</td>';
                $p12 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["nombre_modalidad"] . '</td>';
                if ($Aprendiz["ubicacion_seguimiento"] == null || $Aprendiz["ubicacion_seguimiento"] == "") {
                    $Aprendiz["ubicacion_seguimiento"] == "No aplica";
                }
                $p13 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["ubicacion_seguimiento"] . '</td>';
                $p14 = '<td style="font-weight:400;line-height:24px;text-align:left;color:#000;border: 1px solid black; font-size: 5pt;text-align: center;font-family: verdana;padding: 5px;">' . $Aprendiz["nombresFuncionario"] . " " . $Aprendiz["apellidosFuncionario"] . '</td>';
                $p15 = '</tr>';


                try {
                    $objConsulta = conexion::conectar()->prepare("UPDATE visita_seguimiento SET instructor_notificado = :estado WHERE idvisita_seguimiento = :id");
                    $objConsulta->bindParam(":estado", $estado);
                    $objConsulta->bindParam(":id", $Aprendiz["idvisita_seguimiento"]);

                    if ($objConsulta->execute()) {
                        $datos .= $p1 . $p2 . $p3 . $p4 . $p5 . $p6 . $p7 . $p8 . $p9 . $p10 . $p12 . $p13 . $p14 . $p15;
                        $mensaje = ["codigo" => "200"];
                    } else {
                        $mensaje = ["codigo" => "425"];
                    }
                    $objConsulta = null;
                } catch (Exception $e) {
                    $mensaje = ["codigo" => "425"];
                }
                $emailInstructor = $Aprendiz["emailFuncionario"];
            } else {
                $mensaje = ["codigo" => "201"];
            }
        }

        if ($mensaje["codigo"] == "200") {
            $mensajePersonalizado = '<p><h4>Cordial saludo,</h4></p><br>';
            $mensajePersonalizado .= '<p style="font-weight:400;line-height:24px;text-align:left;">Le informamos los seguimientos de etapa práctica programados, agradecemos la gestión en las fechas indicadas.';
            $mensajePersonalizado .= ' Si existe alguna novedad favor informar con antelación a desplazamiento a Coordinación Académica con copia al correo contratoaprendizajecimm@sena.edu.co.</p>';
            $alertaSeguimientos = '<p style="background-color:#fff3cd; color:#856404; border:1px solid #ffeeba; padding:12px 16px; border-radius:6px; font-weight:400; line-height:24px; text-align:left;">
            ⚠️ <strong>Importante:</strong>Estimado instructor, Si tiene asignados seguimientos momento 2 o 3, verifique previamente si el aprendiz ya cuenta con los seguimientos anteriores aprobados.
            En caso contrario, el instructor deberá realizar los seguimientos faltantes antes de continuar con los nuevos seguimientos.
            </p>';
            $seguimientoRegistro = $datos;
            include '../vista/modulos/emailSeguimientos.php';

            $mail = crearEmail('seguimientos@eproductiva.net', 'Seguimientos asignados mes ' . $mes);
            $mail->addAddress($emailInstructor);
            $mail->addCC('eproductiva9304@sena.edu.co');
            $mail->Subject = "Seguimientos asignados " . $mes . " " . $ano;
            $mail->Body    = $cuerpoMensaje;
            $mail->AltBody = strip_tags($cuerpoMensaje);
            if ($mail->send()) {
                $mensaje = ["codigo" => "200"];
            } else {
                $mensaje = ["codigo" => "425"];
            }
        } elseif ($mensaje["codigo"] == "201") {
            $mensaje = ["codigo" => "200"];
        } else {
            $mensaje = ["codigo" => "425"];
        }
        return $mensaje;
    }
}
