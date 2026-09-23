(() => {
    let objAprendicesPorCertificar = new aprendicesPorCertificar();
    objAprendicesPorCertificar.cargarAprendicesPorCertificar();

    // Event Delegation para atrapar los clics en los botones de "Ver Documentos" contenidos en DataTables
    $("#tablaAprendicesCertificacion").on("click", ".btnVerDocumentos", function () {
        // Obtenemos la información codificada en base64 y la desencriptamos a un objeto manejable
        let infoBase64 = $(this).attr("data-info");
        let element = JSON.parse(decodeURIComponent(escape(atob(infoBase64))));

        cargarDatosAprendiz(element); // Llamamos la función con el objeto completo
    });

    function cargarDatosAprendiz(element) {
        $("#tablaAprendicesCertificacion").attr("idaprendiz", element.idaprendiz);
        $(".aprendicesCertificacionFicha").hide();
        let contenedorDatosAprendiz = document.getElementById("documentosAprendiz");
        contenedorDatosAprendiz.style.display = "block";
        let objDatos = { idAprendiz: element.idaprendiz };
        let objAprendizCertificacion = new fichasCertificacion(objDatos);
        objAprendizCertificacion.mostrarDocumentosAprendiz();

        objDatos = { documetoAprendiz: element.documento };
        let objDatosAprendizCertificacion = new aprendicesPorCertificar(objDatos);
        objDatosAprendizCertificacion.informacionAprendizCertificacion();
    }

    $(".atras_FichaAprendices").on("click", function () {
        $(".documentosAprendiz").hide();
        $(".aprendicesCertificacionFicha").show();
    });


})()