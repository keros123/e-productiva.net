<?php
    $aprendiz = null;
    $ficha = null;
    $nombreFicha = null;
    if (isset($_SESSION["id"])){
        $aprendiz = $_SESSION["id"];
    }
?>


<div id="contenedorPrincipal" aprendiz="<?php echo $aprendiz;?>" class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Panel Administrativo / Bitácoras /</span>
        <?php 
            echo $_SESSION["ficha"]." - ".ucfirst(mb_strtolower($_SESSION["nombreFicha"]));;
        ?>
    </h4>

    <div id="contenedorFormulario" class="row" style="display: none;">
        <div class="col-sm-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <form id="formularioBitacoras" class="row g-3 needs-validation" novalidate>
                        <h5 class="titulo-mc">Empresa</h5>
                        <div class="row g-3">
                            <div class="col">
                                <label for="txt-razonSocialEmpresa" class="form-label">Razón social</label>
                                <input type="text" class="form-control" id="txt-razonSocialEmpresa" placeholder="Razón Social" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese la razón social de la empresa.</div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col">
                                <label for="txt-direccionEmpresa" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="txt-direccionEmpresa" placeholder="Dirección" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese la dirección de la empresa.</div>
                            </div>

                            <div class="col">
                                <label for="txt-telefonoEmpresa" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="txt-telefonoEmpresa" placeholder="Telefono" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese teléfono de la empresa.</div>
                            </div>

                            <div class="col">
                                <label for="txt-emailEmpresa" class="form-label">Email</label>
                                <div class="input-group">
                                    <div class="input-group-text">@</div>
                                    <input type="email" class="form-control" id="txt-emailEmpresa" placeholder="Email" required>
                                    <div class="valid-feedback">¡Se ve bien!</div>
                                    <div class="invalid-feedback">Por favor ingrese el email de la empresa.</div>
                                </div>
                            </div>
                        </div>


                        <hr>
                        <h5 class="titulo-mc">Jefe Inmediato</h5>
                        <div class="row g-3">
                            <div class="col">
                                <label for="txt-NombreJefe" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="txt-NombreJefe" placeholder="Nombres" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese el nombre de su jefe inmediato.</div>
                            </div>

                            <div class="col">
                                <label for="txt-apellidoJefe" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="txt-apellidoJefe" placeholder="Apellidos" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese el apellido de su jefe inmediato.</div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col">
                                <label for="txt-telefonoJefe" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="txt-telefonoJefe" placeholder="Telefono" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese el teléfono de su jefe inmediato.</div>
                            </div>

                            <div class="col">
                                <label for="txt-emailJefe" class="form-label">Email</label>
                                <div class="input-group">
                                    <div class="input-group-text">@</div>
                                    <input type="email" class="form-control" id="txt-emailJefe" placeholder="Email" required>
                                    <div class="valid-feedback">¡Se ve bien!</div>
                                    <div class="invalid-feedback">Por favor ingrese el email de su jefe inmediato.</div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <h5 class="titulo-mc">Etapa Practica</h5>
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label for="txt-fechaInicio" class="form-label">Fecha Inicial </label>
                                <input type="date" class="form-control" id="txt-fechaInicio" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese la fecha inicial desu etapa practica.</div>
                            </div>

                            <div class="col">
                                <label for="txt-fechaFinal" class="form-label">Fecha Final</label>
                                <input type="date" class="form-control" id="txt-fechaFinal" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese la fecha final de su etapa practica.</div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-block">
                            <button id="btn_registroBitacoras" type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="contenedorFormularioEditar" class="row" style="display: none;">
        <div class="col-sm-12 mb-5">
            <div class="card">
                <div class="card-body">
                    <form id="formularioBitacorasEditar" class="row g-3 needs-validation" novalidate>
                        <h5 class="titulo-mc">Empresa</h5>
                        <div class="row g-3">
                            <div class="col">
                                <label for="txt-razonSocialEmpresaEdit" class="form-label">Razón social</label>
                                <input type="text" class="form-control" id="txt-razonSocialEmpresaEdit" placeholder="Razón Social" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese la razón social de la empresa.</div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col">
                                <label for="txt-direccionEmpresaEdit" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="txt-direccionEmpresaEdit" placeholder="Dirección" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese la dirección de la empresa.</div>
                            </div>

                            <div class="col">
                                <label for="txt-telefonoEmpresaEdit" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="txt-telefonoEmpresaEdit" placeholder="Telefono" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese teléfono de la empresa.</div>
                            </div>

                            <div class="col">
                                <label for="txt-emailEmpresaEdit" class="form-label">Email</label>
                                <div class="input-group">
                                    <div class="input-group-text">@</div>
                                    <input type="email" class="form-control" id="txt-emailEmpresaEdit" placeholder="Email" required>
                                    <div class="valid-feedback">¡Se ve bien!</div>
                                    <div class="invalid-feedback">Por favor ingrese el email de la empresa.</div>
                                </div>
                            </div>
                        </div>


                        <hr>
                        <h5 class="titulo-mc">Jefe Inmediato</h5>
                        <div class="row g-3">
                            <div class="col">
                                <label for="txt-NombreJefe" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="txt-NombreJefeEdit" placeholder="Nombres" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese el nombre de su jefe inmediato.</div>
                            </div>

                            <div class="col">
                                <label for="txt-apellidoJefe" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="txt-apellidoJefeEdit" placeholder="Apellidos" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese el apellido de su jefe inmediato.</div>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col">
                                <label for="txt-telefonoJefeEdit" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="txt-telefonoJefeEdit" placeholder="Telefono" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese el teléfono de su jefe inmediato.</div>
                            </div>

                            <div class="col">
                                <label for="txt-emailJefeEdit" class="form-label">Email</label>
                                <div class="input-group">
                                    <div class="input-group-text">@</div>
                                    <input type="email" class="form-control" id="txt-emailJefeEdit" placeholder="Email" required>
                                    <div class="valid-feedback">¡Se ve bien!</div>
                                    <div class="invalid-feedback">Por favor ingrese el email de su jefe inmediato.</div>
                                </div>
                            </div>
                        </div>

                        <hr>
                        <h5 class="titulo-mc">Etapa Practica</h5>
                        <div class="row g-3 mb-3">
                            <div class="col">
                                <label for="txt-fechaInicioEdit" class="form-label">Fecha Inicial </label>
                                <input type="date" class="form-control" id="txt-fechaInicioEdit" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese la fecha inicial desu etapa practica.</div>
                            </div>

                            <div class="col">
                                <label for="txt-fechaFinalEdit" class="form-label">Fecha Final</label>
                                <input type="date" class="form-control" id="txt-fechaFinalEdit" required>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Por favor ingrese la fecha final de su etapa practica.</div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-block">
                            <button type="button" class="btn btn-dark" id="atrasBitacorasEdit" data-bs-toggle="tooltip" data-bs-placement="top" title="Regresar"><img src="assets/img/interface/flecha.png"></i></button>
                            <button id="btn_EditarBitacoras" idBitacora="" type="submit" class="btn btn-primary">Guardar Cambios</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div id="contenedorBitacoras" class="row" style="display: none;">
            
        </div>
    </div>

   
    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bitacoraTitulo">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="formularioPdfBitacora" class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                        <div class="mb-1">
                            <input type="file" class="form-control btn-danger" id="txt_file_bitacora" accept=".pdf,.xlsx" require>
                            <small id="helpId" class="form-text text-muted">Archivos Permitidos .pdf,.xlsx</small>
                            <div id="errorFile" class="mc-errores"></div>
                        </div>

                        <button id="btnArchivoBitacora" type="submit"  bitacora="" codigoBitacora="" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>

                <div class="modal-footer">
                   
                </div>
            </div>
        </div>
    </div>
</div>


<script async defer src="vista/js/bitacoras.js"></script>