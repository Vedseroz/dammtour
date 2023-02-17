<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Costo_model extends CI_model {
	public function __construct() {
		$table = 'costo';
        parent::__construct($table);
    }

    public function getDatosCostos(){
        $query = $this->db->query('SELECT * FROM datos_costo');
        $data = $query->result_array();
        return $data;
    }

    public function getCostoById($id_costo){
        $query = $this->db->query('SELECT * FROM costo WHERE id_costo = '.$id_costo);
        $data = $query->result_array();
        return $data;
    }

    public function getLastCosto(){
        $query = $this->db->query('SELECT id_costo FROM costo ORDER BY id_costo DESC LIMIT 1');
        $data = $query->result_array();
        return $data;
    }

    public function InsertarCosto($data){
        $this->db->insert('costo',$data);
    }

    public function EditarCosto($data){
        $this->db->get('costo');
        $this->db->where('id_costo',$data['id_costo']);
        $this->db->update('costo',$data);
    }

    public function EliminarCosto($data){
        $this->db->delete('costo',array('id_costo' => $data['id_costo']));
    }

}