<?php
$dept	= $this->session->userdata('dept');
$url	= $this->uri->segment(1);
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Master Data Golongan</h1>
		<?php
		if($this->session->flashdata('msg_success')) {?>
			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<?php echo $this->session->flashdata('msg_success');?>
			</div>
		<?php }?>
	</div>
</div>
<?php
	echo anchor('golongan/add','Tambah','class="btn btn-primary"');
?>
<br><br>
<div class="row">
	<div class="col-md-12">
		<table id="table_nama_golongan" class="table table-bordered table-hover dt-responsive datatable" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>No</th>
					<th>ID</th>
					<th>Nama Golongan</th>
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
		table = $('#table_nama_golongan').dataTable({
			"lengthMenu": [[10, 15, 20, -1], [10, 15, 20, "All"]],
        	"pageLength": 10,
			"responsive": true,
			"processing": false, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [2,'asc'], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('golongan/table_nama_golongan');?>',
				"type": "POST",
				"dataType": "json"
			},
			"columnDefs": [
				{
					"searchable": false,
					"orderable": false,
					"targets": [3,0]},
				{
					"visible": false,
					"targets": 1}
			],
			"fnRowCallback": function(nRow,aData,iDisplayIndex,iDisplayIndexFull) {
				var index = iDisplayIndex + 1;
				$('td:eq(0)',nRow).html(index);
				return nRow;
			},
			//Set column definition initialisation properties.
			"aoColumns": [
				{"mData": "id_t_golongan",class:'text-center',width:30},
				{"mData": "id_t_golongan"},
				{"mData": "nama_golongan"},
				{"mData": "action",class:'text-center',width:300}
			],
			"language": {
				"zeroRecords": "Data tidak ditemukan",
				"infoEmpty": "Tidak ada data"
			}
		});
	});

</script>
<!-- /Datatables -->