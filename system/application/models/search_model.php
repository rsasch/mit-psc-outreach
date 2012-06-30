<?php
class Search_model extends Model {

	function User_model() {
		parent::Model();
	}
	
	function getAll($start = '0', $limit = null) {
		$this->db->select("program_id, title, description_short");
		$this->db->order_by("title");
		$this->db->where("active_flag", "1");
		if ($limit) {
			$query = $this->db->get('program', $limit, $start);
		}
		else {
			$query = $this->db->get('program');
		}
		if ($query->num_rows() > 0) {
			 return $query->result();
		}
	}
	
	function search($data, $start = null, $limit = null) {
		$results = array();
		$sql = "";
		$bindings = array();
		
		// search keywords
		if ($data["keywords"] != "") {
			// process keywords for boolean fulltext search
			$keywordlist = "+" . preg_replace('/ /', ' +', $data["keywords"]);
			$sql = "SELECT DISTINCT program.program_id, title, description_short FROM program, term, program_term WHERE MATCH (title, description, description_short, additional_info, term_name) AGAINST (? IN BOOLEAN MODE) && program.active_flag = '1' && program.program_id = program_term.program_id && term.term_id = program_term.term_id";
			array_push($bindings, $keywordlist);


/*
			// ...and search checkbox text
			$sql .= " UNION SELECT program.program_id, title, description_short  FROM program_term, program WHERE term_id IN (SELECT term_id FROM term WHERE MATCH(term_name) AGAINST (? IN BOOLEAN MODE)) && program.program_id = program_term.program_id && program.active_flag = '1'";

			$wordArray = explode(" ", $data["keywords"]);

			array_push($bindings, $keywordlist);
*/
		}
	
		// search checked boxes
		if (count($data["term_ids"])) {
			if ($sql != "") {
				$sql .= " && program.program_id IN (SELECT program_term.program_id FROM program_term WHERE term_id in (" . implode(",", $data["term_ids"]) . ") GROUP BY program_term.program_id HAVING COUNT(*) = " . count($data["term_ids"]) . ")";
			}
			else {
				$sql = "SELECT program.program_id, title, description_short FROM program_term, program WHERE program.program_id = program_term.program_id && program.active_flag = '1' && term_id IN (" . implode(",", $data["term_ids"]) . ") GROUP BY program_id HAVING COUNT(*) = " . count($data["term_ids"]);
			}
		}

		if ($sql != "") {
			$sql .= " ORDER BY title";
		}
		else {
			return $this->getAll($start, $limit);
		}
	
		if ($limit) {
			$sql .= " LIMIT " . $start . "," . $limit;
/*
			print "--$sql--<br />\n";
			print_r($bindings);
*/
		}

		$query = $this->db->query($sql, $bindings);
		return $query->result();
	}

}
