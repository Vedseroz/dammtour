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

    public function getDatosHospedajeById($id_pasajero_hospedaje){ // de aqui se extrae la data para la tabla de hospedajes asociados al pasajero
        $query = $this->db->query('SELECT hospedaje_id,pasajero_id,id_pasajero_hospedaje,nombre_hospedaje,pais,ciudad,fechallegada,horallegada,fechasalida,horasalida FROM datos_hospedaje WHERE id_pasajero_hospedaje = '.$id_pasajero_hospedaje);
        $data = $query->result_array();
        return $data;
    }

    public function getDatosHospedajeByIdPasajero($pasajero_id){ // de aqui se extrae la data para la tabla de hospedajes asociados al pasajero
        $query = $this->db->query('SELECT hospedaje_id,pasajero_id,id_pasajero_hospedaje,nombre_hospedaje,pais,ciudad,fechallegada,horallegada,fechasalida,horasalida FROM datos_hospedaje WHERE pasajero_id = '.$pasajero_id);
        $data = $query->result_array();
        return $data;
    }

    public function getPasajeroIdByEventoId($id_pasajero_hospedaje){
        $query = $this->db->query('SELECT pasajero_id FROM datos_hospedaje WHERE id_pasajero_hospedaje = '.$id_pasajero_hospedaje);
        $data = $query->result_array();
        return $data;
    }


    public function AgregarEventoHospedaje($data){
        $this->db->insert('pasajero_hospedaje',$data);
    }

    public function EliminarEventoHospedaje($id_pasajero_hospedaje){
        $this->db->delete('pasajero_hospedaje',array('id_pasajero_hospedaje' => $id_pasajero_hospedaje));
    }


}