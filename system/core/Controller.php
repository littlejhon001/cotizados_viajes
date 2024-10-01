<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2019 - 2022, CodeIgniter Foundation
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2019, British Columbia Institute of Technology (https://bcit.ca/)
 * @copyright	Copyright (c) 2019 - 2022, CodeIgniter Foundation (https://codeigniter.com/)
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/userguide3/general/controllers.html
 */
#[\AllowDynamicProperties]
class CI_Controller
{

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * CI_Loader
	 *
	 * @var	CI_Loader
	 */
	public $load;
	public $formData = null;
	public $reques;
	public $token;
	private $roles;
	protected $user;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =  &$this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class) {
			$this->$var = &load_class($class);
		}

		$this->load = &load_class('Loader', 'core');
		$this->load->initialize();
		$this->reques = (object) ['success' => '1', 'data' => ''];
		$this->metodo();
		// log_message('info', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}
	/**
	 * CI_Controller::json()
	 *
	 * @param string $array
	 * @return
	 */
	public function json($array = '')
	{
		header('Cache-Control: no-cache, must-revalidate, post-check=0, pre-check=0');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json; text/json; charset=utf-8');
		header("Cache-Control: private", false);
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
		header('Access-Control-Request-Headers: Accept, X-Requested-With');
		header('Access-Control-Allow-Credentials: true');
		header("Access-Control-Allow-Headers: Content-Length, Accept-Encoding, Origin, X-Requested-With, Content-Type, Accept, token");
		echo json_encode(empty($array) ? $this->reques : $array);
	}
	public function iffalse($msj = '')
	{
		if (!isset($this->reques->error)) {
			$this->reques->error = array();
		}
		$this->reques->error[] = $msj;
		$this->reques->success = '';
	}
	private function metodo()
	{
		$metodo = $this->input->method(true);
		//console($metodo,$this->uri->segment(1));
		if ($metodo == 'OPTIONS') {
			$this->json($metodo);
			exit;
		}
		if ($metodo == 'POST') {
			$this->formData = $this->input->post();
			if (empty($this->formData)) {
				$this->formData = json_decode(file_get_contents("php://input"));
			}
			if (empty($this->formData)) {
				$this->formData = $metodo;
			}
			$this->formData = (object) $this->formData;
		} else {
			$this->formData = $metodo;
			// $this->deletefiles();
		}
	}
	/**
	 * CI_Controller::view()
	 *
	 * @param mixed $view
	 * @param mixed $vars
	 * @param bool $return
	 * @return void
	 */
	public function view($view, $vars = '', $return = FALSE)
	{
		if ($return) {
			return $this->load->view($view, $vars, TRUE);
		}
		$this->load->view($view, $vars, FALSE);
	}
	public function vista($view, $vars = '')
	{
		$this->load->view('layouts/header', $vars);
		$this->load->view($view, $vars);
		$this->load->view('layouts/footer');
	}
	// funciones protegidas  ////////////////////////////////////////////////
	protected function validatoken()
	{
		$head = apache_request_headers();
		if (!empty($head['token'])) {
			$token = $head['token'];
		} elseif (!empty($this->formData->token)) {
			$token = $this->formData->token;
		} else {
			$token = '';
		}
		if (!empty($token)) {
			$this->token = $token;
			$fila = $this->lg->findName('token', $this->token);
			if (!empty($fila->token)) {
				$this->user = $fila;
				if (!empty($fila->roles)) {
					$this->roles = explode(',', $fila->roles);
				}
				return strtotime('now') <= $fila->tiempo;
			}
			$this->token = '';
		}
		return false;
	}
	protected function validaroles($rol = '')
	{
		if (!empty($rol) && !empty($this->roles)) {
			if (is_string($rol)) {
				if (strpos($rol, ',') !== false) {
					return $this->validaroles(explode(',', $rol));
				}
				return in_array($rol, $this->roles);
			} elseif (is_array($rol)) {
				$esta = array_intersect($rol, $this->roles);
				return !empty($esta);
			}
		}
		return false;
	}
	protected function logueado($rol = '', $estado = 0)
	{
		if (!empty($this->session->datosusuario->id)) {
			// obtener los datos del usuario
			$this->user = $this->session->datosusuario;
			// comparar el tiempo de vida del login, este el diferente al tiempo de vida de session
			if (strtotime('now') <= $this->user->tiempo && !empty($this->user->token)) {
				// consultar en la base de datos si existe el token, si se conecta de otro punto este token cambia
				$fila = $this->lg->count(['token' => $this->user->token]);
				if ($fila > 0) {
					if (!empty($this->session->datosusuario->roles)) {
						$this->roles = $this->session->datosusuario->roles;
					}
					// depende de aplicacion, no todas son iguales
					// if (!empty($rol)) {
					// 	if (!$this->validaroles($rol)) {
					// 		redirect('basico');
					// 	}
					// }
					// if($estado == 3 && $estado != $this->user->estado) {
					// 	redirect('');
					// }
					return true;
				}
			}
		}
		redirect('login/salir');
	}
	protected function errores($data = null)
	{
		if (!empty($data)) {
			if (is_array($data)) {
				$data = implode_r($data);
			} elseif (is_object($data)) {
				$data = print_r($data, 1);
			}
			$this->iffalse($data);
		} else $this->iffalse('No se enconntrarón registros');
	}
	protected function deletefiles()
	{
		$ruta = $this->config->config['sess_save_path'];
		$fechaa = strtotime("-1 hours");
		if (!empty($ruta) && is_string($ruta)) {
			if ($dh = opendir($ruta)) {
				while (($file = readdir($dh)) !== false) {
					if (is_dir($file) && $file != '.' && $file != '..') {
						continue;
					} elseif (is_string($file) && $file != '.' && $file != '..') {
						$rutafile = $ruta . $file;
						if (file_exists($rutafile)) {
							$fechac = filemtime($rutafile);
							if ($fechac <= $fechaa) {
								@unlink($rutafile);
							}
						}
					}
				}
				closedir($dh);
			}
		}
	}
	protected function breadcrumb($rutas = array())
	{
		return $this->view('layouts/_breadcrumb', ['rutas' => $rutas], true);
	}
	// funciones privadas  ////////////////////////////////////////////////

}
