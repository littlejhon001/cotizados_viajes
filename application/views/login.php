<?php
# Nota de Transparencia: Código generado/refactorizado con asistencia de IA Generativa (Claude Code) bajo la Política ODTI012 del CCS. Requiere supervisión y validación humana permanente.
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>Administrador · Transportes Dorado</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo IP_SERVER ?>assets/css/tokens.css">
    <link rel="stylesheet" href="<?php echo IP_SERVER ?>assets/css/login.css">
    <link rel="icon" type="image/png" href="<?php echo IP_SERVER ?>assets/img/logo_transdorado.png">
</head>

<body>
    <div class="auth">

        <!-- Panel de marca -->
        <aside class="auth-hero">
            <img class="auth-hero__logo" src="<?php echo IP_SERVER ?>assets/img/logo_transdorado.png"
                alt="Transportes Dorado">

            <div class="auth-hero__body">
                <span class="auth-hero__eyebrow">Cotizador de viajes</span>
                <h1 class="auth-hero__title">Gestiona rutas, tarifas y cotizaciones en un solo lugar</h1>
                <p class="auth-hero__text">Panel administrativo para mantener al día los destinos y precios que tus
                    clientes cotizan en línea.</p>
                <ul class="auth-hero__list">
                    <li><i class="bi bi-geo-alt" aria-hidden="true"></i> Destinos y rutas frecuentes</li>
                    <li><i class="bi bi-bus-front" aria-hidden="true"></i> Precios por tipo de vehículo</li>
                    <li><i class="bi bi-receipt" aria-hidden="true"></i> Cotizaciones recibidas</li>
                </ul>
            </div>

            <div>
                <div class="brand-stripe" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span></div>
                <p class="auth-hero__foot">&copy; <?php echo date('Y') ?> Transportes Dorado</p>
            </div>
        </aside>

        <!-- Formulario -->
        <main class="auth-main">
            <div class="auth-card">
                <div class="brand-stripe" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span></div>
                <h2 class="auth-card__title">Iniciar sesión</h2>
                <p class="auth-card__subtitle">Ingresa con tu cuenta de administrador.</p>

                <div id="authAlert" class="auth-alert" role="alert" aria-live="assertive">
                    <i class="bi bi-exclamation-circle" aria-hidden="true"></i>
                    <span id="authAlertText"></span>
                </div>

                <form id="ingresar" method="post" novalidate>
                    <div class="field">
                        <label for="inputEmail">Correo electrónico</label>
                        <div class="field__control">
                            <i class="bi bi-envelope field__icon" aria-hidden="true"></i>
                            <input id="inputEmail" type="email" name="email" placeholder="nombre@empresa.com"
                                autocomplete="username" maxlength="255" required autofocus>
                        </div>
                    </div>

                    <div class="field">
                        <label for="inputPassword">Contraseña</label>
                        <div class="field__control">
                            <i class="bi bi-lock field__icon" aria-hidden="true"></i>
                            <input id="inputPassword" type="password" name="contrasena" placeholder="••••••••"
                                autocomplete="current-password" maxlength="255" required>
                            <button class="field__toggle" type="button" aria-label="Mostrar contraseña"
                                aria-controls="inputPassword" aria-pressed="false">
                                <i class="bi bi-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <button id="btnIngresar" type="submit" class="btn-submit">
                        <span class="btn-submit__label">Ingresar</span>
                        <i class="bi bi-arrow-right" aria-hidden="true"></i>
                    </button>
                </form>

                <p class="auth-help">¿Olvidaste tu contraseña?
                    <a href="<?php echo IP_SERVER ?>contacto">Contáctanos</a>
                </p>

                <a class="auth-back" href="<?php echo IP_SERVER ?>">
                    <i class="bi bi-arrow-left" aria-hidden="true"></i> Volver al cotizador
                </a>
            </div>
        </main>
    </div>

    <script src="<?php echo IP_SERVER ?>assets/jquery/jquery.min.js"></script>
    <script>
        $(function () {
            var $form = $('#ingresar');
            var $email = $('#inputEmail');
            var $password = $('#inputPassword');
            var $btn = $('#btnIngresar');
            var $alert = $('#authAlert');

            function showError(msg, $field) {
                $('#authAlertText').text(msg);
                $alert.addClass('is-visible');
                $form.find('input').attr('aria-invalid', 'false');
                if ($field) {
                    $field.attr('aria-invalid', 'true').trigger('focus');
                }
            }

            function setLoading(loading) {
                $btn.prop('disabled', loading);
                $btn.find('.btn-submit__label').text(loading ? 'Ingresando…' : 'Ingresar');
            }

            $form.find('input').on('input', function () {
                $(this).attr('aria-invalid', 'false');
                $alert.removeClass('is-visible');
            });

            $form.on('submit', function (event) {
                event.preventDefault();

                var email = $.trim($email.val());
                if (email === '' || !$email[0].checkValidity()) {
                    showError('Ingresa un correo electrónico válido.', $email);
                    return;
                }
                if ($password.val() === '') {
                    showError('Ingresa tu contraseña.', $password);
                    return;
                }

                setLoading(true);
                $.post('<?php echo IP_SERVER ?>Login/procesar', $form.serialize(), null, 'json')
                    .done(function (result) {
                        if (result && result.success == 1) {
                            $btn.find('.btn-submit__label').text('Bienvenido');
                            location.assign('<?php echo IP_SERVER ?>Home/admin');
                            return;
                        }
                        setLoading(false);
                        $password.val('');
                        showError((result && result.msg) || 'Usuario o contraseña incorrectos.', $password);
                    })
                    .fail(function () {
                        setLoading(false);
                        showError('No pudimos conectar con el servidor. Intenta de nuevo.');
                    });
            });

            $('.field__toggle').on('click', function () {
                var visible = $password.attr('type') === 'text';
                $password.attr('type', visible ? 'password' : 'text');
                $(this).attr({
                    'aria-pressed': String(!visible),
                    'aria-label': visible ? 'Mostrar contraseña' : 'Ocultar contraseña'
                }).find('i').toggleClass('bi-eye bi-eye-slash');
            });
        });
    </script>
</body>

</html>
