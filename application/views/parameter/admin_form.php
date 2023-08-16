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
					'id_t_nama_parameter'=>'',
					'id_kat_spek'=>'',
					'nama_parameter'=>'');

		$hidden = array();

	break;
	
	case 'edit':

		$data = array(
					'title'=>'Edit',
					'id_t_nama_parameter'=>$record['id_t_nama_parameter'],
					'id_kat_spek'=>$record['id_kat_spek'],
					'nama_parameter'=>$record['nama_parameter']);

		$hidden = array('id_t_nama_parameter'=>$data['id_t_nama_parameter'],
						'nama_parameter_lama'=>$data['nama_parameter']);

	break;
}
?>

<div class="row">
	<div class="col-lg-6">
		<h1 class="page-header"><?php echo $data['title'];?> Nama Parameter</h1>
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
		echo form_open('parameter/'.$method,'',$hidden);
		?>
		<div class="form-group">
			<?php echo form_label('Kategori Spek *','kat_spek');?>
			<?php
				unset($options);
				foreach ($tmp_options = auto_get_options('t_kategori_spek','id_t_katspek,kat_spek','ORDER BY kat_spek ASC') as $info){
					$options[$info['id_t_katspek']] = $info['kat_spek'];
				}
				echo form_dropdown('kat_spek',$options,$data['id_kat_spek'],'class="form-control" id=kat_spek');
			?>
		</div>
		<div class="form-group">
			<label>Nama Parameter</label>
			<input type="text" name="nama_parameter" class="form-control" placeholder="Example : pH +- 7" value="<?php echo $data['nama_parameter'];?>">
		</div>
		<button type="submit" name="submit" class="btn btn-md btn-success">Submit</button>
		<?php echo form_close();?>
	</div>
</div>