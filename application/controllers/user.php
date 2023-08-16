<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	var $folder = "user";
	var $table = "t_user";

	public function __construct()
	{
		parent::__construct();
		cek_session();
		cek_level();
	}

	public function index()
	{
		$this->template->load('nav_head',$this->folder.'/view');
	}

	public function json()
	{
		$this->datatables->select('id_user,username,nama,level,dept');
		$this->datatables->add_column('action',
			anchor('user/edit/$1','Edit',array('class'=>'btn btn-warning btn-xs'))
			.'&nbsp'.
			anchor('user/reset/$1','Reset Password',array('class'=>'btn btn-warning btn-xs',"onclick"=>"return confirm('Reset Password ?, This will set your password same as username.')"))
			.'&nbsp'.
			anchor('user/delete/$1','Delete',array('class'=>'btn btn-danger btn-xs',"onclick"=>"return confirm('Anda yakin ingin menghapus ?')"))
			,'id_user');
		$this->datatables->from($this->table);
		return print_r($this->datatables->generate());
	}

	public function add()
	{
		if(isset($_POST['submit'])) {
			$username	= $this->input->post('username');
			$nama		= $this->input->post('nama');
			$email		= $this->input->post('email');
			$password	= $this->input->post('password');
			$str		= $this->input->post('level');

			$tmp1 	= substr($str, 0,3);
			if ($tmp1 == 'adm') {
				$level = 'admin';
			}
			elseif ($tmp1 == 'usr') {
				$level = 'user';
			}

			$tmp2	= substr($str, 4,3);
			if ($tmp2 == 'psa') {
				$dept = 'psa';
			}
			elseif ($tmp2 == 'quc') {
				$dept = 'qc';
			}
			elseif ($tmp2 == 'pro') {
				$dept = 'produksi';
			}
			elseif ($tmp2 == 'rdt') {
				$dept = 'rd';
			}
			else{
				$dept = 'admin';
			}

			$tmp3	= substr($str, 8,3);
			if ($tmp3 == 'cia') {
				$plant = 'Ciawi';
			}
			elseif ($tmp3 == 'cib') {
				$plant = 'Cibitung';
			}
			elseif ($tmp3 == 'sen') {
				$plant = 'Sentul';
			}
			else{
				$plant = 'All';
			}

			$data		= array('username'=>str_replace(' ','',$username),
								'password'=>password_hash($password,PASSWORD_BCRYPT),
								'nama'=>$nama,
								'level'=>$level,
								'dept'=>$dept,
								'email'=>$email,
								'plant'=>$plant
							);

			//CEK USERNAME JIKA ADA YANG SAMA
			$record = $this->db->select('*')
								->from($this->table)
								->where('username =',$username)
								->get();
			foreach($record->result() as $r) {
				if($r->username == $username) {
					$this->session->set_flashdata('msg_username','Username sudah dipakai');
					redirect('user/add');
				}
			}

			$this->session->set_flashdata('msg_username','Tambah user berhasil');
			$this->model_crud->create_data($this->table,$data);
			redirect('user');
		}
		else {
			$this->template->load('nav_head',$this->folder.'/form');
		}
	}

	public function edit()
	{
		if(isset($_POST['submit'])) {
			$id_user		= $this->input->post('id_user');
			$username_lama	= $this->input->post('username_lama');
			$username		= $this->input->post('username');
			$nama			= $this->input->post('nama');
			$email			= $this->input->post('email');
			$str			= $this->input->post('level');

			$tmp1 	= substr($str, 0,3);
			if ($tmp1 == 'adm') {
				$level = 'admin';
			}
			elseif ($tmp1 == 'usr') {
				$level = 'user';
			}

			$tmp2	= substr($str, 4,3);
			if ($tmp2 == 'psa') {
				$dept = 'psa';
			}
			elseif ($tmp2 == 'quc') {
				$dept = 'qc';
			}
			elseif ($tmp2 == 'pro') {
				$dept = 'produksi';
			}
			elseif ($tmp2 == 'rdt') {
				$dept = 'rd';
			}
			else{
				$dept = 'admin';
			}

			$tmp3	= substr($str, 8,3);
			if ($tmp3 == 'cia') {
				$plant = 'Ciawi';
			}
			elseif ($tmp3 == 'cib') {
				$plant = 'Cibitung';
			}
			elseif ($tmp3 == 'sen') {
				$plant = 'Sentul';
			}
			else{
				$plant = 'All';
			}

			//CEK USERNAME JIKA ADA YANG SAMA
			$record = $this->db->select('*')
								->from($this->table)
								->where('username !=',$username_lama)
								->get();
			foreach($record->result() as $r) {
				if($r->username == $username) {
					$this->session->set_flashdata('msg_username','Username sudah dipakai');
					redirect('user/edit/'.$id_user);
				}
			}

			$data 	= array('username'=>str_replace(' ','',$username),
							'nama'=>$nama,
							'email'=>$email,
							'level'=>$level,
							'dept'=>$dept,
							'plant'=>$plant
						);

			$this->model_crud->update_data($this->table,$data,'id_user',$id_user);
			$this->session->set_flashdata('msg_edit_success','Data berhasil diupdate');
			redirect('user');
		}

		else {
			$id_user		= $this->uri->segment(3);
			$data['record']	= $this->model_crud->get_one($this->table,'id_user',$id_user)->row_array();
			$this->template->load('nav_head',$this->folder.'/form',$data);
		}
	}

	public function reset(){
		$id_user 	= $this->uri->segment(3);
		$data		= $this->model_crud->get_one($this->table,'id_user',$id_user)->row_array();
		$password 	= $data['username'];
		$password	= array('password'=>password_hash($password,PASSWORD_BCRYPT));

		$this->model_crud->update_data($this->table,$password,'id_user',$id_user);

		reset_password($data['email'],$data['nama'],$data['username']);
	}

	public function delete(){
		$id_user = $this->uri->segment(3);
		$this->model_crud->delete_data($this->table,'id_user',$id_user);
		redirect('user');
	}

}

/* End of file user.php */
/* Location: ./application/controllers/user.php */