$(function () {
    cargarHistoral ();

    function cargarHistoral () {
        let tipoHistorial = $("#historial").attr("tipo");
        let objDatos = { "tipoHistorial": tipoHistorial };
        let objHistorial = new Historial (objDatos);
        objHistorial.cargarHistoral();
    }
})