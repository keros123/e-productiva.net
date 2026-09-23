$(function () {
    listarLineaRedTecnologica();

    function listarLineaRedTecnologica () {
        let tabla = "";
        let objDatos = { "tabla": tabla };
        let objLista = new LineaRedTecnologicaFicha (objDatos);
        objLista.listarLineaRedTecnologica ();
    }

    window.modoLineaRed = null; // Variable global para rastrear el modo activo

    $("#txt_linea_red_tecnologica_0").on("click", function () {
        window.modoLineaRed = "agregar";
        $(".btn_seleccionarRedLineaTecnologica_edit").hide();
        $(".btn_seleccionarRedLineaTecnologica").show();
    })

    $("#txt_linea_red_tecnologica_edit_0").on("click", function () {
        window.modoLineaRed = "editar";
        $(".btn_seleccionarRedLineaTecnologica_edit").show();
        $(".btn_seleccionarRedLineaTecnologica").hide();
    })

    $("#tablaSelectLineaRedTecnologica").on("click", ".btn_seleccionarRedLineaTecnologica", function () {
        let lineaRedTecnologica = $(this).attr("lineaTecnologica")+" - "+$(this).attr("redTecnologica");
        let idRed = $(this).attr("idRedTecnologica");

        $("#txt_linea_red_tecnologica").val(lineaRedTecnologica);
        $("#txt_linea_red_tecnologica").attr("idRedTecnologica",idRed);
        $("#modalSelectLineaRedTecnologica").modal("hide");
    })

    $("#tablaSelectLineaRedTecnologica").on("click", ".btn_seleccionarRedLineaTecnologica_edit", function () {
        let lineaRedTecnologica = $(this).attr("lineaTecnologica")+" - "+$(this).attr("redTecnologica");
        let idRed = $(this).attr("idRedTecnologica");

        $("#txt_linea_red_tecnologica_edit").val(lineaRedTecnologica);
        $("#txt_linea_red_tecnologica_edit").attr("idredTecnologica",idRed);
        $("#modalSelectLineaRedTecnologica").modal("hide");
    })
})