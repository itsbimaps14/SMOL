<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
?>

<?php
$datatab = $this->uri->segment(3);

$ket_release = array(
	'name'        => 'keterangan_release',
	'id'          => 'keterangan_release',
	'value'       => $record['keterangan_release'],
	'rows'        => '3',
	'cols'        => '10',
	'style'       => 'width:50%',
	'class'       => 'form-control',
	'placeholder' => 'Example = Keterangan Release');

$ket_monitoring = array(
	'name'        => 'keterangan_monitoring',
	'id'          => 'keterangan_monitoring',
	'value'       => $record['keterangan_monitoring'],
	'rows'        => '3',
	'cols'        => '10',
	'style'       => 'width:50%',
	'class'       => 'form-control',
	'placeholder' => 'Example = Keterangan Monitoring');

$referensi = array(
	'name'        => 'referensi',
	'id'          => 'referensi',
	'value'       => $record['referensi'],
	'rows'        => '3',
	'cols'        => '10',
	'style'       => 'width:50%',
	'class'       => 'form-control',
	'placeholder' => 'Example = Referensi');

$data = array(
	'title'			=>'View Data'
);

?>
<div class="row">
	<div class="col-lg-10 col-lg-offset-1">
		<h1 class="page-header"><?php echo $data['title'];?> Database Spek</h1>
<?php
if($this->session->flashdata('msg_username')) {?>
	<div class='alert alert-danger alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<?php echo $this->session->flashdata('msg_username');?>
	</div>
<?php }
if($this->session->flashdata('msg_password')) {?>
	<div class='alert alert-danger alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<?php echo $this->session->flashdata('msg_password');?>
	</div>
<?php }?>
	</div>
</div>
<div class="row">
	<div class="col-lg-10 col-lg-offset-1">
		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
					<label>No.</label>
					<input type="text" name="no_db_spek" class="form-control" value="<?php echo $record['no_db_spek'];?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-3">
					<?php echo form_label('No. UPP *','no_upp');?>
					<?php echo form_input('no_upp',$record['no_upp'],array('class'=>'form-control'));?>
				</div>
				<div class="col-md-3">
					<label>Tanggal Berlaku *</label>
					<input type="text" name="tanggal_berlaku" class="form-control tgl" value="<?php echo $record['tanggal_berlaku'] ?>">
				</div>
				<div class="col-md-3">
					<?php echo form_label('Revisi *','revisi');?>
					<?php echo form_input('revisi',$record['revisi'],array('class'=>'form-control'));?>
				</div>
				<div class="col-md-3">
					<?php echo form_label('Golongan *','golongan');?>
					<?php
						unset($options);
						foreach ($tmp_options = auto_get_options('t_golongan','id_t_golongan,nama_golongan','ORDER BY nama_golongan ASC') as $info){
							$options[$info['id_t_golongan']] = $info['nama_golongan'];
						}
						echo form_dropdown('golongan',$options,$record['golongan'],'class="form-control" id=golongan disabled');
					?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-3">
					<?php echo form_label('Kode Oracle *','kode_oracle');?>
					<?php echo form_input('kode_oracle',$record['kode_oracle'],array('class'=>'form-control'));?>
				</div>
				<div class="col-md-3">
					<?php echo form_label('Nama Bahan *','nama_bahan');?>
					<?php echo form_input('nama_bahan',$record['nama_bahan'],array('class'=>'form-control'));?>
				</div>
				<div class="col-md-3">
					<?php echo form_label('Umur Simpan (Bulan) *','umur_simpan');?>
					<?php echo form_input('umur_simpan',$record['umur_simpan'],array('class'=>'form-control'));?>
				</div>
				<div class="col-md-3">
					<?php echo form_label('Kondisi Penyimpanan *','kondisi_penyimpanan');?>
					<?php echo form_input('kondisi_penyimpanan',$record['kondisi_penyimpanan'],array('class'=>'form-control'));?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Parameter Release *</label>
			<table id="view_par_release" class="table table-bordered table-hover nowrap" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="title">Kategori Spek</th>
						<th class="title">Nama Parameter</th>
						<th class="title">Periode Analisa</th>	
						<th class="title">Titik Sampling</th>
					</tr>
				</thead>
			</table>
		</div>
		<div class="form-group">
			<?php echo form_label('Keterangan Release *','keterangan_release');?>
			<?php echo form_textarea($ket_release);?>
		</div>
		<div class="form-group">
			<label>Parameter Monitoring *</label>
			<table id="view_par_monitor" class="table table-bordered table-hover nowrap" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="title">Kategori Spek</th>
						<th class="title">Nama Parameter</th>
						<th class="title">Periode Analisa</th>	
						<th class="title">Titik Sampling</th>
					</tr>
				</thead>
			</table>
		</div>
		<div class="form-group">
			<?php echo form_label('Keterangan Monitoring *','krm');?>
			<?php echo form_textarea($ket_monitoring);?>
		</div>
		<div class="form-group">
			<?php echo form_label('Referensi *','ref');?>
			<?php echo form_textarea($referensi);?>
		</div>
	</div>
	<br>
</div>

<!-- Readonly Input -->
<script type="text/javascript">
	$(document).ready(function() {
		$('[name=no_db_spek],[name=r_fisik_def],[name=m_fisik_def],[name=revisi],[name=no_upp],[name=tanggal_berlaku]').prop('readonly',true);
		$('[name=kode_oracle],[name=nama_bahan],[name=umur_simpan],[name=kondisi_penyimpanan]').prop('readonly',true);
		$('[name=keterangan_release],[name=keterangan_monitoring],[name=referensi]').prop('readonly',true);
		//$('[name=tgl_rkj],[name=no_rkj],[name=kode_item]').prop('readonly',true);
	});
</script>
<!-- /Readonly Input -->

<!-- Datatables -->
<script type="text/javascript">
	var save_method; //for save method string
	var table;

	// Datatables for SSSMB
	$(document).ready(function() {
		//datatables
		table = $('#view_par_release').dataTable({
			"responsive": true,
			// Disable Search
			"searching": false,
			// --
			// Disable Entries
			"bPaginate": false,
			"bLengthChange": false,
			"bFilter": true,
			"bInfo": false,
			"bAutoWidth": false,
			// --
			// Disable Showing Entries
			"showNEntries" : false,
			// --
			"processing": false, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [0,'asc'], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('spek/view_par_release/'.$datatab.'');?>',
				"type": "POST",
				"dataType": "json"
			},
			//Set column definition initialisation properties.
			"aoColumns": [
				{"mData": "kat_spek"},
				{"mData": "nama_parameter"},
				{"mData": "periode_analisa_release"},
				{"mData": "titik_sampling_release"}
			],
			"language": {
				"zeroRecords": "Data tidak ditemukan",
				"infoEmpty": "Tidak ada data"
			}
		});
	});

	// Datatables for SSSMB
	$(document).ready(function() {
		//datatables
		table = $('#view_par_monitor').dataTable({
			"responsive": true,
			// Disable Search
			"searching": false,
			// --
			// Disable Entries
			"bPaginate": false,
			"bLengthChange": false,
			"bFilter": true,
			"bInfo": false,
			"bAutoWidth": false,
			// --
			// Disable Showing Entries
			"showNEntries" : false,
			// --
			"processing": false, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [0,'asc'], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('spek/view_par_monitor/'.$datatab.'');?>',
				"type": "POST",
				"dataType": "json"
			},
			//Set column definition initialisation properties.
			"aoColumns": [
				{"mData": "kat_spek"},
				{"mData": "nama_parameter"},
				{"mData": "periode_analisa_monitoring"},
				{"mData": "titik_sampling_monitoring"}
			],
			"language": {
				"zeroRecords": "Data tidak ditemukan",
				"infoEmpty": "Tidak ada data"
			}
		});
	});

</script>
<!-- /Datatables -->