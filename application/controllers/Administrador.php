<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {
	private $data = array();
	
    public function __construct() 
    {
		parent::__construct();
		// Session
	   	$this->ion_auth->redirectLoginIn();
	    if(!$this->ion_auth->in_group(1)) redirect(site_url('Inicio'), 'location');
	    $this->login = $this->ion_auth->loginIn();
	    // Config
	    // Models
	    $this->load->model('Colegios_model');
	    $this->load->model('Cursos_model');
	    $this->load->model('casos_model');
	    $this->load->model('En_colegio_model');
	    $this->load->model('En_curso_model');
	    $this->load->model('Users_model');
	    // Libraries
	    $this->load->library('excel');
	    $this->load->library('upload');
	    $this->load->library('mpdf');
	    // Helpers
	    $this->load->helper(array('download', 'file', 'html'));
    	// View data

	    // Helpers
	    $this->load->helper('date');
	    $this->load->helper('array');
	    $this->load->helper('directory');
    	// View data
		$this->data['breadcrumb'] = array(
			array(
				'name' => 'Administrador',
				'link' =>  site_url('Administrador/index')
			)
		);
		$this->data['errors'] = array();
		if($this->ion_auth->in_group(1)){
			$this->data['avatar'] = 'boss.png';
			$this->data['avatar_descrip'] = 'Imagen avatar admin';
			$this->data['avatar_nombre'] = 'Administrador';
		}
		if($this->ion_auth->in_group(array(1,2,3,4,5,6,7,8))){
			$idCuenta = $this->session->userdata('user_id');
			$uploadPath = './files/avatar/cuentas/' .$idCuenta. '/';
			$map = directory_map($uploadPath,1);
			if(!empty($map)) $this->data['avatarP'] = 'files/avatar/cuentas/' .$idCuenta. '/'. $map[0];
		}
    }

	public function index()	{
		$this->data['message'] = $this->session->flashdata('message');
		if($this->ion_auth->in_group(1)) $this->view_handler->view('administrador', 'inicio', $this->data);
			else redirect(site_url('Inicio'), 'location');
	}

	//Administracion de educadores y profecionales
	public function educadores(){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores'
		);
		$this->data['messages'] = $this->session->flashdata('messages');
		$this->view_handler->view('administrador', 'educadores/inicio', $this->data);
	}

	public function createAdmin(){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Crear cuenta admin general'
		);

		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');

		$config = array(
			array(
				'field' => 'username',
				'label' => '<b>Nombre de Usuario</b>',
				'rules' => 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']'
			),
			array(
				'field' => 'password',
				'label' => '<b>Contraseña</b>',
				'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordc]'
			),
			array(
				'field' => 'passwordc',
				'label' => '<b>Confirmar contraseña</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellidos',
				'label' => '<b>apellidos</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'email',
				'label' => '<b>Email</b>',
				'rules' => 'trim|valid_email'
			),
			array(
				'field' => 'phone',
				'label' => '<b>Telefono</b>',
				'rules' => 'trim'
			),
		);
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('username')) ? $this->data['username'] = $this->input->post('username') : $this->data['username'] = NULL;
			!empty($this->input->post('nombres')) ? $this->data['nombres'] = $this->input->post('nombres') : $this->data['nombres'] = NULL;
			!empty($this->input->post('apellidos')) ? $this->data['apellidos'] = $this->input->post('apellidos') : $this->data['apellidos'] = NULL;
			!empty($this->input->post('email')) ? $this->data['email'] = $this->input->post('email') : $this->data['email'] = NULL;
			!empty($this->input->post('phone')) ? $this->data['phone'] = $this->input->post('phone') : $this->data['phone'] = NULL;
			$this->view_handler->view('administrador/educadores', 'createAdmin', $this->data);
		}	else{

				$email = strtolower($this->input->post('email'));
				$identity = $this->input->post('username');
				$password = $this->input->post('password');

				$additional_data = array(
					'first_name' => $this->input->post('nombres'),
					'last_name' => $this->input->post('apellidos'),
					'phone' => $this->input->post('phone'),
				);
				$idCuenta = $this->ion_auth->register($identity, $password, $email, $additional_data, array('1'));
				$this->session->set_flashdata('messages', $this->bootstrap->alert('success', "Se creó la cuenta de administrador."));
				redirect('administrador/educadores');
			}
	}

	public function editAdmin($id){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Editar administrador'
		);
		$this->data['id'] = $id;
		$user = $this->ion_auth->user($id)->row();
		$config = array(
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellidos',
				'label' => '<b>apellidos</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'email',
				'label' => '<b>Email</b>',
				'rules' => 'trim|valid_email'
			),
			array(
				'field' => 'phone',
				'label' => '<b>Telefono</b>',
				'rules' => 'trim'
			),
		);
		if ($this->input->post('password')){
			$config[] = array(
				'field' => 'password',
				'label' => '<b>Contraseña</b>',
				'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordc]'
			);
			$config[] = array(
				'field' => 'passwordc',
				'label' => '<b>Confirmar contraseña</b>',
				'rules' => 'trim|required'
			);
		}
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('nombres')) ? $this->data['nombres'] = $this->input->post('nombres') : $this->data['nombres'] = $user->first_name;
			!empty($this->input->post('apellidos')) ? $this->data['apellidos'] = $this->input->post('apellidos') : $this->data['apellidos'] = $user->last_name;
			!empty($this->input->post('email')) ? $this->data['email'] = $this->input->post('email') : $this->data['email'] = $user->email;
			!empty($this->input->post('phone')) ? $this->data['phone'] = $this->input->post('phone') : $this->data['phone'] = $user->phone;
			$this->view_handler->view('administrador/educadores', 'editAdmin', $this->data);
		}	else{
				$additional_data = array(
					'first_name' => $this->input->post('nombres'),
					'last_name' => $this->input->post('apellidos'),
					'phone' => $this->input->post('phone'),
					'email' => $this->input->post('email'),
				);
				if ($this->input->post('password')) $additional_data['password'] = $this->input->post('password');
				if ($this->ion_auth->update($user->id, $additional_data)){
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('messages', $this->bootstrap->alert('success', "Se edito la cuenta de administrador."));
					redirect('administrador/educadores');
				}
				else{
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('messages', $this->ion_auth->errors());
					redirect('administrador/educadores');
				}
			}
	}

	public function showAdmin($id){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Ver administrador'
		);
		$user = $this->ion_auth->user($id)->row();
		$this->data['username'] = $user->username;
		$this->data['nombres'] = $user->first_name;
		$this->data['apellidos'] = $user->last_name;
		$this->data['phone'] = $user->phone;
		$this->data['email'] = $user->email;

		$this->view_handler->view('administrador/educadores', 'showAdmin', $this->data);
	}

	public function createProfeJ(){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Crear cuenta Usuario 1'
		);

		$colegios = $this->Colegios_model->get('*');
		$this->data['colegios'] = $colegios;
		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');

		$config = array(
			array(
				'field' => 'username',
				'label' => '<b>Nombre de Usuario</b>',
				'rules' => 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']'
			),
			array(
				'field' => 'password',
				'label' => '<b>Contraseña</b>',
				'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordc]'
			),
			array(
				'field' => 'passwordc',
				'label' => '<b>Confirmar contraseña</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellidos',
				'label' => '<b>apellidos</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'colegiosselect',
				'label' => '<b>Colegio</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'cursosselect',
				'label' => '<b>Curso</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'email',
				'label' => '<b>Email</b>',
				'rules' => 'trim|valid_email'
			),
			array(
				'field' => 'phone',
				'label' => '<b>Telefono</b>',
				'rules' => 'trim'
			),
		);
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('username')) ? $this->data['username'] = $this->input->post('username') : $this->data['username'] = NULL;
			!empty($this->input->post('nombres')) ? $this->data['nombres'] = $this->input->post('nombres') : $this->data['nombres'] = NULL;
			!empty($this->input->post('apellidos')) ? $this->data['apellidos'] = $this->input->post('apellidos') : $this->data['apellidos'] = NULL;
			!empty($this->input->post('email')) ? $this->data['email'] = $this->input->post('email') : $this->data['email'] = NULL;
			!empty($this->input->post('phone')) ? $this->data['phone'] = $this->input->post('phone') : $this->data['phone'] = NULL;
			!empty($this->input->post('colegiosselect')) ? $this->data['colegioSelect'] = $this->input->post('colegiosselect') : $this->data['colegioSelect'] = NULL;
			!empty($this->input->post('cursosselect')) ? $this->data['cursosSelect'] = $this->input->post('cursosselect') : $this->data['cursosSelect'] = NULL;
			$this->view_handler->view('administrador/educadores', 'createProfeJ', $this->data);
		}	else{

				$email = strtolower($this->input->post('email'));
				$identity = $this->input->post('username');
				$password = $this->input->post('password');

				$additional_data = array(
					'first_name' => $this->input->post('nombres'),
					'last_name' => $this->input->post('apellidos'),
					'phone' => $this->input->post('phone'),
					'company' => $this->input->post('colegiosselect'),
					'sector' => $this->input->post('cursosselect'),
				);
				$idCuenta = $this->ion_auth->register($identity, $password, $email, $additional_data, array('3'));
				$this->session->set_flashdata('messages', $this->bootstrap->alert('success', "Se creó la cuenta de Usuario 1."));
				redirect('administrador/educadores');
			}
	}

	public function editProfeJ($id){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Editar Usuario 1'
		);
		$this->data['id'] = $id;
		$this->data['colegios'] = $this->Colegios_model->get('*');
		$user = $this->ion_auth->user($id)->row();
		$config = array(
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellidos',
				'label' => '<b>apellidos</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'email',
				'label' => '<b>Email</b>',
				'rules' => 'trim|valid_email'
			),
			array(
				'field' => 'phone',
				'label' => '<b>Telefono</b>',
				'rules' => 'trim'
			),
		);
		if ($this->input->post('password')){
			$config[] = array(
				'field' => 'password',
				'label' => '<b>Contraseña</b>',
				'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordc]'
			);
			$config[] = array(
				'field' => 'passwordc',
				'label' => '<b>Confirmar contraseña</b>',
				'rules' => 'trim|required'
			);
		}
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('nombres')) ? $this->data['nombres'] = $this->input->post('nombres') : $this->data['nombres'] = $user->first_name;
			!empty($this->input->post('apellidos')) ? $this->data['apellidos'] = $this->input->post('apellidos') : $this->data['apellidos'] = $user->last_name;
			!empty($this->input->post('email')) ? $this->data['email'] = $this->input->post('email') : $this->data['email'] = $user->email;
			!empty($this->input->post('phone')) ? $this->data['phone'] = $this->input->post('phone') : $this->data['phone'] = $user->phone;
			$this->view_handler->view('administrador/educadores', 'editProfeJ', $this->data);
		}	else{
				$additional_data = array(
					'first_name' => $this->input->post('nombres'),
					'last_name' => $this->input->post('apellidos'),
					'phone' => $this->input->post('phone'),
					'email' => $this->input->post('email'),
				);
				if ($this->input->post('password')) $additional_data['password'] = $this->input->post('password');
				if ($this->input->post('colegiosselect')){
					$additional_data['company'] = $this->input->post('colegiosselect');
					$additional_data['sector'] = $this->input->post('cursosselect');
				}
				if ($this->ion_auth->update($user->id, $additional_data)){
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('messages', $this->bootstrap->alert('success', "Se edito la cuenta de Usuario 1."));
					redirect('administrador/educadores');
				}	else{
						// redirect them back to the admin page if admin, or to the base url if non admin
						$this->session->set_flashdata('messages', $this->ion_auth->errors());
						redirect('administrador/educadores');
					}
			}
	}

	public function showProfeJ($id){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Ver Usuario 1'
		);
		$user = $this->ion_auth->user($id)->row();
		$this->data['username'] = $user->username;
		$this->data['nombres'] = $user->first_name;
		$this->data['apellidos'] = $user->last_name;
		$this->data['phone'] = $user->phone;
		$this->data['email'] = $user->email;
		$this->data['colegio'] = $this->Colegios_model->get('*', array('id' => $user->company))[0]->nombre;
		$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $user->sector))[0]->nombre;

		$this->view_handler->view('administrador/educadores', 'showProfeJ', $this->data);
	}

	public function createPIE(){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Crear cuenta PIE'
		);

		$this->data['colegios'] = $this->Colegios_model->get('*');
		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');

		$config = array(
			array(
				'field' => 'username',
				'label' => '<b>Nombre de Usuario</b>',
				'rules' => 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']'
			),
			array(
				'field' => 'password',
				'label' => '<b>Contraseña</b>',
				'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordc]'
			),
			array(
				'field' => 'passwordc',
				'label' => '<b>Confirmar contraseña</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellidos',
				'label' => '<b>apellidos</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'colegiosselect',
				'label' => '<b>Colegio</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'email',
				'label' => '<b>Email</b>',
				'rules' => 'trim|valid_email'
			),
			array(
				'field' => 'phone',
				'label' => '<b>Telefono</b>',
				'rules' => 'trim'
			),
		);
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('username')) ? $this->data['username'] = $this->input->post('username') : $this->data['username'] = NULL;
			!empty($this->input->post('nombres')) ? $this->data['nombres'] = $this->input->post('nombres') : $this->data['nombres'] = NULL;
			!empty($this->input->post('apellidos')) ? $this->data['apellidos'] = $this->input->post('apellidos') : $this->data['apellidos'] = NULL;
			!empty($this->input->post('email')) ? $this->data['email'] = $this->input->post('email') : $this->data['email'] = NULL;
			!empty($this->input->post('phone')) ? $this->data['phone'] = $this->input->post('phone') : $this->data['phone'] = NULL;
			!empty($this->input->post('colegiosselect')) ? $this->data['colegioSelect'] = $this->input->post('colegiosselect') : $this->data['colegioSelect'] = NULL;
			$this->view_handler->view('administrador/educadores', 'createPIE', $this->data);
		}	else{

				$email = strtolower($this->input->post('email'));
				$identity = $this->input->post('username');
				$password = $this->input->post('password');

				$additional_data = array(
					'first_name' => $this->input->post('nombres'),
					'last_name' => $this->input->post('apellidos'),
					'phone' => $this->input->post('phone'),
					'company' => $this->input->post('colegiosselect'),
				);
				$idCuenta = $this->ion_auth->register($identity, $password, $email, $additional_data, array('5'));
				$this->session->set_flashdata('messages', $this->bootstrap->alert('success', "Se creó la cuenta de PIE."));
				redirect('administrador/educadores');
			}
	}

	public function editPIE($id){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Editar PIE'
		);
		$this->data['id'] = $id;
		$this->data['colegios'] = $this->Colegios_model->get('*');
		$user = $this->ion_auth->user($id)->row();
		$config = array(
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellidos',
				'label' => '<b>apellidos</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'email',
				'label' => '<b>Email</b>',
				'rules' => 'trim|valid_email'
			),
			array(
				'field' => 'phone',
				'label' => '<b>Telefono</b>',
				'rules' => 'trim'
			),
		);
		if ($this->input->post('password')){
			$config[] = array(
				'field' => 'password',
				'label' => '<b>Contraseña</b>',
				'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordc]'
			);
			$config[] = array(
				'field' => 'passwordc',
				'label' => '<b>Confirmar contraseña</b>',
				'rules' => 'trim|required'
			);
		}
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('nombres')) ? $this->data['nombres'] = $this->input->post('nombres') : $this->data['nombres'] = $user->first_name;
			!empty($this->input->post('apellidos')) ? $this->data['apellidos'] = $this->input->post('apellidos') : $this->data['apellidos'] = $user->last_name;
			!empty($this->input->post('email')) ? $this->data['email'] = $this->input->post('email') : $this->data['email'] = $user->email;
			!empty($this->input->post('phone')) ? $this->data['phone'] = $this->input->post('phone') : $this->data['phone'] = $user->phone;
			$this->view_handler->view('administrador/educadores', 'editPIE', $this->data);
		}	else{
				$additional_data = array(
					'first_name' => $this->input->post('nombres'),
					'last_name' => $this->input->post('apellidos'),
					'phone' => $this->input->post('phone'),
					'email' => $this->input->post('email'),
				);
				if ($this->input->post('password')) $additional_data['password'] = $this->input->post('password');
				if ($this->input->post('colegiosselect')){
					$additional_data['company'] = $this->input->post('colegiosselect');
				}
				if ($this->ion_auth->update($user->id, $additional_data)){
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('messages', $this->bootstrap->alert('success', "Se edito la cuenta de PIE."));
					redirect('administrador/educadores');
				}	else{
						// redirect them back to the admin page if admin, or to the base url if non admin
						$this->session->set_flashdata('messages', $this->ion_auth->errors());
						redirect('administrador/educadores');
					}
			}
	}

	public function showPIE($id){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Ver PIE'
		);
		$user = $this->ion_auth->user($id)->row();
		$this->data['username'] = $user->username;
		$this->data['nombres'] = $user->first_name;
		$this->data['apellidos'] = $user->last_name;
		$this->data['phone'] = $user->phone;
		$this->data['email'] = $user->email;
		$this->data['colegio'] = $this->Colegios_model->get('*', array('id' => $user->company))[0]->nombre;

		$this->view_handler->view('administrador/educadores', 'showPIE', $this->data);
	}

	public function createCC(){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Crear cuenta comite de convivencia'
		);

		$this->data['colegios'] = $this->Colegios_model->get('*');
		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');

		$config = array(
			array(
				'field' => 'username',
				'label' => '<b>Nombre de Usuario</b>',
				'rules' => 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']'
			),
			array(
				'field' => 'password',
				'label' => '<b>Contraseña</b>',
				'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordc]'
			),
			array(
				'field' => 'passwordc',
				'label' => '<b>Confirmar contraseña</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellidos',
				'label' => '<b>apellidos</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'colegiosselect',
				'label' => '<b>Colegio</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'email',
				'label' => '<b>Email</b>',
				'rules' => 'trim|valid_email'
			),
			array(
				'field' => 'phone',
				'label' => '<b>Telefono</b>',
				'rules' => 'trim'
			),
		);
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('username')) ? $this->data['username'] = $this->input->post('username') : $this->data['username'] = NULL;
			!empty($this->input->post('nombres')) ? $this->data['nombres'] = $this->input->post('nombres') : $this->data['nombres'] = NULL;
			!empty($this->input->post('apellidos')) ? $this->data['apellidos'] = $this->input->post('apellidos') : $this->data['apellidos'] = NULL;
			!empty($this->input->post('email')) ? $this->data['email'] = $this->input->post('email') : $this->data['email'] = NULL;
			!empty($this->input->post('phone')) ? $this->data['phone'] = $this->input->post('phone') : $this->data['phone'] = NULL;
			!empty($this->input->post('colegiosselect')) ? $this->data['colegioSelect'] = $this->input->post('colegiosselect') : $this->data['colegioSelect'] = NULL;
			$this->view_handler->view('administrador/educadores', 'createCC', $this->data);
		}	else{

				$email = strtolower($this->input->post('email'));
				$identity = $this->input->post('username');
				$password = $this->input->post('password');

				$additional_data = array(
					'first_name' => $this->input->post('nombres'),
					'last_name' => $this->input->post('apellidos'),
					'phone' => $this->input->post('phone'),
					'company' => $this->input->post('colegiosselect'),
				);
				$idCuenta = $this->ion_auth->register($identity, $password, $email, $additional_data, array('6'));
				$this->session->set_flashdata('messages', $this->bootstrap->alert('success', "Se creó la cuenta de comite C."));
				redirect('administrador/educadores');
			}
	}

	public function editCC($id){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Editar comite C.'
		);
		$this->data['id'] = $id;
		$this->data['colegios'] = $this->Colegios_model->get('*');
		$user = $this->ion_auth->user($id)->row();
		$config = array(
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellidos',
				'label' => '<b>apellidos</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'email',
				'label' => '<b>Email</b>',
				'rules' => 'trim|valid_email'
			),
			array(
				'field' => 'phone',
				'label' => '<b>Telefono</b>',
				'rules' => 'trim'
			),
		);
		if ($this->input->post('password')){
			$config[] = array(
				'field' => 'password',
				'label' => '<b>Contraseña</b>',
				'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordc]'
			);
			$config[] = array(
				'field' => 'passwordc',
				'label' => '<b>Confirmar contraseña</b>',
				'rules' => 'trim|required'
			);
		}
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('nombres')) ? $this->data['nombres'] = $this->input->post('nombres') : $this->data['nombres'] = $user->first_name;
			!empty($this->input->post('apellidos')) ? $this->data['apellidos'] = $this->input->post('apellidos') : $this->data['apellidos'] = $user->last_name;
			!empty($this->input->post('email')) ? $this->data['email'] = $this->input->post('email') : $this->data['email'] = $user->email;
			!empty($this->input->post('phone')) ? $this->data['phone'] = $this->input->post('phone') : $this->data['phone'] = $user->phone;
			$this->view_handler->view('administrador/educadores', 'editCC', $this->data);
		}	else{
				$additional_data = array(
					'first_name' => $this->input->post('nombres'),
					'last_name' => $this->input->post('apellidos'),
					'phone' => $this->input->post('phone'),
					'email' => $this->input->post('email'),
				);
				if ($this->input->post('password')) $additional_data['password'] = $this->input->post('password');
				if ($this->input->post('colegiosselect')){
					$additional_data['company'] = $this->input->post('colegiosselect');
				}
				if ($this->ion_auth->update($user->id, $additional_data)){
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('messages', $this->bootstrap->alert('success', "Se edito la cuenta de comite C."));
					redirect('administrador/educadores');
				}	else{
						// redirect them back to the admin page if admin, or to the base url if non admin
						$this->session->set_flashdata('messages', $this->ion_auth->errors());
						redirect('administrador/educadores');
					}
			}
	}

	public function showCC($id){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Ver Comite C.'
		);
		$user = $this->ion_auth->user($id)->row();
		$this->data['username'] = $user->username;
		$this->data['nombres'] = $user->first_name;
		$this->data['apellidos'] = $user->last_name;
		$this->data['phone'] = $user->phone;
		$this->data['email'] = $user->email;
		$this->data['colegio'] = $this->Colegios_model->get('*', array('id' => $user->company))[0]->nombre;

		$this->view_handler->view('administrador/educadores', 'showCC', $this->data);
	}

	public function createOri(){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Crear cuenta orientador'
		);

		$this->data['colegios'] = $this->Colegios_model->get('*');
		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');

		$config = array(
			array(
				'field' => 'username',
				'label' => '<b>Nombre de Usuario</b>',
				'rules' => 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']'
			),
			array(
				'field' => 'password',
				'label' => '<b>Contraseña</b>',
				'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordc]'
			),
			array(
				'field' => 'passwordc',
				'label' => '<b>Confirmar contraseña</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellidos',
				'label' => '<b>apellidos</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'colegiosselect',
				'label' => '<b>Colegio</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'email',
				'label' => '<b>Email</b>',
				'rules' => 'trim|valid_email'
			),
			array(
				'field' => 'phone',
				'label' => '<b>Telefono</b>',
				'rules' => 'trim'
			),
		);
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('username')) ? $this->data['username'] = $this->input->post('username') : $this->data['username'] = NULL;
			!empty($this->input->post('nombres')) ? $this->data['nombres'] = $this->input->post('nombres') : $this->data['nombres'] = NULL;
			!empty($this->input->post('apellidos')) ? $this->data['apellidos'] = $this->input->post('apellidos') : $this->data['apellidos'] = NULL;
			!empty($this->input->post('email')) ? $this->data['email'] = $this->input->post('email') : $this->data['email'] = NULL;
			!empty($this->input->post('phone')) ? $this->data['phone'] = $this->input->post('phone') : $this->data['phone'] = NULL;
			!empty($this->input->post('colegiosselect')) ? $this->data['colegioSelect'] = $this->input->post('colegiosselect') : $this->data['colegioSelect'] = NULL;
			$this->view_handler->view('administrador/educadores', 'createOri', $this->data);
		}	else{

				$email = strtolower($this->input->post('email'));
				$identity = $this->input->post('username');
				$password = $this->input->post('password');

				$additional_data = array(
					'first_name' => $this->input->post('nombres'),
					'last_name' => $this->input->post('apellidos'),
					'phone' => $this->input->post('phone'),
					'company' => $this->input->post('colegiosselect'),
				);
				$idCuenta = $this->ion_auth->register($identity, $password, $email, $additional_data, array('4'));
				$this->session->set_flashdata('messages', $this->bootstrap->alert('success', "Se creó la cuenta de orientador."));
				redirect('administrador/educadores');
			}
	}

	public function editOri($id){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Editar Orientador'
		);
		$this->data['id'] = $id;
		$this->data['colegios'] = $this->Colegios_model->get('*');
		$user = $this->ion_auth->user($id)->row();
		$config = array(
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellidos',
				'label' => '<b>apellidos</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'email',
				'label' => '<b>Email</b>',
				'rules' => 'trim|valid_email'
			),
			array(
				'field' => 'phone',
				'label' => '<b>Telefono</b>',
				'rules' => 'trim'
			),
		);
		if ($this->input->post('password')){
			$config[] = array(
				'field' => 'password',
				'label' => '<b>Contraseña</b>',
				'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordc]'
			);
			$config[] = array(
				'field' => 'passwordc',
				'label' => '<b>Confirmar contraseña</b>',
				'rules' => 'trim|required'
			);
		}
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('nombres')) ? $this->data['nombres'] = $this->input->post('nombres') : $this->data['nombres'] = $user->first_name;
			!empty($this->input->post('apellidos')) ? $this->data['apellidos'] = $this->input->post('apellidos') : $this->data['apellidos'] = $user->last_name;
			!empty($this->input->post('email')) ? $this->data['email'] = $this->input->post('email') : $this->data['email'] = $user->email;
			!empty($this->input->post('phone')) ? $this->data['phone'] = $this->input->post('phone') : $this->data['phone'] = $user->phone;
			$this->view_handler->view('administrador/educadores', 'editOri', $this->data);
		}	else{
				$additional_data = array(
					'first_name' => $this->input->post('nombres'),
					'last_name' => $this->input->post('apellidos'),
					'phone' => $this->input->post('phone'),
					'email' => $this->input->post('email'),
				);
				if ($this->input->post('password')) $additional_data['password'] = $this->input->post('password');
				if ($this->input->post('colegiosselect')){
					$additional_data['company'] = $this->input->post('colegiosselect');
				}
				if ($this->ion_auth->update($user->id, $additional_data)){
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('messages', $this->bootstrap->alert('success', "Se edito la cuenta de Orientador."));
					redirect('administrador/educadores');
				}	else{
						// redirect them back to the admin page if admin, or to the base url if non admin
						$this->session->set_flashdata('messages', $this->ion_auth->errors());
						redirect('administrador/educadores');
					}
			}
	}

	public function showOri($id){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Ver Orientador'
		);
		$user = $this->ion_auth->user($id)->row();
		$this->data['username'] = $user->username;
		$this->data['nombres'] = $user->first_name;
		$this->data['apellidos'] = $user->last_name;
		$this->data['phone'] = $user->phone;
		$this->data['email'] = $user->email;
		$this->data['colegio'] = $this->Colegios_model->get('*', array('id' => $user->company))[0]->nombre;

		$this->view_handler->view('administrador/educadores', 'showOri', $this->data);
	}

	public function createDupla(){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Crear cuenta dupla psicosocial'
		);

		$this->data['colegios'] = $this->Colegios_model->get('*');
		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');

		$config = array(
			array(
				'field' => 'username',
				'label' => '<b>Nombre de Usuario</b>',
				'rules' => 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']'
			),
			array(
				'field' => 'password',
				'label' => '<b>Contraseña</b>',
				'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordc]'
			),
			array(
				'field' => 'passwordc',
				'label' => '<b>Confirmar contraseña</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellidos',
				'label' => '<b>apellidos</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'colegiosselect',
				'label' => '<b>Colegio</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'email',
				'label' => '<b>Email</b>',
				'rules' => 'trim|valid_email'
			),
			array(
				'field' => 'phone',
				'label' => '<b>Telefono</b>',
				'rules' => 'trim'
			),
		);
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('username')) ? $this->data['username'] = $this->input->post('username') : $this->data['username'] = NULL;
			!empty($this->input->post('nombres')) ? $this->data['nombres'] = $this->input->post('nombres') : $this->data['nombres'] = NULL;
			!empty($this->input->post('apellidos')) ? $this->data['apellidos'] = $this->input->post('apellidos') : $this->data['apellidos'] = NULL;
			!empty($this->input->post('email')) ? $this->data['email'] = $this->input->post('email') : $this->data['email'] = NULL;
			!empty($this->input->post('phone')) ? $this->data['phone'] = $this->input->post('phone') : $this->data['phone'] = NULL;
			!empty($this->input->post('colegiosselect')) ? $this->data['colegioSelect'] = $this->input->post('colegiosselect') : $this->data['colegioSelect'] = NULL;
			$this->view_handler->view('administrador/educadores', 'createDupla', $this->data);
		}	else{

				$email = strtolower($this->input->post('email'));
				$identity = $this->input->post('username');
				$password = $this->input->post('password');

				$additional_data = array(
					'first_name' => $this->input->post('nombres'),
					'last_name' => $this->input->post('apellidos'),
					'phone' => $this->input->post('phone'),
					'company' => $this->input->post('colegiosselect'),
				);
				$idCuenta = $this->ion_auth->register($identity, $password, $email, $additional_data, array('8'));
				$this->session->set_flashdata('messages', $this->bootstrap->alert('success', "Se creó la cuenta de orientador."));
				redirect('administrador/educadores');
			}
	}

	public function editDupla($id){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Editar dupla psicosocial'
		);
		$this->data['id'] = $id;
		$this->data['colegios'] = $this->Colegios_model->get('*');
		$user = $this->ion_auth->user($id)->row();
		$config = array(
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellidos',
				'label' => '<b>apellidos</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'email',
				'label' => '<b>Email</b>',
				'rules' => 'trim|valid_email'
			),
			array(
				'field' => 'phone',
				'label' => '<b>Telefono</b>',
				'rules' => 'trim'
			),
		);
		if ($this->input->post('password')){
			$config[] = array(
				'field' => 'password',
				'label' => '<b>Contraseña</b>',
				'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordc]'
			);
			$config[] = array(
				'field' => 'passwordc',
				'label' => '<b>Confirmar contraseña</b>',
				'rules' => 'trim|required'
			);
		}
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('nombres')) ? $this->data['nombres'] = $this->input->post('nombres') : $this->data['nombres'] = $user->first_name;
			!empty($this->input->post('apellidos')) ? $this->data['apellidos'] = $this->input->post('apellidos') : $this->data['apellidos'] = $user->last_name;
			!empty($this->input->post('email')) ? $this->data['email'] = $this->input->post('email') : $this->data['email'] = $user->email;
			!empty($this->input->post('phone')) ? $this->data['phone'] = $this->input->post('phone') : $this->data['phone'] = $user->phone;
			$this->view_handler->view('administrador/educadores', 'editDupla', $this->data);
		}	else{
				$additional_data = array(
					'first_name' => $this->input->post('nombres'),
					'last_name' => $this->input->post('apellidos'),
					'phone' => $this->input->post('phone'),
					'email' => $this->input->post('email'),
				);
				if ($this->input->post('password')) $additional_data['password'] = $this->input->post('password');
				if ($this->input->post('colegiosselect')){
					$additional_data['company'] = $this->input->post('colegiosselect');
				}
				if ($this->ion_auth->update($user->id, $additional_data)){
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('messages', $this->bootstrap->alert('success', "Se edito la cuenta de Orientador."));
					redirect('administrador/educadores');
				}	else{
						// redirect them back to the admin page if admin, or to the base url if non admin
						$this->session->set_flashdata('messages', $this->ion_auth->errors());
						redirect('administrador/educadores');
					}
			}
	}

	public function showDupla($id){
		$this->data['menu_items'][] = 'educadores';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de educadores',
			'link' => site_url('administrador/educadores')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Ver dupla psicosocial'
		);
		$user = $this->ion_auth->user($id)->row();
		$this->data['username'] = $user->username;
		$this->data['nombres'] = $user->first_name;
		$this->data['apellidos'] = $user->last_name;
		$this->data['phone'] = $user->phone;
		$this->data['email'] = $user->email;
		$this->data['colegio'] = $this->Colegios_model->get('*', array('id' => $user->company))[0]->nombre;

		$this->view_handler->view('administrador/educadores', 'showDupla', $this->data);
	}

	public function ajaxCuentas(){

		$data = array(
                    "draw" => 0,
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => [] 
                );

		$allUser = $this->ion_auth->users()->result();
			foreach ($allUser as $k => $user){
				$user->groups = $this->ion_auth->get_users_groups($user->id)->result();
				if($user->groups[0]->id != 7 AND $user->groups[0]->id != 9){
					if($user->groups[0]->id != 1) $nombreColegio = $this->Colegios_model->get('nombre', array('id' => $user->company))[0]->nombre;
						else {$nombreColegio = 'No aplica'; $nombreCurso = 'No aplica';}
					if($user->groups[0]->id == 3) $nombreCurso = $this->Cursos_model->get('nombre', array('id' => $user->sector))[0]->nombre;
						else $nombreCurso = 'No aplica';
					$data['data'][] = array(
									'id' => $user->id,
									'username' => $user->username,
									'first_name' => $user->first_name,
									'last_name' => $user->last_name,
									'group' => $user->groups[0]->description,
									'idgroup' => $user->groups[0]->id,
									'colegio' => $nombreColegio,
									'curso' => $nombreCurso,

					);
					$data['recordsTotal'] = $k + 1;
					$data['recordsFiltered'] = $k + 1;
				}
			}

		echo json_encode($data);
	}

	public function ajaxRemoverUser($id){

		if($this->ion_auth->delete_user($id)){
			$response = $this->message_handler->get("Successful", "Remove", $id);
		}	else{
				$response = $this->message_handler->get('Warning', 'DoesNotExist');
			}
		echo json_encode($response);
		return;
	}

	//Administracion de casos
	public function casos(){
		$this->data['menu_items'][] = 'casos';
		$this->data['menu_items'][] = 'lista';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de casos'
		);

		$this->view_handler->view('administrador/casos', 'inicio', $this->data);
	}

	public function add_caso(){
		$this->data['menu_items'] = array ('casos','add');
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de casos',
			'link' =>  site_url('Administrador/casos')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Registrar caso'
		);

		$colegios = $this->Colegios_model->get('*');
		$this->data['colegios'] = $colegios;


		$config = array(
			array(
				'field' => 'rut',
				'label' => '<b>RUT caso</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellido_p',
				'label' => '<b>Apellido paterno</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellido_m',
				'label' => '<b>Apellido materno</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'nacimiento',
				'label' => '<b>Nacimiento</b>',
				'rules' => 'trim|required'
			),
		);
		$this->form_validation->set_rules($config);
	    
	    if($this->form_validation->run() === FALSE){
	    	!empty($this->input->post('rut')) ? $this->data['rut'] = $this->input->post('rut') : $this->data['rut'] = NULL;
	    	!empty($this->input->post('nombres')) ? $this->data['nombres'] = $this->input->post('nombres') : $this->data['nombres'] = NULL;
	    	!empty($this->input->post('apellido_p')) ? $this->data['apellido_p'] = $this->input->post('apellido_p') : $this->data['apellido_p'] = NULL;
	    	!empty($this->input->post('apellido_m')) ? $this->data['apellido_m'] = $this->input->post('apellido_m') : $this->data['apellido_m'] = NULL;
	    	!empty($this->input->post('nacimiento')) ? $this->data['nacimiento'] = $this->input->post('nacimiento') : $this->data['nacimiento'] = NULL;
	    	$this->view_handler->view('administrador/casos', 'agregarcaso', $this->data);
	    }	else{

	    		$nombreCuenta = substr($this->input->post('rut'), 0, -2) .'@alumno';
				$additional_data = array(
							'first_name' => $this->input->post('nombres'),
							'last_name' => $this->input->post('apellido_p') .' '.$this->input->post('apellido_m'),
							'company' => $this->input->post('colegiosselect'),
							'sector' => $this->input->post('cursosselect'),
							'rut' => $this->input->post('rut'),
					);
				$idCuentaE = $this->ion_auth->register($nombreCuenta, substr($this->input->post('rut'), 0, -2), $nombreCuenta, $additional_data, array('9'));

				$nombreCuenta = substr($this->input->post('rut'), 0, -2) .'@apoderado';
				$additional_data = array(
					'first_name' => 'Apoderado',
					'last_name' => 'Apoderado',
					'company' => $this->input->post('colegiosselect'),
					'rut' => 'NoSet',
				);

				$idCuentaA = $this->ion_auth->register($nombreCuenta, substr($this->input->post('rut'), 0, -2) , $nombreCuenta, $additional_data, array('7'));

		    	$caso = array(
		    		'rut' => $this->input->post('rut'),
		    		'nombres' => $this->input->post('nombres'),
		    		'apellido_p' => $this->input->post('apellido_p'),
		    		'apellido_m' => $this->input->post('apellido_m'),
		    		'nacimiento' => $this->input->post('nacimiento'),
		    		'user_id' => $idCuentaE,
		    		'apoderado_user_id' => $idCuentaA,
		    	);

		    	$id_caso = $this->casos_model->add_id($caso);

				$this->ion_auth->update($idCuentaA, array('sector' => $id_caso));

		    	if(!empty($id_caso)) {

		    		$en_colegio = array(
			    		'id_caso' => $id_caso,
			    		'id_colegio' => $this->input->post('colegiosselect'),
			    		'estado' => '1',
			    	);
			    	$this->En_colegio_model->add($en_colegio);

			    	$en_curso = array(
			    		'id_caso' => $id_caso,
			    		'id_curso' => $this->input->post('cursosselect'),
			    		'estado' => '1',
			    	);
			    	$this->En_curso_model->add($en_curso);


	        		//$this->session->set_flashdata('message', $this->bootstrap->alert('success', "Se creó exitosamente el."));
	        		$this->data['nombres'] = $this->input->post('nombres');
	        		$this->data['rut'] = $this->input->post('rut');
	        		$this->view_handler->view('administrador/casos', 'agregarcasoTRUE', $this->data);
	        	} 	else {
	        			$this->data['errors']['Base de datos'] =  'No se pudo almacenar los datos.';
	        			$this->view_handler->view('administrador/casos', 'agregarcaso', $this->data);
	        		}

	    	}	
	}

	public function edit_caso($id_caso = null){

		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];
		
		$caso = $this->casos_model->get('*',array('id' => $id_caso))[0];
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de casos',
			'link' =>  site_url('Administrador/casos')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Editar de caso'
		);

		$this->data['colegios'] = $this->Colegios_model->get('*');
		
		$this->data['id_caso'] = $id_caso;
		$this->data['menu_items'][] = 'casos';

		$config = array(
			array(
				'field' => 'rut',
				'label' => '<b>RUT caso</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellido_p',
				'label' => '<b>Apellido paterno</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellido_m',
				'label' => '<b>Apellido materno</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'nacimiento',
				'label' => '<b>Nacimiento</b>',
				'rules' => 'trim|required'
			),
		);

		if ($this->input->post('colegiosselect')){
			$config[] = array(
				'field' => 'colegiosselect',
				'label' => '<b>Colegio</b>',
				'rules' => 'trim|required'
			);
			$config[] = array(
				'field' => 'cursosselect',
				'label' => '<b>Curso</b>',
				'rules' => 'trim|required'
			);
		}

		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			$post = !empty($this->input->post());

			$this->data['rut'] = $post ? $this->input->post('rut') : $caso->rut;
        	$this->data['nombres'] = $post ? $this->input->post('nombres') : $caso->nombres;
        	$this->data['apellido_p'] = $post ? $this->input->post('apellido_p') : $caso->apellido_p;
        	$this->data['apellido_m'] = $post ? $this->input->post('apellido_m') : $caso->apellido_m;
        	$this->data['nacimiento'] = $post ? $this->input->post('nacimiento') : $caso->nacimiento;

        	$this->view_handler->view('administrador/casos', 'editarcaso', $this->data);
		}	else {
				$caso = array(
		    		'rut' => $this->input->post('rut'),
		    		'nombres' => $this->input->post('nombres'),
		    		'apellido_p' => $this->input->post('apellido_p'),
		    		'apellido_m' => $this->input->post('apellido_m'),
		    		'nacimiento' => $this->input->post('nacimiento'),
		    	);
		    	if ($this->input->post('colegiosselect')){
		    		$listaColegios = $this->En_colegio_model->get('*',array('id_caso' => $id_caso));
					foreach ($listaColegios as $key => $value) {
						$this->En_colegio_model->update(array('estado' => 0), array('id' => $value->id));
					}
					$registroColegio = $this->En_colegio_model->get('*',array('id_caso' => $id_caso, 'id_colegio' => $this->input->post('colegiosselect')));
					if(empty($registroColegio)){
						$en_colegio = array(
							'id_caso' => $id_caso,
							'id_colegio' => $this->input->post('colegiosselect'),
							'estado' => '1',
						);
						$this->En_colegio_model->add($en_colegio);
					} 	else {
							$en_colegio = array(
								'estado' => '1',
							);
							$this->En_colegio_model->update($en_colegio, array('id_caso' => $id_caso, 'id_colegio' => $this->input->post('colegiosselect')));
						}
					

					$listaCursos = $this->En_curso_model->get('*', array('id_caso' => $id_caso));
					foreach ($listaCursos as $key => $value) {
						$this->En_curso_model->update(array('estado' => 0), array('id' => $value->id));
					}
					$registroCurso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'id_curso' => $this->input->post('cursosselect')));
					if(empty($registroCurso)){
						$en_curso = array(
							'id_caso' => $id_caso,
							'id_curso' => $this->input->post('cursosselect'),
							'estado' => '1',
						);
						$this->En_curso_model->add($en_curso);
					} 	else {
							$en_curso = array(
								'estado' => '1',
							);
							$this->En_curso_model->update($en_curso, array('id_caso' => $id_caso, 'id_curso' => $this->input->post('cursosselect')));
						}
					
				}
		    	
				
		    	if($this->casos_model->update($caso, array('id' => $id_caso))) {
		    		$this->data['message'] = $this->bootstrap->alert('success', "Se modificó exitosamente el caso.");
					$this->view_handler->view('administrador/casos', 'inicio', $this->data);
	        	} else {
	        		$this->data['errors']['Base de datos'] =  'No se pudieron modificar los datos.';
	        		$this->view_handler->view('administrador/casos', 'editarcaso', $this->data);
	        	}
		}
	}

	public function show_caso($id_caso = null){
		$caso = $this->casos_model->get('*',array('id' => $id_caso))[0];
		
		$avatarPath = './files/avatar/casos/' .$id_caso. '/';
		$map = directory_map($avatarPath,1);
		if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de casos',
			'link' =>  site_url('Administrador/casos')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Ver caso'
		);
		$this->data['menu_items'][] = 'casos';
		$this->data['messages'] = $this->session->flashdata('messages');
		$userE = $this->ion_auth->user($caso->user_id)->row();
		$userA = $this->ion_auth->user($caso->apoderado_user_id)->row();

		$id_colegio = $this->En_colegio_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_colegio;
		$id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
		
		$this->data['rut'] = $caso->rut;
		$this->data['nombres'] = $caso->nombres;
		$this->data['apellidos'] = $caso->apellido_p .' '. $caso->apellido_m;
		$this->data['nacimiento'] = $caso->nacimiento;
		$this->data['colegio'] = $this->Colegios_model->get('*', array('id' => $id_colegio))[0]->nombre;
		$this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso))[0]->nombre;
		$this->data['user_id'] = $caso->user_id;
		$this->data['apoderado_user_id'] = $caso->apoderado_user_id;

		$this->data['eUsername'] = $userE->username;
		$this->data['eEmail'] = $userE->email;
		$this->data['aUsername'] = $userA->username;
		$this->data['aEmail'] = $userA->email;

		$this->data['id_caso'] = $id_caso;
		$this->data['id_cuenta'] = $caso->user_id;
		$this->view_handler->view('administrador/casos', 'mostrarcaso', $this->data);
	}

	public function editCuentaE($id_caso, $id_cuenta){
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de casos',
			'link' =>  site_url('Administrador/casos')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Ver caso'
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Modificicar cuenta caso'
		);
		$this->data['menu_items'][] = 'casos';
		$this->data['id_caso'] = $id_caso;
		$this->data['id_cuenta'] = $id_cuenta;

		$user = $this->ion_auth->user($id_cuenta)->row();
		$config = array(
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellidos',
				'label' => '<b>apellidos</b>',
				'rules' => 'trim|required'
			),
		);
		if ($this->input->post('password')){
			$config[] = array(
				'field' => 'password',
				'label' => '<b>Contraseña</b>',
				'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordc]'
			);
			$config[] = array(
				'field' => 'passwordc',
				'label' => '<b>Confirmar contraseña</b>',
				'rules' => 'trim|required'
			);
		}
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('nombres')) ? $this->data['nombres'] = $this->input->post('nombres') : $this->data['nombres'] = $user->first_name;
			!empty($this->input->post('apellidos')) ? $this->data['apellidos'] = $this->input->post('apellidos') : $this->data['apellidos'] = $user->last_name;
			$this->view_handler->view('administrador/casos', 'editCuentaE', $this->data);
		}	else{
				$additional_data = array(
					'first_name' => $this->input->post('nombres'),
					'last_name' => $this->input->post('apellidos'),
				);
				if ($this->input->post('password')) $additional_data['password'] = $this->input->post('password');
				if ($this->ion_auth->update($user->id, $additional_data)){
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('messages', $this->bootstrap->alert('success', "Se edito la cuenta de caso."));
					redirect('administrador/show_caso/'. $id_caso);
				}	else{
						// redirect them back to the admin page if admin, or to the base url if non admin
						$this->session->set_flashdata('messages', $this->ion_auth->errors());
						redirect('administrador/show_caso/'. $id_caso);
					}
			}
	}

	public function editCuentaA($id_caso, $id_cuenta){
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de casos',
			'link' =>  site_url('Administrador/casos')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Ver caso'
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Modificicar cuenta apoderado'
		);
		$this->data['menu_items'][] = 'casos';
		$this->data['id_caso'] = $id_caso;
		$this->data['id_cuenta'] = $id_cuenta;

		$user = $this->ion_auth->user($id_cuenta)->row();
		$config = array(
			array(
				'field' => 'nombres',
				'label' => '<b>Nombres</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'apellidos',
				'label' => '<b>apellidos</b>',
				'rules' => 'trim|required'
			),
		);
		if ($this->input->post('password')){
			$config[] = array(
				'field' => 'password',
				'label' => '<b>Contraseña</b>',
				'rules' => 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordc]'
			);
			$config[] = array(
				'field' => 'passwordc',
				'label' => '<b>Confirmar contraseña</b>',
				'rules' => 'trim|required'
			);
		}
		$this->form_validation->set_rules($config);
		if($this->form_validation->run() === FALSE){
			!empty($this->input->post('nombres')) ? $this->data['nombres'] = $this->input->post('nombres') : $this->data['nombres'] = $user->first_name;
			!empty($this->input->post('apellidos')) ? $this->data['apellidos'] = $this->input->post('apellidos') : $this->data['apellidos'] = $user->last_name;
			$this->view_handler->view('administrador/casos', 'editCuentaA', $this->data);
		}	else{
				$additional_data = array(
					'first_name' => $this->input->post('nombres'),
					'last_name' => $this->input->post('apellidos'),
				);
				if ($this->input->post('password')) $additional_data['password'] = $this->input->post('password');
				if ($this->ion_auth->update($user->id, $additional_data)){
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('messages', $this->bootstrap->alert('success', "Se edito la cuenta de Apoderado."));
					redirect('administrador/show_caso/'. $id_caso);
				}	else{
						// redirect them back to the admin page if admin, or to the base url if non admin
						$this->session->set_flashdata('messages', $this->ion_auth->errors());
						redirect('administrador/show_caso/'. $id_caso);
					}
			}
	}

	public function ajaxcaso() {
		$columns = array(
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'rut', 'dt' => 'rut' ),
			array( 'db' => 'nombres', 'dt' => 'nombres' ),
			array( 'db' => 'apellido_p', 'dt' => 'apellido_p' ),
			array( 'db' => 'apellido_m', 'dt' => 'apellido_m' ),
			array( 'db' => 'nacimiento', 'dt' => 'nacimiento' ),
			array( 'db' => 'nombreColegio', 'dt' => 'nombreColegio' ),
			array( 'db' => 'id_colegio', 'dt' => 'id_colegio' ),
			array( 'db' => 'nombreCurso', 'dt' => 'nombreCurso' ),
			array( 'db' => 'id_curso', 'dt' => 'id_curso' ),
		);

		echo json_encode($data);
    }

    public function ajaxRemovercaso($id = null){

    	if(empty($id)) {
			$respose = $this->message_handler->get('Warning', 'EmptyIdentifier');
    		echo json_encode($respose);
    		return;
		}
	
		$caso = $this->casos_model->get('*', array('id' => $id));
		if(empty($caso)) {
			$response = $this->message_handler->get('Warning', 'DoesNotExist');
    		echo json_encode($response);
    		return;
		}

		$this->casos_model->remove(array('id' => $id));
		$users = $this->ion_auth->where('sector', 2)->users(array(7,9))->result();
		foreach ($users as $key => $value) {
			$this->ion_auth->delete_user($value->id);
		}
		//
		$response = $this->message_handler->get("Successful", "Remove",  $caso[0]);
		// En construccion, falta eliminar información de crtz y drvz, cuentas, etc.

		echo json_encode($response);
		return;

    }

    public function ajaxGetCursos($idColegio = null){
    	$idColegio = urldecode($idColegio);

    	$data = $this->Cursos_model->get('*',array('id_colegio' => $idColegio) );

    	$response = $this->message_handler->get('Successful', 'Get', $data);
    	echo json_encode($response);
    }

    public function casosExcel(){
    	$this->data['menu_items'][] = 'casos';
    	$this->data['menu_items'][] = 'excel';
		$this->data['breadcrumb'][] = array(
			'name' => 'Carga de extudiante por Excel'
		);
		$this->data['messages'] = '';
		$this->data['colegios'] = $this->Colegios_model->get('*');
		$this->view_handler->view('administrador/casos', 'agregarcasoExcel', $this->data);

    }

    public function cargaExcel(){
		$this->data['menu_items'][] = 'casos';
		$this->data['menu_items'][] = 'lista';
		$this->data['breadcrumb'][] = array(
			'name' => 'Cuentas de casos'
		);
		$this->data['messages'] = '';
		$this->data['time_upload_xlsx'] = time();
		
		
		$config = array(
			'upload_path' => './files/alumnos/xlsx',
			'file_name' => $this->data['time_upload_xlsx'],
			'allowed_types' => 'xlsx',
			'overwrite' => true
		);

		$getCurso = $this->Cursos_model->get('*',array('id' => $this->input->post('cursosselect')));
		
		$this->upload->initialize($config);
		
		if($uploaded = $this->upload->do_upload('xlsx')) {
			$data_file = $this->upload->data();
	
			$header = array('Año','RBD', 'Cod Tipo Enseñanza', 'Cod Grado', 'Desc Grado', 'Letra Curso', 'Run', 'Dígito Ver.', 'Genero', 'Nombres','Apellido Paterno','Apellido Materno','Dirección','Comuna Residencia','Código Comuna Residencia','Email','Telefono','Celular','Fecha Nacimiento','Código Etnia','Fecha Incorporación Curso','Fecha Retiro','%Asistenca','Promedio Final');
			$xlsx = $this->excel->readXLSX($data_file['full_path'], $header);
			
			if(empty($xlsx)) {
				$this->data['messages'] = $this->bootstrap->alert('warning', 'El excel no tiene datos.');
			} else {
				$invalid_header = count(array_diff($header, array_keys($xlsx[2]))) !== 0;
				if($invalid_header) {
					$this->data['messages'] = $this->bootstrap->alert('danger', 'No se respeta las columnas requeridas para la cabecera.');
				} else {
					
					$rutIngresados = array();
					
					foreach($xlsx as $key => $row) {

						if(!empty($row['Run']) && $row['Cod Grado'] == $getCurso[0]->codigo && $row['Letra Curso'] == $getCurso[0]->letra){

							$getcaso = $this->casos_model->get('*',array('rut' => $row['Run'] . '-' . $row['Dígito Ver.']));
							if(empty($getcaso)){

								$nombreCuenta = $row['Run'].'@alumno';
								$additional_data = array(
									'first_name' => $row['Nombres'],
									'last_name' => $row['Apellido Paterno'] .' '.$row['Apellido Materno'],
									'company' => $this->input->post('colegiosselect'),
									'phone' => empty($row['Telefono']) ? 'Sin Información' : $row['Telefono'],
									'rut' => $row['Run'] . '-' . $row['Dígito Ver.'],
								);
								$idCuentaE = $this->ion_auth->register($nombreCuenta, $row['Run'], $nombreCuenta, $additional_data, array('9'));

								$nombreCuenta = $row['Run'].'@apoderado';
								$additional_data = array(
									'first_name' => 'Apoderado',
									'last_name' => 'Apoderado',
									'company' => $this->input->post('colegiosselect'),
									'phone' => empty($row['Telefono']) ? 'Sin Información' : $row['Telefono'],
									'rut' => 'NoSet',
								);

								$idCuentaA = $this->ion_auth->register($nombreCuenta, $row['Run'], $nombreCuenta, $additional_data, array('7'));

								$caso = array(
									'rut' => $row['Run'] . '-' . $row['Dígito Ver.'],
									'nombres' => $row['Nombres'],
									'apellido_p' => $row['Apellido Paterno'],
									'apellido_m' => $row['Apellido Materno'],
									'genero' => $row['Genero'],
									'nacimiento' => date('Y-m-d', strtotime($row['Fecha Nacimiento'])),
									'user_id' => $idCuentaE,
									'apoderado_user_id' => $idCuentaA,
								);

								$idcaso = $this->casos_model->add_id($caso);
								$this->ion_auth->update($idCuentaE, array('sector' => $idcaso));
								$this->ion_auth->update($idCuentaA, array('sector' => $idcaso));

								$en_colegio = array(
						    		'id_caso' => $idcaso,
						    		'id_colegio' => $this->input->post('colegiosselect'),
						    		'estado' => '1',
						    	);
						    	$this->En_colegio_model->add($en_colegio);

						    	$en_curso = array(
						    		'id_caso' => $idcaso,
						    		'id_curso' => $this->input->post('cursosselect'),
						    		'estado' => '1',
						    	);
						    	$this->En_curso_model->add($en_curso);
							}	else{

									$listaColegios = $this->En_colegio_model->get('*',array('id_caso' => $getcaso[0]->id));
									foreach ($listaColegios as $key => $value) {
										$this->En_colegio_model->update(array('estado' => 0), array('id' => $value->id));
									}
									$en_colegio = array(
							    		'id_caso' => $getcaso[0]->id,
							    		'id_colegio' => $this->input->post('colegiosselect'),
							    		'estado' => '1',
							    	);
							    	$this->En_colegio_model->add($en_colegio);

							    	$listaCursos = $this->En_curso_model->get('*', array('id_caso' => $getcaso[0]->id));
							    	foreach ($listaCursos as $key => $value) {
							    		$this->En_curso_model->update(array('estado' => 0), array('id' => $value->id));
							    	}
							    	$en_curso = array(
							    		'id_caso' => $getcaso[0]->id,
							    		'id_curso' => $this->input->post('cursosselect'),
							    		'estado' => '1',
							    	);
							    	$this->En_curso_model->add($en_curso);
								}
						}
					}
					$this->data['messages'] = $this->bootstrap->alert('success', 'Se cargó exitosamente el Excel');
					$this->view_handler->view('administrador/casos', 'inicio', $this->data);
				}
			}
		} else {
			$error_files = $this->upload->display_errors('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>', '</div>');
			$this->data['messages'] = $error_files;
			$this->view_handler->view('administrador/casos', 'inicio', $this->data);
		}
    }

    public function template_xlsx(){
		$this->excel->writeXLSX('', 'casos', 'template_casos', array('Año','RBD', 'Cod Tipo Enseñanza', 'Cod Grado', 'Desc Grado', 'Letra Curso', 'Run', 'Dígito Ver.', 'Genero', 'Nombres','Apellido Paterno','Apellido Materno','Dirección','Comuna Residencia','Código Comuna Residencia','Email','Telefono','Celular','Fecha Nacimiento','Código Etnia','Fecha Incorporación Curso','Fecha Retiro','%Asistenca','Promedio Final'));
	}


	//ADMINISTRACON DE  COLEGIOS Y CURSOS
	public function colegios(){
		$this->data['menu_items'][] = 'colegios';
		$this->data['breadcrumb'][] = array(
			'name' => 'Administración de colegios'
		);
		$this->data['message'] = $this->session->flashdata('message');
		$this->view_handler->view('administrador/colegios', 'inicio', $this->data);
	}

	public function add_colegio(){
		$this->data['menu_items'][] = 'colegios';
		$this->data['breadcrumb'][] = array(
			'name' => 'Registrar Colegio'
		);

		$config = array(
			array(
				'field' => 'nombre',
				'label' => '<b>Nombre colegio</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'codigo',
				'label' => '<b>Código</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'direccion',
				'label' => '<b>Dirección</b>',
				'rules' => 'trim'
			)
		);
		$this->form_validation->set_rules($config);
	    
	    if($this->form_validation->run() === FALSE){
	    	!empty($this->input->post('nombre')) ? $this->data['nombre'] = $this->input->post('nombre') : $this->data['nombre'] = NULL;
	    	!empty($this->input->post('codigo')) ? $this->data['codigo'] = $this->input->post('codigo') : $this->data['codigo'] = NULL;
	    	!empty($this->input->post('direccion')) ? $this->data['direccion'] = $this->input->post('direccion') : $this->data['direccion'] = NULL;
	    	$this->view_handler->view('administrador/colegios', 'agregar', $this->data);
	    }	else{
		    	$colegio = array(
		    		'codigo_colegio' => $this->input->post('codigo'),
		    		'nombre' => $this->input->post('nombre'),
		    		'direccion' => !empty($this->input->post('direccion')) ? $this->input->post('direccion') : " ",
		    	);

		    	if($this->Colegios_model->add($colegio)) {
	        		//$this->session->set_flashdata('message', $this->bootstrap->alert('success', "Se creó exitosamente el."));
	        		$this->data['nombre'] = $this->input->post('nombre');
	        		$this->data['codigo'] = $this->input->post('codigo');
	        		$this->view_handler->view('administrador/colegios', 'agregarTRUE', $this->data);
	        	} 	else {
	        			$this->data['errors']['Base de datos'] =  'No se pudo almacenar los datos.';
	        			$this->view_handler->view('administrador/colegios', 'agregar', $this->data);
	        		}

	    	}	
	}

	public function edit_colegio($id = null){
		$getColegio = $this->Colegios_model->get('*', array('id' => $id))[0];
		$this->data['id_colegio'] = $id;
		$this->data['menu_items'][] = 'colegios';
		$this->data['breadcrumb'][] = array(
			'name' => 'Administración de colegio',
			'link' =>  site_url('Administrador/colegios')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Editar: ' . $getColegio->nombre,
		);
		
		$config = array(
			array(
				'field' => 'nombre',
				'label' => '<b>Nombre colegio</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'codigo',
				'label' => '<b>Código</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'direccion',
				'label' => '<b>Dirección</b>',
				'rules' => 'trim'
			)
		);

		$this->form_validation->set_rules($config);
	    if($this->form_validation->run() === FALSE){
	    	!empty($this->input->post('nombre')) ? $this->data['nombre'] = $this->input->post('nombre') : $this->data['nombre'] = $getColegio->nombre;

	    	!empty($this->input->post('codigo')) ? $this->data['codigo'] = $this->input->post('codigo') : $this->data['codigo'] = $getColegio->codigo_colegio;
	    	!empty($this->input->post('direccion')) ? $this->data['direccion'] = $this->input->post('direccion') : $this->data['direccion'] = $getColegio->direccion;
	    	$this->view_handler->view('administrador/colegios', 'editar', $this->data);
	    }	else{
	    		$colegio = array(
		    		'codigo_colegio' => $this->input->post('codigo'),
		    		'nombre' => $this->input->post('nombre'),
		    		'direccion' => !empty($this->input->post('direccion')) ? $this->input->post('direccion') : " ",
		    	);

		    	if($this->Colegios_model->update($colegio, array('id' => $id))) {
	        		//$this->session->set_flashdata('message', $this->bootstrap->alert('success', "Se creó exitosamente el."));
	        		$this->data['nombre'] = $this->input->post('nombre');
	        		$this->data['codigo'] = $this->input->post('codigo');
	        		$this->view_handler->view('administrador/colegios', 'editarTRUE', $this->data);
	        	} 	else {
	        			$this->data['errors']['Base de datos'] =  'No se pudo almacenar los datos.';
	        			$this->view_handler->view('administrador/colegios', 'editar', $this->data);
	        		}

	    	}
	}

	public function show_colegio($id = null){
		$this->data['menu_items'][] = 'colegios';
		$this->data['breadcrumb'][] = array(
			'name' => 'Administración de colegio',
			'link' =>  site_url('Administrador/colegios')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Administración de cursos'
		);
		$getColegio = $this->Colegios_model->get('*', array('id' => $id))[0];
		$this->data['nombre_colegio'] = $getColegio->nombre;
		$this->data['id_colegio'] = $id;
		$this->data['message'] = $this->session->flashdata('message');

		$this->view_handler->view('administrador/colegios', 'cursos', $this->data);
	}

	public function add_curso($id_colegio = null){
		$this->data['menu_items'] = array ('colegios');
		$this->data['id_colegio'] = $id_colegio;
		$this->data['breadcrumb'][] = array(
			'name' => 'Administración de colegio',
			'link' =>  site_url('Administrador/colegios')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Administración de cursos',
			'link' =>  site_url('Administrador/show_colegio/'. $id_colegio)
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Registrar Curso'
		);

		$config = array(
			array(
				'field' => 'nombre',
				'label' => '<b>Nombre curso</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'codigo',
				'label' => '<b>Código</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'fecha',
				'label' => '<b>Fecha</b>',
				'rules' => 'trim'
			),
			array(
				'field' => 'letra',
				'label' => '<b>Letra</b>',
				'rules' => 'trim'
			)
		);
		$this->form_validation->set_rules($config);
	    
	    if($this->form_validation->run() === FALSE){
	    	!empty($this->input->post('nombre')) ? $this->data['nombre'] = $this->input->post('nombre') : $this->data['nombre'] = NULL;
	    	!empty($this->input->post('codigo')) ? $this->data['codigo'] = $this->input->post('codigo') : $this->data['codigo'] = NULL;
	    	!empty($this->input->post('fecha')) ? $this->data['fecha'] = $this->input->post('fecha') : $this->data['fecha'] = NULL;
	    	!empty($this->input->post('letra')) ? $this->data['letra'] = $this->input->post('letra') : $this->data['letra'] = NULL;
	    	$this->view_handler->view('administrador/colegios', 'agregarCurso', $this->data);
	    }	else{
		    	$colegio = array(
		    		'id_colegio' => $id_colegio,
		    		'codigo' => $this->input->post('codigo'),
		    		'nombre' => $this->input->post('nombre'),
		    		'fecha' => !empty($this->input->post('fecha')) ? $this->input->post('fecha') : NULL,
		    		'letra' => $this->input->post('letra'),
		    	);

		    	if($this->Cursos_model->add($colegio)) {
	        		//$this->session->set_flashdata('message', $this->bootstrap->alert('success', "Se creó exitosamente el."));
	        		$this->data['nombre'] = $this->input->post('nombre');
	        		$this->data['codigo'] = $this->input->post('codigo');
	        		$this->view_handler->view('administrador/colegios', 'agregarCursoTRUE', $this->data);
	        	} 	else {
	        			$this->data['errors']['Base de datos'] =  'No se pudo almacenar los datos.';
	        			$this->view_handler->view('administrador/colegios', 'agregarCurso', $this->data);
	        		}

	    	}	
	}

	public function edit_curso($id_colegio = null, $id = null){
		$getCurso = $this->Cursos_model->get('*', array('id' => $id))[0];
		$this->data['id_curso'] = $id;
		$this->data['id_colegio'] = $id_colegio;
		$this->data['menu_items'][] = 'colegios';
		$this->data['breadcrumb'][] = array(
			'name' => 'Administración de colegio',
			'link' =>  site_url('Administrador/colegios')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Administración de cursos',
			'link' =>  site_url('Administrador/show_colegio/'. $id_colegio)
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Editar: ' . $getCurso->nombre,
		);
		
		$config = array(
			array(
				'field' => 'nombre',
				'label' => '<b>Nombre curso</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'codigo',
				'label' => '<b>Código</b>',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'fecha',
				'label' => '<b>Fecha</b>',
				'rules' => 'trim'
			)
		);

		$this->form_validation->set_rules($config);
	    if($this->form_validation->run() === FALSE){
	    	!empty($this->input->post('nombre')) ? $this->data['nombre'] = $this->input->post('nombre') : $this->data['nombre'] = $getCurso->nombre;

	    	!empty($this->input->post('codigo')) ? $this->data['codigo'] = $this->input->post('codigo') : $this->data['codigo'] = $getCurso->codigo;
	    	!empty($this->input->post('fecha')) ? $this->data['fecha'] = $this->input->post('fecha') : $this->data['fecha'] = $getCurso->fecha;
	    	$this->view_handler->view('administrador/colegios', 'editarCurso', $this->data);
	    }	else{
	    		$curso = array(
		    		'id_colegio' => $id_colegio,
		    		'codigo' => $this->input->post('codigo'),
		    		'nombre' => $this->input->post('nombre'),
		    		'fecha' => !empty($this->input->post('fecha')) ? $this->input->post('fecha') : NULL,
		    	);

		    	if($this->Cursos_model->update($curso, array('id' => $id))) {
	        		//$this->session->set_flashdata('message', $this->bootstrap->alert('success', "Se creó exitosamente el."));
	        		$this->data['nombre'] = $this->input->post('nombre');
	        		$this->data['codigo'] = $this->input->post('codigo');
	        		$this->view_handler->view('administrador/colegios', 'editarColegioTRUE', $this->data);
	        	} 	else {
	        			$this->data['errors']['Base de datos'] =  'No se pudo almacenar los datos.';
	        			$this->view_handler->view('administrador/colegios', 'editar', $this->data);
	        		}

	    	}
	}

	public function show_curso($id_curso = null, $id_colegio){
		$this->data['menu_items'][] = 'colegios';
		$this->data['breadcrumb'][] = array(
			'name' => 'Administración de colegio',
			'link' =>  site_url('Administrador/colegios')
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Administración de cursos',
			'link' =>  site_url('Administrador/show_colegio/' . $id_colegio)
		);
		$this->data['breadcrumb'][] = array(
			'name' => 'Administración de casos'
		);
		$this->data['id_curso'] = $id_curso;
		$this->data['nombreCurso'] = $this->Cursos_model->get('nombre', array('id' => $id_curso))[0]->nombre;
		$this->data['message'] = $this->session->flashdata('message');

		$this->view_handler->view('administrador/colegios', 'showCursos', $this->data);
	}

	public function ajaxColegios(){
		$respuesta = $this->Colegios_model->getColegios();
		if(!empty($respuesta)) echo json_encode($respuesta);
		 else echo json_encode(array(
                    "draw" => null,
                    "recordsTotal" => 0,
                    "recordsFiltered" => 0,
                    "data" => []
            ));
		return;
	}

	public function ajaxCursos($id_colegio = null){

		$respuesta = $this->Cursos_model->getCursos($id_colegio);

		if(!empty($respuesta)) echo json_encode($respuesta);
		 else {
		 	$data = array(
				        "draw" => null,
				        "recordsTotal" => 0,
				        "recordsFiltered" => 0,
				        "data" => [] 
				    );
			echo json_encode($data);
		 }
	}

	public function ajaxGetcasosCursos($id_curso = null){

		$respuesta = $this->casos_model->datatable($id_curso);

		if(!empty($respuesta)) echo json_encode($respuesta);
		 else {
		 	$data = array(
				        "draw" => null,
				        "recordsTotal" => 0,
				        "recordsFiltered" => 0,
				        "data" => [] 
				    );
			echo json_encode($data);
		 }
	}

	public function ajaxRemoverColegio($id = null){

		if(empty($id)) {
			$respose = $this->message_handler->get('Warning', 'EmptyIdentifier');
    		echo json_encode($respose);
    		return;
		}
	
		$colegios = $this->Colegios_model->get('*', array('id' => $id));
		if(empty($colegios)) {
			$response = $this->message_handler->get('Warning', 'DoesNotExist');
    		echo json_encode($response);
    		return;
		}

		$this->Colegios_model->remove(array('id' => $id));
		$response = $this->message_handler->get("Successful", "Remove",  $colegios[0]);
		echo json_encode($response);
		return;
	}

	public function ajaxRemoverCurso($id = null){

		if(empty($id)) {
			$respose = $this->message_handler->get('Warning', 'EmptyIdentifier');
    		echo json_encode($respose);
    		return;
		}
	
		$curso = $this->Cursos_model->get('*', array('id' => $id));
		if(empty($curso)) {
			$response = $this->message_handler->get('Warning', 'DoesNotExist');
    		echo json_encode($response);
    		return;
		}
		$this->Cursos_model->remove(array('id' => $id));
		$response = $this->message_handler->get('Successful', 'Remove', $curso[0]);
		// En construccion, falta eliminar los cursos de los alumnos asociados

		/*
		$reemplazos = $this->Reemplazo_model->get('*', array('id_centro_costo' => $id));
		if(empty($reemplazos)) {
			$this->model->remove(array('id' => $id));
			$response = $this->message_handler->get('Successful', 'Remove', $centro_costo);
    		
		} else {
			$this->model->update(array('desactivado' => 'NOT desactivado'), array('id' => $id));
			if($centro_costo->desactivado == '1') {
				$response = $this->message_handler->get('Successful', 'Activated', $centro_costo);	
			}
			else {
				$response = $this->message_handler->get('Successful', 'Disabled', $centro_costo);
			}
		}
		*/
		echo json_encode($response);
		return;
	}

	public function ajaxRemovercasoDeCurso($id = null){

		if(empty($id)) {
			$respose = $this->message_handler->get('Warning', 'EmptyIdentifier');
    		echo json_encode($respose);
    		return;
		}
	
		$caso = $this->casos_model->get('*', array('id' => $id));
		if(empty($caso)) {
			$response = $this->message_handler->get('Warning', 'DoesNotExist');
    		echo json_encode($response);
    		return;
		}

		$this->En_curso_model->remove(array('id_caso' => $id));
		$response = $this->message_handler->get("Successful", "Remove",  $caso[0]);
		// En construccion, falta eliminar los cursos

		/*
		$reemplazos = $this->Reemplazo_model->get('*', array('id_centro_costo' => $id));
		if(empty($reemplazos)) {
			$this->model->remove(array('id' => $id));
			$response = $this->message_handler->get('Successful', 'Remove', $centro_costo);
    		
		} else {
			$this->model->update(array('desactivado' => 'NOT desactivado'), array('id' => $id));
			if($centro_costo->desactivado == '1') {
				$response = $this->message_handler->get('Successful', 'Activated', $centro_costo);	
			}
			else {
				$response = $this->message_handler->get('Successful', 'Disabled', $centro_costo);
			}
		}
		*/
		echo json_encode($response);
		return;
	}
	
	/*public function bombero(){
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
	 
		$id_curso = 3; 
		$id_caso = $this->En_curso_model->idporcurso($id_curso);
		$x = 0;
		for ($i=0; $i < sizeof($id_caso); $i++){ 
		    $int = (int)$id_caso[$i]->id_caso;
		    $estudi[$i] = $this->casos_model->bombero($int);
		    $casos = array(
		        'rut' => $estudi[$i][0],
	        	'nombres' => $estudi[$i][1],
	        	'apellido_p' => $estudi[$i][2],
	        	'apellido_m' => $estudi[$i][3],
	        	'nacimiento' => $estudi[$i][4],
	        	'direccion' => $estudi[$i][5],
	        	'apoderado' => $estudi[$i][6],
	        	'apoderado_s' => $estudi[$i][7],
	        	'cesfam' => $estudi[$i][8],
	        	'enfermedades' => $estudi[$i][9],
	        	'alergias' => $estudi[$i][10],
		    );
		    $id_procedimientos[$i] = $this->procedimientoses_model->bombero($int);
		    if ($id_procedimientos[$i] != NULL) {
    			$carac_activas = (int)$id_procedimientos[$i];
    			$actividad1[$x] = $this->Actividad1d_model->bombero($carac_activas);
    			$actividad1d = array(
	        	    'id_procedimientos' => $actividad1[$x][0],
			    	'ingreso' => $actividad1[$x][1],
	            	'integrantes' => $actividad1[$x][2],
	            	'habitaciones' => $actividad1[$x][3],
    	        	'servicios' => $actividad1[$x][4],
	        	    'RAE' => $actividad1[$x][5],
	        	    'preferente' => $actividad1[$x][6],
	        	    'prioritario' => $actividad1[$x][7],
	            );
    			$listanueva = [];
    			$L[$x] = $this->Actividad1dtest_model->bombero($carac_activas);
    			$count = 0;
    			if(!empty($L[$x])){
    			    for ($w=0; $w < sizeof($L[$x]); $w++){ 
    			        $listan[$w] = (string)$L[$x][$w]->lista_test;
    			        $testadded = array(
			       			'lista_test' => $listan[$w],
			       		);
			       		$listanueva[$count] = $testadded;
	                    $count++;
    			    }
    			}
                $listanueva_2 = [];
                $count_2 = 0;
    			$L2[$x]= $this->Actividad1_colegio_anterior_model->bombero($carac_activas);
    			for ($y=0; $y < sizeof($L2[$x]); $y++){
    			    $listan_2[$y] = (string)$L2[$x][$y]->nombre_colegio;
    			    $colan = array(
			       		'nombre_colegio' => $listan_2[$y],
			       	);
			       	$listanueva_2[$count_2] = $colan;
			       	$count_2++;
    			}
    			var_dump($listanueva_2);
    			
    			$listanueva_3 = [];
	            $count_3 = 0;
    			$L3[$x]= $this->Actividad1_cursos_repetidos_model->bombero($carac_activas);
    			$L32[$x]= $this->Actividad1_cursos_repetidos_model->bombero2($carac_activas);
    			for ($z=0; $z < sizeof($L3[$x]); $z++){ 
    		        $lista_3[$z]= (string)$L3[$x][$z]->curso;
    		        $lista_32[$z]= (string)$L32[$x][$z]->causa;
    		        $curcau = array(
						'causa' => $lista_32[$z],
						'curso' => $lista_3[$z],
		       		);
		       		$listanueva_3[$count_3] = $curcau;
		       		$count_3++;
    			}
			
    			$this->createpdf($casos, $actividad1d['id_procedimientos'], $actividad1d, $listanueva, $listanueva_2, $listanueva_3, $int); 
    			$x++;
		    }
		}
	}*/
	
	/*public function createpdf($casos = null, $id_procedimientos = null, $actividad1d = null, $listaTest = null, $listaColegios = null, $listaCursos = null, $id_caso = null){
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
	}*/
}
