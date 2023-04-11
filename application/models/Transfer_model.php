<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Transfer_model extends CI_model {
	public function __construct() {
		$table = 'transfer';
        parent::__construct($table);
    }

    /*public function datatable(){
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
    }*/

    public function getAllTransfers(){
        $query = $this->db->query('SELECT * FROM datos_transfer');
        $data = $query->result_array();
        return $data;
    }


    public function getDatosTransferById($id_pasajero_transfer){ //con este metodo se saca la data de los transfers asociados al pasajero.
        $query = $this->db->query('SELECT id_transfer,id_pasajero_transfer,pasajero_id,cant_adultos,cant_ninos,cant_maletas,fechallegada,horallegada,fechasalida,horasalida,marca,modelo,patente FROM datos_transfer WHERE id_pasajero_transfer = '.$id_pasajero_transfer);
        $data = $query->result_array();
        return $data;
    }

    public function getDatosTransferByIdPasajero($pasajero_id){ //con este metodo se saca la data de los transfers asociados al pasajero.
        $query = $this->db->query('SELECT id_transfer,id_pasajero_transfer,pasajero_id,cant_adultos,cant_ninos,cant_maletas,fechallegada,horallegada,fechasalida,horasalida,marca,modelo,patente FROM datos_transfer WHERE pasajero_id = '.$pasajero_id);
        $data = $query->result_array();
        return $data;
    }

    public function InsertarTransfer($data){
        $this->db->insert('transfer',$data);
    }

    public function getLastId(){
        $query = $this->db->query('SELECT MAX(id_transfer) FROM transfer');
        $data = $query->result_array();
        return $data[0]['MAX(id_transfer)'];

    }

    public function EliminarTransfer($id_transfer){
        $this->db->delete('transfer',array('id_transfer' => $id_transfer));
    }

}