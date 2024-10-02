<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Afacad+Flux:wght@100..1000&display=swap');



        body {
            font-family: "Afacad Flux", sans-serif;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 2cm;
            background-color: white;
        }

        table {
            font-size: 14px !important;
        }

        .encabezado {
            margin-top: 20px;
            width: 100%;
            padding-bottom: 150px;
        }

        .texto {
            float: left;
        }

        .logo {
            float: right;
        }

        .solicitado {
            padding-top: 0px !important;
            padding-left: 30px;
            padding-right: 30px;
            background-color: #dddbdbe7;
            margin: 0px !important;
            display: flex;
            text-align: justify;
        }

        /* Forzar envoltura de línea */
        .solicitado::after {
            content: '';
            display: inline-block;
            width: 100%;
        }

        /* Estilos para los elementos internos */
        .solicitado>div {
            display: inline-block;
            vertical-align: top;
            box-sizing: border-box;
            width: calc(50% - 15px);
            padding: 10px;
        }

        .solicitado div p {
            margin: 0;
        }

        .solicitado div label {
            font-weight: bold;
        }

        .texto-blanco {
            color: #dddbdbe7;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            background-color: transparent;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody+tbody {
            border-top: 2px solid #dee2e6;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }

        .table-bordered {
            border: 2px solid #fff;
        }

        .table-bordered th,
        .table-bordered td {
            border: 2px solid #fff;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
        }

        .tr-estilo {
            background-color: #dddbdbe7;
            vertical-align: center;
            text-align: center;
        }

        thead .tr-estilo {
            border-bottom: 3px solid #fff;
            background-color: #323ead;
            color: #fff;
        }

        tbody tr .tr-estilo {
            border-bottom: 3px solid #fff;
            background-color: #8fd19e;
            color: #000;
        }

        .parrafo {
            text-align: justify;
            font-size: 14px;
            font-family: 'Comic Neue', sans-serif;
            font-style: italic;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 2cm;
            text-align: center;
            /* Centra el texto en el footer */
            font-size: 12px;
            /* Tamaño de fuente para el footer */
            line-height: 2cm;
            /* Alinea verticalmente el texto en el footer */
        }

        body {
            margin-bottom: 2.5cm;
        }
    </style>
</head>
<?php $now = date('Y-m-d'); ?>
<body>
    <div class="container-fluid">
        <div class="encabezado">
            <div class="texto">
                <h2>Transdorado
                </h2>
                <br>
                BOGOTA - COLOMBIA. CRA 9 ESTE # 1 A - 56 <br>
                311 596 6555 - 314 228 5823 - 601 750 59 68

            </div>
            <div class="logo">
                <img src="https://www.transdorado.co/wp-content/uploads/2024/06/WhatsApp_Image_2024-04-15_at_20.48.28-removebg-preview.png" alt="Logo" width="150px">
            </div>
        </div>
        <div class="solicitado">
            <div>
                <label class="titulo">SOLICITADO POR:</label>
                <p><?php echo $nombre; ?></p>
                <p><?php echo $apellido; ?></p>
            </div>
            <div>
                <label>ORDEN-<?php // echo $cotizacion['id'] ?></label>
                <p class="texto-blanco">-</p>
                <p>Fecha: <?php  echo $now ?></p>
            </div>
        </div>
        <table class="table table-sm table-bordered" style="margin-top: 20px;">
            <thead class="table-primary ">
                <tr class="tr-estilo">
                    <th>Destino</th>
                    <th>N° días</th>
                    <th>Vehículo</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr class="tr-estilo">
                    <td><?php  echo $trayecto; ?></td>
                    <td><?php  echo $dia; ?></td>
                    <td><?php  echo $vehiculo; ?></td>
                    <td><?php  echo $precio; ?></td>
                </tr>
                <tr>
                    <td colspan="3" class="tr-estilo">Total</td>
                    <td class="tr-estilo"><?php  echo $precio; ?></td>
                </tr>
            </tbody>
        </table>
        <div>
            <p>
                <b>Contacto:</b><br>
                Teléfono: <?php echo $telefono; ?>
                <b>Contacto:</b><br>
                <a href="mailto:<?php echo $correo;?>">
                    <?php echo $correo; ?>
                </a>
            </p>
        </div>
        <div>
            <p>
                <b>Mensaje:</b> <br>
                <?php // echo $cotizacion['descripcion']; ?>
            </p>
            <p class="parrafo">Vehículos con aire acondicionado, tv, bluetooth, silletería reclinable y cómoda, bodega,
                maletero.</p>
            <p class="parrafo">
                1. A. Los vehículos cuentan con todas las exigencias del Ministerio de Transporte y con las
                disposiciones legales contempladas en la ley 769 del 6 de Agosto del 2002, el decreto 174 del 5 de
                Febrero de 2001 y las normas que lo modifiquen o adiciones para la prestación del servicio público de
                transporte terrestre automotor especial; con la documentación vigente: matrícula del vehículo, seguro
                obligatorio SOAT, certificado de emisión de gases, certificado de revisión técnico mecánica, que estén
                dotados del equipo de carretera reglamentario, cubrir y todos los costos de mantenimiento del vehículo,
                y demás normas que regulen y lleguen a regular el servicios de transporte de pasajeros y las normas de
                tránsito. <br>
                2. B. vansbogota.com será responsable del suministro de conductores, insumos, equipos, herramientas,
                materiales, combustibles, lubricantes, o cualquier otro elemento o material necesario para la normal
                operación del vehículo y prestación del servicio y cubrir todos los costos de metimiento del vehículo o
                infracciones de tránsito en las que incurran. d. Disponer de los conductores idóneos, capacitados, con
                sus licencias de conducción vigentes y con experiencia en el manejo de transporte vehicular de pasajeros
                necesarios para este evento, los cuales deben caracterizare por el buen trato y respeto al personal
                beneficiado. <br>
                3. C. Para hacer su reservación por favor enviar al WhatsApp 3115966555 la cedula o pasaporte si es
                extranjero o cámara de comercio si es empresa de la persona o entidad contratante. Datos del responsable
                del contrato nombre, cedula dirección y teléfono lugar y hora de salida. <br>
                4. D. Para reservar se debe apartar con el 10% de la totalidad del servicio a nequi,3115966555,
                Bancolombia cuenta de ahorros # 11305155928, Davivienda ahorros # 45790025257. El resto del servicio se
                cancelará antes de arrancar el 60% y antes del regreso el restante del 100% de la totalidad. <br><br>
                5. E. Si el destino al que contrataste esta menos de 5 min o 2 km en vía pavimentada en auto, no tiene
                ningún costo adicional. Si el destino queda entre 5 min y 15min debe cancelar $ 50.000 si el destino
                esta entre 15 min y 30 min tiene un valor de $ 100.000 mil pesos si es mas de media hora se debe revisar
                la ubicación y verificar la tarifa y se le indicara el nuevo precio. Todo destino excedente queda a
                placer del conductor si la vía es destapada, (trocha) o el vehículo no puede ingresar no nos haceos
                responsables del traslado,(SE HACE EL TRASLADO HASTA DONDE LA VIA ESTE PAVIMENTADA.<br>
            </p>

            <p>Atento a sus comentarios.</p>
            <p>Coordialmente:</p>
            <!-- <img src="<?php // echo // RUTA_BASE; ?>assets/imagenes/firma.png" alt="firma" width="180px"> -->
            <p>ROGER STEVEN ESPEJO <br>
                Cargo: Gerente General <br>
            </p>
        </div>
    </div>
    <footer>
        <div class="container-fluid">
            <p>
                <a href="https://www.vansbogota.com/" target="_blank">VansBogota</a> - Todos los derechos reservados
                <?php echo date('Y'); ?>
            </p>
        </div>
    </footer>
</body>