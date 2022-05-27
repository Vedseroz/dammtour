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
            array('db'=>'hospedaje.posada','dt'=>'posada'),
            array('db'=>'hospedaje.id_cliente','dt'=>'id_cliente'),
            array('db'=>'hospedaje.id_transfer','dt'=>'id_transfer'),
            array('db'=>'hospedaje.fecha_id','dt'=>'fecha_id'),
            array('db'=>'hospedaje.localidad_id','dt'=>'localidad_id'),

        );
        $data = $this->data_tables->complex($_POST,$table,$primarykey,$columns);
        return $data;
    }

    public function getHospedajePorPais($id_localidad){   //esta funcion devuelve los datos del hospedaje segun la localidad asociada. 
        $query = $this->db->query('SELECT * FROM hospedaje WHERE id_localidad = '.$id_localidad);
        $data = $query->result();
        return $data;
    }
}