<?php
$dept	= $this->session->userdata('dept');
$url	= $this->uri->segment(1);
$this->load->view('nav/'.$dept.'/admin_nav');
?>

<?php
$method = $this->uri->segment(2);
switch ($method) {
	case 'add':

		$data = array(
					'title'=>'Tambah',
					'id_t_golongan'=>'',
					'nama_golongan'=>'');

		$hidden = array();

	break;
	
	case 'edit':

		$data = array(
					'title'=>'Edit',
					'id_t_golongan'=>$record['id_t_golongan'],
					'nama_golongan'=>$record['nama_golongan']);

		$hidden = array('id_t_golongan'=>$data['id_t_golongan'],
						'nama_golongan_lama'=>$data['nama_golongan']);

	break;
}
?>

<div class="row">
	<div class="col-lg-6">
		<h1 class="page-header"><?php echo $data['title'];?> Data Golongan</h1>
		<?php
		if($this->session->flashdata('msg_failed')) {?>
			<div class="alert alert-danger alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<?php echo $this->session->flashdata('msg_failed');?>
			</div>
		<?php }?>
	</div>
</div>

<div class="row">
	<div class="col-lg-6">
		<?php
		echo form_open('golongan/'.$method,'',$hidden);
		?>
		<div class="form-group">
			<label>Nama Golongan</label>
			<input type="text" name="nama_golongan" class="form-control" placeholder="Nama Golongan" value="<?php echo $data['nama_golongan'];?>">
		</div>
		<button type="submit" name="submit" class="btn btn-md btn-success">Submit</button>
		<?php echo form_close();?>
	</div>
</div>