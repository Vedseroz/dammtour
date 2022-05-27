<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Transfer_model extends CI_model {
	public function __construct() {
		$table = 'transfer';
        parent::__construct($table);
    }

    public function datatable(){
        $table = 'transfer';
        $primarykey = 'transfer.transfer';
        $columns = array(
            array('db'=>'transfer.id_transfer','dt'=>'transfer'),
            array('db'=>'transfer.nombre_chofer','dt'=>'nombre_chofer'),
            array('db'=>'transfer.apellido_chofer','dt'=>'apellido_chofer'),
            array('db'=>'transfer.tipo','dt'=>'tipo'),
            array('db'=>'transfer.modelo','dt'=>'modelo'),
            array('db'=>'transfer.cant_maletas','dt'=>'cant_maletas'),
            array('db' =>'transfer.cant_pasajeros','dt'=>'cant_pasajeros'),

        );
        $data = $this->data_tables->complex($_POST,$table,$primarykey,$columns);
        return $data;
    }

    public function InsertarTransfer($data){
        $this->db->insert('transfer',$data);
    }

}