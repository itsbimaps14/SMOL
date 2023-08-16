<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class belum_analisa extends CI_Controller {

	var $folder = 'belum_analisa';
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
				$data['read'] = $this->model_qc->view_qc('status_all = "Belum Analisa QC"');
			break;
			default:
				$data['read'] = $this->model_qc->view_qc('plant = "'.$plant.'" AND status_all = "Belum Analisa QC"');
			break;
		}
		$this->template->load('nav_head','qc/'.$this->folder.'/qc_belum_analisa_view',$data);
	}

	public function proses(){
		if(isset($_POST['save'])) {
			$id_t_kedatangan		= $this->input->post('id_t_kedatangan');
			$id_analisa_qc_release	= $this->input->post('id_analisa_qc_release');
			$analisa_qc 			= $this->input->post('analisa_qc');
			$no_running_kedatangan 	= $this->input->post('no_running_kedatangan');
			$id_t_parameter_release = $this->input->post('id_t_parameter_release');
			for($i = 0; $i < count($analisa_qc); $i++) {
				$data 	= array('analisa_qc_release'=>$analisa_qc[$i]);
				$this->model_crud->update_data('t_analisa_qc_release',$data,'id_analisa_qc_release',$id_analisa_qc_release[$i]);
			}
			$data = array(
				'status_qc' => 'Analisa QC',
				'status_all' => 'Analisa QC'
			);
			$this->model_crud->update_data($this->table,$data,'id_t_kedatangan',$id_t_kedatangan);
			$this->session->set_flashdata('msg_success','Data pada tabel Analisa QC release Berhasil disimpan.');
			redirect('belum_analisa');
		}

		elseif (isset($_POST['submit'])) {
			// C.1. Input ke Analisa //
			$id_t_kedatangan		= $this->input->post('id_t_kedatangan');
			$id_analisa_qc_release	= $this->input->post('id_analisa_qc_release');
			$analisa_qc 			= $this->input->post('analisa_qc');
			$no_running_kedatangan 	= $this->input->post('no_running_kedatangan');
			$id_t_parameter_release = $this->input->post('id_t_parameter_release');
			for($i = 0; $i < count($analisa_qc); $i++) {
				$data 	= array('analisa_qc_release'=>$analisa_qc[$i]);
				$this->model_crud->update_data('t_analisa_qc_release',$data,'id_analisa_qc_release',$id_analisa_qc_release[$i]);
			}

			// End of Part C.1. Input ke Analisa //
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
			$jumlah 		 	= $this->input->post('jumlah');
			$jumlah_ditahan 	= $this->input->post('jumlah_ditahan');
			$jumlah_diterima 	= $this->input->post('jumlah_diterima');
			$id_t_db_spek 		= $this->input->post('id_t_db_spek');
			if(!$this->upload->do_upload('attachement_hak')) {
				$data['error'] 	= $this->upload->display_errors();
				$this->template->load('nav_head','qc/'.$this->folder.'/qc_belum_analisa_view',$data);
			}
			else {
				switch ($status_release_qc) {
					case 'Tahanan':
						$running_tahanan 	= $this->input->post('running_tahanan');
						$alasan_tahanan 	= $this->input->post('alasan_tahanan');
						$spek_tahanan		= $this->input->post('spek_tahanan');
						$data = array(
							'status_qc' => 'Tahanan',
							'status_all' => 'Tahanan RD',
							'status_tahanan_rd' => $status_tahanan_rd,
							'keterangan_qc' => $keterangan_qc,
							'running_tahanan' => $running_tahanan);
						$tahanan = array(
							'tahanan_kedatangan'	=> $no_running,
							'no_running_tahanan' 	=> $running_tahanan,
							'alasan_tahanan'		=> $alasan_tahanan,
							'spek_tahanan'			=> $spek_tahanan,
							'plant_tahanan'			=> $plant);
						$this->model_crud->create_data('t_tahanan',$tahanan);
						email_tahanan_qc($no_running,$running_tahanan,$alasan_tahanan);
					break;
					
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
					$file_name = $this->upload->data('file_name');
					$data['attachement_hak_release'] = $plant.'/'.date("Y").'/'.date('m').'/'.$running.'/'.$file_name;
				}
				$this->model_crud->update_data($this->table,$data,'id_t_kedatangan',$id_t_kedatangan);
				$this->session->set_flashdata('msg_success','Data informasi kedatangan & status berhasil proses.');
				redirect('belum_analisa');
			}
		}
		else{
			$id_t_kedatangan	= $this->uri->segment(3);
			$data['record'] = $this->model_qc->view_qc('id_t_kedatangan = "'.$id_t_kedatangan.'"')->row_array();
			$this->template->load('nav_head','qc/'.$this->folder.'/qc_belum_analisa_form',$data);
		}
	}

	public function delete(){
		cek_level();
		$id_t_kedatangan = $this->uri->segment(3);
		$this->model_qc->delete_file($id_t_kedatangan);
		$this->model_crud->delete_data($this->table,'id_t_kedatangan',$id_t_kedatangan);
		$this->session->set_flashdata('msg_success','Data kedatangan berhasil dihapus.');
		redirect('belum_analisa');
	}
}

/* End of file belum_analisa.php */
/* Location: ./application/controllers/qc/belum_analisa.php */