<?php
include_once "modelo/usuarioModelo.php";
$objUsuario = usuarioModelo::mdlListarUsuario($_SESSION["id"], $_SESSION["tipoUsuario"]);
?>

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Perfil /</span> Cuenta</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i>
                            Cuenta</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="notifications"><i class="bx bx-bell me-1"></i> Notificaciones</a>
                    </li> -->
                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Detalles del Perfil</h5>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <?php
                            $ruta_imagen = "";
                            if ($objUsuario["url_foto"] != null) {
                                $ruta_imagen = $objUsuario["url_foto"];
                            } else {
                                $ruta_imagen = "assets/img/interface/user2.png";
                            }
                            ?>

                            <img id="visualizadorImagenRegistro" src="<?php echo $ruta_imagen; ?>" alt="user-avatar" class="d-block rounded" height="120" width="100" id="uploadedAvatar" />

                            <div class="button-wrapper">
                                <label for="txt_imagen" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Subir nueva foto</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="txt_imagen" class="account-file-input" hidden accept="image/png, image/jpeg" />
                                </label>
                        
                                <button type="button" id="btnGuardarImagen" class="btn btn-outline-secondary account-image-reset mb-4"  Usuario="<?php echo $_SESSION["id"];?>" tipoUsuario="<?php echo $_SESSION["tipoUsuario"];?>">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Guardar Cambios</span>
                                </button>

                                <p class="text-muted mb-0">Permitido JPG o PNG. Tamaño máximo de 800K</p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" class="needs-validated" novalidate>
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="txt_nombres" class="form-label">Nombres</label>
                                    <input class="form-control" type="text" id="txt_nombres" name="txt_nombres" value="<?php echo $objUsuario["nombres"]; ?>" autofocus />
                                    <input class="form-control" type="text" id="txt_sesion" name="txt_sesion" value="<?php echo $_SESSION["tipoUsuario"]; ?>" hidden/>
                                    <div class="valid-feedback">¡Se ve bien!</div>
                                    <div class="invalid-feedback">Proporciona un Nombre válido.</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="txt_apellidos" class="form-label">Apellidos</label>
                                    <input class="form-control" type="text" name="txt_apellidos" id="txt_apellidos" value="<?php echo $objUsuario["apellidos"]; ?>" />
                                    <div class="valid-feedback">¡Se ve bien!</div>
                                    <div class="invalid-feedback">Proporciona un Apellido válido.</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="selectAccountDocumento" class="form-label">Tipo de Documento</label>
                                    <select id="selectAccountDocumento" class="form-select" required>
                                        <option value="<?php echo $objUsuario["idtipo_documento"]; ?>"><?php  echo $objUsuario["nombre_tipo_documento"]; ?></option>
                                    </select>
                                    <div class="valid-feedback">¡Se ve bien!</div>
                                    <div class="invalid-feedback">Proporciona un tipo de documento válido.</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="txt_documento" class="form-label">Documento</label>
                                    <input class="form-control" type="text" id="txt_documento" name="txt_documento" value="<?php echo $objUsuario["documento"]; ?>" />
                                    <input class="form-control" type="text" id="txt_documento_old" name="txt_documento_old" value="<?php echo $objUsuario["documento"]; ?>" hidden />
                                    <div class="valid-feedback">¡Se ve bien!</div>
                                    <div class="invalid-feedback">Proporciona un Documento válido.</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="txt_email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="txt_email" name="txt_email" value="<?php echo $objUsuario["email"]; ?>" placeholder="" />
                                    <div class="valid-feedback">¡Se ve bien!</div>
                                    <div class="invalid-feedback">Proporciona un email válido.</div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="txt_telefono">Telefono</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">CO (+57)</span>
                                        <input type="text" id="txt_telefono" name="txt_telefono" class="form-control" value="<?php echo $objUsuario["telefono"]; ?>" />
                                    </div>
                                    <div class="valid-feedback">¡Se ve bien!</div>
                                    <div class="invalid-feedback">Proporciona un telefono válido.</div>
                                </div>

                                <?php
                                    if ($_SESSION["tipoUsuario"] <= "9") {?>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="selectAccountDepartamentos">Departamento</label>
                                            <select id="selectAccountDepartamentos" name="selectAccountDepartamentos" class="select2 form-select">
                                                <option value="<?php echo $objUsuario["codi_depa"]; ?>"><?php echo $objUsuario["nomb_depa"]; ?></option>
                                            </select>
                                            <div class="valid-feedback">¡Se ve bien!</div>
                                            <div class="invalid-feedback">Proporciona un departamento válido.</div>
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="selectMunicipio">Ciudad</label>
                                            <select id="selectAccountMunicipios" class="select2 form-select">
                                                <option value="<?php echo $objUsuario["codi_muni"]; ?>"><?php echo $objUsuario["nomb_muni"]; ?></option>
                                            </select>
                                            <div class="valid-feedback">¡Se ve bien!</div>
                                            <div class="invalid-feedback">Proporciona una ciudad válida.</div>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="txt_direccion" class="form-label">Dirección</label>
                                            <input type="text" class="form-control" id="txt_direccion" name="txt_direccion" value="<?php echo $objUsuario["direccion"]; ?>" placeholder="Address" />
                                            <div class="valid-feedback">¡Se ve bien!</div>
                                            <div class="invalid-feedback">Proporciona una Dirección válida.</div>
                                        </div>


                                        <div class="mb-3 col-md-6 form-password-toggle">
                                            <label class="form-label" for="txt_password">Contraseña</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="txt_password" class="form-control" name="txt_password" value="<?php echo $objUsuario["password"]; ?>" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                                <div class="valid-feedback">¡Se ve bien!</div>
                                                <div class="invalid-feedback">Proporciona una Contraseña válida.</div>
                                            </div>
                                        </div>
                                        <?php
                                    }else{?>
                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="txt_NumeroFicha">Número Ficha</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text" class="form-control" id="txt_NumeroFicha"                                    
                                                value="<?php echo $objUsuario["numero_ficha"]; ?>" disabled required>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label class="form-label" for="txt_Carterizacion">Caracterización</label>
                                            <div class="input-group input-group-merge">
                                                <input type="text" class="form-control"  id="txt_Carterizacion"                                  
                                                value="<?php echo $objUsuario["caracterizacion"]; ?>" disabled required>
                                            </div>
                                        </div>

                                        <div class="mb-3 col-md-6 form-password-toggle">
                                            <label class="form-label" for="txt_password_aprendiz">Contraseña</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="txt_password" class="form-control" name="txt_password" value="<?php echo $objUsuario["password_aprendiz"]; ?>" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required />
                                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                                <div class="valid-feedback">¡Se ve bien!</div>
                                                <div class="invalid-feedback">Proporciona una Contraseña válida.</div>
                                            </div>
                                        </div>

                                        <?php
                                    }
                                ?>
                            </div>

                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Actualizar Datos</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->