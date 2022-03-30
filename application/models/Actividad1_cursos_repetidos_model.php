<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Actividad1_cursos_repetidos_model extends General_model {
	public function __construct() {
		$table = 'actividad1_cursos_repetidos';
        parent::__construct($table);
    }
    
    public function bombero($id = null) {
        $this->db->from('actividad1_cursos_repetidos');
        $this->db->where('actividad1_cursos_repetidos.id_procedimientos', $id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $this->get('curso', array('id_procedimientos' => $id));
            $values = $data;
        }
        return $values;
    }
    
     public function bombero2($id = null) {
        $this->db->from('actividad1_cursos_repetidos');
        $this->db->where('actividad1_cursos_repetidos.id_procedimientos', $id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $this->get('causa', array('id_procedimientos' => $id));
            $values = $data;
        }
        return $values;
    }
}