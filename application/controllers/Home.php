<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once 'application/third_party/Autoloader.php';
// require_once 'application/third_party/psr/Autoloader.php';
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // if (!$this->validatoken()) {
        //     $this->iffalse('Acceso denegado');
        //     $this->json();
        //     die();
        $this->load->model('Destinos_model');
        $this->load->model('Vehiculos_model');
        $this->load->model('Precios_model');
        $this->load->model('Usuarios_model');
        // if (!empty($this->session->userdata('user_data'))) {
        $this->load->model('Usuarios_model');
        $this->load->model('Destinos_model');
        $this->load->model('Vehiculos_model');
        $this->load->model('Precios_model');

    }
    public function index()
    {
        // console($this->session->userdata('user_data'));

        $data['destinos'] = $this->Destinos_model->findAll();
        $data['vehiculos'] = $this->Vehiculos_model->findAll();
        // $data['dia'] = $this->Precios_model->get_dia($id_destino, $id_vehiculo);

        $this->load->view('layouts/header_web');
        $this->load->view('index', $data);
        $this->load->view('layouts/footer');
    }
    public function admin()
    {
        $data['destinos'] = $this->Destinos_model->findAll();
        $this->load->view('layouts/header');
        $this->load->view('admin/dashboard', $data);
        $this->load->view('layouts/footer');
    }
    public function usuarios()
    {
        $data['usuarios'] = $this->Usuarios_model->findAll();
        $this->load->view('layouts/header');
        $this->load->view('admin/cotizaciones', $data);
        $this->load->view('layouts/footer');
    }
    public function get_tarifa()
    {
        $id_destino = $this->input->post('id_destino');
        $id_vehiculo = $this->input->post('id_vehiculo');
        $dia = $this->input->post('dia');
        $data = $this->Precios_model->get_tarifa($id_destino, $id_vehiculo, $dia);
        $this->json($data);
    }
    public function cotizacion()
    {
        $emular_datos = (object) array(
            'nombre' => 'Juan Guevara',
            'telefono' => '1234567890',
            'apellido' => 'Guevara',
            'correo' => 'jhgomor@gmail.com'
        );

        $this->load->view('mails/_cotizacion', $emular_datos);

    }
    public function editar_destino($id)
    {
        // Obtener el destino especificado
        $data['destino'] = $this->Destinos_model->find($id);

        // Obtener todos los vehículos
        $data['vehiculos'] = $this->Vehiculos_model->findAll();

        // Obtener precios para el destino específico
        $data['precios'] = $this->Precios_model->get_precios_por_destino($data['destino']->id);

        // Cargar las vistas
        $this->load->view('layouts/header');
        $this->load->view('admin/editar_destino', $data);
        $this->load->view('layouts/footer');
    }

    public function inicio()
    {
        $this->load->model('Evento_model');
        $data['eventos'] = $this->Evento_model->findAll();
        $this->load->view('layouts/header_web');
        $this->load->view('index', $data);
        $this->load->view('layouts/footer');
    }

    public function enviar_cotizacion()
    {
        // Obtener los datos del formulario
        $correo = $this->input->post('correo');
        $nombre = $this->input->post('nombre');
        $telefono = $this->input->post('telefono');
        $apellido = $this->input->post('apellidos');
        $precio = $this->input->post('precio');
        $trayecto = $this->input->post('trayecto');
        $vehiculo = $this->input->post('vehiculo');
        $dia = $this->input->post('dia');
        $created_at = date('Y-m-d H:i:s');

        $hora = $this->input->post('hora');
        $direccion = $this->input->post('direccion');


        $politicas = $this->input->post('politicas') === 'true' || $this->input->post('politicas') === 'on' ? 1 : 0;
        $mascotas = $this->input->post('mascotas') === 'true' || $this->input->post('mascotas') === 'on' ? 1 : 0;

        $comentarios = $this->input->post('comentarios');

        // Crear un objeto con los datos del formulario
        $data = (object) array(
            'correo' => $correo,
            'nombre' => $nombre,
            'telefono' => $telefono,
            'apellido' => $apellido,
            'precio' => $precio,
            'trayecto' => $trayecto,
            'vehiculo' => $vehiculo,
            'dia' => $dia,
            'politica' => $politicas,
            'hora' => $hora,
            'direccion' => $direccion,
            'mascota' => $mascotas,
            'comentarios' => $comentarios,
            'created_at' => $created_at
        );


        // Cargar la vista y obtener el contenido HTML como un string
        $html = $this->load->view('mails/_cotizacion', $data, true);
        $this->Usuarios_model->insert($data);
        // Crear un objeto para pasar al php_mailer con el destinatario y el contenido
        $correo = (object) array(
            'email' => $correo, // Cambié 'to' a 'email' porque en tu función 'enviarcorreo' espera 'email'
            'subject' => 'Cotización Transdorado',
            'body' => $html, // Asegúrate que el campo sea 'body', ya que es lo que espera la función 'enviarcorreo'
            'addbcc' => 'cotizaciones@transdorado.co'
        );

        // Cargar la librería php_mailer y enviar el correo
        $this->load->library('php_mailer', null, 'php_mailer');
        $respuesta = $this->php_mailer->enviarcorreo($correo);
        // emulacion de respuesta
        // $respuesta = (object) array (
        //     'success' => true,
        //     'error' => ''
        // );

        // Verificar si el correo fue enviado exitosamente
        if ($respuesta->success) {
            // Retorna un mensaje JSON indicando éxito
            echo json_encode(['status' => 'success', 'message' => 'La cotización de tu viaje se ha enviado correctamente.']);
        } else {
            // Retorna un mensaje JSON indicando error
            echo json_encode(['status' => 'error', 'message' => 'Error al enviar correo: ' . $respuesta->error]);
        }
    }


    public function imprimir()
    {
        var_dump($this->input->post());
        // Recuperar datos de entrada
        $nombre = $this->input->post('nombre');
        $telefono = $this->input->post('telefono');
        $correo = $this->input->post('correo');
        $apellido = $this->input->post('apellidos');
        $precio = $this->input->post('precio');
        $trayecto = $this->input->post('trayecto');
        $vehiculo = $this->input->post('vehiculo');
        $dia = $this->input->post('dia');
        $politicas = $this->input->post('politicas') === 'true' || $this->input->post('politicas') === 'on' ? 1 : 0;
        $created_at = date('Y-m-d H:i:s');

        // Datos que se pasarán a la vista
        $data = (object) array(
            'nombre' => $nombre,
            'telefono' => $telefono,
            'correo' => $correo,
            'apellido' => $apellido,
            'precio' => $precio,
            'trayecto' => $trayecto,
            'vehiculo' => $vehiculo,
            'dia' => $dia,
            'politica' => $politicas,
            'created_at' => $created_at
        );
        $this->Usuarios_model->insert($data);


        // $emular_datos = (object) array(
        //     'nombre' => 'Juan Guevara',
        //     'telefono' => '1234567890',
        //     'apellido' => 'Guevara',
        //     'correo' => 'jhgomor@gmail.com',
        //     'precio' => '100.000',
        //     'trayecto' => 'Bogotá - Medellín',
        //     'vehiculo' => 'Bus',
        //     'dia' => '1',
        //     'politica' => '1',

        // );

        // Cargar la biblioteca DomPDF
        $this->load->library('dompdf_gen');
        // Generar HTML desde la vista
        $html = $this->load->view('pdf/cotizacion', $data, true);
        $pdf = $this->dompdf_gen->generate($html, "cotizacion" . date('Y-m-d') . ".pdf", false, 'A4', 'landscape');


        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="cotizacion" ' . date('Y-m-d') . '.pdf');
        header('Expires: 0');
        header('Content-Transfer-Encoding: binary');
        // header('Content-Length: '.$filesize);
        header('Cache-Control: private, no-transform, no-store, must-revalidate');

        echo $pdf;
    }

    public function crear_destino()
    {
        $nombre = $this->input->post('nombre');

        $data = array(
            'destino' => $nombre,
        );
        $respuesta = $this->Destinos_model->create($data);

        if (empty($respuesta)) {
            $this->json(array('success' => 1, 'msg' => 'Destino creado'));
        } else {
            $this->json(array('success' => 2, 'msg' => 'Oopps.. ocurrio un error'));
        }

    }

    public function actualizar_evento()
    {
        $id = $this->input->post('id');
        $nombre = $this->input->post('nombre');
        $ubicacion = $this->input->post('ubicacion');
        $estado = $this->input->post('estado');
        $artista = $this->input->post('artista');
        $capacidad = $this->input->post('capacidad');
        $descripcion = $this->input->post('descripcion');
        $escenario = $this->input->post('escenario');
        $url_imagen = $this->input->post('ulr_imagen');

        $data = array(
            'nombre' => $nombre,
            'ubicacion' => $ubicacion,
            'estado' => $estado,
            'artista' => $artista,
            'capacidad' => $capacidad,
            'descripcion' => $descripcion,
            'escenario' => $escenario,
            'ulr_imagen' => $url_imagen
        );
        $respuesta = $this->Evento_model->update($id, $data);

        if (empty($respuesta)) {
            $this->json(array('success' => 1, 'msg' => 'Evento actualizado'));
        } else {
            $this->json(array('success' => 2, 'msg' => 'Oopps.. ocurrio un error'));
        }
    }

    public function eliminar_destino()
    {

        console($this->input->post());
        $id = $this->input->post('id');
        $respuesta = $this->Destinos_model->delete($id);

        if (empty($respuesta)) {
            $this->json(array('success' => 1, 'msg' => 'Evento eliminado'));
        } else {
            $this->json(array('success' => 2, 'msg' => 'Oopps.. ocurrio un error'));
        }

    }

    public function guardar_precios()
    {
        // Recibe el id_destino desde el formulario
        $id_destino = $this->input->post('id_destino');

        // Recibe los precios desde el formulario
        $precios = $this->input->post('precios');

        if ($precios && $id_destino) {
            foreach ($precios as $dia => $vehiculos) {
                foreach ($vehiculos as $id_vehiculo => $tarifa) {
                    // Aquí preparas los datos para insertar o actualizar en la base de datos
                    $data = [
                        'id_destino' => $id_destino,
                        'id_vehiculo' => $id_vehiculo,
                        'dia' => $dia,
                        'tarifa' => $tarifa
                    ];

                    // Inserta o actualiza el precio en la base de datos
                    $this->Precios_model->guardar_o_actualizar_precio($data);
                }
            }

            // Respuesta exitosa
            echo json_encode(['status' => 'success', 'message' => 'Precios guardados correctamente']);
        } else {
            // Respuesta en caso de error
            echo json_encode(['status' => 'error', 'message' => 'No se pudieron guardar los precios']);
        }
    }


}




