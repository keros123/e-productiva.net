var modoModal = "agregar"; // global: accesible desde cl_ficha.js

$(function () {
    cargarFichas();
    cargarEstadoFicha();
    selectFichas();
    cargarTablaTipoPrograma();

    function cargarFichas() {
        let idTabla = "#tablaFichas";
        let objDatos = { "idTabla": idTabla };
        let objFicha = new Ficha(objDatos);
        objFicha.cargarTablaFichas();
    }

    function cargarEstadoFicha() {
        let objDatos = { "id": "#selectEstadoFicha", "id2": "#selectEstadoFichaEdit" };
        let objFicha = new Ficha(objDatos);
        objFicha.cargarSelectEstadoFicha();
    }


    function selectFichas() {
        let idTabla = "#tablaSelectFichas";
        let objDatos = { "idTabla": idTabla };
        let objFicha = new Ficha(objDatos);
        objFicha.cargarSelectFichas();
    }


    $("#tablaFichas").on("click", "#btn-DeletFicha", function () {
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
                let idFicha = $(this).attr("ficha");
                let fichaCompleta = $(this).attr("fichaCompleta");
                let objDatos = { "idFicha": idFicha, "fichaCompleta": fichaCompleta };
                let objFicha = new Ficha(objDatos);
                objFicha.eliminarFicha();
            }
        })
    })

    $("#tablaFichas").on("click", "#btn-EditFicha", function () {
        $(".card_editarFicha").fadeIn(2000);
        $(".btn_agregarFicha").hide();
        $(".card_tablaFichas").hide();
        let ficha = $(this).attr("ficha");
        let idFicha = $(this).attr("idficha");
        let caracterizacion = $(this).attr("caracterizacion");
        let fIf = $(this).attr("fIf");
        let fIl = $(this).attr("fIl");
        let fFl = $(this).attr("fFl");
        let estado = $(this).attr("estado");
        let programa = $(this).attr("programa");
        let duracion = $(this).attr("duracion");
        let idPrograma = $(this).attr("idPrograma");
        let lineaRedTecnologica = $(this).attr("lineaTecnologica") + " - " + $(this).attr("redTecnologica");
        let idRed = $(this).attr("idredTecnologica");
        let fichaCompleta = "Numero " + ficha + ", Caracterización " + caracterizacion;
        $("#txt-FichaEdit").val(ficha);
        $("#txt-CaracterizacionEdit").val(caracterizacion);
        $("#selectEstadoFichaEdit").val(estado);
        $("#txt-fechaInicioFichaEdit").val(fIf);
        $("#txt-fechaFinLectivaEdit").val(fIl);
        let duracion_meses = parseInt(duracion);
        $("#txt-fechaFinLectivaEdit").attr("duracion_meses", duracion_meses);
        $("#txt-fechaFinPracticaEdit").val(fFl);
        $("#txt-tipoProgramaEdit").val(programa);
        $("#txt-tipoProgramaEdit").attr("idprograma", idPrograma);
        $("#txt-tipoProgramaEdit").attr("duracion", duracion);
        $("#btn-EditarFicha").attr("ficha", idFicha);
        $("#btn-EditarFicha").attr("fichaCompleta", fichaCompleta);
        $("#txt_linea_red_tecnologica_edit").attr("idredTecnologica", idRed);
        $("#txt_linea_red_tecnologica_edit").val(lineaRedTecnologica);
    })

    var forms = document.querySelectorAll("#formAgregarFicha");

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                    form.classList.add('was-validated')
                } else {
                    event.preventDefault()
                    let numeroFicha = $("#txt-Ficha").val();
                    let caracterizacion = $("#txt-Caracterizacion").val();
                    let tipoPrograma = $("#txt-tipoPrograma").attr("idprograma");
                    let fechaInicio = $("#txt-fechaInicioFicha").val();
                    let finlectiva = $("#txt-fechaFinLectiva").val();
                    let finPractica = $("#txt-fechaFinPractica").val();
                    let estadoFicha = $("#selectEstadoFicha").val();
                    let lineaRedTecnologica = $("#txt_linea_red_tecnologica").attr("idredtecnologica");
                    let objDatos = { "numeroFicha": numeroFicha, "caracterizacion": caracterizacion, "fechaInicio": fechaInicio, "finlectiva": finlectiva, "finPractica": finPractica, "estadoFicha": estadoFicha, "tipoPrograma": tipoPrograma, "lineaRedTecnologica": lineaRedTecnologica };
                    let objFicha = new Ficha(objDatos);
                    objFicha.agregarFicha();
                }
            }, false)
        })



    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll("#formEditarFicha");

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                    form.classList.add('was-validated')
                } else {
                    event.preventDefault()
                    let numeroFichaEdit = $("#txt-FichaEdit").val();
                    let caracterizacionEdit = $("#txt-CaracterizacionEdit").val();
                    let fechaInicio = $("#txt-fechaInicioFichaEdit").val();
                    let finLectiva = $("#txt-fechaFinLectivaEdit").val();
                    let finPractica = $("#txt-fechaFinPracticaEdit").val();
                    let estadoFichaEdit = $("#selectEstadoFichaEdit").val();
                    let idFichaEdit = $("#btn-EditarFicha").attr("ficha");
                    let fichaCompleta = $("#btn-EditarFicha").attr("fichaCompleta");
                    let tipoPrograma = $("#txt-tipoProgramaEdit").attr("idprograma");
                    let idRed = $("#txt_linea_red_tecnologica_edit").attr("idredTecnologica");
                    let objDatos = { "edIdficha": idFichaEdit, "edNumeroFicha": numeroFichaEdit, "edCracterizacion": caracterizacionEdit, "edfechaInicio": fechaInicio, "edFinLectiva": finLectiva, "edFinPractica": finPractica, "edEstadoFicha": estadoFichaEdit, "tipoPrograma": tipoPrograma, "idRed": idRed, "fichaCompleta": fichaCompleta };
                    let objFicha = new Ficha(objDatos);
                    objFicha.editarFicha();
                }
            }, false)
        })


    $("#tablaSelectFichas").on("click", "#btn-SelectFicha", function () {
        let ficha = $(this).attr("ficha");
        let idficha = $(this).attr("idficha");
        $("#modalSelectFichas").modal("hide");
        $("#txt-fichaAprendiz").val(idficha);
        $("#txt-fichaAprendiz").attr("idFicha", idficha);
        $("#txt-fichaAprendiz-0").val(ficha);
        $("#txt-fichaAprendizEdit").val(idficha);
        $("#txt-fichaAprendiz-0Edit").val(ficha);
    })

    // modulo actualizado

    $("#tablaFichas").on("click", "#btn-AddAprendizFicha", function () {
        let ficha = $(this).attr("ficha");
        let idficha = $(this).attr("idficha");
        let caracterizacion = $(this).attr("caracterizacion");
        let objDatos = { "fichaAp": ficha, "idfichaAp": idficha, "caracterizacionAp": caracterizacion };
        let objFicha = new Ficha(objDatos);
        objFicha.addAprendizFicha();
    })

    $(".btn_agregarFicha").on("click", function () {
        $(".card_agregarFicha").fadeIn(2000);
        $(".btn_agregarFicha").hide();
        $(".card_tablaFichas").hide();
    })

    $(".btn_atras_agregarFicha").on("click", function () {
        $(".card_agregarFicha").hide();
        $(".btn_agregarFicha").fadeIn(2000);
        $(".card_tablaFichas").fadeIn(2000);
    })

    $(".btn_atras_editarFicha").on("click", function () {
        $(".card_editarFicha").hide();
        $(".btn_agregarFicha").fadeIn(2000);
        $(".card_tablaFichas").fadeIn(2000);
    })

    function cargarTablaTipoPrograma() {
        let idTabla = "#tablaSelectTipoPrograma";
        let objDatos = { "idTabla": idTabla };
        let objFicha = new Ficha(objDatos);
        objFicha.cargarTablaTipoPrograma();
    }

    $("#txt-tipoPrograma_agregar_0").on("click", function () {
        modoModal = "agregar";
        cargarTablaTipoPrograma();
    })

    $("#txt-tipoPrograma_editar_0").on("click", function () {
        modoModal = "editar";
        cargarTablaTipoPrograma();
    })

    $("#tablaSelectTipoPrograma").on("click", "#btn_seleccionarPrograma_agregar", function () {
        let programa = $(this).attr("programa");
        let duracion = $(this).attr("duracion");
        let idPrograma = $(this).attr("idPrograma");
        let programaDetalles = programa + " De " + duracion + " Meses";

        $("#txt-tipoPrograma").val(programaDetalles);
        $("#txt-tipoPrograma").attr("duracion", duracion);
        $("#txt-tipoPrograma").attr("idprograma", idPrograma);
        $("#modalSelectTipoPrograma").modal("hide");

        $("#txt-fechaFinLectiva").val("");
        $("#txt-fechaFinPractica").val("");
        let duracion_meses = parseInt(duracion);
        $("#txt-fechaFinLectiva").attr("duracion_meses", duracion_meses);
    })

    $("#txt-fechaInicioFicha").on("change", function () {
        let fechaInicial = $(this).val();
        document.getElementById("txt-fechaFinLectiva").setAttribute("min", fechaInicial);
    })

    $("#txt-fechaFinLectiva").on("change", function () {
        let duracion_meses = parseInt($(this).attr("duracion_meses"));
        let finLectiva = $(this).val();
        var fechaFinPractica = new Date(finLectiva);
        let tiempoPractica = 0;
        if (duracion_meses == 6) {
            tiempoPractica = 3;
        } else if (duracion_meses > 6) {
            tiempoPractica = 6;
        }
        fechaFinPractica.setMonth(fechaFinPractica.getMonth() + tiempoPractica);
        $("#txt-fechaFinPractica").val(fechaFinPractica.toISOString().substr(0, 10));
    })


    $("#tablaSelectTipoPrograma").on("click", "#btn_seleccionarPrograma_editar", function () {
        let programa = $(this).attr("programa");
        let duracion = $(this).attr("duracion");
        let idPrograma = $(this).attr("idPrograma");
        let programaDetalles = programa + " De " + duracion + " Meses";

        $("#txt-tipoProgramaEdit").val(programaDetalles)
        $("#txt-tipoProgramaEdit").attr("duracion", duracion);
        $("#txt-tipoProgramaEdit").attr("idprograma", idPrograma);
        $("#modalSelectTipoPrograma").modal("hide");

        $("#txt-fechaInicioFichaEdit").val("");
        $("#txt-fechaFinLectivaEdit").val("");
        $("#txt-fechaFinPracticaEdit").val("");
        let duracion_meses = parseInt(duracion);
        $("#txt-fechaFinLectivaEdit").attr("duracion_meses", duracion_meses);
    })


    $("#txt-fechaInicioFichaEdit").on("change", function () {
        let fechaInicial = $(this).val();
        $("#txt-fechaFinLectivaEdit").val("");
        $("#txt-fechaFinPracticaEdit").val("");
        document.getElementById("txt-fechaFinLectivaEdit").setAttribute("min", fechaInicial);
    })


    $("#txt-fechaFinLectivaEdit").on("change", function () {
        let duracion_meses = parseInt($(this).attr("duracion_meses"));
        let finLectiva = $(this).val();
        var fechaFinPractica = new Date(finLectiva);
        let tiempoPractica = 0;
        if (duracion_meses == 6) {
            tiempoPractica = 3;
        } else if (duracion_meses > 6) {
            tiempoPractica = 6;
        }
        fechaFinPractica.setMonth(fechaFinPractica.getMonth() + tiempoPractica);
        $("#txt-fechaFinPracticaEdit").val(fechaFinPractica.toISOString().substr(0, 10));
    })

    // Funcionalidad para Formato 165 - Rol 7
    $("#tablaFichas").on("click", "#btn-SubirFormato165", function () {
        let idFicha = $(this).attr("idficha");
        let ficha = $(this).attr("ficha");

        // Crear input file oculto
        let inputFile = $('<input type="file" accept=".pdf,.xls,.xlsx" style="display:none;">');
        inputFile.on('change', function () {
            let archivo = this.files[0];
            if (archivo) {
                let objDatos = { "idFicha": idFicha, "archivo": archivo };
                let objFicha = new Ficha(objDatos);
                objFicha.subirArchivoFormato165();
            }
        });
        inputFile.click();
    });

    $("#tablaFichas").on("click", "#btn-VerFormato165", function () {
        let idFicha = $(this).attr("idficha");
        let ficha = $(this).attr("ficha");

        let objDatos = { "idFicha": idFicha };
        let objFicha = new Ficha(objDatos);
        objFicha.obtenerArchivoFormato165();
    });



    $("#btnSeleccionarFichaTraslado").on("click",()=>{
        let objFicha = new Ficha();
        objFicha.cargarFichasTraslado();
    })

    $("#tablaFichasTraslado").on("click",".btn-SelectFichaTraslado",function(){
        const objInfoFicha = document.getElementById("txt-fichaAprendiz-0Edit");
        objInfoFicha.value = $(this).attr("ficha");
        $("#ModalFichasTraslado").modal("toggle");

        objInfoFicha.setAttribute("numeroFicha",$(this).attr("numeroFicha"));
        objInfoFicha.setAttribute("caracterizacion",$(this).attr("ficha"));
        document.getElementById("txt-fichaAprendizEdit").setAttribute("idFicha",$(this).attr("idFicha"));
    })

})