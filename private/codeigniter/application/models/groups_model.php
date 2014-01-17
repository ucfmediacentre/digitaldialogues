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
}