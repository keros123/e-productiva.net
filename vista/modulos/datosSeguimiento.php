<div class="row detallesSeguimientoPorTipo" style="display:none;">
    <div class="col-12 mb-3 mt-3">
        <button type="button" class="btn btn-outline-dark btn-sm volver_datosSeguimiento" data-bs-toggle="tooltip" data-bs-placement="top" title="Regresar">
            <i class="bx bx-arrow-back me-1"></i>Regresar a la lista
        </button>
    </div>

    <!-- Columna Izquierda (Perfiles) -->
    <div class="col-lg-4 col-md-5">
        <!-- Tarjeta Aprendiz -->
        <div class="card shadow-sm mb-4 border-0 rounded-3">
            <div class="card-body text-center p-4">
                <h5 class="text-primary mb-3 fw-bold"><i class="bx bx-user me-2"></i>Aprendiz</h5>
                <img id="imagenAprendiz" src="assets/img/interface/profile.png" alt="user-avatar" class="rounded-circle mb-3 border border-4 border-light shadow-sm" height="130" width="130" style="object-fit: cover;" />
                <h5 id="nombreAprendiz" class="fw-bold mb-1">Cargando...</h5>
                <p class="text-muted mb-2 small" id="documentoAprendiz"></p>
                
                <div class="d-flex justify-content-center flex-wrap gap-1 mb-4">
                    <span id="etapaAprendiz" class="badge bg-primary"></span>
                </div>
                
                <ul class="list-group list-group-flush text-start small">
                    <li class="list-group-item px-0 pb-2 border-0 d-flex align-items-center">
                        <div class="bg-label-primary p-2 rounded me-3">
                            <i class="bx bx-hash fs-5 text-primary"></i>
                        </div>
                        <div>
                            <span class="d-block text-muted" style="font-size: 0.75rem;">Ficha y Programa</span>
                            <strong id="fichaAprendiz" class="d-block text-truncate" style="max-width: 200px;"></strong>
                        </div>
                    </li>
                    <li class="list-group-item px-0 pb-2 border-0 d-flex align-items-center">
                        <div class="bg-label-info p-2 rounded me-3">
                            <i class="bx bx-envelope fs-5 text-info"></i>
                        </div>
                        <div>
                            <span class="d-block text-muted" style="font-size: 0.75rem;">Correo Electrónico</span>
                            <strong id="correoAprendiz"></strong>
                        </div>
                    </li>
                    <li class="list-group-item px-0 pb-2 border-0 d-flex align-items-center">
                        <div class="bg-label-success p-2 rounded me-3">
                            <i class="bx bx-phone fs-5 text-success"></i>
                        </div>
                        <div>
                            <span class="d-block text-muted" style="font-size: 0.75rem;">Teléfono</span>
                            <strong id="telefonoAprendiz"></strong>
                        </div>
                    </li>
                    <li class="list-group-item px-0 pb-0 border-0 d-flex align-items-center">
                        <div class="bg-label-warning p-2 rounded me-3">
                            <i class="bx bx-info-circle fs-5 text-warning"></i>
                        </div>
                        <div>
                            <span class="d-block text-muted" style="font-size: 0.75rem;">Novedad Aprendiz</span>
                            <strong id="novedadAprendiz"></strong>
                        </div>
                    </li>
                </ul>
                <div id="seguimientosAprendiz" class="mt-3"></div>
            </div>
        </div>

        <!-- Tarjeta Funcionario -->
        <div class="card shadow-sm mb-4 border-0 rounded-3">
            <div class="card-body text-center p-4">
                <h5 class="text-primary mb-3 fw-bold"><i class="bx bx-briefcase me-2"></i>Instructor</h5>
                <img id="imagenFuncionario" src="assets/img/interface/profile.png" alt="user-avatar" class="rounded-circle mb-3 border border-4 border-light shadow-sm" height="110" width="110" style="object-fit: cover;" />
                <h6 id="nombresFuncionario" class="fw-bold mb-1 fs-5">Cargando...</h6>
                <p id="txt_rolI" class="text-muted mb-3 small"></p>
                
                <ul class="list-group list-group-flush text-start small">
                    <li class="list-group-item px-0 pb-2 border-0 d-flex align-items-center">
                        <div class="bg-label-secondary p-2 rounded me-3">
                            <i class="bx bx-id-card fs-5 text-secondary"></i>
                        </div>
                        <div>
                            <span class="d-block text-muted" style="font-size: 0.75rem;">Documento</span>
                            <strong id="txt_documentoId"></strong>
                        </div>
                    </li>
                    <li class="list-group-item px-0 pb-2 border-0 d-flex align-items-center">
                        <div class="bg-label-info p-2 rounded me-3">
                            <i class="bx bx-envelope fs-5 text-info"></i>
                        </div>
                        <div>
                            <span class="d-block text-muted" style="font-size: 0.75rem;">Correo Electrónico</span>
                            <strong id="txt_emailI"></strong>
                        </div>
                    </li>
                    <li class="list-group-item px-0 pb-2 border-0 d-flex align-items-center">
                        <div class="bg-label-success p-2 rounded me-3">
                            <i class="bx bx-phone fs-5 text-success"></i>
                        </div>
                        <div>
                            <span class="d-block text-muted" style="font-size: 0.75rem;">Teléfono</span>
                            <strong id="txt_telefonoI"></strong>
                        </div>
                    </li>
                    <li class="list-group-item px-0 pb-0 border-0 d-flex align-items-center">
                        <div class="bg-label-danger p-2 rounded me-3">
                            <i class="bx bx-map fs-5 text-danger"></i>
                        </div>
                        <div>
                            <span class="d-block text-muted" style="font-size: 0.75rem;">Ubicación</span>
                            <strong id="txt_ubicacionI"></strong>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Columna Derecha (Detalles Visita y Empresa) -->
    <div class="col-lg-8 col-md-7">
        
        <!-- Detalles de Visita -->
        <div class="card shadow-sm mb-4 border-0 rounded-3">
            <div class="card-header bg-transparent border-bottom-0 pt-4 pb-2 d-flex justify-content-between align-items-center">
                <h5 class="text-primary mb-0 fw-bold"><i class="bx bx-calendar-check me-2"></i>Detalles de la Visita</h5>
                <a type="button" class="btn btn-primary btn-sm rounded shadow-sm text-nowrap" href="javascript:void(0);" target="" id="ver_documento" data-bs-toggle="tooltip" title="Ver documento adjunto">
                    <i class="bx bx-cloud-download align-middle me-1"></i> <span class="align-middle">Documento</span>
                </a>
            </div>
            <div class="card-body pt-2">
                
                <!-- Estado Reporte Action -->
                <div class="bg-label-primary rounded p-3 mb-4 d-flex justify-content-between align-items-center">
                    <div>
                        <span class="d-block text-primary small fw-bold text-uppercase mb-1">Estado del Reporte</span>
                        <div style="min-width: 180px;">
                            <select name="txt_reporte" id="txt_reporte" idVisita="" class="form-select form-select-sm border-0 shadow-sm fw-bold"></select>
                        </div>
                    </div>
                    <div class="text-end">
                         <span class="d-block text-primary small fw-bold text-uppercase mb-1">Modalidad</span>
                         <input class="form-control-plaintext form-control-sm text-end fw-bold text-primary p-0 fs-6" type="text" id="txt_modalidad" disabled style="width:140px;" />
                    </div>
                </div>

                <!-- Grid Detalles -->
                <div class="row g-3">
                    <div class="col-sm-6 col-md-4">
                        <div class="border rounded p-3 h-100 bg-white">
                            <span class="d-block text-muted small mb-1"><i class="bx bx-calendar me-1"></i>Fecha Radicado</span>
                            <input class="form-control-plaintext fw-bold p-0 text-dark" type="text" id="txt_fechaRadicado" disabled />
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="border border-danger border-opacity-25 rounded p-3 h-100 bg-label-danger bg-opacity-10">
                            <span class="d-block text-danger small mb-1"><i class="bx bx-calendar-exclamation me-1"></i>Fecha Vencimiento</span>
                            <input class="form-control-plaintext fw-bold p-0 text-danger" type="text" id="txt_fecha_vencimiento" disabled />
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="border border-success border-opacity-25 rounded p-3 h-100 bg-label-success bg-opacity-10">
                            <span class="d-block text-success small mb-1"><i class="bx bx-calendar-check me-1"></i>Fecha Entrega</span>
                            <input class="form-control-plaintext fw-bold p-0 text-success" type="text" id="txt_fecha_entrega" disabled />
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-md-6">
                        <div class="border rounded p-3 h-100 bg-white">
                            <span class="d-block text-muted small mb-1"><i class="bx bx-info-circle me-1"></i>Estado de Visita</span>
                            <input class="form-control-plaintext fw-bold p-0 text-dark" type="text" id="txt_estado_visita" disabled />
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="border rounded p-3 h-100 bg-white">
                            <span class="d-block text-muted small mb-1"><i class="bx bx-map-pin me-1"></i>Ubicación de Visita</span>
                            <input class="form-control-plaintext fw-bold p-0 text-dark" type="text" id="txt_ubicacion" disabled />
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Detalles de Empresa -->
        <div class="card shadow-sm mb-4 border-0 rounded-3">
            <div class="card-header bg-transparent border-bottom-0 pt-4 pb-2">
                <h5 class="text-primary mb-0 fw-bold"><i class="bx bx-buildings me-2"></i>Información de Empresa</h5>
            </div>
            <div class="card-body pt-2">
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="bg-light border-0 rounded p-3">
                            <span class="d-block text-muted small mb-1">Razón Social</span>
                            <input class="form-control-plaintext fw-bold fs-5 p-0 text-dark" type="text" id="txt_empresa" disabled />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3">
                            <span class="d-block text-muted small mb-1">Departamento</span>
                            <input class="form-control-plaintext fw-bold p-0 text-dark" type="text" id="txt_departamento" disabled />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="border rounded p-3">
                            <span class="d-block text-muted small mb-1">Ciudad</span>
                            <input class="form-control-plaintext fw-bold p-0 text-dark" type="text" id="txt_ciudad" disabled />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Novedades (Hidden by default) -->
        <div class="card shadow-sm mb-4 border-0 rounded-3 novedades" style="display: none;">
            <div class="card-header bg-transparent border-bottom-0 pt-4 pb-2">
                <h5 class="text-primary mb-0 fw-bold"><i class="bx bx-message-square-detail me-2"></i>Novedades e Historial</h5>
            </div>
            <div class="card-body bg-light rounded-bottom">
                <!-- Se inyecta la lista desde cl_detallesUsuario.js -->
                <div class="row mt-2" id="novedades">
                </div>
            </div>
        </div>

    </div>

    <?php include_once "novedad_visita.php"; ?>
</div>