<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['areas_niveles'] = [
	'Aseo' => [], 
	'Cementerio' => ['Cementerio'], 
	'Central' => ['Administración'], 
	'Educación' => ['Administración', 'Asistentes', 'Escuela', 'Jardín' , 'Liceo'], 
	'Salud' => ['Administración', 'CECOSF', 'CESFAM', 'Posta', 'SAPU']
];