<?php

include_once "conexion.php";
include_once "subirArchivoModelo.php";
include_once "emailReporteSeguimiento.php";
include_once "../helpers/crearEmail.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class modeloSeguimientosAsignados
{

    public static function mdlCargarSeguimientosAsignados($id)
    {
        try {
            $asignacion = "2";
            $sql = "SELECT *
                      FROM visita_seguimiento
                INNER JOIN estado_visita_seguimiento
                        ON visita_seguimiento.estado_visita_seguimiento_idestado_visita_seguimiento = estado_visita_seguimiento.idestado_visita_seguimiento
                INNER JOIN seguimiento
                        ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento
                INNER JOIN tipo_seguimiento
                        ON visita_seguimiento.tipo_seguimiento_idtipo_seguimiento = tipo_seguimiento.idtipo_seguimiento
                INNER JOIN aprendiz
                        ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz
                INNER JOIN ficha
                        ON aprendiz.ficha_idficha = ficha.idficha
                     WHERE visita_seguimiento.funcionario_idfuncionario = :id
                       AND visita_seguimiento.asignacion            = :asignacion";
            $objConsulta = conexion::conectar()->prepare($sql);
            $objConsulta->bindParam(":id", $id);
            $objConsulta->bindParam(":asignacion", $asignacion);
            $objConsulta->execute();
            $datos = $objConsulta->fetchAll();
            $objConsulta = null;
        } catch (Exception $e) {
            $datos = $e->getMessage();
        }
        return $datos;
    }


    /* ---------------Metodo para subir reporte de seguimientos etapa practica Instructor-------------------- */
    /* Fecha de Creacion :             Desarrollador: Marco Antonio Cipagauta Arbelaez                        */
    /* Parametros :                                                                                           */
    /* Retorno :                                                                                              */
    /* -------------------------------------------------------------------------------------------------------*/
    /* --------------------------------------Control de cambios ----------------------------------------------*/
    /* Desarrollador: Marco Antonio Cipagauta Arbeláez           fecha: 27/08/2025                            */
    /* Descripcion: Se agrego validacion de numero de bitacoras para cada momento del seguimiento con el fin  */
    /*              de obligar al instructor a revisarlas y aprobarlas para habilitar subida de archivo       */
    /* -------------------------------------------------------------------------------------------------------*/
    /* Desarrollador: Marco Antonio Cipagauta Arbeláez           fecha: 23/09/2025                            */
    /* Descripcion: Se corrigio validacion de subida de archivos cuando la funcion  mdlEliminarArchivo retorna
       vacio por que el archivo no existe ("")                                                                */
    /*--------------------------------------------------------------------------------------------------------*/
    /* Desarrollador: Marco Antonio Cipagauta Arbeláez           fecha: 05/02/2026                            */
    /* Descripcion: Se agregaron campos de $imagenJuicioEvaluativo, $rutaJuicio para subir pantallazo
                    de evidencia de calificacion de resultado de etapa practica para seguimiento momento 3    */
    /*--------------------------------------------------------------------------------------------------------*/
    public static function mdlSubirReporteSeguimiento($tipoUsuario, $documentoAprendiz, $idVisitaSeguimiento, $ficha, $archivo, $rutaActual,$imagenJuicioEvaluativo,$rutaJuicio){
        $mensaje = [];
        $prueba = true;

        $verificarBitacorasSeguimiento = self::mdlVerificarBitacorasSeguimiento($idVisitaSeguimiento,$documentoAprendiz);
        if ($verificarBitacorasSeguimiento["success"]){
            // if ($prueba){
            $eliminarArchivo = ($rutaActual !== "") ? subirArchivo::mdlEliminarArchivo($rutaActual) : "ok";
            $eliminarArchivoJuicio = "";
            if ($imagenJuicioEvaluativo != null){
                $eliminarArchivoJuicio = ($rutaJuicio !== "") ? subirArchivo::mdlEliminarArchivo($rutaJuicio) : "ok";
            }else{
              $eliminarArchivoJuicio = "ok";  
            }

            if (($eliminarArchivo == "ok" || $eliminarArchivo == "") && ($eliminarArchivoJuicio = "ok" || $eliminarArchivoJuicio = "")){

                // obtener estado del reporte del seguimiento para verificar si se habia rechazado
                $objReporte = self::mdlValidarEstadoSeguimiento($idVisitaSeguimiento);

                if ($objReporte["success"]){
                    $objDatosAprendiz = ["numero_ficha" => $ficha, "documento" => $documentoAprendiz];
                    $tipoSolicitud = null;
                    $ruta = subirArchivo::mdlCrearfolderUsuario($objDatosAprendiz, $tipoUsuario, $tipoSolicitud);
                    if ($ruta["codigo"] == "202") {
                        $base = '../' . $ruta["mensaje"] . "/seguimiento";
                        if (!file_exists($base) && !mkdir($base, 0777, true)) {
                            $mensaje = ["codigo" => "425", "mensaje" => "No fue posible crear la carpeta /seguimiento"];
                        }else{

                            // configuracion subida reporte seguimientos
                            $splitFile     = explode('.', $archivo['name']);
                            $nombreArchivo = uniqid('Seguimiento-') . '.' . end($splitFile);
                            $rutaReporte   = $base . "/" . $nombreArchivo;
                            $rutaReporteBD = $ruta["mensaje"] . "/seguimiento/" . $nombreArchivo;
                            $error = true;
                            $mensajeError = "";
                            if (!move_uploaded_file($archivo['tmp_name'], $rutaReporte)) {
                                $mensajeError .= "No fue posible subir el reporte de seguimiento de etapa practica.";
                            }else{
                                $error = false;
                            }

                            // cofiguracion subida imagen juicios evaluativos solo para seguimiento momento 3
                            $rutaJuicioBD = "";
                            if ($imagenJuicioEvaluativo != null && !$error){
                                $splitFile     = explode('.', $imagenJuicioEvaluativo['name']);
                                $nombreArchivoJuicio = uniqid('Juicio-') . '.' . end($splitFile);
                                $rutaJuicioEvaluativo   = $base . "/" . $nombreArchivoJuicio;
                                $rutaJuicioBD = $ruta["mensaje"] . "/seguimiento/" . $nombreArchivoJuicio;
                                $error = true;

                                if (!move_uploaded_file($imagenJuicioEvaluativo['tmp_name'], $rutaJuicioEvaluativo)) {
                                    $mensajeError .= " No fue posible cargar la imagen de evidencia correspondiente a la calificación del resultado de aprendizaje en la etapa práctica.";
                                }else{
                                    $error = false;
                                }
                            }


                            if ($error) {
                                $mensaje = ["codigo" => "425", "mensaje" => $mensajeError];
                            }else{
                                $fechaEntrega = date("Y-m-d");
                                // cabiamos el estado del seguimiento a 2= realizado
                                $estadoVisitaSeguimiento = 2; 
                                try {
                                    $sql = "UPDATE visita_seguimiento SET url_documento=:archivo,url_juicio_evaluativo=:url_juicio_evaluativo,fecha_entrega=:fechaEntrega,estado_visita_seguimiento_idestado_visita_seguimiento=:nuevoEstado,estado_reporte=:estadoReporte WHERE idvisita_seguimiento=:id";
                                    $objConsulta = conexion::conectar()->prepare($sql);
                                    $objConsulta->bindParam(":id",           $idVisitaSeguimiento);
                                    $objConsulta->bindParam(":archivo",      $rutaReporteBD);
                                    $objConsulta->bindParam(":url_juicio_evaluativo", $rutaJuicioBD);
                                    $objConsulta->bindParam(":fechaEntrega", $fechaEntrega);
                                    $objConsulta->bindParam(":nuevoEstado",  $estadoVisitaSeguimiento);
                                    $objConsulta->bindValue(":estadoReporte", "0", PDO::PARAM_STR_CHAR);
                                    
                                    if ($objConsulta->execute()){
                                        // si el reporte habia sido rechazado con anterioridad envia correo a certificacion de que se ha subido nuevamente
                                        if ($objReporte["estado_reporte"] == "2"){
                                            try {
                                                $sqlInfo = "SELECT a.nombres,a.apellidos,f.numero_ficha,f.caracterizacion,func.nombres AS nombreInstructor,func.apellidos AS apellidoInstructor,ts.nombre_tipo_seguimiento FROM visita_seguimiento vs INNER JOIN seguimiento s ON vs.seguimiento_idseguimiento = s.idseguimiento INNER JOIN aprendiz a ON s.aprendiz_idaprendiz = a.idaprendiz INNER JOIN ficha f ON a.ficha_idficha = f.idficha INNER JOIN funcionario func ON vs.funcionario_idfuncionario = func.idfuncionario INNER JOIN tipo_seguimiento ts ON vs.tipo_seguimiento_idtipo_seguimiento = ts.idtipo_seguimiento WHERE vs.idvisita_seguimiento = :id";

                                                $stmtInfo = conexion::conectar()->prepare($sqlInfo);
                                                $stmtInfo->bindParam(":id", $idVisitaSeguimiento);
                                                $stmtInfo->execute();
                                                $info      = $stmtInfo->fetch(PDO::FETCH_ASSOC);
                                                $stmtInfo  = null;
                                                if ($objReporte["estado_reporte"] == "2"){
                                                    $mensaje = self::mdlRadicarEmailCertificacion($info);
                                                }else{
                                                    $mensaje = ["codigo" => "200", "mensaje" => "Correcto"];
                                                }

                                            } catch (Exception $e) {
                                                $mensaje = ["codigo" => "425", "mensaje" => $e->getMessage()];
                                            }
                                        }else{
                                            $mensaje = ["codigo" => "200", "mensaje" => "Correcto"];
                                        }
                                    }else{
                                        $mensaje = ["codigo" => "425", "mensaje" => "No fue posible actualizar el estado del seguimiento"];
                                    }

                                    $objConsulta = null;
                                } catch (Exception $e) {
                                    $mensaje = ["codigo" => "425", "mensaje" => $e->getMessage()];
                                }
                            }
                        }
                    }else{
                        $mensaje = ["codigo" => "425", "mensaje" => "Error al crear carpetas"];
                    }
                }else{
                    $mensaje = ["codigo" => "425", "mensaje" => $objReporte["message"]];
                }
            }else{
                $mensaje = ["codigo" => "425", "mensaje" => "Error eliminando archivo previo"];
            }
        }else{
            $mensaje = ["codigo" => "425", "mensaje" => $verificarBitacorasSeguimiento["message"]];
        }

        return $mensaje;
    }


    /* ------------------------------- Validar Estado seguimiento ------------------------------------------- */
    /* Fecha de Creacion :  27/08/2025           Desarrollador: Marco Antonio Cipagauta Arbelaez              */
    /* Parametros : idVisitaSeguimiento                                                                       */
    /* Retorno : ["success"=>true,"estado_reporte"=>$estado_reporte] o ["success"=>false,"message"=>"mensaje"]*/
    /*           estado_reporte: vacio=sin documento 0=entregado  1=aprobado 2= Rechazado                     */
    /* -------------------------------------------------------------------------------------------------------*/
    /* --------------------------------------Control de cambios ----------------------------------------------*/
    /* Desarrollador:                                          fecha:                                         */
    /* Descripcion:                                                                                           */
    /*--------------------------------------------------------------------------------------------------------*/
    public static function mdlValidarEstadoSeguimiento($idVisitaSeguimiento){
        $mensaje = [];
        try {
            $estado_reporte = "";
            $objRespuesta = Conexion::conectar()->prepare("SELECT estado_reporte FROM visita_seguimiento WHERE idvisita_seguimiento = :id");
            $objRespuesta->bindParam(":id", $idVisitaSeguimiento);
            if ($objRespuesta->execute()){
                $objVisitaSeguimiento = $objRespuesta->fetch();
                $estado_reporte = $objVisitaSeguimiento['estado_reporte'];
                $mensaje = ["success"=>true,"estado_reporte"=>$estado_reporte];
            }else{
                $mensaje = ["success"=>false,"message"=>"no se encontro una visita de seguimiento con codigo ".$idVisitaSeguimiento];
            }
        } catch (Exception $error) {
            $mensaje = ["success"=>false,"message"=>$error->getMessage()];
        }

        return $mensaje;
    }

    /* ------------------------------- Radicar Email a Certificacion ---------------------------------------- */
    /* Fecha de Creacion :  27/08/2025           Desarrollador: Marco Antonio Cipagauta Arbelaez              */
    /* Parametros : objDatosEmail                                                                             */
    /* Retorno :["codigo" => "200", "mensaje" => "Correcto"] o ["codigo" => "425", "mensaje" => "error"]      */
    /* -------------------------------------------------------------------------------------------------------*/
    /* --------------------------------------Control de cambios ----------------------------------------------*/
    /* Desarrollador:                                          fecha:                                         */
    /* Descripcion:                                                                                           */
    /*--------------------------------------------------------------------------------------------------------*/
    public static function mdlRadicarEmailCertificacion($objDatosEmail){
        try {
            $plantilla   = new mdlPlantillaEmailReporteSeguimiento();
            $cuerpoEmail = $plantilla->crearCuerpoMensajeReporteSeguimiento(
                $objDatosEmail['nombres'] . ' ' . $objDatosEmail['apellidos'],
                $objDatosEmail['caracterizacion'],
                $objDatosEmail['nombreInstructor'] . ' ' . $objDatosEmail['apellidoInstructor'],
                $objDatosEmail['numero_ficha'],
                $objDatosEmail['nombre_tipo_seguimiento']
            );

            $mail = crearEmail('seguimientos@eproductiva.net', 'Reporte Seguimiento Resubido');
            $mail->addAddress('certificacioncimm@sena.edu.co');
            $mail->Subject = "Seguimiento Resubido";
            $mail->Body    = $cuerpoEmail;
            $mail->AltBody = strip_tags($cuerpoEmail);
            if ($mail->send()){
                $mensaje = ["codigo" => "200", "mensaje" => "Correcto"];
            }else{
                $mensaje = ["codigo" => "425", "mensaje" => "No fue posible enviar email a certificación"];
            }

        } catch (Exception $e) {
            $mensaje = ["codigo" => "425", "mensaje" => $e->getMessage()];
        }

        return $mensaje;
    }
    
    /* ----------------------------------------------------------------------------------------------------------*/
    /* Validar estado y numero de bitacoras subidas por el aprendiz y aprobadas por el instructor de seguimiento */
    /* Fecha de Creacion :  27/08/2025           Desarrollador: Marco Antonio Cipagauta Arbelaez                 */
    /* Parametros :                                                                                              */
    /* Retorno :                                                                                                 */
    /* ----------------------------------------------------------------------------------------------------------*/
    /* --------------------------------------Control de cambios -------------------------------------------------*/
    /* Desarrollador:  Marco Antonio Cipagauta                 fecha:  23/09/2025                                */
    /* Descripcion:  se agrego validacion para programas de tipo operario y se complemento mensaje de error       */
    /*-----------------------------------------------------------------------------------------------------------*/
    public static function mdlVerificarBitacorasSeguimiento($idVisitaSeguimiento,$documentoAprendiz){
        $mensaje = [];
        try {
            $objSeguimiento = self::mdlInfoVisitaSeguimiento($idVisitaSeguimiento);

            if ($objSeguimiento["success"]){
                $momentoSeguimiento = $objSeguimiento["seguimiento"]["tipo_seguimiento_idtipo_seguimiento"];
                $duracionPractica = $objSeguimiento["seguimiento"]["duracion_practica"];
                
                // Si el momento es 3 (Momento 1) o 6 (Extraordinario), permitimos subir el reporte sin validar bitácoras
                if ($momentoSeguimiento == "3" || $momentoSeguimiento == "6") {
                    return ["success" => true];
                }

                $objBitacoras = self::mdlInfoBitacoras($documentoAprendiz);
                if ($objBitacoras["success"]){
                    $totalBitacorasAprobadas = count($objBitacoras["listaBitacorasAprobadas"]);
                    $totalBitacorasEntregadas = count($objBitacoras["listaBitacorasEntregadasSinAprobar"]);
                    $totalBitacorasFecha = self::mdlTotalBitacorasFecha($objSeguimiento["seguimiento"]["fecha_inicio_practica"],date("Y-m-d"),$duracionPractica);
                    $mensaje = ["success" => false];

                    $momento = "";
                    if ($momentoSeguimiento == "1"){
                        $momento = "Parcial";
                    }else if($momentoSeguimiento == "2"){
                        $momento = "Final";
                    }else if ($momentoSeguimiento == "3"){
                        $momento = "uno";
                    }else if($momentoSeguimiento == "4"){
                        $momento = "dos";
                    }else if($momentoSeguimiento == "5"){
                        $momento = "tres";
                    }

                    if ($duracionPractica == "3"){
                        // validacion de bitacoras para programas de formacion igual a operarios
                        if ((($momentoSeguimiento == "1" || $momentoSeguimiento == "4") && (($totalBitacorasAprobadas >= 3 && $totalBitacorasAprobadas <= 4) || ($totalBitacorasAprobadas > 4))) ||
                            (($momentoSeguimiento == "2" || $momentoSeguimiento == "5") && $totalBitacorasAprobadas == 6)) {
                            
                                $mensaje = ["success" => true];
                        }
                    }else{
                        // validacion de bitacoras para programas de formacion igual a tecnicos y tecnologos
                        if ((($momentoSeguimiento == "1" || $momentoSeguimiento == "4") && (($totalBitacorasAprobadas >= 4 && $totalBitacorasAprobadas <= 8) || ($totalBitacorasAprobadas > 8))) ||
                            (($momentoSeguimiento == "2" || $momentoSeguimiento == "5") && $totalBitacorasAprobadas == 12)) {
                            
                                $mensaje = ["success" => true];
                        }
                    }
                  
                    if (!$mensaje["success"]) {
                        if ($momentoSeguimiento == "2" || $momentoSeguimiento == "5"){
                            $mensaje = [
                                "success" => false,
                                "message" => "Estimado instructor, cordialmente solicitamos realizar la revisión de las bitácoras del aprendiz. Para el momento $momento el aprendiz debe tener aprobadas el total de las bitácoras aprobadas."
                            ];
                        }else{
                            $mensaje = [
                                "success" => false,
                                "message" => "Estimado instructor, cordialmente solicitamos realizar la revisión de las bitácoras del aprendiz. Para el momento $momento el aprendiz registra ".$totalBitacorasEntregadas." bitácoras entregadas sin revisar, un total de ".$totalBitacorasAprobadas." aprobadas y según el cronograma, a la fecha debería contar aproximadamente con un total de ".$totalBitacorasFecha." bitácoras aprobadas."
                            ];
                        }
                    }
                }else{
                    $mensaje = ["success"=>false,"message"=>$objBitacoras["message"]];      
                }
            }else{
                $mensaje = ["success"=>false,"message"=>$objSeguimiento["message"]];   
            }
        } catch (Exception $e) {
            $mensaje = ["success"=>false,"message"=>$e->getMessage()];
        }

        return $mensaje;
    }


    /* -------Calcular total de bitacoras que debe tener el aprendiz a la fecha ---------------------------------*/
    /* Fecha de Creacion :  28/08/2025           Desarrollador: Marco Antonio Cipagauta Arbelaez                 */
    /* Parametros : $fechaInicioPractica año/mes/dia ,$fechaActual año/mes/dia ,$duracionPractica (int)          */
    /* Retorno :   total de bitacoras que deberia llevar el aprendiz a la fecha  $totalBitacorasFechaPrograma    */
    /* ----------------------------------------------------------------------------------------------------------*/
    /* --------------------------------------Control de cambios -------------------------------------------------*/
    /* Desarrollador:                                          fecha:                                            */
    /* Descripcion:                                                                                              */
    /*-----------------------------------------------------------------------------------------------------------*/
    public static function mdlTotalBitacorasFecha($fechaInicioPractica,$fechaActual,$duracionPractica){
        $f0 = new DateTime($fechaInicioPractica);
        $f2 = new DateTime($fechaActual);

        // Calcular diferencias absolutas en días
        $diff02 = $f0->diff($f2)->days;

        // calcular numero de meses
        $meses = floor($diff02 / 30);
        $dias = floor($meses * 30);
        $numeroBitacoras = floor((1 * $dias) / 15);

        // calcular numero total de bitacoras segun la duracion del programa;
        $totalBitacorasPrograma = ($duracionPractica *  2);

        $totalBitacorasFechaPrograma = ($numeroBitacoras > $totalBitacorasPrograma) ? $totalBitacorasPrograma : $numeroBitacoras;

        return($totalBitacorasFechaPrograma);
    }

    /* ----------recopilar informacion de bitacoras por aprendiz a travez del documento de identidad--------------------------------------------------------------------- */
    /* Fecha de Creacion :  27/08/2025           Desarrollador: Marco Antonio Cipagauta Arbelaez                                                                          */
    /* Parametros :  documentoAprendiz                                                                                                                                    */
    /* Retorno :  ["success"=>true,"idAprendiz"=>$idAprendiz,"nombreApendiz"=>$nombreAprendiz,"idFicha"=>$idficha,"numeroFicha"=>$numeroFicha,
                  "caracterizacionFicha"=>$caracterizacion,"listaBitacorasEntregadasSinAprobar"=>$listaBitacorasEntregadasSinAprobar,
                  "listaBitacorasAprobadas"=>$listaBitacorasAprobadas,"listaBitacorasRechazadas"=>$listaBitacorasRechazadas] o ["success"=>false,"message"=>"error"];     /*                                                                                                                                                                    */
    /* -------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    /* ---------------------------------------------------Control de cambios ---------------------------------------------------------------------------------------------*/
    /* Desarrollador:  Marco Antonio Cipagauta Arbelaez           fecha:  02/09/2025                                                                                      */
    /* Descripcion: informacion de estado bitacoras: 0= Sin entregar  1= Entregada  2= Aprobada  3= Rechazada                                                             */
    /*--------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
    public static function mdlInfoBitacoras($documentoAprendiz){
        $mensaje = [];
        $listaBitacorasAprobadas = [];
        $listaBitacorasRechazadas = [];
        $listaBitacorasEntregadasSinAprobar = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM aprendiz INNER JOIN bitacora ON aprendiz.idaprendiz = bitacora.aprendiz_idaprendiz  INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha WHERE aprendiz.documento = :documento");
            $objRespuesta->bindParam(":documento",$documentoAprendiz);
            $objRespuesta->execute();
            $bitacoras = $objRespuesta->fetchAll();
            $objRespuesta = null;
            if (count($bitacoras) >= 1){
                $idAprendiz = null;
                $idficha = null;
                $numeroFicha = "";
                $caracterizacion = "";
                $nombreAprendiz = "";
                $datosAprendiz = true;

                foreach ($bitacoras as $key => $value) {
                    if ($datosAprendiz){
                        $idAprendiz = $value["idaprendiz"];
                        $idficha = $value["ficha_idficha"];
                        $numeroFicha = $value["numero_ficha"];
                        $caracterizacion = $value["caracterizacion"];
                        $nombreAprendiz = $value["nombres"]." ".$value["apellidos"];
                        $datosAprendiz = false;
                    }

                    switch ($value["estado"]) {
                        case 1:
                            array_push($listaBitacorasEntregadasSinAprobar,["codigoBitacora"=>$value["codigo_bitacora"],"estadoBitacora"=>$value["estado"],"urlBitacora"=>$value["url_bitacora"],"novedad"=>$value["novedad"]]);
                            break;

                        case 2:
                            array_push($listaBitacorasAprobadas,["codigoBitacora"=>$value["codigo_bitacora"],"estadoBitacora"=>$value["estado"],"urlBitacora"=>$value["url_bitacora"],"novedad"=>$value["novedad"]]);
                            break;

                        case 3:
                            array_push($listaBitacorasRechazadas,["codigoBitacora"=>$value["codigo_bitacora"],"estadoBitacora"=>$value["estado"],"urlBitacora"=>$value["url_bitacora"],"novedad"=>$value["novedad"]]);
                            break;

                        default:
                            break;
                    }
                }

                $mensaje = ["success"=>true,"idAprendiz"=>$idAprendiz,"nombreApendiz"=>$nombreAprendiz,"idFicha"=>$idficha,"numeroFicha"=>$numeroFicha,"caracterizacionFicha"=>$caracterizacion,"listaBitacorasEntregadasSinAprobar"=>$listaBitacorasEntregadasSinAprobar,"listaBitacorasAprobadas"=>$listaBitacorasAprobadas,"listaBitacorasRechazadas"=>$listaBitacorasRechazadas];
            }else{
                $mensaje = ["success"=>false,"message"=>"Estimado instructor, de manera atenta le informo que no es posible registrar el seguimiento de etapa práctica si el aprendiz no ha cargado previamente sus bitácoras de acuerdo al momento del seguimiento y estas no han sido revisadas y aprobadas por usted."];
            }
        } catch (Exception $e) {
            $mensaje = ["success"=>false,"message"=>$e->getMessage()];
        }

        return $mensaje;
    }

    /* ---------------------Traer informacion de seguimientos asignados por Instructor----------------------------*/
    /* Fecha de Creacion :  27/08/2025           Desarrollador: Marco Antonio Cipagauta Arbelaez                  */
    /* Parametros : idVisitaSeguimiento                                                                           */
    /* Retorno :["success"=>true,"seguimiento"=>$seguimiento] o  ["success"=>false,"message"=>error]              */
    /* -----------------------------------------------------------------------------------------------------------*/
    /* --------------------------------------Control de cambios --------------------------------------------------*/
    /* Desarrollador: Marco Antonio Cipagauta Arbelaez        fecha: 23/09/2025                                   */
    /* Descripcion: se agrego el campo de duracion_programa en la consulta                                        */
    /*------------------------------------------------------------------------------------------------------------*/
    public static function mdlInfoVisitaSeguimiento($idVisitaSeguimiento){
        $mensaje = [];

    // agregar info de operario 
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT seguimiento.fecha_inicio_practica,seguimiento.fecha_fin_practica_seguimiento,seguimiento.estado_etapa,visita_seguimiento.fecha_radicado,visita_seguimiento.fecha_vencimiento,visita_seguimiento.tipo_seguimiento_idtipo_seguimiento,tipo_programa.duracion_practica,tipo_programa.duracion_programa,funcionario.idfuncionario,funcionario.nombres,funcionario.apellidos FROM visita_seguimiento INNER JOIN seguimiento ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento INNER JOIN aprendiz ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha INNER JOIN tipo_programa ON ficha.tipo_programa_idtipo_programa = tipo_programa.idtipo_programa INNER JOIN funcionario ON visita_seguimiento.funcionario_idfuncionario = funcionario.idfuncionario WHERE visita_seguimiento.idvisita_seguimiento = :idVisitaSeguimiento");

            $objRespuesta->bindParam(":idVisitaSeguimiento",$idVisitaSeguimiento);
            $objRespuesta->execute();
            $seguimiento = $objRespuesta->fetch();
            $objRespuesta = null;
            $mensaje = ["success"=>true,"seguimiento"=>$seguimiento];
        } catch (Exception $e) {
            $mensaje = ["success"=>false,"message"=>$e->getMessage()];
        }

        return $mensaje;
    }
}