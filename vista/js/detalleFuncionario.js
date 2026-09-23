$(() => {
  let estadoVisita, seguimiento
  $("#novedadErrorMensaje").hide()

  $("#tablaFuncionarios").on("click", "#btn_visualizar", function () {
    const idFuncionario = $(this).attr("idFuncionario")
    const idTipoFuncionario = $(this).attr("idTipoFuncionario")
    $(".funcionarios").hide()
    $(".detallesFuncionario").fadeIn("2000")
    infoFuncionario(idFuncionario)
    if (idTipoFuncionario == 1) {
      tablaSeguimientosFuncionario(idFuncionario)
      $("#seguimientosIntructorDetalles").fadeIn()
    } else {
      $("#seguimientosIntructorDetalles").css({ display: "none" })
    }
  })

  function infoFuncionario(idFuncionario) {
    const objDatos = { idFuncionario: idFuncionario }
    const objInfoAprendiz = new DetallesUsuario(objDatos)
    objInfoAprendiz.infoFuncionario()
  }

  function tablaSeguimientosFuncionario(idFuncionario) {
    const objData = { listarSeguimientosFuncionario: "ok", idFuncionario: idFuncionario }
    const objSeguimientosFuncionario = new DetallesUsuario(objData)
    objSeguimientosFuncionario.listarSeguimientosInstructor()
  }

  $(".volver_funcionarios").on("click", () => {
    $(".funcionarios").fadeIn("2000")
    $(".detallesFuncionario").hide()
  })

  // Mejorado el manejo del cambio de estado
  $("#tablaListaSeguimientosInstructor").on("change", "#selectEstados", function () {
    const currentSelect = $(this)
    Swal.fire({
      title: "¿Está seguro de cambiar el estado?",
      text: "Recuerde que después de aprobar el seguimiento no podrá cambiarlo",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sí, estoy seguro",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        const estado = currentSelect.val()
        const visitaSeguimiento = $("option:selected", currentSelect).attr("visitaSeguimiento")

        if (estado == 2 || estado == 1) {
          // Limpiamos el textarea antes de mostrar el modal
          $("#message-textNovedad").val("")
          $("#novedadErrorMensaje").hide()

          // Asignamos los atributos a los botones
          $("#btnRegistroNovedadSeguimiento").attr("estado", estado)
          $("#btnRegistroNovedadSeguimiento").attr("seguimiento", visitaSeguimiento)
          $("#btnOmitirNovedad").attr("estado", estado)
          $("#btnOmitirNovedad").attr("seguimiento", visitaSeguimiento)

          // Mostramos el modal
          $("#novedadModal").modal("show")
        } else {
          const objDataVisitaSeguimiento = {
            estadoVisitaSeguimiento: estado,
            visitaSeguimiento: visitaSeguimiento,
            novedad: null,
            idContenedor: currentSelect.parent(),
          }
          const objVisitaSeguimiento = new DetallesUsuario(objDataVisitaSeguimiento)
          objVisitaSeguimiento.cambiarEstadoVisitaSeguimiento()
        }
      } else {
        // Si cancela, restauramos el valor original
        currentSelect.val(currentSelect.find("option[selected]").val())
      }
    })
  })

  // Corregido: Manejo del cierre del modal
  $("#btnCerrarModalNovedad").on("click", () => {
    // Restauramos el valor del select al cerrar el modal
    $("#selectEstados").val($("#selectEstados").find("option[selected]").val())
    $("#novedadModal").modal("hide")
  })

  // Manejo del botón omitir - SIN ENVÍO DE CORREO
  $("#btnOmitirNovedad").on("click", function () {
    const estadoSeguimiento = $(this).attr("estado")
    const visitaSeguimiento = $(this).attr("seguimiento")

    const objDataVisitaSeguimiento = {
      estadoVisitaSeguimiento: estadoSeguimiento,
      visitaSeguimiento: visitaSeguimiento,
      novedad: null,
      idContenedor: $("#selectEstados").parent(),
      enviarCorreo: "no", // Añadimos este parámetro para indicar que NO se envíe correo
    }

    const objVisitaSeguimiento = new DetallesUsuario(objDataVisitaSeguimiento)
    objVisitaSeguimiento.cambiarEstadoVisitaSeguimiento()

    // Cerramos el modal después de procesar
    $("#novedadModal").modal("hide")
  })

  // Manejo del botón registrar novedad - CON ENVÍO DE CORREO
  $("#btnRegistroNovedadSeguimiento").on("click", function () {
    const mensaje = $("#message-textNovedad").val()
    const contenedorMensaje = document.getElementById("novedadErrorMensaje")

    if (mensaje == "" || mensaje == null) {
      contenedorMensaje.innerText = "¡Error! Este campo no puede ir vacío."
      $(contenedorMensaje).show()
    } else {
      const estadoSeguimiento = $(this).attr("estado")
      const visitaSeguimiento = $(this).attr("seguimiento")

      const objDataVisitaSeguimiento = {
        estadoVisitaSeguimiento: estadoSeguimiento,
        visitaSeguimiento: visitaSeguimiento,
        novedad: mensaje,
        idContenedor: $("#selectEstados").parent(),
        enviarCorreo: "si",
      }

      const objVisitaSeguimiento = new DetallesUsuario(objDataVisitaSeguimiento)
      objVisitaSeguimiento.cambiarEstadoVisitaSeguimiento()

      // Cerramos el modal después de procesar
      $("#novedadModal").modal("hide")
    }
  })

  $("#message-textNovedad").on("click", () => {
    $("#novedadErrorMensaje").hide()
  })
})
