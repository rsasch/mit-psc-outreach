<?php
class Message_model extends Model {

	function Message_model() {
		parent::Model();
	}
	
	// return all messages
	function getAll() {
		$this->db->order_by("message_order");		
		$query = $this->db->get('message');
		if ($query->num_rows() > 0) {
			 return $query->result();
		}
	}

	function getMessage($id) {
		$this->db->where("message_id", $id);
		$query = $this->db->get("message");
		if ($query->num_rows() == 1) {
			$results = $query->result();
			return $results[0]->message_text;
		}
	}
	
	function updateMessage($id, $data) {
		$this->db->where("message_id", $id);
		$this->db->update("message", $data);
	}
	
}
