<?php

include_once "usuarioModelo.php";

class subirArchivo{
    public static function mdlSubirArchivos($archivo,$usuario,$tipoUsuario,$tipoSolicitud){
        $mensaje = array();
        $objUsuario = usuarioModelo::mdlListarUsuario($usuario,$tipoUsuario);
        $mensaje = subirArchivo::mdlCrearfolderUsuario($objUsuario,$tipoUsuario,$tipoSolicitud);
        if ($mensaje["codigo"] == "202"){
            if ($tipoSolicitud == null){
                $respuesta = "ok";
                if ($objUsuario["url_foto"] != null){
                    $respuesta = subirArchivo::mdlEliminarArchivo($objUsuario["url_foto"]);
                }

                if ($respuesta == "ok"){
                    $nombreArchivo = $archivo['name'];
                    $rutaPrincipal = $mensaje["mensaje"]."/".$nombreArchivo;
                    $rutaFinal = "../".$mensaje["mensaje"]."/".$nombreArchivo;
                    if (move_uploaded_file($archivo['tmp_name'],  $rutaFinal)){
                        $mensaje = array("codigo"=>"202","mensaje"=>$rutaPrincipal);
                        $objUsuario = null;
                    }else{
                        $mensaje = array("codigo"=>"425","mensaje"=>"error al subir el archivo");
                    }
                }
            }else{
                // espacio para subida de archivos de otro tipo de solicitudes



            }
        }

        return $mensaje;
    }



    public static function mdlEliminarArchivo($ruta){
        $mensaje = "";
        if (file_exists('../'.$ruta)) {
            try {
                if (unlink('../'.$ruta)){
                    $mensaje = "ok";
                }else{
                    $mensaje = "error";
                }
            } catch (Exception $th) {
                $mensaje = $th;
            }
        }
        return $mensaje;
    }



    public static function mdlCrearfolderUsuario($objUsuario,$tipoUsuario,$tipoSolicitud){
        $mensaje = array();
        $ruta = "";
        $directorioGeneral = "archivos";

        if ($objUsuario != null){
            // crear directorio principal
            $error = false;
            if (!file_exists('../'.$directorioGeneral)){
                if(!mkdir('../'.$directorioGeneral, 0777, true)){
                    $error = true;
                }
            }

            if (!$error){
                if ($tipoUsuario >= "10"){
                    // estructura aprendiz

                    // crear folder principal aprendiz
                    if (!file_exists('../'.$directorioGeneral.'/aprendices')){
                        if(!mkdir('../'.$directorioGeneral.'/aprendices', 0777, true)){
                            $error = true;
                        }
                    }

                    if (!$error){
                        // crear folder de la ficha del aprendiz activo
                        if (!file_exists('../'.$directorioGeneral.'/aprendices/'.$objUsuario["numero_ficha"])){
                            if(!mkdir('../'.$directorioGeneral.'/aprendices/'.$objUsuario["numero_ficha"], 0777, true)){
                                $error = true;
                            }
                        }

                        if (!$error){
                            // crear folder del aprendiz activo
                            if (!file_exists('../'.$directorioGeneral.'/aprendices/'.$objUsuario["numero_ficha"].'/'.$objUsuario["documento"])){
                                if(!mkdir('../'.$directorioGeneral.'/aprendices/'.$objUsuario["numero_ficha"].'/'.$objUsuario["documento"], 0777, true)){
                                    $error = true;
                                }
                            }

                            if (!$error){
                                if ($tipoSolicitud == null){
                                    $ruta = $directorioGeneral.'/aprendices/'.$objUsuario["numero_ficha"].'/'.$objUsuario["documento"];
                                    $mensaje = array("codigo"=>"202","mensaje"=>$ruta);
                                }else{
                                    // espacio para crear folder de las otras solicitudes como seguimientos y radicados



                                }
                            }else{
                                $mensaje = array("codigo"=>"425","mensaje"=>"error al crear el directorio para el aprendiz : ".$objUsuario["nombres"]);
                            }
                        }else{
                            $mensaje = array("codigo"=>"425","mensaje"=>"error al crear el directorio principal para la ficha : ".$objUsuario["numero_ficha"]); 
                        }
                    }else{
                        $mensaje = array("codigo"=>"425","mensaje"=>"error al crear el directorio principal de aprendices"); 
                    }
                }else{
                    // estructura funcionario

                    // crear folder principal funcionarios
                    if (!file_exists('../'.$directorioGeneral.'/funcionarios')){
                        if(!mkdir('../'.$directorioGeneral.'/funcionarios', 0777, true)){
                            $error = true;
                        }
                    }

                    if (!$error){
                        // crear folder del funcionario activo
                        if (!file_exists('../'.$directorioGeneral.'/funcionarios/'.$objUsuario["documento"])){
                            if(!mkdir('../'.$directorioGeneral.'/funcionarios/'.$objUsuario["documento"], 0777, true)){
                                $error = true;
                            }
                        }

                        // si no hay error retornar ruta del foldel del usuario activo
                        if(!$error){
                            $ruta = $directorioGeneral.'/funcionarios/'.$objUsuario["documento"];
                            $mensaje = array("codigo"=>"202","mensaje"=>$ruta);
                        }else{
                            $mensaje = array("codigo"=>"425","mensaje"=>"error al crear el directorio para el funcionario : ".$objUsuario["nombres"]);
                        }
                    }else{
                        $mensaje = array("codigo"=>"425","mensaje"=>"error al crear el directorio principal de funcionarios");
                    }
                }
            }else{
                $mensaje = array("codigo"=>"425","mensaje"=>"error al crear el directorio principal de archivos");
            }
        }

        return $mensaje;
    }

}