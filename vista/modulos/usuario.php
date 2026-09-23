<!-- primer_inicio_usuario -->
<?php
    include_once "primer_inicio_usuario.php";
?>

<!-- Navbar -->
<div class="layout-page">
    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar">
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">

                    <p>
                        <h5 class="card-title text-primary">👋 Hola!&nbsp;&nbsp;</h5>
                        <h6 class="card-title"><?php echo $_SESSION["nombreUsuario"];?></h6>
                    </p>
                </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                    <!-- <a class="github-button"
                        href="https://github.com/themeselection/sneat-html-admin-template-free"
                        data-icon="octicon-star" data-size="large" data-show-count="true"
                        aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a> -->
                        <!-- <h6>Notificaciones <span class="badge bg-danger">6</span></h6> -->
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                        data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <?php 
                                $ruta_foto = "";
                                if ($_SESSION["foto"] != null){
                                    $ruta_foto = $_SESSION["foto"];
                                }else{
                                    $ruta_foto = "assets/img/interface/profile.png";
                                }
                            
                            ?>
                            <img id="imgUsuarioPerfil" src="<?php echo $ruta_foto;?>" tipo="<?php echo $_SESSION["tipoUsuario"] ?>" class="w-px-35 h-60 rounded-circle" />
                        </div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img id="imgUsuarioPerfil2" src="<?php echo $ruta_foto;?>" alt
                                                class="w-px-35 h-60 rounded-circle" />
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <span class="fw-semibold d-block"><?php echo $_SESSION["nombreUsuario"];?></span>
                                        <?php 
                                            if ($_SESSION["tipoUsuario"] == "1"){
                                                echo '<small class="text-muted">Instructor</small>';
                                            }elseif($_SESSION["tipoUsuario"] == "2"){
                                                echo '<small class="text-muted">Admin</small>';
                                            }elseif($_SESSION["tipoUsuario"] == "3"){
                                                echo '<small class="text-muted">Caprendizaje</small>';    
                                            }elseif($_SESSION["tipoUsuario"] == "4"){
                                                echo '<small class="text-muted">Admin Seguimientos</small>';
                                            }elseif($_SESSION["tipoUsuario"] == "5"){
                                                echo '<small class="text-muted">Admin Certificación</small>';
                                            }else if($_SESSION["tipoUsuario"] == "6"){
                                                echo '<small class="text-muted">Coordinación Académica</small>';
                                            }else if($_SESSION["tipoUsuario"] == "7"){
                                                echo '<small class="text-muted">Formato 165</small>';
                                            }else{
                                                echo '<small class="text-muted">Aprendiz</small>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <?php if($_SESSION["tipoUsuario"] != "11"){ ?>
                            <li>
                                <a class="dropdown-item" href="account">
                                    <i class="bx bx-user me-2"></i>
                                    <span class="align-middle">Mi Perfil</span>
                                </a>
                            </li>
                        <?php } ?>
                        <!-- <li>
                            <a class="dropdown-item" href="notifications">
                                <span class="d-flex align-items-center align-middle">
                                    <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                    <span class="flex-grow-1 align-middle">Notificaciones</span>
                                    <span
                                        class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                </span>
                            </a>
                        </li> -->
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="cerrarSesion">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Cerrar Sesión</span>
                            </a>
                        </li>
                    </ul>

                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>

    <!-- / Navbar -->