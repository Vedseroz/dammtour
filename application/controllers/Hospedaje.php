<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Hospedaje extends CI_Controller{
    
    public function __construct(){ // constructor
        parent::__construct();
        if(!$this->ion_auth->logged_in()){
            redirect('auth/login','refresh');
        }

        //load models
        $this->load->model('Transfer_model');
		$this->load->model('Vehiculo_model');
        $this->load->model('Hospedaje_model');

    }

    public function index(){
        $this->data['actual'] = 'Hospedajes'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Inicio';
        $this->data['vista'] = 'hospedaje/hospedaje'; //con esto se carga la vista
        
    $this->load->view('template',$this->data);
		
	}

    public function IngresarHospedaje(){
		$this->data['actual'] = 'Ingresar Hospedaje'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Hospedaje';
        $this->data['vista'] = 'hospedaje/ingresar_hospedaje'; //con esto se carga la vista 
		$this->load->view('template',$this->data);
	}

	public function EditarVehiculo($id_hospedaje){
		$this->data['actual'] = 'Editar Hospedaje';
		$this->data['before'] = 'Hospedaje';
		$this->data['vista'] = 'hospedaje/editar_hospedaje';
		$this->data['vehiculo'] = $this->Hospedaje_model->getHospedajeById($id_hospedaje);  //obtener la informacion del vehiculo.
		$this->load->view('template',$this->data);
	}

    public function IngresarHospedajeForm($pasajero_id){
		//form validation

		//form validation
		$this->form_validation->set_rules("fechallegada2","<b>Fecha de Llegada</b>","required");
		$this->form_validation->set_rules('horallegada2','<b>Hora de Llegada</b>','trim|required');
		$this->form_validation->set_rules("fechasalida2","<b>Fecha de Salida</b>","required");
		$this->form_validation->set_rules('horasalida2','<b>Hora de Salida</b>','trim|required');
		$this->form_validation->set_rules('pais1','<b>Pais</b>','trim|required');
		$this->form_validation->set_rules('ciudad1','<b>Ciudad</b>','trim|required');
		$this->form_validation->set_rules('posada','<b>Posada</b>','trim|required');


		//primero insertamos los datos asociados al hospedaje en especifico, la cantidad de ninos, adultos y maletas, en conjunto de que despues se asociara los datos 
		//del chofer y del vehiculo.

		$posada = $this->input->post('posada');

		$id_hospedaje = $this->Hospedaje_model->getIdHospedaje($posada); // obtenemos el id para ponerlo en la tabla de pasajero hospedaje
		$hospedaje_id = $id_hospedaje[0]['id_hospedaje'];
	

		$datos_evento = array(   //captura de todos los datos del formulario
			'fechallegada' => $this->input->post('fechallegada2'),
			'horallegada' => $this->input->post('horallegada2'),
			'fechasalida' => $this->input->post('fechasalida2'),
			'horasalida' => $this->input->post('horasalida2'),
			'pasajero_id' => $pasajero_id,
			'hospedaje_id' => $hospedaje_id
		);

		$estado_pasajero = array(
			'pasajero_id' => $pasajero_id,
			'estado' => 1
		);
		
		$this->Pasajero_model->CambiarEstadoPasajero($estado_pasajero);
		$this->Hospedaje_model->AgregarEventoHospedaje($datos_evento);
		

		redirect(site_url('Pasajero/editarPasajero/'.$pasajero_id)); //se devuelve a la pantalla del pasajero al cual se le hizo el hospedaje.

	}

	
	public function EliminarEventoHospedaje($id_pasajero_hospedaje){
		
		$pasajero_id = $this->Hospedaje_model->getPasajeroIdByEventoId($id_pasajero_hospedaje);

		$this->Hospedaje_model->EliminarEventoHospedaje($id_pasajero_hospedaje); //se elimina el evento.

		redirect(site_url('pasajero/EditarPasajero/'.$pasajero_id[0]['pasajero_id']));
	}


    public function getDatosHospedaje(){
		$data = $this->Hospedaje_model->datatable();
		echo json_encode($data);
		return;
	}

	public function getDatosHospedajeById($pasajero_id){
		$aux = $this->Hospedaje_model->getDatosHospedajeById($pasajero_id);
		$hospedaje['draw'] = 0;
		$hospedaje['recordsTotal'] = count($aux);
		$hospedaje['recordsFiltered'] = count($aux);
		$hospedaje['data'] = $aux;
		echo json_encode($hospedaje);
	}

	public function getHospedajePorCiudad($ciudad){
		$data = $this->Hospedaje_model->getHospedajePorCiudad($ciudad);
		$data = json_encode($data);
        echo $data;
        return;
	}

	


}