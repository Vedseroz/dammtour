<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Rep_habytal_deriv3_model extends General_model {
	public function __construct() {
		$table = 'full_habytal_derv3';
        parent::__construct($table);
    }

    public function habytal($id = null) {
        $this->db->from('full_habytal_derv3');
        $this->db->where('full_habytal_derv3.id',$id);
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
                $data['perf_dp'],
                $data['tal1_dp'], 
                $data['tal2_dp'], 
                $data['tal3_dp'], 
                $data['tal4_dp'], 
                $data['tal5_dp'],
                $data['hab1_dp'], 
                $data['hab2_dp'], 
                $data['hab3_dp'], 
                $data['hab4_dp'],
                $data['hab5_dp']
            ];
        }
        return $values;
    }    
}
