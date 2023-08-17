<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Prueba extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('auth/login', 'refresh');
        }

        $this->load->model('Pasajero_model');
        $this->load->model('Wordpress_model');
        $this->load->model('Localidad_model');
        $this->load->model('Vehiculo_model');
        $this->load->model('Transfer_model');
        $this->load->model('Hospedaje_model');
        $this->load->model('Tour_model');
    }
    public function pruebaMpdf(){
        // Incluir la carga automática de clases de Composer
        require_once 'vendor/autoload.php';

        //CARGA DE DATOS

        //creacion de los vouchers
		require_once('./files/Plantilla/VOUCHER_Dammtour.php');
		date_default_timezone_set("America/Santiago");
		$hoy = date('Y-m-d');
		$html = Plantilla($hoy                 );
    	$estilos = file_get_contents('./files/Plantilla/style.css');
        $html = utf8_encode($html);
    	ob_start();
        $mpdf = new \Mpdf\Mpdf();
	    $mpdf->setDisplayMode('fullpage');  
		$mpdf->WriteHTML($estilos,1);
	    $mpdf->WriteHTML($html,2);
	    $mpdf->Output("", 'I');
	    ob_end_flush();

    }
}
