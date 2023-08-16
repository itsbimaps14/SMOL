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
					'id_t_katspek'=>'',
					'kat_spek'=>'');

		$hidden = array();

	break;
	
	case 'edit':

		$data = array(
					'title'=>'Edit',
					'id_t_katspek'=>$record['id_t_katspek'],
					'kat_spek'=>$record['kat_spek']);

		$hidden = array('id_t_katspek'=>$data['id_t_katspek'],
						'kat_spek_lama'=>$data['kat_spek']);

	break;
}
?>

<div class="row">
	<div class="col-lg-6">
		<h1 class="page-header"><?php echo $data['title'];?> Kategori Spek</h1>
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
		echo form_open('kat_spek/'.$method,'',$hidden);
		?>
		<div class="form-group">
			<label>Kategori Spek</label>
			<input type="text" name="kategori_spek" class="form-control" placeholder="Example : Fisik / Kimia" value="<?php echo $data['kat_spek'];?>">
		</div>
		<button type="submit" name="submit" class="btn btn-md btn-success">Submit</button>
		<?php echo form_close();?>
	</div>
</div>