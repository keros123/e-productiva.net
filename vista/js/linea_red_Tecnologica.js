$(function() {

    //linea tecnologica

    listarLineaTecnologica();

    var forms = document.querySelectorAll("#form_lineaTecnologica");

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
                    let lineaTecnologica = $("#txt_lineaTecnologica").val();
                    let objDatos = { "lineaTecnologica": lineaTecnologica };
                    let objLinea_red_tecnologica = new linea_red_Tecnologica(objDatos);
                    objLinea_red_tecnologica.agregarLineaTecnologica();
                }
            }, false)
        })

    function listarLineaTecnologica() {
        let tabla = '"#tablaLineaTecnologica"';
        let objDatos = { "tabla": tabla };
        let objLinea_red_tecnologica = new linea_red_Tecnologica(objDatos);
        objLinea_red_tecnologica.listarLineaTecnologica();
    }

    $("#tablaLineaTecnologica").on("click", "#btn_editLinea", function() {
        let lineaTecnologica = $(this).attr("lineaTecnologica");
        let idlineaTecnologica = $(this).attr("idlineaTecnologica");

        $("#txt_lineaTecnologica_edit").val(lineaTecnologica);
        $("#btn_editar_lineaTecnologica").attr("idLineaTecnologica", idlineaTecnologica);
        $("#btn_editar_lineaTecnologica").attr("LineaTecnologica", lineaTecnologica);
    })

    var forms = document.querySelectorAll("#form_lineaTecnologica_edit");

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
                    let lineaTecnologica = $("#txt_lineaTecnologica_edit").val();
                    let id = $("#btn_editar_lineaTecnologica").attr("idLineaTecnologica");
                    let linea = $("#btn_editar_lineaTecnologica").attr("LineaTecnologica");
                    let objDatos = { "lineaTecnologica": lineaTecnologica, "id": id, "linea": linea };
                    let objLinea_red_tecnologica = new linea_red_Tecnologica(objDatos);
                    objLinea_red_tecnologica.editarLineaTecnologica();
                }
            }, false)
        })

    $("#tablaLineaTecnologica").on("click", "#btn_eliminarLinea", function() {
        let idlineaTecnologica = $(this).attr("idlineaTecnologica");
        let lineaTecnologica = $(this).attr("lineaTecnologica");

        Swal.fire({
            title: '¿esta seguro de eliminar ' + lineaTecnologica + '?',
            text: "recuerde que si elimina el registro, no podra recuperarlo",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'aceptar',
            cancelButtonText: 'cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                let objDatos = { "id": idlineaTecnologica, "linea": lineaTecnologica };
                let objLinea_red_tecnologica = new linea_red_Tecnologica(objDatos);
                objLinea_red_tecnologica.eliminarLineaTecnologica();
            }
        })
    })

    //red tecnologica

    $("#tablaLineaTecnologica").on("click", "#btn_RedTecnologica", function() {
        let idlineaTecnologica = $(this).attr("idlineaTecnologica");
        let lineaTecnologica = $(this).attr("lineaTecnologica");

        $("#nombreLineaTecnologica").text(lineaTecnologica);
        $("#btn_redTecnologica").attr("lineaTecnologica", idlineaTecnologica);
        $("#agregarRedTecnologica").attr("nombrelineaTecnologica", lineaTecnologica);
        $("#agregarRedTecnologica").attr("lineaTecnologica", idlineaTecnologica);

        $(".lineaTecnologica").hide();
        $(".redTecnologica").fadeIn(2000);

        listarRedTecnologica();
    })

    $(".atras_btn_redTecnologica").on("click", function() {
        $(".lineaTecnologica").fadeIn(2000);
        $(".redTecnologica").hide();
    })

    function listarRedTecnologica() {
        let tabla = "'#tablaRedTecnologica'";
        let objDatos = { "tabla": tabla };
        let objLinea_red_tecnologica = new linea_red_Tecnologica(objDatos);
        objLinea_red_tecnologica.listarRedTecnologica();
    }

    var forms = document.querySelectorAll("#form_redTecnologica");

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
                    let redTecnologica = $("#txt_RedTecnologica").val();
                    let id = $("#btn_redTecnologica").attr("lineaTecnologica");
                    let linea = $("#agregarRedTecnologica").attr("nombrelineaTecnologica");
                    let objDatos = { "redTecnologica": redTecnologica, "id": id, "linea": linea };
                    let objLinea_red_tecnologica = new linea_red_Tecnologica(objDatos);
                    objLinea_red_tecnologica.agregarRedTecnologica();
                }
            }, false)
        })

    $("#tablaRedTecnologica").on("click", "#btn_editRed", function() {
        let redTecnologica = $(this).attr("redTecnologica");
        let idRedTecnologica = $(this).attr("idRedTecnologica");

        $("#txt_RedTecnologica_edit").val(redTecnologica);
        $("#btn_redTecnologica_edit").attr("idRedTecnologica", idRedTecnologica);
        $("#btn_redTecnologica_edit").attr("redTecnologica", redTecnologica);
    })

    var forms = document.querySelectorAll("#form_redTecnologica_edit");

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
                    let redTecnologica = $("#txt_RedTecnologica_edit").val();
                    let id = $("#btn_redTecnologica_edit").attr("idRedTecnologica");
                    let linea = $("#agregarRedTecnologica").attr("nombrelineaTecnologica");
                    let red = $("#btn_redTecnologica_edit").attr("redTecnologica");
                    let objDatos = { "redTecnologica": redTecnologica, "id": id, "linea": linea, "red": red };
                    let objLinea_red_tecnologica = new linea_red_Tecnologica(objDatos);
                    objLinea_red_tecnologica.editarRedTecnologica();
                }
            }, false)
        })

    $("#tablaRedTecnologica").on("click", "#btn_eliminarRed", function() {
        let idRedTecnologica = $(this).attr("idRedTecnologica");
        let redTecnologica = $(this).attr("redTecnologica");
        let linea = $("#agregarRedTecnologica").attr("nombrelineaTecnologica");

        Swal.fire({
            title: '¿esta seguro de eliminar ' + redTecnologica + '?',
            text: "recuerde que si elimina el registro, no podra recuperarlo",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'aceptar',
            cancelButtonText: 'cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                let objDatos = { "id": idRedTecnologica, "redTecnologica": redTecnologica, "linea": linea };
                let objLinea_red_tecnologica = new linea_red_Tecnologica(objDatos);
                objLinea_red_tecnologica.eliminarRedTecnologica();
            }
        })
    })

})