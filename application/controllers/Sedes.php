<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sedes extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); // Cargar la librería
        $this->load->model('Sedes_model'); // Cargar el modelo correctamente
    }
    //  método para mostrar página inicial
    public function index()
    {
        // validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
        // llamamos todas las sedes registradas en la base de datos
        $sedes = $this->Sedes_model->obtenerSedes();
        // cargamos la vista con la lista de sedes
        $data['sedes'] = $sedes;
        // cargamos la vista con la lista de sedes
        $this->load->view('admin/sedes', $data);
    }
    //  método para mostrar formulario registro de sedes
    public function view_registrar()
    {
        // validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
        $this->load->view('admin/registrar_sede');
    }
    // metodo para realizar registro de sede
    public function register()
    {
		// validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
		// validamos que el formulario sea enviado por el emtodo POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('nombre_sede', 'Nombre de Sede', 'required');
            $this->form_validation->set_rules('direccion', 'Direccion', 'required');
            $this->form_validation->set_rules('telefono', 'Telefono', 'required');
            if ($this->form_validation->run() == TRUE) {
                $nombre_sede = $this->input->post('nombre_sede');
                $direccion = $this->input->post('direccion');
                $telefono = $this->input->post('telefono');
                $data = array(
                    'nombre_sede' => $nombre_sede,
                    'direccion' => $direccion,
                    'telefono' => $telefono,
                );
                $register_sede = $this->Sedes_model->registrarSede($data);
                if ($register_sede) {
                    $this->session->set_flashdata('success', 'Sede registrada exitosamente.');
                    redirect(base_url('sedes'));
                } else {
                    $this->session->set_flashdata('error', 'Ha ocurrido un error al registrar la sede.');
                    redirect(base_url('form_registrar_sede'));
                }
            } else {
                $this->session->set_flashdata('error', 'Por favor, completa todos los campos obligatorios.');
                redirect(base_url('form_registrar_sede'));
            }
        } else {
            $this->session->set_flashdata('error', 'Ha ocurrido un error al registrar la sede.');
            redirect(base_url('form_registrar_sede'));
        }
    }
}