<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	/**
	 * Class constructor.
	 */
	public function __construct(){
		parent::__construct();
		 if(!$this->ion_auth->logged_in()){
			 redirect('auth/login','refresh');
		 }

		//cargar los models. 
		$this->load->model('Hospedaje_model');
		$this->load->model('Pasajero_model');
		 
	}

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index(){	
		$this->load->helper('form');

		$this->data['vista'] = 'inicio';
		$this->load->view('template',$this->data);
	}

	
}
