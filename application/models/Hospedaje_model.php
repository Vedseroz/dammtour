<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Hospedaje_model extends CI_model {
	public function __construct() {
		$table = 'hospedaje';
        parent::__construct($table);
    }

    public function datatable(){
        $table = 'hospedaje';
        $primarykey = 'hospedaje.id_pasajero';
        $columns = array(
            array('db' => 'hospedaje.id_hospedaje' , 'dt'=>'id_hospedaje' ),
            array('db' => 'hospedaje.nombre_hospedaje' , 'dt'=>'nombre_hospedaje' ),
            array('db' => 'hospedaje.direccion_hospedaje' , 'dt'=>'direccion_hospedaje' ),
            array('db' => 'hospedaje.ciudad' , 'dt'=>'ciudad' ),
            array('db' => 'hospedaje.comuna' , 'dt'=>'comuna' ),
            array('db' => 'hospedaje.pais' , 'dt'=>'pais' ),
            array('db' => 'hospedaje.telefono_hospedaje' , 'dt'=>'telefono_hospedaje' ) 
        );
        $data = $this->data_tables->complex($_POST,$table,$primarykey,$columns);
        return $data;
    }

    public function InsertarHospedaje($data){
        $this->db->insert('hospedaje',$data);
    }

}