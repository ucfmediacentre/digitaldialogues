<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messages_model extends CI_Model {

    //makes sure all functions load the database and url helper
	public function __construct()
    {
		// Call the Model constructor
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
    }
    
	// inserts a message into the database
	public function joinGroup_message($toUser, $fromUser, $group)
	{
	
		// set up all the info in the right variables
		$this->load->helper('date');
		$data = array(
			'toName' => $toUser,
			'fromName' => $fromUser,
			'subject' => 'Request to join group: '.$group,
			'body' => 'Hi '.$toUser.', '.$fromUser.' would like to join the group: '.$group.'. Please <a href="'.base_url().'index.php/users/addUserToGroup/'.$toUser.'/'.$fromUser.'/'.$group.'" onclick="alert(&quot;'.$fromUser.' will now be allowed into group: '.$group.'&quot;)"; >click here</a>, if this is Ok.',
			'dateTime' => date("Y-m-d H:i:s")
		);
			  
		// insert new information into the database
		$this->db->insert('messages', $data); 
		$added_message_id = $this->db->insert_id();
		
		return $added_message_id;
    }
	
	// creates a page from a click on the Add: Page link
	public function send_message()
	{
		// first insert user's requirements into database
		//collect variables from the form
   		$toName = $this->input->post('toUser');
   		$subject = $this->input->post('subject');
   		$body = $this->input->post('body');
   		$fromName = $this->input->post('fromUser');
			
		// add the new messaage to the database
		$data = array(
			'toName' => $toName,
			'fromName' => $fromName,
			'subject' => $subject,
			'body' => $body,
			'dateTime' => date("Y-m-d H:i:s")
		);
		
		$this->db->insert('messages', $data); 
		return $this->db->insert_id();
			
	}
	
	// retreives all messages belonging to $username
	public function get_all_unread_messages($username) {
		$this->db->where('toName', $username);
		$this->db->where('unread', "Y");
		$this->db->order_by("dateTime","desc");
		$this->db->from('messages');
		$query=$this->db->get();
		
    	$messages = $query->result_array();
		
    	return $messages;
	}
	
	// retrieves all messages belonging to $username
	public function get_all_messages($username) {
		$this->db->where('toName', $username);
		$this->db->where('deleted', "N");
		$this->db->order_by("dateTime","desc");
		$this->db->from('messages');
		$query=$this->db->get();
		
    	$messages = $query->result_array();
		
    	return $messages;
	}

	public function get_new_messages_number($username) {
		
		$this->db->where('toName', $username);
		$this->db->where('unread', "Y");
		$this->db->from('messages');
		$messageCount=$this->db->count_all_results();
		
    	return $messageCount;
		
	}
	
	
	public function update_session_messages_number($username) {
		
		$this->db->where('toName', $username);
		$this->db->where('unread', "Y");
		$this->db->from('messages');
		$messageCount=$this->db->count_all_results();
    	
		$this->session->set_userdata('messageCount', $messageCount);
		
	}
	
	// retrieves all members belonging to community
	public function get_all_members() {
		$this->db->select('user_name');
		$this->db->order_by("user_name","asc");
		$this->db->from('users');
		$query=$this->db->get();
		
    	$members = $query->result_array();
		
    	return $members;
	} 
	
	// retrieves all messages belonging to $username
	public function delete_message($message_id, $username) {
		
		// Mark messages now as deleted
	   	$data = array(
               'deleted' => 'Y',
			   'unread' => 'N'
            );

		$this->db->where('message_id', $message_id);
		$this->db->from('messages');
		$this->db->update('messages', $data);
		
    	$messages = $this->get_all_messages($username);
		$this->update_session_messages_number($username);
		
		return $messages;
	}
	
	// Marks a message as being read
	public function mark_as_read($message_id, $username) {
		
		// Mark unread message now as read
	   	$data = array(
               'unread' => 'N'
            );

		$this->db->where('toName', $username);
		$this->db->where('message_id', $message_id);
		$this->db->update('messages', $data);
		
    	$messages = $this->get_all_unread_messages($username);
		$this->update_session_messages_number($username);
		
		return $messages;
	}
}
