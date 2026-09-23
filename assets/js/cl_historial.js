class Historial {
    constructor(objDatos) {
        this._objHistorial = objDatos;
    }

    cargarHistoral() {
        let objData = new FormData();
        objData.append("tipoHistorial", this._objHistorial.tipoHistorial);

        fetch(config.rutes["controllerHistorial"], {
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
            response.forEach(Tabla);

            function Tabla(item, index) {
                dataSet.push([item.fecha_hora_proceso, item.responsable, item.proceso, item.descripcion_proceso]);
            }

            $("#tabla_historial").DataTable({
                buttons: [{
                        extend: 'colvis',
                        text: 'Columnas Visibles'
                    },
                    'excel'
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
}