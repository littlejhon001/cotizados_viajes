<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
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
        --glass-strong: rgba(255, 255, 255, 0.97);
        --shadow-soft: 0 12px 30px rgba(26, 26, 26, 0.12);
        --shadow-strong: 0 18px 40px rgba(26, 26, 26, 0.18);
    }

    body {
        font-family: 'Manrope', sans-serif;
        color: var(--ink-900);
        background: linear-gradient(180deg, #ffffff 0%, #f7f5ef 100%);
    }

    .contact-hero {
        position: relative;
        overflow: hidden;
        padding: 36px 0 76px;
        background:
            radial-gradient(900px 480px at 12% 10%, rgba(212, 175, 55, 0.18), transparent 58%),
            radial-gradient(700px 400px at 90% 0%, rgba(26, 26, 26, 0.08), transparent 50%),
            linear-gradient(180deg, #ffffff 0%, #f3f1ea 100%);
    }

    .contact-hero::before,
    .contact-hero::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }

    .contact-hero::before {
        width: 320px;
        height: 320px;
        right: -120px;
        top: -120px;
        background: radial-gradient(circle, rgba(212, 175, 55, 0.16), transparent 68%);
    }

    .contact-hero::after {
        width: 260px;
        height: 260px;
        left: -90px;
        bottom: -120px;
        background: radial-gradient(circle, rgba(26, 26, 26, 0.07), transparent 68%);
    }

    .contact-hero-content {
        position: relative;
        z-index: 1;
    }

    .contact-kicker {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 8px 16px;
        border-radius: 999px;
        background: rgba(212, 175, 55, 0.14);
        color: var(--ink-700);
        font-weight: 700;
        font-size: 13px;
        letter-spacing: 0.02em;
    }

    .contact-title {
        font-family: 'Sora', sans-serif;
        font-size: clamp(32px, 4vw, 56px);
        line-height: 1.08;
        font-weight: 800;
        color: var(--ink-900);
        max-width: 10ch;
        margin: 18px auto 0;
    }

    .contact-subtitle {
        max-width: 820px;
        margin: 16px auto 0;
        color: var(--ink-500);
        font-size: clamp(16px, 1.6vw, 19px);
        line-height: 1.6;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 12px;
        margin-top: 28px;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        min-height: 48px;
        padding: 12px 20px;
        border-radius: 999px;
        border: 1px solid transparent;
        font-weight: 700;
        text-decoration: none;
        transition: transform 180ms ease, box-shadow 180ms ease, background 180ms ease, color 180ms ease;
    }

    .action-btn:hover {
        transform: translateY(-1px);
    }

    .action-primary {
        background: var(--accent-500);
        color: var(--ink-900);
        box-shadow: var(--shadow-soft);
    }

    .action-primary:hover {
        background: var(--accent-600);
        color: var(--ink-900);
    }

    .action-secondary {
        background: rgba(26, 26, 26, 0.04);
        color: var(--ink-900);
        border-color: rgba(26, 26, 26, 0.12);
    }

    .contact-shell {
        margin-top: -50px;
        padding-bottom: 56px;
    }

    .contact-panel {
        background: var(--glass-strong);
        border: 1px solid rgba(255, 255, 255, 0.75);
        border-radius: 28px;
        box-shadow: var(--shadow-strong);
        backdrop-filter: blur(14px);
        overflow: hidden;
    }

    .contact-panel-top {
        padding: 28px 28px 8px;
    }

    .panel-title {
        font-family: 'Sora', sans-serif;
        font-size: clamp(24px, 2.4vw, 36px);
        font-weight: 800;
        margin: 0;
        color: var(--ink-900);
    }

    .panel-lead {
        color: var(--ink-500);
        margin-top: 10px;
        margin-bottom: 0;
        line-height: 1.6;
        max-width: 72ch;
    }

    .contact-stat {
        display: flex;
        gap: 14px;
        align-items: flex-start;
        padding: 18px;
        border-radius: 20px;
        background: rgba(26, 26, 26, 0.03);
        border: 1px solid rgba(26, 26, 26, 0.06);
        height: 100%;
    }

    .contact-stat i {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        border-radius: 16px;
        background: rgba(212, 175, 55, 0.16);
        color: var(--ink-900);
        font-size: 1.2rem;
        flex: 0 0 auto;
    }

    .contact-stat h3 {
        margin: 0;
        font-size: 15px;
        font-weight: 800;
        color: var(--ink-900);
    }

    .contact-stat p {
        margin: 4px 0 0;
        color: var(--ink-500);
        line-height: 1.5;
        font-size: 14px;
    }

    .contact-info-card {
        background: linear-gradient(180deg, rgba(212, 175, 55, 0.12), rgba(255, 255, 255, 0.94));
        border: 1px solid rgba(212, 175, 55, 0.2);
        border-radius: 24px;
        padding: 22px;
        box-shadow: var(--shadow-soft);
    }

    .contact-info-card h3,
    .contact-form-card h3,
    .contact-map-card h3,
    .contact-hours-card h3,
    .contact-faq-card h3 {
        font-family: 'Sora', sans-serif;
        font-size: 22px;
        font-weight: 800;
        margin: 0;
        color: var(--ink-900);
    }

    .contact-info-card p,
    .contact-form-card p,
    .contact-map-card p,
    .contact-hours-card p,
    .contact-faq-card p {
        color: var(--ink-500);
    }

    .contact-pill-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 18px;
    }

    .contact-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        border-radius: 999px;
        background: rgba(26, 26, 26, 0.05);
        color: var(--ink-700);
        font-size: 13px;
        font-weight: 700;
    }

    .contact-form-card,
    .contact-map-card,
    .contact-hours-card,
    .contact-faq-card {
        border-radius: 24px;
        background: #fff;
        box-shadow: var(--shadow-soft);
        border: 1px solid rgba(26, 26, 26, 0.08);
    }

    .contact-form-card {
        padding: 24px;
    }

    .contact-map-card,
    .contact-hours-card,
    .contact-faq-card {
        padding: 22px;
    }

    .section-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 12px;
        border-radius: 999px;
        background: rgba(212, 175, 55, 0.12);
        color: var(--ink-700);
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .form-label {
        font-weight: 700;
        color: var(--ink-700);
        margin-bottom: 6px;
    }

    .form-control,
    .form-select {
        min-height: 48px;
        border-radius: 14px;
        border: 1px solid rgba(26, 26, 26, 0.16);
        padding: 12px 14px;
        box-shadow: none;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--accent-500);
        box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.18);
    }

    textarea.form-control {
        min-height: 150px;
        resize: vertical;
    }

    .channel-toggle {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .channel-option {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding: 14px;
        border-radius: 16px;
        border: 1px solid rgba(26, 26, 26, 0.12);
        background: rgba(26, 26, 26, 0.03);
        cursor: pointer;
        min-height: 72px;
    }

    .channel-option input {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
    }

    .channel-option strong {
        color: var(--ink-900);
        font-size: 14px;
    }

    .channel-option span {
        color: var(--ink-500);
        font-size: 12px;
    }

    .channel-option:has(input:checked) {
        border-color: rgba(212, 175, 55, 0.55);
        background: rgba(212, 175, 55, 0.14);
    }

    .submit-row {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
        margin-top: 18px;
    }

    .btn-contact-submit {
        background: var(--accent-500);
        border: 1px solid var(--accent-500);
        color: var(--ink-900);
        border-radius: 999px;
        font-weight: 800;
        padding: 12px 20px;
        min-height: 48px;
    }

    .btn-contact-submit:hover {
        background: var(--accent-600);
        border-color: var(--accent-600);
        color: var(--ink-900);
    }

    .btn-contact-secondary {
        border-radius: 999px;
        font-weight: 800;
        padding: 12px 18px;
        min-height: 48px;
    }

    .list-check {
        list-style: none;
        padding: 0;
        margin: 18px 0 0;
    }

    .list-check li {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        padding: 10px 0;
        border-bottom: 1px dashed rgba(26, 26, 26, 0.12);
        color: var(--ink-700);
    }

    .list-check li:last-child {
        border-bottom: 0;
    }

    .list-check i {
        color: var(--accent-500);
        font-size: 18px;
        margin-top: 2px;
    }

    .contact-map {
        margin-top: 14px;
        border-radius: 18px;
        overflow: hidden;
        background:
            linear-gradient(135deg, rgba(26, 26, 26, 0.84), rgba(26, 26, 26, 0.7)),
            radial-gradient(circle at 20% 20%, rgba(212, 175, 55, 0.2), transparent 34%),
            linear-gradient(135deg, #2b2b2b, #161616);
        min-height: 220px;
        padding: 22px;
        color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .map-embed {
        width: 100%;
        min-height: 220px;
        border: 0;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.04);
    }

    .contact-map small,
    .contact-map p {
        color: rgba(255, 255, 255, 0.84);
        margin: 0;
    }

    .contact-map .map-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        width: fit-content;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(8px);
        font-weight: 700;
    }

    details.faq-item {
        border-top: 1px solid rgba(26, 26, 26, 0.08);
        padding: 14px 0;
    }

    details.faq-item:first-of-type {
        border-top: 0;
        padding-top: 0;
    }

    details.faq-item summary {
        list-style: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        font-weight: 800;
        color: var(--ink-900);
    }

    details.faq-item summary::-webkit-details-marker {
        display: none;
    }

    details.faq-item summary i {
        transition: transform 180ms ease;
    }

    details.faq-item[open] summary i {
        transform: rotate(180deg);
    }

    details.faq-item p {
        margin: 10px 0 0;
        color: var(--ink-500);
        line-height: 1.6;
    }

    .sticky-column {
        position: sticky;
        top: 112px;
    }

    .status-toast {
        display: none;
        margin-top: 14px;
        padding: 12px 14px;
        border-radius: 14px;
        background: rgba(212, 175, 55, 0.14);
        color: var(--ink-700);
        border: 1px solid rgba(212, 175, 55, 0.22);
        font-weight: 700;
    }

    .privacy-copy {
        margin-top: 14px;
        padding: 18px;
        border-radius: 18px;
        background: rgba(26, 26, 26, 0.03);
        border: 1px solid rgba(26, 26, 26, 0.08);
    }

    .privacy-copy summary {
        list-style: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        font-weight: 800;
        color: var(--ink-900);
    }

    .privacy-copy summary::-webkit-details-marker {
        display: none;
    }

    .privacy-copy p {
        margin: 12px 0 0;
        color: var(--ink-500);
        line-height: 1.7;
        font-size: 14px;
        white-space: pre-line;
    }

    @media (max-width: 991.98px) {
        .sticky-column {
            position: static;
        }

        .contact-shell {
            margin-top: -24px;
        }
    }

    @media (max-width: 767.98px) {
        .contact-hero {
            padding-top: 24px;
            padding-bottom: 64px;
        }

        .contact-title {
            max-width: 100%;
        }

        .channel-toggle {
            grid-template-columns: 1fr;
        }
    }
</style>

<section class="contact-hero">
    <div class="container contact-hero-content text-center animate__animated animate__fadeInUp animate__slow">
        <div class="contact-kicker mx-auto">
            <i class="bi bi-chat-dots-fill"></i>
            Hablemos de tu próximo viaje
        </div>
        <h1 class="contact-title animate__animated animate__fadeInUp animate__delay-1s animate__slow">Contacto directo, rápido y claro</h1>
        <p class="contact-subtitle animate__animated animate__fadeInUp animate__delay-1s animate__slow">
            Contacta a <strong>Transdorado Grupo Grems</strong>, NIT <strong>901867890</strong>, por WhatsApp o correo para recibir atención rápida, resolver dudas y solicitar una cotización personalizada de transporte.
            Operamos con atención <strong>24/7</strong> para que tengas una respuesta oportuna cuando la necesites.
        </p>
        <div class="hero-actions animate__animated animate__fadeInUp animate__delay-1s animate__slow">
            <a class="action-btn action-primary" href="https://wa.me/573115966555?text=Hola%2C%20quiero%20recibir%20informaci%C3%B3n%20sobre%20el%20servicio%20de%20transporte" target="_blank" rel="noopener">
                <i class="bi bi-whatsapp"></i>
                Escribir por WhatsApp
            </a>
            <a class="action-btn action-secondary" href="mailto:cotizaciones@transdorado.co">
                <i class="bi bi-envelope"></i>
                Enviar correo
            </a>
        </div>
    </div>
</section>

<div class="container contact-shell">
    <div class="contact-panel p-0">
        <div class="contact-panel-top">
            <div class="row g-3 align-items-stretch">
                <div class="col-lg-4 col-md-6">
                    <div class="contact-stat animate__animated animate__fadeInUp">
                        <i class="bi bi-lightning-charge-fill"></i>
                        <div>
                            <h3>Respuesta ágil</h3>
                            <p>Canales directos para responder rápido sin perder el contexto de tu solicitud.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="contact-stat animate__animated animate__fadeInUp animate__delay-1s">
                        <i class="bi bi-shield-check"></i>
                        <div>
                            <h3>Atención confiable</h3>
                            <p>Información clara, seguimiento y una experiencia ordenada desde el primer mensaje.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="contact-stat animate__animated animate__fadeInUp animate__delay-2s">
                        <i class="bi bi-telephone-fill"></i>
                        <div>
                            <h3>Contacto multimodal</h3>
                            <p>WhatsApp, correo y formulario para adaptar la conversación al canal que te resulte más cómodo.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 px-3 px-lg-4 pb-4 pb-lg-5 pt-2">
            <div class="col-lg-5">
                <div class="sticky-column">
                    <div class="contact-info-card animate__animated animate__fadeInLeft">
                        <span class="section-label mb-3"><i class="bi bi-pin-map-fill"></i> Datos de contacto</span>
                        <h3>Comunícate con Transdorado Grupo Grems</h3>
                        <p class="mt-2 mb-0">Atendemos solicitudes de transporte, cotizaciones y asesoría directa con una experiencia clara, rápida y orientada a respuesta inmediata.</p>

                        <div class="contact-pill-list">
                            <span class="contact-pill"><i class="bi bi-whatsapp"></i> WhatsApp directo</span>
                            <span class="contact-pill"><i class="bi bi-telephone"></i> Llamada inmediata</span>
                            <span class="contact-pill"><i class="bi bi-clock-history"></i> Atención 24/7</span>
                        </div>

                        <ul class="list-check">
                            <li><i class="bi bi-check-circle-fill"></i><span><strong>Teléfono principal:</strong> 311 596 6555</span></li>
                            <li><i class="bi bi-check-circle-fill"></i><span><strong>Teléfono secundario:</strong> 321 313 0355</span></li>
                            <li><i class="bi bi-check-circle-fill"></i><span><strong>Correo:</strong> cotizaciones@transdorado.co</span></li>
                            <li><i class="bi bi-check-circle-fill"></i><span><strong>Razón social:</strong> Transdorado Grupo Grems</span></li>
                            <li><i class="bi bi-check-circle-fill"></i><span><strong>NIT:</strong> 901867890</span></li>
                            <li><i class="bi bi-check-circle-fill"></i><span><strong>Dirección:</strong> Cra. 9 Este #1a-56, Bogotá</span></li>
                            <li><i class="bi bi-check-circle-fill"></i><span><strong>Horario:</strong> Atención 24/7 por WhatsApp y teléfono</span></li>
                        </ul>
                    </div>

                    <div class="contact-hours-card mt-4 animate__animated animate__fadeInLeft animate__delay-1s">
                        <span class="section-label mb-3"><i class="bi bi-calendar2-week-fill"></i> Horarios y tiempos</span>
                        <h3>Atención continua, sin fricción</h3>
                        <p class="mb-3">Escríbenos a cualquier hora. Nuestro canal principal es WhatsApp y siempre puedes usar la llamada directa si necesitas atención más inmediata.</p>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="contact-stat h-100">
                                    <i class="bi bi-stopwatch"></i>
                                    <div>
                                        <h3>Respuesta estimada</h3>
                                        <p>Atención prioritaria durante todo el día.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="contact-stat h-100">
                                    <i class="bi bi-geo-alt"></i>
                                    <div>
                                        <h3>Zona de atención</h3>
                                        <p>Bogotá y rutas personalizadas según solicitud.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="contact-map-card mt-4 animate__animated animate__fadeInLeft animate__delay-2s">
                        <span class="section-label mb-3"><i class="bi bi-map-fill"></i> Punto de referencia</span>
                        <h3>Ubicación de referencia en Bogotá</h3>
                        <div class="contact-map">
                            <div class="map-badge"><i class="bi bi-geo"></i> Cra. 9 Este #1a-56, Bogotá</div>
                            <p class="mt-3">Aquí puedes integrar el mapa oficial de la sede para ayudar a ubicar el punto de atención, la cobertura del servicio o el sitio de encuentro con tus clientes.</p>
                            <iframe
                                class="map-embed"
                                title="Mapa de ubicación de Transdorado Grupo Grems"
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3977.071750723708!2d-74.0716449!3d4.581138500000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f9856b1b09185%3A0x94f7cafa887c7301!2sCra.%209%20Este%20%231a-56%2C%20Bogot%C3%A1!5e0!3m2!1sen!2sco!4v1779903314684!5m2!1sen!2sco"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                allowfullscreen=""></iframe>
                            <small class="mt-3 d-block">Envíame el enlace de Google Maps o el iframe del mapa y lo inserto aquí con la ubicación real.</small>
                        </div>
                    </div>

                    <div class="contact-faq-card mt-4 animate__animated animate__fadeInLeft animate__delay-2s">
                        <span class="section-label mb-3"><i class="bi bi-question-circle-fill"></i> Preguntas frecuentes</span>
                        <details class="faq-item" open>
                            <summary>¿Qué información debo enviar primero? <i class="bi bi-chevron-down"></i></summary>
                            <p>Nombre, teléfono, correo y una breve descripción de lo que necesitas. Si ya tienes fecha o destino, mejor todavía.</p>
                        </details>
                        <details class="faq-item">
                            <summary>¿Puedo pedir una cotización personalizada? <i class="bi bi-chevron-down"></i></summary>
                            <p>Sí. El formulario está pensado para capturar el contexto necesario y luego convertirlo en una cotización más precisa.</p>
                        </details>
                        <details class="faq-item">
                            <summary>¿La respuesta llega por WhatsApp o correo? <i class="bi bi-chevron-down"></i></summary>
                            <p>Ambas opciones quedan disponibles. Puedes elegir el canal que te resulte más cómodo en el formulario.</p>
                        </details>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">
                <div class="contact-form-card animate__animated animate__fadeInRight">
                    <span class="section-label mb-3"><i class="bi bi-send-fill"></i> Formulario de contacto</span>
                    <h3>Solicita tu cotización o asesoría</h3>
                    <p class="mb-4">Completa tus datos y te responderemos por el canal que prefieras. Esta sección está pensada para convertir visitas en contactos reales con una experiencia clara, confiable y enfocada en transporte.</p>

                    <form id="contactForm" novalidate>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre completo</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre">
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Ej. 311 000 0000">
                            </div>
                            <div class="col-md-6">
                                <label for="correo" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="correo@ejemplo.com">
                            </div>
                            <div class="col-md-6">
                                <label for="asunto" class="form-label">Asunto</label>
                                <select class="form-select" id="asunto" name="asunto">
                                    <option selected>Selecciona una opción</option>
                                    <option value="cotizacion">Solicitar cotización</option>
                                    <option value="informacion">Pedir información</option>
                                    <option value="soporte">Soporte o seguimiento</option>
                                    <option value="alianza">Alianza comercial</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label d-block">Canal preferido</label>
                                <div class="channel-toggle">
                                    <label class="channel-option">
                                        <input type="radio" name="canal" value="WhatsApp" checked>
                                        <strong>WhatsApp</strong>
                                        <span>Respuesta rápida y directa.</span>
                                    </label>
                                    <label class="channel-option">
                                        <input type="radio" name="canal" value="Correo electrónico">
                                        <strong>Correo electrónico</strong>
                                        <span>Recibe el detalle en tu bandeja.</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="mensaje" class="form-label">Mensaje</label>
                                <textarea class="form-control" id="mensaje" name="mensaje" placeholder="Cuéntanos tu necesidad con el mayor detalle posible"></textarea>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="politica" required>
                                    <label class="form-check-label" for="politica">
                                        Acepto ser contactado y autorizo el uso de mis datos para responder esta solicitud.
                                    </label>
                                </div>
                                <details class="privacy-copy">
                                    <summary>
                                        Ver política de privacidad y tratamiento de datos
                                        <i class="bi bi-chevron-down"></i>
                                    </summary>
                                    <p>LEY ESTATUTARIA 1581 DE 2012 Artículo 12. Deber de informar al Titular. Apreciado usuario: el sitio web de www.transdorado.co Transporte y Turismo, con sede en Bogotá, Colombia - (en adelante el sitio web) tiene como función principal proveer información y servicios, así como guardar sus datos para ofertas relacionadas con planes y servicio promocionales de transporte y turismo. Por medio del sitio web, www.transdorado.co , entre otros, los temas y actividades que tienen que ver con su misión, visión, objetivos y las funciones que le corresponden. Adicionalmente, por este medio la empresa da a conocer información sobre políticas, planes, programas de turismo; planes y programas; publicaciones; normas; convocatorias; páginas recomendadas; y, en general, información relacionada con transporte, turismo en Colombia y extranjero, Adicionalmente, permite la opción de solicitar trámites en línea y ofrece herramientas de interacción para los usuarios del sitio. Transdorado.co no persigue ningún lucro, ganancia o interés comercial con los contenidos o links que se publican en su sitio web y en las páginas web de otras agencias o entidades adscritas y vinculadas, a los cuales se accede a través del sitio web. www.transdorado.co solicita al usuario de esta página, que lea detallada y juiciosamente estas condiciones de uso (en adelante las condiciones de uso) y la política de privacidad de este sitio web, antes de iniciar su exploración o utilización. Si el usuario no está de acuerdo con estas condiciones de uso o con cualquier disposición del Manual de Seguridad y Privacidad de la Información, le sugerimos que se abstenga de acceder o navegar por el sitio web de nuestra entidad</p>
                                </details>
                            </div>
                        </div>

                        <div class="submit-row">
                            <button type="submit" class="btn btn-contact-submit">
                                <i class="bi bi-whatsapp"></i>
                                Enviar por WhatsApp
                            </button>
                            <a href="mailto:cotizaciones@transdorado.co" class="btn btn-outline-dark btn-contact-secondary">
                                <i class="bi bi-envelope-paper"></i>
                                Copiar correo
                            </a>
                        </div>

                        <div id="contactStatus" class="status-toast" aria-live="polite"></div>
                    </form>
                </div>

                <div class="contact-map-card mt-4 animate__animated animate__fadeInUp animate__delay-1s">
                    <span class="section-label mb-3"><i class="bi bi-stars"></i> Experiencia del usuario</span>
                    <h3>Una página pensada para SEO y conversión</h3>
                    <p class="mb-3">Incluimos lenguaje claro, palabras clave de servicio, datos de contacto visibles y un camino corto hacia WhatsApp para que la página funcione bien en búsquedas y también en la acción del usuario.</p>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="contact-stat h-100">
                                <i class="bi bi-phone"></i>
                                <div>
                                    <h3>Mobile-first</h3>
                                    <p>Se adapta bien a celulares y pantallas pequeñas.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-stat h-100">
                                <i class="bi bi-universal-access"></i>
                                <div>
                                    <h3>Clara y accesible</h3>
                                    <p>Etiquetas visibles, buen contraste y jerarquía limpia.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="contact-stat h-100">
                                <i class="bi bi-heart-fill"></i>
                                <div>
                                    <h3>Más humana</h3>
                                    <p>Prioriza la conversación antes que la fricción del formulario.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        const form = document.getElementById('contactForm');
        const status = document.getElementById('contactStatus');

        function showStatus(message) {
            status.textContent = message;
            status.style.display = 'block';
        }

        if (form) {
            form.addEventListener('submit', function (event) {
                event.preventDefault();

                const nombre = document.getElementById('nombre').value.trim();
                const telefono = document.getElementById('telefono').value.trim();
                const correo = document.getElementById('correo').value.trim();
                const asunto = document.getElementById('asunto').value;
                const mensaje = document.getElementById('mensaje').value.trim();
                const canal = document.querySelector('input[name="canal"]:checked')?.value || 'WhatsApp';
                const politica = document.getElementById('politica').checked;

                if (!politica) {
                    showStatus('Debes aceptar la autorización de contacto para continuar.');
                    return;
                }

                const texto = [
                    'Hola, quisiera recibir información.',
                    nombre ? 'Nombre: ' + nombre : null,
                    telefono ? 'Teléfono: ' + telefono : null,
                    correo ? 'Correo: ' + correo : null,
                    asunto && asunto !== 'Selecciona una opción' ? 'Asunto: ' + asunto : null,
                    canal ? 'Canal preferido: ' + canal : null,
                    mensaje ? 'Mensaje: ' + mensaje : null
                ].filter(Boolean).join('%0A');

                const whatsappUrl = 'https://wa.me/573115966555?text=' + encodeURIComponent(texto);
                showStatus('Abriendo WhatsApp con tu mensaje para enviar la solicitud.');
                window.open(whatsappUrl, '_blank', 'noopener');
            });
        }
    })();
</script>