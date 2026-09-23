<script async defer src="assets/js/cl_seguimientosTipo.js"></script>
<script async defer src="vista/js/seguimientosTipo.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Asignación de seguimientos /</span> Seguimientos parciales
    </h4>

    <div class="row seguimientosPorTipo" id="seguimientosPorTipo" tipo="Parcial">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="error"></div>
                    <br>
                    <div class="table-responsive">
                        <table id="tabla_seguimientosPorTipo" funcionario="<?php echo $_SESSION["tipoUsuario"] ?>" class="table table-hover align-middle table-sm border-top" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap text-center text-dark" style="font-size: 10px;">Fecha Radicado</th>
                                    <th class="text-nowrap text-center text-dark" style="font-size: 10px;">Fecha Vencimiento</th>
                                    <th class="text-nowrap text-center text-dark" style="font-size: 10px;">Fecha Entrega</th>
                                    <th class="text-nowrap text-center text-dark" style="font-size: 10px;">Documento</th>
                                    <th class="text-nowrap text-center text-dark" style="font-size: 10px;">Instructor</th>
                                    <th class="text-nowrap text-center text-dark" style="font-size: 10px;">Ficha</th>
                                    <th class="text-nowrap text-center text-dark" style="font-size: 10px;">Caracterización</th>
                                    <th class="text-nowrap text-center text-dark" style="font-size: 10px;">Documento A.</th>
                                    <th class="text-nowrap text-center text-dark" style="font-size: 10px;">Aprendiz</th>
                                    <th class="text-nowrap text-center text-dark" style="font-size: 10px;">Ubicación</th>
                                    <th class="text-nowrap text-center text-dark" style="font-size: 10px;">Estado</th>
                                    <th class="text-nowrap text-center text-dark" style="font-size: 10px;">Reporte</th>
                                    <th class="text-nowrap text-center text-dark" style="font-size: 10px;">Acciones</th>
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
    <?php include_once "datosSeguimiento.php"; ?>


    <?php include_once "ModalSeguimientosTipo.php" ?>

    <?php include_once "Modal_Instructores.php" ?>
</div>

