<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
?>

<?php
$url	= $this->uri->segment(2);
$method = $this->uri->segment(3);
if ($method == 'form') {
	$data = array(
		'title'=>'Tambah',
		'running'=>running_permintaan(),
		'kode_oracle'=>'',
		'jumlah'=>'',
		'action'=>'permintaan');

	$hidden = '';
}
elseif ($url == 'edit') {
	$data = array(
		'title'=>'Edit',
		'running'=>$record['running_permintaan'],
		'kode_oracle'=>$record['id_db_spek'],
		'jumlah'=>$record['jumlah_permintaan'],
		'action'=>'edit');

	$hidden = array('id'=>$record['id_permintaan']);
}
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $data['title'];?> Permintaan Supporting Material</h1>

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
	<div class="col-lg-12">
		<?php
		echo form_open('produksi/'.$data['action'],'id=permintaan',$hidden);
		?>
		<div class="form-group">
			<div class="row">
				<div class="col-md-6">
					<label>Running Number</label>
					<input type="text" name="running" class="form-control" value="<?php echo $data['running'];?>">
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
					<?php echo form_label('Kode Item - Nama Bahan.','id_t_db_spek');?>
					<?php
						unset($options);
						foreach ($tmp_options = auto_get_options('t_db_spek','id_t_dbspek,kode_oracle,nama_bahan','where status_db_spek = "Active" and status_top = "Top" ORDER BY kode_oracle ASC') as $info){
							$options[$info['id_t_dbspek']] = $info['kode_oracle'].' - '.$info['nama_bahan'];
						}
						echo form_dropdown('id_t_db_spek',$options,$data['kode_oracle'],'class="form-control" id=id_t_db_spek');
					?>
				</div>
				<div class="col-md-4">
					<label>Jumlah</label>
					<input type="number" step="any" name="jumlah" class="form-control" placeholder="Example : 10"
						value="<?php echo $data['jumlah'] ?>">
				</div>
				<div class="col-md-4">
					<?php echo form_label('Satuan.','satuan');?>
					<?php echo form_input('satuan','',array('class'=>'form-control','placeholder'=>'Example : KG','id' => 'satuan'));?>
				</div>
			</div>
		</div>
		<button type="submit" name="submit" class="btn btn-md btn-success">Save & Submit</a>
		<?php echo form_close();?>
	</div>
</div>

<!-- Readonly Input -->
<script type="text/javascript">
	$(document).ready(function() {
		$('[name=running],[name=satuan]').prop('readonly',true);
	});
</script>
<!-- /Readonly Input -->

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

<!-- JSon untuk Satuan -->
<script type="text/javascript">
	function get_satuan(){
		var data_1 = $('#id_t_db_spek').val();
		$.getJSON({
			type 	: 'get',
			url 	: '<?php echo base_url()."produksi/get_satuan";?>',
			data 	: 'data_1='+data_1,
			success : function(data) {
				$('#satuan').val(data);
			}
		})
	}

	$(document).ready(function() {
		get_satuan();
		$('#id_t_db_spek').change(function() {
			get_satuan();
		});
	});
</script>
<!-- /JSon untuk Satuan -->