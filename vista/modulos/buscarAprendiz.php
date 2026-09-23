<script src="assets/js/cl_buscarAprendiz.js"></script>
<script async defer src="vista/js/buscarAprendiz.js"></script>

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

<div class="container-xxl flex-grow-1 container-p-y col-12" >

    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Panel Administrativo /</span> Buscar aprendiz
    </h4>

    <div class="row">
        <div class="col-md-5 mb-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form id="form-buscarAprendiz" class="needs-validation" novalidate>
                            <div class="col-12">
                                <label for="txt-documento">Documento del aprendiz</label>
                                <div class=" mt-2 input-group" role="group">
                                    <input type="text" id="txt-documento" placeholder="" class="form-control" required />
                                    <button type="submit" id="btn-busqueda" class="btn btn-secondary" data-mdb-ripple-init>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                        </svg>
                                    </button>
                                </div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor Ingrese un dato valido.</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div id="PanelPrincipalBusqueda" style="display: none;" class="card-body">
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
                <div class="col-md-12">
                    <strong>Empresa:</strong>
                    <h6 id="empresaAprendiz" class="text-muted">
                        Empresa XYZ
                    </h6>
                </div>

                <div class="col-md-12">
                    <strong>Observaciones:</strong>
                    <h6 id="observacionesPractica" class="text-muted">
                        Empresa XYZ
                    </h6>
                </div>

                <div class="col-md-4">
                    <strong>Modalidad:</strong>
                    <h6 id="modalidadPractica" class="text-muted">
                        C. Aprendizaje
                    </h6>
                </div>

                <div class="col-md-4">
                    <strong>Fecha inicio:</strong>
                    <h6 id="fechaInicioPractica" class="text-muted">
                        01/02/2026
                    </h6>
                </div>

                <div class="col-md-4">
                    <strong>Fecha fin:</strong>
                    <h6 id="fechaFinPractica" class="text-muted">
                        01/08/2026
                    </h6>
                </div>

                
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
                <!-- Bitácoras dinámicas -->
                <div class="bitacora-box bg-success text-white" title="Descargar">
                    B1
                </div>
                <div class="bitacora-box bg-success text-white" title="Descargar">
                    B2
                </div>
                <div class="bitacora-box bg-success text-white" title="Descargar">
                    B3
                </div>
                <div class="bitacora-box bg-success text-white" title="Descargar">
                    B4
                </div>
                <div class="bitacora-box bg-warning text-white" title="Descargar">
                    B5
                </div>
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

            <div class="accordion mt-3 mb-3" id="acordeonBitacorasDetalle">
                <div class="accordion-item border-0 shadow-sm">
                    <h2 class="accordion-header" id="headingBitacoras">
                        <button class="accordion-button collapsed py-2 text-muted fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBitacoras" aria-expanded="false" aria-controls="collapseBitacoras">
                            <i class="bi bi-info-circle me-2"></i> Detalles de revisión de bitácoras
                        </button>
                    </h2>
                    <div id="collapseBitacoras" class="accordion-collapse collapse" aria-labelledby="headingBitacoras" data-bs-parent="#acordeonBitacorasDetalle">
                        <div class="accordion-body px-0" id="detalleBitacorasBody">
                            <!-- Los detalles de las bitácoras se cargarán dinámicamente aquí -->
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <!-- INFO DE Documentos Certificacion -->
            <h6 class="fw-semibold  mb-3">
                Documentos Certificación
            </h6>



            <div class="container my-4">
                <!-- <div class="card shadow-sm"> -->
                    <!-- <div class="card-header fw-semibold">
                        Documentos adjuntos
                    </div> -->

                    <ul id="listaDocumentosCertificacion" class="list-group list-group-flush">

                    <!-- Documento -->
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-file-earmark-pdf text-danger fs-4"></i>

                            <div>
                                <div class="fw-semibold">Contrato de prestación de servicios</div>
                                <small class="text-muted">Subido: 02/02/2026</small>
                            </div>
                            </div>

                            <div class="d-flex align-items-center gap-3">
                            <span class="badge bg-success">Aprobado</span>

                            <a href="#" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-download"></i>
                                Descargar
                            </a>
                            </div>
                        </li>

                        <!-- Documento -->
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                            <i class="bi bi-file-earmark-text text-secondary fs-4"></i>

                            <div>
                                <div class="fw-semibold">Informe técnico</div>
                                <small class="text-muted">Subido: 28/01/2026</small>
                            </div>
                            </div>

                            <div class="d-flex align-items-center gap-3">
                            <span class="badge bg-warning text-dark">Pendiente</span>

                            <a href="#" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-download"></i>
                                Descargar
                            </a>
                            </div>
                        </li>

                    </ul>
                <!-- </div> -->
            </div>

            <span class="badge bg-secondary">Sin Radicar</span>
            <span class="badge bg-warning ">Radicado</span>
            <span class="badge bg-info">Aprobado</span>
            <span class="badge bg-danger">Rechazado</span>
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
</div>
