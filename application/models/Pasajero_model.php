<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pasajero_model extends CI_model {
	public function __construct() {
		$table = 'pasajero';
        parent::__construct($table);
    }
    

    public function datatable(){
        $table = 'pasajero';
        $primarykey = 'pasajero.id_pasajero';
        $columns = array(
            array('db'=>'pasajero.id_pasajero','dt'=>'id_pasajero'),
            array('db'=>'pasajero.nombre','dt'=>'nombre'),
            array('db'=>'pasajero.apellido','dt'=>'apellido'),
            array('db'=>'pasajero.telefono','dt'=>'telefono'),
            array('db'=>'pasajero.email','dt'=>'email'),
            array('db'=>'pasajero.observacion','dt'=>'observacion'),
            array('db' =>'pasajero.servicio','dt'=>'servicio'),
            array('db'=>'pasajero.acompa','dt'=>'acompa'),
            array('db'=>'pasajero.fecha_id','dt'=>'fecha_id')

        );
        $data = $this->data_tables->complex($_POST,$table,$primarykey,$columns);
        return $data;
    }

    public function getPasajeros(){
        $query = $this->db->query('SELECT * FROM pasajero');
        $data = $query->result_array();
        return $data;
    }

    public function getDatosPasajeros(){
        $table = 'datos_pasajeros';
        $primaryKey = 'id_pasajero';
        $whereResult = null;
        $columns = array(
            array('db'=>'datos_pasajeros.id_pasajero','dt'=>'id_pasajero'),
            array('db'=>'datos_pasajeros.nombre','dt'=>'nombre'),
            array('db'=>'datos_pasajeros.apellido','dt'=>'apellido'),
            array('db'=>'datos_pasajeros.telefono','dt'=>'telefono'),
            array('db'=>'datos_pasajeros.fecha_id','dt'=>'fecha_id'),
            array('db'=>'datos_pasajeros.servicios','dt'=>'servicios'),
            array('db'=>'datos_pasajeros.fechallegada','dt'=>'fechallegada'),
            array('db'=>'datos_pasajeros.horallegada','dt'=>'horallegada'),
            array('db'=>'datos_pasajeros.fechasalida','dt'=>'fechasalida'),
            array('db'=>'datos_pasajeros.horasalida','dt'=>'horasalida')
        );
        $data = $this->data_tables->complex($_POST,$table,$primaryKey,$columns);
        return $data; 
    }
    
    public function getPasajeroById($id_pasajero){
        $query = $this->db->query('SELECT * FROM pasajero WHERE id_pasajero = '.$id_pasajero);
        $data = $query->result();
        return $data;
    }

    public function InsertarPasajero($data){
        $this->db->insert('pasajero',$data);
    }

}