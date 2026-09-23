<?php

include_once "conexion.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

class certificarAprendizModelo
{

    /* ------------------------------- Validar Estado seguimiento ------------------------------------------- */
    /* Fecha de Creacion :  27/08/2023           Desarrollador: Humberto benavides                            */
    /* Parametros : idAprendiz                                                                                */
    /* Retorno : mensaje de exito si se certifica el aprendiz, la funcion se encargar de limpiar base de datos 
                y carpeta de archivos                                                                        */
    /* -------------------------------------------------------------------------------------------------------*/
    /* --------------------------------------Control de cambios ----------------------------------------------*/
    /* Desarrollador: Marco Antonio Cipagauta                  fecha:  23/09/2025                             */
    /* Descripcion: se bloqueo eliminada de archivos y limpieza de base de datos para conservar la integridad
                    de la informacion debido a peticion de cordinacion academica para conservar el historial  */
    /*--------------------------------------------------------------------------------------------------------*/
    public static function mdlCertificarAprendiz($id)
    {
        $mensaje = [];
        $objRespaldoAprendizCertificado = null;
        //comprobar que los documentos dependiendo del tipo de programa esten aprobados
        $requisitos = self::mdlComprobarRequisitos($id);
        if ($requisitos["codigo"] == "200") {
            //crear objeto respaldo
            $respaldo = self::mdlCrearRespaldoAprendiz($id);
            $mensaje = $respaldo;

            if ($respaldo["codigo"] == "200") {
                $rutaFolderAprendiz = "../archivos/aprendices/" . $respaldo["mensaje"]["numero_ficha"] . "/" . $respaldo["mensaje"]["documento"];
                // $vaciarFolders = self::mdlVaciarFolders($rutaFolderAprendiz); // suspender eliminacion de archivos
                $vaciarFolders = ["codigo" => "200"];
                
                if ($vaciarFolders["codigo"] == "200") {
                    //$limpiarBaseDatos = self::mdlLimpiarBaseDatos($id);  // suspender limpieza de base de datos para conservar integridad
                    $limpiarBaseDatos = ["codigo" => "200"];
                    if ($limpiarBaseDatos["codigo"] == "200") {
                        $mensaje = ["codigo" => "200", "mensaje" => "El aprendiz se ha certificado exitosamente."];

                        // correo al aprendiz
                        include "../vista/modulos/emailNotificacionEsperarCertificado.php";

                        // Configuración del servidor
                        $mail = new PHPMailer(true);
                        $mail->SMTPDebug = 0; // Cambiado a 0 para producción (sin mensajes de depuración)
                        $mail->isSMTP();
                        $mail->Host       = 'www.sgdcimm.com.co';
                        $mail->SMTPAuth   = true;
                        $mail->Username   = 'seguimientos@sgdcimm.com.co';
                        $mail->Password   = 'tK8N&Rssg?zb';
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port       = 465;

                        // Destinatarios
                        $mail->setFrom('seguimientos@sgdcimm.com.co', 'Notificación de espera de certificado');
                        $mail->addAddress($respaldo["mensaje"]["email"]); // Usa el email del aprendiz

                        // Contenido
                        $mail->isHTML(true);
                        $mail->Subject = "Certificado en proceso";
                        $mail->Body    = $cuerpoEmailNotificacion;
                        $mail->CharSet = 'UTF-8';

                        // Intentar enviar el correo
                        try {
                            $resultado = $mail->send();
                            if ($resultado) {
                                $mensaje = ["codigo" => "200", "mensaje" => "Correo enviado correctamente a " . $respaldo["mensaje"]["email"]];
                            } else {
                                $mensaje = ["codigo" => "425", "error" => $mail->ErrorInfo];
                            }
                        } catch (Exception $e) {
                            $mensaje = ["codigo" => "425", "error" => $mail->ErrorInfo, "exception" => $e->getMessage()];
                        }
                    } else {
                        $mensaje = ["codigo" => "202", "mensaje" => "Ha ocurrido un error al certificar al aprendiz."];
                    }
                } else {
                    $mensaje = ["codigo" => "202", "mensaje" => "Ha ocurrido un error al limpiar el folder base."];
                }
                $mensaje = ["codigo" => "200", "mensaje" => "exito"];
            } else {
                $mensaje = ["codigo" => "202", "mensaje" => "El respaldo no pudo ser creado, intenta de nuevo mas tarde."];
            }
        } else {
            $mensaje = ["codigo" => "202", "mensaje" => $requisitos["mensaje"]];
        }
        return $mensaje;
    }

    public static function mdlComprobarRequisitos($id)
    {
        $mensaje = [];
        try {
            $objConsulta = Conexion::conectar()->prepare("SELECT certificacion.*, tipo_programa.* 
                FROM certificacion INNER JOIN 
                aprendiz ON aprendiz_idaprendiz = idaprendiz 
                INNER JOIN ficha ON ficha_idficha = idficha 
                INNER JOIN tipo_programa ON tipo_programa_idtipo_programa = idtipo_programa 
                WHERE idaprendiz = :idaprendiz");
            $objConsulta->bindParam(":idaprendiz", $id);
            if ($objConsulta->execute()) {
                $objrequisitos = $objConsulta->fetchAll();
                $tipoPrograma = null;
                $contadorCumplimientoRequisitos = null;

                foreach ($objrequisitos as $item) {
                    if ($item["estado_archivo"] == 2) {
                        $contadorCumplimientoRequisitos += 1;
                    }

                    $tipoPrograma = $item["nombre_programa"];
                }

                if ($tipoPrograma == "Tecnólogo" && $contadorCumplimientoRequisitos == 5) {
                    $mensaje = ["codigo" => "200", "mensaje" => $objrequisitos];
                } else if ($tipoPrograma != "Tecnólogo" && $contadorCumplimientoRequisitos == 4) {
                    $mensaje = ["codigo" => "200", "mensaje" => $objrequisitos];
                } else {
                    $mensaje = ["codigo" => "202", "mensaje" => "El aprendiz no cumple con las condiciones para certificarse."];
                }
            } else {
                $mensaje = ["codigo" => "202", "mensaje" => "Error al generar la consulta"];
            }
            $objConsulta = null;
        } catch (Exception $e) {
            $mensaje = ["codigo" => "202", "mensaje" => $e->getMessage()];
        }
        return $mensaje;
    }

    public static function mdlCrearRespaldoAprendiz($id)
    {
        $mensaje = [];
        $respaldo = self::mdlBuscarRespaldo($id);
        if ($respaldo["codigo"] == "200") {
            try {
                // Obtener información de empresa y ubicación
                $objConsultaEmpresa = Conexion::conectar()->prepare("
                        SELECT e.nombre_empresa, e.direccion_empresa, m.nomb_muni, d.nomb_depa 
                        FROM seguimiento s 
                        INNER JOIN empresa e ON s.empresa_idempresa = e.idempresa 
                        INNER JOIN municipios m ON e.municipios_codi_muni = m.codi_muni 
                        INNER JOIN departamentos d ON m.departamentos_codi_depa = d.codi_depa 
                        WHERE s.aprendiz_idaprendiz = :idaprendiz
                    ");
                $objConsultaEmpresa->bindParam(":idaprendiz", $id);
                $objConsultaEmpresa->execute();
                $datosEmpresa = $objConsultaEmpresa->fetch(PDO::FETCH_ASSOC);

                // Valores por defecto si no se encuentra información
                $nombreEmpresa = $datosEmpresa ? $datosEmpresa['nombre_empresa'] : 'No disponible';
                $direccionEmpresa = $datosEmpresa ? $datosEmpresa['direccion_empresa'] : 'No disponible';
                $municipio = $datosEmpresa ? $datosEmpresa['nomb_muni'] : 'No disponible';
                $departamento = $datosEmpresa ? $datosEmpresa['nomb_depa'] : 'No disponible';

                if ($respaldo["mensaje"]["url_foto"] == "" || $respaldo["mensaje"]["url_foto"] == null) {
                    $respaldo["mensaje"]["url_foto"] = "assets/img/interface/profile.png";
                }
                $fecha = date('Y-m-d');
                $existe = self::mdlverificarExistencia($respaldo["mensaje"]);
                if ($existe["codigo"] == "201") { //no existe
                    $objConsulta = Conexion::conectar()->prepare("INSERT INTO aprendices_certificados (nombres,apellidos,documento,telefono,email,foto,numero_ficha,caracterizacion,modalidad,fin_practica,fecha_certificacion,password_aprendiz,nombre_empresa,direccion_empresa,municipio,departamento) VALUES (:nombres,:apellidos,:documento,:telefono,:email,:foto,:numeroficha,:caracterizacion,:modalidad,:finpractica,:fecha_certificacion,:password_aprendiz,:nombre_empresa,:direccion_empresa,:municipio,:departamento)");
                    $objConsulta->bindParam(":nombres", $respaldo["mensaje"]["nombres"]);
                    $objConsulta->bindParam(":apellidos", $respaldo["mensaje"]["apellidos"]);
                    $objConsulta->bindParam(":documento", $respaldo["mensaje"]["documento"]);
                    $objConsulta->bindParam(":telefono", $respaldo["mensaje"]["telefono"]);
                    $objConsulta->bindParam(":email", $respaldo["mensaje"]["email"]);
                    $objConsulta->bindParam(":foto", $respaldo["mensaje"]["url_foto"]);
                    $objConsulta->bindParam(":numeroficha", $respaldo["mensaje"]["numero_ficha"]);
                    $objConsulta->bindParam(":caracterizacion", $respaldo["mensaje"]["caracterizacion"]);
                    $objConsulta->bindParam(":modalidad", $respaldo["mensaje"]["nombre_modalidad"]);
                    $objConsulta->bindParam(":finpractica", $respaldo["mensaje"]["fecha_fin_practica_seguimiento"]);
                    $objConsulta->bindParam(":fecha_certificacion", $fecha);
                    $objConsulta->bindParam(":password_aprendiz", $respaldo["mensaje"]["password_aprendiz"]);
                    $objConsulta->bindParam(":nombre_empresa", $nombreEmpresa);
                    $objConsulta->bindParam(":direccion_empresa", $direccionEmpresa);
                    $objConsulta->bindParam(":municipio", $municipio);
                    $objConsulta->bindParam(":departamento", $departamento);

                    if ($objConsulta->execute()) {
                        $mensaje = ["codigo" => "200", "mensaje" => $respaldo["mensaje"]];


                        










                    } else {
                        $mensaje = ["codigo" => "202", "mensaje" => "error al crear el respaldo"];
                    }
                    $objConsulta = null;
                } else if ($existe["codigo"] == "200") { //si existe actualiza
                    $objConsulta = Conexion::conectar()->prepare("UPDATE aprendices_certificados SET nombres = :nombres, apellidos = :apellidos, documento = :documento, telefono = :telefono, email = :email, foto = :foto, numero_ficha = :numeroficha, caracterizacion = :caracterizacion, modalidad = :modalidad, fin_practica = :finpractica, password_aprendiz = :password_aprendiz, fecha_certificacion = NOW(), nombre_empresa = :nombre_empresa, direccion_empresa = :direccion_empresa, municipio = :municipio, departamento = :departamento WHERE idaprendices_certificados = :id");
                    $objConsulta->bindParam(":id", $existe["mensaje"]["idaprendices_certificados"]);
                    $objConsulta->bindParam(":nombres", $respaldo["mensaje"]["nombres"]);
                    $objConsulta->bindParam(":apellidos", $respaldo["mensaje"]["apellidos"]);
                    $objConsulta->bindParam(":documento", $respaldo["mensaje"]["documento"]);
                    $objConsulta->bindParam(":telefono", $respaldo["mensaje"]["telefono"]);
                    $objConsulta->bindParam(":email", $respaldo["mensaje"]["email"]);
                    $objConsulta->bindParam(":foto", $respaldo["mensaje"]["url_foto"]);
                    $objConsulta->bindParam(":numeroficha", $respaldo["mensaje"]["numero_ficha"]);
                    $objConsulta->bindParam(":caracterizacion", $respaldo["mensaje"]["caracterizacion"]);
                    $objConsulta->bindParam(":modalidad", $respaldo["mensaje"]["nombre_modalidad"]);
                    $objConsulta->bindParam(":finpractica", $respaldo["mensaje"]["fecha_fin_practica_seguimiento"]);
                    $objConsulta->bindParam(":password_aprendiz", $respaldo["mensaje"]["password_aprendiz"]);
                    $objConsulta->bindParam(":nombre_empresa", $nombreEmpresa);
                    $objConsulta->bindParam(":direccion_empresa", $direccionEmpresa);
                    $objConsulta->bindParam(":municipio", $municipio);
                    $objConsulta->bindParam(":departamento", $departamento);

                    if ($objConsulta->execute()) {
                        $mensaje = ["codigo" => "200", "mensaje" => $respaldo["mensaje"]];

                    } else {
                        $mensaje = ["codigo" => "202", "mensaje" => "error al crear el respaldo"];
                    }
                    $objConsulta = null;
                } else {
                    $mensaje = ["codigo" => "202", "mensaje" => "error en la consulta"];
                }
            } catch (Exception $e) {
                $mensaje = ["codigo" => "202", "mensaje" => $e->getMessage()];
            }
        } else {
            $mensaje = ["codigo" => "202", "mensaje" => "el aprendiz no existe"];
        }
        return $mensaje;
    }

    public static function mdlverificarExistencia($respaldo)
    {
        $mensaje = [];
        try {
            $objExisteRegistro = Conexion::conectar()->prepare("SELECT * FROM aprendices_certificados WHERE documento = :documento AND numero_ficha = :numeroficha");
            $objExisteRegistro->bindParam(":documento", $respaldo["documento"]);
            $objExisteRegistro->bindParam(":numeroficha", $respaldo["numero_ficha"]);
            $objExisteRegistro->execute();
            $aprendiz = $objExisteRegistro->fetch();
            if ($aprendiz != null) {
                $mensaje = ["codigo" => "200", "mensaje" => $aprendiz];
            } else {
                $mensaje = ["codigo" => "201", "mensaje" => $aprendiz];
            }
            $objExisteRegistro = null;
        } catch (Exception $e) {
            $mensaje = ["codigo" => "202", "mensaje" => $e->getMessage()];
        }
        return $mensaje;
    }

    public static function mdlBuscarRespaldo($id)
    {
        $mensaje = [];
        $respaldo = null;
        try {
            $objConsulta = Conexion::conectar()->prepare("SELECT * FROM aprendiz INNER JOIN ficha ON ficha_idficha = idficha INNER JOIN seguimiento ON idaprendiz = aprendiz_idaprendiz INNER JOIN modalidad ON modalidad_idmodalidad = idmodalidad WHERE idaprendiz = :idaprendiz");
            $objConsulta->bindParam(":idaprendiz", $id);
            if ($objConsulta->execute()) {
                $respaldo = $objConsulta->fetch();
                $respaldoBD = $objConsulta->fetchAll();
                $mensaje = ["codigo" => "200", "mensaje" => $respaldo, "respaldoBD" => $respaldoBD];
            }
            $objConsulta = null;
        } catch (Exception $e) {
            $mensaje = ["codigo" => "202", "mensaje" => $e->getMessage()];
        }
        return $mensaje;
    }

    public static function mdlVaciarFolders($rutaFolderAprendiz)
    {
        $mensaje = [];
        $errorFicheros = 0;
        $errorFolders = 0;
        $contenidoFolder = scandir($rutaFolderAprendiz);
        foreach ($contenidoFolder as $item) {
            $subRuta = null;
            if ($item == "." || $item == "..") {
            } else {
                if (is_dir($rutaFolderAprendiz . "/" . $item)) {
                    $contenidoSubFolder = scandir($rutaFolderAprendiz . "/" . $item);
                    foreach ($contenidoSubFolder as $subItem) {
                        if ($subItem == "." || $subItem == "..") {
                        } else {
                            if (file_exists($rutaFolderAprendiz . "/" . $item . "/" . $subItem)) {
                                if (!unlink($rutaFolderAprendiz . "/" . $item . "/" . $subItem)) {
                                    $errorFicheros += 1;
                                }
                            }
                        }
                    }
                }
            }
        }

        if ($errorFicheros == 0) {
            foreach ($contenidoFolder as $item) {
                $subRuta = null;
                if ($item == "." || $item == "..") {
                } else {
                    if (is_dir($rutaFolderAprendiz . "/" . $item)) {
                        if (file_exists($rutaFolderAprendiz . "/" . $item)) {
                            if (!rmdir($rutaFolderAprendiz . "/" . $item)) {
                                $errorFolders += 1;
                            }
                        }
                    }
                }
            }
            if ($errorFolders == 0) {
                $mensaje = ["codigo" => "200", "mensaje" => "El proceso de limpieza a sido exitoso."];
            } else {
                $mensaje = ["codigo" => "202", "mensaje" => "han ocurido " . $errorFolders . " durante el proceso de eliminar folders."];
            }
        } else {
            $mensaje = ["codigo" => "202", "mensaje" => "han ocurido " . $errorFicheros . " durante el proceso de eliminar ficheros."];
        }
        return $mensaje;
    }

    public static function mdlLimpiarBaseDatos($idaprendiz)
    {
        $mensaje = [];
        $datosEtapaSeguimientos = self::consultarEtapaPractica($idaprendiz);
        if ($datosEtapaSeguimientos != "404") {
            $error = 0;
            $ordenLimpieza =
                [
                    "DELETE FROM bitacora WHERE aprendiz_idaprendiz = :id",
                    "DELETE FROM certificacion WHERE aprendiz_idaprendiz = :id",
                    "DELETE FROM recuperacion_contrasena_aprendiz WHERE aprendiz_idaprendiz = :id",
                    "DELETE FROM visita_seguimiento WHERE seguimiento_idseguimiento = :id",
                    "DELETE FROM seguimiento WHERE aprendiz_idaprendiz = :id",
                    "DELETE FROM aprendiz WHERE idaprendiz = :id"
                ];
            for ($i = 0; $i < count($ordenLimpieza); $i++) {
                try {
                    if ($i !== 3) {
                        $sql = $ordenLimpieza[$i];
                        $objConsulta = Conexion::conectar()->prepare($sql);
                        $objConsulta->bindParam(":id", $idaprendiz);
                        if (!$objConsulta->execute()) {
                            $error += 1;
                        }
                        $objConsulta = null;
                    } else {
                        for ($j = 0; $j < count($datosEtapaSeguimientos); $j++) {
                            $sql = $ordenLimpieza[$i];
                            $objConsulta = Conexion::conectar()->prepare($sql);
                            $objConsulta->bindParam(":id", $datosEtapaSeguimientos[$j]["idseguimiento"]);
                            if (!$objConsulta->execute()) {
                                $error += 1;
                            }
                            $objConsulta = null;
                        }
                    }
                } catch (Exception $e) {
                    $error += 1;
                }
            }
            if ($error == 0) {
                $mensaje = ["codigo" => "200", "mensaje" => "la limpieza se realizo con exito."];
            } else {
                $mensaje = ["codigo" => "202", "mensaje" => "hubo un error al limpiar la base de datos."];
            }
        } else {
            $mensaje = ["codigo" => "202", "mensaje" => "hubo un error al consultar las etapas practicas."];
        }
        return $mensaje;
    }

    public static function mdlSeguimientosAprendizCertificacion($id)
    {
        $mensaje = null;
        try {
            $sql = "SELECT * FROM visita_seguimiento INNER JOIN tipo_seguimiento ON tipo_seguimiento_idtipo_seguimiento = idtipo_seguimiento INNER JOIN seguimiento ON seguimiento_idseguimiento = idseguimiento INNER JOIN funcionario ON funcionario.idfuncionario = visita_seguimiento.funcionario_idfuncionario WHERE aprendiz_idaprendiz = :id";
            $objConsulta = Conexion::conectar()->prepare($sql);
            $objConsulta->bindParam(":id", $id);
            if ($objConsulta->execute()) {
                $mensaje = $objConsulta->fetchAll();
            }
            $objConsulta = null;
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
        }
        return $mensaje;
    }

    public static function consultarEtapaPractica($id)
    {
        $mensaje = null;
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM seguimiento WHERE aprendiz_idaprendiz = :id");
            $objRespuesta->bindParam(":id", $id);
            $objRespuesta->execute();
            $mensaje = $objRespuesta->fetchAll();
            $objRespuesta = null;
            if ($mensaje == null) {
                $mensaje = "404";
            }
        } catch (Exception $e) {
            $mensaje = "404";
        }
        return $mensaje;
    }
}
