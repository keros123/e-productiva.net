$("#tablaDocumentosAprendices").on("change", "#selectCertificacionAdmin", function() {
    let estado = $(this).val();
    let aprendiz = $(this).attr("aprendiz");
    let archivo = $(this).attr("archivo");
    let email = $(this).attr("email");
    let objData = { "estado": estado, "aprendiz": aprendiz, "archivo": archivo, "select": $(this), "email": email };
    let objAprendiz = new aprendizCertificacion(objData);
    objAprendiz.cambiarEstadoArchivos();
})