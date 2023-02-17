<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Hospedaje_model extends CI_model {
	public function __construct() {
		$table = 'hospedaje';
        parent::__construct($table);
    }


    public function getNombreHospedaje($hospedaje_id){
        $query = $this->db->query('SELECT nombre_hospedaje FROM hospedaje WHERE id_hospedaje =.'.$hospedaje_id);
        $data = $query->result_array();
        return $data;
    }

    public function getAllHospedajes(){
        $query = $this->db->query('SELECT * FROM datos_hospedaje');
        $data = $query->result_array();
        return $data;
    }

    public function getHospedajePorCiudad($ciudad){
        $ciudad = urldecode($ciudad);
        $query = $this->db->query('SELECT nombre_hospedaje FROM hospedaje_localidad WHERE ciudad = '.'"'.$ciudad.'"');
        $data = $query->result_array();
        return $data;
    }

    public function getIdHospedaje($posada){
        $query = $this->db->query("SELECT id_hospedaje FROM hospedaje_localidad WHERE nombre_hospedaje = '".$posada."';");
        $data = $query->result_array();
        return $data;
    }

    public function getDatosHospedajeById($pasajero_id){ // de aqui se extrae la data para la tabla de hospedajes asociados al pasajero
        $query = $this->db->query('SELECT nombre_hospedaje,pais,ciudad,fechallegada,horallegada,fechasalida,horasalida FROM datos_hospedaje WHERE pasajero_id = '.$pasajero_id);
        $data = $query->result_array();
        return $data;
    }


    public function AgregarEventoHospedaje($data){
        $this->db->insert('pasajero_hospedaje',$data);
    }

}