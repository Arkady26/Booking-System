<?php

class customer_model extends CI_Model {
	
	function search($limit, $offset, $sort_by, $sort_order,$search) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('cno','cname','ctelephone','cpname','cptelephone','cweddingdate');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'cname';
		
		// results query
		$q = $this->db->select('*')
			->from('customer')			
			->where('(cname LIKE \'%'.$search.'%\' OR  ctelephone LIKE \'%'.$search.'%\' OR  cweddingdate LIKE \'%'.$search.'%\' OR  cpname LIKE \'%'.$search.'%\' OR  cptelephone LIKE \'%'.$search.'%\')', NULL)	
			->limit($limit, $offset)
			->order_by($sort_by, $sort_order);
		
		$ret['rows'] = $q->get()->result();
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
			->from('customer')	
			->where('(cname LIKE \'%'.$search.'%\' OR  ctelephone LIKE \'%'.$search.'%\' OR  cweddingdate LIKE \'%'.$search.'%\' OR  cpname LIKE \'%'.$search.'%\' OR  cptelephone LIKE \'%'.$search.'%\')', NULL)		
			->like('cname',$search);
					
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	function delete_row($tablename,$value,$cno)
	{
		$sql="Delete FROM dress_booking_detail WHERE dbid IN(select id from dress_booking where customer_no='".$cno."')";		
		$q = $this->db->query($sql);
		
		$sql="Delete FROM dress_booking where customer_no='".$cno."'";		
		$q = $this->db->query($sql);
		
		$sql="Delete FROM customer where cid='".$value."'";		
		$q = $this->db->query($sql);
	}
}