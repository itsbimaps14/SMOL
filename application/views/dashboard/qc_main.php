<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Home</h1>
		<?php
		if($this->session->flashdata('msg_success')) {?>
			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<?php echo $this->session->flashdata('msg_success');?>
			</div>
		<?php }?>
	</div>
</div>

<div class="row">
	<div class="col-md-3 col-sm-3 col-xs-6">
		<div class="dashboard-div-wrapper bk-clr-one">
			<a href="<?php echo base_url().'belum_analisa';?>">
				<?php $data = data_proses('Belum Analisa QC'); ?>
				<?php echo $data['fa'];?>
			</a>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				</div>
			</div>
			<h5><?php echo $data['text'];?></h5>
			<h5>'Belum Analisa QC'</h5>
		</div>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-6">
		<div class="dashboard-div-wrapper bk-clr-two">
			<a href="<?php echo base_url().'analisa_qc';?>">
				<?php $data = data_proses('Analisa QC'); ?>
				<?php echo $data['fa'];?>
			</a>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				</div>
			</div>
			<h5><?php echo $data['text'];?></h5>
			<h5>'Analisa QC'</h5>
		</div>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-6">
		<div class="dashboard-div-wrapper bk-clr-three">
				<?php $data = data_proses('Tahanan'); ?>
				<?php echo $data['fa'];?>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				</div>
			</div>
			<h5><?php echo $data['text'];?></h5>
			<h5>'Tahanan'</h5>
		</div>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-6">
		<div class="dashboard-div-wrapper bk-clr-four">
			<a href="<?php echo base_url().'ok_pending';?>">
				<?php $data = data_proses('OK Pending Monitoring'); ?>
				<?php echo $data['fa'];?>
			</a>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				</div>
			</div>
			<h5><?php echo $data['text'];?></h5>
			<h5>'OK Pending Monitoring'</h5>
		</div>
	</div>	
</div>