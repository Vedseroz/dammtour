<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Chofer_model extends CI_model {
	public function __construct() {
		$table = 'chofer';
        parent::__construct($table);
    }

    public function datatable(){
        $table = 'chofer';
        $primarykey = 'chofer.id_chofer';
        $columns = array(
            array('db'=>'chofer.id_chofer','dt'=>'id_chofer'),
            array('db'=>'chofer.nombre_chofer','dt'=>'nombre_chofer'),
            array('db'=>'chofer.apellido_chofer','dt'=>'apellido_chofer'),
            array('db'=>'chofer.rut','dt'=>'rut'),
        );
        $data = $this->data_tables->complex($_POST,$table,$primarykey,$columns);
        return $data;
    }

    public function InsertarChofer($data){
        $this->db->insert('chofer',$data);
    }

}