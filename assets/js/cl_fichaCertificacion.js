class fichasCertificacion {
    constructor(objDatos) {
        this._objCertificacion = objDatos;
    }

    cargarTablaFichasCertificacion() {
        var objData = new FormData();
        objData.append("cargarTablaFichasPorCertificar", "ok");

        fetch(config.rutes["controllerFichasPorCertificar"], {
            method: "POST",
            body: objData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Error en la solicitud");
                }
                return response.json();
            })
            .then((response) => {
                datosTabla(response);
            })
            .catch((error) => {
                console.error("Error al cargar la tabla:", error);
            });

        function datosTabla(response) {
            var dataSet = [];
            response.forEach((item, index) => {
                var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                objBotones += '<a type="button" class="btn btn-sm btn-verAprendices" idficha="' + item.idficha + '"ficha="' + item.numero_ficha + '" caracterizacion="' + item.caracterizacion + '" title="Ver Aprendices"><img  class="mc_iconTabla" src="' + config.rutes["btnVerAprendices"] + '" ></a>';
                objBotones += "</div>";
                var estado_ficha = '<span class="badge bg-label-danger me-1">' + item.nombre_estado_ficha + "</span>";

                dataSet.push([
                    item.numero_ficha,
                    item.caracterizacion,
                    item.nombre_linea_tecnologica,
                    item.nombre_red_tecnologica,
                    item.fecha_inicio,
                    item.fecha_fin_lectiva,
                    item.fecha_fin_practica,
                    estado_ficha,
                    objBotones,
                ]);
            });

            $("#tablaFichaCertificacion").DataTable({
                buttons: [{
                    extend: "colvis",
                    text: "Columnas Visibles",
                },
                    "excel",
                { extend: "print", text: "Imprimir" },
                ],
                dom: "Bfrtip",
                destroy: true,
                data: dataSet,
                responsive: true,
                language: {
                    decimal: "",
                    emptyTable: "No hay datos disponibles en la tabla",
                    info: "visualizando _START_ de _END_ para un total de _TOTAL_ registros",
                    infoEmpty: "visualizando 0 de 0 para un total de 0 registros",
                    infoFiltered: "(filtrado de _MAX_ registros)",
                    infoPostFix: "",
                    thousands: ",",
                    lengthMenu: "Mostrar _MENU_ registros",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscar:",
                    zeroRecords: "No se encontraron registros coincidentes",
                    paginate: {
                        first: "Primero",
                        last: "Ultimo",
                        next: "Siguiente",
                        previous: "Anterior",
                    },
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending",
                    },
                },
            });
        }
    }

    cargarTablaAprendices() {
        let idFicha = $("#tablaAprendicesCertificacion").attr("idFicha");
        let objData = new FormData();
        objData.append("idFicha", idFicha);

        fetch(config.rutes["controllerFichasPorCertificar"], {
            method: "POST",
            body: objData,
        })
            .then((response) => response.json())
            .then((response) => {
                mostrarDatosAprendices(response);
            })
            .catch((error) => {
                console.error("Error al cargar la tabla de aprendices:", error);
            });

        function mostrarDatosAprendices(response) {
            var dataSet = [];
            response.forEach((item, index) => {
                let objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                objBotones += '<a type="button" class="btn btn-sm btn-verDocumentos" idAprendiz="' + item.idaprendiz + '"  ficha="' + item.numero_ficha + '" caracterizacion="' + item.caracterizacion + '" title="Ver Documentos"><img  class="mc_iconTabla"  src="' + config.rutes["btnVisualizar"] + '" ></button>';
                objBotones += "</div>";

                dataSet.push([
                    item.abreviatura_tipo_documento,
                    item.documento,
                    item.nombres,
                    item.apellidos,
                    item.telefono,
                    item.email,
                    item.numero_ficha + "-" + item.caracterizacion,
                    item.nombre_modalidad,
                    item.fecha_inicio_practica,
                    item.fecha_fin_practica,
                    objBotones,
                ]);
            });

            $("#tablaAprendicesCertificacion").DataTable({
                buttons: [{
                    extend: "colvis",
                    text: "Columnas Visibles",
                },
                    "excel",
                { extend: "print", text: "Imprimir" },
                ],
                dom: "Bfrtip",
                destroy: true,
                data: dataSet,
                responsive: true,
                language: {
                    decimal: "",
                    emptyTable: "No hay datos disponibles en la tabla",
                    info: "visualizando _START_ de _END_ para un total de _TOTAL_ registros",
                    infoEmpty: "visualizando 0 de 0 para un total de 0 registros",
                    infoFiltered: "(filtrado de _MAX_ registros)",
                    infoPostFix: "",
                    thousands: ",",
                    lengthMenu: "Mostrar _MENU_ registros",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscar:",
                    zeroRecords: "No se encontraron registros coincidentes",
                    paginate: {
                        first: "Primero",
                        last: "Ultimo",
                        next: "Siguiente",
                        previous: "Anterior",
                    },
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending",
                    },
                },
            });
        }
    }

    mostrarDocumentosAprendiz() {
        let idAprendiz = $("#tablaAprendicesCertificacion").attr("idAprendiz");
        let objData = new FormData();
        objData.append("idAprendiz", idAprendiz);

        fetch(config.rutes["controllerFichasPorCertificar"], {
            method: "POST",
            body: objData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Error en la solicitud");
                }
                return response.json();
            })
            .then((response) => {
                if (response.length > 0) {
                    mostrarDocumentos(response);
                } else {
                    Swal.fire({
                        icon: "info",
                        title: "Sin documentos",
                        text: "No hay documentos pendientes de revisión. Es posible que el aprendiz no haya subido archivos o que todos hayan sido rechazados.",
                    });
                }
            })
            .catch((error) => {
                console.error("Error al cargar la tabla de aprendices:", error);
            });

        function mostrarDocumentos(response) {
            let idAprendizDocumentos;
            var dataSet = [];
            response.forEach((item) => {
                let selectEstados = '';
                if (item["estado_archivo"] == "1") {
                    selectEstados += '<select id="selectCertificacionAdmin" aprendiz="' + idAprendiz + '" archivo="' + item.idcertificacion + '" email="' + item.email + '" class="form-select">';
                    selectEstados += '<option value="1">Radicado</option>';
                    selectEstados += '<option value="2">Aprobado</option>';
                    selectEstados += '<option value="3">Rechazado</option>';
                    selectEstados += '</select>';
                } else {
                    if (item["estado_archivo"] == "2") {
                        selectEstados += '<span class="badge bg-label-info me-1">Aprobado</span>';
                    } else if (item["estado_archivo"] == "3") {
                        selectEstados += '<span class="badge bg-label-danger me-1">Rechazado</span>';
                    } else {
                        selectEstados += '<span class="badge bg-label-secondary me-1">Sin Radicar</span>';
                    }
                }

                let novedad = "";
                if (item.novedad_archivo == null || item.novedad_archivo == "") {
                    novedad = "Sin Novedad";
                } else {
                    novedad = item.novedad_archivo;
                }

                idAprendizDocumentos = idAprendiz;
                let urlDocLink = (item.url_documento && item.url_documento !== "")
                    ? "<a href='" + item.url_documento + "' target='_blank' title='visualizar'><img class='mc_iconTabla' src='" + config.rutes["btnVisualizar"] + "'></a>"
                    : "<span class='text-muted small'>Sin archivo</span>";
                let filaDocumento = [item.titulo_documento, novedad, selectEstados, urlDocLink];
                dataSet.push(filaDocumento);
            });

            $("#btnGenerarPdf").attr("aprendiz", idAprendizDocumentos);
            $("#btnCertificar").attr("aprendiz", idAprendizDocumentos);
            $("#tablaDocumentosAprendices").DataTable({
                destroy: true,
                data: dataSet,
                responsive: true,
                language: {
                    decimal: "",
                    emptyTable: "No hay datos disponibles en la tabla",
                    info: "visualizando _START_ de _END_ para un total de _TOTAL_ registros",
                    infoEmpty: "visualizando 0 de 0 para un total de 0 registros",
                    infoFiltered: "(filtrado de _MAX_ registros)",
                    infoPostFix: "",
                    thousands: ",",
                    lengthMenu: "Mostrar _MENU_ registros",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscar:",
                    zeroRecords: "No se encontraron registros coincidentes",
                    paginate: {
                        first: "Primero",
                        last: "Ultimo",
                        next: "Siguiente",
                        previous: "Anterior",
                    },
                    aria: {
                        sortAscending: ": activate to sort column ascending",
                        sortDescending: ": activate to sort column descending",
                    },
                },
            });

            $(".fichasAsignadasCertificacion").hide();
            $(".aprendicesCertificacionFicha").hide();
            $(".documentosAprendiz").fadeIn(1500);
        }
    }

    cargarSeguimientosAprendizSeleccionado() {
        var objData = new FormData();
        objData.append("idAprendizSeguimientos", this._objCertificacion.idAprendiz);

        fetch(config.rutes["controllerCertificarAprendiz"], {
            method: "POST",
            body: objData,
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            })
            .then((response) => {
                let datos = '';
                response.forEach((item) => {
                    let urlFotoInstructor = item.url_foto != null ? item.url_foto : "assets/img/interface/profile.png";

                    datos += '<div class="row align-items-center g-3 mb-4">';
                    datos += '<div class="col-auto">';
                    datos += '<img id="fotoInstructor" src="' + urlFotoInstructor + '" class="rounded-circle border" width="70" height="70" alt="Foto instructor">';
                    datos += '</div>';

                    datos += '<div class="col">';
                    datos += '<div class="fw-semibold" id="nombreInstructor">';
                    datos += 'Instructor Encargado : ' + item.nombres + " " + item.apellidos;
                    datos += '</div>';

                    datos += '<div class="small text-muted" id="emailInstructor">';
                    datos += item.email;
                    datos += '</div>';

                    let tipoSeguimiento = '';
                    if (item.tipo_seguimiento_idtipo_seguimiento == 1) {
                        tipoSeguimiento = 'Seguimiento Parcial';
                    } else if (item.tipo_seguimiento_idtipo_seguimiento == 2) {
                        tipoSeguimiento = 'Seguimiento Final';
                    } else if (item.tipo_seguimiento_idtipo_seguimiento == 3) {
                        tipoSeguimiento = 'Seguimiento momento 1';
                    } else if (item.tipo_seguimiento_idtipo_seguimiento == 4) {
                        tipoSeguimiento = 'Seguimiento momento 2';
                    } else if (item.tipo_seguimiento_idtipo_seguimiento == 5) {
                        tipoSeguimiento = 'Seguimiento momento 3';
                    } else if (item.tipo_seguimiento_idtipo_seguimiento == 6) {
                        tipoSeguimiento = 'Seguimiento extraordinario';
                    }

                    let estadoReporte = "";
                    if (item.estado_reporte == "" || item.estado_reporte == null) {
                        estadoReporte = 'Preasignado';
                    } else if (item.estado_reporte == "0") {
                        estadoReporte = 'Entregado';
                    } else if (item.estado_reporte == "1") {
                        estadoReporte = 'Aprobado';
                    } else if (item.estado_reporte == "2") {
                        estadoReporte = 'Rechazado';
                    }

                    datos += '<div class="d-flex flex-wrap gap-2 mt-2 small">';
                    datos += '<span class="badge bg-primary" id="tipoSeguimiento">';
                    datos += tipoSeguimiento;
                    datos += '</span>';

                    datos += '<span class="badge bg-secondary" id="estadoSeguimiento">';
                    datos += estadoReporte;
                    datos += '</span>';

                    if (item.tipo_seguimiento_idtipo_seguimiento == 5) {
                        let textoLink = "";
                        let colorJuicio = "";
                        if (item.url_juicio_evaluativo != "" && item.url_juicio_evaluativo != null) {
                            $("#imagenJuicio").attr("src", item.url_juicio_evaluativo);
                            textoLink = "Evidencia Juicio Evaluativo";
                            colorJuicio = "bg-info";
                        } else {
                            $("#imagenJuicio").attr("src", 'assets/img/interface/folder.png');
                            textoLink = "Juicio Evaluativo Sin Soporte";
                            colorJuicio = "bg-danger";
                        }

                        datos += '<span class="badge ' + colorJuicio + '" id="estadoSeguimiento">';
                        datos += '<a href="#" class="mc-ancor" data-bs-toggle="modal" data-bs-target="#imagenModal">';
                        datos += textoLink;
                        datos += '</a>';
                        datos += '</span>';
                    }
                    datos += '</div>';
                    datos += '</div>';

                    let url = "";
                    let target = "";
                    if (item.url_documento !== null && item.url_documento !== "") {
                        url = item.url_documento;
                        target = 'target = "_Blank"';
                    } else {
                        url = 'javascript:void(0);';
                        target = 'target = ""';
                    }

                    datos += '<div class="col-auto text-end">';
                    datos += '<a id="seguimientosBuscarAprendiz"  href="' + url + '" ' + target + '  class="btn btn-outline-secondary btn-sm" download title="Descargar seguimiento">';
                    datos += '<i class="bi bi-download"></i>';
                    datos += '</a>';
                    datos += '</div>';
                    datos += '</div>';
                })

                $("#seguimientosBuscarAprendizCertificacion").html(datos);
            });
    }
}