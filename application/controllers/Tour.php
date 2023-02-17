<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Tour extends CI_Controller{
    
    public function __construct(){ // constructor
        parent::__construct();
        if(!$this->ion_auth->logged_in()){
            redirect('auth/login','refresh');
        }

        //load models
        $this->load->model('Transfer_model');
		$this->load->model('Vehiculo_model');
        $this->load->model('Tour_model');

    }

    public function index(){
        $this->data['actual'] = 'Tours'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Inicio';
        $this->data['vista'] = 'Tour/tours'; //con esto se carga la vista
        
    $this->load->view('template',$this->data);
		
	}

    public function IngresarTour(){
		$this->data['actual'] = 'Ingresar Tour'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Tours';
        $this->data['vista'] = 'Tour/ingresar_tour'; //con esto se carga la vista 
		$this->load->view('template',$this->data);
	}

	public function EditarTour($id_tour){
		$this->data['actual'] = 'Editar Tour';
		$this->data['before'] = 'Tour';
		$this->data['vista'] = 'hospedaje/editar_hospedaje';
		$this->data['vehiculo'] = $this->Hospedaje_model->getHospedajeById($id_hospedaje);  //obtener la informacion del vehiculo.
		$this->load->view('template',$this->data);
	}

    public function IngresarTourForm($pasajero_id){
		//form validation

		//form validation
		$this->form_validation->set_rules("fechallegada3","<b>Fecha de Llegada</b>","required");
		$this->form_validation->set_rules('horallegada3','<b>Hora de Llegada</b>','trim|required');
		$this->form_validation->set_rules("fechasalida3","<b>Fecha de Salida</b>","required");
		$this->form_validation->set_rules('horasalida3','<b>Hora de Salida</b>','trim|required');
		$this->form_validation->set_rules('pais2','<b>Pais</b>','trim|required');
		$this->form_validation->set_rules('ciudad2','<b>Ciudad</b>','trim|required');
		$this->form_validation->set_rules('tour','<b>Posada</b>','trim|required');


		//primero insertamos los datos asociados al hospedaje en especifico, la cantidad de ninos, adultos y maletas, en conjunto de que despues se asociara los datos 
		//del chofer y del vehiculo.

		$tour = $this->input->post('tour');

		$id_tour = $this->Tour_model->getIdTour($tour); // obtenemos el id para ponerlo en la tabla de pasajero hospedaje
		$tour_id = $id_tour[0]['id_tour'];


		$datos_evento = array(   //captura de todos los datos del formulario
			'fechallegada' => $this->input->post('fechallegada3'),
			'horallegada' => $this->input->post('horallegada3'),
			'fechasalida' => $this->input->post('fechasalida3'),
			'horasalida' => $this->input->post('horasalida3'),
			'pasajero_id' => $pasajero_id,
			'tour_id' => $tour_id
		);

        var_dump($datos_evento);

		$this->Tour_model->AgregarEventoTour($datos_evento);

		redirect(site_url('Pasajero/editarPasajero/'.$pasajero_id)); //se devuelve a la pantalla del pasajero al cual se le hizo el hospedaje.

	}

	public function getDatosTourById($pasajero_id){
		$aux = $this->Tour_model->getDatosTourById($pasajero_id);
		$tour['draw'] = 0;                                                                                                  
		$tour['recordsTotal'] = count($aux);
		$tour['recordsFiltered'] = count($aux);
		$tour['data'] = $aux;
		echo json_encode($tour);
	}

	public function getTourPorCiudad($ciudad){
		$data = $this->Tour_model->getTourPorCiudad($ciudad);
		$data = json_encode($data);
        echo $data;
        return;
	}

	


}