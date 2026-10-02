<?php
class Usuarios_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }
    public $table = "usuarios";
    public $table_id = "id";

    /**
     * Cuenta las cotizaciones recibidas en los últimos N días.
     *
     * @param int $dias
     * @return int
     */
    public function countUltimosDias($dias)
    {
        // Excluye envíos con duración inválida (bots), igual que el listado de cotizaciones
        return (int) $this->db->where('created_at >=', date('Y-m-d H:i:s', strtotime('-' . (int) $dias . ' days')))
            ->where_in('dia', array('1', '2', '3', '5', '8'))
            ->count_all_results($this->table);
    }

    /**
     * Listado completo de cotizaciones para el admin, más recientes primero.
     *
     * @return array
     */
    public function listado()
    {
        return $this->db->select('id, nombre, apellido, telefono, correo, politica, direccion, hora, mascota, trayecto, precio, comentarios, vehiculo, dia, more_info, created_at')
            ->order_by('created_at', 'DESC')
            ->get($this->table)
            ->result();
    }

    /**
     * Últimas cotizaciones para el resumen del dashboard. Solo trae datos
     * del viaje, sin datos personales del cliente.
     *
     * @param int $limite
     * @return array
     */
    public function recientes($limite = 5)
    {
        return $this->db->select('id, trayecto, vehiculo, precio, created_at')
            ->order_by('created_at', 'DESC')
            ->limit((int) $limite)
            ->get($this->table)
            ->result();
    }

}
