function listarDocumentos() {
    let objData = new FormData();
    objData.append("ListarCertificacion", "ok");
    objData.append(
        "aprendiz",
        document.getElementById("contenedorPrincipal").getAttribute("aprendiz")
    );

    fetch(config.rutes["controllerCertificacion"], {
            method: "POST",
            body: objData,
        })
        .then((response) => response.json())
        .then((response) => {
            datos(response);
        })
        .catch((error) => {
            console.log(error);
        });

    function datos(response) {
        let dataSet = [];
        response.mensaje.forEach((item) => {
                    let objBotones = `<div class="btn-group" role="group" aria-label="Basic example">${item.url_documento? `<a type="button" class="btn btn-sm" href="${item.url_documento}" target="_blank" title="Ver Documento"><img class="mc_iconTabla" src="${config.rutes["btnVisualizar"]}"></a>`: ""}<button id="btnModalDocumentos" idcertificacion="${item.idcertificacion}" type="button" class="btn btn-warning btnModalDocumentos" title="Subir Archivo" data-titulodocumento="${item.titulo_documento}" data-bs-toggle="modal" data-bs-target="#modalId"><i class="bx bx-cloud-upload"></i></button>${item.url_documento ? `<button class="btn btn-danger btnEliminarFila" title="Eliminar Fila" data-idcertificacion="${item.idcertificacion}"><i class="bx bx-trash"></i></button>`: ""}</div>`;
                    let estado_archivo = '';
                    if (item["estado_archivo"] == ""){
                      estado_archivo += '<span class="badge bg-label-danger me-1">Sin Radicar</span>';
                    }else if (item["estado_archivo"] == "1"){
                      estado_archivo += '<span class="badge bg-label-success me-1">Radicado</span>';
                    }else if (item["estado_archivo"] == "2"){
                      estado_archivo += '<span class="badge bg-label-info me-1">Aprobado</span>';
                      objBotones = `<div class="btn-group" role="group" aria-label="Basic example">${item.url_documento? `<a type="button" class="btn btn-sm" href="${item.url_documento}" target="_blank" title="Ver Documento"><img class="mc_iconTabla" src="${config.rutes["btnVisualizar"]}" ></a>`: ""}<button id="btnModalDocumentos" idcertificacion="${item.idcertificacion}" type="button" class="btn btn-warning btnModalDocumentos" title="Subir Archivo" data-titulodocumento="${item.titulo_documento}" data-bs-toggle="modal" data-bs-target="#modalId" disabled><i class="bx bx-cloud-upload"></i></button>${item.url_documento ? `<button class="btn btn-danger btnEliminarFila" title="Eliminar Fila" data-idcertificacion="${item.idcertificacion}" disabled><i class="bx bx-trash"></i></button>`: ""}</div>`;
                    }else if (item["estado_archivo"] == "3"){
                      estado_archivo += '<span class="badge bg-label-danger me-1">Rechazado</span>';
                    }

                    let novedad = "";
                    if (item.novedad_archivo == "" || item.novedad_archivo == ""){
                        novedad = "Sin Novedad";
                    }else{
                        novedad = item.novedad_archivo;
                    }

                    dataSet.push([item.titulo_documento, novedad,estado_archivo,objBotones]);
      });

      $("#tabla_DocumentosCertificacion").DataTable({
        destroy: true,
        data: dataSet,
        responsive: true,
        language: {
          decimal: "",
          emptyTable: "No hay datos disponibles en la tabla",
          info: "visualizando _START_ de _END_ para un total de TOTAL registros",
          infoEmpty: "visualizando 0 de 0 para un total de 0 registros",
          infoFiltered: "(filtrado de MAX registros)",
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
      });
  }
}

$(document).on("click", ".btnModalDocumentos", function () {
  let tituloDocumento = $(this).data("titulodocumento");
  $("#tituloDocumentoCertificacion").val(tituloDocumento);
});

$(document).on("click", ".btnEliminarFila", function () {
  let idCertificacion = $(this).data("idcertificacion");
  eliminarFila(idCertificacion);
});

function eliminarFila(idCertificacion) {
  Swal.fire({
    title: "¿Estás seguro?",
    text: "¿Estás seguro de que deseas eliminar este archivo?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Sí, eliminar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      let objData = new FormData();
      objData.append("EliminarRegistro", "ok");
      objData.append("idcertificacion", idCertificacion);

      fetch(config.rutes["controllerCertificacion"], {
        method: "POST",
        body: objData,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.codigo == "200") {
            listarDocumentos();
            Swal.fire({
              icon: "success",
              title: "Éxito",
              text: data.mensaje,
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: data.mensaje,
            });
          }
        })
        .catch((error) => {
          console.error("Error al eliminar el registro:", error);
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "Error al eliminar el registro",
          });
        });
    }
  });
}

document
  .getElementById("formularioPdfDocumentos")
  .addEventListener("submit", (event) => {
    event.preventDefault();

    const formData = new FormData();
    formData.append(
      "tituloDocumentoCertificacion",
      document.getElementById("tituloDocumentoCertificacion").value
    );
    formData.append(
      "archivoDocumento",
      document.getElementById("txt_file_certificacion").files[0]
    );
    formData.append(
      "aprendiz",
      document.getElementById("contenedorPrincipal").getAttribute("aprendiz")
    );
    formData.append("subirArchivosCertificacion", "ok");

    fetch(config.rutes["controllerCertificacion"], {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((data) => {
        listarDocumentos();
        $("#txt_file_certificacion").val("")
        if (data["codigo"] == "200") {
          $("#modalId").modal("toggle");
          Swal.fire({
            icon: "success",
            title: data["mensaje"],
            showConfirmButton: false,
            timer: 1500,
          });
        } else if (data["codigo"] == "401") {
          Swal.fire({
            icon: "error",
            title: "Oops...",
            text: data["mensaje"],
          });
        }
      })
      .catch((error) => {
        console.error("Error en la conexión con el servidor:", error);
        Swal.fire({
          icon: "error",
          title: "Oops...",
          text: "Error en la conexión con el servidor",
        });
      });
  });

(function () {
  listarDocumentos();
})();