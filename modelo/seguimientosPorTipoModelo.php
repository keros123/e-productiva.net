<?php

include_once "conexion.php";
include_once "plantillaEmail.php";
include_once "../helpers/crearEmail.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


class seguimientosPorTipoModelo
{

    public static function mdlListarSeguimientosPorTipo($tipo, $estado)
    {
        try {
            $sql = "SELECT *, visita_seguimiento.*,
            seguimiento.fecha_radicado AS fecha_radicado_seguimiento,
             funcionario.nombres AS
             nombresfuncionario, funcionario.apellidos AS
              apellidosfuncionario, funcionario.documento AS
               documentofuncionario ,aprendiz.documento AS
                documentoaprendiz FROM visita_seguimiento 
                INNER JOIN estado_visita_seguimiento 
                ON visita_seguimiento.estado_visita_seguimiento_idestado_visita_seguimiento = estado_visita_seguimiento.idestado_visita_seguimiento 
                INNER JOIN tipo_seguimiento 
                ON visita_seguimiento.tipo_seguimiento_idtipo_seguimiento = tipo_seguimiento.idtipo_seguimiento 
                INNER JOIN funcionario ON visita_seguimiento.funcionario_idfuncionario = funcionario.idfuncionario 
                INNER JOIN seguimiento ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento 
                INNER JOIN aprendiz ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz 
                INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha 
                WHERE visita_seguimiento.asignacion = :asignacion 
                AND tipo_seguimiento.nombre_tipo_seguimiento = :tipo";
            $objConsulta = conexion::conectar()->prepare($sql);
            $objConsulta->bindParam(":asignacion", $estado);
            $objConsulta->bindParam(":tipo", $tipo);

            $objConsulta->execute();
            $datos = $objConsulta->fetchAll();
            $objConsulta = null;
        } catch (Exception $e) {
            $datos = $e->getMessage();
        }
        return $datos;
    }

    public static function mdlListarDetallesSeguimiento($id)
    {
        try {
            $sql = "SELECT *, visita_seguimiento.fecha_radicado AS fecha_radicado_visita 
            FROM visita_seguimiento 
            INNER JOIN estado_visita_seguimiento ON visita_seguimiento.estado_visita_seguimiento_idestado_visita_seguimiento = estado_visita_seguimiento.idestado_visita_seguimiento 
            INNER JOIN seguimiento ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento 
            INNER JOIN empresa ON seguimiento.empresa_idempresa = empresa.idempresa 
            INNER JOIN municipios ON empresa.municipios_codi_muni = municipios.codi_muni 
            INNER JOIN departamentos ON municipios.departamentos_codi_depa = departamentos.codi_depa 
            INNER JOIN modalidad ON seguimiento.modalidad_idmodalidad =
            modalidad.idmodalidad WHERE visita_seguimiento.idvisita_seguimiento = :id";
            $objConsulta = conexion::conectar()->prepare($sql);
            $objConsulta->bindParam(":id", $id);

            $objConsulta->execute();
            $datos = $objConsulta->fetchAll();
            $objConsulta = null;
        } catch (Exception $e) {
            $datos = $e->getMessage();
        }
        return $datos;
    }

    public static function mdlCrearNovedad($id, $novedad, $creador, $emailNovedad)
    {
        $mensaje = [];
        $fecha = date("Y-m-d H:i:s");
        $autor = $_SESSION["nombreCompleto"];

        if ($creador == "administrador") {
            // Obtener información del aprendiz y ficha para incluir en el correo
            $infoAprendiz = self::obtenerInfoAprendizPorVisitaSeguimiento($id);

            include '../vista/modulos/plantillaEmailNovedades.php';

            $mail = crearEmail('seguimientos@eproductiva.net', 'Novedad Reporte de Seguimiento subido');
            $mail->addAddress($emailNovedad);
            $mail->Subject = "Novedad Reporte Seguimiento - Aprendiz: " . $infoAprendiz['nombreAprendiz'] . " " . $infoAprendiz['apellidosAprendiz'];
            $mail->Body    = $cuerpoMensajeNovedadReporte;
            $mail->AltBody = strip_tags($cuerpoMensajeNovedadReporte);
            if ($mail->send()) {
                $mensaje = ["codigo" => "200", "mensaje" => "Novedad enviada Exitosamente", "creador" => $creador];
            } else {
                $mensaje = ["codigo" => "425", "mensaje" => "Error al enviar la Novedad", "creador" => $creador];
            }

            if ($mensaje["codigo"] == "200") {
                try {

                    $sql = "INSERT INTO novedad_visita_seguimiento(fecha_hora_novedad,autor,novedad,visita_seguimiento_idvisita_seguimiento) VALUES(:fecha,:autor,:novedad,:id)";
                    $objConsulta = conexion::conectar()->prepare($sql);
                    $objConsulta->bindParam(":id", $id);
                    $objConsulta->bindParam(":novedad", $novedad);
                    $objConsulta->bindParam(":fecha", $fecha);
                    $objConsulta->bindParam(":autor", $autor);

                    if ($objConsulta->execute()) {
                        $mensaje = ["codigo" => "200", "mensaje" => "novedad agregada con exito", "creador" => $creador];
                    } else {
                        $mensaje = ["codigo" => "425", "mensaje" => "error al agregar novedad", "creador" => $creador];
                    }

                    $objConsulta = null;
                } catch (Exception $e) {
                    $mensaje = ["codigo" => "425", "mensaje" => $e->getMessage(), "creador" => $creador];
                }
            } else {
                $mensaje = ["codigo" => "425", "mensaje" => "Error al enviar la Novedad", "creador" => $creador];
            }
        } else {
            try {

                $sql = "INSERT INTO novedad_visita_seguimiento(fecha_hora_novedad,autor,novedad,visita_seguimiento_idvisita_seguimiento) VALUES(:fecha,:autor,:novedad,:id)";
                $objConsulta = conexion::conectar()->prepare($sql);
                $objConsulta->bindParam(":id", $id);
                $objConsulta->bindParam(":novedad", $novedad);
                $objConsulta->bindParam(":fecha", $fecha);
                $objConsulta->bindParam(":autor", $autor);

                if ($objConsulta->execute()) {
                    $mensaje = ["codigo" => "200", "mensaje" => "novedad agregada con exito", "creador" => $creador];
                } else {
                    $mensaje = ["codigo" => "425", "mensaje" => "error al agregar novedad", "creador" => $creador];
                }

                $objConsulta = null;
            } catch (Exception $e) {
                $mensaje = ["codigo" => "425", "mensaje" => $e->getMessage(), "creador" => $creador];
            }
        }

        return $mensaje;
    }

    // Método para obtener información del aprendiz a partir del ID de visita seguimiento
    private static function obtenerInfoAprendizPorVisitaSeguimiento($idVisitaSeguimiento)
    {
        try {
            $sql = "SELECT 
                aprendiz.nombres AS nombreAprendiz, 
                aprendiz.apellidos AS apellidosAprendiz,
                ficha.numero_ficha,
                ficha.caracterizacion
            FROM visita_seguimiento 
            INNER JOIN seguimiento ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento
            INNER JOIN aprendiz ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz
            INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha
            WHERE visita_seguimiento.idvisita_seguimiento = :id";

            $objConsulta = conexion::conectar()->prepare($sql);
            $objConsulta->bindParam(":id", $idVisitaSeguimiento);
            $objConsulta->execute();
            $datos = $objConsulta->fetch(PDO::FETCH_ASSOC);
            $objConsulta = null;

            return $datos;
        } catch (Exception $e) {
            return [
                'nombreAprendiz' => 'No disponible',
                'apellidosAprendiz' => '',
                'numero_ficha' => 'No disponible',
                'caracterizacion' => 'No disponible'
            ];
        }
    }


    public static function mdlReasignarInstructor($idVisitaSeguimiento, $idFuncionario, $fechaVencimiento)
    {
        $mensaje = [];
        try {
            // 1. Abrimos una única conexión para todo el proceso
            $conexion = Conexion::conectar();

            // 2. Obtener el correo y el ID del anterior instructor para poder validar 
            $stmtAnterior = $conexion->prepare("SELECT funcionario.idfuncionario, funcionario.email, visita_seguimiento.fecha_vencimiento 
                                                FROM funcionario 
                                                INNER JOIN visita_seguimiento ON funcionario.idfuncionario = visita_seguimiento.funcionario_idfuncionario 
                                                WHERE visita_seguimiento.idvisita_seguimiento = :idvisita_seguimiento");
            $stmtAnterior->bindParam(":idvisita_seguimiento", $idVisitaSeguimiento);
            $stmtAnterior->execute();
            $infoAnterior = $stmtAnterior->fetch(PDO::FETCH_ASSOC);
            $stmtAnterior = null;

            // Validar si realmente hay un cambio (evita procesos innecesarios)
            if ($infoAnterior && $infoAnterior["idfuncionario"] == $idFuncionario && $infoAnterior["fecha_vencimiento"] == $fechaVencimiento) {
                return ["codigo" => "200", "message" => "El seguimiento ya cuenta con estos datos asignados. No se realizaron cambios."];
            }

            // Solo incluiremos en CC al instructor anterior si el instructor realmente cambió.
            // Si el instructor se mantiene pero solo cambió la fecha de vencimiento, 
            // el correo se le enviará directamente en el "ADDADDRESS" y omitiremos el CC redundante.
            $emailAnterior = ($infoAnterior && $infoAnterior["idfuncionario"] != $idFuncionario) ? $infoAnterior["email"] : null;

            // 3. Sentencia UPDATE
            $stmtUpdate = $conexion->prepare("UPDATE visita_seguimiento 
                                              SET funcionario_idfuncionario = :funcionario_idfuncionario, 
                                                  fecha_vencimiento = :fecha_vencimiento 
                                              WHERE idvisita_seguimiento = :idvisita_seguimiento");
            $stmtUpdate->bindParam(":funcionario_idfuncionario", $idFuncionario);
            $stmtUpdate->bindParam(":fecha_vencimiento", $fechaVencimiento);
            $stmtUpdate->bindParam(":idvisita_seguimiento", $idVisitaSeguimiento);
            
            if ($stmtUpdate->execute()) {
                $stmtUpdate = null;

                // 4. Sentencia SELECT con la información nueva para el correo
                $stmtInfo = $conexion->prepare("SELECT visita_seguimiento.fecha_vencimiento, visita_seguimiento.ubicacion_seguimiento, tipo_seguimiento.nombre_tipo_seguimiento, aprendiz.nombres AS nombreAprendiz, aprendiz.apellidos AS apellidosAprendiz, aprendiz.email AS emailAprendiz, aprendiz.telefono AS telefonoAprendiz, ficha.numero_ficha, ficha.caracterizacion, funcionario.nombres, funcionario.apellidos, funcionario.email 
                                                FROM visita_seguimiento 
                                                INNER JOIN seguimiento ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento 
                                                INNER JOIN tipo_seguimiento ON visita_seguimiento.tipo_seguimiento_idtipo_seguimiento = tipo_seguimiento.idtipo_seguimiento 
                                                INNER JOIN aprendiz ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz 
                                                INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha 
                                                INNER JOIN funcionario ON visita_seguimiento.funcionario_idfuncionario = funcionario.idfuncionario 
                                                WHERE visita_seguimiento.idvisita_seguimiento = :idvisita_seguimiento");
                $stmtInfo->bindParam(":idvisita_seguimiento", $idVisitaSeguimiento);
                $stmtInfo->execute();
                $objInfoEmail = $stmtInfo->fetch(PDO::FETCH_ASSOC);
                $stmtInfo = null;

                // 5. Validamos que la información por correo exista antes de intentar enviarlo
                if ($objInfoEmail) {
                    $cuerpoMensaje = mdlPlantillaEmail::crearCuerpoMensaje(
                        $objInfoEmail["nombre_tipo_seguimiento"], 
                        $objInfoEmail["nombreAprendiz"] . " " . $objInfoEmail["apellidosAprendiz"], 
                        $objInfoEmail["telefonoAprendiz"], 
                        $objInfoEmail["numero_ficha"] . " - " . $objInfoEmail["caracterizacion"], 
                        $objInfoEmail["nombres"] . " " . $objInfoEmail["apellidos"], 
                        $objInfoEmail["fecha_vencimiento"], 
                        $objInfoEmail["ubicacion_seguimiento"]
                    );

                    $mail = crearEmail('seguimientos@eproductiva.net', 'Novedad Reporte Seguimiento');
                    $mail->addAddress($objInfoEmail["email"]);
                    $mail->addCC($objInfoEmail["emailAprendiz"]);
                    if ($emailAnterior) {
                        $mail->addCC($emailAnterior);
                    }
                    $mail->Subject = "Novedad Reporte Seguimiento";
                    $mail->Body    = $cuerpoMensaje;
                    $mail->AltBody = strip_tags($cuerpoMensaje);

                    if ($mail->send()) {
                        $mensaje = ["codigo" => "200", "message" => "Seguimiento reasignado correctamente"];
                    } else {
                        // Retornamos 200 porque en DB sí guardó correctamente
                        $mensaje = ["codigo" => "200", "message" => "Seguimiento reasignado. (Nota: Hubo un fallo enviando el correo electrónico)"];
                    }
                } else {
                    $mensaje = ["codigo" => "200", "message" => "Seguimiento reasignado, pero sin información para notificar."];
                }
            } else {
                $mensaje = ["codigo" => "401", "message" => "Error! no fue posible reasignar el seguimiento"];
            }
        } catch (Exception $e) {
            $mensaje = ["codigo" => "401", "message" => "Error de servidor: " . $e->getMessage()];
        }

        return $mensaje;
    }


    public static function mdlCambiarEstadoReporte($id, $estado)
    {
        try {
            $idAprendiz = null;
            $tipoSeguimiento = null;
            $mensaje = array("codigo" => "200");

            // consultar datos del seguimiento
            $objRespuesta = Conexion::conectar()->prepare("SELECT aprendiz.idaprendiz,visita_seguimiento.tipo_seguimiento_idtipo_seguimiento FROM visita_seguimiento INNER JOIN seguimiento ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento INNER JOIN aprendiz ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz WHERE visita_seguimiento.idvisita_seguimiento = :id");
            $objRespuesta->bindParam(":id", $id);
            $objRespuesta->execute();
            $objVisitaSeguimiento = $objRespuesta->fetch();
            $objRespuesta = null;

            if ($objVisitaSeguimiento != null) {
                $idAprendiz = $objVisitaSeguimiento["idaprendiz"];
                $tipoSeguimiento = $objVisitaSeguimiento["tipo_seguimiento_idtipo_seguimiento"];

                // seguimiento final cambiar estado al aprendiz por certificar
                if ($tipoSeguimiento == "2" || $tipoSeguimiento == "5") {
                    if ($estado == 1) {
                        $estadoAprendiz = 9; // En proceso de certificación
                    } else {
                        $estadoAprendiz = 2; // en formación
                    }

                    $objRespuesta = Conexion::conectar()->prepare("UPDATE aprendiz SET estado_aprendiz_idestado_aprendiz = :estado_aprendiz_idestado_aprendiz WHERE idaprendiz=:idaprendiz");
                    $objRespuesta->bindParam(":estado_aprendiz_idestado_aprendiz", $estadoAprendiz);
                    $objRespuesta->bindParam(":idaprendiz", $idAprendiz);
                    if ($objRespuesta->execute()) {
                        $mensaje = array("codigo" => "200", "mensaje" => "el estado del aprendiz se modifico correctamente");
                    } else {
                        $mensaje = array("codigo" => "401", "mensaje" => "error! al modificar el estado del aprendiz");
                    }
                    $objRespuesta = null;
                }
            }



            if ($mensaje["codigo"] == "200") {
                $mensaje = array();
                $sql = "UPDATE visita_seguimiento SET estado_reporte = :estado WHERE idvisita_seguimiento = :id";
                $objConsulta = conexion::conectar()->prepare($sql);
                $objConsulta->bindParam(":id", $id);
                $objConsulta->bindParam(":estado", $estado);

                if ($objConsulta->execute()) {
                    $mensaje = array("codigo" => "200", "estado" => $estado);
                } else {
                    $mensaje = array("codigo" => "425", "estado" => "");
                }
                $objConsulta = null;
            }
        } catch (Exception $e) {
            $mensaje = ["codigo" => "425", "mensaje" => $e->getMessage()];
        }
        return $mensaje;
    }


    public static function mdlCambiarTipoSeguimiento($idVisitaSeguimiento, $idTipoSeguimiento, $ubicacion)
    {
        $mensaje = [];
        try {
            $sql = "UPDATE visita_seguimiento SET tipo_seguimiento_idtipo_seguimiento = :tipo_seguimiento_idtipo_seguimiento , ubicacion_seguimiento = :ubicacion_seguimiento WHERE idvisita_seguimiento = :id";
            $objConsulta = Conexion::conectar()->prepare($sql);
            $objConsulta->bindParam(":id", $idVisitaSeguimiento);
            $objConsulta->bindParam(":tipo_seguimiento_idtipo_seguimiento", $idTipoSeguimiento);
            $objConsulta->bindParam(":ubicacion_seguimiento", $ubicacion);

            if ($objConsulta->execute()) {
                // consultar el seguimiento modificado y optener el id 
                $objRespuesta = Conexion::conectar()->prepare("SELECT seguimiento_idseguimiento FROM visita_seguimiento WHERE idvisita_seguimiento=:id");
                $objRespuesta->bindParam(":id", $idVisitaSeguimiento);
                $objRespuesta->execute();
                $objVisitaSeguimiento = $objRespuesta->fetch();
                $idSeguimiento = $objVisitaSeguimiento["seguimiento_idseguimiento"];
                $objRespuesta = null;

                // actualizar el estado de la etapa practica
                $objRespuesta = Conexion::conectar()->prepare("UPDATE seguimiento SET estado_etapa=:estado_etapa WHERE idseguimiento=:id");
                $objRespuesta->bindParam(":estado_etapa", $idTipoSeguimiento);
                $objRespuesta->bindParam(":id", $idSeguimiento);
                if ($objRespuesta->execute()) {
                    $mensaje = array("codigo" => "200", "mensaje" => "Seguimiento modificado correctamente");
                }
            } else {
                $mensaje = array("codigo" => "401", "mensaje" => "No fue posible cambiar el tipo de seguimiento");
            }
            $objConsulta = null;
        } catch (Exception $e) {
            $mensaje = ["codigo" => "401", "mensaje" => $e->getMessage()];
        }
        return $mensaje;
    }

    public static function mdlEliminarVisitaSeguimiento($idVisitaSeguimiento, $tipoSeguimiento, $idSeguimiento, $idAprendiz, $url_archivo)
    {
        $mensaje = [];
        try {
            $error = false;
            // validamos que la ruta del archivo exista
            if ($url_archivo != null || $url_archivo != "") {
                if (file_exists("../" . $url_archivo)) {
                    // eliminamos el archivo
                    if (!unlink("../" . $url_archivo)) {
                        $error = true;
                    }
                }
            }

            if (!$error) {
                // eliminamos el seguimiento
                $objRespuesta = Conexion::conectar()->prepare("DELETE FROM visita_seguimiento WHERE idvisita_seguimiento=:id");
                $objRespuesta->bindParam(":id", $idVisitaSeguimiento);
                if ($objRespuesta->execute()) {
                    // buscamos que seguimientos tiene el aprendiz hasta el momento 
                    $objRespuesta = null;
                    $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM visita_seguimiento WHERE seguimiento_idseguimiento = :seguimiento_idseguimiento ORDER BY tipo_seguimiento_idtipo_seguimiento DESC");
                    $objRespuesta->bindParam(":seguimiento_idseguimiento", $idSeguimiento);
                    $objRespuesta->execute();
                    $listaSeguimientos = $objRespuesta->fetchAll();
                    $ultimoSeguimiento = end($listaSeguimientos);
                    if (!$ultimoSeguimiento) {
                        $tipo_seguimiento = "";
                    } else {
                        $tipo_seguimiento = $ultimoSeguimiento["tipo_seguimiento_idtipo_seguimiento"];
                    }
                    $objRespuesta = null;
                    // actualizamos el estado de la etapa practica para saber en que etapa de seguimiento se encuentra 
                    // "" = sin asignar , 1= parcial , 2= final, 3=Momento_1, 4=Momento_2, 5=Momento_3, 6=Extraordinario 
                    $objRespuesta = Conexion::conectar()->prepare("UPDATE seguimiento SET estado_etapa=:estado_etapa WHERE idseguimiento=:id");
                    $objRespuesta->bindParam(":estado_etapa", $tipo_seguimiento);
                    $objRespuesta->bindParam(":id", $idSeguimiento);
                    if (!$objRespuesta->execute()) {
                        $error = true;
                    }

                    if (!$error) {
                        $mensaje = ["codigo" => "200", "message" => "seguimiento eliminado correctamente"];
                    }
                } else {
                    $mensaje = ["codigo" => "401", "message" => "No fue posible borrar el seguimiento"];
                }
            }
        } catch (Exception $e) {
            $mensaje = ["codigo" => "401", "message" => $e->getMessage()];
        }

        return $mensaje;
    }
}
