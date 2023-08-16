<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_auth extends CI_Model {

	public function login($table,$data)
	{
		$cek = $this->db->get_where($table,$data);
		if($cek->num_rows() > 0) {
			$u		= $cek->row_array();
			$data	= array('id_user'=>$u['id_user'],
							'username'=>$u['username'],
							'nama'=>$u['nama'],
							'level'=>$u['level'],
							'email'=>$u['email'],
							'plant'=>$u['plant'],
							'dept'=>$u['dept'],
							'status_login'=>1);
			return $data; 
		}
		else {
			return 0;
		}
	}

}

/* End of file model_auth.php */
/* Location: ./application/models/model_auth.php */