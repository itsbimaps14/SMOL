<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class createpdf extends CI_Controller {

	var $table = 't_kedatangan';

	public function pdf_fsc()
	{
		$this->load->helper('pdf_helper');

		// Data yang di bawa ke pdf
		$id_t_kedatangan	= $this->uri->segment(3);
		$data['read'] = $this->db->query("
			SELECT kode_oracle,nama_bahan,satuan,t_kedatangan.*
			FROM t_kedatangan
			INNER JOIN t_db_spek ON t_kedatangan.kode_id_t_db_spek = t_db_spek.id_t_dbspek
			WHERE id_t_kedatangan = '$id_t_kedatangan'
			");

		$this->load->view('pdf/pdf_fsc',$data);
	}

}

/* End of file createpdf.php */
/* Location: ./application/controllers/createpdf.php */