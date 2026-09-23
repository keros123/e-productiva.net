$(function () {

    var forms = document.querySelectorAll("#form_novedades");

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
                let idVisita = $("#mensaje_novedad").attr("idSeguimiento");
                let creador = $("#mensaje_novedad").attr("creador");
                let emailNovedad = $("#mensaje_novedad").attr("email");
                if (creador == "administrador") {
                    $(".selectEstadoReporte").hide("");
                    $(".enviando").show("");
                }
                let novedad = $("#txt_novedad").val();
                let objDatos = { "novedad": novedad, "idVisita": idVisita, "creador": creador, "emailNovedad": emailNovedad };
                let objFicha = new Novedades(objDatos);
                objFicha.crearNovedad();
            }
        }, false)
    })

})