<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class attach extends CI_Controller {

	public function download($folder=NULL,$sub_folder=NULL,$plant=NULL,$year=NULL,$month=NULL,$filename=NULL,$running=NULL)
	{
		//FREEDOM
		if($filename == NULL) {
			if(!force_download("uploads/$folder/$sub_folder/$plant/$year/$month/$running",NULL)) {
				echo "File not found";
			}
		}
		else {
			if(!force_download("uploads/$folder/$sub_folder/$plant/$year/$month/$running/$filename",NULL)) {
				echo "File not found";
			}
		}
	}

}

/* End of file attach.php */
/* Location: ./application/controllers/attach.php */