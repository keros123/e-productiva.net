class aprendizCertificacion {

    constructor(objData) {
        this._objData = objData;
    }

    cambiarEstadoArchivos() {

        let mensajeAlerta = '';
        if (this._objData.estado == "2") {
            mensajeAlerta = 'Tenga en cuenta que al cambiar a estado Aprobado no podra modificarlo nuevamente.';
        } else if (this._objData.estado == "3") {
            mensajeAlerta = 'Tenga en cuenta que al cambiar a estado Rechazado el aprendiz debera subir la documentación requerida nuevamente.';
        }

        Swal.fire({
            title: "Está seguro?",
            text: mensajeAlerta,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, estoy seguro!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                let objArchivo = new FormData();
                objArchivo.append("estadoCertificacion", this._objData.estado);
                objArchivo.append("aprendizCertificacion", this._objData.aprendiz);
                objArchivo.append("archivoCertificacion", this._objData.archivo);
                objArchivo.append("email", this._objData.email);
                if (this._objData.estado == "3") {
                    Swal.fire({
                        title: "Por favor ingrese el motivo de rechazo",
                        input: "text",
                        inputAttributes: {
                            autocapitalize: "off"
                        },
                        showCancelButton: true,
                        confirmButtonText: "Aceptar",
                        cancelButtonText: "Cancelar",
                        showLoaderOnConfirm: true,
                        preConfirm: (novedad) => { },
                        allowOutsideClick: () => !Swal.isLoading()
                    }).then((result) => {
                        if (result.isConfirmed) {
                            objArchivo.append("novedadCertificacion", result.value);
                            fetch(config.rutes["controllerAprendizCertificacion"], {
                                method: 'POST',
                                body: objArchivo
                            })
                                .then(response => response.json()).catch(error => {
                                    mensaje = error;
                                }).then(response => {
                                    let icono = "";
                                    if (response["codigo"] == "200") {
                                        icono = "success";
                                    } else {
                                        icono = "error";
                                    }

                                    Swal.fire({
                                        position: "top-end",
                                        icon: icono,
                                        title: response["mensaje"],
                                        showConfirmButton: false,
                                        timer: 1500
                                    });

                                    let objDatos = { idAprendiz: this._objData.aprendiz };
                                    let objAprendizDocumentos = new fichasCertificacion(objDatos);
                                    objAprendizDocumentos.mostrarDocumentosAprendiz();
                                });
                        } else {
                            this._objData.select.prop("selectedIndex", 0);
                        }
                    });
                } else {
                    fetch(config.rutes["controllerAprendizCertificacion"], {
                        method: 'POST',
                        body: objArchivo
                    })
                        .then(response => response.json()).catch(error => {
                            mensaje = error;
                        }).then(response => {
                            let icono = "";
                            if (response["codigo"] == "200") {
                                icono = "success";
                            } else {
                                icono = "error";
                            }
                            Swal.fire({
                                position: "top-end",
                                icon: icono,
                                title: response["mensaje"],
                                showConfirmButton: false,
                                timer: 1500
                            });

                            let objDatos = { idAprendiz: this._objData.aprendiz };
                            let objAprendizDocumentos = new fichasCertificacion(objDatos);
                            objAprendizDocumentos.mostrarDocumentosAprendiz();
                        });
                }
            } else {
                this._objData.select.prop("selectedIndex", 0);
            }
        });
    }
}