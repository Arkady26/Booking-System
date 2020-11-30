<?php
class Global_model extends CI_Model {
	
	function getall($tablename)
	{		
		$query = $this->db->get($tablename);
		return $query->result();
	}
	function add_record($tablename,$data)
	{
		$this->db->insert($tablename, $data);
		$ins=$this->db->insert_id();		 
		return $ins;
	}
	
	function delete_row($tablename,$id,$value)
	{
		$this->db->where($id ,$value);
		$this->db->delete($tablename);
		if($this->db->affected_rows () == 0)
		{
			return false;
		}
		return true;
	}
	function edit_select($tablename,$id,$value)
	{
		$sql = "SELECT * FROM ". $tablename . " WHERE " . $id . " = " . $value;
		$q = $this->db->query($sql);
		return $q->result();
	}
	
	function update_record($tablename,$data,$id,$value) 
	{
		$this->db->update($tablename, $data, array($id => $value));
		return;		
	}
	function namebyid($tablename,$fildname,$id,$value)
	{	
		$this->db->select($fildname);
		$this->db->where($id,$value);
		$query = $this->db->get($tablename);
		return $query->result();
	}	
	function checkunique($tablename,$criteria)
	{	
		$sql = "SELECT * FROM ". $tablename . " WHERE " . $criteria;
		$query = $this->db->query($sql);	
		if($query->num_rows == 1)
		{
			return true;
		}
		return false;
	}	
	function checkunique1($tablename,$criteria)
	{	
		$sql = "SELECT * FROM ". $tablename . " WHERE " . $criteria;
		$query = $this->db->query($sql);	
		if($query->num_rows >= 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}	
	
}