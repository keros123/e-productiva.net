<style>
    /* ============================================
       INICIO (ADMIN) - DASHBOARD ESTILOS
    ============================================ */

    /* Hero */
    .dash-hero {
        background: linear-gradient(135deg, #696cff 0%, #567bfb 40%, #9155fd 100%);
        border-radius: 14px;
        overflow: hidden;
        position: relative;
        border: none;
    }
    .dash-hero::before {
        content: '';
        position: absolute;
        top: -50px; right: -50px;
        width: 180px; height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,0.07);
        pointer-events: none;
    }

    /* KPI cards */
    .dash-kpi-card {
        border: none;
        border-radius: 14px;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        overflow: hidden;
    }
    .dash-kpi-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.12) !important;
    }
    .dash-kpi-icon {
        width: 52px;
        height: 52px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    .dash-kpi-value {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
        color: #566a7f;
    }
    .dash-kpi-label {
        font-size: 0.75rem;
        color: #a8aab7;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }
    .dash-progress-bar {
        height: 5px;
        border-radius: 3px;
        background: #e8e8ea;
        overflow: hidden;
        margin-top: 8px;
    }
    .dash-progress-fill {
        height: 100%;
        border-radius: 3px;
        animation: dashGrow 1s ease forwards;
    }
    @keyframes dashGrow { from { width: 0%; } }

    /* Chart cards */
    .dash-chart-card {
        border: none;
        border-radius: 14px;
    }

    /* Section label */
    .dash-section-label {
        font-size: 0.73rem;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: #696cff;
        margin-bottom: 0.4rem;
    }

    /* CSV card */
    .dash-csv-link {
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.85rem 1rem;
        border-radius: 10px;
        transition: background 0.2s ease;
    }
    .dash-csv-link:hover {
        background: rgba(40, 199, 111, 0.06);
        color: inherit;
    }
</style>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- ===== HERO BANNER COMPACTO ===== -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card dash-hero shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3 py-3 px-4" style="position:relative;z-index:1;">
                        <div class="d-flex align-items-center justify-content-center rounded flex-shrink-0"
                             style="width:50px;height:50px;background:rgba(255,255,255,0.2);">
                            <i class="bx bx-bar-chart-alt-2 text-white" style="font-size:1.8rem;"></i>
                        </div>
                        <div class="flex-grow-1 text-white">
                            <h5 class="mb-1 fw-bold text-white">Panel de Control — SGD CIMM</h5>
                            <p class="mb-0 d-none d-md-block" style="font-size:0.85rem;opacity:0.9;">
                                Monitorea el estado de los seguimientos y la actividad de los aprendices en tiempo real.
                            </p>
                        </div>
                        <div class="d-none d-lg-flex align-items-center gap-4 text-white" style="opacity:0.85;font-size:0.82rem;">
                            <span><i class="bx bx-check-circle me-1"></i>Seguimientos realizados</span>
                            <span><i class="bx bx-time me-1"></i>Pendientes</span>
                            <span><i class="bx bx-trending-up me-1"></i>Estadísticas por año</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== KPI CARDS ===== -->
        <div class="row g-3 mb-4">

            <!-- Realizados -->
            <div class="col-12 col-md-4">
                <div class="card dash-kpi-card shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3 py-3">
                        <div class="dash-kpi-icon" style="background:rgba(105,108,255,0.15);color:#696cff;">
                            <i class="bx bxs-checkbox-checked"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="dash-kpi-label mb-1">Realizados</p>
                            <h3 class="dash-kpi-value mb-0" id="totalRealizados">—</h3>
                        </div>
                    </div>
                    <div class="dash-progress-bar mx-3 mb-2">
                        <div class="dash-progress-fill" id="barRealizados" style="background:#696cff;width:0%;"></div>
                    </div>
                </div>
            </div>

            <!-- Vencidos -->
            <div class="col-12 col-md-4">
                <div class="card dash-kpi-card shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3 py-3">
                        <div class="dash-kpi-icon" style="background:rgba(255,77,77,0.15);color:#ff4d4d;">
                            <i class="bx bx-error-circle"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="dash-kpi-label mb-1">Vencidos</p>
                            <h3 class="dash-kpi-value mb-0" id="totalVencidos">—</h3>
                        </div>
                    </div>
                    <div class="dash-progress-bar mx-3 mb-2">
                        <div class="dash-progress-fill" id="barVencidos" style="background:#ff4d4d;width:0%;"></div>
                    </div>
                </div>
            </div>

            <!-- Pendientes -->
            <div class="col-12 col-md-4">
                <div class="card dash-kpi-card shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3 py-3">
                        <div class="dash-kpi-icon" style="background:rgba(0,186,209,0.15);color:#00bad1;">
                            <i class="bx bxs-time-five"></i>
                        </div>
                        <div class="flex-grow-1">
                            <p class="dash-kpi-label mb-1">Pendientes</p>
                            <h3 class="dash-kpi-value mb-0" id="totalPendientes">—</h3>
                        </div>
                    </div>
                    <div class="dash-progress-bar mx-3 mb-2">
                        <div class="dash-progress-fill" id="barPendientes" style="background:#00bad1;width:0%;"></div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ===== GRÁFICAS ===== -->
        <div class="row g-4 mb-4">

            <!-- Gráfica de barras: Resumen Mensual -->
            <div class="col-12 col-lg-7">
                <div class="card dash-chart-card shadow-sm h-100">
                    <div class="card-header border-0 pb-0">
                        <p class="dash-section-label mb-1">Actividad mensual</p>
                        <h5 class="fw-bold mb-0" style="color:#435971;">Resumen Mensual de Seguimientos</h5>
                    </div>
                    <div class="card-body pt-2">
                        <div id="totalRevenueChart" class="px-1"></div>
                    </div>
                </div>
            </div>

            <!-- Gráfica circular: Resumen General -->
            <div class="col-12 col-lg-5">
                <div class="card dash-chart-card shadow-sm h-100">
                    <div class="card-header border-0 pb-0">
                        <p class="dash-section-label mb-1">Distribución</p>
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold mb-0" style="color:#435971;">Resumen General</h5>
                            <select name="selectYear" id="selectYear" class="form-select form-select-sm border-primary" style="width:auto;">
                            </select>
                        </div>
                        <small class="text-muted" style="font-size:0.8rem;">
                            Seguimientos programados —
                            <script>document.write(new Date().getFullYear());</script>
                        </small>
                    </div>
                    <div class="card-body d-flex flex-column align-items-center justify-content-center pt-2">
                        <div id="orderStatisticsChart"></div>
                    </div>
                </div>
            </div>

        </div>

        <!-- ===== ARCHIVO PLANO CSV ===== -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm border-0 rounded-3">
                    <a href="vista/recursos/etapaPractica.csv" target="_blank" class="dash-csv-link">
                        <div class="d-flex align-items-center justify-content-center rounded flex-shrink-0"
                             style="width:46px;height:46px;background:rgba(40,199,111,0.12);">
                            <i class="bx bx-spreadsheet" style="font-size:1.5rem;color:#28c76f;"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold" style="color:#566a7f;">Archivo plano — Registro masivo Etapa Práctica</h6>
                            <small class="text-muted" style="font-size:0.78rem;">
                                Archivo de ejemplo para cargar información de aprendices de forma masiva (.csv)
                            </small>
                        </div>
                        <div class="d-flex align-items-center justify-content-center rounded-circle shadow-sm flex-shrink-0"
                             style="width:34px;height:34px;background:#28c76f;">
                            <i class="bx bx-download text-white" style="font-size:1rem;"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Page JS -->
<script src="assets/js/dashboards-analytics.js"></script>