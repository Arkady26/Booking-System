<?php

class dress_booking_model extends CI_Model {
	
	function search($limit, $offset, $sort_by, $sort_order,$search) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('id','customer_no','staff_name','customer.cname');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'id';
		
		// results query
		$q = $this->db->select('*,customer.cname')
			->from('dress_booking')
			->join('customer','dress_booking.customer_no = customer.cno')
			->where('(dress_booking.staff_name LIKE \'%'.$search.'%\' OR customer.cname  LIKE \'%'.$search.'%\' OR dress_booking.customer_no  LIKE \'%'.$search.'%\')', NULL)
			->limit($limit, $offset)
			->order_by($sort_by, $sort_order);
		
		$ret['rows'] = $q->get()->result();
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
			->from('dress_booking')	
			->join('customer','dress_booking.customer_no = customer.cno')
			->where('(dress_booking.staff_name LIKE \'%'.$search.'%\' OR customer.cname  LIKE \'%'.$search.'%\' OR dress_booking.customer_no  LIKE \'%'.$search.'%\')', NULL)	
			->like('staff_name',$search);
					
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	function get_style($type = NULL){
			
		$q = $this->db->select('dress_style.did, dress_style.styleno,dress_style.description,dress_style.type')
		->from('dress_style')
		->join('dress_type','dress_type.did = dress_style.type')
		->where('dress_style.type',$type)
		->order_by('styleno', 'asc');
		/*if($faculty != NULL){
			
		}*/
    	$tmp= $q->get()->result();
		$s = array();
		if($tmp){
			foreach ($tmp as $s1) {
				$s[$s1->did] = $s1->styleno;
			}
		return $s;
		}else{
			return FALSE;
		}
	}
	
}