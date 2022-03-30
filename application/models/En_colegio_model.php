<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class En_colegio_model extends General_model {
	public function __construct() {
		$table = 'en_colegio';
        parent::__construct($table);
    }
}