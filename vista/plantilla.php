<?php

session_start();

include_once "vista/modulos/cabecera.php";

if (isset($_SESSION["usuario"])) {
   
    include_once "vista/modulos/menu.php";

    include_once "vista/modulos/usuario.php";

    $tipoUsuario = $_SESSION["tipoUsuario"];

    // Definir rutas permitidas según tipo de usuario
    $rutasPermitidas = [
        1 => ["inicioInstructor", "account", "fichasInstructor", "buscarAprendiz", "cerrarSesion", "seguimientosProgramados"],
        2 => ["inicio", "account", "instructores", "aprendices", "descarga", "empresas", "fichas", "seguimientos", "funcionarios", "fichaAprendices", "solicitud", "cerrarSesion", "lineaTecnologica", "notifications", "historialAprendices", "historialFuncionarios", "historialFichas", "historialEmpresas", "historialSeguimientos", "asignarSeguimiento", "seguimientosParciales", "buscarAprendiz", "seguimientosFinales", "seguimientosNuevoFormato", "informeVencidos","informeCompleto","historialLineaRedTecnologica"],
        3 => ["account", "cerrarSesion", "empresas", "seguimientos"],
        4 => ["inicio", "account", "instructores", "aprendices", "empresas", "fichas", "seguimientos", "funcionarios", "fichaAprendices", "solicitud", "cerrarSesion", "lineaTecnologica", "notifications", "asignarSeguimiento", "seguimientosParciales", "seguimientosNuevoFormato", "informeVencidos", "buscarAprendiz", "seguimientosFinales","informeCompleto"],
        5 => ["inicioCertificacion", "account","funcionarios","seguimientosParciales","seguimientosFinales", "seguimientosNuevoFormato", "informeVencidos","informeCompleto", "fichaCertificacion", "cerrarSesion", "buscarAprendiz", "aprendicesCertificados","aprendicesPorCertificar"],
        6 => ["buscarAprendiz", "informeVencidos","informeCompleto", "account", "fichas", "cerrarSesion", "fichaAprendices", "aprendicesCertificados", "funcionarios"],
        7 => ["inicio165","account", "fichas", "cerrarSesion", "buscarAprendiz", "fichaAprendices"],
        10 => ["inicioAprendiz", "account", "bitacoras", "seguimientosAsignados", "certificacion", "cerrarSesion", "notifications","archivoAprendiz"],
        11 => ["inicioAprendizCertificado", "cerrarSesion"]
    ];

    // Ruta por defecto para cada tipo de usuario
    $rutasPorDefecto = [
        1 => "inicioInstructor",
        2 => "inicio",
        3 => "empresas",
        4 => "inicio",
        5 => "inicioCertificacion",
        6 => "buscarAprendiz",
        7 => "inicio165",
        10 => "inicioAprendiz",
        11 => "inicioAprendizCertificado"
    ];

    // Si ruta no ha sido asignada, selecciona la rutra por defecto para cada tipo de usuario
    $ruta = $_GET["ruta"] ?? $rutasPorDefecto[$tipoUsuario];

    if (in_array($ruta, $rutasPermitidas[$tipoUsuario])) {
        include_once "vista/modulos/$ruta.php";
    } else {
        include_once "vista/modulos/404.php";
    }

    include_once "vista/modulos/footer.php";
} else {
    include_once "vista/modulos/login.php";
}

include_once "vista/modulos/pie.php";