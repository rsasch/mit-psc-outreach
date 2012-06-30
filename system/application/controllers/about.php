<?php

class About extends PSC_Controller {

	function About() {
		parent::PSC_Controller();	
	}
	
	function index() {
		$this->load->library('session');
		$this->session->sess_destroy();

		
		// load view with data
		$this->load->view('about_view');
	}
	
}

/* End of file about.php */
/* Location: ./system/application/controllers/about.php */