<?php
class User_model extends Model {

	function User_model() {
		parent::Model();
	}
	
	// return all users
	function getAll() {
		$this->db->order_by("last_name");
		$query = $this->db->get('user');
		if ($query->num_rows() > 0) {
			 return $query->result();
		}
	}

	// return user data for a certain user
	function getUserData ($userID) {
		$query = $this->db->query("SELECT user_id, first_name, last_name, kerb, dlc, title, address, email, phone, role_name, add_approval_flag FROM user, role WHERE user.role_id = role.role_id && user_id = ?", array($userID));
		$results = $query->result();
		return $results[0];
	}
	
	// return user role id, return FALSE if not in the system or inactive
	function getUserRole($kerb) {
		$this->db->select('role_id');
		$this->db->where("kerb", $kerb);
		$query = $this->db->get("user");
		if ($query->num_rows() > 0) {
			$data = $query->result();
			return $data[0]->role_id;
		}
		else {
			return FALSE;
		}
	}
	
	function getUserName($userID) {
		$this->db->select('first_name, last_name');
		$this->db->where("user_ID", $userID);
		$query = $this->db->get("user");
		if ($query->num_rows() > 0) {
			$data = $query->result();
			return $data[0]->first_name . " " . $data[0]->last_name;
		}
		else {
			return FALSE;
		}
	}
	
	function isUserActive($userID) {
		$this->db->select('active_flag');
		$this->db->where("user_id", $userID);
		$query = $this->db->get("user");
		$data = $query->result();

		if ($data[0]->active_flag == "1") {
			return TRUE;
		}
		else {
			return FALSE;
		}
	}
	
	function getUserID($kerb) {
		$this->db->select('user_id');
		$this->db->where("kerb", $kerb);
		$query = $this->db->get("user");
		if ($query->num_rows() > 0) {
			$data = $query->result();
			return $data[0]->user_id;
		}
		else {
			return FALSE;
		}
	}
	
	function getActiveUsersByRole($role_id) {
		$this->db->where("role_id", $role_id);
		$this->db->where("active_flag", "1");
		$query = $this->db->get("user");
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function getInactiveUsers() {
		$this->db->where("active_flag", "0");
		$query = $this->db->query("SELECT user_id, first_name, last_name, dlc, kerb, role_name FROM user, role WHERE user.role_id = role.role_id && active_flag = '0'");
		if ($query->num_rows() > 0) {
			return $query->result();
		}
		else {
			return FALSE;
		}
	}

	function updateUserData($data) {
		$this->db->where("user_id", $data["user_id"]);
		$this->db->update("user", $data);
	}
	
	function addUser($data) {
		$this->db->insert('user', $data);
	}
	
	function removeUser($id) {
		$this->db->delete('user', array('user_id' => $id));
	}
	
	function getNewUsers() {
		$this->db->select("user_id, first_name, last_name, kerb, title, email, dlc");
		$this->db->where("add_approval_flag", "1");
		$query = $this->db->get("user");
		$results = $query->result();
		if (sizeof($results) > 0) {
			return $results;
		}
		else {
			return FALSE;
		}
	}

}
