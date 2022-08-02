<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Vehiculo_model extends CI_model {
	public function __construct() {
		$table = 'vehiculo';
        parent::__construct($table);
    }

    public function datatable(){
        $table = 'vehiculo';
        $primarykey = 'vehiculo.id_chofer';
        $columns = array(
            array('db'=>'vehiculo.id_vehiculo','dt'=>'id_vehiculo'),
            array('db'=>'vehiculo.marca','dt'=>'marca'),
            array('db'=>'vehiculo.modelo','dt'=>'modelo'),
            array('db'=>'vehiculo.tipo','dt'=>'tipo'),
            array('db'=>'vehiculo.patente','dt'=>'patente'),
            array('db'=>'vehiculo.cant_pasajeros','dt'=>'cant_pasajeros'),
        );
        $data = $this->data_tables->complex($_POST,$table,$primarykey,$columns);
        return $data;
    }

    public function InsertarVehiculo($data){
        $this->db->insert('vehiculo',$data);
    }

}