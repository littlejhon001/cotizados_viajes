<?php
# Nota de Transparencia: Código generado/refactorizado con asistencia de IA Generativa (Claude Code) bajo la Política ODTI012 del CCS. Requiere supervisión y validación humana permanente.
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="page-head">
    <div>
        <h1>Nueva cotización</h1>
        <p>Arma una cotización formal, genera el PDF y envíala por correo o WhatsApp. No se guarda en el sistema.</p>
    </div>
    <span class="badge badge--ok" title="Referencia de esta cotización"><?php echo html_escape($referencia) ?></span>
</div>

<form id="formCot" class="cot" novalidate>
    <input type="hidden" name="referencia" value="<?php echo html_escape($referencia) ?>">

    <div class="cot__main">
        <!-- Cliente -->
        <section class="card">
            <div class="card__head"><h2 class="card__title">Cliente</h2></div>
            <div class="form-grid">
                <div class="field field--full">
                    <label for="cNombre">Nombre o empresa <span class="req" aria-hidden="true">*</span></label>
                    <input id="cNombre" name="cliente[nombre]" maxlength="150" required autocomplete="off">
                </div>
                <div class="field">
                    <label for="cDoc">NIT o documento</label>
                    <input id="cDoc" name="cliente[documento]" maxlength="30" autocomplete="off">
                </div>
                <div class="field">
                    <label for="cTel">Teléfono / WhatsApp</label>
                    <input id="cTel" name="cliente[telefono]" type="tel" maxlength="30" placeholder="300 123 4567" autocomplete="off">
                </div>
                <div class="field field--full">
                    <label for="cCorreo">Correo</label>
                    <input id="cCorreo" name="cliente[correo]" type="email" maxlength="150" placeholder="cliente@empresa.com" autocomplete="off">
                </div>
            </div>
        </section>

        <!-- Servicio -->
        <section class="card">
            <div class="card__head"><h2 class="card__title">Servicio</h2></div>
            <div class="form-grid form-grid--4">
                <div class="field">
                    <label for="vFecha">Fecha</label>
                    <input id="vFecha" name="viaje[fecha]" type="date">
                </div>
                <div class="field">
                    <label for="vHora">Hora</label>
                    <input id="vHora" name="viaje[hora]" type="time">
                </div>
                <div class="field">
                    <label for="vPax">Pasajeros</label>
                    <input id="vPax" name="viaje[pasajeros]" type="number" min="1" max="200" inputmode="numeric">
                </div>
                <div class="field field--full">
                    <label for="vOrigen">Lugar de recogida</label>
                    <input id="vOrigen" name="viaje[origen]" maxlength="200" placeholder="Dirección o punto de encuentro" autocomplete="off">
                </div>
            </div>
        </section>

        <!-- Ítems -->
        <section class="card">
            <div class="card__head">
                <h2 class="card__title">Ítems</h2>
                <button type="button" class="btn btn-ghost" id="btnLibre"><i class="bi bi-plus-lg" aria-hidden="true"></i> Línea libre</button>
            </div>

            <div class="tarifario" aria-label="Agregar desde el tarifario">
                <div class="tarifario__title"><i class="bi bi-lightning-charge" aria-hidden="true"></i> Agregar desde el tarifario</div>
                <div class="tarifario__row">
                    <label class="select select--grow">
                        <span class="visually-hidden">Destino</span>
                        <select id="tDestino">
                            <option value="">Destino…</option>
                            <?php foreach ($destinos as $d) { ?>
                                <option value="<?php echo $d['id'] ?>"><?php echo html_escape($d['nombre']) ?></option>
                            <?php } ?>
                        </select>
                    </label>
                    <label class="select select--grow">
                        <span class="visually-hidden">Vehículo</span>
                        <select id="tVehiculo">
                            <option value="">Vehículo…</option>
                            <?php foreach ($vehiculos as $v) { ?>
                                <option value="<?php echo $v['id'] ?>"><?php echo html_escape($v['nombre']) ?></option>
                            <?php } ?>
                        </select>
                    </label>
                    <label class="select">
                        <span class="visually-hidden">Duración</span>
                        <select id="tDias">
                            <?php foreach ($dias as $dia) { ?>
                                <option value="<?php echo $dia ?>"><?php echo $dia ?> <?php echo $dia == 1 ? 'día' : 'días' ?></option>
                            <?php } ?>
                        </select>
                    </label>
                    <button type="button" class="btn btn-primary" id="btnTarifa" disabled>Agregar</button>
                </div>
                <div class="tarifario__hint" id="tHint" aria-live="polite"></div>
            </div>

            <div class="items-wrap">
                <table class="tbl items-tbl">
                    <thead>
                        <tr>
                            <th scope="col">Descripción</th>
                            <th scope="col" class="it-fecha">Fecha</th>
                            <th scope="col" class="it-cant">Cant.</th>
                            <th scope="col" class="it-val">Valor unitario</th>
                            <th scope="col" class="it-tot">Total</th>
                            <th scope="col" class="col-actions"><span class="visually-hidden">Quitar</span></th>
                        </tr>
                    </thead>
                    <tbody id="items"></tbody>
                </table>
                <p class="items-empty" id="itemsVacio">Aún no hay ítems. Agrega uno desde el tarifario o una línea libre.</p>
            </div>
        </section>

        <!-- Condiciones -->
        <section class="card">
            <div class="card__head">
                <h2 class="card__title">Texto de la cotización</h2>
                <span class="card__meta">Las condiciones del servicio (A–I) se agregan automáticamente al PDF</span>
            </div>
            <div class="form-grid">
                <div class="field field--full">
                    <label for="intro">Introducción</label>
                    <textarea id="intro" name="intro" rows="2" maxlength="600"><?php echo html_escape($intro) ?></textarea>
                </div>
                <div class="field field--full">
                    <label for="obs">Observaciones (opcional)</label>
                    <textarea id="obs" name="observaciones" rows="3" maxlength="2000" placeholder="Paradas, itinerario, notas para el cliente…"><?php echo html_escape($condiciones) ?></textarea>
                </div>
            </div>
        </section>
    </div>

    <!-- Resumen -->
    <aside class="cot__side">
        <section class="card summary">
            <div class="card__head"><h2 class="card__title">Resumen</h2></div>
            <div class="summary__body">
                <div class="sum-row"><span>Subtotal</span><strong id="sSubtotal">$ 0</strong></div>
                <div class="sum-row sum-row--input">
                    <label for="descuento">Descuento</label>
                    <div class="money money--sm">
                        <span class="money__sym" aria-hidden="true">$</span>
                        <input id="descuento" name="descuento" class="money__input js-money" inputmode="numeric" maxlength="13" placeholder="0">
                    </div>
                </div>
                <label class="sum-row check">
                    <span><input type="checkbox" id="iva" name="iva" value="1"> Aplicar IVA (19%)</span>
                    <strong id="sIva">$ 0</strong>
                </label>
                <label class="sum-row check">
                    <span><input type="checkbox" id="factura" name="factura" value="1"> Factura electrónica (<?php echo (int) $factura_porcentaje ?>%)</span>
                    <strong id="sFactura">$ 0</strong>
                </label>
                <div class="sum-row sum-row--total"><span>Total</span><strong id="sTotal">$ 0</strong></div>
                <div class="sum-row sum-row--input">
                    <label for="horaAdicional">Hora adicional</label>
                    <div class="money money--sm">
                        <span class="money__sym" aria-hidden="true">$</span>
                        <input id="horaAdicional" name="hora_adicional" class="money__input js-money" inputmode="numeric" maxlength="11" value="<?php echo number_format((int) $hora_adicional, 0, ',', '.') ?>">
                    </div>
                </div>
                <div class="sum-row sum-row--input">
                    <label for="vigencia">Vigencia</label>
                    <div class="inline-unit">
                        <input id="vigencia" name="vigencia" type="number" min="1" max="90" value="15" inputmode="numeric">
                        <span>días</span>
                    </div>
                </div>
                <div class="form-alert" id="alerta" role="alert" hidden></div>
            </div>
            <div class="summary__actions">
                <button type="button" class="btn btn-primary btn-block" id="btnPdf"><i class="bi bi-file-earmark-pdf" aria-hidden="true"></i> Descargar PDF</button>
                <button type="button" class="btn btn-ghost btn-block" id="btnCorreo"><i class="bi bi-envelope" aria-hidden="true"></i> Enviar por correo</button>
                <button type="button" class="btn btn-ghost btn-block" id="btnWa"><i class="bi bi-whatsapp" aria-hidden="true"></i> Enviar por WhatsApp</button>
                <p class="summary__note">WhatsApp: se descarga el PDF y se abre el chat con el mensaje listo. Adjunta el PDF en la conversación.</p>
            </div>
        </section>
    </aside>
</form>

<template id="tplItem">
    <tr class="item">
        <td>
            <label class="visually-hidden">Descripción</label>
            <textarea class="it-input it-input--desc js-desc" rows="2" maxlength="255" placeholder="Descripción del servicio"></textarea>
        </td>
        <td class="it-fecha">
            <label class="visually-hidden">Fecha del servicio</label>
            <input class="it-input js-fecha" type="date">
        </td>
        <td class="it-cant">
            <label class="visually-hidden">Cantidad</label>
            <input class="it-input it-input--num js-cant" type="number" min="0.5" step="0.5" max="1000" value="1" inputmode="decimal">
        </td>
        <td class="it-val">
            <label class="visually-hidden">Valor unitario</label>
            <div class="money money--sm">
                <span class="money__sym" aria-hidden="true">$</span>
                <input class="money__input js-money js-val" inputmode="numeric" maxlength="13" placeholder="0">
            </div>
        </td>
        <td class="it-tot js-tot">$ 0</td>
        <td class="col-actions">
            <button type="button" class="btn btn-icon is-danger js-quitar" aria-label="Quitar ítem"><i class="bi bi-x-lg" aria-hidden="true"></i></button>
        </td>
    </tr>
</template>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var IVA = 0.19;
        var FACTURA = <?php echo (int) $factura_porcentaje ?> / 100;
        var $form = $('#formCot');
        var $items = $('#items');
        var tpl = document.getElementById('tplItem');

        var digitos = function (v) { return String(v || '').replace(/\D/g, ''); };
        var cop = function (n) { return '$ ' + Math.round(n || 0).toLocaleString('es-CO'); };
        var formatearMoney = function (el) {
            var d = digitos(el.value).replace(/^0+(?=\d)/, '');
            el.value = d === '' ? '' : Number(d).toLocaleString('es-CO');
        };

        function alerta(msg) {
            $('#alerta').text(msg || '').prop('hidden', !msg);
        }

        function agregarItem(desc, valor) {
            var $tr = $(tpl.content.cloneNode(true)).find('tr');
            $tr.find('.js-desc').val(desc || '');
            if (valor) { $tr.find('.js-val').val(Number(valor).toLocaleString('es-CO')); }
            $items.append($tr);
            recalcular();
            return $tr;
        }

        function recalcular() {
            var subtotal = 0;
            $items.find('tr.item').each(function () {
                var cant = parseFloat($(this).find('.js-cant').val()) || 0;
                var val = Number(digitos($(this).find('.js-val').val())) || 0;
                var tot = Math.round(cant * val);
                subtotal += tot;
                $(this).find('.js-tot').text(cop(tot));
            });
            var desc = Math.min(Number(digitos($('#descuento').val())) || 0, subtotal);
            var base = subtotal - desc;
            var iva = $('#iva').is(':checked') ? Math.round(base * IVA) : 0;
            var factura = $('#factura').is(':checked') ? Math.round(base * FACTURA) : 0;
            $('#sSubtotal').text(cop(subtotal));
            $('#sIva').text(cop(iva));
            $('#sFactura').text(cop(factura));
            $('#sTotal').text(cop(base + iva + factura));
            $('#itemsVacio').prop('hidden', $items.children().length > 0);
            return { total: base + iva + factura };
        }

        $form.on('input', '.js-money', function () { formatearMoney(this); });
        $form.on('input change', 'input', recalcular);
        $items.on('click', '.js-quitar', function () { $(this).closest('tr').remove(); recalcular(); });
        $('#btnLibre').on('click', function () { agregarItem('', '').find('.js-desc').trigger('focus'); });

        // Tarifario: consulta la tarifa configurada para destino + vehículo + días
        var tarifa = null;
        function consultarTarifa() {
            tarifa = null;
            var d = $('#tDestino').val(), v = $('#tVehiculo').val(), dias = $('#tDias').val();
            $('#btnTarifa').prop('disabled', !(d && v));
            if (!(d && v)) { $('#tHint').text(''); return; }
            $('#tHint').text('Consultando tarifa…');
            $.post(Admin.base + 'Home/get_tarifa', { id_destino: d, id_vehiculo: v, dia: dias }, null, 'json')
                .done(function (r) {
                    var valor = r && r[0] ? Math.round(Number(r[0].tarifa)) : 0;
                    tarifa = valor;
                    $('#tHint').text(valor > 0 ? 'Tarifa: ' + cop(valor) + ' (puedes ajustarla después)'
                        : 'Sin tarifa para esta combinación. Se agregará con valor 0 para que lo completes.');
                })
                .fail(function () { $('#tHint').text('No se pudo consultar la tarifa.'); });
        }
        $('#tDestino, #tVehiculo, #tDias').on('change', consultarTarifa);
        $('#btnTarifa').on('click', function () {
            var dias = Number($('#tDias').val());
            var desc = 'Transporte a ' + $('#tDestino option:selected').text() + ' · ' + $('#tVehiculo option:selected').text()
                + ' · ' + dias + (dias === 1 ? ' día' : ' días');
            var $tr = agregarItem(desc, tarifa || '');
            if (!tarifa) { $tr.find('.js-val').trigger('focus'); }
        });

        // Datos a enviar al servidor (los totales se recalculan allá)
        function datos() {
            var nombre = $.trim($('#cNombre').val());
            if (nombre === '') { $('#cNombre').trigger('focus'); return alerta('Ingresa el nombre del cliente.'), null; }
            var $rows = $items.find('tr.item');
            if ($rows.length === 0) { return alerta('Agrega al menos un ítem.'), null; }
            var malo = null;
            $rows.each(function (i) {
                if ($.trim($(this).find('.js-desc').val()) === '') { malo = $(this).find('.js-desc'); return false; }
                if (digitos($(this).find('.js-val').val()) === '') { malo = $(this).find('.js-val'); return false; }
            });
            if (malo) { malo.trigger('focus'); return alerta('Completa la descripción y el valor de todos los ítems.'), null; }
            alerta('');

            var fd = new FormData($form[0]);
            $rows.each(function (i) {
                fd.append('items[' + i + '][descripcion]', $(this).find('.js-desc').val());
                fd.append('items[' + i + '][cantidad]', $(this).find('.js-cant').val());
                fd.append('items[' + i + '][valor]', digitos($(this).find('.js-val').val()));
                fd.append('items[' + i + '][fecha]', $(this).find('.js-fecha').val() || '');
            });
            fd.set('descuento', digitos($('#descuento').val()));
            fd.set('hora_adicional', digitos($('#horaAdicional').val()));
            return fd;
        }

        function ocupado($btn, on, texto) {
            if (on) { $btn.data('html', $btn.html()).prop('disabled', true).text(texto); }
            else { $btn.prop('disabled', false).html($btn.data('html')); }
        }

        // Genera el PDF y lo descarga. Devuelve una promesa
        function descargarPdf() {
            var fd = datos();
            if (!fd) { return Promise.reject(); }
            return fetch(Admin.base + 'Home/cotizacion_formal_pdf', {
                method: 'POST', body: fd, credentials: 'same-origin',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            }).then(function (res) {
                if (res.status === 401) { location.assign(Admin.base + 'login'); throw new Error(''); }
                var tipo = res.headers.get('Content-Type') || '';
                if (tipo.indexOf('application/pdf') === -1) {
                    return res.json().then(function (j) { throw new Error((j && j.msg) || 'No se pudo generar el PDF.'); });
                }
                return res.blob();
            }).then(function (blob) {
                var a = document.createElement('a');
                a.href = URL.createObjectURL(blob);
                a.download = $form.find('[name=referencia]').val() + '.pdf';
                document.body.appendChild(a);
                a.click();
                setTimeout(function () { URL.revokeObjectURL(a.href); a.remove(); }, 1000);
            }).catch(function (err) {
                if (err && err.message) { alerta(err.message); }
                throw err;
            });
        }

        $('#btnPdf').on('click', function () {
            var $b = $(this);
            ocupado($b, true, 'Generando…');
            descargarPdf().then(function () { Admin.toast('PDF descargado'); }).catch(function () {})
                .then(function () { ocupado($b, false); });
        });

        $('#btnCorreo').on('click', function () {
            var correo = $.trim($('#cCorreo').val());
            if (correo === '' || !$('#cCorreo')[0].checkValidity()) {
                $('#cCorreo').trigger('focus');
                return alerta('Ingresa un correo válido del cliente para enviar la cotización.');
            }
            var fd = datos();
            if (!fd) { return; }
            var $b = $(this);
            ocupado($b, true, 'Enviando…');
            $.ajax({ url: Admin.base + 'Home/cotizacion_formal_enviar', type: 'POST', data: fd, processData: false, contentType: false, dataType: 'json' })
                .done(function (r) {
                    if (r && r.success == 1) { Admin.toast('Cotización enviada a ' + correo); }
                    else { alerta((r && r.msg) || 'No se pudo enviar el correo.'); }
                })
                .fail(function (xhr) {
                    if (xhr.status === 401) { return location.assign(Admin.base + 'login'); }
                    alerta('No se pudo conectar con el servidor.');
                })
                .always(function () { ocupado($b, false); });
        });

        // WhatsApp: descarga el PDF y abre el chat con el mensaje listo para adjuntarlo
        $('#btnWa').on('click', function () {
            var tel = digitos($('#cTel').val());
            if (tel.length === 10 && tel[0] === '3') { tel = '57' + tel; }
            var nombre = $.trim($('#cNombre').val());
            var ref = $form.find('[name=referencia]').val();
            var vig = Number($('#vigencia').val()) || 15;
            var vence = new Date(Date.now() + vig * 86400000).toLocaleDateString('es-CO');
            var msg = 'Hola ' + nombre + ', te compartimos la cotización ' + ref + ' de Transportes Dorado por un total de '
                + $('#sTotal').text() + ', válida hasta el ' + vence + '. Te adjuntamos el PDF con el detalle.';
            var url = (tel.length >= 10 ? 'https://wa.me/' + tel : 'https://wa.me/') + '?text=' + encodeURIComponent(msg);

            // La ventana se abre en el clic para que el navegador no la bloquee
            var win = window.open('about:blank', '_blank');
            var $b = $(this);
            ocupado($b, true, 'Preparando…');
            descargarPdf().then(function () {
                if (win) { win.location = url; } else { location.assign(url); }
                Admin.toast('PDF descargado: adjúntalo en el chat');
            }).catch(function () { if (win) { win.close(); } })
                .then(function () { ocupado($b, false); });
        });

        recalcular();
    });
</script>
