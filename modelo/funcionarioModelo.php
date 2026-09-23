<?php
include_once "conexion.php";


class funcionarioModelo{

    public static function mdlcargarSelectTipoFuncionario () {
        try {
            $objFuncionario = conexion::conectar()->prepare("SELECT * FROM tipo_funcionario");
            $objFuncionario -> execute();
            $datos = $objFuncionario -> fetchAll();
            $objFuncionario = null;
        } catch (Exception $e) {
            $datos = $e -> getMessage();
        }
        return $datos;
    }

    public static function mdlListarDepartamentos(){
        $mensaje = array();
        try {
            $objFuncionario = Conexion::conectar()->prepare("SELECT codi_depa,nomb_depa FROM departamentos");
            $objFuncionario->execute();
            $mensaje = $objFuncionario->fetchAll();
            $objFuncionario = null;
        } catch (Exception $e) {
            $mensaje = array("mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlListarMunicipios($idDepartamento){
        $mensaje = array();
        try {
            $objFuncionario = Conexion::conectar()->prepare("SELECT * FROM municipios WHERE departamentos_codi_depa = :departamentos_codi_depa");
            $objFuncionario->bindParam(":departamentos_codi_depa",$idDepartamento);
            $objFuncionario->execute();
            $mensaje = $objFuncionario->fetchAll();
            $objFuncionario = null;
        } catch (Exception $e) {
            $mensaje = array("mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlListarMunicipiosEdit(){
        $mensaje = array();
        try {
            $objFuncionario = Conexion::conectar()->prepare("SELECT * FROM municipios");
            $objFuncionario->execute();
            $mensaje = $objFuncionario->fetchAll();
            $objFuncionario = null;
        } catch (Exception $e) {
            $mensaje = array("mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlregistrarFuncionario ($nombres,$apellidos,$tipoDocumento,$numeroDocumento,$email,$telefono,$municipio,$direccion,$tipoFuncionario) {
        $mensaje = array();

        try {
            // 1. Instanciamos UNA sola conexión
            $conexion = Conexion::conectar();
            
            // 2. Verificamos si el usuario ya existe
            $objFuncionario = $conexion->prepare("SELECT documento, nombres, apellidos FROM funcionario WHERE documento = :documento");
            $objFuncionario->bindParam(":documento", $numeroDocumento);
            $objFuncionario->execute();
            $objUsuario = $objFuncionario->fetch();

            if ($objUsuario != null) {
                // Usuario ya existe, retornamos y detenemos la ejecución.
                return array(
                    "codigo" => "425",
                    "mensaje" => "El documento " . $objUsuario["documento"] . " pertenece al usuario " . $objUsuario["nombres"] . " " . $objUsuario["apellidos"] . " que ya se encuentra registrado en la plataforma."
                );
            }
            
            // 3. Iniciamos Transacción para garantizar que ambas inserciones se completen
            $conexion->beginTransaction();

            // 4. Inserción del funcionario
            $queryInsertFunc = "INSERT INTO funcionario(documento,nombres,apellidos,direccion,email,telefono,password,tipo_funcionario_idtipo_funcionario,tipo_documento_idtipo_documento,municipios_codi_muni) VALUES (:documento,:nombres,:apellidos,:direccion,:email,:telefono,:password1,:tipofuncionario,:tipodoc,:municipio)";
            $objFuncionario = $conexion->prepare($queryInsertFunc);
            $objFuncionario->bindParam(":nombres",$nombres);
            $objFuncionario->bindParam(":apellidos",$apellidos);
            $objFuncionario->bindParam(":tipodoc",$tipoDocumento);
            $objFuncionario->bindParam(":documento",$numeroDocumento);
            $objFuncionario->bindParam(":email",$email);
            $objFuncionario->bindParam(":telefono",$telefono);
            $objFuncionario->bindParam(":municipio",$municipio);
            $objFuncionario->bindParam(":direccion",$direccion);
            // Mantenemos la contraseña como el número de documento sin hash según la solicitud
            $objFuncionario->bindParam(":password1",$numeroDocumento);
            $objFuncionario->bindParam(":tipofuncionario",$tipoFuncionario);

            if (!$objFuncionario->execute()) {
                throw new Exception("Error al insertar los datos del funcionario.");
            }

            // 5. Inserción del log de procesos_funcionarios
            $fecha = date("Y-m-d H:i:s");
            // Mantenemos la responsabilidad de la sesión en el modelo según la solicitud
            $responsable = $_SESSION["nombreCompleto"]; 
            $proceso = "Creo funcionario";
            $descripcion = "Se creo el funcionario " . $nombres . " " . $apellidos . " con numero de identificación " . $numeroDocumento;
            
            $sqlLog = "INSERT INTO procesos_funcionarios(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
            $objLog = $conexion->prepare($sqlLog);
            $objLog->bindParam(":fecha",$fecha);
            $objLog->bindParam(":responsable",$responsable);
            $objLog->bindParam(":proceso",$proceso);
            $objLog->bindParam(":descripcion",$descripcion);

            if (!$objLog->execute()) {
                 throw new Exception("Error al insertar el registro de seguimiento/procesos.");
            }

            // 6. Finalizamos la transacción exitosamente (ambas queries están correctas)
            $conexion->commit();

            $mensaje = array(
                "codigo" => "200",
                "mensaje" => "Funcionario creado correctamente"
            );

        } catch (Exception $e) {
            // En caso de que OCURRA CUALQUIER ERROR dentro del flujo transaccional anterior (incluidas las queries),
            // echamos para atrás todos los cambios (por ejemplo si se insertó y luego falló el log de procesos).
            if(isset($conexion) && $conexion->inTransaction()){
                $conexion->rollBack();
            }

            $mensaje = array(
                "codigo" => "425",
                "mensaje" => "Ha ocurrido un error",
                "msg" => $e->getMessage()
            );
        }

        return $mensaje;
    }



    public static function mdlEditarFuncionario ($idFuncionario,$nombres,$apellidos,$tipoDocumento,$numeroDocumento,$email,$telefono,$municipio,$direccion,$tipoFuncionario,$nombreCompleto) {
        $mensaje = array();

        try {
            // 1. Unica Conexion para todo el proceso
            $conexion = Conexion::conectar();

            // 2. Traer los datos antiguos
            $sql = "SELECT * FROM funcionario INNER JOIN tipo_funcionario ON funcionario.tipo_funcionario_idtipo_funcionario = tipo_funcionario.idtipo_funcionario INNER JOIN tipo_documento ON funcionario.tipo_documento_idtipo_documento = tipo_documento.idtipo_documento INNER JOIN municipios ON funcionario.municipios_codi_muni = municipios.codi_muni INNER JOIN departamentos ON municipios.departamentos_codi_depa = departamentos.codi_depa WHERE funcionario.idfuncionario = :idFuncionario";
            $objFuncionario = $conexion->prepare($sql);
            $objFuncionario->bindParam(":idFuncionario",$idFuncionario);
            
            if (!$objFuncionario->execute()) {
                throw new Exception("Hubo un error al consultar el funcionario antes de actualizar.");
            }

            $datosAnterioresFuncionario = $objFuncionario->fetch();
            if(!$datosAnterioresFuncionario){
                throw new Exception("El funcionario a editar no existe en los registros.");
            }

            // 3. Iniciar Transaccion para el UPDATE y el Log
            $conexion->beginTransaction();

            // 4. Actualizar los datos
            $sqlUpdate = "UPDATE funcionario SET nombres = :nombres, apellidos = :apellidos, tipo_documento_idtipo_documento = :tipodoc, documento = :documento, email = :email, telefono = :telefono, municipios_codi_muni = :municipio, direccion = :direccion, tipo_funcionario_idtipo_funcionario = :tipofuncionario WHERE idfuncionario = :idfuncionario";
            $objUpdate = $conexion->prepare($sqlUpdate);
            $objUpdate->bindParam(":nombres",$nombres);
            $objUpdate->bindParam(":apellidos",$apellidos);
            $objUpdate->bindParam(":tipodoc",$tipoDocumento);
            $objUpdate->bindParam(":documento",$numeroDocumento);
            $objUpdate->bindParam(":idfuncionario",$idFuncionario);
            $objUpdate->bindParam(":email",$email);
            $objUpdate->bindParam(":telefono",$telefono);
            $objUpdate->bindParam(":municipio",$municipio);
            $objUpdate->bindParam(":direccion",$direccion);
            $objUpdate->bindParam(":tipofuncionario",$tipoFuncionario);

            if (!$objUpdate->execute()) {
                throw new Exception("Hubo un error al actualizar los datos principales del funcionario.");
            }

            // 5. Crear la descripcion de cambios
            $cambios = '';
            if ($datosAnterioresFuncionario["nombres"] != $nombres) {
                $cambios .= "Antes ".$datosAnterioresFuncionario["nombres"].", Ahora ".$nombres.". ";
            }
            if ($datosAnterioresFuncionario["apellidos"] != $apellidos) {
                $cambios .= "Antes ".$datosAnterioresFuncionario["apellidos"].", Ahora ".$apellidos.". ";
            }
            if ($datosAnterioresFuncionario["tipo_documento_idtipo_documento"] != $tipoDocumento) {
                $cambios .= "Antes ".$datosAnterioresFuncionario["nombre_tipo_documento"].". ";
            }
            if ($datosAnterioresFuncionario["documento"] != $numeroDocumento) {
                $cambios .= "Antes ".$datosAnterioresFuncionario["documento"].", Ahora ".$numeroDocumento.". ";
            }
            if ($datosAnterioresFuncionario["telefono"] != $telefono) {
                $cambios .= "Antes ".$datosAnterioresFuncionario["telefono"].", Ahora ".$telefono.". ";
            }
            if ($datosAnterioresFuncionario["email"] != $email) {
                $cambios .= "Antes ".$datosAnterioresFuncionario["email"].", Ahora ".$email.". ";
            }
            if ($datosAnterioresFuncionario["direccion"] != $direccion) {
                $cambios .= "Antes ".$datosAnterioresFuncionario["direccion"].", Ahora ".$direccion.". ";
            }
            if ($datosAnterioresFuncionario["tipo_funcionario_idtipo_funcionario"] != $tipoFuncionario) {
                $cambios .= "Antes ".$datosAnterioresFuncionario["nombre_tipo_funcionario"].". ";
            }
            if ($datosAnterioresFuncionario["municipios_codi_muni"] != $municipio) {
                $cambios .= "Antes ".$datosAnterioresFuncionario["nomb_depa"].". Antes ".$datosAnterioresFuncionario["nomb_muni"].".";
            }

            $cambiosTotales = ($cambios == '') ? 'No hay cambios' : "Cambios: " . rtrim($cambios);
            $descripcion = "Se editó el funcionario ".$nombreCompleto.". ".$cambiosTotales;

            // 6. Insertar en Log de Procesos
            $fecha = date("Y-m-d H:i:s");
            // Mantenemos la responsabilidad de la sesión en el modelo
            $responsable = $_SESSION["nombreCompleto"];
            $proceso = "Edito funcionario";
            
            $sqlLog = "INSERT INTO procesos_funcionarios(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
            $objLog = $conexion->prepare($sqlLog);
            $objLog->bindParam(":fecha",$fecha);
            $objLog->bindParam(":responsable",$responsable);
            $objLog->bindParam(":proceso",$proceso);
            $objLog->bindParam(":descripcion",$descripcion);

            if (!$objLog->execute()) {
                throw new Exception("Hubo un error al registrar el historial de procesos del funcionario.");
            }

            // 7. Commit si todo salio bien
            $conexion->commit();

            $mensaje = array("codigo"=>"200","mensaje"=>"Funcionario actualizado correctamente");

        } catch (Exception $e) {
            // Revertimos cambios si hubo un error a mitad de camino
            if(isset($conexion) && $conexion->inTransaction()){
                $conexion->rollBack();
            }

            $mensaje = [
                "codigo" => "425",
                "mensaje" => "Ha ocurrido un error al actualizar el funcionario",
                "msg" => $e->getMessage()
            ];
        }
        
        return $mensaje;
    }

    public static function mdlCargarFuncionarios () {
        try {
            $sql = "SELECT * FROM funcionario INNER JOIN tipo_funcionario ON tipo_funcionario_idtipo_funcionario = idtipo_Funcionario INNER JOIN tipo_documento ON tipo_documento_idtipo_documento = idtipo_documento INNER JOIN municipios ON municipios_codi_muni = codi_muni";
            $objFuncionario = conexion::conectar()->prepare($sql);
            $objFuncionario->execute();
            $datos = $objFuncionario->fetchAll();
            $objFuncionario = null;

        } catch (Exception $e) {
            $datos = $e->getMessage();
        }
        return $datos;
    }

    public static function mdlEliminarFuncionario ($idFuncionario,$nombreCompleto) {
        $mensaje = array();
        try {
            $conexion = Conexion::conectar();
            
            // 1. Verificar si tiene seguimientos asignados
            $sqlSeguimiento = "SELECT COUNT(*) as total FROM visita_seguimiento WHERE funcionario_idfuncionario = :idfuncionario";
            $objSeguimiento = $conexion->prepare($sqlSeguimiento);
            $objSeguimiento->bindparam(":idfuncionario", $idFuncionario);
            $objSeguimiento->execute();
            $resultado = $objSeguimiento->fetch();
            
            if ($resultado && $resultado['total'] > 0) {
                return array("codigo"=>"425", "mensaje"=>"No es posible eliminar el funcionario porque tiene seguimientos asignados.");
            }

            // 2. Iniciar transacción
            $conexion->beginTransaction();

            // 3. Eliminar de recuperacion_contrasena si existe
            $sqlRecuperacion = "DELETE FROM recuperacion_contrasena WHERE funcionario_idfuncionario = :idfuncionario";
            $objRecuperacion = $conexion->prepare($sqlRecuperacion);
            $objRecuperacion->bindparam(":idfuncionario", $idFuncionario);
            $objRecuperacion->execute();

            // 4. Eliminar funcionario
            $sqlFuncionario = "DELETE FROM funcionario WHERE idfuncionario = :idfuncionario";
            $objFuncionario = $conexion->prepare($sqlFuncionario);
            $objFuncionario->bindparam(":idfuncionario", $idFuncionario);
            if (!$objFuncionario->execute()) {
                throw new Exception("Error al intentar eliminar el funcionario de la base de datos.");
            }

            // 5. Insertar log de procesos_funcionarios
            $fecha = date("Y-m-d H:i:s");
            $responsable = $_SESSION["nombreCompleto"];
            $proceso = "Elimino funcionario";
            $descripcion = "Se Elimino el funcionario ".$nombreCompleto;
            $sqlLog = "INSERT INTO procesos_funcionarios(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
            $objLog = $conexion->prepare($sqlLog);
            $objLog->bindparam(":fecha",$fecha);
            $objLog->bindparam(":responsable",$responsable);
            $objLog->bindparam(":proceso",$proceso);
            $objLog->bindparam(":descripcion",$descripcion);
            if (!$objLog->execute()) {
                throw new Exception("Error al registrar el proceso en el historial.");
            }

            // 6. Confirmar cambios
            $conexion->commit();
            $mensaje = array("codigo"=>"200","mensaje"=>"Funcionario eliminado correctamente");

        } catch (Exception $e) {
            if(isset($conexion) && $conexion->inTransaction()){
                $conexion->rollBack();
            }
            $mensaje = array("codigo"=>"425", "mensaje"=>"Hubo un error al eliminar el funcionario", "msg"=>$e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlEditarIngresoIndividual($idFuncionario,$ingreso){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE funcionario SET ingreso=:ingreso WHERE idfuncionario=:idfuncionario");
            $objRespuesta->bindParam(":ingreso",$ingreso);
            $objRespuesta->bindParam(":idfuncionario",$idFuncionario);
            if ($objRespuesta->execute()){
                $mensaje = array("codigo"=>"200","mensaje"=>"estado modificado correctamente","ingreso"=>$ingreso);
            }else{
                $mensaje = array("codigo"=>"425","mensaje"=>"No fue posible editar el estado del funcionario, por favor intentelo mas tarde.");
            }
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"425","mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }
}

