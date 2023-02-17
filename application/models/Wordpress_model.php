<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Wordpress_model extends CI_model {
	public function __construct() {
		$db = $this->load->database('wordpress', TRUE);
        $table = 'wp5g_posts';
        parent::__construct($db,$table);
    }

    public function datatable(){
        $table = 'wp5g_posts';
        $primarykey = 'ID';
        $columns = array(
            array('db'=>'wp5g_posts.ID','dt'=>'ID'),
            array('db'=>'wp5g_posts.post_author','dt'=>'post_author'),
            array('db'=>'wp5g_posts.post_date','dt'=>'post_date'),
            array('db'=>'wp5g_posts.post_date_gmt','dt'=>'post_date_gmt'),
            array('db'=>'wp5g_posts.post_content','dt'=>'post_content'),
            array('db'=>'wp5g_posts.post_title','dt'=>'post_title'),
            array('db'=>'wp5g_posts.post_content','dt'=>'post_content'),
            array('db'=>'wp5g_posts.post_excerpt','dt'=>'post_excerpt'),
            array('db'=>'wp5g_posts.post_status','dt'=>'post_status'),
            array('db'=>'wp5g_posts.comment_status','dt'=>'comment_status'),
            array('db'=>'wp5g_posts.ping_status','dt'=>'ping_status'),
            array('db'=>'wp5g_posts.post_password','dt'=>'post_password'),
            array('db'=>'wp5g_posts.post_name','dt'=>'post_name'),
            array('db'=>'wp5g_posts.to_ping','dt'=>'to_ping'),
            array('db'=>'wp5g_posts.pinged','dt'=>'pinged'),
            array('db'=>'wp5g_posts.post_modified','dt'=>'post_modified'),
            array('db'=>'wp5g_posts.post_modified_gmt','dt'=>'post_modified_gmt'),
            array('db'=>'wp5g_posts.post_content_filtered','dt'=>'post_content_filtered'),
            array('db'=>'wp5g_posts.post_parent','dt'=>'post_parent'),
            array('db'=>'wp5g_posts.guid','dt'=>'guid'),
            array('db'=>'wp5g_posts.menu_order','dt'=>'menu_order'),
            array('db'=>'wp5g_posts.post_type','dt'=>'post_type'),
            array('db'=>'wp5g_posts.post_mime_type','dt'=>'post_mime_type'),
            array('db'=>'wp5g_posts.comment_count','dt'=>'comment_count'),

        );
        $data = $this->data_tables->complex($_POST,$table,$primarykey,$columns);
        return $data;
    }

    public function GetAllPosts(){  // con esta funcion se extraen todos los datos desde la tabla de wordpress de la base de datos (solamente los incluidos en post_content y ID)
        $query = $this->db->query('SELECT wp5g_posts.ID,wp5g_posts.post_content,wp5g_posts.post_type FROM dammtour_wp75.wp5g_posts WHERE wp5g_posts.post_type = '.'"flamingo_inbound"'.';');
        $data = $query->result_array();
        for ($i = 0; $i<count($data);$i++){
            $aux[$i]['pasajero_id'] = $data[$i]['ID'];
            $output[$i]['post_content'] = $data[$i]['post_content'];
            $output[$i]['post_content'] = preg_split('/\r\n|\r|\n/', $output[$i]['post_content']); // separa el string enorme en pedazos en un array

            // vamos a ir separando el arreglo de entrada por cada indice que presente. Los primeros 6 datos son fijos, asi que se asignan de una. 

            //comprobamos el estado
            $this->ComprobarEstado($aux[$i]['pasajero_id']);
            
            $aux[$i]['estado'] = $this->ObtenerEstado($aux[$i]['pasajero_id']);
            $aux[$i]['nombre'] = $output[$i]['post_content'][0];  // NOMBRE
            $aux[$i]['telefono'] = $output[$i]['post_content'][1]; // TELEFONO
            $aux[$i]['fecha_inicio'] = $output[$i]['post_content'][2]; //FECHA INICIO
            $aux[$i]['hora_inicio'] = $output[$i]['post_content'][3]; //HORA INICIO
            $aux[$i]['email'] = $output[$i]['post_content'][4]; //CORREO
            $aux[$i]['destino'] = $output[$i]['post_content'][5]; //DESTINO

            if(is_numeric($output[$i]['post_content'][6]) == true){     //en caso de que este indice tenga un valor numerico.
                $aux[$i]['cant_ninos'] = $output[$i]['post_content'][6];
            } else {
                $aux[$i]['cant_ninos'] = '0'; //si no, la cantidad de ninos es 0
            }

            $servicios = array();
            if($output[$i]['post_content'][6] == 'Transfer' || $output[$i]['post_content'][6] == 'Hospedaje' || $output[$i]['post_content'][6] == 'Tour'){
                array_push($servicios,$output[$i]['post_content'][6]);
            } 
            //comprueba la siguiente casilla
            if($output[$i]['post_content'][7] == 'Transfer' || $output[$i]['post_content'][7] == 'Hospedaje'  || $output[$i]['post_content'][7] == 'Tour'){
                array_push($servicios,$output[$i]['post_content'][7]);
            }
            //comprueba la ultima casilla de los servicios
            if($output[$i]['post_content'][8] == 'Transfer' || $output[$i]['post_content'][8] == 'Hospedaje'  || $output[$i]['post_content'][8] == 'Tour'){
                array_push($servicios,$output[$i]['post_content'][8]);
            }

            if($output[$i]['post_content'][9] == 'Transfer' || $output[$i]['post_content'][9] == 'Hospedaje'  || $output[$i]['post_content'][9] == 'Tour'){
                array_push($servicios,$output[$i]['post_content'][9]);
            }

            $servicios = implode(' ',$servicios);
            $aux[$i]['servicios'] = $servicios;

            if(is_numeric($output[$i]['post_content'][7]) == false && filter_var($output[$i]['post_content'][7], FILTER_VALIDATE_IP) == false && $output[$i]['post_content'][7] != 'Transfer' && $output[$i]['post_content'][7] != 'Hospedaje'  && $output[$i]['post_content'][7] != 'Tour'){ //en caso de que NO SEAN valores numericos
                $aux[$i]['detalles'] = $output[$i]['post_content'][7];
            }

            if(is_numeric($output[$i]['post_content'][8]) == false && filter_var($output[$i]['post_content'][8], FILTER_VALIDATE_IP) == false && $output[$i]['post_content'][8] != 'Transfer' && $output[$i]['post_content'][8] != 'Hospedaje'  && $output[$i]['post_content'][8] != 'Tour'){
                $aux[$i]['detalles'] = $output[$i]['post_content'][8];
            }

            if(is_numeric($output[$i]['post_content'][9]) == false && filter_var($output[$i]['post_content'][9], FILTER_VALIDATE_IP) == false && $output[$i]['post_content'][9] != 'Transfer' && $output[$i]['post_content'][9] != 'Hospedaje'  && $output[$i]['post_content'][9] != 'Tour'){
                $aux[$i]['detalles'] = $output[$i]['post_content'][9];
            }

            if(is_numeric($output[$i]['post_content'][10]) == false && filter_var($output[$i]['post_content'][10], FILTER_VALIDATE_IP) == false && $output[$i]['post_content'][10] != 'Transfer' && $output[$i]['post_content'][10] != 'Hospedaje'  && $output[$i]['post_content'][10] != 'Tour'){
                $aux[$i]['detalles'] = $output[$i]['post_content'][10];
            }

            if(is_numeric($output[$i]['post_content'][8]) == true){ //en caso de que sean valores numericos
                $aux[$i]['cant_adultos'] = $output[$i]['post_content'][8];
            }

            if(is_numeric($output[$i]['post_content'][9]) == true){
                $aux[$i]['cant_adultos'] = $output[$i]['post_content'][9];
            }

            if(is_numeric($output[$i]['post_content'][10]) == true){
                $aux[$i]['cant_adultos'] = $output[$i]['post_content'][10];
            }

            if(is_numeric($output[$i]['post_content'][11]) == true){
                $aux[$i]['cant_adultos'] = $output[$i]['post_content'][11];
            }
    
        }

        return $aux;

    }

    public function GetPostById($id){  // con esta funcion se extraen todos los datos desde la tabla de wordpress de la base de datos (solamente los incluidos en post_content y ID)
        $query = $this->db->query('SELECT wp5g_posts.ID,wp5g_posts.post_content,wp5g_posts.post_type FROM dammtour_wp75.wp5g_posts WHERE wp5g_posts.ID = '.$id);
        $data = $query->result_array();
        for ($i = 0; $i<count($data);$i++){
            $aux[$i]['pasajero_id'] = $data[$i]['ID'];
            $output[$i]['post_content'] = $data[$i]['post_content'];
            $output[$i]['post_content'] = preg_split('/\r\n|\r|\n/', $output[$i]['post_content']); // separa el string enorme en pedazos en un array

            // vamos a ir separando el arreglo de entrada por cada indice que presente. Los primeros 6 datos son fijos, asi que se asignan de una. 
            //$aux[$i]['estado'] = '0'; // INICIALIZAMOS EL ESTADO CON VALOR POR DEFECTO COMO NO DETERMINADO. 

            //comprobamos el estado
            $this->ComprobarEstado($aux[$i]['pasajero_id']);
            $aux[$i]['estado'] = $this->ObtenerEstado($aux[$i]['pasajero_id']);
            $aux[$i]['nombre'] = $output[$i]['post_content'][0];  // NOMBRE
            $aux[$i]['telefono'] = $output[$i]['post_content'][1]; // TELEFONO
            $aux[$i]['fecha_inicio'] = $output[$i]['post_content'][2]; //FECHA INICIO
            $aux[$i]['hora_inicio'] = $output[$i]['post_content'][3]; //HORA INICIO
            $aux[$i]['email'] = $output[$i]['post_content'][4]; //CORREO
            $aux[$i]['destino'] = $output[$i]['post_content'][5]; //DESTINO

            if(is_numeric($output[$i]['post_content'][6]) == true){     //en caso de que este indice tenga un valor numerico, se asigna este valor a los ninos
                $aux[$i]['cant_ninos'] = $output[$i]['post_content'][6];
            } else {
                $aux[$i]['cant_ninos'] = '0'; //si no, la cantidad de ninos es 0
            }
            
            $servicios = array();
            if($output[$i]['post_content'][6] == 'Transfer' || $output[$i]['post_content'][6] == 'Hospedaje' || $output[$i]['post_content'][6] == 'Tour'){
                array_push($servicios,$output[$i]['post_content'][6]);
            } 
            //comprueba la siguiente casilla
            if($output[$i]['post_content'][7] == 'Transfer' || $output[$i]['post_content'][7] == 'Hospedaje'  || $output[$i]['post_content'][7] == 'Tour'){
                array_push($servicios,$output[$i]['post_content'][7]);
            }
            //comprueba la ultima casilla de los servicios
            if($output[$i]['post_content'][8] == 'Transfer' || $output[$i]['post_content'][8] == 'Hospedaje'  || $output[$i]['post_content'][8] == 'Tour'){
                array_push($servicios,$output[$i]['post_content'][8]);
            }

            if($output[$i]['post_content'][9] == 'Transfer' || $output[$i]['post_content'][9] == 'Hospedaje'  || $output[$i]['post_content'][9] == 'Tour'){
                array_push($servicios,$output[$i]['post_content'][9]);
            }

            $servicios = implode(' ',$servicios);
            $aux[$i]['servicios'] = $servicios;

            if(is_numeric($output[$i]['post_content'][7]) == false && filter_var($output[$i]['post_content'][7], FILTER_VALIDATE_IP) == false && $output[$i]['post_content'][7] != 'Transfer' && $output[$i]['post_content'][7] != 'Hospedaje'  && $output[$i]['post_content'][7] != 'Tour'){ //en caso de que NO SEAN valores numericos
                $aux[$i]['detalles'] = $output[$i]['post_content'][7];
            }

            if(is_numeric($output[$i]['post_content'][8]) == false && filter_var($output[$i]['post_content'][8], FILTER_VALIDATE_IP) == false && $output[$i]['post_content'][8] != 'Transfer' && $output[$i]['post_content'][8] != 'Hospedaje'  && $output[$i]['post_content'][8] != 'Tour'){
                $aux[$i]['detalles'] = $output[$i]['post_content'][8];
            }

            if(is_numeric($output[$i]['post_content'][9]) == false && filter_var($output[$i]['post_content'][9], FILTER_VALIDATE_IP) == false && $output[$i]['post_content'][9] != 'Transfer' && $output[$i]['post_content'][9] != 'Hospedaje'  && $output[$i]['post_content'][9] != 'Tour'){
                $aux[$i]['detalles'] = $output[$i]['post_content'][9];
            }

            if(is_numeric($output[$i]['post_content'][10]) == false && filter_var($output[$i]['post_content'][10], FILTER_VALIDATE_IP) == false && $output[$i]['post_content'][10] != 'Transfer' && $output[$i]['post_content'][10] != 'Hospedaje'  && $output[$i]['post_content'][10] != 'Tour'){
                $aux[$i]['detalles'] = $output[$i]['post_content'][10];
            }

            if(is_numeric($output[$i]['post_content'][8]) == true){ //en caso de que sean valores numericos
                $aux[$i]['cant_adultos'] = $output[$i]['post_content'][8];
            }

            if(is_numeric($output[$i]['post_content'][9]) == true){
                $aux[$i]['cant_adultos'] = $output[$i]['post_content'][9];
            }

            if(is_numeric($output[$i]['post_content'][10]) == true){
                $aux[$i]['cant_adultos'] = $output[$i]['post_content'][10];
            }

            if(is_numeric($output[$i]['post_content'][11]) == true){
                $aux[$i]['cant_adultos'] = $output[$i]['post_content'][11];
            }
    
        }

        return $aux;
    }

    public function ComprobarEstado($pasajero_id){ // ESTA FUNCION SIRVE PARA COMPROBAR SI EFECTIVAMENTE EL REGISTRO DEL PASAJERO TIENE UN ESTADO INICIALIZADO. 
        $query = $this->db->query('SELECT count(estado) FROM estado_pasajeros WHERE pasajero_id = '.$pasajero_id);
        $data = $query->result_array();
        $flag = $data[0]['count(estado)']; // esto deberia retornar un 0 si no hay o un 1 si encuentra un registro.

        if($flag == '0'){
            $this->InicializarEstado($pasajero_id);
            unset($flag);
        }
        

        elseif($flag == '1'){
            return 0;
            unset($flag);
        }

    }

    public function InicializarEstado($pasajero_id){ // funcion para insertar el valor del estado a la tabla de dammtour_sigetur
        $data['pasajero_id'] = $pasajero_id;
        $data['estado'] = 0;
        $this->db->insert('pasajero',$data);
    }

    public function ObtenerEstado($pasajero_id){
        $query = $this->db->query('SELECT estado FROM estado_pasajeros WHERE pasajero_id = '.$pasajero_id);
        $data = $query->result_array();

        return $data[0]['estado'];
    }



    /*public function Wordpress_Output(){ //con esto se procesa el output para que despues se puedan insertar todos los datos a la base de datos local de dammtour.
        $output = $this->GetAllPosts();
        
        //con esto vamos a seccionar el array en varias partes y luego dejar todo asignado a un mismo objeto
        for ($i = 0 ; $i < count($output); $i++){
            $aux[$i]['id_pasajero'] = $output[$i]['ID']; 
            $output[$i]['post_content'] = preg_split('/\r\n|\r|\n/', $output[$i]['post_content']); // separa el string enorme en pedazos en un array
            $aux[$i]['nombre'] = $output[$i]['post_content'][0];
            $aux[$i]['apellido'] = $output[$i]['post_content'][1];          //estas variables son fijas en el string que llega desde wordpress.
            $aux[$i]['telefono'] = $output[$i]['post_content'][3];
            $aux[$i]['email'] = $output[$i]['post_content'][2];

            //array de los servicios disponibles, deben estar todos los casos posibles
            $servicios = array();
            if($output[$i]['post_content'][4] == 'Transfer' || $output[$i]['post_content'][4] == 'Hospedaje' || $output[$i]['post_content'][4] == 'Tour'){
                array_push($servicios,$output[$i]['post_content'][4]);
            } 
            //comprueba la siguiente casilla
            if($output[$i]['post_content'][5] == 'Hospedaje' || $output[$i]['post_content'][5] == 'Tour'){
                array_push($servicios,$output[$i]['post_content'][5]);
            }
            //comprueba la ultima casilla de los servicios
            if($output[$i]['post_content'][6] == 'Tour'){
                array_push($servicios,$output[$i]['post_content'][6]);
            }
            $servicios = implode(' ',$servicios);
            $aux[$i]['servicios'] = $servicios;

            //cantidad de pasajeros en el tranfer, si o si va a estar en el espacio 5 del arreglo y en su conjunto pone la observacion en el espacio siguiente.
            if($output[$i]['post_content'][5] != 'Hospedaje' || $output[$i]['post_content'][5] != 'Tour'){
                $aux[$i]['acompa'] = $output[$i]['post_content'][5];
                $aux[$i]['observacion'] = $output[$i]['post_content'][6];
            }
            if($output[$i]['post_content'][6] != 'Tour'){ // comprueba lo mismo con el otro espacio
                $aux[$i]['acompa'] = $output[$i]['post_content'][6];
                $aux[$i]['observacion'] = $output[$i]['post_content'][7];
            }
            else{
                $aux[$i]['acompa'] = $output[$i]['post_content'][7];
                $aux[$i]['observacion'] = $output[$i]['post_content'][8];
            }

        }
        return $aux;
    }*/


    public function InsertarVehiculo($data){
        $this->db->insert('vehiculo',$data);
    }

    public function EliminarPasajeroWordpress($data){
        $this->db->delete('dammtour_wp75.wp5g_posts',array('ID' => $data['id_pasajero']));
    }

}