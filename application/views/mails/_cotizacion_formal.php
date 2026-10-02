<?php
# Nota de Transparencia: Código generado/refactorizado con asistencia de IA Generativa (Claude Code) bajo la Política ODTI012 del CCS. Requiere supervisión y validación humana permanente.
defined('BASEPATH') or exit('No direct script access allowed');

// Correo HTML: solo tablas y estilos en línea para que se vea igual en Gmail, Outlook y móviles
$e = function ($v) {
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
};
$cop = function ($n) {
    return '$ ' . number_format((float) $n, 0, ',', '.');
};
$t = $cot['totales'];
$v = $cot['viaje'];
$wa_texto = 'Hola, quiero confirmar la cotización ' . $cot['referencia'] . ' por ' . $cop($t['total']) . '.';
$wa_url = 'https://wa.me/573115966555?text=' . rawurlencode($wa_texto);
$mail_url = 'mailto:cotizaciones@transdorado.co?subject=' . rawurlencode('Confirmación ' . $cot['referencia']);
$items = array_slice($cot['items'], 0, 4);
$mas_items = count($cot['items']) - count($items);
$firma_cargo = isset($firmante['cargo']) ? $firmante['cargo'] : 'Gerente General';
?>
<!DOCTYPE html>
<html lang="es" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light">
    <meta name="supported-color-schemes" content="light">
    <title>Cotización <?php echo $e($cot['referencia']) ?></title>
    <style>
        @media (max-width: 620px) {
            .container { width: 100% !important; }
            .px { padding-left: 20px !important; padding-right: 20px !important; }
            .stack { display: block !important; width: 100% !important; }
            .stack-gap { padding-top: 10px !important; padding-left: 0 !important; }
            .total { font-size: 30px !important; }
            .btn a { display: block !important; }
        }
    </style>
</head>

<body style="margin:0; padding:0; background:#EEF1F6; -webkit-text-size-adjust:100%;">
    <!-- Texto de vista previa en la bandeja de entrada -->
    <div style="display:none; max-height:0; overflow:hidden; opacity:0; color:#EEF1F6;">
        Tu cotización <?php echo $e($cot['referencia']) ?> por <?php echo $e($cop($t['total'])) ?> está lista. Válida hasta el <?php echo $e($cot['vence']) ?>.
    </div>

    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#EEF1F6;">
        <tr>
            <td align="center" style="padding:28px 12px;">
                <table role="presentation" class="container" width="600" cellpadding="0" cellspacing="0" border="0" style="width:600px; max-width:600px; background:#ffffff; border-radius:16px; overflow:hidden; font-family:Arial, Helvetica, sans-serif; color:#16213A;">

                    <!-- Encabezado -->
                    <tr>
                        <td class="px" style="padding:24px 32px 18px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td valign="middle"><img src="cid:main_logo" alt="Transportes Dorado" width="150" style="display:block; border:0; width:150px; height:auto;"></td>
                                    <td valign="middle" align="right" style="font-size:12px; color:#5B6478; line-height:1.4;">
                                        Cotización<br><strong style="color:#1B2A78; font-size:13px;"><?php echo $e($cot['referencia']) ?></strong>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0; font-size:0; line-height:0;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td width="20%" height="5" style="background:#7AB51D;"></td>
                                    <td width="20%" height="5" style="background:#F39200;"></td>
                                    <td width="20%" height="5" style="background:#1B2A78;"></td>
                                    <td width="20%" height="5" style="background:#0E6B70;"></td>
                                    <td width="20%" height="5" style="background:#1E9FE0;"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Mensaje principal -->
                    <tr>
                        <td class="px" style="padding:32px 32px 8px;">
                            <p style="margin:0 0 6px; font-size:13px; font-weight:bold; letter-spacing:1px; text-transform:uppercase; color:#0E6B70;">Tu cotización está lista</p>
                            <h1 style="margin:0 0 12px; font-size:24px; line-height:1.3; color:#16213A;">Hola <?php echo $e($cot['cliente']['nombre']) ?>, gracias por elegirnos</h1>
                            <p style="margin:0; font-size:15px; line-height:1.6; color:#3D4659;">Te enviamos la cotización de tu servicio de transporte. Encontrarás el detalle completo y las condiciones en el <strong>PDF adjunto</strong>.</p>
                        </td>
                    </tr>

                    <!-- Resumen -->
                    <tr>
                        <td class="px" style="padding:24px 32px 8px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:#F4F7FA; border:1px solid #E1E6EE; border-radius:12px;">
                                <tr>
                                    <td style="padding:22px 24px 6px;">
                                        <p style="margin:0; font-size:12px; font-weight:bold; text-transform:uppercase; letter-spacing:.6px; color:#5B6478;">Total de la cotización</p>
                                        <p class="total" style="margin:4px 0 2px; font-size:34px; line-height:1.2; font-weight:bold; color:#0E6B70;"><?php echo $e($cop($t['total'])) ?></p>
                                        <p style="margin:0; font-size:13px; color:#5B6478;">
                                            Válida hasta el <strong style="color:#16213A;"><?php echo $e($cot['vence']) ?></strong>
                                            <?php if (!empty($cot['factura'])) { ?> · Incluye facturación electrónica<?php } ?>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 24px 4px;">
                                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <?php foreach ($items as $it) { ?>
                                                <tr>
                                                    <td valign="top" style="padding:10px 0; border-top:1px solid #E1E6EE; font-size:14px; line-height:1.45; color:#16213A;">
                                                        <?php echo $e($it['descripcion']) ?>
                                                        <span style="display:block; font-size:12px; color:#5B6478;">
                                                            <?php echo !empty($it['fecha']) ? $e($it['fecha']) . ' · ' : '' ?>Cant. <?php echo $e(rtrim(rtrim(number_format((float) $it['cantidad'], 2, ',', '.'), '0'), ',')) ?>
                                                        </span>
                                                    </td>
                                                    <td valign="top" align="right" style="padding:10px 0 10px 12px; border-top:1px solid #E1E6EE; font-size:14px; font-weight:bold; white-space:nowrap; color:#16213A;"><?php echo $e($cop($it['total'])) ?></td>
                                                </tr>
                                            <?php } ?>
                                            <?php if ($mas_items > 0) { ?>
                                                <tr><td colspan="2" style="padding:8px 0 10px; border-top:1px solid #E1E6EE; font-size:13px; color:#5B6478;">y <?php echo (int) $mas_items ?> ítem(s) más en el PDF</td></tr>
                                            <?php } ?>
                                        </table>
                                    </td>
                                </tr>
                                <?php if (!empty($v['hora']) || !empty($v['origen']) || !empty($v['fecha_texto'])) { ?>
                                    <tr>
                                        <td style="padding:4px 24px 20px;">
                                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-top:1px solid #E1E6EE;">
                                                <tr>
                                                    <?php if (!empty($v['fecha_texto']) || !empty($v['hora'])) { ?>
                                                        <td class="stack" valign="top" width="50%" style="padding-top:12px; font-size:13px; color:#5B6478;">
                                                            Salida<br><strong style="color:#16213A;"><?php echo $e(trim((!empty($v['fecha_texto']) ? $v['fecha_texto'] : '') . ' ' . $v['hora'])) ?></strong>
                                                        </td>
                                                    <?php } ?>
                                                    <?php if (!empty($v['origen'])) { ?>
                                                        <td class="stack stack-gap" valign="top" width="50%" style="padding-top:12px; padding-left:12px; font-size:13px; color:#5B6478;">
                                                            Recogida<br><strong style="color:#16213A;"><?php echo $e($v['origen']) ?></strong>
                                                        </td>
                                                    <?php } ?>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                <?php } else { ?>
                                    <tr><td style="padding:0 0 12px; font-size:0; line-height:0;">&nbsp;</td></tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>

                    <!-- Botones -->
                    <tr>
                        <td class="px" style="padding:22px 32px 4px;">
                            <table role="presentation" cellpadding="0" cellspacing="0" border="0" width="100%">
                                <tr>
                                    <td class="stack btn" align="center" style="padding:0 6px 10px 0;">
                                        <a href="<?php echo $e($wa_url) ?>" target="_blank" style="display:inline-block; width:100%; box-sizing:border-box; background:#0E6B70; color:#ffffff; font-size:15px; font-weight:bold; text-decoration:none; padding:15px 18px; border-radius:10px;">Confirmar por WhatsApp</a>
                                    </td>
                                    <td class="stack btn" align="center" style="padding:0 0 10px 6px;">
                                        <a href="<?php echo $e($mail_url) ?>" style="display:inline-block; width:100%; box-sizing:border-box; background:#ffffff; color:#1B2A78; font-size:15px; font-weight:bold; text-decoration:none; padding:13px 18px; border:2px solid #1B2A78; border-radius:10px;">Responder por correo</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Próximos pasos -->
                    <tr>
                        <td class="px" style="padding:22px 32px 8px;">
                            <p style="margin:0 0 12px; font-size:16px; font-weight:bold; color:#16213A;">¿Cómo reservar?</p>
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">
                                <?php foreach (array(
                                    array('1', 'Revisa el PDF', 'Allí están el detalle del servicio y las condiciones.'),
                                    array('2', 'Envía tus documentos', 'Cédula (o pasaporte) o cámara de comercio si es empresa. Si necesitas factura electrónica, envía también el RUT.'),
                                    array('3', 'Aparta tu servicio', 'Con el 10% del valor total, entre 3 y 5 días antes del servicio.'),
                                ) as $paso) { ?>
                                    <tr>
                                        <td valign="top" width="40" style="padding:0 0 14px;">
                                            <div style="width:28px; height:28px; line-height:28px; border-radius:50%; background:#1B2A78; color:#ffffff; font-size:13px; font-weight:bold; text-align:center;"><?php echo $paso[0] ?></div>
                                        </td>
                                        <td valign="top" style="padding:3px 0 14px; font-size:14px; line-height:1.5; color:#3D4659;">
                                            <strong style="color:#16213A;"><?php echo $paso[1] ?>.</strong> <?php echo $paso[2] ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </td>
                    </tr>

                    <!-- Firma -->
                    <tr>
                        <td class="px" style="padding:8px 32px 30px;">
                            <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="border-top:1px solid #E1E6EE;">
                                <tr>
                                    <td style="padding-top:20px; font-size:14px; color:#3D4659;">
                                        Cordialmente,
                                        <img src="cid:firma" alt="Firma" width="150" style="display:block; border:0; width:150px; height:auto; margin:8px 0 4px;">
                                        <?php if (!empty($firmante['nombre'])) { ?><strong style="color:#16213A;"><?php echo $e($firmante['nombre']) ?></strong><br><?php } ?>
                                        <span style="font-size:13px; color:#5B6478;"><?php echo $e($firma_cargo) ?> · Transportes Dorado</span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Pie -->
                    <tr>
                        <td class="px" style="padding:22px 32px; background:#131D52; color:#C9D0E6; font-size:12px; line-height:1.7;">
                            <strong style="color:#ffffff;">Vansbogota.com y Transdorado.co</strong><br>
                            Bogotá · WhatsApp <a href="https://wa.me/573115966555" style="color:#ffffff; text-decoration:underline;">311 596 6555</a> · Tel. 321 313 0355<br>
                            GRUPO GREMS SAS · NIT 901.867.890-8 · @TRANSDORADOVANSBOGOTA
                        </td>
                    </tr>
                </table>

                <p style="margin:16px 0 0; font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#8A93A6;">Recibes este correo porque solicitaste una cotización a Transportes Dorado.</p>
            </td>
        </tr>
    </table>
</body>

</html>
