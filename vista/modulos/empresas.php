<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Panel Administrativo /</span> Empresas
    </h4>

    <div id="contenedorFormularioEmpresa" class="container card" style="display: none;">
        <div class="card-body">
            <form id="formEmpresas" class="row g-3 needs-validation" novalidate>
                <div class="col-md-4">
                    <label for="txt_nit" class="form-label">NIT de empresa</label>
                    <input type="text" class="form-control" id="txt_nit" required>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Este campo no puede ir vacío</div>
                </div>
            
                <div class="col-md-4">
                    <label for="txt_razon" class="form-label">Nombre de empresa o razón Social</label>
                    <input type="text" class="form-control" id="txt_razon" required>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Este campo no puede ir vacío</div>
                </div>


                <div class="col-md-4">
                    <label class="form-label" for="selectDepartamentosEmpresa">Departamento</label>
                    <select id="selectDepartamentosEmpresa" name="selectDepartamentosEmpresa" class="select2 form-select" required>
                    </select>
                    <div class="valid-feedback">¡Se ve bien!</div>
                    <div class="invalid-feedback">Proporciona un departamento válido.</div>
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="selectMunicipio">Ciudad</label>
                    <select id="selectMunicipiosEmpresa" class="select2 form-select" required>
                        <option value="">Seleccione</option>
                    </select>
                    <div class="valid-feedback">¡Se ve bien!</div>
                    <div class="invalid-feedback">Proporciona una ciudad válida.</div>
                </div>

                <div class="col-md-4">
                    <label for="txt_direccion" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="txt_direccion" required>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Este campo no puede ir vacío</div>
                </div>

                
                <div class="col-md-4">
                    <label for="txt_telefono" class="form-label">Telefeno de empresa</label>
                    <input type="text" class="form-control" id="txt_telefono" required>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Este campo no puede ir vacío</div>
                </div>

                <div class="col-12">
                    <button type="button" class="btn btn-dark" id="atrasEmpresa">Regresar</button>

                    <button class="btn btn-primary" type="submit"><i class="bx bx-buildings me-1"></i> Agregar</button>
                </div>
            </form>
        </div>
    </div>


    <div id="contenedorFormularioEditarEmpresa" class="container  card" style="display: none;">
        <div class="card-body">
            <form id="formEmpresasEdit" class="row g-3 needs-validation" novalidate>
                <div class="col-md-4">
                    <label for="txt_nitEdit" class="form-label">NIT de empresa</label>
                    <input type="text" class="form-control" id="txt_nitEdit" required>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Este campo no puede ir vacío</div>
                </div>
            
            
                <div class="col-md-4">
                    <label for="txt_razon" class="form-label">Nombre de empresa o razón Social</label>
                    <input type="text" class="form-control" id="txt_razonEdit" required>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Este campo no puede ir vacío</div>
                </div>


                <div class="col-md-4">
                    <label class="form-label" for="selectDepartamentosEmpresaEdit">Departamento</label>
                    <select id="selectDepartamentosEmpresaEdit" name="selectDepartamentosEmpresaEdit" class="select2 form-select" required>
                    </select>
                    <div class="valid-feedback">¡Se ve bien!</div>
                    <div class="invalid-feedback">Proporciona un departamento válido.</div>
                </div>

                <div class="col-md-4">
                    <label class="form-label" for="selectMunicipiosEmpresaEdit">Ciudad</label>
                    <select id="selectMunicipiosEmpresaEdit" class="select2 form-select" required>
                        <option value="">Seleccione</option>
                    </select>
                    <div class="valid-feedback">¡Se ve bien!</div>
                    <div class="invalid-feedback">Proporciona una ciudad válida.</div>
                </div>

                <div class="col-md-4">
                    <label for="txt_direccionEdit" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="txt_direccionEdit" required>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Este campo no puede ir vacío</div>
                </div>

                
                <div class="col-md-4">
                    <label for="txt_telefonoEdit" class="form-label">Telefeno de empresa</label>
                    <input type="text" class="form-control" id="txt_telefonoEdit" required>
                    <div class="valid-feedback">Looks good!</div>
                    <div class="invalid-feedback">Este campo no puede ir vacío</div>
                </div>

                <div class="col-12">
                    <button type="button" class="btn btn-dark" id="atrasEmpresaEdit">Regresar</button>

                    <button id="btnEditarDatosEmpresa" empresa="" class="btn btn-primary" type="submit"><i class="bx bx-buildings me-1"></i> Editar</button>
                </div>
            </form>
        </div>
    </div>

    <br>
    <div id="contenedorTablaEmpresa" class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3 d-flex justify-content-end">
                <li class="nav-item">
                    <a id="btnEmpresa" class="nav-link active mc-link"><i class="bx bx-buildings me-1"></i> Agregar Empresa</a>
                </li>
            </ul>
            <div class="card">
                <div class="card-body">
                    <div class="error"></div>
                    <br>
                    <div class="table-responsive">
                        <table id="tablaEmpresas" class="table border-top" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap text-center text-dark">#</th>
                                    <th class="text-nowrap text-center text-dark">Nit</th>
                                    <th class="text-nowrap text-center text-dark">Razon Social</th>
                                    <th class="text-nowrap text-center text-dark">Departamento</th>
                                    <th class="text-nowrap text-center text-dark">Municipio</th>
                                    <th class="text-nowrap text-center text-dark">Dirección</th>
                                    <th class="text-nowrap text-center text-dark">Telefono</th>
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


</div>

<script async defer src="vista/js/empresa.js"></script>