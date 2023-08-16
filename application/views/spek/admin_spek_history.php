<?php
$dept = $this->session->userdata('dept');
$this->load->view('nav/'.$dept.'/'.$dept.'_nav');
$id_t_dbspek	= $this->uri->segment(3);
?>

<div class="row">
	<div class="col-lg-8 col-lg-offset-2">
		<h1 class="page-header">History Database Spek</h1>
	</div>
</div>
<div class="row">
	<div class="col-md-8 col-lg-offset-2">
		<table id="view_edit_database_spek" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th class="text-center">No. DB Spek</th>
					<th class="text-center">Revisi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($history->result() as $r) {?>
				<tr>
					<?php 
						echo "<td class='text-center'>".anchor('spek/view/'.$r->id_t_dbspek,$r->no_db_spek,array('class'=>'btn btn-link'))."</td>";
						echo "<td class=text-center><span class='label label-primary'>".$r->revisi."</span></td>";
					?>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>