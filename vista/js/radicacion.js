function radicarDocumentosAprendiz(aprendiz) {
    let objData = { "aprendiz": aprendiz }
    let objRadicacion = new radicacion(objData)
    objRadicacion.validarEstadoAprendiz();
}