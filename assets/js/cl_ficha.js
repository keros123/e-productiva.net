class Ficha {
    constructor(objDatos) {
        this._objFichas = objDatos;
    }

    cargarSelectEstadoFicha() {
        var objData = new FormData();
        objData.append("cargarSelectEstadoFicha", this._objFichas.id);
        fetch(config.rutes["controllerFichas"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                var interface_select = '';
                response.forEach(listarSelect);

                function listarSelect(item, index) {
                    interface_select += '<option value="' + item.idestado_ficha + '">' + item.nombre_estado_ficha + '</option>';
                }
                $(this._objFichas.id).html(interface_select);
                $(this._objFichas.id2).html(interface_select);
            });
    }

    agregarFicha() {
        var objData = new FormData();
        objData.append("numeroFicha", this._objFichas.numeroFicha);
        objData.append("caracterizacion", this._objFichas.caracterizacion);
        objData.append("estadoFicha", this._objFichas.estadoFicha);
        objData.append("fechaInicio", this._objFichas.fechaInicio);
        objData.append("finLectiva", this._objFichas.finlectiva);
        objData.append("finPractica", this._objFichas.finPractica);
        objData.append("tipoPrograma", this._objFichas.tipoPrograma);
        objData.append("lineaRedTecnologica", this._objFichas.lineaRedTecnologica);
        fetch(config.rutes["controllerFichas"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    document.getElementById("formAgregarFicha").reset();
                    $(".card_agregarFicha").hide();
                    $(".btn_agregarFicha").fadeIn(2000);
                    $(".card_tablaFichas").fadeIn(2000);
                    $("#tablaFichas").dataTable().fnDestroy();
                    this.cargarTablaFichas();
                    Swal.fire({
                        icon: 'success',
                        title: 'Ficha agregada Correctamente',
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

    cargarTablaFichas() {
        var objData = new FormData();
        objData.append("cargarTablaFichas", "ok");
        fetch(config.rutes["controllerFichas"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                datosTabla(response);
            });


        function datosTabla(response) {
            var dataSet = [];
            response.forEach(listaDatos);

            function listaDatos(item, index) {
                var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                objBotones += '<button type="button" class="btn btn-sm btn-secondary d-flex align-items-center justify-content-center" id="btn-AddAprendizFicha"  idficha="' + item.idficha + '" ficha="' + item.numero_ficha + '" caracterizacion="' + item.caracterizacion + '" title="Aprendices"><i class="bx bx-user-plus mc_iconTabla"></i></button>';
                if ($("#imgUsuarioPerfil").attr("tipo") == "2" || $("#imgUsuarioPerfil").attr("tipo") == "4" || $("#imgUsuarioPerfil").attr("tipo") == "7") {
                    objBotones += '<button type="button" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center" id="btn-VerFormato165" idficha="' + item.idficha + '" ficha="' + item.numero_ficha + '" title="Ver Formato 165"><i class="bx bx-search-alt mc_iconTabla"></i></button>';
                }
                if ($("#imgUsuarioPerfil").attr("tipo") != "6") {
                    objBotones += '<button type="button" class="btn btn-sm btn-info d-flex align-items-center justify-content-center" id="btn-EditFicha" idficha="' + item.idficha + '" ficha="' + item.numero_ficha + '" fIf="' + item.fecha_inicio + '" fIl="' + item.fecha_fin_lectiva + '" fFl="' + item.fecha_fin_practica + '" caracterizacion="' + item.caracterizacion + '" estado="' + item.estado_ficha_idestado_ficha + '" programa="' + item.nombre_programa + " De " + item.duracion_programa + " Meses " + '" duracion="' + item.duracion_programa + '" idPrograma="' + item.idtipo_programa + '" idRedTecnologica="' + item.idred_tecnologica + '" lineaTecnologica="' + item.nombre_linea_tecnologica + '" redTecnologica="' + item.nombre_red_tecnologica + '" title="editar"><i class="bx bx-edit mc_iconTabla"></i></button>';
                    objBotones += '<button type="button" class="btn btn-sm btn-dark d-flex align-items-center justify-content-center" id="btn-DeletFicha" ficha="' + item.idficha + '" fichaCompleta="' + item.numero_ficha + ' - ' + item.caracterizacion + '" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"><i class="bx bx-trash mc_iconTabla"></i></button>';
                }
                if ($("#imgUsuarioPerfil").attr("tipo") == "7") {
                    objBotones += '<button type="button" class="btn btn-sm btn-warning d-flex align-items-center justify-content-center" id="btn-SubirFormato165" idficha="' + item.idficha + '" ficha="' + item.numero_ficha + '" title="Subir Formato 165"><i class="bx bx-upload mc_iconTabla"></i></button>';
                }
                objBotones += '</div>';

                var estado_ficha;
                if ($("#imgUsuarioPerfil").attr("tipo") == "7") {
                    // Para rol 7, mostrar estado del archivo en lugar del estado de la ficha
                    if (item.url_archivo_formato_165 && item.url_archivo_formato_165.trim() !== '') {
                        estado_ficha = '<span class="badge bg-label-info me-1">GFPI-F-165 Cargado</span>';
                    } else {
                        estado_ficha = '<span class="badge bg-label-danger me-1">Sin Archivo</span>';
                    }
                } else {
                    // Para otros roles, mostrar el estado normal de la ficha
                    estado_ficha = '<span class="badge bg-label-primary me-1">' + item.nombre_estado_ficha + '</span>';
                }


                dataSet.push(['<span class="text-dark">' + item.numero_ficha + '</span>', '<span class="text-dark">' + item.caracterizacion + '</span>', item.nombre_linea_tecnologica, item.nombre_red_tecnologica, item.fecha_inicio, item.fecha_fin_lectiva, item.fecha_fin_practica, estado_ficha, objBotones]);
            }


            $("#tablaFichas").DataTable({
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
                columnDefs: [
                    {
                        targets: [2, 3],
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
        }
    }

    cargarFichasTraslado(){
        var objData = new FormData();
        objData.append("cargarTablaFichas", "ok");
        fetch(config.rutes["controllerFichas"], {
            method: 'POST',
            body: objData
        })
        .then(response => response.json()).catch(error => {
            mensaje = error;
        }).then(response => {

            var dataSet = [];
            response.forEach(function (item, index) {
                var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                objBotones += '<button type="button" idficha="' + item.idficha + '" numeroFicha="' + item.numero_ficha + '" ficha="' + item.numero_ficha + ' - ' + item.caracterizacion + '" class="btn btn-sm btn-primary d-grid btn-SelectFichaTraslado"><i class="bx bxs-add-to-queue"></i></button>';
                objBotones += '</div>';

                var estado_ficha = '<span class="badge bg-label-danger me-1">' + item.nombre_estado_ficha + '</span>';

                dataSet.push([item.numero_ficha , item.caracterizacion, objBotones])
            });

            $("#tablaFichasTraslado").DataTable({
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
                },
                rowCallback: function (row, data, index) {
                    $(row).css("font-size", "11.5px");
                }
            });
        });
    }




    eliminarFicha() {
        var objData = new FormData();
        objData.append("idFicha", this._objFichas.idFicha);
        objData.append("EliminarFichaCompleta", this._objFichas.fichaCompleta);

        fetch(config.rutes["controllerFichas"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    $("#tablaFichas").dataTable().fnDestroy();
                    this.cargarTablaFichas();
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro eliminado Correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error ...',
                        text: response["mensaje"],
                    })
                }
            });
    }

    editarFicha() {
        var objData = new FormData();
        objData.append("numeroFichaEdit", this._objFichas.edNumeroFicha);
        objData.append("caracterizacionEdit", this._objFichas.edCracterizacion);
        objData.append("estadoFichaEdit", this._objFichas.edEstadoFicha);
        objData.append("fechaInicioEdit", this._objFichas.edfechaInicio);
        objData.append("finLectivaEdit", this._objFichas.edFinLectiva);
        objData.append("finPracticaEdit", this._objFichas.edFinPractica);
        objData.append("idFichaEdit", this._objFichas.edIdficha);
        objData.append("tipoProgramaEdit", this._objFichas.tipoPrograma);
        objData.append("idRed", this._objFichas.idRed);
        objData.append("fichaCompleta", this._objFichas.fichaCompleta);

        fetch(config.rutes["controllerFichas"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    $(".card_editarFicha").hide();
                    $(".btn_agregarFicha").fadeIn(2000);
                    $(".card_tablaFichas").fadeIn(2000);
                    $("#tablaFichas").dataTable().fnDestroy();
                    this.cargarTablaFichas();
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

    cargarSelectFichas() {
        var objData = new FormData();
        objData.append("cargarSelectFichas", this._objFichas.idTabla);

        fetch(config.rutes["controllerFichas"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                listaFichas(response);
            });

        function listaFichas(response) {
            var dataSet = [];
            response.forEach(function (item, index) {
                var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                objBotones += '<button type="button" idficha="' + item.idficha + '" ficha="' + item.numero_ficha + ' - ' + item.caracterizacion + '" class="btn btn-sm btn-primary d-grid " id="btn-SelectFicha"><i class="bx bxs-add-to-queue"></i></button>';
                objBotones += '</div>';

                var estado_ficha = '<span class="badge bg-label-danger me-1">' + item.nombre_estado_ficha + '</span>';

                dataSet.push([item.numero_ficha + ' - ' + item.caracterizacion, estado_ficha, objBotones])
            });

            $("#tablaSelectFichas").DataTable({
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

    addAprendizFicha() {
        var objData = new FormData();
        objData.append("idFicha", this._objFichas.idfichaAp);
        objData.append("ficha", this._objFichas.fichaAp);
        objData.append("caracterizacion", this._objFichas.caracterizacionAp);
        objData.append("peticion", "js");
        fetch(config.rutes["controllerEncriptar"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    window.location = config.rutes["vistaFichaAprendiz"] + '?m~' + response["idFicha"] + '?m~' + response["ficha"] + '?m~' + response["caracterizacion"];
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["mensaje"],
                    })
                }
            });
    }


    cargarAprendicesFichaSeleccionada() {
        let fichaSeleccionada = this._objFichas.idListarFichasAprendiz;
        let objData = new FormData();
        objData.append("fichaAprendicesSelecionada", fichaSeleccionada);
        fetch(config.rutes["controllerFichas"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    this.cargarDatosFichaSeleccionada(response["mensaje"]);
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["mensaje"],
                    })
                }
            });
    }


    cargarDatosFichaSeleccionada(data) {

        var dataSet = [];

        data.forEach(listaDatos);

        function listaDatos(item, index) {
            var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';

            // objBotones += '<a type="button" class="btn btn-sm" id="btnVisualizar" idaprendiz="' + item.idaprendiz + '" title="Visualizar"><img  class="mc_iconTabla"  src="' + config.rutes["btnVisualizar"] + '" ></button>';
            if ($("#imgUsuarioPerfil").attr("tipo") != "6") {
                objBotones += '<button type="button" class="btn btn-sm btn-info d-flex align-items-center justify-content-center" id="btnEditAprendizFichaSeleccionada" idaprendiz="' + item.idaprendiz + '" numeroFicha="' + item.numero_ficha + '" ficha="' + item.numero_ficha + "-" + item.caracterizacion + '" idficha="' + item.ficha_idficha + '" tipodoc="' + item.tipo_documento_idtipo_documento + '" documento="' + item.documento + '" nombres="' + item.nombres + '" apellidos="' + item.apellidos + '" telefono="' + item.telefono + '" email="' + item.email + '" estado="' + item.estado_aprendiz_idestado_aprendiz + '" title="Editar"><i class="bx bx-edit mc_iconTabla"></i></button>';
                objBotones += '<button type="button" class="btn btn-sm btn-dark d-flex align-items-center justify-content-center" id="btnElimAprendizFichaSeleccionada" aprendiz="' + item.idaprendiz + '" nombreCompleto="' + item.nombres + ' ' + item.apellidos + ' con numero de identificación ' + item.documento + '" fichaCompleta="' + item.numero_ficha + ' - ' + item.caracterizacion + '" title="Eliminar"><i class="bx bx-trash mc_iconTabla"></i></button>';
            }
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
                estado_aprendiz = '<span class="badge bg-label-danger me-1">' + item.nombre_estado_aprendiz + '</span>';
            } else if (item.idestado_aprendiz == 6) {
                estado_aprendiz = '<span class="badge bg-label-info me-1">' + item.nombre_estado_aprendiz + '</span>';
            } else if (item.idestado_aprendiz == 8) {
                estado_aprendiz = '<span class="badge bg-label-info me-1">' + item.nombre_estado_aprendiz + '</span>';
            } else if (item.idestado_aprendiz == 9) {
                estado_aprendiz = '<span class="badge bg-label-warning me-1">' + item.nombre_estado_aprendiz + '</span>';
            } else if (item.idestado_aprendiz == 9) {
                estado_aprendiz = '<span class="badge bg-label-success text-black me-1">' + item.nombre_estado_aprendiz + '</span>';
            } else if (item.idestado_aprendiz == 10) {
                estado_aprendiz = '<span class="badge bg-label-success me-1">' + item.nombre_estado_aprendiz + '</span>';
            }

            dataSet.push([item.documento, item.nombres, item.apellidos, item.telefono, item.email, estado_aprendiz, objBotones]);
        }


        $("#tablaAprendizFichaSeleccionada").DataTable({
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

    }


    eliminarAprendizFichaSeleccionada() {
        var objData = new FormData();
        objData.append("idAprendiz", this._objFichas.idAprendiz);
        objData.append("nombreCompletoEliminar", this._objFichas.nombreCompleto);
        objData.append("fichaCompletaEliminar", this._objFichas.fichaCompleta);
        fetch(config.rutes["controllerAprendiz"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    this.cargarAprendicesFichaSeleccionada();
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
    //modulo actualizado
    cargarTablaTipoPrograma() {
        var objData = new FormData();
        objData.append("CargarTipoPrograma", this._objFichas.idTabla);
        fetch(config.rutes["controllerFichas"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                Datos(response);
            });

        function Datos(response) {
            var dataSet = [];
            response.forEach(recorrerDatos);

            function recorrerDatos(item, index) {

                var objBoton = '<div class="d-grid gap-2 d-md-block">';
                // Renderizar solo el botón correspondiente al modo actual
                if (typeof modoModal === "undefined" || modoModal === "agregar") {
                    objBoton += '<a id="btn_seleccionarPrograma_agregar" programa="' + item.nombre_programa + '" duracion="' + item.duracion_programa + '" idPrograma="' + item.idtipo_programa + '" class="btn btn-sm btn-primary mc_iconTabla btn_seleccionarPrograma_agregar" href="#" role="button"><i class="bx bxs-add-to-queue"></i></a>';
                } else {
                    objBoton += '<a id="btn_seleccionarPrograma_editar" programa="' + item.nombre_programa + '" duracion="' + item.duracion_programa + '" idPrograma="' + item.idtipo_programa + '" class="btn btn-sm btn-primary mc_iconTabla btn_seleccionarPrograma_editar" href="#" role="button"><i class="bx bxs-add-to-queue"></i></a>';
                }
                objBoton += '</div>';

                dataSet.push([item.nombre_programa, item.duracion_programa, '<span class="text-dark">'+item.descripcion_programa+'</span>', objBoton]);
            }

            $("#tablaSelectTipoPrograma").DataTable({
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
                },
                rowCallback: function (row, data, index) {
                    $(row).css("font-size", "12px"); // Cambia el tamaño de la letra de cada fila
                }
            })
        }
    }

    subirArchivoFormato165() {
        var objData = new FormData();
        objData.append("archivoFormato165", this._objFichas.archivo);
        objData.append("idFichaFormato165", this._objFichas.idFicha);

        fetch(config.rutes["controllerFichas"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Archivo subido correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    this.cargarTablaFichas();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response["mensaje"]
                    });
                }
            });
    }

    obtenerArchivoFormato165() {
        var objData = new FormData();
        objData.append("obtenerArchivoFormato165", "ok");
        objData.append("idFichaFormato165", this._objFichas.idFicha);

        fetch(config.rutes["controllerFichas"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    window.open(response["mensaje"], '_blank');
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Archivo no encontrado',
                        text: response["mensaje"]
                    });
                }
            });
    }


}