<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Vehiculo_model extends CI_model {
	public function __construct() {
		$table = 'vehiculo';
        parent::__construct($table);
    }

    public function datatable(){
        $table = 'vehiculo';
        $primarykey = 'vehiculo.id_vehiculo';
        $columns = array(
            array('db'=>'vehiculo.id_vehiculo','dt'=>'id_vehiculo'),
            array('db'=>'vehiculo.marca','dt'=>'marca'),
            array('db'=>'vehiculo.modelo','dt'=>'modelo'),
            array('db'=>'vehiculo.tipo','dt'=>'tipo'),
            array('db'=>'vehiculo.patente','dt'=>'patente'),
            array('db'=>'vehiculo.cant_pasajeros','dt'=>'cant_pasajeros'),
            array('db'=>'vehiculo.estado','dt'=>'estado')
        );
        $data = $this->data_tables->complex($_POST,$table,$primarykey,$columns);
        return $data;
    }

    public function getVehiculos(){
        $query = $this->db->query('SELECT * FROM vehiculo');
        $data = $query->result_array();
        return $data;
    }

    public function getVehiculosDisponibles(){
        $query = $this->db->query('SELECT * FROM vehiculo WHERE estado = 0');
        $data = $query->result_array();
        return $data;
    }

    public function getVehiculoById($id_vehiculo){
        $query = $this->db->query('SELECT * FROM vehiculo WHERE id_vehiculo = '.$id_vehiculo);
        $data = $query->result_array();
        return $data;
    }

    public function InsertarVehiculo($data){
        $this->db->insert('vehiculo',$data);
    }

    public function EditarVehiculo($data){
        $this->db->get('vehiculo');
        $this->db->where('id_vehiculo',$data['id_vehiculo']);
        $this->db->update('vehiculo',$data);
    }

    public function EliminarVehiculo($data){
        $this->db->delete('vehiculo',array('id_vehiculo' => $data['id_vehiculo']));
    }

}