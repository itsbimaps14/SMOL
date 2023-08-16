<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
?>

<?php
$datatab = $this->uri->segment(3);

$data = array(
	'title'			=>'Edit Data Release'
);

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
		$hidden = array('id_t_dbspek'=>$datatab);
		echo form_open('spek/edit_release','id=edit_release',$hidden);
		?>
		<div class="form-group">
			<label>Parameter Release *</label>
			<table id="edit_par_release" class="table table-bordered table-hover nowrap" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th class="title">Kategori Spek</th>
						<th class="title">Nama Parameter</th>
						<th class="title">Nilai Spek</th>
						<th class="title">Periode Analisa</th>	
						<th class="title">Titik Sampling</th>
						<th class="title text-center" width="5" colspan="2">Action</th>
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
						<td class="text-center">
							<button id="r_addRow" type="button" class="btn btn-default btn-circle">
								<i class="fa fa-plus"></i>
							</button>
						</td>
						<td class="text-center">
							<button id="r_delRow" type="button" class="btn btn-default btn-circle">
								<i class="fa fa-minus"></i>
							</button>
						</td>
					</tr>
<?php
$i = 1; $b = 0;
foreach($release->result() as $r) {?>
	<tr>
		<td class="text-center">
			<input type="hidden" name="id_t_parameter_release[]" value="<?php echo $r->id_t_parameter_release ?>">
			<input type="text" name="kat_spek_release[]" class="form-control" value="<?php echo $r->kat_spek;?>" readonly>
		</td>
		<td class="text-center">
			<input type="text" name="nama_parameter_release[]" class="form-control" value="<?php echo $r->nama_parameter;?>" readonly>
		</td>
		<td class="text-center">
			<input type="text" name="nilai_spek_release[]" class="form-control" value="<?php echo $r->nilai_spek_release;?>">
		</td>
		<td class="text-center">
			<input type="text" name="periode_analisa_release[]" class="form-control" value="<?php echo $r->periode_analisa_release;?>">
		</td>
		<td class="text-center">
			<input type="text" name="titik_sampling_release[]" class="form-control" value="<?php echo $r->titik_sampling_release;?>">
		</td>
		<td class="text-center" colspan="2">
			<?php
			if($i > 0) {
				echo anchor('spek/delete_release/'.$datatab.'/'.$r->id_t_parameter_release,'<i class="fa fa-trash-o"></i>',array('class'=>'btn btn-danger btn-sm',"onclick"=>"return confirm('Anda yakin ingin menghapus?')"));
			}?>
		</td>
	</tr>
	<input type="hidden" name="no_db_spek" value="<?php echo $r->no_db_spek_release?>">
	<input type="hidden" name="qty" value="<?php echo $i?>">
<?php
$i++; $b++;
}?>
				</tbody>
			</table>
		</div>
		<button type="submit" name="submit" class="btn btn-md btn-success">Done</a>
		<?php echo form_close();?>
	</div>
	<br>
</div>

<!-- Readonly Input -->
<script type="text/javascript">
	$(document).ready(function() {
		$('[name=no_db_spek],[name=r_fisik_def],[name=m_fisik_def],[name=revisi]').prop('readonly',true);
		//$('[name=tgl_rkj],[name=no_rkj],[name=kode_item]').prop('readonly',true);
	});
</script>
<!-- /Readonly Input -->

<!-- Json Data Options ke-2 -->
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

	$(document).ready(function() {
		options_kedua_fr();
		$('#options_pertama_rf').change(function() {
			options_kedua_fr();
		});
	});
</script>
<!-- /Json Data Options ke-2-->

<!-- Add/Remove Row -->
<script type="text/javascript">
	$(document).ready(function() {
		var now = <?php echo $i;?>;
		var bts = <?php echo $i;?>;
		if(now==bts) {
			$('#r_delRow').prop('disabled',true);
		}
		else {
			$('#r_delRow').prop('disabled',false);
		}

		$('#r_addRow').click(function() {
			var opt1 = $("#options_pertama_rf option:selected").text();
			var opt2 = $("#options_kedua_rf option:selected").text();
			var type_defect = $('#type').val();

			// Deklarasi Hidden input tampung ID Data
			var hidden1d = $('#options_pertama_rf').val();
			var hidden1i = "<input type='hidden' name='kat_spek_release[]' value='"+hidden1d+"'>";
			var hidden2d = $('#options_kedua_rf').val();
			var hidden2i = "<input type='hidden' name='nama_parameter_release[]' value='"+hidden2d+"'>";
			now += 1;
			if(now==bts) {
				$('#r_delRow').prop('disabled',true);
			}
			else {
				$('#r_delRow').prop('disabled',false);
			}

			var row = $('<tr>');
			row.append($("<td><input type='text' name='opt1[]' class='form-control' value='"+opt1+"' readonly></td>"))
				.append($("<td><input type='text' name='opt2[]' class='form-control' value='"+opt2+"' readonly></td>"))
				.append($("<td><input type='text' name='nilai_spek_release[]' class='form-control'></td>"))
				.append($("<td><input type='text' name='periode_analisa_release[]' class='form-control'></td>"))
				.append($("<td><input type='text' name='titik_sampling_release[]' class='form-control'></td>"))
				.append($("<td class='text-center'>"+hidden1i+"</td>"))
				.append($("<td class='text-center'>"+hidden2i+"</td>"));
			$('#edit_par_release tbody').append(row);
		});

		$('#r_delRow').click(function() {
			document.getElementById('edit_par_release').deleteRow(now);
			now -= 1;
			if(now==bts) {
				$('#r_delRow').prop('disabled',true);
			}
			else {
				$('#r_delRow').prop('disabled',false);
			}
		});
	});
</script>
<!-- /Add/Remove Row -->