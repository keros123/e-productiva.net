<div class="row redTecnologica" style="display:none;">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3 justify-content-end">
            <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0);" lineaTecnologica="" id="agregarRedTecnologica" data-bs-toggle="modal" data-bs-target="#modalAgregarRedTecnologica"><i class='menu-icon tf-icons bx bx-plus-circle'></i> Agregar Red Tecnologica</a>
            </li>
        </ul>

        <div class="card">
            <div class="card-body">
            <div class="error"></div>
                <div class="table-responsive">
                    <table id="tablaRedTecnologica" class="table table-hover align-middle table-sm border-bottom" style="width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th class="text-nowrap text-center">Red Tecnologica</th>
                                <th class="text-nowrap text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="d-grid gap-2 d-md-block">
                    <button type="button" class="btn btn-dark atras_btn_redTecnologica">Regresar</button>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modalAgregarRedTecnologica" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" style="display: none;" aria-modal="true" role="dialog"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="">Agregar Red Tecnológica</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form_redTecnologica" class="needs-validation" novalidated>
                            <div class="mb-3">
                                <label for="txt_RedTecnologica" class="form-label">Linea Tecnologica</label>
                                <input type="text" class="form-control" name="txt_RedTecnologica" id="txt_RedTecnologica" placeholder="Inserte red tecnológica">
                                <div class="invalid-feedback">Por favor ingrese la red tecnológica.</div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" lineaTecnologica="" id="btn_redTecnologica">Agregar</button>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="modalEditarRedTecnologica" tabindex="-1" data-bs-backdrop="static"
            data-bs-keyboard="false" style="display: none;" aria-modal="true" role="dialog"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="">Editar Red Tecnologica</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form_redTecnologica_edit" class="needs-validation" novalidated>
                            <div class="mb-3">
                                <label for="txt_RedTecnologica_edit" class="form-label">Red Tecnológica</label>
                                <input type="text" class="form-control" name="txt_RedTecnologica_edit" id="txt_RedTecnologica_edit" placeholder="Inserte red tecnológica">
                                <div class="invalid-feedback">Por favor ingrese la red tecnológica.</div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary" idRedTecnologica="" id="btn_redTecnologica_edit">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>