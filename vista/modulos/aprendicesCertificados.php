<script async defer src="assets/js/cl_aprendicesCertificados.js"></script>
<script async defer src="vista/js/aprendicesCertificados.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Panel Administrativo /</span> Aprendices Certificados
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="error"></div>
                    <br>
                    <div class="table-responsive" style="visibility: hidden;">
                        <table id="tabla_AprendicesCertificados" class="table table-hover align-middle table-sm border-top" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    
                                    <th class="text-nowrap text-center">Certificado</th>
                                    <th class="text-nowrap text-center">Ficha</th>
                                    <th class="text-nowrap text-center">Caracterización</th>
                                    <th class="text-nowrap text-center">Documento</th>
                                    <th class="text-nowrap text-center">Nombres</th>
                                    
                                    <th class="text-nowrap text-center">Modalidad</th>
                                    <th class="text-nowrap text-center">Municipio</th>
                                    <th class="text-nowrap text-center">Departamento</th>
                                    <th class="text-nowrap text-center">Nombre Empresa</th>
                                    <th class="text-nowrap text-center">Dirección</th>
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
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="detalles" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body" style="background-color:#f5f5f9;">
                    <div class="row mt-2 p-2">
                        <div class="col-md-5  text-center p-2" style="border-right: 2px solid #394859 ">
                            <img id="imagenAprendiz" src="assets/img/interface/profile.png" alt="user-avatar" class="d-block rounded mx-auto" height="200" width="200">
                            <div class="row mt-2" id="NombreAprendiz"></div>
                        </div>
                        <div class="col-md-7 aling-items-center p-2">
                            <div class="row mt-2 px-1" style="justify-content:center;" id="informacionPersonal"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>