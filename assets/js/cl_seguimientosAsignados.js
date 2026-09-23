class SeguimientosInstructor {
    constructor (objDatos) {
        this._objSeguimientosAsignados = objDatos;
    }

    seguimientosAsignados () {
        let objData = new FormData ();
        objData.append("seguimientosAsignados", "");

        fetch(config.rutes["controllerSeguimientosAsignados"], {
            method: 'POST',
            body: objData
        })
        .then(response => response.json()).catch(error => {
            mensaje = error;
        }).then(response => {
            datos(response);
        });

        function datos (response) {
            let dataSet = [];
            let contadorSeguimientos = 0;
            response.forEach(Tabla);
            function Tabla (item, index) {
                let reporte = '';
                let url_documento = '';
                if (item.url_documento != null) {
                    url_documento += item.url_documento;
                }else{
                    url_documento += "vacio";
                }
                var objBotones = '<div class="btn-group" role="group" aria-label="Basic example">';
                objBotones += '<button class="btn btn-sm" id="btnVisualizar" idaprendiz="' + item.idaprendiz + '" idVisita="' + item.idvisita_seguimiento + '" title="Visualizar"><img  class="mc_iconTabla"  src="' + config.rutes["btnVisualizar"] + '" ></button>';
                objBotones += '<button class="btn btn-sm" id="btn_subirReporte" fecha_fin_practica="'+item.fecha_fin_practica_seguimiento+'" tipo_seguimiento="'+item.idtipo_seguimiento+'"  ficha="'+item.numero_ficha+'" aprendiz="' + item.documento + '" idVisita="' + item.idvisita_seguimiento + '" estado="'+ item.idestado_visita_seguimiento +'" ruta="'+ url_documento +'"  rutaJuicio="'+ item.url_juicio_evaluativo +'" title="Subir Reporte"><img  class="mc_iconTabla"  src="' + config.rutes["btnSubirReporte"] + '" ></button>';
                objBotones += '</div>';

                var nombre_aprendiz = item.nombres+" "+item.apellidos;
                
                if (item.estado_reporte == null || item.estado_reporte == '') {
                    reporte +='<div class="d-flex align-items-center gap-2">';
                    reporte +='<span class="bg-warning rounded-circle d-inline-block" style="width: 12px; height: 12px;"></span>';
                    reporte +='</div>';

                }else if (item.estado_reporte == 0) {
                    reporte +='<div class="d-flex align-items-center gap-2">';
                    reporte +='<span class="bg-primary rounded-circle d-inline-block" style="width: 12px; height: 12px;"></span>';
                    reporte +='</div>';
                }else if (item.estado_reporte == 1) {
                    reporte +='<div class="d-flex align-items-center gap-2">';
                    reporte +='<span class="bg-success rounded-circle d-inline-block" style="width: 12px; height: 12px;"></span>';
                    reporte +='</div>';
                }else{
                    reporte +='<div class="d-flex align-items-center gap-2">';
                    reporte +='<span class="bg-danger rounded-circle d-inline-block" style="width: 12px; height: 12px;"></span>';
                    reporte +='</div>';
                }

                let ubicacion = item.ubicacion_seguimiento
                if (item.ubicacion_seguimiento == "" || item.ubicacion_seguimiento == null) {
                    ubicacion = "No aplica"
                }
                contadorSeguimientos += 1;
                dataSet.push(['<span class="fw-medium text-dark">'+contadorSeguimientos+'</span>','<span class="fw-medium text-dark">'+item.nombre_tipo_seguimiento+'</span>','<span class="fw-medium text-dark">'+nombre_aprendiz+'</span>', item.fecha_radicado, item.fecha_vencimiento,item.fecha_fin_practica_seguimiento, ubicacion, item.fecha_entrega, '<span class="fw-medium text-dark">'+item.nombre_estado_visita_seguimiento+'</span>', reporte,objBotones]);
            }

            $("#tabla_seguimientosProgramados").DataTable({
                destroy: true,
                data: dataSet,
                responsive: true,
                language: {
                    "decimal": "",
                    "emptyTable": "No hay datos disponibles en la tabla",
                    "info": "visualizando _START_ de _END_ para un total de _TOTAL_ registros",
                    "infoEmpty": "visualizando 0 de 0 para un total de 0 registros",
                    "infoFiltered": "(filtrado de _MAX_ registros)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "No se encontraron registros coincidentes",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    },
                    "aria": {
                        "sortAscending": ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
                },
                rowCallback: function (row, data, index) {
                    $(row).css("font-size", "11.5px"); // Cambia el tamaño de la letra de cada fila
                }
            });
        }
    }

    async subirReporteSeguimiento () {
        let objData = new FormData ();
        objData.append("archivo", this._objSeguimientosAsignados.archivo);
        objData.append("ficha", this._objSeguimientosAsignados.ficha);
        objData.append("idVisita", this._objSeguimientosAsignados.idVisita);
        objData.append("aprendiz", this._objSeguimientosAsignados.aprendiz);
        objData.append("tipoUsuario", this._objSeguimientosAsignados.tipoUsuario);
        objData.append("rutaActual", this._objSeguimientosAsignados.rutaActual);
        objData.append("imagenJuicioEvaluativo", this._objSeguimientosAsignados.imagenJuicioEvaluativo);
        objData.append("rutaJuicio", this._objSeguimientosAsignados.rutaJuicio);

        fetch(config.rutes["controllerSeguimientosAsignados"], {
            method: 'POST',
            body: objData
        }).then(response => response.json()).catch(error => {
            console.log(error);
        }).then(response => {
            if (response["codigo"] == "200") {
                this.seguimientosAsignados();
                $("#modalSubirReporte").modal('hide');
                $("#txt_subirReporteSeguimiento").val("");
                Swal.fire({
                    icon: 'success',
                    title: 'Reporte subido Exitosamente',
                    showConfirmButton: false,
                    timer: 1500
                })
                
                setTimeout(function () {
                    $("#modalNovedades_visita").modal("show");
                },1000)
            } else {
                $("#modalSubirReporte").modal('hide');
                Swal.fire({
                    icon: 'warning',
                    title: 'Alerta!',
                    text: response["mensaje"],
                })
            }
        });
    }
}