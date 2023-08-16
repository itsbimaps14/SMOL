<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ok_pending extends CI_Controller {

	var $folder = 'ok_pending';
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
				$data['read'] = $this->model_qc->view_qc('status_all = "OK Pending Monitoring"');
			break;
			default:
				$data['read'] = $this->model_qc->view_qc('plant = "'.$plant.'" AND status_all = "OK Pending Monitoring"');
			break;
		}
		$this->template->load('nav_head','qc/'.$this->folder.'/qc_ok_pending_view',$data);
	}

	public function proses(){
		if(isset($_POST['save'])) {
			$id_t_kedatangan			= $this->input->post('id_t_kedatangan');
			$id_analisa_qc_monitoring	= $this->input->post('id_analisa_qc_monitoring');
			$analisa_qc 				= $this->input->post('analisa_qc');
			$no_running_kedatangan 		= $this->input->post('no_running_kedatangan');

			for($i = 0; $i < count($analisa_qc); $i++) {
				$data 	= array('analisa_qc_monitoring'=>$analisa_qc[$i]);
				$this->model_crud->update_data('t_analisa_qc_monitoring',$data,'id_analisa_qc_monitoring',$id_analisa_qc_monitoring[$i]);
			}

			$this->session->set_flashdata('msg_success','Data pada tabel Analisa QC release Berhasil disimpan.');
			redirect('ok_pending');
		}

		elseif (isset($_POST['submit'])) {
			// D.1. Input ke Analisa //

			$id_t_kedatangan			= $this->input->post('id_t_kedatangan');
			$id_analisa_qc_monitoring	= $this->input->post('id_analisa_qc_monitoring');
			$analisa_qc 				= $this->input->post('analisa_qc');
			$no_running_kedatangan 		= $this->input->post('no_running_kedatangan');

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
			$config['file_name'] 		= strtolower(pathinfo($_FILES['attachement_hak']['name'], PATHINFO_FILENAME)).'-'.date('d-m-Y').'-MONITORING';
			$this->upload->initialize($config);

			$pure_hak				= $this->input->post('pure_hak');
			$status_release_qc		= $this->input->post('status_release_qc');
			$keterangan_qc			= $this->input->post('keterangan_qc');
			$running_tahanan_lama	= $this->input->post('running_tahanan_lama');

			// Untuk Parameter Stok
			$jumlah_diterima 	= $this->input->post('jumlah_diterima');
			$id_t_db_spek 		= $this->input->post('id_t_db_spek');

			if(!$this->upload->do_upload('attachement_hak')) {
				$data['error'] 	= $this->upload->display_errors();
				$this->template->load('nav_head','qc/'.$this->folder.'/qc_ok_pending_view',$data);
			}

			else {
				switch ($status_release_qc) {
					case 'OK Closed':
						$data = array(
							'status_all' => 'OK Closed',
							'keterangan_qc' => $keterangan_qc
						);
						
					break;

					case 'OK Bersyarat':
						$data = array(
							'status_all' => 'OK Bersyarat',
							'keterangan_qc' => $keterangan_qc
						);
						
					break;

					case 'Tahanan':
						$running_tahanan 	= $this->input->post('running_tahanan');
						$alasan_tahanan 	= $this->input->post('alasan_tahanan');
						$spek_tahanan		= $this->input->post('spek_tahanan');
					
						$data = array(
							'status_all' 					=> 'Tahanan RD',
							'keterangan_qc' 				=> $keterangan_qc,
							'running_tahanan'	 			=> $running_tahanan,
							'running_tahanan_lama'			=> $running_tahanan_lama
						);

						$tahanan = array(
							'tahanan_kedatangan'	=> $no_running,
							'no_running_tahanan' 	=> $running_tahanan,
							'alasan_tahanan'		=> $alasan_tahanan,
							'spek_tahanan'			=> $spek_tahanan,
							'plant_tahanan'			=> $plant
						);
					break;

					case 'Reject':
						$data = array(
							'status_all' => 'Reject',
							'status_tahanan_rd' => $status_tahanan_rd,
							'keterangan_qc' => $keterangan_qc,
							'jumlah_diterima' => '0',
							'jumlah_ditolak' => $jumlah
						);
					break;
				}

				if(!empty($_FILES['attachement_hak']['name'])) {
					$file_name = $this->upload->data('file_name');
					$data['attachement_hak_monitoring'] = $plant.'/'.date("Y").'/'.date('m').'/'.$running.'/'.$file_name;
				}

				// Transac DB
				$this->db->trans_start();
				if ($status_release_qc == 'OK Closed' OR $status_release_qc == 'OK Bersyarat') {
					email_all_ok($no_running,$status_release_qc);
				}
				elseif ($status_release_qc == 'Tahanan') {
					$this->model_crud->create_data('t_tahanan',$tahanan);
					email_tahanan_qc($no_running,$running_tahanan,$alasan_tahanan);
				}
				else{
					email_all_ok($no_running,$status_release_qc);
				}
				for($i = 0; $i < count($analisa_qc); $i++) {
					$monitor 	= array('analisa_qc_monitoring'=>$analisa_qc[$i]);
					$this->model_crud->update_data('t_analisa_qc_monitoring',$monitor,'id_analisa_qc_monitoring',$id_analisa_qc_monitoring[$i]);
				}	
				$this->model_crud->update_data($this->table,$data,'id_t_kedatangan',$id_t_kedatangan);
				$this->db->trans_complete();
				if ($this->db->trans_status() === FALSE){
					echo 'Error input data !';
					die;
				}
				else{
					$this->session->set_flashdata('msg_success','Data informasi kedatangan & status berhasil proses.');
					redirect('ok_pending');
				}
				// End of Transac DB
			}
		}
		else{
			$id_t_kedatangan	= $this->uri->segment(3);
			$data['record'] 	= $this->model_qc->view_qc('id_t_kedatangan = "'.$id_t_kedatangan.'"')->row_array();
			$this->template->load('nav_head','qc/'.$this->folder.'/qc_ok_pending_form',$data);
		}
	}

	public function edit(){
		if(isset($_POST['submit'])) {
			// D.1. Input ke Analisa //

			$id_t_kedatangan		= $this->input->post('id_t_kedatangan');
			$id_analisa_qc_release	= $this->input->post('id_analisa_qc_release');
			$analisa_qc_release 	= $this->input->post('analisa_qc_release');
			$no_running_kedatangan 	= $this->input->post('no_running_kedatangan');

			for($i = 0; $i < count($analisa_qc_release); $i++) {
				$data 	= array('analisa_qc_release'=>$analisa_qc_release[$i]);
				$this->model_crud->update_data('t_analisa_qc_release',$data,'id_analisa_qc_release',$id_analisa_qc_release[$i]);
			}

			// End of Part D.1. Input ke Analisa //

			// D.1. Input ke Analisa //

			$id_analisa_qc_monitoring	= $this->input->post('id_analisa_qc_monitoring');
			$analisa_qc_monitoring 		= $this->input->post('analisa_qc_monitoring');
			$no_running_kedatangan 		= $this->input->post('no_running_kedatangan');

			for($i = 0; $i < count($analisa_qc_monitoring); $i++) {
				$data 	= array('analisa_qc_monitoring'=>$analisa_qc_monitoring[$i]);
				$this->model_crud->update_data('t_analisa_qc_monitoring',$data,'id_analisa_qc_monitoring',$id_analisa_qc_monitoring[$i]);
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
			$config['file_name'] 		= strtolower(pathinfo($_FILES['attachement_hak']['name'], PATHINFO_FILENAME)).'-'.date('d-m-Y').'-RELEASE';
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
					$this->template->load('nav_head','qc/'.$this->folder.'/qc_ok_pending_view',$data);
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
			redirect('ok_pending');
		}
		else{
			$id_t_kedatangan	= $this->uri->segment(3);
			$data['record'] = $this->model_qc->view_qc("id_t_kedatangan = '$id_t_kedatangan'")->row_array();
			$this->template->load('nav_head','qc/'.$this->folder.'/qc_ok_pending_edit',$data);
		}
	}

	public function delete(){
		cek_level();
		$id_t_kedatangan = $this->uri->segment(3);
		$this->model_qc->delete_file($id_t_kedatangan);
		$this->model_crud->delete_data($this->table,'id_t_kedatangan',$id_t_kedatangan);
		$this->session->set_flashdata('msg_success','Data kedatangan berhasil dihapus.');
		redirect('ok_pending');
	}
}

/* End of file ok_pending.php */
/* Location: ./application/controllers/qc/ok_pending.php */