<?php

// controller class for secure admin pages

class PSC_Controller extends Controller {

	// PSC administrator email/list for notifications
	protected $PSCemail = "rsa@mit.edu";
	if ($this->config->item('env') != 'dev') {
		$PSCemail = "outreach-notify@mit.edu";
	}

	function PSC_Controller() {
		parent::Controller();
		$this->load->helper('navlinks');
	}
	
	function index() {
	}
	
	protected function getNestedTermData () {
		// load models
		$this->load->model('category_model');
		$this->load->model('term_model');

		// get all categories and use to organize terms into nested array of objects
		$categories = $this->category_model->getAll();
		$nestedTerms = array();
		foreach ($categories as $category) {
			$terms = $this->term_model->getTermsByCategory($category->category_id);
			$nestedTerms[$category->category_name] = $terms;
		}
		return $nestedTerms;
	}
	
	protected function getProgramData ($id) {	
		// get simple program data
		$this->load->model('program_model');
		$data["program"] = $this->program_model->getProgramData($id);

		// get terms, organized by category, for program 
		$this->load->model('category_model');
		$categories = $this->category_model->getAll();
		
		$this->load->model('term_model');
		$data["terms"] = $this->getProgramTerms($id);
		return $data;
	}
	
	protected function getProgramTerms ($id) {
		// get terms, organized by category, for program 
		$this->load->model('category_model');
		$categories = $this->category_model->getAll();
		
		$this->load->model('term_model');
		$data["terms"] = array();
		foreach ($categories as $category) {
			$tempArray = $this->term_model->getTermsByIDandCategory($id, $category->category_id);
			if (count($tempArray)) {
				$data["terms"][$category->category_id] = array();
				foreach ($tempArray as $term) {
					$data["terms"][$category->category_id][$term->term_id] = $term->term_name;
				}
			}
		}
		return $data["terms"];
	}

	protected function sendMessage($id, $to, $subject, $cc = '') {
		$this->load->model('message_model');
		$this->load->library('email');		
		$this->email->clear(); // get ready to send email
		
		$this->email->from($this->PSCemail, 'PSC Outreach Database');
		$this->email->to($to);
		$this->email->reply_to($this->PSCemail, 'PSC Outreach Database');
		if ($cc) {
			$this->email->cc($cc);
		}
		$this->email->subject($subject);
		$this->email->message($this->message_model->getMessage($id));
		
		$this->email->send();		
	}
}

require_once(APPPATH.'libraries/PSC_Admincontroller.php'); 
