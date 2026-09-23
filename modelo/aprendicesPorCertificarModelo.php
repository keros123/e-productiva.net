<?php

include_once "conexion.php";

class aprendicesPorCertificarModelo {
    private $conexion;

    public function __construct() {
        // Guardamos la conexión activa en la variable de la clase para reutilizarla
        $this->conexion = Conexion::conectar();
    }

    public function cargarAprendicesPorCertificar() {
        $respuesta = [];
        
        try {
            $sql = "SELECT * FROM aprendiz INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha INNER JOIN estado_aprendiz ON aprendiz.estado_aprendiz_idestado_aprendiz = estado_aprendiz.idestado_aprendiz WHERE aprendiz.estado_aprendiz_idestado_aprendiz = 6";


            // Reutilizamos la conexión que ya abrimos en el constructor
            $objCondicion = $this->conexion->prepare($sql);
            
            if ($objCondicion->execute()) {
                $respuesta = $objCondicion->fetchAll(PDO::FETCH_ASSOC);
            }
            
        } catch (PDOException $e) {
            $respuesta = ["error" => "Ha ocurrido un error al cargar la información"];
        } finally {
            $objCondicion = null;
        }
        
        return $respuesta;
    }
}