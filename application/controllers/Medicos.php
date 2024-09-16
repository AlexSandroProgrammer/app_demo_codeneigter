<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Medicos extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); // Cargar la librería
        $this->load->model('Medicos_model'); // Cargar el modelo correctamente
    }
    //  método para mostrar página inicial
    public function index() {
        // validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['id'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
        // llamos todas las medicos registradas en la base de datos
        $medicos = $this->Medicos_model->obtenerMedicos();
        // validamos de que si no trae medicos entonces enviamos un mensaje de que no hay medicos registradas
        if (empty($medicos)) {
            $this->session->set_flashdata('message', 'No hay medicos registradas.');
            redirect(base_url('medicos'));
            return;
        }
        // cargamos la vista con la lista de medicos
        $data['medicos'] = $medicos;
        // cargamos la vista con la lista de medicos
        $this->load->view('admin/medicos', $data);
    }
    //  método para mostrar formulario registro de medicos
    public function view_registrar(){
        // validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['id'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
        // llamos todas las medicos registradas en la base de datos
        $sedes = $this->Sedes_model->obtenerSedes();
        // validamos de que si no trae sedes entonces enviamos un mensaje de que no hay sedes registradas
        if (empty($sedes)) {
            $this->session->set_flashdata('message', 'No hay sedes registradas.');
            $this->load->view('admin/registrar_sede');
            return;
        }
        // cargamos la vista con la lista de sedes
        $data['sedes'] = $sedes;
        // cargamos la vista con el formulario de registro
        $this->load->view('admin/registrar_sede');
    }
    // metodo para realizar registro de sede
    public function register(){
		// validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['id'])) {
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
                $register_sede = $this->Medicos_model->registrarSede($data);
                if ($register_sede) {
                    $this->session->set_flashdata('success', 'Sede registrada exitosamente.');
                    redirect(base_url('medicos'));
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