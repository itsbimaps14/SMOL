<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');

$plant = $this->session->userdata('plant');
$method = $this->uri->segment(2);
$id_t_kedatangan = $this->uri->segment(3);

switch ($method) {
	case 'add':
		$data = array(
			'title'					=>'Tambah',
			'no_fsc'				=>auto_no_fsc(),
			'tanggal_datang'		=>'',
			'kode_id_t_db_spek'		=>'',
			'kode_produksi'			=>'',
			'no_po'					=>'',
			'supplier'				=>'',
			'principal'				=>'',
			'tanggal_prod'			=>'',
			'tanggal_exp'			=>'',
			'tanggal_dibutuhkan'	=>'',
			'jumlah'				=>'',
			'satuan'				=>'',
			'umur_simpan'			=>'',
			'attachement_coa'		=>''
		);
		$hidden = array(
			'plant' => $plant
		);

		break;

	case 'edit':
		$data = array(
			'title'					=>'Edit',
			'no_fsc'				=>$record['no_running_kedatangan'],
			'tanggal_datang'		=>$record['tanggal_datang'],
			'kode_id_t_db_spek'		=>$record['kode_id_t_db_spek'],
			'kode_produksi'			=>$record['kode_produksi'],
			'no_po'					=>$record['no_po'],
			'supplier'				=>$record['supplier'],
			'principal'				=>$record['principal'],
			'tanggal_prod'			=>$record['tanggal_prod'],
			'tanggal_exp'			=>$record['tanggal_exp'],
			'tanggal_dibutuhkan'	=>$record['tanggal_dibutuhkan'],
			'jumlah'				=>$record['jumlah'],
			'satuan'				=>''	,
			'umur_simpan'			=>$record['umur_simpan'],
			'attachement_coa'		=>"File : ".$record['attachement_coa']
		);
		$hidden = array(
			'plant' => $record['plant'],
			'id_t_kedatangan' => $id_t_kedatangan,
			'file_url' => $record['attachement_coa']
		);
		break;
}

?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $data['title'];?> Informasi Kedatangan & Status PSA / FSC</h1>
<?php
if($this->session->flashdata('msg_username')) {?>
	<div class='alert alert-danger alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<?php echo $this->session->flashdata('msg_username');?>
	</div>
<?php }
if($this->session->flashdata('msg_password')) {?>
	<div class='alert alert-danger alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<?php echo $this->session->flashdata('msg_password');?>
	</div>
<?php }?>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<?php
		echo form_open_multipart('psa/'.$method,'id=psa_add_form',$hidden);
		?>
		<!-- UNTUK ERROR UPLOAD -->
		<?php echo (empty($error) ? "" :"
			<div class='alert alert-danger alert-dismissible fade in' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
				</button>$error
			</div>
		");?>
		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
					<label>No.</label>
					<input type="text" name="no_fsc" class="form-control" value="<?php echo $data['no_fsc'];?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-3">
					<label>Tanggal Datang.</label>
					<input type="text" name="tanggal_datang" id="tanggal_datang" class="form-control tgl" placeholder="Example : YYYY-MM-DD" value="<?php echo $data['tanggal_datang'] ?>">
				</div>
				<div class="col-md-3">
					<?php echo form_label('Kode Item - Nama Bahan.','id_t_db_spek');?>
					<?php
						unset($options);
						foreach ($tmp_options = auto_get_options('t_db_spek','id_t_dbspek,kode_oracle,nama_bahan','where status_db_spek = "Active" and status_top = "Top" ORDER BY kode_oracle ASC') as $info){
							$options[$info['id_t_dbspek']] = $info['kode_oracle'].' - '.$info['nama_bahan'];
						}
						echo form_dropdown('id_t_db_spek',$options,$data['kode_id_t_db_spek'],'class="form-control" id=id_t_db_spek');
					?>
				</div>
				<div class="col-md-3">
					<?php echo form_label('No. Lot / Kode Produksi.','kode_produksi');?>
					<?php echo form_input('kode_produksi',$data['kode_produksi'],array('class'=>'form-control','placeholder'=>'Example : 0323CK19054TO676'));?>
				</div>
				<div class="col-md-3">
					<label>No. PO.</label>
					<input type="number" step="any" name="no_po" class="form-control" placeholder="Example : 899600144049"
						value="<?php echo $data['no_po'] ?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-3">
					<?php echo form_label('Supplier.','supplier');?>
					<?php echo form_input('supplier',$data['supplier'],array('class'=>'form-control','placeholder'=>'Example : Supplier'));?>
				</div>
				<div class="col-md-3">
					<?php echo form_label('Principal.','principal');?>
					<?php echo form_input('principal',$data['principal'],array('class'=>'form-control','placeholder'=>'Example : Principal'));?>
				</div>
				<div class="col-md-3">
					<label>Prod. Date.</label>
					<input type="text" name="tanggal_prod" id="tanggal_prod" class="form-control tgl" placeholder="Example : YYYY-MM-DD"
						value="<?php echo $data['tanggal_prod'] ?>">
				</div>
				<div class="col-md-3">
					<label>Exp. Date.</label>
					<input type="text" name="tanggal_exp" id="tanggal_exp" class="form-control tgl" placeholder="Example : YYYY-MM-DD"
						value="<?php echo $data['tanggal_exp'] ?>">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-3">
					<label>Tanggal Dibutuhkan.</label>
					<input type="text" name="tanggal_dibutuhkan" id="tanggal_dibutuhkan" class="form-control" placeholder="Example : YYYY-MM-DD"
						value="<?php echo $data['tanggal_dibutuhkan'] ?>">
				</div>
				<div class="col-md-3">
					<label>Jumlah</label>
					<input type="number" step="any" name="jumlah" class="form-control" placeholder="Example : 10"
						value="<?php echo $data['jumlah'] ?>">
				</div>
				<div class="col-md-3">
					<?php echo form_label('Satuan.','satuan');?>
					<?php echo form_input('satuan',$data['satuan'],array('class'=>'form-control','placeholder'=>'Example : KG','id' => 'satuan'));?>
				</div>
				<div class="col-md-3">
					<?php echo form_label('Status Umur Simpan.','umur_simpan');?>
					<?php echo form_input('umur_simpan',$data['umur_simpan'],array('class'=>'form-control','placeholder'=>'Example : 45%','id'=>'umur_simpan'));?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-6">
					<label>Attachement COA.</label>
					<div class="fileinput fileinput-new input-group" data-provides="fileinput">
	  					<div class="form-control" data-trigger="fileinput">
	  						<i class="glyphicon glyphicon-file fileinput-exists"></i>
	  						<span class="fileinput-filename"><?php echo $data['attachement_coa'];?></span>
	  					</div>
	  					<span class="input-group-addon btn btn-default btn-file">
	  						<span class="fileinput-new">Select file</span>
	  						<span class="fileinput-exists">Change</span>
	  						<?php
	  						if ($method == 'edit') {
	  							echo "<input type='file' name='attachement_coa'>";
	  						}
	  						else {
	  							echo "<input type='file' name='attachement_coa' required>";
	  						}
	  						
	  						?>
	  					</span>
	  					<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
					</div>
				</div>
			</div>
		</div>
		<button type="submit" name="submit" class="btn btn-md btn-success">Save & Finalize</a>
		<?php echo form_close();?>
	</div>
	<br>
</div>

<!-- Readonly Input -->
<script type="text/javascript">
	$(document).ready(function() {
		$('[name=no_fsc],[name=umur_simpan],[name=satuan]').prop('readonly',true);
	});
</script>
<!-- /Readonly Input -->

<!-- Bootstrap Validator -->
<script type="text/javascript">
	$(document).ready(function() {
		$( "#psa_add_form" ).validate( {
			rules: {
				no_fsc: "required",
				tanggal_datang: "required",
				kode_oracle: "required",
				kode_produksi: "required",
				no_po: "required",
				supplier: "required",
				principal: "required",
				tanggal_prod: "required",
				tanggal_exp: "required",
				umur_simpan: "required",
				jumlah: "required",
				tanggal_dibutuhkan: "required",
				satuan: "required"
			}
		});
	});
</script>
<!-- /Bootstrap Validator -->

<!-- Bootstrap Datetimepicker-->
<script type="text/javascript">
	function parseDate(str) {
		var date = str.split('-');
		return new Date(date[0], date[1], date[2]);
	}
	function daydiff(first, second, third) {
		var proses1 = Math.round((third - first)/(1000*60*60*24));
		var proses2 = Math.round((third - second)/(1000*60*60*24));
		var result = Math.round((proses1/proses2)*100);
		return result+'%';
	}
	function get_days() {
		var t1 = $('#tanggal_datang').val();
		var t2 = $('#tanggal_prod').val();
		var t3 = $('#tanggal_exp').val();
		days = daydiff(parseDate(t1), parseDate(t2), parseDate(t3));
		$('[name=umur_simpan]').val(days);
	}
	$(function () {
		var todayDate = new Date().getDate();
		$('.tgl').datetimepicker({
			format: 'YYYY-MM-DD'
		});
		$('#tanggal_dibutuhkan').datetimepicker({
			format: 'YYYY-MM-DD',	
			minDate: new Date(new Date().setDate(todayDate + 5))
		});
		$('#tanggal_datang').on("dp.change", function() {
			get_days();
		});
		$('#tanggal_prod').on("dp.change", function() {
			get_days();
		});
		$('#tanggal_exp').on("dp.change", function() {
			get_days();
		});
	});
</script>
<!-- /Bootstrap Datetimepicker-->

<!-- JSon untuk Satuan -->
<script type="text/javascript">
	function get_satuan(){
		var data_1 = $('#id_t_db_spek').val();
		$.getJSON({
			type 	: 'get',
			url 	: '<?php echo base_url()."psa/get_satuan";?>',
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