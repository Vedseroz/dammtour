<?php/*
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Fecha_model extends CI_model {
	public function __construct() {
		$table = 'fecha';
        parent::__construct($table);
    }

    public function datatable(){
        $table = 'fecha';
        $primarykey = 'fecha.id_fecha';
        $columns = array(
            array('db'=>'fecha.id_fecha','dt'=>'id_fecha'),
            array('db'=>'fecha.fecha_llegada','dt'=>'fecha_llegada'),
            array('db'=>'fecha.hora_llegada','dt'=>'hora_llegada'),
            array('db'=>'fecha.fecha_salida','dt'=>'fecha_salida'),
            array('db'=>'fecha.hora_salida','dt'=>'hora_salida'),
            
        );
        $data = $this->data_tables->complex($_POST,$table,$primarykey,$columns);
        return $data;
    }

    //==============================================================CRUD
    public function InsertarFecha($data){
        $this->db->insert('fecha',$data);
    }

    public function EditarFecha($data){
        $this->db->get('fecha');
        $this->db->where('id_fecha',$data['id_fecha']);
        $this->db->update('fecha',$data);
    }

    public function EliminarFecha($data){
        $this->db->delete('fecha',array('id_fecha' => $data['id_fecha']));
    }
    
//======================================================================
    public function getFechaById($id_fecha){
        $query = $this->db->query('SELECT * FROM fecha WHERE id_fecha = '.$id_fecha);
        $data = $query->result_array();
        return $data;
    }

    public function getLastId(){
       $query = $this->db->query('SELECT id_fecha FROM fecha ORDER BY id_fecha DESC LIMIT 1');
       foreach ($query->result() as $row){
            $data = $row->id_fecha;
       }
       return $data;
    }


/*
}