/**
 * Config
 * -------------------------------------------------------------------------------------
 * ! IMPORTANT: Make sure you clear the browser local storage In order to see the config changes in the template.
 * ! To clear local storage: (https://www.leadshook.com/help/how-to-clear-local-storage-in-google-chrome-browser/).
 */

"use strict";

// Base URL dinámica: funciona tanto en local (XAMPP) como en el hosting
const baseUrl = (function() {
    const scripts = document.getElementsByTagName('script');
    for (let i = 0; i < scripts.length; i++) {
        const src = scripts[i].src;
        const match = src.match(/(.*\/)(assets\/js\/config\.js)/i);
        if (match) return match[1];
    }
    // Fallback: raíz del origen actual
    return window.location.origin + '/';
})();

// JS global variables
let config = {
    colors: {
        primary: "#696cff",
        secondary: "#8592a3",
        success: "#71dd37",
        info: "#03c3ec",
        warning: "#ffab00",
        danger: "#ff3e1d",
        dark: "#233446",
        black: "#000",
        white: "#fff",
        body: "#f4f5fb",
        headingColor: "#566a7f",
        axisColor: "#a1acb8",
        borderColor: "#eceef1",
    },
    rutes: {
        controllerAprendicesPorCertificar: baseUrl + "control/aprendicesPorCertificarControl.php",
        controllerUsuarios:                baseUrl + "control/usuarioControl.php",
        controllerRUsuarios:               baseUrl + "control/rUsuarioControl.php",
        controllerActualizacionUsuarios:   baseUrl + "control/actualizacion_datos_usuarioControl.php",
        controllerAprendiz:                baseUrl + "control/aprendizControl.php",
        controllerFichas:                  baseUrl + "control/fichaControl.php",
        controllerFichasPorCertificar:     baseUrl + "control/fichaCertificacionControl.php",
        controllerAprendizCertificacion:   baseUrl + "control/aprendizCertificacionControl.php",
        controllerSeguimiento:             baseUrl + "control/seguimientoControl.php",
        controllerArchivos:                baseUrl + "control/archivoControl.php",
        controllerUbicacion:               baseUrl + "control/ubicacionControl.php",
        controllerEncriptar:               baseUrl + "control/encriptarControl.php",
        controllerRegistroMasivo:          baseUrl + "control/registroMasivoControl.php",
        controllerRegistroMasivoEtapaPractica: baseUrl + "control/registroMasivoEtapaPracticaControl.php",
        vistaFichaAprendiz:                baseUrl + "fichaAprendices",
        btnDesbloqueo:                     baseUrl + "assets/img/interface/desbloqueado.png",
        btnBloqueo:                        baseUrl + "assets/img/interface/bloqueado.png",
        btnEditarSeguimiento:              baseUrl + "assets/img/interface/configuration.png",
        btnDescargarArchivo:               baseUrl + "assets/img/interface/paper.png",
        btnEditar:                         baseUrl + "assets/img/interface/edit2.png",
        btnVerAprendices:                  baseUrl + "assets/img/interface/networking_432044.png",
        btnEliminar:                       baseUrl + "assets/img/interface/delete.png",
        btnAsignarFichas:                  baseUrl + "assets/img/interface/agregar2.png",
        btnReasignarInstructor:            baseUrl + "assets/img/interface/edicion.png",
        btnAsignarRedTecnologica:          baseUrl + "assets/img/interface/agregar2.png",
        btnAsignarEmpresa:                 baseUrl + "assets/img/interface/block.png",
        btnAsignar:                        baseUrl + "assets/img/interface/block.png",
        btnDesasignarFichas:               baseUrl + "assets/img/interface/desvincularFicha.png",
        btnVisualizar:                     baseUrl + "assets/img/interface/view_5598149.png",
        controllerFuncionarios:            baseUrl + "control/funcionarioControl.php",
        controllerAsignacionFichas:        baseUrl + "control/asignacionFichasControl.php",
        controllerFichasInstructor:        baseUrl + "control/fichasInstructorControl.php",
        controllerBitacoras:               baseUrl + "control/bitacorasControl.php",
        controllerEmpresa:                 baseUrl + "control/empresaControl.php",
        controllerAsignacionSeguimiento:   baseUrl + "control/asignacionSeguimientosControl.php",
        controllerLineaRedTecnologica:     baseUrl + "control/linea_red_TecnologicaControl.php",
        controllerDetalleUsuario:          baseUrl + "control/detalleUsuarioControl.php",
        controllerHistorial:               baseUrl + "control/historialControl.php",
        controllerSeguimientosAsignados:   baseUrl + "control/controlSeguimientosAsignados.php",
        controllerSeguimientoAprendiz:     baseUrl + "control/seguimientoAprendizControl.php",
        btnSubirReporte:                   baseUrl + "assets/img/interface/subirReporte.png",
        btnNovedad:                        baseUrl + "assets/img/interface/novedad.png",
        btnUserInfo:                       baseUrl + "assets/img/interface/btn_user.png",
        controllerSeguimientosPorTipo:     baseUrl + "control/seguimientosPorTipoControl.php",
        controllerEnviarSeguimientos:      baseUrl + "control/enviarSeguimientosControl.php",
        controllerGraficas:                baseUrl + "control/graficasControlador.php",
        controllerCertificacion:           baseUrl + "control/certificacionControl.php",
        controllerRadicacion:              baseUrl + "control/radicacionControl.php",
        controllerGenerarPdfCertificacion: baseUrl + "control/generarPdfCertificacionControl.php",
        controllerBuscarAprendiz:          baseUrl + "control/buscarAprendizControl.php",
        controllerCertificarAprendiz:      baseUrl + "control/certificarAprendizControl.php",
        controllerAprendicesCertificados:  baseUrl + "control/aprendicesCertificadosControl.php",
        controllerInformes:                baseUrl + "control/informesControl.php",
        controllerArchivoAprendiz:         baseUrl + "control/archivosAprendizControl.php"
    },
};