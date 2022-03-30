<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Groups_cc_email_model extends General_model {
	public function __construct() {
		$table = 'groups_cc_email';
        parent::__construct($table);
    }

    public function getmail($id = null, $group = null) {
        $this->db->from('groups_cc_email');
        $this->db->where('groups_cc_email.id_colegio',$id);
        $this->db->where('groups_cc_email.group_id',$group);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = [$data['email'], $data['first_name']];
        }
        return $values;
    }    

    public function getmailprofe($colegio = null, $curso = null, $grupo = null) {
        $this->db->from('groups_cc_email');
        $this->db->where('groups_cc_email.id_colegio',$colegio);
        $this->db->where('groups_cc_email.id_curso',$curso);
        $this->db->where('groups_cc_email.group_id',$grupo);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = [$data['email'], $data['first_name']];
        }
        return $values;
    }        
}