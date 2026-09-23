class ubicacion {
    constructor(objDatos) {
        this._objUbicacion = objDatos;
    }

    departamentos() {
        let objData = new FormData;
        objData.append(this._objUbicacion["cargarSelectDepartamentos"], "ok");
        fetch(config.rutes["controllerUbicacion"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                var estructuraSelect = '';
                var editarSelect = this._objUbicacion["editarSelect"];
                var idDepartamento = this._objUbicacion["idDepartamento"];
                if (editarSelect) {
                    estructuraSelect += '<option value="' + this._objUbicacion["idDepartamento"] + '">' + this._objUbicacion["nombreDepartamento"] + '</option>';
                }

                response.forEach(cargarSelectDepartamentosAccount);

                function cargarSelectDepartamentosAccount(item, index) {
                    if (editarSelect) {
                        if (item.codi_depa != idDepartamento) {
                            estructuraSelect += '<option value="' + item.codi_depa + '">' + item.nomb_depa + '</option>';
                        }
                    } else {
                        estructuraSelect += '<option value="' + item.codi_depa + '"><' + item.nomb_depa + '></option>';
                    }
                }

                $(this._objUbicacion["idSelectHtml"]).html(estructuraSelect);
            });
    }



    municipios() {
        let objData = new FormData;
        objData.append(this._objUbicacion["cargarSelectMunicipios"], "ok");
        objData.append("idDepartamento", this._objUbicacion["idDepartamento"]);

        fetch(config.rutes["controllerUbicacion"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                var estructuraSelect = '';
                var editarSelect = this._objUbicacion["editarSelect"];
                var idMunicipio = this._objUbicacion["idMunicipio"];
                if (editarSelect) {
                    estructuraSelect += '<option value="' + this._objUbicacion["idMunicipio"] + '">' + this._objUbicacion["nombreMunicipio"] + '</option>';
                }

                response.forEach(cargarSelectMunicipiosAccount);

                function cargarSelectMunicipiosAccount(item, index) {
                    if (editarSelect) {
                        if (item.codi_muni != idMunicipio) {
                            estructuraSelect += '<option value="' + item.codi_muni + '">' + item.nomb_muni + '</option>';
                        }
                    } else {
                        estructuraSelect += '<option value="' + item.codi_muni + '">' + item.nomb_muni + '</option>';
                    }
                }

                $(this._objUbicacion["idSelectHtml"]).html(estructuraSelect);
            });
    }
}