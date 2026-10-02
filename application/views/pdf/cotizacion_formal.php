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
$hay_fechas = false;
foreach ($cot['items'] as $it) {
    if (!empty($it['fecha'])) {
        $hay_fechas = true;
    }
}
$factura_pct = isset($factura_porcentaje) ? (int) $factura_porcentaje : 7;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title><?php echo $e($cot['referencia']) ?></title>
    <style>
        @page { margin: 30px 40px 78px; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 9.6px; color: #16213A; line-height: 1.5; }
        table { border-collapse: collapse; width: 100%; }
        .stripe { table-layout: fixed; }
        .stripe td { padding: 0; height: 4px; font-size: 1px; line-height: 1px; }
        .head td { vertical-align: top; }
        .doc-title { font-size: 19px; font-weight: bold; color: #1B2A78; margin: 0; }
        .muted { color: #5B6478; }
        .ref { font-size: 11px; font-weight: bold; }
        .box { border: 1px solid #D9DEE7; border-radius: 6px; padding: 10px 12px; }
        .label { font-size: 7.6px; font-weight: bold; text-transform: uppercase; letter-spacing: .5px; color: #5B6478; }
        .val { font-size: 9.8px; margin-bottom: 5px; }
        .intro { margin: 14px 0 0; font-size: 10px; }
        .items th { background: #0E6B70; color: #fff; font-size: 8px; text-transform: uppercase; padding: 7px 8px; text-align: left; }
        .items td { padding: 8px; border-bottom: 1px solid #EEF1F5; vertical-align: top; }
        .items tr.alt td { background: #F7F9FB; }
        .num, .items th.num { text-align: right; white-space: nowrap; }
        .totals td { padding: 4px 8px; }
        .totals .info td { color: #5B6478; font-size: 9px; }
        .totals .grand td { border-top: 2px solid #0E6B70; padding-top: 8px; font-size: 13px; font-weight: bold; color: #0E6B70; }
        .notes { white-space: pre-line; }
        .section-title { margin: 0 0 8px; font-size: 11px; font-weight: bold; color: #1B2A78; text-transform: uppercase; letter-spacing: .6px; }
        .features td { width: 25%; padding: 9px 6px; text-align: center; border: 1px solid #EEF1F5; font-size: 8.8px; background: #F7F9FB; }
        .clauses td { padding: 5px 0; vertical-align: top; text-align: justify; }
        .clauses .l { width: 18px; font-weight: bold; color: #0E6B70; }
        .alert { color: #C62828; font-weight: bold; }
        .page-break { page-break-before: always; }
        .footer { position: fixed; bottom: -30px; left: 0; right: 0; font-size: 7.8px; color: #5B6478; text-align: center; border-top: 1px solid #D9DEE7; padding-top: 6px; line-height: 1.6; }
        .footer strong { color: #1B2A78; }
    </style>
</head>

<body>
    <div class="footer">
        <strong>Vansbogota.com y Transdorado.co</strong> · Bogotá · Tel. 311 596 6555 | 321 313 0355<br>
        GRUPO GREMS SAS · NIT 901.867.890-8 · @TRANSDORADOVANSBOGOTA
    </div>

    <!-- ======================= PÁGINA 1: COTIZACIÓN ======================= -->
    <table class="head">
        <tr>
            <td style="width:55%">
                <?php if ($logo) { ?><img src="<?php echo $logo ?>" style="width:165px"><?php } ?>
                <div class="muted" style="margin-top:4px">GRUPO GREMS SAS · NIT 901.867.890-8</div>
            </td>
            <td style="width:45%; text-align:right">
                <p class="doc-title">COTIZACIÓN</p>
                <div class="ref">No. <?php echo $e($cot['referencia']) ?></div>
                <div class="muted">Bogotá, <?php echo $e($fecha_larga) ?></div>
                <div class="muted">Válida hasta: <?php echo $e($cot['vence']) ?> (<?php echo (int) $cot['vigencia'] ?> días)</div>
            </td>
        </tr>
    </table>

    <table class="stripe" style="margin:12px 0 14px">
        <tr>
            <td style="width:20%; background:#7AB51D">&nbsp;</td><td style="width:20%; background:#F39200">&nbsp;</td><td style="width:20%; background:#1B2A78">&nbsp;</td><td style="width:20%; background:#0E6B70">&nbsp;</td><td style="width:20%; background:#1E9FE0">&nbsp;</td>
        </tr>
    </table>

    <table>
        <tr>
            <td style="width:50%; padding-right:8px; vertical-align:top">
                <div class="box">
                    <div class="label">Señores</div>
                    <div class="val" style="font-size:11px; font-weight:bold"><?php echo $e($c['nombre']) ?></div>
                    <div class="label">NIT / Documento</div>
                    <div class="val"><?php echo $c['documento'] ? $e($c['documento']) : '—' ?></div>
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
                    <div class="label">Modalidad</div>
                    <div class="val">Servicio de transporte a disponibilidad</div>
                </div>
            </td>
        </tr>
    </table>

    <p class="intro"><?php echo $e(!empty($cot['intro']) ? $cot['intro'] : '') ?></p>

    <table class="items" style="margin-top:10px">
        <thead>
            <tr>
                <th style="width:4%">#</th>
                <th>Producto y/o servicio</th>
                <?php if ($hay_fechas) { ?><th style="width:16%">Fecha</th><?php } ?>
                <th class="num" style="width:8%">Cant.</th>
                <th class="num" style="width:15%">Valor unitario</th>
                <th class="num" style="width:15%">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cot['items'] as $i => $it) { ?>
                <tr class="<?php echo $i % 2 ? 'alt' : '' ?>">
                    <td class="muted"><?php echo $i + 1 ?></td>
                    <td><?php echo $e($it['descripcion']) ?></td>
                    <?php if ($hay_fechas) { ?><td><?php echo !empty($it['fecha']) ? $e($it['fecha']) : '—' ?></td><?php } ?>
                    <td class="num"><?php echo $cant($it['cantidad']) ?></td>
                    <td class="num"><?php echo $cop($it['valor']) ?></td>
                    <td class="num"><?php echo $cop($it['total']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <table style="margin-top:10px">
        <tr>
            <td style="width:50%"></td>
            <td style="width:50%">
                <table class="totals">
                    <tr><td class="muted">Subtotal</td><td class="num"><?php echo $cop($t['subtotal']) ?></td></tr>
                    <?php if ($t['descuento']) { ?>
                        <tr><td class="muted">Descuento</td><td class="num">− <?php echo $cop($t['descuento']) ?></td></tr>
                    <?php } ?>
                    <?php if ($cot['iva']) { ?>
                        <tr><td class="muted">IVA (<?php echo (int) $iva_porcentaje ?>%)</td><td class="num"><?php echo $cop($t['iva']) ?></td></tr>
                    <?php } ?>
                    <?php if (!empty($cot['factura'])) { ?>
                        <tr><td class="muted">Facturación electrónica (<?php echo $factura_pct ?>%)</td><td class="num"><?php echo $cop($t['factura']) ?></td></tr>
                    <?php } ?>
                    <tr class="grand"><td>Total</td><td class="num"><?php echo $cop($t['total']) ?></td></tr>
                    <?php if (!empty($cot['hora_adicional'])) { ?>
                        <tr class="info"><td>Valor hora adicional</td><td class="num"><?php echo $cop($cot['hora_adicional']) ?></td></tr>
                    <?php } ?>
                    <?php if (empty($cot['factura'])) { ?>
                        <tr class="info"><td colspan="2">Con facturación electrónica el valor aumenta un <?php echo $factura_pct ?>%.</td></tr>
                    <?php } ?>
                </table>
            </td>
        </tr>
    </table>

    <?php if ($cot['observaciones']) { ?>
        <div class="box" style="margin-top:16px">
            <div class="label">Observaciones</div>
            <div class="notes"><?php echo $e($cot['observaciones']) ?></div>
        </div>
    <?php } ?>

    <!-- ======================= PÁGINA 2: VEHÍCULOS Y CONDICIONES ======================= -->
    <div class="page-break"></div>

    <p class="section-title">Nuestros vehículos</p>
    <p style="margin:0 0 8px">Vehículos de modelos recientes, en muy buenas condiciones y con toda la seguridad. Full equipo:</p>
    <table class="features" style="margin-bottom:18px">
        <tr>
            <td>Aire acondicionado</td>
            <td>TV y bluetooth</td>
            <td>Silletería reclinable y cómoda</td>
            <td>Bodega y maletero</td>
        </tr>
    </table>

    <p class="section-title">Condiciones del servicio</p>
    <table class="clauses">
        <tr><td class="l">A.</td><td>Los vehículos cuentan con todas las exigencias del Ministerio de Transporte y con las disposiciones legales contempladas en la Ley 769 del 6 de agosto de 2002, el Decreto 174 del 5 de febrero de 2001 y las normas que lo modifiquen o adicionen para la prestación del servicio público de transporte terrestre automotor especial, con la documentación vigente: matrícula del vehículo, seguro obligatorio SOAT, certificado de emisión de gases y certificado de revisión técnico-mecánica; dotados del equipo de carretera reglamentario, cubriendo todos los costos de mantenimiento del vehículo y demás normas que regulen y lleguen a regular el servicio de transporte de pasajeros y las normas de tránsito.</td></tr>
        <tr><td class="l">B.</td><td><strong>GRUPO GREMS SAS</strong> será responsable del suministro de conductores, insumos, equipos, herramientas, materiales, combustibles, <strong>peajes</strong>, lubricantes o cualquier otro elemento necesario para la normal operación del vehículo y la prestación del servicio, y cubrirá todos los costos de mantenimiento del vehículo o infracciones de tránsito en las que incurra. Dispondrá de conductores idóneos, capacitados, con licencia de conducción vigente y experiencia en el transporte de pasajeros, que se caracterizan por el buen trato y respeto al personal beneficiado.</td></tr>
        <tr><td class="l">C.</td><td>Los peajes adicionales por trayectos no especificados y los parqueaderos en parques o restaurantes serán gastos del contratante. El conductor no está obligado a transitar por vías destapadas, en mal estado o veredas que no hayan sido especificadas antes de hacer el contrato.</td></tr>
        <tr><td class="l">D.</td><td>Para hacer su reservación envíe al WhatsApp 311 596 6555 la cédula (o pasaporte si es extranjero) o la cámara de comercio si es empresa, y los datos del responsable del contrato: nombre, cédula, dirección, teléfono, lugar y hora de salida.</td></tr>
        <tr><td class="l">E.</td><td>Para reservar se debe apartar con el <strong>10%</strong> del total del servicio entre 3 y 5 días antes del servicio. El <strong>60%</strong> se cancela antes de iniciar el servicio y el saldo hasta completar el <strong>100%</strong> antes del regreso.<?php if (!empty($pago['medios'])) { ?> Medios de pago: <?php echo $e($pago['medios']) ?>.<?php } ?></td></tr>
        <tr><td class="l">F.</td><td>Con factura o con cualquiera de los otros medios, <span class="alert">el servicio debe estar pago en su totalidad antes de culminar el servicio.</span></td></tr>
        <tr><td class="l">G.</td><td>Cuentas <strong>GRUPO GREMS SAS</strong> · NIT 901.867.890-8<?php echo !empty($pago['empresa']) ? ': ' . $e($pago['empresa']) : '' ?>.<?php if (empty($pago['medios']) && empty($pago['empresa'])) { ?> Solicite los datos de pago por WhatsApp al 311 596 6555.<?php } ?></td></tr>
        <tr><td class="l">H.</td><td>Si requiere <strong>factura electrónica</strong>, el valor tiene un aumento del <strong><?php echo $factura_pct ?>%</strong> y debe enviar el RUT. De igual forma, el servicio debe estar pago en su totalidad antes de finalizar el último trayecto.</td></tr>
        <tr><td class="l">I.</td><td>Todo servicio debe estar pago en su totalidad antes de hacer el regreso; de lo contrario, el vehículo no iniciará el recorrido de regreso hasta que se haya cancelado la totalidad o se refleje el pago o transferencia en nuestras cuentas.</td></tr>
    </table>

    <!-- ======================= CIERRE Y FIRMA ======================= -->
    <div style="page-break-inside:avoid; margin-top:18px">
        <p style="margin:0 0 4px; font-style:italic">Agradecemos por contactarnos y esperamos solucionar sus necesidades. Contamos con vehículos de modelos recientes, en muy buenas condiciones y con toda la seguridad.</p>
        <p style="margin:0 0 14px">Atento a sus comentarios.</p>
        <div class="muted" style="margin-bottom:6px">Cordialmente,</div>
        <?php if (!empty($firma)) { ?><div><img src="<?php echo $firma ?>" style="width:160px"></div><?php } ?>
        <div style="border-top:1px solid #16213A; width:210px; padding-top:4px">
            <?php if (!empty($firmante['nombre'])) { ?><strong><?php echo $e($firmante['nombre']) ?></strong><br><?php } ?>
            <span class="muted"><?php echo $e(isset($firmante['cargo']) ? $firmante['cargo'] : 'Gerente General') ?> · Transportes Dorado</span>
        </div>
    </div>
</body>

</html>
