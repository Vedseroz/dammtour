<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Actividad1dtest_model extends General_model {
	public function __construct() {
		$table = 'actividad1dtest';
        parent::__construct($table);
    }
    
    public function bombero($id = null) {
        $this->db->from('actividad1dtest');
        $this->db->where('actividad1dtest.id_derivacion',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $this->get('lista_test', array('id_derivacion' => $id));
            $values = $data;
        }
        return $values;
    }
}