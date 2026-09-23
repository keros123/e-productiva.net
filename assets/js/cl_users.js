class Usuario {
    constructor(objDatos) {
        this._objUsuario = objDatos;
    }

    cargarSelectDocumento() {
        var objData = new FormData();
        objData.append("cargarSelectDocumento", this._objUsuario.id);

        fetch(config.rutes["controllerUsuarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
                console.log(mensaje);
            }).then(response => {
                let interface_select = '';

                response.forEach(listarSelect);

                function listarSelect(item, index) {
                    interface_select += '<option value="' + item.idtipo_documento + '">' + item.nombre_tipo_documento + '</option>';
                }

                $(this._objUsuario.id).html(interface_select);
                $(this._objUsuario.id2).html(interface_select);
            });
    }

    cargarSelectTipoFuncionario() {
        var objData = new FormData();
        objData.append("cargarSelectTipoFuncionario", this._objUsuario.id);
        fetch(config.rutes["controllerUsuarios"], {
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
                $(this._objUsuario.id).html(interface_select);
            });
    }

    cargarSelectEstadoAprendiz() {
        var objData = new FormData();
        objData.append("cargarSelectEstadoAprendiz", this._objUsuario.id);
        fetch(config.rutes["controllerUsuarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                var interface_select = '';
                response.forEach(listarSelect);

                function listarSelect(item, index) {
                    interface_select += '<option value="' + item.idestado_aprendiz + '">' + item.nombre_estado_aprendiz + '</option>';
                }
                $(this._objUsuario.id).html(interface_select);
                $(this._objUsuario.id2).html(interface_select);
            });
    }


    autenticarFuncionario() {
        let mensaje = "";
        var objData = new FormData();
        objData.append("usuarioFuncionario", this._objUsuario.usuario);
        objData.append("passwordFuncionario", this._objUsuario.password);
        fetch(config.rutes["controllerUsuarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["mensaje"] == "1") {
                    window.location = "inicioInstructor";
                } else if (response["mensaje"] == "2") {
                    window.location = "inicio";
                } else if (response["mensaje"] == "3") {
                    window.location = "empresas";
                } else if (response["mensaje"] == "4") {
                    window.location = "inicio";
                } else if (response["mensaje"] == "5") {
                    window.location = "inicioCertificacion";
                } else if (response["mensaje"] == "6") {
                    window.location = "buscarAprendiz";
                } else if (response["mensaje"] == "7") {
                    window.location = "inicio165";
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error..!',
                        text: response["mensaje"]
                    })
                }
            });
    }


    autenticarAprendiz() {
        let mensaje = "";
        var objData = new FormData();
        objData.append("tipoDocumentoAprendiz", this._objUsuario.tipoDocumento);
        objData.append("documentoAprendiz", this._objUsuario.documento);
        objData.append("fichaAprendiz", this._objUsuario.ficha);
        objData.append("passwordAprendiz", this._objUsuario.passwordAprendiz);
        fetch(config.rutes["controllerUsuarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["mensaje"] == "ok") {
                    window.location = response["ruta"];
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error..!',
                        text: response["mensaje"]
                    })
                }
            });
    }


    TipoDocumento() {
        let objData = new FormData;
        objData.append(this._objUsuario["cargarSelectDocumento"], "ok");
        fetch(config.rutes["controllerUsuarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
                console.log(mensaje);
            }).then(response => {
                var estructuraSelect = '';
                var editarSelect = this._objUsuario["editarSelect"];
                var idTipoDocumento = this._objUsuario["idTipoDocumento"];
                if (editarSelect) {
                    estructuraSelect += '<option value="' + this._objUsuario["idTipoDocumento"] + '">' + this._objUsuario["nombreDocumento"] + '</option>';
                }

                response.forEach(cargarSelectDocumentosAccount);

                function cargarSelectDocumentosAccount(item, index) {
                    if (editarSelect) {
                        if (item.idtipo_documento != idTipoDocumento) {
                            estructuraSelect += '<option value="' + item.idtipo_documento + '">' + item.nombre_tipo_documento + '</option>';
                        }
                    } else {
                        estructuraSelect += '<option value="' + item.idtipo_documento + '"><' + item.nombre_tipo_documento + '></option>';
                    }
                }

                $(this._objUsuario["idSelectHtml"]).html(estructuraSelect);
            });
    }

    enviarCodVerificacion() {
        if (this._objUsuario.tipoRecuperacion == "funcionario") {
            $('.fRContrasena,.politicas_modulo_password').hide();
            $('.enviando').fadeIn();

            var objData = new FormData();
            objData.append("emailRecuperacion", this._objUsuario.emailRecuperacion);
            objData.append("tipoRecuperacion", this._objUsuario.tipoRecuperacion);

            fetch(config.rutes["controllerRUsuarios"], {
                method: 'POST',
                body: objData
            })
                .then(response => response.json()).catch(error => {
                    mensaje = error;
                }).then(response => {
                    if (response["codigo"] == "200") {
                        Swal.fire({
                            title: 'Se ha enviado un codigo de confirmacion a su E-Mail',
                            timer: 2000,
                            showConfirmButton: false,
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            },
                        })

                        $('.enviando').hide();

                        $("#email_recuperar_contrasena").val("");
                        $('.fRContrasena').hide();
                        $('.fCContrasena').fadeIn(2000);
                    } else {
                        Swal.fire({
                            title: response["mensaje"],
                            timer: 2000,
                            showConfirmButton: false,
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        })

                        $('.enviando').hide();

                        $('.fRContrasena,.politicas_modulo_password').fadeIn();
                        $("#email_recuperar_contrasena").val("");
                    }
                });
        } else {
            $('.formSolicitarCodAprendiz,.politicas_modulo_password_aprendiz').hide();
            $('.enviando').fadeIn();

            var objData = new FormData();
            objData.append("emailRecuperacion_aprendiz", this._objUsuario.emailRecuperacion_aprendiz);
            objData.append("documento_aprendiz", this._objUsuario.documento_aprendiz);
            objData.append("tipoRecuperacion_aprendiz", this._objUsuario.tipoRecuperacion);

            fetch(config.rutes["controllerRUsuarios"], {
                method: 'POST',
                body: objData
            })
                .then(response => response.json()).catch(error => {
                    mensaje = error;
                }).then(response => {
                    if (response["codigo"] == "200") {
                        Swal.fire({
                            title: 'Se ha enviado un codigo de confirmacion a su E-Mail',
                            timer: 2000,
                            showConfirmButton: false,
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            },
                        })

                        $('.enviando').hide();

                        $("#formSolicitarCodAprendiz")[0].reset();
                        $('.formSolicitarCodAprendiz').hide();
                        $('.formActualizarContrasena').fadeIn(2000);
                    } else {
                        Swal.fire({
                            title: response["mensaje"],
                            timer: 2000,
                            showConfirmButton: false,
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        })

                        $('.enviando').hide();

                        $('.formSolicitarCodAprendiz,.politicas_modulo_password_aprendiz').fadeIn();
                        $("#formSolicitarCodAprendiz")[0].reset();
                    }
                });
        }
    }

    actualizarContrasena() {
        if (this._objUsuario.tipoCambio == "funcionario") {
            var objData = new FormData();
            objData.append("codVerificacion", this._objUsuario.codVerificacion);
            objData.append("confirmarPassword", this._objUsuario.confirmarPassword);
            objData.append("tipoCambio", this._objUsuario.tipoCambio);

            fetch(config.rutes["controllerRUsuarios"], {
                method: 'POST',
                body: objData
            })
                .then(response => response.json()).catch(error => {
                    mensaje = error;
                }).then(response => {
                    if (response["codigo"] == "200") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Tu contraseña ha sido actualizada correctamente',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        $("#codigo_cambio_contrasena").val("");
                        $("#new_password").val("");
                        $("#confirmar_new_password").val("");
                        $('.fRContrasena').fadeIn();
                        $('.fCContrasena').hide();
                        $('.cLogin').fadeIn(2000);
                        $('.cRecuperacion').hide();
                    } else {
                        Swal.fire({
                            title: response["mensaje"],
                            timer: 2000,
                            showConfirmButton: false,
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        })
                        $('.fRContrasena').fadeIn(2000);
                        $('.fCContrasena').hide();
                    }
                });
        } else {
            var objData = new FormData();
            objData.append("codVerificacion_aprendiz", this._objUsuario.codVerificacion);
            objData.append("confirmarPassword_aprendiz", this._objUsuario.confirmarPassword);
            objData.append("tipoCambio_aprendiz", this._objUsuario.tipoCambio);

            fetch(config.rutes["controllerRUsuarios"], {
                method: 'POST',
                body: objData
            })
                .then(response => response.json()).catch(error => {
                    mensaje = error;
                }).then(response => {
                    if (response["codigo"] == "200") {
                        Swal.fire({
                            icon: 'success',
                            title: 'Tu contraseña ha sido actualizada correctamente',
                            showConfirmButton: false,
                            timer: 2000
                        })
                        $('.formSolicitarCodAprendiz').fadeIn();
                        $('.formActualizarContrasena').hide();
                        $('.cLogin').fadeIn(2000);
                        $('.cRecuperacion_aprendiz').hide();
                    } else {
                        Swal.fire({
                            title: response["mensaje"],
                            timer: 2000,
                            showConfirmButton: false,
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        })
                        $("#codigo_cambio_contrasena_aprendiz").val("");
                        $("#new_password_aprendiz").val("");
                        $("#confirmar_new_password_aprendiz").val("");
                        $('.formSolicitarCodAprendiz').fadeIn(2000);
                        $('.formActualizarContrasena').hide();
                    }
                });
        }

    }

    // segun el tipo de sesion actualiza funcionarios o aprendices
    // si el id de la sesion es superior a 9 modifica datos del aprendiz 
    actualizarDatosUsuarios() {
        let objDataUsuario = new FormData();
        objDataUsuario.append("tipoUsuario", this._objUsuario.tipoUsuario);
        objDataUsuario.append("nombres", this._objUsuario.nombres);
        objDataUsuario.append("apellidos", this._objUsuario.apellidos);
        objDataUsuario.append("tipoDocumento", this._objUsuario.tipoDocumento);
        objDataUsuario.append("numeroDocumento", this._objUsuario.numeroDocumento);
        objDataUsuario.append("numeroDocumentoAnterior", this._objUsuario.numeroDocumentoAnterior);
        objDataUsuario.append("email", this._objUsuario.email);
        objDataUsuario.append("telefono", this._objUsuario.telefono);
        if (this._objUsuario.tipoUsuario <= 9) {
            objDataUsuario.append("municipio", this._objUsuario.municipio);
            objDataUsuario.append("direccion", this._objUsuario.direccion);
        }
        objDataUsuario.append("password", this._objUsuario.password);

        fetch(config.rutes["controllerActualizacionUsuarios"], {
            method: 'POST',
            body: objDataUsuario
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Tus datos se actualizaron correctamente',
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

    cambioContrasenaPrimerInicio() {
        let objData = new FormData();
        objData.append("passwordPrimerInicio", this._objUsuario.password);
        objData.append("idUsuarioPrimerInicio", this._objUsuario.idUsuario);
        objData.append("tipoUsuarioPrimerInicio", this._objUsuario.tipoUsuario);

        fetch(config.rutes["controllerUsuarios"], {
            method: 'POST',
            body: objData
        })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                if (response["codigo"] == "200") {
                    $("#parrafo_primer_inicio").hide();
                    $("#parrafo_noCoincide_password").hide();
                    $("#parrafo_exito").show();
                    setTimeout(function () {
                        window.location = "cerrarSesion";
                    }, 2000)
                } else {
                    $("#mensajes_primer_inicio").css({ "background-color": "red" });
                    $("#parrafo_primer_inicio").hide();
                    $("#parrafo_noCoincide_password").hide();
                    $("#parrafo_error").show();
                    setTimeout(function () {
                        $("#mensajes_primer_inicio").css({ "background-color": "#a493fa" });
                        $("#parrafo_primer_inicio").show();
                        $("#parrafo_error").hide();
                    }, 3000)
                }

                $("#cambio_contrasena_primer_inicio")[0].reset();
            });

    }

}