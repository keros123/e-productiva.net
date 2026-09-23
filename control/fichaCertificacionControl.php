<?php

session_start();
include_once "../modelo/fichaCertificacionModelo.php";

class fichaCertificacionControl{

    public $idAprendiz;
    public $idFicha;
    public $numeroFicha;
    public $caracterizacion;
    public $fecha_inicio;
    public $fecha_fin_lectiva;
    public $fecha_fin_practica;
    public $estadoFicha;
    public $tipoPrograma;
    public $lineaRedTecnologica;
    public $fichaCompleta;
    public $fichaAprendiz;
    public $documentoAprendiz;

    public function ctrcargarTablaFichas(){
        $objRespuesta = fichaCertificacionModelo::mdlcargarTablaFichasPorCertificar();
        echo json_encode($objRespuesta);
    }

    public function ctrcargarListaAprendices(){
        $objRespuesta = fichaCertificacionModelo::mdlcargarListaAprendices($this->idFicha);
        echo json_encode($objRespuesta);
    }
    public function ctrListaDocumentosAprendices(){
        $objRespuesta = fichaCertificacionModelo::mdllistarDocumentos($this->idAprendiz);
        echo json_encode($objRespuesta);
    }

    public function ctrDescargarDocumentos(){
        $idAprendiz = $_POST["idAprendiz"];
        $fichaAprendiz = $_POST["fichaAprendiz"];
        $documentoAprendiz = $_POST["documentoAprendiz"];
        $ruta = "archivos/aprendices/{$fichaAprendiz}/{$documentoAprendiz}/certificacion/";
    
        // Verificar si la carpeta "certificacion" existe
        if (!is_dir($ruta)) {
            echo "No se encontraron documentos para descargar.";
            return;
        }
    
        // Obtener la lista de archivos del directorio de documentos
        $archivos = scandir($ruta);
        // Eliminar los directorios "." y ".."
        $archivos = array_diff($archivos, array('.', '..'));
    
        // Verificar si hay archivos para unificar
        if (empty($archivos)) {
            echo "No se encontraron documentos para descargar.";
            return;
        }
    
        // Crear un nuevo archivo PDF
        require_once('libs/tcpdf/tcpdf.php');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Aprendiz');
        $pdf->SetTitle('Documentos del Aprendiz');
        $pdf->SetSubject('Documentos del Aprendiz');
        $pdf->SetKeywords('TCPDF, PDF, documentos, aprendiz');
    
        // Agregar una página al PDF
        $pdf->AddPage();
    
        // Título del documento
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Documentos del Aprendiz', 0, 1, 'C');
    
        // Agregar los documentos al PDF
        foreach ($archivos as $archivo) {
            $filePath = $ruta . $archivo;
            if (is_file($filePath)) {
                $pdf->Image($filePath, 10, 10, 180, 0, '', '', '', false, 300, '', false, false, 0);
                $pdf->AddPage(); // Agregar una nueva página para el próximo documento
            }
        }
    
        // Cerrar el PDF y enviarlo al cliente
        $pdfContent = $pdf->Output('documentos_aprendiz_'.$idAprendiz.'.pdf', 'S'); // 'S' devuelve el contenido del PDF como una cadena
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename='documentos_aprendiz_$idAprendiz.pdf'");
        echo $pdfContent;
    }
    

}

if (isset($_SESSION["usuario"])) {
    if (isset($_POST["cargarTablaFichasPorCertificar"])){
        $objFicha = new fichaCertificacionControl();
        $objFicha->ctrcargarTablaFichas();
    }
    
    if(isset($_POST["idFicha"])){
        $objDatosAprendiz = new fichaCertificacionControl();
        $objDatosAprendiz-> idFicha = $_POST["idFicha"];
        $objDatosAprendiz->ctrcargarListaAprendices();
    }
    
    if(isset($_POST["idAprendiz"])){
        $objDatosAprendiz = new fichaCertificacionControl();
        $objDatosAprendiz-> idAprendiz = $_POST["idAprendiz"];
        $objDatosAprendiz->ctrListaDocumentosAprendices();
    }
    
    if(isset($_POST["idAprendiz"], $_POST["fichaAprendiz"], $_POST["documentoAprendiz"])){
        $objDatosAprendiz = new fichaCertificacionControl();
        $objDatosAprendiz-> idAprendiz = $_POST["idAprendiz"];
        $objDatosAprendiz-> fichaAprendiz = $_POST["fichaAprendiz"];
        $objDatosAprendiz-> documentoAprendiz = $_POST["documentoAprendiz"];
        $objDatosAprendiz->ctrDescargarDocumentos();
    }
}