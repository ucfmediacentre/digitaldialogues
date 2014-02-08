<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	// provides access to a user in a group 
	public function addUserToGroup($username, $requester, $group)
	{
		
		// check to see if user is logged in as the right person
		if ($this->session->userdata('username') != $username) {
			return;
		}

		// get the Id of who needs to be added
		$this->load->model('Users_model');
		$requesterId = $this->Users_model->get_userId($requester);
		
		$this->load->model('Groups_model');
		$this->Groups_model->addUserToGroup($requesterId, $group);
		
		redirect(base_url() . 'index.php/messages/view/'.$this->session->userdata('username'), 'location');
		
    }
}


/* End of file pages.php */
/* Location: ./application/controllers/pages.php */
