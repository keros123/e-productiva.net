<script async defer src="assets/js/cl_seguimientosAsignadosAprendiz.js"></script>
<script async defer src="vista/js/seguimientosAsignadosAprendiz.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Panel aprendiz /</span> Seguimientos asignados
    </h4>

    <div class="row seguimientosAsignados">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="error"></div>
                    <br>
                    <div class="table-responsive">
                        <table id="tabla_seguimientosAsignados" class="table table-hover align-middle table-sm border-top" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap text-center">Tipo</th>
                                    <th class="text-nowrap text-center">Encargado</th>
                                    <th class="text-nowrap text-center">Radicado</th>
                                    <th class="text-nowrap text-center">Vencimiento</th>
                                    <th class="text-nowrap text-center">Entrega</th>
                                    <th class="text-nowrap text-center">Empresa</th>
                                    <th class="text-nowrap text-center">Dirección</th>
                                    <th class="text-nowrap text-center">Ubicación</th>
                                    <th class="text-nowrap text-center">Estado</th>
                                    <th class="text-nowrap text-center">Acciones</th>
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
        <div id="contenedorMensajeAprendiz" class="col-md-12 mt-3">

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ModalDireccionVisita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Dirección de Empresa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <form id="formularioDireccionEmpresa" class="row g-3 needs-validation" novalidate>
                        <div class="col-md-12">
                            <label for="txtDireccionEmpresa" class="form-label">Dirección</label>
                            <input type="text" class="form-control" visita="" id="txtDireccionEmpresa" required>
                            <div class="valid-feedback">
                                buen trabajo!
                            </div>
                            <div class="invalid-feedback">
                                Por favor ingrese una dirección valida.
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <?php include_once "detalleSeguimientoAprendiz.php"; ?>
</div>