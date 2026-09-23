$(function() {
    'use strict'

    listarSeguimientosAsignados();

    function listarSeguimientosAsignados() {
        let tabla = "#tabla_seguimientosAsignados";
        let objDatos = { "tabla": tabla };
        let objSeguimientosAprendiz = new seguimientosAprendiz(objDatos);
        objSeguimientosAprendiz.listarSeguimientosAsignados();
    }

    $("#tabla_seguimientosAsignados").on("click", "#btn_encargado", function() {
        let idFuncionario = $(this).attr("idfuncionario");
        $(".seguimientosAsignados").hide();
        $(".detallesseguimiento").fadeIn("2000");
        infoFuncionario(idFuncionario);
    })

    $("#tabla_seguimientosAsignados").on("click", "#btn_visita", function() {
        let direccionEmpresa = $(this).attr("direccionEmpresa");
        let visitaEmpresa = $(this).attr("visita");
        $("#txtDireccionEmpresa").val(direccionEmpresa);
        $("#txtDireccionEmpresa").attr("visita", visitaEmpresa);
    })

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var formularioDireccionEmpresa = document.querySelectorAll('#formularioDireccionEmpresa')

    // Loop over them and prevent submission
    Array.prototype.slice.call(formularioDireccionEmpresa)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault()
                if (!form.checkValidity()) {
                    event.stopPropagation()
                } else {
                    let direccion = $("#txtDireccionEmpresa").val();
                    let visita = $("#txtDireccionEmpresa").attr("visita");
                    $('#ModalDireccionVisita').modal('toggle');
                    let objData = { "visita": visita, "direccion": direccion };
                    let objEmpresa = new seguimientosAprendiz(objData);
                    objEmpresa.editarDireccionEmpresa();
                }

                form.classList.add('was-validated')
            }, false)
        })



    function infoFuncionario(idFuncionario) {
        let objDatos = { "idFuncionario": idFuncionario };
        let objInfoAprendiz = new DetallesUsuario(objDatos);
        objInfoAprendiz.infoFuncionario();
    }

    $(".atrasSeguimientoAprendiz").on("click", function() {
        $(".seguimientosAsignados").fadeIn("2000");
        $(".detallesseguimiento").hide();
    })






})