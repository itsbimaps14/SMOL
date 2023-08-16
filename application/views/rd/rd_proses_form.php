<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');

$method = $this->uri->segment(2);
$id_t_tahanan = $this->uri->segment(3);

switch ($method) {
	case 'proses':
		$data = array(
			'title'					=> 'Proses Data',
			'no_running'			=> $record['no_running_tahanan'],
			'alasan_tahanan'		=> $record['alasan_tahanan'],
			'spek_tahanan'			=> $record['spek_tahanan'],
			'penyebab'				=> $record['penyebab'],
			'hasil_analisa'			=> $record['hasil_analisa'],
			'tindakan_koreksi'		=> $record['tindakan_koreksi'],
			'pic1'					=> $record['pic1'],
			'tindakan_preventive'	=> $record['tindakan_preventive'],
			'pic2'					=> $record['pic2'],
			'status_tahanan'		=> ''
		);

		$keterangan = array(
			'name'        => 'keterangan_qc',
			'id'          => 'keterangan_qc',
			'value'       => '',
			'rows'        => '3',
			'cols'        => '10',
			'style'       => 'width:50%',
			'class'       => 'form-control',
			'placeholder' => 'Example = Keterangan'
		);
		$hidden = array();
		break;

	case 'edit':
		$data = array(
			'title'					=> 'Edit Data',
			'no_running'			=> $record['no_running_tahanan'],
			'alasan_tahanan'		=> $record['alasan_tahanan'],
			'spek_tahanan'			=> $record['spek_tahanan'],
			'penyebab'				=> $record['penyebab'],
			'hasil_analisa'			=> $record['hasil_analisa'],
			'tindakan_koreksi'		=> $record['tindakan_koreksi'],
			'pic1'					=> $record['pic1'],
			'tindakan_preventive'	=> $record['tindakan_preventive'],
			'pic2'					=> $record['pic2'],
			'status_tahanan'		=> ''
		);

		$keterangan = array(
			'name'        => 'keterangan_qc',
			'id'          => 'keterangan_qc',
			'value'       => '',
			'rows'        => '3',
			'cols'        => '10',
			'style'       => 'width:50%',
			'class'       => 'form-control',
			'placeholder' => 'Example = Keterangan'
		);
		$hidden = array();
		break;
}

?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $data['title'];?> Tahanan RD</h1>
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
		<?php echo form_open_multipart('rd/'.$method,'id=qc_ba_form',$hidden); ?>
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
					<div class="col-md-6">
						<?php echo form_label('Alasan Penahanan.','alasan_tahanan');?>
						<?php echo form_input('alasan_tahanan',$data['alasan_tahanan'],array('class'=>'form-control','placeholder'=>'Example : Alasan'));?>
					</div>
					<div class="col-md-6">
						<?php echo form_label('Spek Tahanan.','spek_tahanan');?>
						<?php echo form_input('spek_tahanan',$data['spek_tahanan'],array('class'=>'form-control','placeholder'=>'Example : Spek'));?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4">
						<?php echo form_label('Penyebab.','penyebab');?>
						<?php echo form_input('penyebab',$data['penyebab'],array('class'=>'form-control','placeholder'=>'Example : Penyebab'));?>
					</div>
					<div class="col-md-4">
						<?php echo form_label('Hasil Analisa.','hasil_analisa');?>
						<?php echo form_input('hasil_analisa',$data['hasil_analisa'],array('class'=>'form-control','placeholder'=>'Example : Hasil Analisa'));?>
					</div>
					<div class="col-md-4">
						<?php echo form_label('Tindakan Koreksi.','tindakan_koreksi');?>
						<?php echo form_input('tindakan_koreksi',$data['tindakan_koreksi'],array('class'=>'form-control','placeholder'=>'Example : Tindakan Koreksi'));?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-4">
						<?php echo form_label('PIC 1.','pic1');?>
						<?php echo form_input('pic1',$data['pic1'],array('class'=>'form-control','placeholder'=>'Example : PIC 1'));?>
					</div>
					<div class="col-md-4">
						<?php echo form_label('Tindakan Preventive.','tindakan_preventive');?>
						<?php echo form_input('tindakan_preventive',$data['tindakan_preventive'],array('class'=>'form-control','placeholder'=>'Example : Tindakan Preventive'));?>
					</div>
					<div class="col-md-4">
						<?php echo form_label('PIC 2.','pic2');?>
						<?php echo form_input('pic2',$data['pic2'],array('class'=>'form-control','placeholder'=>'Example : PIC 2'));?>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<div class="col-md-6">
						<?php echo form_label('Status Tahanan.','status_tahanan');?>
						<?php
							unset($options);
							$options = array(
								''					=> 'Status Tahanan',
								'OK'				=> 'OK',
								'Reject'			=> 'Reject'
							);
							echo form_dropdown('status_tahanan',$options,$data['status_tahanan'],'class="form-control" id=status_tahanan');
						?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<button type="submit" name="submit" class="btn btn-md btn-success">Save & Finalize</a>
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
			$('[name=no_running],[name=alasan_tahanan],[name=spek_tahanan]').prop('readonly',true);
		}
		else{
			$('[name=no_running]').prop('readonly',true);
			$('[name=status_tahanan]').prop('disabled',true);
		}
	});
</script>
<!-- /Readonly Input -->

<!-- Bootstrap Validator -->
<script type="text/javascript">
	$("#qc_ba_form" ).validate( {
		rules: {
			penyebab: "required",
			hasil_analisa: "required",
			tindakan_koreksi: "required",
			pic1: "required",
			preventive: "required",
			pic2: "required",
			status_tahanan: "required"
		}
	});
</script>
<!-- /Bootstrap Validator -->