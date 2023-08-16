<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class produksi extends CI_Controller {

	var $folder = 'produksi';
	var $table	= 't_permintaan';

	public function __construct(){
		parent::__construct();
		cek_session();
		cek_dept('produksi');
		$this->load->model('model_produksi');
	}

	public function index(){
		$this->template->load('nav_head','dashboard/produksi_main');
	}

	public function permintaan(){
		if(isset($_POST['submit'])){
			$running		= $this->input->post('running');
			$id_t_db_spek	= $this->input->post('id_t_db_spek');
			$jumlah			= $this->input->post('jumlah');
			$tanggal		= date('Y-m-d');
			$nama			= $this->session->userdata('nama');
			$plant			= $this->session->userdata('plant');
			$data = array(
				'running_permintaan'	=> $running,
				'id_db_spek'			=> $id_t_db_spek,
				'jumlah_permintaan'		=> $jumlah,
				'pemohon'				=> $nama,
				'tanggal_permintaan'	=> $tanggal,
				'plant'					=> $plant);

			// Input ke Database
			$this->db->trans_start();
			$this->model_crud->create_data($this->table,$data);
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE){
				echo "Gagal Input Data ke Database / Gagal Kirim Email !";
				die;
			}
			else{
				$this->session->set_flashdata('msg_success','Data informasi kedatangan & status berhasil diubah.');
				permintaan_gudang($running);
				redirect('produksi');
			}
		}
		elseif ($this->uri->segment(3) == 'form'){
			$this->template->load('nav_head',$this->folder.'/permintaan_form');
		}
		elseif ($this->uri->segment(3) != '' AND $this->uri->segment(3) != 'form'){
			redirect('produksi');
		}
		else {
			$dept = $this->session->userdata('dept');
			$this->template->load('nav_head',$this->folder.'/'.$dept.'_permintaan_view');
		}
	}

	public function edit(){
		cek_level();
		if(isset($_POST['submit'])){
			$id 	= $this->input->post('id');
			$id_db 	= $this->input->post('id_t_db_spek');
			$jumlah = $this->input->post('jumlah');
			$data = array(
				'id_db_spek'		=> $id_db,
				'jumlah_permintaan'	=> $jumlah);

			$this->model_crud->update_data($this->table,$data,'id_permintaan',$id);
			$this->session->set_flashdata('msg_username','Data permintaan SM berhasil diubah.');
			redirect('produksi');
		}
		else{
			$id 			= $this->uri->segment(3);
			$data['record'] = $this->model_crud->get_one($this->table,'id_permintaan',$id)->row_array();
			$this->template->load('nav_head',$this->folder.'/permintaan_form',$data);
		}
	}

	public function delete(){
		cek_level();
		$id = $this->uri->segment(3);
		$this->model_crud->delete_data($this->table,'id_permintaan',$id);
		$this->session->set_flashdata('msg_username','Data permintaan SM berhasil dihapus.');
		redirect('produksi');
	}

	public function penerimaan(){
		$dept = $this->session->userdata('dept');
		$this->template->load('nav_head',$this->folder.'/penerimaan_view');
	}

	public function proses(){
		if(isset($_POST['submit'])){
			$permintaan = $this->input->post('permintaan');
			$date 		= date('Y-m-d');
			$terima 	= $this->input->post('terima');
			$penerima 	= $this->input->post('penerima');
			$running		= $this->input->post('running');
			$kode_produksi		= $this->input->post('kode_produksi');
			$id 				= $this->input->post('id');
			$acc				= $this->input->post('acc');
			$stok				= $this->input->post('stok');
			$tanggal 			= $this->input->post('tanggal');
			$penanggungjawab 	= $this->input->post('penanggungjawab');

			$data = array(
				'jumlah_penerimaan' => $terima,
				'penerima' => $penerima,
				'tanggal_penerimaan' => $date,
				'status' => 'Selesai');
			// Input ke Database
			$this->db->trans_start();
			$this->model_crud->update_data($this->table,$data,'id_permintaan',$permintaan);
			// Log
			for($i = 0; $i < count($id); $i++) {
				if ($acc[$i] > 0) {
					$gudang = array(
						'id'				=> $id[$i],
						'status'			=> 'tarik',
						'jumlah'			=> $acc[$i],
						'running'			=> $running,
						'tanggal'			=> $tanggal[$i],
						'penanggungjawab'	=> $penanggungjawab[$i]
					);
					$produksi = array(
						'id'				=> $id[$i],
						'status'			=> 'deposit',
						'jumlah'			=> $acc[$i],
						'running'			=> $running
					);
					$this->model_produksi->log_tmp_gudang('t_log_gudang',$gudang);
					$this->model_produksi->log_tmp_produksi('t_log_gudang_p',$produksi);
					$this->model_produksi->hitung_gudang($id[$i],$acc[$i]);
				}
			}
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE){
				echo "Gagal Input Data ke Database / Gagal Kirim Email !";
				die;
			}
			else{
				$this->session->set_flashdata('msg_success','Proses penerimaan telah selesai !.');
				redirect('produksi');
			}
		}
		else {
			$id 			= $this->uri->segment(3);
			$data['record'] = $this->model_crud->get_one($this->table,'id_permintaan',$id)->row_array();
			$this->template->load('nav_head',$this->folder.'/penerimaan_form',$data);
		}
	}

	public function gudang(){
		$dept = $this->session->userdata('dept');
		$data['read'] = $this->model_produksi->get_gudang($dept);
		$this->template->load('nav_head',$this->folder.'/gudang_view',$data);
	}

	public function log(){
		$dept = $this->session->userdata('dept');
		$data['read'] = $this->model_produksi->log_gudang($dept);
		$this->template->load('nav_head',$this->folder.'/log_view',$data);
	}

	public function json(){
		$plant = $this->session->userdata('plant');
		$this->datatables->select('id_permintaan, running_permintaan, status, kode_oracle, nama_bahan, jumlah_permintaan, tanggal_permintaan, pemohon');
		$this->datatables->from($this->table);
		$this->datatables->join('t_db_spek', 't_permintaan.id_db_spek = t_db_spek.id_t_dbspek', 'inner');
		if ($plant == 'All') {
			$this->datatables->where('status', 'Belum Proses');
			$this->datatables->add_column('action',
				anchor('produksi/edit/$1','Edit',array('class'=>'btn btn-warning btn-xs')).'&nbsp'.
				anchor('produksi/delete/$1','Delete',array('class'=>'btn btn-danger btn-xs',"onclick"=>"return confirm('Anda yakin ingin menghapus?')")),'id_permintaan');
		}
		else{
			$array = array('status' => 'Belum Proses', 'plant' => $plant);
			$this->datatables->where($array);
		}
		return print_r($this->datatables->generate());
	}

	public function json2(){
		$plant = $this->session->userdata('plant');
		$this->datatables->select('id_permintaan, running_permintaan, status, kode_oracle, nama_bahan, jumlah_permintaan, tanggal_permintaan, pemohon');
		$this->datatables->from($this->table);
		$this->datatables->join('t_db_spek', 't_permintaan.id_db_spek = t_db_spek.id_t_dbspek', 'inner');
		if ($plant == 'All') {
			$this->datatables->where('status', 'Proses');
			$this->datatables->add_column('action',
				anchor('produksi/proses/$1','Proses',array('class'=>'btn btn-success btn-xs')).'&nbsp'.
				anchor('produksi/edit/$1','Edit',array('class'=>'btn btn-warning btn-xs')).'&nbsp'.
				anchor('produksi/delete/$1','Delete',array('class'=>'btn btn-danger btn-xs',"onclick"=>"return confirm('Anda yakin ingin menghapus?')")),'id_permintaan');
		}
		else{
			$array = array('status' => 'Proses', 'plant' => $plant);
			$this->datatables->where($array);
			$this->datatables->add_column('action',
				anchor('produksi/proses/$1','Proses',array('class'=>'btn btn-success btn-xs')),'id_permintaan');
		}
		return print_r($this->datatables->generate());
	}

	public function get_satuan(){
		$data_1 = $this->input->get('data_1');
		$query = $this->db->query('SELECT satuan FROM t_db_spek WHERE id_t_dbspek = '.$data_1);
		foreach ($query->result() as $row){
			$data = $row->satuan;
		}
		if (!empty($data)) {
			echo json_encode($data);}
		else{
			echo '0';}
	}
}

/* End of file produksi.php */
/* Location: ./application/controllers/produksi.php */