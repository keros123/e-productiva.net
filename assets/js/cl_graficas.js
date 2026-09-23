class Seguimiento {
  constructor(objData) {
    this._objDataGrafica = objData;
  }

  DatoSeguimientos() {
    let mensaje;
    let objdatos = new FormData();
    objdatos.append("listarSeguimientos", this._objDataGrafica);

    fetch(config.rutes["controllerGraficas"], {
      method: "POST",
      body: objdatos,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error;
      })
      .then((response) => {
        // console.log(response.listaSeguimientos);
        if (response["codigo"] == "200") {
          let datosUsuarios = [];
          response["listaSeguimientos"].forEach((item) => {
            datosUsuarios.push([item.mes, item.realizados, item.pendientes]);
          });

          console.log(datosUsuarios);

          $("#container").html(JSON.stringify(datosUsuarios));
        } else {
          console.log(response.mensaje);
        }
      });
  }

  DatosRealizados() {
    let mensaje;

    let objdatos = new FormData();
    objdatos.append("listarRealizados", this._objDataGrafica);

    fetch(config.rutes["controllerGraficas"], {
      method: "POST",
      body: objdatos,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error;
      })
      .then((response) => {
        console.log(response.listaRealizados);
        if (
          response.codigo == "200" &&
          Array.isArray(response.listaRealizados)
        ) {
          let datosUsuarios = [];
          response.listaRealizados.forEach((item) => {
            datosUsuarios.push([item.seguimientos_radicados]);
          });
          $("#container").html(JSON.stringify(datosUsuarios));
        } else {
          console.log(response.mensaje);
        }
      });
  }

  DatosPendientes() {
    let mensaje;

    let objdatos = new FormData();
    objdatos.append("listarPendientes", this._objDataGrafica);

    fetch(config.rutes["controllerGraficas"], {
      method: "POST",
      body: objdatos,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error;
      })
      .then((response) => {
        console.log(response.listaPendientes);
        if (
          response.codigo == "200" &&
          Array.isArray(response.listaPendientes)
        ) {
          let datosUsuarios = [];
          response.listaPendientes.forEach((item) => {
            datosUsuarios.push([item.seguimientos_pendientes]);
          });
          $("#container").html(JSON.stringify(datosUsuarios));
        } else {
          console.log(response.mensaje);
        }
      });
  }

  DatosAsignados() {
    let mensaje;

    let objdatos = new FormData();
    objdatos.append("listarAsignados", this._objDataGrafica);

    fetch(config.rutes["controllerGraficas"], {
      method: "POST",
      body: objdatos,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error;
      })
      .then((response) => {
        console.log(response.listaAsignados);
        if (
          response.codigo == "200" &&
          Array.isArray(response.listaAsignados)
        ) {
          let datosUsuarios = [];
          response.listaAsignados.forEach((item) => {
            datosUsuarios.push([item.seguimientos_asignados]);
          });
          $("#container").html(JSON.stringify(datosUsuarios));
        } else {
          console.log(response.mensaje);
        }
      });
  }

  DatosTotal() {
    let mensaje;

    let objdatos = new FormData();
    objdatos.append("listarTotal", this._objDataGrafica);

    fetch(config.rutes["controllerGraficas"], {
      method: "POST",
      body: objdatos,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error;
      })
      .then((response) => {
        console.log(response.listaTotal);
        if (response.codigo == "200" && Array.isArray(response.listaTotal)) {
          let datosUsuarios = [];
          response.listaTotal.forEach((item) => {
            datosUsuarios.push([item.total_seguimientos]);
          });
          $("#total").html(JSON.stringify(datosUsuarios));
        } else {
          console.log(response.mensaje);
        }
      });
  }

  DatosVencidos() {
    let mensaje;

    let objdatos = new FormData();
    objdatos.append("listarVencidos", this._objDataGrafica);

    fetch(config.rutes["controllerGraficas"], {
      method: "POST",
      body: objdatos,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error;
      })
      .then((response) => {
        console.log(response.listaVencidos);
        if (response.codigo == "200" && Array.isArray(response.listaVencidos)) {
          let datosUsuarios = [];
          response.listaVencidos.forEach((item) => {
            datosUsuarios.push([item.total_seguimientos]);
          });
          $("#container").html(JSON.stringify(datosUsuarios));
        } else {
          console.log(response.mensaje);
        }
      });
  }

  MostrarCertificacion() {
    let mensaje;

    let objdatos = new FormData();
    objdatos.append("listarCertificacion", this._objDataGrafica);

    fetch(config.rutes["controllerGraficas"], {
      method: "POST",
      body: objdatos,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error;
      })
      .then((response) => {
        console.log(response.listaCertificacion);
        if (
          response.codigo == "200" &&
          Array.isArray(response.listaCertificacion)
        ) {
          let datosUsuarios = [];
          response.listaCertificacion.forEach((item) => {
            datosUsuarios.push([item.total_certificacion]);
          });
          $("#container").html(JSON.stringify(datosUsuarios));
        } else {
          console.log(response.mensaje);
        }
      });
  }

  cargarYears() {
    let mensaje;
    let objdatos = new FormData();
    objdatos.append("cargarYears", "ok");

    fetch(config.rutes["controllerGraficas"], {
      method: "POST",
      body: objdatos,
    })
      .then((response) => response.json())
      .catch((error) => {
        mensaje = error;
      })
      .then((response) => {
        console.log(response)
        let dataSelect = '';
        response.forEach(function (item, index) {
          dataSelect += `<option value="${item.Year}>${item.Year}</option>"`;
        })
        $("#selectYear").html(dataSelect);
      });
  }
  
}
