<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
$id_t_dbspek	= $this->uri->segment(3);
?>

<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header">Edit Database Spek</h1>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table id="view_edit_database_spek" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="text-center">No. DB Spek</th>
					<th class="text-center">Edit</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="text-center">
						<?php echo $record['no_db_spek'];?>
					</td>
					<td class="text-center" colspan="2">
						<?php
							echo anchor('spek/edit_data/'.$id_t_dbspek,'<i class="fa fa-edit"></i><b> Data</b>',array('class'=>'btn btn-warning btn-sm'))."&nbsp";
							echo anchor('spek/edit_release/'.$id_t_dbspek,'<i class="fa fa-edit"></i><b> Release</b>',array('class'=>'btn btn-warning btn-sm'))."&nbsp";
							echo anchor('spek/edit_monitoring/'.$id_t_dbspek,'<i class="fa fa-edit"></i><b> Monitoring</b>',array('class'=>'btn btn-warning btn-sm'));
						?>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>