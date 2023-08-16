<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_psa extends CI_Model {

	public function view_psa($where=NULL){
		return $this->db
			->select('kode_oracle,satuan,nama_bahan,t_kedatangan.*')
			->from('t_kedatangan')
			->join('t_db_spek','t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek','INNER')
			->where($where)
			->get();
	}

	public function par_release($id=NULL){
		return $this->db
			->select('t_parameter_release.*')
			->from('t_db_spek')
			->join('t_parameter_release','t_parameter_release.no_db_spek_release = t_db_spek.no_db_spek','INNER')
			->where('id_t_dbspek = '.$id.'')
			->get();
	}

	public function par_monitor($id=NULL){
		return $this->db
			->select('t_parameter_monitoring.*')
			->from('t_db_spek')
			->join('t_parameter_monitoring','t_db_spek.no_db_spek = t_parameter_monitoring.no_db_spek_monitoring','INNER')
			->where('id_t_dbspek = '.$id.'')
			->get();
	}

	public function update_coa($id=null){
		$result = $this->db->query("SELECT * FROM t_kedatangan WHERE id_t_kedatangan = '$id'")->row_array();
		unlink('uploads/file_coa_psa/'.$result['attachement_coa']);
	}

	public function delete_file($id=null){
		$result = $this->db->query("SELECT * FROM t_kedatangan WHERE id_t_kedatangan = '$id'")->row_array();
		unlink('uploads/file_coa_psa/'.$result['attachement_coa']);
		unlink('uploads/file_hak_qc/'.$result['attachement_hak_release']);
		unlink('uploads/file_hak_qc/'.$result['attachement_hak_monitoring']);
	}

	public function get_gudang($dept=NULL){
		if ($dept == 'admin') {
			$where = 'stok > 0';
		}
		else{
			$plant = $this->session->userdata('plant');
			$where = 't_kode_gudang.plant = "'.$plant.'" AND stok > 0';
		}
		
		return $this->db
			->select('t_kode_gudang.kode_oracle, nama_bahan, t_gudang.kode_produksi, tanggal_exp, stok')
			->from('t_kode_gudang')
			->join('t_db_spek','t_kode_gudang.kode_oracle = t_db_spek.kode_oracle','LEFT')
			->join('t_gudang','t_kode_gudang.id_t_kode_gudang = t_gudang.id_kode','LEFT')
			->join('t_kedatangan','t_gudang.kode_produksi = t_kedatangan.kode_produksi','LEFT')
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
			->select('t_kode_gudang.kode_oracle, nama_bahan, t_gudang.kode_produksi, t_log_gudang.*')
			->from('t_log_gudang')
			->join('t_gudang','t_log_gudang.id_gudang = t_gudang.id','LEFT')
			->join('t_kode_gudang','t_kode_gudang.id_t_kode_gudang = t_gudang.id_kode','LEFT')
			->join('t_db_spek','t_kode_gudang.kode_oracle = t_db_spek.kode_oracle','LEFT')
			->where($where)
			->get();
	}

	public function log_tmp_gudang($table=NULL,$data=NULL){
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
}

/* End of file model_psa.php */
/* Location: ./application/models/model_psa.php */