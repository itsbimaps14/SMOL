<?php
	function create_folder()
	{
		/* PRODUKSI */
		if(!is_dir('uploads/produksi/sterile_air_at/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/produksi/sterile_air_at/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/produksi/proses_fm/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/produksi/proses_fm/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/produksi/proses_sterilisasi/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/produksi/proses_sterilisasi/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/produksi/konsentrasi/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/produksi/konsentrasi/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/produksi/cip_uht/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/produksi/cip_uht/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/produksi/cip_at/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/produksi/cip_at/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/produksi/cip_fm/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/produksi/cip_fm/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/produksi/proses_uht/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/produksi/proses_uht/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/produksi/manual_cleaning_fm/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/produksi/manual_cleaning_fm/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/produksi/system_tightness/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/produksi/system_tightness/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/produksi/proses_phe/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/produksi/proses_phe/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/produksi/kejadian_proses/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/produksi/kejadian_proses/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}

		/* ENGINEERING */
		if(!is_dir('uploads/engineering/overpressure_fm/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/engineering/overpressure_fm/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}

		/* QC RTD */
		if(!is_dir('uploads/qcrtd/swab_test/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/qcrtd/swab_test/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/qcrtd/swab_udara/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/qcrtd/swab_udara/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/qcrtd/swab_higienitas/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/qcrtd/swab_higienitas/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/qcrtd/swab_paper/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/qcrtd/swab_paper/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/qcrtd/inspeksi_filling/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/qcrtd/inspeksi_filling/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/qcrtd/air_bakusoftener/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/qcrtd/air_bakusoftener/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/qcrtd/tube_tightness/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/qcrtd/tube_tightness/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/qcrtd/monitoring_udara/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/qcrtd/monitoring_udara/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/qcrtd/kelarutan_baku/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/qcrtd/kelarutan_baku/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/qcrtd/data_wip/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/qcrtd/data_wip/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
		if(!is_dir('uploads/qcrtd/verifikasi_berkala/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/qcrtd/verifikasi_berkala/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}

		/* QC Baku */
		if(!is_dir('uploads/qcbaku/kedatangan_bb/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/qcbaku/kedatangan_bb/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}

		/* RD Tahanan */
		if(!is_dir('uploads/rdtahanan/uji_saring/'.date("Y").'/'.date('m').'/')) {
			mkdir('uploads/rdtahanan/uji_saring/'.date("Y").'/'.date('m').'/',0777,TRUE);
		}
	}
?>