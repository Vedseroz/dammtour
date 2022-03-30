<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class En_curso_model extends General_model {
	public function __construct() {
		$table = 'en_curso';
        parent::__construct($table);
    }
    
    public function idporcurso($id = null) {
        $this->db->from('en_curso');
        $this->db->where('en_curso.id_curso',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $this->get('id_caso', array('id_curso' => $id));
            $values = $data;
        }
        return $values;
    }
}