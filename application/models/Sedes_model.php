<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sedes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // * método para registrar sede
    public function registrarSede($data)
    {
        // Realiza la inserción en la base de datos
        $this->db->insert('sedes', $data);

        // Verifica si la inserción fue exitosa
        if ($this->db->affected_rows() > 0) {
            return true; // La inserción fue exitosa
        } else {
            return false; // La inserción falló
        }
    }

    // * método para obtener todas las sedes
    public function obtenerSedes()
    {
        $query = $this->db->get('sedes');
        return $query->result();
    }

    //* metodo para hacer un conteo de sedes
    public function contarSedes(){
        $query = $this->db->query("SELECT COUNT(*) as totalSedes FROM sedes");
        if($query->num_rows() == 1){
            return $query->row()->totalSedes;
        }else{
            return 0;
        }
    }
}