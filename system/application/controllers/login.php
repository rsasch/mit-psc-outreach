<?php

class Login extends PSC_Controller {

	function Login() {
		parent::PSC_Controller();	
	}
	
	function index() {
		// load view
		$this->load->view('login_view');
	}
	
	function add() {
		// if new user data has been submitted and should be saved
		if (isset($_POST["save"])) {

			// back-end data validation
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
			$config = array(
				array(
					 'field'   => 'kerb',
					 'label'   => '<strong>MIT Kerberos ID</strong>',
					 'rules'   => 'required'
				  ),
				array(
					 'field'   => 'email',
					 'label'   => '<strong>MIT email</strong>',
					 'rules'   => 'required'
				  )
			);
			$this->form_validation->set_rules($config);

			if ($this->form_validation->run() == FALSE) {
				// set error reporting so that undefined variables won't throw error
				error_reporting(E_ERROR | E_PARSE);

				$data["controller"] = "login";
				$data["mode"] = "add";
		
				// load view
				$this->load->helper('form');
				$this->load->view('admin_user_view', $data);
			}
			else {
				$this->load->model('user_model');
				if ($this->user_model->getUserID($_POST["kerb"]) === FALSE) {			
					$data["first_name"] = $_POST["first_name"];
					$data["last_name"] = $_POST["last_name"];
					$data["kerb"] = $_POST["kerb"];
					$data["title"] = $_POST["title"];
					$data["address"] = $_POST["address"];
					$data["email"] = $_POST["email"];
					$data["phone"] = $_POST["phone"];
					$data["dlc"] = $_POST["dlc"];
					$data["role_id"] = "1";
					$data["add_approval_flag"] = "1";
					$data["active_flag"] = "0";
					$this->user_model->addUser($data);
	
					// send notification emails
					$this->sendMessage("14", $data["email"], "Request received for an Outreach Database account", $this->PSCemail);
	
					redirect("/login/success");
				}
				else {
					show_error("<p>You already have an account, and <a href='/login'>you can log in here</a>.</p>");
				}
			}
		}
		// if user form should be displayed
		else {
			// set error reporting so that undefined variables won't throw error
			error_reporting(E_ERROR | E_PARSE);
	
			$data["controller"] = "login";
			$data["mode"] = "add";
	
			// load view
			$this->load->helper('form');
			$this->load->view('admin_user_view', $data);
		}
	}
	
	function noaccount() {
		// load view
		$this->load->view('noaccount_view');
	}
	
	function success() {
		$this->load->view('add_user_success');
	}
}

/* End of file login.php */
/* Location: ./system/application/controllers/login.php */