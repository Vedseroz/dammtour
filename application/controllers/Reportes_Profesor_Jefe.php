<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_Profesor_Jefe extends CI_Controller {
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
        $this->load->model('Rep_to_derivacion_model'); 
        $this->load->model('Rep_to_externo_model');
        $this->load->model('Rep_externo_model');
        $this->load->model('Full_habytal_model');
        $this->load->model('Full_otros_model');
        $this->load->model('En_colegio_model');
        $this->load->model('En_curso_model');
        $this->load->model('Colegios_model');
        $this->load->model('Cursos_model');
        $this->load->helper('url');

        $this->load->library('upload');
        $this->load->helper(array('date','download', 'file', 'html'));

    //$this->load->model('');

        if($this->ion_auth->in_group(3)){
            $this->data['avatar'] = 'profesor.jpg';
            $this->data['avatar_descrip'] = 'Imagen avatar Usuario 1';
            $this->data['avatar_nombre'] = 'Usuario 1';
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

    public function Reportes($id_caso){
        if(!$this->ion_auth->in_group(3)) redirect(site_url('Inicio'), 'location');

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
        $this->view_handler->view('Usuario1', 'Reportes', $this->data);
    }

    public function Procedimientos(){
        $id_caso = $this->input->post('$id');
        if($this->ion_auth->in_group(3)){
            $data = $this->Rep_to_procedimientos_model->procedimientos($id_caso);
            echo json_encode($data);
            return;
        }
    }

    public function downloadcarac($id = null){
        $ruta = $this->Rep_to_procedimientos_model->Reportesproc($id);
        $filepath = './files/Reportes/crtz/Usuario1/procedimientos '.$id.' '.$ruta[0].' completa.pdf';
        force_download($filepath, NULL);
    }

    public function Derivacion(){
        $id_caso = $this->input->post('$id');
        if($this->ion_auth->in_group(3)){
            $data = $this->Rep_to_derivacion_model->Derivacion($id_caso);
            echo json_encode($data);
            return;
        }
    }

    public function downloadderiv($id = null){
        $ruta = $this->Rep_to_derivacion_model->ReportesDRVZ($id);
        $tipo = (int) $ruta[2];
        if ($tipo == 1) {
            $filepath = './files/Reportes/drvz/Usuario1/Derivación por Habilidad '.$id.' '.$ruta[0].'.pdf';
        }elseif($tipo == 3){
            $filepath = './files/Reportes/drvz/Usuario1/Derivación por convivencia MEDIACIÓN ESCOLAR '.$id.' '.$ruta[0].'.pdf';
        }elseif($tipo == 4){
            $filepath = './files/Reportes/drvz/Usuario1/Derivación por convivencia RED INTERNA '.$id.' '.$ruta[0].'.pdf';
        }elseif($tipo == 5){
            $filepath = './files/Reportes/drvz/Usuario1/Derivación por convivencia RED EXTERNA '.$id.' '.$ruta[0].'.pdf';
        }
        force_download($filepath, NULL);
    }

    public function Habytal(){
        $id_caso = $this->input->post('$id');
        if($this->ion_auth->in_group(3)){
            $data = $this->Full_habytal_model->Indicadores($id_caso);
            echo json_encode($data);
            return;
        }
    }

    public function downloadgabytal($id = null, $tipo){
        if($tipo == 1){
            $ruta = $this->Rep_to_procedimientos_model->Reportesproc($id);
            $filepath = './files/Reportes/indicadores/procedimientos '.$id.' Habilidades y talentos de '.$ruta[0].' '.$ruta[2].'.pdf';
        }elseif($tipo == 2){
            $ruta = $this->Rep_to_derivacion_model->ReportesDRVZ($id);
            $filepath = './files/Reportes/indicadores/Derivación '.$id.' por Habilidades y talentos de '.$ruta[0].' '.$ruta[3].'.pdf';
        }elseif($tipo == 3){
            $ruta = $this->Rep_to_derivacion_model->ReportesDRVZ($id);
            $filepath = './files/Reportes/indicadores/Derivación '.$id.' por Mediación escolar '.$ruta[0].' '.$ruta[3].'.pdf';
        }elseif($tipo == 4){
            $ruta = $this->Rep_to_derivacion_model->ReportesDRVZ($id);
            $filepath = './files/Reportes/indicadores/Derivación '.$id.' por Red interna '.$ruta[0].' '.$ruta[3].'.pdf';
        }elseif($tipo == 5){
            $ruta = $this->Rep_to_derivacion_model->ReportesDRVZ($id);
            $filepath = './files/Reportes/indicadores/Derivación '.$id.' por Red externa '.$ruta[0].' '.$ruta[3].'.pdf';
        }
        force_download($filepath, NULL);
    }

    public function Otros(){
        $id_caso = $this->input->post('$id');
        if($this->ion_auth->in_group(3)){
            $data = $this->Full_otros_model->Otros($id_caso);
            echo json_encode($data);
            return;
        }
    }

    public function downloadotros($tipo, $fecha, $id){    
        $caso = $this->casos_model->caso($id);
        if($tipo == 1){
            $filepath = './files/Reportes/indicadores/Indicadores de emoción de '.$caso[2].' '.$caso[3].' '.$caso[4].' '.$fecha.'.pdf';
        }elseif($tipo == 2){
            $filepath = './files/Reportes/indicadores/Indicador de georeferencia '.$caso[2].' '.$caso[3].' '.$caso[4].' '.$fecha.'.pdf';
        }
        force_download($filepath, NULL);
    }

    public function Extra(){
        $id_caso = $this->input->post('$id');
        if($this->ion_auth->in_group(3)){
            $data = $this->Rep_to_externo_model->Externo($id_caso);
            echo json_encode($data);
            return;
        }
    }

    public function download_extra($id){
        $ruta = $this->Rep_to_externo_model->ReportesXTRN($id);
        $filepath = './files/Reportes/otros/'.$ruta;
        force_download($filepath, NULL);
    }

    public function Reportes_extra($id = null){
        if(empty($_FILES['File']['name'])){
            $config = array(
                array(
                    'field' => 'File',
                    'label' => '<b>Documento externo</b>',
                    'rules' => "required"
                )
            );
        }else{
            $config = array(
                array(
                    'field' => 'File',
                    'label' => '<b>Documento externo</b>',
                    'rules' => "trim"
                )
            );
        }
        $hoy = date('Y-m-d');
        $this->form_validation->set_rules($config);
        
        if($this->form_validation->run() === FALSE){
            $post = !empty($this->input->post());   
        }else{
            $filename = $_FILES['File']['name'];
            if(!empty($_FILES['File']['name'])){
                $uploadPath = './files/Reportes/otros/';
                $config = array(
                    'upload_path' => $uploadPath,
                    'allowed_types' => '*',
                    'overwrite' => false
                );
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('File')){
                    echo $this->upload->display_errors();
                    return;
                }            
            }

            $externo = array(
                'id_caso' => $id, 
                'fecha' => $hoy,
                'filename' => $filename
            );

            $this->Rep_externo_model->add($externo);    
            $this->Reportes($id);
        }
    }
}