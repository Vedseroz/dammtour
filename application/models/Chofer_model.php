<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Chofer_model extends CI_model {
	public function __construct() {
		$table = 'chofer';
        parent::__construct($table);
    }

    public function datatable(){
        $table = 'chofer';
        $primarykey = 'chofer.id_chofer';
        $columns = array(
            array('db'=>'chofer.id_chofer','dt'=>'id_chofer'),
            array('db'=>'chofer.nombre_chofer','dt'=>'nombre_chofer'),
            array('db'=>'chofer.apellido_chofer','dt'=>'apellido_chofer'),
            array('db'=>'chofer.rut_chofer','dt'=>'rut_chofer'),
            array('db' => 'chofer.telefono_chofer','dt'=>'telefono_chofer'),
            array('db' => 'chofer.direccion_chofer','dt'=>'direccion_chofer'),
            array('db' => 'chofer.correo','dt'=>'correo')
        );
        $data = $this->data_tables->complex($_POST,$table,$primarykey,$columns);
        return $data;
    }

    public function getChoferById($id_chofer){
        $query = $this->db->query('SELECT * FROM chofer WHERE id_chofer = '.$id_chofer);
        $data = $query->result_array();
        return $data;
    }

    public function InsertarChofer($data){
        $this->db->insert('chofer',$data);
    }

    public function EditarChofer($data){
        $this->db->get('chofer');
        $this->db->where('id_chofer',$data['id_chofer']);
        $this->db->update('chofer',$data);
    }

    public function EliminarChofer($data){
        $this->db->delete('chofer',array('id_chofer' => $data['id_chofer']));
    }

}