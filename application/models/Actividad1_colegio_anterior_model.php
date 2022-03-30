<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Actividad1_colegio_anterior_model extends General_model {
	public function __construct() {
		$table = 'actividad1_colegio_anterior';
        parent::__construct($table);
    }
    
    public function bombero($id = null) {
        $this->db->from('actividad1_colegio_anterior');
        $this->db->where('actividad1_colegio_anterior.id_procedimientos',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $this->get('nombre_colegio', array('id_procedimientos' => $id));
            $values = $data;
        }
        return $values;
    }
}