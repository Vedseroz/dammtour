<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_PIE extends CI_Controller {
    private $data = array();

    public function __construct(){
        parent::__construct();
        $this->ion_auth->redirectLoginIn();
        $this->data['breadcrumb'] = array(
            array(
                'name' => 'Inicio',
                'link' =>  site_url('inicio/index')
            ),
            array(
                'name' => 'Reportes',
                'link' =>  site_url('casos')
             )
        );

        $this->data['menu_items'] = array(
        'reporte'
        );
    //Models
        $this->load->model('casos_model'); 
        $this->load->model('Rep_to_procedimientos_model'); 
        $this->load->model('En_colegio_model');
        $this->load->model('En_curso_model');
        $this->load->model('Colegios_model');
        $this->load->model('Cursos_model');
        $this->load->helper('url');

        $this->load->library('upload');
        $this->load->helper(array('date','download', 'file', 'html'));

    //$this->load->model('');
    
    
        if($this->ion_auth->in_group(5)){
            $this->data['avatar'] = 'avatar4.png';
            $this->data['avatar_descrip'] = 'Imagen avatar PIE';
            $this->data['avatar_nombre'] = 'Educador PIE';
        }

        if($this->ion_auth->in_group(array(1,2,3,4,5,6,7,8))){
            $idCuenta = $this->session->userdata('user_id');
            $uploadPath = './files/avatar/cuentas/' .$idCuenta. '/';
            $map = directory_map($uploadPath,1);
            if(!empty($map)) $this->data['avatarP'] = 'files/avatar/cuentas/' .$idCuenta. '/'. $map[0];
        }
    }

    public function Reportes($id_caso){
        if(!$this->ion_auth->in_group(5)) redirect(site_url('Inicio'), 'location');

        $avatarPath = './files/avatar/casos/' .$id_caso. '/';
        $map = directory_map($avatarPath,1);
        if(!empty($map)) $this->data['avatarE'] = 'files/avatar/casos/' .$id_caso. '/'. $map[0];

    //MENU INFORMACION caso
        $components = new stdClass();
        $this->data['caso'] = $this->casos_model->get('*', array('id' => $id_caso));
        $this->data['breadcrumb'][] = array(
            'name' => 'Reportes del alumno: ' .$this->data['caso'][0]->nombres ,
        );
        $datoscaso = $this->casos_model->get('*', array('id' => $id_caso))[0];
    
        $id_colegio = $this->En_colegio_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_colegio;
        $this->data['colegio'] = $this->Colegios_model->get('*', array('id' => $id_colegio));
        
        $id_curso = $this->En_curso_model->get('*', array('id_caso' => $id_caso, 'estado' => TRUE))[0]->id_curso;
        $this->data['curso'] = $this->Cursos_model->get('*', array('id' => $id_curso));
    
        $components->infoBasica = $this->load->view('infoBasica', $this->data, true);
        $this->data['components'] = $components;
        
    //VIEW_HANDLER
        $this->view_handler->view('PIE', 'Reportes', $this->data);
    }

    public function procedimientos(){
        $id_caso = $this->input->post('$id');
        if($this->ion_auth->in_group(5)){
            $data = $this->Rep_to_procedimientos_model->procedimientos($id_caso);
            echo json_encode($data);
            return;
        }
    }

    public function downloadcarac($id = null){
        $ruta = $this->Rep_to_procedimientos_model->Reportesproc($id);
        $filepath = './files/Reportes/crtz/PIE/procedimientos '.$id.' '.$ruta[0].' '.$ruta[1].'.pdf';

        force_download($filepath, NULL);
    }
}