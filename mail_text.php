// Message Email


		/* Untuk Notifikasi ke QC saat ada inputan supporting material baru di FSC/PSA Dept
		$this->email->subject('Kedatangan Supporting Material baru No. '.$data['username']);
		$message  =	"<html><body>";
		$message .=	"<strong>Dear QC,</strong><br><br><br>";
		$message .=	"Kami menginformasikan bahwa ada kedatangan supporting material baru dengan status ' Belum Analisa QC ' :<br><br>";
		$message .=	"<table rules='all' style='border: 1px solid #666;' cellpadding='10'>";
		$message .=	"<tr style='background: #eee;'><td><strong> Running Number </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Tanggal Datang </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Kode Item </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Nama Bahan </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> No. Lot / Kode Produksi </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> No. PO </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Tanggal Status Dibutuhkan </strong> </td><td> ".$data['username']."</td></tr>";
		$message .= "</table>";
		$message .= "<br>Untuk informasi detail, silahkan click link <a href='localhost/SMOL'>disini.</a>";
		$message .= "<br>Kami sarankan untuk membuka link aplikasi menggunakan Mozilla Firefox / Google Chrome.<br><br>";
		$message .= "<br>Terimakasih,";
		$message .= "<br><strong>SMOL.";
		*/

		/* Untuk Notifikasi jika status "Tahanan"
		$this->email->subject('Tahanann Supporting Material No. '.$data['username']);
		$message  =	"<html><body>";
		$message .=	"<strong>Dear,</strong><br><br><br>";
		$message .=	"Kami menginformasikan bahwa ada tahanan supporting material sebagai berikut :<br><br>";
		$message .=	"<table rules='all' style='border: 1px solid #666;' cellpadding='10'>";
		$message .=	"<tr style='background: #eee;'><td><strong> No Tahanan </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Tanggal Datang </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Kode Item </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Nama Bahan </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> No. Lot / Kode Produksi </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Alasan Penahanan </strong> </td><td> ".$data['username']."</td></tr>";
		$message .= "</table>";
		$message .= "<br>Untuk informasi detail, silahkan click link <a href='localhost/SMOL'>disini.</a>";
		$message .= "<br>Kami sarankan untuk membuka link aplikasi menggunakan Mozilla Firefox / Google Chrome.<br><br>";
		$message .= "<br>Terimakasih,";
		$message .= "<br><strong>SMOL.";
		*/

		/* Untuk Notifikasi jika status "Balasan Tahanan"
		$this->email->subject('Tahanann Supporting Material No. : '.$data['username'].', No.Tahanan : '.$data['username']);
		$message  =	"<html><body>";
		$message .=	"<strong>Dear,</strong><br><br><br>";
		$message .=	"Kami menginformasikan bahwa telah terbit status tahanan supporting material sebagai berikut :<br><br>";
		$message .=	"<table rules='all' style='border: 1px solid #666;' cellpadding='10'>";
		$message .=	"<tr style='background: #eee;'><td><strong> No Tahanan </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Tanggal Datang </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Kode Item </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Nama Bahan </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> No. Lot / Kode Produksi </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Alasan Penahanan </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Tindakan Koreksi </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> PIC </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Tindakan Preventive </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> PIC </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Status Tahanan </strong> </td><td> ".$data['username']."</td></tr>";
		$message .= "</table>";
		$message .= "<br>Untuk informasi detail, silahkan click link <a href='localhost/SMOL'>disini.</a>";
		$message .= "<br>Kami sarankan untuk membuka link aplikasi menggunakan Mozilla Firefox / Google Chrome.<br><br>";
		$message .= "<br>Terimakasih,";
		$message .= "<br><strong>SMOL.";
		*/

		/* Notifikasi jika status Released QC "OK", "Reject", "Released Partial"
		$this->email->subject('Supporting Material No. '.$data['username'].', Status Released QC "OK", "Reject", & "Released Partial"');
		$message  =	"<html><body>";
		$message .=	"<strong>Dear,</strong><br><br><br>";
		$message .=	"Kami menginformasikan bahwa telah terbit status Released QC supporting material sebagai berikut :<br><br>";
		$message .=	"<table rules='all' style='border: 1px solid #666;' cellpadding='10'>";
		$message .=	"<tr style='background: #eee;'><td><strong> No </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Tanggal Datang </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Kode Item </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Nama Bahan </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> No. Lot / Kode Produksi </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Status Released QC </strong> </td><td> ".$data['username']."</td></tr>";
		$message .= "</table>";
		$message .= "<br>Untuk informasi detail, silahkan click link <a href='localhost/SMOL'>disini.</a>";
		$message .= "<br>Kami sarankan untuk membuka link aplikasi menggunakan Mozilla Firefox / Google Chrome.<br><br>";
		$message .= "<br>Terimakasih,";
		$message .= "<br><strong>SMOL.";
		*/

		/* Notifikasi jika ada permintaaan SM dari Produksi ke Gudang
		$this->email->subject('Permintaan Supporting Material No. '.$data['username']);
		$message  =	"<html><body>";
		$message .=	"<strong>Dear Gudang,</strong><br><br><br>";
		$message .=	"Kami menginformasikan bahwa ada permintaan supporting material dari produksi yang harus segera diproses sebagai berikut :<br><br>";
		$message .=	"<table rules='all' style='border: 1px solid #666;' cellpadding='10'>";
		$message .=	"<tr style='background: #eee;'><td><strong> No </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Tanggal Permintaan </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Kode Item </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Nama Bahan </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Jumlah yang diminta </strong> </td><td> ".$data['username']."</td></tr>";
		$message .= "</table>";
		$message .= "<br>Untuk informasi detail, silahkan click link <a href='localhost/SMOL'>disini.</a>";
		$message .= "<br>Kami sarankan untuk membuka link aplikasi menggunakan Mozilla Firefox / Google Chrome.<br><br>";
		$message .= "<br>Terimakasih,";
		$message .= "<br><strong>SMOL.";
		*/

		/* Notifikasi jika permintaaan SM sudah diproses
		$this->email->subject('Permintaan Supporting Material No. '.$data['username']);
		$message  =	"<html><body>";
		$message .=	"<strong>Dear Gudang,</strong><br><br><br>";
		$message .=	"Kami menginformasikan bahwa ada permintaan supporting material dari produksi yang harus segera diproses sebagai berikut :<br><br>";
		$message .=	"<table rules='all' style='border: 1px solid #666;' cellpadding='10'>";
		$message .=	"<tr style='background: #eee;'><td><strong> No </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Tanggal Permintaan </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Kode Item </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Nama Bahan </strong> </td><td> ".$data['username']."</td></tr>";
		$message .=	"<tr><td><strong> Jumlah yang diminta </strong> </td><td> ".$data['username']."</td></tr>";
		$message .= "</table>";
		$message .= "<br>Untuk informasi detail, silahkan click link <a href='localhost/SMOL'>disini.</a>";
		$message .= "<br>Kami sarankan untuk membuka link aplikasi menggunakan Mozilla Firefox / Google Chrome.<br><br>";
		$message .= "<br>Terimakasih,";
		$message .= "<br><strong>SMOL.";
		*/

		/* Untuk Change Password
		$this->email->subject('Password Account telah di Reset oleh Admin');
		$message  =	"<html><body>";
		$message .=	"<strong>Dear ".$data['nama'].",</strong><br><br><br>";
		$message .=	"Kami menginformasikan bahwa account anda dengan username ".$data['username']." telah direset password oleh admin :<br><br>";
		$message .=	"<table rules='all' style='border: 1px solid #666;' cellpadding='10'>";
		$message .=	"<tr style='background: #eee;'><td><strong> New Password :</strong> </td><td> ".$data['username']. "</td></tr>";
		$message .= "</table>";
		$message .= "<br><strong>Silahkan login dengan password baru di <a href='localhost/SMOL'>sini.</a><br><br>";
		*/