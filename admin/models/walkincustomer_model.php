<?php

class walkincustomer_model extends CI_Model {
	
	function search($limit, $offset, $sort_by, $sort_order,$search) {
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('wname','walkincustomer','wtelephone','cpname','cptelephone','wdate','weddingdate','staffname');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'wname';
		
		// results query
		$q = $this->db->select('*')
			->from('walkincustomer')			
			->where('(wname LIKE \'%'.$search.'%\' OR  wtelephone LIKE \'%'.$search.'%\' OR  cptelephone LIKE \'%'.$search.'%\' OR  cpname LIKE \'%'.$search.'%\' OR wdate LIKE \'%'.$search.'%\')', NULL)	
			->limit($limit, $offset)
			->order_by($sort_by, $sort_order);
		
		$ret['rows'] = $q->get()->result();
		
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
			->from('walkincustomer')	
			->where('(wname LIKE \'%'.$search.'%\' OR  wtelephone LIKE \'%'.$search.'%\' OR  cptelephone LIKE \'%'.$search.'%\' OR  cpname LIKE \'%'.$search.'%\'  OR  wdate LIKE \'%'.$search.'%\')', NULL)		
			->like('wname',$search);
					
		$tmp = $q->get()->result();
		
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	
	function get_style($type = NULL){
			
		$q = $this->db->select('dress_style.did, dress_style.styleno,dress_style.description,dress_style.type')
		->from('dress_style')
		->join('dress_type','dress_type.did = dress_style.type')
		->where('dress_style.type', $type)
		->order_by('styleno', 'asc');
		/*if($faculty != NULL){
			
		}*/
    	$tmp= $q->get()->result();
		$s = array();
		$s[0] = 'Select Style';
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