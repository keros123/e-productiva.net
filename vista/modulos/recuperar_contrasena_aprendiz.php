<div class="mb-3">
    <h4 class="mb-2 formSolicitarCodAprendiz">Recuperacion de contraseña</h4>
    <p class="mb-4 formSolicitarCodAprendiz">Por favor indica el E-Mail de tu cuenta y tu numero de documeto para obtener tu codigo de verificación</p>
    <form id="formSolicitarCodAprendiz" class="needs-validated formSolicitarCodAprendiz" novalidate>
        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <label for="email_recuperar_contrasena_aprendiz" class="form-label">Email</label>
                <a href="javascript:void(0);" class="tengoCodVerificacion">
                    <small>Ya tengo codigo de verificación</small>
                </a>
            </div>
            <input type="email" class="form-control" id="email_recuperar_contrasena_aprendiz" name="email_recuperar_contrasena" placeholder="Ingresa tu email" autofocus required/>
            
            <div class="valid-feedback">¡Se ve bien!</div>
            <div class="invalid-feedback">Proporciona un email válido.</div>
        </div>
        <div class="mb-3">
            <label for="txt_documento_recuper_aprendiz" class="form-label">Documento</label>
            <input type="text" class="form-control" id="txt_documento_recuper_aprendiz" name="txt_documento_recuper_aprendiz" placeholder="Ingresa su numero de documento"  required/>
            <div class="valid-feedback">¡Se ve bien!</div>
            <div class="invalid-feedback">Proporciona un codigo de verificacion válido.</div>
        </div>
        <div class="d-flex gap-2 mt-2">
            <button type="button" class="btn btn-dark w-50" id="atrasRecuperacion_aprendiz">Regresar</button>
            <button type="submit" class="btn btn-primary w-50" id="btn-Recuperar-Contrasena">Solicitar</button>
        </div>
    </form>

    <h4 class="mb-2 formActualizarContrasena" style="display:none;">Actualización de Contraseña</h4>
    <p class="mb-4 formActualizarContrasena" style="display:none;">Por favor indica el codigo de verificación enviado a tu E-Mail</p>
    <form id="formActualizarContrasena_aprendiz" class="needs-validated formActualizarContrasena" style="display:none;" novalidate>
        <div class="mb-3">
            <label for="codigo_cambio_contrasena_aprendiz" class="form-label">Codigo Verificación</label>
            <input type="text" class="form-control" id="codigo_cambio_contrasena_aprendiz" name="codigo_cambio_contrasena" placeholder="Ingresa el codigo de verificación sin espacios"  required/>
            <div class="valid-feedback">¡Se ve bien!</div>
            <div class="invalid-feedback">Proporciona un codigo de verificacion válido.</div>
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="new_password_aprendiz">Nueva Contraseña</label>
            </div>
            <div class="input-group input-group-merge">
                <input type="password" id="new_password_aprendiz" class="form-control" name="new_password"  placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="new_password" required/>
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                <div class="valid-feedback">¡Se ve bien!</div>
                <div class="invalid-feedback">Proporciona una Contraseña válida.</div>
            </div>
        </div>
        <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="confirmar_new_password_aprendiz">Confirmar Nueva Contraseña</label>
            </div>
            <div class="input-group input-group-merge">
                <input type="password" id="confirmar_new_password_aprendiz" class="form-control" name="confirmar_new_password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="confirmar_new_password" required/>
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                <div class="valid-feedback">¡Se ve bien!</div>
                <div class="invalid-feedback">Proporciona una Contraseña válida.</div>
            </div>
        </div>
        <div class="d-flex gap-2 mt-2">
            <button type="button" class="btn btn-dark w-50" id="atrasActualizarContrasena">Regresar</button>
            <button type="submit" class="btn btn-primary w-50" id="btn-Actualizar-Contrasena">Actualizar</button>
        </div>
    </form>
</div>
