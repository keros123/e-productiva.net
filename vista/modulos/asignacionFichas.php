<div class="container-xxl flex-grow-1 container-p-y ModuloAsignacionFichas" style="display: none">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Panel Administrativo/<a type="button" class="atras_btn_Funcionarios">Funcionarios</a>/Asignación De Fichas/</span><span id="etiqueta_nombreCompletoAsignacionFichas" ></span>
    </h4>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                <a type="button" class="nav-link active" id="btn_asignarFichaInstructor" idFuncionario=""><i class='bx bx-add-to-queue'></i> Asignar Ficha</a>
                </li>
            </ul>
            <div class="card">
                <div class="card-body">
                    <div class="error"></div>
                    <br>
                    <div class="table-responsive">
                        <table id="tablaFichasAsignadas" class="table table-hover align-middle table-sm border-bottom" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-nowrap text-center text-white">Ficha</th>
                                    <th class="text-nowrap text-center text-white">Caracterización</th>
                                    <th class="text-nowrap text-center text-white">Estado</th>
                                    <th class="text-nowrap text-center text-white">Retirar</th>
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
            <div class="modal fade" id="modalAsignarFicha" tabindex="-1" data-bs-backdrop="static"
                data-bs-keyboard="false" style="display: none;" aria-modal="true" role="dialog"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4>Asignación de Fichas</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="tablaAsignarFicha"
                                    class="table table-hover table-borderless border-bottom text-center"
                                    style="width: 100%;">
                                    <thead class="table-dark">
                                        <tr>
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
            <br>
            <div class="d-grid gap-2 d-md-block">
                <button type="button" class="btn btn-dark atras_btn_Funcionarios" data-bs-toggle="tooltip" data-bs-placement="top" title="Regresar"><img src="assets/img/interface/flecha.png"></i></button>
            </div>
            
        </div>
    </div>
</div>