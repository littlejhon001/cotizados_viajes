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
                <h2 class="text-white ">Destinos transdorado</h2>
                <div>
                    <button class="btn-add-event" data-bs-toggle="modal" data-bs-target="#modal_evento">Agregar
                        destino</button>
                </div>
            </div>
            <div class="row">
                <div class=" position-relative z-index-2">
                    <div class="card bg-negro-tercero card_eventos border p-2">
                        <div class="">
                            <div>
                                <h3 class="text-white ">Todos los destinos:</h3>
                            </div>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($destinos as $destino) { ?>
                                    <tr>
                                        <td class="text-white" style="width:20px"><?php echo $destino->id; ?></td>
                                        <td class="text-white"><?php echo $destino->destino; ?></td>
                                        <td class="text-white" style="width:100px">
                                            <a href="<?php echo IP_SERVER ?>home/editar_destino/<?php echo $destino->id ?>"
                                                class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>

                                            <button class="btn btn-danger eliminar_destino"
                                                data-id="<?php echo $destino->id ?>">
                                                <i class="bi bi-trash3"></i>
                                            </button>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </main>
    <div class="modal fade" id="modal_evento" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-white titulo_modal" id="staticBackdropLabel">Crear nuevo destino
                    </h1>
                    <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-evento" action="<?php echo IP_SERVER; ?>home/crear_evento">
                        <input type="hidden" id="id_evento">
                        <div class="form-group">
                            <label for="nombre">Nombre del destino</label>
                            <input type="text" class="form-control" id="nombre"
                                placeholder="Ingrese el nombre del destino" name="nombre">
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-white">
                    <button type="button" class="btn btn-primary" id="guardar">Guardar destino</button>
                </div>
            </div>
        </div>
    </div>

    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {
        $('#guardar').click(function () {
            var nombre = $('#nombre').val();
            const url = '<?php echo IP_SERVER . 'home/crear_destino'; ?>';
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    nombre: nombre,
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success == 1) {
                        Swal.fire({
                            title: "Destino creado",
                            text: response.msg,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000
                        });
                        setTimeout(function () {
                            $('#modal_evento').modal('hide');
                            window.location.reload();
                        }, 2000);
                    }
                    else if (response.success == 2) {
                        Swal.fire({
                            title: "Error",
                            text: response.msg,
                            icon: "error"
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });
        });

        $('.eliminar_destino').click(function () {
            const url = '<?php echo IP_SERVER . 'home/eliminar_destino'; ?>';
            var id = $(this).data('id');
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.success == 1) {
                                Swal.fire({
                                    title: "Destino eliminado",
                                    text: response.msg,
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 2000
                                });
                                setTimeout(function () {
                                    window.location.reload();
                                }, 2000);
                            }
                            else if (response.success == 2) {
                                Swal.fire({
                                    title: "Error",
                                    text: response.msg,
                                    icon: "error"
                                });
                            }
                        },
                        error: function (xhr, status, error) {
                            console.error('AJAX Error: ' + status + error);
                        }
                    });
                }
            });
        });
    });
</script>

</html>