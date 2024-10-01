<?php
class Evento_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public $table = "evento";
    public $table_id = "id";


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
