<script async defer src="assets/js/cl_historial.js"></script>
<script async defer src="vista/js/historial.js"></script>
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Historial /</span> Historial Aprendices
    </h4>

    <div class="row">
        <div class="col-md-12">
            <div class="card" id="historial" tipo="procesos_aprendices">
                <?php include_once "tabla_historial.php"; ?>
            </div>
        </div>
    </div>
</div>