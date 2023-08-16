<?php
	function running_permintaan(){
		$CI =& get_instance();

		$tahun = date('Y');
		$bulan = date('m');
		$lokasi = $CI->session->userdata('plant');
		$plant	= strtoupper($lokasi);
		$record = $CI->db->query("SELECT MAX(left(running_permintaan,3)) as kode FROM t_permintaan WHERE plant = '$lokasi' AND RIGHT(running_permintaan,4) = '$tahun'");
		foreach($record->result() as $r) {
				$kode = $r->kode;
		}
		if(empty($kode)) {
				$no_db_spek = "001/PSM/$plant/$bulan/$tahun";
		}
		else {
				$no = $kode + 1;
				$no = str_pad($no, 3, '0', STR_PAD_LEFT);
				$no_db_spek = "$no/PSM/$plant/$bulan/$tahun";
		}
		return $no_db_spek;
	}

	function get_log_panel($running=NULL){
		$CI =& get_instance();
		$hasil = $CI->db->query("SELECT t_log_gudang_tmp.*, t_gudang.*, tanggal_exp
			FROM t_log_gudang_tmp 
			LEFT JOIN t_gudang ON t_log_gudang_tmp.id_gudang = t_gudang.id
			LEFT JOIN t_kedatangan on t_gudang.kode_produksi = t_kedatangan.kode_produksi
			WHERE nomor_running = '$running'
			GROUP BY nomor_running");
		return $hasil;
	}

	function data_gudang_produksi($id=NULL,$jumlah=NULL){
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
	}
?>