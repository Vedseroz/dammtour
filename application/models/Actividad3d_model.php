<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Actividad3d_model extends General_model {
	public function __construct() {
		$table = 'actividad3d';
        parent::__construct($table);
    }
}