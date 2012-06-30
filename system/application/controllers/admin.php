<?php

class Admin extends PSC_Admincontroller {
	private $messages = array(
		0 => "Email notifications have been updated.",
		1 => "Program has been added/updated. You can post other volunteer opportunities <a href=\"/adminprogram/edit\">here</a>.",
		2 => "User profile has been updated.",
		3 => "Program addition/update has been approved.",
		4 => "Program addition/update has been denied.",
		5 => "New user has been approved.",
		6 => "New user has been denied.",
		7 => "Program has been activated.",
		8 => "Program has been inactivated.",
		9 => "Search criteria have been updated.",
		10 => "Program addition/edits have been saved for later."
	);

	function Admin() {
		parent::PSC_Admincontroller();
		parent::index(); 
	}
	
	function index($message = '') {
		if ($message != '') {
			$data["message"] = $this->messages[$message];
		}
		$data['userlevel'] = $this->userlevel;
		$data["userid"] = $this->userid;
		$data["userkerb"] = $this->userkerb;
		
		$this->load->model('user_model');
		$data["username"] = $this->user_model->getUserName($this->userid);
		$this->load->model('program_model');

		// get data for PSC admin landing page
		if ($this->userlevel == "0") {
			$this->load->model('user_model');
			$data["newusers"] = array();
			$data["newusers"] = $this->user_model->getNewUsers();
			
			$data["newprograms"] = array();
			$data["newprograms"] = $this->program_model->getNewPrograms();

			$data["editedprograms"] = array();
			$data["editedprograms"] = $this->program_model->getEditedPrograms();

			$data["expiringprograms"] = array();
			// find date eleven months ago, and find programs last modified before then
			$data["expiringprograms"] = $this->program_model->getProgramsModifiedBeforeDate(date("Y-m-d",strtotime("-11 month")));
		}
		// get data for program admin landing page
		else {
			$data["programs"] = array();
			$data["programs"] = $this->program_model->getMyPrograms($this->userid);
			
			$data["newprograms"] = array();
			$data["newprograms"] = $this->program_model->getMyNewPrograms($this->userid);
			
			$data["unsubmitted"] = array();
			$data["unsubmitted"] = $this->program_model->getMyUnsubmittedPrograms($this->userid);

			$data["editedprograms"] = array();
			$data["editedprograms"] = $this->program_model->getMyEditedPrograms($this->userid);

			$data["inactiveprograms"] = array();
			$data["inactiveprograms"] = $this->program_model->getMyInactivePrograms($this->userid);
		}

		// load view with data
		$this->load->view('admin_landing_view', $data);
	}
	
	function success() {
		$data['userlevel'] = $this->userlevel;
		$data["userid"] = $this->userid;
		$data["userkerb"] = $this->userkerb;

		// load view with data
		$this->load->view('admin_success_view', $data);
	}
}

/* End of file admin.php */
/* Location: ./system/application/controllers/admin.php */
