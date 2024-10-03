<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />


<link rel="stylesheet"
    href="https://www.gstatic.com/dialogflow-console/fast/df-messenger/prod/v1/themes/df-messenger-default.css">
<script src="https://www.gstatic.com/dialogflow-console/fast/df-messenger/prod/v1/df-messenger.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap');


    df-messenger {
        z-index: 999;
        position: fixed;
        --df-messenger-font-color: #000;
        --df-messenger-font-family: Google Sans;
        --df-messenger-chat-background: #f3f6fc;
        --df-messenger-message-user-background: #cdf6d1;
        --df-messenger-message-bot-background: #badff3;
        bottom: 16px;
        right: 16px;
    }



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



    /* ? ----- MAIN ----- */
</style>


<div class="text-video">
    <h2 class="text-center text-white">
        Realiza la cotización de tu trayecto ideal, selecciona el trayecto, el vehículo y el día.
    </h2>
    <div class="d-flex justify-content-center">
        <a class="btn button-cotizar text-center" href="#cotizacion">Cotiza ahora</a>
    </div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 m-0 p-0 ">
    <video id="miVideo" class="miVideo" src="<?php echo IP_SERVER ?>assets/img/vide_travel_spot.mp4" autoplay loop
        muted>
    </video>
</div>

</div>
<div class="container-fluid p-5  img-fondo bg-glass p-4" id="cotizacion">
    <div class="container bg-glass p-4">
        <div class="row   rounded-2 py-4 ">
            <h2 class="fs-1 color-text">
                Tenemos el viaje ideal para ti
            </h2>
            <div class="col-md-6  ">
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
            <div class="col-md-3  ">
                <label for="vehiculo" class="form-label text-white">Seleccione el Vehículo</label>
                <select class="form-select" id="vehiculo" name="vehiculo">
                    <option value="">Seleccione un día</option>
                    <?php foreach ($vehiculos as $vehiculo) { ?>
                        <option value="<?php echo $vehiculo->id ?>">
                            <?php echo $vehiculo->vehiculo ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="col-md-3  ">
                <label for="dia" class="form-label text-white">Seleccione el día</label>
                <select class="form-select" id="dia" name="dia">
                    <option disabled selected>Seleccione un día</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="5">5</option>
                    <option value="8">8</option>
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
                <div class="col-6">
                    <h2 class="text-white">
                        La tarifa para el trayecto seleccionado es:
                    </h2>
                    <div class="card border-0 bg-white mt-3" style="width:auto;">
                        <div class="card-header border-0">
                            <div class="d-flex">
                                <i class="bi bi-geo-alt fs-5 text-danger mx-2"></i>
                                <h4 class="color-text" id="destino">Destino o trayecto:</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <i class="bi bi-car-front-fill me-2 fs-5"></i>
                                <h4 class="color-text" id="vehiculo_seleccionado">Vehículo: Selecciona</h4>
                            </div>
                            <div class="d-flex">
                                <i class="bi bi-cash fs-5 me-2"></i>
                                <h4 class="color-text" id="precio">Precio:0$ </h4>
                            </div>

                        </div>
                        <div class="card-footer border-0 ">
                            <div class="d-flex justify-content-end">
                                <button class="btn btn-primary d-none animate__animated animate__fadeInLeft "
                                    id="enviar_correo1">
                                    Enviar esta cotización a mi
                                    correo
                                    <i class="bi bi-envelope"></i>
                                </button>
                                <a href="https://wa.link/9bwsji" target="_blank" class="ms-3 btn btn-success">Contactar
                                    con un agente
                                    <i class="bi bi-whatsapp"></i></a>
                            </div>
                            <div>
                                <label for="" class="form-check-label">
                                    Deseas agregar mas información a tu cotización
                                </label>
                                <input type="checkbox" name="" id="more-info">
                            </div>
                            <div class="my-2 d-none animate__animated animate__fadeIn informacion-adicional">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-5">
                                            <label for="" class="form-label">Ubicación</label>
                                            <input type="text" class="form-control" placeholder="Ingresa tu dirección">
                                        </div>
                                        <div class="col-4">
                                            <label for="" class="form-label">Hora de recogida</label>
                                            <input type="time" class="form-control" placeholder="Hora de recogida">
                                        </div>
                                        <div class="col-3  d-flex align-items-center">
                                            <div class="form-check">
                                                <label class="form-check-label" for="flexCheckDefault">
                                                    Mascotas ?
                                                </label>
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="flexCheckDefault">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="  box-form  animate__animated animate__fadeInRight" id="formulario"
                        style="display:none;">
                        <h2 class="color-text">
                            Recibirás la cotización formal en tu correo electrónico para imprimir.
                        </h2>
                        <form id="formCotizacion">
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
                                <input type="tel" class="form-control" id="telefono" name="telefono" required>
                            </div>
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>
                            <div class="mb-3">
                                <input class="form-check-input" type="checkbox" id="politicas" name="politicas"
                                    required>
                                <label class="form-check-label" for="politicas">
                                    Acepto políticas de privacidad <a href="http://">Política de privacidad</a>
                                </label>
                            </div>
                            <button class="btn btn-primary enviar_cotizacion">Enviar cotización</button>
                            <button target="_blank" class="ms-3 btn  btn-outline-danger">
                                imprimir
                                <i class="bi bi-printer"></i>
                            </button>
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
                    $('#destino').text('Destino o trayecto: ' + trayectoSeleccionado);
                    $('#vehiculo_seleccionado').text('Vehículo: ' + $('#vehiculo option:selected').text());
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
        const vehiculo = $('#vehiculo').text();
        const dia = $('#dia').val();

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
                dia: dia
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
                        title: 'Error',
                        text: response.message,
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                }
            },
            error: function () {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al enviar el correo.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    });


</script>


<script>
    // Obtén los datos desde PHP en formato JSON
    var tarifas = <?php echo json_encode($tarifas); ?>;

    // Selecciona los elementos del DOM
    var selectTrayecto = document.getElementById('trayecto');
    var selectDia = document.getElementById('dia');
    var precio = document.getElementById('precio');
    var destino = document.getElementById('destino');
    var vehiculo = document.getElementById('vehiculo'); // Nuevo elemento para el vehículo
    var enviarCorreo = document.getElementById('enviar_correo1');

    // Función para formatear el precio en pesos colombianos
    function formatearPrecio(precio) {
        return new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP' }).format(precio);
    }

    // Escuchar cambios en el select de trayecto
    selectTrayecto.addEventListener('change', function () {
        var trayectoSeleccionado = tarifas.find(function (trayecto) {
            return trayecto.id == selectTrayecto.value;
        });

        // Resetear el select de días, el precio, el destino y el vehículo al cambiar de trayecto
        selectDia.value = '';
        precio.innerText = 'Precio: ';
        destino.innerText = 'Destino o trayecto: ';
        vehiculo.innerText = 'Vehículo: '; // Resetear el vehículo
    });

    // Escuchar cambios en el select de días
    selectDia.addEventListener('change', function () {
        var trayectoSeleccionado = tarifas.find(function (trayecto) {
            return trayecto.id == selectTrayecto.value;
        });

        if (trayectoSeleccionado) {
            var precioDia;
            switch (selectDia.value) {
                case '1':
                    precioDia = trayectoSeleccionado.dia1;
                    break;
                case '2':
                    precioDia = trayectoSeleccionado.dia2;
                    break;
                case '3':
                    precioDia = trayectoSeleccionado.dia3;
                    break;
                default:
                    precioDia = null;
            }

            if (precioDia) {
                precio.innerText = 'Precio: ' + formatearPrecio(precioDia);
                destino.innerText = 'Destino o trayecto: ' + trayectoSeleccionado.destino;
                vehiculo.innerText = 'Vehículo: ' + trayectoSeleccionado.vehiculo; // Mostrar el vehículo
                enviarCorreo.classList.remove('d-none');
            } else {
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
                precio.innerText = 'Precio: ';
                destino.innerText = 'Destino o trayecto: ';
                vehiculo.innerText = 'Vehículo: '; // Resetear el vehículo
            }
        }
    });

    var mostrar_fomulario = document.getElementById('enviar_correo1');

    mostrar_fomulario.addEventListener('click', function () {

        var formulario = document.getElementById('formulario');
        formulario.style.display = 'block';

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