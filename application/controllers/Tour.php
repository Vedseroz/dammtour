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
		$this->load->model('Pasajero_model');
		$this->load->model('Localidad_model');

    }

    public function index(){
        $this->data['actual'] = 'Tours'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Inicio';
        $this->data['vista'] = 'Tour/tour'; //con esto se carga la vista
        
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

		/* 	PLACEHOLDER CODIGO INSERVIBLE QUE PODRIA SERVIR ASI QUE NO BORRAR :).
		$datos_localidad = array(   //captura de todos los datos del formulario
			'ciudad' => strtoupper($this->input->post('ciudad')), //se deja todo en mayusculas
			'pais' => strtoupper($this->input->post('pais')),
		);

		$flag = $this->Localidad_model->ComprobarCiudadPais($datos_localidad['ciudad'],$datos_localidad['pais']);
		$flag = $flag[0]['COUNT(ciudad)'];

		if($flag == '1'){
			$localidad_id = $this->Localidad_model->getIdByCiudad($datos_localidad['ciudad']);
			echo ' entro a 1 ';
			var_dump($localidad_id);
		}

		if($flag == '0'){ //comprobamos si la instancia existe en la base de datos
			$this->Localidad_model->InsertarLocalidad($datos_localidad); //inserta la nueva localidad
			$localidad_id = $this->Localidad_model->getLastLocalidad(); // llama para obtener el ultimo id seleccionado
			echo ' entro a 0 ';
		}

		var_dump($localidad_id);*/
		
		$localidad_id = $this->Localidad_model->getIdByCiudad($this->input->post('ciudad2'));

		$datos_tour = array(
			'detalles_tour' => $this->input->post('tour'),
			'localidad_id' => $localidad_id[0]['id_localidad'],
			'pasajero_id' => $pasajero_id
		);

		var_dump($datos_tour);

		$this->Tour_model->InsertarTour($datos_tour); //inserta el nombre del tour y el id de la localidad.

		
		//$this->Pasajero_model->CambiarEstadoPasajero($estado_pasajero);
		//$this->Tour_model->AgregarEventoTour($datos_evento);

		redirect(site_url('pasajero/editarPasajero/'.$pasajero_id)); //se devuelve a la pantalla del pasajero al cual se le hizo el hospedaje.

	}

	
	public function EliminarEventoTour($id_tour){
		
		$pasajero_id = $this->Tour_model->getPasajeroIdByEventoId($id_tour);

		$this->Tour_model->EliminarTour($id_tour); //se elimina el evento.

		redirect(site_url('pasajero/EditarPasajero/'.$pasajero_id[0]['pasajero_id']));
	}

	public function EliminarEventoTour2($id_pasajero_tour){
		
		$pasajero_id = $this->Tour_model->getPasajeroIdByEventoId($id_pasajero_tour);

		$this->Tour_model->EliminarEventoTour($id_tour); //se elimina el evento.

		redirect(site_url('tour'));
	}

	public function EliminarTour($tour_id){ //se elimina el tour
		$this->Tour_model->EliminarTour($tour_id);
		redirect(site_url('Tour/IngresarTour'));

	}

	public function getResumenTours(){ //ESTA MUESTRA TODOS LOS TOURS QUE HAY EN LA PLATAFORMA.
		$data = $this->Tour_model->getResumenTours();
		//var_dump($transfers);
		for ($i = 0;$i<count($data);$i++){  // con esto se le asignara el nombre del pasajero al transfer
			$aux = preg_split('/\r\n|\r|\n/', $data[$i]['post_content']);
			$data[$i]['nombre_pasajero'] = $aux[0];
			$data[$i]['post_content'] = NULL;
		}
		$tours['draw'] = 0;
		$tours['recordsTotal'] = count($data);
		$tours['recordsFiltered'] = count($data);
		$tours['data'] = $data;
		echo json_encode($tours);
		return;
	}

	public function getDatosTour(){// esta funcion retorna todos los datos de la tabla de tours en conjunto de su nombre.
		$datos_tour = $this->Tour_model->getDatosTour();
		for($i=0;$i<count($datos_tour);$i++){
		$datos_tour[$i]['nombre'] = $this->Pasajero_model->getNombreById($datos_tour[$i]['pasajero_id']);
		}
		$tour['draw'] = 0;                                                                                                  
		$tour['recordsTotal'] = count($datos_tour);
		$tour['recordsFiltered'] = count($datos_tour);
		$tour['data'] = $datos_tour;
		echo json_encode($tour);
		return;
	}

	public function getTours(){// esta funcion retorna todos los datos de la tabla de tours en conjunto de su nombre.
		$datos_tour = $this->Tour_model->getTours();
		$tour['draw'] = 0;                                                                                                  
		$tour['recordsTotal'] = count($datos_tour);
		$tour['recordsFiltered'] = count($datos_tour);
		$tour['data'] = $datos_tour;
		echo json_encode($tour);
		return;
	}


	public function getDatosTourById($pasajero_id){
		$aux = $this->Tour_model->getDatosTourById($pasajero_id);
		$tour['draw'] = 0;                                                                                                  
		$tour['recordsTotal'] = count($aux);
		$tour['recordsFiltered'] = count($aux);
		$tour['data'] = $aux;
		echo json_encode($tour);
	}

	public function getDatosTourByIdPasajero($pasajero_id){
		$aux = $this->Tour_model->getDatosTourByIdPasajero($pasajero_id);
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