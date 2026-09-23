$(function() {

    listarEtapasPracticas();
    listarSeguimientosPreAsignados();
    listarTipoSeguimiento();

    function listarEtapasPracticas() {
        var objData = { "listarEtapaPractica": "ok" };
        var objListaEtapaPractica = new asignacionSeguimientos(objData);
        objListaEtapaPractica.crearTablaEtapaPractica();
    }

    function listarSeguimientosPreAsignados() {
        var objData = { "listarPreAsignados": "ok" };
        var objListaPreAsignados = new asignacionSeguimientos(objData);
        objListaPreAsignados.crearTablaSegumientosPreAsignados();
    }

    function listarTipoSeguimiento() {
        var objData = { "listarTipoSeguimiento": "ok" };
        var objListaTipoSeguimiento = new asignacionSeguimientos(objData);
        objListaTipoSeguimiento.cargarTipoSeguimiento();
    }

    $("#tablaSeguimientoPreAsignado").on("click", "#btn-DeletePreAsignado", function() {
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
                let seguimientoPreAsignado = $(this).attr("seguimientoPreAsignado");
                let idSeguimiento = $(this).attr("idseguimiento");
                let estadoEtapa = $(this).attr("estadoEtapa");
                let objData = { "eliminarPreAsignado": "ok", "seguimientoPreAsignado": seguimientoPreAsignado, "idSeguimiento": idSeguimiento, "estadoEtapa": estadoEtapa, "listarPreAsignados": "ok" };
                objEliminarPreAsignados = new asignacionSeguimientos(objData);
                objEliminarPreAsignados.eliminarPreAsignado();
            }
        })
    })

    $("#btn-ListarFuncionario").on("click", function() {
        let objData = { "listarInstructor": "ok", "idtxtFuncionario": "filtro" };
        let objInstructor = new asignacionSeguimientos(objData);
        objInstructor.listarInstructor();
    })


    $("#btn-ListarFuncionarioSeguimiento").on("click", function() {
        let objData = { "listarInstructor": "ok", "idtxtFuncionario": "registro" };
        let objInstructor = new asignacionSeguimientos(objData);
        objInstructor.listarInstructor();
    })


    $("#tablaInstructoresSeguimientos").on("click", "#btn-AsignarInstructorFiltro", function() {
        $("#txt_funcionario").attr("idfuncionario", $(this).attr("idFuncionario"));
        $("#txt_funcionario").val($(this).attr("nombreFuncionario"));
        $('#modalInstructor').modal('toggle');

        let objData = { "listarSeguimientosInstructor": "ok", "idInstructor": $(this).attr("idFuncionario") };
        objListaSeguimientosInstructor = new asignacionSeguimientos(objData);
        objListaSeguimientosInstructor.listarSeguimientosInstructor();
    })


    $("#tablaInstructoresSeguimientos").on("click", "#btn-AsignarInstructorRegistro", function() {
        $("#txt_funcionarioSeguimiento").attr("idfuncionario", $(this).attr("idFuncionario"));
        $("#txt_funcionarioSeguimiento").val($(this).attr("nombreFuncionario"));
        $("#errorInstructor").hide();
        $('#modalInstructor').modal('toggle');
    })

    $("#tablaEtapaPracticaAsignacion").on("click", "#btn-asignarSeguimientoEtapaPractica", function() {
        document.getElementById("formVisitaSeguimiento").reset();
        $("#txt_funcionarioSeguimiento").attr("idfuncionario", "");
        let seguimiento = $(this).attr("etapaPractica");
        $("#btnPreAsignarSeguimiento").attr("seguimiento", seguimiento);
        $("#contenedorFormularioVisitaSeguimiento").fadeIn("2000");
        $("#contenedorTablaEtapaPractica").hide();
    })

    $("#atrasPreAsignarSeguimiento").on("click", function() {
        $("#contenedorFormularioVisitaSeguimiento").hide();
        $("#contenedorTablaEtapaPractica").fadeIn("2000");
    })


    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('#formVisitaSeguimiento')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault()
                if (!form.checkValidity()) {
                    event.stopPropagation()
                    form.classList.add('was-validated')
                    let instructor = $("#txt_funcionarioSeguimiento").attr("idfuncionario");
                    if (instructor == "" || instructor == undefined) {
                        $("#errorInstructor").show();
                    }
                } else {
                    let instructor = $("#txt_funcionarioSeguimiento").attr("idfuncionario");
                    let tipoSeguimiento = $("#selectTipoSeguimiento").val();
                    let fechaVencimiento = $("#txt-fechaVencimiento").val();
                    let idSeguimiento = $("#btnPreAsignarSeguimiento").attr("seguimiento");
                    let ubicacion = $("#selectUbicacionSeguimiento").val();
                    let error = false;
                    if (instructor == "" || instructor == undefined) {
                        error = true;
                        $("#errorInstructor").show();
                    }
                    if (!error) {
                        let objData = { "instructor": instructor, "tipoSeguimiento": tipoSeguimiento, "fechaVencimiento": fechaVencimiento, "idSeguimiento": idSeguimiento, "ubicacion": ubicacion,"RegistrarSeguimientoPractica": "ok" };
                        let objRegistroSeguimiento = new asignacionSeguimientos(objData);
                        objRegistroSeguimiento.registrarAsignacion();
                    }
                }
            }, false)
        })


    $("#btn-EnviarSeguimientosInstructor").on("click", function() {
        let lista = JSON.parse($(this).parent().attr("lista"));
        if (lista == "" || lista == null || lista == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "El instructor no cuenta con seguimientos preasignados"
            })
        } else {
            let listaEnviar = JSON.stringify(lista);
            let objDatos = { "listaEnviar": listaEnviar };
            let objCorreoMasivo = new asignacionSeguimientos(objDatos);
            objCorreoMasivo.enviarSeguimientosInstructor();
        }
    })

    // --- Navegación de Tabs (Siguiente y Anterior) ---
    $("#btnSiguientePaso").on("click", function() {
        var triggerEl = document.querySelector('#asignacionTabs button[data-bs-target="#paso2"]');
        var tab = new bootstrap.Tab(triggerEl);
        tab.show();
    });

    $("#btnAnteriorPaso").on("click", function() {
        var triggerEl = document.querySelector('#asignacionTabs button[data-bs-target="#paso1"]');
        var tab = new bootstrap.Tab(triggerEl);
        tab.show();
    });

    // --- Redibujar DataTables al cambiar de pestaña ---
    $('button[data-bs-toggle="pill"]').on('shown.bs.tab', function (e) {
        let target = $(e.target).attr("data-bs-target"); // #paso1 o #paso2
        if (target == "#paso1") {
            if ($.fn.DataTable.isDataTable('#tablaEtapaPracticaAsignacion')) {
                $('#tablaEtapaPracticaAsignacion').DataTable().columns.adjust().responsive.recalc();
            }
        } else if (target == "#paso2") {
            if ($.fn.DataTable.isDataTable('#tablaSeguimientoPreAsignado')) {
                $('#tablaSeguimientoPreAsignado').DataTable().columns.adjust().responsive.recalc();
            }
            if ($.fn.DataTable.isDataTable('#tablaSeguimientoInstructor')) {
                $('#tablaSeguimientoInstructor').DataTable().columns.adjust().responsive.recalc();
            }
        }
    });

})