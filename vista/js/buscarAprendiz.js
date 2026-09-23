$(function () {

    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll("#form-buscarAprendiz");

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                if (!form.checkValidity()) {
                    event.stopPropagation()
                    form.classList.add('was-validated')
                } else {
                    let documento = $("#txt-documento").val();
                    let objDatos = { "documento": documento };
                    let objAprendiz = new BuscarAprendiz(objDatos);
                    objAprendiz.buscarPorDocumento();
                }
            }, false)
        })

    $("#GFPI-F-165").on("click",function () {
        if ($(this).attr("target") == "") {
            Swal.fire({
                icon: 'warning',
                title: 'Lo lamentamos!',
                text: "No existe documento adjunto.",
                timer: 2000
            })
        }
    })

    $("#seguimientosBuscarAprendiz").on("click", "#documentoSeguimiento", function () {
        if ($(this).attr("target") == "") {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: "No existe documento adjunto relacionado para seguimiento parcial.",
                timer: 2000
            })
        }
    })

    $("#tablaCertificacion").on("click", "#ver", function () {
        if ($(this).attr("target") == "") {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: "No existe documento adjunto para el documento de certificación.",
                timer: 2000
            })
        }
    })

    $("#tablaBitacoras").on("click", "#ver", function () {
        if ($(this).attr("target") == "") {
            Swal.fire({
                icon: 'info',
                title: 'Oops...',
                text: "No existe documento adjunto para la bitacora seleccionada.",
                timer: 2000
            })
        }
    })
})