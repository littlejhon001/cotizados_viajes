<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once 'application/third_party/Autoloader.php';
// require_once 'application/third_party/psr/Autoloader.php';
class Home extends CI_Controller
{
    // Duraciones (en días) que maneja el cotizador
    const DIAS_TARIFA = array(1, 2, 3, 5, 8);

    public function __construct()
    {
        parent::__construct();
        
        // CORS solo para orígenes conocidos (sitio principal y la propia app)
        $origen = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
        if ($origen !== '' && in_array($origen, $this->origenes_permitidos(), true)) {
            header('Access-Control-Allow-Origin: ' . $origen);
            header('Vary: Origin');
            header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
            header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');
        }
        
        // Manejar peticiones OPTIONS (preflight)
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit();
        }
        
        // Rutas de administración: exigen sesión iniciada en Login/procesar
        $rutas_admin = array('admin', 'usuarios', 'editar_destino', 'crear_destino', 'actualizar_evento', 'eliminar_destino', 'guardar_precios', 'cotizacion_formal', 'cotizacion_formal_pdf', 'cotizacion_formal_enviar');
        if (in_array(strtolower($this->router->fetch_method()), $rutas_admin, true)
            && empty($this->session->user_data->id)) {
            if ($this->input->is_ajax_request()) {
                http_response_code(401);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode(array('success' => 0, 'msg' => 'Sesión expirada, inicie sesión nuevamente'));
                exit();
            }
            redirect('login');
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
        // console($this->session->userdata('user_data'));

        $data['destinos'] = $this->Destinos_model->findAll();
        $data['vehiculos'] = $this->Vehiculos_model->findAll();
        // $data['dia'] = $this->Precios_model->get_dia($id_destino, $id_vehiculo);

        $this->load->view('layouts/header_web');
        $this->load->view('index', $data);
        $this->load->view('layouts/footer');
    }

    public function destinos()
    {
        // Obtener todos los destinos y vehículos
        $destinos = $this->Destinos_model->findAll();
        $vehiculos = $this->Vehiculos_model->findAll();

        $data['vehiculos'] = $vehiculos;
        $data['destinos'] = [];

        // Filtrar: mostrar solo destinos seleccionados (ej. Bogotá y Aeropuerto)
        $allowed_keywords = array('bogota', 'bogotá', 'aeropuerto');

        foreach ($destinos as $destino) {
            $name_lower = mb_strtolower(trim($destino->destino), 'UTF-8');
            $match = false;
            foreach ($allowed_keywords as $kw) {
                if (strpos($name_lower, $kw) !== false) {
                    $match = true;
                    break;
                }
            }
            if (!$match) {
                continue; // ignorar destinos que no coinciden
            }

            $precios = $this->Precios_model->get_precios_por_destino($destino->id);
            $tarifas = array();

            foreach ($precios as $dia => $vehiculosTarifa) {
                foreach ($vehiculosTarifa as $idVehiculo => $tarifa) {
                    $tarifas[] = (object) array(
                        'dia' => $dia,
                        'id_vehiculo' => $idVehiculo,
                        'tarifa' => $tarifa,
                    );
                }
            }

            $data['destinos'][] = (object) array(
                'id' => $destino->id,
                'destino' => $destino->destino,
                'precios' => $precios,
                'tarifas' => $tarifas,
                'tarifas_count' => count($tarifas),
            );
        }

        $this->load->view('layouts/header_web');
        $this->load->view('destinos', $data);
        $this->load->view('layouts/footer');
    }
    public function admin()
    {
        $destinos = $this->Destinos_model->findAllConTarifas();
        $sin_tarifa = 0;
        foreach ($destinos as $d) {
            if ((int) $d->tarifas === 0) {
                $sin_tarifa++;
            }
        }

        $data = array(
            'titulo' => 'Destinos y tarifas',
            'menu' => 'destinos',
            'destinos' => $destinos,
            'stats' => array(
                'destinos' => count($destinos),
                'sin_tarifa' => $sin_tarifa,
                'vehiculos' => (int) $this->Vehiculos_model->count(),
                'cotizaciones_30' => $this->Usuarios_model->countUltimosDias(30),
            ),
            'recientes' => $this->Usuarios_model->recientes(5),
        );
        $this->load->view('layouts/admin_header', $data);
        $this->load->view('admin/dashboard', $data);
        $this->load->view('layouts/admin_footer', $data);
    }
    public function usuarios()
    {
        $limpiar = function ($texto) {
            return trim(preg_replace('/\s+/u', ' ', (string) $texto));
        };

        $cotizaciones = array();
        $destinos_conteo = array();
        $hace7 = strtotime('-7 days');
        $hace30 = strtotime('-30 days');
        $stats = array('total' => 0, 'ult7' => 0, 'ult30' => 0, 'sospechosas' => 0);

        foreach ($this->Usuarios_model->listado() as $c) {
            $ts = $c->created_at ? strtotime($c->created_at) : 0;
            // El formulario público solo ofrece estas duraciones; otro valor indica un envío automático
            $sospechosa = !in_array((int) $c->dia, self::DIAS_TARIFA, true) || !ctype_digit((string) $c->dia);
            $trayecto = $limpiar($c->trayecto);

            $cotizaciones[] = array(
                'id' => (int) $c->id,
                'ts' => $ts,
                'fecha' => $ts ? date('d/m/Y H:i', $ts) : '',
                'nombre' => $limpiar($c->nombre . ' ' . $c->apellido),
                'telefono' => $limpiar($c->telefono),
                'correo' => $limpiar($c->correo),
                'trayecto' => $trayecto,
                'vehiculo' => $limpiar($c->vehiculo),
                'dia' => $sospechosa ? '' : (int) $c->dia,
                'precio' => trim(str_ireplace('Precio:', '', $limpiar($c->precio))),
                'direccion' => $limpiar($c->direccion),
                'hora' => $limpiar($c->hora),
                'mascota' => (string) $c->mascota === '1',
                'more_info' => (string) $c->more_info === '1',
                'politica' => (string) $c->politica === '1',
                'comentarios' => $limpiar($c->comentarios),
                'sospechosa' => $sospechosa,
            );

            if ($sospechosa) {
                $stats['sospechosas']++;
                continue;
            }
            $stats['total']++;
            if ($ts >= $hace7) {
                $stats['ult7']++;
            }
            if ($ts >= $hace30) {
                $stats['ult30']++;
            }
            if ($trayecto !== '') {
                $clave = mb_strtoupper($trayecto);
                $destinos_conteo[$clave] = isset($destinos_conteo[$clave]) ? $destinos_conteo[$clave] + 1 : 1;
            }
        }
        arsort($destinos_conteo);

        $data = array(
            'titulo' => 'Solicitudes web',
            'menu' => 'cotizaciones',
            'cotizaciones' => $cotizaciones,
            'stats' => $stats,
            'top_destino' => $destinos_conteo ? array('nombre' => key($destinos_conteo), 'total' => reset($destinos_conteo)) : null,
        );
        $this->load->view('layouts/admin_header', $data);
        $this->load->view('admin/cotizaciones', $data);
        $this->load->view('layouts/admin_footer', $data);
    }
    public function get_tarifa()
    {
        header('Content-Type: application/json; charset=utf-8');

        $id_destino = $this->input->post('id_destino');
        $id_vehiculo = $this->input->post('id_vehiculo');
        $dia = $this->input->post('dia');
        $data = $this->Precios_model->get_tarifa($id_destino, $id_vehiculo, $dia);
        $this->json($data);
    }
    /**
     * Tarifas disponibles (> 0) de un destino: { "id_vehiculo": { "dia": tarifa } }.
     * Permite al cotizador público mostrar solo combinaciones con precio.
     */
    public function tarifas_destino()
    {
        header('Content-Type: application/json; charset=utf-8');
        header('Cache-Control: public, max-age=300');
        $id_destino = (int) $this->input->get_post('id_destino');
        if ($id_destino <= 0 || empty($this->Destinos_model->find($id_destino))) {
            http_response_code(404);
            echo json_encode(new stdClass());
            return;
        }
        $salida = array();
        foreach ($this->Precios_model->get_precios_por_destino($id_destino) as $dia => $vehiculos) {
            if (!in_array((int) $dia, self::DIAS_TARIFA, true)) {
                continue;
            }
            foreach ($vehiculos as $id_vehiculo => $tarifa) {
                if ((float) $tarifa > 0) {
                    $salida[(int) $id_vehiculo][(int) $dia] = (int) round($tarifa);
                }
            }
        }
        echo json_encode((object) $salida);
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
        $destino = $this->Destinos_model->find((int) $id);
        if (empty($destino)) {
            show_404();
        }

        $data = array(
            'titulo' => 'Editar tarifas',
            'menu' => 'destinos',
            'destino' => $destino,
            'vehiculos' => $this->Vehiculos_model->findAll(),
            'dias' => self::DIAS_TARIFA,
            'precios' => $this->Precios_model->get_precios_por_destino($destino->id),
        );
        $this->load->view('layouts/admin_header', $data);
        $this->load->view('admin/editar_destino', $data);
        $this->load->view('layouts/admin_footer', $data);
    }

    public function inicio()
    {
        $this->load->model('Evento_model');
        $data['eventos'] = $this->Evento_model->findAll();
        $this->load->view('layouts/header_web');
        $this->load->view('index', $data);
        $this->load->view('layouts/footer');
    }

    public function contacto()
    {
        $this->load->view('layouts/header_web');
        $this->load->view('contacto');
        $this->load->view('layouts/footer');
    }

    /**
     * Cotización pública: guarda la solicitud y la envía por correo al cliente
     * con el PDF adjunto. Precio y nombres se toman de la base, no del navegador.
     */
    public function enviar_cotizacion()
    {
        $sol = $this->preparar_solicitud_publica();
        if (isset($sol['error'])) {
            $this->json_publico('error', $sol['error'], isset($sol['http']) ? $sol['http'] : 200);
            return;
        }
        if (!empty($sol['bot'])) {
            // Campo trampa lleno: se responde como éxito para no dar pistas al bot
            $this->json_publico('success', 'La cotización de tu viaje se ha enviado correctamente.');
            return;
        }
        if (!$this->limite_envios('correo', 5, 600) || !$this->limite_envios('correo_dia', 20, 86400)) {
            $this->json_publico('error', 'Has enviado varias cotizaciones seguidas. Espera unos minutos e intenta de nuevo.', 429);
            return;
        }

        $data = $sol['data'];
        $this->registrar_solicitud($data);
        $cot = $this->cotizacion_desde_solicitud($sol);

        $adjunto = $this->adjunto_pdf($this->render_cotizacion_pdf($cot), $cot['referencia'] . '.pdf');
        $correo_obj = (object) array(
            'email' => $data->correo,
            'subject' => 'Cotización ' . $cot['referencia'] . ' · Transportes Dorado',
            'body' => $this->load->view('mails/_cotizacion_formal', array('cot' => $cot, 'firmante' => $this->firmante()), true),
            'embedded' => array(array('path' => FCPATH . 'assets/img/firma_cotizacion.png', 'cid' => 'firma')),
            'addbcc' => 'cotizaciones@transdorado.co',
            'attachment' => array($adjunto),
        );
        $this->load->library('Php_mailer', null, 'Php_mailer');
        $respuesta = $this->Php_mailer->enviarcorreo($correo_obj);
        $this->borrar_adjunto($adjunto);
        $this->log_evento('cotizacion_publica_correo', array('id_destino' => $sol['ids']['destino'], 'enviado' => !empty($respuesta->success)));

        if (!empty($respuesta->success)) {
            $this->json_publico('success', 'La cotización de tu viaje se ha enviado correctamente con el PDF adjunto.');
        } else {
            // El detalle técnico va al log, nunca al usuario
            log_message('error', 'cotizacion_publica_correo: ' . (isset($respuesta->error) ? substr($respuesta->error, 0, 300) : 'sin detalle'));
            $this->json_publico('error', 'Recibimos tu solicitud, pero no pudimos enviar el correo. Un asesor te contactará pronto.');
        }
    }


    /** Cotización pública: guarda la solicitud y descarga el PDF. */
    public function imprimir()
    {
        $sol = $this->preparar_solicitud_publica();
        if (isset($sol['error'])) {
            $this->json_publico('error', $sol['error'], isset($sol['http']) ? $sol['http'] : 422);
            return;
        }
        if (empty($sol['bot'])) {
            if (!$this->limite_envios('pdf', 15, 600)) {
                $this->json_publico('error', 'Has generado varias cotizaciones seguidas. Espera unos minutos e intenta de nuevo.', 429);
                return;
            }
            $this->registrar_solicitud($sol['data']);
        }

        $cot = $this->cotizacion_desde_solicitud($sol);
        $pdf = $this->render_cotizacion_pdf($cot);
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $cot['referencia'] . '.pdf"');
        header('Content-Length: ' . strlen($pdf));
        header('Cache-Control: private, no-transform, no-store, must-revalidate');
        echo $pdf;
    }

    /**
     * Valida la solicitud del formulario público y arma el registro.
     * Precio, destino y vehículo salen de la base a partir de los IDs.
     *
     * @return array array('data' => object, 'ids' => array, 'bot' => bool) o array('error' => mensaje, 'http' => código)
     */
    private function preparar_solicitud_publica()
    {
        if ($this->input->method() !== 'post') {
            return array('error' => 'Método no permitido.', 'http' => 405);
        }
        $origen = isset($_SERVER['HTTP_ORIGIN']) ? $_SERVER['HTTP_ORIGIN'] : '';
        if ($origen !== '' && !in_array($origen, $this->origenes_permitidos(), true)) {
            return array('error' => 'Origen no permitido.', 'http' => 403);
        }

        $txt = function ($campo, $max) {
            $v = trim(preg_replace('/[^\P{C}\n]+/u', '', (string) $this->input->post($campo)));
            return mb_substr($v, 0, $max);
        };
        $marcado = function ($campo) {
            return in_array((string) $this->input->post($campo), array('true', 'on', '1'), true) ? 1 : 0;
        };

        $nombre = $txt('nombre', 60);
        $apellido = $txt('apellidos', 60);
        $telefono = preg_replace('/\D/', '', $txt('telefono', 20));
        $correo = $txt('correo', 150);
        $direccion = $txt('direccion', 200);
        $hora = $txt('hora', 5);
        $comentarios = $txt('comentarios', 255);
        $id_destino = (int) $this->input->post('id_destino');
        $id_vehiculo = (int) $this->input->post('id_vehiculo');
        $dia = (int) $this->input->post('dia');

        if ($nombre === '' || $apellido === '') {
            return array('error' => 'Escribe tu nombre y apellidos.');
        }
        if (strlen($telefono) < 7 || strlen($telefono) > 15) {
            return array('error' => 'Escribe un número de teléfono válido.');
        }
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            return array('error' => 'Escribe un correo electrónico válido.');
        }
        if (!$marcado('politicas')) {
            return array('error' => 'Debes aceptar la política de privacidad.');
        }
        if ($hora !== '' && !preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', $hora)) {
            return array('error' => 'La hora de recogida no es válida.');
        }
        if (!in_array($dia, self::DIAS_TARIFA, true)) {
            return array('error' => 'Selecciona la duración del viaje.');
        }

        $destino = $id_destino ? $this->Destinos_model->find($id_destino) : null;
        $vehiculo = $id_vehiculo ? $this->Vehiculos_model->find($id_vehiculo) : null;
        if (empty($destino) || empty($vehiculo)) {
            return array('error' => 'Selecciona un destino y un vehículo válidos.');
        }
        $fila = $this->Precios_model->get_tarifa($id_destino, $id_vehiculo, $dia);
        $tarifa = !empty($fila[0]) ? (float) $fila[0]->tarifa : 0;
        if ($tarifa <= 0) {
            return array('error' => 'No tenemos tarifa para esa combinación. Prueba otro día o vehículo.');
        }

        $limpiar = function ($t) {
            return trim(preg_replace('/\s+/u', ' ', (string) $t));
        };
        return array(
            'bot' => trim((string) $this->input->post('website')) !== '',
            'ids' => array('destino' => $id_destino, 'vehiculo' => $id_vehiculo),
            'tarifa' => (int) round($tarifa),
            'data' => (object) array(
                'correo' => $correo,
                'nombre' => $nombre,
                'telefono' => $telefono,
                'apellido' => $apellido,
                'precio' => 'Precio: $ ' . number_format($tarifa, 2, ',', '.'),
                'trayecto' => $limpiar($destino->destino),
                'vehiculo' => $limpiar($vehiculo->vehiculo),
                'dia' => (string) $dia,
                'politica' => 1,
                'hora' => $hora,
                'direccion' => $direccion,
                'mascota' => $marcado('mascotas'),
                'comentarios' => $comentarios,
                'more_info' => $marcado('more_info'),
                'created_at' => date('Y-m-d H:i:s'),
            ),
        );
    }

    /** Inserta la solicitud salvo que sea la misma de los últimos 10 minutos (clic en PDF y en correo). */
    private function registrar_solicitud($data)
    {
        $existe = $this->db->where('correo', $data->correo)
            ->where('trayecto', $data->trayecto)
            ->where('vehiculo', $data->vehiculo)
            ->where('dia', $data->dia)
            ->where('created_at >=', date('Y-m-d H:i:s', strtotime('-10 minutes')))
            ->count_all_results('usuarios');
        if (!$existe) {
            $this->Usuarios_model->insert($data);
        }
    }

    /**
     * Límite simple de solicitudes por IP usando la caché en archivos.
     *
     * @return bool true si aún está dentro del límite
     */
    private function limite_envios($accion, $max, $ventana)
    {
        $this->load->driver('cache', array('adapter' => 'file'));
        $clave = 'rl_' . $accion . '_' . md5((string) $this->input->ip_address());
        $registro = $this->cache->get($clave);
        $ahora = time();
        if (!is_array($registro) || $registro['hasta'] < $ahora) {
            $registro = array('n' => 0, 'hasta' => $ahora + $ventana);
        }
        if ($registro['n'] >= $max) {
            return false;
        }
        $registro['n']++;
        $this->cache->save($clave, $registro, $registro['hasta'] - $ahora);
        return true;
    }

    /**
     * Convierte una solicitud del cotizador público al formato de la
     * cotización formal, para usar el mismo PDF y el mismo correo.
     */
    private function cotizacion_desde_solicitud($sol)
    {
        $d = $sol['data'];
        $dias = (int) $d->dia;
        $observaciones = array();
        if ($d->mascota) {
            $observaciones[] = 'El cliente viaja con mascota.';
        }
        if ($d->comentarios !== '') {
            $observaciones[] = 'Comentarios del cliente: ' . $d->comentarios;
        }
        $observaciones = implode("\n", $observaciones);
        $tarifa = (int) $sol['tarifa'];
        $vigencia = 15;
        return array(
            'referencia' => $this->referencia_cotizacion(),
            'fecha' => date('d/m/Y'),
            'cliente' => array(
                'nombre' => trim($d->nombre . ' ' . $d->apellido),
                'documento' => '',
                'telefono' => $d->telefono,
                'correo' => $d->correo,
            ),
            'viaje' => array('fecha' => '', 'hora' => $d->hora, 'origen' => $d->direccion, 'pasajeros' => null),
            'iva' => false,
            'factura' => false,
            'hora_adicional' => self::HORA_ADICIONAL,
            'intro' => self::INTRO_COTIZACION_WEB,
            'vigencia' => $vigencia,
            'vence' => date('d/m/Y', strtotime('+' . $vigencia . ' days')),
            'observaciones' => $observaciones,
            'items' => array(array(
                'descripcion' => 'Transporte a ' . $d->trayecto . ' · ' . $d->vehiculo . ' · ' . $dias . ($dias === 1 ? ' día' : ' días'),
                'cantidad' => 1,
                'valor' => $tarifa,
                'total' => $tarifa,
                'fecha' => '',
            )),
            'totales' => array('subtotal' => $tarifa, 'descuento' => 0, 'base' => $tarifa, 'iva' => 0, 'factura' => 0, 'total' => $tarifa),
        );
    }

    /** Respuesta JSON del cotizador público, en el formato que espera el front. */
    private function json_publico($status, $message, $http = 200)
    {
        http_response_code($http);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode(array('status' => $status, 'message' => $message));
    }

    /** Orígenes que pueden llamar al cotizador (sitio principal y la propia app). */
    private function origenes_permitidos()
    {
        $propio = parse_url(IP_SERVER);
        $lista = array('https://www.transdorado.co', 'https://transdorado.co');
        if (!empty($propio['scheme']) && !empty($propio['host'])) {
            $lista[] = $propio['scheme'] . '://' . $propio['host'] . (!empty($propio['port']) ? ':' . $propio['port'] : '');
        }
        $extra = getenv('ALLOWED_ORIGINS');
        if ($extra) {
            $lista = array_merge($lista, array_map('trim', explode(',', $extra)));
        }
        return $lista;
    }

    public function crear_destino()
    {
        $nombre = trim((string) $this->input->post('nombre'));
        if ($nombre === '' || mb_strlen($nombre) > 255) {
            $this->json(array('success' => 2, 'msg' => 'Ingresa un nombre de destino válido (máx. 255 caracteres).'));
            return;
        }

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
        $id_destino = (int) $this->input->post('id_destino');
        $precios = $this->input->post('precios');

        if (!$id_destino || !is_array($precios) || empty($this->Destinos_model->find($id_destino))) {
            $this->json(array('success' => 0, 'msg' => 'No se pudieron guardar los precios: destino no válido.'));
            return;
        }

        $vehiculos_validos = array();
        foreach ($this->Vehiculos_model->findAll() as $v) {
            $vehiculos_validos[(int) $v->id] = true;
        }

        // Valida todo antes de escribir para no dejar el destino a medio guardar
        $filas = array();
        foreach ($precios as $dia => $vehiculos) {
            if (!in_array((int) $dia, self::DIAS_TARIFA, true) || !is_array($vehiculos)) {
                $this->json(array('success' => 0, 'msg' => 'Día de tarifa no válido.'));
                return;
            }
            foreach ($vehiculos as $id_vehiculo => $tarifa) {
                $tarifa = trim((string) $tarifa);
                if (!isset($vehiculos_validos[(int) $id_vehiculo])) {
                    $this->json(array('success' => 0, 'msg' => 'Vehículo no válido.'));
                    return;
                }
                // Vacío = no disponible (0), igual que en el cotizador
                if ($tarifa === '') {
                    $tarifa = '0';
                }
                if (!is_numeric($tarifa) || $tarifa < 0 || $tarifa > 99999999.99) {
                    $this->json(array('success' => 0, 'msg' => 'Hay tarifas con valores no válidos.'));
                    return;
                }
                $filas[] = array(
                    'id_destino' => $id_destino,
                    'id_vehiculo' => (int) $id_vehiculo,
                    'dia' => (int) $dia,
                    'tarifa' => round((float) $tarifa, 2),
                );
            }
        }

        $this->db->trans_start();
        foreach ($filas as $fila) {
            $this->Precios_model->guardar_o_actualizar_precio($fila);
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === false) {
            $this->json(array('success' => 0, 'msg' => 'No se pudieron guardar los precios.'));
            return;
        }
        $this->json(array('success' => 1, 'msg' => 'Tarifas guardadas'));
    }

    /* ------------------------------------------------------------------
     * Cotización formal: el admin la arma, genera el PDF y lo envía.
     * No se guarda en base de datos ni en disco.
     * ------------------------------------------------------------------ */

    public function cotizacion_formal()
    {
        $limpiar = function ($texto) {
            return trim(preg_replace('/\s+/u', ' ', (string) $texto));
        };
        $destinos = array();
        foreach ($this->Destinos_model->findAllConTarifas() as $d) {
            $destinos[] = array('id' => (int) $d->id, 'nombre' => $limpiar($d->destino));
        }
        $vehiculos = $this->Vehiculos_model->findAll();
        usort($vehiculos, function ($a, $b) {
            return (int) $a->orden - (int) $b->orden;
        });
        $lista_vehiculos = array();
        foreach ($vehiculos as $v) {
            $lista_vehiculos[] = array('id' => (int) $v->id, 'nombre' => $limpiar($v->vehiculo));
        }

        $data = array(
            'titulo' => 'Nueva cotización',
            'menu' => 'cotizacion_formal',
            'referencia' => $this->referencia_cotizacion(),
            'destinos' => $destinos,
            'vehiculos' => $lista_vehiculos,
            'dias' => self::DIAS_TARIFA,
            'condiciones' => self::CONDICIONES_COTIZACION,
            'intro' => self::INTRO_COTIZACION,
            'hora_adicional' => self::HORA_ADICIONAL,
            'factura_porcentaje' => self::FACTURA_PORCENTAJE,
        );
        $this->load->view('layouts/admin_header', $data);
        $this->load->view('admin/cotizacion_formal', $data);
        $this->load->view('layouts/admin_footer', $data);
    }

    /** Descarga el PDF de la cotización enviada en el formulario. */
    public function cotizacion_formal_pdf()
    {
        $cot = $this->validar_cotizacion_formal($this->input->post());
        if (isset($cot['error'])) {
            $this->json(array('success' => 0, 'msg' => $cot['error']));
            return;
        }
        $pdf = $this->render_cotizacion_pdf($cot);
        $this->log_evento('cotizacion_formal_pdf', array('referencia' => $cot['referencia'], 'items' => count($cot['items'])));

        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $cot['referencia'] . '.pdf"');
        header('Content-Length: ' . strlen($pdf));
        header('Cache-Control: private, no-store');
        echo $pdf;
    }

    /** Envía la cotización por correo con el PDF adjunto. */
    public function cotizacion_formal_enviar()
    {
        $cot = $this->validar_cotizacion_formal($this->input->post());
        if (isset($cot['error'])) {
            $this->json(array('success' => 0, 'msg' => $cot['error']));
            return;
        }
        if ($cot['cliente']['correo'] === '') {
            $this->json(array('success' => 0, 'msg' => 'Ingresa el correo del cliente para enviar la cotización.'));
            return;
        }

        $this->load->library('Php_mailer');
        $adjunto = $this->adjunto_pdf($this->render_cotizacion_pdf($cot), $cot['referencia'] . '.pdf');
        $correo = (object) array(
            'email' => $cot['cliente']['correo'],
            'subject' => 'Cotización ' . $cot['referencia'] . ' · Transportes Dorado',
            'body' => $this->load->view('mails/_cotizacion_formal', array('cot' => $cot, 'firmante' => $this->firmante()), true),
            'embedded' => array(array('path' => FCPATH . 'assets/img/firma_cotizacion.png', 'cid' => 'firma')),
            'attachment' => array($adjunto),
        );
        $respuesta = $this->php_mailer->enviarcorreo($correo);
        $this->borrar_adjunto($adjunto);
        $ok = !empty($respuesta->success);
        $this->log_evento('cotizacion_formal_correo', array('referencia' => $cot['referencia'], 'enviado' => $ok));

        if ($ok) {
            $this->json(array('success' => 1, 'msg' => 'Cotización enviada'));
        } else {
            log_message('error', 'cotizacion_formal_correo: ' . (isset($respuesta->error) ? substr($respuesta->error, 0, 300) : 'sin detalle'));
            $this->json(array('success' => 0, 'msg' => 'No se pudo enviar el correo. Revisa la configuración SMTP.'));
        }
    }

    const IVA_PORCENTAJE = 19;
    const FACTURA_PORCENTAJE = 7;
    const HORA_ADICIONAL = 100000;
    const INTRO_COTIZACION = 'De acuerdo a lo dialogado por teléfono enviamos cotización de nuestros productos y servicios de transporte.';
    const INTRO_COTIZACION_WEB = 'Gracias por cotizar en nuestro sitio web. Enviamos la cotización del servicio de transporte que solicitaste.';
    // Las condiciones del servicio (cláusulas A a I) están en la plantilla pdf/cotizacion_formal.php
    const CONDICIONES_COTIZACION = '';

    /** Referencia legible sin consecutivo (no se guarda historial). */
    private function referencia_cotizacion()
    {
        return 'COT-' . date('ymd-Hi') . '-' . strtoupper(substr(bin2hex(random_bytes(2)), 0, 3));
    }

    /**
     * Valida y normaliza la cotización recibida. Los totales siempre se
     * recalculan aquí; no se confía en los que calcule el navegador.
     *
     * @param array $in POST
     * @return array Cotización normalizada o array('error' => mensaje)
     */
    private function validar_cotizacion_formal($in)
    {
        $txt = function ($v, $max) {
            $v = trim(preg_replace('/[^\P{C}\n]+/u', '', (string) $v));
            return mb_substr($v, 0, $max);
        };
        $in = is_array($in) ? $in : array();
        $cliente = isset($in['cliente']) && is_array($in['cliente']) ? $in['cliente'] : array();
        $viaje = isset($in['viaje']) && is_array($in['viaje']) ? $in['viaje'] : array();

        $cot = array(
            'referencia' => $txt(isset($in['referencia']) ? $in['referencia'] : '', 30),
            'fecha' => date('d/m/Y'),
            'cliente' => array(
                'nombre' => $txt(isset($cliente['nombre']) ? $cliente['nombre'] : '', 150),
                'documento' => $txt(isset($cliente['documento']) ? $cliente['documento'] : '', 30),
                'telefono' => $txt(isset($cliente['telefono']) ? $cliente['telefono'] : '', 30),
                'correo' => $txt(isset($cliente['correo']) ? $cliente['correo'] : '', 150),
            ),
            'viaje' => array(
                'fecha' => $txt(isset($viaje['fecha']) ? $viaje['fecha'] : '', 10),
                'hora' => $txt(isset($viaje['hora']) ? $viaje['hora'] : '', 5),
                'origen' => $txt(isset($viaje['origen']) ? $viaje['origen'] : '', 200),
                'pasajeros' => isset($viaje['pasajeros']) && $viaje['pasajeros'] !== '' ? (int) $viaje['pasajeros'] : null,
            ),
            'iva' => !empty($in['iva']),
            'factura' => !empty($in['factura']),
            'hora_adicional' => isset($in['hora_adicional']) && $in['hora_adicional'] !== '' ? (int) preg_replace('/\D/', '', (string) $in['hora_adicional']) : self::HORA_ADICIONAL,
            'intro' => $txt(isset($in['intro']) && trim((string) $in['intro']) !== '' ? $in['intro'] : self::INTRO_COTIZACION, 600),
            'vigencia' => isset($in['vigencia']) ? (int) $in['vigencia'] : 15,
            'observaciones' => $txt(isset($in['observaciones']) ? $in['observaciones'] : '', 2000),
            'items' => array(),
        );

        if (!preg_match('/^COT-\d{6}-\d{4}-[0-9A-F]{3}$/', $cot['referencia'])) {
            $cot['referencia'] = $this->referencia_cotizacion();
        }
        if ($cot['cliente']['nombre'] === '') {
            return array('error' => 'Ingresa el nombre del cliente.');
        }
        if ($cot['cliente']['correo'] !== '' && !filter_var($cot['cliente']['correo'], FILTER_VALIDATE_EMAIL)) {
            return array('error' => 'El correo del cliente no es válido.');
        }
        if ($cot['cliente']['telefono'] !== '' && !preg_match('/^[0-9+()\s-]{7,30}$/', $cot['cliente']['telefono'])) {
            return array('error' => 'El teléfono del cliente no es válido.');
        }
        if ($cot['viaje']['fecha'] !== '') {
            $f = DateTime::createFromFormat('Y-m-d', $cot['viaje']['fecha']);
            if (!$f || $f->format('Y-m-d') !== $cot['viaje']['fecha']) {
                return array('error' => 'La fecha del servicio no es válida.');
            }
            $cot['viaje']['fecha_texto'] = $f->format('d/m/Y');
        }
        if ($cot['viaje']['hora'] !== '' && !preg_match('/^([01]\d|2[0-3]):[0-5]\d$/', $cot['viaje']['hora'])) {
            return array('error' => 'La hora del servicio no es válida.');
        }
        if ($cot['viaje']['pasajeros'] !== null && ($cot['viaje']['pasajeros'] < 1 || $cot['viaje']['pasajeros'] > 200)) {
            return array('error' => 'El número de pasajeros debe estar entre 1 y 200.');
        }
        if ($cot['vigencia'] < 1 || $cot['vigencia'] > 90) {
            return array('error' => 'La vigencia debe estar entre 1 y 90 días.');
        }

        $items = isset($in['items']) && is_array($in['items']) ? array_values($in['items']) : array();
        if (count($items) === 0 || count($items) > 30) {
            return array('error' => 'Agrega entre 1 y 30 ítems a la cotización.');
        }
        $subtotal = 0;
        foreach ($items as $n => $it) {
            $desc = $txt(is_array($it) && isset($it['descripcion']) ? $it['descripcion'] : '', 255);
            $cant = is_array($it) && isset($it['cantidad']) ? str_replace(',', '.', (string) $it['cantidad']) : '';
            $valor = is_array($it) && isset($it['valor']) ? preg_replace('/\D/', '', (string) $it['valor']) : '';
            $fecha_it = is_array($it) && isset($it['fecha']) ? trim((string) $it['fecha']) : '';
            if ($fecha_it !== '') {
                $f = DateTime::createFromFormat('Y-m-d', $fecha_it);
                if (!$f || $f->format('Y-m-d') !== $fecha_it) {
                    return array('error' => 'La fecha del ítem ' . ($n + 1) . ' no es válida.');
                }
            }
            if ($desc === '') {
                return array('error' => 'El ítem ' . ($n + 1) . ' no tiene descripción.');
            }
            if (!is_numeric($cant) || $cant <= 0 || $cant > 1000) {
                return array('error' => 'La cantidad del ítem ' . ($n + 1) . ' no es válida.');
            }
            if ($valor === '' || strlen($valor) > 10) {
                return array('error' => 'El valor del ítem ' . ($n + 1) . ' no es válido.');
            }
            $total_item = round((float) $cant * (int) $valor);
            $subtotal += $total_item;
            $cot['items'][] = array('descripcion' => $desc, 'cantidad' => (float) $cant, 'valor' => (int) $valor, 'total' => $total_item, 'fecha' => $this->fecha_larga($fecha_it));
        }

        $descuento = isset($in['descuento']) ? (int) preg_replace('/\D/', '', (string) $in['descuento']) : 0;
        if ($descuento > $subtotal) {
            return array('error' => 'El descuento no puede ser mayor que el subtotal.');
        }
        $base = $subtotal - $descuento;
        if ($cot['hora_adicional'] > 10000000) {
            return array('error' => 'El valor de la hora adicional no es válido.');
        }
        $iva = $cot['iva'] ? round($base * self::IVA_PORCENTAJE / 100) : 0;
        $factura = $cot['factura'] ? round($base * self::FACTURA_PORCENTAJE / 100) : 0;
        $cot['totales'] = array('subtotal' => $subtotal, 'descuento' => $descuento, 'base' => $base, 'iva' => $iva, 'factura' => $factura, 'total' => $base + $iva + $factura);
        $cot['vence'] = date('d/m/Y', strtotime('+' . $cot['vigencia'] . ' days'));
        return $cot;
    }

    private function render_cotizacion_pdf($cot)
    {
        $logo = FCPATH . 'assets/img/logo_transdorado.png';
        $firma = FCPATH . 'assets/img/firma_cotizacion.png';
        $html = $this->load->view('pdf/cotizacion_formal', array(
            'cot' => $cot,
            'logo' => is_readable($logo) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logo)) : '',
            'firma' => is_readable($firma) ? 'data:image/png;base64,' . base64_encode(file_get_contents($firma)) : '',
            'firmante' => $this->firmante(),
            'iva_porcentaje' => self::IVA_PORCENTAJE,
            'factura_porcentaje' => self::FACTURA_PORCENTAJE,
            'fecha_larga' => $this->fecha_larga(date('Y-m-d')),
            'pago' => $this->datos_pago(),
        ), true);
        $this->load->library('dompdf_gen');
        return $this->dompdf_gen->generate($html, $cot['referencia'] . '.pdf', false, 'letter', 'portrait');
    }

    /**
     * Adjunto PDF para la librería de correo. Se entrega en memoria ('content')
     * y también como archivo temporal ('path') en application/cache, que no es
     * pública: así funciona tanto con la librería actual como con versiones
     * anteriores que solo adjuntan archivos en disco. Borrar con borrar_adjunto().
     */
    private function adjunto_pdf($contenido, $nombre)
    {
        $adjunto = array('content' => $contenido, 'name' => $nombre, 'type' => 'application/pdf');
        $ruta = APPPATH . 'cache/adj_' . bin2hex(random_bytes(8)) . '.pdf';
        if (@file_put_contents($ruta, $contenido) !== false) {
            $adjunto['path'] = $ruta;
        } else {
            log_message('error', 'adjunto_pdf: no se pudo escribir el temporal en application/cache');
        }
        return $adjunto;
    }

    private function borrar_adjunto($adjunto)
    {
        if (!empty($adjunto['path']) && strpos($adjunto['path'], APPPATH . 'cache/adj_') === 0 && is_file($adjunto['path'])) {
            @unlink($adjunto['path']);
        }
    }

    /** "2026-12-04" -> "4 de diciembre de 2026" */
    private function fecha_larga($ymd)
    {
        if (!$ymd || !($t = strtotime($ymd))) {
            return '';
        }
        $meses = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
        return (int) date('j', $t) . ' de ' . $meses[(int) date('n', $t) - 1] . ' de ' . date('Y', $t);
    }

    /**
     * Medios de pago para las cláusulas de reserva. Son datos financieros:
     * se configuran en .env (PAGO_MEDIOS, PAGO_CUENTA_EMPRESA) y no en el código.
     */
    private function datos_pago()
    {
        $this->load->library('Php_mailer', null, 'Php_mailer');
        $medios = getenv('PAGO_MEDIOS');
        $empresa = getenv('PAGO_CUENTA_EMPRESA');
        return array(
            'medios' => $medios !== false ? trim($medios) : '',
            'empresa' => $empresa !== false ? trim($empresa) : '',
        );
    }

    /** Firmante de las cotizaciones; el nombre se configura en .env (FIRMA_NOMBRE), no en el código. */
    private function firmante()
    {
        $this->load->library('Php_mailer', null, 'Php_mailer');
        $nombre = getenv('FIRMA_NOMBRE');
        $cargo = getenv('FIRMA_CARGO');
        return array(
            'nombre' => $nombre !== false ? trim($nombre) : '',
            'cargo' => $cargo !== false && trim($cargo) !== '' ? trim($cargo) : 'Gerente General',
        );
    }

    /** Log estructurado JSON con execution_id (UUID v4), sin datos personales. */
    private function log_evento($evento, $datos = array())
    {
        $b = random_bytes(16);
        $b[6] = chr(ord($b[6]) & 0x0f | 0x40);
        $b[8] = chr(ord($b[8]) & 0x3f | 0x80);
        $uuid = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($b), 4));
        $registro = array_merge(array(
            'ts' => date('c'),
            'execution_id' => $uuid,
            'evento' => $evento,
            'admin_id' => isset($this->session->user_data->id) ? (int) $this->session->user_data->id : null,
        ), $datos);
        log_message('info', json_encode($registro, JSON_UNESCAPED_UNICODE));
    }
    


}




