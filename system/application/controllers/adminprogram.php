<?php

class Adminprogram extends PSC_Admincontroller {
	/* --------------------------------------------------------------------------
	| Image settings
	----------------------------------------------------------------------------- */
	private $photo_width = 156;
	private $photo_height = 1560;
	private $logo_width = 156;
	private $logo_height  = 1560;
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

	function Adminprogram() {
		parent::PSC_Admincontroller();
		parent::index();
	}
	
	function index($message = "") {	
		if ($message != '') {
			$data["message"] = $this->messages[$message];
		}

		// show program listing
		$data['userlevel'] = $this->userlevel;
		$data["userid"] = $this->userid;
		$data["userkerb"] = $this->userkerb;
		if ($this->userlevel != "0") {
			show_error("You do not have the permissions to view other user's programs.");
		}

		$this->load->model('program_model');
		$data["activeprograms"] = $this->program_model->getActivePrograms();
		$data["inactiveprograms"] = $this->program_model->getInactivePrograms();
		// load view with data
		$this->load->view('admin_program_listing_view', $data);
		
	}
	
	function edit($id = "", $mode = "add") {	
		// check to see if file over post_max_size has been submitted
		if (isset($_SERVER['CONTENT_LENGTH']) && $_SERVER['CONTENT_LENGTH'] > '2000000') {
			show_error("The uploaded file exceeds the maximum size allowed by the submission form.");
		}

		$this->load->model('program_model');

		if(isset($_POST["program_id"])) {
			// back-end data validation
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
			$config = array(
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
					 'field'   => 'description',
					 'label'   => '<strong>Description</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'description_short',
					 'label'   => '<strong>Description (short)</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'additional_info',
					 'label'   => '<strong>Additional Information</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'admin_contact1_name',
					 'label'   => '<strong>Primary Administrative Name</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'admin_contact1_dlc',
					 'label'   => '<strong>Primary Administrative Contact DLC/Title</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'admin_contact1_address',
					 'label'   => '<strong>Primary Administrative Contact Address</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'admin_contact1_email',
					 'label'   => '<strong>Primary Administrative Contact Email</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'admin_contact1_phone',
					 'label'   => '<strong>Primary Administrative Contact Phone</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'admin_contact2_name',
					 'label'   => '<strong>Secondary Administrative Name</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'admin_contact2_dlc',
					 'label'   => '<strong>Secondary Administrative Contact DLC/Title</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'admin_contact2_address',
					 'label'   => '<strong>Secondary Administrative Contact Address</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'admin_contact2_email',
					 'label'   => '<strong>Secondary Administrative Contact Email</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'admin_contact2_phone',
					 'label'   => '<strong>Secondry Administrative Contact Phone</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'public_contact1_name',
					 'label'   => '<strong>Primary Public Contact Name</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'public_contact1_address',
					 'label'   => '<strong>Primary Public Contact Address</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'public_contact1_phone',
					 'label'   => '<strong>Primary Public Contact Phone</strong>',
					 'rules'   => 'required'
				  ),
			   array(
					 'field'   => 'public_contact1_email',
					 'label'   => '<strong>Primary Public Contact Email</strong>',
					 'rules'   => 'required'
				  )
			);
			$this->form_validation->set_rules($config);
		}

		// if new program
		if (!is_numeric($id) || $mode == "add") {
			// if new program data has been submitted, save it
			if (isset($_POST["title"])) {
				if ($this->form_validation->run() == FALSE) {
					if (isset($_POST["mode"]) && $_POST["mode"] == "list") {
						$data["mode"] = "edit";
					}
					else if (isset($_POST["mode"])) {
						$data["mode"] = $_POST["mode"];
					}
					else if ($mode) {
						$data["mode"] = $mode;
					}
					$data['userlevel'] = $this->userlevel;
					$data["userid"] = $this->userid;
					$data["userkerb"] = $this->userkerb;
			
					// get program admins so psc admin can change program owner
					if ($this->userlevel == "0") {
						$this->load->model('user_model');
						$data["users"] = $this->user_model->getAll();
					}

					// load view with data
					$this->load->view('admin_program_view', $data);
				}
				else {
					// assemble data for saving
					$data = array();
					$moddates = array();
					list($data, $moddates) = $this->setNewValues($data, $moddates);
					
					array_push($moddates, "program_moddate");
		
					// if program has not been saved before, add and get new ID
					if (!is_numeric($id) && (isset($_POST["program_id"]) || $_POST["program_id"] == "")) {
						$data["program_id"] = $this->program_model->add_program($data, $moddates);
					}
					else {
						$data["program_id"] = $id;
						$this->program_model->update_program($data, $moddates);
					}
					
					// save the term data 
					$this->load->model('term_model');
					$this->term_model->update_program_terms($data["program_id"], $_POST["terms"]);

					if (isset($_POST["preview"])) {
						redirect("/adminprogram/preview/" . $data["program_id"] . "/add");
					}
					else {
						redirect("/admin/index/10");
					}
				}
			}
			// user has selected to re-edit new program
			else if (isset($_POST["edit"])) {				
				// bring up program data
				$data["program"] = $this->program_model->getEditedProgramData($id);
				$data["terms"] = $this->getProgramTerms($id);
				$data["term_ids"] = array();
				foreach ($data["terms"] as $category => $terms) {
					foreach ($terms as $term_id => $term_name) {
						array_push($data["term_ids"], $term_id);
					}
				}
				$data["checkboxes"] = $this->getNestedTermData();				
				$data['userlevel'] = $this->userlevel;
				$data["userid"] = $this->userid;
				$data["userkerb"] = $this->userkerb;
				$data["mode"] = $mode;
		
				// get program admins so psc admin can change program owner
				if ($this->userlevel == "0") {
					$this->load->model('user_model');
					$data["users"] = $this->user_model->getAll();
				}
	
				// load view with data
				$this->load->view('admin_program_view', $data);

			}
			// user has selected to saved added program for later
			else if (isset($_POST["save"])) {				
				redirect("/admin/index/10");
			}
			// user has selected to submit added program
			else if (isset($_POST["submit"])) {
				$data = array();
				$data["program_id"] = $id;
				$data["add_approval_flag"] = "1";
				$data["add_inprogress_flag"] = "0";
				$moddates = array("program_moddate");
				$this->program_model->update_program($data, $moddates);
				$data["title"] = $this->program_model->getProgramTitle($id);
				$recipient = $this->user_model->getUserData($this->program_model->getProgramAdmin($id));

				// send notification email
				$this->sendMessage("4", $recipient->email, "Received request for new outreach program for Outreach Database", $this->PSCemail);
				
				redirect("/admin/success/1");
			}
			// otherwise show form for entering new program
			else {
				// set error reporting so that undefined variables won't throw error
				error_reporting(E_ERROR | E_PARSE);
				
				// bring up Add Program form
				$data["checkboxes"] = $this->getNestedTermData();
				$data["mode"] = "add";
				$data['userlevel'] = $this->userlevel;
				$data["userid"] = $this->userid;
				$data["userkerb"] = $this->userkerb;
				
				// get program admins so psc admin can change program owner
				if ($this->userlevel == "0") {
					$this->load->model('user_model');
					$data["users"] = $this->user_model->getAll();
				}
				
				// load view with data
				$this->load->view('admin_program_view', $data);
			}

		}
		// end if new program
		
		// if addition/edits are being approved
		else if (isset($_POST["approve"])) {
			$this->load->model('user_model');

			// assemble data for saving
			$data = $this->getApprovedValues($id);
	
			// set flags and send off email
			$recipient = $this->user_model->getUserData($data["user_id"]);
			if ($data["add_approval_flag"] == "1") {
				$data["active_flag"] = "1";
				$data["add_approval_flag"] = "0";
				$this->sendMessage("5", $recipient->email, "You have a new Outreach Database program listing: " . $data["title"]);
			}
			else if ($data["edit_approval_flag"] == "1") {		
				$data["edit_approval_flag"] = "0";
				$this->sendMessage("8", $recipient->email, "Edits to your Outreach Database Program are now active");
			}

			$data["program_id"] = $id;

			$this->program_model->update_program($data, array());
			
			if (isset($_POST["terms"])) {
				// if term data has been submitted, save it 
				$this->load->model('term_model');
				$this->term_model->update_program_terms($data["program_id"], $_POST["terms"]);
			}
			redirect("/admin/index/3");
		}

		// if addition/edits are being denied
		else if (isset($_POST["deny"])) {

			// assemble data for saving
			$data = $this->getDeniedValues($id);
			
			// set flags and send off email
			$recipient = $this->user_model->getUserData($data["user_id"]);
			if ($data["add_approval_flag"] == "1") {
				$data["active_flag"] = "0";
				$data["add_approval_flag"] = "0";
				$this->sendMessage("6", $recipient->email, "Problem with your Outreach Database program submission");
			}
			else if ($data["edit_approval_flag"] == "1") {		
				$data["edit_approval_flag"] = "0";
				$this->sendMessage("9", $recipient->email, "Problem with your Outreach Database program edits");
			}

			$data["program_id"] = $id;
	
			$this->program_model->update_program($data, array());
			redirect("/admin/index/4");
		}
	
		// if edited data has been submitted and should be saved
		else if (isset($_POST["title"])) {
			if ($this->form_validation->run() == FALSE) {
				$data = array();
				if (isset($_POST["mode"]) && $_POST["mode"] == "list") {
					$data["mode"] = "edit";
				}
				else if (isset($_POST["mode"])) {
					$data["mode"] = $_POST["mode"];
				}
				else if ($mode) {
					$data["mode"] = $mode;
				}
				
				// bring up program data
				$data["program"] = $this->program_model->getEditedProgramData($id);
				$data["terms"] = $this->getProgramTerms($id);
				$data["term_ids"] = array();
				foreach ($data["terms"] as $category => $terms) {
					foreach ($terms as $term_id => $term_name) {
						array_push($data["term_ids"], $term_id);
					}
				}
				$data["checkboxes"] = $this->getNestedTermData();
				
				$data['userlevel'] = $this->userlevel;
				$data["userid"] = $this->userid;
				$data["userkerb"] = $this->userkerb;
		
				// get program admins so psc admin can change program owner
				if ($this->userlevel == "0") {
					$this->load->model('user_model');
					$data["users"] = $this->user_model->getAll();
				}
	
				// load view with data
				$this->load->view('admin_program_view', $data);
			}
			else {
				// check to see if user has the right to edit this program
				$this->checkPermissionToEdit($id, $this->userid, $this->userlevel);
	
				$programdata["program"] = $this->program_model->getProgramData($id);
		
				// assemble data for saving
				$moddates = array();
				$data = array();
				list ($data, $moddates) = $this->setEditedValues($data, $moddates, $programdata);
				$data["program_id"] = $id;

				// if program should be submitted for approval, set flag and send off email
				if (isset($_POST["submit"])) {
					$data["edit_approval_flag"] = "1";
					// send notification email
					$recipient = $this->user_model->getUserData($this->program_model->getProgramAdmin($id));
					$this->sendMessage("7", $recipient->email, "Received request for edits to " . $programdata["program"]->title, $this->PSCemail);
				}
				
				array_push($moddates, "program_moddate");	
				$this->program_model->update_program($data, $moddates);
				
				// save the term data 
				$this->load->model('term_model');
				$this->term_model->update_program_terms($data["program_id"], $_POST["terms"]);		

/*						
				// if user has selected "other" under search criteria, send email to PSC admins
				if (isset($_POST["other_term"]) && $_POST["other_term"] == "1") {
					$this->sendMessage("13", $this->PSCemail, $programdata["program"]->title);
				}
*/	
				if ($mode == "list") {
					$mode = "edit";
				}
	
				if (isset($_POST["preview"])) {
					redirect("/adminprogram/preview/" . $data["program_id"] . "/$mode");
				}
				else {
					redirect("/admin/index/10");
				}
			}
		}
		// no data has been submitted
		else {
			// check to see if user has the right to edit this program
			$this->checkPermissionToEdit($id, $this->userid, $this->userlevel);

			if (isset($_POST["submit"]) && $_POST["submit"] != "") {
				$data["program_id"] = $id;
				$data["edit_approval_flag"] = "1";
				$data["title"] = $this->program_model->getProgramTitle($id);

				$moddates = array();
				$this->program_model->update_program($data, $moddates);

				// send notification email
				$recipient = $this->user_model->getUserData($this->program_model->getProgramAdmin($id));
				$this->sendMessage("7", $recipient->email, "Received request for edits to " . $data["title"], $this->PSCemail);

				redirect("/admin/success/1");
			}
			else if (isset($_POST["save"]) && $_POST["save"] != "") {
				redirect("/admin/index/10");
			}
			else {
				$data = array();
				if (isset($_POST["mode"]) && $_POST["mode"] == "list") {
					$data["mode"] = "edit";
				}
				else if (isset($_POST["mode"])) {
					$data["mode"] = $_POST["mode"];
				}
				else if ($mode) {
					$data["mode"] = $mode;
				}
				else {
					$data["mode"] = "edit";
				}

				// bring up program data
				$data["program"] = $this->program_model->getEditedProgramData($id);
				$data["terms"] = $this->getProgramTerms($id);
				$data["term_ids"] = array();
				foreach ($data["terms"] as $category => $terms) {
					foreach ($terms as $term_id => $term_name) {
						array_push($data["term_ids"], $term_id);
					}
				}
				$data["checkboxes"] = $this->getNestedTermData();				
				$data['userlevel'] = $this->userlevel;
				$data["userid"] = $this->userid;
				$data["userkerb"] = $this->userkerb;
		
				// get program admins so psc admin can change program owner
				if ($this->userlevel == "0") {
					$this->load->model('user_model');
					$data["users"] = $this->user_model->getAll();
				}

				// load view with data
				$this->load->view('admin_program_view', $data);
			}
		}
	}
	
	function preview($id, $mode) {
		$this->load->model('program_model');
		$data["program"] = $this->program_model->getEditedProgramData($id);

		$data["terms"] = $this->getProgramTerms($id);
		
		$data['userlevel'] = $this->userlevel;
		$data["userid"] = $this->userid;
		$data["userkerb"] = $this->userkerb;
		if (isset($data["program"]->add_inprogress_flag) && $data["program"]->add_inprogress_flag == "1") {
			$data["mode"] = "add";
		}
		else {
			$data["mode"] = $mode;
		}

		// load view with data
		$this->load->view('admin_program_preview_view', $data);
		
	}
	
	function activate($id) {
		if ($this->userlevel != "0") {
			show_error("You do not have the permissions to activate this program.");
		}
		$this->load->model('program_model');
		$this->program_model->activateProgram($id);
		redirect("/adminprogram/index/7");
	}
	
	function inactivate($id) {
		if ($this->userlevel != "0") {
			show_error("You do not have the permissions to inactivate this program.");
		}
		$this->load->model('program_model');
		$this->program_model->inactivateProgram($id);

		// send notification email
		$recipient = $this->user_model->getUserData($this->program_model->getProgramAdmin($id));
		$admins = $this->program_model->getAdminContactEmails($id);

		$this->sendMessage("15", $recipient->email, "Notice of inactive Outreach Database program listing: " . $this->program_model->getProgramTitle($id), $admins->admin_contact1_email . ", " . $admins->admin_contact2_email);
		redirect("/adminprogram/index/8");
	}
	
	private function setNewValue($index, $data, $moddates) {
		if (isset($_POST[$index])) {
			$data[$index] = $_POST[$index];
			array_push($moddates, $index . "_moddate");
		}
		return array ($data, $moddates);
	}
	
	private function setEditValue($index, $data, $moddates, $oldvalue) {
		// if data isn't different from that in the DB, just return the same arrays
		if ($_POST[$index] != $oldvalue) {
			if (isset($_POST[$index])) {
				$data[$index . "_edit"] = $_POST[$index];
				array_push($moddates, $index . "_moddate");
			}
		}
		return array ($data, $moddates);
	}
	
	private function checkPermissionToEdit($program_id, $userid, $userlevel) {
		if ($program_id) {
			$reason = "";
			$this->load->model('program_model');
			$data["program"] = $this->program_model->getProgramData($program_id);
	
			// user is not an admin and they are not the program admin for this program
			if ($userlevel != "0" && $data["program"]->user_id != $userid) {
				$reason = "you are not the program administrator for " . $data["program"]->title;
			}
			// user is not an admin and there is a pending approval
			else if ($userlevel != "0" && ($data["program"]->add_approval_flag == "1" || $data["program"]->edit_approval_flag == "1")) {
				$reason = "program is still awaiting approval";
			}
			// user is not an admin and the program is inactive
			else if ($userlevel != "0" && $data["program"]->active_flag == "0") {
				$reason = "program is inactive";
			}
			// everthing is fine, return before error message is assembled
			else {
				return TRUE;
			}
			$mesg = "You are not able to edit this program: " . $reason . ".";
			show_error($mesg);
		}
	}
	
	private function setNewValues($data, $moddates) {
		// assemble simple data for saving
		$data["user_id"] = $_POST["user_id"];

		list ($data, $moddates) = $this->setNewValue("title", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("dlc", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("description", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("description_short", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("additional_info", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("admin_contact1_name", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("admin_contact1_dlc", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("admin_contact1_address", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("admin_contact1_phone", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("admin_contact1_email", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("admin_contact2_name", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("admin_contact2_dlc", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("admin_contact2_address", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("admin_contact2_phone", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("admin_contact2_email", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("public_contact1_name", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("public_contact1_org", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("public_contact1_address", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("public_contact1_phone", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("public_contact1_email", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("public_contact2_name", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("public_contact2_org", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("public_contact2_address", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("public_contact2_phone", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("public_contact2_email", $data, $moddates);
		list ($data, $moddates) = $this->setNewValue("url", $data, $moddates);

		// assemble image data for saving
		$uploadconfig['upload_path'] = './images/programs/';
		$uploadconfig['allowed_types'] = 'gif|jpg|png';
		$uploadconfig['max_size']	= '1000';
		$uploadconfig['max_width']  = '0';
		$uploadconfig['max_height']  = '0';
		
		$this->load->library('upload', $uploadconfig);

		// photo image
		if ($_FILES["photo"]["name"] != "") {
			$this->upload->do_upload("photo");
			if ($this->upload->display_errors()) {
				show_error($this->upload->display_errors());
			}
			else {
				$imagedata = $this->upload->data();				
				if (($imagedata["image_width"] > $this->photo_width) || ($imagedata["image_height"] > $this->photo_height)) {
					//$imageconfig['image_library'] = 'gd2';
					$imageconfig['image_library'] = 'imagemagick';
					$imageconfig['library_path'] = '/usr/bin/';
					$imageconfig['source_image'] = $imagedata['full_path'];
					$imageconfig['create_thumb'] = FALSE;
					$imageconfig['maintain_ratio'] = TRUE;
					$imageconfig['width'] = $this->photo_width;
					$imageconfig['height'] = $this->photo_height;
					$this->load->library('image_lib', $imageconfig);				
					if (!$this->image_lib->resize()) {
						show_error($this->image_lib->display_errors() . " [photo]");
					}
				}
				$data["photo_path"] = $imagedata["file_name"];
				array_push($moddates, "photo_path_moddate");
			}
		}
		else if ($_POST["empty_photo"] == "1") {
			$data["photo_path"] = "";
			array_push($moddates, "photo_path_moddate");
		}

		$uploadconfig['upload_path'] = './images/programs/';
		$uploadconfig['allowed_types'] = 'gif|jpg|png';
		$uploadconfig['max_size']	= '1000';
		$uploadconfig['max_width']  = '0';
		$uploadconfig['max_height']  = '0';

		// logo image
		if ($_FILES["logo"]["name"] != "") {
			$this->upload->do_upload("logo");
			if ($this->upload->display_errors()) {
				show_error($this->upload->display_errors());
			}
			else {
				$imagedata = $this->upload->data();				
				if (($imagedata["image_width"] > $this->logo_width) || ($imagedata["image_height"] > $this->logo_height)) {
					//$imageconfig['image_library'] = 'gd2';
					$imageconfig['image_library'] = 'imagemagick';
					$imageconfig['library_path'] = '/usr/bin/';
					$imageconfig['source_image'] = $imagedata['full_path'];
					$imageconfig['create_thumb'] = FALSE;
					$imageconfig['maintain_ratio'] = TRUE;
					$imageconfig['width'] = $this->logo_width;
					$imageconfig['height'] = $this->logo_height;
					$this->load->library('image_lib', $imageconfig);				
					$this->image_lib->clear();
					$this->image_lib->initialize($imageconfig);
					if (!$this->image_lib->resize()) {
						show_error($this->image_lib->display_errors() . " [logo]");
					}
				}
				$data["logo_path"] = $imagedata["file_name"];
				array_push($moddates, "logo_path_moddate");
			}
		}
		else if ($_POST["empty_logo"] == "1") {
			$data["logo_path"] = "";
			array_push($moddates, "logo_path_moddate");
		}
		
		return array($data, $moddates);
	}

	private function setEditedValues($data, $moddates, $programdata) {
		$data["user_id"] = $_POST["user_id"];
		list ($data, $moddates) = $this->setEditValue("title", $data, $moddates, $programdata["program"]->title);
		list ($data, $moddates) = $this->setEditValue("dlc", $data, $moddates, $programdata["program"]->dlc);
		list ($data, $moddates) = $this->setEditValue("description", $data, $moddates, $programdata["program"]->description);
		list ($data, $moddates) = $this->setEditValue("description_short", $data, $moddates, $programdata["program"]->description_short);
		list ($data, $moddates) = $this->setEditValue("additional_info", $data, $moddates, $programdata["program"]->additional_info);
		list ($data, $moddates) = $this->setEditValue("admin_contact1_name", $data, $moddates, $programdata["program"]->admin_contact1_name);
		list ($data, $moddates) = $this->setEditValue("admin_contact1_dlc", $data, $moddates, $programdata["program"]->admin_contact1_dlc);
		list ($data, $moddates) = $this->setEditValue("admin_contact1_address", $data, $moddates, $programdata["program"]->admin_contact1_address);
		list ($data, $moddates) = $this->setEditValue("admin_contact1_phone", $data, $moddates, $programdata["program"]->admin_contact1_phone);
		list ($data, $moddates) = $this->setEditValue("admin_contact1_email", $data, $moddates, $programdata["program"]->admin_contact1_email);
		list ($data, $moddates) = $this->setEditValue("admin_contact2_name", $data, $moddates, $programdata["program"]->admin_contact2_name);
		list ($data, $moddates) = $this->setEditValue("admin_contact2_dlc", $data, $moddates, $programdata["program"]->admin_contact2_dlc);
		list ($data, $moddates) = $this->setEditValue("admin_contact2_address", $data, $moddates, $programdata["program"]->admin_contact2_address);
		list ($data, $moddates) = $this->setEditValue("admin_contact2_phone", $data, $moddates, $programdata["program"]->admin_contact2_phone);
		list ($data, $moddates) = $this->setEditValue("admin_contact2_email", $data, $moddates, $programdata["program"]->admin_contact2_email);
		list ($data, $moddates) = $this->setEditValue("public_contact1_name", $data, $moddates, $programdata["program"]->public_contact1_name);
		list ($data, $moddates) = $this->setEditValue("public_contact1_org", $data, $moddates, $programdata["program"]->public_contact1_org);
		list ($data, $moddates) = $this->setEditValue("public_contact1_address", $data, $moddates, $programdata["program"]->public_contact1_address);
		list ($data, $moddates) = $this->setEditValue("public_contact1_phone", $data, $moddates, $programdata["program"]->public_contact1_phone);
		list ($data, $moddates) = $this->setEditValue("public_contact1_email", $data, $moddates, $programdata["program"]->public_contact1_email);
		list ($data, $moddates) = $this->setEditValue("public_contact2_name", $data, $moddates, $programdata["program"]->public_contact2_name);
		list ($data, $moddates) = $this->setEditValue("public_contact2_org", $data, $moddates, $programdata["program"]->public_contact2_org);
		list ($data, $moddates) = $this->setEditValue("public_contact2_address", $data, $moddates, $programdata["program"]->public_contact2_address);
		list ($data, $moddates) = $this->setEditValue("public_contact2_phone", $data, $moddates, $programdata["program"]->public_contact2_phone);
		list ($data, $moddates) = $this->setEditValue("public_contact2_email", $data, $moddates, $programdata["program"]->public_contact2_email);
		list ($data, $moddates) = $this->setEditValue("url", $data, $moddates, $programdata["program"]->url);

		// assemble image data for saving
		$uploadconfig['upload_path'] = './images/programs/';
		$uploadconfig['allowed_types'] = 'gif|jpg|png';
		$uploadconfig['max_size']	= '1000';
		$uploadconfig['max_width']  = '0';
		$uploadconfig['max_height']  = '0';
		
		$this->load->library('upload', $uploadconfig);

		// photo image
		if ($_FILES["photo"]["name"] != "") {
			$this->upload->do_upload("photo");
			
			if ($this->upload->display_errors()) {
				show_error($this->upload->display_errors());
			}
			else {
				$imagedata = $this->upload->data();				
				if (($imagedata["image_width"] > $this->photo_width) || ($imagedata["image_height"] > $this->photo_height)) {
					//$imageconfig['image_library'] = 'gd2';
					$imageconfig['image_library'] = 'imagemagick';
					$imageconfig['library_path'] = '/usr/bin/';
					$imageconfig['source_image'] = $imagedata['full_path'];
					$imageconfig['create_thumb'] = FALSE;
					$imageconfig['maintain_ratio'] = TRUE;
					$imageconfig['width'] = $this->photo_width;
					$imageconfig['height'] = $this->photo_height;
					$this->load->library('image_lib');				
					$this->image_lib->initialize($imageconfig);
					if (!$this->image_lib->resize()) {
						show_error($this->image_lib->display_errors() . " [photo]");
					}
					$this->image_lib->clear();
					unset($imageconfig);
				}
				$data["photo_path_edit"] = $imagedata["file_name"];
				array_push($moddates, "photo_path_moddate");
			}
		}
		else if ($_POST["empty_photo"] == "1") {
			$data["photo_path_edit"] = "";
			array_push($moddates, "photo_path_moddate");
		}

		// logo image
		if ($_FILES["logo"]["name"] != "") {
			$this->upload->do_upload("logo");
			if ($this->upload->display_errors()) {
				show_error($this->upload->display_errors());
			}
			else {
				$imagedata = $this->upload->data();				
				if (($imagedata["image_width"] > $this->logo_width) || ($imagedata["image_height"] > $this->logo_height)) {
					//$imageconfig['image_library'] = 'gd2';
					$imageconfig['image_library'] = 'imagemagick';
					$imageconfig['library_path'] = '/usr/bin/';
					$imageconfig['source_image'] = $imagedata['full_path'];
					$imageconfig['create_thumb'] = FALSE;
					$imageconfig['maintain_ratio'] = TRUE;
					$imageconfig['width'] = $this->logo_width;
					$imageconfig['height'] = $this->logo_height;
					$this->load->library('image_lib');				
					$this->image_lib->initialize($imageconfig);
					if (!$this->image_lib->resize()) {
						show_error($this->image_lib->display_errors() . " [logo]");
					}
				}
				$data["logo_path_edit"] = $imagedata["file_name"];
				array_push($moddates, "logo_path_moddate");
			}
		}
		else if ($_POST["empty_logo"] == "1") {
			$data["logo_path_edit"] = "";
			array_push($moddates, "logo_path_moddate");
		}
		
		return array($data, $moddates);
	}
	
	private function getApprovedValues($id) {		
		$returndata = array();
		$currentdata = $this->program_model->getProgramData($id);
		foreach ($currentdata as $key => $value) {
			$pos = strpos($key, "_edit");
			if ($pos && !is_null($value)) {
				$returndata[substr($key,0,$pos)] = $value;
				$returndata[$key] = NULL;
			}
			else {
				$returndata[$key] = $value;
			}
		}

		return $returndata;
	}
	
	private function getDeniedValues($id) {		
		$returndata = array();
		$currentdata = $this->program_model->getProgramData($id);
		foreach ($currentdata as $key => $value) {
			$pos = strpos($key, "_edit");
			if ($pos && !is_null($value)) {
				$returndata[$key] = NULL;
			}
			else {
				$returndata[$key] = $value;
			}
		}

		return $returndata;
	}

}

/* End of file adminprogram.php */
/* Location: ./system/application/controllers/adminprogram.php */