<?php
class Destinos_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public $table = "destinos";
    public $table_id = "id";


    /**
     * Lista los destinos con el número de tarifas mayores a cero que tienen
     * configuradas, para marcar en el admin los que aún no tienen precio.
     *
     * @return array
     */
    public function findAllConTarifas()
    {
        return $this->db->select('d.id, d.destino, COUNT(p.id) AS tarifas', false)
            ->from($this->table . ' d')
            ->join('precios p', 'p.id_destino = d.id AND p.tarifa > 0', 'left')
            ->group_by(array('d.id', 'd.destino'))
            ->order_by('d.destino', 'ASC')
            ->get()
            ->result();
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
