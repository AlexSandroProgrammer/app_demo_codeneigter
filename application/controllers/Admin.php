<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); // Cargar la librería
        $this->load->model('Medicos_model'); // Cargar el modelo correctamente
        $this->load->model('Sedes_model'); // Cargar el modelo correctamente
        $this->load->model('Estados_model'); // Cargar el modelo correctamente
        $this->load->model('Tipos_model'); // Cargar el modelo correctamente
    }
	//  metodo para mostrar pagina inicial
	public function index(){
		$this->load->view('admin/index');
	}
}