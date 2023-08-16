<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	var $t_user = "t_user";

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_auth');
	}

	public function login()
	{
		if(isset($_POST['submit'])) {
			$username	= $this->input->post('username');
			$password	= $this->input->post('password');
			$pw 		= $this->model_crud->get_one($this->t_user,'username',$username)->row_array();

			//ENKRIPSI PASSWORD PHP FUNGSI
			if(password_verify($password,$pw['password'])) {
				$data 	= array('username'=>$username);
				$hasil	= $this->model_auth->login($this->t_user,$data);
			}

			if($hasil['status_login'] == 1) {
				//SET SESSION DATA
				$this->session->set_userdata($hasil);

				$this->session->set_flashdata('msg_login','LOGIN BERHASIL');
				redirect('dashboard');
			}
			else {
				$this->session->set_flashdata('msg_login','LOGIN GAGAL');
				redirect('auth/login');
			}
		}
		else {
			cek_session_login();
			$this->load->view('form_login');
		}
	}

	public function guest(){
		if(isset($_POST['submit'])) {
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$plant = $this->input->post('plant');

			$hasil = array(
					'id_user'=>'0',
					'username'=>'guest',
					'nama'=>$nama,
					'level'=>'guest',
					'email'=>$email,
					'plant'=>$plant,
					'dept'=>'guest',
					'status_login'=>'1'
				);

			$this->session->set_userdata($hasil);
			$this->session->set_flashdata('msg_login','LOGIN BERHASIL');
			redirect('dashboard');
		}
		else{
			cek_session_login();
			$this->load->view('form_login');
		}
	}

	public function logout()
	{
		//$items = array('id_user','username','nama','level','status_login');
		//$this->session->unset_userdata($items);
		$this->session->sess_destroy();
		redirect('auth/login');
	}

	public function landing(){
		if ($this->session->userdata('status_login') == '1') {
			redirect('dashboard');
		}
		else {
			$this->load->view('landing_page');
		}
	}

	public function daftar(){
		if (isset($_POST['submit'])) {
			$username	= $this->input->post('username');
			$password	= $this->input->post('password');
			$plant		= $this->input->post('plant');
			$dept		= $this->input->post('dept');

			$data = array(
				'username'	=> $username,
				'password'	=> $password,
				'plant'		=> $plant,
				'dept'		=> $dept);

			//CEK USERNAME JIKA ADA YANG SAMA
			$record = $this->db->select('*')
								->from('t_user')
								->where('username =',$username)
								->get();
			foreach($record->result() as $r) {
				if($r->username == $username) {
					$this->session->set_flashdata('msg_login','USERNAME TELAH DIGUNAKAN');
					redirect('auth/daftar');
				}
			}

			email_daftar($data);
			$this->session->set_flashdata('msg_login','Daftar Berhasil - Tunggu Verifikasi Admin');
			redirect('auth/login');
		}
		else{
			cek_session_login();
			$this->load->view('form_login');
		}
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */