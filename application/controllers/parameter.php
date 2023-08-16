<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class parameter extends CI_Controller {

	var $folder = 'parameter';
	var $table = 't_nama_parameter';

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
			$kat_spek 		= $this->input->post('kat_spek');
			$nama_parameter = $this->input->post('nama_parameter');

			$data			= array('id_kat_spek'=>$kat_spek,
									'nama_parameter'=>$nama_parameter);

			//CEK KATEGORI SPEK JIKA ADA YANG SAMA
			$record = $this->db->select('*')
								->from($this->table)
								->where('id_kat_spek = ',$kat_spek,' AND nama_parameter = ',$nama_parameter)
								->get();
			foreach($record->result() as $r) {
				if($r->nama_parameter == $nama_parameter) {
					$this->session->set_flashdata('msg_failed','Nama parameter : "'.$nama_parameter.'" sudah dipakai');
					redirect('parameter/add');
				}
			}

			$this->model_crud->create_data($this->table,$data);
			$this->session->set_flashdata('msg_success','Nama parameter : "'.$nama_parameter.'" berhasil ditambahkan');
			redirect('parameter');
		}
		else {
			$this->template->load('nav_head',$this->folder.'/admin_form');
		}
	}

	public function edit(){
		if(isset($_POST['submit'])){
			$id_t_nama_parameter	= $this->input->post('id_t_nama_parameter');
			$id_kat_spek 			= $this->input->post('kat_spek');
			$nama_parameter			= $this->input->post('nama_parameter');
			$nama_parameter_lama	= $this->input->post('nama_parameter_lama');

			//CEK KATEGORI SPEK JIKA ADA YANG SAMA
			$record = $this->db->select('*')
								->from($this->table)
								->where('id_kat_spek = ',$id_kat_spek,' AND nama_parameter != ',$nama_parameter_lama)
								->get();
			foreach($record->result() as $r) {
				if($r->nama_parameter == $nama_parameter) {
					$this->session->set_flashdata('msg_failed','Nama parameter : "'.$nama_parameter.'" sudah dipakai');
					redirect('parameter/edit/'.$id_t_nama_parameter);
				}
			}

			$data	= array('id_kat_spek'=>$id_kat_spek,
							'nama_parameter'=>$nama_parameter);

			$this->model_crud->update_data($this->table,$data,'id_t_nama_parameter',$id_t_nama_parameter);
			$this->session->set_flashdata('msg_success','Data nama parameter berhasil diubah');

			redirect('parameter');
		}
		else{
			$id_t_nama_parameter = $this->uri->segment(3);
			$data['record']	= $this->model_crud->get_one($this->table,'id_t_nama_parameter',$id_t_nama_parameter)->row_array();
			$this->template->load('nav_head',$this->folder.'/admin_form',$data);
		}
	}

	public function delete(){
		$id_t_nama_parameter = $this->uri->segment(3);
		$this->model_crud->delete_data($this->table,'id_t_nama_parameter',$id_t_nama_parameter);
		$this->session->set_flashdata('msg_success','Data nama parameter berhasil dihapus');
		redirect('parameter');
	}

	public function table_nama_parameter()
	{
		$this->datatables->select('id_t_nama_parameter,kat_spek,nama_parameter');
		$this->datatables->add_column('action',anchor('parameter/edit/$1','Edit',array('class'=>'btn btn-warning btn-xs')).'&nbsp'.anchor('parameter/delete/$1','Delete',array('class'=>'btn btn-danger btn-xs',"onclick"=>"return confirm('Anda yakin ingin menghapus?')")),'id_t_nama_parameter');
		$this->datatables->from($this->table);
		$this->datatables->join('t_kategori_spek', 't_kategori_spek.id_t_katspek = t_nama_parameter.id_kat_spek');
		return print_r($this->datatables->generate());
	}

}

/* End of file parameter.php */
/* Location: ./application/controllers/parameter.php */