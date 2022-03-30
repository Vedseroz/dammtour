<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Full_habytal_model extends General_model {
	public function __construct() {
		$table = 'full_habytal';
        parent::__construct($table);
    }

    public function Indicadores($param){
        $table = 'full_habytal';
        $primaryKey = 'id';
        $whereResult = null;
        $whereAll = "full_habytal.id_caso = '" .$param."'AND full_habytal.estado = 'FINALIZADO'"; 
        $columns = array(
            array( 'db' => 'id', 'dt' => 'id' ),
            array( 'db' => 'fecha', 'dt' => 'fecha' ),
            array( 'db' => 'tipo', 'dt' => 'tipo' ),
        );
        $data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }
}