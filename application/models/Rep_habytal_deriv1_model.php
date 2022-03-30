<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Rep_habytal_deriv1_model extends General_model {
	public function __construct() {
		$table = 'full_habytal_derv1';
        parent::__construct($table);
    }

    public function habytal($id = null) {
        $this->db->from('full_habytal_derv1');
        $this->db->where('full_habytal_derv1.id',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = [
                $data['perf_est'], 
                $data['tal1_est'], 
                $data['tal2_est'], 
                $data['tal3_est'], 
                $data['tal4_est'], 
                $data['tal5_est'],
                $data['hab1_est'], 
                $data['hab2_est'], 
                $data['hab3_est'], 
                $data['hab4_est'], 
                $data['hab5_est'], 
                $data['perf_pie'], 
                $data['tal1_pie'],
                $data['tal2_pie'], 
                $data['tal3_pie'], 
                $data['tal4_pie'], 
                $data['tal5_pie'],
                $data['hab1_pie'], 
                $data['hab2_pie'], 
                $data['hab3_pie'], 
                $data['hab4_pie'],
                $data['hab5_pie']
            ];
        }
        return $values;
    }    
}
