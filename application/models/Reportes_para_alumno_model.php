<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Reportes_para_alumno_model extends General_model {
	public function __construct() {
		$table = 'reporte_para_alumno';
        parent::__construct($table);
    }

    public function procedimientos($param){
    	$table = 'reporte_para_alumno';
    	$primaryKey = 'id_procedimientos';
        $whereResult = null;
        $whereAll = "reporte_para_alumno.id_procedimientos = '".$param."'";
    	$columns = array(
            array( 'db' => 'id_procedimientos', 'dt' => 'id_procedimientos' ),
            array( 'db' => 'fecha_inicio', 'dt' => 'fecha_inicio' ),
//            array( 'db' => 'procedimientos', 'dt' => 'procedimientos' )
        );
        $data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }
}