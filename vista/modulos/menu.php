<?php
    $rutasPorDefecto = [
        1  => "inicioInstructor",
        2  => "inicio",
        3  => "empresas",
        4  => "inicio",
        5  => "inicioCertificacion",
        6  => "buscarAprendiz",
        7  => "inicio165",
        10 => "inicioAprendiz",
        11 => "inicioAprendizCertificado"
    ];
    $tipoUsuario = $_SESSION["tipoUsuario"] ?? 0;
    $_SESSION["rutaInicio"] = $rutasPorDefecto[$tipoUsuario] ?? "inicio";
?>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="inicio" class="app-brand-link d-flex align-items-center gap-2">
            <span class="app-brand-logo demo">
                <img src="assets/img/logo/sena.png" alt="Logo SENA" style="width: 45px; height: auto;">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2 mb-0 text-uppercase" style="font-size: 1.5rem; color: #566a7f; text-transform: uppercase !important;">
                SGDCIMM
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul id="menuOpciones" class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="<?php echo $_SESSION["rutaInicio"]; ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Inicio</div>
            </a>

            <?php
                include_once "vista/modulos/CL_menu.php";
                if (isset($_SESSION["tipoUsuario"])) {
                    if ($_SESSION["tipoUsuario"] == 1) {
                        MenuPerfiles::MenuInstructor();
                    } elseif ($_SESSION["tipoUsuario"] == 2) {
                        MenuPerfiles::MenuAdministrador();
                    } elseif ($_SESSION["tipoUsuario"] == 3) {
                        MenuPerfiles::MenuCaprendizaje();
                    } elseif ($_SESSION["tipoUsuario"] == 4) {
                        MenuPerfiles::MenuAdministradorSeguimientos();
                    } elseif ($_SESSION["tipoUsuario"] == 5) {
                        MenuPerfiles::MenuCertificacion();
                    } elseif ($_SESSION["tipoUsuario"] == 6) {
                        MenuPerfiles::MenuCordinacionAcademica();
                    } elseif ($_SESSION["tipoUsuario"] == 7) {
                        MenuPerfiles::MenuFormato165();
                    } elseif ($_SESSION["tipoUsuario"] == 11) {
                        // $ruta = "inicioAprendizCertificado";
                    } else{
                        MenuPerfiles::MenuAprendiz();
                    }
                }
            ?>
        </li>
    </ul>
</aside>