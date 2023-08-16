<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

	var $folder = "home";
	var $table;

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->template->load('template_dashboard',$this->folder.'/view');
	}

	public function t_sssmb_index()
	{
		$this->template->load('template_dashboard',$this->folder.'/sssmb');
	}

	public function t_sssmb_json()
	{
		$this->table='t_coba1';
		$this->datatables->select('id,upp,nama_bahan,tgl,link');
		$this->datatables->from($this->table);
		return print_r($this->datatables->generate());
	}

	public function t_isosm_index()
	{
		$this->template->load('template_dashboard',$this->folder.'/isosm');
	}

	public function t_isosm_json()
	{
		$this->table='t_coba2';
		$this->datatables->select('id,nama,kelas,rumah,kota');
		$this->datatables->from($this->table);
		return print_r($this->datatables->generate());
	}

	public function home(){
		$this->template->load('template_home',$this->folder.'/home');
	}

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */