<?php

class Fine extends PSC_Controller {

	function File() {
		parent::PSC_Controller();	
	}
	
	function index() {
		$this->load->library('session');
		$this->session->sess_destroy();

		
		// load view with data
		$this->load->view('fine_view');
	}
	
}

/* End of file fine.php */
/* Location: ./system/application/controllers/fine.php */