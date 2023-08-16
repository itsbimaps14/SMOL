<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ok_tahanan_qc extends CI_Controller {

	var $folder = 'ok_tahanan_qc';
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
				$data['read'] = $this->model_qc->view_qc('(status_qc = "OK" OR status_qc = "Released Partial") AND status_all = "Tahanan"');
			break;
			default:
				$data['read'] = $this->model_qc->view_qc('(status_qc = "OK" OR status_qc = "Released Partial") AND plant = "'.$plant.'" AND status_all = "Tahanan"');
			break;
		}
		$this->template->load('nav_head','qc/'.$this->folder.'/qc_ok_tahanan_qc_view',$data);
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
			$config['file_name'] 		= strtolower(pathinfo($_FILES['attachement_hak']['name'], PATHINFO_FILENAME)).'-'.date('d-m-Y').'-MONITORING';
			$this->upload->initialize($config);

			$status_release_qc 	= $this->input->post('status_release_qc');
			$status_tahanan_rd 	= $this->input->post('status_tahanan_rd');
			$keterangan_qc 		= $this->input->post('keterangan_qc');
			$jumlah 			= $this->input->post('jumlah');
			$jumlah_ditahan 	= $this->input->post('jumlah_ditahan');
			$jumlah_diterima 	= $this->input->post('jumlah_diterima');
			$pure_hak			= $this->input->post('pure_hak');

			switch ($status_release_qc) {
				case 'Reject Done':
					$data = array(
						'status_all' => 'Reject',
						'status_tahanan_rd' => $status_tahanan_rd,
						'keterangan_qc' => $keterangan_qc,
						'jumlah_diterima' => '0',
						'jumlah_ditolak' => $jumlah
					);

					email_all_ok($no_running,$status_release_qc);
				break;

				case 'OK Closed':
					$data = array(
						'status_all' => 'OK Closed',
						'keterangan_qc' => $keterangan_qc
					);

					$jumlah_diterima 	= $this->input->post('jumlah_diterima');
					$id_t_db_spek 		= $this->input->post('id_t_db_spek');

					email_all_ok($no_running,$status_release_qc);
				break;

				case 'OK Bersyarat':
					$data = array(
						'status_all' => 'OK Bersyarat',
						'keterangan_qc' => $keterangan_qc
					);

					$jumlah_diterima 	= $this->input->post('jumlah_diterima');
					$id_t_db_spek 		= $this->input->post('id_t_db_spek');

					email_all_ok($no_running,$status_release_qc);
				break;
			}

			if(!empty($_FILES['attachement_hak']['name'])) {
				if(!$this->upload->do_upload('attachement_hak')) {
					$data['error'] 	= $this->upload->display_errors();
					$this->template->load('nav_head','qc/'.$this->folder.'/qc_ok_tahanan_qc_view',$data);
				}
				else {
					$pure_hak	= 'uploads/file_hak_qc/'.$pure_hak;
					unlink($pure_hak);
					$file_name = $this->upload->data('file_name');
					$data['attachement_hak_release'] = $plant.'/'.date("Y").'/'.date('m').'/'.$running.'/'.$file_name;
				}
			}
			
			email_all_ok($no_running);
			$this->model_crud->update_data($this->table,$data,'id_t_kedatangan',$id_t_kedatangan);
			$this->session->set_flashdata('msg_success','Data informasi kedatangan & status berhasil diubah.');
			redirect('ok_tahanan_qc');
		}

		else{
			$id_t_kedatangan	= $this->uri->segment(3);
			$data['record'] = $this->model_qc->view_qc('id_t_kedatangan = "'.$id_t_kedatangan.'"')->row_array();
			$this->template->load('nav_head','qc/'.$this->folder.'/qc_ok_tahanan_qc_form',$data);
		}
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
					$this->template->load('nav_head','qc/'.$this->folder.'/qc_ok_tahanan_qc_form',$data);
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
					$this->template->load('nav_head','qc/'.$this->folder.'/qc_ok_tahanan_qc_form',$data);
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
			redirect('ok_tahanan_qc');
		}
		else{
			$id_t_kedatangan	= $this->uri->segment(3);
			$data['record'] = $this->model_qc->view_qc("id_t_kedatangan = '$id_t_kedatangan'")->row_array();
			$this->template->load('nav_head','qc/'.$this->folder.'/qc_ok_tahanan_qc_edit',$data);
		}
	}

	public function delete(){
		cek_level();
		$id_t_kedatangan = $this->uri->segment(3);
		$this->model_qc->delete_file($id_t_kedatangan);
		$this->model_crud->delete_data($this->table,'id_t_kedatangan',$id_t_kedatangan);
		$this->session->set_flashdata('msg_success','Data kedatangan berhasil dihapus.');
		redirect('ok_tahanan_qc');
	}
}

/* End of file ok_tahanan_qc.php */
/* Location: ./application/controllers/qc/ok_tahanan_qc.php */