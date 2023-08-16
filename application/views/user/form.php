<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
?>

<?php
$method = $this->uri->segment(2);
switch ($method) {
	case 'add':
		$data = array(
					'title'=>'Tambah',
					'id_user'=>'',
					'username'=>'',
					'password'=>'',
					'nama'=>'',
					'level'=>'',
					'email'=>'');

		$selected_opt = '';
		break;
	
	case 'edit':

		if ($record['level'] == 'admin') {
			$tmp1 = 'adm';
		}
		else{
			$tmp1 = 'usr';
		}

		if ($record['dept'] == 'psa') {
			$tmp2 = 'psa'; 
		}
		elseif ($record['dept'] == 'qc') {
			$tmp2 = 'quc';
		}
		elseif ($record['dept'] == 'produksi') {
			$tmp2 = 'pro';
		}
		elseif ($record['dept'] == 'rd') {
			$tmp2 = 'rdt';
		}
		else{
			$tmp2 = 'adm';
		}

		if ($record['plant'] == 'Ciawi') {
			$tmp3 = 'cia';
		}
		elseif ($record['plant'] == 'Cibitung') {
			$tmp3 = 'cib';
		}
		elseif ($record['plant'] == 'Sentul') {
			$tmp3 = 'sen';
		}
		else{
			$tmp3 = 'all';
		}

		$selected_opt = $tmp1.'-'.$tmp2.'-'.$tmp3;

		$data = array(
					'title'=>'Edit',
					'id_user'=>$record['id_user'],
					'username'=>$record['username'],
					'password'=>$record['password'],
					'nama'=>$record['nama'],
					'level'=>$record['level'],
					'email'=>$record['email']);

		

		break;
}

if($data['level'] == 'admin') {
	$level1 = TRUE;
	$level2 = FALSE;
}
else if($data['level'] == 'user') {
	$level1 = FALSE;
	$level2 = TRUE;
}
else {
	$level1 = FALSE;
	$level2 = TRUE;
}
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $data['title'];?> Data User</h1>

<?php
if($this->session->flashdata('msg_username')) {?>
	<div class='alert alert-danger alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<?php echo $this->session->flashdata('msg_username');?>
	</div>
<?php }?>

	</div>
</div>
<div class="row">
	<div class="col-lg-6">
		<?php
		$hidden = array(
					'id_user'=>$data['id_user'],
					'username_lama'=>$data['username']);
		echo form_open('user/'.$method,'id=add_user',$hidden);
		?>
		<div class="form-group">
			<label>Username</label>
			<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $data['username'];?>">
		</div>
		<div class="form-group">
			<label>Nama</label>
			<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $data['nama'];?>">
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $data['email'];?>">
		</div>
<?php
switch ($method) {
	case 'add': ?>
		<div class="form-group">
			<?php echo form_label('Password','password');?>&nbsp&nbsp&nbsp<span id='message_1'></span>
			<?php echo form_password('password','',array('class'=>'form-control','placeholder'=>'Password','id'=>'password'));?>
		</div>
		<div class="form-group">
			<?php echo form_label('Confirm Password','confirm_password');?>&nbsp&nbsp&nbsp<span id='message_2'></span>
			<?php echo form_password('confirm_password','',array('class'=>'form-control','placeholder'=>'Confirm Password','id'=>'confirm_password'));?>
		</div>
<?php
	break;
	
	case 'edit': ?>
<?php
	break;
}
?>

		<div class="form-group">
			<?php echo form_label('Level','level');?>
			<?php
				unset($options);
				$options = array(
					'adm-adm-all'	=>'ADMIN - ALL PLANT',
					'usr-psa-cia'	=>'USER - Gudang PSA - Ciawi',
					'usr-quc-cia'	=>'USER - QC - Ciawi',
					'usr-pro-cia'	=>'USER - Produksi - Ciawi',
					'usr-rdt-cia'	=>'USER - User RD - Ciawi',
					'usr-psa-cib'	=>'USER - Gudang PSA - Cibitung',
					'usr-quc-cib'	=>'USER - QC - Cibitung',
					'usr-pro-cib'	=>'USER - Produksi - Cibitung',
					'usr-rdt-cib'	=>'USER - User RD - Cibitung',
					'usr-psa-sen'	=>'USER - Gudang PSA - Sentul',
					'usr-quc-sen'	=>'USER - QC - Sentul',
					'usr-pro-sen'	=>'USER - Produksi - Sentul',
					'usr-rdt-sen'	=>'USER - User RD - Sentul'
				);
				echo form_dropdown('level',$options,$selected_opt,'class="form-control" id=level');
			?>
		</div>
		<button type="submit" name="submit" class="btn btn-md btn-success">Submit</a>
		<?php echo form_close();?>
	</div>
</div>

<!-- Confirm Validation Password -->
<script type="text/javascript">

	$('#password, #confirm_password').on('keyup', function () {

		if ($('#password').val().length < '8') {
			$('#message_1').html('Password must have atleast 8 Character').css('color', 'red');
			$(':input[type="submit"]').prop('disabled', true);
		}
		else {
			$('#message_1').html('').css('color', 'red');
		}

		if ($('#password').val() == '' && $('#confirm_password').val() == ''){
			$('#message_2').html('').css('color', 'red');
			$(':input[type="submit"]').prop('disabled', true);
		}
		else if ($('#password').val() == $('#confirm_password').val() && $('#password').val().length > '7') {
			$('#message_2').html('Matching').css('color', 'green');
			$(':input[type="submit"]').prop('disabled', false);
		}
		else {
			$('#message_2').html('Not Matching').css('color', 'red');
			$(':input[type="submit"]').prop('disabled', true);
		}
	});
</script>
<!-- /Confirm Validation Password -->

<!-- Bootstrap Validator -->
<script type="text/javascript">
	$(document).ready(function() {
		$( "#add_user" ).validate( {
			rules: {
				username: "required",
				nama: "required",
				email: "required",
				password: "required",
				confirm_password: "required",
				level: "required",
				plant: "required"
			}
		});
	});
</script>
<!-- /Bootstrap Validator -->