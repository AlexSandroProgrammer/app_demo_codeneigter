<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Medicos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // * método para registrar medico
    public function registrarMedico($data)
    {
        // Realiza la inserción en la base de datos
        $this->db->insert('users', $data);

        // Verifica si la inserción fue exitosa
        if ($this->db->affected_rows() > 0) {
            return true; // La inserción fue exitosa
        } else {
            return false; // La inserción falló
        }
    }

    // * método para obtener todas las medicos
    public function obtenerMedicos(){
        $query = $this->db->query("SELECT * FROM users INNER JOIN estados ON users.id_state = estados.id_estado INNER JOIN tipos ON users.id_type_user = tipos.id INNER JOIN sedes ON users.id_sede = sedes.id_sede WHERE users.id_type_user = 2");
        if($query->num_rows() >= 1){
            return $query->result();
        }else{
            return [];
        }
    }

    //* metodo para hacer un conteo de medicos
    public function contarMedicos(){
        $query = $this->db->query("SELECT COUNT(*) as totalMedicos FROM users WHERE id_type_user = 2");
        if($query->num_rows() == 1){
            return $query->row()->totalMedicos;
        }else{
            return 0;
        }
    }
}