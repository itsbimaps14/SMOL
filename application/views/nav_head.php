<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>SMOL</title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="shorcut icon" href="<?php echo base_url();?>assets/icon.png">
		<!-- Bootstrap Core CSS -->
		<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<!-- Custom Fonts -->
		<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<!-- Custom CSS -->
		<link href="<?php echo base_url();?>assets/custom.css" rel="stylesheet">
		<!-- MetisMenu CSS -->
		<link href="<?php echo base_url();?>assets/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
		<!-- Datatables CSS -->
		<link href="<?php echo base_url();?>assets/datatables/media/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<!-- jasny-bootstrap CSS -->
		<link href="<?php echo base_url();?>assets/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
		<!-- Bootstrap Datetimepicker CSS-->
		<link href="<?php echo base_url();?>assets/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		<!-- amchart plugin -->
		<link href="<?php echo base_url();?>assets/amcharts/plugins/export/export.css" rel="stylesheet">
		<!-- Select2 -->
		<link href="<?php echo base_url();?>assets/select2/dist/css/select2.min.css" rel="stylesheet">
		<!-- jQuery -->
		<script src="<?php echo base_url();?>assets/jquery.min.js"></script>
		<!-- jquery-validation JavaScript -->
		<script src="<?php echo base_url();?>assets/jquery-validation/dist/jquery.validate.js"></script>
		<!-- Moment -->
		<script src="<?php echo base_url();?>assets/moment/min/moment.min.js"></script>
		<!-- Bootstrap Datetimepicker JavaScript -->
		<script src="<?php echo base_url();?>assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.css">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
		<style type="text/css">
			input[type=number]::-webkit-inner-spin-button,
			input[type=number]::-webkit-outer-spin-button {
				-webkit-appearance: none;
				-moz-appearance: none;
				appearance: none;
				margin: 0;
			}
			form.cmxform label.error, label.error {
				color: red;
				font-style: italic
			}
			div.error { display: none; }
			input.checkbox { border: none }
			input.error, textarea.error { border: 1px solid red; }

			.sidebar-menu .treeview-menu > li > a {
				font-size: 12px;
			}
		</style>
	</head>


	<body class="hold-transition skin-green sidebar-mini">
	<div class="wrapper">
		<header class="main-header">
			<!-- Logo -->
			<a href="<?php echo base_url().'dashboard';?>" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b></b>NFI</span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>SMOL - Nutrifood</b></span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<!-- Navbar Right Menu -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li>
							<a href="<?php echo base_url().'profile';?>"><i class="fa fa-user"></i> Profile</a>
						</li>
						<li>
							<a href="<?php echo base_url().'auth/logout';?>"><i class="fa fa-sign-out"></i> Logout</a>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<!-- echo content -->
		
				<?php echo $contents;?>
			</section>
		</div>
		<!-- /.content-wrapper -->

		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<strong>&copy Copyright 2017 SMOL v.1.0 - Framework CodeIgniter</strong>
			</div>
			<strong>.</strong>
		</footer>
	</div>
<!-- ./wrapper -->

	<!-- DataTables JavaScript -->
	<script src="<?php echo base_url();?>assets/datatables/media/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>assets/datatables/media/dataTables.bootstrap.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="<?php echo base_url();?>assets/metisMenu/dist/metisMenu.min.js"></script>

	<!-- Select2 -->
	<script src="<?php echo base_url();?>assets/select2/dist/js/select2.full.min.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="<?php echo base_url();?>assets/custom.js"></script>

	<!-- export excel-->
	<script src="<?php echo base_url();?>assets/datatables-excel/buttons.html5.min.js"></script>
	<script src="<?php echo base_url();?>assets/datatables-excel/dataTables.buttons.min.js"></script>
	<script src="<?php echo base_url();?>assets/datatables-excel/jszip.min.js"></script>

	<!-- AdminLTE App -->
	<script src="<?php echo base_url();?>assets/dist/js/app.min.js"></script>

	<!-- jasny-bootstrap JavaScript -->
	<script src="<?php echo base_url();?>assets/jasny-bootstrap/js/jasny-bootstrap.js"></script>

	<!-- Datatables -->
	<script type="text/javascript">
		$(document).ready(function() {
			$('.datatable').DataTable();
		});
	</script>
	<!-- /Datatables -->

	<!-- Select2 -->
	<script type="text/javascript">
		$(document).ready(function() {
			$(".select2_single").select2({});
		});
	</script>
	<!-- /Select2 -->

</body>
</html>