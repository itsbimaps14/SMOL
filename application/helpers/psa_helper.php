<?php
	function get_kode_nama_psa($id=NULL){
		$CI =& get_instance();
		$hasil = $CI->model_crud->get_one('t_db_spek','id_t_dbspek',$id)->row_array();
		return $hasil;
	}
	function get_kode_gudang($oracle=NULL,$plant=NULL){
		$CI =& get_instance();
		$hasil = $CI->db->query("SELECT * FROM t_kode_gudang WHERE kode_oracle = '$oracle' AND plant = '$plant'")->row_array();
		return $hasil;
	}
	function panel_gudang($id=NULL){
		$CI =& get_instance();
		$hasil = $CI->db->query("
			SELECT t_gudang.*, tanggal_exp
			FROM t_gudang
			JOIN t_kedatangan ON t_gudang.kode_produksi = t_kedatangan.kode_produksi
			WHERE id_kode = '$id' AND stok > 0 ORDER BY tanggal_exp ASC");
		return $hasil;
	}
	function psa_gudang_log($id=NULL,$status=NULL,$jumlah=NULL,$running=NULL){
		$CI =& get_instance();
		$tanggal 	= date('Y-m-d H:i:s'); //Get today date
		$user		= $CI->session->userdata('username');
		$data 		= array(
			'id_gudang' 		=> $id,
			'nomor_running'		=> $running,
			'status'			=> $status,
			'jumlah'			=> $jumlah,
			'tanggal'			=> $tanggal,
			'penanggungjawab'	=> $user);
		$CI->model_crud->create_data('t_log_gudang',$data);
	}
	function gudang_produksi($id=NULL,$jumlah=NULL,$running=NULL){
		$CI =& get_instance();
		$help = $CI->db->query("SELECT * FROM t_gudang WHERE id = '$id'")->row_array();
		$input_query 	= $CI->db->query("
			SELECT *
			FROM t_gudang_produksi 
			WHERE kode_produksi = '$help[kode_produksi]' AND id_kode = '$help[id_kode]'");
		$input 			= $input_query->num_rows();
		switch ($input) {
			case 0:
				$data = array(
					'id_kode'		=> $help['id_kode'],
					'stok'			=> $jumlah,
					'kode_produksi'	=> $help['kode_produksi']);
				$CI->model_crud->create_data('t_gudang_produksi',$data);
			break;
			
			default:
				$val_input = $input_query->row_array();
				$data = array('stok' => $val_input['stok'] + $jumlah);
				$CI->model_crud->update_data('t_gudang_produksi',$data,'id',$val_input['id']);
			break;
		}
		psa_produksi_log($help,'deposit',$jumlah,$running);
	}
	function psa_produksi_log($help=NULL,$status=NULL,$jumlah=NULL,$running=NULL){
		$CI =& get_instance();
		$user		= $CI->session->userdata('username');
		$date 		= date('Y-m-d H:i:s'); //Get today date
		$input 		= $CI->db->query("
			SELECT *
			FROM t_gudang_produksi 
			WHERE kode_produksi = '$help[kode_produksi]' AND id_kode = '$help[id_kode]'")->row_array();
		$data = array(
			'id_gudang'			=> $input['id'],
			'nomor_running'		=> $running,
			'status'			=> $status,
			'jumlah'			=> $jumlah,
			'tanggal'			=> $date,
			'penanggungjawab'	=> $user);
		$CI->model_crud->create_data('t_log_gudang_p',$data);
	}
?>