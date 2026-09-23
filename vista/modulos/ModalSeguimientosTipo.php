<!-- Modal -->
<div class="modal fade" id="ModalEditarTipo" tabindex="-1" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h1 class="modal-title fs-5" id="exampleModalLabel">Editar Tipo Seguimiento</h1> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="container mt-12">

                    <label for="selectVisitaSeguimiento" class="form-label">Modalidad de Visita Seguimiento</label>
                    <select id="selectVisitaSeguimiento" class="form-select mb-2" aria-label="Default select example">

                    </select>


                    <label for="selectTipoSeguimiento" class="form-label">Tipo Seguimiento</label>
                    <select id="selectTipoSeguimiento" class="form-select" aria-label="Default select example">

                    </select>

                    <div class="alert alert-secondary d-flex align-items-center mt-4" role="alert">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-exclamation-triangle-fill me-2" viewBox="0 0 16 16">
                            <path d="M7.938 2.016a.5.5 0 0 1 .933 0l6.857 11.945a.5.5 0 0 1-.433.75H1.705a.5.5 0 0 1-.432-.75L7.938 2.016zM8 5c-.535 0-.954.462-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507c.054-.533-.365-.995-.9-.995zM8 12a.905.905 0 1 0 0 1.81.905.905 0 0 0 0-1.81z" />
                        </svg>
                        <div>
                            <p class="mb-2">¿Está seguro de que desea cambiar la etapa del seguimiento?</p>
                            <p class="small mb-2">Al hacerlo, el seguimiento se moverá automáticamente a la sección correspondiente.</p>

                            <div class="mt-2">
                                <button id="btn_CambiarTipoSeguimiento" class="btn btn-primary btn-md">Sí, cambiar</button>
                                <button class="btn btn-secondary btn-md" data-bs-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>