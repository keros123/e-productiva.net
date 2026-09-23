<script src="assets/js/cl_linea_red_Tecnologica.js"></script>
<script async defer src="vista/js/linea_red_Tecnologica.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4 lineaTecnologica">
        <span class="text-muted fw-light">Panel Administrativo /</span> Línea Tecnológica
    </h4>
    <h4 class="fw-bold py-3 mb-4 redTecnologica" style="display:none;">
        <span class="text-muted fw-light">Panel Administrativo /<a href="lineaTecnologica">Línea Tecnológica</a> /Red Tecnologica /</span><span id="nombreLineaTecnologica"></span> 
    </h4>

    <?php include_once "redTecnologica.php"; ?>

    <div class="row lineaTecnologica">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3 justify-content-end">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalAgregarLineaTecnologica"><i class='menu-icon tf-icons bx bx-plus-circle'></i> Agregar Línea Tecnológica</a>
                </li>
            </ul>
    
            <div class="card">
                <div class="card-body">
                <div class="error"></div>
                    <div class="table-responsive">
                        <table id="tablaLineaTecnologica" class="table table-hover align-middle table-sm border-top" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap text-center ">Línea Tecnológica</th>
                                    <th class="text-nowrap text-center ">Acciones</th>
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
            
            <div class="modal fade" id="modalAgregarLineaTecnologica" tabindex="-1" data-bs-backdrop="static"
                data-bs-keyboard="false" style="display: none;" aria-modal="true" role="dialog"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="">Agregar Línea Tecnológica</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                                <form id="form_lineaTecnologica" class="needs-validated" novalidate>
                                    <div class="mb-3">
                                        <label for="txt_lineaTecnologica" class="form-label">Línea Tecnológica</label>
                                        <input type="text" class="form-control" name="txt_lineaTecnologica" id="txt_lineaTecnologica" placeholder="Inserte línea tecnológica" required>
                                        <div class="invalid-feedback">Por favor ingrese la línea tecnológica.</div>
                                        <div class="valid-feedback">¡Se ve bien!</div>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Agregar</button>
                                    </div>
                                </form>
                                
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalEditarLineaTecnologica" tabindex="-1" data-bs-backdrop="static"
                data-bs-keyboard="false" style="display: none;" aria-modal="true" role="dialog"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="">Editar Línea Tecnológica</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form_lineaTecnologica_edit" class="needs-validated" novalidate>
                                <div class="mb-3">
                                    <label for="txt_lineaTecnologica_edit" class="form-label">Línea Tecnológica</label>
                                    <input type="text" class="form-control" name="txt_lineaTecnologica_edit" id="txt_lineaTecnologica_edit" placeholder="Inserte línea tecnológica" required>
                                    <div class="invalid-feedback">Por favor ingrese la línea tecnológica.</div>
                                    <div class="valid-feedback">¡Se ve bien!</div>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary" id="btn_editar_lineaTecnologica" idLineaTecnologica="">Actualizar</button>
                                </div>
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>