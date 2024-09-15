<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sedes extends CI_Model
{
    //TODO: METODOS
    // * metodo para registrar sede
    function registrarSede($data)
    {
        $this->db->insert('sede', $data);
    }
}