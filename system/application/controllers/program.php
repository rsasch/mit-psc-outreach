<?php

class Program extends PSC_Controller {

	function Program() {
		parent::PSC_Controller();
	}
	
	function view($id, $context) {
		$data = $this->getProgramData($id);

		// make sure program is active
		if (!$data["program"]->active_flag) {
			show_error("This program is currently inactive.");
		}

		$this->load->library('session');
		$this->session->userdata('idlist');

		$ids =  $this->session->userdata('idlist');
		$data["prevlink"] = "";
		$data["nextlink"] = "";

		if ($ids) {
			for ($i = 0; $i < count($ids); $i++) {
				if ($id == $ids[$i]) {
					if ($i > 0) {
						$data["prevlink"] = $ids[$i - 1];
					}
					if ($i < count($ids) - 1) {
						$data["nextlink"] = $ids[$i + 1];
					}
					break;
				}
			}
		}
		
		$data["context"] = $context;

		// load view with data
		$this->load->view('program_view', $data);
	}
	
}

/* End of file program.php */
/* Location: ./system/application/controllers/program.php */