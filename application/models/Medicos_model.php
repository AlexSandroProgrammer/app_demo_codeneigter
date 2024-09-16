<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Medicos_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // * método para registrar sede
    public function registrarMedico($data)
    {
        // Realiza la inserción en la base de datos
        $this->db->insert('medicos', $data);

        // Verifica si la inserción fue exitosa
        if ($this->db->affected_rows() > 0) {
            return true; // La inserción fue exitosa
        } else {
            return false; // La inserción falló
        }
    }

    // * método para obtener todas las sedes
    public function obtenerMedicos()
    {
        $query = $this->db->get('medicos');
        return $query->result();
    }
}