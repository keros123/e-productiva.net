class Aprendiz {
    constructor(objDatos) {
        this._objAprendiz = objDatos;
    }

    agregarAprendiz() {
        var objData = new FormData();
        objData.append("fichaAprendiz", this._objAprendiz.fichaAprendiz);
        objData.append("fichaCompleta", this._objAprendiz.fichaCompleta);
        objData.append("tipoDocAprendiz", this._objAprendiz.tipoDocAprendiz);
        objData.append("documentoAprendiz", this._objAprendiz.documentoAprendiz);
        objData.append("nombresAprendiz", this._objAprendiz.nombresAprendiz);
        objData.append("apellidosAprendiz", this._objAprendiz.apellidosAprendiz);
        objData.append("numeroAprendiz", this._objAprendiz.numeroAprendiz);
        objData.append("emailAprendiz", this._objAprendiz.emailAprendiz);
        objData.append("estadoAprendiz", this._objAprendiz.estadoAprendiz);
        objData.append("fotoAprendiz", this._objAprendiz.fotoAprendiz);
        objData.append("passwordAprendiz", this._objAprendiz.documentoAprendiz);

        fetch(config.rutes["controllerAprendiz"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    $("#txt-fichaAprendiz").val("");
                    $("#txt-fichaAprendiz-0").val("");
                    $("#selectDocumento").val("1");
                    $("#txt-DocumentoAprendiz").val("");
                    $("#txt-NombresAprendiz").val("");
                    $("#txt-ApellidosAprendiz").val("");
                    $("#txt-NumeroAprendiz").val("");
                    $("#txt-EmailAprendiz").val("");
                    $("#selectEstadoAprendiz").val("1");
                    $("#card-formAgregarAprendiz").hide("2000");
                    $("#card-tablaAprendices").fadeIn("2000");
                    $("#agregarAprendiz").fadeIn("2000");
                    $("#contenedorBtnSubirArchivo").fadeIn("2000");

                    // $("#tablaAprendiz").dataTable().fnDestroy();

                    if (this._objAprendiz.ruta == "fichaAprendices") {
                        let objDatos = { "idListarFichasAprendiz": this._objAprendiz.fichaAprendiz };
                        let objFicha = new Ficha(objDatos);
                        objFicha.cargarAprendicesFichaSeleccionada();
                    } else {
                        this.cargarTablaAprendices();
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Aprendiz agregado Correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'hubo un problema al registar los datos!',
                    })
                }
            });
    }

    cargarTablaAprendices() {
        var objData = new FormData();
        objData.append("cargarTablaAprendices", this._objAprendiz.idTabla);

        fetch(config.rutes["controllerAprendiz"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                listaAprendices(response);
            });

        function listaAprendices(response) {
            var dataSet = [];
            response.forEach(listaDatos);

            function listaDatos(item, index) {
                var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                objBotones += '<a type="button" class="btn btn-sm" id="btn-Edit" idaprendiz="' + item.idaprendiz + '" ficha="' + item.numero_ficha + "-" + item.caracterizacion + '" idficha="' + item.ficha_idficha + '" tipodoc="' + item.tipo_documento_idtipo_documento + '" documento="' + item.documento + '" nombres="' + item.nombres + '" apellidos="' + item.apellidos + '" telefono="' + item.telefono + '" email="' + item.email + '" estado="' + item.estado_aprendiz_idestado_aprendiz + '" title="editar"><img  class="mc_iconTabla"  src="' + config.rutes["btnEditar"] + '" ></button>';
                objBotones += '<a type="button" class="btn btn-sm" id="btn-Delet" aprendiz="' + item.idaprendiz + '" nombreCompleto="' + item.nombres + ' ' + item.apellidos + ' con numero de identificación ' + item.documento + '" fichaCompleta="' + item.numero_ficha + ' - ' + item.caracterizacion + '" title="eliminar"><img  class="mc_iconTabla"  src="' + config.rutes["btnEliminar"] + '" ></a>';
                objBotones += '</div>';

                var estado_aprendiz = '';
                if (item.idestado_aprendiz == 1) {
                    estado_aprendiz = '<span class="badge bg-label-success me-1">' + item.nombre_estado_aprendiz + '</span>';
                } else if (item.idestado_aprendiz == 2) {
                    estado_aprendiz = '<span class="badge bg-label-primary me-1">' + item.nombre_estado_aprendiz + '</span>';
                } else if (item.idestado_aprendiz == 3) {
                    estado_aprendiz = '<span class="badge bg-label-danger me-1">' + item.nombre_estado_aprendiz + '</span>';
                } else if (item.idestado_aprendiz == 4) {
                    estado_aprendiz = '<span class="badge bg-label-warning me-1">' + item.nombre_estado_aprendiz + '</span>';
                } else if (item.idestado_aprendiz == 5) {
                    estado_aprendiz = '<span class="badge bg-label-secondary me-1">' + item.nombre_estado_aprendiz + '</span>';
                } else if (item.idestado_aprendiz == 6) {
                    estado_aprendiz = '<span class="badge bg-label-info me-1">' + item.nombre_estado_aprendiz + '</span>';
                } else if (item.idestado_aprendiz == 7) {
                    estado_aprendiz = '<span class="badge bg-label-dark me-1">' + item.nombre_estado_aprendiz + '</span>';
                } else if (item.idestado_aprendiz == 8) {
                    estado_aprendiz = '<span class="badge bg-label-light text-black me-1">' + item.nombre_estado_aprendiz + '</span>';
                } else if (item.idestado_aprendiz == 9) {
                    estado_aprendiz = '<span class="badge bg-label-success text-black me-1">' + item.nombre_estado_aprendiz + '</span>';
                } else if (item.idestado_aprendiz == 10) {
                    estado_aprendiz = '<span class="badge bg-label-success me-1">' + item.nombre_estado_aprendiz + '</span>';
                }

                dataSet.push([item.numero_ficha, item.nombre_tipo_documento, item.documento, item.nombres, item.apellidos, item.telefono, item.email, estado_aprendiz, objBotones]);
            }

            $("#tablaAprendiz").DataTable({
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
    }

    eliminarAprendiz() {
        var objData = new FormData();
        objData.append("idAprendiz", this._objAprendiz.idAprendiz);
        objData.append("nombreCompletoEliminar", this._objAprendiz.nombreCompleto);
        objData.append("fichaCompletaEliminar", this._objAprendiz.fichaCompleta);

        fetch(config.rutes["controllerAprendiz"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    this.cargarTablaAprendices();
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro eliminado Correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'hubo un problema al eliminar el registro!',
                    })
                }
            });
    }

    editarAprendiz() {
        var objData = new FormData();
        objData.append("fichaAprendizEdit", this._objAprendiz.fichaAprendizEdit);
        objData.append("fichaCompletaEdit", this._objAprendiz.fichaCompleta);
        objData.append("nombreCompleto", this._objAprendiz.nombreCompleto);
        objData.append("tipoDocAprendizEdit", this._objAprendiz.tipoDocAprendizEdit);
        objData.append("documentoAprendizEdit", this._objAprendiz.documentoAprendizEdit);
        objData.append("nombresAprendizEdit", this._objAprendiz.nombresAprendizEdit);
        objData.append("apellidosAprendizEdit", this._objAprendiz.apellidosAprendizEdit);
        objData.append("numeroAprendizEdit", this._objAprendiz.numeroAprendizEdit);
        objData.append("emailAprendizEdit", this._objAprendiz.emailAprendizEdit);
        objData.append("estadoAprendizEdit", this._objAprendiz.estadoAprendizEdit);
        objData.append("idAprendizEdit", this._objAprendiz.idAprendizEdit);
        
        // Agregar novedad si existe
        if (this._objAprendiz.novedad) {
            objData.append("novedad", this._objAprendiz.novedad);
        }
    
        fetch(config.rutes["controllerAprendiz"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    $("#card-formEditarAprendiz").hide("2000");
                    $("#card-tablaAprendices").fadeIn("2000");
                    $("#agregarAprendiz").fadeIn("2000");
                    $("#contenedorBtnSubirArchivo").fadeIn("2000");
                    $("#tablaAprendiz").dataTable().fnDestroy();
                    if (this._objAprendiz.ruta == "fichaAprendices") {
                        let objDatos = { "idListarFichasAprendiz": this._objAprendiz.fichaAprendizEdit };
                        let objFicha = new Ficha(objDatos);
                        objFicha.cargarAprendicesFichaSeleccionada();
                    } else {
                        this.cargarTablaAprendices();
                    }
    
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro actualizado Correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'hubo un problema al actualizar el registro!',
                    })
                }
            });
    }

    huellaRegistroMasivo() {
        var objData = new FormData();
        objData.append("registrados", this._objAprendiz.registrados);
        objData.append("ficha", this._objAprendiz.ficha);

        fetch(config.rutes["controllerAprendiz"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {

            });
    }

    cancelarAprendiz () {
        var objData = new FormData();
        objData.append("documentoAprendizCancelado", this._objAprendiz.documentoAprendizCancelado);
        objData.append("idAprendizCancelado", this._objAprendiz.idAprendizCancelado);
        objData.append("fichaCancelado", this._objAprendiz.numeroFicha);
        objData.append("cancelarAprendiz", "ok");

        fetch(config.rutes["controllerAprendiz"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    $("#card-formEditarAprendiz").hide("2000");
                    $("#card-tablaAprendices").fadeIn("2000");
                    $("#agregarAprendiz").fadeIn("2000");
                    $("#contenedorBtnSubirArchivo").fadeIn("2000");
                    $("#tablaAprendiz").dataTable().fnDestroy();
                    if (this._objAprendiz.ruta == "fichaAprendices") {
                        let objDatos = { "idListarFichasAprendiz": this._objAprendiz.fichaAprendizEdit };
                        let objFicha = new Ficha(objDatos);
                        objFicha.cargarAprendicesFichaSeleccionada();
                    } else {
                        this.cargarTablaAprendices();
                    }

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
                        text: response["mensaje"]
                    })
                }
            });
    }
}