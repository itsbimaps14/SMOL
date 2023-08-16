<?php
$dept	= $this->session->userdata('dept');
$url	= $this->uri->segment(1);
$this->load->view('nav/admin/admin_nav');

$method 		= $this->uri->segment(2);
$id_kedatangan 	= $this->uri->segment(3);

switch ($method) {
	case 'input':
		$data 	= array(
			'title' 				=> 'Proses Data',
			'running'				=> auto_no_spb(),
			'tanggal_spb'			=> '',
			'receipt_oracle'		=> '',
			'no_polisi'				=> '',
			'no_jasa'				=> '',
			'no_reel'				=> '',
			'no_seal'				=> '',
			'kondisi_seal'			=> '',
			'no_container'			=> '',
			'no_po'					=> $record['no_po'],
			'kode_oracle'			=> $record['kode_oracle'],
			'nama_bahan'			=> $record['nama_bahan'],
			'supplier'				=> $record['supplier'],
			'tanggal_datang'		=> $record['tanggal_datang'],
			'no_lot'				=> $record['kode_produksi'],
			'jumlah'				=> $record['jumlah'],
			'jumlah_tidaksesuai' 	=> '',
			'jumlah_diterima'		=> $record['jumlah_diterima'],
			'jumlah_ditolak'		=> $record['jumlah_ditolak']);

		$alasan_tolak = array(
			'name'        => 'alasan_tolak',
			'id'          => 'alasan_tolak',
			'value'       => '',
			'rows'        => '3',
			'cols'        => '10',
			'style'       => 'width:50%',
			'class'       => 'form-control',
			'placeholder' => 'Example = Alasan Penolakan');

		$alasan_revisi = array(
			'name'        => 'alasan_revisi',
			'id'          => 'alasan_revisi',
			'value'       => '-',
			'rows'        => '3',
			'cols'        => '10',
			'style'       => 'width:50%',
			'class'       => 'form-control',
			'placeholder' => 'Example = Alasan Revisi');

		$hidden = array(
			'plant'			=> $record['plant'],
			'id_kedatangan'	=> $id_kedatangan);
	break;

	case 'edit':
		$data 	= array(
			'title' 				=> 'Edit / Revisi Data',
			'running'				=> $record['running_spb'],
			'tanggal_spb'			=> $record['tanggal_spb'],
			'receipt_oracle'		=> $record['receipt_oracle'],
			'no_polisi'				=> $record['no_polisi'],
			'no_jasa'				=> $record['no_jasa'],
			'no_reel'				=> $record['no_reel'],
			'no_seal'				=> $record['no_seal'],
			'kondisi_seal'			=> $record['kondisi_seal'],
			'no_container'			=> $record['no_container'],
			'no_po'					=> $record['no_po'],
			'kode_oracle'			=> $record['kode_oracle'],
			'nama_bahan'			=> $record['nama_bahan'],
			'supplier'				=> $record['supplier'],
			'tanggal_datang'		=> $record['tanggal_datang'],
			'no_lot'				=> $record['kode_produksi'],
			'jumlah'				=> $record['jumlah'],
			'jumlah_tidaksesuai' 	=> $record['jumlah_tidaksesuai'],
			'jumlah_diterima'		=> $record['jumlah_diterima'],
			'jumlah_ditolak'		=> $record['jumlah_ditolak']);

		$alasan_tolak = array(
			'name'        => 'alasan_tolak',
			'id'          => 'alasan_tolak',
			'value'       => $record['alasan_ditolak'],
			'rows'        => '3',
			'cols'        => '10',
			'style'       => 'width:50%',
			'class'       => 'form-control',
			'placeholder' => 'Example = Alasan Penolakan');

		$alasan_revisi = array(
			'name'        => 'alasan_revisi',
			'id'          => 'alasan_revisi',
			'value'       => $record['alasan_revisi'],
			'rows'        => '3',
			'cols'        => '10',
			'style'       => 'width:50%',
			'class'       => 'form-control',
			'placeholder' => 'Example = Alasan Revisi');

		$hidden = array(
			'plant'			=> $record['plant'],
			'id_kedatangan'	=> $id_kedatangan);
	break;
}

?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $data['title'];?> Surat Penolakan Barang (SPB)</h1>
<?php
if($this->session->flashdata('msg_success')) {?>
	<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<?php echo $this->session->flashdata('msg_success');?>
	</div>
<?php }?>
<!-- UNTUK ERROR UPLOAD -->
		<?php echo (empty($error) ? "" :"
			<div class='alert alert-danger alert-dismissible fade in' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
				</button>$error
			</div>
		");?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<?php echo form_open_multipart('released_partial/'.$method,'id=qc_spb_form',$hidden); ?>
			<div class="form-group">
				<div class="row">
					<div class="col-md-5">
						<label>No.</label>
						<input type="text" name="no_running" id="no_running" value="<?php echo $data['running'];?>" class="form-control">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4">
						<label>Tanggal SPB.</label>
						<input type="text" name="tanggal_spb" id="tanggal_spb" class="form-control tgl" placeholder="Example : YYYY-MM-DD" value="<?php echo $data['tanggal_spb'];?>">
					</div>
					<div class="col-md-4">
						<?php echo form_label('Receipt Oracle.','receipt_oracle');?>
						<?php
							unset($options);
							$options = array(
								'' 		=> 'Receipt Oracle',
								'Sudah' => 'Sudah',
								'Belum'	=> 'Belum'
							);
							echo form_dropdown('receipt_oracle',$options,$data['receipt_oracle'],'class="form-control" id=receipt_oracle');
						?>
					</div>
					<div class="col-md-4">
						<?php echo form_label('No. Polisi Kendaraan.','no_polisi');?>
						<?php echo form_input('no_polisi',$data['no_polisi'],array('class'=>'form-control','placeholder'=>'Example : A 9999 BB'));?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4">
						<?php echo form_label('No. Jasa Pengiriman.','no_jasa');?>
						<?php echo form_input('no_jasa',$data['no_jasa'],array('class'=>'form-control','placeholder'=>'Example : 999'));?>
					</div>
					<div class="col-md-4">
						<?php echo form_label('No. Reel.','no_reel');?>
						<?php echo form_input('no_reel',$data['no_reel'],array('class'=>'form-control','placeholder'=>'Example : 999'));?>
					</div>
					<div class="col-md-4">
						<?php echo form_label('No. Seal.','no_seal');?>
						<?php echo form_input('no_seal',$data['no_seal'],array('class'=>'form-control','placeholder'=>'Example : 999'));?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4">
						<?php echo form_label('Kondisi Seal.','kondisi_seal');?>
						<?php echo form_input('kondisi_seal',$data['kondisi_seal'],array('class'=>'form-control','placeholder'=>'Example : OK'));?>
					</div>
					<div class="col-md-4">
						<?php echo form_label('No. Container.','no_container');?>
						<?php echo form_input('no_container',$data['no_container'],array('class'=>'form-control','placeholder'=>'Example : 999'));?>
					</div>
					<div class="col-md-4">
						<?php echo form_label('No. PO.','no_po');?>
						<?php echo form_input('no_po',$data['no_po'],array('class'=>'form-control'));?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<b>Data Bahan</b>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<?php echo form_label('Kode Oracle / Item.','kode_oracle');?>
										<?php echo form_input('kode_oracle',$data['kode_oracle'],array('class'=>'form-control'));?>
									</div>
									<div class="col-md-4">
										<?php echo form_label('Nama Bahan / Barang.','nama_bahan');?>
										<?php echo form_input('nama_bahan',$data['nama_bahan'],array('class'=>'form-control'));?>
									</div>
									<div class="col-md-4">
										<?php echo form_label('Nama Supplier / Pemasok','supplier');?>
										<?php echo form_input('supplier',$data['supplier'],array('class'=>'form-control'));?>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<?php echo form_label('Tanggal Datang.','tanggal_datang');?>
										<?php echo form_input('tanggal_datang',$data['tanggal_datang'],array('class'=>'form-control'));?>
									</div>
									<div class="col-md-4">
										<?php echo form_label('No. LOT.','no_lot');?>
										<?php echo form_input('no_lot',$data['no_lot'],array('class'=>'form-control'));?>
									</div>
									<div class="col-md-4">
										<?php echo form_label('Jumlah Datang','jumlah');?>
										<?php echo form_input('jumlah',$data['jumlah'],array('class'=>'form-control'));?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<b>Ketidaksesuaian</b>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<?php echo form_label('Jumlah Ketidaksesuaian.','jumlah_tidaksesuai');?>
										<?php echo form_input('jumlah_tidaksesuai',$data['jumlah_tidaksesuai'],array('class'=>'form-control'));?>
									</div>
									<div class="col-md-4">
										<?php echo form_label('Jumlah Diterima.','jumlah_diterima');?>
										<?php echo form_input('jumlah_diterima',$data['jumlah_diterima'],array('class'=>'form-control'));?>
									</div>
									<div class="col-md-4">
										<?php echo form_label('Jumlah Ditolak.','jumlah_ditolak');?>
										<?php echo form_input('jumlah_ditolak',$data['jumlah_ditolak'],array('class'=>'form-control'));?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<?php echo form_label('Alasan Penolakan.','alasan_tolak');?>
				<?php echo form_textarea($alasan_tolak);?>
			</div>
			<div class="form-group">
				<?php echo form_label('Alasan Revisi.','alasan_revisi');?>
				<?php echo form_textarea($alasan_revisi);?>
			</div>
			<div class="row">
				<div class="col-md-6">
					<button type="submit" name="submit" class="btn btn-md btn-success">Save & Finalize</a>
				</div>
			</div>
		<?php echo form_close();?>
	</div>
</div>

<!-- Bootstrap Datetimepicker-->
<script type="text/javascript">
	$(document).ready(function() {
		$('.tgl').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	});
</script>
<!-- /Bootstrap Datetimepicker-->

<!-- Readonly Input -->
<script type="text/javascript">
	$(document).ready(function() {
		$('[name=no_running],[name=no_po],[name=kode_oracle],[name=nama_bahan],[name=supplier],[name=tanggal_datang]').prop('readonly',true);
		$('[name=tanggal_datang],[name=no_lot],[name=jumlah],[name=jumlah_diterima],[name=jumlah_ditolak]').prop('readonly',true);
	});
</script>
<!-- /Readonly Input -->

<!-- Bootstrap Validator -->
<script type="text/javascript">
	$( "#qc_spb_form" ).validate( {
		rules: {
			tanggal_spb: "required",
			receipt_oracle: "required",
			no_polisi: "required",
			no_jasa: "required",
			no_reel: "required",
			no_seal: "required",
			kondisi_seal: "required",
			no_container: "required",
			jumlah_tidaksesuai: "required",
			alasan_tolak: "required",
			alasan_revisi: "required"
		}
	});
</script>
<!-- /Bootstrap Validator -->