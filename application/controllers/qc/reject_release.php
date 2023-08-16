<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class reject_release extends CI_Controller {

	var $folder = 'reject_release';
	var $table = 't_kedatangan';

	public function __construct(){
		parent::__construct();
		cek_dept('qc');
		$this->load->model('model_qc');
	}

	public function index(){
		$plant = $this->session->userdata('plant');
		switch ($plant) {
			case 'All':
				$data['read'] = $this->model_qc->view_qc('status_qc = "Reject" AND status_all = "Reject"');
			break;
			default:
				$data['read'] = $this->model_qc->view_qc('plant = "'.$plant.'" AND status_qc = "Reject" AND status_all = "Reject"');
			break;
		}
		$this->template->load('nav_head','qc/'.$this->folder.'/qc_reject_release_view',$data);
	}

	public function edit(){
		cek_level();
		if(isset($_POST['submit'])) {
			// Bagian Kepala

			$id_t_kedatangan	= $this->input->post('id_t_kedatangan');
			$plant				= $this->input->post('plant');
			$plant				= strtoupper($plant);
			$no_running 		= $this->input->post('no_running');
			$running 			= substr($no_running, 0,3);

			// Bagian Release

			$id_t_kedatangan		= $this->input->post('id_t_kedatangan');
			$id_analisa_qc_release	= $this->input->post('id_analisa_qc_release');
			$analisa_qc_release 	= $this->input->post('analisa_qc_release');
			$no_running_kedatangan 	= $this->input->post('no_running_kedatangan');

			for($i = 0; $i < count($analisa_qc_release); $i++) {
				$read 	= array('analisa_qc_release'=>$analisa_qc_release[$i]);
				$this->model_crud->update_data('t_analisa_qc_release',$read,'id_analisa_qc_release',$id_analisa_qc_release[$i]);
			}

			if(!is_dir('uploads/file_hak_qc/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/')) {
				mkdir('uploads/file_hak_qc/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/',0777,TRUE);
			}

			$path = 'uploads/file_hak_qc/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/';
			$config['upload_path']		= $path;
			$config['allowed_types']	= '*';
			$config['max_size']			= '1024';
			$config['file_ext_tolower']	= 'true';
			$config['file_name'] 		= strtolower(pathinfo($_FILES['attachement_hak_r']['name'], PATHINFO_FILENAME)).'-'.date('d-m-Y').'-RELEASE';
			$this->upload->initialize($config);

			if(!empty($_FILES['attachement_hak_r']['name'])) {
				if(!$this->upload->do_upload('attachement_hak_r')) {
					$data['error'] 	= $this->upload->display_errors();
					$this->template->load('nav_head','qc/'.$this->folder.'/qc_reject_release_view',$data);
				}
				else {
					$this->model_qc->edit_hak_r_file($id_t_kedatangan);
					$file_name = $this->upload->data('file_name');
					$data['attachement_hak_release'] = $plant.'/'.date("Y").'/'.date('m').'/'.$running.'/'.$file_name;
					$this->model_crud->update_data($this->table,$data,'id_t_kedatangan',$id_t_kedatangan);
				}
			}

			// End of Bagian Release

			// Bagian Monitoring

			$id_analisa_qc_monitoring	= $this->input->post('id_analisa_qc_monitoring');
			$analisa_qc_monitoring 		= $this->input->post('analisa_qc_monitoring');
			$no_running_kedatangan 		= $this->input->post('no_running_kedatangan');

			for($i = 0; $i < count($analisa_qc_monitoring); $i++) {
				$read 	= array('analisa_qc_monitoring'=>$analisa_qc_monitoring[$i]);
				$this->model_crud->update_data('t_analisa_qc_monitoring',$read,'id_analisa_qc_monitoring',$id_analisa_qc_monitoring[$i]);
			}

			$path = 'uploads/file_hak_qc/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/';
			$config['upload_path']		= $path;
			$config['allowed_types']	= '*';
			$config['max_size']			= '1024';
			$config['file_ext_tolower']	= 'true';
			$config['file_name'] 		= strtolower(pathinfo($_FILES['attachement_hak_m']['name'], PATHINFO_FILENAME)).'-'.date('d-m-Y').'-MONITORING';
			$this->upload->initialize($config);

			if(!empty($_FILES['attachement_hak_m']['name'])) {
				if(!$this->upload->do_upload('attachement_hak_m')) {
					$data['error'] 	= $this->upload->display_errors();
					$this->template->load('nav_head','qc/'.$this->folder.'/qc_reject_release_view',$data);
				}
				else {
					$this->model_qc->edit_hak_m_file($id_t_kedatangan);
					$file_name = $this->upload->data('file_name');
					$data['attachement_hak_monitoring'] = $plant.'/'.date("Y").'/'.date('m').'/'.$running.'/'.$file_name;
					$this->model_crud->update_data($this->table,$data,'id_t_kedatangan',$id_t_kedatangan);
				}
			}	

			// End of Bagian Monitoring

			$status_tahanan_rd 	= $this->input->post('status_tahanan_rd');
			$keterangan_qc 		= $this->input->post('keterangan_qc');

			$data = array(
				'status_tahanan_rd' => $status_tahanan_rd,
				'keterangan_qc'		=> $keterangan_qc
			);

			$this->model_crud->update_data($this->table,$data,'id_t_kedatangan',$id_t_kedatangan);
			$this->session->set_flashdata('msg_success','Data informasi kedatangan & status berhasil proses.');
			redirect('reject_release');
		}
		else{
			$id_t_kedatangan	= $this->uri->segment(3);
			$data['record'] = $this->model_qc->view_qc("id_t_kedatangan = '$id_t_kedatangan'")->row_array();
			$this->template->load('nav_head','qc/'.$this->folder.'/qc_reject_release_form',$data);
		}
	}

	public function delete(){
		cek_level();
		$id_t_kedatangan = $this->uri->segment(3);
		$this->model_qc->delete_file($id_t_kedatangan);
		$this->model_crud->delete_data($this->table,'id_t_kedatangan',$id_t_kedatangan);
		$this->session->set_flashdata('msg_success','Data kedatangan berhasil dihapus.');
		redirect('reject_release');
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

			redirect('reject_release');
		}
		else{
			$id_t_kedatangan	= $this->uri->segment(3);
			$data['record'] 	= $this->model_qc->get_tbl_kedatangan($id_t_kedatangan)->row_array();
			$this->template->load('nav_head','spb/spb_form',$data);
		}
	}

	public function edit_spb(){
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

			redirect('reject_release');
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
}

/* End of file reject_release.php */
/* Location: ./application/controllers/qc/reject_release.php */