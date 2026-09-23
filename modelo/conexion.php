<?php

// Zona horaria centralizada para todo el proyecto
date_default_timezone_set('America/Bogota');

class Conexion{
    public static function conectar(){
        $nombreServidor = "localhost";
        $usuarioServidor = "mromer04_sgd";
        $baseDatos = "mromer04_dbsgdcomercio";
        $password = "~s=&_4dtHqFp}O8f";

        $objConexion = new PDO('mysql:host='.$nombreServidor.';dbname='.$baseDatos.';',$usuarioServidor,$password);
        $objConexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $objConexion->exec("set names utf8");

        return $objConexion;
    }

}