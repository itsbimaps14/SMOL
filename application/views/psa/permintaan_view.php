<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Permintaan Supporting Material</h1>
<?php
if($this->session->flashdata('msg_edit_success')) {?>
	<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<?php echo $this->session->flashdata('msg_edit_success');?>
	</div>
<?php }?>
<?php
if($this->session->flashdata('msg_username')) {?>
	<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<?php echo $this->session->flashdata('msg_username');?>
	</div>
<?php }?>
	</div>
</div>
<div class="dataTable_wrapper">
	<table id="table-permintaan-psa" class="table table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Running Number</th>
				<th>Status</th>
				<th>Kode Oracle</th>
				<th>Nama Bahan</th>
				<th>Tanggal Permintaan</th>
				<th>Jumlah</th>
				<th>Pemohon</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<td colspan="5" class="dataTables_empty text-center">Loading data from server</td>
		</tbody>
	</table>
</div>

<!-- Datatables -->
<script type="text/javascript">
	var save_method; //for save method string
	var table;
	$(document).ready(function() {
		//datatables
		table = $('#table-permintaan-psa').DataTable({
			"responsive": true,
			"processing": false, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [0,'desc'], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('psa/json_permintaan');?>',
				"type": "POST",
				"dataType": "json"
			},
			"columnDefs": [{
				"searchable": false,
				"orderable": false,
				"targets": 7
			}],
			//Set column definition initialisation properties.
			"aoColumns": [
				{"mData": 'running_permintaan'},
				{"mData": "status"},
				{"mData": "kode_oracle"},
				{"mData": "nama_bahan"},
				{"mData": "tanggal_permintaan"},
				{"mData": "jumlah_permintaan"},
				{"mData": "pemohon"},
				{"mData": "action",class:'text-center'}
			],
			"language": {
				"zeroRecords": "Data tidak ditemukan",
				"infoEmpty": "Tidak ada data"
			}
		});
	});
</script>
<!-- /Datatables -->