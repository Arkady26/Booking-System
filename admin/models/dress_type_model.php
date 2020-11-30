<?php

class dress_type_model extends CI_Model {
	
	function search($limit, $offset, $sort_by, $sort_order,$search) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('type');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'type';
		
		// results query
		$q = $this->db->select('*')
			->from('dress_type')			
			->like('type',$search)
			->limit($limit, $offset)
			->order_by($sort_by, $sort_order);
		
		$ret['rows'] = $q->get()->result();
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
			->from('dress_type')		
			->like('type',$search);
					
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	
}