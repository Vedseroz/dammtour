<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Rep_to_derivacion_model extends General_model {
	public function __construct() {
		$table = 'rep_to_derivacion';
        parent::__construct($table);
    }

    public function Derivacion($param){
    	$table = 'rep_to_derivacion';
    	$primaryKey = 'id';
        $whereResult = null;
        $whereAll = "rep_to_derivacion.id_caso = '" .$param."' AND rep_to_derivacion.estado = 'FINALIZADO'";
    	$columns = array(
            array( 'db' => 'id', 'dt' => 'id' ),
            array( 'db' => 'fecha', 'dt' => 'fecha' ),
            array( 'db' => 'tipo', 'dt' => 'tipo' )
        );
        $data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }

    public function Derivacionotros($param){
        $table = 'rep_to_derivacion';
        $primaryKey = 'id';
        $whereResult = null;
        $whereAll = "rep_to_derivacion.id_caso = '".$param."' AND rep_to_derivacion.tipo = 3 OR rep_to_derivacion.tipo = 4 OR rep_to_derivacion.tipo = 5";  
        $columns = array(
            array( 'db' => 'id', 'dt' => 'id' ),
            array( 'db' => 'fecha', 'dt' => 'fecha' ),
            array( 'db' => 'tipo', 'dt' => 'tipo' )
        );
        $data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }

    public function tabla_dupla($param){
        $table = 'rep_to_derivacion';
        $primaryKey = 'id';
        $whereResult = null;
        $whereAll = "rep_to_derivacion.id_caso = '" .$param."' AND rep_to_derivacion.tipo = 4 OR rep_to_derivacion.tipo = 5";  
        $columns = array(
            array( 'db' => 'id', 'dt' => 'id' ),
            array( 'db' => 'fecha', 'dt' => 'fecha' ),
            array( 'db' => 'tipo', 'dt' => 'tipo' )
        );
        $data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }

    public function ReportesDRVZ($id = null) {
        $this->db->from('rep_to_derivacion');
        $this->db->where('rep_to_derivacion.id',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = [$data['nombres'],$data['apellido_p'],$data['tipo'],$data['fecha']];
        }
        return $values;
    }
}