<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tahanan_qc extends CI_Controller {

	var $folder = 'tahanan_qc';
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
				$data['read'] = $this->model_qc->view_qc('status_qc = "Tahanan" AND status_all = "Tahanan"');
			break;
			default:
				$data['read'] = $this->model_qc->view_qc('plant = "'.$plant.'" AND status_qc = "Tahanan" AND status_all = "Tahanan"');
			break;
		}
		$this->template->load('nav_head','qc/'.$this->folder.'/qc_tahanan_qc_view',$data);
	}

	public function proses(){
		if(isset($_POST['submit'])) {
			$id_t_kedatangan	= $this->input->post('id_t_kedatangan');
			$plant				= $this->input->post('plant');
			$plant				= strtoupper($plant);
			$no_running 		= $this->input->post('no_running');
			$running 			= substr($no_running, 0,3);
			
			if(!is_dir('uploads/file_hak_qc/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/')) {
				mkdir('uploads/file_hak_qc/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/',0777,TRUE);
			}

			$path = 'uploads/file_hak_qc/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/';
			$config['upload_path']		= $path;
			$config['allowed_types']	= '*';
			$config['max_size']			= '1024';
			$config['file_ext_tolower']	= 'true';
			$config['file_name'] 		= strtolower(pathinfo($_FILES['attachement_hak']['name'], PATHINFO_FILENAME)).'-'.date('d-m-Y').'-RELEASE';
			$this->upload->initialize($config);

			$status_release_qc 	= $this->input->post('status_release_qc');
			$status_tahanan_rd 	= $this->input->post('status_tahanan_rd');
			$keterangan_qc 		= $this->input->post('keterangan_qc');
			$jumlah 			= $this->input->post('jumlah');
			$jumlah_ditahan 	= $this->input->post('jumlah_ditahan');
			$jumlah_diterima 	= $this->input->post('jumlah_diterima');
			$pure_hak			= $this->input->post('pure_hak');
			$id_t_db_spek 		= $this->input->post('id_t_db_spek');

			switch ($status_release_qc) {
				case 'Reject':
					$data = array(
						'status_qc' => 'Reject',
						'status_all' => 'Reject',
						'status_tahanan_rd' => $status_tahanan_rd,
						'keterangan_qc' => $keterangan_qc,
						'jumlah_diterima' => '0',
						'jumlah_ditolak' => $jumlah
					);

					email_release_ok($no_running,$status_release_qc);
				break;

				case 'OK':
					$data = array(
						'status_qc' => 'OK',
						'status_all' => 'OK Pending Monitoring',
						'status_tahanan_rd' => $status_tahanan_rd,
						'keterangan_qc' => $keterangan_qc,
						'jumlah_diterima' => $jumlah,
						'jumlah_ditolak' => '0'
					);
					count_stock($id_t_db_spek,$id_t_kedatangan,$jumlah_diterima,$plant);
					email_release_ok($no_running,$status_release_qc);
				break;

				case 'Released Partial':
					$data = array(
						'status_qc' => 'Released Partial',
						'status_all' => 'OK Pending Monitoring',
						'status_tahanan_rd' => $status_tahanan_rd,
						'keterangan_qc' => $keterangan_qc,
						'jumlah_diterima' => $jumlah_diterima,
						'jumlah_ditolak' => $jumlah_ditahan
					);
					count_stock($id_t_db_spek,$id_t_kedatangan,$jumlah_diterima,$plant);
					email_release_ok($no_running,$status_release_qc);
				break;
			}

			if(!empty($_FILES['attachement_hak']['name'])) {
				if(!$this->upload->do_upload('attachement_hak')) {
					$data['error'] 	= $this->upload->display_errors();
					$this->template->load('nav_head','qc/'.$this->folder.'/qc_tahanan_qc_view',$data);
				}
				else {
					$pure_hak	= 'uploads/file_hak_qc/'.$pure_hak;
					unlink($pure_hak);
					$file_name = $this->upload->data('file_name');
					$data['attachement_hak_release'] = $plant.'/'.date("Y").'/'.date('m').'/'.$running.'/'.$file_name;
				}
			}
	
			$this->model_crud->update_data($this->table,$data,'id_t_kedatangan',$id_t_kedatangan);
			$this->session->set_flashdata('msg_success','Data informasi kedatangan & status berhasil diubah.');
			redirect('tahanan_qc');
		}

		else{
			$id_t_kedatangan	= $this->uri->segment(3);
			$data['record'] = $this->model_qc->view_qc('id_t_kedatangan = "'.$id_t_kedatangan.'"')->row_array();
			$this->template->load('nav_head','qc/'.$this->folder.'/qc_tahanan_qc_form',$data);
		}
	}

	public function edit(){
		cek_level();
		if(isset($_POST['submit'])) {
			// D.1. Input ke Analisa //
			$id_t_kedatangan		= $this->input->post('id_t_kedatangan');
			$id_analisa_qc_release	= $this->input->post('id_analisa_qc_release');
			$analisa_qc 			= $this->input->post('analisa_qc');
			$no_running_kedatangan 	= $this->input->post('no_running_kedatangan');
			$id_t_parameter_release = $this->input->post('id_t_parameter_release');
			for($i = 0; $i < count($analisa_qc); $i++) {
				$data 	= array('analisa_qc_release'=>$analisa_qc[$i]);
				$this->model_crud->update_data('t_analisa_qc_release',$data,'id_analisa_qc_release',$id_analisa_qc_release[$i]);
			}
			// End of Part D.1. Input ke Analisa //
			$id_t_kedatangan	= $this->input->post('id_t_kedatangan');
			$plant				= $this->input->post('plant');
			$plant				= strtoupper($plant);
			$no_running 		= $this->input->post('no_running');
			$running 			= substr($no_running, 0,3);
			if(!is_dir('uploads/file_hak_qc/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/')) {
				mkdir('uploads/file_hak_qc/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/',0777,TRUE);
			}
			$path = 'uploads/file_hak_qc/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/';
			$config['upload_path']		= $path;
			$config['allowed_types']	= '*';
			$config['max_size']			= '1024';
			$config['file_ext_tolower']	= 'true';
			$config['file_name'] 		= strtolower(pathinfo($_FILES['attachement_hak']['name'], PATHINFO_FILENAME)).'-'.date('d-m-Y');
			$this->upload->initialize($config);
			$status_tahanan_rd 	= $this->input->post('status_tahanan_rd');
			$keterangan_qc 		= $this->input->post('keterangan_qc');
			$pure_hak			= $this->input->post('pure_hak');
			$data = array(
				'status_tahanan_rd' => $status_tahanan_rd,
				'keterangan_qc'		=> $keterangan_qc
			);
			if(!empty($_FILES['attachement_hak']['name'])) {
				if(!$this->upload->do_upload('attachement_hak')) {
					$data['error'] 	= $this->upload->display_errors();
					$this->template->load('nav_head','qc/'.$this->folder.'/qc_tahanan_qc_view',$data);
				}
				else {
					$pure_hak	= 'uploads/file_hak_qc/'.$pure_hak;
					unlink($pure_hak);
					$file_name = $this->upload->data('file_name');
					$data['attachement_hak_release'] = $plant.'/'.date("Y").'/'.date('m').'/'.$running.'/'.$file_name;
				}
			}
			$this->model_crud->update_data($this->table,$data,'id_t_kedatangan',$id_t_kedatangan);
			$this->session->set_flashdata('msg_success','Data informasi kedatangan & status berhasil proses.');
			redirect('tahanan_qc');
		}
		else{
			$id_t_kedatangan	= $this->uri->segment(3);
			$data['record'] = $this->model_qc->view_qc('id_t_kedatangan = "'.$id_t_kedatangan.'"')->row_array();
			$this->template->load('nav_head','qc/'.$this->folder.'/qc_tahanan_qc_form',$data);
		}
	}

	public function delete(){
		cek_level();
		$id_t_kedatangan = $this->uri->segment(3);
		$this->model_qc->delete_file($id_t_kedatangan);
		$this->model_crud->delete_data($this->table,'id_t_kedatangan',$id_t_kedatangan);
		$this->session->set_flashdata('msg_success','Data kedatangan berhasil dihapus.');
		redirect('tahanan_qc');
	}
}

/* End of file tahanan_qc.php */
/* Location: ./application/controllers/qc/tahanan_qc.php */