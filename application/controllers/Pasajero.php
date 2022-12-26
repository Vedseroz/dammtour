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
		$this->load->model('Wordpress_model');
	}

	
	public function index(){
        $this->data['actual'] = 'Pasajero'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Inicio';
        $this->data['vista'] = 'pasajero/pasajero'; //con esto se carga la vista
		$this->data['wordpress'] = $this->Pasajeros_Wordpress();
        
    $this->load->view('template',$this->data);
		
	}

	public function IngresarPasajero(){
		$this->data['actual'] = 'Ingresar Pasajero'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Pasajero';
        $this->data['vista'] = 'pasajero/ingresar_pasajero'; //con esto se carga la vista

		$this->load->view('template',$this->data);

	}

	public function editarPasajero($id_pasajero){
		$this->data['actual'] = 'Editar Pasajero'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Pasajero';
        $this->data['vista'] = 'pasajero/editar_pasajero'; //con esto se carga la vista

		$this->load->model('Pasajero_model');//cargamos los modelos auxiliares
		//carga de la logica.
		$this->data['pasajero'] = $this->Pasajero_model->getPasajeroById($id_pasajero);
	

		$this->load->view('template',$this->data);

	}

	public function getDatosPasajeros(){
		$data = $this->Pasajero_model->getDatosPasajeros();
		foreach($data['data'] as $row){
			$new_data[] = array(
				'id' => $row['id_pasajero'],
				'title'=>$row['nombre'].' '.$row['apellido'],
				'start'=>$row['fechallegada'].' '.$row['horallegada'],
				'end'=>$row['fechasalida'].' '.$row['horasalida'],
			);
		}
		echo json_encode($new_data);
		return;
	}

	public function getDatosPasajerosTabla(){
		$data = $this->Pasajero_model->getDatosPasajeros();
		echo json_encode($data);
		return;
	}

	public function Pasajeros_Wordpress(){
		$pasajeros = $this->Wordpress_model->Wordpress_Output();
		
		for($i = 0; $i<count($pasajeros);$i++){
			$aux = $this->Pasajero_model->ComprobarPasajero($pasajeros[$i]['id_pasajero']); //comprobamos si existe dentro de la tabla.
			$flag = $aux[0]['COUNT(*)'];
			 
			if($flag == '0'){ //si no existe, lo inserta dentro de la tabla

				$datos_pasajero = array(
					'id_pasajero' => $pasajeros[$i]['id_pasajero'],
					'nombre' => $pasajeros[$i]['nombre'],
					'apellido' => $pasajeros[$i]['apellido'],
					'telefono' => $pasajeros[$i]['telefono'],
					'email' => $pasajeros[$i]['email'],
					'acompa' => $pasajeros[$i]['acompa'],
					'observacion' => $pasajeros[$i]['observacion'],
					'servicios' => $pasajeros[$i]['servicios']
				);

				$this->Pasajero_model->InsertarPasajero($datos_pasajero);

			}
		}
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
		
		/*$datos_fecha = array(
			'fechallegada' => $this->input->post('fechallegada'),
			'horallegada' => $this->input->post('horallegada'),
			'fechasalida' => $this->input->post('fechasalida'),
			'horasalida' => $this->input->post('horasalida')
		);
		//primero inserta la fecha
		$this->Fecha_model->InsertarFecha($datos_fecha);
		//y obtiene el id de la ultima fila que se agrego
		$fecha_id = $this->Fecha_model->getLastId();
		var_dump($fecha_id);	 */

		$datos_pasajero = array(
			'nombre' => $this->input->post('nombre'),
			'apellido' => $this->input->post('apellido'),
			'telefono' => $this->input->post('telefono'),
			'email' => $this->input->post('email'),
			'acompa' => $this->input->post('acompa'),
			'observacion' => $this->input->post('observacion'),
			'servicios' => $dato_servicio,
			//'fecha_id' => $fecha_id
		);
				
		$this->Pasajero_model->InsertarPasajero($datos_pasajero);
		

		redirect(site_url('pasajero'));

	}

	// EDICION DE PASAJEROS
	public function editarPasajeroForm($id_pasajero){
		//form validation

		$this->form_validation->set_rules('nombre','<b>Nombre</b>','trim|required');
		$this->form_validation->set_rules('apellido','<b>Apellido</b>','trim|required');
		$this->form_validation->set_rules('telefono','<b>Telefono</b>','trim|required');
		$this->form_validation->set_rules('email','<b>Correo</b>','trim|required');
		$this->form_validation->set_rules('acompa','<b>Acompañantes</b>','trim|required');

		//arreglo con los datos

		$servicios = array(
			'Transfer' => $this->input->post('transfer'),
			'Hospedaje' => $this->input->post('hospedaje'),
			'Tour' => $this->input->post('tour')
		);

		//la idea ahora es juntar los valores de los servicios como un unico string y ponerlos dentro de los datos del pasajero
		$dato_servicio = implode(' ',$servicios);

		
		/*$datos_fecha = array(
			'id_fecha' => $this->Pasajero_model->getIdFecha($id_pasajero),
			'fechallegada' => $this->input->post('fechallegada'),
			'horallegada' => $this->input->post('horallegada'),
			'fechasalida' => $this->input->post('fechasalida'),
			'horasalida' => $this->input->post('horasalida')
		);
		//primero edita la fecha
		$this->Fecha_model->EditarFecha($datos_fecha);	*/	

		$datos_pasajero = array(
			'nombre' => $this->input->post('nombre'),
			'apellido' => $this->input->post('apellido'),
			'telefono' => $this->input->post('telefono'),
			'email' => $this->input->post('email'),
			'acompa' => $this->input->post('acompa'),
			'observacion' => $this->input->post('observacion'),
			'servicios' => $dato_servicio,
			//'fecha_id' => $this->Pasajero_model->getIdFecha($id_pasajero)
		);
				
		$this->Pasajero_model->EditarPasajero($datos_pasajero);
		

		redirect(site_url('pasajero'));

	}

	public function eliminarPasajero($id_pasajero){
		$datos= array(
			'id_pasajero' => $id_pasajero
		);
		$this->Pasajero_model->EliminarPasajero($datos);
		$this->Wordpress_model->EliminarPasajeroWordpress($datos);

		redirect(site_url('pasajero'));
		
	}
	
}