<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Emotions_2d_model extends General_model {
	public function __construct() {
		$table = 'emotions_2d';
        parent::__construct($table);
    }
    
    public function getemotions($param = null){
        $query = $this->db->get_where('emotions_2d',array('emotions_2d.id_caso' => $param),3);
        $data = $query->result_array();
		$values = array_column($data,'emotion');
        return $values;
    }

    public function last_ten_emo($param = null){
        $query = $this->db->get_where('emotions_2d',array('emotions_2d.id_caso' => $param),10);
        $data = $query->result_array();
        $values = array_column($data,'emotion');
        return $values;
    }

    public function last_ten_ctrz($param = null){
        $query = $this->db->get_where('emotions_2d',array('emotions_2d.id_caso' => $param),10);
        $data = $query->result_array();
        $values = array_column($data,'fecha');
        return $values;
    }
}