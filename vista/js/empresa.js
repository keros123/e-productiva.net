$(function() {
    cargarTablaEmpresas();
    cargarDepartamentosEmpresa();

    function cargarTablaEmpresas() {
        let objData = { listarEmpresas: "ok" };
        let objEmpresa = new Empresa(objData);
        objEmpresa.listarEmpresas();
    }

    function cargarDepartamentosEmpresa() {
        let objData = {
            listarDepartametos: "ok",
            idSelectDepartamento: "#selectDepartamentosEmpresa",
            editarDepartamentos: "no",
        };
        let objDepartamentos = new Empresa(objData);
        objDepartamentos.listarDepartamentos();
    }

    $("#selectDepartamentosEmpresa").on("change", function() {
        let departamento = $(this).val();
        cargarMunicipiosEmpresa(
            departamento,
            "#selectMunicipiosEmpresa",
            "no",
            null,
            null
        );
    });

    function cargarMunicipiosEmpresa(
        departamento,
        idSelect,
        editarMunicipio,
        codigoMunicipio,
        nombreMunicipio
    ) {
        let objData = {
            listarDepartametos: "ok",
            idSelectMunicipio: idSelect,
            idDepartamento: departamento,
            editarMunicipios: editarMunicipio,
            codigoMunicipio: codigoMunicipio,
            nombreMunicipio: nombreMunicipio,
        };
        let objMunicipios = new Empresa(objData);
        objMunicipios.listarMunicipios();
    }

    ("use strict");

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll("#formEmpresas");

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener(
            "submit",
            function(event) {
                event.preventDefault();
                if (!form.checkValidity()) {
                    event.stopPropagation();
                    form.classList.add("was-validated");
                } else {
                    let nombreEmpresa = $("#txt_razon").val();
                    let departamento = $("#selectDepartamentosEmpresa").val();
                    let municipio = $("#selectMunicipiosEmpresa").val();
                    let direccionEmpresa = $("#txt_direccion").val();
                    let telefonoEmpresa = $("#txt_telefono").val();
                    let nitEmpresa = $("#txt_nit").val();
                    let objData = {
                        nombreEmpresa: nombreEmpresa,
                        departamento: departamento,
                        municipio: municipio,
                        direccionEmpresa: direccionEmpresa,
                        telefonoEmpresa: telefonoEmpresa,
                        nitEmpresa: nitEmpresa,
                        registrarEmpresa: "ok",
                        listarEmpresas: "ok",
                    };
                    let objEmpresa = new Empresa(objData);
                    objEmpresa.registrarEmpresa();
                }
            },
            false
        );
    });

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll("#formEmpresasEdit");

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms).forEach(function(form) {
        form.addEventListener(
            "submit",
            function(event) {
                event.preventDefault();
                if (!form.checkValidity()) {
                    event.stopPropagation();
                    form.classList.add("was-validated");
                } else {
                    let nombreEmpresa = $("#txt_razonEdit").val();
                    let departamento = $("#selectDepartamentosEmpresaEdit").val();
                    let municipio = $("#selectMunicipiosEmpresaEdit").val();
                    let idEmpresa = $("#btnEditarDatosEmpresa").attr("empresa");
                    let direccionEmpresa = $("#txt_direccionEdit").val();
                    let telefonoEmpresa = $("#txt_telefonoEdit").val();
                    let nitEmpresa = $("#txt_nitEdit").val();

                    let objData = {
                        nombreEmpresa: nombreEmpresa,
                        departamento: departamento,
                        municipio: municipio,
                        direccionEmpresa: direccionEmpresa,
                        telefonoEmpresa: telefonoEmpresa,
                        nitEmpresa: nitEmpresa,
                        editarEmpresa: "ok",
                        listarEmpresas: "ok",
                        idEmpresa: idEmpresa,
                    };
                    let objEmpresa = new Empresa(objData);
                    objEmpresa.editarEmpresa();
                }
            },
            false
        );
    });

    $("#btnEmpresa").on("click", function() {
        $("#contenedorFormularioEmpresa").fadeIn("2000");
        $("#contenedorTablaEmpresa").hide();
    });

    $("#atrasEmpresa").on("click", function() {
        $("#contenedorTablaEmpresa").fadeIn("2000");
        $("#contenedorFormularioEmpresa").hide();
    });

    $("#tablaEmpresas").on("click", "#btn-DeleteEmpresa", function() {
        Swal.fire({
            title: "¿Esta seguro de eliminar este registro?",
            text: "¡Recuerde, si elimina el registro no podra recuperarlo!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Cancelar",
            confirmButtonText: "Aceptar",
        }).then((result) => {
            if (result.isConfirmed) {
                let idEmpresa = $(this).attr("empresa");
                let empresaCompleta = $(this).attr("empresaCompleta");
                let objData = {
                    eliminarEmpresa: "ok",
                    idEmpresa: idEmpresa,
                    empresaCompleta: empresaCompleta,
                };
                let objEmpresa = new Empresa(objData);
                objEmpresa.eliminarEmpresa();
            }
        });
    });

    $("#tablaEmpresas").on("click", "#btn-EditarEmpresa", function() {
        $("#contenedorFormularioEditarEmpresa").fadeIn("2000");
        $("#contenedorTablaEmpresa").hide();

        document.getElementById("formEmpresasEdit").reset();

        $("#txt_razonEdit").val($(this).attr("nombreEmpresa"));
        let objData = {
            listarDepartametos: "ok",
            editarDepartamentos: "ok",
            idSelectDepartamento: "#selectDepartamentosEmpresaEdit",
            codigoDepartamento: $(this).attr("codigoDepartamento"),
            nombreDepartamento: $(this).attr("nombreDepartamento"),
        };
        let objDepartamentos = new Empresa(objData);
        objDepartamentos.listarDepartamentos();
        cargarMunicipiosEmpresa(
            $(this).attr("codigoDepartamento"),
            "#selectMunicipiosEmpresaEdit",
            "ok",
            $(this).attr("codigoMunicipio"),
            $(this).attr("nombreMunicipio")
        );
        $("#txt_direccionEdit").val($(this).attr("direccionEmpresa"));
        $("#txt_telefonoEdit").val($(this).attr("telefonoEmpresa"));
        $("#txt_nitEdit").val($(this).attr("nitEmpresa"));
        $("#btnEditarDatosEmpresa").attr("empresa", $(this).attr("empresa"));
    });

    $("#atrasEmpresaEdit").on("click", function() {
        $("#contenedorTablaEmpresa").fadeIn("2000");
        $("#contenedorFormularioEditarEmpresa").hide();
    });

    $("#selectDepartamentosEmpresaEdit").on("change", function() {
        let departamento = $(this).val();
        cargarMunicipiosEmpresa(departamento, "#selectMunicipiosEmpresaEdit", "no", null, null);
    });


});