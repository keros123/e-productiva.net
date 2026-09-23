$(function () {

    $("#btnGenerarPdf").on("click", function () {
        let id = $(this).attr("aprendiz")
        console.log(id)
        generarPdfCertificacion(id);
    })

    function generarPdfCertificacion(idAprendiz) {
        let objDatos = { "idAprendiz": idAprendiz};
        let objPdf = new generarPdfCertificacionClass(objDatos);
        objPdf.generarPdfCertificacion();
    }

})