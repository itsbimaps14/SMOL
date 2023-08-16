<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class report_par extends CI_Controller {

	var $folder = 'report_par';
	var $table_release = 't_parameter_release';
	var $table_monitoring = 't_parameter_monitoring';

	public function __construct()
	{
		parent::__construct();
	}

	public function release()
	{
		cek_menu('admin');
		$this->template->load('nav_head',$this->folder.'/admin_report_par_release_view');
	}

	public function monitoring()
	{
		cek_menu('admin');
		$this->template->load('nav_head',$this->folder.'/admin_report_par_monitoring_view');
	}

	public function report_par_release()
	{
		$where = array(
			'status_db_spek' => 'Active',
			'status_top' => 'Top');
		$this->datatables->select('id_t_parameter_release,nama_golongan,kode_oracle,nama_bahan,umur_simpan,kondisi_penyimpanan,kat_spek,nama_parameter');
		$this->datatables->from($this->table_release);
		$this->datatables->join('t_db_spek','t_db_spek.no_db_spek = t_parameter_release.no_db_spek_release','inner');
		$this->datatables->join('t_golongan','t_db_spek.golongan = t_golongan.id_t_golongan','inner');
		$this->datatables->join('t_kategori_spek','t_parameter_release.kategori_spek_release = t_kategori_spek.id_t_katspek','inner');
		$this->datatables->join('t_nama_parameter','t_parameter_release.nama_parameter_release = t_nama_parameter.id_t_nama_parameter','inner');
		$this->datatables->where($where);

		return print_r($this->datatables->generate());
	}

	public function report_par_monitoring()
	{
		$where = array(
			'status_db_spek' => 'Active',
			'status_top' => 'Top');

		$this->datatables->select('id_t_parameter_monitoring,nama_golongan,kode_oracle,nama_bahan,umur_simpan,kondisi_penyimpanan,kat_spek,nama_parameter');
		$this->datatables->from($this->table_monitoring);
		$this->datatables->join('t_db_spek','t_db_spek.no_db_spek = t_parameter_monitoring.no_db_spek_monitoring','inner');
		$this->datatables->join('t_golongan','t_db_spek.golongan = t_golongan.id_t_golongan','inner');
		$this->datatables->join('t_kategori_spek','t_parameter_monitoring.kategori_spek_monitoring = t_kategori_spek.id_t_katspek','inner');
		$this->datatables->join('t_nama_parameter','t_parameter_monitoring.nama_parameter_monitoring = t_nama_parameter.id_t_nama_parameter','inner');
		$this->datatables->where($where);

		return print_r($this->datatables->generate());
	}

}

/* End of file report_par.php */
/* Location: ./application/controllers/report_par.php */