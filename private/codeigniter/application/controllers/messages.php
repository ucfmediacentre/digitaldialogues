<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Messages extends CI_Controller

{
	public

	function __construct()
	{
		parent::__construct();
	}

	// setting up a new group request in the database
	public function group_request($requester, $group)
	{
	  
		$this->load->database();
		// get the group information from the db
		$this->load->model('Groups_model');
		$group_details= $this->Groups_model->get_group_details($group);
		$toId = $group_details->creator_id;
		
		// get the details of who should get the message
		$this->load->model('Users_model');
		$toUser = $this->Users_model->get_user($toId);
		
		$this->load->model('Messages_model');
		$this->Messages_model->joinGroup_message($toUser, $requester, $group);
	}
	
	// updates the page_info and returns "1" if successful
	public function send_message()
	{
	  $this->load->model('Messages_model');
	  return $this->Messages_model->send_message();
	}
	
	// set up viewer to browse messages
	public function view($username) {
	  
		// check to see if user is logged in as the right person
		if ($this->session->userdata('username') != $username) {
			if (defined('window')) {
				window.history.back();
			} else {
				redirect(base_url().'index.php/pages/view/public/home', 'location');
			}
		}
		
		//get all messages from the database
		$this->load->model('Messages_model');
		
		//get list of members as an options string
		$members = $this->Messages_model->get_all_members();
		$membersOptions = '';
		foreach($members as $item):
			//get details of each message
			$member = $item['user_name'];
			$membersOptions = $membersOptions . '<option value="' . $member . '">' . $member . '</option>';
		endforeach; 
		$data['members'] = $membersOptions;
		
		$data['username'] = $username;
		$data['type'] = "Unread messages";
		
		//initialise message list
		$messages = $this->Messages_model->get_all_unread_messages($username);
		$messagesList = '';
		if (count($messages) == 0){
			$messagesList = "<H2 style='color:gray;'>You have no new messages</H2>";
			$message_id="0";
		} else {
			foreach($messages as $item):
				//get details of each message
				$subject = $item['subject'];
				$fromName = $item['fromName'];
				$body = $item['body'];
				$dateTime = $item['dateTime'];
				$unread = $item['unread'];
				$message_id = $item['message_id'];
				
				// iterate through all the items found in the messages array and form output
				$messagesList = $messagesList . "<H2 style='color:gray;'>" . $subject . "&nbsp;<input type='button' value='Mark as read' style='font-size:12px; width:7em;  height:0.5em;' onclick='mark_as_read($message_id, &#39;$username&#39;)'></H2>";
				$messagesList = $messagesList . "<span  style='color:gray;'><From: " . $fromName . "<br />";
				$messagesList = $messagesList . "Date: " . $dateTime . "</span><br /><br />";
				$messagesList = $messagesList . $body . "<br />";
				$messagesList = $messagesList . "<hr />";	
			endforeach; 
		}
		$data['messagesList'] = $messagesList;
		$data['title'] = 'Unread messages for ' . $username;
		
		// pass data into messages_view.php
		$this->load->view('header', $data);
		$this->load->view('messages_view', $data);
		$this->load->view('pages_view/new_message_form');
		$this->load->view('message_view_scripts');
		$this->load->view('footer');
		
	}
	// set up viewer to browse messages
	public function view_all($username) {
	  
		// check to see if user is logged in as the right person
		if ($this->session->userdata('username') != $username) {
			if (defined('window')) {
				window.history.back();
			} else {
				redirect(base_url().'index.php/pages/view/public/home', 'location');
			}
		}
		
		//get all messages from the database
		$this->load->model('Messages_model');
		
		//get list of members as an options string
		$members = $this->Messages_model->get_all_members();
		$membersOptions = '';
		foreach($members as $item):
			//get details of each message
			$member = $item['user_name'];
			$membersOptions = $membersOptions . '<option value="' . $member . '">' . $member . '</option>';
		endforeach; 
		$data['members'] = $membersOptions;
		
		$data['messages'] = $this->Messages_model->get_all_messages($username);
		
		//initialise message list
		$messages = $this->Messages_model->get_all_messages($username);
		$messagesList = '';
		if (count($messages) == 0){
			$messagesList = "<H2 style='color:gray;'>You have no messages</H2>";
			$message_id="0";
		} else {
			foreach($messages as $item):
				//get details of each message
				$subject = $item['subject'];
				$fromName = $item['fromName'];
				$body = $item['body'];
				$dateTime = $item['dateTime'];
				$unread = $item['unread'];
				$message_id = $item['message_id'];
				
				// iterate through all the items found in the messages array and form output
				$messagesList = $messagesList . "<H2 style='color:gray;'>" . $subject . "&nbsp;<input type='button' value='Delete' style='font-size:12px; width:4em;  height:0.5em;' onclick='delete_message($message_id, &#39;$username&#39;)'></H2>";
				$messagesList = $messagesList . "<span  style='color:gray;'><From: " . $fromName . "<br />";
				$messagesList = $messagesList . "Date: " . $dateTime . "</span><br /><br />";
				$messagesList = $messagesList . $body . "<br />";
				$messagesList = $messagesList . "<hr />";	
			endforeach; 
		}
		$data['messagesList'] = $messagesList;
		$data['username'] = $username;
		$data['title'] = 'All messages for ' . $username;
		
		// pass data into messages_view.php
		$this->load->view('header', $data);
		$this->load->view('messages_view', $data);
		$this->load->view('pages_view/new_message_form');
		$this->load->view('message_view_scripts');
		$this->load->view('footer');
		
	}
	
	// set up viewer to browse messages
	public function delete_message($message_id, $username) {
	  
		// check to see if user is logged in as the right person
		if ($this->session->userdata('username') != $username) {
			if (defined('window')) {
				window.history.back();
			} else {
				redirect(base_url().'index.php/pages/view/public/home', 'location');
			}
		}
		
		//get all messages from the database
		$this->load->model('Messages_model');
		$data['messages'] = $this->Messages_model->delete_message($message_id, $username);
		$data['username'] = $username;
		$data['type'] = "All messages";
		
		// pass data into messages_view.php
		redirect(base_url().'index.php/messages/view_all/'.$username, 'location');
		
	}
	
	// set up viewer to browse messages
	public function mark_as_read($message_id, $username) {
	  
		// check to see if user is logged in as the right person
		if ($this->session->userdata('username') != $username) {
			if (defined('window')) {
				window.history.back();
			} else {
				redirect(base_url().'index.php/pages/view/public/home', 'location');
			}
		}
		
		//get all messages from the database
		$this->load->model('Messages_model');
		$data['messages'] = $this->Messages_model->mark_as_read($message_id, $username);
		$data['username'] = $username;
		$data['type'] = "Unread messages";
		
		// pass data into messages_view.php
		redirect(base_url().'index.php/messages/view/'.$username, 'location');
		
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */

