<?php
$session_nama = $this->session->userdata('nama');
$nama = strtoupper(substr($session_nama, 0,1));
$session_id = $this->session->userdata('id_user');
$session_level = $this->session->userdata('level');
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
				<a href="#"><i class="fa fa-circle text-success"></i> <?php echo $session_level ?></a>
			</div>
		</div>

		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li id="home" class="treeview">
				<a href="<?php echo base_url().'dashboard';?>">
					<i class="fa fa-dashboard"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<li id="spek" class="treeview">
				<a href="<?php echo base_url().'spek';?>">
					<i class="fa fa-database"></i> <span>Database Spek</span>
				</a>
			</li>
			<li id="kontak" class="treeview">
				<a href="<?php echo base_url().'contact';?>">
					<i class="fa fa-envelope"></i> <span>Contact</span>
				</a>
			</li>
			<li id="fsc" class="treeview">
				<a href="#">
					<i class="fa fa-user-circle"></i>
					<span>FSC / PSA</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li id="fsc-home" class="treeview">
						<a href="<?php echo base_url().'psa';?>"
							><i class="fa fa-home"></i> Home
						</a>
					</li>
					<li id="fsc-data" class="treeview">
						<a href="#">
							<i class="fa fa-list"></i> <span>Data</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li id="fsc-data-ba" class="treeview">
								<a href="<?php echo base_url().'psa/belum_analisa';?>">
									<i class="fa fa-minus-square"></i> Belum Diproses
								</a>
							</li>
							<li id="fsc-data-a" class="treeview">
								<a href="#">
									<i class="fa fa-plus-square "></i> Sedang Diproses
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li id="fsc-data-a-all" class="treeview">
										<a href="<?php echo base_url().'psa/proses_all';?>">
											<i class="fa fa-minus-square"></i> All
										</a>
									</li>
									<li id="fsc-data-a-aqc" class="treeview">
										<a href="<?php echo base_url().'psa/analisa_qc';?>">
											<i class="fa fa-minus-square"></i> Analisa QC
										</a>
									</li>
									<li id="fsc-data-a-thn" class="treeview">
										<a href="<?php echo base_url().'psa/tahanan';?>">
											<i class="fa fa-minus-square"></i> Tahanan
										</a>
									</li>
									<li id="fsc-data-a-rpar" class="treeview">
										<a href="<?php echo base_url().'psa/released_partial';?>">
											<i class="fa fa-minus-square"></i> Released Partial
										</a>
									</li>
									<li id="fsc-data-a-pmon" class="treeview">
										<a href="<?php echo base_url().'psa/pending_monitoring';?>">
											<i class="fa fa-minus-square"></i> Pending Monitoring
										</a>
									</li>
								</ul>
							</li>
							<li id="fsc-data-finish" class="treeview">
								<a href="<?php echo base_url().'psa/finish';?>">
									<i class="fa fa-minus-square"></i> Telah Diproses
								</a>
							</li>
							<li id="fsc-data-reject" class="treeview">
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
				</ul>
			</li>
			<li id="qc" class="treeview">
				<a href="#">
					<i class="fa fa-user-circle"></i>
					<span>QC</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li id="qc-home" class="treeview">
						<a href="<?php echo base_url().'qc';?>">
							<i class="fa fa-home"></i> Home
						</a>
					</li>
					<li id="qc-data" class="treeview">
						<a href="#">
							<i class="fa fa-files-o"></i> <span>Data</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li id="qc-data-ba" class="treeview">
								<a href="<?php echo base_url().'belum_analisa';?>">
									<i class="fa fa-clipboard"></i> Belum Analisa QC
								</a>
							</li>
							<li id="qc-data-aq" class="treeview">
								<a href="<?php echo base_url().'analisa_qc';?>">
									<i class="fa fa-clipboard"></i> Analisa QC
								</a>
							</li>
							<li id="qc-data-rp" class="treeview">
								<a href="<?php echo base_url().'released_partial';?>">
									<i class="fa fa-clipboard"></i> Released Partial
								</a>
							</li>
							<li id="qc-data-th" class="treeview">
								<a href="#">
									<i class="fa fa-files-o"></i> Tahanan
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li id="qc-data-th-rd" class="treeview">
										<a href="<?php echo base_url().'tahanan_rd';?>">
											<i class="fa fa-clipboard"></i> Tahanan RD
										</a>
									</li>
									<li id="qc-data-th-qc" class="treeview">
										<a href="<?php echo base_url().'tahanan_qc';?>">
											<i class="fa fa-clipboard"></i> Tahanan QC
										</a>
									</li>
								</ul>
							</li>
							<li id="qc-data-ok" class="treeview">
								<a href="#">
									<i class="fa fa-files-o"></i> OK
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li id="qc-data-ok-pm" class="treeview">
										<a href="<?php echo base_url().'ok_pending';?>">
											<i class="fa fa-clipboard"></i> Pending Monitoring
										</a>
									</li>
									<li id="qc-data-ok-th" class="treeview">
										<a href="#">
											<i class="fa fa-files-o"></i> Tahanan<i class="fa fa-angle-left pull-right"></i>
										</a>
										<ul class="treeview-menu">
											<li id="qc-data-ok-th-rd" class="treeview">
												<a href="<?php echo base_url().'ok_tahanan_rd';?>">
													<i class="fa fa-clipboard"></i> Tahanan RD
												</a>
											</li>
											<li id="qc-data-ok-th-qc" class="treeview">
												<a href="<?php echo base_url().'ok_tahanan_qc';?>">
													<i class="fa fa-clipboard"></i> Tahanan QC
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
							<li id="qc-data-rj" class="treeview">
								<a href="#">
									<i class="fa fa-files-o"></i> Reject
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li id="qc-data-rj-rr" class="treeview">
										<a href="<?php echo base_url().'reject_release';?>">
											<i class="fa fa-clipboard"></i> Reject Release
										</a>
									</li>
									<li id="qc-data-rj-rm" class="treeview">
										<a href="<?php echo base_url().'reject_monitoring';?>">
											<i class="fa fa-clipboard"></i> Reject Monitoring
										</a>
									</li>
								</ul>
							</li>
							<li id="qc-data-cl" class="treeview">
								<a href="#">
									<i class="fa fa-files-o"></i> Closed
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
									<li id="qc-data-cl-oc" class="treeview">
										<a href="<?php echo base_url().'ok_closed';?>">
											<i class="fa fa-clipboard"></i> OK Closed
										</a>
									</li>
									<li id="qc-data-cl-ob" class="treeview">
										<a href="<?php echo base_url().'ok_bersyarat';?>">
											<i class="fa fa-clipboard"></i> OK Bersyarat
										</a>
									</li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li id="rd" class="treeview">
				<a href="#">
					<i class="fa fa-user-circle"></i>
					<span>Tahanan</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li id="rd-home" class="treeview">
						<a href="<?php echo base_url().'rd';?>">
							<i class="fa fa-home"></i> Home
						</a>
					</li>
					<li id="rd-data" class="treeview">
						<a href="#">
							<i class="fa fa-files-o"></i> <span>Data RD</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li id="rd-data-hp" class="treeview">
								<a href="<?php echo base_url().'rd/view_proses';?>">
									<i class="fa fa-clipboard"></i> Harus Proses
								</a>
							</li>
							<li id="rd-data-dn" class="treeview">
								<a href="<?php echo base_url().'rd/view_done';?>">
									<i class="fa fa-clipboard"></i> Done
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li id="produksi" class="treeview">
				<a href="#">
					<i class="fa fa-user-circle"></i>
					<span>Produksi</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li id="produksi-home" class="treeview">
						<a href="<?php echo base_url().'produksi';?>">
							<i class="fa fa-home"></i>
							<span>Home</span>
						</a>
					</li>
					<li id='produksi-home-permintaan' class="treeview">
						<a href="<?php echo base_url().'produksi/permintaan';?>">
							<i class="fa fa-share"></i>
							<span>Permintaan</span>
						</a>
					</li>
					<li id="produksi-home-penerimaan" class="treeview">
						<a href="<?php echo base_url().'produksi/penerimaan';?>">
							<i class="fa fa-reply"></i>
							<span>Penerimaan</span>
						</a>
					</li>
					<li id="produksi-home-stok" class="treeview">
						<a href="#">
							<i class="fa fa-industry"></i> <span>Stok</span>
							<i class="fa fa-angle-left pull-right"></i>
						</a>
						<ul class="treeview-menu">
							<li id="produksi-home-stok-gudang" class="treeview">
								<a href="<?php echo base_url().'produksi/gudang';?>">
									<i class="fa fa-archive"></i> Gudang Produksi
								</a>
							</li>
							<li id="produksi-home-stok-log" class="treeview">
								<a href="<?php echo base_url().'produksi/log';?>">
									<i class="fa fa-history"></i> Log
								</a>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li id="mdata" class="treeview">
				<a href="#">
					<i class="fa fa-archive"></i>
					<span>Master Data</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li id="mdata-golongan" class="treeview"><a href="<?php echo base_url().'golongan';?>"><i class="fa fa-files-o"></i> M. Golongan</a></li>
					<li id="mdata-kat-spek" class="treeview"><a href="<?php echo base_url().'kat_spek';?>"><i class="fa fa-files-o"></i> M. Kategori Spek</a></li>
					<li id="mdata-parameter" class="treeview"><a href="<?php echo base_url().'parameter';?>"><i class="fa fa-files-o"></i> M. Parameter</a></li>
				</ul>
			</li>
			<li id="report" class="treeview">
				<a href="#">
					<i class="fa fa-list-ul"></i>
					<span>Report</span>
					<i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li id="report-rel" class="treeview"><a href="<?php echo base_url().'report_par/release';?>"><i class="fa fa-clipboard"></i> P. Release</a></li>
					<li id="report-mon" class="treeview"><a href="<?php echo base_url().'report_par/monitoring';?>"><i class="fa fa-clipboard"></i> P. Monitoring</a></li>
					<li id="report-ked" class="treeview"><a href="<?php echo base_url().'psa/report';?>"><i class="fa fa-clipboard"></i> Kedatangan</a></li>
					<li id="report-tah" class="treeview"><a href="<?php echo base_url().'rd/report';?>"><i class="fa fa-clipboard"></i> Tahanan</a></li>
				</ul>
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
		switch($get_2){
			case 'belum_analisa':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>FSC / PSA</li>
					<li>Data</li>
					<li class="active">Belum Analisa</li>';
			break;
			case 'proses_all':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>FSC / PSA</li>
					<li>Data</li>
					<li>Sedang Diproses</li>
					<li class="active">Proses All</li>';
			break;
			case 'analisa_qc':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>FSC / PSA</li>
					<li>Data</li>
					<li>Sedang Diproses</li>
					<li class="active">Analisa QC</li>';
			break;
			case 'tahanan':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>FSC / PSA</li>
					<li>Data</li>
					<li>Sedang Diproses</li>
					<li class="active">Tahanan</li>';
			break;
			case 'released_partial':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>FSC / PSA</li>
					<li>Data</li>
					<li>Sedang Diproses</li>
					<li class="active">Released Partial</li>';
			break;
			case 'pending_monitoring':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>FSC / PSA</li>
					<li>Data</li>
					<li>Sedang Diproses</li>
					<li class="active">Pending Monitrong</li>';
			break;
			case 'finish':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>FSC / PSA</li>
					<li>Data</li>
					<li class="active">Telah Diproses</li>';
			break;
			case 'reject':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>FSC / PSA</li>
					<li>Data</li>
					<li class="active">Telah Direject</li>';
			break;
			case 'view_proses':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>Data</li>
					<li class="active">Harus Proses</li>';
			break;
			case 'view_done':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>Data</li>
					<li class="active">Done</li>';
			break;
			case 'permintaan':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>Produksi</li>
					<li class="active">Permintaan</li>';
			break;
			case 'penerimaan':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>Produksi</li>
					<li class="active">Penerimaan</li>';
			break;
			case 'gudang':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>Produksi</li>
					<li>Stok</li>
					<li class="active">Gudang</li>';
			break;
			case 'log':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>Produksi</li>
					<li>Stok</li>
					<li class="active">Log</li>';
			break;
			case 'release':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>Report</li>
					<li class="active">Report Release</li>';
			break;
			case 'monitoring':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>Report</li>
					<li class="active">Report Monitoring</li>';
			break;
			case 'report':
				$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
					<li>Report</li>
					<li class="active">Report Kedatangan</li>';
			break;
			default :
				switch ($get_1) {
					case 'dashboard':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li class="active">Dashboard</li>';
					break;
					case 'user':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li class="active">User</li>';
					break;
					case 'spek':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li class="active">Spek</li>';
					break;
					case 'contact':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li class="active">Contact</li>';
					break;
					case 'psa':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>FSC / PSA</li>
							<li class="active">Home</li>';
					break;
					case 'qc':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>QC</li>
							<li class="active">Home</li>';
					break;
					case 'belum_analisa':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>QC</li>
							<li>Data</li>
							<li class="active">Belum Analisa</li>';
					break;
					case 'analisa_qc':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>QC</li>
							<li>Data</li>
							<li class="active">Analisa QC</li>';
					break;
					case 'released_partial':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>QC</li>
							<li>Data</li>
							<li class="active">Released Partial</li>';
					break;
					case 'tahanan_rd':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>QC</li>
							<li>Data</li>
							<li>Tahanan</li>
							<li class="active">Tahanan RD</li>';
					break;
					case 'tahanan_qc':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>QC</li>
							<li>Data</li>
							<li>Tahanan</li>
							<li class="active">Tahanan QC</li>';
					break;
					case 'ok_pending':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>QC</li>
							<li>Data</li>
							<li>OK</li>
							<li class="active">Pending Monitoring</li>';
					break;
					case 'ok_tahanan_rd':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>QC</li>
							<li>Data</li>
							<li>OK</li>
							<li>Tahanan</li>
							<li class="active">Tahanan RD</li>';
					break;
					case 'ok_tahanan_qc':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>QC</li>
							<li>Data</li>
							<li>OK</li>
							<li>Tahanan</li>
							<li class="active">Tahanan QC</li>';
					break;
					case 'reject_release':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>QC</li>
							<li>Data</li>
							<li>Reject</li>
							<li class="active">Reject Release</li>';
					break;
					case 'reject_monitoring':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>QC</li>
							<li>Data</li>
							<li>Reject</li>
							<li class="active">Reject Monitoring</li>';
					break;
					case 'ok_closed':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>QC</li>
							<li>Data</li>
							<li>Closed</li>
							<li class="active">OK Closed</li>';
					break;
					case 'ok_bersyarat':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>QC</li>
							<li>Data</li>
							<li>Closed</li>
							<li class="active">OK Bersayarat</li>';
					break;
					case 'rd':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li class="active">RD Tahanan</li>';
					break;
					case 'produksi':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li class="active">Produksi</li>';
					break;
					case 'golongan':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>Master Data</li>
							<li class="active">Master Golongan</li>';
					break;
					case 'kat_spek':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>Master Data</li>
							<li class="active">Master Kategori Spek</li>';
					break;
					case 'parameter':
						$breadcrumb = '<li><a href="#"><i class="fa fa-bookmark-o"></i> Admin</a></li>
							<li>Master Data</li>
							<li class="active">Master Parameter</li>';
					break;
				}
			break;
		}
	?>
	var index_1 = '<?php echo $get_1;?>';
	var index_2 = '<?php echo $get_2;?>';
	switch(index_2){
		case 'belum_analisa':
			$('.treeview').removeClass('active');
			$('#fsc').addClass('active');
			$('#fsc-data').addClass('active');
			$('#fsc-data-ba').addClass('active');
		break;
		case 'proses_all':
			$('.treeview').removeClass('active');
			$('#fsc').addClass('active');
			$('#fsc-data').addClass('active');
			$('#fsc-data-a').addClass('active');
			$('#fsc-data-a-all').addClass('active');
		break;
		case 'analisa_qc':
			$('.treeview').removeClass('active');
			$('#fsc').addClass('active');
			$('#fsc-data').addClass('active');
			$('#fsc-data-a').addClass('active');
			$('#fsc-data-a-aqc').addClass('active');
		break;
		case 'tahanan':
			$('.treeview').removeClass('active');
			$('#fsc').addClass('active');
			$('#fsc-data').addClass('active');
			$('#fsc-data-a').addClass('active');
			$('#fsc-data-a-thn').addClass('active');
		break;
		case 'released_partial':
			$('.treeview').removeClass('active');
			$('#fsc').addClass('active');
			$('#fsc-data').addClass('active');
			$('#fsc-data-a').addClass('active');
			$('#fsc-data-a-rpar').addClass('active');
		break;
		case 'pending_monitoring':
			$('.treeview').removeClass('active');
			$('#fsc').addClass('active');
			$('#fsc-data').addClass('active');
			$('#fsc-data-a').addClass('active');
			$('#fsc-data-a-pmon').addClass('active');
		break;
		case 'finish':
			$('.treeview').removeClass('active');
			$('#fsc').addClass('active');
			$('#fsc-data').addClass('active');
			$('#fsc-data-finish').addClass('active');
		break;
		case 'reject':
			$('.treeview').removeClass('active');
			$('#fsc').addClass('active');
			$('#fsc-data').addClass('active');
			$('#fsc-data-reject').addClass('active');
		break;
		case 'view_proses' :
			$('.treeview').removeClass('active');
			$('#rd').addClass('active');
			$('#rd-data').addClass('active');
			$('#rd-data-hp').addClass('active');
		break;
		case 'view_done' :
			$('.treeview').removeClass('active');
			$('#rd').addClass('active');
			$('#rd-data').addClass('active');
			$('#rd-data-dn').addClass('active');
		break;
		case 'release' :
			$('.treeview').removeClass('active');
			$('#report').addClass('active');
			$('#report-rel').addClass('active');
		break;
		case 'monitoring' :
			$('.treeview').removeClass('active');
			$('#report').addClass('active');
			$('#report-mon').addClass('active');
		break;
		case 'report' :
			$('.treeview').removeClass('active');
			$('#report').addClass('active');
			$('#report-ked').addClass('active');
		break;
		default:
			switch(index_1){
				case 'dashboard' :
					$('.treeview').removeClass('active');
					$('#home').addClass('active');
				break;
				case 'user' :
					$('.treeview').removeClass('active');
					$('#home').addClass('active');
				break;
				case 'spek' :
					$('.treeview').removeClass('active');
					$('#spek').addClass('active');
				break;
				case 'contact' :
					$('.treeview').removeClass('active');
					$('#kontak').addClass('active');
				break;
				case 'psa' :
					$('.treeview').removeClass('active');
					$('#fsc').addClass('active');
					$('#fsc-home').addClass('active');
				break;
				case 'qc' :
					$('.treeview').removeClass('active');
					$('#qc').addClass('active');
					$('#qc-home').addClass('active');
				break;
				case 'belum_analisa' :
					$('.treeview').removeClass('active');
					$('#qc').addClass('active');
					$('#qc-data').addClass('active');
					$('#qc-data-ba').addClass('active');
				break;
				case 'analisa_qc' :
					$('.treeview').removeClass('active');
					$('#qc').addClass('active');
					$('#qc-data').addClass('active');
					$('#qc-data-aq').addClass('active');
				break;
				case 'released_partial' :
					$('.treeview').removeClass('active');
					$('#qc').addClass('active');
					$('#qc-data').addClass('active');
					$('#qc-data-rp').addClass('active');
				break;
				case 'tahanan_rd' :
					$('.treeview').removeClass('active');
					$('#qc').addClass('active');
					$('#qc-data').addClass('active');
					$('#qc-data-th').addClass('active');
					$('#qc-data-th-rd').addClass('active');
				break;
				case 'tahanan_qc' :
					$('.treeview').removeClass('active');
					$('#qc').addClass('active');
					$('#qc-data').addClass('active');
					$('#qc-data-th').addClass('active');
					$('#qc-data-th-qc').addClass('active');
				break;
				case 'ok_pending' :
					$('.treeview').removeClass('active');
					$('#qc').addClass('active');
					$('#qc-data').addClass('active');
					$('#qc-data-ok').addClass('active');
					$('#qc-data-ok-pm').addClass('active');
				break;
				case 'ok_tahanan_rd' :
					$('.treeview').removeClass('active');
					$('#qc').addClass('active');
					$('#qc-data').addClass('active');
					$('#qc-data-ok').addClass('active');
					$('#qc-data-ok-th').addClass('active');
					$('#qc-data-ok-th-rd').addClass('active');
				break;
				case 'ok_tahanan_qc' :
					$('.treeview').removeClass('active');
					$('#qc').addClass('active');
					$('#qc-data').addClass('active');
					$('#qc-data-ok').addClass('active');
					$('#qc-data-ok-th').addClass('active');
					$('#qc-data-ok-th-qc').addClass('active');
				break;
				case 'reject_release' :
					$('.treeview').removeClass('active');
					$('#qc').addClass('active');
					$('#qc-data').addClass('active');
					$('#qc-data-rj').addClass('active');
					$('#qc-data-rj-rr').addClass('active');
				break;
				case 'reject_monitoring' :
					$('.treeview').removeClass('active');
					$('#qc').addClass('active');
					$('#qc-data').addClass('active');
					$('#qc-data-rj').addClass('active');
					$('#qc-data-rj-rm').addClass('active');
				break;
				case 'ok_closed' :
					$('.treeview').removeClass('active');
					$('#qc').addClass('active');
					$('#qc-data').addClass('active');
					$('#qc-data-cl').addClass('active');
					$('#qc-data-cl-oc').addClass('active');
				break;
				case 'ok_bersyarat' :
					$('.treeview').removeClass('active');
					$('#qc').addClass('active');
					$('#qc-data').addClass('active');
					$('#qc-data-cl').addClass('active');
					$('#qc-data-cl-ob').addClass('active');
				break;
				case 'rd':
					$('.treeview').removeClass('active');
					$('#rd').addClass('active');
					$('#rd-home').addClass('active');
				break;
				case 'produksi':
					$('.treeview').removeClass('active');
					$('#produksi').addClass('active');
					$('#produksi-home').addClass('active');
				break;
				case 'golongan':
					$('.treeview').removeClass('active');
					$('#mdata').addClass('active');
					$('#mdata-golongan').addClass('active');
				break;
				case 'kat_spek':
					$('.treeview').removeClass('active');
					$('#mdata').addClass('active');
					$('#mdata-kat-spek').addClass('active');
				break;
				case 'parameter':
					$('.treeview').removeClass('active');
					$('#mdata').addClass('active');
					$('#mdata-parameter').addClass('active');
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