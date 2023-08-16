<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>SMOL | Supporting Material Online | Nutrifood Indonesia</title>

	<link rel="shorcut icon" href="<?php echo base_url();?>assets/icon.png">
	<link rel="stylesheet" href="<?php echo base_url();?>http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">

	<!-- Bootstrap Core CSS -->
	<link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="<?php echo base_url();?>assets/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="<?php echo base_url();?>assets/custom_login.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<?php

	$method = $this->uri->segment(2);
	switch ($method) {
		case 'guest':
				$data = array(
					'title'=>'Guest',
					'user'=>'member',
					'link'=>'login',
					'text'=>"have account ? login as "
				);

				$padding = "padding: 75px 0 170px 0;";
			break;

		case 'login':
				$data = array(
					'title'=>'Member',
					'user'=>'guest',
					'link'=>'guest',
					'text'=>"didn't have account ? login as "
				);

				$padding = "padding: 100px 0 170px 0;";
			break;

		case 'daftar':
			$data = array(
					'title'=>'New Member',
					'user'=>'member',
					'link'=>'login',
					'text'=>"have account ? login as "
				);

			$padding = "padding: 45px 0 170px 0;";
			break;

		default:
				$data = array(
					'title'=>'Guest',
					'user'=>'guest',
					'link'=>'guest',
					'text'=>"didn't have account ? login as "
				);
			break;
	}
	$week = date('W');
	if($week % 2 == 0) {
		$img = "banner1.jpg";
	}
	else {
		$img = "banner2.jpg";
	}
	?>

	<style type="text/css">
		.banner {
			background: url(<?php echo base_url("assets/$img");?>)no-repeat center center;
			-webkit-background-size: cover;
			background-size: cover;
			-moz-background-size: cover;
			position: fixed;
			top: 0;
			left: 0;
			min-width: 100%;
			min-height: 100%;
		}
		.banner-info {
			background: url(<?php echo base_url('assets/dott.png');?>)repeat 0px 0px;
			position: fixed;
			top: 0;
			left: 0;
			min-width: 100%;
			min-height: 100%;
		}
	</style>
</head>

<body>
	<div class="banner">
		<div class="banner-info" style="<?php echo $padding; ?>">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 form-box">
						<div class="form-top">
							<div class="form-top-left">
								<h3>Login SMOL</h3>
								<p>Enter your username and password to log on as : <?php echo $data['title']; ?></p>
                        	</div>
                        	<div class="form-top-right">
                        		<i class="fa fa-cogs"></i>
                        	</div>
                        </div>
                       	<div class="form-bottom">

	<?php
		if($this->session->flashdata('msg_login')) {?>
			<div class="alert alert-danger alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
				</button>
				<?php echo $this->session->flashdata('msg_login');?>
			</div>
	<?php }?>

									<?php if($data['title'] == 'Guest') {?>
										<?php echo form_open('auth/guest');?>
											<div class="form-group input-group">
												<span class="input-group-addon">
													<span class="fa fa-user"></span>
												</span>
												<input type="text" name="nama" class="form-control" placeholder="Nama Anda" autofocus required>
											</div>
											<div class="form-group input-group">
												<span class="input-group-addon">
													<span class="fa fa-envelope"></span>
												</span>
												<input type="email" name="email" class="form-control" placeholder="Email Anda" required>
											</div>
											<div class="form-group input-group">
												<span class="input-group-addon">
													<span class="fa fa-map-marker"></span>
												</span>
												<?php
													unset($options);
													$options = array(	'' => 'Plant',
																		'Ciawi' => 'Ciawi',
																		'Cibitung' => 'Cibitung',
																		'Sentul' => 'Sentul'
													);
													echo form_dropdown('plant',$options,'','class="form-control" id=plant required');
												?>
											</div>
											<div class="form-group">
												<button type="submit" name="submit" class="btn">Login</button>
											</div>
										<?php echo form_close();?>
									<?php } ?>

									<?php if($data['title'] == 'Member') { ?>
										<?php echo form_open('auth/login');?>
											<div class="form-group input-group">
												<span class="input-group-addon">
													<span class="fa fa-user"></span>
												</span>
												<input type="text" name="username" class="form-control" placeholder="Username" autofocus required>
											</div>
											<div class="form-group input-group">
												<span class="input-group-addon">
													<span class="fa fa-lock"></span>
												</span>
												<input type="password" name="password" class="form-control" placeholder="Password" required>
											</div>
											<div class="form-group">
												<button type="submit" name="submit" class="btn">Login</button>
											</div>
										<?php echo form_close();?>
									<?php } ?>

									<?php if($data['title'] == 'New Member') { ?>
										<?php echo form_open('auth/daftar');?>
											<div class="form-group input-group">
												<span class="input-group-addon">
													<span class="fa fa-user"></span>
												</span>
												<input type="text" name="username" class="form-control" placeholder="Username" autofocus required>
											</div>
											<div class="form-group input-group">
												<span class="input-group-addon">
													<span class="fa fa-lock"></span>
												</span>
												<input type="password" name="password" class="form-control" placeholder="Password" required>
											</div>
											<div class="form-group input-group">
												<span class="input-group-addon">
													<span class="fa fa-map-marker"></span>
												</span>
												<?php
													unset($options);
													$options = array(	'' => 'Plant',
																		'Ciawi' => 'Ciawi',
																		'Cibitung' => 'Cibitung',
																		'Sentul' => 'Sentul'
													);
													echo form_dropdown('plant',$options,'','class="form-control" id=plant required');
												?>
											</div>
											<div class="form-group input-group">
												<span class="input-group-addon">
													<span class="fa fa-user-circle"></span>
												</span>
												<?php
													unset($options);
													$options = array(	'' => 'Departemen',
																		'R&D' => 'R&D',
																		'Gudang' => 'Gudang',
																		'QC' => 'QC',
																		'Produksi' => 'Produksi'
													);
													echo form_dropdown('dept',$options,'','class="form-control" id=dept required');
												?>
											</div>
											<div class="form-group">
												<button type="submit" name="submit" class="btn">Register</button>
											</div>
										<?php echo form_close();?>
									<?php } ?>

									<hr style="border-top: 1px solid #de995e;">
									<h5 class="text-center"><?php echo $data['text'] ?><a href="<?php echo base_url().'auth/'.$data['link'];?>"><?php echo $data['user']?></a> or <a href="<?php echo base_url().'auth/daftar';?>">register</a>.</h5>
									<h5 class="text-center">SMOL &copy; 2017 - Synithis</h5>
                       	</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- jQuery -->
	<script src="<?php echo base_url();?>assets/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="<?php echo base_url();?>assets/metisMenu/dist/metisMenu.min.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="<?php echo base_url();?>assets/custom.js"></script>

</body>

</html>