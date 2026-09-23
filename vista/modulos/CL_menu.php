<?php

class MenuPerfiles{

    public static function MenuInstructor(){
        // Menu para Perfil 1 = Instructor
        // item Cuenta
        echo '<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings">Perfil</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="account" class="menu-link">
                            <div data-i18n="Account">Cuenta</div>
                        </a>
                    </li>
                </ul>
            </li>';

        // Items Panel Instructor
        // <li class="menu-item"> se deshabilito del menu pero sigue existiendo
        //     <a href="fichasInstructor" class="menu-link">
        //         <i class="menu-icon tf-icons bx  bx-extension"></i> 
        //         <div data-i18n="Analytics">Fichas Asignadas</div>
        //     </a>
        // </li>
        // faltaba optivizar la visualizacion de los datos del aprendiz en tabla aprendices

        echo'<li class="menu-header small text-uppercase">
                <span class="menu-header-text">LMS</span>
            </li>

            <li class="menu-item">
                <a href="seguimientosProgramados" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Analytics">Seguimientos Programados</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="buscarAprendiz" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-search-alt"></i>
                    <div data-i18n="Analytics">Buscar aprendiz</div>
                </a>
            </li>';
    }

    public static function MenuAdministrador(){
        // Menu para perfil 2 = Administrativo (Super Admin)
        // item Cuenta
        echo '<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Account Settings">Perfil</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="account" class="menu-link">
                            <div data-i18n="Account">Cuenta</div>
                        </a>
                    </li>
                </ul>
            </li>';

 
        // Items Panel Administrativo
        echo '<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx  bx-cog"></i> 
                    <div data-i18n="Account Settings">Panel Administrativo</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="lineaTecnologica" class="menu-link">
                            <i class="menu-icon tf-icons bx  bx-pulse"></i>
                            <div data-i18n="Analytics">Línea Tecnológica</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="fichas" class="menu-link">
                            <i class="menu-icon tf-icons bx  bx-extension"></i> 
                            <div data-i18n="Analytics">Fichas</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="buscarAprendiz" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-search-alt"></i>
                            <div data-i18n="Analytics">Buscar aprendiz</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="funcionarios" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Analytics">Funcionarios</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="empresas" class="menu-link">
                            <i class="menu-icon bx bx-buildings me-1"></i>
                            <div data-i18n="Analytics">Empresas</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="seguimientos" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-file"></i>
                            <div data-i18n="Analytics">Etapa Práctica</div>
                        </a>
                    </li>
                </ul>
            </li>';


            // Items Seguimientos
            echo '<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings">Seguimientos</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="asignarSeguimiento" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-link-external"></i>
                            <div data-i18n="Analytics"> Asignar</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="seguimientosParciales" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-pie-chart-alt"></i>
                            <div data-i18n="Analytics">Parciales</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="seguimientosFinales" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-chart"></i>
                            <div data-i18n="Analytics">Finales</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="seguimientosNuevoFormato" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-file"></i>
                            <div data-i18n="Analytics">GFPI-F-023</div>
                        </a>
                    </li>
                </ul>
            </li>';


            // Items Informes
            echo '<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx  bx-clipboard"></i>
                    <div data-i18n="Account Settings">Informes Seguimientos</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="informeVencidos" class="menu-link">
                            <i class="menu-icon tf-icons bx  bx-block"></i>
                            <div data-i18n="Analytics">Vencidos</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="informeCompleto" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-task"></i> 
                            <div data-i18n="Analytics">Consolidado</div>
                        </a>
                    </li>
                </ul>
            </li>';


        // Items Historial
        echo '<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-history"></i>
                    <div data-i18n="Account Settings">Historial</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="historialAprendices" class="menu-link">
                            <i class="menu-icon bx  bx-user-circle"></i> 
                            <div data-i18n="Analytics">Aprendiz</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="historialFuncionarios" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Analytics">Funcionario</div>
                        </a>
                    </li>


                    <li class="menu-item">
                        <a href="historialFichas" class="menu-link">
                            <i class="menu-icon tf-icons bx  bx-extension"></i>
                            <div data-i18n="Analytics">Fichas</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="historialLineaRedTecnologica" class="menu-link">
                            <i class="menu-icon tf-icons bx  bx-pulse"></i>
                            <div data-i18n="Analytics">Línea Tecnólogica</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="historialEmpresas" class="menu-link">
                            <i class="menu-icon bx bx-buildings me-1"></i>
                            <div data-i18n="Analytics">Empresas</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="historialSeguimientos" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-file"></i>
                            <div data-i18n="Analytics">Etapa Práctica</div>
                        </a>
                    </li>
                </ul>
            </li>';

    }

    public static function MenuCaprendizaje(){
        // Menu para perfil 3 = Caprendizaje
        // item Cuenta
        echo '<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings">Perfil</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="account" class="menu-link">
                            <div data-i18n="Account">Cuenta</div>
                        </a>
                    </li>
                </ul>
            </li>';


        // Items Panel Caprendizaje
        echo'<li class="menu-header small text-uppercase">
                <span class="menu-header-text">Panel Administrativo</span>
            </li>

            <li class="menu-item">
                <a href="empresas" class="menu-link">
                    <i class="menu-icon bx bx-buildings me-1"></i>
                    <div data-i18n="Analytics">Empresas</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="seguimientos" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Analytics">Etapa Practica</div>
                </a>
            </li>';
    }
    public static function MenuAdministradorSeguimientos(){
        // Menu para perfil 4 = Administrador de seguimientos
        // item Cuenta
        echo '<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Account Settings">Perfil</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="account" class="menu-link">
                            <div data-i18n="Account">Cuenta</div>
                        </a>
                    </li>
                </ul>
            </li>';

 
        // Items Panel Administrativo
        echo '<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx  bx-cog"></i> 
                    <div data-i18n="Account Settings">Panel Administrativo</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="lineaTecnologica" class="menu-link">
                            <i class="menu-icon tf-icons bx  bx-pulse"></i>
                            <div data-i18n="Analytics">Línea Tecnológica</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="fichas" class="menu-link">
                            <i class="menu-icon tf-icons bx  bx-extension"></i> 
                            <div data-i18n="Analytics">Fichas</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="buscarAprendiz" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-search-alt"></i>
                            <div data-i18n="Analytics">Buscar aprendiz</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="funcionarios" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-user"></i>
                            <div data-i18n="Analytics">Funcionarios</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="empresas" class="menu-link">
                            <i class="menu-icon bx bx-buildings me-1"></i>
                            <div data-i18n="Analytics">Empresas</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="seguimientos" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-file"></i>
                            <div data-i18n="Analytics">Etapa Práctica</div>
                        </a>
                    </li>
                </ul>
            </li>';


            // Items Seguimientos
            echo '<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings">Seguimientos</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="asignarSeguimiento" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-link-external"></i>
                            <div data-i18n="Analytics"> Asignar</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="seguimientosParciales" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-pie-chart-alt"></i>
                            <div data-i18n="Analytics">Parciales</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="seguimientosFinales" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-chart"></i>
                            <div data-i18n="Analytics">Finales</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="seguimientosNuevoFormato" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-file"></i>
                            <div data-i18n="Analytics">GFPI-F-023</div>
                        </a>
                    </li>
                </ul>
            </li>';


            // Items Informes
            echo '<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx  bx-clipboard"></i>
                    <div data-i18n="Account Settings">Informes Seguimientos</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="informeVencidos" class="menu-link">
                            <i class="menu-icon tf-icons bx  bx-block"></i>
                            <div data-i18n="Analytics">Vencidos</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="informeCompleto" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-task"></i> 
                            <div data-i18n="Analytics">Consolidado</div>
                        </a>
                    </li>
                </ul>
            </li>';
    }

    public static function MenuCertificacion(){
        // Menu para perfil 5 = Certificacion
        // item Cuenta
        echo '<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings">Perfil</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="account" class="menu-link">
                            <div data-i18n="Account">Cuenta</div>
                        </a>
                    </li>
                </ul>
            </li>';


            echo '<li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Seguimientos</span>
                </li>';

            echo '<li class="menu-item">
                    <a href="buscarAprendiz" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-search-alt"></i>
                        <div data-i18n="Analytics">Buscar aprendiz</div>
                    </a>
                </li>';



            echo '<li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon bi bi-card-checklist"></i>
                        <div data-i18n="Account Settings">Seguimientos</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="funcionarios" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-user"></i>
                                <div data-i18n="Analytics">Funcionarios</div>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="seguimientosParciales" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-pie-chart-alt"></i>
                                <div data-i18n="Analytics">Parciales</div>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="seguimientosFinales" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-chart"></i>
                                <div data-i18n="Analytics">Finales</div>
                            </a>
                        </li>

                        <li class="menu-item">
                            <a href="seguimientosNuevoFormato" class="menu-link">
                                <i class="menu-icon tf-icons bx bx-file"></i>
                                <div data-i18n="Analytics">GFPI-F-023</div>
                            </a>
                        </li>
                    </ul>
                </li>';


            echo '<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx  bx-clipboard"></i>
                    <div data-i18n="Account Settings">Informes</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="informeVencidos" class="menu-link">
                            <i class="menu-icon tf-icons bx  bx-block"></i>
                            <div data-i18n="Analytics">Vencidos</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="informeCompleto" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-task"></i> 
                            <div data-i18n="Analytics">Consolidado</div>
                        </a>
                    </li>
                </ul>
            </li>';


            // Items Panel Certificacion
            // <li class="menu-item">  Nota se retiro de certificacion por creacion de nuevo modulo Aprendices Por Certificar
            //         <a href="fichaCertificacion" class="menu-link">
            //             <i class="menu-icon tf-icons bx  bx-extension"></i> 
            //             <div data-i18n="Analytics">Fichas Por Certificar</div>
            //         </a>
            //     </li>

            echo'
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Certificación</span>
                </li>

                <li class="menu-item">
                    <a href="aprendicesPorCertificar" class="menu-link">
                        <i class="menu-icon bi bi-person-exclamation"></i>
                        <div data-i18n="Analytics">Aprendices Por Certificar</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a href="aprendicesCertificados" class="menu-link">
                        <i class="menu-icon bi bi-person-rolodex"></i>
                        <div data-i18n="Analytics">Aprendices Certificados</div>
                    </a>
                </li>';
    }


    public static function MenuCordinacionAcademica(){
        // Menu para perfil 6 = Coordinacion Academica
        // item Cuenta
        echo '<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings">Perfil</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="account" class="menu-link">
                            <div data-i18n="Account">Cuenta</div>
                        </a>
                    </li>
                </ul>
            </li>';

        // Items Panel Coordinacion Academica
        echo'<li class="menu-header small text-uppercase">
                <span class="menu-header-text">Panel Administrativo</span>
            </li>

            <li class="menu-item">
                <a href="buscarAprendiz" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-search-alt"></i>
                    <div data-i18n="Analytics">Buscar aprendiz</div>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="fichas" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-box"></i>
                    <div data-i18n="Analytics">Fichas</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="funcionarios" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-user"></i>
                    <div data-i18n="Analytics">Funcionarios</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="aprendicesCertificados" class="menu-link">
                    <i class="menu-icon tf-icons bx bxs-user-rectangle"></i>
                    <div data-i18n="Analytics">Aprendices Certificados</div>
                </a>
            </li>

            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Informes</span>
            </li>

            <li class="menu-item">
                <a href="informeVencidos" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Analytics">Seguimientos Vencidos</div>
                </a>
            </li>
            <li class="menu-item">
                <a href="informeCompleto" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-task"></i>
                    <div data-i18n="Analytics">Consolidado Seguimientos</div>
                </a>
            </li>';
    }


    public static function MenuAprendiz(){
        // Menu para perfil Aprendiz 
        // item Cuenta
        echo'<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings">Perfil</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="account" class="menu-link">
                            <div data-i18n="Account">Cuenta</div>
                        </a>
                    </li>
                </ul>
            </li>';

        // Items Panel aprendiz
        echo'<li class="menu-header small text-uppercase">
                <span class="menu-header-text">Panel Aprendiz</span>
            </li>
            <li class="menu-item">
                <a href="seguimientosAsignados" class="menu-link">
                    <i class="menu-icon tf-icons bi bi-check-all"></i>
                    <div data-i18n="Analytics">Seguimientos asignados</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="bitacoras" class="menu-link">
                    <i class="menu-icon tf-icons bi bi-clipboard-data"></i>
                    <div data-i18n="Analytics">Bitácoras</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="certificacion" class="menu-link">
                    <i class="menu-icon tf-icons bi bi-person-fill-gear"></i>
                    <div data-i18n="Analytics">Certificación</div>
                </a>
            </li>
            
            <li class="menu-item">
                <a href="archivoAprendiz" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-file"></i>
                    <div data-i18n="Analytics">GFPI-F-165</div>
                </a>
            </li>';
    }


    public static function MenuFormato165(){
        echo'<li class="menu-item">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-dock-top"></i>
                    <div data-i18n="Account Settings">Perfil</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item">
                        <a href="account" class="menu-link">
                            <div data-i18n="Account">Cuenta</div>
                        </a>
                    </li>
                </ul>
            </li>';

        echo '<li class="menu-header small text-uppercase">
                <span class="menu-header-text">Panel Administrativo</span>
            </li>';

        echo'<li class="menu-item">
                <a href="buscarAprendiz" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-search-alt"></i>
                    <div data-i18n="Analytics">Buscar aprendiz</div>
                </a>
            </li>';

        echo'<li class="menu-item">
                <a href="fichas" class="menu-link">
                    <i class="menu-icon tf-icons bx bx-box"></i>
                    <div data-i18n="Analytics">Fichas</div>
                </a>
            </li>';

    }

}