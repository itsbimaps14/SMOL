<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class qc extends CI_Controller {

	var $folder = 'qc';
	var $table = 't_kedatangan';

	public function __construct(){
		parent::__construct();
		cek_dept('qc');
	}

	public function index(){		
		$dept = $this->session->userdata('dept');
		$this->template->load('nav_head','dashboard/qc_main');
	}
}

/* End of file qc.php */
/* Location: ./application/controllers/qc/qc.php */