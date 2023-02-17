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
		$this->load->model('Localidad_model');
		$this->load->model('Transfer_model');
		$this->load->model('Hospedaje_model');
		$this->load->model('Tour_model');
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

	public function editarPasajero($id_pasajero){
		$this->data['actual'] = 'Editar Pasajero'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Pasajero';
        $this->data['vista'] = 'pasajero/editar_pasajero'; //con esto se carga la vista

		$this->load->model('Pasajero_model');//cargamos los modelos auxiliares
		//carga de la logica.
		$this->data['pasajero'] = $this->Wordpress_model->GetPostById($id_pasajero);
		$this->data['paises'] = $this->Localidad_model->getPaises();
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
		$data = $this->Wordpress_model->GetAllPosts();
		//reformateamos la data entrante.
		$pasajeros['draw'] = 0;
		$pasajeros['recordsTotal'] = count($data); 
		$pasajeros['recordsFiltered'] = count($data);
		$pasajeros['data'] = $data;
		echo json_encode($pasajeros);
		return;
	}

	/*public function Pasajeros_Wordpress(){
		$pasajeros = $this->Wordpress_model->GetAllPosts();
		var_dump($pasajeros);
		/*for($i = 0; $i<count($pasajeros);$i++){
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
	}*/
	

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


	public function getDatosPasajeroCalendario(){  //con este metodo se podra obtener todos los datos para ponerlos en el calendario
		$data_tours = $this->Tour_model->getAllTours();
		$data_hospedajes = $this->Hospedaje_model->getAllHospedajes();
		$data_transfers = $this->Transfer_model->getAllTransfers();
		
		//var_dump($data_tours);
		//var_dump($data_hospedajes);

		$data_calendario = array();

		//moldeamos la data de los TRANSFERS
		for($i = 0; $i<count($data_transfers);$i++){

			$nombre = $this->Pasajero_model->getNombreById($data_transfers[$i]['pasajero_id']);
			$transfer = array(
				'id' => $data_transfers[$i]['pasajero_id'],
				'title'=>'PASAJERO: '.$nombre.' '.'EVENTO: Transfer',
				'start'=>$data_transfers[$i]['fechallegada'].' '.$data_transfers[$i]['horallegada'],
				'end'=>$data_transfers[$i]['fechasalida'].' '.$data_transfers[$i]['horasalida'],
			);

			array_push($data_calendario,$transfer);

		}

		//ahora toca modelar la data de los HOSPEDAJES
		for($i = 0; $i<count($data_hospedajes);$i++){

			$nombre = $this->Pasajero_model->getNombreById($data_hospedajes[$i]['pasajero_id']);
			$hospedajes = array(
				'id' => $data_transfers[$i]['pasajero_id'],
				'title'=>'PASAJERO: '.$nombre.' '.'EVENTO: Hospedaje en '.$data_hospedajes[$i]['nombre_hospedaje'],
				'start'=>$data_hospedajes[$i]['fechallegada'].' '.$data_hospedajes[$i]['horallegada'],
				'end'=>$data_hospedajes[$i]['fechasalida'].' '.$data_hospedajes[$i]['horasalida'],
			);

			array_push($data_calendario,$hospedajes);

		}


		//Y por ultimo el ultimo modelado de datos de los TOURS
		for($i = 0; $i<count($data_tours);$i++){

			$nombre = $this->Pasajero_model->getNombreById($data_tours[$i]['pasajero_id']);
			$tours = array(
				'id' => $data_transfers[$i]['pasajero_id'],
				'title'=>'PASAJERO: '.$nombre.' '.'EVENTO: Tour en '.$data_tours[$i]['nombre_tour'],
				'start'=>$data_tours[$i]['fechallegada'].' '.$data_tours[$i]['horallegada'],
				'end'=>$data_tours[$i]['fechasalida'].' '.$data_tours[$i]['horasalida'],
			);

			array_push($data_calendario,$tours);

		}


		//var_dump($data_calendario);

		//finalmente transformamos a JSON
		echo json_encode($data_calendario);
		return;

		/*for($i = 0; $i<count($data);$i++){
			$new_data[$i] = array(
				'id' => $data[$i]['id_voucher'],
				'title'=>$data[$i]['nombre'].' '.$data[$i]['apellido'],
				'start'=>$data[$i]['fecha'].' '.$data[$i]['hora_inicio'],
				'end'=>$data[$i]['fecha'].' '.$data[$i]['hora_finalizacion'],
			);
		}
		echo json_encode($new_data);
		return;*/
	}
	


}