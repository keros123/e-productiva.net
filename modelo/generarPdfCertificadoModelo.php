<?php

include_once "conexion.php";
include_once "certificarAprendizModelo.php";

use setasign\Fpdi\Fpdi;

class generarPdfCertificacionModelo {
    // Mínimo de documentos aprobados (estado 2) para poder generar el PDF
    private const DOCS_MINIMOS_PARA_PDF = 4;

    public static function mdlGenerarPdf($idAprendiz) {
            $tipoFicha = self::tipoPrograma($idAprendiz);
            $mensaje = [];
            try {
                $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM certificacion WHERE aprendiz_idaprendiz=:idaprendiz");
                $objRespuesta->bindParam(":idaprendiz", $idAprendiz);
                if ($objRespuesta->execute()){
                    $documentos = $objRespuesta->fetchAll();
                    $contador = 0;
                    // Contar los documentos aprobados
                    foreach ($documentos as $documento) {
                        if ($documento["estado_archivo"] == "2") {
                            $contador++;
                        }
                    }
                    // Verificar si hay al menos los documentos mínimos aprobados
                    if ($contador >= self::DOCS_MINIMOS_PARA_PDF) {
                        //organizar arreglo ordenado con los documentos
                        $documentosOrdenados = self::documentosOrdenados($tipoFicha, $documentos, $idAprendiz);
                        $pdf = self::generadorDePdf($documentosOrdenados);
                        if($pdf["codigo"] == 200) {
                            $mensaje = ["codigo" => "200", "mensaje" => "../pdf/certificacion.pdf"];
                        } else {
                            $mensaje = ["codigo" => "202", "mensaje" => "Error al generar su PDF."];
                        } 
                        // fin fpdi
                    } else {
                        $mensaje = ["codigo" => "202", "mensaje" => "No es posible generar el PDF, apruebe primero los documentos."];
                    }
                } else {
                    $mensaje = ["codigo" => "202", "mensaje" => "Error al realizar la petición."];
                }
            } catch (Exception $e) {
                $mensaje = ["codigo" => "202", "mensaje" => $e->getMessage()];
            }
        return $mensaje;
    }

    public static function tipoPrograma($idAprendiz) {
        $mensaje = "202";
        try {
            $objRespuesta = Conexion::conectar()->prepare("SELECT * FROM aprendiz INNER JOIN ficha ON idficha = ficha_idficha INNER JOIN tipo_programa ON idtipo_Programa = tipo_programa_idtipo_programa WHERE idaprendiz=:idaprendiz");
            $objRespuesta->bindParam(":idaprendiz", $idAprendiz);
            if ($objRespuesta->execute()){
                $tipoPrograma = $objRespuesta->fetch();
                $mensaje = $tipoPrograma["nombre_programa"];
            } else {
                $mensaje = "202";
            }
        } catch (Exception $e) {
            $mensaje = $e->getMessage();
        }

        return $mensaje;
    }

    public static function documentosOrdenados($tipoFicha, $documentos, $idAprendiz) {
        //tecnologos: certificado laboral, copia documento identidad, seguimiento parcial "si lo tiene", seguimiento final, certificado tyt, destrucción del carnet, certificado de la ape
        //tecnicos y operarios: certificado laboral, copia documento identidad, seguimiento parcial "si lo tiene", seguimiento final, destrucción del carnet, certificado de la ape
        $ordenDocumentos = [];
        $datosSeguiento = null;
        $seguimientos = Conexion::conectar()->prepare("SELECT * FROM visita_seguimiento INNER JOIN seguimiento ON seguimiento_idseguimiento = idseguimiento WHERE aprendiz_idaprendiz = :idAprendiz");
        $seguimientos->bindParam(":idAprendiz",$idAprendiz);
        if ($seguimientos->execute()) {
            $datosSeguiento = $seguimientos->fetchAll();
        }

        if ($datosSeguiento != null) {
            $certificacionLaboral = self::filtroArray($documentos, "Certificado laboral", "Certificacion");
            Array_push($ordenDocumentos,$certificacionLaboral);
            $copiaDocumentoIdentidad = self::filtroArray($documentos, "Copia documento de identidad", "Certificacion");
            Array_push($ordenDocumentos,$copiaDocumentoIdentidad);

            $seguimientoParcial = self::filtroArray($datosSeguiento, "1", "Seguimiento");
            if ($seguimientoParcial != null) {
                Array_push($ordenDocumentos,$seguimientoParcial);
            }

            $seguimientoFinal = self::filtroArray($datosSeguiento, "2", "Seguimiento");
            Array_push($ordenDocumentos,$seguimientoFinal);

            if ($tipoFicha == "Tecnólogo") {
                $pruebasTyT = self::filtroArray($documentos, "Certificado asistencia pruebas TyT", "Certificacion");
                Array_push($ordenDocumentos,$pruebasTyT);
            }
            
            $destruccionCarnet = self::filtroArray($documentos, "Evidencia destruccion carnet", "Certificacion");
            Array_push($ordenDocumentos,$destruccionCarnet);

            $certificadoApe = self::filtroArray($documentos, "Certificado de validacion agencia publica de empleo", "Certificacion");
            Array_push($ordenDocumentos,$certificadoApe);
        }

        return $ordenDocumentos;
    }

    public static function filtroArray($arreglo, $condicion, $tipo) {
        $filtrado = null;
        if($tipo == "Certificacion") {
            for ($i=0; $i < count($arreglo); $i++) { 
                if ($arreglo[$i]["titulo_documento"] == $condicion) {
                    $filtrado = ["url_documento" => $arreglo[$i]["url_documento"]];
                    break;
                }
            }
        }else{
            for ($i=0; $i < count($arreglo); $i++) { 
                if ($arreglo[$i]["tipo_seguimiento_idtipo_seguimiento"] == $condicion) {
                    $filtrado = ["url_documento" => $arreglo[$i]["url_documento"]];
                    break;
                }
            }
        }
        return $filtrado;
    }

    public static function generadorDePdf($documentosOrdenados) {

        require '../libs/fpdf/fpdf.php';
        require '../libs/fpdi/src/autoload.php';
        $mensaje = [];

        $pdf = new Fpdi();

        // Agregar las páginas de los documentos al PDF
        foreach ($documentosOrdenados as $documento) {
            $rutaDocumento = "../".$documento["url_documento"];
            if (!file_exists($rutaDocumento)) {
                $mensaje = "El archivo {$rutaDocumento} no existe.";
                return ["codigo" => "202", "mensaje" => $mensaje];
            }

            try {
                $numeroPaginas = $pdf->setSourceFile($rutaDocumento);
            } catch (Exception $e) {
                return ["codigo" => "202", "mensaje" => "Error al abrir el archivo {$rutaDocumento}: " . $e->getMessage()];
            }

            for ($j = 1; $j <= $numeroPaginas; $j++) { 
                $pagina = $pdf->importPage($j);
                $size = $pdf->getTemplateSize($pagina);
                $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
                $pdf->useImportedPage($pagina, 0, 0);
            }
        }

        $pdf->Output('F', '../pdf/certificacion.pdf');
        return ["codigo" => 200];
    }
}
