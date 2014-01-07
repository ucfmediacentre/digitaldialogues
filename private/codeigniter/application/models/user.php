<?php
Class User extends CI_Model
{
	function login($username, $password)
	{
		$this -> db -> select('user_id, user_email');
		$this -> db -> from('users');
		$this -> db -> where('user_email', $username); 
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
}
?>