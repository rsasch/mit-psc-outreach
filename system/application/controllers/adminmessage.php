<?php

class Adminmessage extends PSC_Admincontroller {

	function Adminmessage() {
		parent::PSC_Admincontroller();
		parent::index(); 
	}
	
	function index() {
		$data['userlevel'] = $this->userlevel;
		$data["userid"] = $this->userid;
		$data["userkerb"] = $this->userkerb;

		$this->load->model('message_model');
		$data["messages"] = $this->message_model->getAll();

		// load view with data
		$this->load->view('admin_message_view', $data);
	}
	
	function edit() {
		$this->load->model('message_model');
		$pos = 0;
		$root = "message";
		$data = array();
		foreach ($_POST as $fieldname => $value) {
			$pos = strpos($fieldname, $root);
			if ($pos !== FALSE) {
				$id = substr($fieldname, strlen($root));
				$data["message_text"] = $value;
				$this->message_model->updateMessage($id, $data);
			}
		}
		redirect("/admin/index/0");
	}
}

/* End of file adminmessage.php */
/* Location: ./system/application/controllers/adminmessage.php */