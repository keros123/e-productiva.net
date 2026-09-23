<style>
    /* Estilos base y tipografía */
    body {
        margin: 0;
        font-family: 'Inter', 'Segoe UI', sans-serif;
    }

    /* Imagen de fondo local */
    .login-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        background-image: url('assets/img/interface/DSC_0409.jpg');
        background-size: cover;
        background-position: center;
        z-index: -2;
    }
    
    /* Overlay con difuminado en degradado desde arriba izquierda hacia abajo derecha */
    .login-blur-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        /* El color blanco también será más fuerte arriba a la izquierda y desaparecerá hacia abajo */
        background: linear-gradient(to bottom right, rgba(255, 255, 255, 0.6) 0%, transparent 100%);
        /* Aplicamos un difuminado fuerte... */
        backdrop-filter: blur(1px);
        -webkit-backdrop-filter: blur(1px);
        /* ...pero esta máscara hace que el difuminado se vaya perdiendo gradualmente hacia la derecha inferior */
        mask-image: linear-gradient(to bottom right, black 10%, transparent 90%);
        -webkit-mask-image: linear-gradient(to bottom right, black 10%, transparent 90%);
        z-index: -1;
    }

    /* Contenedor Flex para centrar la tarjeta de forma absoluta */
    .container-xxl {
        display: flex !important;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 0;
    }
    
    .authentication-wrapper {
        width: 100%;
        max-width: 480px; 
        padding: 20px;
        margin: 0 auto;
    }

    /* Diseño Glassmorphism de la tarjeta principal */
    .authentication-inner .card {
        background: rgba(255, 255, 255, 0.65) !important;
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        box-shadow: 0 10px 40px 0 rgba(31, 38, 135, 0.15) !important;
        border: 1px solid rgba(255, 255, 255, 0.8) !important;
        border-radius: 24px;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .authentication-inner .card:hover {
        /* transform: translateY(-5px); */
        box-shadow: 0 15px 50px 0 rgba(31, 38, 135, 0.2) !important;
    }

    /* Espaciado interno de la tarjeta */
    .cLogin, .cRecuperacion, .cRecuperacion_aprendiz {
        background: transparent !important;
        padding: 45px 40px !important;
    }

    /* Tipografía y textos sobre el fondo claro */
    .cLogin h4 {
        font-weight: 800;
        color: #222;
        letter-spacing: -0.5px;
        font-size: 1.7rem;
    }
    
    .cLogin p {
        color: #555;
        font-size: 1rem;
        margin-bottom: 2rem !important;
    }
    
    /* Inputs modernos y minimalistas */
    .form-control, .input-group-text, .form-select {
        background: rgba(255, 255, 255, 0.7) !important;
        border: 1px solid rgba(255, 255, 255, 0.6) !important;
        border-radius: 12px;
        color: #333 !important;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
        transition: all 0.3s ease;
        padding: 10px 15px;
    }

    .form-control:focus, .form-select:focus {
        background: #fff !important;
        border-color: #696cff !important;
        box-shadow: 0 0 0 0.25rem rgba(105, 108, 255, 0.1) !important;
    }

    .input-group-text {
        border-left: none !important;
    }
    
    .form-control::placeholder {
        color: #999 !important;
    }
    
    .form-label {
        font-weight: 700;
        color: #444;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }

    /* Botón de inicio de sesión vibrante */
    .btn-primary {
        background: linear-gradient(135deg, #696cff 0%, #5254cf 100%) !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 10px !important;
        font-weight: 700 !important;
        font-size: 1 rem !important;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(105, 108, 255, 0.4) !important;
        transition: all 0.3s ease;
        margin-top: 10px;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(105, 108, 255, 0.5) !important;
    }

    /* Botón oscuro (Regresar) */
    .btn-dark {
        background: #3b3f45 !important;
        border: none !important;
        border-radius: 12px !important;
        padding: 10px !important;
        font-weight: 700 !important;
        font-size: 1 rem !important;
        letter-spacing: 0.5px;
        color: white !important;
        box-shadow: 0 4px 15px rgba(59, 63, 69, 0.4) !important;
        transition: all 0.3s ease;
        margin-top: 10px;
    }

    .btn-dark:hover {
        background: #2a2d32 !important;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 63, 69, 0.5) !important;
    }
    
    /* Enlaces y textos pequeños */
    a, .rContrasena, .RecuperarContrasenaAprendiz {
        color: #696cff;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s;
    }
    
    a:hover {
        color: #5254cf;
    }

    .text-center span {
        color: #666;
        font-size: 0.85rem;
        cursor: pointer;
    }
    
    /* Toggle switch Funcionario/Aprendiz */
    .form-check-input {
        width: 3em !important;
        height: 1.5em !important;
        cursor: pointer;
    }
    .form-check-input:checked {
        background-color: #696cff;
        border-color: #696cff;
    }
    .form-check-label h6 {
        margin-left: 10px;
        margin-top: 3px;
        font-weight: 700;
        color: #444;
    }
</style>

<!-- Elementos de fondo -->
<div class="login-background"></div>
<div class="login-blur-overlay"></div>

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body cLogin">
                    <?php 
                        // include_once "arturito.php";
                    ?>

                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="inicio" class="app-brand-link gap-2">
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Bienvenido a SGD! 👋</h4>
                    <p class="mb-4">Por favor inicia sesión en tu cuenta</p>

                    <div class="form-check form-switch">
                        <input class="form-check-input micheckbox" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        <label class="form-check-label micheckboxlabel" for="flexSwitchCheckDefault"><h6>Funcionario</h6></label>
                    </div>

                    <form id="formAuthenticationFuncionario" class="mb-3 needs-validation funcionario" novalidate>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email-username" placeholder="Ingresa tu email" autofocus required/>
                            <div class="valid-feedback">¡Se ve bien!</div>
                            <div class="invalid-feedback">Proporciona un email válido.</div>
                        </div>
                        
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Contraseña</label>
                                <a href="javascript:void(0);" class="rContrasena">
                                    <small>¿Olvidaste tu Contraseña?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required/>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona una Contraseña válida.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Iniciar Sesión</button>
                        </div>
                    </form>


                    <form id="formAuthenticationAprendiz" class="mb-3 aprendiz needs-validation" style="display:none;" novalidate>
                        <div class="mb-3">
                            <?php include_once "selectDocumentos.php"; ?>
                        </div>

                        <div class="mb-3">
                            <label for="documento" class="form-label">Documento</label>
                            <input type="text" class="form-control" id="documento" name="email-username" placeholder="Documento de Identidad" required/>
                            <div class="valid-feedback">¡Se ve bien!</div>
                            <div class="invalid-feedback">Proporciona un Documento válido.</div>
                        </div>

                        
                        <div class="mb-3">
                            <label for="ficha" class="form-label">Ficha</label>
                            <input type="text" class="form-control" id="ficha" name="email-username"
                                placeholder="Ficha No." required/>
                            <div class="valid-feedback">¡Se ve bien!</div>
                            <div class="invalid-feedback">Proporciona una Ficha válida.</div>    
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="passwordAprendiz">Contraseña</label>
                                <a href="javascript:void(0);" class="RecuperarContrasenaAprendiz">
                                    <small>¿Olvidaste tu Contraseña?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="passwordAprendiz" class="form-control" name="passwordAprendiz" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" required/>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                <div class="valid-feedback">¡Se ve bien!</div>
                                <div class="invalid-feedback">Proporciona una Contraseña válida.</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Iniciar Sesión</button>
                        </div>
                    </form>

                    <p class="text-center">
                    <span data-bs-toggle="tooltip" data-bs-placement="right"  data-bs-html="true" title="<h4>Protecci&oacute;n de datos personales</h4><br><p align='left'>Los datos aqu&iacute; consignados son estrictamente confidenciales seg&uacute;n trata en la Ley 1581 de 2012 y el Decreto 1377 de 2013, y solo ser&aacute;n utilizados con fines de gesti&oacute;n y control de los diferentes procesos administrativos y educativos del Servicio Nacional de Aprendizaje SENA.</p>">Pol&iacute;tica de protecci&oacute;n de datos personales.</span>
                    </p>
                </div>
                <div class="card-body cRecuperacion" style="display:none;">
                    <?php 
                        include_once "recuperar_contrasena_funcionario.php";
                    ?>
                    <p class="text-center">
                    <span data-bs-toggle="tooltip" data-bs-placement="right"  data-bs-html="true" title="<h4>Protecci&oacute;n de datos personales</h4><br><p align='left'>Los datos aqu&iacute; consignados son estrictamente confidenciales seg&uacute;n trata en la Ley 1581 de 2012 y el Decreto 1377 de 2013, y solo ser&aacute;n utilizados con fines de gesti&oacute;n y control de los diferentes procesos administrativos y educativos del Servicio Nacional de Aprendizaje SENA.</p>">Pol&iacute;tica de protecci&oacute;n de datos personales.</span>
                    </p>
                </div> 

                <div class="card-body cRecuperacion_aprendiz" style="display:none;">
                    <?php 
                        include "recuperar_contrasena_aprendiz.php";
                    ?>
                    <p class="text-center">
                    <span data-bs-toggle="tooltip" data-bs-placement="right"  data-bs-html="true" title="<h4>Protecci&oacute;n de datos personales</h4><br><p align='left'>Los datos aqu&iacute; consignados son estrictamente confidenciales seg&uacute;n trata en la Ley 1581 de 2012 y el Decreto 1377 de 2013, y solo ser&aacute;n utilizados con fines de gesti&oacute;n y control de los diferentes procesos administrativos y educativos del Servicio Nacional de Aprendizaje SENA.</p>">Pol&iacute;tica de protecci&oacute;n de datos personales.</span>
                    </p>
                </div> 
                <?php
                    include_once "indicador_tiempo.php";
                ?>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>