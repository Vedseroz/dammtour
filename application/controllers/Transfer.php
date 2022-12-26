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
		$this->load->model('Pasajero_model');
		$this->load->model('Voucher_model');

    }

    public function index(){
        $this->data['actual'] = 'Transfer'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Inicio';
        $this->data['vista'] = 'transfer/transfer'; //con esto se carga la vista
        
    $this->load->view('template',$this->data);
		
	}

	public function AgregarEvento(){
        $this->data['actual'] = 'Agregar Evento'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Transfer';
        $this->data['vista'] = 'transfer/transfer_form'; //con esto se carga la vista
        
    $this->load->view('template',$this->data);
		
	}

	public function EditarEvento($id_voucher){
        $this->data['actual'] = 'Editar Evento'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Transfer';
        $this->data['vista'] = 'transfer/editar_transfer'; //con esto se carga la vista
		$this->data['voucher'] = $this->Voucher_model->getVoucher($id_voucher);
        
    $this->load->view('template',$this->data);
		
	}

    public function AsignarTransfer($id_pasajero){
		$this->data['actual'] = 'Asignar Transfer'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Transfer';
        $this->data['vista'] = 'transfer/asignar_transfer'; //con esto se carga la vista
		$this->data['pasajero'] = $this->Pasajero_model->getPasajeroById($id_pasajero);
		$this->load->view('template',$this->data);

	}

    public function AgregarEventoForm($id_pasajero){
		//form validation
		$this->form_validation->set_rules("fecha","<b>Fecha</b>","required");
		$this->form_validation->set_rules('Origen','<b>Origen</b>','trim|required');
		$this->form_validation->set_rules('Hora de Inicio','<b>Hora de Inicio</b>','trim|required');
		$this->form_validation->set_rules('Destino','<b>destino</b>','trim|required');
		$this->form_validation->set_rules('Hora de Finalizacion','<b>Hora de Finalizacion</b>','trim|required');
	
			

		$datos_transfer = array(   //captura de todos los datos del formulario
			'fecha' => $this->input->post('fecha'),
			'origen' => $this->input->post('origen'),
			'hora_inicio' => $this->input->post('hora_inicio'),
			'destino' => $this->input->post('destino'),
			'hora_finalizacion' => $this->input->post('hora_finalizacion'),
			'detalles' => $this->input->post('detalles'),
			'pasajero_id' => $id_pasajero
		);
				
		$this->Voucher_model->InsertarVoucher($datos_transfer); //los ingresa a la tabla 
		

		redirect(site_url('transfer/AsignarTransfer/'.$id_pasajero)); //se devuelve a la pantalla del pasajero al cual se le hizo el voucher.

	}

	public function EditarEventoForm($id_voucher){
		//form validation
		$this->form_validation->set_rules("fecha","<b>Fecha</b>","required");
		$this->form_validation->set_rules('Origen','<b>Origen</b>','trim|required');
		$this->form_validation->set_rules('Hora de Inicio','<b>Hora de Inicio</b>','trim|required');
		$this->form_validation->set_rules('Destino','<b>destino</b>','trim|required');
		$this->form_validation->set_rules('Hora de Finalizacion','<b>Hora de Finalizacion</b>','trim|required');
	
		$aux = $this->Voucher_model->getVoucher($id_voucher); //sacamos el id del pasajero
		$id_pasajero = $aux[0]['pasajero_id'];
		

		$datos_transfer = array(   //captura de todos los datos del formulario
			'id_voucher' => $id_voucher,
			'fecha' => $this->input->post('fecha'),
			'origen' => $this->input->post('origen'),
			'hora_inicio' => $this->input->post('hora_inicio'),
			'destino' => $this->input->post('destino'),
			'hora_finalizacion' => $this->input->post('hora_finalizacion'),
			'detalles' => $this->input->post('detalles'),
			'pasajero_id' => $id_pasajero
		);
				
		$this->Voucher_model->EditarVoucher($datos_transfer); //los actualiza en la tabla 
		
		redirect(site_url('transfer/AsignarTransfer/'.$id_pasajero)); //se devuelve a la pantalla del pasajero al cual se le hizo el voucher.

	}

    public function getDatosTransfer(){
		$data = $this->Transfer_model->datatable();
		echo json_encode($data);
		return;
	}

	public function getDatosVoucherById($id_voucher){
		$data = $this->Voucher_model->getVoucherData($id_voucher);
		echo json_encode($data);
		return;
	}

	public function getDatosVoucher($id_pasajero){
		$aux = $this->Voucher_model->getVoucherById($id_pasajero); //obtenemos todos los datos del voucher asociado a ese pasajero
		$voucher['draw'] = 0;
		$voucher['recordsTotal'] = count($aux); 
		$voucher['recordsFiltered'] = count($aux);
		$voucher['data'] = $aux;
		echo json_encode($voucher);
		return;
	}

	public function getDatosVoucherCalendario(){  //con este metodo se podra obtener todos los datos para ponerlos en el calendario
		$data = $this->Voucher_model->getAllData();
		for($i = 0; $i<count($data);$i++){
			$new_data[$i] = array(
				'id' => $data[$i]['id_voucher'],
				'title'=>$data[$i]['nombre'].' '.$data[$i]['apellido'],
				'start'=>$data[$i]['fecha'].' '.$data[$i]['hora_inicio'],
				'end'=>$data[$i]['fecha'].' '.$data[$i]['hora_finalizacion'],
			);
		}
		echo json_encode($new_data);
		return;
	}
	


}