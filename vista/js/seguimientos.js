$(function () {
    cargarModalidad("#selectModalidad", null, null);
    cargarTablaEtapaPractica();

    function cargarTablaEtapaPractica() {
        let objData = { "listarEtapaPractica": "ok" };
        let objModalidad = new seguimientos(objData);
        objModalidad.listarDatosEtapaPractica();
    }

    $("#btn-VisualizarFormularioSeguimiento").on("click", function () {
        $("#contenedorTablaSeguimientos").hide();
        $("#contenedorFormularioSeguimientos").fadeIn("2000");
        $("#txt_ficha").attr("idficha", "");
        $("#btn-ListarAprendiz").removeAttr("data-bs-toggle");
        $("#btn-ListarAprendiz").removeAttr("data-bs-target");

        $("#contenedor_documento").css({ display: "none" });
        $("#txt-documentoFile").removeAttr("required");
        $(".fila1").attr("class", "mb-3 col-md-4 fila1");

        $("#contenedor_instructor").css({ display: "none" });
        $("#txt-instructor").removeAttr("required");
        $(".fila2").attr("class", "mb-3 col-md-4 fila2");



        $("#formSeguimientos")[0].reset();
    })

    $("#atrasSeguimiento").on("click", function () {
        $("#formSeguimientos")[0].reset();
        $("#contenedorFormularioSeguimientos").hide();
        $("#contenedorTablaSeguimientos").fadeIn("2000");
    })

    function cargarModalidad(idSelect, modalidad, nombreModalidad) {
        let objData = { "listarModalidad": "ok", "idSelect": idSelect, "modalidad": modalidad, "nombreModalidad": nombreModalidad };
        let objModalidad = new seguimientos(objData);
        objModalidad.listarModalidades();
    }

    $("#btn-ListarInstructores").on("click", function () {
        let objData = { "listarInstructores": "ok" };
        let objInstructores = new seguimientos(objData);
        objInstructores.listarInstructoresSeguimientos();
    })

    $("#tablaInstructores").on("click", "#btn-asignarInstructor", function () {
        let idInstructor = $(this).attr("idFuncionario");
        let nombreInstructor = $(this).attr("nombres") + " " + $(this).attr("apellidos");
        $("#txt_instructor").attr("idInstructor", idInstructor);
        $("#txt_instructor").val(nombreInstructor);
        $('#modalInstructores').modal('toggle');
        $("#errorInstructor").hide();
    })


    $("#btn-ListarFichas").on("click", function () {
        let objData = { "listarFichas": "ok" };
        let objEmpresas = new seguimientos(objData);
        objEmpresas.listarFichasSeguimientos();
    })

    $("#tablaFichasSeguimientos").on("click", "#btn-AsignarFicha", function () {
        let idFicha = $(this).attr("idficha");
        let codigoFicha = $(this).attr("ficha");
        let caracterizacion = $(this).attr("caracterizacion");

        $("#txt_ficha").attr("idficha", idFicha);
        $("#txt_ficha").val(codigoFicha + "-" + caracterizacion);

        $("#btn-ListarAprendiz").attr("data-bs-toggle", "modal");
        $("#btn-ListarAprendiz").attr("data-bs-target", "#modalAprendiz");
        $('#modalFichas').modal('toggle');
        $("#errorFicha").hide();
    })


    $("#btn-ListarAprendiz").on("click", function () {
        let idFicha = $("#txt_ficha").attr("idficha");
        if (idFicha != "" && idFicha != undefined) {
            let objData = { "fichaAprendicesSelecionada": idFicha };
            let objAprendices = new seguimientos(objData);
            objAprendices.listarAprendicesSeguimientos();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "No esposible asignar aprendices sin haber seleccionado una ficha primero.",
            })
        }
    })


    $("#tablaAprendicesSeguimientos").on("click", "#btn-AsignarAprendiz", function () {
        let idAprendiz = $(this).attr("idaprendiz");
        let email = $(this).attr("email");
        let nombreCompleto = $(this).attr("nombres") + " " + $(this).attr("apellidos");
        $("#txt_aprendiz").attr("idaprendiz", idAprendiz);
        $("#txt_aprendiz").attr("email", email);
        $("#txt_aprendiz").val(nombreCompleto);
        $('#modalAprendiz').modal('toggle');
        $("#errorAprendiz").hide();
    })


    $("#tablaEmpresasSeguimientos").on("click", "#btn-AsignarEmpresa", function () {
        let idEmpresa = $(this).attr("empresa");
        let nombreEmpresa = $(this).attr("nombreEmpresa");
        $($(this).attr("idtxtEmpresa")).val(nombreEmpresa);
        $($(this).attr("idtxtEmpresa")).attr("idEmpresa", idEmpresa);
        $('#modalEmpresas').modal('toggle');
        $("#errorEmpresa").hide();
        $("#errorEmpresaEdit").hide();
    })



    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('#formSeguimientos')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault()
                if (!form.checkValidity()) {
                    event.stopPropagation()
                    form.classList.add('was-validated')
                    let ficha = $("#txt_ficha").attr("idFicha");
                    let aprendiz = $("#txt_aprendiz").attr("idaprendiz");
                    let empresa = $("#txt_empresa").attr("idEmpresa");
                    let instructor = $("#txt_instructor").attr("idInstructor");
                    let modalidad = $("#selectModalidad").val();
                    if (modalidad >= "2") {
                        if (instructor == "" || instructor == undefined) {
                            $("#errorInstructor").show();
                        }
                    }
                    if (ficha == "" || ficha == undefined) {
                        $("#errorFicha").show();
                    }
                    if (aprendiz == "" || aprendiz == undefined) {
                        $("#errorAprendiz").show();
                    }
                    if (empresa == "" || empresa == undefined) {
                        $("#errorEmpresa").show();
                    }
                } else {
                    let fechaInicioPractica = $("#txt-fechaInicioPractica").val();
                    let fechaFinPractica = $("#txt-fechaFinPractica").val();
                    let modalidad = $("#selectModalidad").val();
                    let ficha = $("#txt_ficha").attr("idFicha");
                    let aprendiz = $("#txt_aprendiz").attr("idaprendiz");
                    let empresa = $("#txt_empresa").attr("idEmpresa");
                    let fichaValor = $("#txt_ficha").val();
                    let aprendizValor = $("#txt_aprendiz").val();
                    let empresaValor = $("#txt_empresa").val();
                    let emailValor = $("#txt_aprendiz").attr("email");
                    let instructor = $("#txt_instructor").attr("idInstructor");
                    if (instructor == "" || instructor == undefined) {
                        instructor = null;
                    }
                    let documentoAlternativa = document.getElementById('txt-documentoFile').files[0];
                    let documentoPeticion = null;
                    if (documentoAlternativa == undefined) {
                        documentoPeticion = "no aplica";
                    } else {
                        documentoPeticion = documentoAlternativa;
                    }
                    let error = false;
                    if (ficha == "" || ficha == undefined) {
                        error = true;
                        $("#errorFicha").show();
                    }
                    if (aprendiz == "" || aprendiz == undefined) {
                        error = true;
                        $("#errorAprendiz").show();
                    }
                    if (empresa == "" || empresa == undefined) {
                        error = true;
                        $("#errorEmpresa").show();
                    }

                    if (modalidad >= "2") {
                        if (instructor == "" || instructor == undefined) {
                            error = true;
                            $("#errorInstructor").show();
                        }
                    }

                    if (!error) {
                        let objData = { "fechaInicio": fechaInicioPractica, "fechaFinal": fechaFinPractica, "modalidad": modalidad, "ficha": ficha, "aprendiz": aprendiz, "empresa": empresa, "registrarEtapa": "ok", "listarEtapaPractica": "ok", "fichaValor": fichaValor, "aprendizValor": aprendizValor, "empresaValor": empresaValor, "documentoAlternativa": documentoPeticion, "emailValor": emailValor, "instructor": instructor };
                        let objEtapaPractica = new seguimientos(objData);
                        objEtapaPractica.registrarEtapaPractica();
                    }
                }
            }, false)
        })



    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('#formSeguimientosEditar')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault()
                if (!form.checkValidity()) {
                    event.stopPropagation()
                    form.classList.add('was-validated')

                    let empresa = $("#txt_empresaEdit").attr("idEmpresa");
                    if (empresa == "" || empresa == undefined) {
                        $("#errorEmpresaEdit").show();
                    }
                } else {
                    let fechaInicioPractica = $("#txt-fechaInicioPracticaEdit").val();
                    let fechaFinPractica = $("#txt-fechaFinPracticaEdit").val();
                    let modalidad = $("#selectModalidadEdit").val();
                    let empresa = $("#txt_empresaEdit").attr("idEmpresa");
                    let seguimiento = $("#txt_empresaEdit").attr("etapaPractica");
                    let estadoEtapaPractica = $("#txtEstadoEtapaPractica").val();
                    let observacion = $("#txt_observaciones").val() != "" && $("#txt_observaciones").val() != null ? $("#txt_observaciones").val() : "";
                    let documentoArchivo = document.getElementById('txt-documentoFileEdit').files[0];
                    let documentoPeticion = null;
                    if (modalidad == 1 || documentoArchivo == undefined) {
                        documentoPeticion = "no aplica";
                    } else {
                        documentoPeticion = documentoArchivo;
                    }
                    let error = false;
                    if (empresa == "" || empresa == undefined) {
                        error = true;
                        $("#errorEmpresaEdit").show();
                    }

                    if (!error) {
                        let objData = { "fechaInicio": fechaInicioPractica, "fechaFinal": fechaFinPractica, "modalidad": modalidad, "empresa": empresa, "idSeguimiento": seguimiento, "editarEtapa": "ok", "listarEtapaPractica": "ok", "estadoEtapaPractica": estadoEtapaPractica, "observacion_seguimiento": observacion, "documentoAlternativa": documentoPeticion };
                        let objEtapaPractica = new seguimientos(objData);
                        objEtapaPractica.editarEtapaPractica();
                    }
                }
            }, false)
        })



    $("#tablaEtapaPractica").on("click", "#btn-DeleteEtapaPractica", function () {
        Swal.fire({
            title: 'Estas seguro?',
            text: "al eliminar este registro no podras recuperarlo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                let seguimiento = $(this).attr("etapaPractica");
                let aprendiz = $(this).attr("aprendiz");
                let detallesEtapaPractica = $(this).attr("detallesEtapaPractica");
                let modalidad = $(this).attr("modalidad");
                let objData = { "eliminarEtapaPractica": "ok", "seguimiento": seguimiento, "aprendiz": aprendiz, "listarEtapaPractica": "ok", "detallesEtapaPractica": detallesEtapaPractica, "modalidad": modalidad };
                let objEtapaPractica = new seguimientos(objData);
                objEtapaPractica.eliminarEtapaPractica();
            }
        })
    })


    $("#tablaEtapaPractica").on("click", "#btn-EditarEtapaPractica", function () {
        let modalidad = $(this).attr("modalidad");
        // Resetear el campo documento y ocultarlo antes de abrir
        $("#contenedor_documento_edit").css({ display: "none" });
        $("#txt-documentoFileEdit").removeAttr("required");
        document.getElementById('txt-documentoFileEdit').value = '';
        $(".fila1-edit").attr("class", "mb-3 col-md-4 fila1-edit");

        $("#contenedorTablaSeguimientos").hide();
        $("#contenedorFormularioSeguimientosEditar").fadeIn("2000");
        $("#txt-fechaInicioPracticaEdit").val($(this).attr("fechaInicioPractica"));
        $("#txt-fechaFinPracticaEdit").val($(this).attr("fechaFinPractica"));
        $("#txt_empresaEdit").val($(this).attr("nombreEmpresa"));
        $("#txt_empresaEdit").attr("idEmpresa", $(this).attr("empresa"));
        $("#txt_empresaEdit").attr("etapaPractica", $(this).attr("etapaPractica"));
        $("#txtEstadoEtapaPractica").val($(this).attr("estadoEtapaPractica"));
        cargarModalidad("#selectModalidadEdit", $(this).attr("modalidad"), $(this).attr("nombreModalidad"));
        $("#txt_observaciones").val($(this).attr("observacion"));

        if (modalidad == 1) {
            // Modalidad contrato de aprendizaje: permite cambiarla
            $("#selectModalidadEdit").attr("disabled", false);
        } else {
            // Otras modalidades: muestra el campo de documento existente, no permite cambiar modalidad
            $("#selectModalidadEdit").attr("disabled", true);
            $("#contenedor_documento_edit").css({ display: "block" });
            $(".fila1-edit").attr("class", "mb-3 col-md-3 fila1-edit");
        }
    })


    $("#atrasSeguimientoEdit").on("click", function () {
        $("#contenedorFormularioSeguimientosEditar").hide();
        $("#contenedorTablaSeguimientos").fadeIn("2000");
    })

    $("#btn-ListarEmpresas").on("click", function () {
        let objData = { "listarEmpresas": "ok", "txtEmpresa": "#txt_empresa" };
        let objEmpresas = new seguimientos(objData);
        objEmpresas.listarEmpresasSeguimientos();
    })


    $("#btn-ListarEmpresasEdit").on("click", function () {
        let objData = { "listarEmpresas": "ok", "txtEmpresa": "#txt_empresaEdit" };
        let objEmpresas = new seguimientos(objData);
        objEmpresas.listarEmpresasSeguimientos();
    })



    $("#btn_excel_EtapaPractica").on("change", function () {
        $("#contenedorLoaderEtapaPractica").fadeIn();
        $("#contenedorEtapasPracticas").hide();
        let archivo = document.getElementById('btn_excel_EtapaPractica').files[0];
        let objData = { "archivoEtapaPractica": archivo, "contenedorTabla": "#contenedorEtapasPracticas", "contenedorLoader": "#contenedorLoaderEtapaPractica" };
        document.getElementById('btn_excel_EtapaPractica').value = '';
        let objEtapaPractica = new EtapaPractica(objData);
        objEtapaPractica.registroMasivoEtapaPractica();
    })


    //condicion select registro
    $("#selectModalidad").on("change", function () {
        let valor = $(this).val();
        if (valor == 1 || valor == "") {
            $("#contenedor_documento").css({ display: "none" });
            $("#txt-documentoFile").removeAttr("required");
            $(".fila1").attr("class", "mb-3 col-md-4 fila1");

            $("#contenedor_instructor").css({ display: "none" });
            $("#txt-instructor").removeAttr("required");
            $(".fila2").attr("class", "mb-3 col-md-4 fila2");
        } else {
            $("#contenedor_documento").css({ display: "block" });
            $("#txt-documentoFile").attr("required", "true");
            $(".fila1").attr("class", "mb-3 col-md-3 fila1");

            $("#contenedor_instructor").css({ display: "block" });
            $("#txt-instructor").attr("required", "true");
            $(".fila2").attr("class", "mb-3 col-md-3 fila2");
        }
    })

    //condicion select edicion
    $("#selectModalidadEdit").on("change", function () {
        let valor = $(this).val();
        if (valor == 1 || valor == "") {
            $("#contenedor_documento_edit").css({ display: "none" });
            $("#txt-documentoFileEdit").removeAttr("required");
            $(".fila1-edit").attr("class", "mb-3 col-md-4 fila1-edit");
        } else {
            $("#contenedor_documento_edit").css({ display: "block" });
            $(".fila1-edit").attr("class", "mb-3 col-md-3 fila1-edit");
        }
    })
})