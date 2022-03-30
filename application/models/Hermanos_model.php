<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Hermanos_model extends General_model {
	public function __construct() {
		$table = 'hermanos';
        parent::__construct($table);
    }
}