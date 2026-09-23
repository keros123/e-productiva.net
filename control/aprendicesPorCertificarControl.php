<?php

include_once "../modelo/aprendicesPorCertificarModelo.php";

class aprendicesPorCertificarControl {

    public function cargarAprendicesPorCertificar() {
        $objAprendicesPorCertificar = new aprendicesPorCertificarModelo();
        $datos = $objAprendicesPorCertificar->cargarAprendicesPorCertificar();
        echo json_encode($datos);
    }
}

if (isset($_GET["cargarAprendicesPorCertificar"])) {
    $objAprendicesPorCertificarControl = new aprendicesPorCertificarControl();
    $objAprendicesPorCertificarControl->cargarAprendicesPorCertificar();
}