$(function() {

    cargarFichasAsignadasInstructor();

    function cargarFichasAsignadasInstructor() {
        let idInstructor = $("#tablaFichasAsignadasInstructor").attr("idInstructor");
        let objDatos = { "idInstructor": idInstructor };
        let objInstructor = new fichasInstructor(objDatos);
        objInstructor.cargarFichasAsignadas();
    }

    $("#tablaFichasAsignadasInstructor").on("click", "#btn-verAprendices", function() {
        let idFicha = $(this).attr("idficha");
        let ficha = $(this).attr("ficha");
        let caracterizacion = $(this).attr("caracterizacion");

        $("#span_caracterizacion").text(ficha + " - " + caracterizacion);
        $("#tablaAprendicesAsignadosInstructor").attr("idFicha", idFicha);
        cargarAprendicesAsignadosInstructor();
        $(".fichasAsignadasInstructor").hide();
        $(".aprendicesAsignadosInstructor").fadeIn(2000);
    })

    function cargarAprendicesAsignadosInstructor() {
        let idFicha = $("#tablaAprendicesAsignadosInstructor").attr("idFicha");
        let objDatos = { "idFicha": idFicha };
        let objInstructor = new fichasInstructor(objDatos);
        objInstructor.aprendicesAsignadosInstructor();
    }

    $(".atras_aprendicesAsignadosInstructor").on("click", function() {
        $(".fichasAsignadasInstructor").fadeIn(2000);
        $(".aprendicesAsignadosInstructor").hide();
    })


    $("#tablaAprendicesAsignadosInstructor").on("change", "#selectAval", function() {

        if ($(this).val() == "Habilitado") {
            $(this).css({
                "background-color": "#696cff"
            });
        } else {
            $(this).val("Inhabilitado");
            $(this).css({
                "background-color": "black"
            });
        }

        Swal.fire({
            title: '¿Seguro de cambiar el Aval a Patrocinio del aprendiz?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                let avalAprendiz = $(this).val();
                let nombreCompleto = $(this).attr("nombreCompleto");
                let fichaCompleta = $(this).attr("fichaCompleta");
                let idAprendiz = $(this).parent().children("#datoAvalAprendiz").attr("idAprendiz");
                let objDatos = { "avalAprendiz": avalAprendiz, "idAprendiz": idAprendiz, "fichaCompleta": fichaCompleta, "nombreCompleto": nombreCompleto };
                let objInstructor = new fichasInstructor(objDatos);
                objInstructor.actualizarAvalAprendiz();

            } else {
                if ($(this).val() == "Habilitado") {
                    $(this).val("Inhabilitado");
                    $(this).css({
                        "background-color": "black"
                    });
                } else {
                    $(this).val("Habilitado");
                    $(this).css({
                        "background-color": "#696cff"
                    });
                }
            }
        })
    })

    $("#tablaAprendicesAsignadosInstructor").on("click", "#btnVisualizar", function() {
        let idAprendiz = $(this).attr("idAprendiz");
        informacionAprendiz(idAprendiz);
        bitacorasAprendiz(idAprendiz);
        segimientosAprendiz(idAprendiz);
        visitaSeguimiento(idAprendiz);
        $(".detallesAprendiz").fadeIn("2000");
        $(".volver_aprendicesInstructor").show();
        $(".aprendicesInstructor").hide();
        $(".fichasAsignadasInstructor").hide();
    });


    function informacionAprendiz(idAprendiz) {
        let objDatos = { "idAprendiz": idAprendiz };
        let objInfoAprendiz = new DetallesUsuario(objDatos);
        objInfoAprendiz.informacionAprendiz();
    }

    function bitacorasAprendiz(idAprendiz) {
        let objDatos = { "idAprendiz": idAprendiz };
        let objInfoAprendiz = new DetallesUsuario(objDatos);
        objInfoAprendiz.bitacorasAprendiz();
    }

    function segimientosAprendiz(idAprendiz) {
        let objDatos = { "idAprendiz": idAprendiz };
        let objInfoAprendiz = new DetallesUsuario(objDatos);
        objInfoAprendiz.segimientosAprendiz();
    }

    $(".volver_aprendicesInstructor").on("click", function() {
        $(".aprendicesInstructor").fadeIn("2000");
        $(".detallesAprendiz").hide();
        $(".fichasAsignadasInstructor").hide();
        $("#seguimientosAprendiz").html("");
        $("#bitacoras").html("");
    })

    function visitaSeguimiento(idSeguimiento) {
        let dirigido = "Administrador";
        let objDatos = { "idSeguimiento": idSeguimiento, "dirigido": dirigido };
        let objInfoAprendiz = new DetallesUsuario(objDatos);
        objInfoAprendiz.visitaSeguimiento();
    }

})