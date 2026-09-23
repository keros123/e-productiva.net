<script async defer src="assets/js/cl_novedad_visita.js"></script>
<script async defer src="vista/js/novedad_visita.js"></script>
<div class="modal fade" id="modalNovedades_visita" tabindex="-1" data-bs-backdrop="static"
    data-bs-keyboard="false" style="display: none;" aria-modal="true" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Novedades</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation selectEstadoReporte" novalidate id="form_novedades">
                    <label for="txt_novedad" class="form-label"></label>
                    <textarea name="txt_novedad" class="form-control" id="txt_novedad" cols="auto" rows="3" placeholder="Escriba su novedad" required></textarea>
                    <div class="invalid-feedback">Porfavor escriba su novedad</div>
                    <div class="valid-feedback">¡Se ve bien!</div>
                    <div class="mt-2 d-flex">
                        <button type="submit" class="btn btn-primary">Agregar novedad</button>
                        <button type="button" class="btn btn-danger mx-2" data-bs-dismiss="modal" aria-label="Close">omitir</button>
                    </div>
                </form>
                <?php include_once "indicador_tiempoEmail.php"; ?>
            </div>
            <div class="modal-footer">
                <span  class="text-muted fw-light text-center" id="mensaje_novedad"></span>
            </div>
        </div>
    </div>
</div>