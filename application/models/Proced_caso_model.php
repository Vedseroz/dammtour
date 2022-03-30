<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Proced_caso_model extends General_model {
	public function __construct() {
		$table = 'caracteriza_estudiante';
        parent::__construct($table);
    }

    public function data_colegio() {
    	$table = 'caracteriza_estudiante';
    	$primaryKey = 'caracteriza_estudiante.id';
    	$whereResult = null;
		$columns = array(
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'RUC', 'dt' => 'RUC' ),
			array( 'db' => 'titulo', 'dt' => 'titulo' ),
			array( 'db' => 'apellido_p', 'dt' => 'apellido_p' ),
			array( 'db' => 'apellido_m', 'dt' => 'apellido_m' ),
			array( 'db' => 'etapa', 'dt' => 'etapa' ),
			array( 'db' => 'fecha', 'dt' => 'fecha' ),
			array( 'db' => 'tipo', 'dt' => 'tipo' ),
			array( 'db' => 'asignado', 'dt' => 'asignado' ),
		);
    	$data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }

    public function data_admin(){
    	$primaryKey = 'id';
    	$table = 'caracteriza_estudiante';
    	$columns = array(
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'nombres', 'dt' => 'nombres' ),
			array( 'db' => 'apellido_p', 'dt' => 'apellido_p' ),
			array( 'db' => 'apellido_m', 'dt' => 'apellido_m' ),
			array( 'db' => 'etapa', 'dt' => 'etapa' ),
			array( 'db' => 'fecha', 'dt' => 'fecha' ),
		);
		$data = $this->data_tables->simple($_POST, $table, $primaryKey, $columns );
        return $data;
    }

    public function data_colegio2($asignado) {
    	$table = 'caracteriza_estudiante';
    	$primaryKey = 'caracteriza_estudiante.id';
    	$whereResult = null;
    	$whereAll = "caracteriza_estudiante.asignado = '" .$asignado."'" ." AND caracteriza_estudiante.etapa = '2'";
    	$columns = array(
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'RUC', 'dt' => 'RUC' ),
			array( 'db' => 'titulo', 'dt' => 'titulo' ),
			array( 'db' => 'apellido_p', 'dt' => 'apellido_p' ),
			array( 'db' => 'apellido_m', 'dt' => 'apellido_m' ),
			array( 'db' => 'etapa', 'dt' => 'etapa' ),
			array( 'db' => 'fecha', 'dt' => 'fecha' ),
			array( 'db' => 'tipo', 'dt' => 'tipo' ),
			array( 'db' => 'asignado', 'dt' => 'asignado' ),
		);
    	$data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }

    public function data_colegioCC() {
    	$table = 'caracteriza_estudiante';
    	$primaryKey = 'caracteriza_estudiante.id';
    	$whereResult = null;
    	$columns = array(
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'nombres', 'dt' => 'nombres' ),
			array( 'db' => 'apellido_p', 'dt' => 'apellido_p' ),
			array( 'db' => 'apellido_m', 'dt' => 'apellido_m' ),
			array( 'db' => 'etapa', 'dt' => 'etapa' ),
			array( 'db' => 'fecha', 'dt' => 'fecha' ),
		);
    	$data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }

    public function data_colegioA() {
    	$table = 'caracteriza_estudiante';
    	$primaryKey = 'caracteriza_estudiante.id';
    	$whereResult = null;
    	$columns = array(
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'nombres', 'dt' => 'nombres' ),
			array( 'db' => 'apellido_p', 'dt' => 'apellido_p' ),
			array( 'db' => 'apellido_m', 'dt' => 'apellido_m' ),
			array( 'db' => 'etapa', 'dt' => 'etapa' ),
			array( 'db' => 'fecha', 'dt' => 'fecha' ),
		);
    	$data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }

    public function data_colegioE($id_caso) {
    	$table = 'caracteriza_estudiante';
    	$primaryKey = 'caracteriza_estudiante.id';
    	$whereResult = null;
    	$whereAll = "caracteriza_estudiante.id = '" .$id_caso."'" ." AND caracteriza_estudiante.etapa = '2'";
		$columns = array(
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'nombres', 'dt' => 'nombres' ),
			array( 'db' => 'apellido_p', 'dt' => 'apellido_p' ),
			array( 'db' => 'apellido_m', 'dt' => 'apellido_m' ),
			array( 'db' => 'etapa', 'dt' => 'etapa' ),
			array( 'db' => 'fecha', 'dt' => 'fecha' ),
		);
    	$data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }
}


/*

CREATE VIEW `caracteriza_estudiante`  AS SELECT 
	`users`.`first_name` AS `apellido_p`, 
	`users`.`last_name` AS `apellido_m`, 
	`procedimientos`.`id_user` AS `id_user`, 
	`procedimientos`.`etapa` AS `etapa`, 
	`procedimientos`.`fecha` AS `fecha`, 
	`procedimientos`.`id` AS `id`,
	`actividad1d`.`RUC` AS `RUC`,
	`actividad1d`.`titulo` AS `titulo`,
	`actividad1d`.`tipo` AS `tipo`,
	`actividad1d`.`asignado` AS `asignado`
	FROM (`users` join `procedimientos` 
		on(`users`.`id` = `procedimientos`.`id_user`)
		join `actividad1d` on (`procedimientos`.`id` = `actividad1d`.`id`)
	) WHERE `procedimientos`.`estado` = 'ACTIVO' ;
 */
