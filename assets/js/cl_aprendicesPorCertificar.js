class aprendicesPorCertificar {
    constructor(objData) {
        this._objData = objData;
    }

    cargarAprendicesPorCertificar() {
        fetch(config.rutes.controllerAprendicesPorCertificar + "?cargarAprendicesPorCertificar=true")
            .then(response => response.json())
            .then(data => {
                let dataSet = [];
                data.forEach(element => {
                    let fotoUrl = element.url_foto ? element.url_foto : "assets/img/interface/profile.png";
                    let imgHtml = `<img src="${fotoUrl}" alt="Foto" style="width: 32px; height: 32px; object-fit: cover;" class="rounded-circle me-2 border">`;
                    const nombres = imgHtml + "<span>" + element.nombres + " " + element.apellidos + "</span>";


                    let infoBase64 = btoa(unescape(encodeURIComponent(JSON.stringify(element))));
                    let btnVerDocumentos = `<button type="button" class="btn btn-primary btn-sm btnVerDocumentos" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver Documentos" data-info="${infoBase64}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-symlink" viewBox="0 0 16 16">
                                            <path d="m11.798 8.271-3.182 1.97c-.27.166-.616-.036-.616-.372V9.1s-2.571-.3-4 2.4c.571-4.8 3.143-4.8 4-4.8v-.769c0-.336.346-.538.616-.371l3.182 1.969c.27.166.27.576 0 .742"/>
                                            <path d="m.5 3 .04.87a2 2 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14h10.348a2 2 0 0 0 1.991-1.819l.637-7A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2m.694 2.09A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09l-.636 7a1 1 0 0 1-.996.91H2.826a1 1 0 0 1-.995-.91zM6.172 2a1 1 0 0 1 .707.293L7.586 3H2.19q-.362.002-.683.12L1.5 2.98a1 1 0 0 1 1-.98z"/>
                                            </svg></button>`;

                    let estadoAprendiz = `<span class="badge bg-info">${element.nombre_estado_aprendiz}</span>`;

                    let numeroFicha = `<strong>${element.numero_ficha}</strong>`;

                    dataSet.push([
                        numeroFicha,
                        element.caracterizacion,
                        element.documento,
                        nombres,
                        element.telefono,
                        element.email,
                        estadoAprendiz,
                        btnVerDocumentos
                    ]);
                });

                $("#tablaAprendicesCertificacion").DataTable({
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
                            // Ocultar por defecto las columnas de Municipio (5), Departamento (6), Empresa (7) y Dirección (8)
                            targets: [1, 4],
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
                        $("#tablaAprendicesCertificacion").closest('.table-responsive').css('visibility', 'visible');
                    }
                });
            })
            .catch(error => console.error('Error:', error));
    }


    informacionAprendizCertificacion() {
        var objData = new FormData();
        objData.append("BuscarAprendiz", "ok");
        objData.append("documento", this._objData.documetoAprendiz);
        fetch(config.rutes["controllerBuscarAprendiz"], {
            method: "POST",
            body: objData,
        })
            .then((response) => response.json())
            .catch((error) => {
                mensaje = error;
            })
            .then((response) => {
                if (response["codigo"] == "200") {
                    let objAprendiz = new BuscarAprendiz();
                    objAprendiz.cargarDatosPersonales(response["informacionAprendiz"], response["etapaPractica"]);
                    objAprendiz.cargarSeguimientos(response["seguimientos"]);
                    objAprendiz.cargarBitacoras(response["bitacoras"]);
                }
            });

    }








}