<?php

class Faq extends PSC_Controller {

	function Faq() {
		parent::PSC_Controller();	
	}
	
	function index() {
		$this->load->library('session');
		$this->session->sess_destroy();

		
		// load view with data
		$this->load->view('faq_view');
	}
	
}

/* End of file faq.php */
/* Location: ./system/application/controllers/faq.php */