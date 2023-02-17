<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Pasajero_model extends CI_model {
	public function __construct() {
		$table = 'pasajero';
        parent::__construct($table);
    }
    

    public function datatable(){
        $table = 'pasajero';
        $primarykey = 'pasajero.id_pasajero';
        $columns = array(
            array('db'=>'pasajero.id_pasajero','dt'=>'id_pasajero'),
            array('db'=>'pasajero.nombre','dt'=>'nombre'),
            array('db'=>'pasajero.apellido','dt'=>'apellido'),
            array('db'=>'pasajero.telefono','dt'=>'telefono'),
            array('db'=>'pasajero.email','dt'=>'email'),
            array('db'=>'pasajero.observacion','dt'=>'observacion'),
            array('db' =>'pasajero.servicio','dt'=>'servicio'),
            array('db'=>'pasajero.acompa','dt'=>'acompa'),
            array('db'=>'pasajero.fecha_id','dt'=>'fecha_id')

        );
        $data = $this->data_tables->complex($_POST,$table,$primarykey,$columns);
        return $data;
    }

    public function getPasajeros(){
        $query = $this->db->query('SELECT * FROM pasajero');
        $data = $query->result_array();
        return $data;
    }

    public function getDatosPasajeros(){
        $table = 'datos_pasajeros';
        $primaryKey = 'id_pasajero';
        $whereResult = null;
        $columns = array(
            array('db'=>'datos_pasajeros.id_pasajero','dt'=>'id_pasajero'),
            array('db'=>'datos_pasajeros.nombre','dt'=>'nombre'),
            array('db'=>'datos_pasajeros.apellido','dt'=>'apellido'),
            array('db'=>'datos_pasajeros.telefono','dt'=>'telefono'),
            array('db'=>'datos_pasajeros.email','dt'=>'email'),
            array('db'=>'datos_pasajeros.servicios','dt'=>'servicios'),
            array('db'=>'datos_pasajeros.acompa','dt'=>'acompa'),

        );
        $data = $this->data_tables->complex($_POST,$table,$primaryKey,$columns);
        return $data; 
    }
    
    public function getPasajeroById($id_pasajero){ //retorna todos los datos del pasajero
        $query = $this->db->query('SELECT * FROM pasajero WHERE id_pasajero = '.$id_pasajero);
        $data = $query->result_array();
        return $data;
    }

    public function ComprobarPasajero($id_pasajero){
        $query = $this->db->query('SELECT COUNT(*) FROM pasajero WHERE id_pasajero = '.$id_pasajero);
        $data = $query->result_array();
        return $data;
    }

    public function getIdFecha($id_pasajero){
        $query = $this->db->query('SELECT fecha_id FROM pasajero WHERE id_pasajero = '.$id_pasajero);
        foreach ($query->result() as $row){
            $data = $row->fecha_id;
        }
        return $data;
    }

    public function InsertarPasajero($data){
        $this->db->insert('pasajero',$data);
    }

    public function EditarPasajero($data){
        $this->db->get('pasajero');
        $this->db->where('id_pasajero',$data['id_pasajero']);
        $this->db->update('pasajero',$data);
    }

    public function EliminarPasajero($data){
        $this->db->delete('pasajero',array('id_pasajero' => $data['id_pasajero']));
    }

    public function InsertarCosto($data){
        $this->db->get('pasajero');
        $this->db->where('pasajero_id',$data['pasajero_id']);
        $this->db->update('pasajero',$data);
    }

    //EVENTOS-----------------------------------------------------------------------------------------------------------------------------------------------

    public function AgregarEventoTransfer($data){
        $this->db->insert('pasajero_transfer',$data);
    }

    public function cambiarEstadoPasajero($data){
        $this->db->get('pasajero');
        $this->db->where('pasajero_id',$data['pasajero_id']);
        $this->db->update('pasajero',$data);
    }

    public function getNombreById($pasajero_id){ //devuelve el nombre del pasajero
        $query = $this->db->query('SELECT post_content FROM datos_pasajeros WHERE ID = '.$pasajero_id);
        $data = $query->result_array();
        $data[0]['post_content'] = preg_split('/\r\n|\r|\n/', $data[0]['post_content']);
        $nombre = $data[0]['post_content'][0];
        return $nombre;
    }


}