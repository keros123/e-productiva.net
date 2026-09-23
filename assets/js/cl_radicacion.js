class radicacion {

    constructor(objData) {
        this._objRadicado = objData;
    }

    validarEstadoAprendiz() {
        let objData = new FormData();
        objData.append("infoAprendiz", this._objRadicado.aprendiz);
        fetch(config.rutes["controllerRadicacion"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: "success",
                        title: "Éxito",
                        text: response["mensaje"],
                    });

                    this.listarCertificadosAprendiz(response["aprendiz"]);

                } else if (response["codigo"] == "401") {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: response["mensaje"],
                    });
                } else if (response["codigo"] == "402") {
                    const nodoCertificacion = document.querySelector('#mensajesErrorCertificacion');
                    nodoCertificacion.innerHTML = '';
                    let listaAlertasDocumentos = [];
                    response["listaDocumentos"].forEach(item => {
                        const alerta = document.createElement('div');
                        alerta.className = "alert alert-danger alert-dismissible";
                        alerta.innerHTML = "<strong>Alerta!</strong> " + item["titulo"];
                        const botonCierre = document.createElement('button');
                        botonCierre.className = "btn-close";
                        botonCierre.setAttribute("type", "button");
                        botonCierre.setAttribute("data-bs-dismiss", "alert");
                        alerta.append(botonCierre);
                        listaAlertasDocumentos.push(alerta);
                    });

                    nodoCertificacion.append(...listaAlertasDocumentos);
                    nodoCertificacion.style.display = 'block';
                }
            });
    }


    listarCertificadosAprendiz(aprendiz) {
            let objData = new FormData();
            objData.append("ListarCertificacion", "ok");
            objData.append("aprendiz", aprendiz);
            fetch(config.rutes["controllerCertificacion"], {
                    method: "POST",
                    body: objData,
                })
                .then((response) => response.json())
                .then((response) => {
                        let dataSet = [];
                        response.mensaje.forEach((item) => {
                                    let objBotones = `<div class="btn-group" role="group" aria-label="Basic example">${item.url_documento? `<a type="button" class="btn btn-sm" href="${item.url_documento}" target="_blank" title="Ver Documento"><img class="mc_iconTabla" src="${config.rutes["btnVisualizar"]}"></a>`: ""}<button id="btnModalDocumentos" idcertificacion="${item.idcertificacion}" type="button" class="btn btn-warning btnModalDocumentos" title="Subir Archivo" data-titulodocumento="${item.titulo_documento}" data-bs-toggle="modal" data-bs-target="#modalId"><i class="bx bx-cloud-upload"></i></button>${item.url_documento ? `<button class="btn btn-danger btnEliminarFila" title="Eliminar Fila" data-idcertificacion="${item.idcertificacion}"><i class="bx bx-trash"></i></button>`: ""}</div>`;
                        let estado_archivo = '';
                        if (item["estado_archivo"] == ""){
                            estado_archivo += '<span class="badge bg-label-danger me-1">Sin Radicar</span>';
                        }else if (item["estado_archivo"] == "1"){
                            estado_archivo += '<span class="badge bg-label-success me-1">Radicado</span>';
                        }else if (item["estado_archivo"] == "2"){
                            estado_archivo += '<span class="badge bg-label-info me-1">Aprobado</span>';
                            objBotones = `<div class="btn-group" role="group" aria-label="Basic example">${item.url_documento? `<a type="button" class="btn btn-sm" href="${item.url_documento}" target="_blank" title="Ver Documento"><img class="mc_iconTabla" src="${config.rutes["btnVisualizar"]}" ></a>`: ""}<button id="btnModalDocumentos" idcertificacion="${item.idcertificacion}" type="button" class="btn btn-warning btnModalDocumentos" title="Subir Archivo" data-titulodocumento="${item.titulo_documento}" data-bs-toggle="modal" data-bs-target="#modalId" disabled><i class="bx bx-cloud-upload"></i></button>${item.url_documento ? `<button class="btn btn-danger btnEliminarFila" title="Eliminar Fila" data-idcertificacion="${item.idcertificacion}" disabled><i class="bx bx-trash"></i></button>`: ""}</div>`;
                        }else if (item["estado_archivo"] == "3"){
                            estado_archivo += '<span class="badge bg-label-danger me-1">Rechazado</span>';
                        }

                        let novedad = "";
                        if (item.novedad_archivo == "" || item.novedad_archivo == ""){
                            novedad = "Sin Novedad";
                        }else{
                            novedad = item.novedad_archivo;
                        }

                        dataSet.push([item.titulo_documento, novedad,estado_archivo,objBotones]);
                    })


                    $("#tabla_DocumentosCertificacion").DataTable({
                        destroy: true,
                        data: dataSet,
                        responsive: true,
                        language: {
                          decimal: "",
                          emptyTable: "No hay datos disponibles en la tabla",
                          info: "visualizando _START_ de _END_ para un total de TOTAL registros",
                          infoEmpty: "visualizando 0 de 0 para un total de 0 registros",
                          infoFiltered: "(filtrado de MAX registros)",
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
                    });
            })
            .catch((error) => {
                console.log(error);
            });
    }
}