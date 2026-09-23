class Archivos {

    constructor(objDatos) {
        this._objArchivo = objDatos;
    }


    subirArchivo() {
        let objData = new FormData();
        objData.append("subirArchivoImagen", this._objArchivo["archivo"]);
        objData.append("usuarioArchivo", this._objArchivo["usuarioArchivo"]);
        objData.append("tipoUsuarioArchivo", this._objArchivo["tipoUsuarioArchivo"]);

        fetch(config.rutes["controllerArchivos"], {
                method: 'POST',
                body: objData
            })
            .then(response => response.json()).catch(error => {
                mensaje = error;
            }).then(response => {
                $("#imgUsuarioPerfil").attr("src", response["mensaje"]);
                $("#imgUsuarioPerfil2").attr("src", response["mensaje"]);
                Swal.fire({
                    title: 'Felicitaciones!',
                    text: 'Imagen modificada correctamente.',
                    imageUrl: response["mensaje"],
                    imageWidth: 180,
                    imageHeight: 200,
                    imageAlt: 'Custom image',
                })
            });
    }

}