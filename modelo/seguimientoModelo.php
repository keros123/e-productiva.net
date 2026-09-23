<?php

include_once "conexion.php";
include_once "../helpers/crearEmail.php";

include_once "seguimientoOtraAlternativaModelo.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

class SeguimientoModelo
{
    public static function mdlListarModalidades()
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM modalidad");
            $objRespuesta->execute();
            $listaModalidades = $objRespuesta->fetchAll();
            $objRespuesta = null;
            $mensaje = array("codigo" => "200", "mensaje" => $listaModalidades);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;
    }

    /* ----------------------Listar instructores para asignar seguimientos -------------------------------- */
    /* Fecha de Creacion :  25/02/2026           Desarrollador: Marco Antonio Cipagauta Arbelaez              */
    /* Parametros :                                                                                           */
    /* Retorno :Listado de  instructores para asignar visita de seguimientos                               */
    /* -------------------------------------------------------------------------------------------------------*/
    /* --------------------------------------Control de cambios ----------------------------------------------*/
    /* Desarrollador:        fecha:                                                                           */
    /* Descripcion:                                                                                           */
    /*--------------------------------------------------------------------------------------------------------*/
    public static function mdlListarInstructores(){
        $mensaje = array();
        $tipoFuncionario = 1; // 1 es el id del funcionario que es instructor
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT idfuncionario,documento,nombres,apellidos,email FROM funcionario WHERE tipo_funcionario_idtipo_funcionario = :tipoFuncionario");
            $objRespuesta->bindParam(":tipoFuncionario", $tipoFuncionario);
            $objRespuesta->execute();
            $listaInstructores = $objRespuesta->fetchAll();
            $objRespuesta = null;
            $mensaje = array("codigo" => "200", "mensaje" => $listaInstructores);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    /* ----------------------Listar etapa practica para asignar seguimientos -------------------------------- */
    /* Fecha de Creacion :  27/08/2025           Desarrollador: Marco Antonio Cipagauta Arbelaez              */
    /* Parametros :                                                                                           */
    /* Retorno :Listado de  etapas practica para asignar visita de seguimientos                               */
    /* -------------------------------------------------------------------------------------------------------*/
    /* --------------------------------------Control de cambios ----------------------------------------------*/
    /* Desarrollador: Marco Antonio Cipagauta Arbelaez         fecha: 09/09/2025                              */
    /* Descripcion: se cambio consulta sql para traer el nombre del ultimo instructor asignado                                                                                                  */
    /*--------------------------------------------------------------------------------------------------------*/
    public static function mdlListarEtapaPractica()
    {
        $mensaje = array();
        try {
            $sql = "SELECT 
                    s.*,
                    a.*,
                    f.*,
                    m.*,
                    e.*,
                    mu.*,
                    d.*,
                    (
                        SELECT CONCAT(funcionario.nombres,' ',funcionario.apellidos) 
                        FROM visita_seguimiento vs INNER JOIN funcionario ON vs.funcionario_idfuncionario = funcionario.idfuncionario WHERE vs.seguimiento_idseguimiento = s.idseguimiento 
                        ORDER BY vs.idvisita_seguimiento DESC 
                        LIMIT 1
                    ) AS ultimo_instructor
                FROM seguimiento s
                INNER JOIN aprendiz a ON s.aprendiz_idaprendiz = a.idaprendiz
                INNER JOIN ficha f ON a.ficha_idficha = f.idficha
                INNER JOIN modalidad m ON s.modalidad_idmodalidad = m.idmodalidad
                INNER JOIN empresa e ON s.empresa_idempresa = e.idempresa
                INNER JOIN municipios mu ON e.municipios_codi_muni = mu.codi_muni
                INNER JOIN departamentos d ON mu.departamentos_codi_depa = d.codi_depa
                ORDER BY s.idseguimiento DESC";

            $objRespuesta = Conexion::conectar()->prepare($sql);
            $objRespuesta->execute();
            $listaEtapaPractica = $objRespuesta->fetchAll();
            $objRespuesta = null;
            $mensaje = array("codigo" => "200", "mensaje" => $listaEtapaPractica);
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlRegistrarEtapaPractica($fechaInicioPractica, $fechaFinPractica, $modalidad, $aprendiz, $empresa, $datosSeguimiento, $documentoAlternativaPractica, $idInstructor)
    {
        $mensaje = array();
        $verificarEtapaPractica = self::verificarEtapasPracticas($aprendiz, $datosSeguimiento, $fechaInicioPractica, $fechaFinPractica);
        if ($verificarEtapaPractica["codigo"] == "200") {
            try {
                $estado_etapa_practica = 1;
                $fechaRadicado = date("Y-m-d");
                $objRespuesta = Conexion::conectar()->prepare("INSERT INTO seguimiento(fecha_radicado,fecha_inicio_practica,fecha_fin_practica_seguimiento,modalidad_idmodalidad,aprendiz_idaprendiz,empresa_idempresa,estado_etapa_practica)VALUES(:fecha_radicado,:fecha_inicio_practica,:fecha_fin_practica_seguimiento,:modalidad_idmodalidad,:aprendiz_idaprendiz,:empresa_idempresa,:estado_etapa_practica)");
                $objRespuesta->bindParam(":fecha_radicado", $fechaRadicado);
                $objRespuesta->bindParam(":fecha_inicio_practica", $fechaInicioPractica);
                $objRespuesta->bindParam(":fecha_fin_practica_seguimiento", $fechaFinPractica);
                $objRespuesta->bindParam(":modalidad_idmodalidad", $modalidad);
                $objRespuesta->bindParam(":aprendiz_idaprendiz", $aprendiz);
                $objRespuesta->bindParam(":empresa_idempresa", $empresa);
                $objRespuesta->bindParam(":estado_etapa_practica", $estado_etapa_practica);
                if ($objRespuesta->execute()) {
                    $etapa_practica = "2";//2 = con etapapractica 1 = reasignada habilitado para asignar una nueva etapa practica
                    $objAprendiz = SeguimientoModelo::mdlActulizarEtapaPracticaAprendiz($aprendiz, $etapa_practica);
                    if ($objAprendiz["codigo"] == "200") {
                        $objRespuesta = null;
                        $sql = "SELECT * FROM modalidad WHERE idmodalidad = :modalidad";
                        $objRespuesta = conexion::conectar()->prepare($sql);
                        $objRespuesta->bindparam(":modalidad", $modalidad);
                        if ($objRespuesta->execute()) {
                            $datosModalidad = $objRespuesta->fetch();
                            $objRespuesta = null;
                            $fecha = date("Y-m-d H:i:s");
                            $responsable = $_SESSION["nombreCompleto"];
                            $proceso = "Creo etapa practica";
                            $descripcion = "Se creo etapa practica al aprendiz " . $datosSeguimiento["aprendiz"] . " de la ficha " . $datosSeguimiento["ficha"] . " en la empresa " . $datosSeguimiento["empresa"] . " bajo la modalidad de " . $datosModalidad["nombre_modalidad"];
                            $sql = "INSERT INTO procesos_seguimientos(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                            $objRespuesta = conexion::conectar()->prepare($sql);
                            $objRespuesta->bindparam(":fecha", $fecha);
                            $objRespuesta->bindparam(":responsable", $responsable);
                            $objRespuesta->bindparam(":proceso", $proceso);
                            $objRespuesta->bindparam(":descripcion", $descripcion);
                            if ($objRespuesta->execute()) {
                                $objRespuesta = null;
                                if ($modalidad != 1) {
                                    //urldocumento, $idaprendiz para idseguimiento, funcionario, tiposeguimiento, fechas, estadovisita, asignacion, notificado, estadoReporte
                                    $visita = seguimientoOtraAlternativaModelo::mdlCrearPrimerSeguimiento($documentoAlternativaPractica, $aprendiz, $idInstructor, 3, $fechaRadicado, 2, 2, 1, 1);

                                    if ($visita["codigo"] == "200") {
                                        $mensaje = ["codigo" => "200", "mensaje" => "Etapa practica registrada correctamente."];
                                    } else {
                                        $mensaje = ["codigo" => "202", "mensaje" => "Error durante el proceso de archivo."];
                                    }
                                } else {
                                    $mensaje = ["codigo" => "200", "mensaje" => "Etapa practica registrada correctamente."];
                                }
                            } else {
                                $mensaje = ["codigo" => "401", "mensaje" => "Error al crear etapa practica"];
                            }
                        } else {
                            $mensaje = ["codigo" => "401", "mensaje" => $objAprendiz["mensaje"]];
                        }

                    } else {
                        $mensaje = array("codigo" => "401", "mensaje" => $objAprendiz["mensaje"]);
                    }
                } else {
                    $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar etapa practica.");
                }
                $objRespuesta = null;
            } catch (Exception $e) {
                $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
            }
        } else {
            $mensaje = array("codigo" => "401", "mensaje" => "Error al registrar etapa practica. verificar Etapas");
        }
        return $mensaje;
    }


    public static function mdlEditarEtapaPractica($idSeguimiento, $fechaInicioPractica, $fechaFinPractica, $modalidad, $empresa, $estadoEtapaPractica, $observacion_seguimiento, $documentoAlternativaPractica = null)
    {
        $mensaje = array();
        try {
            // Una sola conexi¨®n reutilizada en todo el m¨¦todo
            $db = Conexion::conectar();

            $sql = "SELECT * FROM seguimiento INNER JOIN modalidad ON seguimiento.modalidad_idmodalidad = modalidad.idmodalidad INNER JOIN empresa ON seguimiento.empresa_idempresa = empresa.idempresa INNER JOIN aprendiz ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha WHERE idseguimiento = :idSeguimiento";
            $objRespuesta = $db->prepare($sql);
            $objRespuesta->bindParam(":idSeguimiento", $idSeguimiento);
            if ($objRespuesta->execute()) {
                $datosAnterioresEtapa = $objRespuesta->fetch();
                $objRespuesta = null;
                $fechaRadicado = date("Y-m-d");
                $objRespuesta = $db->prepare("UPDATE seguimiento SET fecha_radicado=:fecha_radicado,fecha_inicio_practica=:fecha_inicio_practica,fecha_fin_practica_seguimiento=:fecha_fin_practica_seguimiento,modalidad_idmodalidad=:modalidad_idmodalidad,empresa_idempresa=:empresa_idempresa, estado_etapa_practica=:estadoEtapaPractica ,observacion_seguimiento=:observacion_seguimiento WHERE idseguimiento=:idseguimiento");
                $objRespuesta->bindParam(":fecha_radicado", $fechaRadicado);
                $objRespuesta->bindParam(":fecha_inicio_practica", $fechaInicioPractica);
                $objRespuesta->bindParam(":fecha_fin_practica_seguimiento", $fechaFinPractica);
                $objRespuesta->bindParam(":modalidad_idmodalidad", $modalidad);
                $objRespuesta->bindParam(":empresa_idempresa", $empresa);
                $objRespuesta->bindParam(":idseguimiento", $idSeguimiento);
                $objRespuesta->bindParam(":estadoEtapaPractica", $estadoEtapaPractica);
                $objRespuesta->bindParam(":observacion_seguimiento", $observacion_seguimiento);

                if ($objRespuesta->execute()) {
                    $objRespuesta = null;
                    $etapa_practica = null;
                    if ($estadoEtapaPractica == "2") {
                        $etapa_practica = "1";
                    } else {
                        $etapa_practica = "2";
                    }
                    $aprendiz = $datosAnterioresEtapa["aprendiz_idaprendiz"];
                    $objAprendiz = SeguimientoModelo::mdlActulizarEtapaPracticaAprendiz($aprendiz, $etapa_practica);
                    if ($objAprendiz["codigo"] == "200") {
                        $fecha = date("Y-m-d H:i:s");
                        $responsable = $_SESSION["nombreCompleto"];
                        $proceso = "Edito etapa practica";
                        $cambios = '';
                        if ($datosAnterioresEtapa["fecha_inicio_practica"] != $fechaInicioPractica) {
                            $cambios .= "Antes " . $datosAnterioresEtapa["fecha_inicio_practica"] . ", Ahora " . $fechaInicioPractica . ".";
                        }
                        if ($datosAnterioresEtapa["fecha_fin_practica_seguimiento"] != $fechaFinPractica) {
                            $cambios .= "Antes " . $datosAnterioresEtapa["fecha_fin_practica_seguimiento"] . ", Ahora " . $fechaFinPractica . ".";
                        }
                        if ($datosAnterioresEtapa["empresa_idempresa"] != $empresa) {
                            $cambios .= "Antes " . $datosAnterioresEtapa["nombre_empresa"] . ". ";
                        }
                        if ($datosAnterioresEtapa["modalidad_idmodalidad"] != $modalidad) {
                            $cambios .= "Antes " . $datosAnterioresEtapa["nombre_modalidad"] . ". ";
                        }
                        if ($datosAnterioresEtapa["observacion_seguimiento"] != $observacion_seguimiento) {
                            $cambios .= "Antes " . $datosAnterioresEtapa["observacion_seguimiento"] .  ", Ahora " . $observacion_seguimiento . ".";
                        }
                        $cambiosTotales = ($cambios == '') ? 'No hay cambios' : "cambios: " . $cambios;
                        $descripcion = "Se edito la etapa practica del aprendiz " . $datosAnterioresEtapa["nombres"] . " " . $datosAnterioresEtapa["apellidos"] . " con numero de identificaci¨®n " . $datosAnterioresEtapa["documento"] . " de la ficha " . $datosAnterioresEtapa["numero_ficha"] . " " . $datosAnterioresEtapa["caracterizacion"] . ". " . $cambiosTotales;
                        $sql = "INSERT INTO procesos_seguimientos(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                        $objRespuesta = $db->prepare($sql);
                        $objRespuesta->bindparam(":fecha", $fecha);
                        $objRespuesta->bindparam(":responsable", $responsable);
                        $objRespuesta->bindparam(":proceso", $proceso);
                        $objRespuesta->bindparam(":descripcion", $descripcion);
                        if ($objRespuesta->execute()) {
                            $objRespuesta = null;
                            // Actualizar documento si la modalidad es diferente de 1 y viene un archivo v¨¢lido
                            if ($modalidad != 1 && $documentoAlternativaPractica != null && $documentoAlternativaPractica != "no aplica" && isset($documentoAlternativaPractica['tmp_name']) && $documentoAlternativaPractica['tmp_name'] != '') {
                                $nuevoDocumento = seguimientoOtraAlternativaModelo::subirDocumento($documentoAlternativaPractica, $aprendiz);
                                if ($nuevoDocumento["codigo"] == "200") {
                                    $nuevaUrl = $nuevoDocumento["mensaje"];
                                    $sqlUpdateDoc = "UPDATE visita_seguimiento SET url_documento=:url_documento WHERE seguimiento_idseguimiento=:idseguimiento AND tipo_seguimiento_idtipo_seguimiento=3";
                                    $objUpdateDoc = $db->prepare($sqlUpdateDoc);
                                    $objUpdateDoc->bindparam(":url_documento", $nuevaUrl);
                                    $objUpdateDoc->bindparam(":idseguimiento", $idSeguimiento);
                                    $objUpdateDoc->execute();
                                    $objUpdateDoc = null;
                                }
                            }
                            $mensaje = ["codigo" => "200", "mensaje" => "Etapa practica modificada correctamente."];
                        } else {
                            $mensaje = ["codigo" => "401", "mensaje" => "Error al modificar etapa practica."];
                        }
                    } else {
                        $mensaje = array("codigo" => "401", "mensaje" => "no se pudo cambiar el estado del aprendiz.");
                    }
                } else {
                    $mensaje = array("codigo" => "401", "mensaje" => "Error al modificar etapa practica.");
                }
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "Error al modificar etapa practica.");
            }

            $db = null;
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlActulizarEtapaPracticaAprendiz($idAprendiz, $etapa_practica)
    {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE aprendiz SET etapa_practica=:etapa_practica WHERE idaprendiz=:idaprendiz");
            $objRespuesta->bindParam(":etapa_practica", $etapa_practica);
            $objRespuesta->bindParam(":idaprendiz", $idAprendiz);

            if ($objRespuesta->execute()) {
                $mensaje = array("codigo" => "200", "mensaje" => "Etapa practica actualizada correctamente.");
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "error al actualizar etapa practica");
            }
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlEliminarEtapaPractica($idSeguimiento, $idAprendiz, $datosSeguimiento, $modalidad)
    {
        $mensaje = array();
        $eliminarVisita = seguimientoOtraAlternativaModelo::mdlEliminarVisita($idSeguimiento);

        if ($eliminarVisita["codigo"] == "200") {
            try {
                $objRespuesta = Conexion::conectar()->prepare("DELETE FROM seguimiento WHERE idseguimiento=:idseguimiento");
                $objRespuesta->bindParam(":idseguimiento", $idSeguimiento);
                if ($objRespuesta->execute()) {
                    $objAprendiz = SeguimientoModelo::mdlActulizarEtapaPracticaAprendiz($idAprendiz, "1");
                    if ($objAprendiz["codigo"] == "200") {
                        $objRespuesta = null;
                        $fecha = date("Y-m-d H:i:s");
                        $responsable = $_SESSION["nombreCompleto"];
                        $proceso = "Elimino etapa practica";
                        $descripcion = "Se elimino la etapa practica del " . $datosSeguimiento;
                        $sql = "INSERT INTO procesos_seguimientos(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                        $objRespuesta = conexion::conectar()->prepare($sql);
                        $objRespuesta->bindparam(":fecha", $fecha);
                        $objRespuesta->bindparam(":responsable", $responsable);
                        $objRespuesta->bindparam(":proceso", $proceso);
                        $objRespuesta->bindparam(":descripcion", $descripcion);
                        if ($objRespuesta->execute()) {
                            $objRespuesta = null;
                            $mensaje = ["codigo" => "200", "mensaje" => "Etapa practica eliminada correctamente."];
                        } else {
                            $mensaje = ["codigo" => "401", "mensaje" => "Error al eliminar etapa practica"];
                        }
                        $mensaje = array("codigo" => "200", "mensaje" => "Etapa practica eliminada correctamente.");
                    } else {
                        $mensaje = array("codigo" => "401", "mensaje" => $objAprendiz["mensaje"]);
                    }
                } else {
                    $mensaje = array("codigo" => "401", "mensaje" => "No es posible eliminar una etapa practica con seguimientos asignados");
                }
                $objRespuesta = null;
            } catch (Exception $e) {
                $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
            }
        } else {
            $mensaje = array("codigo" => $eliminarVisita["codigo"], "mensaje" => $eliminarVisita["mensaje"]);
        }
        return $mensaje;
    }

    //nuevaEtapaPractica
    public static function verificarEtapasPracticas($aprendiz, $datosSeguimiento, $fechaInicioPractica, $fechaFinPractica)
    {
        $mensaje = [];
        try {
            $objConsulta = conexion::conectar()->prepare("SELECT * FROM seguimiento WHERE aprendiz_idaprendiz = :aprendiz");
            $objConsulta->bindParam(":aprendiz", $aprendiz);
            if ($objConsulta->execute()) {
                $datos = $objConsulta->fetchAll();
                if ($datos != null) {
                    try {
                        $etapaFragmentada = "1";
                        $estado_etapa_practica = "1";
                        $objConsulta2 = Conexion::conectar()->prepare("UPDATE seguimiento SET etapa_fragmentada = :etapaFragmentada, estado_etapa_practica = :estado_etapa_practica WHERE aprendiz_idaprendiz = :aprendiz");
                        $objConsulta2->bindparam(":etapaFragmentada", $etapaFragmentada);
                        $objConsulta2->bindparam(":estado_etapa_practica", $estado_etapa_practica);
                        $objConsulta2->bindparam(":aprendiz", $aprendiz);
                        if ($objConsulta2->execute()) {
                            $notificacionAprendizNuevaEtapaPractica = self::notificarAprendiz($aprendiz, $datosSeguimiento, $fechaInicioPractica, $fechaFinPractica);
                            if ($notificacionAprendizNuevaEtapaPractica["codigo"] == "200") {
                                $mensaje = ["codigo" => "200", "mensaje" => "se registrara una nueva etapa practica para el aprendiz"];
                            }else{
                                $mensaje = ["codigo" => "425", "mensaje" => "hubo un error al enviar el email"];
                            }
                        }
                        $objConsulta2 = null;
                    } catch (Exception $e) {
                        $mensaje = ["codigo" => "401", "mensaje" => $e->getMessage()];
                    }
                } else {
                    $mensaje = ["codigo" => "200", "mensaje" => "es su primera etapaPractica"];
                }
            }
            $objConsulta = null;
        } catch (Exception $e) {
            $mensaje = ["codigo" => "401", "mensaje" => $e->getMessage()];
        }
        return $mensaje;
    }

    public static function notificarAprendiz($aprendiz, $datosSeguimiento, $fechaInicioPractica, $fechaFinPractica)
    {
        $mensaje = [];
        try {
            $mensajePersonalizado = '<p><h4>Cordial saludo,</h4><br><p>';
            $mensajePersonalizado .= '<p>Estimado aprendiz le informamos que fue registrada su nueva etapa practica, para culminar con su etapa productiva.</p>';
            $mensajePersonalizado .= '<p>Detalles: (Empresa: '.$datosSeguimiento["empresa"].'), (Inicio Practica: '.$fechaInicioPractica.'), (Fin practica: '.$fechaFinPractica.')</p>';
            $mensajePersonalizado .='<br>';
            $mensajePersonalizado .='<p>Le recordamos modificar la informacion de las bitacoras registradas apartir de la fecha de inicio de su practica, adjuntado en el manual el paso a paso.<p/>';
            $mensajePersonalizado .='<p>Tambien le solicitamos una vez terminando su etapa practica, adjuntar todos los certificados laborales de la/s empresas donde culmino su etapa practica en un solo pdf, y subirlo en el apartado certificacion laboral.</p>';

            include '../vista/modulos/emailNuevaEtapaPractica.php';

            $mail = crearEmail('seguimientos@eproductiva.net', 'Alerta Nueva Etapa Practica');
            $mail->addAddress($datosSeguimiento["email"]);
            $mail->addCC('eproductiva9304@sena.edu.co');
            $mail->Subject = 'Alerta Nueva Etapa Practica';
            $mail->Body    = $cuerpoMensaje;
            $mail->AltBody = strip_tags($cuerpoMensaje);
            $mail->addAttachment('../vista/recursos/Instructivo_Aprendiz.pdf', 'Instructivo_Aprendiz.pdf');
            if ($mail->send()) {
                $mensaje = ["codigo" => "200"];
            } else {
                $mensaje = ["codigo" => "425"];
            }
        } catch (Exception $e) {
            $mensaje = ["codigo" => "400"];
        }
        return $mensaje;
    }

}