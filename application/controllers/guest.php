<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class guest extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		redirect('spek');
	}
}

/* End of file guest.php */
/* Location: ./application/controllers/guest.php */