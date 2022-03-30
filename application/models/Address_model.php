<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Address_model extends General_model {
	public function __construct() {
		$table = 'address';
        parent::__construct($table);
    }

    public function address($id = null, $data = null, $hoy = null) {
        $value = $data['direccion'];
        $this->db->query("INSERT INTO address (id_caso, direccion, fecha) VALUES ($id, '$value', '$hoy');");
    }

    public function getaddress($id = null){
        $query = $this->db->get_where('address',array('address.id_caso' => $id));
        $data = $query->result_array();
        $values = array_column($data,'direccion');
        return $values;
    }

    public function getfechas($id = null){
        $query = $this->db->get_where('address',array('address.id_caso' => $id));
        $data = $query->result_array();
        $values = array_column($data,'fecha');
        return $values;
    }
}