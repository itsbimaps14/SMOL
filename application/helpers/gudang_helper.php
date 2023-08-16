<?php

	function count_stock($id=NULL,$id_kedatangan=NULL,$jumlah=NULL,$plant=NULL){
		$CI =& get_instance();

		$plant			= ucfirst(strtolower($plant));
		$kode 			= get_kode($id); //Kode Oracle
		$id_stok		= get_idstok($kode['kode_oracle'],$plant); //ID tabel kode gudang
		$kode_prod 		= get_kodeprod($id_kedatangan); //Kode Produksi
		$input_query 	= $CI->db->query("
			SELECT *
			FROM t_gudang 
			WHERE kode_produksi = '$kode_prod[kode_produksi]' AND id_kode = '$id_stok[id_t_kode_gudang]'");
		$input 			= $input_query->num_rows();
		
		switch ($input) {
			case 0:
				$data = array(
					'id_kode'		=> $id_stok['id_t_kode_gudang'],
					'stok'			=> $jumlah,
					'kode_produksi'	=> $kode_prod['kode_produksi']);
				$CI->model_crud->create_data('t_gudang',$data);
			break;
			
			default:
				$val_input = $input_query->row_array();
				$data = array('stok' => $val_input['stok'] + $jumlah);
				$CI->model_crud->update_data('t_gudang',$data,'id',$val_input['id']);
			break;
		}

		//Input untuk LOG data
		log_gudang($id,$id_kedatangan,$jumlah,$plant,'deposit');
	}

	function log_gudang($id=NULL,$id_kedatangan=NULL,$jumlah=NULL,$plant=NULL,$status=NULL){
		$CI =& get_instance();

		$plant			= ucfirst(strtolower($plant));
		$user			= $CI->session->userdata('username'); //Get username
		$date 			= date('Y-m-d H:i:s'); //Get today date
		$kode 			= get_kode($id); //Kode Oracle
		$id_stok		= get_idstok($kode['kode_oracle'],$plant); //ID tabel kode gudang
		$kode_prod 		= get_kodeprod($id_kedatangan); //Kode Produksi
		$input 		 	= $CI->db->query("
			SELECT *
			FROM t_gudang 
			WHERE kode_produksi = '$kode_prod[kode_produksi]' AND id_kode = '$id_stok[id_t_kode_gudang]'")->row_array();
		$data = array(
			'id_gudang'			=> $input['id'],
			'nomor_running'		=> $kode_prod['no_running_kedatangan'],
			'status'			=> $status,
			'jumlah'			=> $jumlah,
			'tanggal'			=> $date,
			'penanggungjawab'	=> $user);
		$CI->model_crud->create_data('t_log_gudang',$data);
	}

	function get_kode($id=NULL){
		$CI =& get_instance();
		return $CI->model_crud->get_one('t_db_spek','id_t_dbspek',$id)->row_array();
	}

	function get_idstok($oracle=NULL,$plant=NULL){
		$CI =& get_instance();
		return $CI->model_crud->get_where('t_kode_gudang','kode_oracle = "'.$oracle.'" AND plant = "'.$plant.'"')->row_array();
	}

	function get_kodeprod($id=NULL){
		$CI =& get_instance();
		return $CI->model_crud->get_one('t_kedatangan','id_t_kedatangan',$id)->row_array();
	}
?>