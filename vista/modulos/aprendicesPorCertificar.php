

<script src="assets/js/cl_fichaCertificacion.js"></script>
<script src="assets/js/cl_aprendizCertificacion.js"></script>
<script async defer src="assets/js/cl_aprendicesPorCertificar.js"></script>
<script async defer src="assets/js/cl_buscarAprendiz.js"></script>


<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Panel Administrativo /</span> Aprendices Por Certificar
    </h4>

    <div class="row aprendicesCertificacionFicha">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="error"></div>
                    <br>
                    <div class="table-responsive" style="visibility: hidden;">
                        <table id="tablaAprendicesCertificacion" class="table table-hover align-middle table-sm border-top" style="width: 100%;" >
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap text-center">Ficha</th>
                                    <th class="text-nowrap text-center">Caracterización</th>
                                    <th class="text-nowrap text-center">Documento</th>
                                    <th class="text-nowrap text-center">Nombres</th>
                                    <th class="text-nowrap text-center">Telefono</th>
                                    <th class="text-nowrap text-center">email</th>
                                    <th class="text-nowrap text-center">Estado</th>
                                    <th class="text-nowrap" height="25px"></th>
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

    <div id="documentosAprendiz" class="documentosAprendiz" style="display:none;">
        <div class="row">
            <?php include_once "aprendizCertificar.php"; ?>
        </div>
    </div>
</div>


<script async defer src="vista/js/aprendicesPorCertificar.js"></script>