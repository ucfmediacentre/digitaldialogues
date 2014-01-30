<?php
Class Users_model extends CI_Model
{
	function login($username, $password)
	{
		$this -> db -> select('user_id, user_email');
		$this -> db -> from('users');
		$this -> db -> where('user_email', $email); 
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
	
	
	public function new_user($username, $email, $password)
	{
		// entry of new information into the database
   		$data = array(
   			'user_name' => $username,
   			'user_email' => $email,
   			'user_pass' => sha1($password)
   			);

		$this->db->insert('users', $data); 
   		
   		return $this->db->insert_id();

	}
}
?>