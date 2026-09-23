<div class="modal fade" id="modalSubirReporte" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subir Reporte Seguimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <form id="form-reporteSeguimiento"
                    class="row g-3 needs-validation"
                    novalidate
                    enctype="multipart/form-data">

                    <!-- Archivo: Reporte de Seguimiento -->
                    <div class="col-12">
                        <label for="fileReporteSeguimiento" class="form-label">
                            Reporte de Seguimiento
                        </label>
                        <input
                            type="file"
                            class="form-control"
                            id="txt_subirReporteSeguimiento"
                            name="reporte_seguimiento"
                            accept=".pdf,.xls,.xlsx"
                            required
                        >
                        <div class="form-text">
                            Archivos permitidos: PDF, XLS, XLSX
                        </div>
                        <div class="invalid-feedback">
                            Debe adjuntar el reporte de seguimiento.
                        </div>
                    </div>

                    <!-- Archivo: Evidencia de Evaluación (Imagen) -->
                    <!-- Contenedor dinámico -->
                    <div id="contenedorJuicioEvaluativo" class="col-12"></div>

                    <!-- Botón -->
                    <div class="col-12">
                        <button id="btn_SubirArchivoSeguimiento"  type="submit"  class="btn btn-primary w-100">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalFechaNoValida" tabindex="-1" aria-labelledby="modalFechaNoValidaLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-primary">
                <h5  id="tituloModalAdvertencia" class="modal-title text-white" id="modalFechaNoValidaLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body">
                <p>
                    La <strong>etapa práctica del aprendiz aún no ha finalizado</strong>, por lo tanto,
                    en este momento no es posible realizar la carga del seguimiento.
                </p>

                <p>
                    Una vez se cumpla la fecha de finalización de la etapa práctica,
                    podrá realizar el proceso de cargue teniendo en cuenta que deberá adjuntar:
                </p>

                <ul>
                    <li>
                        📸 <strong>Pantallazo como evidencia</strong> de haber calificado el
                        <strong>resultado de aprendizaje</strong> correspondiente a la etapa práctica.
                    </li>
                    <li>
                        📄 <strong>Seguimiento debidamente diligenciado</strong>, conforme a los lineamientos establecidos.
                    </li>
                </ul>

                <p class="mb-0">
                    Agradecemos realizar el cargue únicamente cuando se haya cumplido la fecha establecida.
                </p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Entendido
                </button>
            </div>

        </div>
    </div>
</div>




