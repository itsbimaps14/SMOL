<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/admin_nav');
?>

<?php
$method = $this->uri->segment(2);
switch ($method) {
	case 'add':
		$data = array(
					'title'=>'Tambah',
					'id_user'=>'',
					'nama'=>'',
					'email'=>'',
					'plant'=>'',
					'role'=>'');
		break;
	
	case 'edit':

		$data = array(
					'title'=>'Edit',
					'id_user'=>$record['id_t_kontak'],
					'nama'=>$record['nama'],
					'email'=>$record['email'],
					'plant'=>$record['plant'],
					'role'=>$record['role']);
		break;
}
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $data['title'];?> Data Contact</h1>

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
					'id_user'=>$data['id_user']);
		echo form_open('contact/'.$method,'id=add_user',$hidden);
		?>
		<div class="form-group">
			<label>Nama</label>
			<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo $data['nama'];?>">
		</div>
		<div class="form-group">
			<label>E-Mail</label>
			<input type="text" name="email" class="form-control" placeholder="yourname@nutrifood.co.id" value="<?php echo $data['email'];?>">
		</div>
		<div class="form-group">
			<?php echo form_label('Role','role');?>
			<?php
				unset($options);
				$options = array(
					''			=>'Role User',
					'QC'		=>'QC',
					'RD'		=>'RD',
					'GUDANG'	=>'GUDANG',
					'PRODUKSI'	=>'PRODUKSI'
				);
				echo form_dropdown('role',$options,$data['role'],'class="form-control" id=role');
			?>
		</div>
		<div class="form-group">
			<?php echo form_label('Plant','plant');?>
			<?php
				unset($options);
				$options = array(
					''			=>'Plant User',
					'Ciawi'		=>'Ciawi',
					'Cibitung'	=>'Cibitung',
					'Sentul'	=>'Sentul'
				);
				echo form_dropdown('plant',$options,$data['plant'],'class="form-control" id=plant');
			?>
		</div>
		<button type="submit" name="submit" class="btn btn-md btn-success">Submit</a>
		<?php echo form_close();?>
	</div>
</div>

<!-- Bootstrap Validator -->
<script type="text/javascript">
	$(document).ready(function() {
		$( "#add_user" ).validate( {
			rules: {
				nama: "required",
				email: "required",
				role: "required",
				plant: "required"
			}
		});
	});
</script>
<!-- /Bootstrap Validator -->