class Funcionario {
    constructor(objDatos) {
        this._objFuncionario = objDatos;
    }

    registrarFuncionario() {
        let objData = new FormData();
        objData.append("nombres", this._objFuncionario.nombres);
        objData.append("apellidos", this._objFuncionario.apellidos);
        objData.append("tipoDocumento", this._objFuncionario.tipoDocumento);
        objData.append("nDocumento", this._objFuncionario.nDocumento);
        objData.append("nDocumentoOld", this._objFuncionario.nDocumentoOld);
        objData.append("email", this._objFuncionario.email);
        objData.append("telefono", this._objFuncionario.telefono);
        objData.append("municipio", this._objFuncionario.municipio);
        objData.append("direccion", this._objFuncionario.direccion);
        objData.append("tipoFuncionario", this._objFuncionario.tipoFuncionario);
        fetch(config.rutes["controllerFuncionarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                console.log(error);
            }).then(response => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Funcionario creado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.cargarFuncionarios();
                    $(".tb_funcionarios").fadeIn(2000);
                    $(".formFuncionarioAgregar").hide();
                    $("#btn_agr_funcionario").fadeIn(2000);
                    $("#btn_bloquear_funcionarios").fadeIn(2000);
                    $("#btn_habilitar_funcionarios").fadeIn(2000);
                    $("#formAgregarFuncionario")[0].reset();
                    $("#selectMunicipios").text("");
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error..!',
                        text: response["mensaje"]
                    })
                }
            });
    }


    cargarSelectTipoFuncionario() {
        var objData = new FormData();
        objData.append("cargarSelectTipoFuncionario", this._objFuncionario.id);
        fetch(config.rutes["controllerFuncionarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                var interface_select = '';
                response.forEach(listarSelect);

                function listarSelect(item, index) {
                    interface_select += '<option value="' + item.idtipo_funcionario + '">' + item.nombre_tipo_funcionario + '</option>';
                }
                $(this._objFuncionario.id).html(interface_select);
                $(this._objFuncionario.id2).html(interface_select);
            });
    }

    eliminarFuncionario() {
        var objData = new FormData();
        objData.append("idFuncionario", this._objFuncionario.idFuncionario);
        objData.append("nombreCompleto", this._objFuncionario.nombreCompleto);
        fetch(config.rutes["controllerFuncionarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                console.log(error);
            }).then(response => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro Eliminado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    this.cargarFuncionarios();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error..!',
                        text: response["mensaje"]
                    })
                }
            });
    }

    departamentos() {
        let objData = new FormData;
        if (this._objFuncionario.cargarSelectDepartamentos == "funcionario") {
            objData.append("cargarSelectDepartamentos", "ok");
        } else {
            objData.append("cargarSelectDepartamentosEdit", "ok");
        }
        fetch(config.rutes["controllerFuncionarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                var estructuraSelect = '';
                var editarSelect = this._objFuncionario["editarSelect"];
                var idDepartamento = this._objFuncionario["idDepartamento"];
                if (editarSelect) {
                    estructuraSelect += '<option value="' + this._objFuncionario["idDepartamento"] + '">' + this._objFuncionario["nombreDepartamento"] + '</option>';
                }

                response.forEach(cargarSelectDepartamentos);

                function cargarSelectDepartamentos(item, index) {
                    if (editarSelect) {
                        if (item.codi_depa != idDepartamento) {
                            estructuraSelect += '<option value="' + item.codi_depa + '">' + item.nomb_depa + '</option>';
                        }
                    } else {
                        estructuraSelect += '<option value="' + item.codi_depa + '"><' + item.nomb_depa + '></option>';
                    }
                }

                $(this._objFuncionario["idSelectHtml"]).html(estructuraSelect);
            });
    }



    municipios() {
        let objData = new FormData;
        if (this._objFuncionario.cargarSelectMunicipios == "funcionario") {
            objData.append("cargarSelectMunicipios", "ok");
            objData.append("idDepartamento", this._objFuncionario["idDepartamento"]);
        } else {
            objData.append("cargarSelectMunicipiosEdit1", "ok");
            objData.append("idDepartamentoEdit", this._objFuncionario["idDepartamento"]);
        }

        fetch(config.rutes["controllerFuncionarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                var estructuraSelect = '';
                var editarSelect = this._objFuncionario["editarSelect"];
                var idMunicipio = this._objFuncionario["idMunicipio"];
                if (editarSelect) {
                    estructuraSelect += '<option value="' + this._objFuncionario["idMunicipio"] + '">' + this._objFuncionario["nombreMunicipio"] + '</option>';
                }

                response.forEach(cargarSelectMunicipios);

                function cargarSelectMunicipios(item, index) {
                    if (editarSelect) {
                        if (item.codi_muni != idMunicipio) {
                            estructuraSelect += '<option value="' + item.codi_muni + '">' + item.nomb_muni + '</option>';
                        }
                    } else {
                        estructuraSelect += '<option value="' + item.codi_muni + '">' + item.nomb_muni + '</option>';
                    }
                }

                $(this._objFuncionario["idSelectHtml"]).html(estructuraSelect);
            });
    }

    municipiosedit() {
        let objData = new FormData;
        objData.append("cargarSelectMunicipiosEdit", "ok");
        fetch(config.rutes["controllerFuncionarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                var estructuraSelect = '';
                var editarSelect = this._objFuncionario["editarSelect"];
                var idMunicipio = this._objFuncionario["idMunicipio"];
                if (editarSelect) {
                    estructuraSelect += '<option value="' + this._objFuncionario["idMunicipio"] + '">' + this._objFuncionario["nombreMunicipio"] + '</option>';
                }

                response.forEach(cargarSelectMunicipios);

                function cargarSelectMunicipios(item, index) {
                    if (editarSelect) {
                        if (item.codi_muni != idMunicipio) {
                            estructuraSelect += '<option value="' + item.codi_muni + '">' + item.nomb_muni + '</option>';
                        }
                    } else {
                        estructuraSelect += '<option value="' + item.codi_muni + '">' + item.nomb_muni + '</option>';
                    }
                }

                $(this._objFuncionario["idSelectHtml"]).html(estructuraSelect);
            });
    }


    EditarFuncionario() {
        let objData = new FormData();
        objData.append("idFuncionarioEdit", this._objFuncionario.idFuncionario);
        objData.append("nombresEdit", this._objFuncionario.nombres);
        objData.append("apellidosEdit", this._objFuncionario.apellidos);
        objData.append("tipoDocumentoEdit", this._objFuncionario.tipoDocumento);
        objData.append("nDocumentoEdit", this._objFuncionario.nDocumento);
        objData.append("nDocumentoOldEdit", this._objFuncionario.nDocumentoOld);
        objData.append("emailEdit", this._objFuncionario.email);
        objData.append("telefonoEdit", this._objFuncionario.telefono);
        objData.append("municipioEdit", this._objFuncionario.municipio);
        objData.append("direccionEdit", this._objFuncionario.direccion);
        objData.append("editNombreCompleto", this._objFuncionario.nombreCompleto);
        objData.append("tipoFuncionarioEdit", this._objFuncionario.tipoFuncionario);
        fetch(config.rutes["controllerFuncionarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro Actualizado correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })

                    this.cargarFuncionarios();

                    $("#form_editar_funcionario").hide();
                    $(".formFuncionarioEdit").hide();
                    $(".tb_funcionarios").fadeIn(2000);
                    $("#btn_agr_funcionario").fadeIn(2000);
                    $("#formFuncionarioEdit")[0].reset();
                    $("#selectMunicipiosEdit").val("");
                    this.municipiosedit();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error..!',
                        text: "Hubo un error al Actualizar el Registro"
                    })
                }
            });
    }

    cargarFuncionarios() {
        let objData = new FormData();
        objData.append("cargarFuncionarios", "ok");
        fetch(config.rutes["controllerFuncionarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {

                cargarRegistros(response);

            });

        function cargarRegistros(response) {
            var dataSet = [];
            let funcionario = $("#panelFuncionario").attr("funcionario");

            response.forEach(listarFuncionarios);

            function listarFuncionarios(item, index) {
                var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                if (funcionario != "5") {
                    if ($("#imgUsuarioPerfil").attr("tipo") != "6") {
                        if (item.ingreso <= "1") {
                            objBotones += '<button type="button" class="btn btn-sm btn-secondary d-flex align-items-center justify-content-center" id="btn_Bloqueo" idFuncionario="' + item.idfuncionario + '" ingreso="' + item.ingreso + '" title="Bloquear"><i class="bx bx-lock-open-alt mc_iconTabla"></i></button>';
                        } else if (item.ingreso == "2") {
                            objBotones += '<button type="button" class="btn btn-sm btn-secondary d-flex align-items-center justify-content-center" id="btn_Bloqueo" idFuncionario="' + item.idfuncionario + '" ingreso="' + item.ingreso + '" title="Habilitar"><i class="bx bx-lock-alt mc_iconTabla"></i></button>';
                        }
                    }
                    objBotones += '<button type="button" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center" id="btn_visualizar" idTipoFuncionario="' + item.idtipo_funcionario + '" idFuncionario="' + item.idfuncionario + '" title="Visualizar"><i class="bx bx-search-alt mc_iconTabla"></i></button>';
                    if ($("#imgUsuarioPerfil").attr("tipo") != "6") {
                        // objBotones += '<a type="button" class="btn btn-sm" id="btn_AsignarFicha" tipoFuncionario="' + item.nombre_tipo_funcionario + '" idFuncionario="' + item.idfuncionario + '" nombreCompleto="' + item.nombres + " " + item.apellidos + '" documento="' + item.documento + '" title="Asignación Fichas"><img class="mc_iconTabla" src="' + config.rutes["btnAsignarFichas"] + '"></a>';
                        objBotones += '<button type="button" class="btn btn-sm btn-info d-flex align-items-center justify-content-center" id="btn_EditarFuncionario" nombres="' + item.nombres + '" apellidos="' + item.apellidos + '" tipoDoc="' + item.idtipo_documento + '" documento="' + item.documento + '" email="' + item.email + '" telefono="' + item.telefono + '" municipio="' + item.municipios_codi_muni + '" departamento="' + item.departamentos_codi_depa + '" direccion="' + item.direccion + '" tipoFuncionario="' + item.idtipo_funcionario + '" idFuncionario="' + item.idfuncionario + '" title="Editar"><i class="bx bx-edit mc_iconTabla"></i></button>';
                        objBotones += '<button type="button" class="btn btn-sm btn-dark d-flex align-items-center justify-content-center" id="btn_DeleteFuncionario" idFuncionario="' + item.idfuncionario + '" nombreCompleto="' + item.nombres + ' ' + item.apellidos + ' con numero de identificación ' + item.documento + '" title="Eliminar"><i class="bx bx-trash mc_iconTabla"></i></button>';
                    }
                } else {
                    objBotones += '<button type="button" class="btn btn-sm btn-primary d-flex align-items-center justify-content-center" id="btn_visualizar" idTipoFuncionario="' + item.idtipo_funcionario + '" idFuncionario="' + item.idfuncionario + '" title="Visualizar"><i class="bx bx-search-alt mc_iconTabla"></i></button>';
                }
                objBotones += '</div>';

                var estado_funcionario = '';
                if (item.idtipo_funcionario == 1) {
                    estado_funcionario += '<span class="badge bg-label-primary me-1">' + item.nombre_tipo_funcionario + '</span>';
                } else if (item.idtipo_funcionario == 2) {
                    estado_funcionario += '<span class="badge bg-label-info me-1">' + item.nombre_tipo_funcionario + '</span>';
                } else if (item.idtipo_funcionario == 3) {
                    estado_funcionario += '<span class="badge bg-label-warning me-1">' + item.nombre_tipo_funcionario + '</span>';
                } else if (item.idtipo_funcionario == 4) {
                    estado_funcionario += '<span class="badge bg-label-danger me-1">' + item.nombre_tipo_funcionario + '</span>';
                } else if (item.idtipo_funcionario == 5) {
                    estado_funcionario += '<span class="badge bg-label-info me-1">' + item.nombre_tipo_funcionario + '</span>';
                } else if (item.idtipo_funcionario == 6) {
                    estado_funcionario += '<span class="badge bg-label-secondary me-1">' + item.nombre_tipo_funcionario + '</span>';
                } else if (item.idtipo_funcionario == 7) {
                    estado_funcionario += '<span class="badge bg-label-primary me-1">' + item.nombre_tipo_funcionario + '</span>';
                }

                // Preparar imagen de perfil
                let urlFoto = item.url_foto != null ? item.url_foto : 'assets/img/interface/profile.png';
                let nombreImageHtml = `
                    <div class="d-flex justify-content-start align-items-center">
                        <div class="avatar avatar-sm me-2">
                            <img src="${urlFoto}" alt="Avatar" class="rounded-circle object-fit-cover" style="width: 32px; height: 32px;">
                        </div>
                        <div class="d-flex flex-column">
                            <span class="text-dark fw-medium">${item.nombres} ${item.apellidos}</span>
                        </div>
                    </div>
                `;

                if (funcionario == "5") {
                    if (item.idtipo_funcionario == 1) {
                        dataSet.push([nombreImageHtml, item.email, item.telefono, estado_funcionario, objBotones]);
                    }
                } else {
                    dataSet.push([nombreImageHtml, item.email, item.telefono, estado_funcionario, objBotones]);
                }
            }

            $("#tablaFuncionarios").DataTable({
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
    }


    cambiarIngresoFuncionario() {
        let objData = new FormData();
        objData.append("cambiarIngresoMasivo", this._objFuncionario.cambiarIngresoMasivo);
        objData.append("estadoIngreso", this._objFuncionario.estadoIngreso);
        fetch(config.rutes["controllerUsuarios"], {
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

                    this.cargarFuncionarios();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error..!',
                        text: response["mensaje"]
                    })
                }
            });
    }

    editarIngresoFuncionarioIndividual() {
        let objData = new FormData();
        objData.append("editarIngreso", this._objFuncionario.editarIngreso);
        objData.append("funcionario", this._objFuncionario.funcionario);
        objData.append("ingreso", this._objFuncionario.ingreso);
        let btnNodo = this._objFuncionario.btnBloqueo;
        fetch(config.rutes["controllerFuncionarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    let icono = "";
                    let claseRemover = "";
                    let claseAgregar = "";
                    let titulo = "";

                    if (response["ingreso"] <= 2 && response["ingreso"] > 1) { // Is blocked (2)
                        icono = "<i class='bx bx-lock-alt mc_iconTabla'></i>";
                        claseRemover = "btn-warning"; // Just in case it comes from an old state
                        claseAgregar = "btn-secondary d-flex align-items-center justify-content-center";
                        titulo = "Habilitar";
                    } else { // Is active (1 or less)
                        icono = "<i class='bx bx-lock-open-alt mc_iconTabla'></i>";
                        claseRemover = "btn-secondary";
                        claseAgregar = "btn-secondary d-flex align-items-center justify-content-center";
                        titulo = "Bloquear";
                    }

                    btnNodo.removeClass(claseRemover).addClass(claseAgregar);
                    btnNodo.attr("title", titulo);
                    btnNodo.attr("ingreso", response["ingreso"]);
                    btnNodo.html(icono);

                    Swal.fire({
                        icon: 'success',
                        title: response["mensaje"],
                        showConfirmButton: false,
                        timer: 1500
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