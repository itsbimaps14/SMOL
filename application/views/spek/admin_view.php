<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Database Spek</h1>
<?php
if($this->session->flashdata('msg_edit_success')) {?>
	<div class='alert alert-success alert-dismissable'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<?php echo $this->session->flashdata('msg_edit_success');?>
	</div>
<?php }?>
	</div>
</div>
<?php
	echo anchor('spek/add','Tambah','class="btn btn-primary"');
?>
<br><br>
<div class="row">
	<div class="col-md-12">
		<table id="table_database_spek" class="table table-bordered table-hover dt-responsive datatable" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>No. DB Spek</th>
					<th>Kode Oracle</th>
					<th>Nama Bahan</th>
					<th>Tanggal Berlaku</th>
					<th>Revisi</th>
					<th>Status</th>
					<th>View</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<!-- Datatables -->
<script type="text/javascript">
	var save_method; //for save method string
	var table;

	// Datatables for SSSMB
	$(document).ready(function() {
		//datatables
		table = $('#table_database_spek').DataTable({
			"lengthMenu": [[10, 15, 20, -1], [10, 15, 20, "All"]],
        	"pageLength": 10,
			"responsive": true,
			"processing": false, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [1,'desc'], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('spek/table_database_spek');?>',
				"type": "POST",
				"dataType": "json"
			},
			"columnDefs": [
				{
				"searchable": false,
				"orderable": false,
				"targets": 7},
				{
				"searchable": false,
				"orderable": false,
				"targets": 8}
			],
			"fnRowCallback": function(nRow,aData,iDisplayIndex,iDisplayIndexFull) {
				var index = iDisplayIndex + 1;
				$('td:eq(0)',nRow).html(index);
				return nRow;
			},
			//Set column definition initialisation properties.
			"aoColumns": [
				{"mData": "no_db_spek"},
				{"mData": "no_db_spek"},
				{"mData": "kode_oracle"},
				{"mData": "nama_bahan"},
				{"mData": "tanggal_berlaku"},
				{"mData": "revisi"},
				{"mData": "status_db_spek"},
				{"mData": "view",class:'text-center'},
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