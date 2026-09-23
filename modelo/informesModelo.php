<?php
include_once "conexion.php";

class InformesModelo{

    public static function CargarSeguimientosVencidos(){
        $mensaje = [];
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT tipo_seguimiento.nombre_tipo_seguimiento,visita_seguimiento.estado_reporte,visita_seguimiento.fecha_radicado,visita_seguimiento.fecha_entrega,visita_seguimiento.ubicacion_seguimiento,visita_seguimiento.fecha_vencimiento,funcionario.documento,funcionario.nombres,funcionario.apellidos,aprendiz.documento AS documento_aprendiz,aprendiz.nombres AS nombres_aprendiz, aprendiz.apellidos AS apellidos_aprendiz,ficha.numero_ficha,ficha.caracterizacion FROM visita_seguimiento INNER JOIN tipo_seguimiento ON visita_seguimiento.tipo_seguimiento_idtipo_seguimiento = tipo_seguimiento.idtipo_seguimiento INNER JOIN funcionario ON visita_seguimiento.funcionario_idfuncionario = funcionario.idfuncionario INNER JOIN seguimiento ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento  INNER JOIN aprendiz ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha  WHERE visita_seguimiento.fecha_vencimiento < CURDATE() AND visita_seguimiento.estado_reporte < 1 ORDER BY visita_seguimiento.tipo_seguimiento_idtipo_seguimiento DESC");

            $objRespuesta->execute();
            $datos = $objRespuesta->fetchAll();
            $objRespuesta = null;
            $mensaje = ["codigo"=>200,"InformeVencidos"=>$datos];
        } catch (Exception $e) {
            $mensaje = ["codigo"=>401,"mensaje"=>$e->getMessage()];
        }
        return $mensaje;
    }

    public static function CargarTotalSeguimientos(){
        $mensaje = [];
        try{
            $objRespuesta = Conexion::conectar()->prepare("SELECT tipo_seguimiento.nombre_tipo_seguimiento,visita_seguimiento.estado_reporte,visita_seguimiento.fecha_radicado,visita_seguimiento.fecha_entrega,visita_seguimiento.ubicacion_seguimiento,visita_seguimiento.fecha_vencimiento,funcionario.documento,funcionario.nombres,funcionario.apellidos,aprendiz.documento AS documento_aprendiz,aprendiz.nombres AS nombres_aprendiz, aprendiz.apellidos AS apellidos_aprendiz,ficha.numero_ficha,ficha.caracterizacion FROM visita_seguimiento INNER JOIN tipo_seguimiento ON visita_seguimiento.tipo_seguimiento_idtipo_seguimiento = tipo_seguimiento.idtipo_seguimiento INNER JOIN funcionario ON visita_seguimiento.funcionario_idfuncionario = funcionario.idfuncionario INNER JOIN seguimiento ON visita_seguimiento.seguimiento_idseguimiento = seguimiento.idseguimiento  INNER JOIN aprendiz ON seguimiento.aprendiz_idaprendiz = aprendiz.idaprendiz INNER JOIN ficha ON aprendiz.ficha_idficha = ficha.idficha ORDER BY visita_seguimiento.fecha_radicado DESC, visita_seguimiento.tipo_seguimiento_idtipo_seguimiento DESC");
    
            $objRespuesta->execute();
            $datos = $objRespuesta->fetchAll();
            $objRespuesta = null;
            $mensaje = ["codigo"=>200,"InformeCompleto"=>$datos];
        }catch(Exception $e){
            $mensaje = ["codigo"=>401,"mensaje"=>$e->getMessage()];
        }
        return $mensaje;
    }

}