//fpdi
class generarPdfCertificacionClass {
    constructor(objDatos) {
        this._objCertificacion = objDatos;
    }

    generarPdfCertificacion() {
        $("#btnGenerarPdf").attr("disabled","true");
        $("#btnGenerarPdfSpiner").css({display:"block"})
        var objData = new FormData();
        objData.append("idAprendiz", this._objCertificacion.idAprendiz);

        let idAprendiz = this._objCertificacion.idAprendiz;
        fetch(config.rutes["controllerGenerarPdfCertificacion"], {
            method: "POST",
            body: objData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Error en la solicitud");
                }
                return response.json();
            })
            .then((response) => {
                //espacio para recibir las respuestas del proceso
                console.log(response);
                if (response["codigo"] == 200) {
                    Swal.fire({
                        icon: "success",
                        text: "Solicitud completada con exito.",
                        timer: 2500
                    });
                    setTimeout(function () {
                        var rutaArchivo = response["mensaje"].substring(3);
                        var link = $('<a style="display: none;"></a>');
                        $("#btn").append(link);
                        link.attr('href', rutaArchivo);
                        link.attr('download', 'certificación_' + idAprendiz + '.pdf');
                        link[0].click();
                        link.remove();
                    }, 3000)
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: response["mensaje"],
                        timer: 2000
                    });
                }
                $("#btnGenerarPdf").removeAttr("disabled");
                $("#btnGenerarPdfSpiner").css({display:"none"})
            })
            .catch((error) => {
                console.error("Error al generar el documento:", error);
            });
    }

}