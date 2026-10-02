<?php
# Nota de Transparencia: Código generado/refactorizado con asistencia de IA Generativa (Claude Code) bajo la Política ODTI012 del CCS. Requiere supervisión y validación humana permanente.
defined('BASEPATH') or exit('No direct script access allowed');

// Los textos de las cotizaciones se guardan con saltos de línea y espacios del HTML de origen
$limpiar = function ($texto) {
    return trim(preg_replace('/\s+/u', ' ', (string) $texto));
};
?>
<div class="page-head">
    <div>
        <h1>Destinos y tarifas</h1>
        <p>Administra los destinos que los clientes pueden cotizar y sus precios por vehículo.</p>
    </div>
    <button class="btn btn-primary" type="button" id="btnNuevo">
        <i class="bi bi-plus-lg" aria-hidden="true"></i> Nuevo destino
    </button>
</div>

<section class="kpis" aria-label="Resumen">
    <div class="kpi">
        <span class="kpi__icon kpi__icon--teal"><i class="bi bi-geo-alt" aria-hidden="true"></i></span>
        <div>
            <div class="kpi__label">Destinos</div>
            <div class="kpi__value"><?php echo (int) $stats['destinos'] ?></div>
            <div class="kpi__hint">Disponibles en el cotizador</div>
        </div>
    </div>
    <div class="kpi">
        <span class="kpi__icon <?php echo $stats['sin_tarifa'] ? 'kpi__icon--orange' : 'kpi__icon--green' ?>">
            <i class="bi <?php echo $stats['sin_tarifa'] ? 'bi-exclamation-triangle' : 'bi-check2-circle' ?>" aria-hidden="true"></i>
        </span>
        <div>
            <div class="kpi__label">Sin tarifas</div>
            <div class="kpi__value"><?php echo (int) $stats['sin_tarifa'] ?></div>
            <?php if ($stats['sin_tarifa']) { ?>
                <div class="kpi__hint is-warn">No se pueden cotizar aún</div>
            <?php } else { ?>
                <div class="kpi__hint is-ok">Todos tienen precio</div>
            <?php } ?>
        </div>
    </div>
    <div class="kpi">
        <span class="kpi__icon kpi__icon--blue"><i class="bi bi-bus-front" aria-hidden="true"></i></span>
        <div>
            <div class="kpi__label">Vehículos</div>
            <div class="kpi__value"><?php echo (int) $stats['vehiculos'] ?></div>
            <div class="kpi__hint">Tipos de flota</div>
        </div>
    </div>
    <a class="kpi" href="<?php echo IP_SERVER ?>Home/usuarios">
        <span class="kpi__icon kpi__icon--orange"><i class="bi bi-receipt" aria-hidden="true"></i></span>
        <div>
            <div class="kpi__label">Cotizaciones</div>
            <div class="kpi__value"><?php echo (int) $stats['cotizaciones_30'] ?></div>
            <div class="kpi__hint">Últimos 30 días · Ver todas</div>
        </div>
    </a>
</section>

<div class="grid-2">
    <section class="card" aria-labelledby="tituloDestinos">
        <div class="card__head">
            <div>
                <h2 class="card__title" id="tituloDestinos">Todos los destinos</h2>
                <div class="card__meta" id="contador"><?php echo count($destinos) ?> destinos</div>
            </div>
            <label class="search">
                <span class="visually-hidden">Buscar destino</span>
                <i class="bi bi-search" aria-hidden="true"></i>
                <input type="search" id="buscar" placeholder="Buscar destino…" autocomplete="off">
            </label>
        </div>
        <div class="table-wrap">
            <table class="tbl">
                <thead>
                    <tr>
                        <th scope="col">Destino</th>
                        <th scope="col" class="col-status">Tarifas</th>
                        <th scope="col" class="col-actions"><span class="visually-hidden">Acciones</span></th>
                    </tr>
                </thead>
                <tbody id="tablaDestinos">
                    <?php foreach ($destinos as $destino) {
                        $nombre = $limpiar($destino->destino);
                        $tarifas = (int) $destino->tarifas; ?>
                        <tr data-nombre="<?php echo html_escape(mb_strtolower($nombre)) ?>">
                            <td class="tbl__name"><?php echo html_escape($nombre) ?></td>
                            <td class="col-status">
                                <?php if ($tarifas > 0) { ?>
                                    <span class="badge badge--ok"><?php echo $tarifas ?> tarifas</span>
                                <?php } else { ?>
                                    <span class="badge badge--warn">Sin tarifas</span>
                                <?php } ?>
                            </td>
                            <td class="col-actions">
                                <a class="btn btn-icon" href="<?php echo IP_SERVER ?>Home/editar_destino/<?php echo (int) $destino->id ?>"
                                    title="Editar tarifas" aria-label="Editar tarifas de <?php echo html_escape($nombre) ?>">
                                    <i class="bi bi-pencil-square" aria-hidden="true"></i>
                                </a>
                                <button class="btn btn-icon is-danger js-eliminar" type="button"
                                    data-id="<?php echo (int) $destino->id ?>" data-nombre="<?php echo html_escape($nombre) ?>"
                                    title="Eliminar" aria-label="Eliminar <?php echo html_escape($nombre) ?>">
                                    <i class="bi bi-trash3" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr class="tbl__empty" id="sinResultados" <?php echo $destinos ? 'hidden' : '' ?>>
                        <td colspan="3"><?php echo $destinos ? 'Ningún destino coincide con la búsqueda.' : 'Aún no hay destinos. Crea el primero.' ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <section class="card" aria-labelledby="tituloRecientes">
        <div class="card__head">
            <h2 class="card__title" id="tituloRecientes">Cotizaciones recientes</h2>
        </div>
        <?php if ($recientes) { ?>
            <ul class="feed">
                <?php foreach ($recientes as $r) {
                    $precio = trim(str_ireplace('Precio:', '', $limpiar($r->precio ?? ''))); ?>
                    <li>
                        <div class="feed__route">
                            <i class="bi bi-signpost-2" aria-hidden="true"></i>
                            <?php echo html_escape($limpiar($r->trayecto) ?: 'Sin trayecto') ?>
                        </div>
                        <div class="feed__detail"><?php echo html_escape($limpiar($r->vehiculo)) ?></div>
                        <div class="feed__row">
                            <span class="feed__price"><?php echo html_escape($precio) ?></span>
                            <time class="feed__date" datetime="<?php echo html_escape($r->created_at) ?>">
                                <?php echo $r->created_at ? date('d/m/Y H:i', strtotime($r->created_at)) : '' ?>
                            </time>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        <?php } else { ?>
            <p class="feed__detail" style="padding:18px">Todavía no llegan cotizaciones.</p>
        <?php } ?>
        <div class="card__foot">
            <a href="<?php echo IP_SERVER ?>Home/usuarios">Ver todas las cotizaciones <i class="bi bi-arrow-right" aria-hidden="true"></i></a>
        </div>
    </section>
</div>

<!-- Nuevo destino -->
<dialog class="dlg" id="dlgNuevo" aria-labelledby="dlgNuevoTitulo">
    <form id="formNuevo" method="dialog" novalidate>
        <div class="dlg__body">
            <h2 class="dlg__title" id="dlgNuevoTitulo">Nuevo destino</h2>
            <p class="dlg__text">Después de crearlo, configura sus tarifas por vehículo para que se pueda cotizar.</p>
            <div class="field">
                <label for="nombreDestino">Nombre del destino</label>
                <input type="text" id="nombreDestino" name="nombre" maxlength="255" placeholder="Ej. Villa de Leyva"
                    autocomplete="off" required>
                <div class="field__error" id="nombreError" role="alert"></div>
            </div>
        </div>
        <div class="dlg__foot">
            <button class="btn btn-ghost" type="button" data-close>Cancelar</button>
            <button class="btn btn-primary" type="submit" id="btnGuardar">Crear destino</button>
        </div>
    </form>
</dialog>

<!-- Confirmar eliminación -->
<dialog class="dlg" id="dlgEliminar" aria-labelledby="dlgEliminarTitulo">
    <div class="dlg__body">
        <h2 class="dlg__title" id="dlgEliminarTitulo">¿Eliminar destino?</h2>
        <p class="dlg__text">Se eliminará <strong id="eliminarNombre"></strong>. Esta acción no se puede deshacer.</p>
    </div>
    <div class="dlg__foot">
        <button class="btn btn-ghost" type="button" data-close>Cancelar</button>
        <button class="btn btn-danger" type="button" id="btnConfirmarEliminar">Eliminar</button>
    </div>
</dialog>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dlgNuevo = document.getElementById('dlgNuevo');
        var dlgEliminar = document.getElementById('dlgEliminar');
        var $nombre = $('#nombreDestino');
        var $error = $('#nombreError');
        var idEliminar = null;

        $('[data-close]').on('click', function () { this.closest('dialog').close(); });

        // Búsqueda en la tabla
        var $filas = $('#tablaDestinos tr[data-nombre]');
        var total = $filas.length;
        $('#buscar').on('input', function () {
            var q = $.trim(this.value).toLowerCase();
            var visibles = 0;
            $filas.each(function () {
                var match = q === '' || this.getAttribute('data-nombre').indexOf(q) !== -1;
                this.hidden = !match;
                if (match) { visibles++; }
            });
            $('#sinResultados').prop('hidden', visibles > 0 || total === 0);
            $('#contador').text(q === '' ? total + ' destinos' : visibles + ' de ' + total + ' destinos');
        });

        // Crear destino
        function setError(msg) {
            $error.text(msg).toggleClass('is-visible', !!msg);
            $nombre.attr('aria-invalid', msg ? 'true' : 'false');
        }

        $('#btnNuevo').on('click', function () {
            $nombre.val('');
            setError('');
            dlgNuevo.showModal();
            $nombre.trigger('focus');
        });

        $nombre.on('input', function () { setError(''); });

        $('#formNuevo').on('submit', function (e) {
            e.preventDefault();
            var nombre = $.trim($nombre.val());
            if (nombre === '') {
                setError('Escribe el nombre del destino.');
                $nombre.trigger('focus');
                return;
            }
            var $btn = $('#btnGuardar').prop('disabled', true).text('Creando…');
            Admin.post('home/crear_destino', { nombre: nombre })
                .done(function (r) {
                    if (r && r.success == 1) {
                        dlgNuevo.close();
                        Admin.toast('Destino "' + nombre + '" creado');
                        setTimeout(function () { location.reload(); }, 900);
                    } else {
                        setError((r && r.msg) || 'No se pudo crear el destino.');
                    }
                })
                .fail(function (xhr) {
                    if (xhr.status !== 401) { setError('No se pudo conectar con el servidor.'); }
                })
                .always(function () { $btn.prop('disabled', false).text('Crear destino'); });
        });

        // Eliminar destino
        $('#tablaDestinos').on('click', '.js-eliminar', function () {
            idEliminar = $(this).data('id');
            $('#eliminarNombre').text($(this).data('nombre'));
            dlgEliminar.showModal();
        });

        $('#btnConfirmarEliminar').on('click', function () {
            if (!idEliminar) { return; }
            var $btn = $(this).prop('disabled', true).text('Eliminando…');
            Admin.post('home/eliminar_destino', { id: idEliminar })
                .done(function (r) {
                    if (r && r.success == 1) {
                        dlgEliminar.close();
                        Admin.toast('Destino eliminado');
                        $('#tablaDestinos .js-eliminar[data-id="' + idEliminar + '"]').closest('tr').remove();
                        $filas = $('#tablaDestinos tr[data-nombre]');
                        total = $filas.length;
                        $('#buscar').trigger('input');
                    } else {
                        Admin.toast((r && r.msg) || 'No se pudo eliminar el destino.', 'error');
                    }
                })
                .fail(function (xhr) {
                    if (xhr.status !== 401) { Admin.toast('No se pudo conectar con el servidor.', 'error'); }
                })
                .always(function () { $btn.prop('disabled', false).text('Eliminar'); });
        });
    });
</script>
