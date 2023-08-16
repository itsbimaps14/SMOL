<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
$permintaan	= rows_permintaan();
$penerimaan	= rows_penerimaan();
$stoktotal	= rows_stoktotal();
$transaksi	= rows_transaksi();
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Home</h1>
		<?php
		if($this->session->flashdata('msg_login')) {?>
			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<?php echo $this->session->flashdata('msg_login');?>
			</div>
		<?php }?>
		<?php
		if($this->session->flashdata('msg_success')) {?>
			<div class='alert alert-success alert-dismissable'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
				<?php echo $this->session->flashdata('msg_success');?>
			</div>
		<?php }?>
	</div>
</div>

<div class="row">
	<div class="col-md-3 col-sm-3 col-xs-6">
		<div class="dashboard-div-wrapper bk-clr-one">
			<a href="<?php echo base_url().'produksi/permintaan';?>"><i  class="fa fa-level-up dashboard-div-icon" ></i></a>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				</div>
			</div>
			<h5><?php echo $permintaan; ?> DATA PERMINTAAN BELUM PROSES </h5>
		</div>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-6">
		<div class="dashboard-div-wrapper bk-clr-two">
			<a href="<?php echo base_url().'produksi/penerimaan';?>"><i  class="fa fa-level-down dashboard-div-icon" ></i></a>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				</div>
			</div>
			<h5><?php echo $penerimaan; ?> DATA PERMINTAAN HARUS PROSES </h5>
		</div>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-6">
		<div class="dashboard-div-wrapper bk-clr-three">
			<a href="<?php echo base_url().'produksi/gudang';?>"><i  class="fa fa-truck dashboard-div-icon" ></i></a>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				</div>
			</div>
			<h5><?php echo $stoktotal; ?> STOK SUPPORTING MATERIAL PRODUKSI </h5>
		</div>
	</div>
	<div class="col-md-3 col-sm-3 col-xs-6">
		<div class="dashboard-div-wrapper bk-clr-four">
			<a href="<?php echo base_url().'produksi/log';?>"><i  class="fa fa-database dashboard-div-icon" ></i></a>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
				</div>
			</div>
			<h5><?php echo $transaksi; ?> PROSES TRANSAKSI BARANG BULAN INI </h5>
		</div>
	</div>	
</div>