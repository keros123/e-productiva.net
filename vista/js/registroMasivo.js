$(function() {

    CargarDatosAprendicesFicha();

    $("#btn_excel").on("change", function() {
        let archivo = document.getElementById('btn_excel').files[0];
        let ficha = $(this).attr("ficha");
        let id = $(this).attr("fichaId");
        let objData = { "archivo": archivo, "ficha": ficha, "fichaId": id };
        let objRegistro = new registroMasivo(objData);
        $("#contenedorLoader").fadeIn();
        objRegistro.subirArchivo();
    })

    function CargarDatosAprendicesFicha() {
        var idficha = $("#btn_excel").attr("fichaId");
        let objDatos = { "idListarFichasAprendiz": idficha };
        let objFicha = new Ficha(objDatos);
        objFicha.cargarAprendicesFichaSeleccionada();
    }


    $("#tablaAprendizFichaSeleccionada").on("click", "#btnEditAprendizFichaSeleccionada", function() {
        $("#contenedorBtnSubirArchivo").hide("2000");
        let idAprendiz = $(this).attr("idaprendiz");
        let ficha = $(this).attr("ficha");
        let idFicha = $(this).attr("idficha");
        let tipoDoc = $(this).attr("tipodoc");
        let documento = $(this).attr("documento");
        let nombres = $(this).attr("nombres");
        let apellidos = $(this).attr("apellidos");
        let telefono = $(this).attr("telefono");
        let email = $(this).attr("email");
        let estado = $(this).attr("estado");
        let numeroFicha = $(this).attr("numeroFicha");
        let nombreCompleto = nombres + " " + apellidos + " con numero de identificación " + documento;

        $("#card-formEditarAprendiz").fadeIn("2000");
        $("#card-tablaAprendices").hide("2000");
        $("#agregarAprendiz").hide("2000");
        $("#btn-EditarAprendiz").attr("aprendiz", idAprendiz);
        $("#btn-EditarAprendiz").attr("nombreCompleto", nombreCompleto);
        $("#txt-fichaAprendizEdit").attr("idFicha", idFicha);
        $("#txt-fichaAprendiz-0Edit").val(ficha);
        $("#txt-fichaAprendiz-0Edit").attr("caracterizacion", ficha);
        $("#selectDocumentoEdit").val(tipoDoc);
        $("#txt-DocumentoAprendizEdit").val(documento);
        $("#txt-NombresAprendizEdit").val(nombres);
        $("#txt-ApellidosAprendizEdit").val(apellidos);
        $("#txt-NumeroAprendizEdit").val(telefono);
        $("#txt-EmailAprendizEdit").val(email);
        $("#selectEstadoAprendizEdit").val(estado);
        $("#txt-fichaAprendiz-0Edit").attr("numeroFicha",numeroFicha);
    })

    $("#tablaAprendizFichaSeleccionada").on("click", "#btnElimAprendizFichaSeleccionada", function() {
        Swal.fire({
            title: '¿Seguro desea eliminar este registro?',
            text: "¡Recuerde, si elimina el registro no podra recuperarlo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                let idficha = $("#btn_excel").attr("fichaId");
                let aprendiz = $(this).attr("aprendiz");
                let nombreCompleto = $(this).attr("nombreCompleto");
                let fichaCompleta = $(this).attr("fichaCompleta");
                let objDatos = { "idAprendiz": aprendiz, "idListarFichasAprendiz": idficha, "fichaCompleta": fichaCompleta, "nombreCompleto": nombreCompleto };
                let objFicha = new Ficha(objDatos);
                objFicha.eliminarAprendizFichaSeleccionada();
            }
        })
    })

})