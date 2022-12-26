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
        $query = $this->db->query('SELECT * FROM dammtour_wp75.wp5g_posts');
        $data = $query->result_array();
        for ($i = 0; $i<count($data);$i++){
            $aux[$i]['ID'] = $data[$i]['ID'];
            $aux[$i]['post_content'] = $data[$i]['post_content'];
        }
        $data = $aux;
        $string = $data;
    
        return $string;
    }

    public function Wordpress_Output(){ //con esto se procesa el output para que despues se puedan insertar todos los datos a la base de datos local de dammtour.
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
    }

    public function GetPostById($id){
        $query = $this->db->query('SELECT * FROM dammtour_wp75.wp5g_posts WHERE ID = '.$id);
        $data = $query->result_array();
        return $data;
    }

    public function InsertarVehiculo($data){
        $this->db->insert('vehiculo',$data);
    }

    public function EliminarPasajeroWordpress($data){
        $this->db->delete('dammtour_wp75.wp5g_posts',array('ID' => $data['id_pasajero']));
    }

}