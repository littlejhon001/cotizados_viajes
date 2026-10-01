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
        // Asegurar headers CORS y Content-Type
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=utf-8');
        
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

    public function enviar_cotizacion()
    {
        // Asegurar headers CORS y Content-Type
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json; charset=utf-8');
        
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
        
        // Generar el PDF
        $this->load->library('dompdf_gen');
        $html_pdf = $this->load->view('pdf/cotizacion', $data, true);
        $pdf_content = $this->dompdf_gen->generate($html_pdf, "cotizacion_" . date('Y-m-d_H-i-s') . ".pdf", false, 'A4', 'landscape');
        
        // Guardar temporalmente el PDF
        $temp_pdf_path = FCPATH . 'temp/cotizacion_' . uniqid() . '.pdf';
        
        // Crear directorio temp si no existe
        if (!is_dir(FCPATH . 'temp')) {
            mkdir(FCPATH . 'temp', 0755, true);
        }
        
        file_put_contents($temp_pdf_path, $pdf_content);
        
        // Crear un objeto para pasar al php_mailer con el destinatario y el contenido
        $correo_obj = (object) array(
            'email' => $correo,
            'subject' => 'Cotización Transdorado',
            'body' => $html,
            'addbcc' => 'cotizaciones@transdorado.co',
            'attachment' => array(
                array(
                    'path' => $temp_pdf_path,
                    'name' => 'Cotizacion_Transdorado_' . date('Y-m-d') . '.pdf'
                )
            )
        );

        // Cargar la librería php_mailer y enviar el correo
        $this->load->library('Php_mailer', null, 'Php_mailer');
        $respuesta = $this->Php_mailer->enviarcorreo($correo_obj);
        
        // Eliminar el archivo temporal después de enviar el correo
        if (file_exists($temp_pdf_path)) {
            unlink($temp_pdf_path);
        }
        // emulacion de respuesta
        // $respuesta = (object) array (
        //     'success' => true,
        //     'error' => ''
        // );

        // Verificar si el correo fue enviado exitosamente
        if ($respuesta->success) {
            // Retorna un mensaje JSON indicando éxito
            echo json_encode(['status' => 'success', 'message' => 'La cotización de tu viaje se ha enviado correctamente con el PDF adjunto.']);
        } else {
            // Retorna un mensaje JSON indicando error
            echo json_encode(['status' => 'error', 'message' => 'Hubo un error al enviar la cotización. Por favor, intenta nuevamente. ' . $respuesta->error]);
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
        
        // Campos adicionales
        $direccion = $this->input->post('direccion');
        $hora = $this->input->post('hora');
        $mascotas = $this->input->post('mascotas') === 'true' || $this->input->post('mascotas') === 'on' || $this->input->post('mascotas') === '1' ? 1 : 0;
        $comentarios = $this->input->post('comentarios');
        $more_info = $this->input->post('more_info') === 'true' || $this->input->post('more_info') === 'on' || $this->input->post('more_info') === '1' ? 1 : 0;
        
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
            'direccion' => $direccion,
            'hora' => $hora,
            'mascota' => $mascotas,
            'comentarios' => $comentarios,
            'more_info' => $more_info,
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
        $correo = (object) array(
            'email' => $cot['cliente']['correo'],
            'subject' => 'Cotización ' . $cot['referencia'] . ' · Transportes Dorado',
            'body' => $this->load->view('mails/_cotizacion_formal', array('cot' => $cot), true),
            'attachment' => array(array(
                'content' => $this->render_cotizacion_pdf($cot),
                'name' => $cot['referencia'] . '.pdf',
                'type' => 'application/pdf',
            )),
        );
        $respuesta = $this->php_mailer->enviarcorreo($correo);
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
    const CONDICIONES_COTIZACION = "Precios en pesos colombianos (COP).\nIncluye conductor, combustible y seguros de ley.\nNo incluye peajes ni parqueaderos salvo que se indique en los ítems.\nLa reserva se confirma con el pago del anticipo acordado.";

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
            $cot['items'][] = array('descripcion' => $desc, 'cantidad' => (float) $cant, 'valor' => (int) $valor, 'total' => $total_item);
        }

        $descuento = isset($in['descuento']) ? (int) preg_replace('/\D/', '', (string) $in['descuento']) : 0;
        if ($descuento > $subtotal) {
            return array('error' => 'El descuento no puede ser mayor que el subtotal.');
        }
        $base = $subtotal - $descuento;
        $iva = $cot['iva'] ? round($base * self::IVA_PORCENTAJE / 100) : 0;
        $cot['totales'] = array('subtotal' => $subtotal, 'descuento' => $descuento, 'base' => $base, 'iva' => $iva, 'total' => $base + $iva);
        $cot['vence'] = date('d/m/Y', strtotime('+' . $cot['vigencia'] . ' days'));
        return $cot;
    }

    private function render_cotizacion_pdf($cot)
    {
        $logo = FCPATH . 'assets/img/logo_transdorado.png';
        $html = $this->load->view('pdf/cotizacion_formal', array(
            'cot' => $cot,
            'logo' => is_readable($logo) ? 'data:image/png;base64,' . base64_encode(file_get_contents($logo)) : '',
            'iva_porcentaje' => self::IVA_PORCENTAJE,
        ), true);
        $this->load->library('dompdf_gen');
        return $this->dompdf_gen->generate($html, $cot['referencia'] . '.pdf', false, 'letter', 'portrait');
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




