$(function() {
    cargarDocumentoFuncionario();

    $("#txt_imagen").change(function() {
        $("#visualizadorImagenRegistro").show();
        const imagenPrevisualizacion = document.querySelector("#visualizadorImagenRegistro");
        const archivos = document.querySelector("#txt_imagen").files;
        if (!archivos || !archivos.length) {
            $imagenPrevisualizacion.src = "";
            return;
        }
        const primerArchivo = archivos[0];
        // Lo convertimos a un objeto de tipo objectURL
        const objectURL = URL.createObjectURL(primerArchivo);
        // Y a la fuente de la imagen le ponemos el objectURL
        imagenPrevisualizacion.src = objectURL;
    })

    $("#btnGuardarImagen").on("click", function() {
        let imagen = document.getElementById('txt_imagen').files[0];
        let usuario = $(this).attr("usuario");
        let tipoUsuario = $(this).attr("tipoUsuario");
        if (imagen != null) {
            let objDatos = { "archivo": imagen, "usuarioArchivo": usuario, "tipoUsuarioArchivo": tipoUsuario };
            let objArchivo = new Archivos(objDatos);
            objArchivo.subirArchivo();
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Lo sentimos! no es posible modificar la imagen sin subir una primero.',
            })
        }
    })

    function cargarDocumentoFuncionario() {
        let idTipoDocumento = $("#selectAccountDocumento").val();
        let nombreDocumento = $("#selectAccountDocumento option:selected").text();
        let objDatos = { "cargarSelectDocumento": "selectAccountDocumento", "idSelectHtml": "#selectAccountDocumento", "idTipoDocumento": idTipoDocumento, "nombreDocumento": nombreDocumento, "editarSelect": true };
        let objDocumento = new Usuario(objDatos);
        objDocumento.TipoDocumento();
    }

    //actualizacion datos usuario admin y instructor
    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll("#formAccountSettings");

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
                    let tipoUsuario = $("#txt_sesion").val();
                    let nombres = $("#txt_nombres").val();
                    let apellidos = $("#txt_apellidos").val();
                    let tipoDocumento = $("#selectAccountDocumento").val();
                    let numeroDocumento = $("#txt_documento").val();
                    let numeroDocumentoAnterior = $("#txt_documento_old").val();
                    let email = $("#txt_email").val();
                    let telefono = $("#txt_telefono").val();
                    let direccionEmpresa = null;
                    let municipio = null;
                    let direccion = null;
                    if (tipoUsuario <= 9) {
                        municipio = $("#selectAccountMunicipios").val();
                        direccion = $("#txt_direccion").val();
                    }
                    let password = $("#txt_password").val();

                    let objDataUsuario = null;
                    if (tipoUsuario <= 9) {
                        objDataUsuario = { "tipoUsuario": tipoUsuario, "nombres": nombres, "apellidos": apellidos, "tipoDocumento": tipoDocumento, "numeroDocumento": numeroDocumento, "numeroDocumentoAnterior": numeroDocumentoAnterior, "email": email, "telefono": telefono, "municipio": municipio, "direccion": direccion, "password": password };
                    } else {
                        objDataUsuario = { "tipoUsuario": tipoUsuario, "nombres": nombres, "apellidos": apellidos, "tipoDocumento": tipoDocumento, "numeroDocumento": numeroDocumento, "numeroDocumentoAnterior": numeroDocumentoAnterior, "email": email, "telefono": telefono, "password": password };
                    }
                    let objUsuario = new Usuario(objDataUsuario);
                    objUsuario.actualizarDatosUsuarios();
                }
            }, false)
        })


    //primer inicio usuario
    var forms = document.querySelectorAll("#cambio_contrasena_primer_inicio");
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
                    let password = $("#new_password_primer_inicio").val();
                    let confirm_password = $("#confirmar_new_password_primer_inicio").val();

                    if (confirm_password == password) {
                        let idUsuario = $("#btn_contrasena_primer_inicio").attr("idUsuario");
                        let tipoUsuario = $("#btn_contrasena_primer_inicio").attr("tipoUsuario");
                        let objDatos = { "password": confirm_password, "idUsuario": idUsuario, "tipoUsuario": tipoUsuario };
                        let primer_inicio_usuario = new Usuario(objDatos);
                        primer_inicio_usuario.cambioContrasenaPrimerInicio();
                    } else {
                        $("#mensajes_primer_inicio").css({ "background-color": "red" });
                        $("#parrafo_primer_inicio").hide();
                        $("#parrafo_noCoincide_password").show();

                        setTimeout(function() {
                            $("#mensajes_primer_inicio").css({ "background-color": "#a493fa" });
                            $("#parrafo_primer_inicio").show();
                            $("#parrafo_noCoincide_password").hide();
                        }, 3000)
                    }
                }
            }, false)
        })

})