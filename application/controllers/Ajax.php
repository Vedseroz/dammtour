<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
    public function __construct() 
    {
		parent::__construct();
		// Session
		$this->loginIn = $this->ion_auth->loginIn();
	    // Config
	    $this->config->load('enums', true);
	    $this->load->model('Proced_caso_model');
		$this->load->model('Deriva_caso_model');
    }
    
	public function getcasosDrvz() {

    	/*
    	if($this->ion_auth->in_group(1)){
			$data = $this->Deriva_caso_model->data_admin();
			echo json_encode($data);
			return;
		}
		*/
    	if($this->ion_auth->in_group(3)){
    		$data = $this->Deriva_caso_model->data_colegio();
			echo json_encode($data);
			return;
    	}

    	if($this->ion_auth->in_group(6)){
    		$data = $this->Deriva_caso_model->data_colegioCC();
			echo json_encode($data);
			return;
    	}

    	if($this->ion_auth->in_group(8)){
    		$data = $this->Deriva_caso_model->data_colegioDupla();
			echo json_encode($data);
			return;
    	}

    	$data = array(
                    "draw" => null,
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => []
            );
		echo json_encode($data);
		return;
    }
}