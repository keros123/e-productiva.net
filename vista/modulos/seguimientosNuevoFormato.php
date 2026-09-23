<script async defer src="assets/js/cl_seguimientosTipo.js"></script>
<script async defer src="vista/js/seguimientosTipo.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Asignación de seguimientos / Seguimientos nuevo formato / </span><span id="tipoSeguimientoNuevoFormato">Seguimiento momento 1</span>
    </h4>

    <div class="row seguimientosPorTipo" id="seguimientosPorTipo" tipo="Seguimiento momento 1">
        <div class="col-md-12 mb-3">
            <ul class="nav nav-tabs justify-content-end" id="TipoSeguimientoNuevoFormato" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active btn-seguimiento-tipo fw-bold text-primary" data-bs-toggle="tab" type="button" role="tab" tipo="Seguimiento momento 1">Momento 1</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn-seguimiento-tipo fw-bold text-muted" data-bs-toggle="tab" type="button" role="tab" tipo="Seguimiento momento 2">Momento 2</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn-seguimiento-tipo fw-bold text-muted" data-bs-toggle="tab" type="button" role="tab" tipo="Seguimiento momento 3">Momento 3</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link btn-seguimiento-tipo fw-bold text-muted" data-bs-toggle="tab" type="button" role="tab" tipo="Seguimiento extraordinario">Extraordinario</button>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="error"></div>
                    <br>
                    <div class="table-responsive">
                        <table id="tabla_seguimientosPorTipo" funcionario="<?php echo $_SESSION["tipoUsuario"] ?>" class="table table-hover align-middle table-sm border-top" style="width: 100%;">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once "datosSeguimiento.php"; ?>


    <?php include_once "ModalSeguimientosTipo.php" ?>

    <?php include_once "Modal_Instructores.php" ?>
</div>

