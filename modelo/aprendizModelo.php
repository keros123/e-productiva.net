<?php

    include_once "conexion.php";

    class aprendizModelo {
        public static function mdlIngresarAprendiz ($ficha,$tipoDoc,$documento,$nombres,$apellidos,$telefono,$email,$estado,$passwordAprendiz,$fichaCompleta) {
            $mensaje = [];
            try {
                $objRespuesta = conexion::conectar()->prepare("INSERT INTO aprendiz(ficha_idficha,tipo_documento_idtipo_documento,documento,nombres,apellidos,telefono,email,estado_aprendiz_idestado_aprendiz,password_aprendiz)VALUES(:ficha,:tipoDoc,:documento,:nombres,:apellidos,:telefono,:email,:estado,:passwordAprendiz)");
                $objRespuesta->bindparam(":ficha",$ficha);
                $objRespuesta->bindparam(":tipoDoc",$tipoDoc);
                $objRespuesta->bindparam(":documento",$documento);
                $objRespuesta->bindparam(":nombres",$nombres);
                $objRespuesta->bindparam(":apellidos",$apellidos);
                $objRespuesta->bindparam(":telefono",$telefono);
                $objRespuesta->bindparam(":email",$email);
                $objRespuesta->bindparam(":estado",$estado);
                $objRespuesta->bindparam(":passwordAprendiz",$passwordAprendiz);

                if ($objRespuesta->execute()) {
                    $objRespuesta = null;
                    $fecha = date("Y-m-d H:i:s");
                    $responsable = $_SESSION["nombreCompleto"];
                    $proceso = "Creo aprendiz";
                    $descripcion = "Se creo el aprendiz ".$nombres." ".$apellidos." con numero de identificación ".$documento." en la ficha ".$fichaCompleta;
                    $sql = "INSERT INTO procesos_aprendices(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                    $objRespuesta = conexion::conectar()->prepare($sql);
                    $objRespuesta->bindparam(":fecha",$fecha);
                    $objRespuesta->bindparam(":responsable",$responsable);
                    $objRespuesta->bindparam(":proceso",$proceso);
                    $objRespuesta->bindparam(":descripcion",$descripcion);
                    if ($objRespuesta->execute()) {
                        $objRespuesta = null;
                        $mensaje = ["codigo"=>"200","mensaje"=>"Aprendiz creado correctamente"];
                    }else{
                        $mensaje = ["codigo"=>"425","mensaje"=>"hubo un error al crear el aprendiz"];
                    }
                }else{
                    $mensaje = ["codigo"=>"200","mensaje"=>"El aprendiz ".$nombres." ".$apellidos." con documento ".$documento." ya ha sido registrado anteriormente."];
                }
            } catch (Exception  $e) {
                $mensaje = ["codigo"=>"425","mensaje"=>$e->getMessage()];
            }
            return $mensaje;
        }

        public static function mdlCargarTablaAprendices () {
            $mensaje = [];
            try {
                $objRespuesta = conexion::conectar()->prepare("SELECT * FROM ficha F, aprendiz A, estado_aprendiz E, tipo_documento T WHERE A.ficha_idficha=F.idficha AND A.tipo_documento_idtipo_documento=T.idtipo_documento AND A.estado_aprendiz_idestado_aprendiz=E.idestado_aprendiz");
                $objRespuesta->execute();
                $mensaje = $objRespuesta->fetchAll();
                $objRespuesta = null;
            } catch (Exception $e) {
                $mensaje = $e->getMessage();
            }
            return $mensaje;
        }

        public static function mdlEliminarAprendiz ($idAprendiz,$fichaCompleta,$nombreCompleto) {
            $mensaje = [];
            try {
                $objRespuesta = conexion::conectar()->prepare("SELECT * FROM recuperacion_contrasena_aprendiz WHERE aprendiz_idaprendiz=:idAprendiz");
                $objRespuesta->bindparam(":idAprendiz",$idAprendiz);
                if ($objRespuesta -> execute()) {
                    $datos = $objRespuesta->fetch();
                    $objRespuesta = null;
                    if ($datos != null) {
                        $objRespuesta = conexion::conectar()->prepare("DELETE FROM recuperacion_contrasena_aprendiz WHERE aprendiz_idaprendiz=:idAprendiz");
                        $objRespuesta->bindparam(":idAprendiz",$idAprendiz);
                        if ($objRespuesta -> execute()) {
                            $objRespuesta = null;
                            $objRespuesta = conexion::conectar()->prepare("DELETE FROM aprendiz WHERE idaprendiz=:idAprendiz");
                            $objRespuesta->bindparam(":idAprendiz",$idAprendiz);

                            if ($objRespuesta->execute()) {
                                $objRespuesta = null;
                                $fecha = date("Y-m-d H:i:s");
                                $responsable = $_SESSION["nombreCompleto"];
                                $proceso = "Elimino aprendiz";
                                $descripcion = "Se elimino el aprendiz ".$nombreCompleto." de la ficha ".$fichaCompleta;
                                $sql = "INSERT INTO procesos_aprendices(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                                $objRespuesta = conexion::conectar()->prepare($sql);
                                $objRespuesta->bindparam(":fecha",$fecha);
                                $objRespuesta->bindparam(":responsable",$responsable);
                                $objRespuesta->bindparam(":proceso",$proceso);
                                $objRespuesta->bindparam(":descripcion",$descripcion);
                                if ($objRespuesta->execute()) {
                                    $objRespuesta = null;
                                    $mensaje = ["codigo"=>"200","mensaje"=>"Aprendiz creado correctamente"];
                                }else{
                                    $mensaje = ["codigo"=>"425","mensaje"=>"hubo un error al crear el aprendiz"];
                                }
                            }else {
                                $mensaje = ["codigo"=>"425","mensaje"=>"No fue posible eliminar el registro"];
                            }
                        }else{
                            $mensaje = ["codigo"=>"425","mensaje"=>"Hubo un error al eliminar las dependencias"];
                        }
                    }else {
                        $objRespuesta = conexion::conectar()->prepare("DELETE FROM aprendiz WHERE idaprendiz=:idAprendiz");
                        $objRespuesta->bindparam(":idAprendiz",$idAprendiz);

                        if ($objRespuesta->execute()) {
                            $objRespuesta = null;
                            $fecha = date("Y-m-d H:i:s");
                            $responsable = $_SESSION["nombreCompleto"];
                            $proceso = "Elimino aprendiz";
                            $descripcion = "Se elimino el aprendiz ".$nombreCompleto." de la ficha ".$fichaCompleta;
                            $sql = "INSERT INTO procesos_aprendices(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                            $objRespuesta = conexion::conectar()->prepare($sql);
                            $objRespuesta->bindparam(":fecha",$fecha);
                            $objRespuesta->bindparam(":responsable",$responsable);
                            $objRespuesta->bindparam(":proceso",$proceso);
                            $objRespuesta->bindparam(":descripcion",$descripcion);
                            if ($objRespuesta->execute()) {
                                $objRespuesta = null;
                                $mensaje = ["codigo"=>"200","mensaje"=>"Aprendiz creado correctamente"];
                            }else{
                                $mensaje = ["codigo"=>"425","mensaje"=>"hubo un error al crear el aprendiz"];
                            }
                        }else {
                            $mensaje = ["codigo"=>"425","mensaje"=>"No fue posible eliminar el registro"];
                        }
                    }
                }else {
                    $mensaje = ["codigo"=>"425","mensaje"=>"error al realizar la consulta"];
                }
                
            } catch (Exception  $e) {
                $mensaje = ["codigo"=>"425","mensaje"=>$e->getMessage()];
            }
            return $mensaje;
        }

        public static function mdlEditarAprendiz($ficha, $tipoDoc, $documento, $nombres, $apellidos, $telefono, $email, $estado, $idAprendiz, $fichaCompleta, $nombreCompleto, $novedad = null) {
            // Reasignación automática: si el estado es 4, se normaliza a 2
            $reasignacionEstado = false;
            if ($estado == 4) {
                $estado = 2;
                $reasignacionEstado = true;
            }

            $mensaje = [];
            $con = conexion::conectar();

            try {
                // --- 1. Obtener datos actuales antes de modificar ---
                $sql = "SELECT * FROM aprendiz INNER JOIN tipo_documento ON aprendiz.tipo_documento_idtipo_documento = tipo_documento.idtipo_documento INNER JOIN estado_aprendiz ON aprendiz.estado_aprendiz_idestado_aprendiz = estado_aprendiz.idestado_aprendiz WHERE aprendiz.idaprendiz = :idAprendiz";
                $objRespuesta = $con->prepare($sql);
                $objRespuesta->bindparam(":idAprendiz", $idAprendiz);
                $objRespuesta->execute();
                $datosAnterioresAprendiz = $objRespuesta->fetch();
                $objRespuesta = null;

                if (!$datosAnterioresAprendiz) {
                    return ["codigo"=>"425", "mensaje"=>"No se encontró el aprendiz con el ID proporcionado"];
                }

                // --- 2. Iniciar transacción ---
                $con->beginTransaction();

                // --- 3. Actualizar aprendiz (con o sin novedad) ---
                if ($novedad !== null) {
                    $objRespuesta = $con->prepare("UPDATE aprendiz SET ficha_idficha=:ficha,tipo_documento_idtipo_documento=:tipoDoc,documento=:documento,nombres=:nombres,apellidos=:apellidos,telefono=:telefono,email=:email,estado_aprendiz_idestado_aprendiz=:estado,novedad=:novedad WHERE idaprendiz=:idAprendiz");
                    $objRespuesta->bindparam(":novedad", $novedad);
                } else {
                    $objRespuesta = $con->prepare("UPDATE aprendiz SET ficha_idficha=:ficha,tipo_documento_idtipo_documento=:tipoDoc,documento=:documento,nombres=:nombres,apellidos=:apellidos,telefono=:telefono,email=:email,estado_aprendiz_idestado_aprendiz=:estado WHERE idaprendiz=:idAprendiz");
                }

                $objRespuesta->bindparam(":idAprendiz", $idAprendiz);
                $objRespuesta->bindparam(":ficha",     $ficha);
                $objRespuesta->bindparam(":tipoDoc",   $tipoDoc);
                $objRespuesta->bindparam(":documento", $documento);
                $objRespuesta->bindparam(":nombres",   $nombres);
                $objRespuesta->bindparam(":apellidos", $apellidos);
                $objRespuesta->bindparam(":telefono",  $telefono);
                $objRespuesta->bindparam(":email",     $email);
                $objRespuesta->bindparam(":estado",    $estado);

                if (!$objRespuesta->execute()) {
                    $con->rollBack();
                    return ["codigo"=>"425", "mensaje"=>"Hubo un error al editar el aprendiz"];
                }
                $objRespuesta = null;

                // --- 4. Construir detalle de cambios para auditoría ---
                $cambios = '';
                if ($datosAnterioresAprendiz["nombres"] != $nombres) {
                    $cambios .= "Nombres - Antes: ".$datosAnterioresAprendiz["nombres"].", Ahora: ".$nombres.". ";
                }
                if ($datosAnterioresAprendiz["apellidos"] != $apellidos) {
                    $cambios .= "Apellidos - Antes: ".$datosAnterioresAprendiz["apellidos"].", Ahora: ".$apellidos.". ";
                }
                if ($datosAnterioresAprendiz["tipo_documento_idtipo_documento"] != $tipoDoc) {
                    $cambios .= "Tipo Doc - Antes: ".$datosAnterioresAprendiz["nombre_tipo_documento"].", Ahora: ".$tipoDoc.". ";
                }
                if ($datosAnterioresAprendiz["documento"] != $documento) {
                    $cambios .= "Documento - Antes: ".$datosAnterioresAprendiz["documento"].", Ahora: ".$documento.". ";
                }
                if ($datosAnterioresAprendiz["telefono"] != $telefono) {
                    $cambios .= "Teléfono - Antes: ".$datosAnterioresAprendiz["telefono"].", Ahora: ".$telefono.". ";
                }
                if ($datosAnterioresAprendiz["email"] != $email) {
                    $cambios .= "Email - Antes: ".$datosAnterioresAprendiz["email"].", Ahora: ".$email.". ";
                }
                if ($datosAnterioresAprendiz["estado_aprendiz_idestado_aprendiz"] != $estado) {
                    $cambios .= "Estado - Antes: ".$datosAnterioresAprendiz["nombre_estado_aprendiz"].", Ahora (id): ".$estado.". ";
                }
                if ($reasignacionEstado) {
                    $cambios .= "Estado reasignado automáticamente de 4 a 2. ";
                }
                if ($novedad !== null) {
                    $cambios .= "Se agregó novedad: ".$novedad.". ";
                }

                $cambiosTotales = ($cambios === '') ? 'No hay cambios' : "Cambios: ".$cambios;

                // --- 5. Insertar en historial de auditoría ---
                $fecha       = date("Y-m-d H:i:s");
                $responsable = $_SESSION["nombreCompleto"];
                $proceso     = "Edito aprendiz";
                $descripcion = "Se editó el aprendiz ".$nombres." ".$apellidos." de la ficha ".$fichaCompleta.". ".$cambiosTotales;

                $sql = "INSERT INTO procesos_aprendices(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                $objRespuesta = $con->prepare($sql);
                $objRespuesta->bindparam(":fecha",       $fecha);
                $objRespuesta->bindparam(":responsable", $responsable);
                $objRespuesta->bindparam(":proceso",     $proceso);
                $objRespuesta->bindparam(":descripcion", $descripcion);

                if (!$objRespuesta->execute()) {
                    $con->rollBack();
                    return ["codigo"=>"425", "mensaje"=>"Hubo un error al registrar la auditoría"];
                }
                $objRespuesta = null;

                // --- 6. Confirmar transacción ---
                $con->commit();
                $mensaje = ["codigo"=>"200", "mensaje"=>"Aprendiz editado correctamente"];

            } catch (Exception $e) {
                if ($con->inTransaction()) {
                    $con->rollBack();
                }
                $mensaje = ["codigo"=>"425", "mensaje"=>$e->getMessage()];
            }
            return $mensaje;
        }

        public static function mdlTotalRegistroMasivo ($registrados, $ficha) {
            try {
                $fecha = date("Y-m-d H:i:s");
                $responsable = $_SESSION["nombreCompleto"];
                $proceso = "Registro Masivo";
                $descripcion = "Se registraron masivamente $registrados aprendices. en la ficha $ficha";
                $sql = "INSERT INTO procesos_aprendices(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                $objRespuesta = conexion::conectar()->prepare($sql);
                $objRespuesta->bindparam(":fecha",$fecha);
                $objRespuesta->bindparam(":responsable",$responsable);
                $objRespuesta->bindparam(":proceso",$proceso);
                $objRespuesta->bindparam(":descripcion",$descripcion);
                if ($objRespuesta->execute()) {
                    $objRespuesta = null;
                    $mensaje = ["codigo"=>"200","mensaje"=>"Aprendiz editado correctamente"];
                }else{
                    $mensaje = ["codigo"=>"425","mensaje"=>"hubo un error al editar el aprendiz"];
                }
            } catch (Exception $e) {
                $mensaje = ["codigo"=>"425","mensaje"=>"hubo un error al editar el aprendiz"];
            }
            return $mensaje;
        }

        public static function mdlAprendizCancelado($documento, $idAprendiz, $ficha) {
            $mensaje = [];
            $consultarEtapaPractica = self::consultarEtapaPractica($idAprendiz);
            if ($consultarEtapaPractica != "404") { //404:error consulta //402:no hay registro
                $liberarCarpetas = self::liberarCarpetas($documento,$ficha);
                if ($liberarCarpetas == "200") {
                    $limpiarBD = self::limpiarDB($idAprendiz, $consultarEtapaPractica);
                    if ($limpiarBD == "200") {
                        $mensaje = ["codigo"=>"200", "mensaje"=>"Operación realizada con exito."];
                    }else {
                        $mensaje = ["codigo"=>"400", "mensaje"=>"Error al limpiar BD"];
                    }
                }else {
                    $mensaje = ["codigo"=>"400", "mensaje"=>"Error al limpiar archivos"];
                }
            }else{
                $mensaje = ["codigo"=>"400", "mensaje"=>"Error al generar la consulta"];
            }
            return $mensaje;
        }

        public static function consultarEtapaPractica($id) {
            $mensaje = null;
            try {
                $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM seguimiento WHERE aprendiz_idaprendiz = :id");
                $objRespuesta->bindParam(":id", $id);
                $objRespuesta->execute();
                $mensaje = $objRespuesta->fetchAll();
                $objRespuesta = null;
                if ($mensaje == null) {
                    $mensaje = "402";
                }
            } catch (Exception $e) {
                $mensaje = "404";
            }
            return $mensaje;
        }

        public static function liberarCarpetas ($documento,$ficha) {
            $dirGeneral = "../archivos/aprendices/".$ficha."/".$documento;
            //limpiar folder principal
            if (file_exists($dirGeneral)) {
                $contenidoFolder = scandir($dirGeneral);
                //limpiar archivos dentro del general
                foreach ($contenidoFolder as $item) {
                    $subRuta = null;
                    if ($item == "." || $item == "..") {
                    }else {
                        if (is_dir($dirGeneral."/".$item)) {
                            $contenidoSubFolder = scandir($dirGeneral."/".$item);
                            foreach ($contenidoSubFolder as $subItem) {
                                if ($subItem == "." || $subItem == "..") {
                                }else{
                                    if (file_exists($dirGeneral."/".$item."/".$subItem)) {
                                        if (!unlink($dirGeneral."/".$item."/".$subItem)) {
                                            return "404"; 
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                //limpiar carpetas ya vacias
                foreach ($contenidoFolder as $item) {
                    $subRuta = null;
                    if ($item == "." || $item == "..") {
                    }else {
                        if (is_dir($dirGeneral."/".$item)) {
                            if (file_exists($dirGeneral."/".$item)) {
                                if (!rmdir($dirGeneral."/".$item)) {
                                    return "404"; 
                                }
                            }
                        }
                    }
                    //limpiarimagen
                    if ($item == "." || $item == "..") {
                    }else {
                        if (file_exists($dirGeneral."/".$item)) {
                            if (!unlink($dirGeneral."/".$item)) {
                                return "404"; 
                            }
                        }
                    }
                }

                if (!rmdir($dirGeneral)) {
                    return "404"; 
                }
            }

            return "200";
        }

        public static function limpiarDB($idAprendiz, $consultarEtapaPractica) {
            $ordenLimpieza = ["DELETE FROM bitacora WHERE aprendiz_idaprendiz = :id", "DELETE FROM certificacion WHERE aprendiz_idaprendiz = :id", "DELETE FROM recuperacion_contrasena_aprendiz WHERE aprendiz_idaprendiz = :id", "DELETE FROM visita_seguimiento WHERE seguimiento_idseguimiento = :id", "DELETE FROM seguimiento WHERE idseguimiento = :id", "DELETE FROM aprendiz WHERE idaprendiz = :id"];
            for ($i=0; $i < count($ordenLimpieza); $i++) { 
                try {
                    $sql = $ordenLimpieza[$i];
                    $objConsulta = null;
                    if ($i == "3" || $i == "4"){
                        if ($consultarEtapaPractica != "402") {
                            for ($j=0; $j < count($consultarEtapaPractica); $j++) { 
                                $objConsulta = Conexion::conectar()->prepare($sql);
                                $objConsulta->bindParam(":id", $consultarEtapaPractica[$j]["idseguimiento"]);
                                if (!$objConsulta->execute()) {
                                    return "404";
                                }
                                $objConsulta = null;
                            }
                        }
                    }else{
                        $objConsulta = Conexion::conectar()->prepare($sql);
                        $objConsulta->bindParam(":id", $idAprendiz);
                        if (!$objConsulta->execute()) {
                            return "404";
                        }
                        $objConsulta = null;
                    }
                } catch (Exception $e) {
                    return "404";
                }
            }
            return "200";
        }
    }