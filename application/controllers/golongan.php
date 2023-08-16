<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class golongan extends CI_Controller {

	var $folder = 'golongan';
	var $table = 't_golongan';

	public function __construct()
	{
		parent::__construct();
		cek_menu('admin');
	}

	public function index()
	{
		$this->template->load('nav_head',$this->folder.'/admin_view');
	}

	public function add()
	{
		if(isset($_POST['submit'])) {
			$nama_golongan		= $this->input->post('nama_golongan');

			$data		= array('nama_golongan'=>$nama_golongan);

			//CEK NAMA GOLONGAN JIKA ADA YANG SAMA
			$record = $this->db->select('nama_golongan')
								->from($this->table)
								->where('nama_golongan = ',$nama_golongan)
								->get();
			foreach($record->result() as $r) {
				if($r->nama_golongan == $nama_golongan) {
					$this->session->set_flashdata('msg_failed','Nama golongan "'.$nama_golongan.'" sudah dipakai');
					redirect('golongan/add');
				}
			}

			$this->model_crud->create_data($this->table,$data);
			$this->session->set_flashdata('msg_success',' Tambah data golongan dengan nama "'.$nama_golongan.'" berhasil.');
			redirect('golongan');
		}
		else {
			$this->template->load('nav_head',$this->folder.'/admin_form');
		}
	}

	public function edit(){
		if(isset($_POST['submit'])) {
			$id_t_golongan		= $this->input->post('id_t_golongan');
			$nama_golongan_lama	= $this->input->post('nama_golongan_lama');
			$nama_golongan		= $this->input->post('nama_golongan');

			//CEK NAMA GOLONGAN JIKA ADA YANG SAMA
			$record = $this->db->select('nama_golongan')
								->from($this->table)
								->where('nama_golongan != ',$nama_golongan_lama)
								->get();
			foreach($record->result() as $r) {
				if($r->nama_golongan == $nama_golongan) {
					$this->session->set_flashdata('msg_failed','Nama golongan "'.$nama_golongan.'" sudah dipakai');
					redirect('golongan/edit/'.$id_t_golongan);
				}
			}

			$data	= array('nama_golongan'=>$nama_golongan);

			$this->model_crud->update_data($this->table,$data,'id_t_golongan',$id_t_golongan);
			$this->session->set_flashdata('msg_success','Data nama golongan '.$nama_golongan_lama.' berhasil diubah menjadi '.$nama_golongan.'.');
			redirect('golongan');
		}
		else {
			$id_t_golongan	= $this->uri->segment(3);
			$data['record']	= $this->model_crud->get_one($this->table,'id_t_golongan',$id_t_golongan)->row_array();
			$this->template->load('nav_head',$this->folder.'/admin_form',$data);
		}
	}

	public function delete(){
		$id_t_golongan = $this->uri->segment(3);
		$this->model_crud->delete_data($this->table,'id_t_golongan',$id_t_golongan);
		$this->session->set_flashdata('msg_success','Data nama golongan berhasil dihapus.');
		redirect('golongan');
	}

	public function table_nama_golongan()
	{
		$this->datatables->select('id_t_golongan,nama_golongan');
		$this->datatables->add_column('action',anchor('golongan/edit/$1','Edit',array('class'=>'btn btn-warning btn-xs')).'&nbsp'.anchor('golongan/delete/$1','Delete',array('class'=>'btn btn-danger btn-xs',"onclick"=>"return confirm('Anda yakin ingin menghapus?')")),'id_t_golongan');
		$this->datatables->from($this->table);
		return print_r($this->datatables->generate());
	}

}

/* End of file golongan.php */
/* Location: ./application/controllers/golongan.php */