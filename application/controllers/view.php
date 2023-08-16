<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class view extends CI_Controller {

	var $folder = 'view';
	var $table = 't_kedatangan';

	public function __construct(){
		parent::__construct();
		$this->load->model('model_qc');
	}

	public function view(){
		$id_t_kedatangan = $this->uri->segment(3);
		$data['record'] = $this->model_qc->view_qc("id_t_kedatangan = '$id_t_kedatangan'")->row_array();
		$this->template->load('nav_head',$this->folder.'/view',$data);
	}

}

/* End of file view.php */
/* Location: ./application/controllers/view.php */