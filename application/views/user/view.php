<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Data User</h1>
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
<?php
echo anchor('user/add','Tambah','class="btn btn-primary"');
?>
<br>
<br>
<div class="dataTable_wrapper">
	<table id="table-user" class="table table-bordered table-hover dt-responsive nowrap" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th width="30" class="text-center">No</th>
				<th>Username</th>
				<th>Nama</th>
				<th>Role</th>
				<th>Level</th>
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
		table = $('#table-user').DataTable({
			"responsive": true,
			"processing": false, //Feature control the processing indicator.
			"serverSide": true, //Feature control DataTables' server-side processing mode.
			"order": [1,'asc'], //Initial no order.
			// Load data for the table's content from an Ajax source
			"ajax": {
				"url": '<?php echo site_url('user/json');?>',
				"type": "POST",
				"dataType": "json"
			},
			"columnDefs": [{
				"searchable": false,
				"orderable": false,
				"targets": 4
			}],
			"fnRowCallback": function(nRow,aData,iDisplayIndex,iDisplayIndexFull) {
				var index = iDisplayIndex + 1;
				$('td:eq(0)',nRow).html(index);
				return nRow;
			},
			//Set column definition initialisation properties.
			"aoColumns": [
				{"mData": 'id_user',class:'text-center'},
				{"mData": "username"},
				{"mData": "nama"},
				{"mData": "dept"},
				{"mData": "level"},
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