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
        $this->load->model('Tarifas_model');
    }
    public function index()
    {
        // console($this->session->userdata('user_data'));

        $data['tarifas'] = $this->Tarifas_model->findAll();

        $this->load->view('layouts/header_web');
        $this->load->view('index', $data);
        $this->load->view('layouts/footer');
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


        // Crear un objeto con los datos del formulario
        $data = (object) array(
            'correo' => $correo,
            'nombre' => $nombre,
            'telefono' => $telefono,
            'apellido' => $apellido,
            'precio' => $precio,
            'trayecto' => $trayecto,
            'vehiculo' => $vehiculo,
            'dia' => $dia
        );

        // Cargar la vista y obtener el contenido HTML como un string
        $html = $this->load->view('mails/_cotizacion', $data, true);

        // Crear un objeto para pasar al php_mailer con el destinatario y el contenido
        $correo = (object) array(
            'email' => $correo, // Cambié 'to' a 'email' porque en tu función 'enviarcorreo' espera 'email'
            'subject' => 'Cotización Transdorado',
            'body' => $html, // Asegúrate que el campo sea 'body', ya que es lo que espera la función 'enviarcorreo'
            'addbcc' => 'cotizaciones@transdorado.co'
        );

        // Cargar la librería php_mailer y enviar el correo
        $this->load->library('php_mailer');
        $respuesta = $this->php_mailer->enviarcorreo($correo);

        // Verificar si el correo fue enviado exitosamente
        if ($respuesta->success) {
            // Retorna un mensaje JSON indicando éxito
            echo json_encode(['status' => 'success', 'message' => 'Correo enviado correctamente.']);
        } else {
            // Retorna un mensaje JSON indicando error
            echo json_encode(['status' => 'error', 'message' => 'Error al enviar correo: ' . $respuesta->error]);
        }
    }


    public function crear_evento()
    {
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
        $respuesta = $this->Evento_model->create($data);

        if (empty($respuesta)) {
            $this->json(array('success' => 1, 'msg' => 'Evento creado'));
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

    public function eliminar_evento()
    {

        console($this->input->post());
        $id = $this->input->post('id');
        $respuesta = $this->Evento_model->delete($id);

        if (empty($respuesta)) {
            $this->json(array('success' => 1, 'msg' => 'Evento eliminado'));
        } else {
            $this->json(array('success' => 2, 'msg' => 'Oopps.. ocurrio un error'));
        }

    }

}




