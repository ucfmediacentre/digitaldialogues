<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Message_model extends CI_Model {

    //makes sure all functions load the database and url helper
	public function __construct()
    {
	  // Call the Model constructor
	  parent::__construct();
	  
	  $this->load->database();
	  $this->load->helper('url');
    }
    
   // adds all the details of a message
   public function joinGroup_message($toUser, $fromUser, $group)
   {
	
	  // set up all the info in the right variables
	  $this->load->helper('date');
	  $data = array(
		  'toName' => $toUser,
		  'fromName' => $fromUser,
		  'subject' => 'Request to join group "'.$group.'"',
		  'body' => 'Hi '.$toUser.', '.$fromUser.' would like to join the "'.$group.'" group. If you are happy about this, please <a href="'.base_url().'index.php/users/addUserToGroup/'.$fromUser.'/'.$group.'">click here</a>.',
		  'dateTime' => date("Y-m-d H:i:s")
	  );
			
	  // insert new information into the database
	  $this->db->insert('messages', $data); 
	  $added_message_id = $this->db->insert_id();
	  
	  return $added_message_id;
   }
   
   
}
