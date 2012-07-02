<?php

// controller class for secure admin pages

class PSC_Admincontroller extends PSC_Controller {

	protected $userid = "";
	protected $userlevel = "";
	protected $userkerb = "";

	function PSC_Admincontroller() {
		parent::PSC_Controller(); 
		$this->load->helper('form');
	}
	
	function index() {
		$obj =& get_instance();

		if ($obj->config->item('env') != 'dev') {
			// ssl variables
			$sslArray = array(
				"ok" => $_SERVER['SSL_CLIENT_VERIFY'],
				"https" => $_SERVER['HTTPS'],
				"realName" => $_SERVER['SSL_CLIENT_S_DN_CN'],
				"email" => strtolower($_SERVER['SSL_CLIENT_S_DN_Email'])
			);
			
			// check if SSL connection has been established, otherwise throw error
			if (($sslArray["ok"]) && ($sslArray["https"] == "on")) {
			
				$this->load->model('user_model');
				$kerb = str_ireplace("@mit.edu", "", $sslArray["email"]);
				
				$this->userlevel = $this->user_model->getUserRole($kerb);
				$this->userkerb =  $kerb;
	
				// if user not a memeber, throw error
				if ($this->userlevel === FALSE) {
					redirect("/login/noaccount");
				}
				
				$this->userid = $this->user_model->getUserID($kerb);
	
				if (!$this->user_model->isUserActive($this->userid)) {
					redirect("/login/noaccount");
				}
	
				// set base_url to include the 's'
				$obj->config->set_item('base_url',str_replace("http:", "https:", base_url()));
			}
			else {
				show_error('SSL connection was not established.');
			}
		}
		else {
			$this->load->model('user_model');
			$kerb = "rsa";
			
			$this->userlevel = $this->user_model->getUserRole($kerb);
			$this->userkerb =  $kerb;

			$this->userid = $this->user_model->getUserID($kerb);
		}
		
		// make sure javascript is enabled
		if (count($_POST) && !isset($_POST["javascript"])) {
			show_error("This application requires javascript.  Please enable it and reload the previous page.");
		}
	}

}
