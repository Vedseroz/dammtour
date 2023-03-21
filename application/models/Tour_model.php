<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Tour_model extends CI_model {
	public function __construct() {
		$table = 'tour';
        parent::__construct($table);
    }

    public function getNombreTour($tour_id){
        $query = $this->db->query('SELECT nombre_tour FROM tour WHERE id_tour =.'.$tour_id);
        $data = $query->result_array();
        return $data;
    }

    public function getAllTours(){
        $query = $this->db->query('SELECT * FROM datos_tour');
        $data = $query->result_array();
        return $data;
    }

    public function getTourPorCiudad($ciudad){
        $ciudad = urldecode($ciudad);
        $query = $this->db->query('SELECT nombre_tour FROM tour_localidad WHERE ciudad LIKE '.'"'.$ciudad.'"');
        $data = $query->result_array();
        return $data;
    }

    public function getIdTour($tour){
        $tour = urldecode($tour);
        $query = $this->db->query("SELECT id_tour FROM tour_localidad WHERE nombre_tour = '".$tour."';");
        $data = $query->result_array();
        return $data;
    }

    public function getDatosTourById($id_pasajero_tour){ // de aqui se extrae la data para la tabla de hospedajes asociados al pasajero
        $query = $this->db->query('SELECT tour_id,id_pasajero_tour,pasajero_id,nombre_tour,pais,ciudad,fechallegada,horallegada,fechasalida,horasalida FROM datos_tour WHERE id_pasajero_tour = '.$id_pasajero_tour);
        $data = $query->result_array();
        return $data;
    }

    public function getPasajeroIdByEventoId($id_pasajero_tour){
        $query = $this->db->query('SELECT pasajero_id FROM datos_tour WHERE id_pasajero_tour = '.$id_pasajero_tour);
        $data = $query->result_array();
        return $data;
    }

    public function EliminarEventoTour($id_pasajero_tour){
        $this->db->delete('pasajero_tour',array('id_pasajero_tour' => $id_pasajero_tour));
    }

    public function AgregarEventoTour($data){
        $this->db->insert('pasajero_tour',$data);
    }

}