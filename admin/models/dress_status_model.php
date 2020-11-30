<?php

class dress_status_model extends CI_Model {
	
	function search($limit, $offset, $sort_by, $sort_order,$search) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('status');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'status';
		
		// results query
		$q = $this->db->select('*')
			->from('dress_status')			
			->like('status',$search)
			->limit($limit, $offset)
			->order_by($sort_by, $sort_order);
		
		$ret['rows'] = $q->get()->result();
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
			->from('dress_status')		
			->like('status',$search);
					
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	function setdefaultstatus($did)
	{
		$q="update dress_status set setdefault='0'";
		$sql = $this->db->query($q);
		
		$q1="update dress_status set setdefault='1' where did='".$did."'";
		$sql1= $this->db->query($q1);
		return ;
	}
	
}