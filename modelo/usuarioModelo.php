<?php
include_once "conexion.php";


class usuarioModelo{

    public static function mdlAutenticarAprendiz($tipoDocumento,$documento,$ficha,$password){
        $mensaje = array();
        try {
            $sql = "SELECT * FROM aprendiz INNER JOIN ficha ON ficha.idficha = aprendiz.ficha_idficha INNER JOIN tipo_programa ON ficha.tipo_programa_idtipo_programa = tipo_programa.idtipo_programa INNER JOIN tipo_documento ON tipo_documento.idtipo_documento = aprendiz.tipo_documento_idtipo_documento WHERE aprendiz.tipo_documento_idtipo_documento = :tipodocumento AND aprendiz.documento = :documento AND ficha.numero_ficha = :ficha AND aprendiz.password_aprendiz = :password";
            $objRespuesta = Conexion::conectar()->prepare($sql);
            $objRespuesta->bindParam(":documento",$documento);
            $objRespuesta->bindParam(":tipodocumento",$tipoDocumento);
            $objRespuesta->bindParam(":ficha",$ficha);
            $objRespuesta->bindParam(":password",$password);
            $objRespuesta->execute();
            $datosAprendiz = $objRespuesta->fetch();
            $objRespuesta = null;
            if ($datosAprendiz != null) {
                $mensaje = array("mensaje" => "ok", "ruta"=>"inicioAprendiz");
                $_SESSION["usuario"] = "ok";
                $_SESSION["tipoUsuario"] = "10";
                $_SESSION["nombreUsuario"] = $datosAprendiz["nombres"];
                $_SESSION["id"] = $datosAprendiz["idaprendiz"];
                $_SESSION["ficha"] = $datosAprendiz["numero_ficha"];
                $_SESSION["foto"] = $datosAprendiz["url_foto"];
                $_SESSION["nombreFicha"] = $datosAprendiz["caracterizacion"];
                $_SESSION["documento"] = $datosAprendiz["documento"];
                $_SESSION["password"] = $datosAprendiz["password_aprendiz"];
                $_SESSION["idtipo_programa"] = $datosAprendiz["idtipo_programa"];
                $_SESSION["nombre_programa"] = $datosAprendiz["nombre_programa"];
                $_SESSION["rutaInicio"] = "";
            } else {
                $objAutenticarAprendizCertificado = self::mdlAutenticarAprendizCertificado($documento,$ficha,$password);
                if ($objAutenticarAprendizCertificado["codigo"] == "200") {
                    $mensaje = array("mensaje" => "ok","ruta"=>"inicioAprendizCertificado");
                }else{
                    $mensaje = array("mensaje" => "Error al iniciar sesión, por favor verifique sus datos.","ruta"=>"");
                }
            }
        } catch (Exception $e) {
            $mensaje = array("mensaje" => $e->getMessage(),"ruta"=>"");
        }

        return $mensaje;
    }


    public static function mdlAutenticarFuncionario($email,$password){
        $mensaje = array();
        $emailFuncionario = strtolower($email);
        try {
            $sql = "SELECT * FROM funcionario INNER JOIN tipo_funcionario ON tipo_funcionario.idtipo_funcionario = funcionario.tipo_funcionario_idtipo_funcionario WHERE funcionario.email = :email AND funcionario.password = :password";
            $objRespuesta = Conexion::conectar()->prepare($sql);
            $objRespuesta->bindParam(":email",$emailFuncionario);
            $objRespuesta->bindParam(":password",$password);
            $objRespuesta->execute();
            $datosFuncionario = $objRespuesta->fetch();
            $objRespuesta = null;
            if ($datosFuncionario != null){
                if ($datosFuncionario["ingreso"] != "2"){
                    $mensaje = array("mensaje" => "ok");
                    $tipoFuncionario = strtoupper($datosFuncionario["nombre_tipo_funcionario"]);
                    $_SESSION["usuario"] = "ok";
                    $_SESSION["tipoUsuario"] = $datosFuncionario["idtipo_funcionario"];
                    $_SESSION["nombreUsuario"] = $datosFuncionario["nombres"];
                    $_SESSION["nombreCompleto"] = $datosFuncionario["nombres"]." ".$datosFuncionario["apellidos"];
                    $_SESSION["id"] = $datosFuncionario["idfuncionario"];
                    $_SESSION["foto"] = $datosFuncionario["url_foto"];
                    $_SESSION["documento"] = $datosFuncionario["documento"];
                    $_SESSION["password"] = $datosFuncionario["password"];
                    $_SESSION["rutaInicio"] = "";
                    $mensaje = array("mensaje"=>$_SESSION["tipoUsuario"]);
                }else{
                    $mensaje = array("mensaje" => "Error al iniciar sesión su usuario se encuentra inhabilitado.");
                }
            }else{
                $mensaje = array("mensaje" => "Error al iniciar sesión por favor verifique sus datos.");
            }
        } catch (Exception $e) {
            $mensaje = array("mensaje" => $e->getMessage());
        }

        return $mensaje;
    }


    public static function mdlCargarSelectDocumento(){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM tipo_documento");
            $objRespuesta->execute();
            $mensaje = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlcargarSelectTipoFuncionario(){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM tipo_funcionario");
            $objRespuesta->execute();
            $mensaje = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlcargarSelectEstadoAprendiz(){
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM estado_aprendiz");
            $objRespuesta->execute();
            $mensaje = $objRespuesta->fetchAll();
            $objRespuesta = null;
        } catch (Exception $e) {
            $mensaje = array("mensaje" => $e->getMessage());
        }
        return $mensaje;
    }


    public static function mdlListarUsuario($idUsuario,$tipoUsuario){
        $listaDatosUsuario = null;
        try {
            // si el tipo usuario es 10 consulta tabla aprendiz de lo contrario sera tabla funcionarios
            if ($tipoUsuario >= "10"){
                $sql = "SELECT * FROM aprendiz INNER JOIN ficha ON ficha.idficha = aprendiz.ficha_idficha INNER JOIN tipo_documento ON tipo_documento.idtipo_documento = aprendiz.tipo_documento_idtipo_documento INNER JOIN estado_aprendiz ON estado_aprendiz.idestado_aprendiz = aprendiz.estado_aprendiz_idestado_aprendiz WHERE aprendiz.idaprendiz = :idusuario";
            }else{
                $sql = "SELECT * FROM funcionario INNER JOIN tipo_funcionario ON tipo_funcionario.idtipo_funcionario = funcionario.tipo_funcionario_idtipo_funcionario INNER JOIN tipo_documento ON tipo_documento.idtipo_documento = funcionario.tipo_documento_idtipo_documento INNER JOIN municipios ON municipios.codi_muni = funcionario.municipios_codi_muni INNER JOIN departamentos ON municipios.departamentos_codi_depa = departamentos.codi_depa WHERE funcionario.idfuncionario = :idusuario";
            }
            $objRespuesta = Conexion::conectar()->prepare($sql);
            $objRespuesta->bindParam(":idusuario",$idUsuario);
            $objRespuesta->execute();
            $listaDatosUsuario = $objRespuesta->fetch();
            $objRespuesta = null;
        } catch (Exception $e) {
            $listaDatosUsuario = $e->getMessage();
        }
        
        return $listaDatosUsuario;
    }


    public static function mdlEditarRutaArchivo($idUsuario,$tipoUsuario,$url_archivo,$nombre_campo){
        $mensaje = array();
        $sql = "";

        try {
            if ($tipoUsuario >= "10"){
                $sql = "UPDATE aprendiz SET ".$nombre_campo." = :".$nombre_campo." WHERE idaprendiz=:idaprendiz";
            }else{
                $sql = "UPDATE funcionario SET ".$nombre_campo." = :".$nombre_campo." WHERE idfuncionario=:idfuncionario";
            }
            $objRespuesta = Conexion::conectar()->prepare($sql);
            $objRespuesta->bindParam(":".$nombre_campo,$url_archivo);
            if ($tipoUsuario >= "10"){
                $objRespuesta->bindParam(":idaprendiz",$idUsuario);
            }else{
                $objRespuesta->bindParam(":idfuncionario",$idUsuario);
            }
            if ($objRespuesta->execute()){
                $mensaje = array("codigo"=>"202","mensaje"=>$url_archivo);
                $objRespuesta = null;
            }else{
                $mensaje = array("codigo"=>"425","mensaje"=>"error al actualizar datos");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"425","mensaje"=>$e->getMessage());
        }

        return $mensaje;
    }

    public static function mdlActualizarContraseñaPrimerInicioUsuario ($usuario,$password,$id) {
        $mensaje = [];

        try {

            if ($usuario <= 9) {
                $sql = "UPDATE funcionario SET password = :psw WHERE idfuncionario = :idUsuario";
            }else{
                $sql = "UPDATE aprendiz SET password_aprendiz = :psw WHERE idaprendiz = :idUsuario";
            }

            $objRespuesta = Conexion::conectar()->prepare($sql);
            $objRespuesta -> bindparam(":psw",$password);
            $objRespuesta -> bindparam(":idUsuario",$id);

            if ($objRespuesta -> execute()) {
                $mensaje = ["codigo" => "200"];
            }else{
                $mensaje = ["codigo" => "425"];
            }

            $objRespuesta = null;

        } catch (Exception $e) {
            $mensaje = ["codigo" => "425"];
        }
        return $mensaje;
    }   
    
    
    public static function mdlIngresoMasivo($estadoIngreso){
        $mensaje = array();
        $tipoFuncionario = 1; //instructor
        try {
            $objRespuesta = Conexion::conectar()->prepare("UPDATE funcionario SET ingreso=:ingreso WHERE tipo_funcionario_idtipo_funcionario=:tipo_funcionario_idtipo_funcionario");
            $objRespuesta->bindParam(":ingreso",$estadoIngreso);
            $objRespuesta->bindParam(":tipo_funcionario_idtipo_funcionario",$tipoFuncionario);
            if ($objRespuesta->execute()){
                $textoMensaje = "";
                if ($estadoIngreso == "1"){
                    $textoMensaje = "Instructores habilitados correctamente";
                }else{
                    $textoMensaje = "Instructores bloqueados correctamente";
                }
                $mensaje = array("codigo"=>"200","mensaje"=>$textoMensaje);
            }else{
                $mensaje = array("codigo"=>"401","mensaje"=>"error no fue posible modificar el estado de los funcionarios");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"401","mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlAutenticarAprendizCertificado($documento,$ficha,$password) {
        $mensaje = array();
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM aprendices_certificados WHERE documento = :documento AND numero_ficha = :numeroFicha AND password_aprendiz = :passwordAprendiz");
            $objRespuesta -> bindParam(":documento",$documento);
            $objRespuesta -> bindParam(":numeroFicha",$ficha);
            $objRespuesta -> bindParam(":passwordAprendiz",$password);
            
            $objRespuesta -> execute();
            $datosAprendiz = $objRespuesta->fetch();
            $objRespuesta = null;
            if ($datosAprendiz != null) {
                $_SESSION["usuario"] = "ok";
                $_SESSION["tipoUsuario"] = "11";
                $_SESSION["nombreUsuario"] = strtoupper($datosAprendiz["nombres"]." ".$datosAprendiz["apellidos"]);
                $_SESSION["id"] = $datosAprendiz["idaprendices_certificados"];
                $_SESSION["ficha"] = $datosAprendiz["numero_ficha"];
                $_SESSION["foto"] = $datosAprendiz["foto"];
                $_SESSION["nombreFicha"] = $datosAprendiz["caracterizacion"];
                $_SESSION["documento"] = $datosAprendiz["documento"];
                $_SESSION["password"] = $datosAprendiz["password_aprendiz"];
                $_SESSION["objCertificacion"] = $datosAprendiz;
                $_SESSION["rutaInicio"] = "";
                $mensaje = array("codigo"=>"200", "mensaje"=>"todo correcto.");
            }else {
                $mensaje = array("codigo"=>"202", "mensaje"=>"verifica tus datos.");
            }
        } catch (Exception $e) {
            $mensaje = array("codigo"=>"203", "mensaje"=>$e->getMessage());
        }
        return $mensaje;
    }
}