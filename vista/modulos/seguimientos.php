<script src="assets/js/cl_etapaPractica.js"></script>

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Registrar Etapa Practica /</span> Etapa Practica
    </h4>

    <div id="contenedorTablaSeguimientos" class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3 justify-content-end">
                <li class="nav-item ">
                    <a id="btn-VisualizarFormularioSeguimiento" class="nav-link active" href="javascript:void(0);"><i class="bx bx-file me-1"></i> Registrar Etapa Practica</a>
                </li>

                <li id="contenedorBtnSubirArchivo" class="nav-item">
                    <div class="button-wrapper mc-pading">
                        <label for="btn_excel_EtapaPractica" class="btn btn-secondary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block"><i class='bx bxs-file-doc'></i> Subir Archivo</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="btn_excel_EtapaPractica" class="account-file-input" hidden accept=".xlsx, .xls, .csv" />
                        </label>
                    </div>
                </li>
            </ul>

            <div id="contenedorErrores" style="display: none;">

            </div>

            <div id="contenedorLoaderEtapaPractica" style="display: none;">
                <div class="alert alert-primary">
                    <strong>Alerta!</strong> Subiendo información desde el archivo plano, espera un momento por favor.
                </div>
                <?php include_once "loaderPc.html";?>
            </div>
            
            <div id="contenedorEtapasPracticas" class="card">
                <div class="card-body">
                    <div class="error"></div>
                    <br>
                    <div class="table-responsive">
                        <table id="tablaEtapaPractica" class="table border-top dt-responsive" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap text-center text-dark">Inicio Practica</th>
                                    <th class="text-nowrap text-center text-dark">Fin practica</th>
                                    <th class="text-nowrap text-center text-dark">Modalidad</th>
                                    <th class="text-nowrap text-center text-dark">Ficha</th>
                                    <th class="text-nowrap text-center text-dark">Caracterización</th>
                                    <th class="text-nowrap text-center text-dark">Documento</th>
                                    <th class="text-nowrap text-center text-dark">Aprendiz</th>
                                    <th class="text-nowrap text-center text-dark">Email</th>
                                    <th class="text-nowrap text-center text-dark">Empresa</th>
                                    <th class="text-nowrap text-center text-dark">Observación</th>
                                    <th class="text-nowrap text-center text-dark">Estado</th>
                                    <th class="text-nowrap text-center text-dark">Acciones</th>
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

    <div id="contenedorFormularioSeguimientos" class="container card" style="display: none;">
        <div class="card-body">
            <form id="formSeguimientos" class="row g-3 needs-validation" novalidate>

                <div class="mb-3 col-md-4 fila1">
                    <label for="txt-fechaFinPractica" class="form-label">FECHA INICIO PRÁCTICA</label>
                    <input type="date" id="txt-fechaInicioPractica" class="form-control phone-mask" aria-describedby="txt-fechaInicioPractica" required>
                    <div class="invalid-feedback">Por favor ingrese una fecha valida.</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>

                <div class="mb-3 col-md-4 fila1">
                    <label for="txt-fechaFinPractica" class="form-label">FECHA TERMINACIÓN PRÁCTICA</label>
                    <input type="date" id="txt-fechaFinPractica" class="form-control phone-mask" aria-describedby="txt-fechaFinPractica" required>
                    <div class="invalid-feedback">Por favor ingrese una fecha valida.</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>


                <div class="mb-3 col-md-4 fila1">
                    <label for="selectModalidad" class="form-label">MODALIDAD ETAPA PRÁCTICA</label>
                    <select id="selectModalidad" name="selectModalidad" class="select2 form-select" required>
                        <option></option>
                    </select>
                    <div class="valid-feedback">¡Se ve bien!</div>
                    <div class="invalid-feedback">Proporciona una modalidad válida.</div>
                </div>

                <div class="mb-3 col-md-4 fila1" id="contenedor_documento" style="display:none;">
                    <label for="txt-documentoFile" class="form-label">DOCUMENTO</label>
                    <input type="file" id="txt-documentoFile" class="form-control phone-mask" aria-describedby="txt-documentoFile" accept=".pdf">
                    <div class="invalid-feedback">Por favor ingrese un documento valido.</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>

                <div class="mb-3 col-md-12" id="contenedor_instructor" style="display:none;">
                    <label class="form-label" for="txt_instructor">Instructor</label>

                    <div class="input-group input-group-merge">
                        <input type="text" id="txt_instructor" idInstructor="" class="form-control" placeholder="Click para seleccionar instructor" disabled required>
                        <span class="input-group-text cursor-pointer" id="btn-ListarInstructores" data-bs-toggle="modal" data-bs-target="#modalInstructores"><i class='bx bx-list-plus'></i></span>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div id="errorInstructor" class="invalid-feedback">Por favor seleccione un instructor.</div>
                    </div>
                </div>


                <div class="mb-3 col-md-12">
                    <label class="form-label" for="txt_ficha">FICHA</label>

                    <div class="input-group input-group-merge">
                        <input type="text" id="txt_ficha" idFicha="" class="form-control" placeholder="Click para seleccionar ficha" disabled required>
                        <span class="input-group-text cursor-pointer" id="btn-ListarFichas" data-bs-toggle="modal" data-bs-target="#modalFichas"><i class='bx bx-list-plus'></i></span>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div id="errorFicha" class="invalid-feedback">Por favor seleccione un ficha de formación.</div>
                    </div>
                </div>

                <div class="mb-3 col-md-12">
                    <label class="form-label" for="txt_aprendiz">APRENDIZ</label>
                    <div class="input-group input-group-merge">
                        <input type="text" id="txt_aprendiz" idaprendiz="" data-bs-toggle="modal" data-bs-target="#modalAprendiz" class="form-control phone-mask " placeholder="Click para selecionar aprendiz" aria-label="Click para selecionar aprendiz" disabled="" required="">
                        <span class="input-group-text cursor-pointer" id="btn-ListarAprendiz"><i class='bx bx-list-plus'></i></span>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div id="errorAprendiz" class="invalid-feedback">Por favor seleccione un aprendiz.</div>
                    </div>
                </div>


                <div class="mb-3 col-md-12">
                    <label class="form-label" for="txt_empresa">EMPRESA</label>
                    <div class="input-group input-group-merge">
                        <input type="text" id="txt_empresa" idEmpresa="" data-bs-toggle="modal" data-bs-target="#modalEmpresas" class="form-control phone-mask " placeholder="Click para seleccionar empresa" aria-label="Click para seleccionar empresa" disabled="" required="">
                        <span class="input-group-text cursor-pointer" id="btn-ListarEmpresas" data-bs-toggle="modal" data-bs-target="#modalEmpresas"><i class='bx bx-list-plus'></i></span>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div id="errorEmpresa" class="invalid-feedback">Por favor seleccione una empresa.</div>
                    </div>
                </div>


                <div class="col-12">
                    <button type="button" class="btn btn-dark" id="atrasSeguimiento">Regresar</button>

                    <button class="btn btn-primary" type="submit"><i class="bx bx-buildings me-1"></i> Agregar</button>
                </div>
            </form>
        </div>

    </div>

    <div id="contenedorFormularioSeguimientosEditar" class="container card" style="display: none;">
        <div class="card-body">
            <form id="formSeguimientosEditar" class="row g-3 needs-validation" novalidate>
                <div class="mb-3 col-md-4 fila1-edit">
                    <label for="txt-fechaFinPracticaEdit" class="form-label">FECHA INICIO PRÁCTICA</label>
                    <input type="date" id="txt-fechaInicioPracticaEdit" class="form-control phone-mask" aria-describedby="txt-fechaInicioPractica" required>
                    <div class="invalid-feedback">Por favor ingrese una fecha valida.</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>

                <div class="mb-3 col-md-4 fila1-edit">
                    <label for="txt-fechaFinPracticaEdit" class="form-label">FECHA TERMINACIÓN PRÁCTICA</label>
                    <input type="date" id="txt-fechaFinPracticaEdit" class="form-control phone-mask" aria-describedby="txt-fechaFinPractica" required>
                    <div class="invalid-feedback">Por favor ingrese una fecha valida.</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>

                <div class="mb-3 col-md-4 fila1-edit">
                    <label for="selectModalidadEdit" class="form-label">MODALIDAD ETAPA PRÁCTICA</label>
                    <select id="selectModalidadEdit" name="selectModalidadEdit" class="select2 form-select" required>
                        <option></option>
                    </select>
                    <div class="valid-feedback">¡Se ve bien!</div>
                    <div class="invalid-feedback">Proporciona una modalidad válida.</div>
                </div>

                <div class="mb-3 col-md-4 fila1-edit" id="contenedor_documento_edit" style="display:none;">
                    <label for="txt-documentoFileEdit" class="form-label">DOCUMENTO (PDF)</label>
                    <input type="file" id="txt-documentoFileEdit" class="form-control" aria-describedby="txt-documentoFileEdit" accept=".pdf">
                    <div class="invalid-feedback">Por favor ingrese un documento valido.</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                </div>

                <div class="mb-3 col-md-6">
                    <label class="form-label" for="txt_empresaEdit">EMPRESA</label>
                    <div class="input-group input-group-merge">
                        <input type="text" id="txt_empresaEdit" idEmpresa="" etapaPractica="" data-bs-toggle="modal" data-bs-target="#modalEmpresas" class="form-control phone-mask " placeholder="Click para seleccionar empresa" aria-label="Click para seleccionar empresa" disabled="" required="">
                        <span class="input-group-text cursor-pointer" id="btn-ListarEmpresasEdit" data-bs-toggle="modal" data-bs-target="#modalEmpresas"><i class='bx bx-list-plus'></i></span>
                        <div class="valid-feedback">¡Se ve bien!</div>
                        <div id="errorEmpresaEdit" class="invalid-feedback">Por favor seleccione una empresa.</div>
                    </div>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="txtEstadoEtapaPractica" class="form-label">ESTADO ETAPA PRACTICA</label>
                    <select name="txtEstadoEtapaPractica" id="txtEstadoEtapaPractica" class="form-select" required>
                        <option value="1">Cerrado</option>
                        <option value="2">Abierto</option>
                    </select>
                    <div class="valid-feedback">¡Se ve bien!</div>
                    <p class="mb-1 mx-2">modificar este estado le permitira poder crear una nueva etapa practica al aprendiz.</p>
                </div>

                <div class="mb-3 col-md-12">
                    <label for="txt_observaciones" class="form-label">OBSERVACIONES</label>
                    <textarea class="form-control" id="txt_observaciones" rows="3"></textarea>
                </div>

                <div class="col-12">
                    <button type="button" class="btn btn-dark" id="atrasSeguimientoEdit">Regresar</button>

                    <button id="btnEditaEtapaPractica"  class="btn btn-primary" type="submit"><i class="bx bx-buildings me-1"></i> Editar</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalFichas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Fichas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="tablaFichasSeguimientos" class="table table-hover align-middle table-sm border-bottom" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-nowrap text-center text-white">Ficha</th>
                                    <th class="text-nowrap text-center text-white">Caracterización</th>
                                    <th class="text-nowrap text-center text-white">Estado</th>
                                    <th class="text-nowrap text-center text-white">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">

                            </tbody>
                        </table>
                    </div>



                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="modalInstructores" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Instructores</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="tablaInstructores" class="table table-hover align-middle table-sm border-top" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap text-center">Documento</th>
                                    <th class="text-nowrap text-center">Nombres</th>
                                    <th class="text-nowrap text-center">Apellidos</th>
                                    <th class="text-nowrap text-center">Email</th>
                                    <th class="text-nowrap text-center">...</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="modalAprendiz" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Aprendices</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="tablaAprendicesSeguimientos" class="table table-hover align-middle table-sm border-bottom" style="width: 100%;">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-nowrap text-center text-white">ficha</th>
                                <th class="text-nowrap text-center text-white">Documento</th>
                                <th class="text-nowrap text-center text-white">Nombres</th>
                                <th class="text-nowrap text-center text-white">Apellidos</th>
                                <th class="text-nowrap text-center text-white">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="modalEmpresas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Empresas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="tablaEmpresasSeguimientos" class="table table-hover align-middle table-sm border-bottom" style="width: 100%;">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-nowrap text-center text-white">Razon Social</th>
                                    <th class="text-nowrap text-center text-white">NIT</th>
                                    <th class="text-nowrap text-center text-white">Departamento</th>
                                    <th class="text-nowrap text-center text-white">Ciudad</th>
                                    <th class="text-nowrap text-center text-white">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider">

                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="container">

<div id="myGrid" style="height: 100%" class="ag-theme-alpine">
		</div>
		<script>var __basePath = './';</script>
</div>

<script async defer src="vista/js/seguimientos.js"></script>
<script async defer src="vista/js/gridSeguimientos.js"></script>