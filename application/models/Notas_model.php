<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Notas_model extends General_model {
	public function __construct() {
		$table = 'notas';
        parent::__construct($table);
    }
}