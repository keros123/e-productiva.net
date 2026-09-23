<?php

    include_once "conexion.php";

    class lineaRedTecnologicaModelo {

        public static function mdlAgregarLineaTecnologica ($nombre) {
            $mensaje = [];
            try {
                $sql = "SELECT * FROM linea_tecnologica WHERE nombre_linea_tecnologica = :nombre";
                $objConsulta = conexion::conectar()->prepare($sql);
                $objConsulta->bindparam(":nombre",$nombre);

                if ($objConsulta->execute()) {
                    $existe = $objConsulta->fetch();
                    $objConsulta = null;

                    if ($existe != null) {
                        $mensaje = ["codigo" => "201"];
                    }else {
                        $sql = "INSERT INTO linea_tecnologica(nombre_linea_tecnologica) VALUES (:nombre)";
                        $objConsulta = conexion::conectar()->prepare($sql);
                        $objConsulta->bindparam(":nombre",$nombre);

                        if ($objConsulta->execute()) {
                            $objConsulta = null;
                            $fecha = date("Y-m-d H:i:s");
                            $responsable = $_SESSION["nombreCompleto"];
                            $proceso = "Creo línea tecnológica";
                            $descripcion = "Se creo la línea tecnológica ".$nombre;
                            $sql = "INSERT INTO procesos_linea_red_tecnologica(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                            $objConsulta = conexion::conectar()->prepare($sql);
                            $objConsulta->bindparam(":fecha",$fecha);
                            $objConsulta->bindparam(":responsable",$responsable);
                            $objConsulta->bindparam(":proceso",$proceso);
                            $objConsulta->bindparam(":descripcion",$descripcion);
                            if ($objConsulta->execute()) {
                                $objConsulta = null;
                                $mensaje = ["codigo" => "200"];
                            }else{
                                $mensaje = ["codigo" => "425"];
                            }
                        }else{
                            $mensaje = ["codigo" => "425"];
                        }
                    }
                }
            } catch (Exception $e) {
                $mensaje = ["codigo" => "425"];
            }
            return $mensaje;
        } 

        public static function mdlEditarLineaTecnologica ($nombre,$id,$nombreLinea) {
            $mensaje = [];
            try {
                $sql = "SELECT * FROM linea_tecnologica WHERE nombre_linea_Tecnologica = :nombre";
                $objConsulta = conexion::conectar()->prepare($sql);
                $objConsulta->bindparam(":nombre",$nombre);

                if ($objConsulta->execute()) {
                    $existe = $objConsulta->fetch();
                    $objConsulta = null;
                    if ($existe != null) {
                        $mensaje = ["codigo" => "425", "mensaje"=>"ya existe una línea tecnológica con ese nombre"];
                    }else {
                        $sql = "UPDATE linea_tecnologica SET nombre_linea_tecnologica = :nombre WHERE idlinea_tecnologica = :id";
                        $objConsulta = conexion::conectar()->prepare($sql);
                        $objConsulta->bindparam(":nombre",$nombre);
                        $objConsulta->bindparam(":id",$id);

                        if ($objConsulta->execute()) {
                            $objConsulta = null;
                            $fecha = date("Y-m-d H:i:s");
                            $responsable = $_SESSION["nombreCompleto"];
                            $proceso = "Edito línea tecnológica";
                            $descripcion = "Se edito el nombre de la línea tecnológica ".$nombreLinea." por ".$nombre;
                            $sql = "INSERT INTO procesos_linea_red_tecnologica(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                            $objConsulta = conexion::conectar()->prepare($sql);
                            $objConsulta->bindparam(":fecha",$fecha);
                            $objConsulta->bindparam(":responsable",$responsable);
                            $objConsulta->bindparam(":proceso",$proceso);
                            $objConsulta->bindparam(":descripcion",$descripcion);
                            if ($objConsulta->execute()) {
                                $objConsulta = null;
                                $mensaje = ["codigo" => "200", "mensaje"=>"los datos se actualizaron correctamente"];
                            }else{
                                $mensaje = ["codigo" => "425", "mensaje"=>"hubo un problema al actualizar los datos!"];
                            }
                        }else{
                            $mensaje = ["codigo" => "425", "mensaje"=>"hubo un problema al actualizar los datos!"];
                        }
                        $objConsulta = null;
                    }
                }else {
                    $mensaje = ["codigo" => "425", "mensaje"=>"hubo un problema al actualizar los datos!"];
                }
                
                
            } catch (Exception $e) {
                $mensaje = ["codigo" => "425", "mensaje"=>"hubo un problema al actualizar los datos!"];
            }
            return $mensaje;
        } 

        public static function mdlEliminarLineaTecnologica ($id,$nombreLinea) {
            $mensaje = [];
            try {
                $sql = "SELECT * FROM linea_tecnologica INNER JOIN red_tecnologica ON linea_tecnologica.idlinea_tecnologica = red_tecnologica.linea_tecnologica_idlinea_tecnologica WHERE idlinea_tecnologica = :id";
                $objConsulta = conexion::conectar()->prepare($sql);
                $objConsulta->bindparam(":id",$id);

                if ($objConsulta->execute()) {
                    $contieneRed = $objConsulta->fetchAll();
                    $objConsulta = null;
                    if ($contieneRed != null) {
                        $mensaje = ["codigo" => "425", "mensaje" =>  "no es posible eliminar la línea tecnológica, contiene datos de red tecnológica"];
                    }else {
                        $sql = "DELETE FROM linea_tecnologica WHERE idlinea_tecnologica = :id";
                        $objConsulta = conexion::conectar()->prepare($sql);
                        $objConsulta->bindparam(":id",$id);

                        if ($objConsulta->execute()) {
                            $objConsulta = null;
                            $fecha = date("Y-m-d H:i:s");
                            $responsable = $_SESSION["nombreCompleto"];
                            $proceso = "Elimino línea tecnológica";
                            $descripcion = "Se elimino la línea tecnológica ".$nombreLinea;
                            $sql = "INSERT INTO procesos_linea_red_tecnologica(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                            $objConsulta = conexion::conectar()->prepare($sql);
                            $objConsulta->bindparam(":fecha",$fecha);
                            $objConsulta->bindparam(":responsable",$responsable);
                            $objConsulta->bindparam(":proceso",$proceso);
                            $objConsulta->bindparam(":descripcion",$descripcion);
                            if ($objConsulta->execute()) {
                                $objConsulta = null;
                                $mensaje = ["codigo" => "200", "mensaje"=>"Correcto"];
                            }else{
                                $mensaje = ["codigo" => "425", "mensaje"=>"hubo un problema al eliminar los datos!"];
                            }
                        }else{
                            $mensaje = ["codigo" => "425", "mensaje" => "hubo un problema al eliminar los datos!"];
                        }
                        $objConsulta = null;
                    }
                }else{
                    $mensaje = ["codigo" => "425", "mensaje" => "hubo un problema al eliminar los datos!"];
                }
                
            } catch (Exception $e) {
                $mensaje = ["codigo" => "425", "mensaje" => "hubo un problema al eliminar los datos!"];
            }
            return $mensaje;
        } 

        public static function mdllistarLineaTecnologica () {
            try {
                $sql = "SELECT * FROM linea_tecnologica";
                $objConsulta = conexion::conectar()->prepare($sql);

                if ($objConsulta->execute()) {
                    $datos = $objConsulta->fetchAll();
                }else{
                    $datos = "425";
                }
                $objConsulta = null;
                
            } catch (Exception $e) {
                $datos = "425";
            }
            return $datos;
        } 

        //red
        public static function mdllistarRedTecnologica ($idLinea) {
            try {
                $sql = "SELECT * FROM red_tecnologica WHERE linea_tecnologica_idlinea_tecnologica = :id";
                $objConsulta = conexion::conectar()->prepare($sql);
                $objConsulta->bindparam(":id", $idLinea);

                if ($objConsulta->execute()) {
                    $datos = $objConsulta->fetchAll();
                }else{
                    $datos = "425";
                }
                $objConsulta = null;
                
            } catch (Exception $e) {
                $datos = "425";
            }
            return $datos;
        } 

        public static function mdlAgregarRedTecnologica ($nombre,$idLinea,$nombreLinea) {
            $mensaje = [];
            try {
                $sql = "SELECT * FROM red_tecnologica WHERE nombre_red_tecnologica = :nombre AND linea_tecnologica_idlinea_tecnologica = :id";
                $objConsulta = conexion::conectar()->prepare($sql);
                $objConsulta->bindparam(":nombre",$nombre);
                $objConsulta->bindparam(":id",$idLinea);

                if ($objConsulta->execute()) {
                    $existe = $objConsulta->fetch();
                    $objConsulta = null;
                    if ($existe != null) {
                        $mensaje = ["codigo" => "201"];
                    }else {
                        $sql = "INSERT INTO red_tecnologica(nombre_red_tecnologica,linea_tecnologica_idlinea_tecnologica)VALUES(:nombre,:id)";
                        $objConsulta = conexion::conectar()->prepare($sql);
                        $objConsulta->bindparam(":nombre",$nombre);
                        $objConsulta->bindparam(":id",$idLinea);

                        if ($objConsulta->execute()) {
                            $objConsulta = null;
                            $fecha = date("Y-m-d H:i:s");
                            $responsable = $_SESSION["nombreCompleto"];
                            $proceso = "Creo red tecnológica";
                            $descripcion = "Se creo la red tecnológica ".$nombre." en la línea tecnológica ".$nombreLinea;
                            $sql = "INSERT INTO procesos_linea_red_tecnologica(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                            $objConsulta = conexion::conectar()->prepare($sql);
                            $objConsulta->bindparam(":fecha",$fecha);
                            $objConsulta->bindparam(":responsable",$responsable);
                            $objConsulta->bindparam(":proceso",$proceso);
                            $objConsulta->bindparam(":descripcion",$descripcion);
                            if ($objConsulta->execute()) {
                                $objConsulta = null;
                                $mensaje = ["codigo" => "200"];
                            }else{
                                $mensaje = ["codigo" => "425"];
                            }
                        }else{
                            $mensaje = ["codigo" => "425"];
                        }
                    }
                }else {
                    $mensaje = ["codigo" => "425"];
                }
            } catch (Exception $e) {
                $mensaje = ["codigo" => "425"];
            }
            return $mensaje;
        } 

        public static function mdlEditarRedTecnologica ($nombre,$idRed,$idLinea,$nombreLinea,$nombreRed) {
            $mensaje = [];
            try {
                $sql = "SELECT * FROM red_tecnologica WHERE nombre_red_tecnologica = :nombre AND linea_tecnologica_idlinea_tecnologica = :id";
                $objConsulta = conexion::conectar()->prepare($sql);
                $objConsulta->bindparam(":nombre",$nombre);
                $objConsulta->bindparam(":id",$idLinea);
                if ($objConsulta->execute()) {
                    $existe = $objConsulta->fetch();
                    $objConsulta = null;
                    if ($existe != null) {
                        $mensaje = ["codigo" => "425", "mensaje"=>"ya existe una red tecnológica creada con ese nombre en la línea tecnólogica."];
                    }else {
                        $sql = "UPDATE red_tecnologica SET nombre_red_tecnologica = :nombre WHERE idred_tecnologica = :id";
                        $objConsulta = conexion::conectar()->prepare($sql);
                        $objConsulta->bindparam(":nombre",$nombre);
                        $objConsulta->bindparam(":id",$idRed);

                        if ($objConsulta->execute()) {
                            $objConsulta = null;
                            $fecha = date("Y-m-d H:i:s");
                            $responsable = $_SESSION["nombreCompleto"];
                            $proceso = "Edito red tecnológica";
                            $descripcion = "Se edito el nombre de la red tecnológica ".$nombreRed." en la línea tecnológica ".$nombreLinea." por ".$nombre;
                            $sql = "INSERT INTO procesos_linea_red_tecnologica(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                            $objConsulta = conexion::conectar()->prepare($sql);
                            $objConsulta->bindparam(":fecha",$fecha);
                            $objConsulta->bindparam(":responsable",$responsable);
                            $objConsulta->bindparam(":proceso",$proceso);
                            $objConsulta->bindparam(":descripcion",$descripcion);
                            if ($objConsulta->execute()) {
                                $objConsulta = null;
                                $mensaje = ["codigo" => "200", "mensaje"=>"correcto"];
                            }else{
                                $mensaje = ["codigo" => "425", "mensaje"=>"hubo un problema al actualizar los datos!"];
                            }
                        }else{
                            $mensaje = ["codigo" => "425", "mensaje"=>"hubo un problema al actualizar los datos!"];
                        }
                    }
                }else {
                    $mensaje = ["codigo" => "425", "mensaje"=>"hubo un problema al actualizar los datos!"];
                }
                
                
            } catch (Exception $e) {
                $mensaje = ["codigo" => "425", "mensaje"=>"hubo un problema al actualizar los datos!"];
            }
            return $mensaje;
        } 

        public static function mdlEliminarRedTecnologica ($id,$nombreRed,$nombreLinea) {
            $mensaje = [];
            try {
                $sql = "DELETE FROM red_tecnologica WHERE idred_tecnologica = :id";
                $objConsulta = conexion::conectar()->prepare($sql);
                $objConsulta->bindparam(":id",$id);

                if ($objConsulta->execute()) {
                    $objConsulta = null;
                        $fecha = date("Y-m-d H:i:s");
                        $responsable = $_SESSION["nombreCompleto"];
                        $proceso = "Elimino red tecnológica";
                        $descripcion = "Se Elimino la red tecnológica ".$nombreRed." en la línea tecnológica ".$nombreLinea;
                        $sql = "INSERT INTO procesos_linea_red_tecnologica(fecha_hora_proceso,responsable,proceso,descripcion_proceso) VALUES(:fecha,:responsable,:proceso,:descripcion)";
                        $objConsulta = conexion::conectar()->prepare($sql);
                        $objConsulta->bindparam(":fecha",$fecha);
                        $objConsulta->bindparam(":responsable",$responsable);
                        $objConsulta->bindparam(":proceso",$proceso);
                        $objConsulta->bindparam(":descripcion",$descripcion);
                        if ($objConsulta->execute()) {
                            $objConsulta = null;
                            $mensaje = ["codigo" => "200", "mensaje"=>"correcto"];
                        }else{
                            $mensaje = ["codigo" => "425", "mensaje"=>"hubo un problema al actualizar los datos!"];
                        }
                }else{
                    $mensaje = ["codigo" => "425"];
                }
            } catch (Exception $e) {
                $mensaje = ["codigo" => "425"];
            }
            return $mensaje;
        } 

        public static function mdlListarLineaRedTecnologica () {
            try {
                
                $sql = "SELECT * FROM linea_tecnologica INNER JOIN red_tecnologica ON linea_tecnologica.idlinea_tecnologica = red_tecnologica.linea_tecnologica_idlinea_tecnologica";
                $objConsulta = conexion::conectar()->prepare($sql);
                if ($objConsulta->execute()) {
                    $datos = $objConsulta->fetchAll();
                }else{
                    $datos = "425";
                }
                $objConsulta = null;

            } catch (Exception $e) {
                $datos = "425";
            }
            return $datos;
        }
    }