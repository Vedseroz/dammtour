<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Rep_externo_model extends General_model {
	public function __construct() {
		$table = 'rep_externo';
        parent::__construct($table);
    }
}