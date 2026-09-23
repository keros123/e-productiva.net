class bitacoras {
  constructor(objData) {
    this._objBitacora = objData
  }

  listarBitacoras() {
    const objData = new FormData()
    objData.append("listarBitacoras", "ok")
    objData.append("aprendiz", this._objBitacora.aprendiz)
    fetch(config.rutes["controllerBitacoras"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        const mensaje = error
      })
      .then((response) => {
        if (response["codigo"] == "200") {
          $("#contenedorBitacoras").fadeIn()
          $("#contenedorBitacoras").html("")

          response["mensaje"].forEach(crearListaBitacoras)

          function crearListaBitacoras(item, index) {
            let interfaceBitacora = '<div class="col-sm-3 mb-3">'
            interfaceBitacora += '<div class="card">'
            interfaceBitacora += '<div class="card-body">'
            interfaceBitacora += '<h5 class="card-title">Bitácora ' + item.codigo_bitacora + "</h5>"
            interfaceBitacora += '<p class="card-text">Empresa : ' + item.razon_social + "</p>"
            interfaceBitacora +=
              '<p class="card-text">Jefe Directo : ' + item.nombre_jefe + " " + item.apellido_jefe + "</p>"

            // Mostrar estado actual
            let estadoTexto = ""
            let estadoClass = ""
            if (item.estado == 0) {
              estadoTexto = "Sin entregar"
              estadoClass = "text-muted"
            } else if (item.estado == 1) {
              estadoTexto = "Entregado"
              estadoClass = "text-primary"
            } else if (item.estado == 2) {
              estadoTexto = "Aprobado"
              estadoClass = "text-success"
            } else if (item.estado == 3) {
              estadoTexto = "Rechazado"
              estadoClass = "text-danger"
            }

            interfaceBitacora +=
              '<p class="card-text"><span class="' +
              estadoClass +
              '"><strong>Estado: ' +
              estadoTexto +
              "</strong></span></p>"

            interfaceBitacora += '<div class="btn-group" role="group" aria-label="Basic example">'
            interfaceBitacora +=
              '<button id="btn_cargarFormularioEditar" type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar" idBitacora="' +
              item.idbitacora +
              '" razonSocial="' +
              item.razon_social +
              '" direccionEmpresa="' +
              item.direccion_empresa +
              '" telefonoEmpresa="' +
              item.telefono_empresa +
              '" emailEmpresa="' +
              item.email_empresa +
              '" nombreJefe="' +
              item.nombre_jefe +
              '" apellidoJefe="' +
              item.apellido_jefe +
              '" telefonoJefe="' +
              item.telefono_jefe +
              '" emailJefe="' +
              item.email_jefe +
              '" fechaInicioPractica="' +
              item.fecha_inicio_practica +
              '" fechaFinalPractica="' +
              item.fecha_final_practica +
              '"  ><i class="bx bx-edit-alt" ></i></button>'

            interfaceBitacora +=
              '<button  id="btnModalBitacora" idBitacora="' +
              item.idbitacora +
              '" codigoBitacora="' +
              item.codigo_bitacora +
              '"   type="button" class="btn btn-warning"  title="Subir Archivo" data-bs-toggle="modal" data-bs-target="#modalId"><i class="bx bx-cloud-upload"></i></button>'
            if (item.url_bitacora != null) {
              interfaceBitacora +=
                '<a type="button" href="' +
                item.url_bitacora +
                '" target="_blank"  class="btn btn-danger"  title="visualizar"><i class="bx bx-show-alt" ></i></a>'
            }

            interfaceBitacora += "</div>"
            interfaceBitacora += "</div>"
            interfaceBitacora += "</div>"
            interfaceBitacora += "</div>"

            $("#contenedorBitacoras").append(interfaceBitacora)
          }
        } else if (response["codigo"] == "202") {
          $("#contenedorFormulario").fadeIn()
        }
      })
  }

  registrarBitacoras() {
    $("#btn_registroBitacoras").attr("disabled", true)
    const objData = new FormData()
    objData.append("RegistrarBitacoras", this._objBitacora.registarBitacoras)
    objData.append("razon_social", this._objBitacora.razon_social)
    objData.append("direccion_empresa", this._objBitacora.direccion_empresa)
    objData.append("telefono_empresa", this._objBitacora.telefono_empresa)
    objData.append("email_empresa", this._objBitacora.email_empresa)
    objData.append("nombre_jefe", this._objBitacora.nombre_jefe)
    objData.append("apellido_jefe", this._objBitacora.apellido_jefe)
    objData.append("telefono_jefe", this._objBitacora.telefono_jefe)
    objData.append("email_jefe", this._objBitacora.email_jefe)
    objData.append("fecha_inicial_practica", this._objBitacora.fecha_inicial_practica)
    objData.append("fecha_final_practica", this._objBitacora.fecha_final_practica)
    objData.append("aprendiz", this._objBitacora.aprendiz)

    fetch(config.rutes["controllerBitacoras"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        const mensaje = error
      })
      .then((response) => {
        if (response["codigo"] == "200") {
          $("#contenedorFormulario").fadeOut()
          this.listarBitacoras()
        } else if (response["codigo"] == "202") {
          $("#btn_registroBitacoras").removeAttr("disabled")
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: response["mensaje"],
          })
        }
      })
  }

  editarBitacoras() {
    const objData = new FormData()
    objData.append("editarBitacoras", this._objBitacora.editarBitacoras)
    objData.append("razon_social", this._objBitacora.razon_social)
    objData.append("direccion_empresa", this._objBitacora.direccion_empresa)
    objData.append("telefono_empresa", this._objBitacora.telefono_empresa)
    objData.append("email_empresa", this._objBitacora.email_empresa)
    objData.append("nombre_jefe", this._objBitacora.nombre_jefe)
    objData.append("apellido_jefe", this._objBitacora.apellido_jefe)
    objData.append("telefono_jefe", this._objBitacora.telefono_jefe)
    objData.append("email_jefe", this._objBitacora.email_jefe)
    objData.append("fecha_inicial_practica", this._objBitacora.fecha_inicial_practica)
    objData.append("fecha_final_practica", this._objBitacora.fecha_final_practica)
    objData.append("idBitacora", this._objBitacora.idBitacora)

    fetch(config.rutes["controllerBitacoras"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        const mensaje = error
      })
      .then((response) => {
        if (response["codigo"] == "200") {
          $("#contenedorFormularioEditar").fadeOut()
          Swal.fire({
            icon: "success",
            title: response["mensaje"],
            showConfirmButton: false,
            timer: 1500,
          })

          this.listarBitacoras()
        } else if (response["codigo"] == "202") {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: response["mensaje"],
          })
        }
      })
  }

  subirArchivoBitacoras() {
    const objData = new FormData()
    objData.append("archivoBitacora", this._objBitacora.archivoBitacora)
    objData.append("idBitacora", this._objBitacora.idBitacora)
    objData.append("aprendiz", this._objBitacora.aprendiz)
    objData.append("subirArchivoBitacoras", this._objBitacora.subirArchivoBitacoras)

    fetch(config.rutes["controllerBitacoras"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        const mensaje = error
      })
      .then((response) => {
        if (response["codigo"] == "200") {
          $("#modalId").modal("toggle")
          Swal.fire({
            icon: "success",
            title: response["mensaje"],
            showConfirmButton: false,
            timer: 1500,
          })
          this.listarBitacoras()
        } else if (response["codigo"] == "401") {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: response["mensaje"],
          })
        }
      })
  }

  // Método para cambiar estado
  cambiarEstadoBitacora() {
    const objData = new FormData()
    objData.append("cambiarEstadoBitacora", "ok")
    objData.append("idBitacora", this._objBitacora.idBitacora)
    objData.append("estado", this._objBitacora.estado)

    fetch(config.rutes["controllerBitacoras"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        const mensaje = error
      })
      .then((response) => {
        if (response["codigo"] == "200") {
          Swal.fire({
            icon: "success",
            title: response["mensaje"],
            showConfirmButton: false,
            timer: 1500,
          })
          // Recargar la lista de bitácoras para mostrar el cambio
          setTimeout(() => {
            if (typeof cargarBitacoras === "function") {
              cargarBitacoras()
            } else {
              this.listarBitacoras()
            }
          }, 1600)
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response["mensaje"],
          })
        }
      })
  }

  // Método para rechazar con novedad
  rechazarBitacoraConNovedad() {
    const objData = new FormData()
    objData.append("cambiarEstadoBitacora", "ok")
    objData.append("idBitacora", this._objBitacora.idBitacora)
    objData.append("estado", "3") // Estado rechazado
    objData.append("novedad", this._objBitacora.novedad)

    fetch(config.rutes["controllerBitacoras"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        const mensaje = error
      })
      .then((response) => {
        if (response["codigo"] == "200") {
          $("#modalNovedadRechazo").modal("hide")
          Swal.fire({
            icon: "success",
            title: "Bitácora rechazada",
            text: "Se ha enviado un correo al aprendiz con las observaciones",
            showConfirmButton: false,
            timer: 2000,
          })
          setTimeout(() => {
            if (typeof cargarBitacoras === "function") {
              cargarBitacoras()
            } else {
              this.listarBitacoras()
            }
          }, 2100)
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: response["mensaje"],
          })
        }
      })
  }
}
