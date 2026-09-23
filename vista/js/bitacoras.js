$(function() {

    const aprendiz = $("#contenedorPrincipal").attr("aprendiz");
    cargarBitacoras();

    'use strict'

    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll('#formularioBitacoras');

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault()
                if (!form.checkValidity()) {
                    event.stopPropagation()
                    form.classList.add('was-validated')
                } else {
                    let razon_social = $("#txt-razonSocialEmpresa").val();
                    let direccion_empresa = $("#txt-direccionEmpresa").val();
                    let telefono_empresa = $("#txt-telefonoEmpresa").val();
                    let email_empresa = $("#txt-emailEmpresa").val();
                    let nombre_jefe = $("#txt-NombreJefe").val();
                    let apellido_jefe = $("#txt-apellidoJefe").val();
                    let telefono_jefe = $("#txt-telefonoJefe").val();
                    let email_jefe = $("#txt-emailJefe").val();
                    let fecha_inicial_practica = $("#txt-fechaInicio").val();
                    let fecha_final_practica = $("#txt-fechaFinal").val();

                    let objData = { "razon_social": razon_social, "direccion_empresa": direccion_empresa, "telefono_empresa": telefono_empresa, "email_empresa": email_empresa, "nombre_jefe": nombre_jefe, "apellido_jefe": apellido_jefe, "telefono_jefe": telefono_jefe, "email_jefe": email_jefe, "fecha_inicial_practica": fecha_inicial_practica, "fecha_final_practica": fecha_final_practica, "registarBitacoras": "ok", "aprendiz": aprendiz };

                    let objRegistrarBitacora = new bitacoras(objData);
                    objRegistrarBitacora.registrarBitacoras();
                }
            }, false)
        })


    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll('#formularioBitacorasEditar');

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault()
                if (!form.checkValidity()) {
                    event.stopPropagation()
                    form.classList.add('was-validated')
                } else {
                    let razon_social = $("#txt-razonSocialEmpresaEdit").val();
                    let direccion_empresa = $("#txt-direccionEmpresaEdit").val();
                    let telefono_empresa = $("#txt-telefonoEmpresaEdit").val();
                    let email_empresa = $("#txt-emailEmpresaEdit").val();
                    let nombre_jefe = $("#txt-NombreJefeEdit").val();
                    let apellido_jefe = $("#txt-apellidoJefeEdit").val();
                    let telefono_jefe = $("#txt-telefonoJefeEdit").val();
                    let email_jefe = $("#txt-emailJefeEdit").val();
                    let fecha_inicial_practica = $("#txt-fechaInicioEdit").val();
                    let fecha_final_practica = $("#txt-fechaFinalEdit").val();
                    let idBitacora = $("#btn_EditarBitacoras").attr("idBitacora");

                    let objData = { "razon_social": razon_social, "direccion_empresa": direccion_empresa, "telefono_empresa": telefono_empresa, "email_empresa": email_empresa, "nombre_jefe": nombre_jefe, "apellido_jefe": apellido_jefe, "telefono_jefe": telefono_jefe, "email_jefe": email_jefe, "fecha_inicial_practica": fecha_inicial_practica, "fecha_final_practica": fecha_final_practica, "editarBitacoras": "ok", "idBitacora": idBitacora, "aprendiz": aprendiz };

                    let objRegistrarBitacora = new bitacoras(objData);
                    objRegistrarBitacora.editarBitacoras();
                }
            }, false)
        })


    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll('#formularioPdfBitacora')

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault()
                if (!form.checkValidity()) {
                    event.stopPropagation()
                    form.classList.add('was-validated')
                } else {
                    let archivo = document.getElementById('txt_file_bitacora').files[0];
                    let idBitacora = $("#btnArchivoBitacora").attr("bitacora");
                    if (archivo != undefined) {
                        let objData = { "archivoBitacora": archivo, "idBitacora": idBitacora, "aprendiz": aprendiz, "subirArchivoBitacoras": "ok" };
                        let objSubirBitacora = new bitacoras(objData);
                        objSubirBitacora.subirArchivoBitacoras();
                    } else {
                        $("#errorFile").html("Por favor, suba el archivo que corresponde a la bitácora.");
                    }
                }
            }, false)
        })

    $("#txt_file_bitacora").on("change", function() {
        $("#errorFile").html("");
    })

    function cargarBitacoras() {
        let objData = { "aprendiz": aprendiz };
        let objBitacoras = new bitacoras(objData);
        objBitacoras.listarBitacoras();
    }

    $("#contenedorBitacoras").on("click", "#btn_cargarFormularioEditar", function() {
        $("#contenedorBitacoras").fadeOut();
        $("#contenedorFormularioEditar").fadeIn();
        $("#txt-razonSocialEmpresaEdit").val($(this).attr("razonSocial"));
        $("#txt-direccionEmpresaEdit").val($(this).attr("direccionEmpresa"));
        $("#txt-telefonoEmpresaEdit").val($(this).attr("telefonoEmpresa"));
        $("#txt-emailEmpresaEdit").val($(this).attr("emailEmpresa"));
        $("#txt-NombreJefeEdit").val($(this).attr("nombreJefe"));
        $("#txt-apellidoJefeEdit").val($(this).attr("apellidoJefe"));
        $("#txt-telefonoJefeEdit").val($(this).attr("telefonoJefe"));
        $("#txt-emailJefeEdit").val($(this).attr("emailJefe"));
        $("#txt-fechaInicioEdit").val($(this).attr("fechaInicioPractica"));
        $("#txt-fechaFinalEdit").val($(this).attr("fechaFinalPractica"));
        $("#btn_EditarBitacoras").attr("idBitacora", $(this).attr("idBitacora"))
    })

    $("#atrasBitacorasEdit").on("click", function() {
        $("#contenedorFormularioEditar").fadeOut();
        $("#contenedorBitacoras").fadeIn();
    })

    $("#contenedorBitacoras").on("click", "#btnModalBitacora", function() {
        $("#bitacoraTitulo").html("Bitácora - " + $(this).attr("codigoBitacora"));
        $("#txt_file_bitacora").val("");
        $("#btnArchivoBitacora").attr("bitacora", $(this).attr("idBitacora"));
        $("#btnArchivoBitacora").attr("codigoBitacora", $(this).attr("codigoBitacora"));
    })

})