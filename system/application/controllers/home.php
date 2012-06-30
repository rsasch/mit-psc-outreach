<?php

class Home extends PSC_Controller {

	function Home() {
		parent::PSC_Controller();	
		$this->load->helper('form');
	}
	
	function index() {
		$this->load->library('session');
		$this->session->sess_destroy();
		
		$data["checkboxes"] = $this->getNestedTermData();
		$data["spotlights"] = array();
		$data["css_class"] = "home";

		// get three random spotlights
		$this->load->model("program_model");
		$maxID = $this->program_model->getHighestID();
		for ($i = 1; $i <= ($maxID * 3); $i++) {
			$thisID = mt_rand(1,$maxID);
			if (!in_array(strval($thisID), $data["spotlights"])) {
				$program = $this->program_model->getProgramSpotlightData($thisID);
				if ($program && $program->photo_path != "" && $program->active_flag == "1") {
					$data["spotlights"][$thisID] = $program;
				}
			}
			if (count($data["spotlights"]) >= 3) {
				break;
			}
		}

		$data["heading"] = "Search by keywords";
		$data["searchbutton"] = "Search";
		
		// load view with data
		$this->load->view('home_view', $data);
	}
	
	function search($page = "") {

		$this->load->model("search_model");
		$this->load->library('session');
		$data = array();
		$data["checkboxes"] = $this->getNestedTermData();
		$data["programs"] = array();
		$data['per_page'] = '10';

		// clear session if any data was posted
		if (isset($_POST["search"])) {
			unset($_POST["page"]);
			$page = "1";
		}

		if (isset($_POST["search"]) || isset($_POST["page"])) {
			$this->session->sess_destroy();
			if (isset($_POST["page"])) {
				$page = $_POST["page"];
			}
		}

		if ($page) {
			$start = ($page - 1) * $data["per_page"];
			$data["this_page"] = $page;
		}
		else if (isset($_POST["pagename"])) {
			$start = ($_POST["pagename"] - 1) * $data["per_page"];
			$data["this_page"] = $_POST["pagename"];
		}
		else if ($this->session->userdata('page')) {
			$start = ($this->session->userdata('page') - 1) * $data["per_page"];
			$data["this_page"] = $this->session->userdata('page');
		}
		else {
			$start = "0";
			$data["this_page"] = 1;
		}


		if (isset($_POST["keywords"]) && $_POST["keywords"] == "Search Terms") {
			$_POST["keywords"] = "";
		}

		// grab data submitted by POST
		if (isset($_POST["search"]) || isset($_POST["page"])) {
			if (isset($_POST["terms"])) {
				$data["term_ids"] = $_POST["terms"];
				$this->session->set_userdata('terms', $_POST["terms"]);
			}
			else {
				$data["term_ids"] = array();
				$this->session->set_userdata('terms', array());
			}
			$data["keywords"] = $_POST["keywords"];
			$data["programs"] = $this->search_model->search($data, $start, $data["per_page"]);
			$data['total_rows'] = count($this->search_model->search($data));
			$ids = $this->getProgramIDs($this->search_model->search($data));
			$this->session->set_userdata('keywords', $data["keywords"]);
		}
		// grab data in session 
		else if ($this->session->userdata('terms') || $this->session->userdata('keywords')) {
			if ($this->session->userdata('terms')) {
				$data["term_ids"] = $this->session->userdata('terms');
			}
			$data["keywords"] = $this->session->userdata('keywords');
			$data["programs"] = $this->search_model->search($data, $start, $data["per_page"]);
			$data['total_rows'] = count($this->search_model->search($data));
			$ids = $this->getProgramIDs($this->search_model->search($data));
		}
		else {
			$data["programs"] = $this->search_model->getAll($start, $data["per_page"]);
			$data['total_rows'] = count($this->search_model->getAll());
			$ids = $this->getProgramIDs($this->search_model->getAll());
		}
	
		// pagination
		$data["total_pages"] = ceil($data['total_rows'] / $data['per_page']);
		if ($data["programs"]) {
			$data["prevlink"] = "";
			$data["nextlink"] = "";
			if ($data["this_page"] > 1) {
				$data["prevlink"] = $data["this_page"] - 1;
			}
			if ($data["this_page"] < $data["total_pages"]) {
				$data["nextlink"] = $data["this_page"] + 1;
			}
		}

		$data["heading"] = "Your criteria";
		$data["searchbutton"] = "Search again";
		$data["start"] = $start;
		$data["css_class"] = "results";
		$this->session->set_userdata('idlist', $ids);
		$this->session->set_userdata('page', $data["this_page"]);

		// load view with data
		$this->load->view('home_view', $data);
	}
	
	private function getProgramIDs($programs) {
		$ids = array();
		if (count($programs)) {
			foreach ($programs as $program) {
				array_push($ids, $program->program_id);
			}
			return $ids;
		}
		else {
			return FALSE;
		}
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */