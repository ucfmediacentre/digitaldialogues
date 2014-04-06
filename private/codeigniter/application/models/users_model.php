<?php
Class Users_model extends CI_Model
{
	function login($username, $password)
	{
		$this -> db -> select('user_id, user_name');
		$this -> db -> from('users');
		$this -> db -> where('user_name', $username); 
		$this -> db -> where('user_pass', sha1($password)); 
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

	}
	
	
	public function new_user_vericode($username, $email, $password)
	{
	  
		// create random cerification code based on microseconds
		$vericode = sha1(microtime());
		// entry of new information into the database
   		$data = array(
   			'user_name' => $username,
   			'user_email' => $email,
   			'verification_code' => $vericode,
   			'user_pass' => sha1($password)
   			);

		$this->db->insert('users', $data); 
   		
   		return $vericode;

	}
	
	public function get_user($userId)
	{
   		$this->db->where('user_id', $userId);
   		$this->db->select('user_name');
   		$query = $this->db->get('users');
		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
			return $row->user_name;
		}else
		{
			return null;
		}
	}
	
	public function get_userId($user)
	{
		// make sure you don't search for the value of FALSE, which happens if user is not logged in
   		$this->db->where('user_name', $user);
   		$this->db->select('user_id');
   		$query = $this->db->get('users');
		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
			return $row->user_id;
		}else
		{
			return null;
		}
	}
}
?>