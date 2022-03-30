<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Deriva_caso_model extends General_model {
	public function __construct() {
		$table = 'deriva_estudiante';
        parent::__construct($table);
    }

    public function data_colegio() {
    	$table = 'deriva_estudiante';
    	$primaryKey = 'deriva_estudiante.id_drvz';
    	$whereResult = null;
    	$whereAll = "deriva_estudiante.id_colegio = '" . $this->session->userdata('company')."' AND deriva_estudiante.id_curso = '".$this->session->userdata('sector')."'";
		$columns = array(
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'nombres', 'dt' => 'nombres' ),
			array( 'db' => 'apellido_p', 'dt' => 'apellido_p' ),
			array( 'db' => 'apellido_m', 'dt' => 'apellido_m' ),
			array( 'db' => 'rut', 'dt' => 'rut' ),
			array( 'db' => 'id_drvz', 'dt' => 'id_drvz' ),
			array( 'db' => 'etapa', 'dt' => 'etapa' ),
			array( 'db' => 'tipo', 'dt' => 'tipo' ),
			array( 'db' => 'estado_act', 'dt' => 'estado_act' ),
			array( 'db' => 'fecha', 'dt' => 'fecha' ),
			array( 'db' => 'id_colegio', 'dt' => 'nombreColegio' ),
			array( 'db' => 'id_curso', 'dt' => 'codigo' ),
			array( 'db' => 'nombre_curso', 'dt' => 'nombre_curso' ),
		);

    	$data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }

    public function data_colegioO() {
    	$table = 'deriva_estudiante';
    	$primaryKey = 'deriva_estudiante.id_drvz';
    	$whereResult = null;
    	//$whereAll = "deriva_estudiante.codigo_colegio = '" . $this->session->userdata('company'). "' AND deriva_estudiante.tipo = '1'";
    	$whereAll = "deriva_estudiante.id_colegio = '" . $this->session->userdata('company')."'" ." AND (deriva_estudiante.tipo = '1' AND deriva_estudiante.etapa = '2') OR (deriva_estudiante.tipo = '3' AND deriva_estudiante.etapa = '3')";
		$columns = array(
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'nombres', 'dt' => 'nombres' ),
			array( 'db' => 'apellido_p', 'dt' => 'apellido_p' ),
			array( 'db' => 'apellido_m', 'dt' => 'apellido_m' ),
			array( 'db' => 'rut', 'dt' => 'rut' ),
			array( 'db' => 'id_drvz', 'dt' => 'id_drvz' ),
			array( 'db' => 'etapa', 'dt' => 'etapa' ),
			array( 'db' => 'tipo', 'dt' => 'tipo' ),
			array( 'db' => 'estado_act', 'dt' => 'estado_act' ),
			array( 'db' => 'fecha', 'dt' => 'fecha' ),
			array( 'db' => 'id_colegio', 'dt' => 'nombreColegio' ),
			array( 'db' => 'id_curso', 'dt' => 'codigo' ),
			array( 'db' => 'nombre_curso', 'dt' => 'nombre_curso' ),
		);

    	$data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }

    public function data_admin() {
    	$primaryKey = 'id';
    	$table = 'deriva_estudiante';
    	$columns = array(
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'nombres', 'dt' => 'nombres' ),
			array( 'db' => 'apellido_p', 'dt' => 'apellido_p' ),
			array( 'db' => 'apellido_m', 'dt' => 'apellido_m' ),
			array( 'db' => 'rut', 'dt' => 'rut' ),
			array( 'db' => 'id_drvz', 'dt' => 'id_drvz' ),
			array( 'db' => 'etapa', 'dt' => 'etapa' ),
			array( 'db' => 'tipo', 'dt' => 'tipo' ),
			array( 'db' => 'estado_act', 'dt' => 'estado_act' ),
			array( 'db' => 'fecha', 'dt' => 'fecha' ),
			array( 'db' => 'id_colegio', 'dt' => 'nombreColegio' ),
			array( 'db' => 'id_curso', 'dt' => 'codigo' ),
			array( 'db' => 'nombre_curso', 'dt' => 'nombre_curso' ),
		);
		$data = $this->data_tables->simple($_POST, $table, $primaryKey, $columns );
        return $data;
    }

    public function data_colegioCC() {
    	$table = 'deriva_estudiante';
    	$primaryKey = 'deriva_estudiante.id_drvz';
    	$whereResult = null;
    	//$whereAll = "deriva_estudiante.codigo_colegio = '" . $this->session->userdata('company'). "' AND deriva_estudiante.tipo = '1'";
    	$whereAll = "deriva_estudiante.id_colegio = '" . $this->session->userdata('company')."'" ." AND (deriva_estudiante.tipo = '2' AND deriva_estudiante.etapa = '2')";
		$columns = array(
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'nombres', 'dt' => 'nombres' ),
			array( 'db' => 'apellido_p', 'dt' => 'apellido_p' ),
			array( 'db' => 'apellido_m', 'dt' => 'apellido_m' ),
			array( 'db' => 'rut', 'dt' => 'rut' ),
			array( 'db' => 'id_drvz', 'dt' => 'id_drvz' ),
			array( 'db' => 'etapa', 'dt' => 'etapa' ),
			array( 'db' => 'tipo', 'dt' => 'tipo' ),
			array( 'db' => 'estado_act', 'dt' => 'estado_act' ),
			array( 'db' => 'fecha', 'dt' => 'fecha' ),
			array( 'db' => 'id_colegio', 'dt' => 'nombreColegio' ),
			array( 'db' => 'id_curso', 'dt' => 'codigo' ),
			array( 'db' => 'nombre_curso', 'dt' => 'nombre_curso' ),
		);

    	$data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }

    public function data_colegioDupla() {
    	$table = 'deriva_estudiante';
    	$primaryKey = 'deriva_estudiante.id_drvz';
    	$whereResult = null;
    	//$whereAll = "deriva_deriva_estudiantecaso.codigo_colegio = '" . $this->session->userdata('company'). "' AND deriva_estudiante.tipo = '1'";
    	$whereAll = "deriva_estudiante.id_colegio = '" . $this->session->userdata('company')."'" ." AND (deriva_estudiante.tipo = '4' OR deriva_estudiante.tipo = '5')";
		$columns = array(
			array( 'db' => 'id', 'dt' => 'id' ),
			array( 'db' => 'nombres', 'dt' => 'nombres' ),
			array( 'db' => 'apellido_p', 'dt' => 'apellido_p' ),
			array( 'db' => 'apellido_m', 'dt' => 'apellido_m' ),
			array( 'db' => 'rut', 'dt' => 'rut' ),
			array( 'db' => 'id_drvz', 'dt' => 'id_drvz' ),
			array( 'db' => 'etapa', 'dt' => 'etapa' ),
			array( 'db' => 'tipo', 'dt' => 'tipo' ),
			array( 'db' => 'estado_act', 'dt' => 'estado_act' ),
			array( 'db' => 'fecha', 'dt' => 'fecha' ),
			array( 'db' => 'id_colegio', 'dt' => 'nombreColegio' ),
			array( 'db' => 'id_curso', 'dt' => 'codigo' ),
			array( 'db' => 'nombre_curso', 'dt' => 'nombre_curso' ),
		);

    	$data = $this->data_tables->complex($_POST , $table, $primaryKey, $columns, $whereResult, $whereAll);
        return $data;
    }
}