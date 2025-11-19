<?php
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
class Php_mailer {
	public function __construct() {
		log_message('Debug', 'PHPMailer class is loaded.');
	}
	public function load() {
		require_once APPPATH . "third_party/phpmailer/PHPMailerAutoload.php";
		$objMail = new PHPMailer;
		return $objMail;
	}
	/**
	 * enviarcorreo
	 * @author Juan Guevara <juanjose.guevararozo@gmail.com>
	 *
	 * @param  mixed $correo = {
	 *      subject: Tema del correo,
	 *      email: para quien es el correo,
	 *      body: contenido del correo,
	 *      addbcc: copiar, addbcc: array(copiar1=>uno, copiar2=>dos)
	 * }
	 * @return array(error,email,success)
	 */
	public function enviarcorreo($correo) {
		$return = (object) ['success' => ''];
		if (!empty($correo->email)) {
			$return->email = $correo->email;
			try {
				$mail = $this->load();
				$mail->CharSet = 'UTF-8'; // Enable verbose debug output
				$mail->isSMTP(); // Set mailer to use SMTP
				$mail->Host = 'smtp.hostinger.com'; // Specify main and backup SMTP servers
				$mail->SMTPAuth = true; // Enable SMTP authentication
				$mail->Username = 'administrador@transdorado.co'; // SMTP username (REEMPLAZAR EN LOCAL CON EL CORREO DEL SMTP - NO SUBIR)
				$mail->Password = 'Dereck0212*'; // SMTP password   (REEMPLAZAR EN LOCAL CON LA CONTRASEÑA DEL SMTP - NO SUBIR)
				$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
				$mail->Port = 587;
				$mail->setFrom('	cotizaciones@transdorado.co', 'Cotizador transdorado');
				$mail->Subject = empty($correo->subject) ? 'Cotización' : $correo->subject;
                $mail->AddEmbeddedImage(FCPATH . "assets/img/logo_transdorado.png", "main_logo");  //logo principal
				$mail->IsHTML(true);
				$mail->addAddress($correo->email);
				if (!empty($correo->addbcc)) {
					if (is_array($correo->addbcc)) {
						foreach ($correo->addbcc as $v) {
							$mail->addBcc($v);
						}
					} else {
						$mail->addBcc($correo->addbcc);
					}
				}
				// Adjuntar archivos si existen
				if (!empty($correo->attachment)) {
					if (is_array($correo->attachment)) {
						foreach ($correo->attachment as $file) {
							if (isset($file['path']) && file_exists($file['path'])) {
								$filename = isset($file['name']) ? $file['name'] : basename($file['path']);
								$mail->addAttachment($file['path'], $filename);
							}
						}
					} else {
						if (file_exists($correo->attachment)) {
							$mail->addAttachment($correo->attachment);
						}
					}
				}
				$mail->Body = empty($correo->body) ? 'Cotización' : $correo->body;
				if ($mail->send()) {
					$return->success = 1;
				} else {
					$return->error = "No se pudo enviar el mensaje. Error de envío: {$mail->ErrorInfo}";
				}
			} catch (Exception $e) {
				$return->error = print_r($e, 1);
			}
		} else {
			$return->error = 'Sin correo';
		}
		return $return;
	}
	public function verhtml($html = '') {
		echo $html;
	}
}
