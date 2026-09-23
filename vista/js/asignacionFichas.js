$(function() {

    $("#tablaFuncionarios").on("click", "#btn_AsignarFicha", function() {
        let tipoFuncionario = $(this).attr("tipoFuncionario");
        if (tipoFuncionario != "Instructor") {
            Swal.fire('Solo es posible asignar fichas a funcionarios de tipo instructor')
        } else {
            let idFuncionario = $(this).attr("idFuncionario");
            let nombreCompleto = $(this).attr("nombreCompleto");
            let instructor = nombreCompleto + " con numero de identificación " + $(this).attr("documento");

            $("#etiqueta_nombreCompletoAsignacionFichas").text(nombreCompleto);
            $("#btn_asignarFichaInstructor").attr("idFuncionario", idFuncionario);
            $("#btn_asignarFichaInstructor").attr("instructor", instructor);

            $(".ModuloFuncionario").hide();
            $(".ModuloAsignacionFichas").fadeIn(2000);

            FichasAsignadas();
            cargarFichas();
        }
    })

    function FichasAsignadas() {
        let idtabla = "#tablaFichasAsignadas";
        let objDatos = { "idtabla": idtabla };
        let objAsignarFichas = new asignacionFichas(objDatos);
        objAsignarFichas.listarFichasAsignadas();
    }

    $(".atras_btn_Funcionarios").on("click", function() {
        $("#tablaFichasAsignadas").dataTable().fnDestroy();
        $("#tablaAsignarFicha").dataTable().fnDestroy();
        $(".ModuloFuncionario").fadeIn(2000);
        $(".ModuloAsignacionFichas").hide();
    })

    $("#tablaFichasAsignadas").on("click", "#btn_DesasignarFicha", function() {
        let caracterizacion = $(this).attr("caracterizacion");
        Swal.fire({
            title: '¿Esta seguro de desvincular la ficha de  ' + caracterizacion.toLowerCase() + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                let idFuncionario = $(this).attr("idFuncionario");
                let idFicha = $(this).attr("idFicha");
                let fichaCompleta = $(this).attr("fichaCompleta");
                let instructor = $("#btn_asignarFichaInstructor").attr("instructor");
                let objDatos = { "idFuncionario": idFuncionario, "idFicha": idFicha, "fichaCompleta": fichaCompleta, "instructor": instructor };
                let objFicha = new asignacionFichas(objDatos);
                objFicha.desasignarFicha();
            }
        })
    })

    $("#btn_asignarFichaInstructor").on("click", function() {
        $("#modalAsignarFicha").modal("show");
    });

    function cargarFichas() {
        let idTabla = "#tablaAsignarFicha";
        let objDatos = { "idTabla": idTabla };
        let objFicha = new asignacionFichas(objDatos);
        objFicha.cargartablaFichasAsignadas();
    }

    $("#tablaAsignarFicha").on("click", "#btn_AsignarFichaFuncionario", function() {
        let idficha = $(this).attr("idFicha");
        let fichaCompleta = $(this).attr("fichaCompleta");
        let instructor = $("#btn_asignarFichaInstructor").attr("instructor");
        let objDatos = { "idficha": idficha, "fichaCompleta": fichaCompleta, "instructor": instructor };
        let objFicha = new asignacionFichas(objDatos);
        objFicha.asignarFichaFuncionario();
    })
})