<?php
$session_nama = $this->session->userdata('nama');
$nama = strtoupper(substr($session_nama, 0,1));
$session_id = $this->session->userdata('id_user');
$session_level = $this->session->userdata('level');
$session_dept = $this->session->userdata('dept');
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
			<li id="data" class="treeview">
				<a href="#">
					<i class="fa fa-files-o"></i> <span>Data</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li id="data-hp" class="treeview">
						<a href="<?php echo base_url().'rd/view_proses';?>">
							<i class="fa fa-clipboard"></i> Harus Proses
						</a>
					</li>
					<li id="data-dn" class="treeview">
						<a href="<?php echo base_url().'rd/view_done';?>">
							<i class="fa fa-clipboard"></i> Done
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
			case 'view_proses':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> RD Tahanan</a></li>
					<li>Data</li>
					<li class="active">Harus Proses</li>';
			break;
			case 'view_done':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> RD Tahanan</a></li>
					<li>Data</li>
					<li class="active">Done</li>';
			break;
			default:
				switch ($get_1) {
					case 'rd':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> RD Tahanan</a></li>
							<li class="active">Home</li>';
					break;
					case 'spek':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> RD Tahanan</a></li>
							<li class="active">Spek</li>';
					break;
				}
			break;
		}
	?>
	var index_1 = '<?php echo $get_1;?>';
	var index_2 = '<?php echo $get_2;?>';
	switch(index_2){
		case 'view_proses' :
			$('.treeview').removeClass('active');
			$('#data').addClass('active');
			$('#data-hp').addClass('active');
		break;
		case 'view_done' :
			$('.treeview').removeClass('active');
			$('#data').addClass('active');
			$('#data-dn').addClass('active');
		break;
		default :
			switch(index_1){
				case 'rd':
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