$(function () {

    listarSeguimientosPorTipo();

    function listarSeguimientosPorTipo() {
        let tipoSeguimiento = $("#seguimientosPorTipo").attr("tipo");
        let estado = 2;
        let objDatos = { "tipoSeguimiento": tipoSeguimiento, "estado": estado };
        let objTipoSeguimiento = new SeguimientosPorTipo(objDatos);
        objTipoSeguimiento.listarSeguimientosPorTipo();
    }

    $("#TipoSeguimientoNuevoFormato").on("click", ".btn-seguimiento-tipo", function () {
        // Remover el color de todos y ponerlos grises (inactivos)
        $(".btn-seguimiento-tipo").removeClass("text-primary").addClass("text-muted");
        
        // Agregar el color primary al tab activo
        $(this).removeClass("text-muted").addClass("text-primary");

        let tipoSeguimiento = $(this).attr("tipo");
        $("#tipoSeguimientoNuevoFormato").text(tipoSeguimiento)
        $("#seguimientosPorTipo").attr("tipo", tipoSeguimiento);
        let estado = 2;
        let objDatos = { "tipoSeguimiento": tipoSeguimiento, "estado": estado };
        let objTipoSeguimiento = new SeguimientosPorTipo(objDatos);
        objTipoSeguimiento.listarSeguimientosPorTipo();
    })

    $("#tabla_seguimientosPorTipo").on("click", "#btn_ver_detalles", function () {
        let idFuncionario = $(this).attr("idFuncionario");
        let idAprendiz = $(this).attr("idAprendiz");
        let idSeguimiento = $(this).attr("idSeguimiento");
        $(".novedades").hide();
        $(".seguimientosPorTipo").hide();
        $(".detallesSeguimientoPorTipo").fadeIn(300);
        $("#txt_reporte").attr("idVisita", idSeguimiento);
        infoAprendiz(idAprendiz);
        infoFuncionario(idFuncionario);
        infoSeguimiento(idSeguimiento);
        cargarNovedades(idSeguimiento);
    })

    $("#tabla_seguimientosPorTipo").on("click", "#btn-Editar-Tipo", function () {
        let opciones = ["Presencial", "Virtual"];
        let selectVisitaSeguimiento = document.getElementById('selectVisitaSeguimiento');
        selectVisitaSeguimiento.innerHTML = "";
        let ubicacion = $(this).attr("ubicacion");
        if (ubicacion == "" || ubicacion == null || ubicacion == "Sin Asignar") {
            ubicacion = "Sin Asignar";
            opciones.push("Sin Asignar")
        }
        opciones.forEach(option => {
            let optionSelect = document.createElement('option');
            optionSelect.value = option;
            optionSelect.innerHTML = option;
            selectVisitaSeguimiento.append(optionSelect);
        });
        selectVisitaSeguimiento.value = ubicacion;
        const objTipoSeguimientos = new SeguimientosPorTipo({ "listarTipoSeguimiento": "ok", "tipoSeguimiento": $(this).attr("tipoSeguimiento"), "nombreTipoSeguimiento": $(this).attr("nombreTipoSeguimiento"), "selectTipoSeguimiento": "selectTipoSeguimiento" });
        const btn_CambiarTipoSeguimiento = document.getElementById('btn_CambiarTipoSeguimiento');
        btn_CambiarTipoSeguimiento.setAttribute("visita_seguimiento", $(this).attr("visitaSeguimiento"))
        objTipoSeguimientos.listarTipoSeguimientos();
    })

    $("#tabla_seguimientosPorTipo").on("click", "#btn-Eliminar-Tipo", function () {
        let estado = 2; // ya asignados
        let tipoSeguimiento = $("#seguimientosPorTipo").attr("tipo");
        let objData = { "eliminarSeguimiento": "ok", "listarTipoSeguimiento": "ok", "tipoSeguimiento": tipoSeguimiento, "idTipoSeguimiento": $(this).attr("tipoSeguimiento"), "visita_seguimiento": $(this).attr("visitaSeguimiento"), "seguimiento": $(this).attr("seguimiento"), "url_archivo": $(this).attr("archivo"), "aprendiz": $(this).attr("aprendiz"), "estado": estado };
        let objEliminarSeguimiento = new SeguimientosPorTipo(objData);
        objEliminarSeguimiento.eliminarSeguimiento();
    })

    $("#tabla_seguimientosPorTipo").on("click", "#btnReasignarInstructor", function () {
        document.getElementById("txt_fechaVencimiento").value = $(this).attr("vencimiento");
        document.getElementById("txt_instructor").value = $(this).attr("nombreFuncionario");
        document.getElementById("txt_instructor").setAttribute("funcionario", $(this).attr("idFuncionario"));
        document.getElementById("btn_CambiarInstructor").setAttribute("visitaSeguimiento", $(this).attr("visitaSeguimiento"));;
        document.getElementById("contenedorTablaInstructores").style.display = "none";

        let estadoSeguimiento = $(this).attr("estadoSeguimiento");
        if (estadoSeguimiento == 1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "No es posible reasignar un seguimiento que ya ha sido aprobado.",
            })
        }
    })

    const btnListarIstructores = document.getElementById("btnListarInstructores");
    btnListarIstructores.addEventListener("click", () => {
        document.getElementById("contenedorTablaInstructores").style.display = "block";
        let objData = { "cargarFuncionarios": "ok" };
        let objInstructor = new SeguimientosPorTipo(objData);
        objInstructor.listarInstructoresSeguimientos();
    })

    $("#tablaInstructoresSeguimientos").on("click", "#btnSeleccionarInstructor", function () {
        document.getElementById("txt_instructor").value = $(this).attr("nombreFuncionario");
        document.getElementById("txt_instructor").setAttribute("funcionario", $(this).attr("idFuncionario"));
        document.getElementById("contenedorTablaInstructores").style.display = "none";
    })


    const btnReasignarInstructor = document.getElementById("btn_CambiarInstructor");
    btnReasignarInstructor.addEventListener("click", () => {
        let fechaVencimiento = document.getElementById("txt_fechaVencimiento").value;
        let idFuncionario = document.getElementById("txt_instructor").getAttribute("funcionario");
        let visitaSeguimiento = btnReasignarInstructor.getAttribute("visitaSeguimiento");

        if (fechaVencimiento == "") {
            let alerta = document.createElement('div');
            alerta.className = "alert alert-danger mt-2 custom-alert";
            alerta.setAttribute("role", "alert");
            alerta.innerHTML = "Error! debes proporcionar una fecha valida."
            const contenedorMensajeFecha = document.getElementById("contenedorFecha");
            contenedorMensajeFecha.innerHTML = "";
            contenedorMensajeFecha.append(alerta);
        } else {
            let tipoSeguimiento = $("#seguimientosPorTipo").attr("tipo");
            let estado = 2;
            objData = { "reasignarInstructor": "ok", "fechaVencimiento": fechaVencimiento, "funcionario": idFuncionario, "visitaSeguimiento": visitaSeguimiento, "tipoSeguimiento": tipoSeguimiento, "estado": estado };
            const objReasignacion = new SeguimientosPorTipo(objData);
            objReasignacion.reasignarInstructor();
        }
    })


    const inputFecha = document.getElementById("txt_fechaVencimiento");
    inputFecha.addEventListener("change", () => {
        const contenedorMensajeFecha = document.getElementById("contenedorFecha");
        contenedorMensajeFecha.innerHTML = "";
    })


    // Escuchar cuando se expande una fila
    $("#tabla_seguimientosPorTipo").on("responsive-display.dt", function () {
        setTimeout(() => {
            $("#tabla_seguimientosPorTipo tbody tr td.child").css("font-size", "12.5px");
        }, 10); // Agregamos un pequeño retraso para asegurar que DataTables termine de renderizar
    });

    function infoAprendiz(idAprendiz) {
        let objDatos = { "idAprendiz": idAprendiz };
        let objInfoAprendiz = new DetallesUsuario(objDatos);
        objInfoAprendiz.informacionAprendiz();
    }

    function infoFuncionario(idFuncionario) {
        let objDatos = { "idFuncionario": idFuncionario };
        let objInfoAprendiz = new DetallesUsuario(objDatos);
        objInfoAprendiz.infoFuncionario();
    }

    function infoSeguimiento(idSeguimiento) {
        let objDatos = { "idSeguimiento": idSeguimiento };
        let objInfoAprendiz = new SeguimientosPorTipo(objDatos);
        objInfoAprendiz.infoSeguimiento();
    }

    $(".volver_datosSeguimiento").on("click", function () {
        $(".seguimientosPorTipo").fadeIn(300);
        $(".novedades").hide();
        $(".detallesSeguimientoPorTipo").hide();
    })

    function cargarNovedades(idSeguimiento) {
        let objDatos = { "idVisita": idSeguimiento };
        let objInfoAprendiz = new DetallesUsuario(objDatos);
        objInfoAprendiz.cargarNovedadesVisita();
    }


    $("#txt_reporte").on("change", function () {
        let idVisita = $(this).attr("idVisita");
        let estadoReporte = $(this).val();
        //Reporte rechazado 
        if (estadoReporte == 2) {
            let emailFuncionario = $("#emailTelefonoFuncionario").attr("email");
            $("#mensaje_novedad").text("Ha rechazado el reporte subido por el instructor, crea la novedad del proceso.");
            $("#mensaje_novedad").attr("idSeguimiento", idVisita);
            $("#mensaje_novedad").attr("creador", "administrador");
            $("#mensaje_novedad").attr("email", emailFuncionario);
        }
        //Reporte aprobado
        if (estadoReporte == 1) {
            let emailFuncionario = $("#emailTelefonoFuncionario").attr("email");
            $("#mensaje_novedad").text("Ha aprobado el reporte subido por el instructor, crea la novedad del proceso.");
            $("#mensaje_novedad").attr("idSeguimiento", idVisita);
            $("#mensaje_novedad").attr("creador", "administrador");
            $("#mensaje_novedad").attr("email", emailFuncionario);
        }
        let objDatos = { "estadoReporte": estadoReporte, "idVisitaReporte": idVisita };
        let objInfoAprendiz = new SeguimientosPorTipo(objDatos);
        objInfoAprendiz.cambiarEstadoReporte();
    })

    $("#btn_CambiarTipoSeguimiento").on("click", function () {
        let tipoSeguimiento = $("#seguimientosPorTipo").attr("tipo");
        let estado = 2;
        let idTipoSeguimiento = $("#selectTipoSeguimiento").val();
        let ubicacionSeguimiento = $("#selectVisitaSeguimiento").val();
        let objData = { "cambiarTipoSeguimiento": "ok", "visitaSeguimiento": $(this).attr("visita_seguimiento"), "selectTipoSeguimiento": idTipoSeguimiento, "tipoSeguimiento": tipoSeguimiento, "estado": estado, "ubicacion": ubicacionSeguimiento };
        $("#ModalEditarTipo").modal("toggle");
        let ObjVisitaSeguimiento = new SeguimientosPorTipo(objData);
        ObjVisitaSeguimiento.editarTipoSeguimiento();
    })

})