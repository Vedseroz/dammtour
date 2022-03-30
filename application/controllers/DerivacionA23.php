<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DerivacionA23 extends CI_Controller {
	private $data = array();
	private $filebase;
	
    public function __construct() 
    {
		parent::__construct();
		// Session
	    $this->ion_auth->redirectLoginIn();
	    // Config
	    // Models
	    $this->load->model('casos_model');
	    $this->load->model('Colegios_model');
	    $this->load->model('Cursos_model');
	    $this->load->model('En_colegio_model');
	    $this->load->model('En_curso_model');
	    $this->load->model('Derivaciones_model');
	    $this->load->model('Rep_habytal_deriv2_model');
	    // Libraries
	    $this->load->library('upload');
	    $this->load->library('mpdf');
	    // Helpers
	    $this->load->helper(array('date', 'file', 'url', 'html', 'form'));
    	// View data
		$this->data['breadcrumb'] = array(
			array(
				'name' => 'Derivación',
				'link' =>  site_url('derivacion/index')
			)
		);
		$this->load->helper('array');
		// Errors
		$this->data['errors'] = array();
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

	public function index($id_caso = null, $id_derivacion){
		// View data
		//$this->data['title'] = 'Procedimientos';
		//$this->data['subtitle'] = 'Iniciar';
		/*
		$this->data['breadcrumb'][] = array(
			'name' => 'Buscar caso',
		);
		*/
		//$this->data['menu_items'][] = 'list';
		redirect(site_url('Inicio'), 'location');
	}

	public function Usuario1Ing($id_caso = null, $id_drvz){
   		if(!$this->ion_auth->in_group(3)) redirect(site_url('Inicio'), 'location');
   		$components = new stdClass();

   		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

   		$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
		$id_colegio = $this->En_colegio_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_colegio;
		$this->data['colegio'] = $this->Colegios_model->get('*', array('id' => $id_colegio));

		$id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
		$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso));
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuarta Actividad: Evaluación caso'
		);
		$this->data['id_drvz'] = $id_drvz;
		$this->data['etapa'] = 4;
		$this->data['tipo'] = 3;
		$this->data['estado_act'] = 0;
		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);

		if(empty($_FILES['userFileD']['name'])){
			$config = array(
				array(
					'field' => 'userFileD',
					'label' => '<b>Documento de evaluación</b>',
					'rules' => "required"
				)
			);
		}else{
			$config = array(
				array(
					'field' => 'userFileD',
					'label' => '<b>Documento de evaluación</b>',
					'rules' => "trim"
				)
			);
		}
		$this->form_validation->set_rules($config);
	    if($this->form_validation->run() === FALSE){
        	$post = !empty($this->input->post());
        	$components->menu = $this->load->view('components/Usuario1/drvz/menuDrvz', $this->data, true);
			$this->data['components'] = $components;
        	$this->view_handler->view('Usuario1/drvz', 'act23ingresar', $this->data);
        }else{
        	if(!empty($_FILES['userFileD']['name'])){
		        $uploadPath = './files/drvz/' .$id_drvz. '/act5/dox/';
				if (!is_dir($uploadPath)) {
				    mkdir($uploadPath, 0755, TRUE);
				}
				$config = array(
					'upload_path' => $uploadPath,
					'allowed_types' => '*',
					'overwrite' => true
				);
				$this->upload->initialize($config);
				if(!$this->upload->do_upload('userFileD')){
		            $data['uploadError'] = $this->upload->display_errors();
				    echo $this->upload->display_errors();
				    return;
		        }
		        $data['uploadSuccess'] = $this->upload->data();
	        }
	        $derivacion = array(
	        	'estado' => 'FINALIZADO',
        		'etapa' => 5
        	);

	        $this->Derivaciones_model->update($derivacion, array('id' => $id_drvz));
	        $this->data['etapa'] = 5;
			$this->data['tipo'] = 3;
			$this->data['estado_act'] = 0;
	        $components->menu = $this->load->view('components/Usuario1/drvz/menuDrvz', $this->data, true);
			$this->data['components'] = $components;
	        $this->view_handler->view('Usuario1/drvz', 'act23fin', $this->data);
        }
    }

    public function Usuario1Mostrar($id_caso = null, $id_drvz){
    	if(!$this->ion_auth->in_group(3)) redirect(site_url('Inicio'), 'location');
   		$components = new stdClass();

   		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

   		$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
		$id_colegio = $this->En_colegio_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_colegio;
		$this->data['colegio'] = $this->Colegios_model->get('*', array('id' => $id_colegio));

		$id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
		$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso));
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuarta Actividad: Evaluación caso'
		);
		$this->data['id_drvz'] = $id_drvz;
		$this->data['etapa'] = 5;
		$this->data['tipo'] = 3;
		$this->data['estado_act'] = 0;
		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$components->menu = $this->load->view('components/Usuario1/drvz/menuDrvz', $this->data, true);
		$this->data['components'] = $components;
        $this->view_handler->view('Usuario1/drvz', 'act23fin', $this->data);
    }
	
	public function createhabytal($caso = null, $id = null, $habytal = null){
		require_once("files/Reportes/plantillas/Reporte/habytal_deriv2.php");
		date_default_timezone_set("America/Santiago");
		$hoy = date('Y-m-d');
		$html = getPlantilla($caso, $hoy, $id, $habytal);
    	$pdfFilePath = 'Derivación '.$id.' por Mediación escolar '.$caso[2].' '.$hoy.'.pdf';
	    $estilos = file_get_contents('files/Reportes/plantillas/Reporte/style.css');
		$mpdf = new mpdf('c'); 
	    $mpdf->setDisplayMode('fullpage');  
		$mpdf->WriteHTML($estilos,1);
	    $mpdf->WriteHTML($html,2);
	    ob_clean();
	    $ruta = "files/Reportes/indicadores/".$pdfFilePath;
	    $mpdf->Output($ruta, 'F'); 
	}		
}