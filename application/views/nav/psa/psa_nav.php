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
			<li id="input" class="treeview">
				<a href="<?php echo base_url().'psa/add';?>">
					<i class="fa fa-pencil-square-o"></i> <span>Input Kedatangan</span>
				</a>
			</li>
			<li id="data" class="treeview">
				<a href="#">
					<i class="fa fa-list"></i> <span>Data</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li id="data-bp" class="treeview">
						<a href="<?php echo base_url().'psa/belum_analisa';?>">
							<i class="fa fa-minus-square"></i> Belum Diproses
						</a>
					</li>
					<li id="data-sp" class="treeview">
						<a href="#"><i class="fa fa-plus-square ">
							</i> Sedang Diproses<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li id="data-sp-al" class="treeview">
								<a href="<?php echo base_url().'psa/proses_all';?>">
									<i class="fa fa-minus-square"></i> All
								</a>
							</li>
							<li id="data-sp-aq" class="treeview">
								<a href="<?php echo base_url().'psa/analisa_qc';?>">
									<i class="fa fa-minus-square"></i> Analisa QC
								</a>
							</li>
							<li id="data-sp-th" class="treeview">
								<a href="<?php echo base_url().'psa/tahanan';?>">
									<i class="fa fa-minus-square"></i> Tahanan
								</a>
							</li>
							<li id="data-sp-rp" class="treeview">
								<a href="<?php echo base_url().'psa/released_partial';?>">
									<i class="fa fa-minus-square"></i> Released Partial
								</a>
							</li>
							<li id="data-sp-pm" class="treeview">
								<a href="<?php echo base_url().'psa/pending_monitoring';?>">
									<i class="fa fa-minus-square"></i> Pending Monitoring
								</a>
							</li>
						</ul>
					</li>
					<li id="data-tp" class="treeview">
						<a href="<?php echo base_url().'psa/finish';?>">
							<i class="fa fa-minus-square"></i> Telah Diproses
						</a>
					</li>
					<li id="data-tr" class="treeview">
						<a href="<?php echo base_url().'psa/reject';?>">
							<i class="fa fa-minus-square"></i> Telah Direject
						</a>
					</li>
				</ul>
			</li>
			<li id="permintaan" class="treeview">
				<a href="<?php echo base_url().'psa/permintaan';?>">
					<i class="fa fa-reply"></i>
					<span>Permintaan</span>
				</a>
			</li>
			<li id="stok" class="treeview">
				<a href="#">
					<i class="fa fa-industry"></i> <span>Stok</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li id="stok-gudang" class="treeview">
						<a href="<?php echo base_url().'psa/gudang';?>">
							<i class="fa fa-archive"></i> Stok Gudang
						</a>
					</li>
					<li id="stok-log" class="treeview">
						<a href="<?php echo base_url().'psa/log';?>">
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
			case 'add':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> FSC / PSA</a></li>
					<li class="active">Input Kedatangan</li>';
			break;
			case 'belum_analisa':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> FSC / PSA</a></li>
					<li>Data</li>
					<li class="active">Belum Analisa</li>';
			break;
			case 'proses_all':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> FSC / PSA</a></li>
					<li>Data</li>
					<li>Sedang Proses</li>
					<li class="active">Proses All</li>';
			break;
			case 'analisa_qc':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> FSC / PSA</a></li>
					<li>Data</li>
					<li>Sedang Proses</li>
					<li class="active">Analisa QC</li>';
			break;
			case 'tahanan':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> FSC / PSA</a></li>
					<li>Data</li>
					<li>Sedang Proses</li>
					<li class="active">Tahanan</li>';
			break;
			case 'released_partial':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> FSC / PSA</a></li>
					<li>Data</li>
					<li>Sedang Proses</li>
					<li class="active">Released Partial</li>';
			break;
			case 'pending_monitoring':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> FSC / PSA</a></li>
					<li>Data</li>
					<li>Sedang Proses</li>
					<li class="active">Pending Monitoring</li>';
			break;
			case 'finish':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> FSC / PSA</a></li>
					<li>Data</li>
					<li class="active">Finish</li>';
			break;
			case 'reject':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> FSC / PSA</a></li>
					<li>Data</li>
					<li class="active">Reject</li>';
			break;
			case 'permintaan':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> FSC / PSA</a></li>
					<li class="active">Permintaan</li>';
			break;
			default:
				switch ($get_1) {
					case 'psa':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> FSC / PSA</a></li>
							<li class="active">Home</li>';
					break;
					case 'spek':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> FSC / PSA</a></li>
							<li class="active">Spek</li>';
					break;
				}
			break;
		}
	?>
	var index_1 = '<?php echo $get_1;?>';
	var index_2 = '<?php echo $get_2;?>';
	switch(index_2){
		case 'add' :
			$('.treeview').removeClass('active');
			$('#input').addClass('active');
		break;
		case 'belum_analisa' :
			$('.treeview').removeClass('active');
			$('#data').addClass('active');
			$('#data-bp').addClass('active');
		break;
		case 'proses_all' :
			$('.treeview').removeClass('active');
			$('#data').addClass('active');
			$('#data-sp').addClass('active');
			$('#data-sp-al').addClass('active');
		break;
		case 'analisa_qc' :
			$('.treeview').removeClass('active');
			$('#data').addClass('active');
			$('#data-sp').addClass('active');
			$('#data-sp-aq').addClass('active');
		break;
		case 'tahanan' :
			$('.treeview').removeClass('active');
			$('#data').addClass('active');
			$('#data-sp').addClass('active');
			$('#data-sp-th').addClass('active');
		break;
		case 'released_partial' :
			$('.treeview').removeClass('active');
			$('#data').addClass('active');
			$('#data-sp').addClass('active');
			$('#data-sp-rp').addClass('active');
		break;
		case 'pending_monitoring' :
			$('.treeview').removeClass('active');
			$('#data').addClass('active');
			$('#data-sp').addClass('active');
			$('#data-sp-pm').addClass('active');
		break;
		case 'finish' :
			$('.treeview').removeClass('active');
			$('#data').addClass('active');
			$('#data-tp').addClass('active');
		break;
		case 'reject' :
			$('.treeview').removeClass('active');
			$('#data').addClass('active');
			$('#data-tr').addClass('active');
		break;
		case 'permintaan' :
			$('.treeview').removeClass('active');
			$('#permintaan').addClass('active');
		break;
		default :
			switch(index_1){
				case 'psa':
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
			<?php echo $breadcrumb; ?>
		</ol>
	</section>
<section class="content" style="background-color: white;">