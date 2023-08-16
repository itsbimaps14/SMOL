<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class contact extends CI_Controller {

	var $folder = "contact";
	var $table = "t_kontak";

	public function __construct(){
		parent::__construct();
		cek_session();
		cek_level();
	}

	public function index(){
		$this->template->load('nav_head',$this->folder.'/view');
	}

	public function add(){
		if(isset($_POST['submit'])) {
			$nama		= $this->input->post('nama');
			$email		= $this->input->post('email');
			$role		= $this->input->post('role');
			$plant		= $this->input->post('plant');

			$data = array(
				'nama'	=> $nama,
				'email'	=> $email,
				'role'	=> $role,
				'plant'	=> $plant
			);

			$this->session->set_flashdata('msg_username','Tambah contact user berhasil.');
			$this->model_crud->create_data($this->table,$data);
			redirect('contact');
		}
		else{
			$this->template->load('nav_head',$this->folder.'/form');
		}
	}

	public function edit(){
		if(isset($_POST['submit'])) {
			$id_t_kontak	= $this->input->post('id_user');
			$nama			= $this->input->post('nama');
			$email			= $this->input->post('email');
			$role			= $this->input->post('role');
			$plant			= $this->input->post('plant');

			$data = array(
				'nama'	=> $nama,
				'email'	=> $email,
				'role'	=> $role,
				'plant'	=> $plant
			);

			$this->model_crud->update_data($this->table,$data,'id_t_kontak',$id_t_kontak);
			$this->session->set_flashdata('msg_username','Data contact user berhasil diubah.');
			redirect('contact');
		}
		else{
			$id_t_kontak	= $this->uri->segment(3);
			$data['record']	= $this->model_crud->get_one($this->table,'id_t_kontak',$id_t_kontak)->row_array();
			$this->template->load('nav_head',$this->folder.'/form',$data);
		}
	}

	public function delete(){
		$id_t_kontak = $this->uri->segment(3);
		$this->model_crud->delete_data($this->table,'id_t_kontak',$id_t_kontak);
		redirect('contact');
	}

	public function json(){
		$this->datatables->select('id_t_kontak,nama,email,plant,role');
		$this->datatables->add_column('action',
			anchor('contact/edit/$1','Edit',array('class'=>'btn btn-warning btn-xs'))
			.'&nbsp'.
			anchor('contact/delete/$1','Delete',array('class'=>'btn btn-danger btn-xs',"onclick"=>"return confirm('Anda yakin ingin menghapus ?')"))
			,'id_t_kontak');
		$this->datatables->from($this->table);
		return print_r($this->datatables->generate());
	}
}

/* End of file contact.php */
/* Location: ./application/controllers/contact.php */