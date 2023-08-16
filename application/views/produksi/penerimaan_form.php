<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
?>

<?php
$url	= $this->uri->segment(2);
$method = $this->uri->segment(3);
if ($url == 'proses') {
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
		'date'=>date('Y-m-d'),
		'name'=>$this->session->userdata('nama'),
		'action'=>'proses');

	$hidden = array('permintaan'=>$record['id_permintaan']);	
}
?>
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"><?php echo $data['title'];?> Penerimaan Supporting Material</h1>

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
						<b>Panel Stok Gudang</b>
					</div>
					<div class="panel-body">
						<table class="table table-striped table-bordered table-hover" cellspacing="0" width="100%" id="panel_tabel">
							<thead>
								<tr>
									<th>Kode Produksi</th>
									<th>Jumlah Kirim</th>
									<th>Expired Date</th>
									<th>Jumlah Diterima</th>
								</tr>
							</thead>
							<tbody>
<?php
	$id = 0; $terima = 0;
	$panel = get_log_panel($data['running'])->result();
	foreach ($panel as $hasil) {
		echo "<tr>";
		echo "<td>
<input type='text' name='kode_produksi[]' class='form-control kode".$id."' id='".$id."' value='".$hasil->kode_produksi."' readonly>
<input type='hidden' name='id[]' value='".$hasil->id."'>
<input type='hidden' name='stok[]' value='".$hasil->stok."'>
<input type='hidden' name='tanggal[]' value='".$hasil->tanggal."'>
<input type='hidden' name='penanggungjawab[]' value='".$hasil->penanggungjawab."'>
			</td>";
		echo "<td><input type='number' name='stok[]' class='form-control stok".$id."' id='".$id."' value='".$hasil->jumlah."' readonly>
				</td>";
		echo "<td><input type='text' name='ed[]' class='form-control ed".$id."' id='".$id."' value='".$hasil->tanggal_exp."' readonly>
				</td>";
		echo "<td><input type='number' name='acc[]' class='form-control terima".$id."' id='".$id."' onkeyup='hitung(this.id)' value='".$hasil->jumlah."' required>
				</td>";
		echo "</tr>";
		$id += 1; $terima += $hasil->jumlah;
	}
?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
					<?php echo form_label('Tanggal Terima.','date');?>
					<?php echo form_input('date',$data['date'],array('class'=>'form-control'));?>
				</div>
				<div class="col-md-4">
					<?php echo form_label('Jumlah Terima.','terima');?>
					<?php echo form_input('terima',$terima,array('class'=>'form-control','id'=>'terima'));?>
				</div>
				<div class="col-md-4">
					<?php echo form_label('Penerima.','penerima');?>
					<?php echo form_input('penerima',$data['name'],array('class'=>'form-control'));?>
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
		$('[name=running],[name=satuan],[name=kode_oracle],[name=nama_bahan],[name=jumlah],[name=date]').prop('readonly',true);
		$('[name=terima]').prop('readonly',true);
	});
</script>
<!-- /Readonly Input -->

<!-- Penghitungan Terima -->
<script type="text/javascript">
	function hitung(id){
		var hasil = 0;
		var tmp = 0;
		var no = <?php echo $id-1;?>;
		for(no;no>=0;no--){
			var get = $('.terima'+no).val();
			tmp = parseInt(get);
			hasil = hasil + tmp;
		}
		$('#terima').val(hasil);
	}
</script>
<!-- /Penghitungan Terima -->