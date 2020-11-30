<?php

class user_model extends CI_Model {
	
	function search($limit, $offset, $sort_by, $sort_order,$search) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('username','security_level');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'name';
		
		// results query
		$q = $this->db->select('*')
			->from('signup')	
			->where('(username LIKE \'%'.$search.'%\' OR  email LIKE \'%'.$search.'%\' OR  fname LIKE \'%'.$search.'%\' OR  lname LIKE \'%'.$search.'%\')', NULL)
			->limit($limit, $offset)
			->order_by($sort_by, $sort_order);
		
		$ret['rows'] = $q->get()->result();
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
			->from('signup')		
			->like('username',$search);
					
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	
}