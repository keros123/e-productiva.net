class certificarAprendizClass {
  constructor(objDatos) {
    this._objCertificacion = objDatos;
  }

  certificarAprendices() {
    $("#btnCertificar").attr("disabled", "true");
    var objData = new FormData();
    objData.append("idAprendiz", this._objCertificacion.idAprendiz);

    fetch(config.rutes["controllerCertificarAprendiz"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        console.error("Error en la petición:", error);
        Swal.fire({
          icon: "error",
          title: "Error de conexión",
          text: "Hubo un problema al conectar con el servidor. Intente nuevamente.",
          timer: 3000,
        });
      })
      .then((response) => {
        if (response) {
          if (response["codigo"] == "200") {
            Swal.fire({
              icon: "success",
              text: response["mensaje"],
              timer: 2500,
            });
            setTimeout(function () {
              let idFicha = $("#tablaAprendicesCertificacion").attr("idFicha");
              let objDatos = { idFicha: idFicha };
              let objAprendizFicha = new fichasCertificacion(objDatos);
              objAprendizFicha.cargarTablaAprendices();
              $(".fichasAsignadasCertificacion").hide();
              $(".documentosAprendiz").hide();
              $(".aprendicesCertificacionFicha").fadeIn(1500);
            }, 3000);
          } else {
            Swal.fire({
              icon: "error",
              title: "Oops...",
              text: response["mensaje"],
              timer: 2000,
            });
          }
        }
        $("#btnCertificar").removeAttr("disabled");
      });
  }
}