<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class spek extends CI_Controller {

	var $folder = 'spek';
	var $table1 = 't_db_spek';

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$session_dept = $this->session->userdata('dept');

		if ($session_dept == 'admin') {
			cek_menu('admin');
			$this->template->load('nav_head',$this->folder.'/admin_view');
		}
		else{
			$this->template->load('nav_head',$this->folder.'/guest_view');
		}
	}

	public function add(){
		if(isset($_POST['submit'])) {
			$no_db_spek				= $this->input->post('no_db_spek');
			$no_upp					= $this->input->post('no_upp');
			$no_upp					= strtoupper($no_upp);
			$tanggal_berlaku		= $this->input->post('tanggal_berlaku');
			$revisi					= $this->input->post('revisi');
			$golongan				= $this->input->post('golongan');
			$kode_oracle			= $this->input->post('kode_oracle');
			$nama_bahan				= $this->input->post('nama_bahan');
			$nama_bahan				= ucwords($nama_bahan);
			$umur_simpan			= $this->input->post('umur_simpan');
			$satuan					= $this->input->post('satuan');
			$satuan					= strtoupper($satuan);
			$kondisi_penyimpanan	= $this->input->post('kondisi_penyimpanan');

			//Untuk Parameter Release
			$katspek_par_release	= $this->input->post('kategorispek_parameter_release');
			$nama_par_release		= $this->input->post('nama_parameter_release');
			$nilai_spek_release		= $this->input->post('nilai_spek_release');
			$input1_release			= $this->input->post('periode_analisa_parameter_release');
			$input2_release			= $this->input->post('titik_sampling_parameter_release');

			$keterangan_release		= $this->input->post('keterangan_release');

			//Untuk Parameter Monitoring
			$katspek_par_monitoring	= $this->input->post('kategorispek_parameter_monitoring');
			$nama_par_monitoring	= $this->input->post('nama_parameter_monitoring');
			$nilai_spek_monitoring	= $this->input->post('nilai_spek_monitoring');
			$input1_monitoring		= $this->input->post('periode_analisa_parameter_monitoring');
			$input2_monitoring		= $this->input->post('titik_sampling_parameter_monitoring');

			$keterangan_monitoring	= $this->input->post('keterangan_monitoring');
			$referensi				= $this->input->post('referensi');

			$data					= array('no_db_spek'=>$no_db_spek,
											'no_upp'=>$no_upp,
											'tanggal_berlaku'=>$tanggal_berlaku,
											'revisi'=>$revisi,
											'golongan'=>$golongan,
											'kode_oracle'=>$kode_oracle,
											'nama_bahan'=>$nama_bahan,
											'umur_simpan'=>$umur_simpan,
											'kondisi_penyimpanan'=>$kondisi_penyimpanan,
											'keterangan_release'=>$keterangan_release,
											'keterangan_monitoring'=>$keterangan_monitoring,
											'referensi'=>$referensi,
											'satuan'=>$satuan
										);

			$this->db->trans_start();

			//Parameter Release
			for($i = 0; $i < count($katspek_par_release); $i++) {
				$data1 	= array('no_db_spek_release'=>$no_db_spek,
					'kategori_spek_release'=>$katspek_par_release[$i],
					'nama_parameter_release'=>$nama_par_release[$i],
					'nilai_spek_release'=>$nilai_spek_release[$i],
					'periode_analisa_release'=>$input1_release[$i],
					'titik_sampling_release'=>$input2_release[$i]);
				$this->model_crud->create_data('t_parameter_release',$data1);
			}

			//Parameter Monitoring
			for($i = 0; $i < count($katspek_par_monitoring); $i++) {
				$data2 	= array('no_db_spek_monitoring'=>$no_db_spek,
					'kategori_spek_monitoring'=>$katspek_par_monitoring[$i],
					'nama_parameter_monitoring'=>$nama_par_monitoring[$i],
					'nilai_spek_monitoring'=>$nilai_spek_monitoring[$i],
					'periode_analisa_monitoring'=>$input1_monitoring[$i],
					'titik_sampling_monitoring'=>$input2_monitoring[$i]);
				$this->model_crud->create_data('t_parameter_monitoring',$data2);
			}

			//Spek
			$this->model_crud->create_data($this->table1,$data);

			//Gudang
			$gudang1 = array('kode_oracle'=>$kode_oracle, 'plant'=>'Ciawi');
			$this->model_crud->create_data('t_kode_gudang',$gudang1);
			$gudang2 = array('kode_oracle'=>$kode_oracle, 'plant'=>'Cibitung');
			$this->model_crud->create_data('t_kode_gudang',$gudang2);
			$gudang3 = array('kode_oracle'=>$kode_oracle, 'plant'=>'Sentul');
			$this->model_crud->create_data('t_kode_gudang',$gudang3);

			$this->db->trans_complete();

			if ($this->db->trans_status() === FALSE){
				echo "Gagal Input Data !";
				die;
			}
			else{
				redirect('spek');
			}

		}
		$this->template->load('nav_head',$this->folder.'/admin_form');
	}

	public function add_revisi(){
		if(isset($_POST['submit'])) {
			$no_db_spek_lama		= $this->input->post('no_db_spek_lama');
			$no_db_spek				= $this->input->post('no_db_spek');
			$no_upp					= $this->input->post('no_upp');
			$tanggal_berlaku		= $this->input->post('tanggal_berlaku');
			$revisi					= $this->input->post('revisi');
			$golongan				= $this->input->post('golongan');
			$kode_oracle			= $this->input->post('kode_oracle');
			$nama_bahan				= $this->input->post('nama_bahan');
			$umur_simpan			= $this->input->post('umur_simpan');
			$kondisi_penyimpanan	= $this->input->post('kondisi_penyimpanan');

			//Untuk Parameter Release
			$katspek_par_release	= $this->input->post('kategorispek_parameter_release');
			$nama_par_release		= $this->input->post('nama_parameter_release');
			$nilai_spek_release		= $this->input->post('nilai_spek_release');
			$input1_release			= $this->input->post('periode_analisa_parameter_release');
			$input2_release			= $this->input->post('titik_sampling_parameter_release');

			for($i = 0; $i < count($katspek_par_release); $i++) {
				$data1 	= array('no_db_spek_release'=>$no_db_spek,
								'kategori_spek_release'=>$katspek_par_release[$i],
								'nama_parameter_release'=>$nama_par_release[$i],
								'nilai_spek_release'=>$nilai_spek_release[$i],
								'periode_analisa_release'=>$input1_release[$i],
								'titik_sampling_release'=>$input2_release[$i]);
				$this->model_crud->create_data('t_parameter_release',$data1);
			}

			$keterangan_release		= $this->input->post('keterangan_release');

			//Untuk Parameter Monitoring
			$katspek_par_monitoring	= $this->input->post('kategorispek_parameter_monitoring');
			$nama_par_monitoring	= $this->input->post('nama_parameter_monitoring');
			$nilai_spek_monitoring	= $this->input->post('nilai_spek_monitoring');
			$input1_monitoring		= $this->input->post('periode_analisa_parameter_monitoring');
			$input2_monitoring		= $this->input->post('titik_sampling_parameter_monitoring');

			for($i = 0; $i < count($katspek_par_monitoring); $i++) {
				$data2 	= array('no_db_spek_monitoring'=>$no_db_spek,
								'kategori_spek_monitoring'=>$katspek_par_monitoring[$i],
								'nama_parameter_monitoring'=>$nama_par_monitoring[$i],
								'nilai_spek_monitoring'=>$nilai_spek_monitoring[$i],
								'periode_analisa_monitoring'=>$input1_monitoring[$i],
								'titik_sampling_monitoring'=>$input2_monitoring[$i]);
				$this->model_crud->create_data('t_parameter_monitoring',$data2);
			}

			$keterangan_monitoring	= $this->input->post('keterangan_monitoring');
			$referensi				= $this->input->post('referensi');

			$data					= array('no_db_spek'=>$no_db_spek,
											'no_upp'=>$no_upp,
											'tanggal_berlaku'=>$tanggal_berlaku,
											'revisi'=>$revisi,
											'golongan'=>$golongan,
											'kode_oracle'=>$kode_oracle,
											'nama_bahan'=>$nama_bahan,
											'umur_simpan'=>$umur_simpan,
											'kondisi_penyimpanan'=>$kondisi_penyimpanan,
											'keterangan_release'=>$keterangan_release,
											'keterangan_monitoring'=>$keterangan_monitoring,
											'referensi'=>$referensi
										);

			$this->model_crud->create_data($this->table1,$data);

			$data = array('status_top'=>'Down');
			$this->model_crud->update_data($this->table1,$data,'no_db_spek',$no_db_spek_lama);

			redirect('spek');
		}
		else {
			$id_t_dbspek	= $this->uri->segment(3);
			$data['record']	= $this->model_crud->get_one($this->table1,'id_t_dbspek',$id_t_dbspek)->row_array();
			$this->template->load('nav_head',$this->folder.'/admin_spek_tambah_revisi',$data);
		}
	}

	public function view(){
		$id_t_dbspek	= $this->uri->segment(3);
		$data['record']	= $this->model_crud->get_one($this->table1,'id_t_dbspek',$id_t_dbspek)->row_array();
		$this->template->load('nav_head',$this->folder.'/admin_spek_view',$data);
	}

	public function edit(){
		$id_t_dbspek	= $this->uri->segment(3);
		$data['record']	= $this->model_crud->get_one($this->table1,'id_t_dbspek',$id_t_dbspek)->row_array();
		$this->template->load('nav_head',$this->folder.'/admin_spek_edit',$data);
	}

	public function edit_data(){
		if(isset($_POST['submit'])) {
			$id_t_dbspek			= $this->input->post('id_t_dbspek');
			$no_db_spek 			= $this->input->post('no_db_spek');
			$no_upp					= $this->input->post('no_upp');
			$no_upp					= strtoupper($no_upp);
			$tanggal_berlaku		= $this->input->post('tanggal_berlaku');
			$golongan				= $this->input->post('golongan');
			$kode_oracle			= $this->input->post('kode_oracle');
			$nama_bahan				= $this->input->post('nama_bahan');
			$nama_bahan				= ucwords($nama_bahan);
			$umur_simpan			= $this->input->post('umur_simpan');
			$kondisi_penyimpanan	= $this->input->post('kondisi_penyimpanan');
			$keterangan_release		= $this->input->post('keterangan_release');
			$keterangan_monitoring	= $this->input->post('keterangan_monitoring');
			$referensi				= $this->input->post('referensi');
			$satuan					= $this->input->post('satuan');
			$satuan					= strtoupper($satuan);

			$data = array(
				'no_upp'				=> $no_upp,
				'tanggal_berlaku'		=> $tanggal_berlaku,
				'golongan'				=> $golongan,
				'kode_oracle'			=> $kode_oracle,
				'nama_bahan'			=> $nama_bahan,
				'umur_simpan'			=> $umur_simpan,
				'kondisi_penyimpanan'	=> $kondisi_penyimpanan,
				'keterangan_release'	=> $keterangan_release,
				'keterangan_monitoring'	=> $keterangan_monitoring,
				'referensi'				=> $referensi,
				'satuan'				=> $satuan
			);

			$this->model_crud->update_data($this->table1,$data,'id_t_dbspek',$id_t_dbspek);
			$this->session->set_flashdata('msg_edit_success','Data spek '.$no_db_spek.' berhasil diubah');
			redirect('spek/edit_data/'.$id_t_dbspek);
		}

		else{
			$id_t_dbspek	= $this->uri->segment(3);
			$data['record']	= $this->model_crud->get_one($this->table1,'id_t_dbspek',$id_t_dbspek)->row_array();
			$this->template->load('nav_head',$this->folder.'/admin_spek_edit_data',$data);
		}
	}

	public function edit_release(){
		if(isset($_POST['submit'])) {
			$id_t_dbspek					= $this->input->post('id_t_dbspek');
			$id_t_parameter_release			= $this->input->post('id_t_parameter_release');
			$no_db_spek_release				= $this->input->post('no_db_spek');
			$kat_spek_release 				= $this->input->post('kat_spek_release');
			$nama_parameter_release			= $this->input->post('nama_parameter_release');
			$nilai_spek_release				= $this->input->post('nilai_spek_release');
			$periode_analisa_release 		= $this->input->post('periode_analisa_release');
			$titik_sampling_release 		= $this->input->post('titik_sampling_release');


			//Tambah data 'time'
			$qty = $this->input->post('qty');
			if($qty != count($kat_spek_release)) {
				for($qty; $qty < count($kat_spek_release); $qty++) {
					$data 	= array('no_db_spek_release'=>$no_db_spek_release,
									'kategori_spek_release'=>$kat_spek_release[$qty],
									'nama_parameter_release'=>$nama_parameter_release[$qty],
									'nilai_spek_release'=>$nilai_spek_release[$qty],
									'periode_analisa_release'=>$periode_analisa_release[$qty],
									'titik_sampling_release'=>$titik_sampling_release[$qty]);
					$this->model_crud->create_data('t_parameter_release',$data);
				}
			}

			for($i = 0; $i < count($kat_spek_release); $i++) {
				$data 	= array('nilai_spek_release'=>$nilai_spek_release[$i],
								'periode_analisa_release'=>$periode_analisa_release[$i],
								'titik_sampling_release'=>$titik_sampling_release[$i]);
				$this->model_crud->update_data('t_parameter_release',$data,'id_t_parameter_release',$id_t_parameter_release[$i]);
			}
			
			redirect('spek/edit_release/'.$id_t_dbspek);
		}

		else{
			$id_t_dbspek	= $this->uri->segment(3);

			$query = $this->db->query('SELECT no_db_spek FROM t_db_spek WHERE id_t_dbspek = '.$id_t_dbspek);
			foreach ($query->result() as $row){
				$where = $row->no_db_spek;
			}

			$data['release'] = $this->db->query("
					SELECT id_t_parameter_release,no_db_spek_release,kat_spek,nama_parameter,nilai_spek_release,periode_analisa_release,titik_sampling_release
					FROM t_parameter_release
					INNER JOIN t_kategori_spek ON t_parameter_release.kategori_spek_release = t_kategori_spek.id_t_katspek
					INNER JOIN t_nama_parameter ON t_parameter_release.nama_parameter_release = t_nama_parameter.id_t_nama_parameter
					WHERE no_db_spek_release = '$where'");

			$data['rows_count'] = $this->db->query("SELECT * FROM t_parameter_release WHERE no_db_spek_release = '$where'")->num_rows();

			$this->template->load('nav_head',$this->folder.'/admin_spek_edit_release',$data);
		}
	}

	public function edit_monitoring(){
		if(isset($_POST['submit'])) {
			$id_t_dbspek				= $this->input->post('id_t_dbspek');
			$id_t_parameter_monitoring	= $this->input->post('id_t_parameter_monitoring');
			$no_db_spek					= $this->input->post('no_db_spek');
			$kat_spek_monitoring 		= $this->input->post('kat_spek_monitoring');
			$nama_parameter_monitoring	= $this->input->post('nama_parameter_monitoring');
			$nilai_spek_monitoring		= $this->input->post('nilai_spek_monitoring');
			$periode_analisa_monitoring = $this->input->post('periode_analisa_monitoring');
			$titik_sampling_monitoring 	= $this->input->post('titik_sampling_monitoring');


			//Tambah data 'time'
			$qty = $this->input->post('qty');
			if($qty != count($kat_spek_monitoring)) {
				for($qty; $qty < count($kat_spek_monitoring); $qty++) {
					$data 	= array('no_db_spek_monitoring'=>$no_db_spek,
									'kategori_spek_monitoring'=>$kat_spek_monitoring[$qty],
									'nama_parameter_monitoring'=>$nama_parameter_monitoring[$qty],
									'nilai_spek_monitoring'=>$nilai_spek_monitoring[$qty],
									'periode_analisa_monitoring'=>$periode_analisa_monitoring[$qty],
									'titik_sampling_monitoring'=>$titik_sampling_monitoring[$qty]);
					$this->model_crud->create_data('t_parameter_monitoring',$data);
				}
			}

			for($i = 0; $i < count($kat_spek_monitoring); $i++) {
				$data 	= array('nilai_spek_monitoring'=>$nilai_spek_monitoring[$i],
								'periode_analisa_monitoring'=>$periode_analisa_monitoring[$i],
								'titik_sampling_monitoring'=>$titik_sampling_monitoring[$i]);
				$this->model_crud->update_data('t_parameter_monitoring',$data,'id_t_parameter_monitoring',$id_t_parameter_monitoring[$i]);
			}

			redirect('spek/edit_monitoring/'.$id_t_dbspek);
		}

		else{
			$id_t_dbspek	= $this->uri->segment(3);

			$query = $this->db->query('SELECT no_db_spek FROM t_db_spek WHERE id_t_dbspek = '.$id_t_dbspek);
			foreach ($query->result() as $row){
				$where = $row->no_db_spek;
			}

			$data['release'] = $this->db->query("
					SELECT id_t_parameter_monitoring,no_db_spek_monitoring,kat_spek,nama_parameter,nilai_spek_monitoring,periode_analisa_monitoring,titik_sampling_monitoring
					FROM t_parameter_monitoring
					INNER JOIN t_kategori_spek ON t_parameter_monitoring.kategori_spek_monitoring = t_kategori_spek.id_t_katspek
					INNER JOIN t_nama_parameter ON t_parameter_monitoring.nama_parameter_monitoring = t_nama_parameter.id_t_nama_parameter
					WHERE no_db_spek_monitoring = '$where'");

			$data['rows_count'] = $this->db->query("SELECT * FROM t_parameter_monitoring WHERE no_db_spek_monitoring = '$where'")->num_rows();

			$this->template->load('nav_head',$this->folder.'/admin_spek_edit_monitoring',$data);
		}
	}

	public function history(){
		$id_t_dbspek	= $this->uri->segment(3);

		$query = $this->db->query('SELECT kode_oracle FROM t_db_spek WHERE id_t_dbspek = '.$id_t_dbspek);
		foreach ($query->result() as $row){
			$where = $row->kode_oracle;
		}

		$data['history'] = $this->db->query("
					SELECT id_t_dbspek,no_db_spek,revisi
					FROM t_db_spek
					WHERE kode_oracle = '$where'
					ORDER BY no_db_spek desc");

		$this->template->load('nav_head',$this->folder.'/admin_spek_history',$data);
	}

	public function delete(){
		$id_t_dbspek	= $this->uri->segment(3);

		$table1 = 't_db_spek';
		$table2 = 't_parameter_release';
		$table3 = 't_parameter_monitoring';

		$query = $this->db->query('SELECT no_db_spek FROM t_db_spek WHERE id_t_dbspek = '.$id_t_dbspek);
		foreach ($query->result() as $row){
			$where = $row->no_db_spek;
		}

		$this->model_crud->delete_data($table1,'no_db_spek',$where);
		$this->model_crud->delete_data($table2,'no_db_spek_release',$where);
		$this->model_crud->delete_data($table3,'no_db_spek_monitoring',$where);

		redirect('spek');

	}

	public function delete_release(){
		$table = 't_parameter_release';
		$id_t_dbspek = $this->uri->segment(3);
		$id_t_parameter_release = $this->uri->segment(4);
		$this->model_crud->delete_data($table,'id_t_parameter_release',$id_t_parameter_release);
		redirect('spek/edit_release/'.$id_t_dbspek);
	}

	public function delete_monitoring(){
		$table = 't_parameter_monitoring';
		$id_t_dbspek = $this->uri->segment(3);
		$id_t_parameter_monitoring = $this->uri->segment(4);
		$this->model_crud->delete_data($table,'id_t_parameter_monitoring',$id_t_parameter_monitoring);
		redirect('spek/edit_monitoring/'.$id_t_dbspek);
	}

	public function change_status(){
		$id_t_dbspek	= $this->uri->segment(3);
		
		$query = $this->db->query('SELECT kode_oracle,status_db_spek FROM t_db_spek WHERE id_t_dbspek = '.$id_t_dbspek);
		foreach ($query->result() as $row){
			$where = $row->status_db_spek;
			$penyama = $row->kode_oracle;
		}

		if ($where == 'Active'){
			$data	= array('status_db_spek'=>'Unactive');
		}
		elseif ($where == 'Unactive'){
			$data	= array('status_db_spek'=>'Active');
		}

		$this->model_crud->update_data($this->table1,$data,'kode_oracle',$penyama);
		$this->session->set_flashdata('msg_edit_success','Data keterangan spek berhasil diubah');

		redirect('spek');
	}

	public function table_database_spek()
	{
		$this->table='t_db_spek';
		$this->datatables->select('id_t_dbspek,no_db_spek,kode_oracle,nama_bahan,tanggal_berlaku,revisi,status_db_spek');
		$this->datatables->where('status_top', 'Top');
		$this->datatables->add_column('view',
			anchor('spek/view/$1','View',
				array('class'=>'btn btn-success btn-xs'))
			.'&nbsp'.
			anchor('spek/history/$1','History',
				array('class'=>'btn btn-success btn-xs')),
			'id_t_dbspek');
		$this->datatables->add_column('action',
			anchor('spek/edit/$1','Edit',
				array('class'=>'btn btn-info btn-xs'))
			.'&nbsp'.
			anchor('spek/change_status/$1','Ubah Status',
				array('class'=>'btn btn-info btn-xs',"onclick"=>"return confirm('Anda yakin akan mengubah status?')"))
			.'&nbsp'.
			anchor('spek/add_revisi/$1','+ Revisi',
				array('class'=>'btn btn-info btn-xs'))
			.'&nbsp'.
			anchor('spek/delete/$1','Delete',
				array('class'=>'btn btn-danger btn-xs',"onclick"=>"return confirm('Anda yakin ingin menghapus?')")),
			'id_t_dbspek');
		$this->datatables->from($this->table);
		return print_r($this->datatables->generate());
	}

	public function table_view_spek()
	{
		$this->table='t_db_spek';
		$this->datatables->select('id_t_dbspek,no_db_spek,kode_oracle,nama_bahan,tanggal_berlaku,revisi,status_db_spek');
		$array = array('status_top' => 'Top', 'status_db_spek' => 'Active');
		$this->datatables->where($array);
		$this->datatables->add_column('view',
			anchor('spek/view/$1','View',
				array('class'=>'btn btn-success btn-xs'))
			.'&nbsp'.
			anchor('spek/history/$1','History',
				array('class'=>'btn btn-success btn-xs')),
			'id_t_dbspek');
		$this->datatables->from($this->table);
		return print_r($this->datatables->generate());
	}

	public function view_par_release()
	{
		$id_t_dbspek = $this->uri->segment(3);

		$query = $this->db->query('SELECT no_db_spek FROM t_db_spek WHERE id_t_dbspek = '.$id_t_dbspek);
		foreach ($query->result() as $row){
			$where = $row->no_db_spek;
		}

		$this->table='t_parameter_release';
		$this->datatables->select('*');
		$this->datatables->join('t_kategori_spek','t_parameter_release.kategori_spek_release = t_kategori_spek.id_t_katspek','inner');
		$this->datatables->join('t_nama_parameter','t_parameter_release.nama_parameter_release = t_nama_parameter.id_t_nama_parameter','inner');
		$this->datatables->where('no_db_spek_release',$where);
		$this->datatables->from($this->table);

		return print_r($this->datatables->generate());
	}

	public function view_par_monitor()
	{
		$id_t_dbspek = $this->uri->segment(3);

		$query = $this->db->query('SELECT no_db_spek FROM t_db_spek WHERE id_t_dbspek = '.$id_t_dbspek);
		foreach ($query->result() as $row){
			$where = $row->no_db_spek;
		}

		$this->table='t_parameter_monitoring';
		$this->datatables->select('*');
		$this->datatables->join('t_kategori_spek','t_parameter_monitoring.kategori_spek_monitoring = t_kategori_spek.id_t_katspek','inner');
		$this->datatables->join('t_nama_parameter','t_parameter_monitoring.nama_parameter_monitoring = t_nama_parameter.id_t_nama_parameter','inner');
		$this->datatables->where('no_db_spek_monitoring',$where);
		$this->datatables->from($this->table);

		return print_r($this->datatables->generate());
	}

	public function add_options_2nd(){
		$data_1 = $this->input->get('data_1');
		$record = $this->model_crud->get_one('t_nama_parameter','id_kat_spek',$data_1)->result();
		foreach ($record as $info) {
			$data['nama_parameter'][] = $info->nama_parameter;
			$data['id_t_nama_parameter'][] = $info->id_t_nama_parameter;
		}
		if (!empty($data)) {
			echo json_encode($data);}
		else{
			echo '0';}
	}

}

/* End of file spek.php */
/* Location: ./application/controllers/spek.php */