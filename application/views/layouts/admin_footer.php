<?php
# Nota de Transparencia: Código generado/refactorizado con asistencia de IA Generativa (Claude Code) bajo la Política ODTI012 del CCS. Requiere supervisión y validación humana permanente.
defined('BASEPATH') or exit('No direct script access allowed');
?>
            </main>
        </div>
    </div>

    <div class="toasts" id="toasts" role="status" aria-live="polite"></div>

    <script src="<?php echo IP_SERVER ?>assets/jquery/jquery.min.js"></script>
    <script>
        // Utilidades compartidas del admin
        window.Admin = {
            base: '<?php echo IP_SERVER ?>',
            toast: function (msg, type) {
                var ok = type !== 'error';
                var $t = $('<div class="toast"></div>')
                    .addClass(ok ? 'toast--ok' : 'toast--error')
                    .append($('<i class="bi" aria-hidden="true"></i>').addClass(ok ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill'))
                    .append($('<span></span>').text(msg));
                $('#toasts').append($t);
                setTimeout(function () { $t.fadeOut(200, function () { $t.remove(); }); }, 3500);
            },
            // Si la sesión expiró, el backend responde 401: se vuelve al login
            post: function (url, data) {
                return $.ajax({ url: this.base + url, type: 'POST', data: data, dataType: 'json' })
                    .fail(function (xhr) {
                        if (xhr.status === 401) {
                            location.assign(window.Admin.base + 'login');
                        }
                    });
            }
        };

        $(function () {
            var $shell = $('#admShell');
            var $btn = $('#admMenuBtn');
            function setMenu(open) {
                $shell.toggleClass('is-menu-open', open);
                $btn.attr('aria-expanded', String(open));
            }
            $btn.on('click', function (e) { e.stopPropagation(); setMenu(!$shell.hasClass('is-menu-open')); });
            $(document).on('click', function (e) {
                if ($shell.hasClass('is-menu-open') && !$(e.target).closest('#admSide').length) { setMenu(false); }
            }).on('keydown', function (e) {
                if (e.key === 'Escape') { setMenu(false); }
            });

            <?php $flash = $this->session->flashdata('message'); if (!empty($flash)) { ?>
            Admin.toast(<?php echo json_encode((string) $flash) ?>, <?php echo json_encode($this->session->flashdata('success') ? 'ok' : 'error') ?>);
            <?php } ?>
        });
    </script>
</body>

</html>
