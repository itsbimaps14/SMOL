<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class psa extends CI_Controller {

	var $folder = 'psa';
	var $table = 't_kedatangan';

	public function __construct(){
		parent::__construct();
		cek_dept('psa');
		$this->load->model('model_psa');
	}

	public function index(){
		$this->template->load('nav_head','dashboard/psa_main');
	}

	public function belum_analisa(){
		$plant 	= $this->session->userdata('plant');
		switch ($plant) {
			case 'All':
				$data['read'] = $this->model_psa->view_psa('status_all = "Belum Analisa QC"');
			break;
			default:
				$data['read'] = $this->model_psa->view_psa('plant = "'.$plant.'" AND status_all = "Belum Analisa QC"');
			break;
		}
		$this->template->load('nav_head',$this->folder.'/psa_view',$data);
	}

	public function proses_all(){
		$plant 	= $this->session->userdata('plant');
		switch ($plant) {
			case 'All':
				$data['read'] = $this->model_psa->view_psa('status_all = "Analisa QC" or status_all = "Tahanan" or status_all = "OK Pending Monitoring" or status_all = "Tahanan RD"');
			break;
			default:
				$data['read'] = $this->model_psa->view_psa('(status_all = "Analisa QC" or status_all = "Tahanan" or status_all = "Released Partial" or status_all = "OK Pending Monitoring" or status_all = "Tahanan RD") AND plant = "'.$plant.'"');
			break;
		}
		$this->template->load('nav_head',$this->folder.'/psa_view',$data);
	}

	public function analisa_qc(){
		$plant 	= $this->session->userdata('plant');
		switch ($plant) {
			case 'All':
				$data['read'] = $this->model_psa->view_psa('status_all = "Analisa QC"');
			break;
			default:
				$data['read'] = $this->model_psa->view_psa('plant = "'.$plant.'" AND status_all = "Analisa QC"');
			break;
		}
		$this->template->load('nav_head',$this->folder.'/psa_view',$data);
	}

	public function tahanan(){
		$plant 	= $this->session->userdata('plant');
		switch ($plant) {
			case 'All':
				$data['read'] = $this->model_psa->view_psa('status_all = "Tahanan" or status_all = "Tahanan RD"');
			break;
			default:
				$data['read'] = $this->model_psa->view_psa('(status_all = "Tahanan" or status_all = "Tahanan RD") AND plant = "'.$plant.'"');
			break;
		}
		$this->template->load('nav_head',$this->folder.'/psa_view',$data);
	}

	public function released_partial(){
		$plant 	= $this->session->userdata('plant');
		switch ($plant) {
			case 'All':
				$data['read'] = $this->model_psa->view_psa('status_qc = "Released Partial" AND status_all = "OK Pending Monitoring"');
			break;
			default:
				$data['read'] = $this->model_psa->view_psa('plant = "'.$plant.'" AND status_qc = "Released Partial" AND status_all = "OK Pending Monitoring"');
			break;
		}
		$this->template->load('nav_head',$this->folder.'/psa_view',$data);
	}

	public function pending_monitoring(){
		$plant 	= $this->session->userdata('plant');
		switch ($plant) {
			case 'All':
				$data['read'] = $this->model_psa->view_psa('status_all = "OK Pending Monitoring"');
			break;
			default:
				$data['read'] = $this->model_psa->view_psa('plant = "'.$plant.'" AND status_all = "OK Pending Monitoring"');
			break;
		}
		$this->template->load('nav_head',$this->folder.'/psa_view',$data);
	}

	public function finish(){
		$plant 	= $this->session->userdata('plant');
		switch ($plant) {
			case 'All':
				$data['read'] = $this->model_psa->view_psa('status_all = "OK Closed" or status_all = "OK Bersyarat"');
			break;
			default:
				$data['read'] = $this->model_psa->view_psa('(status_all = "OK Closed" or status_all = "OK Bersyarat") AND plant = "'.$plant.'"');
			break;
		}
		$this->template->load('nav_head',$this->folder.'/psa_view',$data);
	}

	public function reject(){
		$plant 	= $this->session->userdata('plant');
		switch ($plant) {
			case 'All':
				$data['read'] = $this->model_psa->view_psa('status_all = "Reject"');
			break;
			default:
				$data['read'] = $this->model_psa->view_psa('plant = "'.$plant.'" AND status_all = "Reject"');
			break;
		}
		$this->template->load('nav_head',$this->folder.'/psa_view',$data);
	}

	public function add(){
		if(isset($_POST['submit'])) {
			$plant = $this->input->post('plant');
			$plant = strtoupper($plant);
			$no_running_kedatangan	= $this->input->post('no_fsc');
			$running = substr($no_running_kedatangan, 0,3);
			
			if(!is_dir('uploads/file_coa_psa/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/')) {
				mkdir('uploads/file_coa_psa/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/',0777,TRUE);
			}

			$path = 'uploads/file_coa_psa/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/';
			$config['upload_path']		= $path;
			$config['allowed_types']	= '*';
			$config['max_size']			= '1024';
			$config['file_ext_tolower']	= 'true';
			$config['file_name'] 		= strtolower(pathinfo($_FILES['attachement_coa']['name'], PATHINFO_FILENAME)).'-'.date('d-m-Y');
			$this->upload->initialize($config);

			$tanggal_datang			= $this->input->post('tanggal_datang');
			$id_t_db_spek			= $this->input->post('id_t_db_spek');
			$kode_produksi			= $this->input->post('kode_produksi');
			$no_po					= $this->input->post('no_po');
			$supplier				= $this->input->post('supplier');
			$principal				= $this->input->post('principal');
			$tanggal_prod			= $this->input->post('tanggal_prod');
			$tanggal_exp			= $this->input->post('tanggal_exp');
			$tanggal_dibutuhkan		= $this->input->post('tanggal_dibutuhkan');
			$jumlah 				= $this->input->post('jumlah');
			$umur_simpan			= $this->input->post('umur_simpan');

			if(!$this->upload->do_upload('attachement_coa')) {
				$data['error'] 	= $this->upload->display_errors();
				$this->template->load('nav_head',$this->folder.'/psa_form',$data);
			}
			else{
				$data 	= array(
					'no_running_kedatangan'	=> $no_running_kedatangan,
					'plant'					=> $plant,
					'tanggal_datang'		=> $tanggal_datang,
					'kode_id_t_db_spek'		=> $id_t_db_spek,
					'kode_produksi'			=> $kode_produksi,
					'no_po'					=> $no_po,
					'supplier'				=> $supplier,
					'principal'				=> $principal,
					'tanggal_prod'			=> $tanggal_prod,
					'tanggal_exp'			=> $tanggal_exp,
					'tanggal_dibutuhkan'	=> $tanggal_dibutuhkan,
					'jumlah'				=> $jumlah,
					'umur_simpan'			=> $umur_simpan
				);

				if(!empty($_FILES['attachement_coa']['name'])) {
					$file_name = $this->upload->data('file_name');
					$data['attachement_coa'] = $plant.'/'.date("Y").'/'.date('m').'/'.$running.'/'.$file_name;
				}

				// Ambil data untuk t_parameter
					$release = $this->model_psa->par_release($id_t_db_spek);
					$monitor = $this->model_psa->par_monitor($id_t_db_spek);

				// Input ke Database
				$this->db->trans_start();

					$this->model_crud->create_data('t_kedatangan',$data);

					foreach ($release->result() as $row){
						$res_release = array(
							'id_parameter_release' 		=> $row->id_t_parameter_release,
							'no_running_kedatangan'		=> $no_running_kedatangan,
							'analisa_qc_release'		=> ''
						);
					$this->model_crud->create_data('t_analisa_qc_release',$res_release);
					}

					foreach ($monitor->result() as $row){
						$res_monitor = array(
							'id_parameter_monitoring' 	=> $row->id_t_parameter_monitoring,
							'no_running_kedatangan'		=> $no_running_kedatangan,
							'analisa_qc_monitoring'		=> ''
						);
					$this->model_crud->create_data('t_analisa_qc_monitoring',$res_monitor);
					}

				$this->db->trans_complete();

				if ($this->db->trans_status() === FALSE){
					echo "Gagal Input Data ke Database / Gagal Kirim Email !";
					die;
				}
				else{
					email_input_fscpsa($data['no_running_kedatangan']);
					redirect('psa');
				}
			}
		}
		else {
			$this->template->load('nav_head',$this->folder.'/psa_form');
		}
	}

	public function edit(){
		if(isset($_POST['submit'])) {

			$plant					= $this->input->post('plant');
			$plant					= strtoupper($plant);
			$id_t_kedatangan 		= $this->input->post('id_t_kedatangan');
			$no_running_kedatangan	= $this->input->post('no_fsc');
			$running 				= substr($no_running_kedatangan, 0,3);
			
			if(!is_dir('uploads/file_coa_psa/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/')) {
				mkdir('uploads/file_coa_psa/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/',0777,TRUE);
			}

			$path = 'uploads/file_coa_psa/'.$plant.'/'.date("Y").'/'.date('m').'/'.$running.'/';
			$config['upload_path']		= $path;
			$config['allowed_types']	= '*';
			$config['max_size']			= '1024';
			$config['file_ext_tolower']	= 'true';
			$config['file_name'] 		= strtolower(pathinfo($_FILES['attachement_coa']['name'], PATHINFO_FILENAME)).'-'.date('d-m-Y');
			$this->upload->initialize($config);

			$tanggal_datang			= $this->input->post('tanggal_datang');
			$id_t_db_spek			= $this->input->post('id_t_db_spek');
			$kode_produksi			= $this->input->post('kode_produksi');
			$no_po					= $this->input->post('no_po');
			$supplier				= $this->input->post('supplier');
			$principal				= $this->input->post('principal');
			$tanggal_prod			= $this->input->post('tanggal_prod');
			$tanggal_exp			= $this->input->post('tanggal_exp');
			$tanggal_dibutuhkan		= $this->input->post('tanggal_dibutuhkan');
			$jumlah 				= $this->input->post('jumlah');
			$satuan					= $this->input->post('satuan');
			$umur_simpan			= $this->input->post('umur_simpan');

			$data 	= array(
				'no_running_kedatangan'	=> $no_running_kedatangan,
				'tanggal_datang'		=> $tanggal_datang,
				'kode_id_t_db_spek'		=> $id_t_db_spek,
				'kode_produksi'			=> $kode_produksi,
				'no_po'					=> $no_po,
				'supplier'				=> $supplier,
				'principal'				=> $principal,
				'tanggal_prod'			=> $tanggal_prod,
				'tanggal_exp'			=> $tanggal_exp,
				'tanggal_dibutuhkan'	=> $tanggal_dibutuhkan,
				'jumlah'				=> $jumlah,
				'umur_simpan'			=> $umur_simpan
			);

			if(!$this->upload->do_upload('attachement_coa')) {
				$text['error'] 	= $this->upload->display_errors();
				$this->template->load('nav_head',$this->folder.'/psa_form',$text);
			}

			if(!empty($_FILES['attachement_coa']['name'])) {
				$file_name = $this->upload->data('file_name');
				$data['attachement_coa'] = $plant.'/'.date("Y").'/'.date('m').'/'.$running.'/'.$file_name;
				$this->model_psa->update_coa($id_t_kedatangan);
			}

			$this->model_crud->update_data($this->table,$data,'id_t_kedatangan',$id_t_kedatangan);
			$this->session->set_flashdata('msg_success','Data informasi kedatangan & status berhasil diubah.');
			redirect('psa');
		}
		else {
			$id_t_kedatangan	= $this->uri->segment(3);
			$data['record']		= $this->model_crud->get_one($this->table,'id_t_kedatangan',$id_t_kedatangan)->row_array();
			$this->template->load('nav_head',$this->folder.'/psa_form',$data);
		}
	}

	public function delete(){
		$id_t_kedatangan = $this->uri->segment(3);
		$this->model_psa->delete_file($id_t_kedatangan);
		$this->model_crud->delete_data($this->table,'id_t_kedatangan',$id_t_kedatangan);
		$this->session->set_flashdata('msg_success','Data nama golongan berhasil dihapus.');
		redirect('psa');
	}

	public function permintaan(){
		if(isset($_POST['submit'])){
			$running 		= $this->input->post('running');
			$kode_produksi	= $this->input->post('kode_produksi');
			$id 			= $this->input->post('id');
			$stok 			= $this->input->post('stok');
			$tarik			= $this->input->post('tarik');

			$this->db->trans_start();
			for($i = 0; $i < count($id); $i++) {
				if ($tarik[$i] > 0) {
					$tmp = array(
						'id'		=> $id[$i],
						'status'	=> 'tarik',
						'jumlah'	=> $tarik[$i],
						'running'	=> $running
					);
					$this->model_psa->log_tmp_gudang('t_log_gudang_tmp',$tmp);
					//psa_gudang_log($id[$i],'tarik',$tarik[$i],$running);
					//gudang_produksi($id[$i],$tarik[$i],$running);
				}
			}
			$permintaan = array('status' => 'Proses');
			$this->model_crud->update_data('t_permintaan',$permintaan,'running_permintaan',$running);
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE){
				echo "Gagal Input Data ke Database / Gagal Kirim Email !";
				die;
			}
			else{
				$this->session->set_flashdata('msg_success','Data informasi permintaan berhasil diproses.');
				redirect('psa/permintaan');
			}
		}
		elseif ($this->uri->segment(3) == 'form'){
			$id 			= $this->uri->segment(4);
			$data['record'] = $this->model_crud->get_one('t_permintaan','id_permintaan',$id)->row_array();
			$this->template->load('nav_head',$this->folder.'/permintaan_form',$data);
		}
		elseif ($this->uri->segment(3) != '' AND $this->uri->segment(3) != 'form'){
			redirect('psa');
		}
		else {
			$dept = $this->session->userdata('dept');
			$this->template->load('nav_head',$this->folder.'/permintaan_view');
		}
	}

	public function gudang(){
		$dept = $this->session->userdata('dept');
		$data['read'] = $this->model_psa->get_gudang($dept);
		$this->template->load('nav_head',$this->folder.'/gudang_view',$data);
	}

	public function log(){
		$dept = $this->session->userdata('dept');
		$data['read'] = $this->model_psa->log_gudang($dept);
		$this->template->load('nav_head',$this->folder.'/log_view',$data);
	}

	public function json_permintaan(){
		$plant = $this->session->userdata('plant');
		$this->datatables->select('id_permintaan, running_permintaan, status, kode_oracle, nama_bahan, jumlah_permintaan, tanggal_permintaan, pemohon');
		$this->datatables->from('t_permintaan');
		$this->datatables->join('t_db_spek', 't_permintaan.id_db_spek = t_db_spek.id_t_dbspek', 'inner');
		if ($plant == 'All') {
			$this->datatables->where('status', 'Belum Proses');
			$this->datatables->add_column('action',
				anchor('psa/permintaan/form/$1','Proses',array('class'=>'btn btn-success btn-xs')),'id_permintaan');
		}
		else{
			$array = array('status' => 'Belum Proses', 'plant' => $plant);
			$this->datatables->where($array);
			$this->datatables->add_column('action',
				anchor('psa/permintaan/form/$1','Proses',array('class'=>'btn btn-success btn-xs')),'id_permintaan');
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

	public function get_stok(){
		$data_1 = $this->input->get('data_1');
		$query = $this->db->query('SELECT stok FROM t_gudang WHERE id = '.$data_1);
		foreach ($query->result() as $row){
			$data = $row->stok;
		}
		if (!empty($data)) {
			echo json_encode($data);}
		else{
			echo '0';}
	}

	public function report(){
		cek_menu('admin');
		$this->template->load('nav_head','report_par/admin_report_kedatangan_view');
	}

	public function report_release(){
		$this->datatables->select('
			t_analisa_qc_release.no_running_kedatangan,
			tanggal_datang,
			kode_oracle,
			nama_bahan,
			kode_produksi,
			kat_spek,
			nama_parameter,
			analisa_qc_release,
			status_qc');
		$this->datatables->from('t_analisa_qc_release');
		$this->datatables->join('t_kedatangan','t_analisa_qc_release.no_running_kedatangan = t_kedatangan.no_running_kedatangan','left');
		$this->datatables->join('t_db_spek','t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek','left');
		$this->datatables->join('t_parameter_release','t_analisa_qc_release.id_parameter_release = t_parameter_release.id_t_parameter_release','left');
		$this->datatables->join('t_kategori_spek','t_parameter_release.kategori_spek_release = t_kategori_spek.id_t_katspek','left');
		$this->datatables->join('t_nama_parameter','t_parameter_release.nama_parameter_release = t_nama_parameter.id_t_nama_parameter','left');

		return print_r($this->datatables->generate());
	}

	public function report_monitoring(){
		$this->datatables->select('
			t_analisa_qc_monitoring.no_running_kedatangan,
			tanggal_datang,
			kode_oracle,
			nama_bahan,
			kode_produksi,
			kat_spek,
			nama_parameter,
			analisa_qc_monitoring,
			status_qc');
		$this->datatables->from('t_analisa_qc_monitoring');
		$this->datatables->join('t_kedatangan','t_analisa_qc_monitoring.no_running_kedatangan = t_kedatangan.no_running_kedatangan','left');
		$this->datatables->join('t_db_spek','t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek','left');
		$this->datatables->join('t_parameter_monitoring','t_analisa_qc_monitoring.id_parameter_monitoring = t_parameter_monitoring.id_t_parameter_monitoring','left');
		$this->datatables->join('t_kategori_spek','t_parameter_monitoring.kategori_spek_monitoring = t_kategori_spek.id_t_katspek','left');
		$this->datatables->join('t_nama_parameter','t_parameter_monitoring.nama_parameter_monitoring = t_nama_parameter.id_t_nama_parameter','left');

		return print_r($this->datatables->generate());
	}

	public function report_kedatagan(){
		$this->datatables->select('id_t_parameter_release,nama_golongan,kode_oracle,nama_bahan,umur_simpan,kondisi_penyimpanan,kat_spek,nama_parameter');
		$this->datatables->from($this->table_release);
		$this->datatables->join('t_db_spek','t_db_spek.no_db_spek = t_parameter_release.no_db_spek_release','inner');
		$this->datatables->join('t_golongan','t_db_spek.golongan = t_golongan.id_t_golongan','inner');
		$this->datatables->join('t_kategori_spek','t_parameter_release.kategori_spek_release = t_kategori_spek.id_t_katspek','inner');
		$this->datatables->join('t_nama_parameter','t_parameter_release.nama_parameter_release = t_nama_parameter.id_t_nama_parameter','inner');

		return print_r($this->datatables->generate());
	}
}

/* End of file psa.php */
/* Location: ./application/controllers/psa.php */