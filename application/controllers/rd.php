<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rd extends CI_Controller {

	var $folder = 'rd';
	var $table = 't_tahanan';

	public function __construct(){
		parent::__construct();
		cek_dept('rd');
	}

	public function index(){
		$this->template->load('nav_head','dashboard/rd_main');
	}

	public function proses(){
		if(isset($_POST['submit'])) {
			$no_running				= $this->input->post('no_running');
			$penyebab 				= $this->input->post('penyebab');
			$hasil_analisa			= $this->input->post('hasil_analisa');
			$tindakan_koreksi		= $this->input->post('tindakan_koreksi');
			$pic1					= $this->input->post('pic1');
			$tindakan_preventive 	= $this->input->post('tindakan_preventive');
			$pic2					= $this->input->post('pic2');
			$status_tahanan			= $this->input->post('status_tahanan');

			$data = array(
				'penyebab' 				=> $penyebab,
				'hasil_analisa' 		=> $hasil_analisa,
				'tindakan_koreksi'		=> $tindakan_koreksi,
				'pic1'					=> $pic1,
				'tindakan_preventive'	=> $tindakan_preventive,
				'pic2'					=> $pic2,
				'status_tahanan'		=> $status_tahanan
			);

			$result = array(
				'status_all' => 'Tahanan',
				'status_tahanan_rd' => $status_tahanan
			);

			$this->model_crud->update_data($this->table,$data,'no_running_tahanan',$no_running);
			$this->model_crud->update_data('t_kedatangan',$result,'running_tahanan',$no_running);
			$this->session->set_flashdata('msg_success','Data informasi kedatangan & status berhasil diubah.');
			email_tahanan_rd($no_running);
			redirect('rd');
		}
		else {
			$id_t_tahanan	= $this->uri->segment(3);
			$data['record'] = $this->db->query("
				SELECT *
				FROM t_tahanan
				WHERE id_t_tahanan = '$id_t_tahanan'")->row_array();
			$this->template->load('nav_head',$this->folder.'/rd_proses_form',$data);
		}
	}

	public function edit(){
		if(isset($_POST['submit'])) {
			$no_running 			= $this->input->post('no_running');
			$alasan_tahanan			= $this->input->post('alasan_tahanan');
			$spek_tahanan			= $this->input->post('spek_tahanan');
			$penyebab				= $this->input->post('penyebab');
			$hasil_analisa			= $this->input->post('hasil_analisa');
			$tindakan_koreksi		= $this->input->post('tindakan_koreksi');
			$pic1					= $this->input->post('pic1');
			$tindakan_preventive 	= $this->input->post('tindakan_preventive');
			$pic2					= $this->input->post('pic2');

			$data = array(
				'alasan_tahanan' 		=> $alasan_tahanan,
				'spek_tahanan'			=> $spek_tahanan,
				'penyebab'				=> $penyebab,
				'hasil_analisa'			=> $hasil_analisa,
				'tindakan_koreksi'		=> $tindakan_koreksi,
				'pic1'					=> $pic1,
				'tindakan_preventive'	=> $tindakan_preventive,
				'pic2'					=> $pic2
			);

			$this->model_crud->update_data($this->table,$data,'no_running_tahanan',$no_running);
			$this->session->set_flashdata('msg_success','Data tahanan berhasil diedit.');
			redirect('rd');
		}
		else {
			$id_t_tahanan	= $this->uri->segment(3);
			$data['record'] = $this->db->query("
				SELECT *
				FROM t_tahanan
				WHERE id_t_tahanan = '$id_t_tahanan'")->row_array();
			$this->template->load('nav_head',$this->folder.'/rd_proses_form',$data);
		}
	}

	public function delete(){
		$id_t_tahanan = $this->uri->segment(3);
		$this->model_crud->delete_data($this->table,'id_t_tahanan',$id_t_tahanan);
		$this->session->set_flashdata('msg_success','Data kedatangan berhasil dihapus.');
		redirect('qc');
	}

	public function view_proses(){
		$plant = $this->session->userdata('plant');

		switch ($plant) {
			case 'All':
				$data['read'] = $this->db->query("
					SELECT kode_oracle,nama_bahan,satuan,t_kedatangan.*, t_tahanan.*
					FROM t_kedatangan
					INNER JOIN t_tahanan ON t_kedatangan.running_tahanan = t_tahanan.no_running_tahanan
					INNER JOIN t_db_spek ON t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek
					WHERE status_all = 'Tahanan RD' AND status_tahanan is NULL
				");
			break;
			
			default:
				$data['read'] = $this->db->query("
					SELECT kode_oracle,nama_bahan,satuan,t_kedatangan.*, t_tahanan.*
					FROM t_kedatangan
					INNER JOIN t_tahanan ON t_kedatangan.running_tahanan = t_tahanan.no_running_tahanan
					INNER JOIN t_db_spek ON t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek
					WHERE plant = '$plant' AND status_all = 'Tahanan RD' AND status_tahanan is NULL
				");
			break;
		}

		$this->template->load('nav_head',$this->folder.'/rd_proses_view',$data);
	}

	public function view_done(){
		$plant = $this->session->userdata('plant');

		switch ($plant) {
			case 'All':
				$data['read'] = $this->db->query("
					SELECT kode_oracle,nama_bahan,satuan,t_kedatangan.*, t_tahanan.*
					FROM t_tahanan
					INNER JOIN t_kedatangan ON t_kedatangan.running_tahanan = t_tahanan.no_running_tahanan
					INNER JOIN t_db_spek ON t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek
					WHERE status_tahanan != ''
				");
			break;
			
			default:
				$data['read'] = $this->db->query("
					SELECT kode_oracle,nama_bahan,satuan,t_kedatangan.*, t_tahanan.*
					FROM t_tahanan
					INNER JOIN t_kedatangan ON t_kedatangan.running_tahanan = t_tahanan.no_running_tahanan
					INNER JOIN t_db_spek ON t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek
					WHERE plant = '$plant' AND status_tahanan != ''
				");
			break;
		}

		$this->template->load('nav_head',$this->folder.'/rd_proses_view',$data);
	}

	public function report(){
		cek_menu('admin');
		$this->template->load('nav_head','report_par/admin_report_tahanan_view');
	}

	public function report_tahanan(){
		$this->datatables->select('
			tanggal_datang,
			no_running_tahanan,
			kode_oracle,
			nama_bahan,
			kode_produksi,
			alasan_tahanan,
			spek_tahanan,
			penyebab,
			hasil_analisa,
			status_tahanan,
			tindakan_koreksi,
			pic1,
			tindakan_preventive,
			pic2,
			status_qc,
			status_all');
		$this->datatables->from('t_tahanan');
		$this->datatables->join('t_kedatangan','t_tahanan.tahanan_kedatangan = t_kedatangan.no_running_kedatangan','left');
		$this->datatables->join('t_db_spek','t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek','left');

		return print_r($this->datatables->generate());
	}

}

/* End of file rd.php */
/* Location: ./application/controllers/rd.php */