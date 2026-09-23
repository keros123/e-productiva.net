class fichasInstructor {

    constructor(objDatos) {
        this._objInstructor = objDatos;
    }

    cargarFichasAsignadas() {
        let objData = new FormData();
        objData.append("idInstructor", this._objInstructor.idInstructor);

        fetch(config.rutes["controllerFichasInstructor"], {
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
                objBotones += '<a type="button" class="btn btn-sm" id="btn-verAprendices" idficha="' + item.idficha + '" ficha="' + item.numero_ficha + '" caracterizacion="' + item.caracterizacion + '" title="Ver Aprendices"><img  class="mc_iconTabla"  src="' + config.rutes["btnVerAprendices"] + '" ></a>';
                objBotones += '</div>';
                var estado_ficha = '<span class="badge bg-label-danger me-1">' + item.nombre_estado_ficha + '</span>';
                dataSet.push([item.numero_ficha, item.caracterizacion, item.fecha_inicio, item.fecha_fin_lectiva, item.fecha_fin_practica, estado_ficha, objBotones]);
            }


            $("#tablaFichasAsignadasInstructor").DataTable({
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

    aprendicesAsignadosInstructor() {
        let idFicha = $("#tablaAprendicesAsignadosInstructor").attr("idFicha");
        let objData = new FormData();
        objData.append("idFicha", idFicha);

        fetch(config.rutes["controllerFichasInstructor"], {
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
                let nombreCompleto = item.nombres + ' ' + item.apellidos + ' con numero de identificación ' + item.documento;
                let fichaCompleta = item.numero_ficha + ' - ' + item.caracterizacion;
                let select = selectAval(item.aval, item.idaprendiz, nombreCompleto, fichaCompleta);
                let objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                objBotones += '<a type="button" class="btn btn-sm" id="btnVisualizar" idaprendiz="' + item.idaprendiz + '" title="Visualizar"><img  class="mc_iconTabla"  src="' + config.rutes["btnVisualizar"] + '" ></button>';
                objBotones += '</div>'

                dataSet.push([item.abreviatura_tipo_documento, item.documento, item.nombres, item.apellidos, item.telefono, item.email, select, objBotones]);
            }

            function selectAval(aval, idAprendiz, nombreCompleto, fichaCompleta) {
                let interfaceSelect = '';

                if (aval == "Habilitado" || aval == "") {
                    interfaceSelect += '<select id="selectAval" nombreCompleto="' + nombreCompleto + '" fichaCompleta="' + fichaCompleta + '" class="form-select form-select-sm mb-3" style="color: white; font-size: 14px; background-color: #696cff;">';
                    interfaceSelect += '<option value="Habilitado">Habilitado</option>';
                    interfaceSelect += '<option value="Inhabilitado">Inhabilitado</option>';
                } else {
                    interfaceSelect += '<select id="selectAval" class="form-select form-select-sm mb-3" style="color: white; font-size: 14px; background-color: black;">';
                    interfaceSelect += '<option value="Inhabilitado">Inhabilitado</option>';
                    interfaceSelect += '<option value="Habilitado">Habilitado</option>';
                }
                interfaceSelect += '</select>';
                interfaceSelect += '<div id="datoAvalAprendiz" nombreCompleto="' + nombreCompleto + '" fichaCompleta="' + fichaCompleta + '"  class="d-none" idAprendiz="' + idAprendiz + '"></div>';

                return interfaceSelect;
            }

            $("#tablaAprendicesAsignadosInstructor").DataTable({
                buttons: [{
                        extend: 'colvis',
                        text: 'Columnas Visibles'
                    },
                    'excel',
                    { extend: 'print', text: 'Imprimir' }
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
                }
            });
        }
    }

    actualizarAvalAprendiz() {
        let objData = new FormData();
        objData.append("avalAprendiz", this._objInstructor.avalAprendiz);
        objData.append("idAprendiz", this._objInstructor.idAprendiz);
        objData.append("fichaCompleta", this._objInstructor.fichaCompleta);
        objData.append("nombreCompleto", this._objInstructor.nombreCompleto);

        fetch(config.rutes["controllerFichasInstructor"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Aval del aprendiz actualizado',
                        showConfirmButton: false,
                        timer: 2000
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al actualizar Aval Patrocinio',
                        showConfirmButton: false,
                        timer: 2000
                    })
                }
            });
    }
}