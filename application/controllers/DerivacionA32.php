<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DerivacionA32 extends CI_Controller {
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
	    $this->load->model('Derivacion32_model');
	    $this->load->model('Derivaciones_model');
	    $this->load->model('casos_cc_model');//NUEVO
	    $this->load->model('Groups_cc_email_model');//NUEVO
	    $this->load->model('Rep_habytal_deriv4_model');//NUEVO
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

		if($this->ion_auth->in_group(8)){
			$this->data['avatar'] = 'dupla.png';
			$this->data['avatar_descrip'] = 'Imagen avatar dupla';
			$this->data['avatar_nombre'] = 'Dupla Psicosocial';
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

	public function Usuario1Espera($id_caso = null, $id_drvz = null){
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
			'name' => 'Tercera Actividad: Trabajos de fortalecimientos'
		);
		$this->data['id_drvz'] = $id_drvz;
		$this->data['etapa'] = 3;
		$this->data['tipo'] = 5;
		$this->data['estado_act'] = 0;
		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$components->menu = $this->load->view('components/Usuario1/drvz/menuDrvz', $this->data, true);
		$this->data['components'] = $components;

		$this->view_handler->view('Usuario1/drvz', 'act32espera', $this->data);
    }

    public function duplaIng($id_caso = null, $id_drvz = null){
		if(!$this->ion_auth->in_group(8)) redirect(site_url('Inicio'), 'location');
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
			'name' => 'Tercera Actividad: Trabajos de fortalecimientos'
		);
		$this->data['id_drvz'] = $id_drvz;
		$this->data['etapa'] = 3;
		$this->data['tipo'] = 5;
		$this->data['estado_act'] = 0;
		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$this->data['components'] = $components;
		//VARIABLES PARA DOCUMENTO PDF
		$caso = $this->casos_model->caso($id_caso);
		$nombre = array(
			'nombre' => $this->session->userdata('first_name'),
			'apellido' => $this->session->userdata('last_name')
		);
		//FIN VARIABLES PARA DOCUMENTO PDF
		$config = array(
			array(
				'field' => 'info_entregada',
				'label' => '<b>Información entregada</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'enviada',
				'label' => '<b>Enviado por</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'info_recibida',
				'label' => '<b>Información Recibida</b>',
				'rules' => "trim|required"
			),
			array(
				'field' => 'recibida',
				'label' => '<b>Recibida por</b>',
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
				'rules' => "trim|required"
			),
		);

		$this->form_validation->set_rules($config);
	    if($this->form_validation->run() === FALSE && $this->input->post('finalizar') != '2'){
	    	$post = !empty($this->input->post());
        	!empty($this->input->post('info_entregada')) ? $this->data['p1resp'] = $this->input->post('info_entregada') : $this->data['p1resp'] = NULL;
        	$post = !empty($this->input->post());
        	!empty($this->input->post('enviada')) ? $this->data['p2resp'] = $this->input->post('enviada') : $this->data['p2resp'] = NULL;
        	$post = !empty($this->input->post());
        	!empty($this->input->post('info_recibida')) ? $this->data['p3resp'] = $this->input->post('info_recibida') : $this->data['p3resp'] = NULL;
        	$post = !empty($this->input->post());
        	!empty($this->input->post('recibida')) ? $this->data['p4resp'] = $this->input->post('recibida') : $this->data['p4resp'] = NULL;
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
        	$this->view_handler->view('dupla/drvz', 'act32ingresar', $this->data);
        }else{
        	$derivacion32 = array(
	        	'id_derivacion' => $id_drvz,
				'info_entregada' => $this->input->post('info_entregada'),
	        	'enviada' => $this->input->post('enviada'),
	        	'info_recibida' => $this->input->post('info_recibida'),
	        	'recibida' => $this->input->post('recibida'),
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
        	$act32 = $this->Derivacion32_model->get('*', array('id_derivacion' => $id_drvz));
       		if(empty($act32)){
       		    $this->Derivacion32_model->add($derivacion32);
       		}else{
       			$this->Derivacion32_model->update($derivacion32, array('id_derivacion' => $id_drvz,));
       		}
	        //boton finalizar
	        if($this->input->post('finalizar') == '1'){
	        	$derivacion = array(
	            	'estado_act' => 0,
	        	    'etapa' => 4,
	        		'estado' => 'FINALIZADO',
	        	); 
	        	//CREAR DOCUMENTOS PDF
				$habytal = $this->Rep_habytal_deriv4_model->habytal($id_drvz);
	        	$this->createpdf($caso, $derivacion32);
	        	$this->createfracc($caso, $derivacion32, $nombre);
				$this->createhabytal($caso, $id_drvz, $habytal);
				//FIN CREAR DOCUMENTOS PDF
	        	$this->Derivaciones_model->update($derivacion, array('id' => $id_drvz));
	        	//NOTIFICAR
				$colegio = $this->casos_cc_model->colegio($id_caso);
				$email = $this->Groups_cc_email_model->getmailprofe($colegio[0], $colegio[1], 3);
		    	if(!empty($email)){
		    	    $this->enviar($email, $caso);
		    	}
		    	//FIN NOITIFICAR
        		$this->view_handler->view('dupla/drvz', 'act32fin', $this->data);
			}
			//boton guardar
			if($this->input->post('finalizar') == '2'){
				$derivacion = array(
	        		'estado_act' => "1",
	        	);
	        	$this->Derivaciones_model->update($derivacion, array('id' => $id_drvz));
	        	$this->view_handler->view('dupla/drvz', 'act32guardado', $this->data);
			}
        }
	}

	public function duplaContinuar($id_caso = null, $id_drvz = null){
		if(!$this->ion_auth->in_group(8)) redirect(site_url('Inicio'), 'location');
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
			'name' => 'Tercera Actividad: Trabajos de fortalecimientos'
		);
		$this->data['id_drvz'] = $id_drvz;
		$this->data['etapa'] = 3;
		$this->data['tipo'] = 5;

		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$this->data['components'] = $components;

		$derivacione = $this->Derivaciones_model->get('*', array('id' => $id_drvz));
		$this->data['estado_act'] = $derivacione[0]->estado_act;
		$derivacion32 = $this->Derivacion32_model->get('*', array('id_derivacion' => $id_drvz))[0];

		$this->data['p1resp'] = $derivacion32->info_entregada;
		$this->data['p2resp'] = $derivacion32->enviada;
		$this->data['p3resp'] = $derivacion32->info_recibida;
		$this->data['p4resp'] = $derivacion32->recibida;
		$this->data['vocacion'] = $derivacion31->vocacion;
		$this->data['perfil'] = $derivacion31->perfil;
		$this->data['talento1'] = $derivacion31->talento1;
		$this->data['talento2'] = $derivacion31->talento2;
		$this->data['talento3'] = $derivacion31->talento3;
		$this->data['talento4'] = $derivacion31->talento4;
		$this->data['talento5'] = $derivacion31->talento5;
		$this->data['habilidad1'] = $derivacion31->habilidad1;
		$this->data['habilidad2'] = $derivacion31->habilidad2;
		$this->data['habilidad3'] = $derivacion31->habilidad3;
		$this->data['habilidad4'] = $derivacion31->habilidad4;
		$this->data['habilidad5'] = $derivacion31->habilidad5;
		$this->view_handler->view('dupla/drvz', 'act32ingresar', $this->data);
	}

	public function createpdf($casos = null, $derivacion32 = null){
		require_once("files/Reportes/plantillas/Reporte/index-derivacionA32.php");
		date_default_timezone_set("America/Santiago");
		$hoy = date('Y-m-d');
		$html = getPlantilla($casos, $derivacion32, $hoy);
    	$pdfFilePath = "Derivación Red externa ".$derivacion32['id_derivacion']." ".$casos[2]." ".$casos[3].".pdf";
	    $estilos = file_get_contents('files/Reportes/plantillas/Reporte/style.css');
		$mpdf = new mpdf('c');
	    $mpdf->setDisplayMode('fullpage'); 
		$mpdf->WriteHTML($estilos,1);
	    $mpdf->WriteHTML($html,2);
	    ob_clean();
	    $ruta = "files/Reportes/drvz/dupla/".$pdfFilePath;
	    $mpdf->Output($ruta, 'F');
	}

	public function createfracc($casos = null, $derivacion32 = null, $nombre = null){
		require_once("./files/Reportes/plantillas/Reporte/fracA32.php");
		date_default_timezone_set("America/Santiago");
		$hoy = date('Y-m-d');
		$htmlfrac = fraccion($derivacion32, $nombre, $hoy);	
    	$file = $derivacion32['id_derivacion']."_".$casos[2]."fracA32.pdf";
    	$estilos = file_get_contents('files/Reportes/plantillas/Reporte/style.css'); 
		$mpdfcarac = new mpdf('c');
	    $mpdfcarac->setDisplayMode('fullpage'); 
		$mpdfcarac->WriteHTML($estilos,1);
	    $mpdfcarac->WriteHTML($htmlfrac,2);  
	    ob_clean();
	    $rutafile = "files/Reportes/drvz/Usuario1/".$file;
	    $mpdfcarac->Output($rutafile, 'F');
	    $id_drvz = $derivacion32['id_derivacion'];
	    $this->merge($casos, $id_drvz);
	}

	public function merge($casos = null, $id_drvz = null){
		$pdf1 = './files/Reportes/drvz/Usuario1/'.$id_drvz.'_'.$casos[2].'_2drvz.pdf';
		$pdf2 = './files/Reportes/drvz/Usuario1/'.$id_drvz.'_'.$casos[2].'fracA32.pdf';
		
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
		$file = 'Derivación por convivencia RED EXTERNA '.$id_drvz.' '.$casos[2].'.pdf';
        $ruta = "files/Reportes/drvz/Usuario1/".$file;

		$pdf->Output($ruta);
		unlink($pdf1);
		unlink($pdf2);
	}

	public function createhabytal($caso = null, $id = null, $habytal = null){
		require_once("files/Reportes/plantillas/Reporte/habytal_deriv3.php");
		date_default_timezone_set("America/Santiago");
		$hoy = date('Y-m-d');
		$html = Plantilla($caso, $hoy, $id, $habytal);
    	$pdfFilePath = 'Derivación '.$id.' por Red externa '.$caso[2].' '.$hoy.'.pdf';
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
		$mail->Subject = 'Notificación de finalización de proceso de derivación';
		$mail->MsgHTML('Ha concluido el proceso de derivación del caso: '.$caso[2].' '.$caso[3].' '.$caso[4].'. Se ha generado un documento a partir del proceso completo.');
		$mail->CharSet = 'UTF-8';
		$mail->send();
	}
}