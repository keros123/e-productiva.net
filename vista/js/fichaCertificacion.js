$(function() {
    cargarFichas();

    function cargarFichas() {
        let idTabla = "#tablaFichaCertificacion";
        let objDatos = { idTabla: idTabla };
        let objFichaCertificacion = new fichasCertificacion(objDatos);
        objFichaCertificacion.cargarTablaFichasCertificacion();
    }

    function mostrarDocumentosAprendiz() {
        let idAprendiz = $("#tablaAprendicesCertificacion").attr("idAprendiz");
        let objDatos = { idAprendiz: idAprendiz };
        let objAprendizDocumentos = new fichasCertificacion(objDatos);
        objAprendizDocumentos.mostrarDocumentosAprendiz();
        informacionAprendiz(idAprendiz);
        $(".detallesAprendiz").fadeIn(2000);
        $(".documentosAprendiz").fadeIn(1500);
        $(".fichasAsignadasCertificacion").hide();
        $(".aprendicesCertificacionFicha").hide();
    }

    function cargarAprendicesAsignadosPorFicha() {
        let idFicha = $("#tablaAprendicesCertificacion").attr("idFicha");
        let objDatos = { idFicha: idFicha };
        let objAprendizFicha = new fichasCertificacion(objDatos);
        objAprendizFicha.cargarTablaAprendices();
        $(".fichasAsignadasCertificacion").hide();
        $(".aprendicesCertificacionFicha").fadeIn(1500);
    }

    function informacionAprendiz(idAprendiz) {
        let objDatos = { idAprendiz: idAprendiz };
        let objInfoAprendiz = new DetallesUsuario(objDatos);
        objInfoAprendiz.informacionAprendiz();
    }

    function descargarPDF() {
        let idAprendiz = $("#tablaAprendicesCertificacion").attr("idAprendiz");
        let objData = { idAprendiz: idAprendiz };

        fetch(config.rutes["controllerFichasPorCertificar"], {
                method: "POST",
                body: JSON.stringify(objData),
            })
            .then((response) => response.blob())
            .then((blob) => {
                const url = window.URL.createObjectURL(new Blob([blob]));
                const link = document.createElement("a");
                link.href = url;
                link.setAttribute("download", `documentos_aprendiz_${idAprendiz}.pdf`);
                document.body.appendChild(link);
                link.click();
                link.parentNode.removeChild(link);
            })
            .catch((error) => {
                console.error("Error al descargar el PDF:", error);
            });
    }

    $(document).on("click", ".btn-verAprendices", function() {
        let idFicha = $(this).attr("idficha");
        let ficha = $(this).attr("ficha");
        let caracterizacion = $(this).attr("caracterizacion");

        $("#span_caracterizacion").text(ficha + " - " + caracterizacion);
        $("#tablaAprendicesCertificacion").attr("idFicha", idFicha);
        cargarAprendicesAsignadosPorFicha();
    });

    $(".atras_aprendicesCertificar").on("click", function() {
        $(".fichasAsignadasCertificacion").fadeIn(1000);
        $(".aprendicesCertificacionFicha").hide();
    });


    $(".atras_FichaAprendices").on("click", function() {
        $(".aprendicesCertificacionFicha").fadeIn(1000);
        $(".detallesAprendiz").hide();
        $(".documentosAprendiz").hide();
    });


    $(".volver_aprendicesCertificar").on("click", function() {
        $(".aprendicesCertificacionFicha").fadeIn(1000);
        $(".detallesAprendiz").hide();
        $(".documentosAprendiz").hide();
    });

    $(document).on("click", ".btn-verDocumentos", function() {
        let idAprendiz = $(this).attr("idAprendiz");
        let ficha = $(this).attr("ficha");
        let caracterizacion = $(this).attr("caracterizacion");

        cargarSeguimientosAprendiz (idAprendiz);

        let objData = new FormData();
        objData.append("infoAprendiz", idAprendiz);
        fetch(config.rutes["controllerDetalleUsuario"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response != null) {
                    let imagenAprendizCertificar =  document.getElementById("imagenAprendiz");
                    let urlImagenAprendiz = (response["url_foto"] != null && response["url_foto"] != "") ? response["url_foto"] : "assets/img/interface/profile.png";
                    imagenAprendizCertificar.setAttribute("src",urlImagenAprendiz);
                    $("#nombreAprendizCertificar").text(response["nombres"]+" " + response["apellidos"]);
                    $("#documentoAprendizCertificar").text(response["documento"]); 
                    $("#correoAprendizCertificar").text(response["email"]); 
                    $("#telefonoAprendizCertificar").text(response["telefono"]); 
                    $("#fichaAprendizCertificar").text(ficha + " - " + caracterizacion); 
                    $("#etapaAprendizCertificar").text(response["nombre_estado_aprendiz"]);
                    let Formato165 = document.getElementById("GFPI-F-165");
                    let urlFormato165 = response["url_archivoFormato"] != "" && response["url_archivoFormato"] != null ? response["url_archivoFormato"] : "#" ;
                    Formato165.setAttribute("href",urlFormato165);
                    $("#modalidadPractica").text(response["nombre_modalidad"]);
                    $("#fechaInicioPractica").text(response["fecha_inicio_practica"]);
                    $("#fechaFinPractica").text(response["fecha_fin_practica_seguimiento"]); // ojo verificar  
                    $("#empresaAprendiz").text(response["nit_empresa"]+"   "+response["nombre_empresa"]);
                }
            });

        $("#tablaAprendicesCertificacion").attr("idAprendiz", idAprendiz);
        mostrarDocumentosAprendiz();
    });

    $(document).on("click", "#btnDescargarPDF", function() {
        descargarPDF();
    });

    function cargarSeguimientosAprendiz (idAprendiz) {
        let objDatos = { "idAprendiz": idAprendiz };
        let cargarSeguimiento = new fichasCertificacion(objDatos);
        cargarSeguimiento.cargarSeguimientosAprendizSeleccionado();
    }

});