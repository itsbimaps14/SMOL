<?php
$this->load->view('nav/nav');
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Data Produk</h1>

<?php
if($this->session->flashdata('msg_edit_success')) {?>
	<div class="alert alert-success alert-dismissible fade in" role="alert">
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
		<?php echo $this->session->flashdata('msg_edit_success');?>
	</div>
<?php }?>

	</div>
</div>
<?php
echo anchor('produk/add','Tambah','class="btn btn-primary"');
?>
<br>
<br>
<div class="row">
	<div class="col-md-12">
		<table id="table-produk" class="table table-bordered table-hover dt-responsive nowrap datatable" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th width="30" class="text-center">No</th>
					<th>Kode Item</th>
					<th>Nama Produk</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<td colspan="4" class="dataTables_empty text-center">Loading data from server</td>
			</tbody>
		</table>
	</div>
</div>

<!-- Datatables -->
<script type="text/javascript">
	var save_method; //for save method string
	var table;
	$(document).ready(function() {
		//datatables
		table = $('#table-produk').DataTable({
			"responsive": true,
			"processing": false, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [2,'asc'], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('produk/json');?>',
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
				{"mData": 'id_listproduk',class:'text-center'},
				{"mData": "kode_item"},
				{"mData": "nama_produk"},
				{"mData": "action",class:'text-center',width:100}
			],
			"language": {
				"zeroRecords": "Data tidak ditemukan",
				"infoEmpty": "Tidak ada data"
			}
		});
	});
</script>
<!-- /Datatables -->