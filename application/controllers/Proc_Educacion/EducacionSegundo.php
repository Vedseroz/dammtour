<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class procedimientosSegundo extends CI_Controller {
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
	    $this->load->model('Emotions_2d_model');
	    $this->load->model('Groups_cc_email_model');
	    $this->load->model('Colegios_model');
	    $this->load->model('Cursos_model');
	    $this->load->model('En_colegio_model');
	    $this->load->model('En_curso_model');
	    $this->load->model('Procedimientos_model');
	    $this->load->model('Actividad2d_model');
	    // Libraries
	    $this->load->library('upload');
	    $this->load->helper('directory');
	    $this->load->helper('download');
	    $this->load->library('mpdf');
	    $this->load->helper('date');
    	// View data
		$this->data['breadcrumb'] = array(
			array(
				'name' => 'Procedimiento',
				'link' =>  site_url('procedimientos/index')
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

		if($this->ion_auth->in_group(9)){
			$this->data['avatar'] = 'alum.jpg';
			$this->data['avatar_descrip'] = 'Imagen avatar Usuario 2';
			$this->data['avatar_nombre'] = 'Usuario 2';
		}
		if($this->ion_auth->in_group(array(9))){
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

	public function index(){
		redirect(site_url('Inicio'), 'location');
	}

	public function mostrar($id_caso = null, $id_proc = null){
		if(!$this->ion_auth->in_group(array(3,1))) redirect(site_url('Inicio'), 'location');

		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

    	$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
		
		$this->data['id_proc'] = $id_proc;

		$this->data['breadcrumb'][] = array(
			'name' => 'Segunda Actividad: Información Autobiográfica'
		);
		$this->data['menu_procesos'] = array(1,3,3,3,3);

		$procedimientos = $this->procedimientoses_model->get('*', array('id' => $id_proc));

		if($procedimientos[0]->etapa == 2) $this->data['menu_procesos'] = array(1,2,3,3,3);
		if($procedimientos[0]->etapa == 3) $this->data['menu_procesos'] = array(1,1,2,3,3);
		if($procedimientos[0]->etapa == 4) $this->data['menu_procesos'] = array(1,1,1,2,3);
		if($procedimientos[0]->etapa == 5) $this->data['menu_procesos'] = array(1,1,1,1,2);
		if($procedimientos[0]->etapa == 6) $this->data['menu_procesos'] = array(1,1,1,1,1);
		
		$components = new stdClass();
		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$components->menu = $this->load->view('components/Usuario1/proc/menuproc', $this->data, true);
		$this->data['components'] = $components;
		$this->data['actividad2d'] = $this->Actividad2d_model->get('*', array('id_procedimientos' => $id_proc));

		$downloadPath = './files/proc/'.$id_proc.'/act2/dox/';
		$this->data['archivoDox'] = directory_map($downloadPath,1)[0];

		$downloadPath = './files/proc/'.$id_proc.'/act2/audio';
		$this->data['archivoAudio'] = directory_map($downloadPath,1)[0];
		$this->view_handler->view('Usuario1/proc', 'act2mostrar', $this->data);
    }

    public function Usuario1sp($id_caso = null){
   		if(!$this->ion_auth->in_group(3)) redirect(site_url('Inicio'), 'location');
		
   		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

		//MENU INFORMACION caso
		$components = new stdClass();
		$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$this->data['components'] = $components;

		//MENU SELECCION DE ACTIVIDAD 
		$procedimientos = $this->procedimientoses_model->get('*', array('id' => $id_caso));

		$this->data['menu_procesos'] = array(1,2,3,3,3);
		$components->menu = $this->load->view('components/Usuario1/proc/menuproc', $this->data, true);
		$this->view_handler->view('Usuario1/proc', 'act2espera', $this->data);
    }

    public function Usuario1ing($id_caso = null, $id_proc = null){
   		if(!$this->ion_auth->in_group(3)) redirect(site_url('Inicio'), 'location');

   		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

		//MENU INFORMACION caso
		$components = new stdClass();
		$this->data['breadcrumb'][] = array(
			'name' => 'Segunda Actividad: Información Autobiográfica'
		);
		$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
		$id_colegio = $this->En_colegio_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_colegio;
		$this->data['colegio'] = $this->Colegios_model->get('*', array('id' => $id_colegio));

		$id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
		$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso));
		$this->data['id_proc'] = $id_proc;
		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$this->data['components'] = $components;
		//MENU SELECCION DE ACTIVIDAD 
		$procedimientos = $this->procedimientoses_model->get('*', array('id' => $id_proc));

		//declaracion variables pdf
		$nombre = array(
			'nombre' => $this->session->userdata('first_name'),
			'apellido' => $this->session->userdata('last_name')
		);
		$caso = $this->casos_model->caso($id_caso);
		$profe = TRUE;        		
		
		// Validación input 
		$config = array(
			array(
				'field' => 'pregunta1',
				'label' => 'de la <b> pregunta 1</b>',
				'rules' => "trim|required",
			),
			array(
				'field' => 'pregunta2',
				'label' => 'de la <b> pregunta 2</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta3',
				'label' => 'de la <b> pregunta 3</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta4',
				'label' => 'de la <b> pregunta 4</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta5',
				'label' => 'de la <b> pregunta 5</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta6',
				'label' => 'de la <b> pregunta 6</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta7',
				'label' => 'de la <b> pregunta 7</b>',
				'rules' => "trim|required"
			),array(
				'field' => 'pregunta8',
				'label' => 'de la <b> pregunta 8</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta9',
				'label' => 'de la <b> pregunta 9</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta10',
				'label' => 'de la <b> pregunta 10</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta11',
				'label' => 'de la <b> pregunta 11</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'vocacion',
				'label' => '<b>Vocación</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'perfil',
				'label' => '<b>Perfiles</b>',
				'rules' => "required"
			),
			array(
				'field' => 'emotion',
				'label' => '<b>Estados de ánimo</b>',
				'rules' => "required"
			),
		);
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('pregunta1')) ? $this->data['p1resp'] = $this->input->post('pregunta1') : $this->data['p1resp'] = NULL;
			!empty($this->input->post('pregunta2')) ? $this->data['p2resp'] = $this->input->post('pregunta2') : $this->data['p2resp'] = NULL;
			!empty($this->input->post('pregunta3')) ? $this->data['p3resp'] = $this->input->post('pregunta3') : $this->data['p3resp'] = NULL;
			!empty($this->input->post('pregunta4')) ? $this->data['p4resp'] = $this->input->post('pregunta4') : $this->data['p4resp'] = NULL;
			!empty($this->input->post('pregunta5')) ? $this->data['p5resp'] = $this->input->post('pregunta5') : $this->data['p5resp'] = NULL;
			!empty($this->input->post('pregunta6')) ? $this->data['p6resp'] = $this->input->post('pregunta6') : $this->data['p6resp'] = NULL;
			!empty($this->input->post('pregunta7')) ? $this->data['p7resp'] = $this->input->post('pregunta7') : $this->data['p7resp'] = NULL;
			!empty($this->input->post('pregunta8')) ? $this->data['p8resp'] = $this->input->post('pregunta8') : $this->data['p8resp'] = NULL;
			!empty($this->input->post('pregunta9')) ? $this->data['p9resp'] = $this->input->post('pregunta9') : $this->data['p9resp'] = NULL;
			!empty($this->input->post('pregunta10')) ? $this->data['p10resp'] = $this->input->post('pregunta10') : $this->data['p10resp'] = NULL;
			!empty($this->input->post('pregunta11')) ? $this->data['p11resp'] = $this->input->post('pregunta11') : $this->data['p11resp'] = NULL;
			!empty($this->input->post('vocacion')) ? $this->data['vocacion'] = $this->input->post('vocacion') : $this->data['vocacion'] = NULL;
			!empty($this->input->post('perfil')) ? $this->data['perfil'] = $this->input->post('perfil') : $this->data['perfil'] = NULL;
			!empty($this->input->post('emotion')) ? $this->data['emotion'] = $this->input->post('emotion') : $this->data['emotion'] = NULL;
			$this->data['menu_procesos'] = array(1,2,3,3,3);
			$components->menu = $this->load->view('components/Usuario1/proc/menuproc', $this->data, true);
			$actividad2 = $this->Actividad2d_model->get('*',array('id_procedimientos' => $id_proc));
			if($procedimientos[0]->bombero == 1){
				$this->data['p1resp'] = $actividad2[0]->pregunta1;
				$this->data['p2resp'] = $actividad2[0]->pregunta2;
				$this->data['p3resp'] = $actividad2[0]->pregunta3;
				$this->data['p4resp'] = $actividad2[0]->pregunta4;
				$this->data['p5resp'] = $actividad2[0]->pregunta5;
				$this->data['p6resp'] = $actividad2[0]->pregunta6;
				$this->data['p7resp'] = $actividad2[0]->pregunta7;
				$this->data['p8resp'] = $actividad2[0]->pregunta8;
				$this->data['p9resp'] = $actividad2[0]->pregunta9;
				$this->data['p10resp'] = $actividad2[0]->pregunta10;
				$this->data['p11resp'] = $actividad2[0]->pregunta11;
				//var_dump($this->data);
			}
			$this->view_handler->view('Usuario1/proc', 'act2ingresar', $this->data);
		}else{
			$actividad2d = array(
        		'id_procedimientos' => $id_proc,
				'pregunta1' => empty($pregunta1 = $this->input->post('pregunta1')) ? "Sin Respuesta" : $pregunta1,
        		'pregunta2' => empty($pregunta2 = $this->input->post('pregunta2')) ? "Sin Respuesta" : $pregunta2,
        		'pregunta3' => empty($pregunta3 = $this->input->post('pregunta3')) ? "Sin Respuesta" : $pregunta3,
        		'pregunta4' => empty($pregunta4 = $this->input->post('pregunta4')) ?  "Sin Respuesta" : $pregunta4,
        		'pregunta5' => empty($pregunta5 = $this->input->post('pregunta5')) ?  "Sin Respuesta" : $pregunta5,
        		'pregunta6' => empty($pregunta6 = $this->input->post('pregunta6')) ?  "Sin Respuesta" : $pregunta6,
        		'pregunta7' => empty($pregunta7 = $this->input->post('pregunta7')) ?  "Sin Respuesta" : $pregunta7,
        		'pregunta8' => empty($pregunta8 = $this->input->post('pregunta8')) ?  "Sin Respuesta" : $pregunta8,
        		'pregunta9' => empty($pregunta9 = $this->input->post('pregunta9')) ?  "Sin Respuesta" : $pregunta9,
        		'pregunta10' => empty($pregunta10 = $this->input->post('pregunta10')) ?  "Sin Respuesta" : $pregunta10,
        		'pregunta11' => empty($pregunta11 = $this->input->post('pregunta11')) ?  "Sin Respuesta" : $pregunta11,
        		'emotion' => empty($emotion = $this->input->post('emotion')) ?  "Sin Respuesta" : $emotion,
        		'vocacion' => empty($vocacion = $this->input->post('vocacion')) ?  "Sin Respuesta" : $vocacion,
        		'perfil' => empty($perfil = $this->input->post('perfil')) ?  0 : $perfil,
        		'talento1' => empty($talento1 = $this->input->post('talento1')) ?  "Sin Respuesta" : $talento1,
        		'talento2' => empty($talento2 = $this->input->post('talento2')) ?  "Sin Respuesta" : $talento2,
        		'talento3' => empty($talento3 = $this->input->post('talento3')) ?  "Sin Respuesta" : $talento3,
        		'talento4' => empty($talento4 = $this->input->post('talento4')) ?  "Sin Respuesta" : $talento4,
        		'talento5' => empty($talento5 = $this->input->post('talento5')) ?  "Sin Respuesta" : $talento5,
        		'habilidad1' => empty($habilidad1 = $this->input->post('habilidad1')) ?  "Sin Respuesta" : $habilidad1,
        		'habilidad2' => empty($habilidad2 = $this->input->post('habilidad2')) ?  "Sin Respuesta" : $habilidad2,
        		'habilidad3' => empty($habilidad3 = $this->input->post('habilidad3')) ?  "Sin Respuesta" : $habilidad3,
        		'habilidad4' => empty($habilidad4 = $this->input->post('habilidad4')) ?  "Sin Respuesta" : $habilidad4,
        		'habilidad5' => empty($habilidad5 = $this->input->post('habilidad5')) ?  "Sin Respuesta" : $habilidad5,
        	);

        	if($this->Actividad2d_model->add($actividad2d)) {

        		$uploadPath = './files/proc/' .$id_proc. '/act2/dox/';
        		if(!empty($_FILES['userFileD']['name'])){
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
	        	}

	        	$uploadPath = './files/proc/' .$id_proc. '/act2/audio/';
	        	if(!empty($_FILES['userFileA']['name'])){
				        if (!is_dir($uploadPath)) {
				            mkdir($uploadPath, 0755, TRUE);
				        }
				    $config  = 	array(
									'upload_path' => $uploadPath,
									'allowed_types' => '*',
									'overwrite' => true
								);
				    $this->upload->initialize($config);
				    if(!$this->upload->do_upload('userFileA')){
		                $data['uploadError'] = $this->upload->display_errors();
				        echo $this->upload->display_errors();
				        return;
		                }
	        	}

	        	$procedimientos = array(
	        		'etapa' => 3
        		);
        		$this->procedimientoses_model->update($procedimientos, array('id' => $id_proc));
        		//pdfs
        		$this->createpdf($caso, $id_proc, $profe, $nombre, $actividad2d);
        		$this->createfracc($caso, $id_proc, $profe, $nombre, $actividad2d);

        		$this->data['menu_procesos'] = array(1,1,2,3,3);
				$components->menu = $this->load->view('components/Usuario1/proc/menuproc', $this->data, true);
				
				$warning = FALSE;
				$email = $this->Groups_cc_email_model->getmail($colegio[0], 5);
				$emo = $this->Emotions_2d_model->getemotions($id_caso);
				if (!empty($emo)) {
					for ($i=0; $i< count($emo); $i++) { 
						if($emo[$i] == 2 || $emo[$i] == 3 || $emo[$i] == 5){
							$count++;
						}
					}
					if ($count >= 3) {
						$warning = TRUE;
						$emailp = $this->Groups_cc_email_model->getmailprofe($colegio[0], $colegio[1], 3);
				        if(!empty($emailp)){
						    $this->enviarurgente($emailp, $caso);
				        }
					}
				}
        		
        		//notificar
		    	if(!empty($email)){
		    	    $this->enviar($email, $caso);
		    	}
				$this->view_handler->view('Usuario1/proc', 'act2fin', $this->data);
			
        	}	else{
        			$this->data['errors']['Base de datos'] =  'No se pudieron modificar los datos.';
        			$this->view_handler->view('Usuario1/proc', 'act2ingresar', $this->data);
        		}
		}
	}

   	public function casoIng($id_caso = null, $id_proc = null){
   		if(!$this->ion_auth->in_group(9)) redirect(site_url('Inicio'), 'location');

   		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

		//MENU INFORMACION caso
		$components = new stdClass();
		$this->data['breadcrumb'][] = array(
			'name' => 'Segunda Actividad: Información Autobiográfica'
		);
		$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
		$id_colegio = $this->En_colegio_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_colegio;
		$this->data['colegio'] = $this->Colegios_model->get('*', array('id' => $id_colegio));

		$id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
		$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso));
		$this->data['id_proc'] = $id_proc;
		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$this->data['components'] = $components;

		//MENU SELECCION DE ACTIVIDAD 
		$procedimientos = $this->procedimientoses_model->get('*', array('id' => $id_proc));

		//variables		
		$nombre = array(
			'nombre' => $this->session->userdata('first_name'),
			'apellido' => $this->session->userdata('last_name')
		);
		$caso = $this->casos_model->caso($id_caso);
		$profe = FALSE;        		

		// Validación input 
		$config = array(
			array(
				'field' => 'pregunta1',
				'label' => 'de la <b> pregunta 1</b>',
				'rules' => "trim|required",
			),
			array(
				'field' => 'pregunta2',
				'label' => 'de la <b> pregunta 2</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta3',
				'label' => 'de la <b> pregunta 3</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta4',
				'label' => 'de la <b> pregunta 4</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta5',
				'label' => 'de la <b> pregunta 5</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta6',
				'label' => 'de la <b> pregunta 6</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta7',
				'label' => 'de la <b> pregunta 7</b>',
				'rules' => "trim|required"
			),array(
				'field' => 'pregunta8',
				'label' => 'de la <b> pregunta 8</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta9',
				'label' => 'de la <b> pregunta 9</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta10',
				'label' => 'de la <b> pregunta 10</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'pregunta11',
				'label' => 'de la <b> pregunta 11</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'vocacion',
				'label' => '<b>Vocación</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'perfil',
				'label' => '<b>Perfiles</b>',
				'rules' => "required"
			),
			array(
				'field' => 'emotion',
				'label' => '<b>Estados de ánimo</b>',
				'rules' => "required"
			),
		);
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('pregunta1')) ? $this->data['p1resp'] = $this->input->post('pregunta1') : $this->data['p1resp'] = NULL;
			!empty($this->input->post('pregunta2')) ? $this->data['p2resp'] = $this->input->post('pregunta2') : $this->data['p2resp'] = NULL;
			!empty($this->input->post('pregunta3')) ? $this->data['p3resp'] = $this->input->post('pregunta3') : $this->data['p3resp'] = NULL;
			!empty($this->input->post('pregunta4')) ? $this->data['p4resp'] = $this->input->post('pregunta4') : $this->data['p4resp'] = NULL;
			!empty($this->input->post('pregunta5')) ? $this->data['p5resp'] = $this->input->post('pregunta5') : $this->data['p5resp'] = NULL;
			!empty($this->input->post('pregunta6')) ? $this->data['p6resp'] = $this->input->post('pregunta6') : $this->data['p6resp'] = NULL;
			!empty($this->input->post('pregunta7')) ? $this->data['p7resp'] = $this->input->post('pregunta7') : $this->data['p7resp'] = NULL;
			!empty($this->input->post('pregunta8')) ? $this->data['p8resp'] = $this->input->post('pregunta8') : $this->data['p8resp'] = NULL;
			!empty($this->input->post('pregunta9')) ? $this->data['p9resp'] = $this->input->post('pregunta9') : $this->data['p9resp'] = NULL;
			!empty($this->input->post('pregunta10')) ? $this->data['p10resp'] = $this->input->post('pregunta10') : $this->data['p10resp'] = NULL;
			!empty($this->input->post('pregunta11')) ? $this->data['p11resp'] = $this->input->post('pregunta11') : $this->data['p11resp'] = NULL;
			!empty($this->input->post('vocacion')) ? $this->data['vocacion'] = $this->input->post('vocacion') : $this->data['vocacion'] = NULL;
			!empty($this->input->post('perfil')) ? $this->data['perfil'] = $this->input->post('perfil') : $this->data['perfil'] = NULL;
			!empty($this->input->post('emotion')) ? $this->data['emotion'] = $this->input->post('emotion') : $this->data['emotion'] = NULL;
			$actividad2 = $this->Actividad2d_model->get('*',array('id_procedimientos' => $id_proc));
			if($procedimientos[0]->bombero == 1){
				$this->data['p1resp'] = $actividad2[0]->pregunta1;
				$this->data['p2resp'] = $actividad2[0]->pregunta2;
				$this->data['p3resp'] = $actividad2[0]->pregunta3;
				$this->data['p4resp'] = $actividad2[0]->pregunta4;
				$this->data['p5resp'] = $actividad2[0]->pregunta5;
				$this->data['p6resp'] = $actividad2[0]->pregunta6;
				$this->data['p7resp'] = $actividad2[0]->pregunta7;
				$this->data['p8resp'] = $actividad2[0]->pregunta8;
				$this->data['p9resp'] = $actividad2[0]->pregunta9;
				$this->data['p10resp'] = $actividad2[0]->pregunta10;
				$this->data['p11resp'] = $actividad2[0]->pregunta11;
				//var_dump($this->data);
			}
			$this->view_handler->view('caso/proc', 'act2ingresar', $this->data);
		}else{

			$actividad2d = array(
        		'id_procedimientos' => $id_proc,
				'pregunta1' => empty($pregunta1 = $this->input->post('pregunta1')) ? "Sin Respuesta" : $pregunta1,
        		'pregunta2' => empty($pregunta2 = $this->input->post('pregunta2')) ? "Sin Respuesta" : $pregunta2,
        		'pregunta3' => empty($pregunta3 = $this->input->post('pregunta3')) ? "Sin Respuesta" : $pregunta3,
        		'pregunta4' => empty($pregunta4 = $this->input->post('pregunta4')) ?  "Sin Respuesta" : $pregunta4,
        		'pregunta5' => empty($pregunta5 = $this->input->post('pregunta5')) ?  "Sin Respuesta" : $pregunta5,
        		'pregunta6' => empty($pregunta6 = $this->input->post('pregunta6')) ?  "Sin Respuesta" : $pregunta6,
        		'pregunta7' => empty($pregunta7 = $this->input->post('pregunta7')) ?  "Sin Respuesta" : $pregunta7,
        		'pregunta8' => empty($pregunta8 = $this->input->post('pregunta8')) ?  "Sin Respuesta" : $pregunta8,
        		'pregunta9' => empty($pregunta9 = $this->input->post('pregunta9')) ?  "Sin Respuesta" : $pregunta9,
        		'pregunta10' => empty($pregunta10 = $this->input->post('pregunta10')) ?  "Sin Respuesta" : $pregunta10,
        		'pregunta11' => empty($pregunta11 = $this->input->post('pregunta11')) ?  "Sin Respuesta" : $pregunta11,
        		'emotion' => empty($emotion = $this->input->post('emotion')) ?  "Sin Respuesta" : $emotion,
        		'vocacion' => empty($vocacion = $this->input->post('vocacion')) ?  "Sin Respuesta" : $vocacion,
        		'perfil' => empty($pefil = $this->input->post('pefil')) ? 0 : $pefil,
        		'talento1' => empty($talento1 = $this->input->post('talento1')) ?  "Sin Respuesta" : $talento1,
        		'talento2' => empty($talento2 = $this->input->post('talento2')) ?  "Sin Respuesta" : $talento2,
        		'talento3' => empty($talento3 = $this->input->post('talento3')) ?  "Sin Respuesta" : $talento3,
        		'talento4' => empty($talento4 = $this->input->post('talento4')) ?  "Sin Respuesta" : $talento4,
        		'talento5' => empty($talento5 = $this->input->post('talento5')) ?  "Sin Respuesta" : $talento5,
        		'habilidad1' => empty($habilidad1 = $this->input->post('habilidad1')) ?  "Sin Respuesta" : $habilidad1,
        		'habilidad2' => empty($habilidad2 = $this->input->post('habilidad2')) ?  "Sin Respuesta" : $habilidad2,
        		'habilidad3' => empty($habilidad3 = $this->input->post('habilidad3')) ?  "Sin Respuesta" : $habilidad3,
        		'habilidad4' => empty($habilidad4 = $this->input->post('habilidad4')) ?  "Sin Respuesta" : $habilidad4,
        		'habilidad5' => empty($habilidad5 = $this->input->post('habilidad5')) ?  "Sin Respuesta" : $habilidad5,
        	);

        	if($this->Actividad2d_model->add($actividad2d)) {

	        	$procedimientos = array(
	        		'etapa' => 3
        		);

	        	//crea pdfs
        		$this->createpdf($caso, $id_proc, $profe, $nombre, $actividad2d);        		
        		$this->createfracc($caso, $id_proc, $profe, $nombre, $actividad2d);        		
                $this->merge($caso, $id_proc);
        		$this->procedimientoses_model->update($procedimientos, array('id' => $id_proc));
        		
        		$warning = FALSE;
				$email = $this->Groups_cc_email_model->getmail($colegio[0], 5);
				$emo = $this->Emotions_2d_model->getemotions($id_caso);
				if (!empty($emo)) {
					for ($i=0; $i< count($emo); $i++) { 
						if($emo[$i] == 2 || $emo[$i] == 3 || $emo[$i] == 5){
							$count++;
						}
					}
					if ($count >= 3) {
						$warning = TRUE;
						$emailp = $this->Groups_cc_email_model->getmailprofe($colegio[0], $colegio[1], 3);
						if(!empty($emailp)){
						    $this->enviarurgente($emailp, $caso);
						}
					}
				}
        		
        		//notificar
        		if(!empty($email)){
    		    	$this->enviar($email, $caso);
        		}
				$this->view_handler->view('caso/proc', 'act2fin', $this->data);
        	}else{
        		$this->data['errors']['Base de datos'] =  'No se pudieron modificar los datos.';
        		$this->view_handler->view('caso/proc', 'act2ingresar', $this->data);
        	}
		}
   	}

    public function download_dox($id_proc = null, $archivoNombre = null){
   		if(!$this->ion_auth->in_group(3)) redirect(site_url('Inicio'), 'location');	
		$downloadPath = $downloadPath = './files/proc/'.$id_proc.'/act2/dox/'. $archivoNombre;
		force_download($downloadPath, NULL);
	}

	public function download_audio($id_proc = null, $archivoNombre = null){
   		if(!$this->ion_auth->in_group(3)) redirect(site_url('Inicio'), 'location');	

		$downloadPath = $downloadPath = './files/proc/'.$id_proc.'/act2/audio/'. $archivoNombre;
		force_download($downloadPath, NULL);
	}

	public function createpdf($caso = null, $id_proc = null, $profe = null, $nombre = null, $actividad2d = null){
		require_once("files/Reportes/plantillas/Reporte/index2.php");
		date_default_timezone_set("America/Santiago");
		$hoy = date('Y-m-d');
		$html = getPlantilla($actividad2d, $caso, $hoy, $profe, $nombre);
    	$pdfFilePath = "Procedimiento ".$id_proc." ".$caso[2]." ".$caso[3].".pdf";
	    $estilos = file_get_contents('files/Reportes/plantillas/Reporte/style.css');
		$mpdf = new mpdf('c');
	    $mpdf->setDisplayMode('fullpage');
		$mpdf->WriteHTML($estilos,1);
	    $mpdf->WriteHTML($html,2);
	    ob_clean();
	    $ruta = "files/Reportes/crtz/casos/".$pdfFilePath;
	    $mpdf->Output($ruta, 'F');
	}

	public function createfracc($caso = null, $id_proc = null, $profe = null, $nombre = null, $actividad2d = null){
		require_once("files/Reportes/plantillas/Reporte/fraccion1.php");
		date_default_timezone_set("America/Santiago");
		$hoy = date('Y-m-d');
		$htmlfrac = fraccion($profe, $nombre, $hoy, $actividad2d);	
    	$file = $id_proc."_".$caso[2]."fase2.pdf";
    	$estilos = file_get_contents('files/Reportes/plantillas/Reporte/style.css');
		$mpdfcarac = new mpdf('c');
	    $mpdfcarac->setDisplayMode('fullpage');
		$mpdfcarac->WriteHTML($estilos,1);
	    $mpdfcarac->WriteHTML($htmlfrac,2);  
	    ob_clean();
	    $rutafile = "files/Reportes/crtz/Usuario1/".$file;
	    $mpdfcarac->Output($rutafile, 'F'); 
	    $this->merge($caso, $id_proc);
	}

	public function merge($caso = null, $id_proc = null){
		$pdf1 = './files/Reportes/crtz/Usuario1/'.$id_proc.'_'.$caso[2].'_temp.pdf';
		$pdf2 = './files/Reportes/crtz/Usuario1/'.$id_proc.'_'.$caso[2].'fase2.pdf';
		
		$files = array(
			'pdf1' => $pdf1,
			'pdf2' => $pdf2
		); 

		$pdf = new mPDF('', '', 0, '', 15, 15, 6, 12, 9, 9, 'P');
        $pdf->enableImports = true;
        foreach( $files as $file ){
            $pdf->SetImportUse();

            $pagecount = $pdf->SetSourceFile($file);
            for ($i=1; $i<=($pagecount); $i++) {
                $pdf->AddPage();
                $import_page = $pdf->ImportPage($i);
                $pdf->UseTemplate($import_page);
            }
        }
		
		$file = $id_proc.'_'.$caso[2].'_temp2.pdf';
        $ruta = "files/Reportes/crtz/Usuario1/".$file;

		$pdf->Output($ruta);
		
		//unlink($pdf1);
		//unlink($pdf2);		
	}

	public function enviar($email = null, $caso = null){
        $this->load->library('PHPMailer_Lib');
        $mail = $this->phpmailer_lib->load();
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		$mail->SMTPSecure = 'ssl';
		$mail->SMTPOptions = array(
            'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
            )
        );
		$mail->SMTPAuth = true;
		$mail->Username = "acomitil@cmvalparaiso.cl";
		$mail->Password = "cmvzsexdr";
		$mail->setFrom('acomitil@cmvalparaiso.cl', 'Notificación Acomitil');
		$mail->addAddress($email[0], $email[1]);
		$mail->Subject = 'Notificación de Procedimientos';
		$mail->MsgHTML('Se ha completado la segunda etapa del Procedimiento: '.$caso[2].' '.$caso[3].' '.$caso[4].', ingrese al sistema para continuar con el Procedimiento.');	
		$mail->CharSet = 'UTF-8';
		$mail->send();
	}

	public function enviarurgente($email = null, $caso = null){
        $this->load->library('PHPMailer_Lib');
        $mail = $this->phpmailer_lib->load();
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		$mail->SMTPSecure = 'ssl';
		$mail->SMTPOptions = array(
            'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
            )
        );
		$mail->SMTPAuth = true;
		$mail->Username = "acomitil@cmvalparaiso.cl";
		$mail->Password = "cmvzsexdr";
		$mail->setFrom('acomitil@cmvalparaiso.cl', 'Notificación Acomitil');
		$mail->addAddress($email[0], $email[1]);
		$mail->Subject = 'Notificación Urgente';
		$mail->MsgHTML('El caso '.$caso[2].' '.$caso[3].' '.$caso[4].' ha contestado en las últimas tres procedimientoses con un sentir negativo. Se recomienda investigar.');
		$mail->CharSet = 'UTF-8';
		$mail->send();
	}
}