<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Casos extends CI_Controller {
	private $data = array();
	
    public function __construct(){
		parent::__construct();
	    $this->ion_auth->redirectLoginIn();
	    
		/*
			Breadcrumb:
			La estructura de cada elemento del array es un array que contiene los siguientes elementos: 
			array(
			
				'name' => 'Nombre',
				'link' => 'http://www.pagina.com/nombre'
			)
			
			Ejemplo:
			$data['breadcrumb'] = array(
				array(
					'name' => 'Evaluación',
					'link' => site_url(reemplazo)
				),
				array(
					'name' => 'Agregar'
					'link' => ''
				)
			)
		*/
		$this->data['breadcrumb'] = array(
			array(
				'name' => 'Reportes',
				'link' =>  site_url('casos')
			)
		);
		/*
			Contiene los menú seleccionados
			Ejemplo:
			$data['menu_items'] = array(
				'item_1',
				'item_1_2',
				'item_1_2_2',
				'item_1_2_2_1'
			);
		*/
		$this->load->model('casos_model');		
        $this->load->model('En_colegio_model');
        $this->load->model('En_curso_model');
        $this->load->model('Colegios_model');
        $this->load->model('Cursos_model');
		$this->load->model('Deriva_caso_model');
		$this->load->model('Rep_to_procedimientos_model');
        
		$this->load->helper(array('date','download', 'file', 'html'));

		$this->data['menu_items'] = array(
			'Reportes'
		);

		if($this->ion_auth->in_group(3)){
			$this->data['avatar'] = 'profesor.jpg';
			$this->data['avatar_descrip'] = 'Imagen avatar Usuario 1';
			$this->data['avatar_nombre'] = 'Usuario 1';
		}

		if($this->ion_auth->in_group(4)){
			$this->data['avatar'] = 'orientador.png';
			$this->data['avatar_descrip'] = 'Imagen avatar Orientador';
			$this->data['avatar_nombre'] = 'Orientador';
		}

		if($this->ion_auth->in_group(5)){
			$this->data['avatar'] = 'avatar4.png';
			$this->data['avatar_descrip'] = 'Imagen avatar PIE';
			$this->data['avatar_nombre'] = 'Educador PIE';
		}

		if($this->ion_auth->in_group(6)){
			$this->data['avatar'] = 'avatar3.png';
			$this->data['avatar_descrip'] = 'Imagen avatar cómite convivencia';
			$this->data['avatar_nombre'] = 'Cómite Convivencia';
		}

		if($this->ion_auth->in_group(8)){
			$this->data['avatar'] = 'avatar3.png';
			$this->data['avatar_descrip'] = 'Imagen avatar dupla';
			$this->data['avatar_nombre'] = 'Dupla Psicosocial';
		}

		if($this->ion_auth->in_group(7)){
			$this->data['avatar'] = 'apoderado.png';
			$this->data['avatar_descrip'] = 'Imagen avatar apoderado';
			$this->data['avatar_nombre'] = 'Apoderado';
		}

		if($this->ion_auth->in_group(9)){
			$this->data['avatar'] = 'alum.jpg';
			$this->data['avatar_descrip'] = 'Imagen avatar caso';
			$this->data['avatar_nombre'] = 'caso';
		}

		if($this->ion_auth->in_group(array(9))){
			$this->load->model('casos_model');
			$idcaso = $this->casos_model->get('*', array('rut' => $this->session->userdata('rut')))[0]->id;
			$uploadPath = './files/avatar/casos/' .$idcaso. '/';
			$map = directory_map($uploadPath,1);
			if(!empty($map)) $this->data['avatarP'] = 'files/avatar/casos/' .$idcaso. '/'. $map[0];
		}
		if($this->ion_auth->in_group(array(1,2,3,4,5,6,7,8))){
			$idCuenta = $this->session->userdata('user_id');
			$uploadPath = './files/avatar/cuentas/' .$idCuenta. '/';
			$map = directory_map($uploadPath,1);
			if(!empty($map)) $this->data['avatarP'] = 'files/avatar/cuentas/' .$idCuenta. '/'. $map[0];
		}
    }

	public function index()	{
		if($this->ion_auth->in_group(3)) {
			$this->data['colegio_nombre'] = 'CMV';
			$this->view_handler->view('Usuario1', 'Reportesalumnos', $this->data);
		}
		if($this->ion_auth->in_group(4)){
			$this->data['colegio_nombre'] = 'CMV';
			$this->view_handler->view('orientador', 'Reportesalumnos', $this->data);
		}
		if($this->ion_auth->in_group(5)){
			$this->data['colegio_nombre'] = 'CMV';
			$this->view_handler->view('PIE', 'Reportesalumnos', $this->data);
		}
		if($this->ion_auth->in_group(6)){
			$this->data['colegio_nombre'] = 'CMV';
			$this->view_handler->view('comite', 'Reportesalumnos', $this->data);
		}

		if($this->ion_auth->in_group(7)){
			$this->data['colegio_nombre'] = 'CMV';
			$this->view_handler->view('apoderado', 'Reportes', $this->data);
		}

		if($this->ion_auth->in_group(8)){
			$this->data['colegio_nombre'] = 'CMV';
			$this->view_handler->view('dupla', 'Reportesalumnos', $this->data);
		}
		if($this->ion_auth->in_group(9)){
			$this->data['colegio_nombre'] = 'CMV';
			$this->view_handler->view('caso', 'Reportes', $this->data);
		}		
	}

	public function Buscar() {
		$data = array(
                    "draw" => null,
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => [] 
                );
		echo json_encode($data);
		return;
    }

    public function procedimientos(){
        if($this->ion_auth->in_group(9)){
        	$id_caso = $this->casos_model->casoporid($this->session->userdata('user_id'));
        }
        if($this->ion_auth->in_group(7)){
        	$id_caso = $this->casos_model->casoporapoderado($this->session->userdata('user_id'));
        }
        $data = $this->Rep_to_procedimientos_model->procedimientos($id_caso);
        echo json_encode($data);
        return;
	}

    public function downloadcarac($id = null){
        $ruta = $this->Rep_to_procedimientos_model->Reportesproc($id);
        if($this->ion_auth->in_group(9)){
        	$filepath = './files/Reportes/crtz/casos/procedimientos '.$id.' '.$ruta[0].' '.$ruta[1].'.pdf';
    	}
    	if($this->ion_auth->in_group(7)){
    		$filepath = './files/Reportes/crtz/Apoderado/procedimientos '.$id.' '.$ruta[0].' '.$ruta[1].'.pdf';	
    	}
        force_download($filepath, NULL);
    }
}
