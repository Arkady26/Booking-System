<?php

class Membership_model extends CI_Model
{
	function validate($uname,$pwd)
	{
		 $sql = "SELECT * FROM signup WHERE username ='".$uname."' and password='".md5($pwd)."'";
		 $q = $this->db->query($sql);		  
		if($q->num_rows() > 0) 
		{
			foreach ($q->result() as $row)
			 {
				$data[] = $row;
			 }	
		}
		else
		{
			$data='';
		}
		//echo print_r($data);
		return $data;	
    }
	function add_record($tablename,$data)
	{
		$this->db->insert($tablename, $data);
		$myid=$this->db->insert_id();		 
		return $myid;
	}
	function gettemplate($template)
	{
 		$sql = "select body from mail where name = '".$template."'";
 		$q= $this->db->query($sql);
		if($q->num_rows() > 0) 
		{
			foreach ($q->result() as $row)
			 {
				 $data[] = $row;
			 }
			 return $data;
		}
 	}
	function isadmin()
	{
		$this->db->where('flag', 'a');
		$query = $this->db->get('signup');
		if($query->num_rows >= 1)
		{
			return true;
		}
	}
	function validateinput($id,$value)
	{
		
		$this->db->where($id, $value);
		$query = $this->db->get('signup');
		if($query->num_rows == 1)
		{
			return true;
		}
		return false;
	}
	function getemailarrdess($value)
	{
		$this->db->select('email');
		$this->db->where('username',$value);
		$query = $this->db->get('signup');
		 $data['a'] = $query->result();
		 foreach($data['a'] as $r) :
	 			$e=$r->email;
		 endforeach; 
		 return $e;
	}
	function update_password($fild,$username,$data)
	{
		$this->db->where($fild, $username);
		$this->db->update('signup', $data);
		return;
	}

}
