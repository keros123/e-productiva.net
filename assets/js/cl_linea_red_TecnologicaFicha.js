class LineaRedTecnologicaFicha {

    constructor(objDatos) {
        this._objLineaRedTecnologica = objDatos;
    }

    listarLineaRedTecnologica() {
        let objData = new FormData();
        objData.append("tabla_linea_red", "#tablaSelectLineaRedTecnologica");

        fetch(config.rutes["controllerLineaRedTecnologica"], {
                method: 'POST',
                body: objData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Error en la respuesta del servidor");
                }
                return response.json();
            })
            .then(response => {
                // Solo se ejecuta si la petición fue exitosa
                datos(response);
            })
            .catch(error => {
                console.error("Ocurrió un error al obtener la línea red tecnológica:", error);
            });

        function datos(response) {
            var dataSet = [];
            
            if (Array.isArray(response)) {
                response.forEach(recorrerDatos);
            }

            function recorrerDatos(item, index) {
                var objBotones = '<div class="" role="group" aria-label="Opciones">';
                
                // NOTA: Se han eliminado los atributos 'id' ('id="btn_..."') porque en un ciclo for 
                // se repiten, rompiendo el estándar HTML y causando fallos en los selectores JS.
                // Los eventos JS deben apuntar a las clases de estos elementos.
                
                objBotones += '<button type="button" class="btn btn-sm btn-primary mc_iconRed btn_seleccionarRedLineaTecnologica" idRedTecnologica="' + item.idred_tecnologica + '" lineaTecnologica="' + item.nombre_linea_tecnologica + '" redTecnologica="' + item.nombre_red_tecnologica + '" title="Seleccionar" style="display: none;"><i class="bx bxs-add-to-queue mc_iconTabla"></i></button>';
                objBotones += '<button type="button" class="btn btn-sm btn-primary mc_iconRed btn_seleccionarRedLineaTecnologica_edit" idRedTecnologica="' + item.idred_tecnologica + '" lineaTecnologica="' + item.nombre_linea_tecnologica + '" redTecnologica="' + item.nombre_red_tecnologica + '" title="Seleccionar" style="display: none;"><i class="bx bx-edit mc_iconTabla"></i></button>';
                
                objBotones += '</div>';

                dataSet.push([item.nombre_linea_tecnologica,'<span class="text-dark">'+item.nombre_red_tecnologica+'</span>' , objBotones]);
            }

            $("#tablaSelectLineaRedTecnologica").DataTable({
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
                },
                drawCallback: function (settings) {
                    // Se ejecuta cada vez que DataTables redibuja la tabla (ej. al cambiar de página)
                    if (window.modoLineaRed === "agregar") {
                        $(".btn_seleccionarRedLineaTecnologica_edit").hide();
                        $(".btn_seleccionarRedLineaTecnologica").show();
                    } else if (window.modoLineaRed === "editar") {
                        $(".btn_seleccionarRedLineaTecnologica_edit").show();
                        $(".btn_seleccionarRedLineaTecnologica").hide();
                    }
                }
            });
        }
    }
}