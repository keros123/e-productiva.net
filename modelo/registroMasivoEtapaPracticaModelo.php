<?php
include_once "conexion.php";


require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class RegistroMasivoEtapaPracticaModelo{

    public static function mdlRegistroEtapaPractica($archivo){
        $mensaje = array();
        $objFolderEtapasPracticas = RegistroMasivoEtapaPracticaModelo::mdlCrearFolder();

        if ($objFolderEtapasPracticas["codigo"] != "200"){
            return array("codigo"=>"401","mensaje"=>$objFolderEtapasPracticas["mensaje"]);
        }

        $ruta = $objFolderEtapasPracticas["ruta"];
        $nombreArchivo = $archivo['name'];
        $mensajeEliminar = RegistroMasivoEtapaPracticaModelo::mdlEliminarArchivo($ruta, $nombreArchivo);

        if ($mensajeEliminar["codigo"] != "200"){
            return $mensajeEliminar;
        }

        if (!move_uploaded_file($archivo['tmp_name'], $ruta.$nombreArchivo)){
            return array("codigo"=>"401","mensaje"=>"Error al subir el archivo plano al servidor.");
        }

        // recorrer archivo plano para crear el registro 
        $listaErrores = array();
        $contadorEtapas = 0;

        try {
            $documento = IOFactory::load($ruta.$nombreArchivo);
            $hojaActual = $documento->getSheet(0);
            $numeroFilas = $hojaActual->getHighestDataRow();
            
            $fechaRadicado = date("Y-m-d");

            // 1. ABRIMOS CONEXIÓN UNA SOLA VEZ
            $conexion = Conexion::conectar();

            // 2. PREPARAMOS LAS CONSULTAS FUERA DEL BUCLE
            $stmtAprendiz = $conexion->prepare("SELECT idaprendiz, nombres, apellidos FROM aprendiz WHERE documento = :documento");
            $stmtEmpresa = $conexion->prepare("SELECT idempresa FROM empresa WHERE idempresa = :idempresa");
            $stmtSeguimiento = $conexion->prepare("SELECT idseguimiento FROM seguimiento WHERE aprendiz_idaprendiz = :idaprendiz");
            $stmtInsert = $conexion->prepare("INSERT INTO seguimiento(fecha_radicado, fecha_inicio_practica, fecha_fin_practica_seguimiento, modalidad_idmodalidad, aprendiz_idaprendiz, empresa_idempresa) VALUES (:fecha_radicado, :fecha_inicio, :fecha_fin, :modalidad, :idaprendiz, :idempresa)");

            // 3. RECORREMOS DESDE LA FILA 4 DIRECTAMENTE
            for ($indiceFila = 4; $indiceFila <= $numeroFilas; $indiceFila++){
                
                $fechaInicioExcelVal = trim($hojaActual->getCellByColumnAndRow(1, $indiceFila)->getValue());
                $fechaFinExcelVal    = trim($hojaActual->getCellByColumnAndRow(2, $indiceFila)->getValue());
                $idModalidad         = trim($hojaActual->getCellByColumnAndRow(3, $indiceFila)->getValue());
                $documentoAprendiz   = trim($hojaActual->getCellByColumnAndRow(4, $indiceFila)->getValue());
                $idEmpresa           = trim($hojaActual->getCellByColumnAndRow(5, $indiceFila)->getValue());

                // Validamos si la fila está vacía (ignoramos)
                if(empty($documentoAprendiz) && empty($idEmpresa)) {
                    continue; 
                }

                try {
                    // Validar Aprendiz
                    $stmtAprendiz->execute([':documento' => $documentoAprendiz]);
                    $objAprendiz = $stmtAprendiz->fetch(PDO::FETCH_ASSOC);
                    
                    if (!$objAprendiz){
                        $listaErrores[] = "Fila $indiceFila: No existe un aprendiz con el documento: $documentoAprendiz";
                        continue;
                    }

                    $idAprendiz = $objAprendiz["idaprendiz"];
                    $nombreAprendiz = $objAprendiz["nombres"]." ".$objAprendiz["apellidos"];

                    // Validar Empresa
                    $stmtEmpresa->execute([':idempresa' => $idEmpresa]);
                    if (!$stmtEmpresa->fetch(PDO::FETCH_ASSOC)){
                        $listaErrores[] = "Fila $indiceFila: No existe una empresa con NIT o código: $idEmpresa";
                        continue;
                    }

                    // Validar si el aprendiz ya tiene seguimiento registrado
                    $stmtSeguimiento->execute([':idaprendiz' => $idAprendiz]);
                    if ($stmtSeguimiento->fetch(PDO::FETCH_ASSOC)){
                        $listaErrores[] = "Fila $indiceFila: Ya existe una etapa práctica registrada para el aprendiz $nombreAprendiz ($documentoAprendiz)";
                        continue;
                    }

                    // Formatear Fechas (Se asume que vienen como texto en formato con / o -)
                    $fechaInicioStr = str_replace("/", "-", $fechaInicioExcelVal);
                    $fechaFinalStr  = str_replace("/", "-", $fechaFinExcelVal);

                    $fechaInicioFormat = (new DateTime($fechaInicioStr))->format("Y-m-d");
                    $fechaFinalFormat  = (new DateTime($fechaFinalStr))->format("Y-m-d");

                    // Insertar Registro
                    $insertado = $stmtInsert->execute([
                        ':fecha_radicado' => $fechaRadicado,
                        ':fecha_inicio'   => $fechaInicioFormat,
                        ':fecha_fin'      => $fechaFinalFormat,
                        ':modalidad'      => $idModalidad,
                        ':idaprendiz'     => $idAprendiz,
                        ':idempresa'      => $idEmpresa
                    ]);

                    if ($insertado) {
                        $contadorEtapas++;
                    } else {
                        $listaErrores[] = "Fila $indiceFila: Error en base de datos al intentar registrar al aprendiz $documentoAprendiz";
                    }

                } catch (Exception $e) {
                    $listaErrores[] = "Fila $indiceFila (Error en datos): " . $e->getMessage();
                }
            } // Fin del for

        } catch (Exception $e) {
            return array("codigo"=>"401","mensaje"=>"Error al procesar el archivo Excel: ".$e->getMessage());
        }

        // Construir la respuesta final
        if (count($listaErrores) > 0){
            $mensaje = array("codigo"=>"401", "listaErrores" => $listaErrores, "registrados" => $contadorEtapas);
        } else {
            $mensaje = array("codigo"=>"200", "mensaje"=>"Se registraron $contadorEtapas etapas practicas con éxito.");
        }

        return $mensaje;
    }


    public static function mdlCrearFolder(){
        $mensaje = array();
        $error = false;
        $directorioGeneral = "archivos";
        $ruta = "";
        if (!file_exists('../'.$directorioGeneral)){
            if(!mkdir('../'.$directorioGeneral, 0777, true)){
                $error = true;
            }
        }

        if (!$error){
            if (!file_exists('../'.$directorioGeneral.'/etapas_practicas')){
                if(!mkdir('../'.$directorioGeneral.'/etapas_practicas', 0777, true)){
                    $error = true;
                }

                if ($error){
                    $mensaje = array("codigo"=>"401","mensaje"=>"No fue posible crear el directorio de archivos de etapas practicas");
                }
            }
        }else{
            $error = true;
            $mensaje = array("codigo"=>"401","mensaje"=>"No fue posible crear el directorio principal de archivos");
        }

        if (!$error){
            $ruta = '../'.$directorioGeneral.'/etapas_practicas/';
            $mensaje = array("codigo"=>"200","ruta"=>$ruta);
        }

        return $mensaje;

    }

    public static function mdlEliminarArchivo($ruta,$nombreArchivo){
        $mensaje = array();
        $rutaArchivo = $ruta.$nombreArchivo;
        if (file_exists($rutaArchivo)) {
            try {
                if (unlink($rutaArchivo)){
                    $mensaje = array("codigo"=>"200","mensaje"=>"ok");
                }else{
                    $mensaje = array("codigo"=>"401","mensaje"=>"no fue posible eliminar el anterior archivo plano");
                }
            } catch (Exception $e) {
                $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
            }
        }else{
            $mensaje = array("codigo"=>"200","mensaje"=>"ok");
        }

        return $mensaje;
    }

}