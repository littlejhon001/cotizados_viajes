<?php
# Nota de Transparencia: Código generado/refactorizado con asistencia de IA Generativa (Claude Code) bajo la Política ODTI012 del CCS. Requiere supervisión y validación humana permanente.
defined('BASEPATH') or exit('No direct script access allowed');

$titulo = isset($titulo) ? $titulo : 'Administrador';
$menu = isset($menu) ? $menu : '';
$usuario = $this->session->user_data;
$nombre_usuario = trim($usuario->nombre . ' ' . $usuario->apellido);
$iniciales = strtoupper(mb_substr((string) $usuario->nombre, 0, 1) . mb_substr((string) $usuario->apellido, 0, 1));

$items = array(
    'destinos' => array('url' => 'Home/admin', 'icon' => 'bi-geo-alt', 'label' => 'Destinos y tarifas'),
    'cotizacion_formal' => array('url' => 'Home/cotizacion_formal', 'icon' => 'bi-file-earmark-plus', 'label' => 'Nueva cotización'),
    'cotizaciones' => array('url' => 'Home/usuarios', 'icon' => 'bi-receipt', 'label' => 'Solicitudes web'),
);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title><?php echo html_escape($titulo) ?> · Admin Transportes Dorado</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo IP_SERVER ?>assets/css/tokens.css">
    <link rel="stylesheet" href="<?php echo IP_SERVER ?>assets/css/admin.css">
    <link rel="icon" type="image/png" href="<?php echo IP_SERVER ?>assets/img/logo_transdorado.png">
</head>

<body class="adm">
    <div class="adm-shell" id="admShell">

        <aside class="adm-side" id="admSide" aria-label="Menú principal">
            <a class="adm-side__brand" href="<?php echo IP_SERVER ?>Home/admin">
                <img src="<?php echo IP_SERVER ?>assets/img/logo_transdorado.png" alt="Transportes Dorado">
                <div class="brand-stripe" aria-hidden="true"><span></span><span></span><span></span><span></span><span></span></div>
            </a>

            <nav>
                <p class="adm-nav__label">Gestión</p>
                <ul class="adm-nav">
                    <?php foreach ($items as $key => $item) { ?>
                        <li>
                            <a href="<?php echo IP_SERVER . $item['url'] ?>" <?php echo $menu === $key ? 'aria-current="page"' : '' ?>>
                                <i class="bi <?php echo $item['icon'] ?>" aria-hidden="true"></i>
                                <?php echo $item['label'] ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>

                <p class="adm-nav__label">Sitio</p>
                <ul class="adm-nav">
                    <li>
                        <a href="<?php echo IP_SERVER ?>" target="_blank" rel="noopener">
                            <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i> Ver cotizador
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="adm-side__user">
                <span class="adm-avatar" aria-hidden="true"><?php echo html_escape($iniciales) ?></span>
                <div style="min-width:0">
                    <div class="adm-side__user-name"><?php echo html_escape($nombre_usuario) ?></div>
                    <div class="adm-side__user-role">Administrador</div>
                </div>
                <a class="adm-side__logout" href="<?php echo IP_SERVER ?>Login/logout" title="Cerrar sesión"
                    aria-label="Cerrar sesión">
                    <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </aside>

        <div class="adm-main">
            <header class="adm-top">
                <button class="btn btn-icon adm-menu-btn" type="button" id="admMenuBtn" aria-controls="admSide"
                    aria-expanded="false" aria-label="Abrir menú">
                    <i class="bi bi-list" style="font-size:1.4rem" aria-hidden="true"></i>
                </button>
                <div class="adm-top__crumb">Admin / <strong><?php echo html_escape($titulo) ?></strong></div>
                <div class="adm-top__actions">
                    <a class="btn btn-ghost" href="<?php echo IP_SERVER ?>" target="_blank" rel="noopener">
                        <i class="bi bi-box-arrow-up-right" aria-hidden="true"></i><span>Ver cotizador</span>
                    </a>
                </div>
            </header>

            <main class="adm-content" id="contenido">
