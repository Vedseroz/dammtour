<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Rep_habytal_deriv2_model extends General_model {
	public function __construct() {
		$table = 'full_habytal_derv2';
        parent::__construct($table);
    }

    public function habytal($id = null) {
        $this->db->from('full_habytal_derv2');
        $this->db->where('full_habytal_derv2.id',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            $data = $query->row_array();
            $values = [
                $data['perf_pro'], 
                $data['tal1_pro'], 
                $data['tal2_pro'], 
                $data['tal3_pro'], 
                $data['tal4_pro'], 
                $data['tal5_pro'], 
                $data['hab1_pro'], 
                $data['hab2_pro'], 
                $data['hab3_pro'], 
                $data['hab4_pro'], 
                $data['hab5_pro'],
                $data['perf_cc'],
                $data['tal1_cc'], 
                $data['tal2_cc'], 
                $data['tal3_cc'], 
                $data['tal4_cc'], 
                $data['tal5_cc'],
                $data['hab1_cc'], 
                $data['hab2_cc'], 
                $data['hab3_cc'], 
                $data['hab4_cc'],
                $data['hab5_cc'],
                $data['perf_ori'],
                $data['tal1_ori'], 
                $data['tal2_ori'], 
                $data['tal3_ori'], 
                $data['tal4_ori'],
                $data['tal5_ori'], 
                $data['hab1_ori'], 
                $data['hab2_ori'], 
                $data['hab3_ori'], 
                $data['hab4_ori'],
                $data['hab5_ori']
            ];
        }
        return $values;
    }    
}
