<?php
$dept	= $this->session->userdata('dept');
$url	= $this->uri->segment(1);
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Master Nama Parameter</h1>
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
	echo anchor('parameter/add','Tambah','class="btn btn-primary"');
?>
<br><br>
<div class="row">
	<div class="col-md-12">
		<table id="table_nama_parameter" class="table table-bordered table-hover dt-responsive datatable" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>No</th>
					<th>Kategori Spek</th>
					<th>Nama Parameter</th>
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
		table = $('#table_nama_parameter').dataTable({
			"lengthMenu": [[10, 15, 20, -1], [10, 15, 20, "All"]],
        	"pageLength": 10,
			"responsive": true,
			"processing": false, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [1,'asc'], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('parameter/table_nama_parameter');?>',
				"type": "POST",
				"dataType": "json"
			},
			"fnRowCallback": function(nRow,aData,iDisplayIndex,iDisplayIndexFull) {
				var index = iDisplayIndex + 1;
				$('td:eq(0)',nRow).html(index);
				return nRow;
			},
			//Set column definition initialisation properties.
			"aoColumns": [
				{"mData": "id_t_nama_parameter",class:'text-center',width:30},
				{"mData": "kat_spek"},
				{"mData": "nama_parameter"},
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