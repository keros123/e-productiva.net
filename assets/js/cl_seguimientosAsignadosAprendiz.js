class seguimientosAprendiz {
    constructor(objDatos) {
        this._objSeguiAprendiz = objDatos;
    }

    listarSeguimientosAsignados() {
        let objData = new FormData();
        objData.append("listarSeguimientosAsignados", "ok");

        fetch(config.rutes["controllerSeguimientoAprendiz"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                datos(response);
            });

        function datos(response) {
            let dataSet = [];
            let direccionEmpresa = "";
            const contenedorMensaje = document.querySelector("#contenedorMensajeAprendiz");
            $("#contenedorMensajeAprendiz").html("");
            let elemento = null;
            const arrayAlertas = [];
            response.forEach(listarVisitaSeguimientos);

            function listarVisitaSeguimientos(item, index) {
                direccionEmpresa = item.direccion_visita;

                var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                if (item.nombre_estado_visita_seguimiento != "en proceso") {
                    objBotones += '<a type="button" class="btn btn-sm" href="' + item.url_documento + '" target="_blank" title="Ver Documento"><img  class="mc_iconTabla"  src="' + config.rutes["btnVisualizar"] + '" ></a>';
                }
                objBotones += '<a type="button" class="btn btn-sm" idFuncionario="' + item.funcionario_idfuncionario + '" idSeguimiento="' + item.idseguimiento + '" id="btn_encargado" title="Encargado"><img  class="mc_iconTabla"  src="' + config.rutes["btnAsignarEmpresa"] + '" ></a>';
                objBotones += '<a type="button" class="btn btn-sm" visita="' + item.idvisita_seguimiento + '" direccionEmpresa="' + item.direccion_visita + '" id="btn_visita" data-bs-toggle="modal" data-bs-target="#ModalDireccionVisita"><img  class="mc_iconTabla"  src="' + config.rutes["btnEditar"] + '" ></a>';
                objBotones += '</div>';

                let ubicacion = item.ubicacion_seguimiento
                if (item.ubicacion_seguimiento == "" || item.ubicacion_seguimiento == null) {
                    ubicacion = "No aplica"
                }

                if (direccionEmpresa == "" || direccionEmpresa == null) {
                    elemento = document.createElement('div');
                    elemento.className = "alert alert-danger";
                    elemento.setAttribute("role", "alert");
                    elemento.textContent = "Estimado aprendiz, el seguimiento " + item.nombre_tipo_seguimiento.toLowerCase() + " que le fue asignado no posee la dirección de la empresa donde se encuentra realizando su etapa práctica, por favor actualice este dato desde el botón de editar. Recuerde que este dato es fundamental para que el instructor asignado a su seguimiento pueda realizar la debida visita.";
                    arrayAlertas.push(elemento);
                }

                let nombreEncargado = item.nombres + " " + item.apellidos;

                let estadoSeguimiento = ""
                if (item.estado_reporte === "0" || item.estado_reporte === 0) {
                    estadoSeguimiento = "Entregado"
                } else if (item.estado_reporte === "1" || item.estado_reporte === 1) {
                    estadoSeguimiento = "Aprobado"
                } else if (item.estado_reporte === "2" || item.estado_reporte === 2) {
                    estadoSeguimiento = "Rechazado"
                } else {
                    estadoSeguimiento = "Sin documento";
                }

                dataSet.push([item.nombre_tipo_seguimiento, nombreEncargado, item.fecha_radicado, item.fecha_vencimiento, item.fecha_entrega, item.nombre_empresa, item.direccion_visita, ubicacion, estadoSeguimiento, objBotones]);
            }

            if (arrayAlertas.length >= 1) {
                contenedorMensaje.append(...arrayAlertas);
            }


            $("#tabla_seguimientosAsignados").DataTable({
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
                dom: "Bfrtip",
                destroy: true,
                data: dataSet,
                responsive: true,
                columnDefs: [
                    {
                        // Ocultar por defecto las columnas de fecha radicado (2),  Empresa(5)
                        targets: [2, 5],
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
                    $(row).css("font-size", "11.5px"); // Cambia el tamaño de la letra de cada fila
                },
                initComplete: function (settings, json) {
                    // Mostrar la tabla una vez que DataTables ha terminado de inicializarse
                    $("#tabla_seguimientosAsignados").closest('.table-responsive').css('visibility', 'visible');
                }
            });
        }
    }


    editarDireccionEmpresa() {
        let objData = new FormData();
        objData.append("editarDireccionVisita", "ok");
        objData.append("visita", this._objSeguiAprendiz.visita);
        objData.append("direccion", this._objSeguiAprendiz.direccion);

        fetch(config.rutes["controllerSeguimientoAprendiz"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    this.listarSeguimientosAsignados();
                    Swal.fire({
                        icon: 'success',
                        title: response["mensaje"],
                        showConfirmButton: false
                    })
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