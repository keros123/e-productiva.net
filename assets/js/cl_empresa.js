class Empresa {
    constructor(objData) {
        this._objEmpresa = objData;
    }

    listarEmpresas() {
        let objData = new FormData();
        objData.append("listarEmpresas", this._objEmpresa.listarEmpresas);
        fetch(config.rutes["controllerEmpresa"], {
            method: "POST",
            body: objData,
        })
            .then((response) => response.json())
            .catch((error) => {
                mensaje = error;
            })
            .then((response) => {
                let dataSet = [];
                if (response["codigo"] == "200") {
                    response["mensaje"].forEach(crearListaEmpresas);

                    function crearListaEmpresas(item, index) {
                        var objBotones =
                            '<div class="btn-group" role="group" aria-label="Basic example">';
                        objBotones +=
                            '<button type="button" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center" id="btn-EditarEmpresa" empresa="' +
                            item.idempresa +
                            '" nombreEmpresa="' +
                            item.nombre_empresa +
                            '"  codigoDepartamento="' +
                            item.codi_depa +
                            '" nombreDepartamento="' +
                            item.nomb_depa +
                            '"  codigoMunicipio="' +
                            item.codi_muni +
                            '" nombreMunicipio="' +
                            item.nomb_muni +
                            '"  direccionEmpresa="' +
                            item.direccion_empresa +
                            '"  telefonoEmpresa="' +
                            item.telefono_empresa +
                            '"  nitEmpresa="' +
                            item.nit_empresa +
                            '"  title="editar"><i class="bx bx-edit mc_iconTabla"></i></button>';
                        objBotones +=
                            '<button type="button" class="btn btn-sm btn-dark d-flex align-items-center justify-content-center" id="btn-DeleteEmpresa"  empresa="' +
                            item.idempresa +
                            '" empresaCompleta="' +
                            item.nombre_empresa +
                            " Ubicación " +
                            item.nomb_muni +
                            " - " +
                            item.nomb_depa +
                            '" title="eliminar"><i class="bx bx-trash-alt mc_iconTabla"></i></button>';
                        objBotones += "</div>";
                        dataSet.push([
                            '<span class="text-dark">' + item.idempresa + '</span>',
                            '<span class="text-dark">' + item.nit_empresa + '</span>',
                            '<span class="text-dark">' + item.nombre_empresa + '</span>',
                            item.nomb_depa,
                            item.nomb_muni,
                            item.direccion_empresa,
                            item.telefono_empresa,
                            objBotones,
                        ]);
                    }

                    $("#tablaEmpresas").DataTable({
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
                                targets: [3, 4],
                                visible: false,
                            },
                        ],
                        language: {
                            decimal: "",
                            emptyTable: "No hay datos disponibles en la tabla",
                            info: "visualizando _START_ de _END_ para un total de _TOTAL_ registros",
                            infoEmpty: "visualizando 0 de 0 para un total de 0 registros",
                            infoFiltered: "(filtrado de _MAX_ registros)",
                            infoPostFix: "",
                            thousands: ",",
                            lengthMenu: "Mostrar _MENU_ registros",
                            loadingRecords: "Cargando...",
                            processing: "Procesando...",
                            search: "Buscar:",
                            zeroRecords: "No se encontraron registros coincidentes",
                            paginate: {
                                first: "Primero",
                                last: "Ultimo",
                                next: "Siguiente",
                                previous: "Anterior",
                            },
                            aria: {
                                sortAscending: ": activate to sort column ascending",
                                sortDescending: ": activate to sort column descending",
                            },
                        },
                        rowCallback: function (row, data, index) {
                            $(row).css("font-size", "11.5px");
                        }
                    });
                }
            });
    }

    registrarEmpresa() {
        let objData = new FormData();
        objData.append("registrarEmpresa", this._objEmpresa.registrarEmpresa);
        objData.append("nombreEmpresa", this._objEmpresa.nombreEmpresa);
        objData.append("departamento", this._objEmpresa.departamento);
        objData.append("municipio", this._objEmpresa.municipio);
        objData.append("direccionEmpresa", this._objEmpresa.direccionEmpresa);
        objData.append("telefonoEmpresa", this._objEmpresa.telefonoEmpresa);
        objData.append("nitEmpresa", this._objEmpresa.nitEmpresa);

        fetch(config.rutes["controllerEmpresa"], {
            method: "POST",
            body: objData,
        })
            .then((response) => response.json())
            .catch((error) => {
                mensaje = error;
            })
            .then((response) => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: "success",
                        title: response["mensaje"],
                        showConfirmButton: false,
                        timer: 1500,
                    });

                    window.location = "empresas";
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: response["mensaje"],
                    });
                }
            });
    }

    editarEmpresa() {
        let objData = new FormData();
        objData.append("editarEmpresa", this._objEmpresa.editarEmpresa);
        objData.append("idEmpresa", this._objEmpresa.idEmpresa);
        objData.append("nombreEmpresa", this._objEmpresa.nombreEmpresa);
        objData.append("direccionEmpresa", this._objEmpresa.direccionEmpresa);
        objData.append("telefonoEmpresa", this._objEmpresa.telefonoEmpresa);
        objData.append("municipio", this._objEmpresa.municipio);
        objData.append("nitEmpresa", this._objEmpresa.nitEmpresa);

        fetch(config.rutes["controllerEmpresa"], {
            method: "POST",
            body: objData,
        })
            .then((response) => response.json())
            .catch((error) => {
                mensaje = error;
            })
            .then((response) => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: "success",
                        title: response["mensaje"],
                        showConfirmButton: false,
                        timer: 1500,
                    });

                    window.location = "empresas";
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: response["mensaje"],
                    });
                }
            });
    }

    eliminarEmpresa() {
        let objData = new FormData();
        objData.append("eliminarEmpresa", this._objEmpresa.eliminarEmpresa);
        objData.append("idEmpresa", this._objEmpresa.idEmpresa);
        objData.append("empresaCompleta", this._objEmpresa.empresaCompleta);
        fetch(config.rutes["controllerEmpresa"], {
            method: "POST",
            body: objData,
        })
            .then((response) => response.json())
            .catch((error) => {
                mensaje = error;
            })
            .then((response) => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: "success",
                        title: response["mensaje"],
                        showConfirmButton: false,
                        timer: 1500,
                    });

                    window.location = "empresas";
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: response["mensaje"],
                    });
                }
            });
    }

    listarDepartamentos() {
        let objData = new FormData();
        objData.append(
            "cargarSelectDepartamentos",
            this._objEmpresa.listarDepartametos
        );

        fetch(config.rutes["controllerFuncionarios"], {
            method: "POST",
            body: objData,
        })
            .then((response) => response.json())
            .catch((error) => {
                mensaje = error;
            })
            .then((response) => {
                var editarDepartamentos = this._objEmpresa.editarDepartamentos;
                var idSelect = this._objEmpresa.idSelectDepartamento;
                var codigoDepartamento = "";

                if (editarDepartamentos == "ok") {
                    codigoDepartamento = this._objEmpresa.codigoDepartamento;
                    $(idSelect).html("");
                    $(idSelect).append(
                        '<option value="' +
                        codigoDepartamento +
                        '">' +
                        this._objEmpresa.nombreDepartamento +
                        "</option>"
                    );
                } else {
                    $(idSelect).html("");
                    $(idSelect).append("<option>Seleccione</option>");
                }

                response.forEach(crearListaDepartamentos);

                function crearListaDepartamentos(item, index) {
                    if (editarDepartamentos == "ok") {
                        if (item.codi_depa != codigoDepartamento) {
                            $(idSelect).append(
                                '<option value="' +
                                item.codi_depa +
                                '">' +
                                item.nomb_depa +
                                "</option>"
                            );
                        }
                    } else {
                        $(idSelect).append(
                            '<option value="' +
                            item.codi_depa +
                            '">' +
                            item.nomb_depa +
                            "</option>"
                        );
                    }
                }
            });
    }

    listarMunicipios() {
        let objData = new FormData();
        objData.append("cargarSelectMunicipios", "ok");
        objData.append("idDepartamento", this._objEmpresa.idDepartamento);

        fetch(config.rutes["controllerFuncionarios"], {
            method: "POST",
            body: objData,
        })
            .then((response) => response.json())
            .catch((error) => {
                mensaje = error;
            })
            .then((response) => {
                var editarMunicipios = this._objEmpresa.editarMunicipios;
                var idSelect = this._objEmpresa.idSelectMunicipio;
                var codigoMunicipio = "";
                var nombreMunicipio = "";

                $(idSelect).html("");
                if (editarMunicipios == "ok") {
                    codigoMunicipio = this._objEmpresa.codigoMunicipio;
                    nombreMunicipio = this._objEmpresa.nombreMunicipio;
                    $(idSelect).append(
                        '<option value="' +
                        codigoMunicipio +
                        '">' +
                        nombreMunicipio +
                        "</option>"
                    );
                }

                response.forEach(crearListaDepartamentos);

                function crearListaDepartamentos(item, index) {
                    if (editarMunicipios == "ok") {
                        if (codigoMunicipio != item.codi_muni) {
                            $(idSelect).append(
                                '<option value="' +
                                item.codi_muni +
                                '">' +
                                item.nomb_muni +
                                "</option>"
                            );
                        }
                    } else {
                        $(idSelect).append(
                            '<option value="' +
                            item.codi_muni +
                            '">' +
                            item.nomb_muni +
                            "</option>"
                        );
                    }
                }
            });
    }
}