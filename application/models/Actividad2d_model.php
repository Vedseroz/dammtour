<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Actividad2d_model extends General_model {
	public function __construct() {
		$table = 'actividad2d';
        parent::__construct($table);
    }
}