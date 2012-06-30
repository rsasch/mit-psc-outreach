<?php
class Category_model extends Model {

	function Category_model() {
		parent::Model();
	}
	
	// return all categories
	function getAll () {
		$query = $this->db->get('category');
		if ($query->num_rows() > 0) {
			 return $query->result();
		}
	}
	
}
