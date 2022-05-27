<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasajero extends CI_Controller {

	/**
	 * Class constructor.
	 */
	public function __construct(){
		parent::__construct();
		 if(!$this->ion_auth->logged_in()){
			 redirect('auth/login','refresh');
		 }

		$this->load->model('Pasajero_model');
		$this->load->model('Fecha_model');
	}

	
	public function index(){
        $this->data['actual'] = 'Pasajero'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Inicio';
        $this->data['vista'] = 'pasajero/pasajero'; //con esto se carga la vista
        
    $this->load->view('template',$this->data);
		
	}

	public function IngresarPasajero(){
		$this->data['actual'] = 'Ingresar Pasajero'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Pasajero';
        $this->data['vista'] = 'pasajero/ingresar_pasajero'; //con esto se carga la vista

		$this->load->view('template',$this->data);

	}

	public function getDatosPasajeros(){
		$data = $this->Pasajero_model->getDatosPasajeros();
		echo json_encode($data);
		return;
	}

	public function IngresarPasajeroForm(){
		//form validation

		$this->form_validation->set_rules('nombre','<b>Nombre</b>','trim|required');
		$this->form_validation->set_rules('apellido','<b>Apellido</b>','trim|required');
		$this->form_validation->set_rules('telefono','<b>Telefono</b>','trim|required');
		$this->form_validation->set_rules('email','<b>Correo</b>','trim|required');
		$this->form_validation->set_rules('acompa','<b>Acompañantes</b>','trim|required');

		//arreglo con los datos

		$servicios = array(
			'transfer' => $this->input->post('transfer'),
			'hospedaje' => $this->input->post('hospedaje'),
			'tour' => $this->input->post('tour')
		);

		//la idea ahora es juntar los valores de los servicios como un unico string y ponerlos dentro de los datos del pasajero
		$dato_servicio = implode(',',$servicios);
		
		$datos_fecha = array(
			'fechallegada' => $this->input->post('fechallegada'),
			'horallegada' => $this->input->post('horallegada'),
			'fechasalida' => $this->input->post('fechasalida'),
			'horasalida' => $this->input->post('horasalida')
		);
		//primero inserta la fecha
		$this->Fecha_model->InsertarFecha($datos_fecha);
		//y obtiene el id de la ultima fila que se agrego
		$fecha_id = $this->Fecha_model->getLastId();
		var_dump($fecha_id);		

		$datos_pasajero = array(
			'nombre' => $this->input->post('nombre'),
			'apellido' => $this->input->post('apellido'),
			'telefono' => $this->input->post('telefono'),
			'email' => $this->input->post('email'),
			'acompa' => $this->input->post('acompa'),
			'observacion' => $this->input->post('observacion'),
			'servicios' => $dato_servicio,
			'fecha_id' => $fecha_id
		);
				
		$this->Pasajero_model->InsertarPasajero($datos_pasajero);
		

		redirect(site_url('pasajero'));

	}

	
}