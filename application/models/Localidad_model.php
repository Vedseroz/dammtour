<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Localidad_model extends CI_model {
	public function __construct() {
		$table = 'localidad';
        parent::__construct($table);
    }

    public function Insertarvoucher($data){
        $this->db->insert('voucher',$data);
    }

    public function EditarVoucher($data){
        $this->db->get('voucher');
        $this->db->where('id_voucher',$data['id_voucher']);
        $this->db->update('voucher',$data);
    }

    public function getIdByCiudad($ciudad){
        $query = $this->db->query('SELECT id_localidad FROM localidad WHERE ciudad = '.'"'.$ciudad.'"');
        $data = $query->result_array();
        return $data;
    }

    public function ComprobarCiudadPais($ciudad,$pais){
        $query = $this->db->query('SELECT COUNT(ciudad) FROM localidad WHERE ciudad = "'.$ciudad.'" AND pais = "'.$pais.'"');
        $data = $query->result_array();
        return $data;
    }

    public function getLastLocalidad(){ //obtiene el ultimo id insertado de la localidad
        $query = $this->db->query('SELECT id_localidad FROM localidad ORDER BY id_localidad DESC LIMIT 1');
        $data = $query->result_array();
        return $data;
    }

    public function InsertarLocalidad($data){
        $this->db->insert('localidad',$data);
    }

    public function getPaises(){
        $query = $this->db->query('SELECT pais FROM localidad GROUP BY pais');
        $data = $query->result_array();
        return $data;
    }

    public function getCiudades($pais){
        $query = $this->db->query("SELECT ciudad FROM localidad WHERE pais = "."'".$pais."'");
        $data = $query->result_array();
        return $data;
    }
}

