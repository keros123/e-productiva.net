<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Panel Administrativo /</span> Asignación Seguimientos
    </h4>
    <ul class="nav nav-pills nav-justified mb-4" id="asignacionTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="paso1-tab" data-bs-toggle="pill" data-bs-target="#paso1" type="button" role="tab" aria-controls="paso1" aria-selected="true">
                <i class="bx bx-user-plus me-1"></i> Paso 1: Asignación de Seguimientos
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="paso2-tab" data-bs-toggle="pill" data-bs-target="#paso2" type="button" role="tab" aria-controls="paso2" aria-selected="false">
                <i class="bx bx-mail-send me-1"></i> Paso 2: Notificación y Envío
            </button>
        </li>
    </ul>

    <div class="tab-content" id="asignacionTabsContent" style="padding: 0; background: transparent; box-shadow: none;">
        <div class="tab-pane fade show active" id="paso1" role="tabpanel" aria-labelledby="paso1-tab">
            <div class="row">
        <div id="contenedorFormularioVisitaSeguimiento" class="" style="display: none;">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form id="formVisitaSeguimiento" class="row g-3 needs-validation" novalidate>
                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="txt_funcionarioSeguimiento">Instructor</label>
                                <div class="input-group input-group-merge">
                                    <input type="text" id="txt_funcionarioSeguimiento" idfuncionario="" class="form-control phone-mask " placeholder="Click para selecionar Instructor" aria-label="Click para selecionar Instructor" disabled="" required="">
                                    <span class="input-group-text cursor-pointer" id="btn-ListarFuncionarioSeguimiento" data-bs-toggle="modal" data-bs-target="#modalInstructor"><i class='bx bx-list-plus'></i></span>
                                    <div class="valid-feedback">¡Se ve bien!</div>
                                    <div id="errorInstructor" class="invalid-feedback">Por favor seleccione un Instructor.</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="selectTipoSeguimiento">Tipo Seguimiento</label>
                                <select id="selectTipoSeguimiento" name="selectTipoSeguimiento" class="select2 form-select" required>
                                </select>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona un tipo de seguimiento válido.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="selectUbicacionSeguimiento" class="form-label">Ubicación</label>
                                <select id="selectUbicacionSeguimiento" name="selectUbicacionSeguimiento" class="select2 form-select" required>
                                    <option value="" disabled selected>Seleccione una ubicación</option>
                                    <option value="Presencial">Presencial</option>
                                    <option value="Virtual">Virtual</option>
                                </select>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona una ubicación válida.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="txt-fechaVencimiento" class="form-label">FECHA VENCIMIENTO</label>
                                <input type="date" id="txt-fechaVencimiento" class="form-control phone-mask" aria-describedby="txt-fechaFinPractica" required>
                                <div class="invalid-feedback">Por favor ingrese una fecha valida.</div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                            </div>

                            <div class="col-12">
                                <button type="button" class="btn btn-dark" id="atrasPreAsignarSeguimiento">Regresar</button>

                                <button id="btnPreAsignarSeguimiento" seguimiento="" class="btn btn-primary" type="submit"><i class="bx bx-buildings me-1"></i> Asignar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div id="contenedorTablaEtapaPractica">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="error"></div>
                        <br>
                        <div class="table-responsive">
                            <table id="tablaEtapaPracticaAsignacion" class="table table-hover border-top dt-responsive" style="width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-nowrap text-center text-dark">Inicio Practica</th>
                                        <th class="text-nowrap text-center text-dark">Fin practica</th>
                                        <th class="text-nowrap text-center text-dark">Modalidad</th>
                                        <th class="text-nowrap text-center text-dark">Ficha</th>
                                        <th class="text-nowrap text-center text-dark">Caracterización</th>
                                        <th class="text-nowrap text-center text-dark">Documento</th>
                                        <th class="text-nowrap text-center text-dark">Aprendiz</th>
                                        <th class="text-nowrap text-center text-dark">Empresa</th>
                                        <th class="text-nowrap text-center text-dark">Instructor Asignado</th>
                                        <th class="text-nowrap text-center text-dark">Ciudad</th>
                                        <th class="text-nowrap text-center text-dark">Observaciones</th>
                                        <th class="text-nowrap text-center text-dark">Momento</th>
                                        <th class="text-nowrap text-center text-dark">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            <div class="d-flex justify-content-end mt-3 mb-4">
                <button type="button" class="btn btn-primary" id="btnSiguientePaso">Siguiente Paso <i class="bx bx-chevron-right"></i></button>
            </div>
        </div>

        <div class="tab-pane fade" id="paso2" role="tabpanel" aria-labelledby="paso2-tab">
            <div id="contenedorSeguimientosAsignados" class="row mt-4">
        <div class="col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="error"></div>
                    <br>
                    <div class="table-responsive">
                        <table id="tablaSeguimientoPreAsignado" class="table table-hover border-top  dt-responsive" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap text-center text-dark">Documento</th>
                                    <th class="text-nowrap text-center text-dark">Instructor</th>
                                    <th class="text-nowrap text-center text-dark">ficha</th>
                                    <th class="text-nowrap text-center text-dark">Aprendiz</th>
                                    <th class="text-nowrap text-center text-dark">Seguimiento</th>
                                    <th class="text-nowrap text-center text-dark">Ubicación</th>
                                    <th class="text-nowrap text-center text-dark">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body lista">
                    <div class="mb-3 col-md-12">
                        <label class="form-label" for="txt_funcionario">Instructor</label>
                        <div class="input-group input-group-merge">
                            <input type="text" id="txt_funcionario" idfuncionario="" class="form-control phone-mask " placeholder="Click para selecionar Instructor" aria-label="Click para selecionar Instructor" disabled="" required="">
                            <span class="input-group-text cursor-pointer" id="btn-ListarFuncionario" data-bs-toggle="modal" data-bs-target="#modalInstructor"><i class='bx bx-list-plus'></i></span>
                            <div class="valid-feedback">¡Se ve bien!</div>
                            <div id="errorAprendiz" class="invalid-feedback">Por favor seleccione un aprendiz.</div>
                        </div>
                    </div>


                    <br>
                    <div class="table-responsive">
                        <table id="tablaSeguimientoInstructor" class="table table-striped table-bordered border-bottom dt-responsive" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap text-center">Aprendiz</th>
                                    <th class="text-nowrap text-center">Seguimiento</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div>
                    <br>

                    <div class="row">
                        <div id="contenedorBotonCorreos" lista="" notificado="2" class="mb-3 col-md-12" style="display: none;">
                            <button type="button" id="btn-EnviarSeguimientosInstructor" class="btn btn-secondary">Enviar Seguimientos</button>
                        </div>
                    </div>
                </div>
                <?php include_once "indicador_tiempoEmail.php"; ?>
            </div>
        </div>
    </div>
            <div class="d-flex justify-content-start mt-3 mb-4">
                <button type="button" class="btn btn-secondary" id="btnAnteriorPaso"><i class="bx bx-chevron-left"></i> Paso Anterior</button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalInstructor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Instructores</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="tablaInstructoresSeguimientos" class="table table-hover align-middle table-sm border-bottom" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap text-center text-dark">Documento</th>
                                    <th class="text-nowrap text-center text-dark">Nombres</th>
                                    <th class="text-nowrap text-center text-dark">...</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script async defer src="vista/js/asignacionSeguimientos.js"></script>