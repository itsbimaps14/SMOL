<?php
$dept	= $this->session->userdata('dept');
$url	= $this->uri->segment(2);
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
date_default_timezone_set('Asia/Jakarta');
$today=date("Y M d");
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Report Kedatangan Release</h1>
		<?php
		if($this->session->flashdata('msg_edit_success')) {?>
			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<?php echo $this->session->flashdata('msg_edit_success');?>
			</div>
		<?php }?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table id="report_release" class="table table-bordered table-hover dt-responsive datatable" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>No Running</th>
					<th>Tanggal Kedatangan</th>
					<th>Kode Oracle</th>
					<th>Nama Bahan</th>
					<th>Kode Produksi</th>
					<th>Kategori Parameter</th>
					<th>Parameter</th>
					<th>Hasil Analisa</th>
					<th>Status Release QC</th>
				</tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>

<hr>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Report Kedatangan Monitoring</h1>
		<?php
		if($this->session->flashdata('msg_edit_success')) {?>
			<div class="alert alert-success alert-dismissible fade in" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
				<?php echo $this->session->flashdata('msg_edit_success');?>
			</div>
		<?php }?>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table id="report_monitoring" class="table table-bordered table-hover dt-responsive datatable" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>No Running</th>
					<th>Tanggal Kedatangan</th>
					<th>Kode Oracle</th>
					<th>Nama Bahan</th>
					<th>Kode Produksi</th>
					<th>Kategori Parameter</th>
					<th>Parameter</th>
					<th>Hasil Analisa</th>
					<th>Status Release QC</th>
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
	var nama_monitoring =  'Data Report Release_';
	var today = '<?php echo $today;?>';

	// Datatables for Parameter Monitoring
	$(document).ready(function() {
		//datatables
		table = $('#report_release').dataTable({
			"dom": 	"<'row'<'col-sm-4'B><'col-sm-4 text-center'><'col-sm-4'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-4'l><'col-sm-4 text-center'><'col-sm-4'f>>" +
    				"<'row'<'col-sm-12'tr>>" +
    				"<'row'<'col-sm-5'i><'col-sm-7'p>>",
		    "buttons": {
		       "dom": {
		          "button": {
		            "tag": "button",
		            "className": "btn btn-success",
		            "value": "Report to Excel"
		          }
		       },
		       "buttons": [
		       		{
		       			extend: 'excel',
		       			text: 'Export to Excel',
		       			title: nama_monitoring+today
		       		}
				]   
		    },
			"lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
        	"pageLength": 5,
			"responsive": true,
			"processing": false, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [1,'desc'], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('psa/report_release');?>',
				"type": "POST",
				"dataType": "json"
			},
			//Set column definition initialisation properties.
			"aoColumns": [
				{"mData": "no_running_kedatangan"},
				{"mData": "tanggal_datang"},
				{"mData": "kode_oracle"},
				{"mData": "nama_bahan"},
				{"mData": "kode_produksi"},
				{"mData": "kat_spek"},
				{"mData": "nama_parameter"},
				{"mData": "analisa_qc_release"},
				{"mData": "status_qc"}
			],
			"language": {
				"zeroRecords": "Data tidak ditemukan",
				"infoEmpty": "Tidak ada data"
			}
		});
	});

</script>
<!-- /Datatables -->

<!-- Datatables -->
<script type="text/javascript">
	var save_method; //for save method string
	var table;
	var nama_monitoring =  'Data Report Monitoring_';
	var today = '<?php echo $today;?>';

	// Datatables for Parameter Monitoring
	$(document).ready(function() {
		//datatables
		table = $('#report_monitoring').dataTable({
			"dom": 	"<'row'<'col-sm-4'B><'col-sm-4 text-center'><'col-sm-4'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-12'>>" +
					"<'row'<'col-sm-4'l><'col-sm-4 text-center'><'col-sm-4'f>>" +
    				"<'row'<'col-sm-12'tr>>" +
    				"<'row'<'col-sm-5'i><'col-sm-7'p>>",
		    "buttons": {
		       "dom": {
		          "button": {
		            "tag": "button",
		            "className": "btn btn-success",
		            "value": "Report to Excel"
		          }
		       },
		       "buttons": [
		       		{
		       			extend: 'excel',
		       			text: 'Export to Excel',
		       			title: nama_monitoring+today
		       		}
				]   
		    },
			"lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
        	"pageLength": 5,
			"responsive": true,
			"processing": false, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [1,'desc'], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('psa/report_monitoring');?>',
				"type": "POST",
				"dataType": "json"
			},
			//Set column definition initialisation properties.
			"aoColumns": [
				{"mData": "no_running_kedatangan"},
				{"mData": "tanggal_datang"},
				{"mData": "kode_oracle"},
				{"mData": "nama_bahan"},
				{"mData": "kode_produksi"},
				{"mData": "kat_spek"},
				{"mData": "nama_parameter"},
				{"mData": "analisa_qc_monitoring"},
				{"mData": "status_qc"}
			],
			"language": {
				"zeroRecords": "Data tidak ditemukan",
				"infoEmpty": "Tidak ada data"
			}
		});
	});

</script>
<!-- /Datatables -->