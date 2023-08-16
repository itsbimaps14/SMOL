<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class released_partial extends CI_Controller {

	var $folder = 'released_partial';
	var $table = 't_kedatangan';

	public function __construct(){
		parent::__construct();
		$this->load->model('model_qc');
	}

	public function index(){
		$plant = $this->session->userdata('plant');
		switch ($plant) {
			case 'All':
				$data['read'] = $this->model_qc->view_qc('status_qc = "Released Partial"');
			break;
			default:
				$data['read'] = $this->model_qc->view_qc('plant = "'.$plant.'" AND status_qc = "Released Partial"');
			break;
		}
		$this->template->load('nav_head','qc/'.$this->folder.'/qc_released_partial_view',$data);
	}

	public function input(){
		if(isset($_POST['submit'])) {
			$id_t_kedatangan	= $this->input->post('id_kedatangan');
			$no_running 		= $this->input->post('no_running');
			$plant				= strtoupper($this->input->post('plant'));
			$tanggal_spb 		= $this->input->post('tanggal_spb');
			$receipt_oracle 	= $this->input->post('receipt_oracle');
			$no_polisi 			= $this->input->post('no_polisi');
			$no_jasa 			= $this->input->post('no_jasa');
			$no_reel 			= $this->input->post('no_reel');
			$no_seal 			= $this->input->post('no_seal');
			$kondisi_seal 		= $this->input->post('kondisi_seal');
			$no_container 		= $this->input->post('no_container');
			$jumlah_tidaksesuai = $this->input->post('jumlah_tidaksesuai');
			$alasan_tolak 		= $this->input->post('alasan_tolak');
			$alasan_revisi 		= $this->input->post('alasan_revisi');

			$data = array(
				'no_running_spb' 		=> $no_running,
				'plant'					=> $plant,
				'tanggal_spb'			=> $tanggal_spb,
				'receipt_oracle'		=> $receipt_oracle,
				'no_polisi'				=> $no_polisi,
				'no_jasa'				=> $no_jasa,
				'no_reel'				=> $no_reel,
				'no_seal'				=> $no_seal,
				'kondisi_seal'			=> $kondisi_seal,
				'no_container'			=> $no_container,
				'jumlah_tidaksesuai'	=> $jumlah_tidaksesuai,
				'alasan_ditolak'		=> $alasan_tolak,
				'alasan_revisi'			=> $alasan_revisi
			);
			$kedatangan = array('running_spb' => $no_running);

			$this->model_crud->create_data('t_spb',$data);
			$this->model_crud->update_data('t_kedatangan',$kedatangan,'id_t_kedatangan',$id_t_kedatangan);
			$this->session->set_flashdata('msg_success','Data SPB Berhasil ditambahkan !');

			redirect('released_partial');
		}
		else{
			$id_t_kedatangan	= $this->uri->segment(3);
			$data['record'] 	= $this->model_qc->get_tbl_kedatangan($id_t_kedatangan)->row_array();
			$this->template->load('nav_head','spb/spb_form',$data);
		}
	}

	public function edit(){
		cek_level();
		if(isset($_POST['submit'])) {
			$id_t_kedatangan	= $this->input->post('id_kedatangan');
			$tanggal_spb 		= $this->input->post('tanggal_spb');
			$receipt_oracle 	= $this->input->post('receipt_oracle');
			$no_polisi 			= $this->input->post('no_polisi');
			$no_jasa 			= $this->input->post('no_jasa');
			$no_reel 			= $this->input->post('no_reel');
			$no_seal 			= $this->input->post('no_seal');
			$kondisi_seal 		= $this->input->post('kondisi_seal');
			$no_container 		= $this->input->post('no_container');
			$jumlah_tidaksesuai = $this->input->post('jumlah_tidaksesuai');
			$alasan_tolak 		= $this->input->post('alasan_tolak');
			$alasan_revisi 		= $this->input->post('alasan_revisi');

			$data = array(
				'tanggal_spb'			=> $tanggal_spb,
				'receipt_oracle'		=> $receipt_oracle,
				'no_polisi'				=> $no_polisi,
				'no_jasa'				=> $no_jasa,
				'no_reel'				=> $no_reel,
				'no_seal'				=> $no_seal,
				'kondisi_seal'			=> $kondisi_seal,
				'no_container'			=> $no_container,
				'jumlah_tidaksesuai'	=> $jumlah_tidaksesuai,
				'alasan_ditolak'		=> $alasan_tolak,
				'alasan_revisi'			=> $alasan_revisi
			);
			$record 	= $this->model_qc->get_for_spb($id_t_kedatangan)->row_array();
			$this->model_crud->update_data('t_spb',$data,'no_running_spb',$record['running_spb']);
			$this->session->set_flashdata('msg_success','Data SPB Berhasil diubah !');

			redirect('released_partial');
		}
		else{
			$id_t_kedatangan	= $this->uri->segment(3);
			$data['record'] 	= $this->model_qc->get_tbl_spb($id_t_kedatangan)->row_array();
			$this->template->load('nav_head','spb/spb_form',$data);
		}
	}

	public function view(){
		$this->load->helper('pdf_helper');
		$id_t_kedatangan 	= $this->uri->segment(3);
		$data['record']		= $this->model_qc->get_for_spb($id_t_kedatangan)->row_array();
		$this->load->view('spb/spb_pdf',$data);
	}

	public function delete(){
		cek_level();
		$id_t_kedatangan = $this->uri->segment(3);
		$this->model_qc->delete_file($id_t_kedatangan);
		$this->model_crud->delete_data($this->table,'id_t_kedatangan',$id_t_kedatangan);
		$this->session->set_flashdata('msg_success','Data kedatangan berhasil dihapus.');
		redirect('released_partial');
	}

}

/* End of file psa.php */
/* Location: ./application/controllers/psa.php */