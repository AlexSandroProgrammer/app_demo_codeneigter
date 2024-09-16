<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Estados_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // * método para registrar estado
    public function registrarEstado($data)
    {
        // Realiza la inserción en la base de datos
        $this->db->insert('estados', $data);

        // Verifica si la inserción fue exitosa
        if ($this->db->affected_rows() > 0) {
            return true; // La inserción fue exitosa
        } else {
            return false; // La inserción falló
        }
    }

    // * método para obtener todas las estados
    public function obtenerEstados()
    {
        $query = $this->db->get('estados');
        return $query->result();
    }
}