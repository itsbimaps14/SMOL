<?php

	function email_input_fscpsa($running_id=NULL){
		$CI =& get_instance();
		$data = $CI->db->query("
			SELECT kode_oracle,nama_bahan,satuan,t_kedatangan.*
			FROM t_kedatangan
			INNER JOIN t_db_spek ON t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek
			WHERE no_running_kedatangan = '$running_id'
		")->row_array();
		$email = get_email($data['plant'],'QC');
		$CI->email->set_mailtype("html");
		$CI->email->set_newline("\r\n");
		$CI->email->set_crlf("\r\n");
		$CI->email->from('SMOL_NFI@nutrifood.co.id', 'SMOL Application');
		$CI->email->to($email);
		
		/* Untuk Notifikasi ke QC saat ada inputan supporting material baru di FSC/PSA Dept */
		$CI->email->subject('Kedatangan Supporting Material baru No. '.$data['no_running_kedatangan']);
			$message  =	"<html><body>";
			$message .=	"<strong>Dear QC ".$data['plant'].",</strong><br><br><br>";
			$message .=	"Kami menginformasikan bahwa ada kedatangan supporting material baru dengan status ' Belum Analisa QC ' :<br><br>";
			$message .=	"<table rules='all' style='border: 1px solid #666;' cellpadding='10'>";
			$message .=	"<tr style='background: #eee;'><td><strong> Running Number </strong> </td><td> ".$data['no_running_kedatangan']."</td></tr>";
			$message .=	"<tr><td><strong> Tanggal Datang </strong> </td><td> ".$data['tanggal_datang']."</td></tr>";
			$message .=	"<tr><td><strong> Kode Item </strong> </td><td> ".$data['kode_oracle']."</td></tr>";
			$message .=	"<tr><td><strong> Nama Bahan </strong> </td><td> ".$data['nama_bahan']."</td></tr>";
			$message .=	"<tr><td><strong> No. Lot / Kode Produksi </strong> </td><td> ".$data['kode_produksi']."</td></tr>";
			$message .=	"<tr><td><strong> No. PO </strong> </td><td> ".$data['no_po']."</td></tr>";
			$message .=	"<tr><td><strong> Tanggal Status Dibutuhkan </strong> </td><td> ".$data['tanggal_dibutuhkan']."</td></tr>";
			$message .= "</table>";
			$message .= "<br>Untuk informasi detail, silahkan click link <a href='localhost/SMOL/belum_analisa'>disini.</a>";
			$message .= "<br>Kami sarankan untuk membuka link aplikasi menggunakan Mozilla Firefox / Google Chrome.<br><br>";
			$message .= "<br>Terimakasih,";
			$message .= "<br><strong>SMOL.";
			
		$CI->email->message($message);
		if (!$CI->email->send()) {
			show_error($CI->email->print_debugger());
		}
	}

	function email_tahanan_qc($running_id=NULL,$running_tahanan=NULL,$alasan=NULL){
		$CI =& get_instance();

		$data = $CI->db->query("
			SELECT kode_oracle,nama_bahan,satuan,t_kedatangan.*
			FROM t_kedatangan
			INNER JOIN t_db_spek ON t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek
			WHERE no_running_kedatangan = '$running_id'
		")->row_array();
		$email = get_email($data['plant'],'RD');
		$CI->email->set_mailtype("html");
		$CI->email->set_newline("\r\n");
		$CI->email->set_crlf("\r\n");
		$CI->email->from('SMOL_NFI@nutrifood.co.id', 'SMOL Application');
		$CI->email->to($email);

		/* Untuk Notifikasi ke RD saat ada inputan supporting material baru di FSC/PSA Dept */
		$CI->email->subject('Tahanann Supporting Material No. '.$running_tahanan);
			$message  =	"<html><body>";
			$message .=	"<strong>Dear RD Tahanan ".$data['plant'].",</strong><br><br><br>";
			$message .=	"Kami menginformasikan bahwa ada tahanan supporting material sebagai berikut :<br><br>";
			$message .=	"<table rules='all' style='border: 1px solid #666;' cellpadding='10'>";
			$message .=	"<tr style='background: #eee;'><td><strong> No Tahanan </strong> </td><td> ".$running_tahanan." </td></tr>";
			$message .=	"<tr><td><strong> Tanggal Datang </strong> </td><td> ".$data['tanggal_datang']." </td></tr>";
			$message .=	"<tr><td><strong> Kode Item </strong> </td><td> ".$data['kode_oracle']." </td></tr>";
			$message .=	"<tr><td><strong> Nama Bahan </strong> </td><td> ".$data['nama_bahan']." </td></tr>";
			$message .=	"<tr><td><strong> No. Lot / Kode Produksi </strong> </td><td> ".$data['kode_produksi']." </td></tr>";	
			$message .=	"<tr><td><strong> Alasan Penahanan </strong> </td><td> ".$alasan." </td></tr>";
			$message .= "</table>";
			$message .= "<br>Untuk informasi detail, silahkan click link <a href='localhost/SMOL/rd/view_proses'>disini.</a>";
			$message .= "<br>Kami sarankan untuk membuka link aplikasi menggunakan Mozilla Firefox / Google Chrome.<br><br>";
			$message .= "<br>Terimakasih,";
			$message .= "<br><strong>SMOL.";

			
		$CI->email->message($message);
		if (!$CI->email->send()) {
			show_error($CI->email->print_debugger());
		}
	}

	function email_tahanan_rd($no_running=NULL){
		$CI =& get_instance();

		$data = $CI->db->query("
			SELECT t_tahanan.*,kode_oracle,nama_bahan,satuan,t_kedatangan.*
			FROM t_tahanan
			INNER JOIN t_kedatangan ON t_tahanan.no_running_tahanan = t_kedatangan.running_tahanan
			INNER JOIN t_db_spek ON t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek
			WHERE no_running_tahanan = '$no_running'
		")->row_array();
		$email = get_email($data['plant'],'QC');
		$CI->email->set_mailtype("html");
		$CI->email->set_newline("\r\n");
		$CI->email->set_crlf("\r\n");
		$CI->email->from('SMOL_NFI@nutrifood.co.id', 'SMOL Application');
		$CI->email->to($email);

		/* Untuk Notifikasi ke QC saat ada inputan supporting material baru di FSC/PSA Dept */
		$CI->email->subject('Tahanann Supporting Material No. : '.$data['no_running_kedatangan'].', No.Tahanan : '.$no_running);
			$message  =	"<html><body>";
			$message .=	"<strong>Dear QC ".$data['plant'].",</strong><br><br><br>";
			$message .=	"Kami menginformasikan bahwa telah terbit status tahanan supporting material sebagai berikut :<br><br>";
			$message .=	"<table rules='all' style='border: 1px solid #666;' cellpadding='10'>";
			$message .=	"<tr style='background: #eee;'><td><strong> No Tahanan </strong> </td><td> ".$no_running." </td></tr>";
			$message .=	"<tr><td><strong> Tanggal Datang </strong> </td><td> ".$data['tanggal_datang']." </td></tr>";
			$message .=	"<tr><td><strong> Kode Item </strong> </td><td> ".$data['kode_oracle']." </td></tr>";
			$message .=	"<tr><td><strong> Nama Bahan </strong> </td><td> ".$data['nama_bahan']." </td></tr>";
			$message .=	"<tr><td><strong> No. Lot / Kode Produksi </strong> </td><td> ".$data['kode_produksi']." </td></tr>";
			$message .=	"<tr><td><strong> Alasan Penahanan </strong> </td><td> ".$data['alasan_tahanan']." </td></tr>";
			$message .=	"<tr><td><strong> Tindakan Koreksi </strong> </td><td> ".$data['tindakan_koreksi']." </td></tr>";
			$message .=	"<tr><td><strong> PIC </strong> </td><td> ".$data['pic1']." </td></tr>";
			$message .=	"<tr><td><strong> Tindakan Preventive </strong> </td><td> ".$data['tindakan_preventive']." </td></tr>";
			$message .=	"<tr><td><strong> PIC </strong> </td><td> ".$data['pic2']." </td></tr>";
			$message .=	"<tr><td><strong> Status Tahanan </strong> </td><td> ".$data['status_tahanan']." </td></tr>";
			$message .= "</table>";
			$message .= "<br>Untuk informasi detail, silahkan click link <a href='localhost/SMOL/qc'>disini.</a>";
			$message .= "<br>Kami sarankan untuk membuka link aplikasi menggunakan Mozilla Firefox / Google Chrome.<br><br>";
			$message .= "<br>Terimakasih,";
			$message .= "<br><strong>SMOL.";

			
		$CI->email->message($message);
		if (!$CI->email->send()) {
			show_error($CI->email->print_debugger());
		}
	}

	function email_release_ok($no_running=NULL,$status_release_qc=NULL){
		$CI =& get_instance();

		$data = $CI->db->query("
			SELECT kode_oracle,nama_bahan,satuan,t_kedatangan.*
			FROM t_kedatangan
			INNER JOIN t_db_spek ON t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek
			WHERE no_running_kedatangan = '$no_running'
		")->row_array();
		$email = get_email($data['plant'],'QC');
		$CI->email->set_mailtype("html");
		$CI->email->set_newline("\r\n");
		$CI->email->set_crlf("\r\n");
		$CI->email->from('SMOL_NFI@nutrifood.co.id', 'SMOL Application');
		$CI->email->to($email);

		/* Untuk Notifikasi ke QC saat ada inputan supporting material baru di FSC/PSA Dept */
		$CI->email->subject('Supporting Material No. '.$no_running.', Status Released QC "OK", "Reject", & "Released Partial"');
			$message  =	"<html><body>";
			$message .=	"<strong>Dear QC ".$data['plant'].",</strong><br><br><br>";
			$message .=	"Kami menginformasikan bahwa telah terbit status Released QC supporting material sebagai berikut :<br><br>";
			$message .=	"<table rules='all' style='border: 1px solid #666;' cellpadding='10'>";
			$message .=	"<tr style='background: #eee;'><td><strong> No </strong> </td><td> ".$no_running." </td></tr>";
			$message .=	"<tr><td><strong> Tanggal Datang </strong> </td><td> ".$data['tanggal_datang']." </td></tr>";
			$message .=	"<tr><td><strong> Kode Item </strong> </td><td> ".$data['kode_oracle']." </td></tr>";
			$message .=	"<tr><td><strong> Nama Bahan </strong> </td><td> ".$data['nama_bahan']." </td></tr>";
			$message .=	"<tr><td><strong> No. Lot / Kode Produksi </strong> </td><td> ".$data['kode_produksi']." </td></tr>";
			$message .=	"<tr><td><strong> Status Released QC </strong> </td><td> ".$status_release_qc." </td></tr>";
			$message .= "</table>";
			$message .= "<br>Untuk informasi detail, silahkan click link <a href='localhost/SMOL'>disini.</a>";
			$message .= "<br>Kami sarankan untuk membuka link aplikasi menggunakan Mozilla Firefox / Google Chrome.<br><br>";
			$message .= "<br>Terimakasih,";
			$message .= "<br><strong>SMOL.";

			
		$CI->email->message($message);
		if (!$CI->email->send()) {
			show_error($CI->email->print_debugger());
		}
	}

	function get_email($plant,$role){
		$CI =& get_instance();
		$mail = '';
		$data = $CI->db->query("
			SELECT email
			FROM t_kontak
			WHERE plant = '$plant' AND role = '$role'");
		foreach ($data->result() as $r) {
			if ($mail == '') {
				$mail = $mail.$r->email;
			}
			else{
				$mail = $mail.', '.$r->email;
			}
		}
		return $mail;
	}

	function reset_password($to,$nama,$user){
		$CI =& get_instance();

		$CI->email->set_mailtype("html");
		$CI->email->set_newline("\r\n");
		$CI->email->set_crlf("\r\n");
		$CI->email->from('SMOL_NFI@nutrifood.co.id', 'SMOL Application');
		$CI->email->to($to);

		// Message Mail
		$CI->email->subject('Password Account telah di Reset oleh Admin');
		$message  =	"<html><body>";
		$message .=	"<strong>Dear ".$nama.",</strong><br><br><br>";
		$message .=	"Kami menginformasikan bahwa account anda dengan username ".$user." telah direset password oleh admin :<br><br>";
		$message .=	"<table rules='all' style='border: 1px solid #666;' cellpadding='10'>";
		$message .=	"<tr style='background: #eee;'><td><strong> New Password :</strong> </td><td> ".$user. "</td></tr>";
		$message .= "</table>";
		$message .= "<br><strong>Silahkan login dengan password baru di <a href='localhost/SMOL'>sini.</a><br><br>";

		$CI->email->message($message);
		if (!$CI->email->send()) {
			show_error($CI->email->print_debugger());
		}
		else{
			$CI->session->set_flashdata('msg_edit_success','Password berhasil direset!');
			redirect('user');
		}
	}

	function permintaan_gudang($running=NULL){
		$CI =& get_instance();

		$data = $CI->db->query("
			SELECT t_permintaan.*, kode_oracle, nama_bahan
			FROM t_permintaan
			INNER JOIN t_db_spek ON t_permintaan.id_db_spek = t_db_spek.id_t_dbspek
			WHERE running_permintaan = '$running'
		")->row_array();
		$email = get_email($data['plant'],'GUDANG');
		$CI->email->set_mailtype("html");
		$CI->email->set_newline("\r\n");
		$CI->email->set_crlf("\r\n");
		$CI->email->from('SMOL_NFI@nutrifood.co.id', 'SMOL Application');
		$CI->email->to($email);

		// Message Mail
		$CI->email->subject('Permintaan SM No. '.$running);
		$message  =	"<html><body>";
		$message .=	"<strong>Dear Gudang ".$data['plant'].",</strong><br><br><br>";
		$message .=	"Menginformasikan ada permintaan supporting material dari produksi yang harus diproses sbb :<br><br>";
		$message .=	"<table rules='all' style='border: 1px solid #666;' cellpadding='10'>";
		$message .=	"<tr style='background: #eee;'><td><strong> No </strong> </td><td> ".$running." </td></tr>";
		$message .=	"<tr><td><strong> Tanggal Permintaan </strong> </td><td> ".$data['tanggal_permintaan']." </td></tr>";
		$message .=	"<tr><td><strong> Kode Item </strong> </td><td> ".$data['kode_oracle']." </td></tr>";
		$message .=	"<tr><td><strong> Nama Bahan </strong> </td><td> ".$data['nama_bahan']." </td></tr>";
		$message .=	"<tr><td><strong> Jumlah yang diminta </strong> </td><td> ".$data['jumlah_permintaan']." </td></tr>";
		$message .= "</table>";
		$message .= "<br>Untuk informasi detail, silahkan click link <a href='".base_url()."gudang/proses/".$data['id_permintaan']."'>disini.</a>";
		$message .= "<br>Kami sarankan untuk membuka link aplikasi menggunakan Mozilla Firefox / Google Chrome.<br><br>";
		$message .= "<br>Terimakasih,";
		$message .= "<br><strong>SMOL.";

		$CI->email->message($message);
		if (!$CI->email->send()) {
			show_error($CI->email->print_debugger());
		}
	}

	function email_all_ok($no_running=NULL,$status_release_qc=NULL){
		$CI =& get_instance();

		$data = $CI->db->query("
			SELECT kode_oracle,nama_bahan,satuan,t_kedatangan.*
			FROM t_kedatangan
			INNER JOIN t_db_spek ON t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek
			WHERE no_running_kedatangan = '$no_running'
		")->row_array();
		$email = email_ok($data['plant']);
		$CI->email->set_mailtype("html");
		$CI->email->set_newline("\r\n");
		$CI->email->set_crlf("\r\n");
		$CI->email->from('SMOL_NFI@nutrifood.co.id', 'SMOL Application');
		$CI->email->to($email);

		/* Untuk Notifikasi ke QC saat ada inputan supporting material baru di FSC/PSA Dept */
		$CI->email->subject('Supporting Material No. '.$no_running.', Telah Selesai Diproses');
			$message  =	"<html><body>";
			$message .=	"<strong>Dear QC dan Gudang ".$data['plant'].",</strong><br><br><br>";
			$message .=	"Kami menginformasikan bahwa telah selesai diproses oleh QC supporting material sebagai berikut :<br><br>";
			$message .=	"<table rules='all' style='border: 1px solid #666;' cellpadding='10'>";
			$message .=	"<tr style='background: #eee;'><td><strong> No </strong> </td><td> ".$no_running." </td></tr>";
			$message .=	"<tr><td><strong> Tanggal Datang </strong> </td><td> ".$data['tanggal_datang']." </td></tr>";
			$message .=	"<tr><td><strong> Kode Item </strong> </td><td> ".$data['kode_oracle']." </td></tr>";
			$message .=	"<tr><td><strong> Nama Bahan </strong> </td><td> ".$data['nama_bahan']." </td></tr>";
			$message .=	"<tr><td><strong> No. Lot / Kode Produksi </strong> </td><td> ".$data['kode_produksi']." </td></tr>";
			$message .=	"<tr><td><strong> Status QC </strong> </td><td> ".$status_release_qc." </td></tr>";
			$message .= "</table>";
			$message .= "<br>Untuk informasi detail, silahkan click link <a href='localhost/SMOL'>disini.</a>";
			$message .= "<br>Kami sarankan untuk membuka link aplikasi menggunakan Mozilla Firefox / Google Chrome.<br><br>";
			$message .= "<br>Terimakasih,";
			$message .= "<br><strong>SMOL.";

			
		$CI->email->message($message);
		if (!$CI->email->send()) {
			show_error($CI->email->print_debugger());
		}
	}

	function email_daftar($data){
		$CI =& get_instance();

		$email = $CI->db->query("
			SELECT email
			FROM t_user
			WHERE level = 'admin'
		")->row_array();
		$email = $email['email'];

		$CI->email->set_mailtype("html");
		$CI->email->set_newline("\r\n");
		$CI->email->set_crlf("\r\n");
		$CI->email->from('SMOL_NFI@nutrifood.co.id', 'SMOL Application');
		$CI->email->to($email);

		/* Untuk Notifikasi ke QC saat ada inputan supporting material baru di FSC/PSA Dept */
		$CI->email->subject('Request Daftar '.$data['username']);
			$message  =	"<html><body>";
			$message .=	"<strong>Dear Admin, Request Daftar</strong><br><br><br>";
			$message .=	"<table rules='all' style='border: 1px solid #666;' cellpadding='10'>";
			$message .=	"<tr style='background: #eee;'><td><strong> Username </strong> </td><td> ".$data['username']." </td></tr>";
			$message .=	"<tr><td><strong> Password </strong> </td><td> ".$data['password']." </td></tr>";
			$message .=	"<tr><td><strong> Departemen </strong> </td><td> ".$data['dept']." </td></tr>";
			$message .=	"<tr><td><strong> Plant </strong> </td><td> ".$data['plant']." </td></tr>";
			$message .= "</table>";
			$message .= "<br>Terimakasih,";
			$message .= "<br><strong>SMOL.";

			
		$CI->email->message($message);
		if (!$CI->email->send()) {
			show_error($CI->email->print_debugger());
		}
	}

	function email_ok($plant){
		$CI =& get_instance();
		$mail = '';
		$data = $CI->db->query("
			SELECT email
			FROM t_kontak
			WHERE plant = '$plant' AND (role = 'QC' OR role = 'GUDANG')");
		foreach ($data->result() as $r) {
			if ($mail == '') {
				$mail = $mail.$r->email;
			}
			else{
				$mail = $mail.', '.$r->email;
			}
		}
		return $mail;
	}
?>