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
                <h2 class="text-white ">Cotizaciones realizadas</h2>
                <!-- <div>
                    <button class="btn-add-event" data-bs-toggle="modal" data-bs-target="#modal_evento">Agregar
                        evento</button>
                </div> -->
            </div>
            <div class="row">
                <div class=" position-relative z-index-2">
                    <div class="card bg-negro-tercero card_eventos border p-2">
                        <div class="">
                            <div>
                                <h3 class="text-white ">Historial de usuarios</h3>
                            </div>
                        </div>
                        <table class="table table-hover" id="cotizacionesTable" style="width: auto;">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Apellido</th>
                                    <th scope="col">Teléfono</th>
                                    <th scope="col">Correo</th>
                                    <th scope="col">Destino</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Vehículo</th>
                                    <th scope="col">Día</th>
                                    <th scope="col">Dirección</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Mascotas</th>
                                    <th scope="col">Comentarios</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $cotizaciones) { ?>
                                    <tr>
                                        <td class="text-white" colspan="1"><?php echo $cotizaciones->nombre; ?></td>
                                        <td class="text-white"><?php echo $cotizaciones->apellido; ?></td>
                                        <td class="text-white"><?php echo $cotizaciones->telefono; ?></td>
                                        <td class="text-white"><?php echo $cotizaciones->correo; ?></td>
                                        <td class="text-white"><?php echo $cotizaciones->trayecto; ?></td>
                                        <td class="text-white"><?php echo $cotizaciones->precio; ?></td>
                                        <td class="text-white"><?php echo $cotizaciones->vehiculo; ?></td>
                                        <td class="text-white"><?php echo $cotizaciones->dia; ?> día(s)</td>
                                        <td class="text-white"><?php echo !empty($cotizaciones->direccion) ? $cotizaciones->direccion : '-'; ?></td>
                                        <td class="text-white"><?php echo !empty($cotizaciones->hora) ? $cotizaciones->hora : '-'; ?></td>
                                        <td class="text-white">
                                            <?php echo (!empty($cotizaciones->mascota) && $cotizaciones->mascota == 1) ? '<span class="badge bg-success">Sí</span>' : '<span class="badge bg-secondary">No</span>'; ?>
                                        </td>
                                        <td class="text-white">
                                            <?php 
                                            if (!empty($cotizaciones->comentarios)) {
                                                $comentarios = strlen($cotizaciones->comentarios) > 30 ? 
                                                    substr($cotizaciones->comentarios, 0, 30) . '...' : 
                                                    $cotizaciones->comentarios;
                                                echo '<span title="' . htmlspecialchars($cotizaciones->comentarios) . '">' . htmlspecialchars($comentarios) . '</span>';
                                            } else {
                                                echo '-';
                                            }
                                            ?>
                                        </td>
                                        <td class="text-white"><?php echo $cotizaciones->created_at; ?></td>
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
   

    </div>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#cotizacionesTable').DataTable({
        responsive: true,
        language: {
            "decimal": "",
            "emptyTable": "No hay datos disponibles en la tabla",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "infoEmpty": "Mostrando 0 a 0 de 0 registros",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "No se encontraron registros coincidentes",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activar para ordenar la columna ascendente",
                "sortDescending": ": activar para ordenar la columna descendente"
            }
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csv',
                text: 'CSV',
                className: 'btn btn-success btn-sm'
            },
            {
                extend: 'excel',
                text: 'Excel',
                className: 'btn btn-success btn-sm'
            },
        ],
        pageLength: 10,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
        order: [[12, 'desc']], // Ordenar por fecha (columna 12) descendente
        columnDefs: [
            { responsivePriority: 1, targets: [0, 1, 4, 5, 12] }, // Nombre, Apellido, Destino, Precio, Fecha
            { responsivePriority: 2, targets: [2, 3] }, // Teléfono, Correo
            { responsivePriority: 3, targets: [6, 7] }, // Vehículo, Día
            { responsivePriority: 10000, targets: [8, 9, 10, 11] } // Campos adicionales (se ocultan primero)
        ]
    });
});
</script>

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