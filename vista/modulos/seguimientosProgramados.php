<script async defer src="assets/js/cl_seguimientosAsignados.js"></script>
<script async defer src="vista/js/seguimientosAsignados.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Inicio /</span> <span class="fw-medium text-dark">Seguimientos programados</span>
    </h4>

    <div class="row seguimientosProgramados">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="rounded-3 p-3 text-end ">
                        <!-- Título -->
                        <div class="mb-2 fw-medium text-uppercase small text-muted">
                            Estado del reporte (RP)
                        </div>

                        <!-- Leyenda -->
                        <div class="d-flex gap-4 align-items-center justify-content-end flex-wrap">
                            <!-- Sin reporte -->
                            <div class="d-flex align-items-center gap-2">
                                <span class="bg-warning rounded-circle d-inline-block"
                                    style="width: 12px; height: 12px;"></span>
                                <span class="fw-small text-dark">
                                    Sin reporte
                                </span>
                            </div>

                            <!-- Entregado -->
                            <div class="d-flex align-items-center gap-2">
                                <span class="bg-primary rounded-circle d-inline-block"
                                    style="width: 12px; height: 12px;"></span>
                                <span class="fw-medium text-dark">
                                    Entregado
                                </span>
                            </div>
                            
                            <!-- Aprobado -->
                            <div class="d-flex align-items-center gap-2">
                                <span class="bg-success rounded-circle d-inline-block"
                                    style="width: 12px; height: 12px;"></span>
                                <span class="fw-medium text-dark">
                                    Aprobado
                                </span>
                            </div>

                            <!-- Rechazado -->
                            <div class="d-flex align-items-center gap-2">
                                <span class="bg-danger rounded-circle d-inline-block"
                                    style="width: 12px; height: 12px;"></span>
                                <span class="fw-medium text-dark">
                                    Rechazado
                                </span>
                            </div>

                        </div>
                    </div>
                
                    <div class="error"></div>
                    <br>
                    <div class="table-responsive">
                        <table id="tabla_seguimientosProgramados" class="table table-hover align-middle table-sm border-top" style="width: 100%;">
                            <thead class="bg-light small text-muted">
                                <tr>
                                    <th class="text-nowrap text-center text-dark">#</th>
                                    <th class="text-nowrap text-center text-dark">Tipo</th>
                                    <th class="text-nowrap text-center text-dark">Dirigido</th>
                                    <th class="text-nowrap text-center text-dark">Radicado</th>
                                    <th class="text-nowrap text-center text-dark">Vencimiento</th>
                                    <th class="text-nowrap text-center text-dark">Fin Práctica</th>
                                    <th class="text-nowrap text-center text-dark">Ubicación</th>
                                    <th class="text-nowrap text-center text-dark">Entrega</th>
                                    <th class="text-nowrap text-center text-dark">Estado</th>
                                    <th class="text-nowrap text-center text-dark">RP</th>
                                    <th class="text-nowrap text-center text-dark">...</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "detallesAprendiz.php" ?>
    <?php include_once "novedad_visita.php" ?>
    <?php include_once "subirReporteSeguimiento.php" ?>
</div>