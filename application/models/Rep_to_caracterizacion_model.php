<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Rep_to_procedimientos_model extends General_model {
	public function __construct() {
		$table = 'rep_to_procedimientos';
        parent::__construct($table);
    }

    public function procedimientos($id = null){
    	$table = 'rep_to_procedimientos';
    	$primaryKey = 'id';
        $whereResult = null;
        $whereAll = "rep_to_procedimientos.id_caso = '".$id."'AND rep_to_procedimientos.estado = 'FINALIZADO'"; 
    	$columns = array(
            array( 'db' => 'id', 'dt' => 'id'),
            array( 'db' => 'fecha', 'dt' => 'fecha'),
        );
        $data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }

    public function ReportesCTRZ($id = null) {
        $this->db->from('rep_to_procedimientos');
        $this->db->where('rep_to_procedimientos.id',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = [$data['nombres'],$data['apellido_p'],$data['fecha']];
        }
        return $values;
    }
}