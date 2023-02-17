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

