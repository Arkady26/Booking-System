<?php

class dress_style_model extends CI_Model {
	
	function search($limit, $offset, $sort_by, $sort_order,$search) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('styleno','type','description');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'styleno';
		
		// results query
		$q = $this->db->select('dress_style.did,styleno,description,dress_style.type')
			->from('dress_style')
			->join('dress_type','dress_type.did = dress_style.type', 'left')
			->where('(dress_type.type LIKE \'%'.$search.'%\' OR dress_style.styleno LIKE \'%'.$search.'%\' )', NULL)			
			->limit($limit, $offset)
			->order_by($sort_by, $sort_order);
		
		$ret['rows'] = $q->get()->result();
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
			->from('dress_style')	
			->join('dress_type','dress_type.did = dress_style.type', 'left')
			->where('(dress_type.type LIKE \'%'.$search.'%\' OR dress_style.styleno LIKE \'%'.$search.'%\' )', NULL)		
			->like('styleno',$search);
					
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	
}