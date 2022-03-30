<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Full_otros_model extends General_model {
	public function __construct() {
		$table = 'full_otros';
        parent::__construct($table);
    }
    
    public function Otros($param){
        $table = 'full_otros';
        $primaryKey = 'id_caso';
        $whereResult = null;
        $whereAll = "full_otros.id_caso = '" .$param."'";
        $columns = array(
            array( 'db' => 'fecha', 'dt' => 'fecha' ),
            array( 'db' => 'tipo', 'dt' => 'tipo' )
        );
        $data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }

    public function Reportes($param1, $param2){
        $this->db->from('full_otros');
        $this->db->where('full_otros.tipo',$param1);
        $this->db->where('full_otros.fecha',$param2);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = [$data['id_caso']];
        }
        return $values;
    }
}