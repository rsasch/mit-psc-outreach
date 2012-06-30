<?php

class Adminuser extends PSC_Admincontroller {

	function Adminuser() {
		parent::PSC_Admincontroller();
		parent::index(); 
	}
	
	function index() {
		if ($this->userlevel != "0") {
			show_error("You do not have the permissions to view other user data.");
		}
		$this->load->model('user_model');
		$data['userlevel'] = $this->userlevel;
		$data["userid"] = $this->userid;
		$data["userkerb"] = $this->userkerb;
		$data["pscusers"] = $this->user_model->getActiveUsersByRole("0");
		$data["progusers"] = $this->user_model->getActiveUsersByRole("1");
		$data["inactiveusers"] = $this->user_model->getInactiveUsers();
		
		// load view with data
		$this->load->view('admin_user_listing_view', $data);
	}
	
	function edit($id) {
		if ($this->userlevel != "0" && $id != $this->userid) {
			show_error("You do not have the permissions to edit other user data.");
		}
		// back-end data validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		$config = array(
		   array(
				 'field'   => 'first_name',
				 'label'   => '<strong>First Name</strong>',
				 'rules'   => 'required'
			  ),
		   array(
				 'field'   => 'last_name',
				 'label'   => '<strong>Last Name</strong>',
				 'rules'   => 'required'
			  ),
		   array(
				 'field'   => 'kerb',
				 'label'   => '<strong>MIT Kerberos ID</strong>',
				 'rules'   => 'required'
			  ),
		   array(
				 'field'   => 'title',
				 'label'   => '<strong>Title</strong>',
				 'rules'   => 'required'
			  ),
		   array(
				 'field'   => 'dlc',
				 'label'   => '<strong>Dept/Lab/Center</strong>',
				 'rules'   => 'required'
			  ),
		   array(
				 'field'   => 'address',
				 'label'   => '<strong>MIT Location</strong>',
				 'rules'   => 'required'
			  ),
		   array(
				 'field'   => 'phone',
				 'label'   => '<strong>Phone</strong>',
				 'rules'   => 'required'
			  ),
		   array(
				 'field'   => 'email',
				 'label'   => '<strong>Email</strong>',
				 'rules'   => 'required'
			  )
		);		
		$this->form_validation->set_rules($config);
		$this->load->model('user_model');
		$this->load->model('message_model');

		$data = array();
		$data["user_id"] = $id;
		// if user is being approved
		if (isset($_POST["approve"]) && $_POST["approve"] != "") {
			if ($this->form_validation->run() == FALSE) {
				$data['user'] = $this->user_model->getUserData($id);
				$data['userlevel'] = $this->userlevel;
				$data["userid"] = $this->userid;
				$data["userkerb"] = $this->userkerb;
				$data["controller"] = "adminuser";
				$data["mode"] = "edit";
				$this->load->view('admin_user_view', $data);
			}
			else {
				$data["add_approval_flag"] = "0";
				$data["active_flag"] = "0";
				$this->update($data);
	
				// send notification email
				$recipient = $this->user_model->getUserData($id);
				$this->sendMessage("2", $recipient->email, "You have a new Outreach Database account");
	
				redirect("/admin/index/5");
			}

		}
		// if user is being denied
		else if (isset($_POST["deny"]) && $_POST["deny"] != "") {
			// send notification email
			$recipient = $this->user_model->getUserData($id);
			$this->sendMessage("3", $recipient->email, "Request denied for Outreach Database account", $this->PSCemail);
			$this->user_model->removeUser($id);
			redirect("/admin/index/6");
		}
		// if user profile is being updated
		else if (isset($_POST["user_id"])) {
			if ($this->form_validation->run() == FALSE) {
				$data['user'] = $this->user_model->getUserData($id);
				$data['userlevel'] = $this->userlevel;
				$data["userid"] = $this->userid;
				$data["userkerb"] = $this->userkerb;
				$data["controller"] = "adminuser";
				$data["mode"] = "edit";
				$this->load->view('admin_user_view', $data);
			}
			else {
				$this->update($data);
				redirect("/admin/index/2");
			}
		}
		// if user's own profile should be displayed
		else {
			$data['user'] = $this->user_model->getUserData($id);
			$data['userlevel'] = $this->userlevel;
			$data["userid"] = $this->userid;
			$data["userkerb"] = $this->userkerb;
			$data["controller"] = "adminuser";
			$data["mode"] = "edit";
	
			// load view with data
			$this->load->view('admin_user_view', $data);
		}
	}
	
	private function update($data) {
		$data["first_name"] = $_POST["first_name"];
		$data["last_name"] = $_POST["last_name"];
		$data["kerb"] = $_POST["kerb"];
		$data["title"] = $_POST["title"];
		$data["address"] = $_POST["address"];
		$data["email"] = $_POST["email"];
		$data["phone"] = $_POST["phone"];
		$data["dlc"] = $_POST["dlc"];
		$this->user_model->updateUserData($data);
	}

}

/* End of file adminuser.php */
/* Location: ./system/application/controllers/adminuser.php */