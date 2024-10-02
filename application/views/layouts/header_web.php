<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Cotizador - Transdorado</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="copyright" content="CCS" />
    <meta name="revisit" content="5 days" />
    <meta name="Author" content="David Parra" />
    <meta name="medium" content="medium_type" />
    <meta name="Author Email" content="aprendizgti@ccs.org.co" />
    <meta name="DC.creator" content="David Parra" />
    <meta name="DC.language" content="ES" />
    <link rel="shortcut icon" type="image/png" href="<?php echo IP_SERVER ?>assets/img/event_on.png" />

    <!-- splashscreen pwa -->
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_15_Pro_Max__iPhone_15_Plus__iPhone_14_Pro_Max_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_15_Pro__iPhone_15__iPhone_14_Pro_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_14_Plus__iPhone_13_Pro_Max__iPhone_12_Pro_Max_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_14__iPhone_13_Pro__iPhone_13__iPhone_12_Pro__iPhone_12_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_13_mini__iPhone_12_mini__iPhone_11_Pro__iPhone_XS__iPhone_X_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_11_Pro_Max__iPhone_XS_Max_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_11__iPhone_XR_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_8_Plus__iPhone_7_Plus__iPhone_6s_Plus__iPhone_6_Plus_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_8__iPhone_7__iPhone_6s__iPhone_6__4.7__iPhone_SE_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/4__iPhone_SE__iPod_touch_5th_generation_and_later_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 1032px) and (device-height: 1376px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/13__iPad_Pro_M4_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/12.9__iPad_Pro_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 834px) and (device-height: 1210px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/11__iPad_Pro_M4_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/11__iPad_Pro__10.5__iPad_Pro_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 820px) and (device-height: 1180px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/10.9__iPad_Air_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/10.5__iPad_Air_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/10.2__iPad_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/9.7__iPad_Pro__7.9__iPad_mini__9.7__iPad_Air__9.7__iPad_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 744px) and (device-height: 1133px) and (-webkit-device-pixel-ratio: 2) and (orientation: landscape)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/8.3__iPad_Mini_landscape.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 430px) and (device-height: 932px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_15_Pro_Max__iPhone_15_Plus__iPhone_14_Pro_Max_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 393px) and (device-height: 852px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_15_Pro__iPhone_15__iPhone_14_Pro_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_14_Plus__iPhone_13_Pro_Max__iPhone_12_Pro_Max_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 390px) and (device-height: 844px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_14__iPhone_13_Pro__iPhone_13__iPhone_12_Pro__iPhone_12_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_13_mini__iPhone_12_mini__iPhone_11_Pro__iPhone_XS__iPhone_X_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_11_Pro_Max__iPhone_XS_Max_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_11__iPhone_XR_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 414px) and (device-height: 736px) and (-webkit-device-pixel-ratio: 3) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_8_Plus__iPhone_7_Plus__iPhone_6s_Plus__iPhone_6_Plus_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/iPhone_8__iPhone_7__iPhone_6s__iPhone_6__4.7__iPhone_SE_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/4__iPhone_SE__iPod_touch_5th_generation_and_later_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 1032px) and (device-height: 1376px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/13__iPad_Pro_M4_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/12.9__iPad_Pro_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 834px) and (device-height: 1210px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/11__iPad_Pro_M4_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/11__iPad_Pro__10.5__iPad_Pro_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 820px) and (device-height: 1180px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/10.9__iPad_Air_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/10.5__iPad_Air_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 810px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/10.2__iPad_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/9.7__iPad_Pro__7.9__iPad_mini__9.7__iPad_Air__9.7__iPad_portrait.png">
    <link rel="apple-touch-startup-image"
        media="screen and (device-width: 744px) and (device-height: 1133px) and (-webkit-device-pixel-ratio: 2) and (orientation: portrait)"
        href="<?php echo IP_SERVER ?>assets/imagenes/splashscreen/8.3__iPad_Mini_portrait.png">



    <!-- Global site tag (gtag.js) - Google Analytics -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-7JVR1LDC67"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'G-7JVR1LDC67');
    </script>
    <!-- Meta Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '752520745761895');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=752520745761895&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->

    <title></title>

    <!-- scroll -->
    <!-- <script> configObj = { "buttonD": "M16.806 13.667v-5.25c0-.967-.841-1.75-1.879-1.75-1.037 0-1.878.783-1.878 1.75v8.998c0 .912-1.073 1.472-1.907.995l-1.79-1.024c-.588-.328-1.326-.312-1.896.042-.93.578-1.061 1.805-.27 2.542l5.757 5.363h10.929l1.43-7.49c.22-1.333-.714-2.594-2.129-2.876l-6.367-1.3z", "buttonT": "translate(-1208 -172) translate(832 140) translate(32 32) translate(344)", "shadowSize": "none", "roundnessSize": "999px", "buttonDToBottom": "12px", "buttonDToRight": "12px", "selectedBackgroundColor": "#0e0f27", "selectedIconColor": "#ffffff", "buttonWidth": "40px", "buttonHeight": "40px", "svgWidth": "32px", "svgHeight": "32px" }; function createButton(obj, pageSimulator) { const body = document.querySelector("body"); backToTopButton = document.createElement("span"); backToTopButton.classList.add("softr-back-to-top-button"); backToTopButton.id = "softr-back-to-top-button"; pageSimulator ? pageSimulator.appendChild(backToTopButton) : body.appendChild(backToTopButton); backToTopButton.style.width = obj.buttonWidth; backToTopButton.style.height = obj.buttonHeight; backToTopButton.style.marginRight = obj.buttonDToRight; backToTopButton.style.marginBottom = obj.buttonDToBottom; backToTopButton.style.borderRadius = obj.roundnessSize; backToTopButton.style.boxShadow = obj.shadowSize; backToTopButton.style.color = obj.selectedBackgroundColor; backToTopButton.style.backgroundColor = obj.selectedBackgroundColor; pageSimulator ? backToTopButton.style.position = "absolute" : backToTopButton.style.position = "fixed"; backToTopButton.style.outline = "none"; backToTopButton.style.bottom = "0px"; backToTopButton.style.right = "0px"; backToTopButton.style.cursor = "pointer"; backToTopButton.style.textAlign = "center"; backToTopButton.style.border = "solid 2px currentColor"; backToTopButton.innerHTML = '<svg class="back-to-top-button-svg" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" > <g fill="none" fill-rule="evenodd"> <path d="M0 0H32V32H0z" transform="translate(-1028 -172) translate(832 140) translate(32 32) translate(164) matrix(1 0 0 -1 0 32)" /> <path class="back-to-top-button-img" fill-rule="nonzero" d="M11.384 13.333h9.232c.638 0 .958.68.505 1.079l-4.613 4.07c-.28.246-.736.246-1.016 0l-4.613-4.07c-.453-.399-.133-1.079.505-1.079z" transform="translate(-1028 -172) translate(832 140) translate(32 32) translate(164) matrix(1 0 0 -1 0 32)" /> </g> </svg>'; backToTopButtonSvg = document.querySelector(".back-to-top-button-svg"); backToTopButtonSvg.style.verticalAlign = "middle"; backToTopButtonSvg.style.margin = "auto"; backToTopButtonSvg.style.justifyContent = "center"; backToTopButtonSvg.style.width = obj.svgWidth; backToTopButtonSvg.style.height = obj.svgHeight; backToTopButton.appendChild(backToTopButtonSvg); backToTopButtonImg = document.querySelector(".back-to-top-button-img"); backToTopButtonImg.style.fill = obj.selectedIconColor; backToTopButtonSvg.appendChild(backToTopButtonImg); backToTopButtonImg.setAttribute("d", obj.buttonD); backToTopButtonImg.setAttribute("transform", obj.buttonT); if (!pageSimulator) { backToTopButton.style.display = "none"; window.onscroll = function () { if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) { backToTopButton.style.display = "block"; } else { backToTopButton.style.display = "none"; } }; backToTopButton.onclick = function () { document.body.scrollTop = 0; document.documentElement.scrollTop = 0; }; } }; document.addEventListener("DOMContentLoaded", function () { createButton(configObj, null); });</script> -->


    <!-- ionicon -->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>



    <!-- michal snick  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <!-- link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">


    <!-- css pagina -->
    <link rel="stylesheet" href="<?php echo IP_SERVER ?>assets/css/main2.css" type="text/css">
    <!-- <link rel="stylesheet" href="<?php echo IP_SERVER ?>assets/css/agenda.css" type="text/css"> -->
    <!-- <link rel="stylesheet" href="<?php echo IP_SERVER ?>assets/css/agenda1.css" type="text/css"> -->

    <!-- <link rel="manifest" href="<?php//  echo IP_SERVER; ?>assets/manifest.json"> -->
<!--

    <link rel="manifest" href="<?php// echo IP_SERVER; ?>manifest"> -->

    <!-- <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function () {
                navigator.serviceWorker.register('<?php // echo IP_SERVER . 'assets/service-worker.js'; ?>').then(function (registration) {
                    console.log('ServiceWorker registration successful with scope: ', registration.scope);
                }, function (err) {
                    console.log('ServiceWorker registration failed: ', err);
                });
            });
        }
    </script> -->
    <!-- <script>
        var timestamp = new Date().getTime();
        var stylesheetUrl = "css/style.css?v=" + timestamp;
        document.write('<link rel="stylesheet" href="' + stylesheetUrl + '">');
      </script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>


<header id="inicio">
    <nav class="navbar navbar-expand-lg" id="miNavBar" data-aos="fade-down" data-aos-duration="1500">
        <div class="container-fluid">
            <a class="navbar-brand " href="index.html" id="logo">
                <img src="<?php echo IP_SERVER ?>assets/img/logo_transdorado.png" class="logo-ppal" width=""
                    alt="main_logo">
            </a>
            <button onclick="boton()" id="navbarButton" class="navbar-toggler  navIcono" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="https://www.transdorado.co/">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>





<script src="https://cdn.lordicon.com/lordicon.js"></script>



<a href="https://lordicon.com/" class="d-none">Icons by Lordicon.com</a>