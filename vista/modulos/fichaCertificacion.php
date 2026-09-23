<script src="assets/js/cl_fichaCertificacion.js"></script>
<script src="assets/js/cl_aprendizCertificacion.js"></script>



<div class="container-xxl flex-grow-1 container-p-y">
    <div class="fichasAsignadasCertificacion">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Panel Administrativo /</span> Fichas Por Certificar
        </h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card card_tablaFichas">
                    <div class="card-body">
                        <div class="error"></div>
                        <br>
                        <div class="table-responsive">
                            <table id="tablaFichaCertificacion" class="table table-hover align-middle table-sm border-bottom" style="width: 100%;">
                                <thead class="table-dark">
                                    <tr>
                                        <th class="text-nowrap text-center text-white">Ficha</th>
                                        <th class="text-nowrap text-center text-white">Caracterización</th>
                                        <th class="text-nowrap text-center text-white">Línea Tecnológica</th>
                                        <th class="text-nowrap text-center text-white">Red Tecnológica</th>
                                        <th class="text-nowrap text-center text-white">Inicio</th>
                                        <th class="text-nowrap text-center text-white">Fin Lectiva</th>
                                        <th class="text-nowrap text-center text-white">Fin Práctica</th>
                                        <th class="text-nowrap text-center text-white">Estado</th>
                                        <th class="text-nowrap text-center text-white">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="aprendicesCertificacionFicha" style="display: none;">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4">
                <span class="text-muted fw-light">LMS/</span><a class="atras_aprendicesCertificar" href="javascript:void(0);" data-bs-toggle="tab" data-bs-target="#fichasPorCertificar">Aprendices</a>/<span id="span_caracterizacion"></span>
            </h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="d-grid gap-2 d-md-block md-4 mt-4">
                        <button type="button" class="btn btn-dark atras_aprendicesCertificar" data-bs-toggle="tooltip" data-bs-placement="top" title="Regresar"><img src="assets/img/interface/flecha.png"> Regresar</button>
                    </div>
                    <br>
                    <div class="card card_tablaAprendices">
                        <div class="card-body">
                            <div class="error"></div>
                            <br>
                            <div class="table-responsive">
                                <table id="tablaAprendicesCertificacion" idFicha="" class="table table-striped table-bordered align-middle table table-sm border-bottom" style="width: 100%;">
                                    <thead class="table-dark">
                                        <tr>
                                            <th class="text-nowrap text-center text-white">Tipo</th>
                                            <th class="text-nowrap text-center text-white">Documento</th>
                                            <th class="text-nowrap text-center text-white">Nombres</th>
                                            <th class="text-nowrap text-center text-white">Apellidos</th>
                                            <th class="text-nowrap text-center text-white">Celular</th>
                                            <th class="text-nowrap text-center text-white">Email</th>
                                            <th class="text-nowrap text-center text-white">Ficha</th>
                                            <th class="text-nowrap text-center text-white">Alternativa</th>
                                            <th class="text-nowrap text-center text-white">Fecha inicio</th>
                                            <th class="text-nowrap text-center text-white">Fecha finalización</th>
                                            <th class="text-nowrap text-center text-white">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>


<!-- Tabla de documentos del aprendiz -->
    <div class="documentosAprendiz" style="display:none;">
    <!-- <div class="documentosAprendiz"> -->
        <div class="row">
            <?php include_once "aprendizCertificar.php"; ?>
        </div>
    </div>

</div>


<script async defer src="vista/js/fichaCertificacion.js"></script>
<script async defer src="vista/js/aprendizCertificacion.js"></script>