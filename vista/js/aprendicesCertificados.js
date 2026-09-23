$(() => {
  cargarAprendicesCertificados()

  function cargarAprendicesCertificados() {
    const objDatos = { aprendicesCertificadosData: "ok" }
    const objRespuesta = new aprendicesCertificados(objDatos)
    objRespuesta.cargarAprendicesCertificadosClass()
  }

  $("#tabla_AprendicesCertificados").on("click", "#verDetalles", function () {
    $("#detalles").modal("show")
    //iniciar
    $("#informacionPersonal").html("");

    let urlImagen = $(this).attr("foto");
    urlImagen ? $("#imagenAprendiz").attr("src", urlImagen) : $("#imagenAprendiz").attr("src", "assets/img/interface/profile.png")

    //final
    $("#NombreAprendiz").html("<h4>" + $(this).attr("nombres") + "</h4>")
    let info = '<div class="col-md-12 p-3">'
    info += '<h5 class="mb-2" style="font-weight:bold">Informaci&oacute;n personal</h5>'
    info += '<ul class="mb-1">'
    info += '<li><h6 style="word-wrap: break-word;">Documento : ' + $(this).attr("documento") + "</h6></li>"
    info += '<li><h6 style="word-wrap: break-word;">Email : ' + $(this).attr("email") + "</h6></li>"
    info += '<li><h6 style="word-wrap: break-word;">Telefono : ' + $(this).attr("telefono") + "</h6></li>"
    info += "</ul>"
    info += '<h5 class="mt-2 mb-2" style="font-weight:bold">Informaci&oacute;n certificaci&oacute;n</h5>'
    info += "<ul>"
    info += '<li><h6 style="word-wrap: break-word;">Ficha : ' + $(this).attr("ficha") + "</h6></li>"
    info += '<li><h6 style="word-wrap: break-word;">Modalidad : ' + $(this).attr("modalidad") + "</h6></li>"
    info += '<li><h6 style="word-wrap: break-word;">Fin practica : ' + $(this).attr("finPractica") + "</h6></li>"
    info +=
      '<li><h6 style="word-wrap: break-word;">Fecha certificaci&oacute;n : ' +
      $(this).attr("fechaCertificacion") +
      "</h6></li>"
    info += "</ul>"
    info += '<h5 class="mt-2 mb-2" style="font-weight:bold">Informaci&oacute;n ubicaci&oacute;n</h5>'
    info += "<ul>"
    info += '<li><h6 style="word-wrap: break-word;">Municipio : ' + $(this).attr("municipio") + "</h6></li>"
    info += '<li><h6 style="word-wrap: break-word;">Departamento : ' + $(this).attr("departamento") + "</h6></li>"
    info += '<li><h6 style="word-wrap: break-word;">Empresa : ' + $(this).attr("nombreEmpresa") + "</h6></li>"
    info += '<li><h6 style="word-wrap: break-word;">Direcci&oacute;n : ' + $(this).attr("direccion") + "</h6></li>"
    info += "</ul></div>"
    $("#informacionPersonal").html(info)
  })
})
