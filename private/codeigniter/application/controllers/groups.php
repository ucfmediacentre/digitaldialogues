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
	
   // creates a group from a click on the Add: Group link
   public function add_group()
   {
		// first insert user's requirements into the group database
		//collect variables from the form
		
   		$newGroup = $this->input->post('newGroup');
   		$participation = $this->input->post('participation');
   		$currentPage = $this->input->post('currentPage');
   		$currentGroup = $this->input->post('currentGroup');
   		$currentPageId = $this->input->post('currentPageId');
		$userId = $this->input->post('userId');
   		
		
		// search database to see if this group already exists
   		$this->db->where('title', $newGroup);
   		$query = $this->db->get('groups');
		
		if ($query->num_rows() > 0)
		{
		   $group_exists = "TRUE";
		   return "A group called $newGroup already exists";
		}else
		{
		   $group_exists = "FALSE";
		}
   		
		// add the new group to the database
	   	$data = array(
		    'title' => URLdecode($newGroup),
		    'openness' => $participation,
			'creator_id' => $userId
   		);
		$this->db->insert('groups', $data); 
   		$added_group_id = $this->db->insert_id();
		
		// Then create a new Home page for this group
		// add the new page to the database
	   	$data = array(
		    'title' => "Home",
		    'group' => $newGroup
   		);
		$this->db->insert('pages', $data); 
   		$added_page_id = $this->db->insert_id();
		
		//Now create the elements with links in them
		// First the link away element with the correct link id
	   	$data = array(
		    'contents' => "[[group::" . $newGroup . "]]",
		    'pages_id' => $currentPageId,
		    'type' => "text",
		    'x' => rand(200,500),
		    'y' => rand(150,400)
   		);
		$this->db->insert('elements', $data);
   		$elementAway_id = $this->db->insert_id();
		
		//Now create the link on the new page back to the original page
		// Then the link back element with the correct link id
	   	$data = array(
		    'contents' => "[[group::" . $currentGroup . "]]",
		    'pages_id' => $added_page_id,
		    'type' => "text",
		    'x' => rand(200,500),
		    'y' => rand(150,400)
   		);
		$this->db->insert('elements', $data);
   		$elementBack_id = $this->db->insert_id();
		
   		return $this->db->insert_id();
		
    }
}


/* End of file pages.php */
/* Location: ./application/controllers/pages.php */
