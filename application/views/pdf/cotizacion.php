<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cotización de Viaje</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 40px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="3">
                    <table>
                        <tr>
                            <td>
                                <img src="<?php echo IP_SERVER; ?>assets/img/logo_transdorado.png"
                                    style="width:100%; max-width:150px;" alt="Logo Transdorado">
                            </td>
                            <td class="">
                                <h5>Cotización de Viaje</h5>
                            </td>
                            <td>
                                Fecha: <?php echo date('d/m/Y'); ?><br>
                            </td>
                        </tr>

                    </table>
                </td>

            </tr>
            <tr class="information">
                <td colspan="3">
                    <table>
                        <tr>
                            <td>
                                Empresa de Viajes, Transdorado.<br>
                                Cra. 9 Este #1a-56, Bogotá
                                <br>
                                Bogotá, Colombia
                            </td>
                            <td>
                                Cliente:<br>
                                <?php echo $nombre; ?><br>
                                <?php echo $apellido; ?><br>
                                <?php echo $telefono; ?><br>
                                <?php echo $correo; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td>Destino</td>
                <td>Día</td>
                <td>Vehículo</td>
            </tr>
            <?php // foreach ($items as $item): ?>
            <tr class="item">
                <td><?php echo $trayecto; ?></td>
                <td><?php echo $dia; ?></td>
                <td><?php echo $vehiculo; ?></td>
            </tr>
            <?php // endforeach; ?>
            <tr class="total">
                <td></td>
                <td></td>
                <td>Total: <?php echo $precio; ?></td>
            </tr>
        </table>

        <!-- Información Adicional -->
        <?php if (!empty($direccion) || !empty($hora) || !empty($mascota) || !empty($comentarios)): ?>
        <div style="margin-top: 30px; padding: 20px; background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 5px;">
            <h3 style="color: #333; margin-bottom: 15px; border-bottom: 2px solid #007bff; padding-bottom: 10px;">Información Adicional del Servicio</h3>
            
            <?php if (!empty($direccion)): ?>
            <p style="margin-bottom: 10px;"><strong>📍 Dirección de recogida:</strong> <?php echo $direccion; ?></p>
            <?php endif; ?>
            
            <?php if (!empty($hora)): ?>
            <p style="margin-bottom: 10px;"><strong>🕒 Hora de recogida:</strong> <?php echo $hora; ?></p>
            <?php endif; ?>
            
            <?php if (!empty($mascota) && $mascota == 1): ?>
            <p style="margin-bottom: 10px;"><strong>🐾 Mascotas:</strong> Sí, el cliente viajará con mascotas</p>
            <?php endif; ?>
            
            <?php if (!empty($comentarios)): ?>
            <div style="margin-top: 15px;">
                <p style="margin-bottom: 5px;"><strong>💬 Comentarios adicionales:</strong></p>
                <div style="background-color: white; padding: 15px; border-left: 4px solid #007bff; margin-top: 5px; font-style: italic;">
                    <?php echo nl2br(htmlspecialchars($comentarios)); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <div>
        <p>
            <b>Mensaje:</b> <br>
            <?php // echo $cotizacion['descripcion']; ?>
        </p>

        <p class="parrafo">
            A.
            Los vehículos cumplen con todas las exigencias establecidas por el Ministerio de Transporte y con las
            disposiciones legales contempladas en la Ley 769 del 6 de agosto de 2002, el Decreto 174 del 5 de febrero de
            2001, así como las normas que los modifiquen o adicionen para la prestación del servicio público de
            transporte terrestre automotor especial. Los vehículos cuentan con la documentación vigente, incluyendo
            matrícula, seguro obligatorio SOAT, certificado de emisión de gases y certificado de revisión
            técnico-mecánica. Asimismo, están equipados con el equipo de carretera reglamentario, y se cubren todos los
            costos de mantenimiento del vehículo, en conformidad con las normas aplicables al transporte de pasajeros y
            tránsito.
            <br>
            <br>

            B.
            Transdorado será responsable de proveer conductores, insumos, equipos, herramientas, materiales,
            combustibles, lubricantes y cualquier otro elemento necesario para la operación normal del vehículo y la
            prestación del servicio. Además, asumirá todos los costos relacionados con el mantenimiento del vehículo y
            las infracciones de tránsito que pudieran ocurrir. La empresa también dispondrá de conductores idóneos,
            capacitados, con licencias de conducción vigentes y con experiencia en el transporte de pasajeros. Dichos
            conductores deberán destacarse por su trato respetuoso y cordial hacia el personal beneficiado.
            <br>
            <br>
            C.
            Para realizar su reservación, por favor envíe al WhatsApp 3115966555 una copia de la cédula o pasaporte, en
            caso de ser extranjero, o el certificado de cámara de comercio si es una empresa. Incluya también los datos
            del responsable del contrato: nombre completo, cédula, dirección y número de teléfono, así como el lugar y
            la hora de salida.
            <br>
            <br>
            D.
            Para reservar, se debe realizar un depósito equivalente al 10% del total del servicio a través de Nequi o
            Daviplata (número 3115966555), o a las siguientes cuentas bancarias: Bancolombia, cuenta de ahorros #
            11305155928; Davivienda, cuenta de ahorros # 45790025257. El 60% restante deberá ser cancelado antes del
            inicio del servicio y el saldo final antes del regreso. También aceptamos pagos a través de PayPal en la
            dirección gerencia@transdorado.com.
            <br>
            <br>
            Agradecemos su contacto y nos comprometemos a satisfacer sus necesidades. Nuestros vehículos son modelos
            recientes y se encuentran en excelentes condiciones. Quedamos atentos a sus comentarios.
        </p>
        <p>Atento a sus comentarios.</p>
        <p>Cordialmente:</p>
        <img src="https://www.transdorado.co/cotizador_viajes/assets/img/firma.png" alt="firma" width="180px">
        <p>ROGER STEVEN ESPEJO <br>
            Cargo: Gerente General <br>
        </p>
    </div>
    <footer>
        <div class="container-fluid " style="text-align: center;">
            <p>GRUPO GREMS SAS
                NIT 901.867.890-9
                Dirección: CRA 9 este 1A 56 📍
                <br>
                <a href="https://wa.me/573115966555">WhatsApp</a>
                <br>
                📱 Tel: 3115966555-3213130355
            </p>
            <p><a href="https://www.transdorado.co/" target="_blank">Transdorado</a> - Todos los derechos reservados
            <?php echo date('Y'); ?>
            </p>
        </div>
    </footer>
</body>

</html>