<?php
$session_nama 	= $this->session->userdata('nama');
$nama 			= strtoupper(substr($session_nama, 0,1));
$session_id 	= $this->session->userdata('id_user');
$session_level 	= $this->session->userdata('level');
$session_dept 	= $this->session->userdata('dept');
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo base_url().'assets/alpha/'.$nama.'.png';?>" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?php echo $session_nama ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> <?php echo $session_level.' - '.$session_dept ?></a>
			</div>
		</div>

		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li id="home" class="treeview">
				<a href="<?php echo base_url().'dashboard';?>">
					<i class="fa fa-home"></i>
					<span>Home</span>
				</a>
			</li>
			<li id='permintaan' class="treeview">
				<a href="<?php echo base_url().'produksi/permintaan';?>">
					<i class="fa fa-share"></i>
					<span>Permintaan</span>
				</a>
			</li>
			<li id="penerimaan" class="treeview">
				<a href="<?php echo base_url().'produksi/penerimaan';?>">
					<i class="fa fa-reply"></i>
					<span>Penerimaan</span>
				</a>
			</li>
			<li id="stok" class="treeview">
				<a href="#">
					<i class="fa fa-industry"></i> <span>Stok</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li id="stok-gudang" class="treeview">
						<a href="<?php echo base_url().'produksi/gudang';?>">
							<i class="fa fa-archive"></i> Gudang Produksi
						</a>
					</li>
					<li id="stok-log" class="treeview">
						<a href="<?php echo base_url().'produksi/log';?>">
							<i class="fa fa-history"></i> Log
						</a>
					</li>
				</ul>
			</li>
			<li id="spek" class="treeview">
				<a href="<?php echo base_url().'spek';?>">
					<i class="fa fa-database"></i>
					<span>Database Spek</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>

<!-- Active selection script -->
<script type="text/javascript">
	<?php
		$get_1 = $this->uri->segment(1); 
		$get_2 = $this->uri->segment(2);

		//Breadcrumb
		switch ($get_2) {
			case 'permintaan':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Produksi</a></li>
					<li class="active">Permintaan</li>';
			break;

			case 'penerimaan':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Produksi</a></li>
					<li class="active">Penerimaan</li>';
			break;

			case 'gudang':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Produksi</a></li>
					<li>Stok</li>
					<li class="active">Gudang</li>';
			break;

			case 'log':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Produksi</a></li>
					<li>Stok</li>
					<li class="active">Log</li>';
			break;

			default:
				switch ($get_1) {
					case 'produksi':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Produksi</a></li>
							<li class="active">Home</li>';
					break;

					case 'spek':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Produksi</a></li>
							<li class="active">Spek</li>';
					break;
				}
			break;
		}
	?>
	var index_1 = '<?php echo $get_1;?>';
	var index_2 = '<?php echo $get_2;?>';
	switch(index_2){
		case 'permintaan' :
			$('.treeview').removeClass('active');
			$('#permintaan').addClass('active');
		break;

		case 'penerimaan' :
			$('.treeview').removeClass('active');
			$('#penerimaan').addClass('active');
		break;

		case 'gudang' :
			$('.treeview').removeClass('active');
			$('#stok').addClass('active');
			$('#stok-gudang').addClass('active');
		break;

		case 'log' :
			$('.treeview').removeClass('active');
			$('#stok').addClass('active');
			$('#stok-log').addClass('active');
		break;

		default :
			switch(index_1){
				case 'produksi':
					$('.treeview').removeClass('active');
					$('#home').addClass('active');
				break;

				case 'spek':
					$('.treeview').removeClass('active');
					$('#spek').addClass('active');
				break;
			}
		break;
	}
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="background-color: white;" >
	<!-- Content Header (Page header) -->
	<section class="content-header" style="background-color: white;">
		<ol class="breadcrumb">
			<?php echo $breadcrumb;?>
		</ol>
	</section>
	<section class="content" style="background-color: white;">