<style>
    /* ============================================
       INICIO INSTRUCTOR - ESTILOS
    ============================================ */

    /* Hero */
    .inst-hero {
        background: linear-gradient(135deg, #696cff 0%, #567bfb 40%, #9155fd 100%);
        border-radius: 14px;
        overflow: hidden;
        position: relative;
        border: none;
    }
    .inst-hero::before {
        content: '';
        position: absolute;
        top: -50px; right: -50px;
        width: 180px; height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,0.07);
        pointer-events: none;
    }

    /* Video card */
    .inst-video-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
    }
    .inst-video-wrapper {
        position: relative;
        padding-bottom: 56.25%; /* 16:9 */
        height: 0;
        overflow: hidden;
        border-radius: 10px;
        background: #000;
    }
    .inst-video-wrapper iframe {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        border: none;
    }

    /* Steps list */
    .inst-step {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        padding: 0.65rem 0;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    .inst-step:last-child { border-bottom: none; }
    .inst-step-num {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, #696cff, #9155fd);
        color: #fff;
        font-size: 0.75rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* Download cards */
    .inst-doc-card {
        border: none;
        border-radius: 12px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        border-left: 4px solid transparent;
    }
    .inst-doc-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 28px rgba(0,0,0,0.12) !important;
    }
    .inst-doc-card.xlsx  { border-left-color: #28c76f; }
    .inst-doc-card.docx  { border-left-color: #00bad1; }
    .inst-doc-card.pdf   { border-left-color: #ff4d4d; }
    .inst-doc-card.link  { border-left-color: #9155fd; }

    .inst-doc-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    .inst-doc-icon.xlsx  { background: rgba(40,199,111,0.15);  color: #28c76f; }
    .inst-doc-icon.docx  { background: rgba(0,186,209,0.15);   color: #00bad1; }
    .inst-doc-icon.pdf   { background: rgba(255,77,77,0.15);   color: #ff4d4d; }
    .inst-doc-icon.link  { background: rgba(145,85,253,0.15);  color: #9155fd; }

    .inst-doc-badge {
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 2px 8px;
        border-radius: 20px;
        text-transform: uppercase;
    }
    .inst-doc-btn {
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 20px;
        padding: 5px 16px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: opacity 0.2s ease, transform 0.2s ease;
        border: none;
    }
    .inst-doc-btn:hover { opacity: 0.85; transform: translateY(-1px); color: #fff; }
    .inst-doc-btn.xlsx { background: #28c76f; color: #fff; }
    .inst-doc-btn.docx { background: #00bad1; color: #fff; }
    .inst-doc-btn.pdf  { background: #ff4d4d; color: #fff; }
    .inst-doc-btn.link { background: #9155fd; color: #fff; }

    .inst-section-label {
        font-size: 0.73rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #696cff;
        margin-bottom: 0.5rem;
    }
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- ===== HERO BANNER COMPACTO ===== -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card inst-hero shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3 py-3 px-4" style="position:relative;z-index:1;">
                        <div class="d-flex align-items-center justify-content-center rounded flex-shrink-0"
                             style="width:50px;height:50px;background:rgba(255,255,255,0.2);">
                            <i class="bx bxs-user-badge text-white" style="font-size:1.8rem;"></i>
                        </div>
                        <div class="flex-grow-1 text-white">
                            <h5 class="mb-1 fw-bold text-white">Bienvenido, Instructor SENA 🎓</h5>
                            <p class="mb-0 d-none d-md-block" style="font-size:0.85rem;opacity:0.9;">
                                Desde aquí puedes descargar los formatos requeridos para realizar los seguimientos de etapa práctica.
                            </p>
                        </div>
                        <div class="d-none d-lg-flex align-items-center gap-4 text-white" style="opacity:0.85;font-size:0.82rem;">
                            <span><i class="bx bx-file me-1"></i>Formatos oficiales</span>
                            <span><i class="bx bx-video me-1"></i>Tutorial disponible</span>
                            <span><i class="bx bx-download me-1"></i>Descarga directa</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== VIDEO + PASOS ===== -->
        <div class="row mb-4 g-4">
            <!-- Video -->
            <div class="col-lg-7">
                <div class="card inst-video-card shadow-sm h-100">
                    <div class="card-body p-4">
                        <p class="inst-section-label">Tutorial</p>
                        <h5 class="fw-bold mb-3" style="color:#435971;">¿Cómo diligenciar el formato GFPI-F-023?</h5>
                        <div class="inst-video-wrapper">
                            <iframe
                                src="https://www.youtube.com/embed/jdb8AZPvZ5I"
                                title="Tutorial SGD - Seguimientos Instructor"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pasos rápidos -->
            <div class="col-lg-5">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <p class="inst-section-label">Guía rápida</p>
                        <h5 class="fw-bold mb-3" style="color:#435971;">Pasos del proceso</h5>

                        <div class="inst-step">
                            <div class="inst-step-num">1</div>
                            <div>
                                <p class="fw-semibold mb-0" style="font-size:0.9rem;">Descarga los formatos</p>
                                <small class="text-muted">Obtén los documentos GFPI requeridos según el tipo de etapa práctica.</small>
                            </div>
                        </div>
                        <div class="inst-step">
                            <div class="inst-step-num">2</div>
                            <div>
                                <p class="fw-semibold mb-0" style="font-size:0.9rem;">Diligencia el seguimiento</p>
                                <small class="text-muted">Completa el formato GFPI-F-023 con la información del aprendiz y la visita.</small>
                            </div>
                        </div>
                        <div class="inst-step">
                            <div class="inst-step-num">3</div>
                            <div>
                                <p class="fw-semibold mb-0" style="font-size:0.9rem;">Sube el documento al sistema</p>
                                <small class="text-muted">Adjunta el reporte diligenciado en el módulo de seguimientos del SGD.</small>
                            </div>
                        </div>
                        <div class="inst-step">
                            <div class="inst-step-num">4</div>
                            <div>
                                <p class="fw-semibold mb-0" style="font-size:0.9rem;">Espera aprobación</p>
                                <small class="text-muted">El coordinador revisará y aprobará o rechazará el reporte enviado.</small>
                            </div>
                        </div>
                        <div class="inst-step">
                            <div class="inst-step-num">5</div>
                            <div>
                                <p class="fw-semibold mb-0" style="font-size:0.9rem;">Consulta el estado</p>
                                <small class="text-muted">Revisa el estado de tus seguimientos asignados en la sección correspondiente.</small>
                            </div>
                        </div>

                        <div class="mt-3 p-3 rounded-3" style="background:rgba(105,108,255,0.07);">
                            <small class="text-muted"><i class="bx bx-info-circle text-primary me-1"></i>
                                ¿Tienes dudas? Mira el video tutorial adjunto o contacta al coordinador de etapa práctica.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== DOCUMENTOS DE DESCARGA ===== -->
        <div class="row mb-2">
            <div class="col-12">
                <p class="inst-section-label">Recursos y formatos</p>
                <h5 class="fw-bold mb-3" style="color:#435971;">Documentos disponibles</h5>
            </div>
        </div>

        <div class="row g-3">

            <!-- GFPI-F-165 V-03 - xlsx -->
            <div class="col-md-6 col-xl-3">
                <div class="card inst-doc-card xlsx shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-3">
                        <div class="inst-doc-icon xlsx">
                            <i class="bx bx-spreadsheet"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="inst-doc-badge bg-label-success text-success d-block mb-1">Excel</span>
                            <p class="fw-bold mb-0" style="font-size:0.85rem;color:#435971;">GFPI-F-165 V-03</p>
                            <small class="text-muted" style="font-size:0.75rem;">Modificación Alternativa Etapa Productiva</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                        <a href="vista/recursos/documentos/GFPI-F-165V3.xlsx" class="inst-doc-btn xlsx w-100 justify-content-center">
                            <i class="bx bx-download"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>

            <!-- GFPI-F-023 V-06 - docx -->
            <div class="col-md-6 col-xl-3">
                <div class="card inst-doc-card docx shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-3">
                        <div class="inst-doc-icon docx">
                            <i class="bx bx-file-blank"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="inst-doc-badge bg-label-info text-info d-block mb-1">Word</span>
                            <p class="fw-bold mb-0" style="font-size:0.85rem;color:#435971;">GFPI-F-023 V-06</p>
                            <small class="text-muted" style="font-size:0.75rem;">Seguimiento Etapa Productiva</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                        <a href="vista/recursos/documentos/GFPI-F-023V06FormatodePlaneacionSeguimientoyEvaluaciondeEtapaProductiva.docx" class="inst-doc-btn docx w-100 justify-content-center">
                            <i class="bx bx-download"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>

            <!-- GFPI-F-147 V-05 - xlsx -->
            <div class="col-md-6 col-xl-3">
                <div class="card inst-doc-card xlsx shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-3">
                        <div class="inst-doc-icon xlsx">
                            <i class="bx bx-spreadsheet"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="inst-doc-badge bg-label-success text-success d-block mb-1">Excel</span>
                            <p class="fw-bold mb-0" style="font-size:0.85rem;color:#435971;">GFPI-F-147 V-05</p>
                            <small class="text-muted" style="font-size:0.75rem;">Bitácora Seguimiento Etapa Productiva</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                        <a href="vista/recursos/documentos/GFPI-F-147V05-Formato-bitacoras.xlsx" class="inst-doc-btn xlsx w-100 justify-content-center">
                            <i class="bx bx-download"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>

            <!-- GFPI-F-191 V-02 - docx -->
            <div class="col-md-6 col-xl-3">
                <div class="card inst-doc-card docx shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-3">
                        <div class="inst-doc-icon docx">
                            <i class="bx bx-file-blank"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="inst-doc-badge bg-label-info text-info d-block mb-1">Word</span>
                            <p class="fw-bold mb-0" style="font-size:0.85rem;color:#435971;">GFPI-F-191 V-02</p>
                            <small class="text-muted" style="font-size:0.75rem;">Vínculo Formativo Acuerdo de Voluntades</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                        <a href="vista/recursos/documentos/GFPI-F-191V02VinculoformativoAcuerdodeVoluntades.docx" class="inst-doc-btn docx w-100 justify-content-center">
                            <i class="bx bx-download"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Carta Solicitud - docx -->
            <div class="col-md-6 col-xl-3">
                <div class="card inst-doc-card docx shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-3">
                        <div class="inst-doc-icon docx">
                            <i class="bx bx-file-blank"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="inst-doc-badge bg-label-info text-info d-block mb-1">Word</span>
                            <p class="fw-bold mb-0" style="font-size:0.85rem;color:#435971;">Carta Solicitud</p>
                            <small class="text-muted" style="font-size:0.75rem;">Solicitud Diferente a Contrato de Aprendizaje</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                        <a href="vista/recursos/documentos/CARTA SOLICITUD ETAPA PRODUCTIVA CIMM 2025.docx" class="inst-doc-btn docx w-100 justify-content-center">
                            <i class="bx bx-download"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Guia Aval - pdf -->
            <div class="col-md-6 col-xl-3">
                <div class="card inst-doc-card pdf shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-3">
                        <div class="inst-doc-icon pdf">
                            <i class="bx bxs-file-pdf"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="inst-doc-badge bg-label-danger text-danger d-block mb-1">PDF</span>
                            <p class="fw-bold mb-0" style="font-size:0.85rem;color:#435971;">Guía Aval</p>
                            <small class="text-muted" style="font-size:0.75rem;">Otras Alternativas Etapa Productiva</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                        <a href="vista/recursos/documentos/P. GUIA DE PROCESO AVAL OTRAS ALTERNATIVAS ETAPA PRODUCTIVA 2025.pdf" target="_blank" class="inst-doc-btn pdf w-100 justify-content-center">
                            <i class="bx bx-download"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Manual Operativo - pdf -->
            <div class="col-md-6 col-xl-3">
                <div class="card inst-doc-card pdf shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-3">
                        <div class="inst-doc-icon pdf">
                            <i class="bx bxs-file-pdf"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="inst-doc-badge bg-label-danger text-danger d-block mb-1">PDF</span>
                            <p class="fw-bold mb-0" style="font-size:0.85rem;color:#435971;">Manual Operativo</p>
                            <small class="text-muted" style="font-size:0.75rem;">Manual Perfil Instructor</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                        <a href="vista/recursos/Instructivo_Instructores.pdf" target="_blank" class="inst-doc-btn pdf w-100 justify-content-center">
                            <i class="bx bx-download"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Herramienta Online - link -->
            <div class="col-md-6 col-xl-3">
                <div class="card inst-doc-card link shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-3">
                        <div class="inst-doc-icon link">
                            <i class="bx bx-globe"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="inst-doc-badge bg-label-primary text-primary d-block mb-1">Online</span>
                            <p class="fw-bold mb-0" style="font-size:0.85rem;color:#435971;">Herramienta Online</p>
                            <small class="text-muted" style="font-size:0.75rem;">Editor PDF para seguimientos</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                        <a href="https://www.sejda.com/" target="_blank" class="inst-doc-btn link w-100 justify-content-center">
                            <i class="bx bx-link-external"></i> Ir al Sitio
                        </a>
                    </div>
                </div>
            </div>

        </div><!-- /row documentos -->

    </div>
</div>
