<?php
# Nota de Transparencia: Código generado/refactorizado con asistencia de IA Generativa (Claude Code) bajo la Política ODTI012 del CCS. Requiere supervisión y validación humana permanente.
class Login_model extends MY_Model {
    public function __construct() {
        parent::__construct();
    }
    public $table = "usuarios_admin";
    public $table_id = "id";


    /**
     * Busca un administrador por correo. Incluye el campo password para
     * que el controlador lo verifique con password_verify(); nunca debe
     * guardarse en sesión.
     *
     * @param string $email
     * @return object|null
     */
    public function get_by_email($email)
    {
        $query = $this->db->select('id,nombre,apellido,correo,password')
            ->where('correo', $email)
            ->limit(1)
            ->get($this->table);

        return $query->row();
    }

    /**
     * Reemplaza la contraseña almacenada por su hash.
     *
     * @param int    $id
     * @param string $hash Resultado de password_hash()
     * @return bool
     */
    public function update_password($id, $hash)
    {
        return $this->db->where($this->table_id, $id)
            ->update($this->table, array('password' => $hash));
    }


}
