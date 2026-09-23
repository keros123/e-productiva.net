<script src="assets/js/cl_funcionario.js"></script>
<script src="assets/js/cl_asignacionFichas.js"></script>
<script async defer src="vista/js/funcionario.js"></script>
<script async defer src="vista/js/asignacionFichas.js"></script>

<?php 
    include_once "asignacionFichas.php";
?>

<div class="container-xxl flex-grow-1 container-p-y ModuloFuncionario">
    <h4 class="fw-bold py-3 mb-4 funcionarios">
        <?php 
            if ($_SESSION["tipoUsuario"] == 5){
                echo '<span class="text-muted fw-light">Panel Administrativo /</span> Seguimientos Por Funcionario';
            }else{
                echo '<span class="text-muted fw-light">Panel Administrativo /</span> Funcionarios';
            }
        ?>
    </h4>
    <div id="panelFuncionario" class="row funcionarios" funcionario="<?php echo $_SESSION["tipoUsuario"] ?>">
        <div class="col-md-12">
            <?php
                if ($_SESSION["tipoUsuario"] < "5") {
            ?>
                <ul class="nav nav-pills flex-column flex-md-row mb-3 justify-content-end">
                    <!-- <li class="nav-item"> -->
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a class="btn btn-primary" id="btn_agr_funcionario" href="javascript:void(0);" title="Agregar Funcionario"><i class="bx bx-user-plus"></i></a>
                            <a class="btn btn-secondary" id="btn_bloquear_funcionarios" href="javascript:void(0);" title="Bloquear Instructores"><i class="bx bx-user-x"></i></a>
                            <a class="btn btn-info" id="btn_habilitar_funcionarios" href="javascript:void(0);" title="Habilitar Instructores"><i class="bx bx-user-check"></i></a>
                        </div>
                    <!-- </li> -->
                </ul>
            <?php 
                }
            ?>

            <div class="card mb-4 tb_funcionarios">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tablaFuncionarios" class="table table-hover align-middle table-sm border-top" style="width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-nowrap text-center text-dark">Nombres</th>
                                    <th class="text-nowrap text-center text-dark">E-Mail</th>
                                    <th class="text-nowrap text-center text-dark">Telefono</th>
                                    <th class="text-nowrap text-center text-dark">Rol</th>
                                    <?php 
                                        if ($_SESSION["tipoUsuario"] == 5){
                                            echo '<th class="text-nowrap text-center text-dark">...</th>';
                                        }else{
                                            echo '<th class="text-nowrap text-center text-dark">Acciones</th>';
                                        }
                                    ?>
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
            
            <div class="card mb-4 formFuncionarioAgregar" style="display: none;">
                <div class="card-body">
                    <form id="formAgregarFuncionario" class="needs-validated" novalidate>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="txt_nombres" class="form-label">Nombres</label>
                                <input class="form-control" type="text" id="txt_nombres" name="txt_nombres" autofocus placeholder="Ingrese Nombres"  required/>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona un Nombre válido.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="txt_apellidos" class="form-label">Apellidos</label>
                                <input class="form-control" type="text" name="txt_apellidos" id="txt_apellidos" placeholder="Ingrese Apellidos"  required/>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona un Apellido válido.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="selectDocumento" class="form-label">Tipo de Documento</label>
                                <select id="selectDocumento" class="form-select" required>
                                    <option value="">Seleccione</option>
                                </select>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona un tipo de documento válido.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="txt_documento" class="form-label">Documento</label>
                                <input class="form-control" type="text" id="txt_documento" name="txt_documento" placeholder="Ingrese Numero Documento" required/>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona un Documento válido.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="txt_email" class="form-label">E-mail</label>
                                <input class="form-control" type="email" id="txt_email" name="txt_email" placeholder="example@email.com"  required/>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona un email válido.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="txt_telefono">Telefono</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">CO (+57)</span>
                                    <input type="text" id="txt_telefono" name="txt_telefono" class="form-control" placeholder="Numero Telefono" required/>
                                </div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona un telefono válido.</div>
                            </div>


                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="selectDepartamentos">Departamento</label>
                                <select id="selectDepartamentos" name="selectDepartamentos" class="select2 form-select" required>
                                    <option value="">Seleccione</option>
                                </select>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona un departamento válido.</div>
                            </div>


                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="selectMunicipio">Ciudad</label>
                                <select id="selectMunicipios" class="select2 form-select" required>
                                    <option value="">Seleccione</option>
                                </select>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona una ciudad válida.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="txt_direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="txt_direccion" name="txt_direccion" placeholder="Dirección"  required/>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona una Dirección válida.</div>
                            </div>


                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label for="selectTipoFuncionario" class="form-label">Tipo Funcionario</label>
                                <select id="selectTipoFuncionario" name="selectTipoFuncionario" class="select2 form-select" required>
                                    <option value="">Seleccione</option>
                                </select>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona una opción válida.</div>
                            </div>
                            
                        </div>

                        <div class="d-grid gap-2 d-md-block">
                            <button type="button" class="btn btn-dark atrasFuncionarioFormulario" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Regresar">Regresar</button>

                            <button type="submit" class="btn btn-primary "><i
                            class="bx bx-user-plus me-1"></i> Crear Funcionario</button>
                        </div>
                    </form>
                </div>
            </div>


            <div class="card mb-4 formFuncionarioEdit" id="form_editar_funcionario" style="display: none;">
                <div class="card-body">
                    <form id="formFuncionarioEdit" class="needs-validated" novalidate>
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="txt_nombresEdit" class="form-label">Nombres</label>
                                <input class="form-control" type="text" id="txt_nombresEdit" name="txt_nombresEdit" autofocus placeholder="Ingrese Nombres" required/>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona un Nombre válido.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="txt_apellidosEdit" class="form-label">Apellidos</label>
                                <input class="form-control" type="text" name="txt_apellidosEdit" id="txt_apellidosEdit" placeholder="Ingrese Apellidos" required />
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona un Apellido válido.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="selectDocumentoEdit" class="form-label">Tipo de Documento</label>
                                <select id="selectDocumentoEdit" class="form-select" required>
                                    <option value="">Seleccione</option>
                                </select>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona un tipo de documento válido.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="txt_documentoEdit" class="form-label">Documento</label>
                                <input class="form-control" type="text" id="txt_documentoEdit" name="txt_documentoEdit" placeholder="Ingrese Numero Documento" required/>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona un Documento válido.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="txt_emailEdit" class="form-label">E-mail</label>
                                <input class="form-control" type="email" id="txt_emailEdit" name="txt_emailEdit" placeholder="example@email.com"  required/>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona un email válido.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="txt_telefonoEdit">Telefono</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">CO (+57)</span>
                                    <input type="text" id="txt_telefonoEdit" name="txt_telefonoEdit" class="form-control" placeholder="Numero Telefono" required/>
                                </div>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona un telefono válido.</div>
                            </div>


                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="selectDepartamentosEdit">Departamento</label>
                                <select id="selectDepartamentosEdit" name="selectDepartamentosEdit" class="select2 form-select" required>
                                    <option value="">Seleccione</option>
                                </select>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona un departamento válido.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label" for="selectMunicipioEdit">Ciudad</label>
                                <select id="selectMunicipiosEdit" class="select2 form-select" required>
                                    <option value="">Seleccione</option>
                                </select>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona una ciudad válida.</div>
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="txt_direccionEdit" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="txt_direccionEdit" name="txt_direccionEdit" placeholder="Dirección" required />
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona una Dirección válida.</div>
                            </div>
                            <div class="mb-3 col-md-6 form-password-toggle">
                                <label for="selectTipoFuncionarioEdit" class="form-label">Tipo Funcionario</label>
                                <select id="selectTipoFuncionarioEdit" name="selectTipoFuncionarioEdit" class="form-select" required>
                                </select>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona una Contraseña válida.</div>
                            </div>
                            
                        <div class="d-grid gap-2 d-md-block">
                            <button type="button" class="btn btn-dark atrasFuncionarioFormularioEdit" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Regresar">Regresar</button>

                            <button type="submit" class="btn btn-primary" id="btn_Actualizar" idFuncionario=""><i
                            class="bx bx-user-plus me-1"></i>Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    include_once "detallesFuncionario.php";
?>
