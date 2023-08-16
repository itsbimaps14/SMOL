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
				<a href="<?php echo base_url().'dashboard/index';?>">
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
					<li id="data-ba" class="treeview">
						<a href="<?php echo base_url().'belum_analisa';?>">
							<i class="fa fa-clipboard"></i> Belum Analisa QC
						</a>
					</li>
					<li id="data-aq" class="treeview">
						<a href="<?php echo base_url().'analisa_qc';?>">
							<i class="fa fa-clipboard"></i> Analisa QC
						</a>
					</li>
					<li id="data-rp" class="treeview">
						<a href="<?php echo base_url().'released_partial';?>">
							<i class="fa fa-clipboard"></i> Released Partial
						</a>
					</li>
					<li id="data-th" class="treeview">
						<a href="#"><i class="fa fa-files-o"></i> Tahanan<i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li id="data-th-rd" class="treeview">
								<a href="<?php echo base_url().'tahanan_rd';?>">
									<i class="fa fa-clipboard"></i> Tahanan RD
								</a>
							</li>
							<li id="data-th-qc" class="treeview">
								<a href="<?php echo base_url().'tahanan_qc';?>">
									<i class="fa fa-clipboard"></i> Tahanan QC
								</a>
							</li>
						</ul>
					</li>
					<li id="data-ok" class="treeview">
						<a href="#">
							<i class="fa fa-files-o"></i> OK
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li id="data-ok-pm" class="treeview">
								<a href="<?php echo base_url().'ok_pending';?>">
									<i class="fa fa-clipboard"></i> Pending Monitoring
								</a>
							</li>
							<li id="data-ok-th" class="treeview">
								<a href="#">
									<i class="fa fa-files-o"></i> Tahanan
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li id="data-ok-th-rd" class="treeview">
										<a href="<?php echo base_url().'ok_tahanan_rd';?>">
											<i class="fa fa-clipboard"></i> Tahanan RD
										</a>
									</li>
									<li id="data-ok-th-qc" class="treeview">
										<a href="<?php echo base_url().'ok_tahanan_qc';?>">
											<i class="fa fa-clipboard"></i> Tahanan QC
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li id="data-rj" class="treeview">
						<a href="#">
							<i class="fa fa-files-o"></i> Reject
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li id="data-rj-rr" class="treeview">
								<a href="<?php echo base_url().'reject_release';?>">
									<i class="fa fa-clipboard"></i> Reject Release
								</a>
							</li>
							<li id="data-rj-rm" class="treeview">
								<a href="<?php echo base_url().'reject_monitoring';?>">
									<i class="fa fa-clipboard"></i> Reject Monitoring
								</a>
							</li>
						</ul>
					</li>
					<li id="data-cl" class="treeview">
						<a href="#">
							<i class="fa fa-files-o"></i> Closed
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li id="data-cl-oc" class="treeview">
								<a href="<?php echo base_url().'ok_closed';?>">
									<i class="fa fa-clipboard"></i> OK Closed
								</a>
							</li>
							<li id="data-cl-ob" class="treeview">
								<a href="<?php echo base_url().'ok_bersyarat';?>">
									<i class="fa fa-clipboard"></i> OK Bersyarat
								</a>
							</li>
						</ul>
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
			default:
				switch ($get_1) {
					case 'qc':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> QC</a></li>
							<li class="active">Home</li>';
					break;
					case 'belum_analisa':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> QC</a></li>
							<li>Data</li>
							<li class="active">Belum Analisa</li>';
					break;
					case 'analisa_qc':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> QC</a></li>
							<li>Data</li>
							<li class="active">Analisa QC</li>';
					break;
					case 'released_partial':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> QC</a></li>
							<li>Data</li>
							<li class="active">Released Partial</li>';
					break;
					case 'tahanan_rd':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> QC</a></li>
							<li>Data</li>
							<li>Tahanan</li>
							<li class="active">Tahanan RD</li>';
					break;
					case 'tahanan_qc':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> QC</a></li>
							<li>Data</li>
							<li>Tahanan</li>
							<li class="active">Tahanan QC</li>';
					break;
					case 'ok_pending':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> QC</a></li>
							<li>Data</li>
							<li>OK</li>
							<li class="active">Pending Monitoring</li>';
					break;
					case 'ok_tahanan_rd':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> QC</a></li>
							<li>Data</li>
							<li>OK</li>
							<li>Tahanan</li>
							<li class="active">Tahanan RD</li>';
					break;
					case 'ok_tahanan_qc':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> QC</a></li>
							<li>Data</li>
							<li>OK</li>
							<li>Tahanan</li>
							<li class="active">Tahanan QC</li>';
					break;
					case 'reject_release':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> QC</a></li>
							<li>Data</li>
							<li>Reject</li>
							<li class="active">Reject Released</li>';
					break;
					case 'reject_monitoring':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> QC</a></li>
							<li>Data</li>
							<li>Reject</li>
							<li class="active">Reject Monitoring</li>';
					break;
					case 'ok_closed':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> QC</a></li>
							<li>Data</li>
							<li>OK</li>
							<li class="active">OK Closed</li>';
					break;
					case 'ok_bersyarat':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> QC</a></li>
							<li>Data</li>
							<li>OK</li>
							<li class="active">OK Bersyarat</li>';
					break;
					case 'spek':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> QC</a></li>
							<li class="active">Spek</li>';
					break;
				}
			break;
		}
	?>
	var index_1 = '<?php echo $get_1;?>';
	var index_2 = '<?php echo $get_2;?>';
	switch(index_2){
		default :
			switch(index_1){
				case 'qc':
					$('.treeview').removeClass('active');
					$('#home').addClass('active');
				break;
				case 'belum_analisa':
					$('.treeview').removeClass('active');
					$('#data').addClass('active');
					$('#data-ba').addClass('active');
				break;
				case 'analisa_qc':
					$('.treeview').removeClass('active');
					$('#data').addClass('active');
					$('#data-aq').addClass('active');
				break;
				case 'released_partial':
					$('.treeview').removeClass('active');
					$('#data').addClass('active');
					$('#data-rp').addClass('active');
				break;
				case 'tahanan_rd':
					$('.treeview').removeClass('active');
					$('#data').addClass('active');
					$('#data-th').addClass('active');
					$('#data-th-rd').addClass('active');
				break;
				case 'tahanan_qc':
					$('.treeview').removeClass('active');
					$('#data').addClass('active');
					$('#data-th').addClass('active');
					$('#data-th-qc').addClass('active');
				break;
				case 'ok_pending':
					$('.treeview').removeClass('active');
					$('#data').addClass('active');
					$('#data-ok').addClass('active');
					$('#data-ok-pm').addClass('active');
				break;
				case 'ok_tahanan_rd':
					$('.treeview').removeClass('active');
					$('#data').addClass('active');
					$('#data-ok').addClass('active');
					$('#data-ok-th').addClass('active');
					$('#data-ok-th-rd').addClass('active');
				break;
				case 'ok_tahanan_qc':
					$('.treeview').removeClass('active');
					$('#data').addClass('active');
					$('#data-ok').addClass('active');
					$('#data-ok-th').addClass('active');
					$('#data-ok-th-qc').addClass('active');
				break;
				case 'reject_release':
					$('.treeview').removeClass('active');
					$('#data').addClass('active');
					$('#data-rj').addClass('active');
					$('#data-rj-rr').addClass('active');
				break;
				case 'reject_monitoring':
					$('.treeview').removeClass('active');
					$('#data').addClass('active');
					$('#data-rj').addClass('active');
					$('#data-rj-rm').addClass('active');
				break;
				case 'ok_closed':
					$('.treeview').removeClass('active');
					$('#data').addClass('active');
					$('#data-cl').addClass('active');
					$('#data-cl-oc').addClass('active');
				break;
				case 'ok_bersyarat':
					$('.treeview').removeClass('active');
					$('#data').addClass('active');
					$('#data-cl').addClass('active');
					$('#data-cl-ob').addClass('active');
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