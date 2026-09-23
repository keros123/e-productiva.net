
<div class="card mb-4" id="card-formAgregarAprendiz" style="display: none;">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Agregar Aprendiz</h5>
        <small class="text-muted float-end"></small>
    </div>
    <div class="card-body">
        <form id="form-agregarAprendiz" class="needs-validated" novalidate>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="txt-fichaAprendiz" class="form-label">FICHA</label>
                    <?php
                        if ($_GET["ruta"] == "fichaAprendices"){?>
                            <div class="input-group input-group-merge">
                                <input type="text" id="txt-ficha" class="form-control cursor-pointer" value="<?php echo $ficha . " - " . $caracterizacion; ?>" disabled required>
                                <span class="input-group-text cursor-pointer">
                                    <i class='bx bxs-add-to-queue'></i>
                                </span>
                            </div>

                            <input type="text" id="txt-fichaAprendiz" idFicha="<?php echo $idFicha; ?>" ruta="<?php echo $_GET["ruta"];?>" value="<?php echo $idFicha; ?>" hidden disabled required>
                        <?php
                        }elseif($_GET["ruta"] == "aprendices"){?>
                            <div class="input-group input-group-merge">
                                <input type="text" id="txt-fichaAprendiz-0" data-bs-toggle="modal"
                                data-bs-target="#modalSelectFichas" class="form-control phone-mask "
                                placeholder="Click para seleccionar una ficha"
                                aria-label="Click para seleccionar una ficha" aria-describedby="txt-fichaAprendiz-0"
                                disabled required>

                                <span class="input-group-text cursor-pointer" data-bs-toggle="modal"
                                data-bs-target="#modalSelectFichas"><i class='bx bxs-add-to-queue'></i></span>    
                            </div>

                            <input type="text" id="txt-fichaAprendiz" idFicha="" ruta="<?php echo $_GET["ruta"];?>" hidden disabled required>
                        <?php
                        }
                    ?>

                    <div class="invalid-feedback">Porfavor seleccione una ficha</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>

                <div class="mb-3 col-md-6">
                    <?php include "selectDocumentos.php"; ?>
                    <div class="invalid-feedback">Porfavor seleccione tipo de documento</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="txt-DocumentoAprendiz" class="form-label">DOCUMENTO</label>
                    <input type="text" id="txt-DocumentoAprendiz" class="form-control phone-mask" placeholder="Número de documento" aria-label="Numero de documento" aria-describedby="txt-DocumentoAprendiz" required>


                    <div class="invalid-feedback">Porfavor ingrese número de documento</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="txt-NombresAprendiz" class="form-label">NOMBRES</label>
                    <input type="text" id="txt-NombresAprendiz" class="form-control phone-mask" placeholder="Nombres" aria-label="Nombres" aria-describedby="txt-NombresAprendiz" required>
                    <div class="invalid-feedback">Porfavor ingrese nombres</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="txt-ApellidosAprendiz" class="form-label">APELLIDOS</label>
                    <input type="text" id="txt-ApellidosAprendiz" class="form-control phone-mask" placeholder="Apellidos" aria-label="Apellidos" aria-describedby="txt-ApellidosAprendiz" required>
                    <div class="invalid-feedback">Porfavor ingrese apellidos</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="txt-NumeroAprendiz" class="form-label">TELEFONO</label>
                    <input type="text" id="txt-NumeroAprendiz" class="form-control phone-mask" placeholder="Número de telefono" aria-label="Número de telefono" aria-describedby="txt-NumeroAprendiz" required>
                    <div class="invalid-feedback">Porfavor ingrese número de telefono </div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="txt-EmailAprendiz" class="form-label">EMAIL</label>
                    <div class="input-group input-group-merge">
                        <input type="text" id="txt-EmailAprendiz" class="form-control" placeholder="example.em" aria-label="example.em" aria-describedby="spam-Email" required>
                        <span class="input-group-text" id="spam-Email">@example.com</span>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div class="invalid-feedback">Porfavor ingrese Email</div>
                    </div>
                </div>
                <div class="mb-3 col-md-6">
                    <?php include "selectEstadoAprendiz.php"; ?>
                    <div class="invalid-feedback">Porfavor seleccione estado del aprendiz</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>
            </div>

            <div class="d-grid gap-2 d-md-block">
                <button type="button" class="btn btn-dark" id="atrasAprendiz">Regresar</button>

                <button type="submit" class="btn btn-primary " id="btn-agregarAprendiz"><i class="bx bx-user-plus me-1"></i> Agregar</button>
            </div>
        </form>
    </div>
</div>