<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Colegios_model extends General_model {
	public function __construct() {
		$table = 'colegios';
        parent::__construct($table);
    }

    public function get_nombre($codigo = null){
    	if(empty($codigo)) return 'Colegio no espesificado';
    	$nombre = $this->get('nombre', array('id' => $codigo))[0]->nombre; 
    	return "$nombre";
    }

    public function getColegios(){
    	$primaryKey = 'id';
    	$table = 'colegios';
    	$columns = array(
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'codigo_colegio', 'dt' => 'codigo_colegio' ),
			array( 'db' => 'nombre', 'dt' => 'nombre' ),
			array( 'db' => 'direccion', 'dt' => 'direccion' ),
		);
		return $this->data_tables->simple($_POST, $table, $primaryKey, $columns );
    }
}