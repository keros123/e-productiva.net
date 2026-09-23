<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Panel Administrativo /</span> Aprendices
    </h4>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);" id="agregarAprendiz"><i
                            class="bx bx-user-plus me-1"></i> Agregar Aprendiz</a>
                </li>
            </ul>

            <div class="modal fade" id="modalSelectFichas" tabindex="-1" data-bs-backdrop="static"
                data-bs-keyboard="false" style="display: none;" aria-modal="true" role="dialog"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="">Seleccionar Ficha</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tablaSelectFichas"
                                    class="table table-hover table-borderless border-bottom text-center"
                                    style="width: 100%;">
                                    <thead class="table-dark">
                                        <tr>
                                            <h5></h5>
                                            <th class="text-nowrap text-center text-white">FICHAS</th>
                                            <th class="text-nowrap text-center text-white">ESTADO</th>
                                            <th class="text-nowrap text-center text-white">SELECCIONAR</th>
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

            <?php 
                include_once "formularioAgregarAprendiz.php";
                include_once "formularioEditarAprendiz.php";
            ?>

            <div class="card" id="card-tablaAprendices">
                <div class="card-body">
                    <div class="error"></div>
                    <br>
                    <div class="table-responsive">
                        <table id="tablaAprendiz" class="table table-hover align-middle table table-sm border-bottom"
                            style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-nowrap text-center text-white">Ficha</th>
                                    <th class="text-nowrap text-center text-white">Tipo</th>
                                    <th class="text-nowrap text-center text-white">Documento</th>
                                    <th class="text-nowrap text-center text-white">Nombres</th>
                                    <th class="text-nowrap text-center text-white">Apellidos</th>
                                    <th class="text-nowrap text-center text-white">Celular</th>
                                    <th class="text-nowrap text-center text-white">Email</th>
                                    <th class="text-nowrap text-center text-white">Estado</th>
                                    <th class="text-nowrap text-center text-white">Acciones</th>
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
</div>