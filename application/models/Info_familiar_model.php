<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Info_familiar_model extends General_model {
	public function __construct() {
		$table = 'info_familiar';
        parent::__construct($table);
    }
}