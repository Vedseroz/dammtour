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

    public function IngresarHospedajeForm(){
		//form validation

		$this->form_validation->set_rules('nombre_hospedaje','<b>Nombre del Hospedaje</b>','trim|required');
		$this->form_validation->set_rules('direccion_hospedaje','<b>Direccion del Hospedaje</b>','trim|required');
		$this->form_validation->set_rules('ciudad','<b>Ciudad</b>','trim|required');
        $this->form_validation->set_rules('comuna','<b>Comuna</b>','trim|required');
		$this->form_validation->set_rules('pais','<b>Pais</b>','trim|required');
        $this->form_validation->set_rules('telefono_hospedaje','<b>Telefono del Hospedaje</b>','trim|required');
	

		$datos_hospedaje = array(
			'nombre_hospedaje' => $this->input->post('nombre_hospedaje'),
			'direccion_hospedaje' => $this->input->post('direccion_hospedaje'),
			'ciudad' => strtoupper($this->input->post('ciudad')),
			'comuna' => strtoupper($this->input->post('comuna')),
			'pais' => strtoupper($this->input->post('pais')),
            'telefono_hospedaje' => $this->input->post('telefono_hospedaje')
		);
				
		$this->Hospedaje_model->InsertarHospedaje($datos_hospedaje);
		

		redirect(site_url('hospedaje'));

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

    public function getDatosHospedaje(){
		$data = $this->Hospedaje_model->datatable();
		echo json_encode($data);
		return;
	}

	


}