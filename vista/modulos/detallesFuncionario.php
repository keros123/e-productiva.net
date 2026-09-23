<script async defer src="vista/js/detalleFuncionario.js"></script>
<div class="row detallesFuncionario" style="display: none;">
    <div class="col-md-12">
        <!-- Contenedor Único General -->
        <div class="card mt-2 mb-2">
            <div class="card-body">
                <div class="row pt-2">
                    <div class="col-12">
                        <!-- Perfil del Instructor Moderno (Siempre visible) -->
                        <div class="user-profile-header d-flex flex-column flex-sm-row align-items-center align-items-sm-start text-center text-sm-start gap-4 mb-4">
                            <div class="flex-shrink-0">
                                <img id="imagenFuncionario" src="assets/img/interface/profile.png" alt="Instructor Profile" 
                                    class="d-block rounded-circle user-profile-img border shadow-sm"
                                    width="140" height="140">
                            </div>
                            <div class="flex-grow-1 mt-3 mt-sm-2">
                                <div class="d-flex align-items-center justify-content-center justify-content-sm-start gap-2 mb-3">
                                    <h2 class="mb-0 fw-bold titulo-mc" id="nombresFuncionario">Cargando...</h2>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6 col-lg-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm flex-shrink-0">
                                                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-id-card"></i></span>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Identificación</small>
                                                <span class="fw-semibold text-dark" id="txt_documentoId">---</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm flex-shrink-0">
                                                <span class="avatar-initial rounded bg-label-info"><i class="bx bx-envelope"></i></span>
                                            </div>
                                            <div class="text-truncate" style="max-width: 250px;">
                                                <small class="text-muted d-block">Correo Electrónico</small>
                                                <span class="fw-semibold text-dark text-truncate" id="txt_emailI" title="">---</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm flex-shrink-0">
                                                <span class="avatar-initial rounded bg-label-success"><i class="bx bx-phone"></i></span>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Teléfono</small>
                                                <span class="fw-semibold text-dark" id="txt_telefonoI">---</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar avatar-sm flex-shrink-0">
                                                <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-map"></i></span>
                                            </div>
                                            <div>
                                                <small class="text-muted d-block">Ubicación</small>
                                                <span class="fw-semibold text-dark" id="txt_ubicacionI">---</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <span class="badge bg-label-secondary" id="txt_rolI"><i class="bx bx-briefcase-alt-2 me-1"></i>Instructor</span>
                                </div>
                            </div>
                            </div>
                        </div>

                        <!-- Contenedor Específico de Seguimientos (Visible solo para Instructores) -->
                        <div id="seguimientosIntructorDetalles" style="display: none;">
                            <!-- Divisor Estilizado para Seguimientos -->
                            <div class="d-flex align-items-center gap-2 mb-3 mt-5 pb-2 border-bottom">
                                <i class="bx bx-list-check fs-3 text-primary"></i>
                                <h4 class="mb-0 fw-bold text-dark">Seguimientos Asignados</h4>
                                <span class="badge bg-label-primary rounded-pill ms-2" id="totalSeguimientosInstructor"></span>
                            </div>

                            <div class="table-responsive">
                                <table id="tablaListaSeguimientosInstructor"
                            class="table table-hover align-middle table-sm border-top" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap text-center text-dark">Fecha</th>
                                    <th class="text-nowrap text-center text-dark">Ficha</th>
                                    <th class="text-nowrap text-center text-dark">Aprendiz</th>
                                    <th class="text-nowrap text-center text-dark">Documento</th>
                                    <th class="text-nowrap text-center text-dark">Seguimiento</th>
                                    <th class="text-nowrap text-center text-dark">Ubicación</th>
                                    <th class="text-nowrap text-center text-dark">Estado</th>
                                    <th class="text-nowrap text-center text-dark">pdf</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">
                            </tbody>
                        </table>
                    </div>

                        </div> <!-- Cierre seguimientosIntructorDetalles -->
                    </div>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2 d-md-block bt-3">
            <button type="button" class="btn btn-dark volver_funcionarios">Regresar</button>
        </div>
    </div>




    <div class="modal fade" id="novedadModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Novedades</h5>
                    <button id="btnCerrarModalNovedad" type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span>Por favor registre alguna novedad de este seguimiento, o si desea omita este
                        paso.</span>
                    <form>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Mensaje:</label>
                            <textarea class="form-control" id="message-textNovedad"></textarea>
                            <div id="novedadErrorMensaje" class="mc-errores">error</div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="btnOmitirNovedad" estado="" seguimiento="" type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Omitir</button>
                    <button id="btnRegistroNovedadSeguimiento" type="button" class="btn btn-primary" estado=""
                        seguimiento="">Registrar Novedad</button>
                </div>
            </div>
        </div>
    </div>
</div>