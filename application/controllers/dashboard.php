<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	var $folder = 'dashboard';

	public function __construct()
	{
		parent::__construct();
		cek_session();
	}

	public function index()
	{
		$session_dept = $this->session->userdata('dept');

		if($session_dept == 'guest') {
			redirect('guest');
		}
		elseif ($session_dept == 'psa') {
			redirect('psa');
		}
		elseif ($session_dept == 'qc') {
			redirect('qc');
		}
		elseif ($session_dept == 'rd'){
			redirect('rd');
		}
		elseif ($session_dept == 'produksi'){
			redirect('produksi');
		}
		else {
			$this->template->load('nav_head',$this->folder.'/admin_main');
		}
	}

}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */