<?php
class Login_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }
    public $table = "usuarios_admin";
    public $table_id = "id";


    public function get_user($email, $password)
    {
        $query = $this->db->select('id,nombre,apellido,correo')
            ->where('correo', $email)
            ->where('password', $password)
            ->get($this->table);

        return $query->row();
    }


}
