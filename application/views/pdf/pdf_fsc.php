<?php

fpdf();
// Header
foreach($read->result() as $r) {
	$pdf=new FPDF();
	$pdf->AddPage();
	$pdf->SetTitle('Label ISM');
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(95,8,'PT. NUTRIFOOD INDONESIA','LT');
	$pdf->Cell(95,8,'KODE FORM : F.S.11205','RT',1,'R');
	$pdf->SetFont('Arial','I',13);
	$pdf->Cell(0,25,'                                                 IDENTITAS SUPPORTING MATERIAL (ISM)','RL',1,'L');
	$pdf->Cell(0,5,'','LBR',1,'C');
	$pdf->Image('assets/icon_pdf.png',20,18,30);
	$pdf->Cell(0,10,'','LR',1,'C');
	$pdf->SetFont('Arial','',11);
	$pdf->Cell(70,10,'                    NAMA BAHAN','L',0,'L');
	$pdf->Cell(15,10,':','0',0,'L');
	$pdf->Cell(80,10,'  '.$r->nama_bahan,'1',0,'L');
	$pdf->Cell(0,10,'','R',1,'');
	$pdf->Cell(0,5,'','LR',1,'');
	$pdf->Cell(70,10,'                    KODE ITEM','L',0,'L');
	$pdf->Cell(15,10,':','0',0,'L');
	$pdf->Cell(80,10,'  '.$r->kode_oracle,'1',0,'L');
	$pdf->Cell(0,10,'','R',1,'');
	$pdf->Cell(0,5,'','LR',1,'');
	$pdf->Cell(70,10,'                    TANGGAL DATANG','L',0,'L');
	$pdf->Cell(15,10,':','0',0,'L');
	$pdf->Cell(80,10,'  '.$r->tanggal_datang,'1',0,'L');
	$pdf->Cell(0,10,'','R',1,'');
	$pdf->Cell(0,5,'','LR',1,'');
	$pdf->Cell(70,10,'                    JUMLAH DATANG','L',0,'L');
	$pdf->Cell(15,10,':','0',0,'L');
	$pdf->Cell(80,10,'  '.$r->jumlah,'1',0,'L');
	$pdf->Cell(0,10,'','R',1,'');
	$pdf->Cell(0,5,'','LR',1,'');
	$pdf->Cell(70,10,'                    SATUAN','L',0,'L');
	$pdf->Cell(15,10,':','0',0,'L');
	$pdf->Cell(80,10,'  '.$r->satuan,'1',0,'L');
	$pdf->Cell(0,10,'','R',1,'');
	$pdf->Cell(0,5,'','LR',1,'');
	$pdf->Cell(70,10,'                    LOT / KODE PRODUKSI','L',0,'L');
	$pdf->Cell(15,10,':','0',0,'L');
	$pdf->Cell(80,10,'  '.$r->kode_produksi,'1',0,'L');
	$pdf->Cell(0,10,'','R',1,'');
	$pdf->Cell(0,5,'','LR',1,'');
	$pdf->Cell(70,10,'                    EXPIRED DATE','L',0,'L');
	$pdf->Cell(15,10,':','0',0,'L');
	$pdf->Cell(80,10,'  '.$r->tanggal_exp,'1',0,'L');
	$pdf->Cell(0,10,'','R',1,'');
	$pdf->Cell(0,5,'','LR',1,'');
	$pdf->Cell(70,10,'                    STATUS QC','L',0,'L');
	$pdf->Cell(15,10,':','0',0,'L');
	$pdf->Cell(80,10,'  '.$r->status_qc,'1',0,'L');
	$pdf->Cell(0,10,'','R',1,'');
	$pdf->Cell(0,10,'','LRB',1,'');
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(0,5,'','LR',1,'R');
	$pdf->Cell(0,5,'Revisi/Berlaku : 01/21.03.2012   ','LR',1,'R');
	$pdf->Cell(0,5,'Lama simpan : mengikuti fisik bahan   ','LR',1,'R');
	$pdf->Cell(0,5,'','LRB',1,'R');
	$pdf->Output('Label FSC', 'I');
}
?>