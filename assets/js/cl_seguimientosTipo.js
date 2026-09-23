class SeguimientosPorTipo {
    constructor(objDatos) {
        this._objSeguimientosPorTipo = objDatos;
    }

    listarSeguimientosPorTipo() {
        let objData = new FormData();
        objData.append("tipoSeguimiento", this._objSeguimientosPorTipo.tipoSeguimiento);
        objData.append("estado", this._objSeguimientosPorTipo.estado);

        let dtInstance;
        let spinnerHtml = '<div class="text-center py-5"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Cargando...</span></div><br><span class="mt-2 d-inline-block">Cargando datos...</span></div>';

        if (!$.fn.DataTable.isDataTable("#tabla_seguimientosPorTipo")) {
            $("#tabla_seguimientosPorTipo").empty();
            dtInstance = $("#tabla_seguimientosPorTipo").DataTable({
                columns: [
                    { title: "Radicado", className: "text-nowrap text-dark", visible: false },
                    { title: "Vencimiento", className: "text-nowrap" },
                    { title: "Entrega", className: "text-nowrap" },
                    { title: "Documento", className: "text-nowrap", visible: false },
                    { title: "Instructor" },
                    { title: "Ficha", className: "text-nowrap" },
                    { title: "Caracterización", className: "text-nowrap", visible: false },
                    { title: "Documento A.", className: "text-nowrap" },
                    { title: "Aprendiz" },
                    { title: "Ubicación", className: "text-nowrap" },
                    { title: "Estado", className: "text-nowrap", visible: false },
                    { title: "Reporte", className: "text-nowrap" },
                    { title: "...", className: "text-nowrap" }
                ],
                headerCallback: function (thead, data, start, end, display) {
                    $(thead).addClass('table-light');
                    $(thead).find('th').addClass('text-dark').css('font-size', '10px');
                },
                buttons: [
                    {
                        extend: "colvis",
                        text: '<i class="bx bx-columns"></i>',
                        titleAttr: "Columnas Visibles",
                        className: "btn btn-dark btn-sm"
                    },
                    {
                        extend: "excel",
                        text: '<i class="bx bx-file" ></i>',
                        titleAttr: 'Exportar a Excel',
                        className: 'btn btn-secondary btn-sm'
                    },
                    {
                        extend: "print",
                        text: '<i class="bx bx-printer"></i>',
                        titleAttr: 'Imprimir',
                        className: 'btn btn-primary btn-sm'
                    }
                ],
                dom: 'Bfrtip',
                data: [],
                responsive: false,
                autoWidth: false,
                language: {
                    "decimal": "",
                    "emptyTable": spinnerHtml,
                    "info": "visualizando _START_ de _END_ para un total de _TOTAL_ registros",
                    "infoEmpty": "visualizando 0 de 0 para un total de 0 registros",
                    "infoFiltered": "(filtrado de _MAX_ registros)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron registros coincidentes",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                },
                rowCallback: function (row, data, index) {
                    $(row).css("font-size", "12.5px");
                }
            });
        } else {
            dtInstance = $("#tabla_seguimientosPorTipo").DataTable();
            dtInstance.context[0].oLanguage.sEmptyTable = spinnerHtml;
            dtInstance.clear().draw();
        }

        fetch(config.rutes["controllerSeguimientosPorTipo"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                let mensaje = error;
            }).then(response => {
                let dataSet = [];
                let funcionario = $("#tabla_seguimientosPorTipo").attr("funcionario");

                if (response && Array.isArray(response)) {
                    response.forEach((item, index) => {
                        var nombre_aprendiz = item.nombres + " " + item.apellidos;
                        var nombre_funcionario = item.nombresfuncionario + " " + item.apellidosfuncionario;

                        let reporte = '';
                        var objBotones = `<div class="btn-group" role="group" aria-label="Basic example">`;
                        if (funcionario != 5) {
                            objBotones += `<button class="btn btn-sm btn-secondary d-flex align-items-center justify-content-center" id="btn_ver_detalles" idAprendiz="${item.idaprendiz}" idFuncionario="${item.idfuncionario}" idSeguimiento="${item.idvisita_seguimiento}" title="Visualizar"><i class="bx bx-search-alt mc_iconTabla"></i></button>`;
                            objBotones += `<button class="btn btn-sm btn-primary d-flex align-items-center justify-content-center" id="btn-Editar-Tipo" data-bs-toggle="modal" data-bs-target="#ModalEditarTipo" visitaSeguimiento="${item.idvisita_seguimiento}" tipoSeguimiento="${item.tipo_seguimiento_idtipo_seguimiento}" nombreTipoSeguimiento="${item.nombre_tipo_seguimiento}"  ubicacion="${item.ubicacion_seguimiento}" title="Editar"><i class="bx bx-edit-alt mc_iconTabla"></i></button>`;

                            if (item.estado_reporte != 1) {
                                objBotones += `<button class="btn btn-sm btn-info d-flex align-items-center justify-content-center" id="btnReasignarInstructor" data-bs-toggle="modal" data-bs-target="#ModalReasignarInstructor" idFuncionario="${item.idfuncionario}" estadoSeguimiento="${item.estado_reporte}" nombreFuncionario="${nombre_funcionario}" visitaSeguimiento="${item.idvisita_seguimiento}" vencimiento='${item.fecha_vencimiento}'  title="Reasignar"><i class="bx bxs-user-plus mc_iconTabla"></i></button>`;
                            } else {
                                objBotones += `<button class="btn btn-sm btn-info d-flex align-items-center justify-content-center" id="btnReasignarInstructor" idFuncionario="${item.idfuncionario}" estadoSeguimiento="${item.estado_reporte}" nombreFuncionario="${nombre_funcionario}" visitaSeguimiento="${item.idvisita_seguimiento}" vencimiento='${item.fecha_vencimiento}'  title="Reasignar"><i class="bx bxs-user-check mc_iconTabla"></i></button>`;
                            }

                            objBotones += `<button class="btn btn-sm btn-dark d-flex align-items-center justify-content-center" id="btn-Eliminar-Tipo" data-bs-toggle="modal" visitaSeguimiento="${item.idvisita_seguimiento}" tipoSeguimiento="${item.tipo_seguimiento_idtipo_seguimiento}" seguimiento="${item.idseguimiento}" archivo="${item.url_documento}"  aprendiz="${item.idaprendiz}" title="Eliminar"><i class="bx bx-trash-alt mc_iconTabla"></i></button>`;
                        } else {
                            objBotones += `<button class="btn btn-sm btn-secondary d-flex align-items-center justify-content-center" id="btn_ver_detalles" idAprendiz="${item.idaprendiz}" idFuncionario="${item.idfuncionario}" idSeguimiento="${item.idvisita_seguimiento}" title="Visualizar"><i class="bx bx-search-alt mc_iconTabla"></i></button>`;
                        }
                        objBotones += `</div>`;

                        let ubicacion = item.ubicacion_seguimiento
                        if (item.ubicacion_seguimiento == "" || item.ubicacion_seguimiento == null) {
                            ubicacion = "No aplica"
                        }


                        if (item.estado_reporte == null || item.estado_reporte == '') {
                            reporte += '<span class="badge bg-label-warning me-1">Sin reporte</span>';
                        } else if (item.estado_reporte == 0) {
                            reporte += '<span class="badge bg-label-primary me-1">Entregado</span>';
                        } else if (item.estado_reporte == 1) {
                            reporte += '<span class="badge bg-label-success me-1">Aprobado</span>';
                        } else {
                            reporte += '<span class="badge bg-label-danger me-1">Rechazado</span>';
                        }

                        dataSet.push([item.fecha_radicado, item.fecha_vencimiento, item.fecha_entrega, item.documentofuncionario, nombre_funcionario, item.numero_ficha, item.caracterizacion, item.documentoaprendiz, nombre_aprendiz, ubicacion, item.nombre_estado_visita_seguimiento, reporte, objBotones]);
                    });
                }

                dtInstance.context[0].oLanguage.sEmptyTable = "No hay datos disponibles en la tabla";
                dtInstance.clear();
                dtInstance.rows.add(dataSet);
                dtInstance.draw();
            });
    }


    listarTipoSeguimientos() {
        let objData = new FormData();
        objData.append("listarTipoSeguimiento", this._objSeguimientosPorTipo.listarTipoSeguimiento);
        fetch(config.rutes["controllerAsignacionSeguimiento"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    const select = document.getElementById(this._objSeguimientosPorTipo.selectTipoSeguimiento);
                    select.innerHTML = "";
                    response["mensaje"].forEach((item) => {
                        let option = document.createElement('option');
                        option.value = item.idtipo_seguimiento;
                        option.innerHTML = item.nombre_tipo_seguimiento;
                        select.append(option);
                    });
                    select.value = this._objSeguimientosPorTipo.tipoSeguimiento;

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["mensaje"],
                    })
                }
            });
    }


    listarInstructoresSeguimientos() {
        let objData = new FormData();
        objData.append("cargarFuncionarios", this._objSeguimientosPorTipo.cargarFuncionarios);
        fetch(config.rutes["controllerFuncionarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                console.log(error)
            }).then(response => {
                if (response != null) {
                    let dataSet = [];
                    response.forEach((item) => {
                        if (item.idtipo_funcionario == 1) {
                            var objBotones = `<div class="btn-group" role="group" aria-label="Basic example">`;
                            objBotones += `<button class="btn btn-sm" id="btnSeleccionarInstructor" idFuncionario="${item.idfuncionario}" nombreFuncionario="${item.nombres + " " + item.apellidos}" title="Reasignar"><img  class="mc_iconTabla"  src="${config.rutes["btnReasignarInstructor"]}" ></button>`;
                            objBotones += `</div>`;

                            dataSet.push([item.documento, item.nombres + " " + item.apellidos, objBotones])
                        }
                    })

                    $("#tablaInstructoresSeguimientos").DataTable({
                        destroy: true,
                        data: dataSet,
                        responsive: true,
                        language: {
                            "decimal": "",
                            "emptyTable": "No hay datos disponibles en la tabla",
                            "info": "visualizando _START_ de _END_ (Total: _TOTAL_)",
                            "infoEmpty": "visualizando 0 de 0 para un total de 0 registros",
                            "infoFiltered": "(filtrado de _MAX_ registros)",
                            "infoPostFix": "",
                            "thousands": ",",
                            "lengthMenu": "Mostrar _MENU_ registros",
                            "loadingRecords": "Cargando...",
                            "processing": "Procesando...",
                            "search": "Buscar:",
                            "zeroRecords": "No se encontraron registros coincidentes",
                            "paginate": {
                                "first": "Primero",
                                "last": "Ultimo",
                                "next": "Siguiente",
                                "previous": "Anterior"
                            },
                            "aria": {
                                "sortAscending": ": activate to sort column ascending",
                                "sortDescending": ": activate to sort column descending"
                            }
                        },
                        rowCallback: function (row, data, index) {
                            $(row).css("font-size", "12.5px"); // Cambia el tamaño de la letra de cada fila
                        }
                    })
                }
            });
    }


    reasignarInstructor() {
        let objData = new FormData();
        objData.append("reasignarInstructor", this._objSeguimientosPorTipo.reasignarInstructor);
        objData.append("fechaVencimiento", this._objSeguimientosPorTipo.fechaVencimiento);
        objData.append("funcionario", this._objSeguimientosPorTipo.funcionario);
        objData.append("visitaSeguimiento", this._objSeguimientosPorTipo.visitaSeguimiento);

        $("#ModalReasignarInstructor").modal('hide');
        Swal.fire({
            toast: true,
            position: 'bottom-end',
            icon: 'info',
            title: 'Actualizando datos y enviando correo... un momento por favor.',
            showConfirmButton: false,
            timer: 7000
        });

        fetch(config.rutes["controllerSeguimientosPorTipo"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                console.log(error)
            }).then(response => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        icon: 'success',
                        title: response["message"],
                        showConfirmButton: false,
                        timer: 3000
                    });

                    this.listarSeguimientosPorTipo();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["message"],
                    })
                }
            });
    }


    editarTipoSeguimiento() {
        let objData = new FormData();
        objData.append("cambiarTipoSeguimiento", this._objSeguimientosPorTipo.cambiarTipoSeguimiento);
        objData.append("idVisitaSeguimiento", this._objSeguimientosPorTipo.visitaSeguimiento);
        objData.append("idTipoSeguimiento", this._objSeguimientosPorTipo.selectTipoSeguimiento);
        objData.append("ubicacion", this._objSeguimientosPorTipo.ubicacion)

        fetch(config.rutes["controllerSeguimientosPorTipo"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                console.log(error)
            }).then(response => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        toast: true,
                        position: 'bottom-end',
                        icon: 'success',
                        title: response["mensaje"],
                        showConfirmButton: false,
                        timer: 3000
                    });

                    this.listarSeguimientosPorTipo();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["mensaje"],
                    })
                }
            });
    }


    eliminarSeguimiento() {
        Swal.fire({
            title: "Estás seguro de eliminar este seguimiento?",
            text: "Al eliminarlo no podrás revertir este proceso!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, estoy seguro!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                let objData = new FormData();
                objData.append("eliminarSeguimiento", this._objSeguimientosPorTipo.eliminarSeguimiento);
                objData.append("tipoSeguimiento", this._objSeguimientosPorTipo.idTipoSeguimiento);
                objData.append("visita_seguimiento", this._objSeguimientosPorTipo.visita_seguimiento);
                objData.append("seguimiento", this._objSeguimientosPorTipo.seguimiento);
                objData.append("url_archivo", this._objSeguimientosPorTipo.url_archivo);
                objData.append("aprendiz", this._objSeguimientosPorTipo.aprendiz);

                fetch(config.rutes["controllerSeguimientosPorTipo"], {
                    method: 'POST',
                    body: objData
                })
                    .then(response => response.json()).catch(error => {
                        let mensaje = error;
                    }).then(response => {
                        if (response["codigo"] == "200") {
                            Swal.fire({
                                icon: 'success',
                                title: response["message"],
                                showConfirmButton: false,
                                timer: 1500
                            })
                            this.listarSeguimientosPorTipo();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error..!',
                                text: "Hubo un error al Eliminar el Registro"
                            })
                        }
                    });
            }
        });
    }


    infoSeguimiento() {
        let objData = new FormData();
        objData.append("idSeguimiento", this._objSeguimientosPorTipo.idSeguimiento);

        fetch(config.rutes["controllerSeguimientosPorTipo"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                datos(response);
            });

        function datos(response) {
            let optionEstadoReporte = '';
            response.forEach(function (item, index) {
                $("#txt_fechaRadicado").val(item.fecha_radicado_visita);
                $("#txt_fecha_vencimiento").val(item.fecha_vencimiento);
                $("#txt_fecha_entrega").val(item.fecha_entrega);
                $("#txt_estado_visita").val(item.nombre_estado_visita_seguimiento);
                $("#txt_modalidad").val(item.nombre_modalidad);
                if (item.url_documento != null && item.url_documento !== "") {
                    $("#ver_documento").attr("href", item.url_documento);
                    $("#ver_documento").attr("target", "_blank");
                    $("#ver_documento").removeClass("disabled btn-secondary").addClass("btn-primary");
                } else {
                    $("#ver_documento").attr("href", "javascript:void(0);");
                    $("#ver_documento").attr("target", "");
                    $("#ver_documento").removeClass("btn-primary").addClass("disabled btn-secondary");
                }
                $("#txt_empresa").val(item.nombre_empresa);
                $("#txt_departamento").val(item.nomb_depa.trim());
                $("#txt_ciudad").val(item.nomb_muni.trim());

                let ubicacion = item.ubicacion_seguimiento
                if (item.ubicacion_seguimiento == "" || item.ubicacion_seguimiento == null) {
                    ubicacion = "No aplica"
                }
                $("#txt_ubicacion").val(ubicacion);
                if (item.estado_reporte == null || item.estado_reporte == '') {
                    optionEstadoReporte += '<option>Sin reporte</option>';
                } else if (item.estado_reporte == 0) {
                    optionEstadoReporte += '<option value="0">Entregado</option>';
                    optionEstadoReporte += '<option value="1">Aprobado</option>';
                    optionEstadoReporte += '<option value="2">Rechazado</option>';
                } else if (item.estado_reporte == 1) {
                    optionEstadoReporte += '<option value="1">Aprobado</option>';
                    optionEstadoReporte += '<option value="2">Rechazado</option>';
                    optionEstadoReporte += '<option value="0">Entregado</option>';
                } else {
                    optionEstadoReporte += '<option value="2">Rechazado</option>';
                    optionEstadoReporte += '<option value="0">Entregado</option>';
                    optionEstadoReporte += '<option value="1">Aprobado</option>';
                }
            })
            $("#txt_reporte").html(optionEstadoReporte)
        }
    }

    cambiarEstadoReporte() {
        let objData = new FormData();
        objData.append("estadoReporte", this._objSeguimientosPorTipo.estadoReporte);
        objData.append("idVisitaReporte", this._objSeguimientosPorTipo.idVisitaReporte);

        fetch(config.rutes["controllerSeguimientosPorTipo"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Se cambio el estado del reporte exitosamente.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    if (response["estado"] == "1" || response["estado"] == "2") {
                        setTimeout(function () {
                            $("#modalNovedades_visita").modal("show");
                        }, 1000);
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al cambiar estado del reporte.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            });
    }

}