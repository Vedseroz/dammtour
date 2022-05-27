<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Localidad_model extends CI_model {
	public function __construct() {
		$table = 'localidad';
        parent::__construct($table);
    }
    

    public function datatable(){
        $table = 'localidad';
        $primarykey = 'localidad.id_pasajero';
        $columns = array(
            array('db'=>'localidad.id_localidad','dt'=>'id_localidad'),
            array('db'=>'localidad.pais','dt'=>'pais'),
            array('db'=>'localidad.ciudad','dt'=>'ciudad'),
            
            
        );
        $data = $this->data_tables->complex($_POST,$table,$primarykey,$columns);
        return $data;
    }

    public function getpaises(){                //funcion para obtener la lista de paises
        $query = $this->db->query('SELECT pais FROM localidad GROUP BY pais');
        $data = $query->result_array();
        return $data;
    }

    public function getLocalidades(){                 //funcion para obtener un arreglo con todas las localidades
        $query = $this->db->query('SELECT * FROM localidad');
        $data = $query->result_array();
        return $data;
    }

    public function getLocalidadByid($id_localidad){       //funcion para obtener una localidad a partir de su identificador.
        $query = $this->db->query('SELECT * FROM localidad WHERE id_localidad = '.$id_localidad);
        $data = $query->result();
        foreach ($data as $value){
            $new_data['id_localidad'] = $value->id_localidad;
            $new_data['pais'] = $value->pais;
            $new_data['ciudad'] = $value->ciudad;
        }   
        return $new_data;
    }

    /*public function getLocalidadPorPais($pais){
        $query = $this->db->query("SELECT * FROM localidad WHERE pais = ".$pais);
        $data = $query->result_array();
        return $data;
    }*/

}