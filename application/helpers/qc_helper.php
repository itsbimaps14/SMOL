<?php
	function qc_spb_proses($id_t_kedatangan=NULL,$controller=NULL,$status=NULL){
		$CI =& get_instance();
		$data = $CI->model_crud->get_one('t_kedatangan','id_t_kedatangan',$id_t_kedatangan)->row_array();
		switch ($status) {
			case 'admin':
				if ($data['running_spb'] != '') {
					$result = " "
								.anchor($controller.'/view/'.$id_t_kedatangan,'Download SPB',array('class'=>'btn btn-success btn-sm')).'&nbsp'
								.anchor($controller.'/edit/'.$id_t_kedatangan,'Edit / Revisi SPB',array('class'=>'btn btn-warning btn-sm')).
							  " ";}
				else {
					$result = " "
								.anchor($controller.'/input/'.$id_t_kedatangan,'Create SPB',array('class'=>'btn btn-primary btn-sm')).'&nbsp'
								.anchor($controller.'/edit/'.$id_t_kedatangan,'Edit / Revisi SPB',array('class'=>'btn btn-warning btn-sm disabled')).
							  " ";}
			break;
			
			default:
				if ($data['running_spb'] != '') {
					$result = " "
								.anchor($controller.'/view/'.$id_t_kedatangan,'Download SPB',array('class'=>'btn btn-success btn-sm')).
							  " ";}
				else {
					$result = " "
								.anchor($controller.'/input/'.$id_t_kedatangan,'Create SPB',array('class'=>'btn btn-primary btn-sm')).
							  " ";}
			break;
		}
		
		return $result;
	}
?>