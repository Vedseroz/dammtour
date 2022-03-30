<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Casos_model extends General_model {
	public function __construct() {
		$table = 'estudiantes';
        parent::__construct($table);
    }

    public function datatable($id_curso = null) {
    	$table = 'estudiantes';
    	$primaryKey = 'estudiantes.id';
    	$whereResult = null;
    	$whereAll = "en_curso.id_curso = '". $id_curso. "'";
    	$join = 'LEFT JOIN en_curso ON estudiantes.id = en_curso.id_caso';
		$columns = array(
			array( 'db' => 'estudiantes.id', 'dt' => 'id' ),
			array( 'db' => 'estudiantes.rut', 'dt' => 'rut' ),
			array( 'db' => 'estudiantes.nombres', 'dt' => 'nombres' ),
			array( 'db' => 'estudiantes.apellido_p', 'dt' => 'apellido_p' ),
			array( 'db' => 'estudiantes.apellido_m', 'dt' => 'apellido_m' ),
			array( 'db' => 'estudiantes.nacimiento', 'dt' => 'nacimiento' ),
		);
    	$data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll, $join);
        return $data;
    }

    public function getCaso(){
        $this->db->order_by('id','ASC');
        $query  = $this->get('*', array());
        foreach($query as $value){
            $data[] = $value->nombres.' '.$value->apellido_p;
        }
        return $data;
    }

    public function getidbyname($name = null) {
        $this->db->from('estudiantes');
        $nombres = explode(" ", $name);
        $this->db->where('estudiantes.apellido_p',$nombres[1]);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = $data['id'];
        }
        return $values;
    }


    public function getEmail($id = null) {
        $this->db->from('estudiantes');
        $this->db->where('estudiantes.id',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = $data['correo'];
        }
        return $values;
    }

    public function caso($id = null) {
        $this->db->from('estudiantes');
        $this->db->where('estudiantes.id',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = [$data['id'],$data['rut'],$data['nombres'],$data['apellido_p'],$data['apellido_m'], $data['direccion']];
        }
        return $values;
    }

    public function casoporid($id = null) {
        $this->db->from('estudiantes');
        $this->db->where('estudiantes.user_id',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = $data['id'];
        }
        return $values;
    }

    public function casoporapoderado($id = null) {
        $this->db->from('estudiantes');
        $this->db->where('estudiantes.apoderado_user_id',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = $data['id'];
        }
        return $values;
    }    

    public function IDapoderado($id = null) {
        $this->db->from('estudiantes');
        $this->db->where('estudiantes.id',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = [$data['apoderado_user_id']];
        }
        return $values;
    }

    public function address($id = null) {
        $this->db->from('estudiantes');
        $this->db->where('estudiantes.user_id',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = $data['direccion'];
        }
        return $values;
    }

    public function actualizar($user, $data){
        $value = $data['direccion'];
        $this->db->query("UPDATE estudiantes SET direccion='$value' WHERE user_id= $user;");
    }
    
    public function bombero($id = null) {
        $this->db->from('estudiantes');
        $this->db->where('estudiantes.id',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = [$data['rut'],$data['nombres'],$data['apellido_p'],$data['apellido_m'],$data['nacimiento'],$data['direccion'],$data['apoderado'],$data['apoderado_s'],$data['cesfam'],$data['enfermedades'],$data['alergias']];
        }
        return $values;
    }
}