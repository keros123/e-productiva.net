class BuscarAprendiz {
  constructor(objDatos) {
    this._objAprendiz = objDatos;
  }

  buscarPorDocumento() {
    var objData = new FormData();
    objData.append("BuscarAprendiz", "ok");
    objData.append("documento", this._objAprendiz.documento);

    let nodoFormulario = document.getElementById("form-buscarAprendiz");
    nodoFormulario.reset();

    fetch(config.rutes["controllerBuscarAprendiz"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error;
      })
      .then((response) => {
        $("#btn-busqueda").removeAttr("disabled");
        if (response["codigo"] == "200") {
          Swal.fire({
            icon: "success",
            title: response["mensaje"],
            showConfirmButton: false,
            timer: 1500,
          });

          this.cargarDatosPersonales(response["informacionAprendiz"], response["etapaPractica"]);
          this.cargarBitacoras(response["bitacoras"]);
          this.cargarCertificacion(response["certificacion"]);
          this.cargarSeguimientos(response["seguimientos"]);
          $("#PanelPrincipalBusqueda").show();

        } else {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: response["mensaje"],
            timer: 3000,
          });
          this.cargarBitacoras([]);
          this.cargarCertificacion([]);
          $("#contenidoBusqueda").css({ display: "none" });

          // Oculta el apartado de descarga si existe
          const cont = document.getElementById("ContenedorDescargaFormato");
          if (cont) cont.style.display = "none";
        }
        $("#txt-documento").val("");
      });
  }

  cargarDatosPersonales(datos, etapaPractica) {
    //cargar imagen
    if (datos["url_foto"] == null || datos["url_foto"] == "") {
      $("#imagenAprendiz").attr("src", "assets/img/interface/profile.png");
    } else {
      $("#imagenAprendiz").attr("src", datos["url_foto"]);
    }
    $("#nombreAprendiz").html(datos["nombres"] + " " + datos["apellidos"]);
    $("#documentoAprendiz").html("Documento: " + datos["abreviatura_tipo_documento"] + ". " + datos["documento"]);
    $("#correoAprendiz").html(datos["email"]);
    $("#telefonoAprendiz").html('CO(+57) ' + datos["telefono"]);
    $("#fichaAprendiz").html(datos["numero_ficha"] + "-" + datos["caracterizacion"].toLowerCase());
    $("#etapaAprendiz").html(datos["nombre_estado_aprendiz"]);
    $("#novedadAprendiz").html(datos["novedad"] == "" ? "Sin Novedades" : datos["novedad"]);

    if (datos["url_archivoFormato"] != "") {
      $("#GFPI-F-165").attr("href", datos["url_archivoFormato"]);
      $("#GFPI-F-165").attr("target", "_Blank");
    } else {
      $("#GFPI-F-165").attr("href", 'javascript:void(0);');
      $("#GFPI-F-165").attr("target", "");
    }

    let dataVista = '';
    etapaPractica.forEach((item) => {
      dataVista += `
        <div class="col-12 mb-3">
          <div class="card border shadow-sm">
            <div class="card-header d-flex align-items-center gap-2 py-2">
              <i class="bi bi-building text-primary"></i>
              <span class="fw-semibold">${item.nit_empresa ? 'nit. ' + item.nit_empresa + ' - ' + item.nombre_empresa : item.nombre_empresa}</span>
              <span class="badge bg-primary ms-auto">${item.nombre_modalidad}</span>
            </div>
            <div class="card-body py-2">
              <div class="row g-2">

                <div class="col-md-6">
                  <div class="small text-muted"><i class="bi bi-calendar-event me-1"></i>Fecha inicio</div>
                  <div class="fw-semibold">${item.fecha_inicio_practica || '—'}</div>
                </div>

                <div class="col-md-6">
                  <div class="small text-muted"><i class="bi bi-calendar-check me-1"></i>Fecha fin</div>
                  <div class="fw-semibold">${item.fecha_fin_practica_seguimiento || '—'}</div>
                </div>

                <div class="col-12">
                  <div class="small text-muted"><i class="bi bi-chat-left-text me-1"></i>Observaciones</div>
                  <div class="fw-semibold">${(item.observacion_seguimiento != "" && item.observacion_seguimiento != null) ? item.observacion_seguimiento : 'No Registra'}</div>
                </div>

              </div>
            </div>
          </div>
        </div>`;
    });

    $("#contenedorEtapaPractica").html(dataVista);
  }

  cargarBitacoras(datos) {
    const contenedor = document.getElementById("contenedorBitacoras");
    const barra = document.getElementById("progressBitacoras");
    const texto = document.getElementById("textoProgresoBitacoras");
    const acordeonBody = document.getElementById("detalleBitacorasBody");

    let htmlBitacoras = "";
    let htmlDetalles = '<ul class="list-group list-group-flush">';
    
    let total = datos.length;
    let entregadas = 0;

    datos.forEach(function (item, index) {
      let color = "";
      let estadoTexto = "";
      let estadoNum = parseInt(item.estado);

      if (estadoNum < 1 || isNaN(estadoNum)) { // Sin Entregar
        color = "secondary";
        estadoTexto = "Sin Entregar";
      }
      else if (estadoNum < 2) {  // Entregada
        color = "warning";
        estadoTexto = "Entregada";
        entregadas++;
      }
      else if (estadoNum < 3) {  // Aprobada
        color = "info";
        estadoTexto = "Aprobada";
        entregadas++;
      }
      else { // Rechazada
        color = "danger";
        estadoTexto = "Rechazada";
        entregadas++;
      }

      let urlBitacora = item.url_bitacora != null ? item.url_bitacora : "javascript:void(0);";
      
      // Renderizado de las cajas de bitácoras (optimizando DOM)
      if (estadoNum < 1 || isNaN(estadoNum)) {
        htmlBitacoras += `
            <div class="col-auto">
                <span class="bitacora-box bg-${color} text-white" title="No disponible">
                    B${index + 1}
                </span>
            </div>
        `;
      } else {
        htmlBitacoras += `
            <div class="col-auto">
                <a href="${urlBitacora}" target="_blank" download class="bitacora-box bg-${color} text-white" title="Descargar">
                    B${index + 1}
                </a>
            </div>
        `;
      }

      // Renderizado de los detalles en el acordeón
      let funcionarioNombre = (item.nombre_funcionario && item.nombre_funcionario.trim() !== "") 
                              ? item.nombre_funcionario 
                              : "Instructor no asignado o pendiente";
      let funcionarioDoc = (item.documento_funcionario && item.documento_funcionario.trim() !== "") 
                              ? `C.C. ${item.documento_funcionario}` 
                              : "Documento no disponible";
      
      htmlDetalles += `
        <li class="list-group-item d-flex flex-column flex-sm-row justify-content-between align-items-sm-center px-3 py-2 gap-2">
            <div class="d-flex align-items-center gap-3">
                <div class="fw-bold text-muted" style="min-width: 80px;">Bitácora ${index + 1}</div>
                <div class="vr d-none d-sm-block"></div>
                <div>
                    <div class="small fw-semibold text-dark mb-0"><i class="bi bi-person me-1"></i>${funcionarioNombre}</div>
                    <div class="small text-muted" style="font-size: 0.75rem;"><i class="bi bi-card-heading me-1"></i>${funcionarioDoc}</div>
                </div>
            </div>
            <div class="text-start text-sm-end">
                <span class="badge bg-${color}">${estadoTexto}</span>
            </div>
        </li>
      `;
    });

    htmlDetalles += '</ul>';

    if (total === 0) {
        htmlDetalles = '<div class="text-center text-muted p-4"><i class="bi bi-inbox fs-3 d-block mb-2"></i>No hay bitácoras registradas para este aprendiz.</div>';
    }

    // Inyección en el DOM
    if(contenedor) contenedor.innerHTML = htmlBitacoras;
    if(acordeonBody) acordeonBody.innerHTML = htmlDetalles;

    // Progreso
    const porcentaje = total > 0 ? Math.round((entregadas / total) * 100) : 0;
    if(barra) barra.style.width = porcentaje + "%";
    if(texto) texto.textContent = `${entregadas} / ${total}`;
  }
  cargarSeguimientos(data) {
    let datos = "";

    // Agrupar seguimientos por idModalidad
    const grupos = new Map();
    data.forEach(function (item) {
      const idModalidad = item.modalidad_idmodalidad;
      if (!grupos.has(idModalidad)) {
        grupos.set(idModalidad, { nombre: item.nombre_modalidad, items: [] });
      }
      grupos.get(idModalidad).items.push(item);
    });

    // Renderizar por grupo de modalidad
    grupos.forEach(function (grupo) {

      // ── Encabezado de modalidad ──
      datos += '<div class="w-100 mb-2 mt-3">';
      datos += '<h6 class="fw-bold text-uppercase border-bottom pb-1 text-primary">';
      datos += '<i class="bi bi-tag-fill me-1"></i>' + grupo.nombre;
      datos += '</h6>';
      datos += '</div>';

      // Ordenar seguimientos del grupo por tipo de seguimiento
      grupo.items.sort(function (a, b) {
        return a.tipo_seguimiento_idtipo_seguimiento - b.tipo_seguimiento_idtipo_seguimiento;
      });

      grupo.items.forEach(function (item) {
        let urlFotoInstructor = item.url_foto != null ? item.url_foto : "assets/img/interface/profile.png";
        datos += '<div class="row align-items-center g-3 mb-4">';
        datos += '<div class="col-auto">';
        datos += '<img id="fotoInstructor" src="' + urlFotoInstructor + '" class="rounded-circle border" width="70" height="70" alt="Foto instructor">';
        datos += '</div>';

        datos += '<div class="col">';
        datos += '<div class="fw-semibold" id="nombreInstructor">';
        datos += 'Instructor Encargado : ' + item.nombres + " " + item.apellidos;
        datos += '</div>';

        datos += '<div class="small text-muted" id="emailInstructor">';
        datos += item.email;
        datos += '</div>';

        let tipoSeguimiento = '';
        if (item.tipo_seguimiento_idtipo_seguimiento == 1) {
          tipoSeguimiento = 'Seguimiento Parcial';
        } else if (item.tipo_seguimiento_idtipo_seguimiento == 2) {
          tipoSeguimiento = 'Seguimiento Final';
        } else if (item.tipo_seguimiento_idtipo_seguimiento == 3) {
          tipoSeguimiento = 'Seguimiento momento 1';
        } else if (item.tipo_seguimiento_idtipo_seguimiento == 4) {
          tipoSeguimiento = 'Seguimiento momento 2';
        } else if (item.tipo_seguimiento_idtipo_seguimiento == 5) {
          tipoSeguimiento = 'Seguimiento momento 3';
        } else if (item.tipo_seguimiento_idtipo_seguimiento == 6) {
          tipoSeguimiento = 'Seguimiento extraordinario';
        }

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

        datos += '<div class="d-flex flex-wrap gap-2 mt-2 small">';
        datos += '<span class="badge bg-primary" id="tipoSeguimiento">';
        datos += tipoSeguimiento;
        datos += '</span>';

        datos += '<span class="badge bg-secondary" id="estadoSeguimiento">';
        datos += estadoReporte;
        datos += '</span>';

        if (item.tipo_seguimiento_idtipo_seguimiento == 5) {
          let textoLink = "";
          let colorJuicio = "";
          let urlJuicio = item.url_juicio_evaluativo;
          if (urlJuicio && urlJuicio !== "null" && urlJuicio.trim() !== "") {
            $("#imagenJuicio").attr("src", urlJuicio);
            textoLink = "Evidencia Juicio Evaluativo";
            colorJuicio = "bg-info";
          } else {
            $("#imagenJuicio").attr("src", 'assets/img/interface/folder.png');
            textoLink = "Juicio Evaluativo Sin Soporte";
            colorJuicio = "bg-danger";
          }

          datos += '<span class="badge ' + colorJuicio + '" id="estadoSeguimiento">';
          datos += '<a href="#" class="mc-ancor" data-bs-toggle="modal" data-bs-target="#imagenModal">';
          datos += textoLink;
          datos += '</a>';
          datos += '</span>';
        }
        datos += '</div>';
        datos += '</div>';

        let url = "";
        let target = "";
        if (item.url_documento !== null && item.url_documento !== "") {
          url = item.url_documento;
          target = 'target = "_Blank"';
        } else {
          url = 'javascript:void(0);';
          target = 'target = ""';
        }

        datos += '<div class="col-auto text-end">';
        datos += '<a href="' + url + '" ' + target + ' class="btn btn-outline-secondary btn-sm" download title="Descargar seguimiento">';
        datos += '<i class="bi bi-download"></i>';
        datos += '</a>';
        datos += '</div>';
        datos += '</div>';
      }); // fin forEach items

    }); // fin forEach grupos

    $("#seguimientosBuscarAprendiz").html(datos);
  }

  cargarCertificacion(datos) {
    let DatosLista = '';
    const ContenedorLista = document.getElementById("listaDocumentosCertificacion");
    ContenedorLista.innerHTML = "";
    datos.forEach(function (item, index) {
      let estado = "";
      let color = "";
      if (item.estado_archivo == "" || item.estado_archivo == null) {
        estado = "Sin Radicar";
        color = "bg-secondary";
      }
      else if (item.estado_archivo == "1") {
        estado = "Radicado";
        color = "bg-warning";
      }
      else if (item.estado_archivo == "2") {
        estado = "Aprobado";
        color = "bg-info";
      }
      else if (item.estado_archivo == "3") {
        estado = "Rechazado";
        color = "bg-danger";
      }

      DatosLista += `<li class="list-group-item d-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center gap-3">
              <i class="bi bi-file-earmark-pdf text-danger fs-4"></i>

              <div>
                  <div class="fw-semibold">${item.titulo_documento}</div>
              </div>
              </div>

              <div class="d-flex align-items-center gap-3">
              <span class="badge rounded-pill ${color}">${estado}</span>

              <a href="${item.url_documento}" class="btn btn-outline-primary btn-sm" download>
                  <i class="bi bi-download"></i>
                  Descargar
              </a>
              </div>
          </li>`;
    });

    ContenedorLista.innerHTML = DatosLista;
  }
}
