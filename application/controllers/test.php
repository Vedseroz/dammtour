<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class test extends CI_Controller {
	private $data = array();
	private $filebase;
	
    public function __construct(){
		parent::__construct();
		// Session
	    $this->ion_auth->redirectLoginIn();
	    // Config

	    // Models
	    $this->load->model('casos_model');
	    $this->load->model('En_colegio_model');
	    $this->load->model('En_curso_model');
	    $this->load->model('Colegios_model');
	    $this->load->model('Cursos_model');
	    $this->load->model('Actividad1_cursos_repetidos_model');
	    $this->load->model('Actividad1_colegio_anterior_model');
	    $this->load->model('procedimientoses_model');
	    $this->load->model('Actividad1d_model');
	    $this->load->model('Actividad1dtest_model');
	    $this->load->model('Users_model');//NUEVO
	    // Libraries
	    $this->load->library('upload');
	    $this->load->library('mpdf');
	    // Helpers
	    $this->load->helper(array('date','download', 'file', 'html'));
    	// View data
		$this->data['breadcrumb'] = array(
			array(
				'name' => 'Pruebas',
				'link' =>  site_url('test/index')
			)
		);
		$this->load->helper('array');
    }

	public function index(){
		echo 'Holoa Mundo';
		//$this->view_handler->view('test', 'upload', $this->data);
	}
	
	public function createpdf($casos = null, $id_procedimientos = null, $actividad1d = null, $listaTest = null, $listaColegios = null, $listaCursos = null, $id_caso = null){
		require_once("./files/Reportes/plantillas/Reporte/index.php"); 							//LLAMADO A LA PLANTILLA
		date_default_timezone_set("America/Santiago");
		$hoy = date('Y-m-d');
		$html = getPlantilla($casos, $id_procedimientos, $actividad1d, $hoy, $listaTest, $listaColegios, $listaCursos, $id_caso);
    	$pdfFilePath = $id_procedimientos."_".$casos['nombres']."_temp.pdf";				//NOMBRE DEL ARCHIVO
	    $estilos = file_get_contents('files/Reportes/plantillas/Reporte/style.css'); 			//CSS DEL ARCHIVO
	    $mpdf = new mpdf('c');
	    $mpdf->setDisplayMode('fullpage');
	    $mpdf->WriteHTML($estilos,1);
	    $mpdf->WriteHTML($html,2);
	    ob_clean();
	    $ruta = "files/Reportes/crtz/Usuario1/".$pdfFilePath;								//RUTA DONDE GUARDA EL ARCHIVO
	    $mpdf->Output($ruta, 'F'); 														        //CREA EL DOCUMENTO Y GUARDA EN LA RUTA.
	}
	
	
	public function correotest(){
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
		//$mail->Username = "acomitil@cmvalparaiso.cl";											//CORREO DE NOTIFICACIONES
		//$mail->Password = "cmvzsexdr";															//CONTRASEÑA DE DICHO CORREO
		//$mail->setFrom('acomitil@cmvalparaiso.cl', 'Notificación Acomitil');					//NOMBRE Y CORREO DE ENVÍO
		
		$mail->Username = "notificaciones.td@cmvalparaiso.cl";											//CORREO DE NOTIFICACIONES
		$mail->Password = "td456CMV";															//CONTRASEÑA DE DICHO CORREO
		$mail->setFrom('notificaciones.td@cmvalparaiso.cl', 'Notificación Acomitil');					//NOMBRE Y CORREO DE ENVÍO
		
		$mail->addAddress('jortizd@cmvalparaiso.cl');												//AGREGA DIRECCIONES PRINCIPALES
		$mail->Subject = 'Inicio de Procedimiento';								//ASUNTO
		$mail->MsgHTML('Ha comenzado el Procedimiento, ingresa al sistema para completar el formulario.');//MENSAJE, PUEDE USAR html
		$mail->CharSet = 'UTF-8';
		$mail->send();
		
	}
}