<script async defer src="vista/js/detalleAprendiz.js"></script>

<style>
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

<div class="card shadow-sm border-0">
    <div id="PanelPrincipalDetalleAprendiz" style="display: none;" class="card-body">
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
                    <span id="" class="badge bg-info px-3 py-2">
                        Activo
                    </span>
                </div>

                <!-- INFORMACIÓN PRINCIPAL -->
                <div class="col-md-9">
                    <h4 id="nombreAprendiz" class="fw-bold mb-1">
                        Nombres y Apellidos
                    </h4>

                    <p class="text-muted mb-3" id="documentoAprendiz">
                       
                    </p>

                    <div class="row g-3 small">
                        <div class="col-md-6">
                            <strong>Correo:</strong>
                            <div id="correoAprendiz" class="text-muted">
                                
                            </div>
                        </div>

                        <div class="col-md-6">
                            <strong>Teléfono:</strong>
                            <div id="telefonoAprendiz" class="text-muted">
                               
                            </div>
                        </div>

                        <div class="col-md-6">
                            <strong>Ficha:</strong>
                            <div id="fichaAprendiz" class="text-muted">
                                
                            </div>
                        </div>

                        <div class="col-md-6">
                            <strong>Novedades:</strong>
                            <div id="novedadAprendiz" class="text-muted">

                            </div>
                        </div>

                        <div class="col-md-6">
                            <strong>Estado:</strong>
                            <div id="etapaAprendiz" class="text-muted">

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


            <div id="contenedorEtapaPracticaAprendiz" class="row small g-3">
                <div class="col-md-4">
                    <strong>Modalidad:</strong>
                    <div id="modalidadPractica" class="text-muted">
                    
                    </div>
                </div>

                <div class="col-md-4">
                    <strong>Fecha inicio:</strong>
                    <div id="fechaInicioPractica" class="text-muted">
                       
                    </div>
                </div>

                <div class="col-md-4">
                    <strong>Fecha fin:</strong>
                    <div id="fechaFinPractica" class="text-muted">
                        
                    </div>
                </div>

                <div class="col-md-6">
                    <strong>Empresa:</strong>
                    <div id="empresaAprendiz" class="text-muted">
                        
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <h6 class="fw-semibold mb-3">
                Seguimientos Etapa Práctica
            </h6>


            <div id="seguimientosAprendiz">
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

            <div class="row" id="bitacoras">
            </div>


            <div class="d-grid gap-2 d-md-block bt-3">
                <button type="button" class="btn btn-dark volver_seguimientosAsignados" style="display: none;">Regresar</button>
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