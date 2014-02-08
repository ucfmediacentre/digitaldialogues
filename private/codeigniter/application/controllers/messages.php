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
		
		// send the info needed to the message table
		$data['toUser'] = $toUser;
		$data['fromUser'] = $requester;
		$data['group'] = $group;
		
		$this->load->model('Messages_model');
		$this->Messages_model->joinGroup_message($toUser, $requester, $group);
	}
	
	// set up viewer to browse messages
	public function view($username) {
	  
		// check to see if user is logged in as the right person
		if ($this->session->userdata('username') != $username) {
			window.history.back();
			return;
		}
		
		//get all messages from the database
		$this->load->model('Messages_model');
		$data['messages'] = $this->Messages_model->get_all_unread_messages($username);
		$data['username'] = $username;
		$data['type'] = "Unread messages";
		
		// pass data into messages_view.php
		$this->load->view('messages_view', $data);
		
	}
	// set up viewer to browse messages
	public function view_all($username) {
	  
		// check to see if user is logged in as the right person
		if ($this->session->userdata('username') != $username) {
			window.history.back();
			return;
		}
		
		//get all messages from the database
		$this->load->model('Messages_model');
		$data['messages'] = $this->Messages_model->get_all_messages($username);
		$data['username'] = $username;
		$data['type'] = "All messages";
		
		// pass data into messages_view.php
		$this->load->view('messages_view', $data);
		
	}
	
	// set up viewer to browse messages
	public function delete_message($message_id, $username) {
	  
		// check to see if user is logged in as the right person
		if ($this->session->userdata('username') != $username) {
			window.history.back();
			return;
		}
		
		//get all messages from the database
		$this->load->model('Messages_model');
		$data['messages'] = $this->Messages_model->delete_message($message_id, $username);
		$data['username'] = $username;
		$data['type'] = "All messages";
		
		// pass data into messages_view.php
		$this->load->view('messages_view', $data);
		
	}
	
	// set up viewer to browse messages
	public function mark_as_read($message_id, $username) {
	  
		// check to see if user is logged in as the right person
		if ($this->session->userdata('username') != $username) {
			window.history.back();
			return;
		}
		
		//get all messages from the database
		$this->load->model('Messages_model');
		$data['messages'] = $this->Messages_model->mark_as_read($message_id, $username);
		$data['username'] = $username;
		$data['type'] = "Unread messages";
		
		// pass data into messages_view.php
		$this->load->view('messages_view', $data);
		
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */

