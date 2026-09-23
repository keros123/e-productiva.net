<?php
include_once "../modelo/informesModelo.php";

class InformesControl{

    public function ctrCargarSeguimientosVencidos(){
        $objRespuesta = InformesModelo::CargarSeguimientosVencidos();
        echo json_encode($objRespuesta);
    }

    public function ctrCargarSeguimientosTotales(){
        $objRespuesta = InformesModelo::CargarTotalSeguimientos();
        echo json_encode($objRespuesta);
    }
}

if (isset($_POST["SeguimientosVencidos"]) == "ok"){
    $objInforme = new InformesControl();
    $objInforme->ctrCargarSeguimientosVencidos();
}

if (isset($_POST["seguimientosCompletos"]) == "ok"){
    $objInformeCompleto = new InformesControl();
    $objInformeCompleto->ctrCargarSeguimientosTotales();
}