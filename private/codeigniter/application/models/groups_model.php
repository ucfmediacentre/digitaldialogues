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
   function get_group_details($group)
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
   
   function check_user($group, $user_id){
	
	// presume no access
	$access = false;
	
	$query = $this->db->get_where('groups', array('title' => $group), 1);
	
	$result = $query->row();
	
	// check to see if the user is the creator of the group
	if ($result->creator_id == $user_id){
	    
	  // allow access
	  $access = true;
	    
	// if not the creator do they have access to the group?    
	}else{
	    
	  $users = $result->user_ids;
	  
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
}