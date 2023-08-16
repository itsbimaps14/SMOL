<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
?>

<?php
$datatab = $this->uri->segment(3);
$method = $this->uri->segment(2);

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
	'title'			=>'Edit Data');

$hidden = array('id_t_dbspek'	=>$record['id_t_dbspek']);

?>
<div class="row">
	<div class="col-lg-10 col-lg-offset-1">
		<h1 class="page-header"><?php echo $data['title'];?> Database Spek</h1>
<?php
if($this->session->flashdata('msg_edit_success')) {?>
	<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<?php echo $this->session->flashdata('msg_edit_success');?>
	</div>
<?php }?>
	</div>
</div>
<div class="row">
	<div class="col-lg-10 col-lg-offset-1">
		<?php
		echo form_open('spek/edit_data','id=db_spek_add_form',$hidden);
		?>
		<div class="form-group">
			<div class="row">
				<div class="col-md-5">
					<label>No.</label>
					<input type="text" name="no_db_spek" class="form-control" value="<?php echo $record['no_db_spek'];?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
					<?php echo form_label('No. UPP *','no_upp');?>
					<?php echo form_input('no_upp',$record['no_upp'],array('class'=>'form-control'));?>
				</div>
				<div class="col-md-4">
					<label>Tanggal Berlaku *</label>
					<input type="text" name="tanggal_berlaku" class="form-control tgl" value="<?php echo $record['tanggal_berlaku'] ?>">
				</div>
				<div class="col-md-4">
					<?php echo form_label('Revisi *','revisi');?>
					<?php echo form_input('revisi',$record['revisi'],array('class'=>'form-control'));?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
					<?php echo form_label('Golongan *','golongan');?>
					<?php
						unset($options);
						foreach ($tmp_options = auto_get_options('t_golongan','id_t_golongan,nama_golongan','ORDER BY nama_golongan ASC') as $info){
							$options[$info['id_t_golongan']] = $info['nama_golongan'];
						}
						echo form_dropdown('golongan',$options,$record['golongan'],'class="form-control" id=golongan');
					?>
				</div>
				<div class="col-md-4">
					<?php echo form_label('Kode Oracle *','kode_oracle');?>
					<?php echo form_input('kode_oracle',$record['kode_oracle'],array('class'=>'form-control'));?>
				</div>
				<div class="col-md-4">
					<?php echo form_label('Nama Bahan *','nama_bahan');?>
					<?php echo form_input('nama_bahan',$record['nama_bahan'],array('class'=>'form-control'));?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
					<?php echo form_label('Umur Simpan (Bulan) *','umur_simpan');?>
					<?php echo form_input('umur_simpan',$record['umur_simpan'],array('class'=>'form-control'));?>
				</div>
				<div class="col-md-4">
					<?php echo form_label('Satuan *','satuan');?>
					<?php echo form_input('satuan',$record['satuan'],array('class'=>'form-control'));?>
				</div>
				<div class="col-md-4">
					<?php echo form_label('Kondisi Penyimpanan *','kondisi_penyimpanan');?>
					<?php echo form_input('kondisi_penyimpanan',$record['kondisi_penyimpanan'],array('class'=>'form-control'));?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<?php echo form_label('Keterangan Release *','keterangan_release');?>
			<?php echo form_textarea($ket_release);?>
		</div>
		<div class="form-group">
			<?php echo form_label('Keterangan Monitoring *','keterangan_monitoring');?>
			<?php echo form_textarea($ket_monitoring);?>
		</div>
		<div class="form-group">
			<?php echo form_label('Referensi *','ref');?>
			<?php echo form_textarea($referensi);?>
		</div>
		<button type="submit" name="submit" class="btn btn-md btn-success">Done</a>
		<?php echo form_close();?>
	</div>
	<br>
</div>

<!-- Readonly Input -->
<script type="text/javascript">
	$(document).ready(function() {
		$('[name=no_db_spek],[name=r_fisik_def],[name=m_fisik_def],[name=revisi]').prop('readonly',true);
		//$('[name=tgl_rkj],[name=no_rkj],[name=kode_item]').prop('readonly',true);
	});
</script>
<!-- /Readonly Input -->

<!-- Bootstrap Datetimepicker-->
<script type="text/javascript">
	$(function () {
		$('.tgl').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	});
</script>
<!-- /Bootstrap Datetimepicker-->