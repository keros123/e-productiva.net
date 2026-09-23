$(function () {
    $("#btnCertificar").on("click", function () {
        Swal.fire({
            title: "Esta a punto de certificar al aprendiz.",
            text: "Reviza que el aprendiz cumpla con todas las condiciones de certificación.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Certificar",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).attr("aprendiz")
                certificarAprendiz(id);
            }
        });
    })

    function certificarAprendiz(idAprendiz) {
        let objDatos = { "idAprendiz": idAprendiz};
        let objPdf = new certificarAprendizClass(objDatos);
        objPdf.certificarAprendices();
    }

})