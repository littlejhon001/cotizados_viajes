<?php
# Nota de Transparencia: Código generado/refactorizado con asistencia de IA Generativa (Claude Code) bajo la Política ODTI012 del CCS. Requiere supervisión y validación humana permanente.
defined('BASEPATH') or exit('No direct script access allowed');
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
		$this->load->library('form_validation');

	}

	public function index()
	{

		$this->view('login');

	}

	// public function procesar()
	// {
	// 	// Procesar el formulario de inicio de sesión
	// 	$email = $this->input->post('email');
	// 	$password = $this->input->post('contrasena');

	// 	// Obtener el usuario autenticado desde el modelo de inicio de sesión
	// 	$user = $this->Login_model->get_user($email, hash('sha256', $password));     //Se compara con la contraseña hasheada

	// 	$this->form_validation->set_rules(
	// 		'email',
	// 		'correo del usuario',
	// 		'required',
	// 		array(
	// 			'required' => 'Por favor ingrese un %s',
	// 		)
	// 	);

	// 	$this->form_validation->set_rules(
	// 		'contrasena',
	// 		'contraseña',
	// 		'required',
	// 		array(
	// 			'required' => '<br> Por favor ingrese una %s',
	// 		)
	// 	);



	// 	if ($user) {
	// 		// Usuario autenticado, guardar toda la información del usuario en la sesión
	// 		if ($this->form_validation->run()) {
	// 			// Validación exitosa
	// 			if (!empty($datos->data) && $datos->success == 1) {

	// 				$this->session->set_userdata('user_data', $user);
	// 				$this->json(array('success' => 1, 'msg' => 'Bienvenido'));
	// 			} else {

	// 				$this->session->set_flashdata('mensaje', 'Datos Erróneos');
	// 				$this->json(array('success' => 0, 'msg' => 'Usuario o contraseña incorrectos'));
	// 			}
	// 		} else {
	// 			// Validación fallida
	// 			$this->json(array('success' => 0, 'msg' => $this->form_validation->error_array()));
	// 		}

	// 		redirect('Home');
	// 	} else {
	// 		// Usuario no autenticado, mostrar mensaje de error o redirigir al formulario de inicio de sesión
	// 		$this->session->set_flashdata('error', 'Usuario o contraseña incorrectos.');
	// 		redirect('login'); // Redirigir de vuelta al formulario de inicio de sesión
	// 	}
	// }

	public function procesar()
	{
		if ($this->input->method() !== 'post') {
			show_404();
		}

		$this->form_validation->set_rules('email', 'correo', 'required|valid_email|max_length[255]');
		$this->form_validation->set_rules('contrasena', 'contraseña', 'required|max_length[255]');
		if (!$this->form_validation->run()) {
			$this->json(array('success' => 0, 'msg' => 'Usuario o contraseña incorrectos'));
			return;
		}

		$email = $this->input->post('email');
		$password = $this->input->post('contrasena');
		$user = $this->Login_model->get_by_email($email);

		if ($user && $this->verificar_password($user, $password)) {
			// Evita fijación de sesión: nuevo ID al autenticarse
			$this->session->sess_regenerate(TRUE);
			// Nunca se guarda el password en sesión
			$this->session->set_userdata('user_data', (object) array(
				'id' => $user->id,
				'nombre' => $user->nombre,
				'apellido' => $user->apellido,
				'correo' => $user->correo,
			));
			$this->json(array('success' => 1, 'msg' => 'Bienvenido'));
		} else {
			// Mismo mensaje si el correo no existe o la clave falla, para no revelar cuentas válidas
			$this->json(array('success' => 0, 'msg' => 'Usuario o contraseña incorrectos'));
		}
	}

	/**
	 * Verifica la contraseña contra el hash almacenado. Si la cuenta aún
	 * tiene la clave en texto plano (registros previos a la migración) y
	 * coincide, la reemplaza por su hash en ese mismo momento.
	 *
	 * @param object $user     Fila de usuarios_admin con el campo password
	 * @param string $password Clave enviada en el formulario
	 * @return bool
	 */
	private function verificar_password($user, $password)
	{
		$stored = (string) $user->password;
		if ($stored === '') {
			return false;
		}

		$info = password_get_info($stored);
		if ($info['algo']) {
			if (!password_verify($password, $stored)) {
				return false;
			}
			if (password_needs_rehash($stored, PASSWORD_DEFAULT)) {
				$this->Login_model->update_password($user->id, password_hash($password, PASSWORD_DEFAULT));
			}
			return true;
		}

		// Clave legada en texto plano: comparación en tiempo constante y rehash inmediato
		if (hash_equals($stored, $password)) {
			$this->Login_model->update_password($user->id, password_hash($password, PASSWORD_DEFAULT));
			return true;
		}
		return false;
	}


	public function logout()
	{
		$this->session->unset_userdata('user_data');
		$this->session->sess_destroy();
		redirect('login');
	}



	// public function ingresar() {
	// 	if (!empty($this->formData->username) && !empty($this->formData->password)) {
	// 		// validar en http://ssologin
	// 		$this->load->library('ssologin');
	// 		$data = $this->ssologin->ingresar($this->formData->username, $this->formData->password);

	// 		if (!empty($data['data']) && $data['success'] && empty($data['errores'])) {
	// 			$datos = (object) $data['data'];
	// 			if ($datos->usuario == $this->formData->username && $datos->mail && $datos->tiempo) {
	// 				$datos->token = hash('sha256', $datos->token);
	// 				$data = array(
	// 					'mail' => $datos->mail,
	// 					'token' => $datos->token,
	// 					'roles' => !empty($datos->roles) ? implode(',', $datos->roles) : '',
	// 					'tiempo' => $datos->tiempo,
	// 					'nombre' => $datos->displayname
	// 				);
	// 				// consultar si existe
	// 				$user = $this->lg->findName(['usuario' => $this->formData->username]);
	// 				if (!empty($user->id) && $user->usuario) {
	// 					$data['update_at'] = date('Y-m-d H:i:s');
	// 					$this->updateuser($this->formData->username, $data);
	// 					$data['id'] = $user->id;
	// 				} else {
	// 					$data['created_at'] = date('Y-m-d H:i:s');
	// 					$data['usuario'] = $this->formData->username;
	// 					$data['id'] = $this->lg->insert($data);
	// 				}
	// 				$data['usuario'] = $this->formData->username;
	// 				$this->session->datosusuario = (object) $data;
	// 				$this->reques->url = 'home';
	// 			} else {
	// 				$this->updateuser($this->formData->username);
	// 				$this->iffalse('Error 39');
	// 			}
	// 		} else {
	// 			$this->updateuser($this->formData->username);
	// 			$this->errores($data);
	// 		}
	// 	} else $this->iffalse('Datos invalidos');
	// 	$this->json();
	// }
	public function salir()
	{
		$this->logout();
	}
	// public function logout()
	// {
	// 	if (!empty($this->formData->usuario)) {
	// 		$this->updateuser($this->formData->usuario);
	// 		$this->reques->data = 'Logout';
	// 		$this->deletefiles();
	// 	} else {
	// 		$this->iffalse('no token');
	// 	}
	// 	unset($this->session->datosusuario);
	// 	$this->json();
	// }


}
