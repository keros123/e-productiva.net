$(function() {

    $("#tablaAprendizFichaSeleccionada").on("click", "#btnVisualizar", function() {
        let idAprendiz = $(this).attr("idAprendiz");
        informacionAprendiz(idAprendiz);
        bitacorasAprendiz(idAprendiz);
        segimientosAprendiz(idAprendiz);
        visitaSeguimiento(idAprendiz);
        $(".detallesAprendiz").fadeIn("2000");
        $(".volver_fichaAprendices").show();
        $(".fichaAprendices").hide();
    });


    function informacionAprendiz(idAprendiz) {
        let objDatos = { "idAprendiz": idAprendiz };
        let objInfoAprendiz = new DetallesUsuario(objDatos);
        objInfoAprendiz.informacionAprendiz();
    }

    function bitacorasAprendiz(idAprendiz) {
        let objDatos = { "idAprendiz": idAprendiz };
        let objInfoAprendiz = new DetallesUsuario(objDatos);
        objInfoAprendiz.bitacorasAprendiz();
    }

    function segimientosAprendiz(idAprendiz) {
        let objDatos = { "idAprendiz": idAprendiz };
        let objInfoAprendiz = new DetallesUsuario(objDatos);
        objInfoAprendiz.segimientosAprendiz();
    }

    $(".volver_fichaAprendices").on("click", function() {
        $(".fichaAprendices").fadeIn("2000");
        $(".detallesAprendiz").hide();
        $("#seguimientosAprendiz").html("");
        $("#bitacoras").html("");
        $(".detallesFuncionario").hide();
    })

    function visitaSeguimiento(idSeguimiento) {
        let dirigido = "Administrador";
        let objDatos = { "idSeguimiento": idSeguimiento, "dirigido": dirigido };
        let objInfoAprendiz = new DetallesUsuario(objDatos);
        objInfoAprendiz.visitaSeguimiento();
    }

    $("#detalleSeguimiento").on("click", "#btn_encargado", function() {
        $(".detallesFuncionario").show();
        let idFuncionario = $(this).attr("idFuncionario");
        infoFuncionario(idFuncionario);
    })

    function infoFuncionario(idFuncionario) {
        let objDatos = { "idFuncionario": idFuncionario };
        let objInfoAprendiz = new DetallesUsuario(objDatos);
        objInfoAprendiz.infoFuncionario();
    }

    $("#detalleSeguimiento").on("click", "#btn_novedad", function() {
        let idVisita = $(this).attr("idVisita");
        let objDatos = { "idVisita": idVisita };
        let objInfoAprendiz = new DetallesUsuario(objDatos);
        objInfoAprendiz.cargarNovedadesVisita();
    })
})