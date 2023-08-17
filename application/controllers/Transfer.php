<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Transfer extends CI_Controller{
    
    public function __construct(){ // constructor
        parent::__construct();
        if(!$this->ion_auth->logged_in()){
            redirect('auth/login','refresh');
        }

        //load models
		$this->load->model('Pasajero_model');
		$this->load->model('Voucher_model');
		$this->load->model('Transfer_model');

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

    public function agregarTransfer($pasajero_id){

		//primero insertamos los datos asociados al transfer en especifico, la cantidad de ninos, adultos y maletas, en conjunto de que despues se asociara los datos 
		//del chofer y del vehiculo.

		$datos_transfer = array(
			'cant_adultos' => $this->input->post('cant_adultos'),
			'cant_ninos' => $this->input->post('cant_ninos'),
			'cant_maletas' => $this->input->post('cant_maletas'),
			'vehiculo_id' => $this->input->post('vehiculo'),
			'chofer_id' => $this->input->post('chofer'),
			'opcion' => $this->input->post('opcionesTransfer')
		);

		$this->Transfer_model->InsertarTransfer($datos_transfer);
		$id_transfer = $this->Transfer_model->getLastId();
			
		$datos_evento = array(   //captura de todos los datos del formulario
			'fechallegada' => $this->input->post('fechallegada'),
			'horallegada' => $this->input->post('horallegada'),
			'fechasalida' => $this->input->post('fechasalida'),
			'horasalida' => $this->input->post('horasalida'),
			'pasajero_id' => $pasajero_id,
			'transfer_id' => $id_transfer
		);
		
		$estado_pasajero = array(
			'pasajero_id' => $pasajero_id,
			'estado' => 1
		);
		var_dump($datos_evento);

		$this->Pasajero_model->cambiarEstadoPasajero($estado_pasajero);
		$this->Pasajero_model->AgregarEventoTransfer($datos_evento);

		redirect(site_url('Pasajero/editarPasajero/'.$pasajero_id)); //se devuelve a la pantalla del pasajero al cual se le hizo el voucher.

	}

	public function EliminarEventoTransfer($id_pasajero_transfer){
		
		$pasajero_id = $this->Pasajero_model->getPasajeroIdByEventoId($id_pasajero_transfer);
		$transfer_id = $this->Pasajero_model->getTransferIdByEventoId($id_pasajero_transfer);

		$pasajero_id = $pasajero_id[0]['pasajero_id'];
		$transfer_id = $transfer_id[0]['id_transfer'];

		var_dump($pasajero_id);
		var_dump($transfer_id);

		$this->Pasajero_model->EliminarEventoTransfer($id_pasajero_transfer); //se elimina el evento.
		$this->Transfer_model->EliminarTransfer($transfer_id);

		redirect(site_url('pasajero/EditarPasajero/'.$pasajero_id));
		
	}

	/*public function EditarEventoForm($id_voucher){
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

	} */



    public function getDatosTransfer(){
		$data = $this->Transfer_model->datatable();
		echo json_encode($data);
		return;
	}


	// ================================================================ASIGNACION DE VEHICULOS AL TRANSFER =====================================================================

	public function asignarVehiculo($id_transfer){

	}


	// =========================================================================================================================================================================

	public function getDatosTransferById($id_pasajero_transfer){
		$aux = $this->Transfer_model->getDatosTransferById($id_pasajero_transfer);
		$transfer['draw'] = 0;
		$transfer['recordsTotal'] = count($aux);
		$transfer['recordsFiltered'] = count($aux);
		$transfer['data'] = $aux;
		echo json_encode($transfer);
		return;
	}


	public function getDatosTransferByIdPasajero($pasajero_id){
		$aux = $this->Transfer_model->getDatosTransferByIdPasajero($pasajero_id);
		$transfer['draw'] = 0;
		$transfer['recordsTotal'] = count($aux);
		$transfer['recordsFiltered'] = count($aux);
		$transfer['data'] = $aux;
		echo json_encode($transfer);
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

	
	//obtener el resumen de la data
	public function getResumenTransfer(){
		$transfers = $this->Transfer_model->getResumenTransfer();
		//var_dump($transfers);
		for ($i = 0;$i<count($transfers);$i++){  // con esto se le asignara el nombre del pasajero al transfer
			$aux = preg_split('/\r\n|\r|\n/', $transfers[$i]['post_content']);
			$transfers[$i]['nombre_pasajero'] = $aux[0];
			$transfers[$i]['post_content'] = NULL;
		}
		
		$data_tabla['draw'] = 0;
		$data_tabla['recordsTotal'] = count($transfers); 
		$data_tabla['recordsFiltered'] = count($transfers);
		$data_tabla['data'] = $transfers;
		echo json_encode($data_tabla);
		return;

		// UNA VEZ TERMINADA LA DATA, SE ENVIA A LA TABLA DE RESUMEN DE TRANSFERS.

	}

	public function getResumenTransferById($id_pasajero){
		$transfers = $this->Transfer_model->getResumenTransferById($id_pasajero);
		//var_dump($transfers[0]);
		$data_tabla['draw'] = 0;
		$data_tabla['recordsTotal'] = count($transfers); 
		$data_tabla['recordsFiltered'] = count($transfers);
		$data_tabla['data'] = $transfers;
		echo json_encode($data_tabla);
		return;

	}


}