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
		$this->load->model('Localidad_model');


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

    public function IngresarHospedajeForm(){
		//form validation
		//con esto se pondran nuevos registros de hospedajes en cada una de las ciudades en la base de datos como el cliente estime conveniente.
		//para agregar una nueva ciudad al sistema de hospedajes, se debera contactar directamente con el equipo desarrollador.
		var_dump($this->input->post('ciudad'));
		$aux = $this->Localidad_model->getIdByCiudad($this->input->post('ciudad1'));
		$id_localidad = $aux[0]['id_localidad'];
		var_dump($id_localidad);

		$datos_hospedaje = array(
			'localidad_id' => $id_localidad,
			'nombre_hospedaje' => strtoupper($this->input->post('nombre_hospedaje'))
		);

		//ingresar a la base de datos.
		$this->Hospedaje_model->AgregarHospedaje($datos_hospedaje);
		redirect(site_url('Hospedaje/IngresarHospedaje')); //se devuelve a la pantalla del pasajero al cual se le hizo el hospedaje.

	}

	public function IngresarEventoHospedaje($pasajero_id){
		//con esto obtenemos el id de la localidad referida a la instancia.
		$aux = $this->Hospedaje_model->getIdHospedaje($this->input->post('posada'));
		$id_hospedaje = $aux[0]['id_hospedaje'];
		
		//adquirimos todos los datos del formulario de pasajeros/hospedaje
		$datos_evento = array(
			'hospedaje_id' => $id_hospedaje,
			'pasajero_id' =>$pasajero_id,
			'fechallegada' => $this->input->post('fechallegada2'),
			'horallegada' =>$this->input->post('horallegada2'),
			'fechasalida' =>$this->input->post('fechasalida2'),
			'horasalida' =>$this->input->post('horasalida2'),
			'recepcionista' => strtoupper($this->input->post('recepcionista'))
		);

		$this->Hospedaje_model->AgregarEventoHospedaje($datos_evento);
		redirect(site_url('Pasajero/editarPasajero/').$pasajero_id);

	}

	public function EliminarHospedaje($hospedaje_id){ //eliminar el hospedaje de la lista de hospedajes disponibles.
		$this->Hospedaje_model->EliminarHospedaje($hospedaje_id);
		redirect(site_url('Hospedaje/IngresarHospedaje'));
	}

	
	public function EliminarEventoHospedaje($id_pasajero_hospedaje){
		
		$pasajero_id = $this->Hospedaje_model->getPasajeroIdByEventoId($id_pasajero_hospedaje);

		$this->Hospedaje_model->EliminarEventoHospedaje($id_pasajero_hospedaje); //se elimina el evento.

		redirect(site_url('pasajero/EditarPasajero/'.$pasajero_id[0]['pasajero_id']));
	}

	public function getResumenHospedaje(){
		$data = $this->Hospedaje_model->getResumenHospedaje();
		//var_dump($transfers);
		for ($i = 0;$i<count($data);$i++){  // con esto se le asignara el nombre del pasajero al transfer
			$aux = preg_split('/\r\n|\r|\n/', $data[$i]['post_content']);
			$data[$i]['nombre_pasajero'] = $aux[0];
			$data[$i]['post_content'] = NULL;
		}
		$hospedaje['draw'] = 0;
		$hospedaje['recordsTotal'] = count($data);
		$hospedaje['recordsFiltered'] = count($data);
		$hospedaje['data'] = $data;
		echo json_encode($hospedaje);
		return;
	}

    public function getDatosHospedaje(){
		$data = $this->Hospedaje_model->getAllHospedajes();
		$hospedaje['draw'] = 0;
		$hospedaje['recordsTotal'] = count($data);
		$hospedaje['recordsFiltered'] = count($data);
		$hospedaje['data'] = $data;
		echo json_encode($hospedaje);
		return;
	}

	public function getDatosHospedajeById($pasajero_id){
		$aux = $this->Hospedaje_model->getDatosHospedajeById($pasajero_id);
		$hospedaje['draw'] = 0;
		$hospedaje['recordsTotal'] = count($aux);
		$hospedaje['recordsFiltered'] = count($aux);
		$hospedaje['data'] = $aux;
		echo json_encode($hospedaje);
		return;
	}

	public function getDatosHospedajeByIdPasajero($pasajero_id){ //cambiar nombre variable
		$aux = $this->Hospedaje_model->getDatosHospedajeByIdPasajero($pasajero_id);
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