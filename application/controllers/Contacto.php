<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once 'application/third_party/Autoloader.php';
// require_once 'application/third_party/psr/Autoloader.php';
class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // Configurar headers CORS para permitir peticiones cross-origin
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
        header('Access-Control-Allow-Credentials: true');
        
        // Manejar peticiones OPTIONS (preflight)
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }
        
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
        $this->load->view('layouts/header_web');
        $this->load->view('contacto');
        $this->load->view('layouts/footer');
    }

}




