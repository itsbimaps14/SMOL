<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Tabel Kedatangan  FSC / PSA</h1>
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
		<div class="box">
			<div class="box-body">
		<table id="table_fsc_psa" class="table table-bordered table-hover dt-responsive nowrap datatable">
			<thead>
				<tr>
				<?php
					if ($dept == 'admin') {
						echo "<th>Action</th>";
					}
				?>
					<th>Status QC Release</th>
					<th>Status All QC</th>
					<th>No. Running</th>
					<th>Tanggal Datang</th>
					<th>Kode Item</th>
					<th>Nama Bahan</th>
					<th>No. Lot / Kode Produksi</th>
					<th>No. PO</th>
					<th>Supplier</th>
					<th>Principal</th>
					<th>Prod. Date</th>
					<th>Exp. Date</th>
					<th>Status Umur Simpan</th>
					<th>Jumlah Datang</th>
					<th>Satuan</th>
					<th>COA</th>
					<th>Label</th>
					<th>Lokasi</th>
					<th>Tanggal Dibutuhkan</th>
				</tr>
			</thead>
			<tbody>
	<?php
	foreach($read->result() as $r) {
	if ($dept == 'admin') {
		echo "<tr>
				<td class=text-center>"
					.anchor('psa/edit/'.$r->id_t_kedatangan,'Edit',array('class'=>'btn btn-warning btn-sm')).'&nbsp'
					.anchor('psa/delete/'.$r->id_t_kedatangan,'Delete',array('class'=>'btn btn-danger btn-sm',"onclick"=>"return confirm('Anda yakin ingin menghapus?')")).
					"
				</td>";
		$order = 3;
	}
	else {
		echo "<tr>";
		$order = 2;
	}
		echo "
				<td class='text-center'><label class='label ".get_status_psa($r->status_qc)."'>$r->status_qc</label></td>
				<td class='text-center'><label class='label ".get_status_psa($r->status_all)."'>$r->status_all</label></td>
				<td>$r->no_running_kedatangan</td>
				<td>$r->tanggal_datang</td>
				<td>$r->kode_oracle</td>
				<td>$r->nama_bahan</td>
				<td>$r->kode_produksi</td>
				<td>$r->no_po</td>
				<td>$r->supplier</td>
				<td>$r->principal</td>
				<td>$r->tanggal_prod</td>
				<td>$r->tanggal_exp</td>
				<td>$r->umur_simpan</td>
				<td>$r->jumlah</td>
				<td>$r->satuan</td>
				<td class=text-center>".(empty($r->attachement_coa) ? "Tidak ada file" : 
					anchor('attach/download/file_coa_psa/'.$r->attachement_coa,'<b>Download</b>',array('class'=>'btn btn-link')))."
				</td>
				<td class=text-center>".(empty($r->attachement_coa) ? "Tidak ada label" : 
					anchor('createpdf/pdf_fsc/'.$r->id_t_kedatangan,'<b>Print</b>',array('class'=>'btn btn-link')))."
				</td>
				<td>$r->plant</td>
				<td>$r->tanggal_dibutuhkan</td>
			</tr>";
	}?>
			</tbody>
		</table>
			</div>
	</div>
</div>
</div>

<!-- Datatables -->
<script type="text/javascript">
	$(document).ready(function() {
		//datatables
		table = $('#table_fsc_psa').DataTable({
			"lengthMenu": [[5, 10, -1], [5, 10, "All"]],
			"order" : [<?php echo $order;?>,'desc']
		});
	});
</script>
<!-- /Datatables -->