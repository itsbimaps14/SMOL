<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kat_spek extends CI_Controller {

	var $folder = 'kat_spek';
	var $table = 't_kategori_spek';

	public function __construct()
	{
		parent::__construct();
		cek_menu('admin');
	}

	public function index()
	{
		$this->template->load('nav_head',$this->folder.'/admin_view');
	}

	public function add(){
		if(isset($_POST['submit'])) {
			$kategori_spek 	= $this->input->post('kategori_spek');
			$data			= array('kat_spek'=>$kategori_spek);

			//CEK KATEGORI SPEK JIKA ADA YANG SAMA
			$record = $this->db->select('kat_spek')
								->from($this->table)
								->where('kat_spek = ',$kategori_spek)
								->get();
			foreach($record->result() as $r) {
				if($r->kat_spek == $kategori_spek) {
					$this->session->set_flashdata('msg_failed','Kategori spek dengan nama : "'.$kategori_spek.'" sudah dipakai');
					redirect('golongan/add');
				}
			}

			$this->session->set_flashdata('msg_success',' Tambah data golongan dengan nama "'.$nama_golongan.'" berhasil.');
			$this->model_crud->create_data($this->table,$data);
			redirect('kat_spek');
		}
		else {
			$this->template->load('nav_head',$this->folder.'/admin_form');
		}
	}

	public function edit(){
		if(isset($_POST['submit'])){
			$id_t_katspek	= $this->input->post('id_t_katspek');
			$kategori_spek 	= $this->input->post('kategori_spek');
			$kat_spek_lama	= $this->input->post('kat_spek_lama');

			//CEK NAMA GOLONGAN JIKA ADA YANG SAMA
			$record = $this->db->select('kat_spek')
								->from($this->table)
								->where('kat_spek != ',$kat_spek_lama)
								->get();
			foreach($record->result() as $r) {
				if($r->kat_spek == $kategori_spek) {
					$this->session->set_flashdata('msg_failed','Nama kategori spek "'.$kategori_spek.'" sudah dipakai');
					redirect('kat_spek/edit/'.$id_t_katspek);
				}
			}

			$data	= array('kat_spek'=>$kategori_spek);

			$this->model_crud->update_data($this->table,$data,'id_t_katspek',$id_t_katspek);
			$this->session->set_flashdata('msg_success','Data kategori spek berhasil diubah');

			redirect('kat_spek');
		}
		else{
			$id_t_katspek	= $this->uri->segment(3);
			$data['record']	= $this->model_crud->get_one($this->table,'id_t_katspek',$id_t_katspek)->row_array();
			$this->template->load('nav_head',$this->folder.'/admin_form',$data);
		}
	}

	public function delete(){
		$id_t_katspek = $this->uri->segment(3);
		$this->model_crud->delete_data($this->table,'id_t_katspek',$id_t_katspek);
		$this->session->set_flashdata('msg_success','Data kategori spek berhasil dihapus');
		redirect('kat_spek');
	}

	public function table_kategori_spek()
	{
		$this->datatables->select('id_t_katspek,kat_spek');
		$this->datatables->add_column('action',anchor('kat_spek/edit/$1','Edit',array('class'=>'btn btn-warning btn-xs')).'&nbsp'.anchor('kat_spek/delete/$1','Delete',array('class'=>'btn btn-danger btn-xs',"onclick"=>"return confirm('Anda yakin ingin menghapus?')")),'id_t_katspek');
		$this->datatables->from($this->table);
		return print_r($this->datatables->generate());
	}

}

/* End of file kat_spek.php */
/* Location: ./application/controllers/kat_spek.php */