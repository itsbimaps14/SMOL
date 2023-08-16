<?php
$dept	= $this->session->userdata('dept');
$url	= $this->uri->segment(2);
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
date_default_timezone_set('Asia/Jakarta');
$today=date("Y M d");
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Report Parameter Release</h1>
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
		<table id="report_par_release" class="table table-bordered table-hover dt-responsive datatable" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<th>Golongan</th>
					<th>Kode Oracle</th>
					<th>Nama Bahan</th>
					<th>Umur Simpan</th>
					<th>Kondisi Penyimpanan</th>
					<th>Kategori Spek</th>
					<th>Nama Parameter</th>
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
	var nama_release =  'Data Parameter Release_';
	var nama_monitoring =  'Data Parameter Monitoring_';
	var today = '<?php echo $today;?>';

	// Datatables for Parameter Release
	$(document).ready(function() {
		//datatables
		table = $('#report_par_release').dataTable({
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
		       			title: nama_release+today
		       		}
				]   
		    },
			"lengthMenu": [[1, 15, 20, -1], [1, 15, 20, "All"]],
        	"pageLength": 10,
			"responsive": true,
			"processing": false, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [0,'asc'], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('report_par/report_par_release');?>',
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
				{"mData": "id_t_parameter_release",class:'text-center',width:30},
				{"mData": "nama_golongan",class:'text-center',width:30},
				{"mData": "kode_oracle"},
				{"mData": "nama_bahan"},
				{"mData": "umur_simpan"},
				{"mData": "kondisi_penyimpanan"},
				{"mData": "kat_spek"},
				{"mData": "nama_parameter"}
			],
			"language": {
				"zeroRecords": "Data tidak ditemukan",
				"infoEmpty": "Tidak ada data"
			}
		});
	});

</script>
<!-- /Datatables -->