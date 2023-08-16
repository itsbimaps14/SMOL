<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_produksi extends CI_Model {
	public function get_gudang($dept=NULL){
		if ($dept == 'admin') {
			$where = 'stok > 0';
		}
		else{
			$plant = $this->session->userdata('plant');
			$where = 't_kode_gudang.plant = "'.$plant.'" AND stok > 0';
		}
		
		return $this->db
			->select('t_kode_gudang.kode_oracle, nama_bahan, t_gudang_produksi.kode_produksi, tanggal_exp, stok')
			->from('t_kode_gudang')
			->join('t_db_spek','t_kode_gudang.kode_oracle = t_db_spek.kode_oracle','LEFT')
			->join('t_gudang_produksi','t_kode_gudang.id_t_kode_gudang = t_gudang_produksi.id_kode','LEFT')
			->join('t_kedatangan','t_gudang_produksi.kode_produksi = t_kedatangan.kode_produksi','LEFT')
			->where($where)
			->get();
	}

	public function log_gudang($dept=NULL){
		if ($dept == 'admin') {
			$where = 't_kode_gudang.plant != ""';
		}
		else{
			$plant = $this->session->userdata('plant');
			$where = 't_kode_gudang.plant = "'.$plant.'"';
		}
		
		return $this->db
			->select('t_kode_gudang.kode_oracle, nama_bahan, t_gudang_produksi.kode_produksi, t_log_gudang_p.*')
			->from('t_log_gudang_p')
			->join('t_gudang_produksi','t_log_gudang_p.id_gudang = t_gudang_produksi.id','LEFT')
			->join('t_kode_gudang','t_kode_gudang.id_t_kode_gudang = t_gudang_produksi.id_kode','LEFT')
			->join('t_db_spek','t_kode_gudang.kode_oracle = t_db_spek.kode_oracle','LEFT')
			->where($where)
			->get();
	}

	public function log_tmp_gudang($table=NULL,$data=NULL){
		$data 		= array(
			'id_gudang' 		=> $data['id'],
			'nomor_running'		=> $data['running'],
			'status'			=> $data['status'],
			'jumlah'			=> $data['jumlah'],
			'tanggal'			=> $data['tanggal'],
			'penanggungjawab'	=> $data['penanggungjawab']);
		$this->model_crud->create_data($table,$data);
	}

	public function log_tmp_produksi($table=NULL,$data=NULL){
		$tanggal 	= date('Y-m-d H:i:s'); //Get today date
		$user		= $this->session->userdata('username');
		$data 		= array(
			'id_gudang' 		=> $data['id'],
			'nomor_running'		=> $data['running'],
			'status'			=> $data['status'],
			'jumlah'			=> $data['jumlah'],
			'tanggal'			=> $tanggal,
			'penanggungjawab'	=> $user);
		$this->model_crud->create_data($table,$data);
	}

	public function hitung_gudang($id=NULL,$jumlah=NULL){
		$help = $this->db->query("SELECT * FROM t_gudang WHERE id = '$id'")->row_array();
		$input_query 	= $this->db->query("
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
				$this->model_crud->create_data('t_gudang_produksi',$data);
			break;
			
			default:
				$val_input = $input_query->row_array();
				$data = array('stok' => $val_input['stok'] + $jumlah);
				$this->model_crud->update_data('t_gudang_produksi',$data,'id',$val_input['id']);
			break;
		}
		$data = array('stok' => $help['stok'] - $jumlah);
		$this->model_crud->update_data('t_gudang',$data,'id',$id);
	}
}

/* End of file model_produksi.php */
/* Location: ./application/models/model_produksi.php */