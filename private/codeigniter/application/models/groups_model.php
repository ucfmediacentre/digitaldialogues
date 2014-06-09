<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups_model extends CI_Model {

    //makes sure all functions load the database and url helper
	public function __construct()
    {
	  // Call the Model constructor
	  parent::__construct();
	  
	  $this->load->database();
	  $this->load->helper('url');
	}
    
	// gets all the details of a specified page
	public function get_group_details($group)
	{
	  $result = $this->db->get_where('groups', array('title' =>$group), 1);
	  
	  if ($result->num_rows() > 0)
	  { 
		return $result->row();
	  }else
	  {
		return false;
	  }
   }
   
   // updates user_info in the `groups` table
   public function addUserToGroup($requesterId, $group)
   {
   		// get user_id and then add this user
		$this->db->select('user_id');
		$this->db->where('title', urldecode($group));
		$this->db->from('groups');
		$query=$this->db->get();
		
		$row = $query->row(); 
		$user_ids = $row->user_id;
		
		// search user_id access to see if new user_id already exists in the list
		$accessList = explode(',', $user_ids);
		
		foreach($accessList as $key) {    
			if ($key == $requesterId) return;    
		}
		
		// add the new user's id to the user_id access list
		$user_ids = $user_ids.",".$requesterId.",";
		
	   	$data = array(
               'user_id' => $user_ids
            );

		$this->db->where('title', $group);
		$this->db->update('groups', $data);
   }
   
   
   // queries groups database to see if a user is allowed access to a particular group (returns TRUE or FALSE)
   public function isUserInGroup($userId, $group)
   {
   		// get user_id and then add this user
		$this->db->select('user_id');
		$this->db->where('title', $group);
		$this->db->from('groups');
		$query=$this->db->get();
		
		$row = $query->row(); 
		$user_ids = $row->user_id;
		
		// search user_id access to see if new user_id already exists in the list
		$accessList = explode(',', $user_ids);
		
		foreach($accessList as $key) {    
			if ($key == $userId) {
				return TRUE;
			}
		}
		
		return FALSE;
   }
   
   
   // queries groups database to see if a user is allowed access to a particular group (returns TRUE or FALSE)
   public function isGroupPublic($group)
   {
   		// get user_id and then add this user
		$this->db->select('openness');
		$this->db->where('title', $group);
		$this->db->from('groups');
		$query=$this->db->get();
		
		$row = $query->row(); 
		$openness = $row->openness;
		
		if ($openness == 'public') {
			return TRUE;
		} else {
			return FALSE;
		}
   }
   
   public function check_user($group, $user_id)
   {
	// presume no access
	$access = false;
	
	$query = $this->db->get_where('groups', array('title' => urldecode($group)), 1);
	
	$result = $query->row();
	
	// check to see if the user is the creator of the group
	if ($result->creator_id == $user_id){
	    
	  // allow access
	  $access = true;
	    
	// if not the creator do they have access to the group?    
	}else{
	  $users = $result->user_id;
	  
	  // break user id string into an array
	  $users = explode(',', $users);
	  
	  // check to see if user id is present in array
	  foreach ($users as $user){
	  
		// allow access
		if ($user == $user_id) $access = true;
	  }
	    
	}
	return $access;
  }
  
  
	public function list_all()
	{
	  //check whether user is logged in
	  $this->load->library('session');
	  $user_id = $this->session->userdata('user_id');
	  
	  // check whether the user has logged in
	  if ($this->session->userdata('logged_in') == 1) {
		//if so collect all groups accessible by the user
		// create list of all groups where they are either public or accessible by the user
		$query = $this->db->query('SELECT * FROM groups WHERE user_id LIKE "%,'.$user_id.',%" OR openness LIKE "public";');
		$result = $query->result_array();
	  } else {
		//if not, collect only public groups
   		$this->db->select('id');
   		$this->db->select('title');
		$this->db->where('openness', 'public');
		$query = $this->db->get('groups');
		$result = $query->result_array();
	  }
	  
	  // encode the reulst s a json object
	  //$groupList = json_encode($result);
	  
	  return $result;
	}
}
