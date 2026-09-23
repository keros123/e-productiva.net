$(function ( ) {

    seguimientosAsignados ();

    function seguimientosAsignados () {
        let tabla = "#tabla_seguimientosProgramados";
        let objDatos = { "tabla": tabla };
        let objSeguimientosAsignados = new SeguimientosInstructor (objDatos);
        objSeguimientosAsignados.seguimientosAsignados();
    }

    $("#tabla_seguimientosProgramados").on("click", "#btnVisualizar", function () {
        let idAprendiz = $(this).attr("idAprendiz");
        $(".novedades").hide();
        informacionAprendiz(idAprendiz);
        bitacorasAprendiz(idAprendiz);
        seguimientosAprendiz(idAprendiz);
        visitaSeguimiento(idAprendiz);
        $("#PanelPrincipalDetalleAprendiz").fadeIn("2000");
        $(".volver_seguimientosAsignados").show();
        $(".seguimientosProgramados").hide();
    });
    

    function informacionAprendiz(idAprendiz) {
        let objDatos = { "idAprendiz": idAprendiz };
        let objSeguimientosAsignados = new DetallesUsuario (objDatos);
        objSeguimientosAsignados.informacionAprendiz();
    }

    function bitacorasAprendiz(idAprendiz) {
        let objDatos = { "idAprendiz": idAprendiz };
        let objSeguimientosAsignados = new DetallesUsuario (objDatos);
        objSeguimientosAsignados.bitacorasAprendiz();
    }

    function seguimientosAprendiz(idAprendiz) {
        let objDatos = { "idAprendiz": idAprendiz };
        let objSeguimientosAsignados = new DetallesUsuario (objDatos);
        objSeguimientosAsignados.segimientosAprendiz();
    }

    $(".volver_seguimientosAsignados").on("click", function () {
        $(".seguimientosProgramados").fadeIn("2000");
        $("#PanelPrincipalDetalleAprendiz").hide();
        $(".novedades").hide();
        $("#seguimientosAprendiz").html("");
        $("#bitacoras").html("");
    })

    // function visitaSeguimiento(idVisita) {
    function visitaSeguimiento(id) {
        let objDatos = { "idSeguimiento": id, "dirigido": "instructor"};
        let objSeguimientosAsignados = new DetallesUsuario (objDatos);
        objSeguimientosAsignados.visitaSeguimiento();
    }

    $("#tabla_seguimientosProgramados").on("click", "#btn_subirReporte", function() {
        let ficha = $(this).attr("ficha");
        let idVisita = $(this).attr("idVisita");
        let aprendiz = $(this).attr("aprendiz");
        let tipoUsuario = 10;
        let rutaActual = $(this).attr("ruta");
        let rutaJuicioEvaluativo = $(this).attr("rutaJuicio");
        let tipoSeguimiento = $(this).attr("tipo_seguimiento");
        let fechaFinalPractica = $(this).attr("fecha_fin_practica");

        $("#btn_SubirArchivoSeguimiento").attr("ficha",ficha);
        $("#btn_SubirArchivoSeguimiento").attr("idVisita",idVisita);
        $("#btn_SubirArchivoSeguimiento").attr("aprendiz",aprendiz);
        $("#btn_SubirArchivoSeguimiento").attr("tipoUsuario",tipoUsuario);
        $("#btn_SubirArchivoSeguimiento").attr("ruta",rutaActual);
        $("#btn_SubirArchivoSeguimiento").attr("rutaJuicio",rutaJuicioEvaluativo);
        $("#btn_SubirArchivoSeguimiento").attr("tipoSeguimiento",tipoSeguimiento);

        const fechaBaseDatos = new Date(fechaFinalPractica + "T00:00:00"); // evita problemas de zona horaria
        const fechaActual = new Date();
        const contenedorFormulario = document.getElementById("contenedorJuicioEvaluativo");
        contenedorFormulario.innerHTML = "";
        const contenedorTituloAdvertencia = document.getElementById("tituloModalAdvertencia");
        contenedorTituloAdvertencia.innerHTML = "Etapa práctica en curso. </br> Fecha de finalización etapa práctica  : " + fechaFinalPractica;

        // Seguimiento Momento 3 
        if (tipoSeguimiento == 5){
            fechaBaseDatos < fechaActual ? (inputJuicioEvaluativo(contenedorFormulario), $("#modalSubirReporte").modal("show")) : $("#modalFechaNoValida").modal("show");
        }else{
            $("#modalSubirReporte").modal("show");
        }
    })


    function inputJuicioEvaluativo(contenedorFormulario){
        let label = document.createElement('label');
        label.setAttribute("for","fileEvidenciaEvaluacion");    
        label.className = "form-label";
        label.innerText = "Evidencia de Evaluación del Resultado de Aprendizaje";

        let input = document.createElement('input');
        input.type = "file";
        input.className = "form-control";
        input.setAttribute("id","fileEvidenciaEvaluacion");
        input.setAttribute("name","evidencia_evaluacion");
        input.setAttribute("accept","image/png,image/jpeg,image/jpg");
        input.required = true;

        let divFormatosPermitidos =  document.createElement('div');
        divFormatosPermitidos.className = "form-text";
        divFormatosPermitidos.innerText = "Formatos permitidos: JPG, JPEG, PNG";

        let divInvalidFeedBack = document.createElement("div");
        divInvalidFeedBack.className = "invalid-feedback";
        divInvalidFeedBack.innerText = "Debe adjuntar la imagen de la evaluación.";
        contenedorFormulario.append(label,input,divFormatosPermitidos,divInvalidFeedBack);
    }

    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll("#form-reporteSeguimiento");

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                if (!form.checkValidity()) {
                    event.stopPropagation()
                    form.classList.add('was-validated')
                } else {
                    let archivo = document.getElementById('txt_subirReporteSeguimiento').files[0];
                    if (archivo != undefined) {
                        let ficha = $("#btn_SubirArchivoSeguimiento").attr("ficha");
                        let idVisita = $("#btn_SubirArchivoSeguimiento").attr("idVisita");
                        let aprendiz = $("#btn_SubirArchivoSeguimiento").attr("aprendiz");
                        let tipoUsuario = 10;
                        let rutaActual = $("#btn_SubirArchivoSeguimiento").attr("ruta");
                        let rutaJuicio = $("#btn_SubirArchivoSeguimiento").attr("rutaJuicio");
                        let nombreArchivo = document.getElementById('txt_subirReporteSeguimiento').files[0].name;
                        let Extension = nombreArchivo.slice(nombreArchivo.lastIndexOf('.'));
                        
                        let imagenJuicioEvaluativo = null;
                        let imagenExtencion = null;
                        const inputJuicioEvaluativo = document.getElementById('fileEvidenciaEvaluacion');
                        if (inputJuicioEvaluativo && inputJuicioEvaluativo.files.length > 0){
                            imagenJuicioEvaluativo = inputJuicioEvaluativo.files[0];
                            imagenExtencion = inputJuicioEvaluativo.files[0].name.slice(inputJuicioEvaluativo.files[0].name.lastIndexOf('.'));
                        }

                        const extensionesDocumento = ['.PDF', '.XLS', '.XLSX'];
                        const extensionesImagen = ['.PNG', '.JPEG', '.JPG'];
                        let error = true;

                        // Validar documento
                        if (extensionesDocumento.includes(Extension?.toUpperCase())) {
                            error = false;
                        }

                        // Validar imagen solo si existe
                        if (imagenExtencion) {
                            error = !extensionesImagen.includes(imagenExtencion.toUpperCase());
                        }

                        if (!error) {
                            $("#mensaje_novedad").attr("email","vacio");
                            $("#mensaje_novedad").attr("idSeguimiento",idVisita);
                            $("#mensaje_novedad").attr("creador","instructor");
                            $("#mensaje_novedad").text("Si tiene una novedad acerca de la visita incluirla de lo contrario omita este paso.");
                            let objData = { "archivo": archivo, "ficha": ficha, "idVisita": idVisita, "aprendiz": aprendiz, "tipoUsuario": tipoUsuario, "rutaActual": rutaActual, "imagenJuicioEvaluativo":imagenJuicioEvaluativo,"rutaJuicio":rutaJuicio};
                            let objSeguimientosAsignados = new SeguimientosInstructor(objData);
                            objSeguimientosAsignados.subirReporteSeguimiento();
                        }else{
                            $("#errorFile").html("El formato del documento no es valido.");
                        }
                    }else{
                        $("#errorFile").html("Porfavor proporcione el archivo del reporte del seguimeinto.")
                    }
                }
            }, false)
        })
})