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
        if (!empty($this->session->userdata('user_data'))) {
            $this->load->model('Evento_model');
        }
    }
    public function index()
    {
        // console($this->session->userdata('user_data'));


        $this->load->view('layouts/header_web');
        $this->load->view('index');
        $this->load->view('layouts/footer' );
    }
    public function inicio()
    {
        $this->load->model('Evento_model');
        $data['eventos'] = $this->Evento_model->findAll();
        $this->load->view('layouts/header_web');
        $this->load->view('index', $data);
        $this->load->view('layouts/footer' );
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

    public function actualizar_evento(){
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

    public function eliminar_evento(){

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




