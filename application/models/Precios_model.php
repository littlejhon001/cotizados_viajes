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
}
