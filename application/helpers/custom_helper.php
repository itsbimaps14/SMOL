<?php

	// My Helper Function
	function auto_no_dbs(){
		$tahun = date('Y');
		$CI =& get_instance();
		$record = $CI->db->query("SELECT MAX(left(no_db_spek,3)) as kode FROM t_db_spek");
		foreach($record->result() as $r) {
				$kode = $r->kode;
		}
		if(empty($kode)) {
				$no_db_spek = "001/DBS/$tahun";
		}
		else {
				$no = $kode + 1;
				$no = str_pad($no, 3, '0', STR_PAD_LEFT);
				$no_db_spek = "$no/DBS/$tahun";
		}
		return $no_db_spek;
	}

	function auto_no_fsc(){
		$bulan = date('m');
		$tahun = date('Y');
		$CI =& get_instance();
		$lokasi = $CI->session->userdata('plant');
		$lokasi = strtoupper($lokasi);
		$record = $CI->db->query("SELECT MAX(left(no_running_kedatangan,3)) as kode FROM t_kedatangan WHERE plant = '$lokasi' AND RIGHT(no_running_kedatangan,4) = '$tahun'");
		foreach($record->result() as $r) {
				$kode = $r->kode;
		}
		if(empty($kode)) {
				$no_db_spek = "001/$lokasi/$bulan/$tahun";
		}
		else {
				$no = $kode + 1;
				$no = str_pad($no, 3, '0', STR_PAD_LEFT);
				$no_db_spek = "$no/$lokasi/$bulan/$tahun";
		}
		return $no_db_spek;
	}

	function auto_no_thn(){
		$bulan = date('m');
		$tahun = date('Y');
		$CI =& get_instance();
		$lokasi = $CI->session->userdata('plant');
		$lokasi = strtoupper($lokasi);
		$record = $CI->db->query("SELECT MAX(left(no_running_tahanan,3)) as kode FROM t_tahanan WHERE plant_tahanan = '$lokasi' AND RIGHT(no_running_tahanan,4) = '$tahun'");
		foreach($record->result() as $r) {
				$kode = $r->kode;
		}
		if(empty($kode)) {
				$no_db_spek = "001/RKSM/$lokasi/$bulan/$tahun";
		}
		else {
				$no = $kode + 1;
				$no = str_pad($no, 3, '0', STR_PAD_LEFT);
				$no_db_spek = "$no/RKSM/$lokasi/$bulan/$tahun";
		}
		return $no_db_spek;
	}

	function auto_no_spb(){
		$bulan = date('m');
		$tahun = date('Y');
		$CI =& get_instance();
		$lokasi = $CI->session->userdata('plant');
		$lokasi = strtoupper($lokasi);
		$record = $CI->db->query("SELECT MAX(left(no_running_spb,3)) as kode FROM t_spb WHERE plant = '$lokasi' AND RIGHT(no_running_spb,4) = '$tahun'");
		foreach($record->result() as $r) {
				$kode = $r->kode;
		}
		if(empty($kode)) {
				$no_db_spek = "001/SPB/SM/$lokasi/$bulan/$tahun";
		}
		else {
				$no = $kode + 1;
				$no = str_pad($no, 3, '0', STR_PAD_LEFT);
				$no_db_spek = "$no/SPB/SM/$lokasi/$bulan/$tahun";
		}
		return $no_db_spek;
	}
	
	function after ($this, $inthat){
		if (!is_bool(strpos($inthat, $this)))
        	return substr($inthat, strpos($inthat,$this)+strlen($this));
	};

	function before ($this, $inthat){
		return substr($inthat, 0, strpos($inthat, $this));
	};
	
	function auto_get_options($table,$column,$queryplus){
		$CI =& get_instance();
		$record = $CI->db->query("SELECT $column FROM $table $queryplus");
        return $record->result_array();
	}

	function cek_dept($dept){
		$CI =& get_instance();
		$session_dept = $CI->session->userdata('dept');
		if($session_dept != $dept AND $session_dept != 'admin') {
			redirect('dashboard/index');
		}
	}

	function cek_session(){
		$CI =& get_instance();
		$session = $CI->session->userdata('status_login');
		if($session!=1) {
			redirect('auth/login');
		}
	}

	function cek_session_login(){
		$CI =& get_instance();
		$session = $CI->session->userdata('status_login');
		if($session==1) {
			redirect('dashboard/index');
		}
	}

	function cek_level(){
		$CI =& get_instance();
		$session_level = $CI->session->userdata('level');
		if($session_level!='admin') {
			redirect('dashboard/index');
		}
	}

	function cek_menu($menu){
		$CI =& get_instance();
		$session_username = $CI->session->userdata('username');
		$session_level = $CI->session->userdata('level');
		if($session_username!=$menu && $session_level=='user') {
			redirect('dashboard/index');
		}
	}

	function get_status_psa($status_psa){
		switch ($status_psa) {
			case 'Belum Analisa QC':
				$data = 'label-success';
				break;

			case 'Analisa QC':
				$data = 'label-info';
				break;

			case 'Tahanan':
				$data = 'label-warning';
				break;

			case 'Released Partial':
				$data = 'label-default';
				break;

			case 'OK Pending Monitoring':
				$data = 'label-primary';
				break;

			case 'OK':
				$data = 'label-success';
				break;

			case 'OK Closed':
				$data = 'label-success';
				break;

			case 'Reject':
				$data = 'label-danger';
				break;

			case 'Reject Closed':
				$data = 'label-danger';
				break;

			case 'OK Bersyarat':
				$data = 'label-warning';
				break;

			default:
				$data = 'label-danger';
				break;
		}
		return $data;
	}

	function rows_user(){
		$CI =& get_instance();
		$jumlah = $CI->db->query("
			SELECT *
			FROM t_user")->num_rows();

		return $jumlah;
	}

	function data_proses($filter){
		$CI =& get_instance();
		$dept  = $CI->session->userdata('dept');
		$plant = $CI->session->userdata('plant');

		switch ($filter) {
			case 'Belum Analisa QC':
				if ($dept == 'admin') {
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE status_all = 'Belum Analisa QC'
					")->num_rows();
				}
				else{
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE status_all = 'Belum Analisa QC' AND plant = '$plant'
					")->num_rows();
				}
			break;

			case 'Analisa QC':
				if ($dept == 'admin') {
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE status_all = 'Analisa QC'
					")->num_rows();
				}
				else{
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE status_all = 'Analisa QC' AND plant = '$plant'
					")->num_rows();
				}
			break;

			case 'Tahanan':
				if ($dept == 'admin') {
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE status_all = 'Tahanan' OR status_all = 'Tahanan RD' 
					")->num_rows();
				}
				else{
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE (status_all = 'Tahanan' OR status_all = 'Tahanan RD') AND plant = '$plant'
					")->num_rows();
				}
			break;

			case 'OK Pending Monitoring':
				if ($dept == 'admin') {
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE status_all = 'OK Pending Monitoring'
					")->num_rows();
				}
				else{
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE status_all = 'OK Pending Monitoring' AND plant = '$plant'
					")->num_rows();
				}
			break;
		}

		if ($jumlah > 0) {
			$data['text'] = $jumlah.' DATA NEED TO PROCESS ON';
			$data['fa'] = '<i class="fa fa-exclamation-circle dashboard-div-icon"></i>';
		}
		else {
			$data['text'] = 'NO DATA NEED TO PROCESS ON';
			$data['fa'] = '<i class="fa fa-check-circle dashboard-div-icon"></i>';
		}

		return $data;
	}

	function psa_data_proses($status){
		$CI =& get_instance();
		$dept  = $CI->session->userdata('dept');
		$plant = $CI->session->userdata('plant');

		switch ($status) {
			case 'Belum Analisa QC':
				if ($dept == 'admin') {
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE status_all = 'Belum Analisa QC'
					")->num_rows();
				}
				else{
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE status_all = 'Belum Analisa QC' AND plant = '$plant'
					")->num_rows();
				}
				$data['text1'] = $jumlah.' DATA KEDATANGAN';
				$data['text2'] = ' MENUNGGU DIPROSES QC';
				$data['fa'] = '<i class="fa fa-clock-o dashboard-div-icon"></i>';
			break;

			case 'Prosess':
				if ($dept == 'admin') {
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE status_all = 'Analisa QC' OR status_all = 'Tahanan' OR status_all = 'Tahanan RD' OR status_all = 'Released Partial' OR status_all = 'OK Pending Monitoring'
					")->num_rows();
				}
				else{
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE (status_all = 'Analisa QC' OR status_all = 'Tahanan' OR status_all = 'Tahanan RD' OR status_all = 'Released Partial' OR status_all = 'OK Pending Monitoring') AND plant = '$plant'
					")->num_rows();
				}
				$data['text1'] = $jumlah.' DATA KEDATANGAN';
				$data['text2'] = ' SEDANG DIPROSES OLEH QC';
				$data['fa'] = '<i class="fa fa-tasks dashboard-div-icon"></i>';
			break;

			case 'OK':
				if ($dept == 'admin') {
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE status_all = 'OK Closed' OR status_all = 'OK Bersyarat' 
					")->num_rows();
				}
				else{
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE (status_all = 'OK Closed' OR status_all = 'OK Bersyarat') AND plant = '$plant'
					")->num_rows();
				}
				$data['text1'] = $jumlah.' DATA KEDATANGAN';
				$data['text2'] = ' TELAH DIPROSES OLEH QC';
				$data['fa'] = '<i class="fa fa-check dashboard-div-icon"></i>';
			break;

			case 'Reject':
				if ($dept == 'admin') {
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE status_all = 'Reject'
					")->num_rows();
				}
				else{
					$jumlah = $CI->db->query("
						SELECT *
						FROM t_kedatangan
						WHERE status_all = 'Reject' AND plant = '$plant'
					")->num_rows();
				}
				$data['text1'] = $jumlah.' DATA KEDATANGAN';
				$data['text2'] = ' TELAH DIPROSES OLEH QC';
				$data['fa'] = '<i class="fa fa-times dashboard-div-icon"></i>';
			break;
		}
		return $data;
	}

	function get_nilai_dash_tahanan($filter){
		$CI =& get_instance();
		$dept  = $CI->session->userdata('dept');
		$plant = $CI->session->userdata('plant');
		if ($dept == 'admin') {
			$jumlah = $CI->db->query("
				SELECT *
				FROM t_kedatangan
				WHERE status_all = '$filter'
			")->num_rows();
		}
		else{
			$jumlah = $CI->db->query("
				SELECT *
				FROM t_kedatangan
				WHERE status_all = '$filter' AND plant = '$plant'
			")->num_rows();
		}
		$data['text'] = $jumlah.' DATA KEDATANGAN';
		$data['fa'] = '<i class="fa fa-check dashboard-div-icon"></i>';
		return $data;
	}

	function get_data_table_release($id,$running){
		$CI =& get_instance();
		$hasil = $CI->db->query("
			SELECT id_analisa_qc_release,id_t_parameter_release, kat_spek, nama_parameter, periode_analisa_release, titik_sampling_release, nilai_spek_release, analisa_qc_release
			FROM t_kedatangan
			INNER JOIN t_db_spek ON t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek
			INNER JOIN t_parameter_release ON t_db_spek.no_db_spek = t_parameter_release.no_db_spek_release
			INNER JOIN t_kategori_spek ON t_parameter_release.kategori_spek_release = t_kategori_spek.id_t_katspek
			INNER JOIN t_nama_parameter ON t_parameter_release.nama_parameter_release = t_nama_parameter.id_t_nama_parameter
			INNER JOIN t_analisa_qc_release ON t_parameter_release.id_t_parameter_release = t_analisa_qc_release.id_parameter_release
			WHERE id_t_kedatangan = '$id' AND t_analisa_qc_release.no_running_kedatangan = '$running'
			")->result();

		return $hasil;
	}

	function get_data_table_monitoring($id,$running){
		$CI =& get_instance();
		$hasil = $CI->db->query("
			SELECT id_analisa_qc_monitoring,id_t_parameter_monitoring, kat_spek, nama_parameter, periode_analisa_monitoring, titik_sampling_monitoring, nilai_spek_monitoring, analisa_qc_monitoring
			FROM t_kedatangan
			INNER JOIN t_db_spek ON t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek
			INNER JOIN t_parameter_monitoring ON t_db_spek.no_db_spek = t_parameter_monitoring.no_db_spek_monitoring
			INNER JOIN t_kategori_spek ON t_parameter_monitoring.kategori_spek_monitoring = t_kategori_spek.id_t_katspek
			INNER JOIN t_nama_parameter ON t_parameter_monitoring.nama_parameter_monitoring = t_nama_parameter.id_t_nama_parameter
			INNER JOIN t_analisa_qc_monitoring ON t_parameter_monitoring.id_t_parameter_monitoring = t_analisa_qc_monitoring.id_parameter_monitoring
			WHERE id_t_kedatangan = '$id' AND t_analisa_qc_monitoring.no_running_kedatangan = '$running'
			")->result();

		return $hasil;
	}

	function rows_kontak(){
		$CI =& get_instance();
		$jumlah = $CI->db->query("
			SELECT *
			FROM t_kontak")->num_rows();

		return $jumlah;
	}

	function rows_total(){
		$CI =& get_instance();
		$jumlah = $CI->db->query("
			SELECT *
			FROM t_db_spek")->num_rows();

		return $jumlah;
	}

	function rows_aktif(){
		$CI =& get_instance();
		$jumlah = $CI->db->query("
			SELECT *
			FROM t_db_spek
			WHERE status_top = 'Top'
			")->num_rows();

		return $jumlah;
	}

	function rows_permintaan(){
		$CI =& get_instance();
		$jumlah = $CI->db->query("
			SELECT *
			FROM t_permintaan
			WHERE status = 'Belum Proses'
			")->num_rows();

		return $jumlah;
	}

	function rows_penerimaan(){
		$CI =& get_instance();
		$jumlah = $CI->db->query("
			SELECT *
			FROM t_permintaan
			WHERE status = 'Proses'
			")->num_rows();

		return $jumlah;
	}

	function rows_stoktotal(){
		$CI =& get_instance();
		$jumlah = $CI->db->query("
			SELECT sum(stok) as jumlah
			FROM t_gudang_produksi
			")->row_array();

		return $jumlah['jumlah'];
	}

	function rows_transaksi(){
		$tahun = date('Y');
		$bulan = date('m');
		$date = $tahun.'-'.$bulan;
		$CI =& get_instance();
		$jumlah = $CI->db->query("
			SELECT *
			FROM t_log_gudang_p
			WHERE tanggal LIKE '$date%'
			")->num_rows();

		return $jumlah;
	}

?>