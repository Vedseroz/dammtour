<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	private $data = array();

	
    public function __construct() 
    {
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
				'name' => 'Inicio',
				'link' =>  site_url('inicio/index')
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
		$this->data['menu_items'] = array(
			'inicio'
		);
		$this->load->model('Proced_caso_model');
		$this->load->model('Deriva_caso_model');


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

		if($this->ion_auth->in_group(7)){
			$this->data['avatar'] = 'apoderado.png';
			$this->data['avatar_descrip'] = 'Imagen avatar apoderado';
			$this->data['avatar_nombre'] = 'Apoderado';
		}

		if($this->ion_auth->in_group(8)){
			$this->data['avatar'] = 'avatar3.png';
			$this->data['avatar_descrip'] = 'Imagen avatar dupla';
			$this->data['avatar_nombre'] = 'Dupla Psicosocial';
		}

		if($this->ion_auth->in_group(9)){
			$this->data['avatar'] = 'alum.jpg';
			$this->data['avatar_descrip'] = 'Imagen avatar Usuario 2';
			$this->data['avatar_nombre'] = 'Usuario 2';
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
		if($this->ion_auth->in_group(1)) {
			$this->load->model('Users_model');
			$this->load->model('Casos_model');
			$this->load->model('Colegios_model');
			$this->load->model('Cursos_model');
			$this->data['ncasos'] = $this->casos_model->count_all();
			$this->data['nProfesores'] = $this->Users_model->count_all() - $this->data['ncasos'] * 2;
			$this->data['nColegios'] = $this->Colegios_model->count_all();
			$this->data['nCursos'] = $this->Cursos_model->count_all();
			
			$this->view_handler->view('administrador', 'inicio', $this->data);
		}
		if($this->ion_auth->in_group(3)){
			$this->view_handler->view('Usuario1', 'inicio', $this->data);
		}
		if($this->ion_auth->in_group(4)){
			$$this->data['colegio_nombre'] = 'CMV';
			$this->view_handler->view('orientador', 'inicio', $this->data);
		}
		if($this->ion_auth->in_group(5)){
			$this->data['colegio_nombre'] = 'CMV';
			$this->view_handler->view('PIE', 'inicio', $this->data);
		}
		if($this->ion_auth->in_group(6)){
			$this->data['colegio_nombre'] = 'CMV';
			$this->view_handler->view('comite', 'inicio', $this->data);
		}

		if($this->ion_auth->in_group(7)){
			$this->data['colegio_nombre'] = 'CMV';
			$this->view_handler->view('apoderado', 'inicio', $this->data);
		}

		if($this->ion_auth->in_group(8)){
			$this->data['colegio_nombre'] = 'CMV';
			$this->view_handler->view('dupla', 'inicio', $this->data);
		}

		if($this->ion_auth->in_group(9)){
			$this->data['colegio_nombre'] = 'CMV';
			$this->view_handler->view('Usuario2', 'inicio', $this->data);
		}
		
	}

	public function getProcedimientos() {
		if($this->ion_auth->in_group(3)){
			$data = $this->Proced_caso_model->data_colegio();
			echo json_encode($data);
			return;
		}

		if($this->ion_auth->in_group(5)){
			$data = $this->Proced_caso_model->data_colegioPIE();
			echo json_encode($data);
			return;
		}
		if($this->ion_auth->in_group(6)){
			$data = $this->Proced_caso_model->data_colegioCC();
			echo json_encode($data);
			return;
		}
		if($this->ion_auth->in_group(7)){
			$data = $this->Proced_caso_model->data_colegioA();
			echo json_encode($data);
			return;
		}

		if($this->ion_auth->in_group(9)){
			$data = $this->Proced_caso_model->data_colegio2("Usuario 2");
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

    public function getcasosDrvz() {
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

    public function getcasosDrvzOrientador() {
    	if($this->ion_auth->in_group(4)){
    		$data = $this->Deriva_caso_model->data_colegioO();
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
		$mail->Username = "acomitil@cmvalparaiso.cl";											//CORREO DE NOTIFICACIONES
		$mail->Password = "cmvzsexdr";															//CONTRASEÑA DE DICHO CORREO
		$mail->setFrom('acomitil@cmvalparaiso.cl', 'Notificación Acomitil');					//NOMBRE Y CORREO DE ENVÍO
		/*
		$mail->Username = "notificaciones.td@cmvalparaiso.cl";											//CORREO DE NOTIFICACIONES
		$mail->Password = "td456CMV";															//CONTRASEÑA DE DICHO CORREO
		$mail->setFrom('notificaciones.td@cmvalparaiso.cl', 'Notificación Acomitil');					//NOMBRE Y CORREO DE ENVÍO
		*/
		$mail->addAddress('jortizd@cmvalparaiso.cl');												//AGREGA DIRECCIONES PRINCIPALES
		$mail->Subject = 'Inicio de Procedimiento';								//ASUNTO
		$mail->MsgHTML('Ha comenzado el Procedimiento, ingresa al sistema para completar el formulario.');//MENSAJE, PUEDE USAR html
		$mail->CharSet = 'UTF-8';
		if($mail->send()){
			echo 'Todo bien';
		} else {
			echo 'Todo mal';
		}
	}
}