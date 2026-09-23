class asignacionFichas {

    constructor(objDatos) {
        this._objAsignacionFichas = objDatos;
    }

    listarFichasAsignadas() {

        let idfuncionarioListar = $("#btn_asignarFichaInstructor").attr("idFuncionario");
        let objData = new FormData();
        objData.append("idfuncionarioListar", idfuncionarioListar);

        fetch(config.rutes["controllerAsignacionFichas"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                cargarFichasAsignadas(response);
            });

        function cargarFichasAsignadas(response) {
            var dataSet = [];
            response.forEach(listaFichas);

            function listaFichas(item, index) {
                var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                objBotones += '<a type="button" class="btn btn-sm" id="btn_DesasignarFicha" caracterizacion="' + item.caracterizacion + '" idFicha ="' + item.ficha_idficha + '" idFuncionario="' + item.funcionario_idfuncionario + '" fichaCompleta=" numero ' + item.numero_ficha + ' caracterización ' + item.caracterizacion + '" title="Desasignar"><img class="mc_iconTabla" src="' + config.rutes["btnDesasignarFichas"] + '"></a>';
                objBotones += '</div>';
                var estado_ficha = '<span class="badge bg-label-danger me-1">' + item.nombre_estado_ficha + '</span>';
                dataSet.push([item.numero_ficha, item.caracterizacion, estado_ficha, objBotones]);
            }

            $("#tablaFichasAsignadas").DataTable({
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

    cargartablaFichasAsignadas() {
        let objData = new FormData();
        objData.append("cargartablaFichasAsignadas", "ok");

        fetch(config.rutes["controllerAsignacionFichas"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                listaFichasAsignadas(response);
            });

        function listaFichasAsignadas(response) {
            var dataSet = [];
            response.forEach(listaFichas);

            function listaFichas(item, index) {
                var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                objBotones += '<button type="button" idFicha="' + item.idficha + '" fichaCompleta=" numero ' + item.numero_ficha + ' caracterización ' + item.caracterizacion + '" class="btn btn-primary d-grid btn-sm" id="btn_AsignarFichaFuncionario" title="Asignar"><i class="bx bxs-add-to-queue"></i></button>';
                objBotones += '</div>';
                var estado_ficha = '<span class="badge bg-label-danger me-1">' + item.nombre_estado_ficha + '</span>';
                dataSet.push([item.numero_ficha + '-' + item.caracterizacion, estado_ficha, objBotones]);
            }

            $("#tablaAsignarFicha").DataTable({
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

    asignarFichaFuncionario() {
        var idFuncionarioAsignarFicha = $("#btn_asignarFichaInstructor").attr("idFuncionario");
        let objData = new FormData();
        objData.append("idFuncionarioAsignarFicha", idFuncionarioAsignarFicha);
        objData.append("idficha", this._objAsignacionFichas.idficha);
        objData.append("fichaCompleta", this._objAsignacionFichas.fichaCompleta);
        objData.append("instructor", this._objAsignacionFichas.instructor);

        fetch(config.rutes["controllerAsignacionFichas"], {
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
                    this.listarFichasAsignadas();
                    $("#modalAsignarFicha").modal("hide");
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error..!',
                        text: response["mensaje"]
                    })
                    $("#modalAsignarFicha").modal("hide");
                }

            });
    }

    desasignarFicha() {
        let objData = new FormData();
        objData.append("idFuncionarioDesasignar", this._objAsignacionFichas.idFuncionario);
        objData.append("idfichaDesasignar", this._objAsignacionFichas.idFicha);
        objData.append("fichaCompletaDes", this._objAsignacionFichas.fichaCompleta);
        objData.append("instructorDes", this._objAsignacionFichas.instructor);

        fetch(config.rutes["controllerAsignacionFichas"], {
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
                    this.listarFichasAsignadas();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error..!',
                        text: response["mensaje"]
                    })
                }

            });
    }
}