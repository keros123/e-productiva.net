
class Informes {

    constructor(objData) {
        this._ObjData = objData;
    }

    ConsolidadoSeguimientosVencidos() {
        let objData = new FormData();
        objData.append("SeguimientosVencidos", this._ObjData.cargarConsolidadoVencidos);

        fetch(config.rutes["controllerInformes"], {
            method: "POST",
            body: objData,
        })
            .then((response) => response.json())
            .catch((error) => {
                let mensaje = error;
            })
            .then((response) => {
                let dataSet = [];
                if (response["codigo"] == 200) {
                    let contador = 0;
                    response["InformeVencidos"].forEach(item => {
                        contador += 1;
                        let reporte = "";
                        if (item.estado_reporte == null || item.estado_reporte == '') {
                            reporte += '<span class="badge bg-label-warning me-1">Sin reporte</span>';
                        } else if (item.estado_reporte == 0) {
                            reporte += '<span class="badge bg-label-primary me-1">Entregado</span>';
                        } else if (item.estado_reporte == 1) {
                            reporte += '<span class="badge bg-label-success me-1">Aprobado</span>';
                        } else {
                            reporte += '<span class="badge bg-label-danger me-1">Rechazado</span>';
                        }

                        dataSet.push([contador, '<span class="text-dark">'+item.nombre_tipo_seguimiento+'</span>', item.fecha_radicado, item.fecha_vencimiento, item.fecha_entrega, reporte, item.documento, '<span class="text-dark">' +item.nombres + " " + item.apellidos+'</span>', item.numero_ficha, item.caracterizacion, item.documento_aprendiz, item.nombres_aprendiz + " " + item.apellidos_aprendiz, item.ubicacion_seguimiento])
                    });
                }

                $("#tabla_informeSeguimientosVencidos").dataTable({
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
                            targets: [0, 6, 9, 10],
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
                    }
                })
            });
    }


    // Consolidado Completo
    ConsolidadoSeguimeintosCompletos() {
        let objData = new FormData;

        objData.append("seguimientosCompletos", this._ObjData.cargarConsolidadoCompleto);

        fetch(config.rutes["controllerInformes"], {
            method: "POST",
            body: objData,
        })
            .then((response) => response.json())
            .catch((error) => {
                let mensaje = error;
            })
            .then((response) => {
                let dataSet = [];
                if (response["codigo"] == 200) {
                    let contador = 0;
                    response["InformeCompleto"].forEach(item => {
                        contador += 1;
                        let reporte = "";
                        if (item.estado_reporte == null || item.estado_reporte == '') {
                            reporte += '<span class="badge bg-label-warning me-1">Sin reporte</span>';
                        } else if (item.estado_reporte == 0) {
                            reporte += '<span class="badge bg-label-primary me-1">Entregado</span>';
                        } else if (item.estado_reporte == 1) {
                            reporte += '<span class="badge bg-label-success me-1">Aprobado</span>';
                        } else {
                            reporte += '<span class="badge bg-label-danger me-1">Rechazado</span>';
                        }

                        dataSet.push([contador, '<span class="text-dark">'+item.nombre_tipo_seguimiento+'</span>', item.fecha_radicado, item.fecha_vencimiento, item.fecha_entrega, reporte, item.documento, '<span class="text-dark">' +item.nombres + " " + item.apellidos+'</span>', item.numero_ficha, item.caracterizacion, item.documento_aprendiz, item.nombres_aprendiz + " " + item.apellidos_aprendiz, item.ubicacion_seguimiento])
                    });
                }

                $("#tabla_informeSeguimientosCompletos").dataTable({
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
                            targets: [0, 6, 9, 10],
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
                    }
                })
            });
    }
}