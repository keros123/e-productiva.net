$(function() {

    cargarDepartamentos();
    cargarMunicipios();

    function cargarDepartamentos() {
        let idDepartamento = $("#selectAccountDepartamentos").val();
        let nombreDepartamento = $("#selectAccountDepartamentos option:selected").text();
        let objDatos = { "cargarSelectDepartamentos": "cargarSelectAccount", "idSelectHtml": "#selectAccountDepartamentos", "idDepartamento": idDepartamento, "nombreDepartamento": nombreDepartamento, "editarSelect": true };
        let objUbicacion = new ubicacion(objDatos);
        objUbicacion.departamentos();
    }


    function cargarMunicipios() {
        let idDepartamento = $("#selectAccountDepartamentos").val();
        let idMunicipio = $("#selectAccountMunicipios").val();
        let nombreMunicipio = $("#selectAccountMunicipios option:selected").text();
        let objDatos = { "cargarSelectMunicipios": "cargarSelectAccountMunicipios", "idSelectHtml": "#selectAccountMunicipios", "idDepartamento": idDepartamento, "idMunicipio": idMunicipio, "nombreMunicipio": nombreMunicipio, "editarSelect": true };
        let objUbicacion = new ubicacion(objDatos);
        objUbicacion.municipios();
    }


    $("#selectAccountDepartamentos").on("change", function() {
        let idDepartamento = $(this).val();
        let objDatos = { "cargarSelectMunicipios": "cargarSelectAccountMunicipios", "idSelectHtml": "#selectAccountMunicipios", "idDepartamento": idDepartamento, "editarSelect": false };
        let objUbicacion = new ubicacion(objDatos);
        objUbicacion.municipios();
    })

})