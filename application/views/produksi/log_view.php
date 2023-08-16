<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Stok Gudang Produksi</h1>
<?php
if($this->session->flashdata('msg_success')) {?>
	<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<?php echo $this->session->flashdata('msg_success');?>
	</div>
<?php }?>
<!-- UNTUK ERROR UPLOAD -->
		<?php echo (empty($error) ? "" :"
			<div class='alert alert-danger alert-dismissible fade in' role='alert'>
				<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>×</span>
				</button>$error
			</div>
		");?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table id="table_fsc_psa" class="table table-bordered table-hover dt-responsive nowrap datatable">
			<thead>
				<tr>
					<th class='text-center'>No.</th>
					<th>Kode Oracle</th>
					<th>Nama Bahan</th>
					<th>Kode Produksi</th>
					<th>Running</th>
					<th>Tanggal</th>
					<th>Status</th>
					<th>Jumlah</th>
					<th>Penanggung Jawab</th>
				</tr>
			</thead>
			<tbody>
	<?php
	$no = 1;
	foreach($read->result() as $r) {
		echo "<tr>
				<td class='text-center'>$no</td>
				<td>$r->kode_oracle</td>
				<td>$r->nama_bahan</td>
				<td>$r->kode_produksi</td>
				<td>$r->nomor_running</td>
				<td>$r->tanggal</td>
				<td>$r->status</td>
				<td class='text-center'>$r->jumlah</td>
				<td>$r->penanggungjawab</td>
			</tr>";
		$no += 1;
	}
	?>
			</tbody>
		</table>
	</div>
</div>

<!-- Datatables -->
<script type="text/javascript">
	$(document).ready(function() {
		//datatables
		table = $('#table_fsc_psa').DataTable({
			"lengthMenu": [[,5, 10, -1], [5, 10, "All"]]
		});
	});
</script>