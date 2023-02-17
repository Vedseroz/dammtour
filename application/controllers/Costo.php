<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Costo extends CI_Controller {

	/**
	 * Class constructor.
	 */
	public function __construct(){
		parent::__construct();
		 if(!$this->ion_auth->logged_in()){
			 redirect('auth/login','refresh');
		 }

		//cargar los models. 
		$this->load->model('Hospedaje_model');
		$this->load->model('Pasajero_model');
        $this->load->model('Costo_model');
		 
	}

    public function index(){
        $this->data['actual'] = 'Costo'; //esto deberia ser el breadcrumb.
        $this->data['before'] = 'Inicio';
        $this->data['vista'] = 'Costo/vista_costo'; //con esto se carga la vista
        
    $this->load->view('template',$this->data);
		
	}

    public function IngresarCosto($pasajero_id){
		//form validation
	
		$this->form_validation->set_rules('costo','<b>Costo</b>','trim|required');

		//Agregamos los datos del costo a la tabla de costos y luego la tenemos que asociar a la tabla de pasajeros.

		$costo = $this->input->post('currency-field');
        var_dump($costo);
        $costo = $this->getAmount($costo);  //el costo sin los caracteres de $ ni las comas.
        var_dump($costo);
        $porcentaje_i4 = 10/100;
        
        $costo_i4 = $costo * $porcentaje_i4;
        $costo_dammtour = $costo * (1 - $porcentaje_i4);

        var_dump($costo_i4);
        var_dump($costo_dammtour);

        $costos = array(
            'costo_total' => $costo,
            'pagado_damm' => $costo_dammtour,
            'pagado_i4' =>$costo_i4
        );

        $this->Costo_model->InsertarCosto($costos);
        $costo_id = $this->Costo_model->getLastCosto();
        $costo_id =$costo_id[0]['id_costo'];
        var_dump($costo_id);

        $datos_costo = array(
            'pasajero_id' => $pasajero_id,
            'costo_id' => $costo_id
        );

        $this->Pasajero_model->InsertarCosto($datos_costo);

		redirect(site_url('Pasajero/editarPasajero/'.$pasajero_id)); //se devuelve a la pantalla del pasajero al cual se le hizo el hospedaje.*/

    }

    public function getAmount($money){
    $cleanString = preg_replace('/([^0-9\.,])/i', '', $money);
    $onlyNumbersString = preg_replace('/([^0-9])/i', '', $money);

    $separatorsCountToBeErased = strlen($cleanString) - strlen($onlyNumbersString) - 1;

    $stringWithCommaOrDot = preg_replace('/([,\.])/', '', $cleanString, $separatorsCountToBeErased);
    $removedThousandSeparator = preg_replace('/(\.|,)(?=[0-9]{3,}$)/', '',  $stringWithCommaOrDot);

    return (float) str_replace(',', '.', $removedThousandSeparator);
    }

    public function getDatosCostos(){
        $entrada = $this->Costo_model->getDatosCostos();

        for ($i = 0; $i<count($entrada);$i++){  // por cada dato que llega a la tabla a va a mostrar los datos de coste de los pasajeros. 
            $entrada[$i]['post_content'] = preg_split('/\r\n|\r|\n/', $entrada[$i]['post_content']); //separamos el arreglo
            
            $datos_costos[$i] = array(
                'pasajero_id' => $entrada[$i]['pasajero_id'],
                'nombre_pasajero' => $entrada[$i]['post_content'][0],
                'costo_total' => '$'.$entrada[$i]['costo_total'].' (BRL)',
                'pagado_damm' => '$'.$entrada[$i]['pagado_damm'].' (BRL)',
                'pagado_i4' => '$'.$entrada[$i]['pagado_i4'].' (BRL)'
            );
        }

        $pasajeros['draw'] = 0;
		$pasajeros['recordsTotal'] = count($datos_costos); 
		$pasajeros['recordsFiltered'] = count($datos_costos);
		$pasajeros['data'] = $datos_costos;
		echo json_encode($pasajeros);
		return;

        

    }


    
	
}
