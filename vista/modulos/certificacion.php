<?php
$aprendiz = null;
$ficha = null;
$nombreFicha = null;

if (isset($_SESSION["id"])) {
  $aprendiz = $_SESSION["id"];
}
?>

<div id="contenedorPrincipal" aprendiz="<?php echo $aprendiz; ?>" class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Panel Administrativo / Certificación /</span>
    <?php echo $_SESSION["ficha"] . " - " . ucfirst(mb_strtolower($_SESSION["nombreFicha"])); ?>
  </h4>

  <br>
  <div id="contenedorFormulario" class="row">
    <div class="row documentosCertificacion">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title text-primary">Aprendiz Sena! 🎉</h5>
            <p class="mb-4">
              Desde este espacio usted podrá adjuntar fácilmente los documentos requeridos para su
              certificacion de su técnico o tecnológo, dentro de estos documentos usted deberá subir dependiendo su programa.
            </p>
            <div class="error"></div>
            <br>
            <div class="table-responsive">
              <table id="tabla_DocumentosCertificacion" class="table table-hover align-middle table-sm border-top" style="width: 100%;">
                <thead class="table-light">
                  <tr>
                    <th class="text-nowrap text-center">Titulo del Documento</th>
                    <th class="text-nowrap text-center">novedad</th>
                    <th class="text-nowrap text-center">estado</th>
                    <th class="text-nowrap text-center">Acciones</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>




                  </tr>
                </tbody>
              </table>
            </div>

            <div class="row mt-2">
              <div class="container-xxl flex-grow-1 container-p-y">
                <button id="btn-radicarDocumentos" onclick="radicarDocumentosAprendiz(<?php echo $aprendiz; ?>)" type="button" class="btn btn-primary">Radicar Documentos</button>
              </div>
            </div>

            <div id="mensajesErrorCertificacion" class="row mt-2" style="display: none;">

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="certificacionTitulo">Agregar Documento</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Contenido dinámico de la modal -->
            <form id="formularioPdfDocumentos" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
              <div class="mb-1">
                <label for="tituloDocumentoCertificacion" class="form-label">Título del Documento:</label>
                <input type="text" class="form-control" id="tituloDocumentoCertificacion" name="tituloDocumentoCertificacion" disabled required>
              </div>
              <div class="mb-1">
                <input type="file" class="form-control btn-danger" id="txt_file_certificacion" name="archivoDocumento" accept=".pdf" required>
                <small id="helpId" class="form-text text-muted">Archivo permitido .pdf</small>
                <div id="errorFile" class="mc-errores"></div>
              </div>
              <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
          </div>
          <div class="modal-footer">

            <!-- Footer de la modal -->
          </div>
        </div>
      </div>
    </div>

  </div>
</div>




<script src="vista/js/certificacion.js"></script>
<script src="assets/js/cl_radicacion.js"></script>
<script src="vista/js/radicacion.js"></script>