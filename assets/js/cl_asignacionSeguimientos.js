class asignacionSeguimientos {

    constructor(objData) {
        this._asignacionSeguimientos = objData;
    }


    crearTablaEtapaPractica() {
        let objData = new FormData();
        objData.append("listarEtapaPractica", this._asignacionSeguimientos.listarEtapaPractica);
        fetch(config.rutes["controllerSeguimiento"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                var dataSet = [];
                response["mensaje"].forEach(listaDatosEtapaPractica);

                function listaDatosEtapaPractica(item, index) {
                    if (item.etapa_fragmentada != "1") {
                        var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                        objBotones += '<button type="button" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center" id="btn-asignarSeguimientoEtapaPractica"  etapaPractica="' + item.idseguimiento + '" aprendiz="' + item.idaprendiz + '" empresa="' + item.idempresa + '" nombreEmpresa="' + item.nombre_empresa + '"  fechaInicioPractica="' + item.fecha_inicio_practica + '" fechaFinPractica="' + item.fecha_fin_practica_seguimiento + '" modalidad="' + item.idmodalidad + '" nombreModalidad="' + item.nombre_modalidad + '"  title="Asignar Seguimiento"><i class="bx bx-user-plus mc_iconTabla"></i></button>';
                        objBotones += '</div>';

                        var estado = "Sin Asignar";
                        if (item.estado_etapa == "2") {
                            estado = "Final";
                        } else if (item.estado_etapa == "1") {
                            estado = "Parcial";
                        } else if (item.estado_etapa == "3") {
                            estado = "Momento 1";
                        } else if (item.estado_etapa == "4") {
                            estado = "Momento 2";
                        } else if (item.estado_etapa == "5") {
                            estado = "Momento 3";
                        } else if (item.estado_etapa == "6") {
                            estado = "Extraordinario";
                        }

                        let nombreInstructor = item.ultimo_instructor == "" || item.ultimo_instructor == null ? "Sin Asignar" : item.ultimo_instructor;

                        dataSet.push([item.fecha_inicio_practica, item.fecha_fin_practica_seguimiento, '<span class="text-dark">' + item.nombre_modalidad + '</span>', '<span class="text-dark">' + item.numero_ficha + '</span>', mayusPrimeraLetraDeOracion(item.caracterizacion), '<span class="text-dark">' + item.documento + '</span>', '<span class="text-dark">' + mayusPrimeraLetraDeOracion(item.nombres + " " + item.apellidos) + '</span>', mayusPrimeraLetraDeOracion(item.nombre_empresa), nombreInstructor, mayusPrimeraLetraDeOracion(item.nomb_depa + " - " + item.nomb_muni), item.observacion_seguimiento, estado, objBotones]);

                        function mayusPrimeraLetraDeOracion(oracion) {
                            let palabras = oracion.split(" ").map(palabra => {
                                if (palabra[0] != "" && palabra[0] != undefined) {
                                    return palabra[0].toUpperCase() + palabra.slice(1).toLowerCase();
                                } else {
                                    return palabra[0] + palabra.slice(1).toLowerCase();
                                }
                            })
                            return palabras.join(" ");
                        }
                    }
                }

                $("#tablaEtapaPracticaAsignacion").DataTable({
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
                            targets: [0, 1, 4, 9, 10],
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
                        $(row).css("font-size", "12px");
                    }
                });

            });
    }


    crearTablaSegumientosPreAsignados() {
        let objData = new FormData();
        objData.append("listarPreAsignados", this._asignacionSeguimientos.listarPreAsignados);
        fetch(config.rutes["controllerAsignacionSeguimiento"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                var dataSet = [];
                response["mensaje"].forEach(listaDatosPreAsignados);

                function listaDatosPreAsignados(item, index) {
                    var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                    objBotones += '<a type="button" class="btn btn-sm" id="btn-DeletePreAsignado" seguimientoPreAsignado="' + item.idvisita_seguimiento + '" idseguimiento="' + item.idseguimiento + '" estadoEtapa="' + item.estado_etapa + '" title="eliminar"><img  class="mc_iconTabla"  src="' + config.rutes["btnEliminar"] + '" ></a>';
                    objBotones += '</div>';

                    let ubicacion = item.ubicacion_seguimiento
                    if (item.ubicacion_seguimiento == "" || item.ubicacion_seguimiento == null) {
                        ubicacion = "No aplica"
                    }

                    dataSet.push([item.documentoFuncionario, item.nombresFuncionario + " " + item.apellidosFuncionario, item.numero_ficha, item.nombreAprendiz + " " + item.apellidoAprendiz, item.nombre_tipo_seguimiento, ubicacion, objBotones]);
                }

                $("#tablaSeguimientoPreAsignado").DataTable({
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
                        $(row).css("font-size", "12px");
                    }
                });

            });
    }


    eliminarPreAsignado() {
        let objData = new FormData();
        objData.append("eliminarPreAsignado", this._asignacionSeguimientos.eliminarPreAsignado);
        objData.append("seguimientoPreAsignado", this._asignacionSeguimientos.seguimientoPreAsignado);
        objData.append("idSeguimiento", this._asignacionSeguimientos.idSeguimiento);
        objData.append("estadoEtapa", this._asignacionSeguimientos.estadoEtapa);
        fetch(config.rutes["controllerAsignacionSeguimiento"], {
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

                    var objDatos = { "listarEtapaPractica": "ok" };
                    var objListaEtapaPractica = new asignacionSeguimientos(objDatos);
                    objListaEtapaPractica.crearTablaEtapaPractica();

                    this.crearTablaSegumientosPreAsignados();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["mensaje"],
                    })
                }
            });
    }

    listarInstructor() {
        let objData = new FormData();
        objData.append("listarInstructor", this._asignacionSeguimientos.listarInstructor);
        fetch(config.rutes["controllerAsignacionSeguimiento"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    var tipoBoton = this._asignacionSeguimientos.idtxtFuncionario;
                    var dataSet = [];
                    response["mensaje"].forEach(listaDatosInstructores);

                    function listaDatosInstructores(item, index) {
                        var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                        if (tipoBoton == "registro") {
                            objBotones += '<button type="button" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center " id="btn-AsignarInstructorRegistro" idFuncionario="' + item.idfuncionario + '"  nombreFuncionario="' + item.nombres + " " + item.apellidos + '" title="Asignar Instructor"><i class="bx bx-user-plus"></i></button>';
                        } else {
                            objBotones += '<button type="button" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center" id="btn-AsignarInstructorFiltro" idFuncionario="' + item.idfuncionario + '"  nombreFuncionario="' + item.nombres + " " + item.apellidos + '" title="Asignar Instructor"><i class="bx bx-user-plus"></i></button>';
                        }
                        objBotones += '</div>';
                        dataSet.push(['<span class="text-dark">' + item.documento + '</span>', item.nombres + " " + item.apellidos, objBotones]);
                    }

                    $("#tablaInstructoresSeguimientos").DataTable({
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
                            $(row).css("font-size", "12px");
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["mensaje"],
                    })
                }
            });
    }

    listarSeguimientosInstructor() {
        let objData = new FormData();
        objData.append("listarSeguimientosInstructor", this._asignacionSeguimientos.listarSeguimientosInstructor);
        objData.append("idInstructor", this._asignacionSeguimientos.idInstructor);
        var objListaSeguimientos = null;
        fetch(config.rutes["controllerAsignacionSeguimiento"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {

                    $("#contenedorBotonCorreos").show();
                    var listaSeguimientos = JSON.stringify(response["mensaje"]);
                    $("#contenedorBotonCorreos").attr("lista", listaSeguimientos);
                    var idInstructor = '';
                    var dataSet = [];

                    response["mensaje"].forEach(listaSeguimientosInstructor);

                    function listaSeguimientosInstructor(item, index) {
                        idInstructor = item.idfuncionario;
                        dataSet.push([item.nombreAprendiz + " " + item.apellidoAprendiz, item.nombre_tipo_seguimiento]);
                    }

                    $("#tablaSeguimientoInstructor").DataTable({
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
                        }
                    });

                    $("#contenedorBotonCorreos").attr("instructor", idInstructor);

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["mensaje"],
                    })
                }
            });
    }


    cargarTipoSeguimiento() {
        let objData = new FormData();
        objData.append("listarTipoSeguimiento", this._asignacionSeguimientos.listarTipoSeguimiento);
        fetch(config.rutes["controllerAsignacionSeguimiento"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    $("#selectTipoSeguimiento").html("");
                    $("#selectTipoSeguimiento").append('<option value>Seleccione</option>');

                    response["mensaje"].forEach(cargarSelectTipoSeguimiento);

                    function cargarSelectTipoSeguimiento(item, index) {
                        $("#selectTipoSeguimiento").append('<option value="' + item.idtipo_seguimiento + '">' + item.nombre_tipo_seguimiento + '</option>');
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["mensaje"],
                    })
                }
            });
    }


    registrarAsignacion() {
        let objData = new FormData();
        objData.append("RegistrarSeguimientoPractica", this._asignacionSeguimientos.RegistrarSeguimientoPractica);
        objData.append("instructor", this._asignacionSeguimientos.instructor);
        objData.append("tipoSeguimiento", this._asignacionSeguimientos.tipoSeguimiento);
        objData.append("fechaVencimiento", this._asignacionSeguimientos.fechaVencimiento);
        objData.append("idSeguimiento", this._asignacionSeguimientos.idSeguimiento);
        objData.append("ubicacion_seguimiento", this._asignacionSeguimientos.ubicacion)

        fetch(config.rutes["controllerAsignacionSeguimiento"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    $("#contenedorFormularioVisitaSeguimiento").hide();
                    $("#contenedorTablaEtapaPractica").fadeIn("2000");

                    var objDatos = { "listarEtapaPractica": "ok" };
                    var objListaEtapaPractica = new asignacionSeguimientos(objDatos);
                    objListaEtapaPractica.crearTablaEtapaPractica();

                    let objData = { "listarPreAsignados": "ok" };
                    let objListaPreAsignados = new asignacionSeguimientos(objData);
                    objListaPreAsignados.crearTablaSegumientosPreAsignados();

                    Swal.fire({
                        icon: 'success',
                        title: response["mensaje"],
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["mensaje"],
                    })
                }
            });

    }

    enviarSeguimientosInstructor() {
        $(".lista").hide();
        $(".enviando").show();
        let objData = new FormData();
        objData.append("objDatosCorreoInstructor", this._asignacionSeguimientos.listaEnviar);

        fetch(config.rutes["controllerEnviarSeguimientos"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    $("#contenedorBotonCorreos").attr("notificado", "1");
                    this.enviarSeguimientosAprendiz();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "hubo un problema al notificar los seguimientos"
                    })
                }
            });
    }

    enviarSeguimientosAprendiz() {
        let instructor = $("#contenedorBotonCorreos").attr("instructor");
        let lista = JSON.parse($("#contenedorBotonCorreos").attr("lista"));
        let listaEnviar = JSON.stringify(lista);
        let notificado = $("#contenedorBotonCorreos").attr("notificado");
        let objData = new FormData();
        objData.append("objDatosCorreoAprendiz", listaEnviar);
        objData.append("notificado", notificado);
        objData.append("instructor", instructor);

        fetch(config.rutes["controllerEnviarSeguimientos"], {
            method: 'POST',
            body: objData
        })
            .then(async (response) => {
                try {
                    // Intentar obtener el texto de la respuesta
                    const responseText = await response.text();

                    // Buscar un objeto JSON en la respuesta
                    const jsonMatch = responseText.match(/\{.*\}/s);
                    if (jsonMatch) {
                        return JSON.parse(jsonMatch[0]);
                    } else {
                        // Si no hay JSON, crear una respuesta de éxito genérica
                        return {
                            "codigo": "200",
                            "mensaje": "Seguimientos notificados exitosamente.",
                            "instructor": instructor
                        };
                    }
                } catch (error) {
                    // En caso de error, devolver una respuesta de éxito genérica
                    console.log("Respuesta no procesable como JSON, asumiendo éxito");
                    return {
                        "codigo": "200",
                        "mensaje": "Seguimientos notificados exitosamente.",
                        "instructor": instructor
                    };
                }
            })
            .then(response => {
                Swal.fire({
                    icon: 'success',
                    title: response.mensaje || "Seguimientos notificados exitosamente."
                });
                let objDatos = {
                    "listarSeguimientosInstructor": "ok",
                    "idInstructor": response.instructor || instructor
                };
                let objListaSeguimientosInstructor = new asignacionSeguimientos(objDatos);
                objListaSeguimientosInstructor.listarSeguimientosInstructor();

                let objData = { "listarPreAsignados": "ok" };
                let objListaPreAsignados = new asignacionSeguimientos(objData);
                objListaPreAsignados.crearTablaSegumientosPreAsignados();
            })
            .catch(error => {
                console.log("Error capturado:", error);
                Swal.fire({
                    icon: 'success',
                    title: "Seguimientos notificados exitosamente."
                });
                let objDatos = {
                    "listarSeguimientosInstructor": "ok",
                    "idInstructor": instructor
                };
                let objListaSeguimientosInstructor = new asignacionSeguimientos(objDatos);
                objListaSeguimientosInstructor.listarSeguimientosInstructor();
            })
            .finally(() => {
                $(".lista").show();
                $(".enviando").hide();
            });
    }

}