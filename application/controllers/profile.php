<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profile extends CI_Controller {

	var $folder = "produk";

	public function __construct(){
		parent::__construct();
		cek_session();
	}

	public function index(){
		$session_nama = $this->session->userdata('nama');
		echo $session_nama;
		die;
	}
}

/* End of file user.php */
/* Location: ./application/controllers/user.php */