<?php
session_start();
include_once "../modelo/certificacionModelo.php";

class Certificacion
{
    public $idcertificacion;
    public $idAprendiz;
    public $archivo_documento;
    public $titulo_documento;

    public function ctrEliminarRegistro()
    {
        $objRespuesta = CertificacionModelo::mdlEliminarRegistro($this->idcertificacion);
        echo json_encode($objRespuesta);
    }

    public function ctrListarCertificacion()
    {
        $objRespuesta = CertificacionModelo::mdlListarCertificaciones($this->idAprendiz);
        echo json_encode($objRespuesta);
    }

    public function ctrInsertarDocumentosCertificacion()
    {
        $objRespuesta = CertificacionModelo::mdlInsertarNuevaCerticacion($this->titulo_documento, $this->archivo_documento, $this->idAprendiz);
        echo json_encode($objRespuesta);
    }

    public function ctrSubirArchivosCertificacion($tituloDocumentoCertificacion, $archivoDocumento, $idAprendiz)
    {
        $ruta = CertificacionModelo::mdlCrearFolderCertificacion($_SESSION["ficha"], $_SESSION["documento"]);

        if ($ruta['codigo'] != 200) {
            return json_encode($ruta);
        }

        $splitFile = explode('.', $archivoDocumento['name']);
        $fileName = uniqid('DOC-') . '.' . end($splitFile);

        $uploadFile = $this->uploadFile(
            $ruta['ruta'],
            $fileName,
            $archivoDocumento['tmp_name']
        );

        if (!$uploadFile) {
            return json_encode(['codigo' => 500, 'mensaje' => 'Error al subir el archivo']);
        }

        return json_encode(
            CertificacionModelo::mdlInsertarNuevaCerticacion(
                $tituloDocumentoCertificacion,
                $ruta['ruta'] . $fileName,
                (int) $idAprendiz
            )
        );
    }


    private function uploadFile($ruta, $name, $temp)
    {
        return (bool) move_uploaded_file($temp, "./../{$ruta}{$name}");
    }
}

if (isset($_SESSION["usuario"])) {
    $objCertificacion = new Certificacion();

    if (isset($_POST["EliminarRegistro"])) {
        $objCertificacion->idcertificacion = $_POST["idcertificacion"]; 
        $objCertificacion->ctrEliminarRegistro();
    }

    if (isset($_POST["ListarCertificacion"])) {
        $objCertificacion->idAprendiz = $_POST["aprendiz"];
        $objCertificacion->ctrListarCertificacion();
    }

    if (isset($_POST["InsertarDocumentosCertificacion"])) {
        $objCertificacion->titulo_documento = $_POST["titulo_documento"];
        $objCertificacion->archivo_documento = $_FILES["archivoDocumento"];
        $objCertificacion->idAprendiz = $_POST["aprendiz"];
        $objCertificacion->ctrInsertarDocumentosCertificacion();
    }

    if (isset($_POST["subirArchivosCertificacion"])) {
        echo $objCertificacion->ctrSubirArchivosCertificacion(
            $_POST["tituloDocumentoCertificacion"], 
            $_FILES["archivoDocumento"],
            $_POST["aprendiz"]
        );
    }

    if (isset($_POST["EliminarArchivoCertificacion"])) {
        $objCertificacion->idcertificacion = $_POST["idCertificacion"]; 
        $objCertificacion->ctrEliminarRegistro();
    }
}
