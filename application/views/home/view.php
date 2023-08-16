<div class="row">
	<div class="col-md-12">
		<h1 class="page-header">Home</h1>
		<h4 class="page-header">Sosialisasi Spek Supporting Material Baru</h4>
		<table id="table-sssmb" class="table table-bordered table-hover dt-responsive nowrap datatable" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th width="30" class="text-center">No</th>
					<th>No. UPP</th>
					<th>Nama Bahan</th>
					<th>Tanggal Berlaku</th>
					<th>Link</th>
				</tr>
			</thead>
			<tbody>
				<td colspan="5" class="dataTables_empty text-center">Loading data from server</td>
			</tbody>
		</table>
		<h4 class="page-header">Informasi Status OK Supporting Material</h4>
		<table id="table-isosm" class="table table-bordered table-hover dt-responsive nowrap datatable" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th width="30" class="text-center">No</th>
					<th>No. UPP</th>
					<th>Nama Bahan</th>
					<th>Tanggal Berlaku</th>
					<th>Link</th>
				</tr>
			</thead>
			<tbody>
				<td colspan="5" class="dataTables_empty text-center">Loading data from server</td>
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
		table = $('#table-sssmb').DataTable({
			"lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
        	"pageLength": 5,
			"responsive": true,
			"processing": false, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [2,'asc'], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('home/t_sssmb_json');?>',
				"type": "POST",
				"dataType": "json"
			},
			"columnDefs": [{
				"searchable": false,
				"orderable": false,
				"targets": 3
			}],
			"fnRowCallback": function(nRow,aData,iDisplayIndex,iDisplayIndexFull) {
				var index = iDisplayIndex + 1;
				$('td:eq(0)',nRow).html(index);
				return nRow;
			},
			//Set column definition initialisation properties.
			"aoColumns": [
				{"mData": 'id',class:'text-center'},
				{"mData": "upp"},
				{"mData": "nama_bahan"},
				{"mData": "tgl"},
				{"mData": "link"}
			],
			"language": {
				"zeroRecords": "Data tidak ditemukan",
				"infoEmpty": "Tidak ada data"
			}
		});
	});

	// Datatables for ISOSM
	$(document).ready(function() {
		//datatables
		table = $('#table-isosm').DataTable({
			"lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
        	"pageLength": 5,
			"responsive": true,
			"processing": false, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [2,'asc'], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('home/t_isosm_json');?>',
				"type": "POST",
				"dataType": "json"
			},
			"columnDefs": [{
				"searchable": false,
				"orderable": false,
				"targets": 3
			}],
			"fnRowCallback": function(nRow,aData,iDisplayIndex,iDisplayIndexFull) {
				var index = iDisplayIndex + 1;
				$('td:eq(0)',nRow).html(index);
				return nRow;
			},
			//Set column definition initialisation properties.
			"aoColumns": [
				{"mData": 'id',class:'text-center'},
				{"mData": "nama"},
				{"mData": "kelas"},
				{"mData": "rumah"},
				{"mData": "kota"}
			],
			"language": {
				"zeroRecords": "Data tidak ditemukan",
				"infoEmpty": "Tidak ada data"
			}
		});
	});

</script>
<!-- /Datatables -->