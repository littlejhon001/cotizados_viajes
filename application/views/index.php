<link rel='stylesheet' href='<?php echo IP_SERVER ?>assets/css/reloj.css?>'>

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

<button id="btnAudio" onclick="toggleAudio()">
    <ion-icon id="sonido" class="sonido btnaudio" name="volume-high-outline"></ion-icon>
    <ion-icon id="muted" class="btnaudio" name="volume-mute-outline"></ion-icon>
</button>
<div id="anuncio" class="anuncio">
    Para una mejor experiencia, activa el audio.
</div>



<div class="container-fluid seccion1 m-0 p-0">

    <div class="col-lg-12 col-md-12 col-sm-12 m-0 p-0 ">
        <video id="miVideo" class="miVideo" src="<?php echo IP_SERVER ?>assets/img/video_spot.mp4" autoplay loop
            muted></video>
    </div>
    <!-- sponsors -->
    <div class="col-lg-12 col-md-12 col-sm-12 p- bg-white text-center">
        <div class="carrousel-57">
            <div class="slider">
                <div class="slide-track">
                    <?php foreach ($eventos as $evento) { ?>
                        <div class="slide">
                            <img src="<?php echo $evento->imagen ?>" height="100" alt="">
                        </div>
                        <?php
                    } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="separador-57"></div>

    <div class="bg-secundario">
        <!-- para para-reflexionar -->
        <div class="section-1 py-5 " id="parareflexionar">
            <div class="row d-flex justify-content-center align-items-center">

                <div class=" col-12 col-md-12 col-lg-5  text-center  " data-aos="fade-right">
                    <div data-aos="fade-right">
                        <img src="<?php echo IP_SERVER ?>assets/imagenes/elementos/para-reflexionar.png"
                            class="my-3 mb-3 img-titulos" width="" alt="">
                    </div>

                    <h3 class="text-light fw-light mt-3 text-start  ">
                        "En Event_On, vive la experiencia del festival VibeFest. Encuentra en tiempo real los escenarios
                        y artistas que se están presentando, consulta los horarios y localiza cada espectáculo. No te
                        pierdas ningún momento de este increíble festival con nuestra guía interactiva, que te ayudará a
                        moverte y disfrutar al máximo de VibeFest. ¡Tu experiencia perfecta está a un clic de
                        distancia!"
                        </>


                </div>
                <div class="col-12  col-md-12  col-lg-5 h-100 d-flex justify-content-center" data-aos="zoom-in"
                    data-aos-duration="3000">
                    <img class="floating-image img-cube mt-5"
                        src="<?php echo IP_SERVER ?>assets/img/L4GXT3DF8D_800850084987979.jpg" width="" alt="">
                </div>

            </div>
        </div>
        <!-- programate -->
        <div class="section-2 py-3" id="programate">
            <div class="text-center mt-3">
                <img src="<?php echo IP_SERVER ?>assets/img/programate.png" alt="">
            </div>
            <div class="container pt-4">
                <div class="text-center">
                    <h4 class=" fw-light ">
                        Conoce a los Artistas en Escena: No te Pierdas Ninguna Presentación, Descubre sus Trayectorias,
                        Explora sus Estilos y Vive de Cerca el Talento que Hace Únicos a Cada Show. Sumérgete en la
                        Magia de sus Actuaciones y Aprovecha al Máximo Cada Momento del Festival.
                    </h4>
                </div>
                <div class="mt-5">
                    <div class="row d-flex ">
                        <?php foreach ($eventos as $row) { ?>
                            <div class="col-6  d-flex justify-content-center">
                                <div class="card mb-3" style="max-width: 540px;">
                                    <div class="row g-0">
                                        <div class="col-md-4 d-flex align-items-center">
                                            <img src="<?php echo $row->imagen ?>" class="img-fluid rounded-start" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row->nombre . '-' . $row->artista ?></h5>
                                                <p class="card-text">
                                                    Descripción:
                                                    <?php echo $row->descripcion ?>
                                                    personas
                                                </p>
                                                <p class="card-text">
                                                    <i class="bi bi-geo-fill"></i>
                                                    Ubicación:
                                                    <?php echo $row->ubicacion ?>
                                                </p>
                                                <p class="card-text">
                                                    <i class="bi bi-person-arms-up"></i>
                                                    Capacidad:
                                                    <?php echo $row->capacidad ?>
                                                    personas
                                                </p>
                                                <p class="card-text">
                                                <i class="bi bi-map-fill"></i>
                                                    <?php echo $row->escenario ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>


        <!-- imagen agenda -->

        <!-- chat  -->
        <!-- <div class="container-fluid p-0 m-0 ">
                    <df-messenger location="us-central1" project-id="consejo-colombiano-seguridad"
                        agent-id="8f5dbdf4-93ca-4e9b-b5a8-412fbe94d5c4" language-code="es" max-query-length="-1">
                        <df-messenger-chat-bubble chat-title="Asistente Viwi">
                        </df-messenger-chat-bubble>
                    </df-messenger>
                    </div> -->
        <div id="install-banner" class="animate__animated animate__fadeInLeft text-center">
            <span>Instala nuestra aplicación para una mejor experiencia.</span>
            <div>
                <button onclick="installPWA()">Instalar</button>
                <button class="bg-danger" onclick="cerrar()">No gracias</button>
            </div>
        </div>

        <div class="btn-whatsapp animate__animated animate__fadeInUp ">
            <a href="" target="_blank">
                <lord-icon src="https://cdn.lordicon.com/fjuachvi.json" trigger="hover" style="width:40px;height:40px">
                </lord-icon>
                <span class="tooltip">Contáctame</span>
            </a>
        </div>



        <script src="https://cdn.lordicon.com/lordicon.js"></script>




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

        <!-- js main -->

        <!-- partial:index.partial.html -->

        <!-- service worker -->



        <script src="<?php echo IP_SERVER ?>assets/js/scripts/main.js"></script>
        <script src="<?php echo IP_SERVER ?>assets/js/simplyCountdown.min.js"></script>
        <script src="<?php echo IP_SERVER ?>assets/js/countdown.js"></script>