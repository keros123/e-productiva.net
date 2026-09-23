<?php
$aprendiz = null;
$ficha = null;
$nombreFicha = null;

if (isset($_SESSION["id"])) {
  $aprendiz = $_SESSION["id"];
}
?>

<script src="assets/js/cl_formatoAprendiz.js"></script>

<div class="container mt-4 mb-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      <div class="d-flex align-items-center justify-content-between mb-2">
        <h2 class="mb-0">Formato GFPI-F-165</h2>
        <span class="badge bg-primary">PDF / Excel</span>
      </div>
      <p class="text-muted">
        Sube el archivo del formato <strong>GFPI-F-165</strong>. Al finalizar, podrás descargarlo o actualizarlo desde aquí mismo.
      </p>
    </div>
  </div>

  <div class="row justify-content-center g-4">
    <div class="col-lg-8">

      <!-- Formulario de subida -->
      <div id="contenedorSubida" class="card shadow-sm border-0">
        <div class="card-header bg-light border-0">
          <h5 class="mb-0">
            <i class="bi bi-upload me-2"></i>Subir archivo
          </h5>
        </div>
        <div class="card-body">
          <form id="formularioArchivo" class="needs-validation" novalidate enctype="multipart/form-data">
            <div class="mb-3">
              <label for="archivo" class="form-label fw-semibold">Seleccionar archivo</label>
              <input
                class="form-control"
                type="file"
                id="archivo"
                name="archivo"
                accept=".pdf,.xls,.xlsx"
                required>
              <div class="form-text">
                Permitidos: <span class="fw-semibold">PDF, XLS, XLSX</span> · Tamaño máx: <span class="fw-semibold">10MB</span>
              </div>
              <div class="invalid-feedback">Por favor, seleccione un archivo válido.</div>
            </div>

            <div class="d-grid gap-2">
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-cloud-upload me-1"></i> Subir archivo
              </button>
            </div>
          </form>
        </div>
      </div>

      <div id="contenedorArchivo" class="card shadow-sm border-0 mt-4" style="display: none;">
        <div class="card-header bg-light border-0">
          <h5 class="mb-0">
            <i class="bi bi-folder-check me-2"></i>Archivo subido
          </h5>
        </div>
        <div class="card-body">
          <div id="archivoInfo" class="p-2 text-center"></div>


          <div class="alert alert-secondary d-flex align-items-start gap-2 mt-3 mb-0" role="alert">
            <i class="bi bi-question-circle mt-1"></i>
            <div>
              Si necesitas reemplazar el documento, usa el botón <strong>Actualizar</strong> y selecciona un nuevo archivo.
            </div>
          </div>
        </div>
      </div>

      <div class="card border-0 mt-4">
        <div class="card-body">
          <div class="row g-3 justify-content-center">
            <div class="col-md-6 col-lg-5 mx-auto">
              <div class="h-100 p-3 border rounded">
                <div class="d-flex align-items-center mb-2">
                  <i class="bi bi-filetype-pdf fs-4 me-2 text-danger"></i>
                  <h6 class="mb-0">Requisitos del archivo</h6>
                </div>
                <ul class="mb-0 small">
                  <li>Formato: PDF, XLS o XLSX</li>
                  <li>Tamaño máximo: 10MB</li>
                  <li>Un solo archivo por aprendiz</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>