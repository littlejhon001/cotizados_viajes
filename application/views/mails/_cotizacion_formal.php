<?php
# Nota de Transparencia: Código generado/refactorizado con asistencia de IA Generativa (Claude Code) bajo la Política ODTI012 del CCS. Requiere supervisión y validación humana permanente.
defined('BASEPATH') or exit('No direct script access allowed');
$e = function ($v) {
    return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');
};
?>
<!DOCTYPE html>
<html lang="es">

<body style="margin:0; padding:24px; background:#F4F6FA; font-family:Arial, Helvetica, sans-serif; color:#16213A;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:560px; margin:0 auto; background:#ffffff; border-radius:12px; overflow:hidden;">
        <tr>
            <td style="padding:24px 28px 8px;">
                <img src="cid:main_logo" alt="Transportes Dorado" width="160" style="display:block;">
            </td>
        </tr>
        <tr>
            <td style="padding:8px 28px 24px; font-size:15px; line-height:1.6;">
                <p style="margin:0 0 12px;">Hola <?php echo $e($cot['cliente']['nombre']) ?>,</p>
                <p style="margin:0 0 12px;">Adjuntamos la cotización <strong><?php echo $e($cot['referencia']) ?></strong> por un total de
                    <strong>$ <?php echo number_format($cot['totales']['total'], 0, ',', '.') ?></strong>.</p>
                <p style="margin:0 0 12px;">Es válida hasta el <?php echo $e($cot['vence']) ?>. Para confirmar tu reserva responde este correo o escríbenos al 311 596 6555.</p>
                <p style="margin:16px 0 0;">Saludos,<br><strong>Transportes Dorado</strong></p>
            </td>
        </tr>
        <tr>
            <td style="padding:14px 28px; background:#131D52; color:#ffffff; font-size:11px;">
                GRUPO GREMS SAS · NIT 901.867.890-9 · www.transdorado.co
            </td>
        </tr>
    </table>
</body>

</html>
