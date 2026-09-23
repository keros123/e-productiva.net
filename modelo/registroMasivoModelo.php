<?php
include_once "conexion.php";
include_once "usuarioModelo.php";

require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;


class registroMasivoModelo{

    public static function mdlRegistroMasivoAprendices($archivo,$ficha,$idficha){
        $registrados = 0;
        $mensaje = array();
        $objRespuestaArchivo = registroMasivoModelo::mdlSubirArchivoRegistroMasivoAprendices($archivo,$ficha);

        $documento = IOFactory::load("../".$objRespuestaArchivo["mensaje"]);
        $totalHojas = $documento->getSheetCount();

        $hojaActual = $documento->getSheet(0);
        $numeroFilas = $hojaActual->getHighestDataRow();
        $letraColumnas = $hojaActual->getHighestDataColumn();
        $numeroColumnas = Coordinate::columnIndexFromString($letraColumnas);

        // Crear lista de documentos
        $objDocumentos = usuarioModelo::mdlCargarSelectDocumento();
        $listaDocumentos = array();
        foreach ($objDocumentos as $key => $value) {
            array_push($listaDocumentos,array($value["idtipo_documento"],$value["nombre_tipo_documento"],$value["abreviatura_tipo_documento"]));
        }

        // crear lista de parametros dinamicos
        $objParametros = array("ficha_idficha","tipo_documento_idtipo_documento","documento","nombres","apellidos","telefono","email","password_aprendiz","estado_aprendiz_idestado_aprendiz");
        $objDatosParametros = array();


        // crear lista de estados 
        $objEstadoAprendiz = usuarioModelo::mdlcargarSelectEstadoAprendiz();
        $listaEstadoAprendiz = array();
        foreach ($objEstadoAprendiz as $key => $value) {
            array_push($listaEstadoAprendiz,array($value["idestado_aprendiz"],$value["nombre_estado_aprendiz"]));
        }

        try {
            $sql_data = "INSERT INTO aprendiz(ficha_idficha,tipo_documento_idtipo_documento,documento,nombres,apellidos,telefono,email,password_aprendiz,estado_aprendiz_idestado_aprendiz)VALUES(:ficha_idficha,:tipo_documento_idtipo_documento,:documento,:nombres,:apellidos,:telefono,:email,:password_aprendiz,:estado_aprendiz_idestado_aprendiz)";
            array_push($objDatosParametros,$idficha);
            $numeroCedula = "";

            for ($indiceFila = 1; $indiceFila <= $numeroFilas; $indiceFila++){
                for ($indiceColumnas = 1; $indiceColumnas <= $numeroColumnas; $indiceColumnas++){
                    if ($indiceFila > 5){
                        $valor = $hojaActual->getCellByColumnAndRow($indiceColumnas,$indiceFila)->getValue();

                        if ($indiceColumnas == 1){
                            for($indice_filas_listaDocumentos = 0;$indice_filas_listaDocumentos < count($listaDocumentos);$indice_filas_listaDocumentos++){
                                for($indice_columnas_listaDocumentos = 0; $indice_columnas_listaDocumentos < 3;$indice_columnas_listaDocumentos++){
                                    if ($listaDocumentos[$indice_filas_listaDocumentos][2] == $valor){
                                        $valor = $listaDocumentos[$indice_filas_listaDocumentos][0];
                                    }
                                }
                            }
                        }elseif($indiceColumnas == 2){
                            $numeroCedula = $valor;
                        }elseif($indiceColumnas == 7){
                            array_push($objDatosParametros,trim($numeroCedula));
                            for($indice_filas_estadoAprendiz = 0;$indice_filas_estadoAprendiz < count($listaEstadoAprendiz);$indice_filas_estadoAprendiz++){
                                for($indice_columnas_estadoAprendiz = 0; $indice_columnas_estadoAprendiz < 3;$indice_columnas_estadoAprendiz++){
                                    if ($listaEstadoAprendiz[$indice_filas_estadoAprendiz][1] == $valor){
                                        $valor = $listaEstadoAprendiz[$indice_filas_estadoAprendiz][0];
                                    }
                                }
                            }
                        }

                        array_push($objDatosParametros,trim($valor));
                    }

                }

                if ($indiceFila > 5){
                    try {
                        $objRespuesta = Conexion::conectar()->prepare($sql_data);
                        for ($i=0; $i < count($objParametros); $i++) { 
                            $objRespuesta->bindParam(":".$objParametros[$i],$objDatosParametros[$i]);
                        }

                        if ($objRespuesta->execute()) {
                            $objRespuesta = null;
                            $registrados ++;
                            $objDatosParametros = array();
                            array_push($objDatosParametros,$idficha);
                            $mensaje = ["codigo"=>"200","mensaje"=>$registrados,"ficha"=>$ficha];
                        }else{
                            $mensaje = ["codigo"=>"401","mensaje"=>"Error"];
                        }
                    } catch (Exception $e) {
                        $mensaje = ["codigo"=>"401","mensaje"=>$e->getMessage()];
                    }
                }
            }
        }  catch (Exception $e) {
            $mensaje = ["codigo"=>"401","mensaje"=>$e->getMessage()];
        }

        return $mensaje;
    }


    public static function mdlSubirArchivoRegistroMasivoAprendices($archivo,$ficha){
        $mensaje = array();  
        $ruta = "";  
        $objRespuestaFolder = registroMasivoModelo::mdlCrearFolderRegistroMasivo($ficha);
        if ($objRespuestaFolder["codigo"] == "200"){
            $nombreArchivo = $archivo['name'];
            $rutaPrincipal = $objRespuestaFolder["mensaje"]."/".$nombreArchivo;
            $rutaFinal = "../".$objRespuestaFolder["mensaje"]."/".$nombreArchivo;

            if (move_uploaded_file($archivo['tmp_name'],  $rutaFinal)){
                $mensaje = array("codigo"=>"200","mensaje"=>$rutaPrincipal);
            }else{
                $mensaje = array("codigo"=>"425","mensaje"=>"error al subir el archivo");
            }
        }else{
            $mensaje = array("codigo"=>"401","mensaje"=>$objRespuestaFolder["mensaje"]);
        }

        return $mensaje;
    }


    public static function mdlCrearFolderRegistroMasivo($ficha){
        $mensaje = array();
        $ruta = "";
        $directorioGeneral = "archivos";

        $error = false;
        if (!file_exists('../'.$directorioGeneral)){
            if(!mkdir('../'.$directorioGeneral, 0777, true)){
                $error = true;
            }
        }else{
            $ruta .= 'archivos/';
        }

        if (!$error){
            if (!file_exists('../'.$directorioGeneral.'/recursoAprendices')){
                if(!mkdir('../'.$directorioGeneral.'/recursoAprendices', 0777, true)){
                    $error = true;
                }
            }else{
                $ruta .= 'recursoAprendices/';
            }

            if (!$error){
                if (!file_exists('../'.$directorioGeneral.'/recursoAprendices/'.$ficha)){
                    if(!mkdir('../'.$directorioGeneral.'/recursoAprendices/'.$ficha, 0777, true)){
                        $error = true;
                    }
                    if (!$error){
                        $ruta = 'archivos/recursoAprendices/'.$ficha;
                        $mensaje = array("codigo"=>"200","mensaje"=>$ruta);
                    }else{
                        $mensaje = array("codigo"=>"425","mensaje"=>"error al crear el directorio ".$ficha);
                    }
                }else{
                    $ruta .= $ficha; 
                    $mensaje = array("codigo"=>"200","mensaje"=>$ruta);
                }
            }else{
                $mensaje = array("codigo"=>"425","mensaje"=>"error al crear el directorio recursoAprendices");
            }
        }else{
            $mensaje = array("codigo"=>"425","mensaje"=>"error al crear el directorio principal de archivos");
        }

        return $mensaje;

    }

}