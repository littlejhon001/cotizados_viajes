<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


<link rel="stylesheet"
    href="https://www.gstatic.com/dialogflow-console/fast/df-messenger/prod/v1/themes/df-messenger-default.css">
<script src="https://www.gstatic.com/dialogflow-console/fast/df-messenger/prod/v1/df-messenger.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



<style>
    @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&display=swap');

    :root {
        --ink-900: #1A1A1A;
        --ink-700: #2b2b2b;
        --ink-500: #555555;
        --accent-500: #D4AF37;
        --accent-600: #b9962f;
        --sun-500: #D4AF37;
        --glass: rgba(255, 255, 255, 0.9);
        --glass-strong: rgba(255, 255, 255, 0.97);
        --shadow-soft: 0 12px 30px rgba(26, 26, 26, 0.12);
        --shadow-strong: 0 18px 40px rgba(26, 26, 26, 0.18);
        --paper-100: #F5F5F5;
    }

    body {
        font-family: 'Manrope', sans-serif;
        color: var(--ink-900);
   
    }





    .hero {
        position: relative;
        padding: 25px 0 72px;
        background:
            radial-gradient(1200px 600px at 10% -20%, rgba(212, 175, 55, 0.22), transparent 60%),
            radial-gradient(900px 420px at 90% 10%, rgba(26, 26, 26, 0.08), transparent 55%),
            linear-gradient(180deg, #FFFFFF 0%, #F5F5F5 100%);
        overflow: hidden;
    }

    .hero::after {
        content: '';
        position: absolute;
        right: -120px;
        bottom: -160px;
        width: 420px;
        height: 420px;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.2), transparent 65%);
        filter: blur(8px);
        z-index: 0;
    }

    .hero-content {
        position: relative;
        z-index: 1;
    }

    .hero-title {
        font-family: 'Sora', sans-serif;
        font-size: clamp(28px, 3vw, 44px);
        font-weight: 700;
        line-height: 1.15;
        color: var(--ink-900);
    }

    .hero-subtitle {
        font-size: clamp(16px, 1.8vw, 20px);
        color: var(--ink-500);
        max-width: 720px;
        margin: 16px auto 28px;
    }

    .hero-cta {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 28px;
        border-radius: 999px;
        background: var(--accent-500);
        color: var(--ink-900);
        font-weight: 600;
        text-decoration: none;
        box-shadow: var(--shadow-soft);
    }

    .hero-cta:hover {
        background: var(--accent-600);
        color: var(--ink-900);
    }

    .input-help {
        font-size: 12px;
        color: var(--ink-500);
        margin-top: 6px;
    }



    #install-banner {
        display: none;
        /* display: flex; */
        position: fixed;
        bottom: 110px;
        transform: translateX(-50%);
        background: #1A1A1A;
        color: #fff;
        padding: 20px 20px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 999;
        left: 7px;

    }

    #install-banner button {
        margin-top: 5px;
        background: #D4AF37;
        border: none;
        padding: 5px 20px;
        color: #1A1A1A;
        cursor: pointer;
        border-radius: 25px;
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 44px !important;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid rgba(26, 26, 26, 0.18);
        border-radius: 12px;
        /* height: 35px; */
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 42px !important;
        padding-left: 12px;
        font-size: 0.95rem;
        font-weight: 500;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #6c7a89;
        font-weight: 500;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 42px !important;
        right: 8px;
    }

    .select2-container--default .select2-selection--single:focus,
    .select2-container--default .select2-selection--single.select2-selection--focus {
        border-color: var(--accent-500);
        box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.2);
    }


    .quote-shell {
        margin-top: -54px;
    }

    .quote-panel {
        background: var(--glass-strong);
        border-radius: 22px;
        box-shadow: var(--shadow-strong);
        border: 1px solid rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(12px);
    }

    .quote-title {
        font-family: 'Sora', sans-serif;
        font-size: clamp(24px, 2.6vw, 34px);
        font-weight: 700;
        color: var(--ink-900);
    }

    .quote-input label,
    .form-panel label,
    .form-panel .form-check-label {
        color: var(--ink-700);
        font-weight: 600;
        font-size: 0.95rem;
    }

    .quote-input .form-label,
    .form-panel .form-label {
        margin-bottom: 6px;
    }

    .quote-card {
        border-radius: 18px;
        box-shadow: var(--shadow-soft);
    }

    .quote-card .card-header {
        background: transparent;
        border-bottom: 1px solid rgba(26, 26, 26, 0.08);
    }

    .summary-item {
        padding: 10px 0;
        border-bottom: 1px dashed rgba(26, 26, 26, 0.12);
    }

    .summary-item i {
        font-size: 18px;
        color: var(--accent-500);
        margin-top: 2px;
    }

    .summary-label {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--ink-700);
        margin: 0;
    }

    .summary-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--ink-900);
        margin: 0;
    }

    .summary-item:last-child {
        border-bottom: none;
    }

    .summary-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 12px;
    }

    .summary-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(212, 175, 55, 0.16);
        color: var(--ink-700);
        font-size: 12px;
        font-weight: 600;
    }

    .form-panel {
        background: #fff;
        border-radius: 18px;
        padding: 24px;
        box-shadow: var(--shadow-soft);
    }

    .form-panel h2 {
        font-family: 'Sora', sans-serif;
        font-size: 22px;
        margin-bottom: 18px;
        color: var(--ink-900);
    }

    .primary-btn {
        background: var(--accent-500);
        border-color: var(--accent-500);
        color: var(--ink-900);
        border-radius: 999px;
        font-weight: 600;
        padding: 10px 22px;
    }

    .primary-btn:hover {
        background: var(--accent-600);
        border-color: var(--accent-600);
    }

    .ghost-btn {
        border-radius: 999px;
        font-weight: 600;
    }

    .btn-whatsapp-gold {
        background: transparent;
        border: 1px solid var(--accent-500);
        color: var(--ink-900);
    }

    .btn-whatsapp-gold:hover {
        background: var(--accent-500);
        color: var(--ink-900);
    }

    .badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 14px;
        background: rgba(212, 175, 55, 0.18);
        color: var(--ink-700);
        border-radius: 999px;
        font-size: 13px;
        font-weight: 600;
    }

    .stepper {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 6px;
    }

    .step-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(26, 26, 26, 0.06);
        color: var(--ink-700);
        font-size: 12px;
        font-weight: 600;
    }

    .form-select,
    .form-control {
        border-radius: 12px;
        border: 1px solid rgba(26, 26, 26, 0.18);
        padding: 10px 12px;
    }

    .form-select:focus,
    .form-control:focus {
        border-color: var(--accent-500);
        box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.2);
    }

    @media (min-width: 992px) {
        .quote-summary {
            position: sticky;
            top: 110px;
        }
    }
</style>


<section class="hero">
    <div class="container hero-content text-center animate__animated animate__fadeInUp animate__slow">
        <div class="badge-pill mx-auto mb-3 animate__animated animate__fadeInUp animate__delay-1s animate__slow">
            <i class="bi bi-stars"></i>
            Cotiza en menos de 1 minuto
        </div>
        <h1 class="hero-title animate__animated animate__fadeInUp animate__delay-1s animate__slow">Tu viaje ideal empieza aqui</h1>
        <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s animate__slow">Selecciona destino, vehiculo y dias. Recibe tu precio al instante y envialo a tu correo si lo deseas.</p>
        <div class="stepper justify-content-center animate__animated animate__fadeInUp animate__delay-1s animate__slow">
            <span class="step-chip"><i class="bi bi-1-circle"></i> Elige destino</span>
            <span class="step-chip"><i class="bi bi-2-circle"></i> Vehiculo</span>
            <span class="step-chip"><i class="bi bi-3-circle"></i> Dias</span>
            <span class="step-chip"><i class="bi bi-4-circle"></i> Recibe precio</span>
        </div>
        <a class="hero-cta mt-3 animate__animated animate__fadeInUp animate__delay-1s animate__slow" href="#cotizacion">
            Cotizar ahora
            <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</section>

<?php
// Nota de Transparencia: Código generado/refactorizado con asistencia de IA Generativa (Claude Code) bajo la Política ODTI012 del CCS. Requiere supervisión y validación humana permanente.
$cq_limpiar = function ($t) {
    return trim(preg_replace('/\s+/u', ' ', (string) $t));
};
$cq_vehiculos = array();
foreach ($vehiculos as $v) {
    $nombre = $cq_limpiar($v->vehiculo);
    // Capacidad a partir del nombre ("8-10 PSJ", "18 A 25 PSJ", "6 PSJ")
    $cap = '';
    if (preg_match('/(\d+)\s*(?:-|A|O)?\s*(\d+)?\s*PSJ/i', $nombre, $m)) {
        $cap = !empty($m[2]) && $m[2] !== $m[1] ? $m[1] . '–' . $m[2] . ' pasajeros' : $m[1] . ' pasajeros';
    }
    $cq_vehiculos[] = array(
        'id' => (int) $v->id,
        'orden' => (int) $v->orden,
        'nombre' => trim(preg_replace('/\s*\d+\s*(?:-|A|O)?\s*\d*\s*PSJ\s*$/i', '', $nombre)) ?: $nombre,
        'capacidad' => $cap,
        'icono' => stripos($nombre, 'SEDAN') !== false ? 'bi-car-front' : 'bi-bus-front',
    );
}
usort($cq_vehiculos, function ($a, $b) {
    return $a['orden'] - $b['orden'];
});
?>
<style>
    /* Cotizador en una sola pantalla. Usa la paleta del sitio (--ink-*, --accent-*) */
    .cq { padding: 0 12px 64px; margin-top: -40px; position: relative; z-index: 2; }
    .cq__grid { max-width: 1180px; margin: 0 auto; display: grid; grid-template-columns: minmax(0, 1fr) 360px; gap: 24px; align-items: start; }
    .cq-card { background: #fff; border-radius: 20px; box-shadow: var(--shadow-soft); padding: 28px; }
    .cq-card + .cq-card { margin-top: 20px; }
    .cq-step { display: flex; align-items: center; gap: 12px; margin: 0 0 14px; }
    .cq-step__n { width: 30px; height: 30px; flex: none; display: grid; place-items: center; border-radius: 50%; font: 700 .85rem 'Sora', sans-serif; color: var(--ink-900); background: var(--paper-100); transition: background .2s, color .2s; }
    .cq-step.is-done .cq-step__n { color: #fff; background: var(--ink-900); }
    .cq-step__t { margin: 0; font: 700 1.1rem 'Sora', sans-serif; color: var(--ink-900); }
    .cq-step__hint { margin-left: auto; font-size: .82rem; color: var(--ink-500); }
    .cq-block + .cq-block { margin-top: 28px; padding-top: 24px; border-top: 1px solid #eee; }
    .cq-muted { color: var(--ink-500); font-size: .9rem; }

    /* Destino (select2) */
    .cq .select2-container { width: 100% !important; }
    .cq .select2-container--default .select2-selection--single { height: 54px; border-radius: 14px; border: 1.5px solid #e2e2e2; display: flex; align-items: center; padding: 0 14px; }
    .cq .select2-container--default .select2-selection--single .select2-selection__rendered { font-weight: 600; font-size: 1rem; color: var(--ink-900); padding-left: 26px; }
    .cq .select2-container--default .select2-selection--single .select2-selection__arrow { height: 52px; right: 10px; }
    .cq .cq-destino { position: relative; }
    .cq .cq-destino > .bi { position: absolute; left: 16px; top: 50%; transform: translateY(-50%); z-index: 2; color: var(--accent-600); pointer-events: none; }
    .select2-dropdown { border-radius: 12px !important; border-color: #e2e2e2 !important; overflow: hidden; }
    .select2-search--dropdown .select2-search__field { border-radius: 8px; padding: 8px 10px; }
    .select2-results__option--highlighted[aria-selected], .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable { background: var(--ink-900) !important; }

    /* Vehículos */
    .cq-veh { display: grid; grid-template-columns: repeat(auto-fill, minmax(190px, 1fr)); gap: 12px; }
    .cq-opt { position: relative; }
    .cq-opt input { position: absolute; opacity: 0; pointer-events: none; }
    .cq-opt label { display: flex; flex-direction: column; gap: 4px; height: 100%; padding: 14px 16px; border: 1.5px solid #e6e6e6; border-radius: 14px; cursor: pointer; transition: border-color .15s, box-shadow .15s, transform .05s; }
    .cq-opt label:hover { border-color: #cfcfcf; }
    .cq-opt input:checked + label { border-color: var(--accent-500); box-shadow: 0 0 0 3px rgba(212, 175, 55, .25); }
    .cq-opt input:focus-visible + label { outline: 3px solid rgba(212, 175, 55, .55); outline-offset: 2px; }
    .cq-opt input:disabled + label { cursor: not-allowed; opacity: .45; background: #fafafa; }
    .cq-veh__icon { font-size: 1.4rem; color: var(--ink-900); }
    .cq-veh__name { font-weight: 700; font-size: .92rem; line-height: 1.25; color: var(--ink-900); }
    .cq-veh__cap { font-size: .8rem; color: var(--ink-500); }
    .cq-veh__price { margin-top: auto; padding-top: 6px; font-size: .82rem; color: var(--ink-500); }
    .cq-veh__price strong { color: var(--ink-900); font-size: .95rem; white-space: nowrap; }

    /* Duración */
    .cq-dias { display: grid; grid-template-columns: repeat(5, minmax(0, 1fr)); gap: 10px; }
    .cq-dias .cq-opt label { align-items: center; text-align: center; padding: 12px 8px; }
    .cq-dias__n { font: 700 1.05rem 'Sora', sans-serif; color: var(--ink-900); }
    .cq-dias__p { font-size: .78rem; color: var(--ink-500); }

    .cq-placeholder { padding: 18px; border: 1.5px dashed #e2e2e2; border-radius: 14px; text-align: center; color: var(--ink-500); font-size: .9rem; }

    /* Datos */
    .cq-form .form-label { font-weight: 600; font-size: .88rem; color: var(--ink-900); margin-bottom: 6px; }
    .cq-form .form-control, .cq-form .form-select { height: 48px; border-radius: 12px; border: 1.5px solid #e2e2e2; }
    .cq-form textarea.form-control { height: auto; }
    .cq-form .form-control:focus { border-color: var(--accent-500); box-shadow: 0 0 0 3px rgba(212, 175, 55, .2); }
    .cq-form .form-control.is-invalid { border-color: #c62828; }
    .cq-more { border: 0; background: none; padding: 0; font-weight: 600; color: var(--ink-900); text-decoration: underline; text-underline-offset: 3px; }
    .cq-extra { display: none; margin-top: 16px; }
    .cq-extra.is-open { display: block; }

    /* Resumen */
    .cq-sum { position: sticky; top: 24px; }
    .cq-sum__title { margin: 0 0 16px; font: 700 1.1rem 'Sora', sans-serif; color: var(--ink-900); }
    .cq-sum__row { display: flex; gap: 12px; align-items: flex-start; padding: 12px 0; border-bottom: 1px dashed #e6e6e6; }
    .cq-sum__row > .bi { color: var(--accent-600); font-size: 1.1rem; margin-top: 2px; }
    .cq-sum__k { font-size: .78rem; color: var(--ink-500); }
    .cq-sum__v { font-weight: 700; color: var(--ink-900); line-height: 1.3; }
    .cq-sum__v.is-empty { font-weight: 500; color: #9a9a9a; }
    .cq-total { display: flex; align-items: baseline; justify-content: space-between; margin: 18px 0 18px; }
    .cq-total__k { font-weight: 600; color: var(--ink-900); }
    .cq-total__v { font: 800 1.9rem 'Sora', sans-serif; color: var(--ink-900); }
    .cq-btn { display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; height: 52px; border-radius: 999px; font-weight: 700; border: 0; transition: background .15s, opacity .15s; text-decoration: none; }
    .cq-btn + .cq-btn { margin-top: 10px; }
    .cq-btn--primary { color: var(--ink-900); background: var(--accent-500); }
    .cq-btn--primary:hover { background: var(--accent-600); color: var(--ink-900); }
    .cq-btn--ghost { color: var(--ink-900); background: #fff; border: 1.5px solid var(--ink-900); }
    .cq-btn--link { height: auto; padding: 10px; color: var(--ink-700); background: none; font-weight: 600; }
    .cq-btn[disabled] { opacity: .45; cursor: not-allowed; }
    .cq-sum__note { margin: 12px 0 0; font-size: .78rem; color: var(--ink-500); text-align: center; }
    .cq-badges { display: flex; flex-wrap: wrap; gap: 8px; margin-top: 16px; justify-content: center; }
    .cq-badges span { font-size: .75rem; font-weight: 600; padding: 5px 10px; border-radius: 999px; background: var(--paper-100); color: var(--ink-700); }

    /* Barra inferior en móvil */
    .cq-bar { display: none; }
    @media (max-width: 991.98px) {
        .cq__grid { grid-template-columns: minmax(0, 1fr); }
        .cq-sum { position: static; }
        .cq-bar { position: fixed; left: 0; right: 0; bottom: 0; z-index: 1030; display: flex; align-items: center; gap: 12px; padding: 12px 16px calc(12px + env(safe-area-inset-bottom)); background: #fff; box-shadow: 0 -8px 24px rgba(26, 26, 26, .12); transform: translateY(110%); transition: transform .25s; }
        .cq-bar.is-visible { transform: none; }
        .cq-bar__k { font-size: .75rem; color: var(--ink-500); }
        .cq-bar__v { font: 800 1.2rem 'Sora', sans-serif; color: var(--ink-900); }
        .cq-bar .cq-btn { width: auto; flex: 1; height: 46px; }
    }
    @media (max-width: 575.98px) {
        .cq-card { padding: 20px 16px; border-radius: 16px; }
        .cq-veh { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
        .cq-dias { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .cq-step__hint { display: none; }
    }
    @media (prefers-reduced-motion: reduce) { .cq *, .cq-bar { transition: none !important; } }
</style>

<section class="cq" id="cotizacion" aria-labelledby="cqTitulo">
    <h2 id="cqTitulo" class="visually-hidden">Cotiza tu viaje</h2>
    <form id="formCotizacion" class="cq__grid" action="<?php echo IP_SERVER ?>home/imprimir" method="POST" novalidate>
        <div>
            <div class="cq-card">
                <!-- 1. Destino -->
                <div class="cq-block">
                    <div class="cq-step" id="stepDestino"><span class="cq-step__n">1</span><h3 class="cq-step__t">¿A dónde vas?</h3></div>
                    <label for="trayecto" class="visually-hidden">Destino</label>
                    <div class="cq-destino">
                        <i class="bi bi-geo-alt-fill" aria-hidden="true"></i>
                        <select id="trayecto" name="id_destino" required>
                            <option value=""></option>
                            <?php foreach ($destinos as $destino) { ?>
                                <option value="<?php echo (int) $destino->id ?>"><?php echo html_escape($cq_limpiar($destino->destino)) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <!-- 2. Vehículo -->
                <div class="cq-block">
                    <div class="cq-step" id="stepVehiculo"><span class="cq-step__n">2</span><h3 class="cq-step__t">Elige tu vehículo</h3><span class="cq-step__hint">Precio desde, según la duración</span></div>
                    <div id="vehiculos" class="cq-veh" role="radiogroup" aria-labelledby="stepVehiculo" hidden>
                        <?php foreach ($cq_vehiculos as $v) { ?>
                            <div class="cq-opt">
                                <input type="radio" name="id_vehiculo" id="veh<?php echo $v['id'] ?>" value="<?php echo $v['id'] ?>" disabled>
                                <label for="veh<?php echo $v['id'] ?>">
                                    <i class="bi <?php echo $v['icono'] ?> cq-veh__icon" aria-hidden="true"></i>
                                    <span class="cq-veh__name"><?php echo html_escape(mb_convert_case(mb_strtolower($v['nombre']), MB_CASE_TITLE, 'UTF-8')) ?></span>
                                    <?php if ($v['capacidad']) { ?><span class="cq-veh__cap"><i class="bi bi-people" aria-hidden="true"></i> <?php echo $v['capacidad'] ?></span><?php } ?>
                                    <span class="cq-veh__price" data-precio>—</span>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="cq-placeholder" id="vehiculosVacio">Primero elige un destino para ver los vehículos disponibles.</div>
                </div>

                <!-- 3. Duración -->
                <div class="cq-block">
                    <div class="cq-step" id="stepDias"><span class="cq-step__n">3</span><h3 class="cq-step__t">¿Cuántos días?</h3></div>
                    <div id="dias" class="cq-dias" role="radiogroup" aria-labelledby="stepDias" hidden>
                        <?php foreach (array(1, 2, 3, 5, 8) as $d) { ?>
                            <div class="cq-opt">
                                <input type="radio" name="dia" id="dia<?php echo $d ?>" value="<?php echo $d ?>" disabled>
                                <label for="dia<?php echo $d ?>">
                                    <span class="cq-dias__n"><?php echo $d ?> <?php echo $d === 1 ? 'día' : 'días' ?></span>
                                    <span class="cq-dias__p" data-precio>—</span>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="cq-placeholder" id="diasVacio">Elige un vehículo para ver la tarifa por duración.</div>
                </div>
            </div>

            <!-- 4. Datos -->
            <div class="cq-card cq-form">
                <div class="cq-step" id="stepDatos"><span class="cq-step__n">4</span><h3 class="cq-step__t">Tus datos</h3><span class="cq-step__hint">Te enviamos la cotización</span></div>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input class="form-control" id="nombre" name="nombre" maxlength="60" autocomplete="given-name" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="apellidos">Apellidos</label>
                        <input class="form-control" id="apellidos" name="apellidos" maxlength="60" autocomplete="family-name" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="telefono">Celular</label>
                        <input class="form-control" id="telefono" name="telefono" type="tel" inputmode="tel" maxlength="20" autocomplete="tel" placeholder="300 123 4567" required>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label" for="correo">Correo</label>
                        <input class="form-control" id="correo" name="correo" type="email" maxlength="150" autocomplete="email" placeholder="tu@correo.com" required>
                    </div>
                </div>

                <div class="mt-3">
                    <button type="button" class="cq-more" id="btnMas" aria-expanded="false" aria-controls="cqExtra">
                        <i class="bi bi-plus-circle" aria-hidden="true"></i> Agregar detalles del servicio (opcional)
                    </button>
                    <input type="hidden" name="more_info" id="more_info" value="0">
                    <div class="cq-extra" id="cqExtra">
                        <div class="row g-3">
                            <div class="col-sm-8">
                                <label class="form-label" for="direccion">Dirección de recogida</label>
                                <input class="form-control" id="direccion" name="direccion" maxlength="200" autocomplete="street-address">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label" for="hora">Hora</label>
                                <input class="form-control" id="hora" name="hora" type="time">
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="mascotas" name="mascotas" value="1">
                                    <label class="form-check-label" for="mascotas">Viajo con mascota</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="comentarios">Comentarios</label>
                                <textarea class="form-control" id="comentarios" name="comentarios" rows="3" maxlength="255" placeholder="Paradas, equipaje especial, horarios de regreso…"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-check mt-4">
                    <input class="form-check-input" type="checkbox" id="politicas" name="politicas" required>
                    <label class="form-check-label" for="politicas">Acepto la política de tratamiento de datos personales</label>
                </div>

                <!-- Campo trampa para bots: las personas no lo ven ni lo llenan -->
                <div aria-hidden="true" style="position:absolute;left:-10000px;top:auto;width:1px;height:1px;overflow:hidden;">
                    <label for="website">No llenar este campo</label>
                    <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
                </div>
            </div>
        </div>

        <!-- Resumen -->
        <aside class="cq-card cq-sum" aria-labelledby="cqResumen">
            <h3 class="cq-sum__title" id="cqResumen">Tu cotización</h3>
            <div class="cq-sum__row"><i class="bi bi-geo-alt" aria-hidden="true"></i><div><div class="cq-sum__k">Destino</div><div class="cq-sum__v is-empty" id="sDestino">Sin elegir</div></div></div>
            <div class="cq-sum__row"><i class="bi bi-bus-front" aria-hidden="true"></i><div><div class="cq-sum__k">Vehículo</div><div class="cq-sum__v is-empty" id="sVehiculo">Sin elegir</div></div></div>
            <div class="cq-sum__row"><i class="bi bi-calendar3" aria-hidden="true"></i><div><div class="cq-sum__k">Duración</div><div class="cq-sum__v is-empty" id="sDias">Sin elegir</div></div></div>
            <div class="cq-total"><span class="cq-total__k">Total</span><span class="cq-total__v" id="sTotal" aria-live="polite">$ 0</span></div>

            <button type="button" class="cq-btn cq-btn--primary" id="btnEnviar" disabled><i class="bi bi-envelope" aria-hidden="true"></i> Enviar a mi correo</button>
            <button type="button" class="cq-btn cq-btn--ghost" id="btnPdf" disabled><i class="bi bi-file-earmark-pdf" aria-hidden="true"></i> Descargar PDF</button>
            <a class="cq-btn cq-btn--link" href="https://wa.link/9bwsji" target="_blank" rel="noopener"><i class="bi bi-whatsapp" aria-hidden="true"></i> Hablar con un asesor</a>
            <p class="cq-sum__note" id="sNota">Elige destino, vehículo y duración para ver tu precio.</p>
            <div class="cq-badges"><span><i class="bi bi-lightning" aria-hidden="true"></i> Precio al instante</span><span><i class="bi bi-shield-check" aria-hidden="true"></i> Datos seguros</span></div>
        </aside>
    </form>
</section>

<!-- Barra inferior en móvil -->
<div class="cq-bar" id="cqBar" aria-hidden="true">
    <div><div class="cq-bar__k">Total</div><div class="cq-bar__v" id="barTotal">$ 0</div></div>
    <button type="button" class="cq-btn cq-btn--primary" id="barIr">Continuar</button>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    (function () {
        // Más abajo se carga jQuery 1.11 y reemplaza a window.$; se guarda la instancia con select2
        var jq = window.jQuery;
        var BASE = '<?php echo IP_SERVER ?>';
        var form = document.getElementById('formCotizacion');
        var tarifas = {};
        var cop = function (n) { return '$ ' + Math.round(n || 0).toLocaleString('es-CO'); };
        var $id = function (id) { return document.getElementById(id); };
        var radios = function (name) { return Array.prototype.slice.call(form.querySelectorAll('input[name="' + name + '"]')); };
        var valor = function (name) { var r = form.querySelector('input[name="' + name + '"]:checked'); return r ? r.value : ''; };
        var etiqueta = function (input) { return input.nextElementSibling.querySelector('.cq-veh__name, .cq-dias__n').textContent.trim(); };

        function aviso(titulo, texto, icono) {
            if (window.Swal) { Swal.fire({ title: titulo, text: texto, icon: icono || 'error', confirmButtonText: 'Aceptar', confirmButtonColor: '#1A1A1A' }); }
            else { alert(titulo + '\n' + texto); }
        }

        function setResumen(id, texto) {
            var el = $id(id);
            el.textContent = texto || 'Sin elegir';
            el.classList.toggle('is-empty', !texto);
        }

        function precioActual() {
            var v = valor('id_vehiculo'), d = valor('dia');
            return v && d && tarifas[v] ? (tarifas[v][d] || 0) : 0;
        }

        function actualizar() {
            var destinoTxt = jq('#trayecto').val() ? jq('#trayecto option:selected').text() : '';
            var vehInput = form.querySelector('input[name="id_vehiculo"]:checked');
            var diaInput = form.querySelector('input[name="dia"]:checked');
            var total = precioActual();

            setResumen('sDestino', destinoTxt);
            setResumen('sVehiculo', vehInput ? etiqueta(vehInput) : '');
            setResumen('sDias', diaInput ? etiqueta(diaInput) : '');
            $id('sTotal').textContent = cop(total);
            $id('barTotal').textContent = cop(total);
            $id('btnEnviar').disabled = $id('btnPdf').disabled = total <= 0;
            $id('sNota').textContent = total > 0 ? 'Completa tus datos y recibe la cotización en tu correo.'
                : 'Elige destino, vehículo y duración para ver tu precio.';
            $id('cqBar').classList.toggle('is-visible', total > 0);
            $id('stepDestino').classList.toggle('is-done', !!destinoTxt);
            $id('stepVehiculo').classList.toggle('is-done', !!vehInput);
            $id('stepDias').classList.toggle('is-done', !!diaInput);
        }

        // Vehículos: habilita solo los que tienen tarifa en el destino y muestra "desde"
        function pintarVehiculos() {
            var hay = false;
            radios('id_vehiculo').forEach(function (r) {
                var precios = tarifas[r.value] ? Object.keys(tarifas[r.value]).map(function (k) { return tarifas[r.value][k]; }) : [];
                var min = precios.length ? Math.min.apply(null, precios) : 0;
                r.disabled = !min;
                r.checked = r.checked && !!min;
                r.nextElementSibling.querySelector('[data-precio]').innerHTML = min ? 'desde <strong>' + cop(min) + '</strong>' : 'No disponible';
                hay = hay || !!min;
            });
            $id('vehiculos').hidden = !hay;
            $id('vehiculosVacio').hidden = hay;
            $id('vehiculosVacio').textContent = hay ? '' : 'No tenemos vehículos con tarifa para este destino. Escríbenos y te ayudamos.';
            pintarDias();
        }

        // Duraciones: precio por opción para el vehículo elegido
        function pintarDias() {
            var v = valor('id_vehiculo');
            radios('dia').forEach(function (r) {
                var p = v && tarifas[v] ? tarifas[v][r.value] : 0;
                r.disabled = !p;
                if (!p) { r.checked = false; }
                r.nextElementSibling.querySelector('[data-precio]').textContent = p ? cop(p) : 'No disponible';
            });
            $id('dias').hidden = !v;
            $id('diasVacio').hidden = !!v;
            // Si solo hay una duración posible, se elige sola
            var disponibles = radios('dia').filter(function (r) { return !r.disabled; });
            if (v && disponibles.length === 1) { disponibles[0].checked = true; }
            actualizar();
        }

        function cargarTarifas(idDestino) {
            tarifas = {};
            radios('id_vehiculo').concat(radios('dia')).forEach(function (r) { r.checked = false; });
            $id('vehiculos').hidden = true;
            $id('dias').hidden = true;
            $id('diasVacio').hidden = false;
            $id('vehiculosVacio').hidden = false;
            $id('vehiculosVacio').textContent = idDestino ? 'Buscando vehículos disponibles…' : 'Primero elige un destino para ver los vehículos disponibles.';
            actualizar();
            if (!idDestino) { return; }
            fetch(BASE + 'Home/tarifas_destino?id_destino=' + encodeURIComponent(idDestino), { credentials: 'same-origin' })
                .then(function (r) { if (!r.ok) { throw new Error(); } return r.json(); })
                .then(function (data) { tarifas = data || {}; pintarVehiculos(); })
                .catch(function () {
                    $id('vehiculosVacio').textContent = 'No pudimos cargar las tarifas. Intenta de nuevo en unos segundos.';
                });
        }

        jq('#trayecto').select2({
            placeholder: 'Busca tu destino',
            width: '100%',
            language: {
                noResults: function () { return 'No encontramos ese destino'; },
                searching: function () { return 'Buscando…'; }
            }
        }).on('change', function () { cargarTarifas(this.value); });

        form.addEventListener('change', function (e) {
            if (e.target.name === 'id_vehiculo') { pintarDias(); }
            else if (e.target.name === 'dia') { actualizar(); }
        });

        $id('btnMas').addEventListener('click', function () {
            var abierto = $id('cqExtra').classList.toggle('is-open');
            this.setAttribute('aria-expanded', String(abierto));
            $id('more_info').value = abierto ? '1' : '0';
            if (abierto) { $id('direccion').focus(); }
        });

        $id('barIr').addEventListener('click', function () {
            var faltante = validar(true);
            (faltante || $id('btnEnviar')).scrollIntoView({ behavior: 'smooth', block: 'center' });
            if (faltante) { faltante.focus({ preventScroll: true }); }
        });

        // Devuelve el primer campo inválido (o null) y lo marca
        function validar(silencioso) {
            var campos = ['nombre', 'apellidos', 'telefono', 'correo'].map($id);
            var malo = null;
            campos.forEach(function (c) {
                var ok = c.value.trim() !== '' && c.checkValidity() && (c.id !== 'telefono' || c.value.replace(/\D/g, '').length >= 7);
                c.classList.toggle('is-invalid', !ok && !silencioso);
                if (!ok && !malo) { malo = c; }
            });
            if (!malo && !$id('politicas').checked) { malo = $id('politicas'); }
            return malo;
        }
        ['nombre', 'apellidos', 'telefono', 'correo'].forEach(function (id) {
            $id(id).addEventListener('input', function () { this.classList.remove('is-invalid'); });
        });

        function listo() {
            if (precioActual() <= 0) { aviso('Elige tu viaje', 'Selecciona destino, vehículo y duración.'); return false; }
            var malo = validar(false);
            if (malo) {
                malo.scrollIntoView({ behavior: 'smooth', block: 'center' });
                malo.focus({ preventScroll: true });
                aviso('Faltan datos', malo.id === 'politicas' ? 'Debes aceptar la política de tratamiento de datos.' : 'Revisa los campos marcados.');
                return false;
            }
            return true;
        }

        function ocupado(btn, on, texto) {
            if (on) { btn.dataset.html = btn.innerHTML; btn.disabled = true; btn.textContent = texto; }
            else { btn.innerHTML = btn.dataset.html; btn.disabled = precioActual() <= 0; }
        }

        $id('btnEnviar').addEventListener('click', function () {
            if (!listo()) { return; }
            var btn = this;
            ocupado(btn, true, 'Enviando…');
            fetch(BASE + 'home/enviar_cotizacion', { method: 'POST', body: new FormData(form), credentials: 'same-origin' })
                .then(function (r) { return r.json().catch(function () { return {}; }); })
                .then(function (r) {
                    if (r.status === 'success') { aviso('¡Listo!', r.message || 'Te enviamos la cotización a tu correo.', 'success'); }
                    else { aviso('No pudimos enviar tu cotización', r.message || 'Intenta de nuevo en unos segundos.'); }
                })
                .catch(function () { aviso('Error de conexión', 'No pudimos conectar con el servidor. Intenta de nuevo.'); })
                .then(function () { ocupado(btn, false); });
        });

        $id('btnPdf').addEventListener('click', function () {
            if (!listo()) { return; }
            var btn = this;
            ocupado(btn, true, 'Generando PDF…');
            fetch(form.action, { method: 'POST', body: new FormData(form), credentials: 'same-origin' })
                .then(function (res) {
                    if ((res.headers.get('Content-Type') || '').indexOf('application/pdf') === -1) {
                        return res.json().then(function (j) { throw new Error((j && j.message) || 'No pudimos generar el PDF.'); });
                    }
                    return res.blob();
                })
                .then(function (blob) {
                    var a = document.createElement('a');
                    a.href = URL.createObjectURL(blob);
                    a.download = 'cotizacion_transdorado.pdf';
                    document.body.appendChild(a);
                    a.click();
                    setTimeout(function () { URL.revokeObjectURL(a.href); a.remove(); }, 1000);
                })
                .catch(function (err) { aviso('Revisa tus datos', err.message || 'No pudimos generar el PDF.'); })
                .then(function () { ocupado(btn, false); });
        });

        actualizar();
    })();
</script>

<!-- <div id="install-banner" class="animate__animated animate__fadeInLeft text-center">
    <span>Instala nuestra aplicación para una mejor experiencia.</span>
    <div>
        <button onclick="installPWA()">Instalar</button>
        <button class="bg-danger" onclick="cerrar()">No gracias</button>
    </div>
</div> -->

<!-- <div class="btn-whatsapp animate__animated animate__fadeInUp ">
    <a href="#" target="_blank">
        <lord-icon src="https://cdn.lordicon.com/fjuachvi.json" trigger="hover" style="width:40px;height:40px">
        </lord-icon>
        <span class="tooltip">Contáctame</span>
    </a>
</div> -->

<script src="https://cdn.lordicon.com/lordicon.js"></script>


<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- michal snick js  -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- slick_jquery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>

<!-- slick_js -->
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


<!-- link js bostrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>

<script>
    AOS.init();
</script>