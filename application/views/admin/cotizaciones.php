<?php
# Nota de Transparencia: Código generado/refactorizado con asistencia de IA Generativa (Claude Code) bajo la Política ODTI012 del CCS. Requiere supervisión y validación humana permanente.
defined('BASEPATH') or exit('No direct script access allowed');

// Enlace de WhatsApp: celulares colombianos de 10 dígitos reciben el indicativo 57
$whatsapp = function ($tel) {
    $d = preg_replace('/\D/', '', (string) $tel);
    if (strlen($d) === 10 && $d[0] === '3') {
        $d = '57' . $d;
    }
    return strlen($d) >= 10 ? 'https://wa.me/' . $d : '';
};
?>
<div class="page-head">
    <div>
        <h1>Solicitudes web</h1>
        <p>Solicitudes que los clientes enviaron desde el cotizador. Contáctalos para confirmar el viaje.</p>
    </div>
    <button class="btn btn-ghost" type="button" id="btnExportar">
        <i class="bi bi-download" aria-hidden="true"></i> Exportar CSV
    </button>
</div>

<section class="kpis" aria-label="Resumen">
    <div class="kpi">
        <span class="kpi__icon kpi__icon--teal"><i class="bi bi-receipt" aria-hidden="true"></i></span>
        <div>
            <div class="kpi__label">Total</div>
            <div class="kpi__value"><?php echo (int) $stats['total'] ?></div>
            <div class="kpi__hint">Cotizaciones válidas</div>
        </div>
    </div>
    <div class="kpi">
        <span class="kpi__icon kpi__icon--green"><i class="bi bi-calendar-week" aria-hidden="true"></i></span>
        <div>
            <div class="kpi__label">Últimos 7 días</div>
            <div class="kpi__value"><?php echo (int) $stats['ult7'] ?></div>
            <div class="kpi__hint">Por contactar esta semana</div>
        </div>
    </div>
    <div class="kpi">
        <span class="kpi__icon kpi__icon--blue"><i class="bi bi-calendar3" aria-hidden="true"></i></span>
        <div>
            <div class="kpi__label">Últimos 30 días</div>
            <div class="kpi__value"><?php echo (int) $stats['ult30'] ?></div>
            <div class="kpi__hint">Mes en curso</div>
        </div>
    </div>
    <div class="kpi">
        <span class="kpi__icon kpi__icon--orange"><i class="bi bi-trophy" aria-hidden="true"></i></span>
        <div style="min-width:0">
            <div class="kpi__label">Destino más cotizado</div>
            <div class="kpi__value kpi__value--text" title="<?php echo html_escape($top_destino ? $top_destino['nombre'] : '') ?>">
                <?php echo $top_destino ? html_escape($top_destino['nombre']) : '—' ?>
            </div>
            <div class="kpi__hint"><?php echo $top_destino ? (int) $top_destino['total'] . ' cotizaciones' : '' ?></div>
        </div>
    </div>
</section>

<section class="card" aria-labelledby="tituloListado">
    <div class="card__head">
        <div>
            <h2 class="card__title" id="tituloListado">Solicitudes</h2>
            <div class="card__meta" id="contador"></div>
        </div>
        <div class="filters">
            <label class="search">
                <span class="visually-hidden">Buscar cotización</span>
                <i class="bi bi-search" aria-hidden="true"></i>
                <input type="search" id="buscar" placeholder="Cliente, teléfono, destino…" autocomplete="off">
            </label>
            <label class="select">
                <span class="visually-hidden">Periodo</span>
                <select id="periodo">
                    <option value="0">Todo el historial</option>
                    <option value="7">Últimos 7 días</option>
                    <option value="30">Últimos 30 días</option>
                    <option value="90">Últimos 90 días</option>
                </select>
            </label>
            <?php if ($stats['sospechosas']) { ?>
                <label class="check">
                    <input type="checkbox" id="verSospechosas">
                    Ver sospechosas (<?php echo (int) $stats['sospechosas'] ?>)
                </label>
            <?php } ?>
        </div>
    </div>

    <div class="table-wrap table-wrap--tall">
        <table class="tbl quotes">
            <thead>
                <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Viaje</th>
                    <th scope="col" class="quotes__price">Precio</th>
                    <th scope="col" class="col-actions"><span class="visually-hidden">Acciones</span></th>
                </tr>
            </thead>
            <tbody id="tablaCotizaciones">
                <?php foreach ($cotizaciones as $c) {
                    $wa = $whatsapp($c['telefono']);
                    $buscable = mb_strtolower($c['nombre'] . ' ' . $c['telefono'] . ' ' . $c['correo'] . ' ' . $c['trayecto'] . ' ' . $c['vehiculo']); ?>
                    <tr data-id="<?php echo $c['id'] ?>" data-ts="<?php echo (int) $c['ts'] ?>"
                        data-q="<?php echo html_escape($buscable) ?>" <?php echo $c['sospechosa'] ? 'data-sospechosa="1" hidden' : '' ?>>
                        <td class="quotes__date">
                            <?php echo html_escape($c['fecha']) ?>
                            <?php if ($c['sospechosa']) { ?><span class="badge badge--warn">Sospechosa</span><?php } ?>
                        </td>
                        <td>
                            <div class="tbl__name pii"><?php echo html_escape($c['nombre'] ?: 'Sin nombre') ?></div>
                            <div class="quotes__sub">
                                <span class="pii"><?php echo html_escape($c['telefono']) ?></span>
                                <?php if ($c['correo']) { ?> · <span class="pii"><?php echo html_escape($c['correo']) ?></span><?php } ?>
                            </div>
                        </td>
                        <td>
                            <div class="tbl__name"><?php echo html_escape($c['trayecto'] ?: '—') ?></div>
                            <div class="quotes__sub">
                                <?php echo html_escape($c['vehiculo']) ?>
                                <?php if ($c['dia']) { ?> · <?php echo $c['dia'] ?> <?php echo $c['dia'] == 1 ? 'día' : 'días' ?><?php } ?>
                                <?php if ($c['mascota']) { ?> · <i class="bi bi-heart" title="Viaja con mascota" aria-label="Viaja con mascota"></i><?php } ?>
                                <?php if ($c['comentarios']) { ?> · <i class="bi bi-chat-left-text" title="Tiene comentarios" aria-label="Tiene comentarios"></i><?php } ?>
                            </div>
                        </td>
                        <td class="quotes__price"><?php echo html_escape($c['precio'] ?: '—') ?></td>
                        <td class="col-actions">
                            <?php if ($wa) { ?>
                                <a class="btn btn-icon" href="<?php echo html_escape($wa) ?>" target="_blank" rel="noopener"
                                    title="Escribir por WhatsApp" aria-label="Escribir por WhatsApp">
                                    <i class="bi bi-whatsapp" aria-hidden="true"></i>
                                </a>
                            <?php } ?>
                            <button class="btn btn-icon js-detalle" type="button" title="Ver detalle" aria-label="Ver detalle">
                                <i class="bi bi-chevron-right" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                <?php } ?>
                <tr class="tbl__empty" id="sinResultados" hidden>
                    <td colspan="5">No hay cotizaciones que coincidan con los filtros.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="pager" id="pager">
        <button class="btn btn-ghost" type="button" id="pagPrev"><i class="bi bi-chevron-left" aria-hidden="true"></i> Anterior</button>
        <span class="pager__info" id="pagInfo" aria-live="polite"></span>
        <button class="btn btn-ghost" type="button" id="pagNext">Siguiente <i class="bi bi-chevron-right" aria-hidden="true"></i></button>
    </div>
</section>

<!-- Detalle -->
<dialog class="dlg dlg--wide" id="dlgDetalle" aria-labelledby="detTitulo">
    <div class="dlg__body">
        <div class="det__head">
            <div>
                <h2 class="dlg__title" id="detTitulo"></h2>
                <p class="dlg__text" id="detFecha"></p>
            </div>
            <button class="btn btn-icon" type="button" data-close aria-label="Cerrar"><i class="bi bi-x-lg" aria-hidden="true"></i></button>
        </div>
        <dl class="det" id="detDatos"></dl>
    </div>
    <div class="dlg__foot">
        <a class="btn btn-ghost" id="detCorreo" href="#"><i class="bi bi-envelope" aria-hidden="true"></i> Correo</a>
        <a class="btn btn-primary" id="detWhatsapp" href="#" target="_blank" rel="noopener"><i class="bi bi-whatsapp" aria-hidden="true"></i> WhatsApp</a>
    </div>
</dialog>

<script type="application/json" id="datosCotizaciones"><?php
    $mapa = array();
    foreach ($cotizaciones as $c) {
        $c['whatsapp'] = $whatsapp($c['telefono']);
        $mapa[$c['id']] = $c;
    }
    echo json_encode($mapa, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE);
?></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var POR_PAGINA = 25;
        var datos = JSON.parse(document.getElementById('datosCotizaciones').textContent || '{}');
        var $filas = $('#tablaCotizaciones tr[data-id]');
        var filtradas = [];
        var pagina = 0;

        function filtrar() {
            var q = $.trim($('#buscar').val()).toLowerCase();
            var dias = Number($('#periodo').val());
            var desde = dias ? (Date.now() / 1000) - dias * 86400 : 0;
            var verSosp = $('#verSospechosas').is(':checked');
            filtradas = $filas.filter(function () {
                if (this.getAttribute('data-sospechosa') && !verSosp) { return false; }
                if (desde && Number(this.getAttribute('data-ts')) < desde) { return false; }
                return q === '' || this.getAttribute('data-q').indexOf(q) !== -1;
            }).toArray();
            pagina = 0;
            pintar();
        }

        function pintar() {
            var paginas = Math.max(1, Math.ceil(filtradas.length / POR_PAGINA));
            pagina = Math.min(pagina, paginas - 1);
            var ini = pagina * POR_PAGINA;
            var visibles = filtradas.slice(ini, ini + POR_PAGINA);
            $filas.prop('hidden', true);
            $(visibles).prop('hidden', false);
            $('#sinResultados').prop('hidden', filtradas.length > 0);
            $('#contador').text(filtradas.length + (filtradas.length === 1 ? ' cotización' : ' cotizaciones'));
            $('#pagInfo').text(filtradas.length ? (ini + 1) + '–' + (ini + visibles.length) + ' de ' + filtradas.length : '');
            $('#pagPrev').prop('disabled', pagina === 0);
            $('#pagNext').prop('disabled', pagina >= paginas - 1);
            $('#pager').prop('hidden', filtradas.length <= POR_PAGINA);
        }

        $('#buscar').on('input', filtrar);
        $('#periodo, #verSospechosas').on('change', filtrar);
        $('#pagPrev').on('click', function () { pagina--; pintar(); $('.table-wrap').scrollTop(0); });
        $('#pagNext').on('click', function () { pagina++; pintar(); $('.table-wrap').scrollTop(0); });

        // Detalle
        var dlg = document.getElementById('dlgDetalle');
        $('[data-close]').on('click', function () { this.closest('dialog').close(); });
        dlg.addEventListener('click', function (e) { if (e.target === dlg) { dlg.close(); } });

        function fila(label, valor) {
            if (valor === '' || valor === null || valor === undefined) { valor = '—'; }
            return $('<div class="det__row"></div>').append($('<dt></dt>').text(label), $('<dd></dd>').text(String(valor)));
        }

        $('#tablaCotizaciones').on('click', '.js-detalle', function () {
            var c = datos[$(this).closest('tr').data('id')];
            if (!c) { return; }
            $('#detTitulo').text(c.nombre || 'Sin nombre');
            $('#detFecha').text('Solicitada el ' + c.fecha + (c.sospechosa ? ' · Marcada como sospechosa' : ''));
            $('#detDatos').empty().append(
                fila('Teléfono', c.telefono),
                fila('Correo', c.correo),
                fila('Destino', c.trayecto),
                fila('Vehículo', c.vehiculo),
                fila('Duración', c.dia ? c.dia + (c.dia == 1 ? ' día' : ' días') : ''),
                fila('Precio cotizado', c.precio),
                fila('Dirección de recogida', c.direccion),
                fila('Hora', c.hora),
                fila('Mascota', c.mascota ? 'Sí' : 'No'),
                fila('Quiere más información', c.more_info ? 'Sí' : 'No'),
                fila('Aceptó política de datos', c.politica ? 'Sí' : 'No'),
                fila('Comentarios', c.comentarios).addClass('det__row--full')
            );
            $('#detCorreo').attr('href', c.correo ? 'mailto:' + c.correo : '#').prop('hidden', !c.correo);
            $('#detWhatsapp').attr('href', c.whatsapp || '#').prop('hidden', !c.whatsapp);
            dlg.showModal();
        });

        // Exporta las filas filtradas (todas las páginas). Separador ";" y BOM para que Excel en español lo abra bien
        $('#btnExportar').on('click', function () {
            var cols = [['fecha', 'Fecha'], ['nombre', 'Cliente'], ['telefono', 'Teléfono'], ['correo', 'Correo'],
                ['trayecto', 'Destino'], ['vehiculo', 'Vehículo'], ['dia', 'Días'], ['precio', 'Precio'],
                ['direccion', 'Dirección'], ['hora', 'Hora'], ['mascota', 'Mascota'], ['comentarios', 'Comentarios']];
            var celda = function (v) {
                if (typeof v === 'boolean') { v = v ? 'Sí' : 'No'; }
                v = String(v === null || v === undefined ? '' : v);
                if (/^[=+\-@]/.test(v)) { v = "'" + v; } // evita inyección de fórmulas en Excel
                return '"' + v.replace(/"/g, '""') + '"';
            };
            var lineas = [cols.map(function (c) { return celda(c[1]); }).join(';')];
            filtradas.forEach(function (tr) {
                var c = datos[tr.getAttribute('data-id')];
                lineas.push(cols.map(function (col) { return celda(c[col[0]]); }).join(';'));
            });
            var blob = new Blob(['﻿' + lineas.join('\r\n')], { type: 'text/csv;charset=utf-8' });
            var a = document.createElement('a');
            a.href = URL.createObjectURL(blob);
            a.download = 'cotizaciones_' + new Date().toISOString().slice(0, 10) + '.csv';
            document.body.appendChild(a);
            a.click();
            setTimeout(function () { URL.revokeObjectURL(a.href); a.remove(); }, 0);
            Admin.toast(filtradas.length + ' cotizaciones exportadas');
        });

        filtrar();
    });
</script>
