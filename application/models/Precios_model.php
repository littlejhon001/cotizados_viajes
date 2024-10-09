<?php
class Precios_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public $table = "precios";
    public $table_id = "id";

    public function get_tarifa($id_destino, $id_vehiculo, $dia)
    {
        $this->db->select(' tarifa');
        $this->db->from($this->table);
        $this->db->where('id_destino', $id_destino);
        $this->db->where('id_vehiculo', $id_vehiculo);
        $this->db->where('dia', $dia);
        return $this->db->get()->result();
    }


    public function create($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where($this->table_id, $id);
        $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where($this->table_id, $id);
        $this->db->delete($this->table);
    }

    public function guardar_o_actualizar_precio($data)
    {
        // Verifica si ya existe un registro con el mismo id_destino, id_vehiculo y día
        $this->db->where('id_destino', $data['id_destino']);
        $this->db->where('id_vehiculo', $data['id_vehiculo']);
        $this->db->where('dia', $data['dia']);
        $query = $this->db->get('precios'); // Cambia por el nombre real de tu tabla

        if ($query->num_rows() > 0) {
            // Si existe, actualiza el registro
            $this->db->where('id_destino', $data['id_destino']);
            $this->db->where('id_vehiculo', $data['id_vehiculo']);
            $this->db->where('dia', $data['dia']);
            $this->db->update('precios', ['tarifa' => $data['tarifa']]);
        } else {
            // Si no existe, inserta un nuevo registro
            $this->db->insert('precios', $data);
        }
    }


    public function get_precios_por_destino($id_destino)
    {
        $this->db->where('id_destino', $id_destino);
        $query = $this->db->get('precios'); // Cambia 'tu_tabla_de_precios' por el nombre real de la tabla
        $result = $query->result();

        // Organizar precios por día y vehículo
        $precios = [];
        foreach ($result as $row) {
            $precios[$row->dia][$row->id_vehiculo] = $row->tarifa;
        }

        return $precios;
    }


}
