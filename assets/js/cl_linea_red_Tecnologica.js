class linea_red_Tecnologica {

    constructor(objDatos) {
        this._objLineaRedTecnologica = objDatos;
    }

    agregarLineaTecnologica() {
        let objData = new FormData();
        objData.append("lineaTecnologica", this._objLineaRedTecnologica.lineaTecnologica);

        fetch(config.rutes["controllerLineaRedTecnologica"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {

                $("#modalAgregarLineaTecnologica").modal("hide");
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Línea Tecnológica agregada Correctamente',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    this.listarLineaTecnologica();
                    $("#form_lineaTecnologica")[0].reset();
                } else if (response["codigo"] == "201") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'la línea tecnológica ingresada ya existe.',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    $("#form_lineaTecnologica")[0].reset();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'hubo un problema al registar los datos!',
                        showConfirmButton: false,
                        timer: 2500
                    })
                }
            });
    }

    listarLineaTecnologica() {
        let objData = new FormData();
        objData.append("tabla_linea", "#tablaLineaTecnologica");

        fetch(config.rutes["controllerLineaRedTecnologica"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                datos(response);
            });

        function datos(response) {
            var dataSet = [];
            response.forEach(recorrerDatos);

            function recorrerDatos(item, index) {
                var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                objBotones += '<button type="button" class="btn btn-sm btn-secondary d-flex align-items-center justify-content-center" id="btn_RedTecnologica" idLineaTecnologica="' + item.idlinea_tecnologica + '" lineaTecnologica="' + item.nombre_linea_tecnologica + '" title="Ver Red Tecnologica"><i class="bx bx-folder-open mc_iconTabla"></i></button>';
                objBotones += '<button type="button" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center" id="btn_editLinea" idLineaTecnologica="' + item.idlinea_tecnologica + '" lineaTecnologica="' + item.nombre_linea_tecnologica + '" data-bs-toggle="modal" data-bs-target="#modalEditarLineaTecnologica" title="Editar"><i class="bx bx-edit mc_iconTabla"></i></button>';
                objBotones += '<button type="button" class="btn btn-sm btn-dark d-flex align-items-center justify-content-center" id="btn_eliminarLinea" idLineaTecnologica="' + item.idlinea_tecnologica + '" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar" lineaTecnologica="' + item.nombre_linea_tecnologica + '" ><i class="bx bx-trash mc_iconTabla"></i></button>';
                objBotones += '</div>';
                dataSet.push(['<span class="text-dark">' + item.nombre_linea_tecnologica + '</span>', objBotones]);
            }

            $("#tablaLineaTecnologica").DataTable({
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
            })
        }
    }

    editarLineaTecnologica() {
        let objData = new FormData();
        objData.append("editLineaTecnologica", this._objLineaRedTecnologica.lineaTecnologica);
        objData.append("editIdLineaTecnologica", this._objLineaRedTecnologica.id);
        objData.append("editlinea", this._objLineaRedTecnologica.linea);

        fetch(config.rutes["controllerLineaRedTecnologica"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                $("#modalEditarLineaTecnologica").modal("hide")
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Línea Tecnológica actualizada Correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.listarLineaTecnologica();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["mensaje"],
                    })
                }
            });
    }

    eliminarLineaTecnologica() {
        let objData = new FormData();
        objData.append("eliminarIdLineaTecnologica", this._objLineaRedTecnologica.id);
        objData.append("eliminarLineaTecnologica", this._objLineaRedTecnologica.linea);

        fetch(config.rutes["controllerLineaRedTecnologica"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Línea Tecnológica eliminada Correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.listarLineaTecnologica();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["mensaje"]
                    })
                }
            });
    }

    //red tecnologica

    listarRedTecnologica() {
        let lineaTecnologica = $("#agregarRedTecnologica").attr("lineaTecnologica");
        let objData = new FormData();
        objData.append("tabla_red", "#tablaRedTecnologica");
        objData.append("red_lineaTecnologica", lineaTecnologica);

        fetch(config.rutes["controllerLineaRedTecnologica"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                datos(response);
            });

        function datos(response) {
            var dataSet = [];
            response.forEach(recorrerDatos);

            function recorrerDatos(item, index) {
                var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                objBotones += '<button type="button" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center" id="btn_editRed" idRedTecnologica="' + item.idred_tecnologica + '" redTecnologica="' + item.nombre_red_tecnologica + '" data-bs-toggle="modal" data-bs-target="#modalEditarRedTecnologica" title="Editar"><i class="bx bx-edit mc_iconTabla"></i></button>';
                objBotones += '<button type="button" class="btn btn-sm btn-dark d-flex align-items-center justify-content-center" id="btn_eliminarRed" idRedTecnologica="' + item.idred_tecnologica + '" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar" redTecnologica="' + item.nombre_red_tecnologica + '" ><i class="bx bx-trash mc_iconTabla"></i></button>';
                objBotones += '</div>';

                dataSet.push(['<span class="text-dark">' + item.nombre_red_tecnologica + '</span>', objBotones]);
            }

            $("#tablaRedTecnologica").DataTable({
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
            })
        }
    }

    agregarRedTecnologica() {
        let objData = new FormData();
        objData.append("redTecnologica", this._objLineaRedTecnologica.redTecnologica);
        objData.append("lineaDeLaRed", this._objLineaRedTecnologica.linea);
        objData.append("idLineaTecnologica_red", this._objLineaRedTecnologica.id);

        fetch(config.rutes["controllerLineaRedTecnologica"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {

                $("#modalAgregarRedTecnologica").modal("hide");
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Línea Tecnológica agregada Correctamente',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    this.listarRedTecnologica();
                    $("#form_redTecnologica")[0].reset();
                } else if (response["codigo"] == "201") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'la Red tecnológica ingresada ya existe en la línea tecnológica.'
                    })
                    $("#form_redTecnologica")[0].reset();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'hubo un problema al registar los datos!',
                        showConfirmButton: false,
                        timer: 2500
                    })
                }
            });
    }

    editarRedTecnologica() {
        let lineaTecnologica = $("#agregarRedTecnologica").attr("lineaTecnologica");
        let objData = new FormData();
        objData.append("editRedTecnologica", this._objLineaRedTecnologica.redTecnologica);
        objData.append("editIdRedTecnologica", this._objLineaRedTecnologica.id);
        objData.append("editNombreLineaDeLaRed", this._objLineaRedTecnologica.linea);
        objData.append("editNombreRed", this._objLineaRedTecnologica.red);
        objData.append("lineaDeRedTecnologica", lineaTecnologica);

        fetch(config.rutes["controllerLineaRedTecnologica"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                $("#modalEditarRedTecnologica").modal("hide")
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Red Tecnológica actualizada Correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.listarRedTecnologica();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response["mensaje"],
                    })
                }
            });
    }

    eliminarRedTecnologica() {
        let objData = new FormData();
        objData.append("eliminarIdRedTecnologica", this._objLineaRedTecnologica.id);
        objData.append("eliminarRedTecnologica", this._objLineaRedTecnologica.redTecnologica);
        objData.append("eliminarLineaDeLaRed", this._objLineaRedTecnologica.linea);

        fetch(config.rutes["controllerLineaRedTecnologica"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro eliminado Correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.listarRedTecnologica();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'hubo un problema al eliminar los datos!',
                    })
                }
            });
    }
}