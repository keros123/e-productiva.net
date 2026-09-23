<?php

    include_once "conexion.php";

    class fichasInstructorModelo {

        public static function mdlListarFichasAsignadas ($idInstructor) {

            try {
                $sql = "SELECT * FROM ficha INNER JOIN ficha_has_funcionario ON ficha.idficha = ficha_has_funcionario.ficha_idficha INNER JOIN estado_ficha ON ficha.estado_ficha_idestado_ficha = estado_ficha.idestado_ficha WHERE ficha_has_funcionario.funcionario_idfuncionario  = :id";
                $objFichasInstructor = conexion::conectar()->prepare($sql);
                $objFichasInstructor->bindparam(":id", $idInstructor);
                if ($objFichasInstructor->execute()) {
                    $datos = $objFichasInstructor -> fetchAll();
                    $objFichasInstructor = null;
                }else {
                    $objFichasInstructor = null;
                    $datos = "Hubo un error";
                }
            } catch (Exception $e) {
                $datos = $e->getMessage();
            }
            return $datos;
        }

        public static function mdlListarAprendicesAsignados ($idFicha) {

            try {
                $sql = "SELECT * FROM aprendiz INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha INNER JOIN tipo_documento ON aprendiz.tipo_documento_idtipo_documento = tipo_documento.idtipo_documento INNER JOIN estado_aprendiz ON aprendiz.estado_aprendiz_idestado_aprendiz = estado_aprendiz.idestado_aprendiz WHERE ficha.idficha = :id";
                $objFichasInstructor = conexion::conectar()->prepare($sql);
                $objFichasInstructor->bindparam(":id", $idFicha);
                if ($objFichasInstructor->execute()) {
                    $datos = $objFichasInstructor -> fetchAll();
                    $objFichasInstructor = null;
                }else {
                    $objFichasInstructor = null;
                    $datos = "Hubo un error";
                }
            } catch (Exception $e) {
                $datos = $e->getMessage();
            }
            return $datos;
        }

        public static function mdlActualizarAvalPatrocinio ($idAprendiz, $avalPatrocinio,$nombreCompleto, $fichaCompleta) {

            try {
                $sql = "UPDATE aprendiz SET aval = :aval  WHERE idaprendiz = :id";
                $objFichasInstructor = conexion::conectar()->prepare($sql);
                $objFichasInstructor->bindparam(":id", $idAprendiz);
                $objFichasInstructor->bindparam(":aval", $avalPatrocinio);
                if ($objFichasInstructor->execute()) {
                    $objFichasInstructor = null;
                    if ($avalPatrocinio == "Habilitado") {
                        $aval = "Inhabilitado";
                    }else{
                        $aval = "Habilitado";
                    }
                    $fecha = date("Y-m-d H:i:s");
                    $responsable = $_SESSION["nombreCompleto"];
                    $proceso = "Cambio Aval patrocinio";
                    $descripcion = "Se cambio el aval a patrocinio del aprendiz ".$nombreCompleto." de la ficha ".$fichaCompleta.". De ".$aval." a ".$avalPatrocinio;
                    $sql = "INSERT INTO procesos_aprendices(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                    $objFichasInstructor = conexion::conectar()->prepare($sql);
                    $objFichasInstructor->bindparam(":fecha",$fecha);
                    $objFichasInstructor->bindparam(":responsable",$responsable);
                    $objFichasInstructor->bindparam(":proceso",$proceso);
                    $objFichasInstructor->bindparam(":descripcion",$descripcion);
                    if ($objFichasInstructor->execute()) {
                        $objFichasInstructor = null;
                        $mensaje = ["codigo"=>"200", "mensaje"=>"Aval Patrocinio Actualizado"];
                    }else{
                        $objFichasInstructor = null;
                        $mensaje = ["codigo"=>"425", "mensaje"=>$avalPatrocinio];
                    }
                }else {
                    $objFichasInstructor = null;
                    $mensaje = ["codigo"=>"425", "mensaje"=>$avalPatrocinio];
                }
            } catch (Exception $e) {
                $mensaje = ["codigo"=>"425", "mensaje"=>$avalPatrocinio];
            }
            return $mensaje;
        }
    }