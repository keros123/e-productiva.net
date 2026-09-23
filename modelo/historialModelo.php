<?php

    include_once "conexion.php";

    class historialModelo {
        public static function mdlCargarHistorial ($tipo) {
            try {
                if ($tipo == "procesos_funcionarios") {
                    $sql = "SELECT * FROM procesos_funcionarios";
                }elseif ($tipo == "procesos_aprendices") {
                    $sql = "SELECT * FROM procesos_aprendices";
                }elseif ($tipo == "procesos_fichas") {
                    $sql = "SELECT * FROM procesos_fichas";
                }elseif ($tipo == "procesos_seguimientos") {
                    $sql = "SELECT * FROM procesos_seguimientos";
                }elseif ($tipo == "procesos_empresas") {
                    $sql = "SELECT * FROM procesos_empresas";
                }elseif ($tipo == "procesos_linea_red_tecnologica") {
                    $sql = "SELECT * FROM procesos_linea_red_tecnologica";
                }
                $objConsulta = conexion::conectar()->prepare($sql);
                $objConsulta->execute();
                $datos = $objConsulta->fetchAll();
                $objConsulta = null;

            } catch (Exception $e) {
                $datos = $e->getMessage();
            }
            return $datos;
        }
    }