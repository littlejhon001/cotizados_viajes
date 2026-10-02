<?php
# Nota de Transparencia: Código generado/refactorizado con asistencia de IA Generativa (Claude Code) bajo la Política ODTI012 del CCS. Requiere supervisión y validación humana permanente.
if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}
class Php_mailer {
	public function __construct() {
		log_message('Debug', 'PHPMailer class is loaded.');
		self::cargar_env();
	}

	/**
	 * Carga variables desde el archivo .env de la raíz del proyecto (no versionado)
	 * sin sobrescribir las que ya existan en el entorno del servidor.
	 */
	public static function cargar_env() {
		$archivo = FCPATH . '.env';
		if (!is_readable($archivo)) {
			return;
		}
		foreach (file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $linea) {
			$linea = trim($linea);
			if ($linea === '' || $linea[0] === '#' || strpos($linea, '=') === false) {
				continue;
			}
			list($clave, $valor) = array_map('trim', explode('=', $linea, 2));
			$valor = trim($valor, "\"'");
			if ($clave !== '' && getenv($clave) === false) {
				putenv($clave . '=' . $valor);
			}
		}
	}

	private static function env($clave, $defecto = '') {
		$valor = getenv($clave);
		return ($valor === false || $valor === '') ? $defecto : $valor;
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
				if (self::env('SMTP_PASS') === '') {
					$return->error = 'SMTP no configurado: defina SMTP_HOST, SMTP_USER y SMTP_PASS en .env';
					return $return;
				}
				$mail->Host = self::env('SMTP_HOST', 'smtp.hostinger.com');
				$mail->SMTPAuth = true;
				$mail->Username = self::env('SMTP_USER');
				$mail->Password = self::env('SMTP_PASS');
				$mail->SMTPSecure = self::env('SMTP_SECURE', 'tls');
				$mail->Port = (int) self::env('SMTP_PORT', '587');
				$mail->setFrom(self::env('SMTP_FROM', self::env('SMTP_USER')), self::env('SMTP_FROM_NAME', 'Cotizador Transdorado'));
				$mail->Subject = empty($correo->subject) ? 'Cotización' : $correo->subject;
                $mail->AddEmbeddedImage(FCPATH . "assets/img/logo_transdorado.png", "main_logo");  //logo principal
				// Imágenes adicionales dentro del cuerpo: array(array('path' => ..., 'cid' => ...))
				if (!empty($correo->embedded) && is_array($correo->embedded)) {
					foreach ($correo->embedded as $img) {
						if (isset($img['path'], $img['cid']) && is_readable($img['path'])) {
							$mail->AddEmbeddedImage($img['path'], $img['cid']);
						}
					}
				}
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
							// Adjunto generado en memoria (p. ej. un PDF), sin escribirlo a disco
							if (isset($file['content'], $file['name'])) {
								$mail->addStringAttachment($file['content'], $file['name'], 'base64', isset($file['type']) ? $file['type'] : 'application/octet-stream');
							} elseif (isset($file['path']) && file_exists($file['path'])) {
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
