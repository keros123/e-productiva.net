<script src="assets/js/cl_fichasInstructor.js"></script>
<script async defer src="vista/js/fichasInstructor.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="fichasAsignadasInstructor">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">LMS/</span>Fichas Asignadas
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="error"></div>
                        <br>
                        <div class="table-responsive">
                            <?php
                                echo '<table id="tablaFichasAsignadasInstructor" idInstructor="'.$_SESSION["id"].'" class="table table-striped table-bordered  align-middle table-sm border-bottom" style="width: 100%;">';
                            ?>
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-nowrap text-center text-white">Ficha</th>
                                        <th class="text-nowrap text-center text-white">Caracterización</th>
                                        <th class="text-nowrap text-center text-white">Fecha Inicio</th>
                                        <th class="text-nowrap text-center text-white">Fecha Fin Lectiva</th>
                                        <th class="text-nowrap text-center text-white">Fecha Fin Práctica</th>
                                        <th class="text-nowrap text-center text-white">Estado</th>
                                        <th class="text-nowrap text-center text-white">...</th>
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

    <!-- aprendices -->

    <div class="aprendicesAsignadosInstructor aprendicesInstructor" style="display: none;">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">LMS/</span><a class="atras_aprendicesAsignadosInstructor" href="javascript:void(0);">Fichas Asignadas</a>/<span id="span_caracterizacion"></span>
        </h4>

        <div class="row">
            <div class="col-md-12">
            <div class="d-grid gap-2 d-md-block md-4 mt-4">
                <button type="button" class="btn btn-dark atras_aprendicesAsignadosInstructor" data-bs-toggle="tooltip" data-bs-placement="top" title="Regresar"><img src="assets/img/interface/flecha.png">  Regresar</i></button>
            </div>
            <br>
                <div class="card">
                    <div class="card-body">
                        <div class="error"></div>
                        <br>
                        <div class="table-responsive">
                            <table id="tablaAprendicesAsignadosInstructor" idFicha="" class="table table-striped table-bordered align-middle table table-sm border-bottom"
                                style="width: 100%;">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-nowrap text-center text-white">Tipo</th>
                                        <th class="text-nowrap text-center text-white">Documento</th>
                                        <th class="text-nowrap text-center text-white">Nombres</th>
                                        <th class="text-nowrap text-center text-white">Apellidos</th>
                                        <th class="text-nowrap text-center text-white">Celular</th>
                                        <th class="text-nowrap text-center text-white">Email</th>
                                        <th class="text-nowrap text-center text-white">Aval Patrocinio</th>
                                        <th class="text-nowrap text-center text-white">...</th>
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
    <?php include_once "detallesAprendiz.php"; ?>
</div>