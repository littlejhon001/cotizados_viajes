<?php
# Nota de Transparencia: Código generado/refactorizado con asistencia de IA Generativa (Claude Code) bajo la Política ODTI012 del CCS. Requiere supervisión y validación humana permanente.
defined('BASEPATH') or exit('No direct script access allowed');

$e = function ($v) {
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
};
$cop = function ($n) {
    return '$ ' . number_format((float) $n, 0, ',', '.');
};
$cant = function ($n) {
    return rtrim(rtrim(number_format((float) $n, 2, ',', '.'), '0'), ',');
};
$c = $cot['cliente'];
$v = $cot['viaje'];
$t = $cot['totales'];
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title><?php echo $e($cot['referencia']) ?></title>
    <style>
        @page { margin: 32px 40px 70px; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; color: #16213A; line-height: 1.45; }
        .stripe { height: 4px; }
        .stripe td { padding: 0; height: 4px; }
        table { border-collapse: collapse; width: 100%; }
        .head td { vertical-align: top; }
        .doc-title { font-size: 20px; font-weight: bold; color: #1B2A78; margin: 0; }
        .muted { color: #5B6478; }
        .ref { font-size: 11px; font-weight: bold; }
        .box { border: 1px solid #D9DEE7; border-radius: 6px; padding: 10px 12px; }
        .label { font-size: 8px; font-weight: bold; text-transform: uppercase; letter-spacing: .5px; color: #5B6478; }
        .val { font-size: 10px; margin-bottom: 6px; }
        .items th { background: #0E6B70; color: #fff; font-size: 8.5px; text-transform: uppercase; padding: 7px 8px; text-align: left; }
        .items td { padding: 8px; border-bottom: 1px solid #EEF1F5; vertical-align: top; }
        .items tr.alt td { background: #F7F9FB; }
        .num, .items th.num { text-align: right; white-space: nowrap; }
        .totals td { padding: 4px 8px; }
        .totals .grand td { border-top: 2px solid #0E6B70; padding-top: 8px; font-size: 13px; font-weight: bold; color: #0E6B70; }
        .notes { white-space: pre-line; }
        .footer { position: fixed; bottom: -48px; left: 0; right: 0; font-size: 8px; color: #5B6478; text-align: center; border-top: 1px solid #D9DEE7; padding-top: 6px; }
    </style>
</head>

<body>
    <div class="footer">
        GRUPO GREMS SAS · NIT 901.867.890-9 · CRA 9 este 1A 56 · Tel. 311 596 6555 – 321 313 0355 · gerencia@transdorado.co · www.transdorado.co
    </div>

    <table class="head">
        <tr>
            <td style="width:55%">
                <?php if ($logo) { ?><img src="<?php echo $logo ?>" style="width:170px"><?php } ?>
            </td>
            <td style="width:45%; text-align:right">
                <p class="doc-title">COTIZACIÓN</p>
                <div class="ref"><?php echo $e($cot['referencia']) ?></div>
                <div class="muted">Fecha: <?php echo $e($cot['fecha']) ?></div>
                <div class="muted">Válida hasta: <?php echo $e($cot['vence']) ?> (<?php echo (int) $cot['vigencia'] ?> días)</div>
            </td>
        </tr>
    </table>

    <table class="stripe" style="margin:14px 0 16px">
        <tr>
            <td style="background:#7AB51D"></td><td style="background:#F39200"></td><td style="background:#1B2A78"></td><td style="background:#0E6B70"></td><td style="background:#1E9FE0"></td>
        </tr>
    </table>

    <table>
        <tr>
            <td style="width:50%; padding-right:8px; vertical-align:top">
                <div class="box">
                    <div class="label">Cliente</div>
                    <div class="val" style="font-size:11px; font-weight:bold"><?php echo $e($c['nombre']) ?></div>
                    <?php if ($c['documento']) { ?><div class="label">NIT / Documento</div><div class="val"><?php echo $e($c['documento']) ?></div><?php } ?>
                    <?php if ($c['telefono']) { ?><div class="label">Teléfono</div><div class="val"><?php echo $e($c['telefono']) ?></div><?php } ?>
                    <?php if ($c['correo']) { ?><div class="label">Correo</div><div class="val"><?php echo $e($c['correo']) ?></div><?php } ?>
                </div>
            </td>
            <td style="width:50%; padding-left:8px; vertical-align:top">
                <div class="box">
                    <div class="label">Servicio</div>
                    <div class="val"><?php echo !empty($v['fecha_texto']) ? $e($v['fecha_texto']) : 'Fecha por confirmar' ?><?php echo $v['hora'] ? ' · ' . $e($v['hora']) : '' ?></div>
                    <?php if ($v['origen']) { ?><div class="label">Lugar de recogida</div><div class="val"><?php echo $e($v['origen']) ?></div><?php } ?>
                    <?php if ($v['pasajeros']) { ?><div class="label">Pasajeros</div><div class="val"><?php echo (int) $v['pasajeros'] ?></div><?php } ?>
                </div>
            </td>
        </tr>
    </table>

    <table class="items" style="margin-top:16px">
        <thead>
            <tr>
                <th style="width:5%">#</th>
                <th>Descripción</th>
                <th class="num" style="width:10%">Cant.</th>
                <th class="num" style="width:17%">Valor unitario</th>
                <th class="num" style="width:17%">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cot['items'] as $i => $it) { ?>
                <tr class="<?php echo $i % 2 ? 'alt' : '' ?>">
                    <td class="muted"><?php echo $i + 1 ?></td>
                    <td><?php echo $e($it['descripcion']) ?></td>
                    <td class="num"><?php echo $cant($it['cantidad']) ?></td>
                    <td class="num"><?php echo $cop($it['valor']) ?></td>
                    <td class="num"><?php echo $cop($it['total']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <table style="margin-top:10px">
        <tr>
            <td style="width:55%"></td>
            <td style="width:45%">
                <table class="totals">
                    <tr><td class="muted">Subtotal</td><td class="num"><?php echo $cop($t['subtotal']) ?></td></tr>
                    <?php if ($t['descuento']) { ?>
                        <tr><td class="muted">Descuento</td><td class="num">− <?php echo $cop($t['descuento']) ?></td></tr>
                    <?php } ?>
                    <?php if ($cot['iva']) { ?>
                        <tr><td class="muted">IVA (<?php echo (int) $iva_porcentaje ?>%)</td><td class="num"><?php echo $cop($t['iva']) ?></td></tr>
                    <?php } ?>
                    <tr class="grand"><td>Total</td><td class="num"><?php echo $cop($t['total']) ?></td></tr>
                </table>
            </td>
        </tr>
    </table>

    <?php if ($cot['observaciones']) { ?>
        <div class="box" style="margin-top:18px">
            <div class="label">Condiciones y observaciones</div>
            <div class="notes"><?php echo $e($cot['observaciones']) ?></div>
        </div>
    <?php } ?>

    <p class="muted" style="margin-top:18px">Gracias por confiar en Transportes Dorado. Para confirmar tu reserva responde este mensaje o escríbenos al 311 596 6555.</p>
</body>

</html>
