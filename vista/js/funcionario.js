$(function() {

    cargarFuncionariosTabla();

    $("#btn_agr_funcionario").on("click", function() {
        cargarTipoFuncionario();
        cargarDepartamentos();
        cargarMunicipios();
        $(".tb_funcionarios").hide();
        $("#btn_agr_funcionario").hide();
        $("#btn_bloquear_funcionarios").hide();
        $("#btn_habilitar_funcionarios").hide();
        $(".formFuncionarioAgregar").fadeIn(2000);
    })

    $(".atrasFuncionarioFormulario").on("click", function() {
        $(".tb_funcionarios").fadeIn(2000);
        $("#btn_agr_funcionario").fadeIn(2000);
        $("#btn_bloquear_funcionarios").fadeIn(2000);
        $("#btn_habilitar_funcionarios").fadeIn(2000);
        $(".formFuncionarioAgregar").hide();
    })

    function cargarTipoFuncionario() {
        let objDatos = { "id": "#selectTipoFuncionario", "id2": "#selectTipoFuncionarioEdit" };
        let objUsuario = new Funcionario(objDatos);
        objUsuario.cargarSelectTipoFuncionario();
    }

    function cargarDepartamentos() {
        let idDepartamento = $("#selectDepartamentos").val();
        let nombreDepartamento = $("#selectDepartamentos option:selected").text();
        let objDatos = { "cargarSelectDepartamentos": "funcionario", "idSelectHtml": "#selectDepartamentos", "idDepartamento": idDepartamento, "nombreDepartamento": nombreDepartamento, "editarSelect": true };
        let objFuncionario = new Funcionario(objDatos);
        objFuncionario.departamentos();
    }


    function cargarMunicipios() {
        let idDepartamento = $("#selectDepartamentos").val();
        let idMunicipio = $("#selectMunicipios").val();
        let nombreMunicipio = $("#selectMunicipios option:selected").text();
        let objDatos = { "cargarSelectMunicipios": "funcionario", "idSelectHtml": "#selectMunicipios", "idDepartamento": idDepartamento, "idMunicipio": idMunicipio, "nombreMunicipio": nombreMunicipio, "editarSelect": true };
        let objFuncionario = new Funcionario(objDatos);
        objFuncionario.municipios();
    }


    $("#selectDepartamentos").on("change", function() {
        let idDepartamento = $(this).val();
        let objDatos = { "cargarSelectMunicipios": "funcionario", "idSelectHtml": "#selectMunicipios", "idDepartamento": idDepartamento, "editarSelect": false };
        let objFuncionario = new Funcionario(objDatos);
        objFuncionario.municipios();
    })

    cargarDepartamentosEdit();
    cargarMunicipiosEdit();
    cargarTipoFuncionario();

    $("#tablaFuncionarios").on("click", "#btn_EditarFuncionario", function() {
        $(".formFuncionarioEdit").fadeIn(2000);
        $(".tb_funcionarios").hide();
        $("#btn_agr_funcionario").hide();
        $("#btn_bloquear_funcionarios").hide();
        $("#btn_habilitar_funcionarios").hide();

        let nombres = $(this).attr("nombres");
        let apellidos = $(this).attr("apellidos");
        let tipoDoc = $(this).attr("tipoDoc");
        let documento = $(this).attr("documento");
        let email = $(this).attr("email");
        let telefono = $(this).attr("telefono");
        let municipio = $(this).attr("municipio");
        let departamento = $(this).attr("departamento");
        let direccion = $(this).attr("direccion");
        let tipoFuncionario = $(this).attr("tipoFuncionario");
        let idFuncionario = $(this).attr("idFuncionario");
        let nombreCompleto = nombres + " " + apellidos + " con numero de identificación " + documento;

        $("#txt_nombresEdit").val(nombres);
        $("#txt_apellidosEdit").val(apellidos);
        $("#selectDocumentoEdit").val(tipoDoc);
        $("#txt_documentoEdit").val(documento);
        $("#txt_emailEdit").val(email);
        $("#txt_telefonoEdit").val(telefono);
        $("#selectDepartamentosEdit").val(departamento);
        $("#selectMunicipiosEdit").val(municipio);
        $("#txt_direccionEdit").val(direccion);
        $("#selectTipoFuncionarioEdit").val(tipoFuncionario);
        $("#btn_Actualizar").attr("idFuncionario", idFuncionario);
        $("#btn_Actualizar").attr("nombreCompleto", nombreCompleto);
    })

    $("#tablaFuncionarios").on("click", "#btn_DeleteFuncionario", function() {
        Swal.fire({
            title: '¿Esta seguro de eliminar este registro?',
            text: "¡Recuerde, si elimina el registro no podra recuperarlo!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Aceptar'
        }).then((result) => {
            if (result.isConfirmed) {
                let idFuncionario = $(this).attr("idFuncionario");
                let nombreCompleto = $(this).attr("nombreCompleto");
                let objDatos = { "idFuncionario": idFuncionario, "nombreCompleto": nombreCompleto };
                let objFicha = new Funcionario(objDatos);
                objFicha.eliminarFuncionario();
            }
        })
    })

    $("#tablaFuncionarios").on("click", "#btn_Bloqueo", function() {
        Swal.fire({
            title: "Estas seguro de cambiar el estado de este funcionario?",
            text: "",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, estoy seguro!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                let funcionario = $(this).attr("idFuncionario");
                let ingreso = "";
                if ($(this).attr("ingreso") <= "1") {
                    ingreso = "2";
                } else if ($(this).attr("ingreso") == "2") {
                    ingreso = "1";
                }
                let objData = { "editarIngreso": "ok", "funcionario": funcionario, "ingreso": ingreso, "btnBloqueo": $(this) };
                let objFuncionario = new Funcionario(objData);
                objFuncionario.editarIngresoFuncionarioIndividual();
            }
        });
    })

    function cargarFuncionariosTabla() {
        let idtabla = "#tablaFuncionarios";
        let objDatos = { "idtabla": idtabla };
        let objFuncionario = new Funcionario(objDatos);
        objFuncionario.cargarFuncionarios();
    }


    function cargarDepartamentosEdit() {
        let idDepartamento = $("#selectDepartamentosEdit").val();
        let nombreDepartamento = $("#selectDepartamentosEdit option:selected").text();
        let objDatos = { "cargarSelectDepartamentos": "editarfuncionario", "idSelectHtml": "#selectDepartamentosEdit", "idDepartamento": idDepartamento, "nombreDepartamento": nombreDepartamento, "editarSelect": true };
        let objFuncionario = new Funcionario(objDatos);
        objFuncionario.departamentos();
    }


    function cargarMunicipiosEdit() {
        let idDepartamento = $("#selectDepartamentosEdit").val();
        let idMunicipio = $("#selectMunicipiosEdit").val();
        let nombreMunicipio = $("#selectMunicipiosEdit option:selected").text();
        let objDatos = { "cargarSelectMunicipios": "editfuncionario", "idSelectHtml": "#selectMunicipiosEdit", "idDepartamento": idDepartamento, "idMunicipio": idMunicipio, "nombreMunicipio": nombreMunicipio, "editarSelect": true };
        let objFuncionario = new Funcionario(objDatos);
        objFuncionario.municipiosedit();
    }

    $("#selectDepartamentosEdit").on("change", function() {
        let idDepartamento = $(this).val();
        let objDatos = { "cargarSelectMunicipios": "editfuncionario1", "idSelectHtml": "#selectMunicipiosEdit", "idDepartamento": idDepartamento, "editarSelect": false };
        let objFuncionario = new Funcionario(objDatos);
        objFuncionario.municipios();
    })

    $(".atrasFuncionarioFormularioEdit").on("click", function() {
        cargarMunicipiosEdit();
        $(".tb_funcionarios").fadeIn(2000);
        $("#btn_agr_funcionario").fadeIn(2000);
        $("#btn_bloquear_funcionarios").fadeIn(2000);
        $("#btn_habilitar_funcionarios").fadeIn(2000);
        $(".formFuncionarioEdit").hide();
        $("#formAgregarFuncionario")[0].reset();
    })


    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll("#formAgregarFuncionario");

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
                    let nombres = $("#txt_nombres").val();
                    let apellidos = $("#txt_apellidos").val();
                    let tipoDocumento = $("#selectDocumento").val();
                    let nDocumento = $("#txt_documento").val();
                    let email = $("#txt_email").val();
                    let telefono = $("#txt_telefono").val();
                    let municipio = $("#selectMunicipios").val();
                    let direccion = $("#txt_direccion").val();
                    let tipoFuncionario = $("#selectTipoFuncionario").val();
                    let objDatos = {
                        "nombres": nombres,
                        "apellidos": apellidos,
                        "tipoDocumento": tipoDocumento,
                        "nDocumento": nDocumento,
                        "email": email,
                        "telefono": telefono,
                        "municipio": municipio,
                        "direccion": direccion,
                        "tipoFuncionario": tipoFuncionario
                    };
                    let objFuncionario = new Funcionario(objDatos);
                    objFuncionario.registrarFuncionario();
                }
            }, false)
        })

    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll("#formFuncionarioEdit");

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
                    let nombres = $("#txt_nombresEdit").val();
                    let apellidos = $("#txt_apellidosEdit").val();
                    let tipoDocumento = $("#selectDocumentoEdit").val();
                    let nDocumento = $("#txt_documentoEdit").val();
                    let email = $("#txt_emailEdit").val();
                    let telefono = $("#txt_telefonoEdit").val();
                    let municipio = $("#selectMunicipiosEdit").val();
                    let direccion = $("#txt_direccionEdit").val();
                    let tipoFuncionario = $("#selectTipoFuncionarioEdit").val();
                    let idFuncionario = $("#btn_Actualizar").attr("idFuncionario");
                    let nombreCompleto = $("#btn_Actualizar").attr("nombreCompleto");
                    let objDatos = {
                        "idFuncionario": idFuncionario,
                        "nombres": nombres,
                        "apellidos": apellidos,
                        "tipoDocumento": tipoDocumento,
                        "nDocumento": nDocumento,
                        "email": email,
                        "telefono": telefono,
                        "municipio": municipio,
                        "direccion": direccion,
                        "tipoFuncionario": tipoFuncionario,
                        "nombreCompleto": nombreCompleto
                    };
                    let objFuncionario = new Funcionario(objDatos);
                    objFuncionario.EditarFuncionario();
                }
            }, false)
        })



    $("#btn_bloquear_funcionarios").on("click", function() {
        let objData = { "cambiarIngresoMasivo": "ok", "estadoIngreso": "2" };
        let objFuncionario = new Funcionario(objData);
        objFuncionario.cambiarIngresoFuncionario();
    })


    $("#btn_habilitar_funcionarios").on("click", function() {
        let objData = { "cambiarIngresoMasivo": "ok", "estadoIngreso": "1" };
        let objFuncionario = new Funcionario(objData);
        objFuncionario.cambiarIngresoFuncionario();
    })
})