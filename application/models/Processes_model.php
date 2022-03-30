<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Processes_model extends General_model {
	public function __construct() {
		$table = 'processes';
        parent::__construct($table);
    }
}