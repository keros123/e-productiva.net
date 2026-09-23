class DetallesUsuario {
  constructor(objDatos) {
    this._objDetallesUsuario = objDatos
  }

  // funcion de carga de datos iniciales aprendiz
  informacionAprendiz() {

    const objData = new FormData()
    objData.append("infoAprendiz", this._objDetallesUsuario.idAprendiz)
    let mensaje
    fetch(config.rutes["controllerDetalleUsuario"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error
      })
      .then((response) => {
        datos(response)
      })

    function datos(response) {
      if (response["url_foto"] != null) {
        $("#imagenAprendiz").attr("src", response["url_foto"])
      } else {
        $("#imagenAprendiz").attr("src", "assets/img/interface/profile.png")
      }
      $("#nombreAprendiz").text(response["nombres"] + " " + response["apellidos"])
      $("#documentoAprendiz").text(response["abreviatura_tipo_documento"] + ". " + response["documento"])
      $("#estadoAprendiz").text(response["nombre_estado_aprendiz"])
      $("#correoAprendiz").text(response["email"])
      $("#telefonoAprendiz").text("(+57) " + response["telefono"])

      $("#fichaAprendiz").text(response["numero_ficha"] + "-" + response["caracterizacion"])
      $("#etapaAprendiz").html(response["nombre_estado_aprendiz"]);

      $("#novedadAprendiz").html(response["novedad"] != "" ? response["novedad"] : "No Aplica");
    }
  }

  segimientosAprendiz() {
    const objData = new FormData()
    objData.append("seguimientoAprendiz", this._objDetallesUsuario.idAprendiz)
    let mensaje

    fetch(config.rutes["controllerDetalleUsuario"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error
      })
      .then((response) => {
        let datos = "";
        $("#contenedorEtapaPracticaAprendiz").html("");
        response.forEach((item) => {
          datos += `
            <div class="col-12 mb-3">
              <div class="card border shadow-sm">
                <div class="card-header d-flex align-items-center gap-2 py-2">
                  <i class="bi bi-building text-primary"></i>
                  <span class="fw-semibold">${item.nombre_empresa}</span>
                  <span class="badge bg-primary ms-auto">${item.nombre_modalidad}</span>
                </div>
                <div class="card-body py-2">
                  <div class="row g-2">

                    <div class="col-md-6">
                      <div class="small text-muted">NIT</div>
                      <div class="fw-semibold">${item.nit_empresa || '—'}</div>
                    </div>

                    <div class="col-md-6">
                      <div class="small text-muted"><i class="bi bi-telephone me-1"></i>Teléfono</div>
                      <div class="fw-semibold">${item.telefono_empresa || '—'}</div>
                    </div>

                    <div class="col-md-6">
                      <div class="small text-muted"><i class="bi bi-geo-alt me-1"></i>Dirección</div>
                      <div class="fw-semibold">${item.direccion_empresa || '—'}</div>
                    </div>

                    <div class="col-md-3">
                      <div class="small text-muted"><i class="bi bi-calendar-event me-1"></i>Fecha inicio</div>
                      <div class="fw-semibold">${item.fecha_inicio_practica || '—'}</div>
                    </div>

                    <div class="col-md-3">
                      <div class="small text-muted"><i class="bi bi-calendar-check me-1"></i>Fecha fin</div>
                      <div class="fw-semibold">${item.fecha_fin_practica_seguimiento || '—'}</div>
                    </div>

                  </div>
                </div>
              </div>
            </div>`;
        });

        $("#contenedorEtapaPracticaAprendiz").html(datos);
      })
  }

  visitaSeguimiento() {
    const objData = new FormData()
    objData.append("idSeguimiento", this._objDetallesUsuario.idSeguimiento)
    objData.append("dirigido", this._objDetallesUsuario.dirigido)
    let mensaje;

    fetch(config.rutes["controllerDetalleUsuario"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error
      })
      .then((response) => {
        datos(response)
      })

    function datos(response) {
      const dataSet = []
      let datosSeguimientos = '';

      // Agrupar por modalidad
      const grupos = new Map();
      response["datos"].forEach((item) => {
        const idModalidad = item.modalidad_idmodalidad;
        if (!grupos.has(idModalidad)) {
          grupos.set(idModalidad, { nombre: item.nombre_modalidad, items: [] });
        }
        grupos.get(idModalidad).items.push(item);
      });

      // Renderizar agrupado y ordenado por tipo de seguimiento
      grupos.forEach(function (grupo) {

        // Encabezado de modalidad
        datosSeguimientos += `<div class="w-100 mb-2 mt-3">
          <h6 class="fw-bold text-uppercase border-bottom pb-1 text-primary">
            <i class="bi bi-tag-fill me-1"></i>${grupo.nombre}
          </h6>
        </div>`;

        // Ordenar por tipo_seguimiento_idtipo_seguimiento
        grupo.items.sort((a, b) => a.tipo_seguimiento_idtipo_seguimiento - b.tipo_seguimiento_idtipo_seguimiento);

        grupo.items.forEach((item) => {
          let urlFoto = item.url_foto_instructor != null ? item.url_foto_instructor : 'assets/img/interface/profile.png';
          let nombreInstructor = item.nombresfuncionario + " " + item.apellidosfuncionario;
          let estadoReporte = "";
          if (item.estado_reporte == "" || item.estado_reporte == null) {
            estadoReporte = 'Preasignado';
          } else if (item.estado_reporte == "0") {
            estadoReporte = 'Entregado';
          } else if (item.estado_reporte == "1") {
            estadoReporte = 'Aprobado';
          } else if (item.estado_reporte == "2") {
            estadoReporte = 'Rechazado';
          }

          datosSeguimientos += `<div class="row align-items-center g-3 mb-4">
                <!-- Foto instructor -->
                <div class="col-auto">
                    <img 
                        src="${urlFoto}"
                        class="rounded-circle border"
                        width="70"
                        height="70"
                        alt="Foto instructor"
                    >
                </div>

                <!-- Información -->
                <div class="col">
                    <div class="fw-semibold">
                        Instructor Encargado : ${nombreInstructor}
                    </div>

                    <div class="small text-muted">
                        ${item.email_instructor}
                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-2 small">
                        <span class="badge bg-primary">
                            ${item.nombre_tipo_seguimiento}
                        </span>

                        <span class="badge bg-secondary">
                            ${estadoReporte}
                        </span>`;

          if (item.tipo_seguimiento_idtipo_seguimiento == 5) {
            let textoLink = "";
            let colorJuicio = "";
            if (item.url_juicio_evaluativo && item.url_juicio_evaluativo !== "null" && item.url_juicio_evaluativo.trim() !== "") {
              $("#imagenJuicio").attr("src", item.url_juicio_evaluativo);
              textoLink = "Evidencia Juicio Evaluativo";
              colorJuicio = "bg-info";
            } else {
              $("#imagenJuicio").attr("src", 'assets/img/interface/folder.png');
              textoLink = "Juicio Evaluativo Sin Soporte";
              colorJuicio = "bg-danger";
            }
            datosSeguimientos += `<span class="badge ${colorJuicio}">
                          <a href="#" class="mc-ancor" data-bs-toggle="modal" data-bs-target="#imagenModal">
                            ${textoLink}
                          </a>
                      </span>`;
          }

          let url = "";
          let target = "";
          if (item.url_documento !== null && item.url_documento !== "") {
            url = item.url_documento;
            target = 'target="_Blank"';
          } else {
            url = 'javascript:void(0);';
            target = 'target=""';
          }

          datosSeguimientos += `</div>
                </div>

                <!-- Acción -->
                <div class="col-auto text-end">
                    <a 
                        href="${url}"
                        class="btn btn-outline-secondary btn-sm"
                        ${target}
                        download
                        title="Descargar seguimiento"
                    >
                        <i class="bi bi-download"></i>
                    </a>
                </div>
            </div>`;
        });
      });

      $("#seguimientosAprendiz").html(datosSeguimientos);
    }
  }

  // Método para crear el modal dinámicamente
  crearModalNovedadRechazo() {
    // Verificar si el modal ya existe
    if ($("#modalNovedadRechazo").length > 0) {
      return
    }

    const modalHTML = `
      <div class="modal fade" id="modalNovedadRechazo" tabindex="-1" aria-labelledby="modalNovedadRechazoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title" id="modalNovedadRechazoLabel">
                <i class="bx bx-x-circle me-2"></i>Rechazar Bitácora
              </h5>
              <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="alert alert-warning">
                <i class="bx bx-info-circle me-2"></i>
                <strong>Importante:</strong> Al rechazar la bitácora, se enviará un correo automático al aprendiz con las observaciones que ingrese a continuación.
              </div>
              
              <div class="mb-3">
                <label class="form-label fw-bold">Bitácora a rechazar:</label>
                <p class="text-muted" id="bitacoraInfo">-</p>
              </div>
              
              <div class="mb-3">
                <label for="novedadTexto" class="form-label fw-bold">
                  Observaciones del instructor <span class="text-danger">*</span>
                </label>
                <textarea 
                  class="form-control" 
                  id="novedadTexto" 
                  rows="5" 
                  placeholder="Ingrese las observaciones detalladas sobre por qué se rechaza la bitácora. Estas observaciones serán enviadas al aprendiz por correo electrónico."
                  maxlength="1000"
                ></textarea>
                <div class="form-text">
                  <span id="contadorCaracteres">0</span>/1000 caracteres
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                <i class="bx bx-x me-1"></i>Cancelar
              </button>
              <button type="button" class="btn btn-danger" id="btnGuardarRechazo">
                <i class="bx bx-paper-plane me-1"></i>Rechazar y Enviar Correo
              </button>
            </div>
          </div>
        </div>
      </div>
    `

    // Agregar el modal al body
    $("body").append(modalHTML)

    // Agregar event listeners
    this.configurarEventListenersModal()
  }

  // Configurar event listeners del modal
  configurarEventListenersModal() {
    // Contador de caracteres
    $(document)
      .off("input", "#novedadTexto")
      .on("input", "#novedadTexto", function () {
        const maxLength = 1000
        const currentLength = $(this).val().length
        $("#contadorCaracteres").text(currentLength)

        if (currentLength > maxLength * 0.9) {
          $("#contadorCaracteres").addClass("text-warning")
        }
        if (currentLength === maxLength) {
          $("#contadorCaracteres").addClass("text-danger").removeClass("text-warning")
        }
        if (currentLength < maxLength * 0.9) {
          $("#contadorCaracteres").removeClass("text-warning text-danger")
        }
      })
  }

  // Método para rechazar bitácora con novedad
  rechazarBitacoraConNovedad(idBitacora, novedad) {
    const objData = new FormData()
    objData.append("cambiarEstadoBitacora", "ok")
    objData.append("idBitacora", idBitacora)
    objData.append("estado", "3") // Estado rechazado
    objData.append("novedad", novedad)

    fetch(config.rutes["controllerBitacoras"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        console.error("Error:", error)
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

          // Recargar las bitácoras
          setTimeout(() => {
            this.bitacorasAprendiz()
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

  bitacorasAprendiz() {
    // Inyectar estilos de cards de bitácora una sola vez
    if (!document.getElementById("bitacora-card-styles")) {
      const style = document.createElement("style")
      style.id = "bitacora-card-styles"
      style.textContent = `
        .bitacora-estado-aprobado  { border-left-color: #696cff !important; }
        .bitacora-estado-rechazado { border-left-color: #ff3e1d !important; }
        .bitacora-estado-entregado { border-left-color: #03c3ec !important; }
        .bitacora-estado-pendiente { border-left-color: #ffab00 !important; }
        .bitacora-estado-vacio     { border-left-color: #a8aaae !important; }
        .bitacora-btn-ver:hover    { background: rgba(105,108,255,0.2) !important; transform: scale(1.1); }
      `
      document.head.appendChild(style)
    }

    const objData = new FormData()
    objData.append("idBitacoras", this._objDetallesUsuario.idAprendiz)
    let mensaje

    fetch(config.rutes["controllerDetalleUsuario"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error
      })
      .then((response) => {
        datos(response)
      })

    const self = this

    function datos(response) {
      if (response.length > 0) {
        $(".bitacoras").fadeIn()
        $("#bitacoras").html("")
        response.forEach(crearListaBitacoras)

        function crearListaBitacoras(item, index) {
          const estadoActual = item.estado

          // Configuración visual por estado
          let estadoTexto = "Sin entregar"
          let estadoIcono = "bx-time-five"
          let estadoClase = "bitacora-estado-pendiente"
          let badgeClase = "bg-label-secondary"
          let borderClase = "border-secondary"

          if (item.url_bitacora != null) {
            if (estadoActual == 1) {
              estadoTexto = "Entregado"
              estadoIcono = "bx-upload"
              estadoClase = "bitacora-estado-entregado"
              badgeClase = "bg-label-info"
              borderClase = "border-info"
            } else if (estadoActual == 2) {
              estadoTexto = "Aprobado"
              estadoIcono = "bx-check-circle"
              estadoClase = "bitacora-estado-aprobado"
              badgeClase = "bg-label-primary"
              borderClase = "border-primary"
            } else if (estadoActual == 3) {
              estadoTexto = "Rechazado"
              estadoIcono = "bx-x-circle"
              estadoClase = "bitacora-estado-rechazado"
              badgeClase = "bg-label-danger"
              borderClase = "border-danger"
            } else if (estadoActual == null) {
              estadoTexto = "Sin entregar"
              estadoIcono = "bx-time-five"
              estadoClase = "bitacora-estado-pendiente"
              badgeClase = "bg-label-warning"
              borderClase = "border-warning"
            }
          } else {
            estadoTexto = "Sin archivo"
            estadoIcono = "bx-folder-open"
            estadoClase = "bitacora-estado-vacio"
            badgeClase = "bg-label-secondary"
            borderClase = "border-secondary"
          }

          // Datos del instructor aprobador/revisor
          const nombreFuncionario = (item.nombre_funcionario && item.nombre_funcionario.trim() !== "")
            ? item.nombre_funcionario
            : null
          const documentoFuncionario = (item.documento_funcionario && item.documento_funcionario.trim() !== "")
            ? item.documento_funcionario
            : null

          let bloqueInstructor = ""
          if (nombreFuncionario) {
            bloqueInstructor = `
              <div class="bitacora-instructor mt-2 pt-2" style="border-top: 1px dashed #e0e0e0;">
                <div class="d-flex align-items-center gap-2">
                  <div class="avatar avatar-xs">
                    <span class="avatar-initial rounded-circle bg-label-info" style="font-size:10px;">
                      <i class="bx bx-user-check"></i>
                    </span>
                  </div>
                  <div style="min-width:0;">
                    <div class="text-muted" style="font-size:10px; line-height:1.2;">Instructor revisor</div>
                    <div class="fw-semibold text-truncate" style="font-size:12px;" title="${nombreFuncionario}">${nombreFuncionario}</div>
                    ${documentoFuncionario ? `<div class="text-muted" style="font-size:10px;">Doc: ${documentoFuncionario}</div>` : ""}
                  </div>
                </div>
              </div>`
          }

          // Bloque de acción (select o badge)
          let bloqueAccion = ""
          if (item.url_bitacora != null) {
            if (estadoActual == 2) {
              bloqueAccion = `<span class="badge ${badgeClase} px-2 py-1"><i class="bx bx-check me-1"></i>Aprobado</span>`
            } else if (estadoActual == 3) {
              bloqueAccion = `<span class="badge ${badgeClase} px-2 py-1"><i class="bx bx-x me-1"></i>Rechazado</span>`
            } else {
              const opcionActual = `<option value="${estadoActual}" selected>${estadoTexto}</option>`
              const opcionAprobado = estadoActual != 2 ? '<option value="2">✔ Aprobar</option>' : ""
              const opcionRechazado = estadoActual != 3 ? '<option value="3">✖ Rechazar</option>' : ""
              bloqueAccion = `
                <select
                  class="form-select form-select-sm cambiar-estado-bitacora"
                  data-bitacora-id="${item.idbitacora}"
                  data-codigo-bitacora="${item.codigo_bitacora}"
                  aria-label="Estado bitácora"
                  style="font-size:12px;">
                  ${opcionActual}
                  ${opcionAprobado}
                  ${opcionRechazado}
                </select>`
            }
          }

          // Botón de visualización
          const btnVer = item.url_bitacora != null
            ? `<a href="${item.url_bitacora}" target="_blank"
                class="btn btn-sm btn-icon bitacora-btn-ver"
                title="Ver bitácora"
                style="width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:8px;background:rgba(105,108,255,0.1);border:none;color:#696cff;transition:all .2s;">
                <i class="bx bx-show-alt"></i>
              </a>`
            : `<span class="btn btn-sm btn-icon"
                style="width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:8px;background:rgba(0,0,0,0.05);border:none;color:#adb5bd;cursor:default;">
                <i class="bx bx-folder-open"></i>
              </span>`

          const interfaceBitacora = `
            <div class="col-sm-6 col-md-4 col-xl-3 mb-3">
              <div class="card h-100 shadow-sm bitacora-card ${estadoClase}"
                style="border-left: 4px solid; border-left-color: inherit; transition: transform .2s, box-shadow .2s; cursor:default;"
                onmouseenter="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 20px rgba(0,0,0,0.1)'"
                onmouseleave="this.style.transform='translateY(0)';this.style.boxShadow=''">

                <div class="card-body p-3 d-flex flex-column gap-2">

                  <!-- Encabezado: número + estado -->
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <div class="text-muted" style="font-size:10px; text-transform:uppercase; letter-spacing:.5px; font-weight:600;">Bitácora</div>
                      <div class="fw-bold" style="font-size:1.15rem; line-height:1.2;">${item.codigo_bitacora}</div>
                    </div>
                    <div class="d-flex flex-column align-items-end gap-1">
                      <span class="badge ${badgeClase}" style="font-size:10px;">
                        <i class="bx ${estadoIcono} me-1"></i>${estadoTexto}
                      </span>
                    </div>
                  </div>

                  <!-- Separador -->
                  <hr class="my-1" style="opacity:.15;">

                  <!-- Acción (select o badges finales) -->
                  <div class="d-flex align-items-center gap-2">
                    ${btnVer}
                    <div class="flex-grow-1">
                      ${bloqueAccion || '<span class="text-muted" style="font-size:11px;"><i class="bx bx-info-circle me-1"></i>Sin archivo cargado</span>'}
                    </div>
                  </div>

                  <!-- Bloque instructor (si existe) -->
                  ${bloqueInstructor}

                </div>
              </div>
            </div>`

          $("#bitacoras").append(interfaceBitacora)
        }

        // Crear el modal si no existe
        self.crearModalNovedadRechazo()

        // Vincular el evento de rechazo utilizando el 'self' actual
        $(document)
          .off("click", "#btnGuardarRechazo")
          .on("click", "#btnGuardarRechazo", function () {
            const idBitacora = $(this).attr("data-bitacora-id")
            const novedad = $("#novedadTexto").val().trim()

            if (novedad === "") {
              Swal.fire({
                icon: "warning",
                title: "Campo requerido",
                text: "Debe ingresar una observación para rechazar la bitácora",
              })
              return
            }

            // Llamar al método para rechazar con novedad
            self.rechazarBitacoraConNovedad(idBitacora, novedad)
          })

        $(document)
          .off("change", ".cambiar-estado-bitacora")
          .on("change", ".cambiar-estado-bitacora", function () {
            const idBitacora = $(this).data("bitacora-id")
            const codigoBitacora = $(this).data("codigo-bitacora")
            const nuevoEstado = $(this).val()
            const selectElement = $(this)

            // Si es rechazo (estado 3), mostrar modal de novedad
            if (nuevoEstado == "3") {
              // Configurar el modal
              $("#bitacoraInfo").text("Bitácora " + codigoBitacora)
              $("#novedadTexto").val("")
              $("#contadorCaracteres").text("0")
              $("#btnGuardarRechazo").attr("data-bitacora-id", idBitacora)
              $("#modalNovedadRechazo").modal("show")

              // Revertir select temporalmente
              selectElement.prop("selectedIndex", 0)
            } else {
              // Para otros estados, confirmar normalmente
              Swal.fire({
                title: "¿Confirmar cambio de estado?",
                text: "Esta acción cambiará el estado de la bitácora",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, cambiar",
                cancelButtonText: "Cancelar",
              }).then((result) => {
                if (result.isConfirmed) {
                  const objData = {
                    idBitacora: idBitacora,
                    estado: nuevoEstado,
                  }

                  // Verificar si la clase bitacoras está disponible
                  if (typeof bitacoras === "undefined") {
                    console.error("La clase bitacoras no está disponible")
                    Swal.fire({
                      icon: "error",
                      title: "Error",
                      text: "Error interno: clase bitacoras no disponible",
                    })
                    selectElement.prop("selectedIndex", 0)
                    return
                  }

                  const objCambiarEstado = new bitacoras(objData)

                  // Verificar que el método existe antes de llamarlo
                  if (typeof objCambiarEstado.cambiarEstadoBitacora === "function") {
                    objCambiarEstado.cambiarEstadoBitacora()
                  } else {
                    console.error("El método cambiarEstadoBitacora no existe")
                    Swal.fire({
                      icon: "error",
                      title: "Error",
                      text: "Error interno: método no disponible",
                    })
                    selectElement.prop("selectedIndex", 0)
                  }

                  // Recargar después de 1.6 Segundos
                  setTimeout(() => {
                    self.bitacorasAprendiz()
                  }, 1600)
                } else {
                  selectElement.prop("selectedIndex", 0)
                }
              })
            }
          })
      } else {
        $("#bitacoras").html("")
        $(".bitacoras").hide()
      }
    }
  }

  infoFuncionario() {
    const objData = new FormData()
    objData.append("infoFuncionario", this._objDetallesUsuario.idFuncionario)
    let mensaje

    fetch(config.rutes["controllerDetalleUsuario"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error
      })
      .then((response) => {
        datos(response)
      })

    function datos(response) {
      response.forEach((item, index) => {
        $("#nombresFuncionario").text(item.nombres + " " + item.apellidos)
        $("#txt_emailI").text(item.email).attr("title", item.email);
        $("#txt_telefonoI").text(item.telefono != "" ? "(+57) " + item.telefono : "Sin Registro");
        $("#txt_ubicacionI").text(item.direccion + " (" + item.nomb_muni.trim() + ")");
        $("#txt_documentoId").text(item.abreviatura_tipo_documento + "." + item.documento);
        $("#txt_rolI").html("<i class='bx bx-briefcase-alt-2 me-1'></i>" + item.nombre_tipo_funcionario);

        if (item.url_foto != null) {
          $("#imagenFuncionario").attr("src", item.url_foto)
        } else {
          $("#imagenFuncionario").attr("src", "assets/img/interface/profile.png")
        }
      })
    }
  }

  cargarNovedadesVisita() {
    const objData = new FormData()
    objData.append("idVisita", this._objDetallesUsuario.idVisita)
    let mensaje

    fetch(config.rutes["controllerDetalleUsuario"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error
      })
      .then((response) => {
        datos(response)
      })

    function datos(response) {
      if (response.length > 0) {
        $(".novedades").fadeIn()
        $("#novedades").html("")
        response.forEach(listarNovedades)

        function listarNovedades(item, index) {
          let interfaceNovedades = ""
          interfaceNovedades += '<div class="col-sm-12 mb-3">'
          interfaceNovedades += '<div class="card">'
          interfaceNovedades += '<div class="card-body">'
          interfaceNovedades += '<h5 class="card-title"> ' + item.autor + "</h5>"
          interfaceNovedades += '<p class="card-text">' + item.novedad + "</p>"
          interfaceNovedades += "</div>"
          interfaceNovedades += '<div class="card-footer">'
          interfaceNovedades += '<p class="card-text"> ' + item.fecha_hora_novedad + "</p>"
          interfaceNovedades += "</div>"
          interfaceNovedades += "</div>"
          interfaceNovedades += "</div>"
          $("#novedades").append(interfaceNovedades)
        }
      } else {
        $("#novedades").html("")
        $(".novedades").hide()
      }
    }
  }

  listarSeguimientosInstructor() {
    const objData = new FormData()
    objData.append("listarSeguimientosFuncionario", this._objDetallesUsuario.listarSeguimientosFuncionario)
    objData.append("idFuncionarioSeguimiento", this._objDetallesUsuario.idFuncionario)
    let mensaje

    fetch(config.rutes["controllerDetalleUsuario"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error
      })
      .then((response) => {
        const dataSet = []
        if (response["codigo"] == "200") {
          $("#totalSeguimientosInstructor").text(response["mensaje"].length);
          const tipoEstados = [{ id: 0, nombre: "Entregado" }]
          tipoEstados.push({ id: 1, nombre: "Aprobado" })
          tipoEstados.push({ id: 2, nombre: "Rechazado" })
          response["mensaje"].forEach((item) => {
            let reporte = ""
            if (item.estado_reporte == null || item.estado_reporte == "") {
              reporte += '<span class="badge bg-label-warning me-1">Sin reporte</span>'
            } else if (item.estado_reporte == 0) {
              reporte += '<span class="badge bg-label-primary me-1">Entregado</span>'
            } else if (item.estado_reporte == 1) {
              reporte += '<span class="badge bg-label-success me-1">Aprobado</span>'
            } else {
              reporte += '<span class="badge bg-label-danger me-1">Rechazado</span>'
            }

            let objSelect =
              '<select id="selectEstados" class="form-select form-select-sm" aria-label=".form-select-sm example">'
            tipoEstados.forEach((itemEstado) => {
              if (itemEstado.id == item.estado_reporte) {
                objSelect +=
                  '<option value="' +
                  item.estado_reporte +
                  '" visitaSeguimiento="' +
                  item.idvisita_seguimiento +
                  '"  selected>' +
                  reporte +
                  "</option>"
              } else {
                objSelect +=
                  '<option value="' +
                  itemEstado.id +
                  '" visitaSeguimiento="' +
                  item.idvisita_seguimiento +
                  '">' +
                  itemEstado.nombre +
                  "</option>"
              }
            })
            objSelect += "</select>"

            let objBotonArchivo = '<div class="btn-group" role="group" aria-label="Basic example">'
            if (item.estado_reporte == null || item.estado_reporte == "") {
              objBotonArchivo +=
                '<a href="#" class="btn btn-sm mc_bloqueoLink"><img  class="mc_iconTabla"  src="' +
                config.rutes["btnVisualizar"] +
                '" ></a>'
            } else {
              objBotonArchivo +=
                '<a href="' +
                item.url_documento +
                '" class="btn btn-sm" id="btn_ver_detalles"  title="Visualizar" target="_blank"><img  class="mc_iconTabla"  src="' +
                config.rutes["btnVisualizar"] +
                '" ></a>'
            }
            objBotonArchivo += "</div>"

            let ubicacion = item.ubicacion_seguimiento
            if (item.ubicacion_seguimiento == "" || item.ubicacion_seguimiento == null) {
              ubicacion = "No aplica"
            }

            if (item.estado_reporte == 1 || item.estado_reporte == null || item.estado_reporte == "") {
              dataSet.push([
                item.fecha_radicado,
                item.numero_ficha + " " + item.caracterizacion,
                item.nombres + " " + item.apellidos,
                item.documento,
                item.nombre_tipo_seguimiento,
                ubicacion,
                reporte,
                objBotonArchivo,
              ])
            } else {
              dataSet.push([
                item.fecha_radicado,
                item.numero_ficha + " " + item.caracterizacion,
                item.nombres + " " + item.apellidos,
                item.documento,
                item.nombre_tipo_seguimiento,
                ubicacion,
                objSelect,
                objBotonArchivo,
              ])
            }
          })
        } else {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: response["mensaje"],
          })
        }

        $("#tablaListaSeguimientosInstructor").DataTable({
          buttons: [
            {
              extend: "colvis",
              text: '<i class="bx bx-columns"></i>',
              titleAttr: "Columnas Visibles",
              className: "btn btn-dark btn-sm"
            },
            {
              extend: "excel",
              text: '<i class="bx bx-file" ></i>',
              titleAttr: 'Exportar a Excel',
              className: 'btn btn-secondary btn-sm'
            },
            {
              extend: "print",
              text: '<i class="bx bx-printer"></i>',
              titleAttr: 'Imprimir',
              className: 'btn btn-primary btn-sm'
            }
          ],
          dom: "Bfrtip",
          destroy: true,
          data: dataSet,
          responsive: true,
          language: {
            decimal: "",
            emptyTable: "No hay datos disponibles en la tabla",
            info: "visualizando _START_ de _END_ para un total de _TOTAL_ registros",
            infoEmpty: "visualizando 0 de 0 para un total de 0 registros",
            infoFiltered: "(filtrado de _MAX_ registros)",
            infoPostFix: "",
            thousands: ",",
            lengthMenu: "Mostrar _MENU_ registros",
            loadingRecords: "Cargando...",
            processing: "Procesando...",
            search: "Buscar:",
            zeroRecords: "No se encontraron registros coincidentes",
            paginate: {
              first: "Primero",
              last: "Ultimo",
              next: "Siguiente",
              previous: "Anterior",
            },
            aria: {
              sortAscending: ": activate to sort column ascending",
              sortDescending: ": activate to sort column descending",
            },
          },
          rowCallback: function (row, data, index) {
            $(row).css("font-size", "11.5px"); // Cambia el tamaño de la letra de cada fila
          },
        })
      })
  }

  cambiarEstadoVisitaSeguimiento() {
    const objData = new FormData()
    objData.append("cambiarEstadoVisitaSeguimiento", "ok")
    objData.append("visitaSeguimiento", this._objDetallesUsuario.visitaSeguimiento)
    objData.append("estadoVisitaSeguimiento", this._objDetallesUsuario.estadoVisitaSeguimiento)
    objData.append("novedad", this._objDetallesUsuario.novedad)

    //Nuevo parámetro para controlar el envío de correo
    if (this._objDetallesUsuario.enviarCorreo) {
      objData.append("enviarCorreo", this._objDetallesUsuario.enviarCorreo)
    } else {
      objData.append("enviarCorreo", "si")
    }

    let mensaje
    fetch(config.rutes["controllerDetalleUsuario"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error
      })
      .then((response) => {
        if (response["codigo"] == "200") {
          if (this._objDetallesUsuario.estadoVisitaSeguimiento == 1) {
            if (this._objDetallesUsuario.idContenedor) {
              this._objDetallesUsuario.idContenedor.html("")
              const span = document.createElement("span")
              span.className = "badge bg-label-success me-1"
              span.innerText = "Aprobado"
              this._objDetallesUsuario.idContenedor.append(span)
            }
          } else if (this._objDetallesUsuario.estadoVisitaSeguimiento == 2) {
            if (this._objDetallesUsuario.idContenedor) {
              this._objDetallesUsuario.idContenedor.html("")
              const span = document.createElement("span")
              span.className = "badge bg-label-danger me-1"
              span.innerText = "Rechazado"
              this._objDetallesUsuario.idContenedor.append(span)
            }
          }

          Swal.fire({
            position: "top-center",
            icon: "success",
            title: response["mensaje"],
            showConfirmButton: false,
            timer: 2500,
          })

          if (typeof tablaSeguimientosFuncionario === "function") {
            const idFuncionario = $("[idFuncionario]").attr("idFuncionario")
            if (idFuncionario) {
              setTimeout(() => {
                tablaSeguimientosFuncionario(idFuncionario)
              }, 2600)
            }
          }
        } else {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: response["mensaje"],
          })
        }
      })
  }

}
