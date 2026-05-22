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

<div class="container-fluid quote-shell" id="cotizacion">
    <div class="container quote-panel p-4 p-lg-5 animate__animated animate__fadeInUp animate__slow">
        <div class="row rounded-2 py-3 g-4 align-items-start">
            <div class="col-12">
                <h2 class="quote-title">Tenemos el viaje ideal para ti</h2>
            </div>
            <div class="col-md-6 col-12 quote-input">
                <label for="trayecto" class="form-label">Destino</label>
                <select class="form-select" id="trayecto" name="trayecto">
                    <option value="" disabled selected>Seleccione un destino</option>
                    <?php foreach ($destinos as $destino) { ?>
                        <option value="<?php echo $destino->id; ?>">
                            <?php echo $destino->destino ?>
                        </option>
                    <?php } ?>
                </select>
                <div class="input-help">Ejemplo: Bogota - Cartagena</div>
            </div>
            <div class="col-md-4 col-12 quote-input">
                <label for="vehiculo" class="form-label">Vehiculo</label>
                <select class="form-select" id="vehiculo" name="vehiculo">
                    <option value="" disabled selected>Seleccione un Vehiculo</option>
                    <?php foreach ($vehiculos as $vehiculo) { ?>
                        <option value="<?php echo $vehiculo->id ?>">
                            <?php echo $vehiculo->vehiculo ?>
                        </option>
                    <?php } ?>
                </select>
                <div class="input-help">El precio cambia segun el vehiculo</div>
            </div>
            <div class="col-md-2 col-12 quote-input">
                <label for="dia" class="form-label">Dias</label>
                <select class="form-select" id="dia" name="dia">
                    <option value="" disabled selected>Seleccione</option>
                    <option value="1">1 Dia</option>
                    <option value="2">2 Dias</option>
                    <option value="3">3 Dias</option>
                    <option value="5">5 Dias</option>
                    <option value="8">8 Dias</option>
                </select>
                <div class="input-help">Escoge la duracion del servicio</div>
            </div>
        </div>
        <div class="container d-flex justify-content-center">
            <div class="spinner-border text-success d-none" id="loader" role="status" aria-live="polite" aria-label="Calculando precio">
                <span class="visually-hidden">Calculando...</span>
            </div>
        </div>
        <div class="pb-4">
            <div class="row g-4">
                <div class="col-md-6 col-12 quote-summary">
                    <div class="card border-0 bg-white mt-2 quote-card animate__animated animate__fadeInUp animate__slow" style="width:auto;">
                        <div class="card-header border-0">
                            <h2>
                                Cotización de tu viaje ideal
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-column flex-md-row summary-item">
                                <i class="bi bi-geo-alt fs-5 text-danger me-2"></i>
                                <h3 class="summary-label">Destino o trayecto:</h3>
                                <h3 class="summary-value ms-auto" id="destino">Seleccione</h3>
                            </div>
                            <div class="d-flex flex-column flex-md-row summary-item">
                                <i class="bi bi-car-front-fill me-2 fs-5"></i>
                                <h4 class="summary-label">Vehiculo:</h4>
                                <h4 class="summary-value ms-auto" id="vehiculo_seleccionado">Seleccione</h4>
                            </div>
                            <div class="d-flex flex-column flex-md-row summary-item">
                                <i class="bi bi-cash fs-5 me-2"></i>
                                <h4 class="summary-label">Precio total:</h4>
                                <h4 class="summary-value ms-auto" id="precio" aria-live="polite">0$</h4>
                            </div>
                            <div class="summary-badges">
                                <span class="summary-badge"><i class="bi bi-lightning"></i> Precio al instante</span>
                                <span class="summary-badge"><i class="bi bi-shield-check"></i> Datos seguros</span>
                            </div>
                        </div>
                        <div class="card-footer border-0 ">
                            <p class="input-help mb-2">Te tomara menos de 2 minutos completar la solicitud.</p>
                            <div class="d-flex justify-content-end flex-column flex-md-row">
                                <button
                                    class="btn primary-btn mb-2 mb-md-0 d-none animate__animated animate__pulse animate__infinite "
                                    id="enviar_correo1">
                                    Enviar esta cotización a mi
                                    correo
                                    <i class="bi bi-envelope"></i>
                                </button>
                                <a href="https://wa.link/9bwsji" target="_blank" class="ms-3 btn ghost-btn btn-whatsapp-gold">Contactar
                                    con un agente
                                    <i class="bi bi-whatsapp"></i></a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="form-panel animate__animated animate__fadeInRight" id="formulario"
                        style="display:none;">
                        <h2>
                            Recibirás esta cotización en tu correo electrónico.
                        </h2>
                        <form id="formCotizacion" action="<?php echo IP_SERVER ?>home/imprimir" method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required maxlength="20">
                            </div>
                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="number" class="form-control" id="telefono" name="telefono" required>
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                                <div class="input-help">Enviaremos tu cotización y nada mas.</div>
                            </div>
                            <div class="mb-3 px-3 bg-light rounded-3">
                                <input type="checkbox" name="more_info" class="form-check-input" id="more-info" style="border:gray;">
                                <label for="more-info" class="form-check-label">
                                    <strong>
                                        Deseas agregar mas información a tu cotización
                                    </strong>
                                </label>
                            </div>
                            <div class="mb-3 d-none animate__animated animate__fadeIn informacion-adicional">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-5">
                                            <label for="" class="form-label">Dirección de recogida</label>
                                            <input type="text" class="form-control" placeholder="Ingresa tu dirección"
                                                value="" name="direccion" id="direccion">
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label for="" class="form-label">Hora de recogida</label>
                                            <input type="time" class="form-control" placeholder="Hora de recogida"
                                                value="" id="hora" name="hora">
                                        </div>
                                        <div class="col-12 col-md-3  d-flex align-items-center">
                                            <div class="form-check">
                                                <label class="form-check-label" for="mascotas">
                                                    Mascotas ?
                                                </label>
                                                <input class="form-check-input" type="checkbox" value="0" id="mascotas" name="mascotas">
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3 ">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Comentarios"
                                                    id="comentarios" name="comentarios"
                                                    style="height: 100%"></textarea>
                                                <label for="comentarios">Comentarios</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input class="form-check-input" type="checkbox" id="politicas" name="politicas"
                                    required>
                                <label class="form-check-label" for="politicas">
                                    Acepto la politica de privacidad <a href="#" onclick="alert('Politica de privacidad no configurada')">Política de privacidad</a>
                                </label>
                            </div>
                            <input type="hidden" id="trayecto_impresion" name="trayecto">
                            <input type="hidden" id="vehiculo_impresion" name="vehiculo">
                            <input type="hidden" id="dia_impresion" name="dia">
                            <input type="hidden" id="precio_impresion" name="precio">
                            <input type="hidden" id="direccion_impresion" name="direccion">
                            <input type="hidden" id="hora_impresion" name="hora">
                            <input type="hidden" id="mascotas_impresion" name="mascotas">
                            <input type="hidden" id="comentarios_impresion" name="comentarios">
                            <input type="hidden" id="more_info_impresion" name="more_info">
                            <div class="d-flex flex-column flex-md-row">
                                <button class="btn primary-btn enviar_cotizacion mb-2 mb-md-0">Enviar
                                    cotización</button>
                                <button id="imprimir_pdf" class="ms-3 btn btn-outline-danger ghost-btn" type="submit">
                                    imprimir
                                    <i class="bi bi-printer"></i>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="install-banner" class="animate__animated animate__fadeInLeft text-center">
    <span>Instala nuestra aplicación para una mejor experiencia.</span>
    <div>
        <button onclick="installPWA()">Instalar</button>
        <button class="bg-danger" onclick="cerrar()">No gracias</button>
    </div>
</div>

<div class="btn-whatsapp animate__animated animate__fadeInUp ">
    <a href="#" target="_blank">
        <lord-icon src="https://cdn.lordicon.com/fjuachvi.json" trigger="hover" style="width:40px;height:40px">
        </lord-icon>
        <span class="tooltip">Contáctame</span>
    </a>
</div>

<!-- <script>
    $('#imprimir_cot').on('click', function (e) {
        e.preventDefault();
        const url = '<?php echo IP_SERVER; ?>';
        const nombre = $('#nombre').val();
        const apellidos = $('#apellidos').val();
        const telefono = $('#telefono').val();
        const correo = $('#correo').val();
        const precio = $('#precio').text();
        const trayecto = $('#destino').text();
        const vehiculo = $('#vehiculo_seleccionado').text();
        const dia = $('#dia').val();
        const politicas = $('#politicas').is(':checked');
        const direccion = $('#direccion').val();
        const hora = $('#hora').val();
        const mascotas = $('#mascotas').is(':checked');

        $.ajax({
            url: url + 'home/imprimir',
            type: 'POST',
            data: {
                nombre: nombre,
                apellidos: apellidos,
                telefono: telefono,
                correo: correo,
                precio: precio,
                trayecto: trayecto,
                vehiculo: vehiculo,
                dia: dia,
                politicas: politicas,
                direccion: direccion,
                hora: hora,
                mascotas: mascotas

            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
            },
            error: function () {
                console.error('Error al imprimir la cotización');
            }
        });
    });
</script> -->


<script>
    function mostrarFormularioConScroll() {
        var formulario = document.getElementById('formulario');
        formulario.style.display = 'block';
        formulario.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    $('#more-info').on('change', function () {
        var checkbox = document.getElementById('more-info');
        var form = document.querySelector('.informacion-adicional');
        if (checkbox.checked) {
            form.classList.remove('d-none');
            form.classList.add('d-block');
        } else {
            form.classList.remove('d-block');
            form.classList.add('d-none');
        }
    });

    $('#vehiculo').on('change', function () {
        $('#dia').val('');
        $('#enviar_correo1').addClass('d-none');
        $('#formulario').hide();
    });
    // función para buscar el precio de la tarifa
    $('#dia').on('change', function () {
        var url = '<?php echo IP_SERVER; ?>';
        var id_destino = $('#trayecto').val();
        var id_vehiculo = $('#vehiculo').val();
        var dia = $('#dia').val();

        function formatearPrecio(precio) {
            return new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(precio);
        }
        $('#enviar_correo1').addClass('d-none');
        $('#formulario').hide();
        $('#loader').removeClass('d-none');

        $.ajax({
            url: url + 'home/get_tarifa',
            type: 'POST',
            data: {
                id_destino: id_destino,
                id_vehiculo: id_vehiculo,
                dia: dia
            },
            dataType: 'json',
            success: function (response) {
                $('#loader').addClass('d-none');
                if (response.length > 0) {
                    $('#enviar_correo1').removeClass('d-none');
                    $('#precio').text('Precio: ' + formatearPrecio(response[0].tarifa));
                    // Obtener el texto del trayecto seleccionado
                    var trayectoSeleccionado = $('#trayecto option:selected').text();
                    $('#destino').text(trayectoSeleccionado);
                    $('#vehiculo_seleccionado').text($('#vehiculo option:selected').text());
                    $('#trayecto_impresion').val(trayectoSeleccionado);
                    $('#vehiculo_impresion').val($('#vehiculo option:selected').text());
                    $('#dia_impresion').val(dia);
                    $('#precio_impresion').val('Precio: ' + formatearPrecio(response[0].tarifa));
                } else {
                    $('#precio').text('Precio: No disponible');
                    Swal.fire({
                        title: "No hay tarifa disponible",
                        icon: "error",
                        html: `
                                    <p>Escribe a un asesor para recibir ayuda inmediata.</p>
                                    <a href="https://wa.link/9bwsji" target="_blank"style="display: inline-flex; align-items: center; padding: 10px 20px; background-color: #25D366; color: white; text-decoration: none; border-radius: 5px;">
                                    Ir a WhatsApp
                                    <i class="ms-2 bi bi-whatsapp"></i>
                                    </a>
                                `,
                        showConfirmButton: false
                    });
                }
            },
            error: function () {
                Swal.fire({
                    title: 'Error de conexion',
                    text: 'No pudimos calcular el precio. Intenta de nuevo en unos segundos.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        });

        var mostrar_fomulario = document.getElementById('enviar_correo1');
        mostrar_fomulario.addEventListener('click', function () {
            mostrarFormularioConScroll();
        });

    });
</script>

<script>
    $('.enviar_cotizacion').on('click', function (e) {
        // Evita que el formulario se envíe normalmente
        e.preventDefault();
        const url = '<?php echo IP_SERVER; ?>';
        const nombre = $('#nombre').val();
        const apellidos = $('#apellidos').val();
        const telefono = $('#telefono').val();
        const correo = $('#correo').val();
        const precio = $('#precio').text();
        const trayecto = $('#destino').text();
        const vehiculo = $('#vehiculo_seleccionado').text();
        const dia = $('#dia').val();
        const politicas = $('#politicas').is(':checked');
        const direccion = $('#direccion').val();
        const hora = $('#hora').val();
        const mascotas = $('#mascotas').is(':checked');
        const comentarios = $('#comentarios').val();

        // Validar que todos los campos estén llenos

        if (precio === 'Precio: No disponible' || precio === '0$') {
            Swal.fire({
                title: 'Selecciona otra opcion',
                text: 'No tenemos tarifa para esa combinacion. Prueba otro dia o vehiculo.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            return;

        }

        if (!nombre || !apellidos || !telefono || !correo || !precio || !trayecto || !vehiculo || !dia || !politicas) {
            Swal.fire({
                title: 'Faltan datos',
                text: 'Completa los campos obligatorios para enviar la cotizacion.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            return;
        }
        else {
            // Mostrar el loader
            Swal.fire({
                title: 'Enviando...',
                text: 'Enviando tu cotizacion por correo.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                url: url + 'home/enviar_cotizacion',
                type: 'POST',
                data: {
                    nombre: nombre,
                    apellidos: apellidos,
                    telefono: telefono,
                    correo: correo,
                    precio: precio,
                    trayecto: trayecto,
                    vehiculo: vehiculo,
                    dia: dia,
                    politicas: politicas,
                    direccion: direccion,
                    hora: hora,
                    mascotas: mascotas,
                    comentarios: comentarios

                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: response.message || 'Tu cotizacion fue enviada. Revisa tu correo.',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        });
                    } else {
                        Swal.fire({
                            title: 'Solicitud recibida',
                            text: response.message || 'Estamos procesando tu solicitud.',
                            icon: 'info',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Solicitud recibida',
                        text: 'Tu solicitud fue recibida. Te contactaremos pronto.',
                        icon: 'info',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        }
    });


</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $('#trayecto').select2({
        placeholder: 'Select an option'
    });
</script>

<script>
    // Populate hidden fields before PDF form submission
    $('#imprimir_pdf').on('click', function(e) {
        // Populate all hidden fields with current values
        $('#direccion_impresion').val($('#direccion').val());
        $('#hora_impresion').val($('#hora').val());
        $('#mascotas_impresion').val($('#mascotas').is(':checked') ? '1' : '0');
        $('#comentarios_impresion').val($('#comentarios').val());
        $('#more_info_impresion').val($('#more-info').is(':checked') ? '1' : '0');
        
        // The form will submit normally after populating hidden fields
    });
</script>



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