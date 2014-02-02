<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Groups extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	// initial testing to display page name
	public function index($group)
	{
	 	
		// get the group information from the db
		$this->load->model('Groups_model');
		$group_details= $this->Groups_model->get_group_details($group);
		
		// check security (logged in) and save state of openness to the session
		$this->load->library('session');
		$this->session->set_userdata('openness', 'public');
		if ($group_details->openness == 'private'){
				$this->is_logged_in(URLdecode($group), URLdecode($page_title));
				$this->session->set_userdata('openness', 'private');
				
		}
		
		$user_id = $this->session->userdata('user_id');
		
		// check permissions for group
		$access = $this->Groups_model->check_user($group, $user_id);
		// check the user id in session vs the groups list of users
		
		if (!$access) exit;
	
    }
}


/* End of file pages.php */
/* Location: ./application/controllers/pages.php */
