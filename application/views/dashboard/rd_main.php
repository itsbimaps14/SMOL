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
	<div class="col-md-3 col-md-offset-2">
		<div class="dashboard-div-wrapper bk-clr-two">
			<a href="<?php echo base_url().'rd/view_proses';?>">
				<?php $data = get_nilai_dash_tahanan('Tahanan RD'); ?>
				<?php echo $data['fa'];?>
			</a>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				</div>
			</div>
			<h5><?php echo $data['text'];?></h5>
			<h5>'Harus Proses Tahanan'</h5>
		</div>
	</div>
	<div class="col-md-3 col-md-offset-2">
		<div class="dashboard-div-wrapper bk-clr-three">
			<a href="<?php echo base_url().'rd/view_done';?>">
				<?php $data = get_nilai_dash_tahanan('Tahanan'); ?>
				<?php echo $data['fa'];?>
			</a>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				</div>
			</div>
			<h5><?php echo $data['text'];?></h5>
			<h5>'Telah Proses Tahanan'</h5>
		</div>
	</div>
</div>