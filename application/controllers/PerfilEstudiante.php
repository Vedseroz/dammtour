<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfilcaso extends CI_Controller {
	private $data = array();
	private $filebase;
	
    public function __construct() 
    {
		parent::__construct();
		// Session
	    $this->ion_auth->redirectLoginIn();
	    // Config
	    // Models
	    //Crear el archivos en carpeta model con nombre reemplazante_model
	    $this->load->model('casos_model');
	    $this->load->model('Derivaciones_model');
	    $this->load->model('Derivacion1_model');
	    $this->load->model('En_colegio_model');
	    $this->load->model('En_curso_model');
	    $this->load->model('Derivacion11_model');
	    $this->load->model('Derivacion21_model');
	    $this->load->model('Derivacion22_model');
	    $this->load->model('Derivacion31_model');
	    $this->load->model('Derivacion32_model');
	    $this->load->model('Procedimientoses_model');
	    $this->load->model('Colegios_model');
	    $this->load->model('Cursos_model');
	    $this->load->model('Info_familiar_model');
	    $this->load->model('Hermanos_model');
	    $this->load->model('Actividad1d_model');
	    $this->load->model('Actividad1dtest_model');
	    $this->load->model('Actividad1_cursos_repetidos_model');
	    $this->load->model('Actividad1_colegio_anterior_model');
	    $this->load->model('Actividad2d_model');
	    $this->load->model('Actividad3d_model');
	    $this->load->model('actividad3dapoyos_model');
	    $this->load->model('Actividad4d_model');
	    $this->load->model('Actividad5d_model');
	    $this->load->model('Notas_model');
	    // Libraries
	    // Helpers
	    $this->load->helper('date');
	    $this->load->helper('directory');
	    $this->load->helper('download');

    	// View data
		$this->data['breadcrumb'] = array(
			array(
				'name' => 'Perfil caso',
				'link' =>  site_url('Perfilcaso/index')
			)
		);
		$this->data['menu_items'] = array(
			'perfil_caso'
		);
		
		$this->load->helper('array');

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
			$this->data['avatar'] = 'dupla.png';
			$this->data['avatar_descrip'] = 'Imagen avatar dupla';
			$this->data['avatar_nombre'] = 'Dupla Psicosocial';
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
		// View data
		//$this->data['title'] = 'Procedimientos';
		//$this->data['subtitle'] = 'Iniciar';
		/*
		$this->data['breadcrumb'][] = array(
			'name' => 'Buscar caso',
		);
		*/
		//$this->data['menu_items'][] = 'list';
		redirect('perfilcaso/buscar', 'buscar');
		//$this->view_handler->view('inicio', 'main', $this->data);
	}

	public function buscar(){
		// View data
		//$this->data['title'] = 'Ver ';
		//$this->data['subtitle'] = 'Iniciar';
		$this->data['breadcrumb'][] = array(
			'name' => 'Buscar caso',
		);
		
		//$this->data['menu_items'][] = 'list';
		
		$this->view_handler->view('perfilcaso', 'buscar', $this->data);
	}

	public function mostrar($id_caso = null){
		if($this->ion_auth->in_group(7)) {
			$id_caso = $this->session->userdata["sector"];
		}
		if($this->ion_auth->in_group(9)) {
			$id_caso = $this->casos_model->casoporid($this->session->userdata["user_id"]);
		}
		$components = new stdClass();

		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];
			// View data
			//$this->data['title'] = 'Ver ';
			//$this->data['subtitle'] = 'Iniciar';

			$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
			$this->data['breadcrumb'][] = array(
				'name' => 'Buscar caso',
				'link' =>  site_url('Perfilcaso/buscar')
				);
			$this->data['breadcrumb'][] = array(
				'name' => 'Perfil seleccionado: ' .$this->data['caso'][0]->nombres ,
			);
			$this->data['colegio'] = 'CMV';

			$id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
			$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso));
			
			//$this->data['menu_items'][] = 'list';
			$this->data['menuPEselect'] = 1;
			$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
			$components->menuPE = $this->load->view('components/perfilcaso/menuPE', $this->data, true);


			$this->data['components'] = $components;
			$this->view_handler->view('perfilcaso', 'mostrar', $this->data);
	}

	public function infoPersonal($id_caso = null){
		if($this->ion_auth->in_group(7)) $id_caso = $this->session->userdata["sector"];
		if($this->ion_auth->in_group(9)) {
			$id_caso = $this->casos_model->casoporid($this->session->userdata["user_id"]);
		}
		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

			$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
			$this->data['breadcrumb'][] = array(
				'name' => 'Buscar caso',
				'link' =>  site_url('Perfilcaso/buscar')
				);
			$this->data['breadcrumb'][] = array(
				'name' => 'Perfil seleccionado: ' .$this->data['caso'][0]->nombres ,
			);
			
			$this->data['colegio'] = 'CMV';
			
			$id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
			$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso));

			$this->data['info_familiar'] = $this->Info_familiar_model->get('*', array('id_caso' => $id_caso));
			if(!empty($this->data['info_familiar'])) $this->data['hermanos'] = $this->Hermanos_model->get('*', array('id_info_familiar' => $this->data['info_familiar'][0]->id));
			else $this->data['hermanos'] = null;

			$components = new stdClass();
			$this->data['menuPEselect'] = 2;
			$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
			$components->menuPE = $this->load->view('components/perfilcaso/menuPE', $this->data, true);
			$this->data['components'] = $components;
			
			$this->view_handler->view('perfilcaso', 'mostrarPersonal', $this->data);
	}

    public function getNumeroSeguimientos(){
    	$id_caso = $_POST["id_caso"];
    	
    	$tipo1 = $this->procedimientoses_model->count_all( array('id_caso' => $id_caso, 'estado' => 'FINALIZADO'));
    	$tipo2 = $this->Derivaciones_model->count_all( array('id_caso' => $id_caso, 'tipo' => 1, 'estado' => 'FINALIZADO'));
    	$tipo3 = $this->Derivaciones_model->count_all( array('id_caso' => $id_caso, 'tipo' => 3, 'estado' => 'FINALIZADO'));
    	$tipo4 = $this->Derivaciones_model->count_all( array('id_caso' => $id_caso, 'tipo' => 4, 'estado' => 'FINALIZADO'));
    	$tipo5 = $this->Derivaciones_model->count_all( array('id_caso' => $id_caso, 'tipo' => 5, 'estado' => 'FINALIZADO'));
		echo json_encode(array($tipo1, $tipo2,$tipo3, $tipo4, $tipo5));
		
    }

	public function infoAcademica($id_caso = null){
		if($this->ion_auth->in_group(7)){
		     $id_caso = $this->session->userdata["sector"];
		}
		if($this->ion_auth->in_group(9)) {
			$id_caso = $this->casos_model->casoporid($this->session->userdata["user_id"]);
		}
		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

		$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
		$this->data['breadcrumb'][] = array(
			'name' => 'Buscar caso',
			'link' =>  site_url('Perfilcaso/buscar')
			);
		$this->data['breadcrumb'][] = array(
			'name' => 'Perfil seleccionado: ' .$this->data['caso'][0]->nombres
		);
			
		$this->data['colegio'] = 'CMV';

		$id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
		$newdata = array(
	        'cursoFiltro'  => $id_curso
		);
    	$this->session->set_userdata($newdata);
		$this->data['cursos'] = $this->En_curso_model->get('*', array('id_caso' => $id_caso));
		foreach ($this->data['cursos'] as $key => $value) {
			$nombreCurso = $this->Cursos_model->get('*', array('id' => $value->id_curso))[0]->nombre;
			$value = (array)$value;
			$value['nombre'] = $nombreCurso;
			$this->data['cursos'][$key] = (object)$value;
		}
		$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso));
			
		//$this->data['menu_items'][] = 'list';
		$components = new stdClass();
		$this->data['menuPEselect'] = 3;
		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$components->menuPE = $this->load->view('components/perfilcaso/menuPE', $this->data, true);
		$this->data['components'] = $components;
		$notas_lenguaje = $this->Notas_model->get('*', array('id_caso' => $id_caso, 'id_curso' => $id_curso, 'id_materia' => '4'),null,null,'fecha DESC');
    	$notasL = [];
    	foreach ($notas_lenguaje as $key => $value) {
    		$notasL[] = $value->nota;
    	}
    	$notas_matematicas = $this->Notas_model->get('*', array('id_caso' => $id_caso, 'id_curso' => $id_curso, 'id_materia' => '5'),null,null,'fecha DESC');
    	$notasM = [];
    	foreach ($notas_matematicas as $key => $value) {
    		$notasM[] = $value->nota;
    	}
    	if(count($notasL) > count($notasM)) $this->data['labelSize'] = count($notasL);
    		else $this->data['labelSize'] = count($notasM);
		$this->data['notas'] = json_encode(array($notasL, $notasM));
		$this->view_handler->view('perfilcaso', 'mostrarAcademica', $this->data);
	}


	public function ajaxNotas(){
    	$id_caso = $_POST["id_caso"];								
    	$materia = $_POST["materia"];											
    	$estado = $_POST["std"];
    	$id_curso = $this->session->userdata('cursoFiltro');
    	switch ($materia) {
    		case '0':
    			echo json_encode(array(array(44,55,65,31,45,51), array(31,55,44,51,65,44,45)));
    			break;
    		case '1':
    			$notasH = $this->Notas_model->get('*', array('id_caso' => $id_caso, 'id_curso' => $id_curso, 'id_materia' => '1'),null,null,'fecha DESC');
    			$notas = [];
    			foreach ($notasH as $key => $value) {
    				$notas[] = $value->nota;
    			}
    			echo json_encode($notas);
    			break;
    		case '2':
    			$notasC = $this->Notas_model->get('*', array('id_caso' => $id_caso, 'id_curso' => $id_curso, 'id_materia' => '2'),null,null,'fecha DESC');
    			$notas = [];
    			foreach ($notasC as $key => $value) {
    				$notas[] = $value->nota;
    			}
    			echo json_encode($notas);
    			break;
    		case '3':
    			$notasI = $this->Notas_model->get('*', array('id_caso' => $id_caso, 'id_curso' => $id_curso, 'id_materia' => '3'),null,null,'fecha DESC');
    			$notas = [];
    			foreach ($notasI as $key => $value) {
    				$notas[] = $value->nota;
    			}
    			echo json_encode($notas);
    			break;
    		case '4':
    			$notas_lenguaje = $this->Notas_model->get('*', array('id_caso' => $id_caso, 'id_curso' => $id_curso, 'id_materia' => '4'),null,null,'fecha DESC');
    			$notasL = [];
    			foreach ($notas_lenguaje as $key => $value) {
    				$notasL[] = $value->nota;
    			}
    			echo json_encode($notasL);
    			break;
    		case '5':
    			$notasM = $this->Notas_model->get('*', array('id_caso' => $id_caso, 'id_curso' => $id_curso, 'id_materia' => '5'),null,null,'fecha DESC');
    			$notas = [];
    			foreach ($notasM as $key => $value) {
    				$notas[] = $value->nota;
    			}
    			echo json_encode($notas);
    			break;
    		
    		default:
    			# code...
    			break;
    	}	
    }

    public function ajaxSetCurso(){
    	$id_curso = $_POST["id_curso"];
    	$newdata = array(
	        'cursoFiltro'  => $id_curso
		);
    	$this->session->set_userdata($newdata);
    }

    public function ajaxIngresarNotas(){
    	$id_caso = $_POST["id_caso"];
    	$idMateria = $_POST["materia"];
    	$nota = $_POST["nota"];
    	$id_curso = $this->session->userdata('cursoFiltro');
    	$calificacion = array(
    		'id_materia' => $idMateria,
    		'nota' => $nota, 
    		'ponderacion' => 100,
    		'id_caso' => $id_caso,
    		'id_curso' => $id_curso,
    		'fecha' => date('Y-m-d'),
    	);
    	$this->Notas_model->add($calificacion);
    	echo json_encode(true);
    	return;
    }


    public function seguimientos($id_caso = null){
    	if($this->ion_auth->in_group(7)) $id_caso = $this->session->userdata["sector"];
		if($this->ion_auth->in_group(9)) {
			$id_caso = $this->casos_model->casoporid($this->session->userdata["user_id"]);
		}
    	$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

		
			$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
			$this->data['breadcrumb'][] = array(
				'name' => 'Buscar caso',
				'link' =>  site_url('Perfilcaso/buscar')
				);
			$this->data['breadcrumb'][] = array(
				'name' => 'Perfil seleccionado: ' .$this->data['caso'][0]->nombres ,
			);
			
			$this->data['colegio'] = 'CMV';
			
			$id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
			$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso));
			
			//$this->data['menu_items'][] = 'list';
			$components = new stdClass();
			$this->data['menuPEselect'] = 4;
			$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
			$components->menuPE = $this->load->view('components/perfilcaso/menuPE', $this->data, true);
			$this->data['components'] = $components;
			$this->view_handler->view('perfilcaso', 'mostrarSeguimientos', $this->data);
		}

	public function getprocedimientoses($id_caso){
	
		$data = $this->procedimientoses_model->datatable($id_caso);
		echo json_encode($data);
    }

    public function getDerivaciones($id_caso){
		
		$data = $this->Derivaciones_model->datatable($id_caso);
		echo json_encode($data);
    }

    public function mostrarprocedimientos($id_caso = null, $id_proc = null, $etapa = null){
    	if($this->ion_auth->in_group(7)) $id_caso = $this->session->userdata["sector"];
		if($this->ion_auth->in_group(9)) {
			$id_caso = $this->casos_model->casoporid($this->session->userdata["user_id"]);
		}
    	$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

		$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
		$this->data['colegio'] = 'CMV';
		$id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
		$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso));
		$this->data['breadcrumb'][] = array(
				'name' => 'Buscar caso',
				'link' =>  site_url('Perfilcaso/buscar')
			);
		$this->data['breadcrumb'][] = array(
				'name' => 'Perfil seleccionado: ' .$this->data['caso'][0]->nombres ,
			);
		$this->data['id_proc'] = $id_proc;
		$components = new stdClass();
		$this->data['menuPEselect'] = 4;
		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$components->menuPE = $this->load->view('components/perfilcaso/menuPE', $this->data, true);

		if($this->ion_auth->in_group(9) and $etapa <> 2) $etapa = 2;
		if($this->ion_auth->in_group(5) and $etapa <> 3) $etapa = 3;
		if($this->ion_auth->in_group(6) and $etapa <> 4) $etapa = 4;
		if($this->ion_auth->in_group(7) and $etapa <> 5) $etapa = 5;
		if($etapa == 1){
			$this->data['menuDPEselect'] = 1;
			$this->data['tituloMenuDPE'] = "Primera Actividad: Informacion básica";
			$components->menuDPE = $this->load->view('components/perfilcaso/procedimientos/menuDPE', $this->data, true);
			$this->data['components'] = $components;
			$this->data['colegios_anteriores'] = $this->Actividad1_colegio_anterior_model->get('*', array('id_procedimientos' => $id_proc));
			$this->data['cursos_repetidos'] = $this->Actividad1_cursos_repetidos_model->get('*', array('id_procedimientos' => $id_proc));
			$this->data['actividad1d'] = $this->Actividad1d_model->get('*', array('id_procedimientos' => $id_proc));
			$this->data['actividad1dtest'] = $this->Actividad1dtest_model->get('*', array('id_derivacion' => $id_proc));
			$downloadPath = './files/proc/'.$id_proc.'/act1/';
			$this->data['archivos'] = directory_map($downloadPath,1);
			$this->view_handler->view('perfilcaso', 'procedimientos/act1', $this->data);
		}

			if($etapa == 2){
				$this->data['menuDPEselect'] = 2;
				$this->data['tituloMenuDPE'] = "Segunda Actividad: Información Autobiográfica";
				$components->menuDPE = $this->load->view('components/perfilcaso/procedimientos/menuDPE', $this->data, true);
				$this->data['components'] = $components;
				$this->data['actividad2d'] = $this->Actividad2d_model->get('*', array('id_procedimientos' => $id_proc));

				$downloadPath = './files/proc/'.$id_proc.'/act2/dox/';
				$this->data['archivos'] = directory_map($downloadPath,1);

				$downloadPath = './files/proc/'.$id_proc.'/act2/audio/';
				$this->data['archivos2'] = directory_map($downloadPath,1);
				$this->view_handler->view('perfilcaso', 'procedimientos/act2', $this->data);
			}

			if($etapa == 3){
				$this->data['menuDPEselect'] = 3;
				$this->data['tituloMenuDPE'] = "Tercera Actividad: Información de Habilidades";
				$components->menuDPE = $this->load->view('components/perfilcaso/procedimientos/menuDPE', $this->data, true);
				$this->data['components'] = $components;
				$this->data['actividad3d'] = $this->Actividad3d_model->get('*', array('id_procedimientos' => $id_proc));
				$this->data['actividad3dapoyos'] = $this->actividad3dapoyos_model->get('*', array('id_procedimientos' => $id_proc));
				$this->view_handler->view('perfilcaso', 'procedimientos/act3', $this->data);
			}

			if($etapa == 4){
				$this->data['menuDPEselect'] = 4;
				$this->data['tituloMenuDPE'] = "Cuarta Actividad: Información de conducta";
				$components->menuDPE = $this->load->view('components/perfilcaso/procedimientos/menuDPE', $this->data, true);
				$this->data['components'] = $components;
				$this->data['actividad4d'] = $this->Actividad4d_model->get('*', array('id_procedimientos' => $id_proc));
				$this->view_handler->view('perfilcaso', 'procedimientos/act4', $this->data);
			}

			if($etapa == 5){
				$this->data['menuDPEselect'] = 5;
				$this->data['tituloMenuDPE'] = "Quinta Actividad: Descripción familiar";
				$components->menuDPE = $this->load->view('components/perfilcaso/procedimientos/menuDPE', $this->data, true);
				$this->data['components'] = $components;
				$this->data['actividad5d'] = $this->Actividad5d_model->get('*', array('id_procedimientos' => $id_proc));
				$this->view_handler->view('perfilcaso', 'procedimientos/act5', $this->data);
			}
		}
    
	public function mostrarDerivacion($id_caso = null, $id_drvz = null, $etapa = null){
		if($this->ion_auth->in_group(7)) $id_caso = $this->session->userdata["sector"];
		if($this->ion_auth->in_group(9)) {
			$id_caso = $this->casos_model->casoporid($this->session->userdata["user_id"]);
		}
		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

		$this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
		$this->data['colegio'] = 'CMV';
			

			$id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
			$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso));
		$this->data['breadcrumb'][] = array(
			'name' => 'Buscar caso',
			'link' =>  site_url('Perfilcaso/buscar')
			);
		$this->data['breadcrumb'][] = array(
			'name' => 'Perfil seleccionado: ' .$this->data['caso'][0]->nombres ,
		);
		$this->data['id_drvz'] = $id_drvz;
		$derivacione = $this->Derivaciones_model->get('*', array('id' => $id_drvz));
		$this->data['tipo'] = $derivacione[0]->tipo;
		$this->data['etapa'] = $derivacione[0]->etapa;

		$components = new stdClass();
		$this->data['menuPEselect'] = 4;
		$components->infoBasica = $this->load->view('infoBasica', $this->data, true);
		$components->menuPE = $this->load->view('components/perfilcaso/menuPE', $this->data, true);
		$this->data['components'] = $components;

		if($etapa > 0  && $etapa < 10){
			$derivacion1temp = $this->Derivacion1_model->get('*', array('id_derivacion' => $id_drvz));
			if($derivacion1temp[0]->responsable == 1){
				$derivacion1temp[0]->responsable = 'Orientador';
			}
			if($derivacion1temp[0]->responsable == 2){
				$derivacion1temp[0]->responsable = 'C. Convivencia';
			}
			$this->data['derivacion1'] = $derivacion1temp;
			$this->view_handler->view('perfilcaso', 'derivacion/A', $this->data);
		}

		if($etapa == 11){
			$this->data['derivacion11'] = $this->Derivacion11_model->get('*', array('id_derivacion' => $id_drvz));
			$this->view_handler->view('perfilcaso', 'derivacion/A11', $this->data);
		}

		if($etapa == 21){
			$this->data['derivacion21'] = $this->Derivacion21_model->get('*', array('id_derivacion' => $id_drvz));
			$this->view_handler->view('perfilcaso', 'derivacion/A21', $this->data);
		}

		if($etapa == 22){
			$downloadPath = './files/drvz/'.$id_drvz.'/act3/';
			if(!empty(directory_map($downloadPath,1))) $this->data['archivoDox'] = directory_map($downloadPath,1)[0];
			$this->data['derivacion22'] = $this->Derivacion22_model->get('*', array('id_derivacion' => $id_drvz));
			$this->view_handler->view('perfilcaso', 'derivacion/A22', $this->data);
		}

		if($etapa == 23){
			$downloadPath = './files/drvz/'.$id_drvz.'/act5/dox/';
			if(!empty(directory_map($downloadPath,1))) $this->data['archivoDox'] = directory_map($downloadPath,1)[0];
			$this->view_handler->view('perfilcaso', 'derivacion/A23', $this->data);
		}

		if($etapa == 31){
			$this->data['derivacion31'] = $this->Derivacion31_model->get('*', array('id_derivacion' => $id_drvz));	
			$this->view_handler->view('perfilcaso', 'derivacion/A31', $this->data);
		}

		if($etapa == 32){
			$this->data['derivacion32'] = $this->Derivacion32_model->get('*', array('id_derivacion' => $id_drvz));;
			$this->view_handler->view('perfilcaso', 'derivacion/A32', $this->data);
		}	
	}

	public function downloadDrvz23($id_drvz = null, $name = null){
		$downloadPath = './files/drvz/' .$id_drvz. '/act5/dox/';		
		$map = directory_map($downloadPath,1);
		if(!empty($map[0])){
			$downloadPath = $downloadPath . $map[0];
			force_download($downloadPath, NULL);
		}
	}
}