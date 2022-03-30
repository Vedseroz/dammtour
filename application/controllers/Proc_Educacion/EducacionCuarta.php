<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class procedimientosCuarta extends CI_Controller {
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
	    $this->load->model('Actividad4d_model');
	    $this->load->model('En_colegio_model');
	    $this->load->model('En_curso_model');
	    $this->load->model('Groups_cc_email_model');//NUEVO
	    $this->load->model('Users_model');//NUEVO
	    // Libraries
	    $this->load->library('upload');
	    $this->load->library('mpdf');
	    // Helpers
	    $this->load->helper('date');
	    $this->load->helper('directory');
    	// View data
		$this->data['breadcrumb'] = array(
			array(
				'name' => 'Caracterizacón',
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

		if($this->ion_auth->in_group(6)){
			$this->data['avatar'] = 'avatar3.png';
			$this->data['avatar_descrip'] = 'Imagen avatar cómite convivencia';
			$this->data['avatar_nombre'] = 'Cómite Convivencia';
		}

		if($this->ion_auth->in_group(array(1,2,3,4,5,6,7,8))){
			$idCuenta = $this->session->userdata('user_id');
			$uploadPath = './files/avatar/cuentas/' .$idCuenta. '/';
			$map = directory_map($uploadPath,1);
			if(!empty($map)) $this->data['avatarP'] = 'files/avatar/cuentas/' .$idCuenta. '/'. $map[0];
		}
    }

	public function index(){
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
			'name' => 'Cuarta Actividad: Información de conducta'
		);
		$this->data['menu_procesos'] = array(1,3,3,3,3);

		$procedimientos = $this->procedimientoses_model->get('*', array('id' => $id_proc));

		if($procedimientos[0]->etapa == 2) $this->data['menu_procesos'] = array(1,2,3,3,3);
		if($procedimientos[0]->etapa == 3) $this->data['menu_procesos'] = array(1,1,2,3,3);
		if($procedimientos[0]->etapa == 4) $this->data['menu_procesos'] = array(1,1,1,2,3);
		if($procedimientos[0]->etapa == 5) $this->data['menu_procesos'] = array(1,1,1,1,2);
		if($procedimientos[0]->etapa == 6) $this->data['menu_procesos'] = array(1,1,1,1,1);
		
		$this->data['actividad4d'] = $this->Actividad4d_model->get('*', array('id_procedimientos' => $id_proc));

		$components = new stdClass();
		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$components->menu = $this->load->view('components/Usuario1/proc/menuproc', $this->data, true);
		$this->data['components'] = $components;

		$this->view_handler->view('Usuario1/proc', 'act4mostrar', $this->data);
   }

    public function Usuario1sp($id_caso = null, $id_proc = null){

    	$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

   		if(!$this->ion_auth->in_group(3)) redirect(site_url('Inicio'), 'location');
   		$this->data['breadcrumb'][] = array(
			'name' => 'Cuarta Actividad: Información de conducta'
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
		$this->data['menu_procesos'] = array(1,1,1,2,3);
		$components->menu = $this->load->view('components/Usuario1/proc/menuproc', $this->data, true);

		$this->view_handler->view('Usuario1/proc', 'act4espera', $this->data);
    }

    public function comiteIng($id_caso = null, $id_proc = null){
    	if(!$this->ion_auth->in_group(6)) redirect(site_url('Inicio'), 'location');
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
			'name' => 'Cuarta Actividad: Información de conducta'
		);
		$this->data['id_proc'] = $id_proc;
		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$this->data['components'] = $components;

		//variables para documento
		$nombre = array(
			'nombre' => $this->session->userdata('first_name'),
			'apellido' => $this->session->userdata('last_name')
		);	

		$caso = $this->casos_model->caso($id_caso);
		//Fin variables para documento
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
			),
			array(
				'field' => 'pregunta8',
				'label' => 'de la <b> pregunta 8</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'vocacion',
				'label' => 'de la <b> vocacion</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'perfil',
				'label' => '<b>Perfiles</b>',
				'rules' => "trim|required"
			),
		);

		$this->form_validation->set_rules($config);
	    if($this->form_validation->run() === FALSE){
        	// default vista al iniciar formulario
        	$post = !empty($this->input->post());
        	!empty($this->input->post('pregunta1')) ? $this->data['p1resp'] = $this->input->post('pregunta1') : $this->data['p1resp'] = NULL;
			!empty($this->input->post('pregunta2')) ? $this->data['p2resp'] = $this->input->post('pregunta2') : $this->data['p2resp'] = NULL;
			!empty($this->input->post('pregunta3')) ? $this->data['p3resp'] = $this->input->post('pregunta3') : $this->data['p3resp'] = NULL;
			!empty($this->input->post('pregunta4')) ? $this->data['p4resp'] = $this->input->post('pregunta4') : $this->data['p4resp'] = NULL;
			!empty($this->input->post('pregunta5')) ? $this->data['p5resp'] = $this->input->post('pregunta5') : $this->data['p5resp'] = NULL;
			!empty($this->input->post('pregunta6')) ? $this->data['p6resp'] = $this->input->post('pregunta6') : $this->data['p6resp'] = NULL;
			!empty($this->input->post('pregunta7')) ? $this->data['p7resp'] = $this->input->post('pregunta7') : $this->data['p7resp'] = NULL;
			!empty($this->input->post('pregunta8')) ? $this->data['p8resp'] = $this->input->post('pregunta8') : $this->data['p8resp'] = NULL;
			!empty($this->input->post('vocacion')) ? $this->data['vocacion'] = $this->input->post('vocacion') : $this->data['vocacion'] = NULL;
			!empty($this->input->post('perfil')) ? $this->data['perfil'] = $this->input->post('perfil') : $this->data['perfil'] = NULL;
        	$this->view_handler->view('comite/proc', 'act4ingresar', $this->data);
        }else{
        	// Ingreso de datos por formulario
	       	$actividad4d = array(
	       		'id_procedimientos' => $id_proc,
				'pregunta1' => empty($pregunta1 = $this->input->post('pregunta1')) ? "Sin Respuesta" : $pregunta1,
	       		'pregunta2' => empty($pregunta2 = $this->input->post('pregunta2')) ? "Sin Respuesta" : $pregunta2,
	       		'pregunta3' => empty($pregunta3 = $this->input->post('pregunta3')) ? "Sin Respuesta" : $pregunta3,
	       		'pregunta4' => empty($pregunta4 = $this->input->post('pregunta4')) ?  "Sin Respuesta" : $pregunta4,
	       		'pregunta5' => empty($pregunta5 = $this->input->post('pregunta5')) ?  "Sin Respuesta" : $pregunta5,
	       		'pregunta6' => empty($pregunta6 = $this->input->post('pregunta6')) ?  "Sin Respuesta" : $pregunta6,
	       		'pregunta7' => empty($pregunta7 = $this->input->post('pregunta7')) ?  "Sin Respuesta" : $pregunta7,
	       		'pregunta8' => empty($pregunta8 = $this->input->post('pregunta8')) ?  "Sin Respuesta" : $pregunta8,
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
	        if($this->Actividad4d_model->add($actividad4d)) {
	        	$procedimientos = array(
		       		'etapa' => 5
	        	);
	        	//CREAR DOCUMENTOS PDF
	        	$this->createpdf($caso, $id_proc, $nombre, $actividad4d);
	        	$this->createfracc($caso, $id_proc, $nombre, $actividad4d);
	        	//FIN CREAR DOCUMENTOS PDF
	        	$this->procedimientoses_model->update($procedimientos, array('id' => $id_proc));
	        	//variables para notificar
				$email = $this->Groups_cc_email_model->getmailprofe($colegio[0], $colegio[1], 3);
		    	$id_apoderado = $this->casos_model->IDapoderado($id_caso);
		    	$email2 = $this->Users_model->getmailapoderado($id_apoderado[0]);
		    	if(!empty($email)){
		    	    $this->enviar($email, $email2, $caso);
		    	}
	        	//FIN variables para notificar
	        	$this->view_handler->view('comite/proc', 'act4fin', $this->data);
	        }else{
	        	$this->data['errors']['Base de datos'] =  'No se pudieron modificar los datos.';
	        	$this->view_handler->view('comite/proc', 'act4ingresar', $this->data);
	        }
        }
	}

	public function createpdf($caso = null, $id_proc = null, $nombre = null, $actividad4d = null){
		require_once("files/Reportes/plantillas/Reporte/index4.php"); 							//LLAMADO A LA PLANTILLA
		date_default_timezone_set("America/Santiago");						
		$hoy = date('Y-m-d');
		$html = getPlantilla($actividad4d, $caso, $hoy, $nombre);							//FUNCIÓN DE LA PLANTILLA
    	$pdfFilePath = "Procedimiento ".$id_proc." ".$caso[2]." ".$caso[3].".pdf";//NOMBRE DEL ARCHIVO
	    $estilos = file_get_contents('files/Reportes/plantillas/Reporte/style.css'); 			//CSS DEL ARCHIVO
		$mpdf = new mpdf('c');
	    $mpdf->setDisplayMode('fullpage');
		$mpdf->WriteHTML($estilos,1);
	    $mpdf->WriteHTML($html,2);
	    ob_clean();
	    $ruta = "files/Reportes/crtz/Comite/".$pdfFilePath;										//RUTA DONDE GUARDA EL ARCHIVO
	    $mpdf->Output($ruta, 'F'); 														//CREA EL DOCUMENTO Y GUARDA EN LA RUTA.
	}

	public function createfracc($caso = null, $id_proc = null, $nombre = null, $actividad4d = null){
		require_once("files/Reportes/plantillas/Reporte/fraccion3.php");
		date_default_timezone_set("America/Santiago");
		$hoy = date('Y-m-d');
		$htmlfrac = fraccion($nombre, $hoy, $actividad4d);	
    	$file = $id_proc."_".$caso[2]."fase4.pdf";
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
		$pdf1 = './files/Reportes/crtz/Usuario1/'.$id_proc.'_'.$caso[2].'_temp3.pdf';	//ABRE REPORTE TEMPORAL CREADO ANTERIORMENTE
		$pdf2 = './files/Reportes/crtz/Usuario1/'.$id_proc.'_'.$caso[2].'fase4.pdf';	//ABRE REPORTE RECIEN CREADO
		
		$files = array(
			'pdf1' => $pdf1,
			'pdf2' => $pdf2
		); 

		$pdf = new mPDF('', '', 0, '', 15, 15, 6, 12, 9, 9, 'P');
        $pdf->enableImports = true;
        foreach( $files as $file ){
            $pdf->SetImportUse();														//PERMITE AGREGAR LAS PAGINAS DE 
            $pagecount = $pdf->SetSourceFile($file);										//DOCUMENTO NUEVO AL YA CREADO
            for ($i=1; $i<=($pagecount); $i++) {
                $pdf->AddPage();
                $import_page = $pdf->ImportPage($i);
                $pdf->UseTemplate($import_page);
            }
        }
		
		$file = $id_proc.'_'.$caso[2].'_temp4.pdf';										//CREA NUEVO DOCUMENTO TEMPORAL
        $ruta = "files/Reportes/crtz/Usuario1/".$file;										//RUTA A GUARDAR
		$pdf->Output($ruta);																//GUARDA EN LA RUTA
		unlink($pdf1);																			//BORRA LOS ARCHIVOS ANTERIORES
		unlink($pdf2);
	}

	public function enviar($email = null, $email2 = null, $caso = null){
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
		$mail->addAddress($email2[0], $email2[1]);												//AGREGA DIRECCIONES PRINCIPALES
		$mail->addCC($email[0], $email[1]);														//AGREGA CC (CON COPIA)
		$mail->Subject = 'Notificación de Procedimientos';							//ASUNTO
		$mail->MsgHTML('Se ha completado la cuarta etapa del Procedimiento: '.$caso[2].' '.$caso[3].' '.$caso[4].', ingrese al sistema para continuar con el Procedimiento.');			 //MENSAJE, PUEDE USAR html
		$mail->CharSet = 'UTF-8';
		$mail->send();
	}
}