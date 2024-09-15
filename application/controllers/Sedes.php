<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sedes extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation'); // Cargar la librería
	}
	//  metodo para mostrar pagina inicial
	public function index(){
		$this->load->view('admin/sedes');
	}
	// funcion para realizar registro de usuario en el modulo de autenticacion
	public function register()
	{
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Configurar las reglas de validación para los campos del formulario
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('names', 'Names', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('surnames', 'Surnames', 'required');
			$this->form_validation->set_rules('id', 'Id', 'required');
			$this->form_validation->set_rules('id_type_user', 'Id_Type_User', 'required');
			$this->form_validation->set_rules('id_state', 'Id_State', 'required');
			if ($this->form_validation->run() == TRUE) {
				// Obtener los valores de los campos del formulario
				$email = $this->input->post('email');
				$names = $this->input->post('names');
				$surnames = $this->input->post('surnames');
				$password = $this->input->post('password');
				$id = $this->input->post('id');
				$id_type_user = $this->input->post('id_type_user');
				$id_state = $this->input->post('id_state');
				// Procesar los datos y guardarlos en la base de datos
				$data = array(
					'email' => $email,
					'names' => $names,
					'password' => $password,
					'surnames' => $surnames,
					'id' => $id,
					'id_type_user' => $id_type_user,
					'id_state' => $id_state,
				);

				// llamamos el modelo de usuarios
				$this->load->model('User');
				$this->User->insertUser($data);
				$this->session->set_flashdata('success', 'Usuario Registrado exitosamente');
				// Redirigir al usuario a la página de inicio de sesión
				redirect('/welcome');
			}
		}else {
			$this->load->view('/welcome');
		}
	}
}