<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Medicos extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); // Cargar la librería
        $this->load->model('Medicos_model'); // Cargar el modelo correctamente
        $this->load->model('Sedes_model'); // Cargar el modelo correctamente
        $this->load->model('Estados_model'); // Cargar el modelo correctamente
    }
    //  método para mostrar página inicial
    public function index() {
        // validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
        // llamos todas las medicos registradas en la base de datos
        $medicos = $this->Medicos_model->obtenerMedicos();
        // validamos de que si no trae medicos entonces enviamos un mensaje de que no hay medicos registradas
        // cargamos la vista con la lista de medicos
        $data['medicos'] = $medicos;    
        // cargamos la vista con la lista de medicos
        $this->load->view('admin/medicos', $data);
    }
    //  método para mostrar formulario registro de medicos
    public function view_registrar(){
        // validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
        // llamos todas las medicos registradas en la base de datos
        $sedes = $this->Sedes_model->obtenerSedes();
        $estados = $this->Estados_model->obtenerEstados();
        // validamos de que si no trae sedes entonces enviamos un mensaje de que no hay sedes registradas
        if (empty($sedes)) {
            $this->session->set_flashdata('error', 'No hay sedes registradas. por tal motivo no puedes registrar medicos.');
            $this->load->view('admin/medicos');
            return;
        }
        // validamos de que si no trae estados entonces enviamos un mensaje de que no hay estados registrados
        if (empty($estados)) {
            $this->session->set_flashdata('error', 'No hay estados registrados. por tal motivo no puedes registrar medicos.');
            $this->load->view('admin/medicos');
            return;
        }
        // cargamos la vista con la lista de estados
        $data['estados'] = $estados;
        // cargamos la vista con la lista de sedes
        $data['sedes'] = $sedes;
        // cargamos la vista con el formulario de registro
        $this->load->view('admin/registrar_medico', $data);
    }
    // metodo para realizar registro de sede
    public function register(){
		// validar sesión
        $session_data = $this->session->userdata('UserLoginSession');
        if (!isset($session_data['documento'])) {
            $this->session->sess_destroy();
            redirect(base_url('welcome'));
            return;
        }
		// validamos que el formulario sea enviado por el emtodo POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('id', 'Id', 'required');
            $this->form_validation->set_rules('names', 'Names', 'required');
            $this->form_validation->set_rules('surnames', 'Surnames', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('id_sede', 'Id Sede', 'required');
            $this->form_validation->set_rules('id_type_user', 'Id Type User', 'required');
            $this->form_validation->set_rules('id_state', 'Id State', 'required');
            if ($this->form_validation->run() == TRUE) {
                // Obtener los valores de los campos del formulario
                $id = $this->input->post('id');
                $names = $this->input->post('names');
                $surnames = $this->input->post('surnames');
                $email = $this->input->post('email');
                $id_sede = $this->input->post('id_sede');
                $id_type_user = $this->input->post('id_type_user');
                $id_state = $this->input->post('id_state');
                $data = array(
                    'id' => $id,
                    'names' => $names,
                   'surnames' => $surnames,
                    'email' => $email,
                    'id_sede' => $id_sede,
                    'id_type_user' => $id_type_user,
                    'id_state' => $id_state,
                );
                $register_medico = $this->Medicos_model->registrarMedico($data);
                if ($register_medico) {
                    $this->session->set_flashdata('success', 'Sede registrada exitosamente.');
                    redirect(base_url('medicos'));
                } else {
                    $this->session->set_flashdata('error', 'Ha ocurrido un error al registrar la sede.');
                    redirect(base_url('form_registrar_medico'));
                }
            } else {
                $this->session->set_flashdata('error', 'Por favor, completa todos los campos obligatorios.');
                redirect(base_url('form_registrar_medico'));
            }
        } else {
            $this->session->set_flashdata('error', 'Ha ocurrido un error al registrar la sede.');
            redirect(base_url('form_registrar_medico'));
        }
    }
}