<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DerivacionA extends CI_Controller {
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
	    $this->load->model('Derivacion1_model');
	    $this->load->model('Groups_cc_email_model');//NUEVO
	    // Libraries
	    $this->load->library('mpdf');
	    // Helpers
	    $this->load->helper(array('date','download', 'file', 'url', 'html', 'form'));
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
	public function mostrar($id_caso = null, $id_drvz = null){
		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

    	$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
		$id_colegio = $this->En_colegio_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_colegio;
		$this->data['colegio'] = $this->Colegios_model->get('*', array('id' => $id_colegio));

		$id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
		$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso));
		$this->data['id_drvz'] = $id_drvz;

		$this->data['breadcrumb'][] = array(
			'name' => 'Primera Actividad: Evaluación de caso'
		);

		$derivacione = $this->Derivaciones_model->get('*', array('id' => $id_drvz));

		$this->data['estado_act'] = $derivacione[0]->estado_act;
		$derivacion1temp = $this->Derivacion1_model->get('*', array('id_derivacion' => $id_drvz));
		if($derivacion1temp[0]->responsable == 1){
			$derivacion1temp[0]->responsable = 'Orientador';
		}
		if($derivacion1temp[0]->responsable == 2){
			$derivacion1temp[0]->responsable = 'C. Convivencia';
		}
		$this->data['tipo'] = $derivacione[0]->tipo;
		$this->data['etapa'] = $derivacione[0]->etapa;
		$this->data['derivacion1'] = $derivacion1temp;

		$this->view_handler->view('DerivacionA', 'mostrar', $this->data);
   }

    public function Usuario1ing($id_caso = null){
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
		//echo $this->casos_model->get('*', array('id' => $id_caso))[0];
		$this->data['breadcrumb'][] = array(
			'name' => 'Primera Actividad: Evaluación de caso'
		);
		$this->data['etapa'] = 0;
		$this->data['tipo'] = 0;
		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		
		$this->data['components'] = $components;
		//variables de documento pdf
		$caso = $this->casos_model->caso($id_caso);
		//fin variables de documento pdf
		$config = array(
			array(
				'field' => 'situacion',
				'label' => '<b>Descripción de situación</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'justificacion',
				'label' => '<b>Justificación de la derivación</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'acciones',
				'label' => '<b>Acciones previas</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'perfil',
				'label' => '<b>Perfiles</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'vocacion',
				'label' => '<b>Vocación</b>',
				'rules' => "trim|required"
			),
		);

		$this->form_validation->set_rules($config);
	    if($this->form_validation->run() === FALSE){
        	$post = !empty($this->input->post());
        	!empty($this->input->post('situacion')) ? $this->data['p1resp'] = $this->input->post('situacion') : $this->data['p1resp'] = NULL;
			!empty($this->input->post('justificacion')) ? $this->data['p2resp'] = $this->input->post('justificacion') : $this->data['p2resp'] = NULL;
			!empty($this->input->post('acciones')) ? $this->data['p3resp'] = $this->input->post('acciones') : $this->data['p3resp'] = NULL;
			!empty($this->input->post('razon')) ? $this->data['razon'] = $this->input->post('razon') : $this->data['razon'] = NULL;
			!empty($this->input->post('vocacion')) ? $this->data['vocacion'] = $this->input->post('vocacion') : $this->data['vocacion'] = NULL;
			!empty($this->input->post('perfil')) ? $this->data['perfil'] = $this->input->post('perfil') : $this->data['perfil'] = NULL;
			!empty($this->input->post('talento1')) ? $this->data['talento1'] = $this->input->post('talento1') : $this->data['talento1'] = NULL;
			!empty($this->input->post('talento2')) ? $this->data['talento2'] = $this->input->post('talento2') : $this->data['talento2'] = NULL;
			!empty($this->input->post('talento3')) ? $this->data['talento3'] = $this->input->post('talento3') : $this->data['talento3'] = NULL;
			!empty($this->input->post('talento4')) ? $this->data['talento4'] = $this->input->post('talento4') : $this->data['talento4'] = NULL;
			!empty($this->input->post('talento5')) ? $this->data['talento5'] = $this->input->post('talento5') : $this->data['talento5'] = NULL;
        	!empty($this->input->post('habilidad1')) ? $this->data['habilidad1'] = $this->input->post('habilidad1') : $this->data['habilidad1'] = NULL;
			!empty($this->input->post('habilidad2')) ? $this->data['habilidad2'] = $this->input->post('habilidad2') : $this->data['habilidad2'] = NULL;
			!empty($this->input->post('habilidad3')) ? $this->data['habilidad3'] = $this->input->post('habilidad3') : $this->data['habilidad3'] = NULL;
			!empty($this->input->post('habilidad4')) ? $this->data['habilidad4'] = $this->input->post('habilidad4') : $this->data['habilidad4'] = NULL;
			!empty($this->input->post('habilidad5')) ? $this->data['habilidad5'] = $this->input->post('habilidad5') : $this->data['habilidad5'] = NULL;
			$components->menu = $this->load->view('components/Usuario1/drvz/menuDrvz', $this->data, true);
        	$this->view_handler->view('Usuario1/drvz', 'act1ingresar', $this->data);
        }else{
			$derivacion = array(
				'id_caso' => $id_caso,
        		'etapa' => 2,
        		'estado_act' => 0,
        		'tipo' => $this->input->post('razon'),
        		'estado' => "ACTIVO",
        		'fecha' => date('Y-m-d'),
        	); 
			//Se crear un nuevo registro en tabla derivacion y retorna el ID para la proxima tabla
        	$id_derivacion = $this->Derivaciones_model->add_id($derivacion);
        	//Estructura de datos para ingresar informacion a tabla derivacion1
        	$derivacion1 = array(
        		'id_derivacion' => $id_derivacion,
				'situacion' => $this->input->post('situacion'),
        		'razon' => $this->input->post('razon'),
        		'justificacion' => $this->input->post('justificacion'),
        		'acciones' => $this->input->post('acciones'),
        		'vocacion' => $this->input->post('vocacion'),
        		'perfil' => $this->input->post('perfil'),
        		'talento1' => $this->input->post('talento1'),
        		'talento2' => $this->input->post('talento2'),
        		'talento3' => $this->input->post('talento3'),
        		'talento4' => $this->input->post('talento4'),
        		'talento5' => $this->input->post('talento5'),
        		'habilidad1' => $this->input->post('habilidad1'),
        		'habilidad2' => $this->input->post('habilidad2'),
        		'habilidad3' => $this->input->post('habilidad3'),
        		'habilidad4' => $this->input->post('habilidad4'),
        		'habilidad5' => $this->input->post('habilidad5'),
        	); 
       
        	$this->Derivacion1_model->add($derivacion1);

        	$this->data['etapa'] = 2;
        	$this->data['estado_act'] = 0;
        	$this->data['id_drvz'] = $id_derivacion;
			$this->data['tipo'] = $this->input->post('razon');
			//CREAR DOCUMENTO PDF
			$this->createpdf($caso, $derivacion1);
			//ENVIAR NOTIFICACIÓN
			if ($this->input->post('razon') == 1) {
				$email = $this->Groups_cc_email_model->getmail($colegio[0], 4);
			}else{
				$email = $this->Groups_cc_email_model->getmail($colegio[0], 6);
			}
			if(!empty($email)){
	    	    $this->enviar($email, $caso, $this->input->post('razon'));
			}
	    	//FIN ENVÍO NOTIFICACIÓN
			$components->menu = $this->load->view('components/Usuario1/drvz/menuDrvz', $this->data, true);
        	$this->view_handler->view('Usuario1/drvz', 'act1fin', $this->data);
        }	
   	}

	public function Usuario1mostrar($id_caso = null, $id_drvz = null){
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
		$this->data['id_drvz'] = $id_drvz;

		$this->data['breadcrumb'][] = array(
			'name' => 'Primera Actividad: Evaluación de caso'
		);
		$derivacione = $this->Derivaciones_model->get('*', array('id' => $id_drvz));
		$this->data['tipo'] = $derivacione[0]->tipo;
		$this->data['etapa'] = $derivacione[0]->etapa;
		$this->data['estado_act'] = $derivacione[0]->estado_act;
		
		$derivacion1temp = $this->Derivacion1_model->get('*', array('id_derivacion' => $id_drvz));
		
		if($derivacion1temp[0]->responsable == 1){
			$derivacion1temp[0]->responsable = 'Orientador';
		}
		if($derivacion1temp[0]->responsable == 2){
			$derivacion1temp[0]->responsable = 'C. Convivencia';
		}
		
		$this->data['derivacion1'] = $derivacion1temp;

		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$components->menu = $this->load->view('components/Usuario1/drvz/menuDrvz', $this->data, true);
		$this->data['components'] = $components;
		$this->view_handler->view('Usuario1/drvz', 'act1mostrar', $this->data);
    }

    public function createpdf($caso = null, $derivacion1 = null){
		require_once("./files/Reportes/plantillas/Reporte/index-derivacion.php");
		date_default_timezone_set("America/Santiago");
		$hoy = date('Y-m-d');
		$html = getPlantilla($caso, $derivacion1, $hoy);
    	$pdfFilePath = $derivacion1['id_derivacion']."_".$caso[2]."_drvz.pdf";
	    $estilos = file_get_contents('files/Reportes/plantillas/Reporte/style.css'); 
	    $mpdf = new mpdf('c');
	    $mpdf->setDisplayMode('fullpage');
	    $mpdf->WriteHTML($estilos,1);
	    $mpdf->WriteHTML($html,2);
	    ob_clean();
	    $ruta = "files/Reportes/drvz/Usuario1/".$pdfFilePath;
	    $mpdf->Output($ruta, 'F'); 
	}

	public function enviar($email = null, $caso = null, $razon = null){
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
		$mail->Subject = 'Notificación de inicio de proceso de derivación';
		if ($razon == 1) {
			$mail->MsgHTML('Ha iniciado la derivación del caso: '.$caso[2].' '.$caso[3].' '.$caso[4].', ingrese al sistema para continuar con el proceso de derivación por Habilidades y talentos.');
		}else{
			$mail->MsgHTML('Ha iniciado la derivación del caso: '.$caso[2].' '.$caso[3].' '.$caso[4].', ingrese al sistema para continuar con el proceso de derivación.');
		}
		
		$mail->CharSet = 'UTF-8';
		$mail->send();
	}
}