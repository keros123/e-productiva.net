<style>
.bitacora-box {
    width: 42px;
    height: 42px;
    border-radius: 0.45rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.8rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.15s ease;
}

.bitacora-box:hover {
    cursor: pointer;
    transform: translateY(-2px);
    box-shadow: 0 .2rem .4rem rgba(0,0,0,.2);
    opacity: 0.9;
}

.mc-ancor{
    color: white;
    text-decoration: none;
}


#imagenAprendiz {
    width: 150px;
    height: 150px;
    object-fit: cover;      /* Recorta sin deformar */
    border-radius: 50%;     /* Hace el círculo perfecto */
    object-position: center;
}

</style>


<div class="col-md-12">
    <div class="card mt-2 mb-2">
        <div class="card-body">
            <div class="row align-items-center">
                <!-- FOTO Y ESTADO -->
                <div class="col-md-3 d-flex flex-column align-items-center mb-3 mb-md-0">
                    <img 
                        id="imagenAprendiz"
                        src="assets/img/interface/profile.png"
                        class="rounded-circle img-thumbnail mb-2"
                        alt="Foto aprendiz"
                    >

                    <div class="small text-muted mt-2">Estado del aprendiz</div>
                    <span id="estadoAprendiz" class="badge bg-info px-3 py-2">
                        Activo
                    </span>
                </div>

                <!-- INFORMACIÓN PRINCIPAL -->
                <div class="col-md-9">
                    <h4 id="nombreAprendiz" class="fw-bold mb-1">
                        Nombres y Apellidos
                    </h4>

                    <p class="text-muted mb-3" id="documentoAprendiz">
                        Documento: 123456789
                    </p>

                    <div class="row g-3 small">

                        <div class="col-md-6">
                            <strong>Correo:</strong>
                            <div id="correoAprendiz" class="text-muted">
                                correo@ejemplo.com
                            </div>
                        </div>

                        <div class="col-md-6">
                            <strong>Teléfono:</strong>
                            <div id="telefonoAprendiz" class="text-muted">
                                300 000 0000
                            </div>
                        </div>

                        <div class="col-md-6">
                            <strong>Ficha:</strong>
                            <div id="fichaAprendiz" class="text-muted">
                                2456789 – Análisis y Desarrollo de Software
                            </div>
                        </div>

                        <div class="col-md-6">
                            <strong>Novedades:</strong>
                            <div id="novedadAprendiz" class="text-muted">
                                No Aplica
                            </div>
                        </div>

                        <div class="col-md-6">
                            <strong>Estado:</strong>
                            <div id="etapaAprendiz" class="text-muted">
                                Etapa práctica
                            </div>
                        </div>


                        <div class="col-md-6">
                            <strong>Formato GFPI-F-165:</strong>
                            <div class="text-muted">
                                <i class="bi bi-file-earmark-pdf text-danger fs-4"></i>
                                <span class="badge bg-danger">
                                    <a id="GFPI-F-165" href="#" class="mc-ancor">
                                        Descargar
                                    </a>
                                </span>
                            </span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <hr class="my-4">

            <!-- INFO DE ETAPA PRÁCTICA -->
            <h6 class="fw-semibold mb-3">
                Información Etapa Práctica
            </h6>

            <div id="contenedorEtapaPractica" class="row small g-3">
                
            </div>

            <hr class="my-4">

            <!-- INFO DE ETAPA PRÁCTICA -->
            <h6 class="fw-semibold mb-3">
                Seguimientos Etapa Práctica
            </h6>

            <div id="seguimientosBuscarAprendiz">
                <div class="row align-items-center g-3">
                    <!-- Foto instructor -->
                    <div class="col-auto">
                        <img 
                            id="fotoInstructor"
                            src="assets/img/interface/profile.png"
                            class="rounded-circle border"
                            width="70"
                            height="70"
                            alt="Foto instructor"
                        >
                    </div>

                    <!-- Información -->
                    <div class="col">
                        <div class="fw-semibold" id="nombreInstructor">
                            Instructor Encargado :  Marco Antonio Cipagauta Arbelaez
                        </div>

                        <div class="small text-muted" id="emailInstructor">
                            macipagauta@sena.edu.co
                        </div>

                        <div class="d-flex flex-wrap gap-2 mt-2 small">
                            <span class="badge bg-primary" id="tipoSeguimiento">
                                Seguimiento Momento Uno
                            </span>

                            <span class="badge bg-secondary" id="estadoSeguimiento">
                                Aprobado
                            </span>
                        </div>
                    </div>

                    <!-- Acción -->
                    <div class="col-auto text-end">
                        <a 
                            id="btnDescargarSeguimiento"
                            href="#"
                            class="btn btn-outline-secondary btn-sm"
                            download
                            title="Descargar seguimiento"
                        >
                            <i class="bi bi-download"></i>
                        </a>
                    </div>
                </div>
            </div>

            <hr class="my-4">


            <!-- espacio los seguimientos -->
            <div class="row mt-2 mb-2 p-2" id="contenedorSeguimientosCertificacion" aprendiz="">
                
            </div>

            <!-- INFO DE ETAPA BITACORAS -->
            <h6 class="fw-semibold mb-3">
                Bitacoras Etapa Práctica
            </h6>

            <!-- Leyenda -->
            <div class="d-flex justify-content-end">
                <div class="d-flex gap-3 small text-muted mb-3">
                    <div class="d-flex align-items-center gap-1">
                        <span class="rounded-circle bg-secondary" style="width:10px;height:10px;"></span>
                        Sin Entregar
                    </div>
                    <div class="d-flex align-items-center gap-1">
                        <span class="rounded-circle bg-warning" style="width:10px;height:10px;"></span>
                        Entregada
                    </div>

                    <div class="d-flex align-items-center gap-1">
                        <span class="rounded-circle bg-info" style="width:10px;height:10px;"></span>
                        Aprobada
                    </div>
                    
                    <div class="d-flex align-items-center gap-1">
                        <span class="rounded-circle bg-danger" style="width:10px;height:10px;"></span>
                        Rechazada
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2 pe-3" id="contenedorBitacoras">
               
            </div>

            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="flex-grow-1">
                    <div class="progress" style="height: 6px;">
                        <div 
                            id="progressBitacoras"
                            class="progress-bar bg-primary"
                            role="progressbar"
                            style="width: 100%"
                        ></div>
                    </div>
                </div>

                <div class="small text-muted" id="textoProgresoBitacoras">
                    12 / 12
                </div>
            </div>

            <hr class="my-4">

            <div class="table-responsive">
                <table id="tablaDocumentosAprendices" idAprendiz="" class="table table-striped align-middle table table-sm border-top  border-bottom" style="width: 100%;">
                    <thead class="">
                        <tr>
                            <th class="text-nowrap text-center ">Título del Documento</th>
                            <th class="text-nowrap text-center ">novedad</th>
                            <th class="text-nowrap text-center ">Estado</th>
                            <th class="text-nowrap text-center "></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>


            <div class="d-grid gap-2 d-md-block" id="btn">
                <button type="button" class="btn btn-dark atras_FichaAprendices mt-3">Regresar</button>
                <!-- <button type="button" id="btnGenerarPdf" aprendiz="1639" style="display:inline-flex; place-items:center" class="btn btn-primary mt-3">
                    Generar pdf 
                    <div role="status" id="btnGenerarPdfSpiner" class="mx-2 spinner-border spinner-border-sm" style="color:#ffff; display: none;">
                    </div>
                </button> -->
                <button type="button" id="btnCertificar" class="btn btn-primary mt-3">
                    Certificar
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="imagenModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content  border-0">

            <!-- Header con botón cerrar -->
            <div class="modal-header border-0">
                <!-- <h5 class="modal-title">Vista de imagen</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body text-center p-0">
                <img id="imagenJuicio" src="" class="img-fluid rounded" alt="Imagen">
            </div>
        </div>
    </div>
</div>


<script src="assets/js/cl_generarPdfCertificacion.js"></script>
<script src="assets/js/cl_certificarAprendiz.js"></script>
<script async defer src="vista/js/certificarAprendiz.js"></script>
<script async defer src="vista/js/aprendizCertificacion.js"></script>
