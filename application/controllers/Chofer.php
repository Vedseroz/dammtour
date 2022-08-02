<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Chofer extends CI_Controller{
    
    public function __construct(){ // constructor
        parent::__construct();
        if(!$this->ion_auth->logged_in()){
            redirect('auth/login','refresh');
        }

        //load models
        $this->load->model('Transfer_model');
        $this->load->model('Chofer_model');

    }

    public function index(){
        $this->data['actual'] = 'Chofer'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Inicio';
        $this->data['vista'] = 'chofer/vista_chofer'; //con esto se carga la vista
        
    $this->load->view('template',$this->data);
		
	}

    public function IngresarChofer(){
		$this->data['actual'] = 'Ingresar Chofer'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Transfer';
        $this->data['vista'] = 'chofer/ingresar_chofer'; //con esto se carga la vista

		$this->load->view('template',$this->data);

	}

    public function IngresarChoferForm(){
		//form validation

		$this->form_validation->set_rules('nombre_chofer','<b>Nombre</b>','trim|required');
		$this->form_validation->set_rules('apellido_chofer','<b>Apellido</b>','trim|required');
		$this->form_validation->set_rules('rut','<b>RUT</b>','trim|required');		

		$datos_chofer = array(
			'nombre_chofer' => $this->input->post('nombre_chofer'),
			'apellido_chofer' => $this->input->post('apellido_chofer'),
			'rut' => $this->input->post('rut'),
		);
				
		$this->Chofer_model->InsertarChofer($datos_chofer);

		redirect(site_url('chofer'));

	}

    public function getDatosChofer(){
		$data = $this->Chofer_model->datatable();
		echo json_encode($data);
		return;
	}

	


}