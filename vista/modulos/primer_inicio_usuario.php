<?php 
    if ($_SESSION["documento"] == $_SESSION["password"]) {
?> 

        <div class="modal fade show authentication-inner HB_modal_primer_inicio" id="modal_alerta_primer_inicio_usuario" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-modal="true" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                    <h3 class="modal-title w-100">Alerta Seguridad</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3 mt-3 HB_alertaSeguridad">
                                <form id="cambio_contrasena_primer_inicio" class="needs-validated" novalidate>
                                    <div class="mb-3 form-password-toggle">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="new_password_primer_inicio">Nueva Contraseña</label>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="new_password_primer_inicio" class="form-control" name="new_password_primer_inicio"  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="new_password" required/>
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                            <div class="valid-feedback">¡Se ve bien!</div>
                                            <div class="invalid-feedback">Proporciona una Contraseña válida.</div>
                                        </div>
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="confirmar_new_password_primer_inicio">Confirmar Nueva Contraseña</label>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="confirmar_new_password_primer_inicio" class="form-control" name="confirmar_new_password_primer_inicio" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="confirmar_new_password" required/>
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                            <div class="valid-feedback">¡Se ve bien!</div>
                                            <div class="invalid-feedback">Proporciona una Contraseña válida.</div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a class="dropdown-item btn btn-danger" href="cerrarSesion">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Cerrar</span>
                                        </a>
                                        <button type="submit" class="btn btn-primary d-grid mx-2" id="btn_contrasena_primer_inicio" tipoUsuario="<?php echo $_SESSION["tipoUsuario"]; ?>" idUsuario="<?php echo $_SESSION["id"]; ?>">Actualizar</button>
                                </div>
                            </form>
                            </div>
                            <div class="col-md-6 mb-3 mt-3 HB_alertaSeguridad" style="background-color: #a493fa; word-wrap: break-word;" id="mensajes_primer_inicio">
                                <p id="parrafo_primer_inicio" style="color: black; font-size: 14pt;">Bienvenido <?php echo $_SESSION["nombreUsuario"]; ?>,
                                    Por su seguridad, le solicitamos que actualice su contraseña. <br> Le sugerimos crear una contraseña fácil de recordar y de la cual solo usted tenga conocimiento. <br> Gracias por su cooperación.
                                </p>
                                <p id="parrafo_noCoincide_password" style="color: white; font-size: 16pt; display: none;">
                                    Por favor, asegúrate de que tu contraseña coincida con la confirmación. Esto nos ayudará a mantener tu cuenta segura. ¡Gracias!
                                </p>
                                <p id="parrafo_error" style="color: white; font-size: 16pt; display: none;">
                                    Lo sentimos, pero no podemos completar su solicitud en este momento. Por favor, inténtelo de nuevo más tarde.
                                </p>
                                <p id="parrafo_exito" style="color: black; font-size: 16pt; display: none;">
                                    Su contraseña ha sido actualizada correctamente.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    }
?>