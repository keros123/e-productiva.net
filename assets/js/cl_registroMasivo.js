class registroMasivo {

    constructor(objDatos) {
        this._objRegistroMasivo = objDatos;
    }

    subirArchivo() {
        var objData = new FormData();
        objData.append("archivo_xls", this._objRegistroMasivo.archivo);
        objData.append("ficha", this._objRegistroMasivo.ficha);
        objData.append("fichaId", this._objRegistroMasivo.fichaId);

        fetch(config.rutes["controllerRegistroMasivo"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                var idficha = $("#btn_excel").attr("fichaId");
                let objDatos = { "idListarFichasAprendiz": idficha };
                let objFicha = new Ficha(objDatos);
                objFicha.cargarAprendicesFichaSeleccionada();
                $("#contenedorLoader").fadeOut();

                if (response["codigo"] == "200") {
                    var registrados = response["mensaje"];
                    var ficha = response["ficha"];
                    let objDatos = { "registrados": registrados, "ficha": ficha };
                    let objAprendiz = new Aprendiz(objDatos);
                    objAprendiz.huellaRegistroMasivo();
                }
            });
    }

}