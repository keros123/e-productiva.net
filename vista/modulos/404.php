<?php 
        $ruta = "";
        if ($_SESSION["tipoUsuario"] == 1) {
            $ruta = "inicioInstructor";
        } elseif ($_SESSION["tipoUsuario"] == 2) {
            $ruta = "inicio";
        } elseif ($_SESSION["tipoUsuario"] == 3) {
            $ruta = "empresas";
        } elseif ($_SESSION["tipoUsuario"] == 4) {
            $ruta = "inicio";
        } else if ($_SESSION["tipoUsuario"] == 10) {
            $ruta = "inicioAprendiz";
        } 
?>
<div class="container-xxl container-p-y">
    <div class="misc-wrapper">
        <h2 class="mb-2 mx-2">Página no encontrada :(</h2>
        <p class="mb-4 mx-2">Oops! 😖 La URL solicitada no se encontró en este servidor.</p>
        <a href=" <?php echo $ruta; ?>" class="btn btn-primary">Regresar al Inicio</a>
        <div class="mt-3">
            <img src="assets/img/illustrations/page-misc-error-light.png" alt="page-misc-error-light" width="500" class="img-fluid" data-app-dark-img="illustrations/page-misc-error-dark.png" data-app-light-img="illustrations/page-misc-error-light.png" />
        </div>
    </div>
</div>