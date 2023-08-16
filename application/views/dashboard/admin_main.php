<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
$user 	= rows_user();
$kontak = rows_kontak();
$total 	= rows_total();
$aktif 	= rows_aktif();
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Dashboard</h1>
		<?php
		if($this->session->flashdata('msg_login')) {?>
			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<?php echo $this->session->flashdata('msg_login');?>
			</div>
		<?php }?>
	</div>
</div>

<div class="row">
	<div class="col-md-3 col-sm-3 col-xs-6">
		<div class="dashboard-div-wrapper bk-clr-one">
			<a href="<?php echo base_url().'user';?>"><i  class="fa fa-group dashboard-div-icon" ></i></a>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				</div>
			</div>
			<h5><?php echo $user; ?> USER TERDAFTAR </h5>
		</div>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-6">
		<div class="dashboard-div-wrapper bk-clr-two">
			<a href="<?php echo base_url().'contact';?>"><i  class="fa fa-envelope dashboard-div-icon" ></i></a>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				</div>
			</div>
			<h5><?php echo $kontak; ?> KONTAK TERDAFTAR </h5>
		</div>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-6">
		<div class="dashboard-div-wrapper bk-clr-three">
			<i  class="fa fa-database dashboard-div-icon" ></i>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				</div>
			</div>
			<h5><?php echo $total; ?> TOTAL DATA SPEK </h5>
		</div>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-6">
		<div class="dashboard-div-wrapper bk-clr-four">
			<i  class="fa fa-database dashboard-div-icon" ></i>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				</div>
			</div>
			<h5><?php echo $aktif; ?> DATA SPEK AKTIF </h5>
		</div>
	</div>	
</div>
