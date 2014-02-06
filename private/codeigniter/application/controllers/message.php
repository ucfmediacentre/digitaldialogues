<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Message extends CI_Controller

{
	public

	function __construct()
	{
		parent::__construct();
	}

	// setting up a new group request in the database
	public function group_request($username, $group)
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
		$data['fromUser'] = $username;
		$data['group'] = $group;
		
		$this->load->model('Message_model');
		$this->Message_model->joinGroup_message($toUser, $username, $group);
	}
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */

