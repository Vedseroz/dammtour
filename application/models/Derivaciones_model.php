<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Derivaciones_model extends General_model {
	public function __construct() {
		$table = 'derivaciones';
        parent::__construct($table);
    }

    public function datatable($id_caso = null) {
    	$table = 'derivaciones';
    	$primaryKey = 'id';
    	$whereResult = null;
    	$whereAll = "id_caso = $id_caso AND estado = 'FINALIZADO'";
		$columns = array(
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'id_caso', 'dt' => 'id_caso' ),
			array( 'db' => 'tipo', 'dt' => 'tipo' ),
			array( 'db' => 'fecha', 'dt' => 'fecha' ),
            array( 'db' => 'estado', 'dt' => 'estado' )
		);
    	$data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }
}