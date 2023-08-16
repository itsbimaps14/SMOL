<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_qc extends CI_Model {

	public function get_tbl_kedatangan($id_t_kedatangan=NULL){
		return $this->db
			->select('t_kedatangan.*, kode_oracle, satuan, nama_bahan')
			->from('t_kedatangan')
			->join('t_db_spek','t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek','INNER')
			->where('id_t_kedatangan',$id_t_kedatangan)
			->get();
	}

	public function get_tbl_spb($id_t_kedatangan=NULL){
		return $this->db
			->select('t_kedatangan.*, kode_oracle, satuan, nama_bahan, t_spb.*')
			->from('t_kedatangan')
			->join('t_spb','t_kedatangan.running_spb = t_spb.no_running_spb','INNER')
			->join('t_db_spek','t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek','INNER')
			->where('id_t_kedatangan',$id_t_kedatangan)
			->get();
	}

	public function get_for_spb($id_t_kedatangan=NULL){
		return $this->db
			->select('t_kedatangan.*, kode_oracle, satuan, nama_bahan, t_spb.*')
			->from('t_kedatangan')
			->join('t_spb','t_kedatangan.running_spb = t_spb.no_running_spb','INNER')
			->join('t_db_spek','t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek','INNER')
			->where('id_t_kedatangan',$id_t_kedatangan)
			->get();
	}

	public function view_qc($where=NULL){
		return $this->db
			->select('kode_oracle,satuan,nama_bahan,t_kedatangan.*')
			->from('t_kedatangan')
			->join('t_db_spek','t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek','INNER')
			->where($where)
			->get();
	}

	public function delete_file($id=null){
		$result = $this->db->query("SELECT * FROM t_kedatangan WHERE id_t_kedatangan = '$id'")->row_array();
		unlink('uploads/file_coa_psa/'.$result['attachement_coa']);
		unlink('uploads/file_hak_qc/'.$result['attachement_hak_release']);
		unlink('uploads/file_hak_qc/'.$result['attachement_hak_monitoring']);
	}

	public function edit_hak_r_file($id=null){
		$result = $this->db->query("SELECT * FROM t_kedatangan WHERE id_t_kedatangan = '$id'")->row_array();
		unlink('uploads/file_hak_qc/'.$result['attachement_hak_release']);
	}

	public function edit_hak_m_file($id=null){
		$result = $this->db->query("SELECT * FROM t_kedatangan WHERE id_t_kedatangan = '$id'")->row_array();
		unlink('uploads/file_hak_qc/'.$result['attachement_hak_monitoring']);
	}

}

/* End of file model_auth.php */
/* Location: ./application/models/model_auth.php */