<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


<link rel="stylesheet"
    href="https://www.gstatic.com/dialogflow-console/fast/df-messenger/prod/v1/themes/df-messenger-default.css">
<script src="https://www.gstatic.com/dialogflow-console/fast/df-messenger/prod/v1/df-messenger.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap');





    /* ? ----- PORTADA ----- */

    .portada.oculta {
        transform: translateY(100%);
    }

    .portada .header {
        margin-bottom: 100px;
        text-transform: uppercase;
        letter-spacing: 3px;
    }

    .portada .header .logotipo {
        font-size: 50px;
        font-size: 900;
        margin-bottom: 20px;
    }

    .portada .header .mensaje {
        font-size: 30px;
        font-weight: 600;
    }



    #install-banner {
        display: none;
        /* display: flex; */
        position: fixed;
        bottom: 110px;
        transform: translateX(-50%);
        background: #333;
        color: #fff;
        padding: 20px 20px;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 999;
        left: 7px;

    }

    #install-banner button {
        margin-top: 5px;
        background: #136072;
        border: none;
        padding: 5px 20px;
        color: #fff;
        cursor: pointer;
        border-radius: 25px;
    }

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 38px !important;
        user-select: none;
        -webkit-user-select: none;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 5px;
        /* height: 35px; */
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 36px !important;
    }


    /* ? ----- MAIN ----- */
</style>


<div class="text-video">
    <h2 class="text-center text-white fs-md-2 fs-5">
        Realiza la cotización de tu trayecto ideal, selecciona el trayecto, el vehículo y el día.
    </h2>
    <div class="d-flex justify-content-center">
        <a class="btn button-cotizar text-center" href="#cotizacion">Cotiza ahora</a>
    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 m-0 p-0 ">
    <video id="miVideo" class="miVideo" src="<?php echo IP_SERVER ?>assets/img/video_colombia.mp4" autoplay loop muted>
    </video>
</div>

</div>
<div class="container-fluid p-5  img-fondo bg-glass p-4" id="cotizacion">
    <div class="container bg-glass p-4">
        <div class="row   rounded-2 py-4 ">
            <h2 class="fs-1 color-text">
                Tenemos el viaje ideal para ti
            </h2>
            <div class="col-md-6 col-12  ">
                <label for="trayecto" class="form-label text-white">Destino</label>
                <select class="form-select" id="trayecto" name="trayecto">
                    <option selected>Seleccione un destino</option>
                    <?php foreach ($destinos as $destino) { ?>
                        <option value="<?php echo $destino->id; ?>">
                            <?php echo $destino->destino ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-4  col-12">
                <label for="vehiculo" class="form-label text-white">Seleccione el Vehículo</label>
                <select class="form-select" id="vehiculo" name="vehiculo">
                    <option value="">Seleccione un Vehículo</option>
                    <?php foreach ($vehiculos as $vehiculo) { ?>
                        <option value="<?php echo $vehiculo->id ?>">
                            <?php echo $vehiculo->vehiculo ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-2  ">
                <label for="dia" class="form-label text-white">Seleccione el día</label>
                <select class="form-select" id="dia" name="dia">
                    <option disabled selected>Seleccione un día</option>
                    <option value="1">1 Día</option>
                    <option value="2">2 Días</option>
                    <option value="3">3 Días</option>
                    <option value="5">5 Días</option>
                    <option value="8">8 Días</option>
                </select>
            </div>
        </div>
        <div class="container d-flex justify-content-center">
            <div class="spinner-border text-success d-none" id="loader" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <div class="container pb-4 ">
            <div class="row">
                <div class="col-md-6 col-12">

                    <div class="card border-0 bg-white mt-3" style="width:auto;">
                        <div class="card-header border-0">
                            <h2>
                                Cotización de tu viaje ideal
                            </h2>
                        </div>
                        <div class="card-body">
                            <div class="d-flex   flex-column flex-md-row">
                                <i class="bi bi-geo-alt fs-5 text-danger me-2"></i>
                                <h3 class="color-text">Destino o trayecto:</h3>
                                <h3 class="color-text ms-auto" id="destino">Seleccione</h3>
                            </div>
                            <div class="d-flex flex-column flex-md-row">
                                <i class="bi bi-car-front-fill me-2 fs-5"></i>
                                <h4 class="color-text">Vehículo:</h4>
                                <h4 class="color-text ms-auto" id="vehiculo_seleccionado">Seleccione</h4>
                            </div>
                            <div class="d-flex  flex-column flex-md-row">
                                <i class="bi bi-cash fs-5 me-2"></i>
                                <h4 class="color-text">Precio total:</h4>
                                <h4 class="ms-auto " id="precio">0$</h4>
                            </div>
                        </div>
                        <div class="card-footer border-0 ">
                            <div class="d-flex justify-content-end  flex-column flex-md-row">
                                <button
                                    class="btn btn-primary mb-2 mb-md-0 d-none animate__animated animate__fadeInLeft "
                                    id="enviar_correo1">
                                    Enviar esta cotización a mi
                                    correo
                                    <i class="bi bi-envelope"></i>
                                </button>
                                <a href="https://wa.link/9bwsji" target="_blank" class="ms-3 btn btn-success">Contactar
                                    con un agente
                                    <i class="bi bi-whatsapp"></i></a>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="  box-form  animate__animated animate__fadeInRight" id="formulario"
                        style="display:none;">
                        <h2 class="color-text">
                            Recibirás esta cotización en tu correo electrónico.
                        </h2>
                        <form id="formCotizacion" action="<?php echo IP_SERVER ?>home/imprimir" method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="apellidos" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="number" class="form-control" id="telefono" name="telefono" required>
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>
                            <div class="mb-3 px-3 bg-secondary rounded-1">
                                <input type="checkbox" name="" class="form-check-input" id="more-info" style="border:gray;">
                                <label for="" class="form-check-label text-white">
                                    <strong>
                                        Deseas agregar mas información a tu cotización
                                    </strong>
                                </label>
                            </div>
                            <div class="mb-3 d-none animate__animated animate__fadeIn informacion-adicional">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-5">
                                            <label for="" class="form-label">Dirección de recogida</label>
                                            <input type="text" class="form-control" placeholder="Ingresa tu dirección"
                                                value="" name="direccion" id="direccion">
                                        </div>
                                        <div class="col-12 col-md-4">
                                            <label for="" class="form-label">Hora de recogida</label>
                                            <input type="time" class="form-control" placeholder="Hora de recogida"
                                                value="" id="hora" name="hora">
                                        </div>
                                        <div class="col-12 col-md-3  d-flex align-items-center">
                                            <div class="form-check">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Mascotas ?
                                                </label>
                                                <input class="form-check-input" type="checkbox" value="0" id="mascotas">
                                            </div>
                                        </div>
                                        <div class="col-12 mt-3 ">
                                            <div class="form-floating">
                                                <textarea class="form-control" placeholder="Comentarios"
                                                    id="comentarios" id="floatingTextarea2"
                                                    style="height: 100%"></textarea>
                                                <label for="floatingTextarea2">Comentarios</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input class="form-check-input" type="checkbox" id="politicas" name="politicas"
                                    required>
                                <label class="form-check-label" for="politicas">
                                    Acepto políticas de privacidad <a href="http://">Política de privacidad</a>
                                </label>
                            </div>
                            <input type="hidden" id="trayecto_impresion" name="trayecto">
                            <input type="hidden" id="vehiculo_impresion" name="vehiculo">
                            <input type="hidden" id="dia_impresion" name="dia">
                            <input type="hidden" id="precio_impresion" name="precio">
                            <div class="d-flex flex-column flex-md-row">
                                <button class=" btn btn-primary enviar_cotizacion mb-2 mb-md-0 ">Enviar
                                    cotización</button>
                                <button id="" class="ms-3  btn  btn-outline-danger" type="submit">
                                    imprimir
                                    <i class="bi bi-printer"></i>
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="install-banner" class="animate__animated animate__fadeInLeft text-center">
    <span>Instala nuestra aplicación para una mejor experiencia.</span>
    <div>
        <button onclick="installPWA()">Instalar</button>
        <button class="bg-danger" onclick="cerrar()">No gracias</button>
    </div>
</div>

<div class="btn-whatsapp animate__animated animate__fadeInUp ">
    <a href="#" target="_blank">
        <lord-icon src="https://cdn.lordicon.com/fjuachvi.json" trigger="hover" style="width:40px;height:40px">
        </lord-icon>
        <span class="tooltip">Contáctame</span>
    </a>
</div>

<!-- <script>
    $('#imprimir_cot').on('click', function (e) {
        e.preventDefault();
        const url = '<?php echo IP_SERVER; ?>';
        const nombre = $('#nombre').val();
        const apellidos = $('#apellidos').val();
        const telefono = $('#telefono').val();
        const correo = $('#correo').val();
        const precio = $('#precio').text();
        const trayecto = $('#destino').text();
        const vehiculo = $('#vehiculo_seleccionado').text();
        const dia = $('#dia').val();
        const politicas = $('#politicas').is(':checked');
        const direccion = $('#direccion').val();
        const hora = $('#hora').val();
        const mascotas = $('#mascotas').is(':checked');

        $.ajax({
            url: url + 'home/imprimir',
            type: 'POST',
            data: {
                nombre: nombre,
                apellidos: apellidos,
                telefono: telefono,
                correo: correo,
                precio: precio,
                trayecto: trayecto,
                vehiculo: vehiculo,
                dia: dia,
                politicas: politicas,
                direccion: direccion,
                hora: hora,
                mascotas: mascotas

            },
            dataType: 'json',
            success: function (response) {
                console.log(response);
            },
            error: function () {
                console.error('Error al imprimir la cotización');
            }
        });
    });
</script> -->


<script>
    $('#more-info').on('change', function () {
        var checkbox = document.getElementById('more-info');
        var form = document.querySelector('.informacion-adicional');
        if (checkbox.checked) {
            form.classList.remove('d-none');
            form.classList.add('d-block');
        } else {
            form.classList.remove('d-block');
            form.classList.add('d-none');
        }
    });

    $('#vehiculo').on('change', function () {
        $('#dia').val('');
    });
    // función para buscar el precio de la tarifa
    $('#dia').on('change', function () {
        var url = '<?php echo IP_SERVER; ?>';
        var id_destino = $('#trayecto').val();
        var id_vehiculo = $('#vehiculo').val();
        var dia = $('#dia').val();

        function formatearPrecio(precio) {
            return new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(precio);
        }
        $('#enviar_correo1').addClass('d-none');
        $('#loader').removeClass('d-none');

        $.ajax({
            url: url + 'home/get_tarifa',
            type: 'POST',
            data: {
                id_destino: id_destino,
                id_vehiculo: id_vehiculo,
                dia: dia
            },
            dataType: 'json',
            success: function (response) {
                $('#loader').addClass('d-none');
                if (response.length > 0) {
                    $('#enviar_correo1').removeClass('d-none');
                    $('#precio').text('Precio: ' + formatearPrecio(response[0].tarifa));
                    // Obtener el texto del trayecto seleccionado
                    var trayectoSeleccionado = $('#trayecto option:selected').text();
                    $('#destino').text(trayectoSeleccionado);
                    $('#vehiculo_seleccionado').text($('#vehiculo option:selected').text());
                    $('#trayecto_impresion').val(trayectoSeleccionado);
                    $('#vehiculo_impresion').val($('#vehiculo option:selected').text());
                    $('#dia_impresion').val(dia);
                    $('#precio_impresion').val('Precio: ' + formatearPrecio(response[0].tarifa));
                } else {
                    $('#precio').text('Precio: No disponible');
                    Swal.fire({
                        title: "Tarifa no disponible",
                        icon: "error",
                        html: `
                                    <p>Comunícate con nosotros para recibir mas información</p>
                                    <a href="https://wa.link/9bwsji" target="_blank"style="display: inline-flex; align-items: center; padding: 10px 20px; background-color: #25D366; color: white; text-decoration: none; border-radius: 5px;">
                                    Ir a WhatsApp
                                    <i class="ms-2 bi bi-whatsapp"></i>
                                    </a>
                                `,
                        showConfirmButton: false
                    });
                }
            },
            error: function () {
                console.error('Error al obtener los datos');
            }
        });

        var mostrar_fomulario = document.getElementById('enviar_correo1');
        mostrar_fomulario.addEventListener('click', function () {
            var formulario = document.getElementById('formulario');
            formulario.style.display = 'block';

        });

    });
</script>

<script>
    $('.enviar_cotizacion').on('click', function (e) {
        // Evita que el formulario se envíe normalmente
        e.preventDefault();
        const url = '<?php echo IP_SERVER; ?>';
        const nombre = $('#nombre').val();
        const apellidos = $('#apellidos').val();
        const telefono = $('#telefono').val();
        const correo = $('#correo').val();
        const precio = $('#precio').text();
        const trayecto = $('#destino').text();
        const vehiculo = $('#vehiculo_seleccionado').text();
        const dia = $('#dia').val();
        const politicas = $('#politicas').is(':checked');
        const direccion = $('#direccion').val();
        const hora = $('#hora').val();
        const mascotas = $('#mascotas').is(':checked');
        const comentarios = $('#comentarios').val();

        // Validar que todos los campos estén llenos

        if (precio === 'Precio: No disponible' || precio === '0$') {
            Swal.fire({
                title: 'Error',
                text: 'La tarifa no está disponible, por favor selecciona otro día.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            return;

        }

        if (!nombre || !apellidos || !telefono || !correo || !precio || !trayecto || !vehiculo || !dia || !politicas) {
            Swal.fire({
                title: 'Error',
                text: 'Por favor, completa todos los campos obligatorios.',
                icon: 'error',
                confirmButtonText: 'Aceptar'
            });
            return;
        }
        else {
            // Mostrar el loader
            Swal.fire({
                title: 'Enviando...',
                text: 'Por favor espera mientras enviamos tu cotización.',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            $.ajax({
                url: url + 'home/enviar_cotizacion',
                type: 'POST',
                data: {
                    nombre: nombre,
                    apellidos: apellidos,
                    telefono: telefono,
                    correo: correo,
                    precio: precio,
                    trayecto: trayecto,
                    vehiculo: vehiculo,
                    dia: dia,
                    politicas: politicas,
                    direccion: direccion,
                    hora: hora,
                    mascotas: mascotas,
                    comentarios: comentarios

                },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            title: '¡Éxito!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        });
                    } else {
                        Swal.fire({
                            title: 'success',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: '¡Éxito!',
                        text: "Correo enviado",
                        icon: 'success',
                        confirmButtonText: 'Aceptar'
                    });
                }
            });
        }
    });


</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $('#trayecto').select2({
        placeholder: 'Select an option'
    });
</script>



<script src="https://cdn.lordicon.com/lordicon.js"></script>


<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- michal snick js  -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- slick_jquery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>

<!-- slick_js -->
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>


<!-- link js bostrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>

<script>
    AOS.init();
</script>