class seguimientos {

    constructor(objData) {
        this._objSeguimientos = objData;
    }

    listarModalidades() {
        let objData = new FormData();
        objData.append("listarModalidades", this._objSeguimientos.listarModalidad);
        fetch(config.rutes["controllerSeguimiento"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.text())
            .then(rawText => {
                // Mostrar el texto crudo en consola para depuración en hosting
                let response;
                try {
                    response = JSON.parse(rawText);
                } catch (e) {
                    console.error("[listarModalidades] El servidor no devolvio JSON valido. Contenido:", rawText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error del servidor',
                        text: 'Respuesta inesperada del servidor. Revise la consola para más detalles.',
                    });
                    return;
                }
                if (!response) return;
                if (response["codigo"] == "401") {
                    Swal.fire({ icon: 'warning', title: 'Sesión expirada', text: response["mensaje"] });
                    return;
                }
                if (response["codigo"] == "200") {
                    $(this._objSeguimientos.idSelect).html("");
                    if (this._objSeguimientos.modalidad != null) {
                        $(this._objSeguimientos.idSelect).append('<option value="' + this._objSeguimientos.modalidad + '">' + this._objSeguimientos.nombreModalidad + '</option>');
                    } else {
                        $(this._objSeguimientos.idSelect).append('<option value>Seleccione</option>');
                    }
                    var idSelect = this._objSeguimientos.idSelect;
                    var modalidad = this._objSeguimientos.modalidad;
                    response["mensaje"].forEach(cargarSelectModalidades);

                    function cargarSelectModalidades(item, index) {
                        if (modalidad != null) {
                            if (modalidad != item.idmodalidad) {
                                $(idSelect).append('<option value="' + item.idmodalidad + '">' + item.nombre_modalidad + '</option>');
                            }
                        } else {
                            $(idSelect).append('<option value="' + item.idmodalidad + '">' + item.nombre_modalidad + '</option>');
                        }
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["mensaje"],
                    })
                }
            })
            .catch(error => {
                console.error("[listarModalidades] Error de red:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'No se pudo contactar al servidor. Verifique su conexión.',
                });
            });
    }


    listarEmpresasSeguimientos() {
        let objData = new FormData();
        objData.append("listarEmpresas", this._objSeguimientos.listarEmpresas);
        fetch(config.rutes["controllerEmpresa"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                let dataSet = [];
                if (response["codigo"] == "200") {

                    var idtxtEmpresa = this._objSeguimientos.txtEmpresa;


                    response["mensaje"].forEach(crearListaEmpresas);

                    function crearListaEmpresas(item, index) {
                        var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                        objBotones += '<a type="button" class="btn btn-sm" id="btn-AsignarEmpresa" idtxtEmpresa="' + idtxtEmpresa + '" empresa="' + item.idempresa + '" nombreEmpresa="' + item.nombre_empresa + '"   title="asignar"><img  class="mc_iconTabla"  src="' + config.rutes["btnAsignar"] + '" ></button>';
                        objBotones += '</div>';
                        dataSet.push([item.nombre_empresa, item.nit_empresa, item.nomb_depa, item.nomb_muni, objBotones]);
                    }

                    $("#tablaEmpresasSeguimientos").DataTable({
                        destroy: true,
                        data: dataSet,
                        responsive: true,
                        language: {
                            "decimal": "",
                            "emptyTable": "No hay datos disponibles en la tabla",
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
                        }
                    });
                }
            });
    }

    listarFichasSeguimientos() {
        var objData = new FormData();
        objData.append("cargarTablaFichas", this._objSeguimientos.listarFichas);
        fetch(config.rutes["controllerFichas"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                var dataSet = [];
                response.forEach(listaDatos);

                function listaDatos(item, index) {
                    var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                    objBotones += '<a type="button" class="btn btn-sm" id="btn-AsignarFicha" idficha="' + item.idficha + '" ficha="' + item.numero_ficha + '"   caracterizacion="' + item.caracterizacion + '" estado="' + item.estado_ficha_idestado_ficha + '" programa="' + item.nombre_programa + " De " + item.duracion_programa + " Meses " + '" duracion="' + item.duracion_programa + '" idPrograma="' + item.idtipo_programa + '"  title="asignar ficha"><img class="mc_iconTabla" src="' + config.rutes["btnAsignar"] + '"></a>';
                    objBotones += '</div>';
                    var estado_ficha = '<span class="badge bg-label-danger me-1">' + item.nombre_estado_ficha + '</span>';
                    dataSet.push([item.numero_ficha, item.caracterizacion, estado_ficha, objBotones]);
                }

                $("#tablaFichasSeguimientos").DataTable({
                    destroy: true,
                    data: dataSet,
                    responsive: true,
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay datos disponibles en la tabla",
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
                    }
                });

            });
    }

    listarAprendicesSeguimientos() {
        var objData = new FormData();
        objData.append("fichaAprendicesEtapaPractica", this._objSeguimientos.fichaAprendicesSelecionada);

        fetch(config.rutes["controllerFichas"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                var dataSet = [];
                response["mensaje"].forEach(listaDatosAprendices);

                function listaDatosAprendices(item, index) {
                    var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                    objBotones += '<a type="button" class="btn btn-sm" id="btn-AsignarAprendiz" idaprendiz="' + item.idaprendiz + '"  documento="' + item.documento + '" nombres="' + item.nombres + '" apellidos="' + item.apellidos + '" ficha="' + item.numero_ficha + '" email="' + item.email + '" title="asignar aprendiz"><img class="mc_iconTabla" src="' + config.rutes["btnAsignar"] + '"></a>';
                    objBotones += '</div>';
                    dataSet.push([item.numero_ficha, item.documento, item.nombres, item.apellidos, objBotones]);
                }

                $("#tablaAprendicesSeguimientos").DataTable({
                    destroy: true,
                    data: dataSet,
                    responsive: true,
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay datos disponibles en la tabla",
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
                    }
                });
            });
    }

    registrarEtapaPractica() {
        let objData = new FormData();
        objData.append("registrarEtapaPractica", this._objSeguimientos.registrarEtapa);
        objData.append("fechaInicioPractica", this._objSeguimientos.fechaInicio);
        objData.append("fechaFinPractica", this._objSeguimientos.fechaFinal);
        objData.append("modalidad", this._objSeguimientos.modalidad);
        objData.append("ficha", this._objSeguimientos.ficha);
        objData.append("aprendiz", this._objSeguimientos.aprendiz);
        objData.append("empresa", this._objSeguimientos.empresa);
        objData.append("fichaValor", this._objSeguimientos.fichaValor);
        objData.append("emailValor", this._objSeguimientos.emailValor);
        objData.append("aprendizValor", this._objSeguimientos.aprendizValor);
        objData.append("empresaValor", this._objSeguimientos.empresaValor);
        objData.append("documentoAlternativa", this._objSeguimientos.documentoAlternativa);
        objData.append("instructor", this._objSeguimientos.instructor);

        fetch(config.rutes["controllerSeguimiento"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    $("#formSeguimientos")[0].reset();
                    $("#contenedorFormularioSeguimientos").hide();
                    $("#contenedorTablaSeguimientos").fadeIn("2000");
                    Swal.fire({
                        icon: 'success',
                        title: response["mensaje"],
                        showConfirmButton: false,
                        timer: 1500
                    })

                    this.listarDatosEtapaPractica();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["mensaje"],
                    })
                }
            });
    }



    editarEtapaPractica() {
        let objData = new FormData();
        objData.append("editarEtapaPractica", this._objSeguimientos.editarEtapa);
        objData.append("fechaInicioPractica", this._objSeguimientos.fechaInicio);
        objData.append("fechaFinPractica", this._objSeguimientos.fechaFinal);
        objData.append("modalidad", this._objSeguimientos.modalidad);
        objData.append("empresa", this._objSeguimientos.empresa);
        objData.append("idSeguimiento", this._objSeguimientos.idSeguimiento);
        objData.append("estadoEtapaPractica", this._objSeguimientos.estadoEtapaPractica);
        objData.append("observacion_seguimiento", this._objSeguimientos.observacion_seguimiento);
        objData.append("documentoAlternativa", this._objSeguimientos.documentoAlternativa);

        fetch(config.rutes["controllerSeguimiento"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    $("#contenedorFormularioSeguimientosEditar").hide();
                    $("#contenedorTablaSeguimientos").fadeIn("2000");
                    Swal.fire({
                        icon: 'success',
                        title: response["mensaje"],
                        showConfirmButton: false,
                        timer: 1500
                    })

                    this.listarDatosEtapaPractica();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["mensaje"],
                    })
                }
            });
    }


    listarDatosEtapaPractica() {
        let objData = new FormData();
        objData.append("listarEtapaPractica", this._objSeguimientos.listarEtapaPractica);
        fetch(config.rutes["controllerSeguimiento"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.text())
            .then(rawText => {
                let response;
                try {
                    response = JSON.parse(rawText);
                } catch (e) {
                    console.error("[listarDatosEtapaPractica] El servidor no devolvió JSON válido. Contenido:", rawText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de servidor',
                        text: 'La respuesta del servidor no se pudo procesar. Revisa la consola.',
                    });
                    return;
                }
                
                if (!response) return;

                if (response["codigo"] == "401") {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Sesión expirada',
                        text: response["mensaje"]
                    });
                    return;
                }

                if (response["codigo"] != "200") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al listar seguimientos',
                        text: response["mensaje"] || 'Error desconocido'
                    });
                    return;
                }

                var dataSet = [];
                var contadorEtapas = 0;
                response["mensaje"].forEach(listaDatosEtapaPractica);

                function listaDatosEtapaPractica(item, index) {
                    var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                    let estadoEtapaPractica = null;
                    let etapa_fragmentada = item.etapa_fragmentada;

                    if (etapa_fragmentada == "" || etapa_fragmentada == null) {
                        objBotones += '<button type="button" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center" id="btn-EditarEtapaPractica"  etapaPractica="' + item.idseguimiento + '" aprendiz="' + item.idaprendiz + '" empresa="' + item.idempresa + '" nombreEmpresa="' + item.nombre_empresa + '"  fechaInicioPractica="' + item.fecha_inicio_practica + '" fechaFinPractica="' + item.fecha_fin_practica_seguimiento + '" modalidad="' + item.idmodalidad + '" nombreModalidad="' + item.nombre_modalidad + '" estadoEtapaPractica="' + item.estado_etapa_practica + '" observacion="' + item.observacion_seguimiento + '"  title="editar"><i class="bx bx-edit mc_iconTabla"></i></button>';
                    } else {
                        objBotones += '<button type="button" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center" id="btn-desabilitado"  title="editar"><i class="bx bx-edit mc_iconTabla"></i></button>';
                    }

                    objBotones += '<button type="button" class="btn btn-sm btn-dark d-flex align-items-center justify-content-center" id="btn-DeleteEtapaPractica" etapaPractica="' + item.idseguimiento + '" aprendiz="' + item.idaprendiz + '" detallesEtapaPractica="aprendiz ' + item.nombres + ' ' + item.apellidos + ' de la ficha ' + item.numero_ficha + ' ' + item.caracterizacion + ' en la empresa ' + item.nombre_empresa + ' bajo la modalidad de ' + item.nombre_modalidad + '" modalidad="' + item.idmodalidad + '" title="eliminar"><i class="bx bx-trash mc_iconTabla"></i></button>';
                    objBotones += '</div>';
                    contadorEtapas += 1;

                    if (item.estado_etapa_practica == "1" || item.estado_etapa_practica == "") {
                        estadoEtapaPractica = "Cerrado";
                    } else {
                        estadoEtapaPractica = "Abierto";
                    }

                    dataSet.push([item.fecha_inicio_practica, item.fecha_fin_practica_seguimiento, item.nombre_modalidad, '<span class="text-dark">' + item.numero_ficha + '</span>', '<span class="text-dark">' + item.caracterizacion + '</span>', item.documento, '<span class="text-dark">' + item.nombres + " " + item.apellidos + '</span>', item.email, item.nombre_empresa, item.observacion_seguimiento, estadoEtapaPractica, objBotones]);
                }

                $("#tablaEtapaPractica").DataTable({
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
                    destroy: true,
                    data: dataSet,
                    responsive: true,
                    select: true,
                    columnDefs: [
                        {
                            targets: [0, 1, 2, 7, 9, 10],
                            visible: false,
                        },
                    ],
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay datos disponibles en la tabla",
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
                        $(row).css("font-size", "11.5px");
                    }
                });

            });
    }


    eliminarEtapaPractica() {
        let objData = new FormData();
        objData.append("eliminarEtapaPractica", this._objSeguimientos.eliminarEtapaPractica);
        objData.append("idseguimiento", this._objSeguimientos.seguimiento);
        objData.append("idaprendiz", this._objSeguimientos.aprendiz);
        objData.append("detallesEtapaPractica", this._objSeguimientos.detallesEtapaPractica);
        objData.append("modalidad", this._objSeguimientos.modalidad);
        fetch(config.rutes["controllerSeguimiento"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: response["mensaje"],
                        showConfirmButton: false,
                        timer: 1500
                    })

                    this.listarDatosEtapaPractica();
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
        objData.append("listarInstructores", this._objSeguimientos.listarInstructores);
        fetch(config.rutes["controllerSeguimiento"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                let dataSet = [];
                response["mensaje"].forEach(item => {
                    let objBotones = '<div class="btn-group">';
                    objBotones += '<a type="button" class="btn btn-primary btn-sm" idFuncionario="' + item.idfuncionario + '" nombres="' + item.nombres + '" apellidos="' + item.apellidos + '"  id="btn-asignarInstructor" title="asignar"><i class="bi bi-person-plus text-white"></i></a>';
                    objBotones += '</div>';
                    dataSet.push(['<span class="text-nowrap">' + item.documento + '</span>', item.nombres, item.apellidos, item.email, objBotones]);
                });

                $("#tablaInstructores").DataTable({
                    destroy: true,
                    data: dataSet,
                    responsive: true,
                    select: true,
                    language: {
                        "decimal": "",
                        "emptyTable": "No hay datos disponibles en la tabla",
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
                        $(row).css("font-size", "11.5px"); // Cambia el tamaño de la letra de cada fila
                    }
                });

            });
    }



}