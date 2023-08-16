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
					'no_db_spek'=>auto_no_dbs(),
					'id_user'=>'',
					'username'=>'',
					'password'=>'',
					'nama'=>'',
					'level'=>''
				);

		$ket_release = array(
			        'name'        => 'keterangan_release',
			        'id'          => 'keterangan_release',
			        'value'       => '',
			        'rows'        => '3',
			        'cols'        => '10',
			        'style'       => 'width:50%',
			        'class'       => 'form-control',
			        'placeholder' => 'Example = Keterangan Release'
			    );

		$ket_monitoring = array(
			        'name'        => 'keterangan_monitoring',
			        'id'          => 'keterangan_monitoring',
			        'value'       => '',
			        'rows'        => '3',
			        'cols'        => '10',
			        'style'       => 'width:50%',
			        'class'       => 'form-control',
			        'placeholder' => 'Example = Keterangan Monitoring'
			    );

		$referensi = array(
			        'name'        => 'referensi',
			        'id'          => 'referensi',
			        'value'       => '',
			        'rows'        => '3',
			        'cols'        => '10',
			        'style'       => 'width:50%',
			        'class'       => 'form-control',
			        'placeholder' => 'Example = Referensi'
			    );

		break;
	
	case 'edit':
		$data = array(
					'title'=>'Edit',
					'id_user'=>$record['id_user'],
					'username'=>$record['username'],
					'password'=>$record['password'],
					'nama'=>$record['nama'],
					'level'=>$record['level']);
		break;
}

?>
<div class="row">
	<div class="col-lg-10 col-lg-offset-1">
		<h1 class="page-header"><?php echo $data['title'];?> Database Spek</h1>
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
	<div class="col-lg-10 col-lg-offset-1">
		<?php
		$hidden = '';
		echo form_open('spek/'.$method,'id=db_spek_add_form',$hidden);
		?>
		<div class="form-group">
			<div class="row">
				<div class="col-md-5">
					<label>No.</label>
					<input type="text" name="no_db_spek" class="form-control" value="<?php echo $data['no_db_spek'];?>">
				</div>
			</div>
		</div>
<?php
switch ($method) {
	// Add Database Spek 
	case 'add': ?>
		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
					<?php echo form_label('No. UPP *','no_upp');?>
					<?php echo form_input('no_upp','',array('class'=>'form-control','placeholder'=>'Example : XXX/UPP/XXX'));?>
				</div>
				<div class="col-md-4">
					<label>Tanggal Berlaku *</label>
					<input type="text" name="tanggal_berlaku" class="form-control tgl" placeholder="YYYY-MM-DD">
				</div>
				<div class="col-md-4">
					<?php echo form_label('Revisi *','revisi');?>
					<?php echo form_input('revisi','01',array('class'=>'form-control','placeholder'=>'Example : 01'));?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
					<?php echo form_label('Golongan *','golongan');?>
					<?php
						unset($options);
						foreach ($tmp_options = auto_get_options('t_golongan','id_t_golongan,nama_golongan','ORDER BY nama_golongan ASC') as $info){
							$options[$info['id_t_golongan']] = $info['nama_golongan'];
						}
						echo form_dropdown('golongan',$options,' ','class="form-control" id=golongan');
					?>
				</div>
				<div class="col-md-4">
					<?php echo form_label('Kode Oracle *','kode_oracle');?>
					<?php echo form_input('kode_oracle','',array('class'=>'form-control','placeholder'=>'Example : XXXXXXXXXXXX'));?>
				</div>
				<div class="col-md-4">
					<?php echo form_label('Nama Bahan *','nama_bahan');?>
					<?php echo form_input('nama_bahan','',array('class'=>'form-control','placeholder'=>'Example : Creamer'));?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
					<?php echo form_label('Umur Simpan (Bulan) *','umur_simpan');?>
					<?php echo form_input('umur_simpan','',array('class'=>'form-control','placeholder'=>'Example : 24'));?>
				</div>
				<div class="col-md-4">
					<?php echo form_label('Satuan *','satuan');?>
					<?php echo form_input('satuan','',array('class'=>'form-control','placeholder'=>'Example : KG'));?>
				</div>
				<div class="col-md-4">
					<?php echo form_label('Kondisi Penyimpanan *','kondisi_penyimpanan');?>
					<?php echo form_input('kondisi_penyimpanan','',array('class'=>'form-control','placeholder'=>'Example : Baik'));?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Parameter Release *</label>
			<table id="par_release_table" class="table table-bordered table-hover nowrap" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="title">Kategori Spek</th>
						<th class="title">Nama Parameter</th>
						<th class="title">Nilai Spek</th>
						<th class="title">Periode Analisa</th>	
						<th class="title">Titik Sampling</th>
						<th class="title" width="5"></th>
						<th class="title" width="5"></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td id="r_fisik" class="col-md-2">
							<?php
								unset($options);
								foreach ($tmp_options = auto_get_options('t_kategori_spek','id_t_katspek,kat_spek','ORDER BY kat_spek ASC') as $info){
									$options[$info['id_t_katspek']] = $info['kat_spek'];
								}
								echo form_dropdown('par_release_opt1',$options,'','class="form-control" id=options_pertama_rf');
							?>
						</td>
						<td id="r_fisik_par" class="col-md-2">
							<?php
								echo form_dropdown('par_release_opt2','','','class="form-control" id=options_kedua_rf');
							?>
						</td>
						<td id="r_fisik_pan"><input type="text" name="r_fisik_def" class="form-control"></td>
						<td id="r_fisik_pan"><input type="text" name="r_fisik_def" class="form-control"></td>
						<td id="r_fisik_tis"><input type="text" name="r_fisik_def" class="form-control"></td>
						<td>
							<button id="r_addRow1" type="button" class="btn btn-default btn-circle">
								<i class="fa fa-plus"></i>
							</button>
						</td>
						<td>
							<button id="r_delRow1" type="button" class="btn btn-default btn-circle">
								<i class="fa fa-minus"></i>
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="form-group">
			<?php echo form_label('Keterangan Release *','keterangan_release');?>
			<?php echo form_textarea($ket_release);?>
		</div>
		<div class="form-group">
			<label>Parameter Monitoring *</label>
			<table id="par_monitor_table" class="table table-bordered table-hover nowrap" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="title">Kategori Spek</th>
						<th class="title">Nama Parameter</th>
						<th class="title">Nilai Spek</th>
						<th class="title">Periode Analisa</th>
						<th class="title">Titik Sampling</th>
						<th class="title" width="5"></th>
						<th class="title" width="5"></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td id="m_fisik" class="col-md-2">
							<?php
								unset($options);
								foreach ($tmp_options = auto_get_options('t_kategori_spek','id_t_katspek,kat_spek','ORDER BY kat_spek ASC') as $info){
									$options[$info['id_t_katspek']] = $info['kat_spek'];
								}
								echo form_dropdown('par_release_opt1',$options,'','class="form-control" id=options_pertama_mf');
							?>
						</td>
						<td id="m_fisik_par" class="col-md-2">
							<?php
								echo form_dropdown('par_release_opt2','','','class="form-control" id=options_kedua_mf');
							?>
						</td>
						<td id="m_fisik_pan"><input type="text" name="m_fisik_def" class="form-control"></td>
						<td id="m_fisik_pan"><input type="text" name="m_fisik_def" class="form-control"></td>
						<td id="m_fisik_tis"><input type="text" name="m_fisik_def" class="form-control"></td>
						<td>
							<button id="m_addRow1" type="button" class="btn btn-default btn-circle">
								<i class="fa fa-plus"></i>
							</button>
						</td>
						<td>
							<button id="m_delRow1" type="button" class="btn btn-default btn-circle">
								<i class="fa fa-minus"></i>
							</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="form-group">
			<?php echo form_label('Keterangan Monitoring *','krm');?>
			<?php echo form_textarea($ket_monitoring);?>
		</div>
		<div class="form-group">
			<?php echo form_label('Referensi *','ref');?>
			<?php echo form_textarea($referensi);?>
		</div>
		<!-- End Add Database Spek Form -->
<?php
	break;
	
	case 'edit': ?>
		<div class="form-group">
			<?php echo form_button('password','Ganti Password',array('id'=>'btn-password','class'=>'btn btn-default'));?>
			<div id="change-password" style="display: none;">
				<?php echo form_label('Password Lama','old_password');?>
				<?php echo form_password('old_password','',array('class'=>'form-control'));?>
				<?php echo form_label('Password Baru','new_password');?>
				<?php echo form_password('new_password','',array('class'=>'form-control'));?>
				<?php echo form_label('Ulangi Password','ver_password');?>
				<?php echo form_password('ver_password','',array('class'=>'form-control'));?>
			</div>
		</div>
<?php
	break;
}
?>
		<button type="submit" name="submit" class="btn btn-md btn-success">Save & Finalize</a>
		<?php echo form_close();?>
	</div>
	<br>
</div>

<!-- Bootstrap Validator -->
<script type="text/javascript">
	$(document).ready(function() {
		$( "#db_spek_add_form" ).validate( {
			rules: {
				no_db_spek: "required",
				no_upp: "required",
				tanggal_berlaku: "required",
				revisi: "required",
				golongan: "required",
				kode_oracle: "required",
				nama_bahan: "required",
				umur_simpan: "required",
				kondisi_penyimpanan: "required"
			}
		});
	});
</script>
<!-- /Bootstrap Validator -->

<!-- Readonly Input -->
<script type="text/javascript">
	$(document).ready(function() {
		$('[name=no_db_spek]').prop('readonly',true);
		$('[name=r_fisik_def]').prop('readonly',true);
		$('[name=m_fisik_def]').prop('readonly',true);
		$('[name=revisi]').prop('readonly',true);
	});
</script>
<!-- /Readonly Input -->

<!-- Bootstrap Datetimepicker-->
<script type="text/javascript">
	$(function () {
		$('.tgl').datetimepicker({
			format: 'YYYY-MM-DD'
		});
	});
</script>
<!-- /Bootstrap Datetimepicker-->

<!-- Add and Min Row -->
<script type="text/javascript">
	$(document).ready(function() {
		var index0 = 0;
		var index1 = 0;
		
		// Parameter Release
		if(index0 == 0){
			$('#r_delRow1').prop('disabled',true);
		}
		else{
			$('#r_delRow1').prop('disabled',false);
		}
		$('#r_addRow1').click(function() {
			// Deklarasi dan Ambil Value Options ke-1
			var opt1 = $("#options_pertama_rf option:selected").text();
			var options_1 = "<input type='text' name='option_1_rf' class='form-control' value='"+opt1+"' readonly='true'";

			// Deklarasi dan Ambil Value Options ke-2
			var opt2 = $("#options_kedua_rf option:selected").text();
			var options_2 = "<input type='text' name='option_2_rf' class='form-control' value='"+opt2+"' readonly='true'";

			// Deklarasi 2 Input
			var input1 = '<input type="text" name="periode_analisa_parameter_release[]" class="form-control">';
			var input2 = '<input type="text" name="titik_sampling_parameter_release[]" class="form-control">';

			// Deklarasi Hidden input tampung ID Data
			var hidden1d = $('#options_pertama_rf').val();
			var hidden1i = "<input type='hidden' name='kategorispek_parameter_release[]' value='"+hidden1d+"'>";
			var hidden2d = $('#options_kedua_rf').val();
			var hidden2i = "<input type='hidden' name='nama_parameter_release[]' value='"+hidden2d+"'>";

			// Penggabungan tabel row
			var row = $('<tr>');
			row.append($("<td>"+options_1+"</td>"))
				.append($("<td>"+options_2+"</td>"))
				.append($("<td><input type='text' name='nilai_spek_release[]' class='form-control'></td>"))
				.append($("<td>"+input1+"</td>"))
				.append($("<td>"+input2+"</td>"))
				.append($("<td>"+hidden1i+"</td>"))
				.append($("<td>"+hidden2i+"</td>"));
			row.insertAfter($('#par_release_table tbody tr:nth('+index0+')'));
			index0 += 1;

			if(index0 == 0){
				$('#r_delRow1').prop('disabled',true);
			}
			else{
				$('#r_delRow1').prop('disabled',false);
			}
		});
		$('#r_delRow1').click(function() {
			document.getElementById('par_release_table').deleteRow(index0+1);
			index0 -= 1;
			if(index0 == 0){
				$('#r_delRow1').prop('disabled',true);
			}
			else{
				$('#r_delRow1').prop('disabled',false);
			}
		});

		// Parameter Monitoring
		if(index1 == 0){
			$('#m_delRow1').prop('disabled',true);
		}
		else{
			$('#m_delRow1').prop('disabled',false);
		}
		$('#m_addRow1').click(function() {
			// Deklarasi dan Ambil Value Options ke-1
			var opt1 = $("#options_pertama_mf option:selected").text();
			var options_1 = "<input type='text' name='option_1_mf' class='form-control' value='"+opt1+"' readonly='true'";

			// Deklarasi dan Ambil Value Options ke-2
			var opt2 = $("#options_kedua_mf option:selected").text();
			var options_2 = "<input type='text' name='option_2_mf' class='form-control' value='"+opt2+"' readonly='true'";

			// Deklarasi 2 Input

			var input1 = '<input type="text" name="periode_analisa_parameter_monitoring[]" class="form-control">';
			var input2 = '<input type="text" name="titik_sampling_parameter_monitoring[]" class="form-control">';

			// Deklarasi Hidden input tampung ID Data
			var hidden1d = $('#options_pertama_mf').val();
			var hidden1i = "<input type='hidden' name='kategorispek_parameter_monitoring[]' value='"+hidden1d+"'>";
			var hidden2d = $('#options_kedua_mf').val();
			var hidden2i = "<input type='hidden' name='nama_parameter_monitoring[]' value='"+hidden2d+"'>";

			// Penggabungan tabel row
			var row = $('<tr>');
			row.append($("<td>"+options_1+"</td>"))
				.append($("<td>"+options_2+"</td>"))
				.append($("<td><input type='text' name='nilai_spek_monitoring[]' class='form-control'></td>"))
				.append($("<td>"+input1+"</td>"))
				.append($("<td>"+input2+"</td>"))
				.append($("<td>"+hidden1i+"</td>"))
				.append($("<td>"+hidden2i+"</td>"));
			row.insertAfter($('#par_monitor_table tbody tr:nth('+index1+')'));
			index1 += 1;

			if(index1 == 0){
				$('#m_delRow1').prop('disabled',true);
			}
			else{
				$('#m_delRow1').prop('disabled',false);
			}

		});
		$('#m_delRow1').click(function() {
			document.getElementById('par_monitor_table').deleteRow(index1+1);
			index1 -= 1;
			if(index1 == 0){
				$('#m_delRow1').prop('disabled',true);
			}
			else{
				$('#m_delRow1').prop('disabled',false);
			}
		});

	});
</script>
<!-- /Add Row -->

<!-- JSon 2 Options -->
<script type="text/javascript">
	function options_kedua_fr(){
			var data_1 = $('#options_pertama_rf').val();
			$.getJSON({
				type 	: 'get',
				url 	: '<?php echo base_url()."spek/add_options_2nd";?>',
				data 	: 'data_1='+data_1,
				success : function(data) {
					if (data == '0') {
						$('#options_kedua_rf option').remove();	
					}
					$('#options_kedua_rf option').remove();
					for (var i=0;i<data.nama_parameter.length;i++){
						$('#options_kedua_rf').append("<option value='"+data.id_t_nama_parameter[i]+"'>"+data.nama_parameter[i]+"</option>");
					}
					//console.log(data.length);
				}
			})
		}

	function options_kedua_mf(){
			var data_1 = $('#options_pertama_mf').val();
			$.getJSON({
				type 	: 'get',
				url 	: '<?php echo base_url()."spek/add_options_2nd";?>',
				data 	: 'data_1='+data_1,
				success : function(data) {
					if (data == '0') {
						$('#options_kedua_mf option').remove();	
					}
					$('#options_kedua_mf option').remove();
					for (var i=0;i<data.nama_parameter.length;i++){
						$('#options_kedua_mf').append("<option value='"+data.id_t_nama_parameter[i]+"'>"+data.nama_parameter[i]+"</option>");
					}
					//console.log(data.length);
				}
			})
		}

	$(document).ready(function() {
		options_kedua_fr();
		options_kedua_mf();
		$('#options_pertama_rf').change(function() {
			options_kedua_fr();
		});
		$('#options_pertama_mf').change(function() {
			options_kedua_mf();
		});
	});
</script>
<!-- /JSon 2 Options -->