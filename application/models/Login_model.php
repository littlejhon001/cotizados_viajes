<?php
class Login_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }
    public $table = "usuarios";
    public $table_id = "id";


    public function get_user($email, $password)
    {
        $query = $this->db->select('id,rol,nombre,apellido,correo,cedula')
            ->where('correo', $email)
            ->where('password', $password)
            ->get('usuarios');

        return $query->row();
    }


}
