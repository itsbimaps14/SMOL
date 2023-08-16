<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'_nav');

$method = $this->uri->segment(2);
$id_t_kedatangan = $this->uri->segment(3);

?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">View Data Table Kedatangan</h1>
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
			<?php
				$hidden = array(
					'id_t_kedatangan' => $id_t_kedatangan,
					'pure_hak_r' => $record['attachement_hak_release'],
					'pure_hak_m' => $record['attachement_hak_monitoring'],
					'plant' => $record['plant']
				);
				echo form_open_multipart('ok_closed/'.$method,'id=qc_ba_form',$hidden);
			?>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4">
						<label>No.</label>
						<input type="text" name="no_running" id="no_running" class="form-control" value="<?php echo $record['no_running_kedatangan'];?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-3">
						<label>Tanggal Datang.</label>
						<input type="text" name="tanggal_datang" id="tanggal_datang" class="form-control tgl" placeholder="Example : YYYY-MM-DD" value="<?php echo $record['tanggal_datang'] ?>">
					</div>
					<div class="col-md-3">
						<?php echo form_label('Kode Item - Nama Bahan.','id_t_db_spek');?>
						<?php
							unset($options);
							foreach ($tmp_options = auto_get_options('t_db_spek','id_t_dbspek,kode_oracle,nama_bahan','where status_db_spek = "Active" and status_top = "Top" ORDER BY kode_oracle ASC') as $info){
								$options[$info['id_t_dbspek']] = $info['kode_oracle'].' - '.$info['nama_bahan'];
							}
							echo form_dropdown('id_t_db_spek',$options,$record['kode_id_t_db_spek'],'class="form-control" id=id_t_db_spek readonly');
						?>
					</div>
					<div class="col-md-3">
						<?php echo form_label('No. Lot / Kode Produksi.','kode_produksi');?>
						<?php echo form_input('kode_produksi',$record['kode_produksi'],array('class'=>'form-control','placeholder'=>'Example : 0323CK19054TO676'));?>
					</div>
					<div class="col-md-3">
						<label>No. PO.</label>
						<input type="number" step="any" name="no_po" class="form-control" placeholder="Example : 899600144049"
							value="<?php echo $record['no_po'] ?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-3">
						<?php echo form_label('Supplier.','supplier');?>
						<?php echo form_input('supplier',$record['supplier'],array('class'=>'form-control','placeholder'=>'Example : Supplier'));?>
					</div>
					<div class="col-md-3">
						<?php echo form_label('Principal.','principal');?>
						<?php echo form_input('principal',$record['principal'],array('class'=>'form-control','placeholder'=>'Example : Principal'));?>
					</div>
					<div class="col-md-3">
						<label>Prod. Date.</label>
						<input type="text" name="tanggal_prod" id="tanggal_prod" class="form-control tgl" placeholder="Example : YYYY-MM-DD"
							value="<?php echo $record['tanggal_prod'] ?>">
					</div>
					<div class="col-md-3">
						<label>Exp. Date.</label>
						<input type="text" name="tanggal_exp" id="tanggal_exp" class="form-control tgl" placeholder="Example : YYYY-MM-DD"
							value="<?php echo $record['tanggal_exp'] ?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-3">
						<label>Tanggal Dibutuhkan.</label>
						<input type="text" name="tanggal_dibutuhkan" id="tanggal_dibutuhkan" class="form-control" placeholder="Example : YYYY-MM-DD"
							value="<?php echo $record['tanggal_dibutuhkan'] ?>">
					</div>
					<div class="col-md-3">
						<?php echo form_label('Jumlah.','jumlah');?>
						<?php echo form_input('jumlah',$record['jumlah'],array('class'=>'form-control','placeholder'=>'Example : 10','id'=>'jumlah'));?>
					</div>
					<div class="col-md-3">
						<?php echo form_label('Satuan.','satuan');?>
						<?php echo form_input('satuan',$record['satuan'],array('class'=>'form-control','placeholder'=>'Example : KG'));?>
					</div>
					<div class="col-md-3">
						<?php echo form_label('Status Umur Simpan.','umur_simpan');?>
						<?php echo form_input('umur_simpan',$record['umur_simpan'],array('class'=>'form-control','placeholder'=>'Example : 45%','id'=>'umur_simpan'));?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<?php echo form_label('Jumlah Diterima.','jumlah_diterima');?>
						<?php echo form_input('jumlah_diterima',$record['jumlah_diterima'],array('class'=>'form-control','placeholder'=>'Example : 10'));?>
					</div>
					<div class="col-md-6">
						<?php echo form_label('Jumlah Ditolak.','jumlah_ditolak');?>
						<?php echo form_input('jumlah_ditolak',$record['jumlah_ditolak'],array('class'=>'form-control','placeholder'=>'Example : 10'));?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
<?php
		echo "<div class='col-md-5'>";
		echo form_label('Nama File COA.','attachement_coa');
		echo form_input('attachement_coa','File : '.$record['attachement_coa'],array('class'=>'form-control','id'=>'attachement_coa'));
		echo "</div><div class='col-md-2'>";
		echo form_label('Download COA.','label_coa');
		echo anchor('attach/download/file_coa_psa/'.$record['attachement_coa'],'<b>Download</b>',array('class'=>'form-control btn btn-primary'));
		echo "</div>";
?>
					<div class="col-md-5">
						<?php echo form_label('Lokasi.','plant');?>
						<?php echo form_input('plant',$record['plant'],array('class'=>'form-control','id'=>'plant'));?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<b>Parameter Release</b>
						</div>
						<div class="panel-body">
							<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="production_table">
								<thead>
									<tr>
										<th>Kategori Spek</th>
										<th>Nama Parameter</th>
										<th>Nilai Spek</th>
										<th>Periode Analisa</th>
										<th>Titik Sampling</th>
										<th>Hasil Analisa QC</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$result = get_data_table_release($id_t_kedatangan,$record['no_running_kedatangan']);
										foreach($result as $r) {
	echo "
		<tr>
			<td>
				<input type='text' name='kat_spek' class='form-control' value='$r->kat_spek' readonly>
				<input type='hidden' name='id_analisa_qc_release[]' value='$r->id_analisa_qc_release'>
			</td>
			<td><input type='text' name='nama_parameter' class='form-control' value='$r->nama_parameter' readonly></td>
			<td><input type='text' name='nilai_spek_release' class='form-control' value='$r->nilai_spek_release' readonly></td>
			<td><input type='text' name='periode_analisa_release' class='form-control' value='$r->periode_analisa_release' readonly></td>
			<td><input type='text' name='titik_sampling_release' class='form-control' value='$r->titik_sampling_release' readonly></td>
			<td><input type='text' id='analisa_qc_release' name='analisa_qc_release[]' class='form-control' value='$r->analisa_qc_release'></td>
		</tr>
	";
										}
									?>
								</tbody>
							</table>
							<!-- Submit untuk Save
							<div style="float: right;">
								<input type="submit" name="save" id="btn_save" value="Save" class="btn btn-md btn-success">
							</div>
							-->
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-9">
						<?php
						echo form_label('Nama File HAK Release.','attachement_coa');
						echo form_input('attachement_coa','File : '.$record['attachement_hak_release'],array('class'=>'form-control','id'=>'attachement_coa'));
						?>
					</div>
					<div class="col-md-3">
						<?php
							echo form_label('Download HAK Release.','label_hak');
							echo anchor('attach/download/file_hak_qc/'.$record['attachement_hak_release'],'<b>Download</b>',array('class'=>'form-control btn btn-primary')); 
						?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<b>Parameter Monitoring</b>
						</div>
						<div class="panel-body">
							<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="production_table">
								<thead>
									<tr>
										<th>Kategori Spek</th>
										<th>Nama Parameter</th>
										<th>Nilai Spek</th>
										<th>Periode Analisa</th>
										<th>Titik Sampling</th>
										<th>Hasil Analisa QC</th>
									</tr>
								</thead>
								<tbody>
									<?php
										$result = get_data_table_monitoring($id_t_kedatangan,$record['no_running_kedatangan']);
										foreach($result as $r) {
	echo "
		<tr>
			<td>
				<input type='text' name='kat_spek' class='form-control' value='$r->kat_spek' readonly>
				<input type='hidden' name='id_analisa_qc_monitoring[]' value='$r->id_analisa_qc_monitoring'>
				<input type='hidden' name='id_t_kedatangan' value='$id_t_kedatangan'>
			</td>
			<td><input type='text' name='nama_parameter' class='form-control' value='$r->nama_parameter' readonly></td>
			<td><input type='text' name='nilai_spek_monitoring' class='form-control' value='$r->nilai_spek_monitoring' readonly></td>
			<td><input type='text' name='periode_analisa_monitoring' class='form-control' value='$r->periode_analisa_monitoring' readonly></td>
			<td><input type='text' name='titik_sampling_monitoring' class='form-control' value='$r->titik_sampling_monitoring' readonly></td>
			<td><input type='text' id='analisa_qc_monitoring' name='analisa_qc_monitoring[]' class='form-control' value='$r->analisa_qc_monitoring'></td>
		</tr>
	";
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-9">
						<?php
						echo form_label('Nama File HAK Monitoring.','attachement_coa');
						echo form_input('attachement_coa','File : '.$record['attachement_hak_monitoring'],array('class'=>'form-control','id'=>'attachement_coa'));
						?>
					</div>
					<div class="col-md-3">
						<?php
							echo form_label('Download HAK Monitoring.','label_hak');
							echo anchor('attach/download/file_hak_qc/'.$record['attachement_hak_monitoring'],'<b>Download</b>',array('class'=>'form-control btn btn-primary')); 
						?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<?php echo form_label('Status Release QC.','status_release_qc');?>
						<?php
							unset($options);
							if ($record['status_qc'] == 'Released Partial' OR $record['status_qc'] == 'OK') {
								$options = array(
									''					=> 'Tahanan',
									'Reject Done'		=> 'Reject',
									'OK Closed'			=> 'OK Closed',
									'OK Bersyarat'		=> 'OK Bersyarat'
								);
							}
							else {
								$options = array(
									''					=> 'Tahanan',
									'Reject'			=> 'Reject',
									'OK'				=> 'OK',
									'Released Partial'	=> 'Released Partial'
								);
							}
							echo form_dropdown('status_release_qc',$options,$record['status_all'],'class="form-control" id=status_release_qc');
						?>
					</div>
					<div class="col-md-6">
						<?php echo form_label('Status Tahanan RD.','status_tahanan_rd');?>
						<?php
							unset($options);
							$options = array(
								''					=> 'Status Tahanan RD',
								'Reject'			=> 'Reject',
								'OK'				=> 'OK'
							);
							echo form_dropdown('status_tahanan_rd',$options,$record['status_tahanan_rd'],'class="form-control" id=status_tahanan_rd');
						?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<?php echo form_label('Keterangan.','keterangan_qc');
					$keterangan = array(
						'name'        => 'keterangan_qc',
						'id'          => 'keterangan_qc',
						'value'       => $record['keterangan_qc'],
						'rows'        => '3',
						'cols'        => '10',
						'style'       => 'width:50%',
						'class'       => 'form-control',
						'placeholder' => 'Example = Keterangan'
					);
				?>
				<?php echo form_textarea($keterangan);?>
			</div>
		<?php echo form_close();?>
	</div>
</div>

<!-- Readonly Input -->
<script type="text/javascript">
	$(document).ready(function() {
		$('[name=no_running],[name=tanggal_datang],[name=kode_oracle],[name=kode_produksi],[name=no_po],[name=supplier]').prop('readonly',true);
		$('[name=principal],[name=tanggal_prod],[name=tanggal_exp],[name=tanggal_dibutuhkan],[name=jumlah]').prop('readonly',true);
		$('[name=umur_simpan],[name=tanggal_prod],[name=attachement_coa],[name=plant],[name=running_tahanan]').prop('readonly',true);
		$('[name=jumlah_diterima],[name=jumlah_ditolak],[name=satuan],[name="analisa_qc_release[]"]').prop('readonly',true);
		$('[name="analisa_qc_monitoring[]"],[name=keterangan_qc]').prop('readonly',true);
		$('[name=status_release_qc],[name=status_tahanan_rd]').prop('disabled',true);
	});
</script>
<!-- /Readonly Input -->