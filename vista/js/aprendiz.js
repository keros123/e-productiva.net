$(function () {
    // cargarAprendices();
    cargarEstadoAprendiz();

    function cargarAprendices() {
        let idTabla = "#tablaAprendiz";
        let objDatos = { "idTabla": idTabla };
        let objAprendiz = new Aprendiz(objDatos);
        objAprendiz.cargarTablaAprendices();
    }

    function cargarEstadoAprendiz() {
        let objDatos = { "id": "#selectEstadoAprendiz", "id2": "#selectEstadoAprendizEdit" };
        let objUsuario = new Usuario(objDatos);
        objUsuario.cargarSelectEstadoAprendiz();
    }


    $("#agregarAprendiz").on("click", function () {
        $("#card-formAgregarAprendiz").fadeIn("2000");
        $("#card-tablaAprendices").hide("2000");
        $("#agregarAprendiz").hide("2000");
        $("#contenedorBtnSubirArchivo").hide("2000");
        $("#txt-fichaAprendiz").val("");
        $("#txt-fichaAprendiz-0").val("");
    })

    $("#atrasAprendiz").on("click", function () {
        $("#card-formAgregarAprendiz").hide("2000");
        $("#card-tablaAprendices").fadeIn("2000");
        $("#agregarAprendiz").fadeIn("2000");
        $("#contenedorBtnSubirArchivo").fadeIn("2000");
    })
    $("#atrasAprendizEdit").on("click", function () {
        $("#card-formEditarAprendiz").hide("2000");
        $("#card-tablaAprendices").fadeIn("2000");
        $("#agregarAprendiz").fadeIn("2000");
        $("#contenedorBtnSubirArchivo").fadeIn("2000");
    })


    $("#tablaAprendiz").on("click", "#btn-Edit", function () {
        alert("marcos");
        let idAprendiz = $(this).attr("idaprendiz");
        let ficha = $(this).attr("ficha");
        let numeroFicha = $(this).attr("numeroFicha");
        let idFicha = $(this).attr("idficha");
        let tipoDoc = $(this).attr("tipodoc");
        let documento = $(this).attr("documento");
        let nombres = $(this).attr("nombres");
        let apellidos = $(this).attr("apellidos");
        let telefono = $(this).attr("telefono");
        let email = $(this).attr("email");
        let estado = $(this).attr("estado");


        $("#card-formEditarAprendiz").fadeIn("2000");
        $("#card-tablaAprendices").hide("2000");
        $("#agregarAprendiz").hide("2000");

        $("#btn-EditarAprendiz").attr("aprendiz", idAprendiz);
        $("#btn-EditarAprendiz").attr("nombreCompleto", nombreCompleto);
        $("#txt-fichaAprendizEdit").attr("idFicha", idFicha);
        $("#txt-fichaAprendiz-0Edit").val(ficha);
        $("#txt-fichaAprendiz-0Edit").attr("numeroFicha", numeroFicha);
        $("#txt-fichaAprendiz-0Edit").attr("caracterizacion", ficha);
        $("#selectDocumentoEdit").val(tipoDoc);
        $("#txt-DocumentoAprendizEdit").val(documento);
        $("#txt-NombresAprendizEdit").val(nombres);
        $("#txt-ApellidosAprendizEdit").val(apellidos);
        $("#txt-NumeroAprendizEdit").val(telefono);
        $("#txt-EmailAprendizEdit").val(email);
        $("#selectEstadoAprendizEdit").val(estado);
    })


    $("#selectEstadoAprendizEdit").on("change",function(){
        const objInfoFicha = document.getElementById("txt-fichaAprendiz-0Edit");
        let numeroFicha = objInfoFicha.getAttribute("numeroFicha");
        let fichaCaracterizacion = objInfoFicha.getAttribute("caracterizacion");
        let fichaId = document.getElementById("txt-fichaAprendizEdit").getAttribute("idFicha");
        if ($(this).val() == 4){
            Swal.fire({
                title: "Desea trasladar al aprendiz?",
                text: "Recuerde aque para poder trasladar el aprendiz debera elegir una nueva ficha de Caracterización.",
                icon: "info",
                confirmButtonText: "Aceptar",
            });
            objInfoFicha.value = "";
            $('#btnSeleccionarFichaTraslado').removeClass('mc-spanDeshabilitado');
        }else{
            objInfoFicha.value = fichaCaracterizacion;
            $('#btnSeleccionarFichaTraslado').addClass('mc-spanDeshabilitado');
        }
    })



    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll("#form-agregarAprendiz");

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                if (!form.checkValidity()) {
                    event.stopPropagation()
                    form.classList.add('was-validated')
                } else {
                    let ficha = $("#txt-fichaAprendiz").attr("idFicha");
                    let fichaCompleta = $("#txt-ficha").val();
                    let ruta = $("#txt-fichaAprendiz").attr("ruta");
                    let tipoDoc = $("#selectDocumento").val();
                    let documento = $("#txt-DocumentoAprendiz").val();
                    let nombres = $("#txt-NombresAprendiz").val();
                    let apellidos = $("#txt-ApellidosAprendiz").val();
                    let telefono = $("#txt-NumeroAprendiz").val();
                    let email = $("#txt-EmailAprendiz").val();
                    let estado = $("#selectEstadoAprendiz").val();
                    let passwordAprendiz = $("#txt-DocumentoAprendiz").val();
                    let objDatos = { "fichaAprendiz": ficha, "tipoDocAprendiz": tipoDoc, "documentoAprendiz": documento, "nombresAprendiz": nombres, "apellidosAprendiz": apellidos, "numeroAprendiz": telefono, "emailAprendiz": email, "estadoAprendiz": estado, "ruta": ruta, "passwordAprendiz": passwordAprendiz, "fichaCompleta": fichaCompleta };
                    let objAprendiz = new Aprendiz(objDatos);
                    objAprendiz.agregarAprendiz();
                }
            }, false)
        })



    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll("#form-EditarAprendiz");

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                if (!form.checkValidity()) {
                    event.stopPropagation();
                    form.classList.add('was-validated');
                } else {
                    let ficha = $("#txt-fichaAprendizEdit").attr("idFicha");
                    let fichaCompleta = $("#txt-fichaAprendiz-0Edit").val();
                    let numeroFicha = $("#txt-fichaAprendiz-0Edit").attr("numeroFicha");
                    let ruta = $("#txt-fichaAprendizEdit").attr("ruta");
                    let tipoDoc = $("#selectDocumentoEdit").val();
                    let documento = $("#txt-DocumentoAprendizEdit").val();
                    let nombres = $("#txt-NombresAprendizEdit").val();
                    let apellidos = $("#txt-ApellidosAprendizEdit").val();
                    let telefono = $("#txt-NumeroAprendizEdit").val();
                    let nombreCompleto = $("#btn-EditarAprendiz").attr("nombreCompleto");
                    let email = $("#txt-EmailAprendizEdit").val();
                    let idAprendiz = $("#btn-EditarAprendiz").attr("aprendiz");
                    let estado = $("#selectEstadoAprendizEdit").val();

                    if (estado == "5") {
                        Swal.fire({
                            title: "¿Esta seguro de cancelar este aprendiz?",
                            text: "Este cambio será irreversible, el sistema eliminará, los datos relacionados a este aprendiz.",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Aceptar",
                            cancelButtonText: "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let objDatos = { "numeroFicha": numeroFicha, "ruta": ruta, "fichaAprendizEdit": ficha, "documentoAprendizCancelado": documento, "idAprendizCancelado": idAprendiz };
                                let objAprendiz = new Aprendiz(objDatos);
                                objAprendiz.cancelarAprendiz();
                            }
                        });
                    } else if (estado == "4" || estado == "7" || estado == "8") {
                        // Mostrar un modal para agregar una novedad
                        Swal.fire({
                            title: 'Novedades',
                            html: `
                            <form class="needs-validation selectEstadoReporte" novalidate id="form_novedades_estado_aprendiz">
                            <label for="txt_novedad_estado_aprendiz" class="form-label"></label>
                            <textarea name="txt_novedad_estado_aprendiz" class="form-control" id="txt_novedad_estado_aprendiz" cols="auto" rows="3" placeholder="Escriba su novedad" required></textarea>
                            <div class="invalid-feedback">Porfavor escriba su novedad</div>
                            <div class="valid-feedback">¡Se ve bien!</div>
                            </form>
                            `,
                            showCancelButton: true,
                            confirmButtonText: 'Guardar Novedad',
                            cancelButtonText: 'Cancelar',
                            preConfirm: () => {
                                const novedadEstadoAprendiz = document.getElementById('txt_novedad_estado_aprendiz').value;
                                if (!novedadEstadoAprendiz) {
                                    Swal.showValidationMessage('La novedad no puede estar vacía');
                                    return false;
                                }
                                return novedadEstadoAprendiz;
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                let novedad = result.value;
                                let objDatos = {
                                    "fichaAprendizEdit": ficha,
                                    "tipoDocAprendizEdit": tipoDoc,
                                    "documentoAprendizEdit": documento,
                                    "nombresAprendizEdit": nombres,
                                    "apellidosAprendizEdit": apellidos,
                                    "numeroAprendizEdit": telefono,
                                    "emailAprendizEdit": email,
                                    "estadoAprendizEdit": estado,
                                    "idAprendizEdit": idAprendiz,
                                    "ruta": ruta,
                                    "fichaCompletaEdit": fichaCompleta,
                                    "nombreCompleto": nombreCompleto,
                                    "novedad": novedad // Se agrega la novedad a los datos
                                };
                                let objAprendiz = new Aprendiz(objDatos);
                                objAprendiz.editarAprendiz();  // Usamos el método existente
                            }
                        });
                    } else {
                        let objDatos = {
                            "fichaAprendizEdit": ficha,
                            "tipoDocAprendizEdit": tipoDoc,
                            "documentoAprendizEdit": documento,
                            "nombresAprendizEdit": nombres,
                            "apellidosAprendizEdit": apellidos,
                            "numeroAprendizEdit": telefono,
                            "emailAprendizEdit": email,
                            "estadoAprendizEdit": estado,
                            "idAprendizEdit": idAprendiz,
                            "ruta": ruta,
                            "fichaCompleta": fichaCompleta,
                            "nombreCompleto": nombreCompleto
                        };
                        let objAprendiz = new Aprendiz(objDatos);
                        objAprendiz.editarAprendiz();
                    }
                }
            }, false)
        });



    //btn eliminar aprendiz
    $("#tablaAprendiz").on("click", "#btn-Delet", function () {
        Swal.fire({
            title: '¿Seguro desea eliminar este registro?',
            text: "¡Recuerde, si elimina el registro no podra recuperarlo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                let idAprendiz = $(this).attr("aprendiz");
                let nombreCompleto = $(this).attr("nombreCompleto");
                let fichaCompleta = $(this).attr("fichaCompleta");
                let objDatos = { "idAprendiz": idAprendiz, "fichaCompleta": fichaCompleta, "nombreCompleto": nombreCompleto }
                let objAprendiz = new Aprendiz(objDatos);
                objAprendiz.eliminarAprendiz();
            }
        })
    })

})