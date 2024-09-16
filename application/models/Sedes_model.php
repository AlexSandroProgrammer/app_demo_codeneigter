<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sedes_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
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
        if($query->num_rows() >= 1){
            return $query->row()->totalSedes;
        }else{
            return 0;
        }
    }
    // * método para obtener los medicos de acuerdo a su respectiva sede
    public function obtenerCantidadMedicosPorSede() {
        $query = $this->db->query(" SELECT sedes.nombre_sede AS nombre, COUNT(users.documento) AS cantidad FROM users INNER JOIN sedes ON users.id_sede = sedes.id_sede WHERE users.id_type_user = 2 GROUP BY sedes.nombre_sede");   
        return $query->result_array();
    }
}