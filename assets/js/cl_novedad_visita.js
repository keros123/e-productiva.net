class Novedades {
    constructor (objDatos) {
        this._objNovedades = objDatos;
    }

    crearNovedad () {
        let objData = new FormData ();
        objData.append("novedad", this._objNovedades.novedad);
        objData.append("idVisita", this._objNovedades.idVisita);
        objData.append("creador", this._objNovedades.creador);
        objData.append("emailNovedad", this._objNovedades.emailNovedad);

        fetch(config.rutes["controllerSeguimientosPorTipo"], {
            method: 'POST',
            body: objData
        })
        .then(response => response.json()).catch(error => {
            mensaje = error;
        }).then(response => {
            if (response["codigo"] == "200") {
                Swal.fire({
                    icon: 'success',
                    title: 'Novedad agregada exitosamente.',
                    showConfirmButton: false,
                    timer: 1500
                })
                $("#modalNovedades_visita").modal("hide");
                $("#form_novedades")[0].reset();
                
                let objDatos = { "idVisita": this._objNovedades.idVisita};
                let objInfoAprendiz = new DetallesUsuario(objDatos);
                objInfoAprendiz.cargarNovedadesVisita(); 

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'hubo un problema al agregar la novedad!',
                })
            }

            if (response["creador"] == "administrador") {
                $(".enviando").hide("");
                $(".selectEstadoReporte").show("");
            }
        });
    }
}