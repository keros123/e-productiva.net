class EtapaPractica {

    constructor(objDatosEtapaPractica) {
        this._objData = objDatosEtapaPractica;
    }


    registroMasivoEtapaPractica() {
        let objData = new FormData();
        objData.append("archivoEtapaPractica", this._objData.archivoEtapaPractica);
        objData.append("registroMasivoEtapaPractica", "ok");

        fetch(config.rutes["controllerRegistroMasivoEtapaPractica"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                $(this._objData.contenedorLoader).hide();
                // crear diseño de lista de errores 
                const nodoErrores = document.querySelector("#contenedorErrores");
                let listaAlertas = [];

                if (response["codigo"] == "200") {
                    const alerta = document.createElement('div');
                    alerta.className = "alert alert-success alert-dismissible";
                    alerta.innerHTML = "<strong>Felicitaciones!</strong> " + response["mensaje"];
                    const botonCierre = document.createElement('button');
                    botonCierre.className = "btn-close";
                    botonCierre.setAttribute("type", "button");
                    botonCierre.setAttribute("data-bs-dismiss", "alert");
                    alerta.append(botonCierre);
                    listaAlertas.push(alerta);
                } else {
                    response["listaErrores"].forEach(item => {
                        const alerta = document.createElement('div');
                        alerta.className = "alert alert-danger alert-dismissible";
                        alerta.innerHTML = "<strong>Alerta!</strong> " + item;
                        const botonCierre = document.createElement('button');
                        botonCierre.className = "btn-close";
                        botonCierre.setAttribute("type", "button");
                        botonCierre.setAttribute("data-bs-dismiss", "alert");
                        alerta.append(botonCierre);
                        listaAlertas.push(alerta);
                    });
                }

                nodoErrores.append(...listaAlertas);
                nodoErrores.style.display = 'block';

                let objData = { "listarEtapaPractica": "ok" };
                let objModalidad = new seguimientos(objData);
                objModalidad.listarDatosEtapaPractica();

                $(this._objData.contenedorTabla).fadeIn();
            });

    }
}