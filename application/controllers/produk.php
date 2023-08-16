<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	var $folder = "produk";
	var $table = "t_listproduk";

	public function __construct()
	{
		parent::__construct();
		cek_session();
		cek_level();
	}

	public function index(){
		$this->template->load('template_dashboard',$this->folder.'/view');
	}

	public function json()
	{
		$this->datatables->select('id_listproduk,kode_item,nama_produk');
		$this->datatables->add_column('action',anchor('produk/edit/$1','Edit',array('class'=>'btn btn-warning btn-xs')).'&nbsp'.anchor('produk/delete/$1','Delete',array('class'=>'btn btn-danger btn-xs',"onclick"=>"return confirm('Anda yakin ingin menghapus?')")),'id_listproduk');
		$this->datatables->from($this->table);
		return print_r($this->datatables->generate());
	}

	public function add()
	{
		if(isset($_POST['submit'])) {
			$kode_item		= $this->input->post('kode_item');
			$nama_produk	= $this->input->post('nama_produk');

			$data	= array('kode_item'=>$kode_item,
							'nama_produk'=>$nama_produk);

			$this->model_crud->create_data($this->table,$data);
			redirect('produk');
		}
		else {
			$this->template->load('template_dashboard',$this->folder.'/form');
		}
	}

	public function edit()
	{
		if(isset($_POST['submit'])) {
			$id_listproduk	= $this->input->post('id_listproduk');
			$kode_item		= $this->input->post('kode_item');
			$nama_produk	= $this->input->post('nama_produk');

			$data	= array('kode_item'=>$kode_item,
							'nama_produk'=>$nama_produk);

			$this->model_crud->update_data($this->table,$data,'id_listproduk',$id_listproduk);
			$this->session->set_flashdata('msg_edit_success','Data berhasil diupdate');
			redirect('produk');
		}
		else {
			$id_listproduk	= $this->uri->segment(3);
			$data['record']	= $this->model_crud->get_one($this->table,'id_listproduk',$id_listproduk)->row_array();
			$this->template->load('template_dashboard',$this->folder.'/form',$data);
		}
	}

	public function delete()
	{
		$id_listproduk = $this->uri->segment(3);
		$this->model_crud->delete_data($this->table,'id_listproduk',$id_listproduk);
		redirect('produk');
	}

}

/* End of file produk.php */
/* Location: ./application/controllers/produk.php */