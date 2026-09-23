<?php
include_once "conexion.php";

class DatosSeguimientos
{

    public static function mdlListarSeguimientos($year)
    {
        $mensaje = null;
        try {
            $objDatos = Conexion::conectar()->prepare("SELECT MONTH(vs.fecha_radicado) AS mes, YEAR(vs.fecha_radicado) AS year, COUNT(DISTINCT CASE WHEN vs.fecha_entrega IS NOT NULL THEN vs.idvisita_seguimiento END) AS realizados, COUNT(DISTINCT CASE WHEN vs.fecha_entrega IS NULL OR vs.fecha_entrega = '' THEN vs.idvisita_seguimiento END) AS pendientes FROM visita_seguimiento vs WHERE YEAR(vs.fecha_radicado) = :year GROUP BY mes; ");
            $objDatos -> bindParam(":year", $year);
            $objDatos->execute();
            $listaSeguimientos = $objDatos->fetchAll();
            $mensaje = array("codigo" => "200", "listaSeguimientos" => $listaSeguimientos);
            $objDatos = null;
        } catch (PDOException $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;

    }
    public static function mdlListarRealizados($year)
    {
        $mensaje = null;
        try {
            $objDatos = Conexion::conectar()->prepare("SELECT COUNT(*) AS numero FROM visita_seguimiento WHERE fecha_entrega IS NOT NULL AND YEAR(fecha_radicado) = :year");
            $objDatos->bindParam(":year", $year);
            $objDatos->execute();
            $listaRealizados = $objDatos->fetch();
            $mensaje = array("codigo" => "200", "datos" => $listaRealizados["numero"]);
            $objDatos = null;
        } catch (PDOException $e) {
            $mensaje = array("codigo" => "401", "datos" => $e->getMessage());
        }

        return $mensaje;

    }
    public static function mdlListarPendientes($year)
    {
        $mensaje = null;
        try {
            $objDatos = Conexion::conectar()->prepare("SELECT COUNT(*) AS numero FROM visita_seguimiento WHERE fecha_entrega IS NULL AND fecha_vencimiento > CURDATE() AND YEAR(fecha_radicado) = :year");
            $objDatos->bindParam(":year", $year);
            $objDatos->execute();
            $listaPendientes = $objDatos->fetch();
            $mensaje = array("codigo" => "200", "datos" => $listaPendientes["numero"]);
            $objDatos = null;
        } catch (PDOException $e) {
            $mensaje = array("codigo" => "401", "datos" => $e->getMessage());
        }

        return $mensaje;

    }
    // public static function mdlListarAsignados()
    // {
    //     $mensaje = null;
    //     try {
    //         $objDatos = Conexion::conectar()->prepare("SELECT COUNT(*) AS seguimientos_asignados
    //         FROM visita_seguimiento  WHERE idvisita_seguimiento;");
    //         $objDatos->execute();
    //         $listaAsignados = $objDatos->fetch();
    //         $mensaje = array("codigo" => "200", "listaAsignados" => $listaAsignados);
    //         $objDatos = null;
    //     } catch (PDOException $e) {
    //         $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
    //     }

    //     return $mensaje;

    // }

    // public static function mdlListarTotal()
    // {
    //     $mensaje = null;
    //     try {
    //         $objDatos = Conexion::conectar()->prepare("SELECT COUNT(*) as total_seguimientos
    //         FROM visita_seguimiento;");
    //         $objDatos->execute();
    //         $listaTotal = $objDatos->fetch();
    //         $mensaje = array("codigo" => "200", "listaTotal" => $listaTotal);
    //         $objDatos = null;
    //     } catch (PDOException $e) {
    //         $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
    //     }

    //     return $mensaje;

    // }

    public static function mdlVencidos($year)
    {
        $mensaje = null;
        try {
            // $objDatos = Conexion::conectar()->prepare("SELECT COUNT(*) AS numero FROM visita_seguimiento WHERE fecha_vencimiento < CURDATE() AND fecha_entrega IS NULL AND YEAR(fecha_radicado) = :year");
            $objDatos = Conexion::conectar()->prepare("SELECT COUNT(*) AS numero FROM visita_seguimiento WHERE fecha_vencimiento < CURDATE() AND visita_seguimiento.estado_reporte < 1 AND YEAR(fecha_radicado) = :year");
            $objDatos->bindParam(":year", $year);
            $objDatos->execute();
            $listaVencidos = $objDatos->fetch();
            $mensaje = array("codigo" => "200", "datos" => $listaVencidos["numero"]);
            $objDatos = null;
        } catch (PDOException $e) {
            $mensaje = array("codigo" => "401", "datos" => $e->getMessage());
        }

        return $mensaje;

    }

    public static function mdlgraficas($year)
    {
        $mensaje = null;
        try {
            $seguimientos_realizados = self::mdlListarRealizados($year);
            if ($seguimientos_realizados["codigo"] == "200") {
                $seguimientos_pendientes = self::mdlListarPendientes($year);
                if ($seguimientos_pendientes["codigo"] == "200") {
                    $vencidos_sin_entrega = self::mdlVencidos($year);
                    if ($vencidos_sin_entrega["codigo"] == "200") {
                        $mensaje = array("codigo" => "200", "listaGrafica" => [["seguimientos_realizados"=>$seguimientos_realizados["datos"], "seguimientos_pendientes"=>$seguimientos_pendientes["datos"], "vencidos_sin_entrega"=>$vencidos_sin_entrega["datos"]]]);
                    }
                }
            }
            // $objDatos = Conexion::conectar()->prepare("SELECT (SELECT COUNT(*) FROM visita_seguimiento WHERE fecha_entrega IS NOT NULL AND fecha_radicado = :year) AS seguimientos_realizados, (SELECT COUNT(*) FROM visita_seguimiento WHERE fecha_entrega IS NULL AND fecha_vencimiento > CURDATE() AND fecha_radicado = :year) AS seguimientos_pendientes, (SELECT COUNT(*) FROM visita_seguimiento WHERE idvisita_seguimiento IS NOT NULL AND fecha_radicado = :year) AS seguimientos_Asignados, (SELECT COUNT(*) FROM visita_seguimiento WHERE fecha_vencimiento < CURDATE() AND fecha_entrega IS NULL AND fecha_radicado = :year) AS vencidos_sin_entrega");
            // $objDatos -> bindParam(":year", $year);
            // $objDatos->execute();
            // $listaGrafica = $objDatos->fetchAll();
        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }

        return $mensaje;

    }

    public static function mdlDatosCertificacion()
    {
        $mensaje = [];
        $Certificados = self::mdlCertificados();
        if ($Certificados["codigo"] == "200") {
            try {
                $estado = 6;
                $objDatos = Conexion::conectar()->prepare("SELECT COUNT(*) FROM aprendiz WHERE estado_aprendiz_idestado_aprendiz = :estado");
                $objDatos -> bindParam(":estado", $estado);
                $objDatos->execute();
                $PorCertificar = $objDatos->fetch();
                $mensaje = array("codigo" => "200", "Certificados" => $Certificados["Certificados"], "PorCertificar"=>$PorCertificar);
                $objDatos = null;

            } catch (Exception $e) {
                $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
            }
        }else{
            $mensaje = array("codigo" => "401", "mensaje" => "ups!!");
        }
        return $mensaje;
    }

    public static function mdlCertificados()
    {
        try {
            $objDatos = Conexion::conectar()->prepare("SELECT COUNT(*) FROM aprendices_certificados");
            $objDatos->execute();
            $Certificados = $objDatos->fetch();
            $mensaje = array("codigo" => "200","Certificados"=>$Certificados);
            $objDatos = null;

        } catch (Exception $e) {
            $mensaje = array("codigo" => "401", "mensaje" => $e->getMessage());
        }
        return $mensaje;
    }

    public static function mdlCargarYears()
    {
        $mensaje = null;
        try {
            $objConsulta = Conexion::conectar()->prepare("SELECT YEAR(fecha_radicado) AS Year, COUNT(*) AS totalSeguimientos FROM visita_seguimiento GROUP BY YEAR(fecha_radicado) ORDER BY YEAR(fecha_radicado) DESC;");
            $objConsulta->execute();
            $mensaje = $objConsulta->fetchAll();
            $objConsulta = null;
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
        }
        return $mensaje;
    }

}