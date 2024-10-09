<body class="g-sidenav-show  bg-negro-ppal animate__fadeIn animate__animated">
    <main class="main-content border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">

                    <h6 class="font-weight-bolder mb-0 text-white ">Bienvenido de nuevo :
                        <?php echo $this->session->user_data->nombre . ' ' . $this->session->user_data->apellido; ?>
                    </h6>

                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">


                    </div>
                    <ul class="navbar-nav  justify-content-end">

                        <li class="nav-item px-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0">
                                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                            </a>
                        </li>
                        <li class="nav-item dropdown pe-2 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-bell cursor-pointer"></i>
                            </a>

                            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                                aria-labelledby="dropdownMenuButton">
                                <li class="mb-2">
                                    <a class="dropdown-item border-radius-md" href="javascript:;">
                                        <div class="d-flex py-1">
                                            <div class="my-auto">
                                                <!-- <img src="./assets/img/team-2.jpg" class="avatar avatar-sm  me-3 "> -->
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item d-flex align-items-center">
                            <a href="./pages/sign-in.html" class="nav-link text-body font-weight-bold px-0">
                                <i class="fa fa-user me-sm-1"></i>
                                <span class="d-sm-inline d-none">
                                    </php>
                                </span>

                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="d-flex justify-content-between align-items-center">
                <h2 class="text-white ">Editar precios para el destino <?php echo $destino->destino?> 🚐🚐🚐</h2>
                <!-- <div>
                    <button class="btn-add-event" data-bs-toggle="modal" data-bs-target="#modal_evento">Agregar
                        evento</button>
                </div> -->
            </div>
            <div class="d-flex justify-content-center">
                <div class="row w-75">
                    <div class=" position-relative z-index-2">
                        <form id="form-precios" action="<?php echo IP_SERVER ?>home/guardar_precios" method="POST">
                            <input type="hidden" name="id_destino" value="<?php echo $destino->id; ?>">
                            <?php $dias = [1, 2, 3, 5, 8]; ?>
                            <?php foreach ($dias as $dia): ?>
                                <div class="card my-3 bg-negro-tercero card_eventos border p-2">
                                    <div class="card-body">
                                        <h2>Día <?php echo $dia; ?></h2>
                                        <?php foreach ($vehiculos as $vehiculo): ?>
                                            <div class="m-0 p-0">
                                                <label for="precio_<?php echo $dia . '_' . $vehiculo->vehiculo; ?>">
                                                    Precio para <?php echo $vehiculo->vehiculo; ?>:
                                                </label>

                                                <!-- Asignar el precio como valor predeterminado -->
                                                <input type="number" class="form-control"
                                                    id="precio_<?php echo $dia . '_' . $vehiculo->vehiculo; ?>"
                                                    name="precios[<?php echo $dia; ?>][<?php echo $vehiculo->id; ?>]"
                                                    step="0.01"
                                                    value="<?php echo isset($precios[$dia][$vehiculo->id]) ? $precios[$dia][$vehiculo->id] : ''; ?>"
                                                    placeholder="Ingrese el precio">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <button type="submit" class="btn btn-primary guardar_precios">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
    </main>
    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#form-precios').on('submit', function (e) {
            e.preventDefault(); // Evita que se recargue la página al enviar el formulario

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Por favor, verifica todos los precios antes de continuar.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, guardar precios',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'), // La URL que especificaste en el action
                        data: $(this).serialize(),   // Serializa todos los inputs del formulario, incluyendo el hidden
                        success: function (response) {
                            // Aquí manejas la respuesta del servidor
                            Swal.fire({
                                icon: 'success',
                                title: 'Precios guardados correctamente',
                                showConfirmButton: false,
                                timer: 3000
                            });
                            setTimeout(function () {
                                window.location.reload();
                            }, 3000);
                        },
                        error: function () {
                            // Manejo de errores
                            alert('Error al guardar los precios');
                        }
                    });
                }
            });
        });
    });
</script>

</html>