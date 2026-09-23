<style>
    /* ============================================
       INICIO APRENDIZ - ESTILOS
    ============================================ */

    /* Hero */
    .apr-hero {
        background: linear-gradient(135deg, #28c76f 0%, #20a75e 40%, #1a8a4e 100%);
        border-radius: 14px;
        overflow: hidden;
        position: relative;
        border: none;
    }
    .apr-hero::before {
        content: '';
        position: absolute;
        top: -50px; right: -50px;
        width: 180px; height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,0.07);
        pointer-events: none;
    }

    /* Video */
    .apr-video-card {
        border: none;
        border-radius: 14px;
        overflow: hidden;
    }
    .apr-video-wrapper {
        position: relative;
        padding-bottom: 56.25%;
        height: 0;
        overflow: hidden;
        border-radius: 10px;
        background: #000;
    }
    .apr-video-wrapper iframe {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        border: none;
    }

    /* Steps */
    .apr-step {
        display: flex;
        align-items: flex-start;
        gap: 0.85rem;
        padding: 0.65rem 0;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    .apr-step:last-child { border-bottom: none; }
    .apr-step-num {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: linear-gradient(135deg, #28c76f, #1a8a4e);
        color: #fff;
        font-size: 0.75rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* Document cards */
    .apr-doc-card {
        border: none;
        border-radius: 12px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        border-left: 4px solid transparent;
    }
    .apr-doc-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 28px rgba(0,0,0,0.12) !important;
    }
    .apr-doc-card.xlsx { border-left-color: #28c76f; }
    .apr-doc-card.docx { border-left-color: #00bad1; }
    .apr-doc-card.pdf  { border-left-color: #ff4d4d; }

    .apr-doc-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    .apr-doc-icon.xlsx { background: rgba(40,199,111,0.15); color: #28c76f; }
    .apr-doc-icon.docx { background: rgba(0,186,209,0.15);  color: #00bad1; }
    .apr-doc-icon.pdf  { background: rgba(255,77,77,0.15);  color: #ff4d4d; }

    .apr-doc-badge {
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        padding: 2px 8px;
        border-radius: 20px;
        text-transform: uppercase;
    }
    .apr-doc-btn {
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
    .apr-doc-btn:hover { opacity: 0.85; transform: translateY(-1px); color: #fff; }
    .apr-doc-btn.xlsx { background: #28c76f; color: #fff; }
    .apr-doc-btn.docx { background: #00bad1; color: #fff; }
    .apr-doc-btn.pdf  { background: #ff4d4d; color: #fff; }

    .apr-section-label {
        font-size: 0.73rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #28c76f;
        margin-bottom: 0.5rem;
    }
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- ===== HERO BANNER COMPACTO ===== -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card apr-hero shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3 py-3 px-4" style="position:relative;z-index:1;">
                        <div class="d-flex align-items-center justify-content-center rounded flex-shrink-0"
                             style="width:50px;height:50px;background:rgba(255,255,255,0.2);">
                            <i class="bx bxs-graduation text-white" style="font-size:1.8rem;"></i>
                        </div>
                        <div class="flex-grow-1 text-white">
                            <h5 class="mb-1 fw-bold text-white">Bienvenido, Aprendiz SENA 🎓</h5>
                            <p class="mb-0 d-none d-md-block" style="font-size:0.85rem;opacity:0.9;">
                                Desde aquí puedes descargar los documentos requeridos para solicitar tu etapa práctica.
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
                <div class="card apr-video-card shadow-sm h-100">
                    <div class="card-body p-4">
                        <p class="apr-section-label">Tutorial</p>
                        <h5 class="fw-bold mb-3" style="color:#435971;">Orientación: Formato GFPI-F-165</h5>
                        <div class="apr-video-wrapper">
                            <iframe
                                src="https://www.youtube.com/embed/AleNJoH7KbA?si=-1nCp8IJoNaJZxeD"
                                title="Tutorial Orientación GFPI-F-165"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin"
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
                        <p class="apr-section-label">Guía rápida</p>
                        <h5 class="fw-bold mb-3" style="color:#435971;">¿Cómo solicitar tu etapa práctica?</h5>

                        <div class="apr-step">
                            <div class="apr-step-num">1</div>
                            <div>
                                <p class="fw-semibold mb-0" style="font-size:0.9rem;">Descarga el formato GFPI-F-165</p>
                                <small class="text-muted">Selecciona o modifica la alternativa de etapa práctica que deseas realizar.</small>
                            </div>
                        </div>
                        <div class="apr-step">
                            <div class="apr-step-num">2</div>
                            <div>
                                <p class="fw-semibold mb-0" style="font-size:0.9rem;">Diligencia el formulario</p>
                                <small class="text-muted">Completa todos los campos requeridos con tu información personal y la de la empresa.</small>
                            </div>
                        </div>
                        <div class="apr-step">
                            <div class="apr-step-num">3</div>
                            <div>
                                <p class="fw-semibold mb-0" style="font-size:0.9rem;">Radica los documentos</p>
                                <small class="text-muted">Sube el formato diligenciado en el módulo de radicación del sistema SGD.</small>
                            </div>
                        </div>
                        <div class="apr-step">
                            <div class="apr-step-num">4</div>
                            <div>
                                <p class="fw-semibold mb-0" style="font-size:0.9rem;">Espera validación</p>
                                <small class="text-muted">El coordinador revisará tu solicitud y te notificará por correo el resultado.</small>
                            </div>
                        </div>
                        <div class="apr-step">
                            <div class="apr-step-num">5</div>
                            <div>
                                <p class="fw-semibold mb-0" style="font-size:0.9rem;">Realiza tus seguimientos</p>
                                <small class="text-muted">Una vez aprobado, coordina con tu instructor las visitas de seguimiento periódicas.</small>
                            </div>
                        </div>

                        <div class="mt-3 p-3 rounded-3" style="background:rgba(40,199,111,0.07);">
                            <small class="text-muted"><i class="bx bx-info-circle text-success me-1"></i>
                                ¿Tienes dudas? Mira el video tutorial o consulta a tu instructor de etapa práctica.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== DOCUMENTOS ===== -->
        <div class="row mb-2">
            <div class="col-12">
                <p class="apr-section-label">Recursos y formatos</p>
                <h5 class="fw-bold mb-3" style="color:#435971;">Documentos disponibles</h5>
            </div>
        </div>

        <div class="row g-3">

            <!-- GFPI-F-165 V-03 - xlsx -->
            <div class="col-md-6 col-xl-3">
                <div class="card apr-doc-card xlsx shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-3">
                        <div class="apr-doc-icon xlsx">
                            <i class="bx bx-spreadsheet"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="apr-doc-badge bg-label-success text-success d-block mb-1">Excel</span>
                            <p class="fw-bold mb-0" style="font-size:0.85rem;color:#435971;">GFPI-F-165 V-03</p>
                            <small class="text-muted" style="font-size:0.75rem;">Selección o modificación de alternativa etapa productiva</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                        <a href="vista/recursos/documentos/GFPI-F-165V3.xlsx" class="apr-doc-btn xlsx w-100 justify-content-center">
                            <i class="bx bx-download"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>

            <!-- GFPI-F-023 V-06 - docx -->
            <div class="col-md-6 col-xl-3">
                <div class="card apr-doc-card docx shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-3">
                        <div class="apr-doc-icon docx">
                            <i class="bx bx-file-blank"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="apr-doc-badge bg-label-info text-info d-block mb-1">Word</span>
                            <p class="fw-bold mb-0" style="font-size:0.85rem;color:#435971;">GFPI-F-023 V-06</p>
                            <small class="text-muted" style="font-size:0.75rem;">Seguimiento Etapa Productiva</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                        <a href="vista/recursos/documentos/GFPI-F-023V06FormatodePlaneacionSeguimientoyEvaluaciondeEtapaProductiva.docx" class="apr-doc-btn docx w-100 justify-content-center">
                            <i class="bx bx-download"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>

            <!-- GFPI-F-147 V-05 - xlsx -->
            <div class="col-md-6 col-xl-3">
                <div class="card apr-doc-card xlsx shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-3">
                        <div class="apr-doc-icon xlsx">
                            <i class="bx bx-spreadsheet"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="apr-doc-badge bg-label-success text-success d-block mb-1">Excel</span>
                            <p class="fw-bold mb-0" style="font-size:0.85rem;color:#435971;">GFPI-F-147 V-05</p>
                            <small class="text-muted" style="font-size:0.75rem;">Bitácora Seguimiento Etapa Productiva</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                        <a href="vista/recursos/documentos/GFPI-F-147V05-Formato-bitacoras.xlsx" class="apr-doc-btn xlsx w-100 justify-content-center">
                            <i class="bx bx-download"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>

            <!-- GFPI-F-191 V-02 - docx -->
            <div class="col-md-6 col-xl-3">
                <div class="card apr-doc-card docx shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-3">
                        <div class="apr-doc-icon docx">
                            <i class="bx bx-file-blank"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="apr-doc-badge bg-label-info text-info d-block mb-1">Word</span>
                            <p class="fw-bold mb-0" style="font-size:0.85rem;color:#435971;">GFPI-F-191 V-02</p>
                            <small class="text-muted" style="font-size:0.75rem;">Vínculo Formativo Acuerdo de Voluntades</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                        <a href="vista/recursos/documentos/GFPI-F-191V02VinculoformativoAcuerdodeVoluntades.docx" class="apr-doc-btn docx w-100 justify-content-center">
                            <i class="bx bx-download"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Carta Solicitud - docx -->
            <div class="col-md-6 col-xl-3">
                <div class="card apr-doc-card docx shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-3">
                        <div class="apr-doc-icon docx">
                            <i class="bx bx-file-blank"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="apr-doc-badge bg-label-info text-info d-block mb-1">Word</span>
                            <p class="fw-bold mb-0" style="font-size:0.85rem;color:#435971;">Carta Solicitud</p>
                            <small class="text-muted" style="font-size:0.75rem;">Solicitud Diferente a Contrato de Aprendizaje</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                        <a href="vista/recursos/documentos/CARTA SOLICITUD ETAPA PRODUCTIVA CIMM 2025.docx" class="apr-doc-btn docx w-100 justify-content-center">
                            <i class="bx bx-download"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Guia Aval - pdf -->
            <div class="col-md-6 col-xl-3">
                <div class="card apr-doc-card pdf shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-3">
                        <div class="apr-doc-icon pdf">
                            <i class="bx bxs-file-pdf"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="apr-doc-badge bg-label-danger text-danger d-block mb-1">PDF</span>
                            <p class="fw-bold mb-0" style="font-size:0.85rem;color:#435971;">Guía Aval</p>
                            <small class="text-muted" style="font-size:0.75rem;">Otras Alternativas Etapa Productiva</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                        <a href="vista/recursos/documentos/P. GUIA DE PROCESO AVAL OTRAS ALTERNATIVAS ETAPA PRODUCTIVA 2025.pdf" target="_blank" class="apr-doc-btn pdf w-100 justify-content-center">
                            <i class="bx bx-download"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>

            <!-- Manual de Usuario - pdf -->
            <div class="col-md-6 col-xl-3">
                <div class="card apr-doc-card pdf shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3 p-3">
                        <div class="apr-doc-icon pdf">
                            <i class="bx bxs-file-pdf"></i>
                        </div>
                        <div class="flex-grow-1">
                            <span class="apr-doc-badge bg-label-danger text-danger d-block mb-1">PDF</span>
                            <p class="fw-bold mb-0" style="font-size:0.85rem;color:#435971;">Manual de Usuario</p>
                            <small class="text-muted" style="font-size:0.75rem;">Instructivo del Aplicativo SGD</small>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 pt-0 pb-3 px-3">
                        <a href="vista/recursos/Instructivo_Aprendiz.pdf" target="_blank" class="apr-doc-btn pdf w-100 justify-content-center">
                            <i class="bx bx-download"></i> Descargar
                        </a>
                    </div>
                </div>
            </div>

        </div><!-- /row documentos -->

    </div>
</div>