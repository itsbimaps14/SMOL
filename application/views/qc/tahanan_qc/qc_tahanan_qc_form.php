<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');

$method = $this->uri->segment(2);
$id_t_kedatangan = $this->uri->segment(3);

switch ($method) {
	case 'proses':
		$data = array(
			'title'					=>'Proses Data',
			'no_running'			=>$record['no_running_kedatangan'],
			'tanggal_datang'		=>$record['tanggal_datang'],
			'kode_id_t_db_spek'		=>$record['kode_id_t_db_spek'],
			'kode_produksi'			=>$record['kode_produksi'],
			'no_po'					=>$record['no_po'],
			'supplier'				=>$record['supplier'],
			'principal'				=>$record['principal'],
			'tanggal_prod'			=>$record['tanggal_prod'],
			'tanggal_exp'			=>$record['tanggal_exp'],
			'tanggal_dibutuhkan'	=>$record['tanggal_dibutuhkan'],
			'jumlah'				=>$record['jumlah'],
			'satuan'				=>$record['satuan'],
			'umur_simpan'			=>$record['umur_simpan'],
			'attachement_coa'		=>'File : '.$record['attachement_coa'],
			'pure_coa'				=>$record['attachement_coa'],
			'plant'					=>$record['plant'],
			'attachement_hak'		=>'File : '.$record['attachement_hak_release'],
			'pure_hak'				=>$record['attachement_hak_release'],
			'status_tahanan_rd'		=>$record['status_tahanan_rd'],
			'status'				=>$record['status_qc']
		);

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
	break;

	case 'edit':
		$data = array(
			'title'					=>'Edit Data',
			'no_running'			=>$record['no_running_kedatangan'],
			'tanggal_datang'		=>$record['tanggal_datang'],
			'kode_id_t_db_spek'		=>$record['kode_id_t_db_spek'],
			'kode_produksi'			=>$record['kode_produksi'],
			'no_po'					=>$record['no_po'],
			'supplier'				=>$record['supplier'],
			'principal'				=>$record['principal'],
			'tanggal_prod'			=>$record['tanggal_prod'],
			'tanggal_exp'			=>$record['tanggal_exp'],
			'tanggal_dibutuhkan'	=>$record['tanggal_dibutuhkan'],
			'jumlah'				=>$record['jumlah'],
			'satuan'				=>$record['satuan'],
			'umur_simpan'			=>$record['umur_simpan'],
			'attachement_coa'		=>'File : '.$record['attachement_coa'],
			'pure_coa'				=>$record['attachement_coa'],
			'plant'					=>$record['plant'],
			'attachement_hak'		=>'File : '.$record['attachement_hak_release'],
			'pure_hak'				=>$record['attachement_hak_release'],
			'status_tahanan_rd'		=>$record['status_tahanan_rd'],
			'status'				=>$record['status_qc']
		);

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
	break;
}

?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $data['title'];?> Tahanan QC</h1>
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
					'plant' => $data['plant'],
					'id_t_kedatangan' => $id_t_kedatangan,
					'pure_hak' => $data['pure_hak']
				);
				echo form_open_multipart('tahanan_qc/'.$method,'id=qc_ba_form',$hidden);
			?>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4">
						<label>No.</label>
						<input type="text" name="no_running" id="no_running" class="form-control" value="<?php echo $data['no_running'];?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-3">
						<label>Tanggal Datang.</label>
						<input type="text" name="tanggal_datang" id="tanggal_datang" class="form-control tgl" placeholder="Example : YYYY-MM-DD" value="<?php echo $data['tanggal_datang'] ?>">
					</div>
					<div class="col-md-3">
						<?php echo form_label('Kode Item - Nama Bahan.','id_t_db_spek');?>
						<?php
							unset($options);
							foreach ($tmp_options = auto_get_options('t_db_spek','id_t_dbspek,kode_oracle,nama_bahan','where status_db_spek = "Active" and status_top = "Top" ORDER BY kode_oracle ASC') as $info){
								$options[$info['id_t_dbspek']] = $info['kode_oracle'].' - '.$info['nama_bahan'];
							}
							echo form_dropdown('id_t_db_spek',$options,$data['kode_id_t_db_spek'],'class="form-control" id=id_t_db_spek readonly');
						?>
					</div>
					<div class="col-md-3">
						<?php echo form_label('No. Lot / Kode Produksi.','kode_produksi');?>
						<?php echo form_input('kode_produksi',$data['kode_produksi'],array('class'=>'form-control','placeholder'=>'Example : 0323CK19054TO676'));?>
					</div>
					<div class="col-md-3">
						<label>No. PO.</label>
						<input type="number" step="any" name="no_po" class="form-control" placeholder="Example : 899600144049"
							value="<?php echo $data['no_po'] ?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-3">
						<?php echo form_label('Supplier.','supplier');?>
						<?php echo form_input('supplier',$data['supplier'],array('class'=>'form-control','placeholder'=>'Example : Supplier'));?>
					</div>
					<div class="col-md-3">
						<?php echo form_label('Principal.','principal');?>
						<?php echo form_input('principal',$data['principal'],array('class'=>'form-control','placeholder'=>'Example : Principal'));?>
					</div>
					<div class="col-md-3">
						<label>Prod. Date.</label>
						<input type="text" name="tanggal_prod" id="tanggal_prod" class="form-control tgl" placeholder="Example : YYYY-MM-DD"
							value="<?php echo $data['tanggal_prod'] ?>">
					</div>
					<div class="col-md-3">
						<label>Exp. Date.</label>
						<input type="text" name="tanggal_exp" id="tanggal_exp" class="form-control tgl" placeholder="Example : YYYY-MM-DD"
							value="<?php echo $data['tanggal_exp'] ?>">
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-3">
						<label>Tanggal Dibutuhkan.</label>
						<input type="text" name="tanggal_dibutuhkan" id="tanggal_dibutuhkan" class="form-control" placeholder="Example : YYYY-MM-DD"
							value="<?php echo $data['tanggal_dibutuhkan'] ?>">
					</div>
					<div class="col-md-3">
						<?php echo form_label('Jumlah.','jumlah');?>
						<?php echo form_input('jumlah',$data['jumlah'],array('class'=>'form-control','placeholder'=>'Example : 10','id'=>'jumlah'));?>
					</div>
					<div class="col-md-3">
						<?php echo form_label('Satuan.','satuan');?>
						<?php echo form_input('satuan',$data['satuan'],array('class'=>'form-control','placeholder'=>'Example : KG'));?>
					</div>
					<div class="col-md-3">
						<?php echo form_label('Status Umur Simpan.','umur_simpan');?>
						<?php echo form_input('umur_simpan',$data['umur_simpan'],array('class'=>'form-control','placeholder'=>'Example : 45%','id'=>'umur_simpan'));?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
<?php
		echo "<div class='col-md-5'>";
		echo form_label('Nama File COA.','attachement_coa');
		echo form_input('attachement_coa',$data['attachement_coa'],array('class'=>'form-control','id'=>'attachement_coa'));
		echo "</div><div class='col-md-2'>";
		echo form_label('Download COA.','label_coa');
		echo anchor('attach/download/file_coa_psa/'.$data['pure_coa'],'<b>Download</b>',array('class'=>'form-control btn btn-primary'));
		echo "</div>";
?>
					<div class="col-md-5">
						<?php echo form_label('Lokasi.','plant');?>
						<?php echo form_input('plant',$data['plant'],array('class'=>'form-control','id'=>'plant'));?>
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
										$result = get_data_table_release($id_t_kedatangan,$data['no_running']);
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
			<td><input type='text' id='analisa_qc' name='analisa_qc[]' class='form-control' value='$r->analisa_qc_release'></td>
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
					<div class="col-md-6">
						<label>Attachement HAK/HPM.</label>
						<div class="fileinput fileinput-new input-group" data-provides="fileinput">
		  					<div class="form-control" data-trigger="fileinput">
		  						<i class="glyphicon glyphicon-file fileinput-exists"></i>
		  						<span class="fileinput-filename"><?php echo $data['attachement_hak'];?></span>
		  					</div>
		  					<span class="input-group-addon btn btn-default btn-file">
		  						<span class="fileinput-new">Select file</span>
		  						<span class="fileinput-exists">Change</span>
		  						<?php
		  							echo "<input type='file' name='attachement_hak'>";
		  						?>
		  					</span>
		  					<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
						</div>
					</div>
					<div class="col-md-2">
						<?php
							echo form_label('Download HAK.','label_hak');
							echo anchor('attach/download/file_hak_qc/'.$data['pure_hak'],'<b>Download</b>',array('class'=>'form-control btn btn-primary')); 
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
							if ($data['status'] == 'Released Partial' OR $data['status'] == 'OK') {
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
							echo form_dropdown('status_release_qc',$options,'','class="form-control" id=status_release_qc');
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
							echo form_dropdown('status_tahanan_rd',$options,$data['status_tahanan_rd'],'class="form-control" id=status_tahanan_rd readonly');
						?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<?php echo form_label('Keterangan.','keterangan_qc');?>
				<?php echo form_textarea($keterangan);?>
			</div>
			<div id="form-partial" style="display: none; ">
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Jumlah Ditahan.</label>
							<input type="number" id="jumlah_ditahan" name="jumlah_ditahan" min="1" max="<?php echo $data['jumlah']-1;?>" onkeyup="hitung()" class="form-control" value="0">
						</div>
						<div class="col-md-6">
							<label>Jumlah Diterima.</label>
							<input type="text" id="jumlah_diterima" name="jumlah_diterima" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<input type="submit" name="submit" id="btn_submit" value="Save & Finalize" class="btn btn-md btn-success">
				</div>
			</div>
		<?php echo form_close();?>
	</div>
</div>

<!-- Readonly Input -->
<script type="text/javascript">
	$(document).ready(function() {
		var method = '<?php echo $method;?>';
		if (method == 'proses') {
			$('[name=no_running],[name=tanggal_datang],[name=kode_oracle],[name=kode_produksi],[name=no_po],[name=supplier]').prop('readonly',true);
			$('[name=principal],[name=tanggal_prod],[name=tanggal_exp],[name=tanggal_dibutuhkan],[name=jumlah]').prop('readonly',true);
			$('[name=umur_simpan],[name=tanggal_prod],[name=attachement_coa],[name=plant],[name=running_tahanan]').prop('readonly',true);
			$('[name="analisa_qc[]"],[name=satuan],[name=jumlah_diterima]').prop('readonly',true);
		}
		else{
			$('[name=no_running],[name=tanggal_datang],[name=kode_oracle],[name=kode_produksi],[name=no_po],[name=supplier]').prop('readonly',true);
			$('[name=principal],[name=tanggal_prod],[name=tanggal_exp],[name=tanggal_dibutuhkan],[name=jumlah]').prop('readonly',true);
			$('[name=umur_simpan],[name=tanggal_prod],[name=attachement_coa],[name=plant],[name=running_tahanan]').prop('readonly',true);
			$('[name=satuan]').prop('readonly',true);
			$('[name=status_release_qc]').prop('disabled',true);
		}
	});
</script>
<!-- /Readonly Input -->

<!-- Hitung jumlah Diterima -->
<script type="text/javascript">
	function hitung(){
		var hasil;
		hasil = $('#jumlah').val() - $('#jumlah_ditahan').val();
		$('#jumlah_diterima').val(hasil);
	}
	$(document).ready(function() {
		hitung();
	});
</script>
<!-- /Hitung jumlah Diterima -->

<!-- Show Hide tahanan Form -->
<script type="text/javascript">
	$(document).ready(function() {
		$('#status_release_qc').change(function() {
			var value = $('#status_release_qc').val();
			if (value == 'Released Partial'){
				$("#form-partial").show("slow");
			}
			else {
				$("#form-partial").hide("slow");
			}
		});
	});
</script>
<!-- /Show Hide tahanan Form -->

<!-- Bootstrap Validator -->
<script type="text/javascript">
	$('#btn_save').click(function(){
		$( "#qc_ba_form" ).validate( {
			rules: {
			}
		});
	});
	$('#btn_submit').click(function(){
		$( "#qc_ba_form" ).validate( {
			rules: {
				status_release_qc: "required",
				status_tahanan_rd: "required",
				keterangan_qc: "required",
				'analisa_qc[]': "required",
				jumlah_ditahan: "required"
			}
		});
	});
</script>
<!-- /Bootstrap Validator -->