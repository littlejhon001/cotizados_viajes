<?php
# Nota de Transparencia: Código generado/refactorizado con asistencia de IA Generativa (Claude Code) bajo la Política ODTI012 del CCS. Requiere supervisión y validación humana permanente.
defined('BASEPATH') or exit('No direct script access allowed');

$limpiar = function ($texto) {
    return trim(preg_replace('/\s+/u', ' ', (string) $texto));
};
usort($vehiculos, function ($a, $b) {
    return (int) $a->orden - (int) $b->orden;
});

$nombre_destino = $limpiar($destino->destino);
$total = count($vehiculos) * count($dias);
$configuradas = 0;
foreach ($dias as $dia) {
    foreach ($vehiculos as $v) {
        if (!empty($precios[$dia][$v->id]) && (float) $precios[$dia][$v->id] > 0) {
            $configuradas++;
        }
    }
}
?>
<a class="back-link" href="<?php echo IP_SERVER ?>Home/admin">
    <i class="bi bi-arrow-left" aria-hidden="true"></i> Destinos
</a>

<div class="page-head">
    <div>
        <h1><?php echo html_escape($nombre_destino) ?></h1>
        <p>Tarifa por vehículo según la duración del viaje. Deja el campo vacío o en 0 si esa combinación no se ofrece.</p>
    </div>
    <div class="page-head__stat">
        <span class="badge <?php echo $configuradas ? 'badge--ok' : 'badge--warn' ?>" id="resumenTarifas">
            <?php echo $configuradas ?> de <?php echo $total ?> tarifas
        </span>
    </div>
</div>

<form id="formTarifas" novalidate>
    <input type="hidden" name="id_destino" value="<?php echo (int) $destino->id ?>">

    <section class="card">
        <div class="card__head">
            <h2 class="card__title">Tarifas en pesos (COP)</h2>
            <div class="day-tabs" role="tablist" aria-label="Duración del viaje">
                <?php foreach ($dias as $i => $dia) { ?>
                    <button type="button" role="tab" class="day-tab" data-col="<?php echo $i ?>"
                        aria-selected="<?php echo $i === 0 ? 'true' : 'false' ?>">
                        <?php echo $dia ?> <?php echo $dia == 1 ? 'día' : 'días' ?>
                    </button>
                <?php } ?>
            </div>
        </div>

        <div class="rates-wrap">
            <table class="tbl rates" id="tablaTarifas" data-col="0">
                <thead>
                    <tr>
                        <th scope="col" class="rates__veh">Vehículo</th>
                        <?php foreach ($dias as $i => $dia) { ?>
                            <th scope="col" class="rates__day" data-col="<?php echo $i ?>">
                                <?php echo $dia ?> <?php echo $dia == 1 ? 'día' : 'días' ?>
                            </th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vehiculos as $v) {
                        $nombre_vehiculo = $limpiar($v->vehiculo); ?>
                        <tr>
                            <th scope="row" class="rates__veh">
                                <i class="bi bi-bus-front" aria-hidden="true"></i>
                                <?php echo html_escape($nombre_vehiculo) ?>
                            </th>
                            <?php foreach ($dias as $i => $dia) {
                                $valor = isset($precios[$dia][$v->id]) ? (float) $precios[$dia][$v->id] : 0;
                                $id_input = 'p_' . $dia . '_' . (int) $v->id; ?>
                                <td class="rates__day" data-col="<?php echo $i ?>">
                                    <label class="visually-hidden" for="<?php echo $id_input ?>">
                                        <?php echo html_escape($nombre_vehiculo) ?>, <?php echo $dia ?> <?php echo $dia == 1 ? 'día' : 'días' ?>
                                    </label>
                                    <div class="money">
                                        <span class="money__sym" aria-hidden="true">$</span>
                                        <input type="text" inputmode="numeric" autocomplete="off" maxlength="12"
                                            id="<?php echo $id_input ?>" class="money__input"
                                            data-dia="<?php echo (int) $dia ?>" data-veh="<?php echo (int) $v->id ?>"
                                            data-original="<?php echo $valor > 0 ? (int) round($valor) : '' ?>"
                                            value="<?php echo $valor > 0 ? number_format($valor, 0, ',', '.') : '' ?>"
                                            placeholder="No disponible">
                                    </div>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>

    <div class="savebar" id="savebar" aria-live="polite">
        <span class="savebar__text" id="savebarText">Sin cambios</span>
        <div class="savebar__actions">
            <button type="button" class="btn btn-ghost" id="btnDescartar" disabled>Descartar</button>
            <button type="submit" class="btn btn-primary" id="btnGuardar" disabled>
                <i class="bi bi-check2" aria-hidden="true"></i> Guardar tarifas
            </button>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var $form = $('#formTarifas');
        var $inputs = $form.find('.money__input');
        var $btnGuardar = $('#btnGuardar');
        var $btnDescartar = $('#btnDescartar');
        var total = $inputs.length;
        var guardando = false;

        function soloDigitos(v) { return String(v || '').replace(/\D/g, '').replace(/^0+(?=\d)/, ''); }
        function formatear(d) { return d === '' ? '' : Number(d).toLocaleString('es-CO'); }
        function valor(el) {
            var d = soloDigitos(el.value);
            return d === '' || Number(d) === 0 ? '' : d;
        }

        function refrescar() {
            var cambios = 0, configuradas = 0;
            $inputs.each(function () {
                var v = valor(this);
                var cambiado = v !== String(this.getAttribute('data-original'));
                this.classList.toggle('is-dirty', cambiado);
                if (cambiado) { cambios++; }
                if (v !== '') { configuradas++; }
            });
            $('#savebar').toggleClass('has-changes', cambios > 0);
            $('#savebarText').text(cambios === 0 ? 'Sin cambios'
                : cambios + (cambios === 1 ? ' tarifa modificada' : ' tarifas modificadas'));
            $btnGuardar.prop('disabled', cambios === 0 || guardando);
            $btnDescartar.prop('disabled', cambios === 0 || guardando);
            $('#resumenTarifas').text(configuradas + ' de ' + total + ' tarifas')
                .toggleClass('badge--ok', configuradas > 0).toggleClass('badge--warn', configuradas === 0);
            return cambios;
        }

        // Formato de miles mientras se escribe, conservando la posición del cursor
        $inputs.on('input', function () {
            var digitosAntes = soloDigitos(this.value.slice(0, this.selectionStart)).length;
            var d = soloDigitos(this.value);
            this.value = formatear(d);
            var pos = 0, vistos = 0;
            while (pos < this.value.length && vistos < digitosAntes) {
                if (/\d/.test(this.value[pos])) { vistos++; }
                pos++;
            }
            this.setSelectionRange(pos, pos);
            refrescar();
        });

        // Enter baja a la siguiente fila de la misma columna
        $inputs.on('keydown', function (e) {
            if (e.key !== 'Enter') { return; }
            e.preventDefault();
            var col = $(this).closest('td').data('col');
            var $next = $(this).closest('tr').next('tr').find('td[data-col="' + col + '"] .money__input');
            ($next.length ? $next : $btnGuardar).trigger('focus');
        });

        $btnDescartar.on('click', function () {
            $inputs.each(function () { this.value = formatear(this.getAttribute('data-original')); });
            refrescar();
        });

        // Pestañas de días (solo visibles en pantallas pequeñas)
        $('.day-tab').on('click', function () {
            var col = $(this).data('col');
            $('.day-tab').attr('aria-selected', 'false');
            $(this).attr('aria-selected', 'true');
            $('#tablaTarifas').attr('data-col', col);
        });

        $form.on('submit', function (e) {
            e.preventDefault();
            if (refrescar() === 0 || guardando) { return; }

            // Solo se envían las celdas modificadas: las demás conservan su valor exacto en la base
            var data = { id_destino: $form.find('[name=id_destino]').val() };
            $inputs.filter('.is-dirty').each(function () {
                data['precios[' + this.getAttribute('data-dia') + '][' + this.getAttribute('data-veh') + ']'] = valor(this) || '0';
            });

            guardando = true;
            $btnGuardar.prop('disabled', true).html('Guardando…');
            $btnDescartar.prop('disabled', true);

            Admin.post('home/guardar_precios', data)
                .done(function (r) {
                    if (r && r.success == 1) {
                        $inputs.each(function () { this.setAttribute('data-original', valor(this)); });
                        Admin.toast('Tarifas guardadas');
                    } else {
                        Admin.toast((r && r.msg) || 'No se pudieron guardar las tarifas.', 'error');
                    }
                })
                .fail(function (xhr) {
                    if (xhr.status !== 401) { Admin.toast('No se pudo conectar con el servidor.', 'error'); }
                })
                .always(function () {
                    guardando = false;
                    $btnGuardar.html('<i class="bi bi-check2" aria-hidden="true"></i> Guardar tarifas');
                    refrescar();
                });
        });

        // Aviso si se intenta salir con cambios sin guardar
        window.addEventListener('beforeunload', function (e) {
            if (refrescar() > 0) { e.preventDefault(); e.returnValue = ''; }
        });

        refrescar();
    });
</script>
