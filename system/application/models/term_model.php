<?php
class Term_model extends Model {

	function Term_model() {
		parent::Model();
	}

	// return all term name and IDs for a certain category
	function getTermsByCategory ($categoryID) {
		$this->db->select("term_id, term_name");
		$this->db->where("category_id", $categoryID);
		$query = $this->db->get("term");
		if ($query->num_rows() > 0) {
			 return $query->result();
		}
	}

	// return all term names for a certain program ID and category
	function getTermsByIDandCategory ($programID, $categoryID) {
		$query = $this->db->query("SELECT term.term_id, term_name FROM term, program_term WHERE category_id = ? AND program_id = ? AND term.term_id = program_term.term_id", array($categoryID, $programID));
		if ($query->num_rows() > 0) {
			 return $query->result();
		}
	}

	function add_term($data) {
		$this->db->insert("term", $data);
	}
	
	function update_program_terms ($programID, $terms) {
		$this->db->query("DELETE FROM program_term WHERE program_id = ?", array($programID));
		foreach ($terms as $termID) {
			$this->db->query("INSERT INTO program_term (program_id, term_id) VALUES (?, ?)", array($programID, $termID));
		}
	}

}
?>