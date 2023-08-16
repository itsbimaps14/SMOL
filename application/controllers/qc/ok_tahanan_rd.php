<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ok_tahanan_rd extends CI_Controller {

	var $folder = 'ok_tahanan_rd';
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
				$data['read'] = $this->model_qc->view_qc('(status_qc = "OK" OR status_qc = "Released Partial") AND status_all = "Tahanan RD"');
			break;
			default:
				$data['read'] = $this->model_qc->view_qc('(status_qc = "OK" OR status_qc = "Released Partial") AND plant = "'.$plant.'" AND status_all = "Tahanan RD"');
			break;
		}
		$this->template->load('nav_head','qc/'.$this->folder.'/qc_ok_tahanan_rd_view',$data);
	}

	public function delete(){
		cek_level();
		$id_t_kedatangan = $this->uri->segment(3);
		$this->model_qc->delete_file($id_t_kedatangan);
		$this->model_crud->delete_data($this->table,'id_t_kedatangan',$id_t_kedatangan);
		$this->session->set_flashdata('msg_success','Data kedatangan berhasil dihapus.');
		redirect('ok_tahanan_rd');
	}
}

/* End of file ok_tahanan_rd.php */
/* Location: ./application/controllers/qc/ok_tahanan_rd.php */