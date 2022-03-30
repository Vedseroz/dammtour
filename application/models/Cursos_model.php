<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Cursos_model extends General_model {
	public function __construct() {
		$table = 'cursos';
        parent::__construct($table);
    }

    public function getCursos($id_colegio = null){
    	$primaryKey = 'id';
    	$table = 'cursos';
    	$whereResult = null;
    	$whereAll = "id_colegio = '" . $id_colegio ."'";
    	$columns = array(
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'id_colegio', 'dt' => 'id_colegio' ),
			array( 'db' => 'nombre', 'dt' => 'nombre' ),
			array( 'db' => 'fecha', 'dt' => 'fecha' ),
			array( 'db' => 'codigo', 'dt' => 'codigo' ),
		);
		return $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
    }
}