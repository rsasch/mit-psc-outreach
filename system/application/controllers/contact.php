<?php

class Contact extends PSC_Controller {

	function Contact() {
		parent::PSC_Controller();	
	}
	
	function index() {
		$this->load->library('session');
		$this->session->sess_destroy();

		
		// load view with data
		$this->load->view('contact_view');
	}
	
}

/* End of file contact.php */
/* Location: ./system/application/controllers/contact.php */