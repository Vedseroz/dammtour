<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class procedimientosQuinto extends CI_Controller {
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
	    $this->load->model('Procedimientos_model');
	    $this->load->model('Actividad5d_model');
	    $this->load->model('En_colegio_model');
	    $this->load->model('En_curso_model');
	   	$this->load->model('casos_cc_model');//NUEVO
	    $this->load->model('Groups_cc_email_model');//NUEVO
	    $this->load->model('Rep_habytal_carac_model');
	    $this->load->model('Emotions_2d_model');
	    // Libraries
	    $this->load->library('upload');
	    $this->load->library('mpdf');
	    // Helpers
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

		if($this->ion_auth->in_group(7)){
			$this->data['avatar'] = 'apoderado.png';
			$this->data['avatar_descrip'] = 'Imagen avatar apoderado';
			$this->data['avatar_nombre'] = 'Apoderado';
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
		redirect(site_url('Inicio'), 'location');
	}

	public function Usuario1ing($id_caso = null, $id_proc = null){
		if(!$this->ion_auth->in_group(3)) redirect(site_url('Inicio'), 'location');

		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

		//MENU INFORMACION caso
		$components = new stdClass();
		$this->data['breadcrumb'][] = array(
			'name' => 'Quinta Actividad: Descripción familiar'
		);
		$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
		$datoscaso = $this->casos_model->get('*', array('id' => $id_caso))[0];
		$id_colegio = $this->En_colegio_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_colegio;
		$this->data['colegio'] = $this->Colegios_model->get('*', array('id' => $id_colegio));

		$id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
		$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso));
		$this->data['id_proc'] = $id_proc;

		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$this->data['components'] = $components;
		$this->data['menu_procesos'] = array(1,1,1,1,2);

		//variables para documento
		$nombre = array(
			'nombre' => $this->session->userdata('first_name'),
			'apellido' => $this->session->userdata('last_name')
		);	

		$profe = TRUE;
		$caso = $this->casos_model->caso($id_caso);
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
			$this->data['menu_procesos'] = array(1,1,1,1,2);
			$components->menu = $this->load->view('components/Usuario1/proc/menuproc', $this->data, true);
			$this->view_handler->view('Usuario1/proc', 'act5ingresar', $this->data);
		}else{
			$actividad5d = array(
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
	        );
	        if($this->Actividad5d_model->add($actividad5d)) {
	        	$procedimientos = array(
		       		'etapa' => 6,
		       		'estado' => 'FINALIZADO'
	        	);
	        	//variables para documentos pdf
	        	$habytal = $this->Rep_habytal_carac_model->habytal($id_proc);
	        	$emo = $this->Emotions_2d_model->last_ten_emo($id_caso);
	        	$ids = $this->Emotions_2d_model->last_ten_proc($id_caso);
	        	//CREAR DOCUMENTOS PDF
	        	$this->createpdf($caso, $profe, $id_proc, $nombre, $actividad5d);
	        	$this->createfracc($caso, $profe, $id_proc, $nombre, $actividad5d);
	        	$this->createhabytal($caso, $id_proc, $habytal);
				$this->createemotion($caso, $id_proc, $emo, $ids);
				//FIN variables y DOCUMENTOS PDF
	        	$this->data['menu_procesos'] = array(1,1,1,1,1);
	        	$this->procedimientoses_model->update($procedimientos, array('id' => $id_proc));
	        	$components->menu = $this->load->view('components/Usuario1/proc/menuproc', $this->data, true);
	        	$this->view_handler->view('Usuario1/proc', 'act5fin', $this->data);
	        }else{
	        	$this->data['errors']['Base de datos'] =  'No se pudieron modificar los datos.';
	        	$this->view_handler->view('Usuario1/proc', 'act5ingresar', $this->data);
	        }
		}
	}

	public function mostrar($id_caso = null, $id_proc = null){
		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

    	$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
		$id_colegio = $this->En_colegio_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_colegio;
		$this->data['colegio'] = $this->Colegios_model->get('*', array('id' => $id_colegio));

		$id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
		$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso));
		$this->data['id_proc'] = $id_proc;

		$this->data['breadcrumb'][] = array(
			'name' => 'Quinta Actividad: Descripción familiar'
		);
		$this->data['menu_procesos'] = array(1,1,1,1,1);

		$procedimientos = $this->procedimientoses_model->get('*', array('id' => $id_proc));
		
		$this->data['actividad5d'] = $this->Actividad5d_model->get('*', array('id_procedimientos' => $id_proc));
		$components = new stdClass();
		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$components->menu = $this->load->view('components/Usuario1/proc/menuproc', $this->data, true);
		$this->data['components'] = $components;

		$this->view_handler->view('Usuario1/proc', 'act5mostrar', $this->data);
    }

    public function Usuario1sp($id_caso = null, $id_proc = null){
   		if(!$this->ion_auth->in_group(3)) redirect(site_url('Inicio'), 'location');

   		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

   		$this->data['breadcrumb'][] = array(
			'name' => 'Quinta Actividad: Descripción familiar'
		);

		//MENU INFORMACION caso
		$components = new stdClass();
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
		$this->data['menu_procesos'] = array(1,1,1,1,2);
		$components->menu = $this->load->view('components/Usuario1/proc/menuproc', $this->data, true);

		$this->view_handler->view('Usuario1/proc', 'act5espera', $this->data);
    }

    public function apoderadoIng($id_caso = null, $id_proc = null){
		if(!$this->ion_auth->in_group(7)) redirect(site_url('Inicio'), 'location');

		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

		//MENU INFORMACION caso
		$components = new stdClass();
		$this->data['breadcrumb'][] = array(
			'name' => 'Quinta Actividad: Descripción familiar'
		);
		$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
		$id_colegio = $this->En_colegio_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_colegio;
		$this->data['colegio'] = $this->Colegios_model->get('*', array('id' => $id_colegio));

		$id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
		$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso));
		$this->data['id_proc'] = $id_proc;

		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$this->data['components'] = $components;

		//variables para pdf
		$nombre = array(
			'nombre' => $this->session->userdata('first_name'),
			'apellido' => $this->session->userdata('last_name')
		);	
		$profe = FALSE;
		$caso = $this->casos_model->caso($id_caso);

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
			$this->view_handler->view('apoderado/proc', 'act5ingresar', $this->data);
		}else{
			$actividad5d = array(
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
	        );
	        if($this->Actividad5d_model->add($actividad5d)) {
	        	$procedimientos = array(
		       		'etapa' => 6,
		       		'estado' => 'FINALIZADO'
	        	);
	        	//variables para documentos pdf
	        	$habytal = $this->Rep_habytal_carac_model->habytal($id_proc);
	        	$emo = $this->Emotions_2d_model->last_ten_emo($id_caso);
	        	$ids = $this->Emotions_2d_model->last_ten_proc($id_caso);
	        	//CREAR DOCUMENTOS PDF
	        	$this->createpdf($caso, $profe, $id_proc, $nombre, $actividad5d);
	        	$this->createfracc($caso, $profe, $id_proc, $nombre, $actividad5d);
	        	$this->createhabytal($caso, $id_proc, $habytal);
				$this->createemotion($caso, $id_proc, $emo, $ids);
				//FIN variables y DOCUMENTOS PDF
        		$this->procedimientoses_model->update($procedimientos, array('id' => $id_proc));
        		//variables para notificar
        		$colegio = $this->casos_cc_model->colegio($id_caso);
				$email = $this->Groups_cc_email_model->getmailprofe($colegio[0], $colegio[1], 3);
				if(!empty($email)){
		    	    $this->enviar($email, $caso);
				}
        		//FIN variables para notificar
        		$this->view_handler->view('apoderado/proc', 'act5fin', $this->data);
        	}else{
	        	$this->data['errors']['Base de datos'] =  'No se pudieron modificar los datos, re-ingrese.';
	        	$this->view_handler->view('apoderado/proc', 'act5ingresar', $this->data);
	        }
		}
	}

	public function createpdf($caso = null, $profe = null, $id_proc = null, $nombre = null, $actividad5d = null){
		require_once("files/Reportes/plantillas/Reporte/index5.php"); 							//LLAMADO A LA PLANTILLA
		date_default_timezone_set("America/Santiago");
		$hoy = date('Y-m-d');
		$html = getPlantilla($actividad5d, $caso, $hoy, $nombre, $profe);					//FUNCIÓN DE LA PLANTILLA
    	$pdfFilePath = "Procedimiento ".$id_proc." ".$caso[2]." ".$caso[3].".pdf";//NOMBRE DEL ARCHIVO
	    $estilos = file_get_contents('files/Reportes/plantillas/Reporte/style.css'); 			//CSS DEL ARCHIVO
		$mpdf = new mpdf('c');
	    $mpdf->setDisplayMode('fullpage');
		$mpdf->WriteHTML($estilos,1);
	    $mpdf->WriteHTML($html,2);
	    ob_clean();
	    $ruta = "files/Reportes/crtz/Apoderado/".$pdfFilePath;									//RUTA DONDE GUARDA EL ARCHIVO
	    $mpdf->Output($ruta, 'F'); 														//CREA EL DOCUMENTO Y GUARDA EN LA RUTA.
	}

	public function createfracc($caso = null, $profe = null, $id_proc = null, $nombre = null, $actividad5d = null){
		require_once("files/Reportes/plantillas/Reporte/fraccion4.php"); 						//LLAMADO A LA PLANTILLA
		date_default_timezone_set("America/Santiago");
		$hoy = date('Y-m-d');
		$htmlfrac = fraccion($nombre, $hoy, $actividad5d, $profe);								//FUNCIÓN DE LA PLANTILLA
    	$file = $id_proc."_".$caso[2]."fase5.pdf";										//NOMBRE DEL ARCHIVO
    	$estilos = file_get_contents('files/Reportes/plantillas/Reporte/style.css');	 		//CSS DEL ARCHIVO
		$mpdfcarac = new mpdf('c');
	    $mpdfcarac->setDisplayMode('fullpage');  
		$mpdfcarac->WriteHTML($estilos,1);
	    $mpdfcarac->WriteHTML($htmlfrac,2);  
	    ob_clean();
	    $rutafile = "files/Reportes/crtz/Usuario1/".$file;									//RUTA DONDE GUARDA EL ARCHIVO
	    $mpdfcarac->Output($rutafile,'F'); 												//CREA EL DOCUMENTO Y GUARDA EN LA RUTA.
	    $this->merge($caso, $id_proc);
	}

	public function merge($caso = null, $id_proc = null){
		$pdf1 = './files/Reportes/crtz/Usuario1/'.$id_proc.'_'.$caso[2].'_temp4.pdf';
		$pdf2 = './files/Reportes/crtz/Usuario1/'.$id_proc.'_'.$caso[2].'fase5.pdf';
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
		$file = 'Procedimiento '.$id_proc.' '.$caso[2].' completa.pdf';
        $ruta = "files/Reportes/crtz/Usuario1/".$file;

		$pdf->Output($ruta);
	
		unlink($pdf1);
		unlink($pdf2);
	}
	
	public function createhabytal($caso = null, $id_proc = null, $habytal = null){
		require_once("files/Reportes/plantillas/Reporte/habytal.php");
		date_default_timezone_set("America/Santiago");
		$hoy = date('Y-m-d');
		$html = Plantilla($caso, $hoy, $id_proc, $habytal);
    	$pdfFilePath = 'procedimientos '.$id_proc.' Habilidades y talentos de '.$caso[2].' '.$hoy.'.pdf';
	    $estilos = file_get_contents('files/Reportes/plantillas/Reporte/style.css');
		$mpdf = new mpdf('c'); 
	    $mpdf->setDisplayMode('fullpage');  
		$mpdf->WriteHTML($estilos,1);
	    $mpdf->WriteHTML($html,2);
	    ob_clean();
	    $ruta = "files/Reportes/indicadores/".$pdfFilePath;
	    $mpdf->Output($ruta, 'F'); 
	}

	public function createemotion($caso = null, $id = null, $emo = null, $ids = null){
		require_once("files/Reportes/plantillas/Reporte/emotion.php");
		date_default_timezone_set("America/Santiago");
		$hoy = date('Y-m-d');
		$html = MorePlantilla($caso, $hoy, $id, $emo, $ids);
    	$pdfFilePath = 'Indicadores de emoción de '.$caso[2].' '.$caso[3].' '.$caso[4].' '.$hoy.'.pdf';
	    $estilos = file_get_contents('files/Reportes/plantillas/Reporte/style.css');
		$mpdf = new mpdf('c'); 
	    $mpdf->setDisplayMode('fullpage');  
		$mpdf->WriteHTML($estilos,1);
	    $mpdf->WriteHTML($html,2);
	    ob_clean();
	    $ruta = "files/Reportes/indicadores/".$pdfFilePath;
	    $mpdf->Output($ruta, 'F'); 
	}

	public function enviar($email = null, $caso = null){
        $this->load->library('PHPMailer_Lib');													//CARGA LIBRERÍA DE PHPMAILER
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
		$mail->Username = "acomitil@cmvalparaiso.cl";											//CORREO DE NOTIFICACIONES
		$mail->Password = "cmvzsexdr";															//CONTRASEÑA DE DICHO CORREO
		$mail->setFrom('acomitil@cmvalparaiso.cl', 'Notificación Acomitil');					//NOMBRE Y CORREO DE ENVÍO
		$mail->addAddress($email[0], $email[1]);												//AGREGA DIRECCIONES PRINCIPALES
		$mail->Subject = 'Notificación de Procedimiento terminado';							//ASUNTO
		$mail->MsgHTML('Ha concluido el Procedimiento del caso: '.$caso[2].' '.$caso[3].' '.$caso[4].'. Se ha generado un documento a partir del proceso completo.');			 					//MENSAJE, PUEDE USAR html
		$mail->CharSet = 'UTF-8';
		$mail->send();
	}
}