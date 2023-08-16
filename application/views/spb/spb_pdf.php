<?php

switch ($record['receipt_oracle']) {
	case 'Sudah':
		$sudah = 'YA';
		$belum = '';
		break;
	
	case 'Belum':
		$sudah = '';
		$belum = 'YA';
		break;
}

fpdf();
// Header
	$pdf=new FPDF('L','mm','LEGAL');
	$pdf->AddPage();
	$pdf->SetTitle('SPB - '.$record['running_spb']);
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(95,8,'PT. NUTRIFOOD INDONESIA',0);
	$pdf->Cell(0,8,'KODE FORM : F.P.5A303',0,1,'R');
	$pdf->SetFont('Arial','I',13);
	$pdf->Cell(0,12,'SURAT PENOLAKAN BARANG (SPB)',0,1,'C');
	$pdf->Cell(0,5,'','B',1,'C');
	$pdf->Image('assets/icon_pdf.png',25,18,15);
// End of Header

// Bagian Kepala
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(60,6,' Receipt Oracle :','L',0);
	$pdf->Cell(20,6,$sudah,'LRB',0,'C');
	$pdf->Cell(35,6,' Sudah dilakukan','RB',0);
	$pdf->Cell(93,6,'',0,0);
	$pdf->Cell(30,6,' No. SPB','LRB',0);
	$pdf->Cell(0,6,' '.$record['running_spb'],'RB',1);
	$pdf->Cell(60,6,'','L',0);
	$pdf->Cell(20,6,$belum,'LRB',0,'C');
	$pdf->Cell(35,6,' Belum dilakukan','RB',0);
	$pdf->Cell(93,6,'',0,0,'C');
	$pdf->Cell(30,6,' Tanggal','LRB',0);
	$pdf->Cell(0,6,' '.$record['tanggal_spb'],'RB',1);
	$pdf->Cell(208,6,'','L',0);
	$pdf->Cell(30,6,' Lampiran','LRB',0);
	$pdf->Cell(0,6,' ','RB',1);
	$pdf->Cell(0,2,'','LR',1,'R');
	$pdf->Cell(60,6,' No. Polisi Kendaraan )*','L',0);
	$pdf->Cell(20,6,'',0,0);
	$pdf->Cell(35,6,': '.$record['no_polisi'],0,0);
	$pdf->Cell(93,6,'',0,0);
	$pdf->Cell(30,6,' No. Seal',0,0);
	$pdf->Cell(0,6,': '.$record['no_seal'],'R',1);
	$pdf->Cell(60,6,' No. Jasa Pengiriman )**','L',0);
	$pdf->Cell(20,6,'',0,0);
	$pdf->Cell(35,6,': '.$record['no_jasa'],0,0);
	$pdf->Cell(93,6,'',0,0);
	$pdf->Cell(30,6,' Kondisi Seal',0,0);
	$pdf->Cell(0,6,': '.$record['kondisi_seal'],'R',1);
	$pdf->Cell(60,6,' No. Reel )**','L',0);
	$pdf->Cell(20,6,'',0,0);
	$pdf->Cell(35,6,': '.$record['no_reel'],0,0);
	$pdf->Cell(93,6,'',0,0);
	$pdf->Cell(30,6,' No. Container',0,0);
	$pdf->Cell(0,6,': '.$record['no_container'],'R',1);
	$pdf->Cell(0,2,'','LR',1,'R');
// End of Bagian Kepala

// Body
	//Table
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(10,12,'No.',1,0,'C');
	$pdf->Cell(35,12,'Kode Oracle.','TRB',0,'C');
	$pdf->Cell(35,12,'Nama Barang.','TRB',0,'C');
	$pdf->Cell(38,12,'Nama Pemasok.','TRB',0,'C');
	$pdf->Cell(30,12,'No. Po.','TRB',0,'C');
	$pdf->Cell(30,12,'Tgl. Datang.','TRB',0,'C');
	$pdf->Cell(30,12,'No. Lot.','TRB',0,'C');
	$pdf->Cell(25,12,"Jml. Datang",'TRB',0,'C');
	$pdf->Cell(0,6,'KETIDAKSESUAIAN.','TRB',2,'C');
	$pdf->SetFont('Arial','B',8);
	$pdf->Cell(34,6,'Jml. Ketidaksesuaian','RB',0,'C');
	$pdf->Cell(34,6,'Jml. Diterima','RB',0,'C');
	$pdf->Cell(0,6,'Jml. Ditolak','RB',1,'C');
	// Isi Table
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10,6,'1','RBL',0,'C');
	$pdf->Cell(35,6,$record['kode_oracle'],'RB',0,'C');
	$pdf->Cell(35,6,$record['nama_bahan'],'RB',0,'C');
	$pdf->Cell(38,6,$record['supplier'],'RB',0,'C');
	$pdf->Cell(30,6,$record['no_po'],'RB',0,'C');
	$pdf->Cell(30,6,$record['tanggal_datang'],'RB',0,'C');
	$pdf->Cell(30,6,$record['kode_produksi'],'RB',0,'C');
	$pdf->Cell(25,6,$record['jumlah'],'RB',0,'C');
	$pdf->Cell(34,6,$record['jumlah_tidaksesuai'],'RB',0,'C');
	$pdf->Cell(34,6,$record['jumlah_diterima'],'RB',0,'C');
	$pdf->Cell(0,6,$record['jumlah_ditolak'],'RB',1,'C');
	//Alasan 
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(0,6,'ALASAN DITOLAK','LRB',1,'C');
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(0,2,'','LR',1,'R');
	$pdf->Multicell(0,6,'        '.$record['alasan_ditolak'],'LR','J');
	$pdf->Cell(0,2,'','LRB',1,'R');
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(0,6,'ALASAN DIREVISI','LRB',1,'C');
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(0,2,'','LR',1,'R');
	$pdf->Multicell(0,6,'        '.$record['alasan_revisi'],'LR','J');
	$pdf->Cell(0,2,'','LRB',1,'R');
	//Retur
	$pdf->Cell(168,2,'','L',0);
	$pdf->Cell(0,2,'','LR',1);
	$pdf->Cell(25,6,'','L',0);
	$pdf->Cell(15,6,'',1,0);
	$pdf->Cell(10,6,'',0,0);
	$pdf->Cell(15,6,'RETUR DITERIMA.',0,0);
	$pdf->Cell(103,6,'','R',0);
	$pdf->Cell(25,6,'',0,0);
	$pdf->Cell(15,6,'',1,0);
	$pdf->Cell(10,6,'',0,0);
	$pdf->Cell(15,6,'RETUR DITOLAK.',0,0);
	$pdf->Cell(0,6,'','R',1);
	$pdf->Cell(168,3,'','L',0);
	$pdf->Cell(0,3,'','LR',1);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(25,6,'','L',0);
	$pdf->Cell(15,6,'',1,0);
	$pdf->Cell(10,6,'',0,0);
	$pdf->Cell(15,6,'Segera diambil di Jakarta / Ciawi.',0,0);
	$pdf->Cell(103,6,'','R',0);
	$pdf->Cell(25,6,'',0,0);
	$pdf->Cell(15,6,'Alasan :',0,0);
	$pdf->Cell(10,6,'',0,0);
	$pdf->Cell(0,6,'','R',1);
	$pdf->Cell(25,6,'','L',0);
	$pdf->Cell(15,6,'',1,0);
	$pdf->Cell(10,6,'',0,0);
	$pdf->Cell(15,6,'Retur segera diganti.',0,0);
	$pdf->Cell(103,6,'','R',0);
	$pdf->Cell(0,6,'','R',1);
	$pdf->Cell(25,6,'','L',0);
	$pdf->Cell(15,6,'',1,0);
	$pdf->Cell(10,6,'',0,0);
	$pdf->Cell(15,6,'Retur tidak diganti / potong tagihan.',0,0);
	$pdf->Cell(103,6,'','R',0);
	$pdf->Cell(0,6,'','R',1);
	$pdf->Cell(168,2,'','LB',0);
	$pdf->Cell(0,2,'','LBR',1);
	$pdf->Cell(0,2,'',0,1);
	//Kaki
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10,6,'',0,0);
	$pdf->Cell(100,6,'Diajukan oleh,',0,0,'C');
	$pdf->Cell(25,6,'',0,0,'C');
	$pdf->Cell(100,6,'Mengetahui,',0,0,'C');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(0,6,')* Jika ketidaksesuaian terjadi saat belum receipt di oracle.',0,1,'R');
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10,6,'',0,0);
	$pdf->Cell(100,6,'Tanggal :',0,0,'L');
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(0,6,')** Khusus untuh bahan kemas.',0,1,'R');
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(10,12,'',0,0);
	$pdf->Cell(100,12,'','B',0,'C');
	$pdf->Cell(25,12,'',0,0,'C');
	$pdf->Cell(100,12,'','B',0,'C');
	$pdf->Cell(0,12,'Revisi / Berlaku : 08/23.02.2017',0,1,'R');
	$pdf->Cell(10,6,'',0,0);
	$pdf->Cell(100,6,'(Quality Control Manager)',0,0,'C');
	$pdf->Cell(25,6,'',0,0,'C');
	$pdf->Cell(100,6,'Super Expedisi*',0,0,'C');
	$pdf->Cell(0,6,'Lama Simpan : 1 Tahun',0,1,'R');

	$pdf->SetCreator('Bima Putra S - SMOL');
	$pdf->SetAuthor('bimaputras.sz14@gmail.com - SMOL');
	$pdf->Output('Surat Penolakan Barang - '.$record['running_spb'].'.pdf', 'I');
?>