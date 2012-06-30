<?php
class Program_model extends Model {

	function Program_model() {
		parent::Model();
	}
	
	function add_program($data, $moddates) {
		$this->db->insert("program", $data);
		$newID = $this->db->insert_id();
		foreach ($moddates as $field) {
			$this->db->set($field, 'CURDATE()', FALSE);
			$this->db->where('program_id', $newID);
			$this->db->update('program');
		}
		return $newID;
	}
	
	function update_program($data, $moddates) {
		$this->db->where("program_id", $data["program_id"]);
		$this->db->update("program", $data);
		foreach ($moddates as $field) {
			$this->db->set($field, 'CURDATE()', FALSE);
			$this->db->where('program_id', $data["program_id"]);
			$this->db->update('program');
		}
	}
	
	function delete_program($id) {
		$this->db->where("program_id", $id);
		$this->db->delete("program");
	}
	
	function getProgramData($id) {
		$this->db->where("program_id", $id);
		$query = $this->db->get("program");
		$results = $query->result();
		if (sizeof($results) > 0) {
			return $results[0];
		}
		else {
			return FALSE;
		}
	}
	
	function getProgramSpotlightData($id) {
		$this->db->select("program_id, photo_path, active_flag, title");
		$this->db->where("program_id", $id);
		$query = $this->db->get("program");
		$results = $query->result();
		if (sizeof($results) > 0) {
			return $results[0];
		}
		else {
			return FALSE;
		}
	}
	
	function getProgramTitle($id) {
		$this->db->select("title");
		$this->db->where("program_id", $id);
		$query = $this->db->get("program");
		$results = $query->result();
		return $results[0]->title;
	}
	
	function getProgramAdmin($id) {
		$this->db->select("user_id");
		$this->db->where("program_id", $id);
		$query = $this->db->get("program");
		$results = $query->result();
		return $results[0]->user_id;
	}
	
	function getAdminContactEmails($id) {
		$this->db->select("admin_contact1_email, admin_contact2_email");
		$this->db->where("program_id", $id);
		$query = $this->db->get("program");
		$results = $query->result();
		return $results[0];
	}
	
	function getEditableProgramData($id) {
		$this->db->select("program_id, user_id, active_flag, add_approval_flag, add_inprogress_flag, title, dlc, description, description_short, additional_info, admin_contact1_name, admin_contact1_dlc, admin_contact1_address, admin_contact1_phone, admin_contact1_email, admin_contact2_name, admin_contact2_dlc, admin_contact2_address, admin_contact2_phone, admin_contact2_email, public_contact1_name, public_contact1_org, public_contact1_address, public_contact1_phone, public_contact1_email, public_contact2_name, public_contact2_org, public_contact2_address, public_contact2_phone, public_contact2_email, url, photo_path, logo_path, title_moddate, dlc_moddate, description_moddate, description_short_moddate, additional_info_moddate, admin_contact1_name_moddate, admin_contact1_dlc_moddate, admin_contact1_address_moddate, admin_contact1_phone_moddate, admin_contact1_email_moddate, admin_contact2_name_moddate, admin_contact2_dlc_moddate, admin_contact2_address_moddate, admin_contact2_phone_moddate, admin_contact2_email_moddate, public_contact1_name_moddate, public_contact1_org_moddate, public_contact1_address_moddate, public_contact1_phone_moddate, public_contact1_email_moddate, public_contact2_name_moddate, public_contact2_org_moddate, public_contact2_address_moddate, public_contact2_phone_moddate, public_contact2_email_moddate, url_moddate, photo_path_moddate, logo_path_moddate");
		$this->db->where("program_id", $id);
		$query = $this->db->get("program");
		$results = $query->result();
		return $results[0];
	}

	function getEditedProgramData($id) {
		$data = $this->getEditableProgramData($id);

		foreach ($data as $field => $value) {
			if (strpos($field, "_moddate") === FALSE && strpos($field, "_flag") === FALSE && strpos($field, "_id") === FALSE) {
				$this->db->where("program_id", $id);
				$this->db->select($field . "_edit", $field . "_moddate");
				$query = $this->db->get("program");
				$results = $query->result();
				if (!is_null($results[0]->{$field . "_edit"})) {
					$data->$field = $results[0]->{$field . "_edit"};
				}
			}
		}	
		return $data;
	}

	function getActivePrograms() {
		$query = $this->db->query("SELECT first_name, last_name, program_id, program.title, program_moddate FROM user, program WHERE user.user_id = program.user_id && program.active_flag = '1' ORDER BY last_name");
		return $query->result();
	}

	function getInactivePrograms() {
		$query = $this->db->query("SELECT first_name, last_name, program_id, program.title, program_moddate FROM user, program WHERE user.user_id = program.user_id && program.active_flag = '0' && add_inprogress_flag = '0' ORDER BY last_name");
		return $query->result();
	}
	
	function getNewPrograms() {
		$query = $this->db->query("SELECT program_id, program.title, first_name, last_name, program_moddate from user, program WHERE program.user_id = user.user_id AND program.add_approval_flag = '1' ORDER BY last_name");
		$results = $query->result();
		if (sizeof($results) > 0) {
			return $results;
		}
		else {
			return FALSE;
		}
	}
	
	function getEditedPrograms() {
		$query = $this->db->query("SELECT program_id, program.title, first_name, last_name, program_moddate from user, program WHERE program.user_id = user.user_id AND program.edit_approval_flag = '1' ORDER BY last_name");
		$results = $query->result();
		if (sizeof($results) > 0) {
			return $results;
		}
		else {
			return FALSE;
		}
	}

	function getProgramsModifiedBeforeDate($date) {
		$query = $this->db->query("SELECT program_id, first_name, last_name, program.title, program_moddate FROM user, program WHERE program.user_id = user.user_id && program.active_flag = '1' && program_moddate BETWEEN '0000-00-00' AND ? ORDER BY program_moddate", array($date));		
		$results = $query->result();
		return $results;
	}

	function getMyPrograms($id) {
		$this->db->select("program_id, title, program_moddate");
		$this->db->where("user_id", $id);
		$this->db->where("add_approval_flag", "0");
		$this->db->where("edit_approval_flag", "0");
		$this->db->where("active_flag", "1");
		$this->db->order_by("title");
		$query = $this->db->get("program");
		$results = $query->result();
		return $results;
	}

	function getMyNewPrograms($id) {
		$this->db->select("program_id, title, program_moddate");
		$this->db->where("user_id", $id);
		$this->db->where("add_approval_flag", "1");
		$this->db->where("active_flag", "0");
		$this->db->order_by("title");
		$query = $this->db->get("program");
		$results = $query->result();
		return $results;
	}
	
	function getMyUnsubmittedPrograms($id) {
		$this->db->select("program_id, title, program_moddate");
		$this->db->where("user_id", $id);
		$this->db->where("add_inprogress_flag", "1");
		$this->db->order_by("title");
		$query = $this->db->get("program");
		$results = $query->result();
		return $results;
	}

	function getMyEditedPrograms($id) {
		$this->db->select("program_id, title, program_moddate");
		$this->db->where("user_id", $id);
		$this->db->where("edit_approval_flag", "1");
		$this->db->where("active_flag", "1");
		$this->db->order_by("title");
		$query = $this->db->get("program");
		$results = $query->result();
		return $results;
	}

	function getMyInactivePrograms($id) {
		$this->db->select("program_id, title, program_moddate");
		$this->db->where("user_id", $id);
		$this->db->where("active_flag", "0");
		$this->db->where("add_approval_flag", "0");
		$this->db->where("add_inprogress_flag", "0");
		$this->db->order_by("title");
		$query = $this->db->get("program");
		$results = $query->result();
		return $results;
	}
	
	function activateProgram($id) {
		$this->db->set('11month_flag', '0');
		$this->db->set('12month_flag', '0');
		$this->db->set('active_flag', '1');
		$this->db->set('program_moddate', 'CURDATE()', FALSE);
		$this->db->where('program_id', $id);
		$this->db->update('program');
	}
	
	function inactivateProgram($id) {
		$this->db->set('active_flag', '0');
		$this->db->where('program_id', $id);
		$this->db->update('program');
	}
	
	function getHighestID() {
		$query = $this->db->query("SELECT MAX(program_id) as program_id FROM program");
		$results = $query->result();
		return $results[0]->program_id;
	}

}
