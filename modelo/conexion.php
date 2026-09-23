<?php

// Zona horaria centralizada para todo el proyecto
date_default_timezone_set('America/Bogota');

class Conexion{
    public static function conectar(){
        $nombreServidor = "127.0.0.1";
        $puertoServidor = "5432";
        $usuarioServidor = "admin";
        $baseDatos = "mromer04_dbsgdcomercio_pg";
        $password = "admin123";

        $objConexion = new PDO('pgsql:host='.$nombreServidor.';port='.$puertoServidor.';dbname='.$baseDatos,$usuarioServidor,$password);
        $objConexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $objConexion->exec("SET client_encoding TO 'UTF8'");

        return $objConexion;
    }

}