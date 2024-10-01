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
                <h2 class="text-white ">Event On: Gestión de eventos</h2>
                <div>
                    <button class="btn-add-event" data-bs-toggle="modal" data-bs-target="#modal_evento">Agregar
                        evento</button>
                </div>
            </div>
            <div class="row">
                <div class=" position-relative z-index-2">
                    <div class="card bg-negro-tercero card_eventos border p-2">
                        <div class="">
                            <div>
                                <h3 class="text-white ">Todos los eventos:</h3>
                            </div>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">ubicación</th>
                                    <th scope="col">Artista</th>
                                    <th scope="col">Capacidad</th>
                                    <th scope="col">Escenario</th>
                                    <th scope="col">logo</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($eventos as $row) { ?>
                                    <tr>
                                        <th scope="col" class="text-white"><?php echo $row->nombre; ?></th>
                                        <th scope="col" class="text-white"><?php echo $row->ubicacion; ?></th>
                                        <th scope="col" class="text-white"><?php echo $row->artista; ?></th>
                                        <th scope="col" class="text-white"><?php echo $row->capacidad; ?></th>
                                        <th scope="col" class="text-white"><?php echo $row->escenario; ?></th>
                                        <th scope="col" class="text-white"><img class="rounded-circle" src="<?php echo $row->imagen; ?>" width="50" height="50" alt=""></th>
                                        <th scope="col" class="text-white"><?php echo $row->estado; ?></th>
                                        <th scope="col" class="text-white">
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <button type="button" class="btn btn-warning editar-evento"
                                                    data-id="<?php echo $row->id; ?>"
                                                    data-nombre="<?php echo $row->nombre; ?>"
                                                    data-ubicacion="<?php echo $row->ubicacion; ?>"
                                                    data-estado="<?php echo $row->estado; ?>"
                                                    data-artista="<?php echo $row->artista; ?>"
                                                    data-capacidad="<?php echo $row->capacidad; ?>"
                                                    data-descripcion="<?php echo $row->descripcion; ?>"
                                                    data-ulr_imagen="<?php echo $row->ulr_imagen; ?>"
                                                    data-escenario="<?php echo $row->escenario; ?>">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger eliminar_evento"
                                                data-id="<?php echo $row->id; ?>">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </th>
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
                    <h1 class="modal-title fs-5 text-white titulo_modal" id="staticBackdropLabel">Crear nuevo evento
                    </h1>
                    <button type="button" class="btn-close bg-danger" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-evento" action="<?php echo IP_SERVER; ?>home/crear_evento">
                        <input type="hidden" id="id_evento">

                        <div class="form-group">
                            <label for="nombre">Nombre del Evento</label>
                            <input type="text" class="form-control" id="nombre"
                                placeholder="Ingrese el nombre del evento" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="ubicacion">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion"
                                placeholder="Ingrese la ubicación del evento" name="ubicacion">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="">
                                <option value="activo">Activo</option>
                                <option value="cancelado">Cancelado</option>
                                <option value="pospuesto">Pospuesto</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="artista">Artista</label>
                            <input type="text" class="form-control" id="artista"
                                placeholder="Ingrese el nombre del artista" name="artista">
                        </div>
                        <div class="form-group">
                            <label for="capacidad">Capacidad</label>
                            <input type="number" class="form-control" id="capacidad"
                                placeholder="Ingrese la capacidad del evento" name="capacidad">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="descripcion" rows="3"
                                placeholder="Ingrese una descripción del evento" name="descripcion">

                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="escenario">Escenario</label>
                            <input type="text" class="form-control" id="escenario"
                                placeholder="Ingrese el escenario del evento" name="escenario">
                        </div>
                        <div class="form-group">
                            <label for="escenario">ulr imagen banner</label>
                            <input type="text" class="form-control" id="ulr_imagen"
                                placeholder="ingrese la ruta del banner" name="ulr_imagen">
                        </div>
                    </form>
                </div>
                <div class="modal-footer text-white">
                    <button type="button" class="btn btn-primary" id="guardar">Guardar evento</button>
                </div>
            </div>
        </div>
    </div>

    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    $('.editar-evento').click(function () {
        // Obtener los valores del data-atributo
        var id = $(this).data('id');
        var nombre = $(this).data('nombre');
        var ubicacion = $(this).data('ubicacion');
        var estado = $(this).data('estado');
        var artista = $(this).data('artista');
        var capacidad = $(this).data('capacidad');
        var descripcion = $(this).data('descripcion');
        var escenario = $(this).data('escenario');
        var ulr_imagen = $(this).data('ulr_imagen');

        // Llenar los campos del formulario con los valores obtenidos
        $('#id_evento').val(id);
        $('#nombre').val(nombre);
        $('#ubicacion').val(ubicacion);
        $('#estado').val(estado);
        $('#artista').val(artista);
        $('#capacidad').val(capacidad);
        $('#descripcion').val(descripcion);
        $('#escenario').val(escenario);
        $('#ulr_imagen').val(ulr_imagen);
        $('#guardar').text('Actualizar evento');
        $('.titulo_modal').text('Actualizar evento');
        // Mostrar el modal
        $('#modal_evento').modal('show');
    });


    $('#modal_evento').on('hidden.bs.modal', function () {
        $('#id_evento').val('');
        $('#nombre').val('');
        $('#ubicacion').val('');
        $('#estado').val('');
        $('#artista').val('');
        $('#capacidad').val('');
        $('#descripcion').val('');
        $('#escenario').val('');
        $('#guardar').text('Guardar evento');
        $('.titulo_modal').text('Crear evento');
    });



    $(document).ready(function () {
        $('#guardar').click(function () {
            var id = $('#id_evento').val();
            var nombre = $('#nombre').val();
            var ubicacion = $('#ubicacion').val();
            var estado = $('#estado').val();
            var artista = $('#artista').val();
            var capacidad = $('#capacidad').val();
            var descripcion = $('#descripcion').val();
            var escenario = $('#escenario').val();
            var ulr_imagen = $('#ulr_imagen').val();
            $.ajax({
                url: id ? '<?php echo IP_SERVER . 'home/actualizar_evento'; ?>' : '<?php echo IP_SERVER . 'home/crear_evento'; ?>',
                type: 'POST',
                data: {
                    id: id,
                    nombre: nombre,
                    ubicacion: ubicacion,
                    estado: estado,
                    artista: artista,
                    capacidad: capacidad,
                    descripcion: descripcion,
                    escenario: escenario,
                    ulr_imagen: ulr_imagen
                },
                dataType: 'json',
                success: function (response) {
                    if (response.success == 1) {
                        Swal.fire({
                            title: "Evento creado",
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

        $('.eliminar_evento').click(function () {

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
                        url: '<?php echo IP_SERVER . 'home/eliminar_evento'; ?>',
                        type: 'POST',
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function (response) {
                            if (response.success == 1) {
                                Swal.fire({
                                    title: "Evento eliminado",
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