<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
?>

<?php
$url	= $this->uri->segment(2);
$method = $this->uri->segment(3);
if ($method == 'form') {
	$result 		= get_kode_nama_psa($record['id_db_spek']);
	$kode_gudang 	= get_kode_gudang($result['kode_oracle'],$record['plant']);
	$kode_gudang 	= $kode_gudang['id_t_kode_gudang'];
	$data = array(
		'title'=>'Proses',
		'running'=>$record['running_permintaan'],
		'kode_oracle'=>$result['kode_oracle'],
		'nama_bahan'=>$result['nama_bahan'],
		'satuan'=>$result['satuan'],
		'jumlah'=>$record['jumlah_permintaan'],
		'action'=>'permintaan');

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
		echo form_open('psa/'.$data['action'],'id=permintaan',$hidden);
		?>
		<div class="form-group">
			<div class="row">
				<div class="col-md-6">
					<label>Running Number</label>
					<input type="text" name="running" class="form-control" value="<?php echo $data['running'];?>">
				</div>
				<div class="col-md-6">
					<?php echo form_label('Nama Bahan.','nama_bahan');?>
					<?php echo form_input('nama_bahan',$data['nama_bahan'],array('class'=>'form-control'));?>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
					<?php echo form_label('Kode Oracle.','kode_oracle');?>
					<?php echo form_input('kode_oracle',$data['kode_oracle'],array('class'=>'form-control'));?>
				</div>
				<div class="col-md-4">
					<label>Jumlah Permintaan</label>
					<input type="number" step="any" name="jumlah" class="form-control" placeholder="Example : 10"
						value="<?php echo $data['jumlah'] ?>">
				</div>
				<div class="col-md-4">
					<?php echo form_label('Satuan.','satuan');?>
					<?php echo form_input('satuan',$data['satuan'],array('class'=>'form-control'));?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<b>Panel Gudang</b>
					</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="panel_tabel">
							<thead>
								<tr>
									<th>Kode Produksi</th>
									<th>Jumlah Tersedia</th>
									<th>Jumlah Dikirim</th>
								</tr>
							</thead>
							<tbody>
								<td class="text-center">
									<?php
										unset($options);
										$options[''] = 'Kode Produksi';
										foreach ($tmp_options = auto_get_options('t_gudang','id,kode_produksi','where id_kode = '.$kode_gudang) as $info){
											$options[$info['id']] = $info['kode_produksi'];
										}
										echo form_dropdown('kode_produksi[]',$options,'','class="form-control kode0" id="0" onchange="get_stok(this.id)" required');
									?>

								</td>
								<td class="text-center">
									<input type="number" name="stok[]" class="form-control stok0" id="0" readonly>
								</td>
								<td class="text-center">
									<input type="number" min="1" name="tarik[]" onkeyup="hitung(this.id)" class="form-control tarik0" id="0" required>
								</td>
							</tbody>
						</table>
						<div class="col-md-3" style="float: left;">
							<?php echo form_input('total','',array('class'=>'form-control','placeholder'=>'Total','id'=>'total'));?>
						</div>
						<div style="float: right;">
							<button id="addRow" type="button" class="btn btn-default btn-circle">
								<i class="fa fa-plus"></i>
							</button>
							<button id="delRow" type="button" class="btn btn-default btn-circle">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
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
		$('[name=running],[name=satuan],[name=kode_oracle],[name=nama_bahan],[name=jumlah],[name=total]').prop('readonly',true);
	});
</script>
<!-- /Readonly Input -->

<!-- Bootstrap Validator -->
<script type="text/javascript">
	$(document).ready(function() {
		$( "#permintaan" ).validate( {
			rules: {

			}
		});
	});
</script>
<!-- /Bootstrap Validator -->

<!-- JSon untuk Stok + Hitung -->
<script type="text/javascript">
	function get_stok(id){
		var data_1 = $('.kode'+id).val();
		if (data_1 == ''){
			data_1 = 0;
		}
		$.getJSON({
			type 	: 'get',
			url 	: '<?php echo base_url()."psa/get_stok";?>',
			data 	: 'data_1='+data_1,
			success : function(data) {
				$('.stok'+id).val(data);
				$('.tarik'+id).attr({"max" : data});
			}
		})
	}

	function hitung(id){
		var hasil = '';
		for(id;id>=0;id--){
			var get = $('.tarik'+id).val();
			hasil = hasil + get;
		}
		$('#total').val(hasil);
	}
</script>
<!-- /JSon untuk Stok + Hitung -->
<!--  -->
<!-- Add/Remove Row -->
<script type="text/javascript">
	$(document).ready(function() {
		var i = 1;
		var n = 0;
		var options = '';
		<?php
			foreach ($tmp_options = auto_get_options("t_gudang","id,kode_produksi","where id_kode = ".$kode_gudang) as $info){?>
			 	options += '<?php echo "<option value=$info[id]>$info[kode_produksi]</option>";?>';
			<?php } ?>

		if(i==1) {
			$('#delRow').prop('disabled',true);
		}
		else {
			$('#delRow').prop('disabled',false);
		}
		$('#addRow').click(function() {
			var type_defect = $('#type').val();
			i+=1;
			n+=1;
			if(i==1) {
				$('#delRow').prop('disabled',true);
			}
			else {
				$('#delRow').prop('disabled',false);
			}

			var row = $('<tr>');
			row.append($('<td class="text-center"><select name="kode_produksi[]" class="form-control kode'+n+'" id="'+n+'" onchange="get_stok(this.id)">'+options+'</select></td>'))
				.append($("<td class='text-center'><input type='number' name='stok[]' class='form-control stok"+n+"' id='"+n+"' readonly></td>"))
				.append($("<td class='text-center'><input type='number' min='1' name='tarik[]'' onkeyup='hitung(this.id)' class='form-control tarik"+n+"' id='"+n+"' required></td>"));
			$('#panel_tabel tbody').append(row);
		});
		$('#delRow').click(function() {
			document.getElementById('panel_tabel').deleteRow(i);
			i-=1;
			n-=1;
			if(i==1) {
				$('#delRow').prop('disabled',true);
			}
			else {
				$('#delRow').prop('disabled',false);
			}
		});
	});
</script>
<!-- /Add/Remove Row -->