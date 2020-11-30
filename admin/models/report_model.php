<?php ob_start();
class report_model extends CI_Model {
	
	function search($limit, $offset, $sort_by, $sort_order,$data) {
			
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('id');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'id';
	
		
				$style =$data['style'];		
				$cno=$data['cno'];
				$ctelephone=$data['ctelephone'];					
				$status = $data['status'];
				$type =$data['type'];
				$sdate =$data['sdate'];
				$edate = $data['edate'];
				$cno1 = $data['cno1'];
		
			$criteria='';
				
				if($cno!='0')
				{
					if($criteria=='')
						$criteria='dress_booking.customer_no LIKE \'%'.$cno.'%\'';
					else
						$criteria=$criteria.' and dress_booking.customer_no LIKE \'%'.$cno.'%\'';
				}
				if($ctelephone!='')
				{
					if($criteria=='')
						$criteria='customer.ctelephone LIKE \'%'.$ctelephone.'%\'';
					else
						$criteria=$criteria.' and customer.ctelephone LIKE \'%'.$ctelephone.'%\'';
				}
				if($cno1!='')
				{
					if($criteria=='')
						$criteria='customer.cno LIKE \'%'.$cno1.'%\'';
					else
						$criteria=$criteria.' and customer.cno LIKE \'%'.$cno1.'%\'';
				}
				 if($type!='0')
				{
					if($criteria=='')
						$criteria='dress_booking_detail.type LIKE \'%'.$type.'%\'';
					else
						$criteria=$criteria.' and dress_booking_detail.type LIKE \'%'.$type.'%\'';
				}
				 if($style!='0')
				{
					if($criteria=='')
						$criteria='dress_booking_detail.style LIKE \'%'.$style.'%\'';
					else
						$criteria=$criteria.' and dress_booking_detail.style LIKE \'%'.$style.'%\'';
				}
				 if($status!='0')
				{
					if($criteria=='')
						$criteria='dress_booking_detail.status LIKE \'%'.$status.'%\'';
					else
						$criteria=$criteria.' and dress_booking_detail.status LIKE \'%'.$status.'%\'';
				}
				 if($sdate!='0-0-0')
				{
					if($criteria=='')
						$criteria="((datebefore between '".$sdate."' and '".$edate."') or (dateafter between '".$sdate."' and '".$edate."') or ('".$sdate."' between datebefore and dateafter) or ('".$edate."' between datebefore and dateafter))";
					else
						$criteria=$criteria." and ((datebefore between '".$sdate."' and '".$edate."') or (dateafter between '".$sdate."' and '".$edate."') or ('".$sdate."' between datebefore and dateafter) or ('".$edate."' between datebefore and dateafter))";
				}
				//echo $criteria;
				 if($criteria!='')
				{
				 $q = $this->db->select('dress_booking.id,remarks,dateafter,datebefore,dress_booking.customer_no,dress_booking.staff_name,dress_booking_detail.dbid,dress_booking_detail.type,dress_booking_detail.style,dress_booking_detail.status')
					->from('dress_booking')				
					->join('dress_booking_detail','dress_booking.id = dress_booking_detail.dbid')
					->join('customer','customer.cno = dress_booking.customer_no')
					->where($criteria, NULL)
					->order_by('customer.cno', 'asc');
							//	->limit($limit, $offset);
					
				
					$ret['rows'] = $q->get()->result();
					
						$q = $this->db->select('COUNT(*) as count', FALSE)
						->from('dress_booking')					
						->join('dress_booking_detail','dress_booking.id = dress_booking_detail.dbid')
						->join('customer','customer.cno = dress_booking.customer_no')
						->where($criteria, NULL);				
					
					$tmp = $q->get()->result();
					//$ret['search']=$_SESSION['SEARCH_DATA'][0]['search'];
					$ret['num_rows'] = $tmp[0]->count;
				}
				else
				{
					$ret['rows']='';
					$ret['num_rows']='';
				}
			return $ret;
	}
	
	function search_dress($limit, $offset, $sort_by, $sort_order,$data) {
	
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('id');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'id';
		
		$style =$data['style'];	
		$type =$data['type'];
		$sdate =$data['sdate'];
		$edate = $data['edate'];
		
			$criteria='';			
			$size=sizeof($style);
			$i=0;
			if($size>0)
			{
				for($i=0;$i<$size;$i++)
				{
					if($criteria=='')
						$criteria='dress_booking_detail.style LIKE \'%'.$style[$i].'%\'';
					else
						$criteria=$criteria.' or dress_booking_detail.style LIKE \'%'.$style[$i].'%\'';					
				}
			}
			
				
				 if($type!='0')
				{
					if($criteria=='')
						$criteria='dress_booking_detail.type LIKE \'%'.$type.'%\'';
					else
						$criteria=$criteria.' and dress_booking_detail.type LIKE \'%'.$type.'%\'';
				}							
				 if($sdate!='0-0-0')
				{
					if($criteria=='')
						$criteria="((datebefore between '".$sdate."' and '".$edate."') or (dateafter between '".$sdate."' and '".$edate."') or ('".$sdate."' between datebefore and dateafter) or ('".$edate."' between datebefore and dateafter))";
					else
						$criteria=$criteria." and ((datebefore between '".$sdate."' and '".$edate."') or (dateafter between '".$sdate."' and '".$edate."') or ('".$sdate."' between datebefore and dateafter) or ('".$edate."' between datebefore and dateafter))";
				}
				//echo $criteria;
				 if($criteria!='')
				{
					$q = $this->db->select('dress_booking.id,remarks,dateafter,datebefore,dress_booking.customer_no,dress_booking.staff_name,dress_booking_detail.dbid,dress_booking_detail.type,dress_booking_detail.style,dress_booking_detail.status')
					->from('dress_booking')					
					->join('dress_booking_detail','dress_booking.id = dress_booking_detail.dbid')
					->where($criteria, NULL);
				//	->limit($limit, $offset);
					//->order_by($sort_order, $sort_by);
				
				$ret['rows'] = $q->get()->result();
					
						$q = $this->db->select('COUNT(*) as count', FALSE)
						->from('dress_booking')					
						->join('dress_booking_detail','dress_booking.id = dress_booking_detail.dbid')
						->where($criteria, NULL);				
					
					$tmp = $q->get()->result();
					
					$ret['num_rows'] = $tmp[0]->count;
				}
				else
				{
					$ret['rows']='';
					$ret['num_rows']='';
				}
				//echo print_r($ret);
				return $ret;
	}
	function get_style($type = NULL)
	{			
		$q = $this->db->select('dress_style.did, dress_style.styleno,dress_style.description,dress_style.type')
		->from('dress_style')
		->join('dress_type','dress_type.did = dress_style.type')
		->where('dress_style.type', $type);
		
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