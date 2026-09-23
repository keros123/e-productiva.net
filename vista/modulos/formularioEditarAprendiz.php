<div class="card mb-4" id="card-formEditarAprendiz" style="display: none;">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Editar Aprendiz</h5>
        <small class="text-muted float-end"></small>
    </div>
    <div class="card-body">
        <form id="form-EditarAprendiz" class="needs-validated" novalidate>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="selectDocumentoEdit" class="form-label">Tipo de Documento</label>
                    <select id="selectDocumentoEdit" class="form-select" aria-label="Default select example"
                        required>
                    </select>
                    <div class="invalid-feedback">Porfavor seleccione tipo de documento</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="txt-DocumentoAprendizEdit" class="form-label">DOCUMENTO</label>
                    <input type="text" id="txt-DocumentoAprendizEdit" class="form-control phone-mask"
                        placeholder="Numero de documento" aria-label="Número de documento"
                        aria-describedby="txt-DocumentoAprendizEdit" required>
                    <div class="invalid-feedback">Porfavor ingrese número de documento</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="txt-NombresAprendizEdit" class="form-label">NOMBRES</label>
                    <input type="text" id="txt-NombresAprendizEdit" class="form-control phone-mask"
                        placeholder="Nombres" aria-label="Nombres"
                        aria-describedby="txt-NombresAprendizEdit" required>
                    <div class="invalid-feedback">Porfavor ingrese nombres</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="txt-ApellidosAprendizEdit" class="form-label">APELLIDOS</label>
                    <input type="text" id="txt-ApellidosAprendizEdit" class="form-control phone-mask"
                        placeholder="Apellidos" aria-label="Apellidos"
                        aria-describedby="txt-ApellidosAprendizEdit" required>
                    <div class="invalid-feedback">Porfavor ingrese apellidos</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="txt-NumeroAprendizEdit" class="form-label">TELEFONO</label>
                    <input type="text" id="txt-NumeroAprendizEdit" class="form-control phone-mask"
                        placeholder="Numero de telefono" aria-label="Número de telefono"
                        aria-describedby="txt-NumeroAprendizEdit" required>
                    <div class="invalid-feedback">Porfavor ingrese número de telefono </div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="txt-EmailAprendizEdit" class="form-label">EMAIL</label>
                    <div class="input-group input-group-merge">
                        <input type="text" id="txt-EmailAprendizEdit" class="form-control"
                            placeholder="example.em" aria-label="example.em" aria-describedby="spam-Email"
                            required>
                        <span class="input-group-text" id="spam-Email">@example.com</span>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Porfavor ingrese Email</div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="selectEstadoAprendizEdit" class="form-label">Estado</label>
                    <select id="selectEstadoAprendizEdit" class="form-select"
                        aria-label="selectEstadoAprendizEdit" required>
                    </select>
                    <div class="invalid-feedback">Porfavor seleccione estado del aprendiz</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="txt-fichaAprendizEdit" class="form-label">FICHA</label>
                    <?php
                        if ($_GET["ruta"] == "fichaAprendices"){?>
                            <div class="input-group input-group-merge">
                                <input type="text" id="txt-fichaAprendiz-0Edit" class="form-control cursor-pointer" value="<?php echo $ficha . " - " . $caracterizacion; ?>" disabled required>
                                <span id="btnSeleccionarFichaTraslado" class="input-group-text cursor-pointer mc-spanDeshabilitado" data-bs-toggle="modal" data-bs-target="#ModalFichasTraslado">
                                    <i class='bx bxs-add-to-queue'></i>
                                </span>
                            </div>
                        <?php
                        }elseif($_GET["ruta"] == "aprendices"){?>
                            <div class="input-group input-group-merge">
                                <input type="text" id="txt-fichaAprendiz-0Edit" data-bs-toggle="modal"
                                data-bs-target="#modalSelectFichas" class="form-control phone-mask "
                                placeholder="Click para seleccionar una ficha"
                                aria-label="Click para seleccionar una ficha" aria-describedby="txt-fichaAprendiz-0Edit"
                                disabled required>

                                <span class="input-group-text cursor-pointer" data-bs-toggle="modal"
                                data-bs-target="#modalSelectFichas"><i class='bx bxs-add-to-queue'></i></span>    
                            </div>
                        <?php
                        }
                    ?>
                    <input type="text" id="txt-fichaAprendizEdit" idFicha="" ruta="<?php echo $_GET["ruta"];?>" hidden disabled required>
                </div>
            </div>


            <div class="d-grid gap-2 d-md-block">
                <button type="button" class="btn btn-dark" id="atrasAprendizEdit">Regresar</button>
                <button type="submit" class="btn btn-primary" id="btn-EditarAprendiz" aprendiz="" nombreCompleto=""><i
                class="bx bx-user-plus me-1"></i>Actualizar</button>
            </div>

        </form>
    </div>
</div>

<?php include_once "vista/modulos/modalFichas.php" ?>