$(function() {

    cargarSelectLogin();
    // cargarTipoFuncionario();

    $('.micheckbox').on('click', function() {
        if ($('.micheckbox').prop('checked')) {
            $('.micheckboxlabel').html('<h6>Aprendiz</h6>');
            $('.funcionario').hide();
            $('.aprendiz').fadeIn(2000);
        } else {
            $('.micheckboxlabel').html('<h6>Funcionario</h6>');
            $('.aprendiz').hide();
            $('.funcionario').fadeIn(2000);
        }
    })

    function cargarSelectLogin() {
        let objDatos = { "id": "#selectDocumento", "id2": "#selectDocumentoEdit" };
        let objSelect = new Usuario(objDatos);
        objSelect.cargarSelectDocumento();
    }

    function cargarTipoFuncionario() {
        let objDatos = { "id": "#selectTipoFuncionario" };
        let objUsuario = new Usuario(objDatos);
        objUsuario.cargarSelectTipoFuncionario();
    }

    'use strict'
    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll("#formAuthenticationFuncionario");

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                    form.classList.add('was-validated')
                } else {
                    event.preventDefault()
                    let usuario = $("#email").val();
                    let password = $("#password").val();
                    let objDatos = { "usuario": usuario, "password": password };
                    let objUsuario = new Usuario(objDatos);
                    objUsuario.autenticarFuncionario();
                }
            }, false)
        })


    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll("#formAuthenticationAprendiz");

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                    form.classList.add('was-validated')
                } else {
                    event.preventDefault()
                    let tipoDocumento = $("#selectDocumento").val();
                    let documento = $("#documento").val();
                    let ficha = $("#ficha").val();
                    let passwordAprendiz = $("#passwordAprendiz").val();
                    let objDatos = { "tipoDocumento": tipoDocumento, "documento": documento, "ficha": ficha, "passwordAprendiz": passwordAprendiz };
                    let objUsuario = new Usuario(objDatos);
                    objUsuario.autenticarAprendiz();
                }
            }, false)
        })

    //modulo_recuperacion_contraseña
    $('.rContrasena').on("click", function() {
        $("#email_recuperar_contrasena").val("");
        $('.cLogin').hide();
        $('.cRecuperacion').fadeIn(2000);
    });

    $('.yRContrasena').on("click", function() {
        $("#codigo_cambio_contrasena").val("")
        $("#new_password").val("");
        $("#confirmar_new_password").val("");
        $('.fRContrasena').hide();
        $('.fCContrasena').fadeIn(2000);
    });

    $("#atrasRecuperacion").on("click", function() {
        $("#email_recuperar_contrasena").val("");
        $('.cLogin').fadeIn(2000);
        $('.cRecuperacion').hide();
    });

    $("#atrasRecuperacionActualizar").on("click", function() {
        $("#codigo_cambio_contrasena").val("")
        $("#new_password").val("");
        $("#confirmar_new_password").val("");
        $('.fRContrasena').fadeIn(2000);
        $('.fCContrasena').hide();
    });


    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll("#formRecuperarContrasena");

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                    form.classList.add('was-validated')
                } else {
                    event.preventDefault()
                    let emailRecuperacion = $("#email_recuperar_contrasena").val();
                    let tipoRecuperacion = "funcionario";
                    let objDatos = { "emailRecuperacion": emailRecuperacion, "tipoRecuperacion": tipoRecuperacion };
                    let objUsuario = new Usuario(objDatos);
                    objUsuario.enviarCodVerificacion();
                }
            }, false)
        })

    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll("#formCambioContrasena");

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                    form.classList.add('was-validated')
                } else {
                    event.preventDefault()
                    let codVerificacion = $("#codigo_cambio_contrasena").val();
                    let newPassword = $("#new_password").val();
                    let confirmarPassword = $("#confirmar_new_password").val();
                    let tipoCambio = "funcionario";

                    if (newPassword == confirmarPassword) {
                        let objDatos = { "codVerificacion": codVerificacion, "confirmarPassword": confirmarPassword, "tipoCambio": tipoCambio };
                        let objUsuario = new Usuario(objDatos);
                        objUsuario.actualizarContrasena();
                    } else {
                        Swal.fire({
                            title: 'Asegurate que tu contraseña coincida',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        })
                    }
                }
            }, false)
        })

    //modulo recueracion contraseña aprendiz

    $('.RecuperarContrasenaAprendiz').on("click", function() {
        $('.cLogin').hide();
        $('.cRecuperacion_aprendiz').fadeIn(2000);
    });

    $('.tengoCodVerificacion').on("click", function() {
        $("#codigo_cambio_contrasena_aprendiz").val("");
        $("#new_password_aprendiz").val("");
        $("#confirmar_new_password_aprendiz").val("");
        $('.formSolicitarCodAprendiz').hide();
        $('.formActualizarContrasena').fadeIn(2000);
    });

    $("#atrasRecuperacion_aprendiz").on("click", function() {
        $("#formSolicitarCodAprendiz")[0].reset();
        $('.cLogin').fadeIn(2000);
        $('.cRecuperacion_aprendiz').hide();
    });

    $("#atrasActualizarContrasena").on("click", function() {
        $('.formSolicitarCodAprendiz').fadeIn(2000);
        $('.formActualizarContrasena').hide();
    });

    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll("#formSolicitarCodAprendiz");

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                    form.classList.add('was-validated')
                } else {
                    event.preventDefault()
                    let emailRecuperacion_aprendiz = $("#email_recuperar_contrasena_aprendiz").val();
                    let documento_aprendiz = $("#txt_documento_recuper_aprendiz").val();
                    let tipoRecuperacion = "aprendiz";
                    let objDatos = { "emailRecuperacion_aprendiz": emailRecuperacion_aprendiz, "documento_aprendiz": documento_aprendiz, "tipoRecuperacion": tipoRecuperacion };
                    let objUsuario = new Usuario(objDatos);
                    objUsuario.enviarCodVerificacion();
                }
            }, false)
        })

    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll("#formActualizarContrasena_aprendiz");

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                    form.classList.add('was-validated')
                } else {
                    event.preventDefault()
                    let codVerificacion = $("#codigo_cambio_contrasena_aprendiz").val();
                    let newPassword = $("#new_password_aprendiz").val();
                    let confirmarPassword = $("#confirmar_new_password_aprendiz").val();
                    let tipoCambio = "aprendiz";

                    if (newPassword == confirmarPassword) {
                        let objDatos = { "codVerificacion": codVerificacion, "confirmarPassword": confirmarPassword, "tipoCambio": tipoCambio };
                        let objUsuario = new Usuario(objDatos);
                        objUsuario.actualizarContrasena();
                    } else {
                        Swal.fire({
                            title: 'Asegurate que tu contraseña coincida',
                            showClass: {
                                popup: 'animate__animated animate__fadeInDown'
                            },
                            hideClass: {
                                popup: 'animate__animated animate__fadeOutUp'
                            }
                        })
                    }
                }
            }, false)
        })

})