<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Rep_to_externo_model extends General_model {
	public function __construct() {
		$table = 'rep_to_externo';
        parent::__construct($table);
    }

    public function Externo($param){
        $table = 'rep_to_externo';
        $primaryKey = 'id';
        $whereResult = null;
        $whereAll = "rep_to_externo.id_caso = '" .$param."'";
        $columns = array(
            array( 'db' => 'id', 'dt' => 'id' ),
            array( 'db' => 'fecha', 'dt' => 'fecha' ),
            array( 'db' => 'filename', 'dt' => 'filename' )
        );
        $data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }

    public function ReportesXTRN($id = null) {
        $this->db->from('rep_to_externo');
        $this->db->where('rep_to_externo.id',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = $data['filename'];
        }
        return $values;
    }
}