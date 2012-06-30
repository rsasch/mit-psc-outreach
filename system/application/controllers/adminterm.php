<?php

class Adminterm extends PSC_Admincontroller {

	function Adminterm() {
		parent::PSC_Admincontroller();
		parent::index();
	}
	
	function index() {
		if ($this->userlevel != "0") {
			show_error("You do not have the permissions to modify search criteria.");
		}
		// load models
		$this->load->model('category_model');

		$data['categories'] = $this->category_model->getAll();
		$data['userlevel'] = $this->userlevel;
		$data["userid"] = $this->userid;
		$data["userkerb"] = $this->userkerb;
		$data["allTerms"] = $this->getNestedTermData();

		// load view with data
		$this->load->view('admin_term_view', $data);
	}
	
	function add() {
		if ($this->userlevel != "0") {
			show_error("You do not have the permissions to modify search criteria.");
		}
		// back-end data validation
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		$config = array(
		   array(
				 'field'   => 'term_name',
				 'label'   => '<strong>New criterion</strong>',
				 'rules'   => 'required'
			  )
		);
		$this->form_validation->set_rules($config);
		if ($this->form_validation->run() == FALSE) {
			$this->load->model('category_model');
			$data['categories'] = $this->category_model->getAll();
			$data['userlevel'] = $this->userlevel;
			$data["userid"] = $this->userid;
			$data["userkerb"] = $this->userkerb;
			$data["allTerms"] = $this->getNestedTermData();

			// load view with data
			$this->load->view('admin_term_view', $data);
		}
		else {
			$this->load->model('term_model');
			$data["term_name"] = $_POST["term_name"];
			$data["category_id"] =  $_POST["category_id"];
			$this->term_model->add_term($data);
			redirect("/admin/index/9");
		}
	}
}

/* End of file adminterm.php */
/* Location: ./system/application/controllers/adminterm.php */