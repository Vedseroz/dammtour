<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Transfer extends CI_Controller{
    
    public function __construct(){ // constructor
        parent::__construct();
        if(!$this->ion_auth->logged_in()){
            redirect('auth/login','refresh');
        }

        //load models
        $this->load->model('Transfer_model');

    }

    public function index(){
        $this->data['actual'] = 'Transfer'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Inicio';
        $this->data['vista'] = 'transfer/transfer'; //con esto se carga la vista
        
    $this->load->view('template',$this->data);
		
	}

    public function AsignarTransfer(){
		$this->data['actual'] = 'Asignar Transfer'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Transfer';
        $this->data['vista'] = 'transfer/asignar_transfer'; //con esto se carga la vista

		$this->load->view('template',$this->data);

	}

    public function AsignarTransferForm(){
		$this->load->library('form_validation');
		//form validation
		$this->form_validation->set_rules("nombre_chofer","<b>Nombre</b>","required");
		$this->form_validation->set_rules('apellido_chofer','<b>Apellido</b>','trim|required');
		$this->form_validation->set_rules('tipo','<b>Tipo de Vehiculo</b>','trim|required');
		$this->form_validation->set_rules('modelo','<b>Modelo</b>','trim|required');
	
			

		$datos_transfer = array(
			'nombre_chofer' => $this->input->post('nombre_chofer'),
			'apellido_chofer' => $this->input->post('apellido_chofer'),
			'tipo' => $this->input->post('tipo'),
			'modelo' => $this->input->post('modelo'),
			'cant_maletas' => $this->input->post('cant_maletas'),
			'cant_pasajeros' => $this->input->post('cant_pasajeros')
		);
				
		$this->Transfer_model->InsertarTransfer($datos_transfer);
		

		redirect(site_url('transfer'));

	}

    public function getDatosTransfer(){
		$data = $this->Transfer_model->datatable();
		echo json_encode($data);
		return;
	}

	


}