<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class Localidad extends CI_Controller{
    
    public function __construct(){ // constructor
        parent::__construct();
        if(!$this->ion_auth->logged_in()){
            redirect('auth/login','refresh');
        }

        //load models
        $this->load->model('Transfer_model');
		$this->load->model('Vehiculo_model');
        $this->load->model('Localidad_model');

    }

    public function getCiudadPorPais($pais){
        $data = $this->Localidad_model->getCiudades($pais);
        $data = json_encode($data);
        echo $data;
        return;
    }


    /*public function index(){
        $this->data['actual'] = 'Transfer'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Inicio';
        $this->data['vista'] = 'vehiculo/vista_vehiculo'; //con esto se carga la vista
        
    $this->load->view('template',$this->data);
		
	}

    public function IngresarVehiculo(){
		$this->data['actual'] = 'Ingresar Vehiculo'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Vehiculo';
        $this->data['vista'] = 'vehiculo/ingresar_vehiculo'; //con esto se carga la vista

		$this->load->view('template',$this->data);

	}

	public function EditarVehiculo($id_vehiculo){
		$this->data['actual'] = 'Editar Vehiculo';
		$this->data['before'] = 'Vehiculo';
		$this->data['vista'] = 'vehiculo/editar_vehiculo';
		$this->data['vehiculo'] = $this->Vehiculo_model->getVehiculoById($id_vehiculo);  //obtener la informacion del vehiculo.
		$this->load->view('template',$this->data);
	}

    public function IngresarVehiculoForm(){
		//form validation

		$this->form_validation->set_rules('marca','<b>Marca</b>','trim|required');
		$this->form_validation->set_rules('modelo','<b>Modelo</b>','trim|required');
		$this->form_validation->set_rules('tipo','<b>Tipo de Vehiculo</b>','trim|required');
		$this->form_validation->set_rules('patente','<b>Patente</b>','trim|required');
	
			

		$datos_vehiculo = array(
			'marca' => $this->input->post('marca'),
			'modelo' => $this->input->post('modelo'),
			'tipo' => $this->input->post('tipo'),
			'patente' => $this->input->post('patente'),
			'cant_pasajeros' => $this->input->post('cant_pasajeros'),
		);
				
		$this->Vehiculo_model->InsertarVehiculo($datos_vehiculo);
		

		redirect(site_url('vehiculo'));

	}

	public function EditarVehiculoForm($id_vehiculo){

		$this->form_validation->set_rules('marca','<b>Marca</b>','trim|required');
		$this->form_validation->set_rules('modelo','<b>Modelo</b>','trim|required');
		$this->form_validation->set_rules('tipo','<b>Tipo de Vehiculo</b>','trim|required');
		$this->form_validation->set_rules('patente','<b>Patente</b>','trim|required');

		$datos_vehiculo = array(
			'id_vehiculo' => $id_vehiculo,
			'marca' => $this->input->post('marca'),
			'modelo' => $this->input->post('modelo'),
			'tipo' => $this->input->post('tipo'),
			'patente' => $this->input->post('patente'),
			'cant_pasajeros' => $this->input->post('cant_pasajeros'),
		);
				
		$this->Vehiculo_model->EditarVehiculo($datos_vehiculo);

		redirect(site_url('vehiculo'));

	}

	public function eliminarVehiculo($id_vehiculo){  //con esta funcion se llama a la base de datos para que elimine el dato que llega desde la columna de la tabla de la pagina. 
		$datos= array(
			'id_vehiculo' => $id_vehiculo
		);
		$this->Vehiculo_model->EliminarVehiculo($datos);

		redirect(site_url('vehiculo'));
		
	}

    public function getDatosVehiculo(){
		$data = $this->Vehiculo_model->datatable();
		echo json_encode($data);
		return;
	}

    */	


}