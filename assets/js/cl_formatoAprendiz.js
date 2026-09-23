class ArchivosFormatoAprendiz {
  constructor(objData) {
    this._objArchivo = objData;
  }

  subirArchivo() {
    const objData = new FormData();
    objData.append("archivo", this._objArchivo.archivo);
    objData.append("usuarioId", this._objArchivo.usuarioId);
    objData.append("subirArchivo", "ok");

    fetch(config.rutes["controllerArchivoAprendiz"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => {
        console.error("Error:", error);
        this.mostrarAlerta("error", "Error", "Error de conexión");
      })
      .then((response) => {
        if (!response) return;
        if (response["codigo"] == "200") {
          this.mostrarAlerta("success", "¡Éxito!", response["mensaje"]);
          const form = document.getElementById("formularioArchivo");
          if (form) {
            form.reset();
            form.classList.remove("was-validated");
          }
          setTimeout(() => this.cargarArchivo(), 800);
        } else {
          this.mostrarAlerta("error", "Error", response["mensaje"] || "Ocurrió un error");
        }
      });
  }

  cargarArchivo() {
    const objData = new FormData();
    objData.append("usuarioId", this._objArchivo.usuarioId);
    objData.append("obtenerArchivo", "ok");

    fetch(config.rutes["controllerArchivoAprendiz"], {
      method: "POST",
      body: objData,
    })
      .then((response) => response.json())
      .catch((error) => console.error("Error:", error))
      .then((response) => {
        if (!response) return;
        if (response["codigo"] == "200") {
          this.mostrarArchivo(response["mensaje"]);
        } else {
          const contArchivo = document.getElementById("contenedorArchivo");
          const contSubida = document.getElementById("contenedorSubida");
          if (contArchivo) contArchivo.style.display = "none";
          if (contSubida) contSubida.style.display = "block";
        }
      });
  }

  mostrarArchivo(archivo) {
    window.__ultimoArchivoFormatoAprendiz = archivo;

    const fechaSubida = (() => {
      const ms = Date.parse(archivo?.fecha_subida || "");
      if (!ms) return "—";
      return new Date(ms).toLocaleString("es-ES", {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
      });
    })();

    const tamanoBytes = Number(archivo.tamaño_archivo || archivo.tamano_archivo || 0);
    const tamañoMB = tamanoBytes > 0 ? (tamanoBytes / (1024 * 1024)).toFixed(2) : "—";

    const tipo = String(archivo.tipo_archivo || "").toLowerCase();
    const iconoArchivo = tipo.includes("pdf")
      ? '<i class="bi bi-file-earmark-pdf text-danger" style="font-size: 2.5rem;"></i>'
      : '<i class="bi bi-file-earmark-excel text-success" style="font-size: 2.5rem;"></i>';

    const contenidoArchivo = `
      <div class="row g-3 align-items-center">
        <div class="col-12">
          <div class="d-flex align-items-center justify-content-center">
            ${iconoArchivo}
          </div>
        </div>
        <div class="col-12 text-center">
          <h5 class="mb-1">${this.escapeHTML(archivo.nombre_original || "Archivo del aprendiz")}</h5>
          <p class="text-muted mb-1">Fecha de subida: ${fechaSubida}</p>
          <p class="text-muted mb-1">Tamaño: ${tamañoMB} MB</p>
        </div>
        <div class="col-12">
          <div class="d-grid gap-2">
            <a class="btn btn-primary" id="btnDescargarArchivo">
              <i class="bi bi-download"></i> Descargar
            </a>
            <button class="btn btn-warning" id="btnActualizarArchivo">
              <i class="bi bi-arrow-clockwise"></i> Actualizar
            </button>
          </div>
        </div>
      </div>
    `;

    const info = document.getElementById("archivoInfo");
    const contArchivo = document.getElementById("contenedorArchivo");
    const contSubida = document.getElementById("contenedorSubida");
    if (info) info.innerHTML = contenidoArchivo;
    if (contArchivo) contArchivo.style.display = "block";
    if (contSubida) contSubida.style.display = "none";

    const APP_PUBLIC_BASE = `${window.location.origin}/sgdcimm/`; 
    // const APP_PUBLIC_BASE = `${window.location.origin}/`;   nota: ruta en produccion
    let rutaRel = String(archivo.ruta_archivo || archivo.url_archivoFormato || "").replace(/^\/+/, "");
    const aDesc = document.getElementById("btnDescargarArchivo");

    if (rutaRel && aDesc) {
      const urlAbs = new URL(rutaRel, APP_PUBLIC_BASE).toString();
      aDesc.href = urlAbs;
      aDesc.setAttribute("download", "");

    } else if (aDesc) {
      const usuarioId = this._objArchivo.usuarioId ?? window.usuarioId ?? window.SESSION_USER_ID ?? 0;
      const base = config.rutes["controllerArchivoAprendiz"];
      if (usuarioId && base) {
        const url = new URL(base, window.location.origin);
        url.searchParams.set("descargarArchivo", "ok");
        url.searchParams.set("usuarioId", String(usuarioId));
        url.searchParams.set("t", Date.now().toString());
        aDesc.href = url.toString();
      } else {
        aDesc.href = "#";
        aDesc.addEventListener("click", (e) => {
          e.preventDefault();
          this.mostrarAlerta("error", "Descarga no disponible", "No se encontró la ruta del archivo.");
        });
      }
    }

    // Botón actualizar
    const btnActualizar = document.getElementById("btnActualizarArchivo");
    if (btnActualizar) {
      btnActualizar.onclick = () => window.actualizarArchivo();
    }
  }

  mostrarAlerta(tipo, titulo, texto) {
    const Swal = window.Swal;
    if (typeof Swal !== "undefined") {
      Swal.fire({
        icon: tipo,
        title: titulo,
        text: texto,
        showConfirmButton: tipo === "error",
        timer: tipo === "success" ? 1500 : undefined,
      });
    } else {
      alert(`${titulo}: ${texto}`);
    }
  }

  escapeHTML(str) {
    return String(str)
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")
      .replaceAll('"', "&quot;")
      .replaceAll("'", "&#039;");
  }
}

window.ArchivosFormatoAprendiz = ArchivosFormatoAprendiz;

document.addEventListener("DOMContentLoaded", () => {
  const usuarioId = window.usuarioId || (window.SESSION_USER_ID ?? 1);
  const archivosView = new ArchivosFormatoAprendiz({ usuarioId });
  window.__archivosViewFormatoAprendiz = archivosView;
  archivosView.cargarArchivo();

  const form = document.getElementById("formularioArchivo");
  if (!form) return;

  form.addEventListener("submit", (event) => {
    event.preventDefault();
    if (!form.checkValidity()) {
      event.stopPropagation();
      form.classList.add("was-validated");
      return;
    }

    const archivo = document.getElementById("archivo")?.files?.[0];
    if (!archivo) {
      const Swal = window.Swal;
      if (typeof Swal !== "undefined") {
        Swal.fire({
          icon: "warning",
          title: "Atención",
          text: "Por favor seleccione un archivo",
        });
      } else {
        alert("Por favor seleccione un archivo");
      }
      return;
    }

    const archivosUploader = new ArchivosFormatoAprendiz({
      archivo,
      usuarioId,
    });
    archivosUploader.subirArchivo();
  });
});

// Función global para actualizar
window.actualizarArchivo = function actualizarArchivo() {
  const contSubida = document.getElementById("contenedorSubida");
  const contArchivo = document.getElementById("contenedorArchivo");
  if (contSubida) contSubida.style.display = "block";
  if (contArchivo) contArchivo.style.display = "none";

  const form = document.getElementById("formularioArchivo");
  if (form) {
    const grid = form.querySelector(".d-grid");
    if (grid && !document.getElementById("btnVolverVerArchivo")) {
      const btn = document.createElement("button");
      btn.type = "button";
      btn.id = "btnVolverVerArchivo";
      btn.className = "btn btn-secondary";
      btn.innerHTML = '<i class="bi bi-eye"></i> Volver a ver';
      btn.addEventListener("click", () => {
        if (contSubida) contSubida.style.display = "none";
        if (contArchivo) contArchivo.style.display = "block";
        if (window.__archivosViewFormatoAprendiz && window.__ultimoArchivoFormatoAprendiz) {
          window.__archivosViewFormatoAprendiz.mostrarArchivo(window.__ultimoArchivoFormatoAprendiz);
        }
        btn.remove();
      });
      grid.appendChild(btn);
    }
  }

  const Swal = window.Swal;
  if (typeof Swal !== "undefined") {
    Swal.fire({
      icon: "info",
      title: "Actualizar Archivo",
      text: "Seleccione un nuevo archivo para reemplazar el actual",
      showConfirmButton: false,
      timer: 1500,
    });
  } else {
    alert("Seleccione un nuevo archivo para reemplazar el actual");
  }
};
