class aprendicesCertificados {
  constructor(objDatos) {
    this._objCertificacion = objDatos
  }

  cargarAprendicesCertificadosClass() {
    var objData = new FormData()
    objData.append("aprendicesCertificadosData", this._objCertificacion.aprendicesCertificadosData)

    fetch(config.rutes["controllerAprendicesCertificados"], {
      method: "POST",
      body: objData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Error en la solicitud")
        }
        return response.json()
      })
      .then((response) => {
        datosTabla(response)
      })
      .catch((error) => {
        console.error("Error al cargar la tabla:", error)
      })

    function datosTabla(response) {
      var dataSet = []
      response.forEach((item, index) => {
        let fotoUrl = item.foto ? item.foto : "assets/img/interface/profile.png";
        let imgHtml = `<img src="${fotoUrl}" alt="Foto" style="width: 32px; height: 32px; object-fit: cover;" class="rounded-circle me-2 border">`;
        const nombres = imgHtml + "<span>" + item.nombres + " " + item.apellidos + "</span>";
        const ficha = item.numero_ficha;

        // Usar los campos correctos o valores por defecto
        const municipio = item.municipio || ""
        const departamento = item.departamento || ""
        const nombreEmpresa = item.nombre_empresa || ""
        const direccionEmpresa = item.direccion_empresa || ""

        let objBotones = `<button id="verDetalles" type="button" class="btn btn-primary btn-sm btnVerDocumentos" data-bs-toggle="tooltip" data-bs-placement="top" title="Datos del Aprendiz" documento="${item.documento}" nombres="${item.nombres}"  telefono="${item.telefono}" email="${item.email}" ficha="${ficha + "-" + item.caracterizacion}" finPractica="${item.fin_practica}" fechaCertificacion="${item.fecha_certificacion}" modalidad="${item.modalidad}" municipio="${item.municipio}" departamento="${item.departamento}" nombreEmpresa="${nombreEmpresa}" direccion="${direccionEmpresa}" foto="${item.foto}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                                            <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5"/>
                                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                            </svg></button>`;

        let modalidad = `<span class="badge bg-info">${item.modalidad}</span>`;

        dataSet.push([
          `<strong>${item.fecha_certificacion}</strong>`,
          ficha,
          item.caracterizacion,
          item.documento,
          nombres,
          modalidad,
          municipio,
          departamento,
          nombreEmpresa,
          direccionEmpresa,
          objBotones,
        ])
      })

      $(document).ready(() => {
        $("#tabla_AprendicesCertificados").DataTable({
          buttons: [
            {
              extend: "colvis",
              text: '<i class="bx bx-columns"></i>',
              titleAttr: "Columnas Visibles",
              className: "btn btn-dark btn-sm"
            },
            {
              extend: "excel",
              text: '<i class="bx bx-file"></i>',
              titleAttr: "Exportar a Excel",
              className: "btn btn-secondary btn-sm"
            },
            {
              extend: "print",
              text: '<i class="bx bx-printer"></i>',
              titleAttr: "Imprimir",
              className: "btn btn-primary btn-sm"
            },
          ],
          dom: "Bfrtip",
          destroy: true,
          data: dataSet,
          responsive: true,
          order: [[0, "desc"]], // Ordenar descendentemente por la primera columna (índice 0)
          columnDefs: [
            {
              // Ocultar por defecto las columnas de Municipio (5), Departamento (6), Empresa (7) y Dirección (8)
              targets: [2, 6, 7, 8, 9],
              visible: false,
            },
          ],
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
          initComplete: function (settings, json) {
            // Mostrar la tabla una vez que DataTables ha terminado de inicializarse
            $("#tabla_AprendicesCertificados").closest('.table-responsive').css('visibility', 'visible');
          }
        })
      })
    }
  }
}


