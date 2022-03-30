<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Derivacion extends CI_Controller {
	private $data = array();
	private $filebase;
	
    public function __construct() 
    {
		parent::__construct();
		// Session
	    $this->ion_auth->redirectLoginIn();
	    // Config
	    // Models
	    //Crear el archivo en carpeta model con nombre reemplazante_model
	    $this->load->model('casos_model', 'this_model');
	    // Libraries
	    // Helpers
	    $this->load->helper('date');
    	// View data
		$this->data['breadcrumb'] = array(
			array(
				'name' => 'Derivación',
				'link' =>  site_url('derivacion/index')
			)
		);
		$this->data['menu_items'] = array(
			'derivacion'
		);
		
		$this->load->helper('array');

		if($this->ion_auth->in_group(1)){
			$this->data['avatar'] = 'boss.png';
			$this->data['avatar_descrip'] = 'Imagen avatar admin';
			$this->data['avatar_nombre'] = 'Administrador';
		}

		if($this->ion_auth->in_group(3)){
			$this->data['avatar'] = 'profesor.jpg';
			$this->data['avatar_descrip'] = 'Imagen avatar Usuario 1';
			$this->data['avatar_nombre'] = 'Usuario 1';
		}
		$this->load->helper('directory');
		if($this->ion_auth->in_group(array(1,2,3,4,5,6,7,8))){
			$idCuenta = $this->session->userdata('user_id');
			$uploadPath = './files/avatar/cuentas/' .$idCuenta. '/';
			$map = directory_map($uploadPath,1);
			if(!empty($map)) $this->data['avatarP'] = 'files/avatar/cuentas/' .$idCuenta. '/'. $map[0];
		}
    }

	public function index(){
		if($this->ion_auth->in_group(3)) $this->view_handler->view('Usuario1/drvz', 'iniciar', $this->data);
			else redirect(site_url('Inicio'), 'location');	
	}

	public function getcasos() {
		if($this->ion_auth->in_group(1)){
			$columns = array(
				array( 'db' => 'id', 'dt' => 'id' ),
				array( 'db' => 'rut', 'dt' => 'rut' ),
				array( 'db' => 'nombres', 'dt' => 'nombres' ),
				array( 'db' => 'apellido_p', 'dt' => 'apellido_p' ),
				array( 'db' => 'apellido_m', 'dt' => 'apellido_m' ),
				array( 'db' => 'nacimiento', 'dt' => 'nacimiento' )
			);

			$data = $this->this_model->simple_data_table($columns);
			echo json_encode($data);
		}else{
			$data = array(
			    "draw" => null,
			    "recordsTotal" => 0,
			    "recordsFiltered" => 0,
			    "data" => [] 
			);
			echo json_encode($data);
		}
    }

    public function getcasosjefe() {
		if(empty($this->ion_auth->in_group(3)){
			$data = array(
		        "draw" => null,
		        "recordsTotal" => 0,
		        "recordsFiltered" => 0,
		        "data" => [] 
		    );
			echo json_encode($data);
		}
    }	
}