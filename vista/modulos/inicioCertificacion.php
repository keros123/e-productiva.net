<style>
    /* ================================================
       INICIO CERTIFICACIÓN - ESTILOS MEJORADOS
    ================================================ */

    /* Hero Banner */
    .cert-hero-card {
        background: linear-gradient(135deg, #696cff 0%, #567bfb 40%, #9155fd 100%);
        border: none;
        border-radius: 16px;
        overflow: hidden;
        position: relative;
    }

    .cert-hero-card::before {
        content: '';
        position: absolute;
        top: -60px;
        right: -60px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.07);
        pointer-events: none;
    }

    .cert-hero-card::after {
        content: '';
        position: absolute;
        bottom: -80px;
        right: 120px;
        width: 160px;
        height: 160px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.05);
        pointer-events: none;
    }

    .cert-hero-card .card-body {
        padding: 2rem 2.5rem;
    }

    .cert-hero-greeting {
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: rgba(255,255,255,0.75);
        margin-bottom: 0.5rem;
    }

    .cert-hero-title {
        font-size: 2rem;
        font-weight: 700;
        color: #fff;
        line-height: 1.2;
        margin-bottom: 0.75rem;
    }

    .cert-hero-desc {
        color: rgba(255,255,255,0.85);
        font-size: 0.95rem;
        max-width: 440px;
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .cert-hero-img {
        opacity: 0.92;
        filter: drop-shadow(0 8px 24px rgba(0,0,0,0.2));
        transition: transform 0.4s ease;
    }

    .cert-hero-img:hover {
        transform: translateY(-5px) scale(1.03);
    }

    /* KPI Cards */
    .cert-kpi-card {
        border: none;
        border-radius: 14px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        overflow: hidden;
        position: relative;
    }

    .cert-kpi-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(105, 108, 255, 0.18) !important;
    }

    .cert-kpi-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .cert-kpi-icon.certified {
        background: rgba(105, 108, 255, 0.15);
        color: #696cff;
    }

    .cert-kpi-icon.pending {
        background: rgba(255, 171, 0, 0.15);
        color: #ffab00;
    }

    .cert-kpi-label {
        font-size: 0.8rem;
        color: #a8aab7;
        font-weight: 500;
        margin-bottom: 0.2rem;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .cert-kpi-value {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
        color: #566a7f;
    }

    .cert-kpi-badge {
        font-size: 0.75rem;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 600;
    }

    /* Chart card */
    .cert-chart-card {
        border: none;
        border-radius: 14px;
    }

    /* Progress bar visual */
    .cert-progress-bar {
        height: 6px;
        border-radius: 3px;
        background: #e8e8ea;
        overflow: hidden;
        margin-top: 8px;
    }

    .cert-progress-fill {
        height: 100%;
        border-radius: 3px;
        animation: growBar 1s ease forwards;
    }

    @keyframes growBar {
        from { width: 0%; }
    }

    /* Manual Card */
    .cert-manual-card {
        border: none;
        border-radius: 14px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }

    .cert-manual-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.1) !important;
    }

    .cert-manual-icon-wrap {
        background: linear-gradient(135deg, #ff4d4d 0%, #f95b3d 100%);
        border-radius: 12px;
        width: 64px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 6px 16px rgba(249, 91, 61, 0.4);
        transition: transform 0.3s ease;
    }

    .cert-manual-card:hover .cert-manual-icon-wrap {
        transform: scale(1.08) rotate(-3deg);
    }

    .cert-manual-icon-wrap i {
        font-size: 1.8rem;
        color: #fff;
    }

    .cert-download-btn {
        background: linear-gradient(135deg, #696cff 0%, #9155fd 100%);
        border: none;
        border-radius: 8px;
        color: #fff;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 8px 20px;
        transition: opacity 0.2s ease, transform 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    .cert-download-btn:hover {
        opacity: 0.88;
        color: #fff;
        transform: translateY(-1px);
    }

    /* Section header */
    .cert-section-label {
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #696cff;
        margin-bottom: 0.4rem;
    }

    /* Divider list item */
    .cert-stat-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.85rem 0;
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }

    .cert-stat-item:last-child {
        border-bottom: none;
    }

    .cert-stat-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .cert-year-badge {
        background: rgba(105, 108, 255, 0.12);
        color: #696cff;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        padding: 4px 12px;
        display: inline-block;
        margin-bottom: 0.5rem;
    }
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- ======= HERO BANNER (Compacto con gradiente) ======= -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card cert-hero-card shadow-sm border-0">
                    <div class="card-body d-flex align-items-center gap-3" style="padding: 1.25rem 1.8rem !important; position: relative; z-index: 1;">
                        <div class="d-flex align-items-center justify-content-center rounded flex-shrink-0 shadow-sm" style="width: 50px; height: 50px; background: rgba(255, 255, 255, 0.2);">
                            <i class="bx bxs-graduation text-white" style="font-size: 1.8rem;"></i>
                        </div>
                        <div class="flex-grow-1 text-white">
                            <h5 class="mb-1 fw-bold text-white" style="letter-spacing: 0.5px;">Sistema de Gestión Documental: Certificación SENA</h5>
                            <p class="mb-0 text-white shadow-none d-none d-md-block" style="font-size: 0.85rem; opacity: 0.9;">
                                Monitoree, gestione y descargue eficientemente los documentos en proceso de certificación.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ======= CONTENIDO PRINCIPAL ======= -->
        <div class="row g-4">
            
            <!-- ====== LADO IZQUIERDO: GRÁFICA (50%) ====== -->
            <div class="col-md-6">
                <div class="card cert-chart-card shadow-sm h-100">
                    <div class="card-body p-4">

                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <div>
                                <p class="cert-section-label mb-0">Visualización de datos</p>
                                <h4 class="fw-bold mb-0">Resumen General</h4>
                            </div>
                            <span class="cert-year-badge">
                                Año <script>document.write(new Date().getFullYear());</script>
                            </span>
                        </div>

                        <p class="text-muted mb-3" style="font-size:0.85rem;">
                            Distribución de aprendices según su estado actual de certificación.
                        </p>

                        <!-- Gráfica grande y centrada -->
                        <div id="certificadosProcesoGrafica"
                             class="d-flex justify-content-center align-items-center"
                             style="min-height:260px;"></div>

                        <!-- Leyenda enriquecida -->
                        <div class="row g-3 mt-2">
                            <div class="col-6">
                                <div class="p-3 rounded-3" style="background:rgba(105,108,255,0.07);">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="cert-stat-dot" style="background:#696cff;width:12px;height:12px;"></span>
                                        <span style="font-size:0.8rem;font-weight:700;color:#696cff;text-transform:uppercase;letter-spacing:0.8px;">Certificados</span>
                                    </div>
                                    <h3 class="fw-bold mb-0" id="totalCertificados2" style="color:#566a7f;">—</h3>
                                    <div class="cert-progress-bar mt-2">
                                        <div class="cert-progress-fill bg-primary" id="barLeg1" style="width:0%;"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 rounded-3" style="background:rgba(255,171,0,0.07);">
                                    <div class="d-flex align-items-center gap-2 mb-2">
                                        <span class="cert-stat-dot" style="background:#ffab00;width:12px;height:12px;"></span>
                                        <span style="font-size:0.8rem;font-weight:700;color:#ffab00;text-transform:uppercase;letter-spacing:0.8px;">Por Certificar</span>
                                    </div>
                                    <h3 class="fw-bold mb-0" id="totalPorCertificar2" style="color:#566a7f;">—</h3>
                                    <div class="cert-progress-bar mt-2">
                                        <div class="cert-progress-fill bg-warning" id="barLeg2" style="width:0%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- ====== LADO DERECHO: KPIs Y MANUAL (50%) ====== -->
            <div class="col-md-6 d-flex flex-column gap-4">
                <!-- Manual (Diseño Compacto) -->
                <div class="card shadow-none border bg-transparent rounded-3 mt-1">
                    <a href="vista\recursos\ManualCertificaciónsgd.pdf" target="_blank" class="d-flex align-items-center gap-3 p-3 text-decoration-none" style="color: inherit; transition: all 0.2s ease;" onmouseover="this.style.backgroundColor='rgba(105, 108, 255, 0.05)'" onmouseout="this.style.backgroundColor='transparent'">
                        <div class="d-flex justify-content-center align-items-center rounded bg-label-primary" style="width: 42px; height: 42px;">
                            <i class="bx bxs-file-pdf fs-4"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold" style="color: #566a7f;">Manual de Certificación</h6>
                            <small class="text-muted d-block" style="font-size: 0.75rem; line-height: 1.2;">Guía rápida del aplicativo</small>
                        </div>
                        <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle shadow-sm" style="width: 32px; height: 32px;">
                            <i class="bx bx-download fs-6"></i>
                        </div>
                    </a>
                </div>


                <!-- KPIs Superiores -->
                <div class="row g-3">
                    <div class="col-12 col-xl-12">
                        <div class="card cert-kpi-card shadow-sm h-100">
                            <div class="card-body d-flex align-items-center gap-3 py-3">
                                <div class="cert-kpi-icon flex-shrink-0" style="background:rgba(0,186,209,0.15);color:#00bad1;">
                                    <i class="bx bx-group"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="cert-kpi-label mb-0" style="font-size: 0.75rem;">Total Aprendices</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h3 class="cert-kpi-value mb-0" id="totalAprendices">—</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="cert-progress-bar mx-3 mb-2 mt-0">
                                <div class="cert-progress-fill bg-info" id="barTotal" style="width:100%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-xl-12">
                        <div class="card cert-kpi-card shadow-sm h-100">
                            <div class="card-body d-flex align-items-center gap-3 py-3">
                                <div class="cert-kpi-icon flex-shrink-0" style="background:rgba(40,199,111,0.15);color:#28c76f;">
                                    <i class="bx bx-trending-up"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <p class="cert-kpi-label mb-0" style="font-size: 0.75rem;">Tasa de Éxito</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h3 class="cert-kpi-value mb-0" id="tasaExito">—</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="cert-progress-bar mx-3 mb-2 mt-0">
                                <div class="cert-progress-fill bg-success" id="barExito" style="width:0%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- IDs ocultos que el script usa para la lógica -->
                    <span id="totalCertificados" style="display:none;"></span>
                    <span id="totalPorCertificar" style="display:none;"></span>
                    <span id="barCertificados" style="display:none;"></span>
                    <span id="barPendientes" style="display:none;"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ================================================================
     Script: actualiza KPIs desde los datos reales de la gráfica
================================================================ -->
<script>
    // Sincroniza los valores de los KPI cards con los de la gráfica
    // tras la carga de la gráfica (cl_graficas.js los popula)
    document.addEventListener('DOMContentLoaded', function () {
        function syncKPIs() {
            const cert   = document.getElementById('totalCertificados');
            const pCert  = document.getElementById('totalPorCertificar');

            // Espera hasta que los valores estén disponibles
            if (!cert || cert.textContent === '—') {
                setTimeout(syncKPIs, 600);
                return;
            }

            const vCert  = parseInt(cert.textContent) || 0;
            const vPCert = parseInt(pCert ? pCert.textContent : 0) || 0;
            const total  = vCert + vPCert;

            // Copia en la zona de leyenda
            const c2 = document.getElementById('totalCertificados2');
            const p2 = document.getElementById('totalPorCertificar2');
            if (c2) c2.textContent = vCert;
            if (p2) p2.textContent = vPCert;

            // Total aprendices
            const tA = document.getElementById('totalAprendices');
            if (tA) tA.textContent = total;

            // Tasa de éxito
            const tE = document.getElementById('tasaExito');
            const pct = total > 0 ? Math.round((vCert / total) * 100) : 0;
            if (tE) tE.textContent = pct + '%';

            // Barras de progreso KPI
            if (total > 0) {
                const bC = document.getElementById('barCertificados');
                const bP = document.getElementById('barPendientes');
                const bE = document.getElementById('barExito');
                if (bC) bC.style.width = Math.round((vCert / total) * 100) + '%';
                if (bP) bP.style.width = Math.round((vPCert / total) * 100) + '%';
                if (bE) bE.style.width = pct + '%';

                // Barras leyenda
                const bL1 = document.getElementById('barLeg1');
                const bL2 = document.getElementById('barLeg2');
                if (bL1) bL1.style.width = Math.round((vCert / total) * 100) + '%';
                if (bL2) bL2.style.width = Math.round((vPCert / total) * 100) + '%';
            }
        }
        setTimeout(syncKPIs, 800);
    });
</script>

<!-- Page JS -->
<script src="assets/js/cl_graficas.js"></script>
<script src="assets/js/dashboards-analytics.js"></script>