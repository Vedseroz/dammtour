<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Voucher_model extends CI_model {
	public function __construct() {
		$table = 'voucher';
        parent::__construct($table);
    }

    public function datatable(){
        $table = 'voucher';
        $primarykey = 'voucher.id_voucher';
        $columns = array(
            array('db'=>'voucher.id_voucher','dt'=>'id_voucher'),
            array('db'=>'voucher.fecha','dt'=>'fecha'),
            array('db'=>'voucher.origen','dt'=>'origen'),
            array('db'=>'voucher.hora_inicio','dt'=>'hora_inicio'),
            array('db'=>'voucher.destino','dt'=>'destino'),
            array('db'=>'voucher.hora_finazilacion','dt'=>'hora_finalizacion'),
            array('db' =>'voucher.detalles','dt'=>'detalles'),
            array('db' =>'voucher.pasajero_id','dt'=>'pasajero_id')

        );
        $data = $this->data_tables->complex($_POST,$table,$primarykey,$columns);
        return $data;
    }

    public function getAllData(){
        $query = $this->db->query('SELECT * FROM datos_voucher');
        $data = $query->result_array();
        return $data;
    }

    public function Insertarvoucher($data){
        $this->db->insert('voucher',$data);
    }

    public function EditarVoucher($data){
        $this->db->get('voucher');
        $this->db->where('id_voucher',$data['id_voucher']);
        $this->db->update('voucher',$data);
    }

    public function EliminarPasajero($data){
        $this->db->delete('voucher',array('id_voucher' => $data['id_voucher']));
    }

    public function getVoucher($id_voucher){
        $query = $this->db->query('SELECT * FROM voucher WHERE id_voucher = '.$id_voucher);
        $data = $query->result_array();
        return $data;
    }

    public function getVoucherData($id_voucher){
        $query = $this->db->query('SELECT * FROM datos_voucher WHERE id_voucher = '.$id_voucher);
        $data = $query->result_array();
        return $data;
    }

    public function getVoucherById($id_pasajero){
        $query = $this->db->query('SELECT * FROM voucher WHERE pasajero_id = '.$id_pasajero);
        $data = $query->result_array();
        return $data;
    }

}