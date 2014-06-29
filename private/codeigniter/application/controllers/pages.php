<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
	{
	  parent::__construct();
	  
	  //$this->is_logged_in();
	}
	
	public function is_logged_in($group, $page){
	  $is_logged_in = $this->session->userdata('logged_in');
	  if (!isset($is_logged_in) || $is_logged_in != true){
		header('Location: ' . base_url() . 'index.php/verifylogin?controller=pages&group=' . $group . '&title=' . $page);
	  }
    }
	
	// initial testing to display page name
	public function index($group = "connectedCommunities", $page_name = "home")
	{
	  header('Location: ' . base_url() . 'index.php/pages/view/' . $group . '/' . $page_name);
	}
	
	
	// set up the page in HTML
	public function view($group = "community", $page_title = NULL)
	{
	  $this->load->helper('url');
	  
	  if ($page_title === NULL){
		$page_title = "home";
		$group = "connectedCommunities";
		redirect('/pages/view/'.$group.'/'.$page_title, 'location');
	  }
	  
	  // get the group information from the db
	  $this->load->model('Groups_model');
	  $group_details= $this->Groups_model->get_group_details(urldecode($group));
	  
	  // check security (logged in) and save state of openness to the session
	  $this->load->library('session');
	  $this->session->set_userdata('openness', NULL);
	  if ($group_details->openness == 'public'){	
		  $this->session->set_userdata('openness', 'public');	
	  } else {
		  $this->is_logged_in(URLdecode($group), URLdecode($page_title));
		  $this->session->set_userdata('openness', 'private');
	  }
	  
	  $user_id = $this->session->userdata('user_id');
	  
	  // check permissions for group
	  $access = $this->Groups_model->check_user(urldecode($group), $user_id);
	  // check the user id in session vs the groups list of users
	  
	  if (!$access) {
		  // user is logged in but is not yet allowed into the group
		  // So user is offered opportunity to request access but stays on previous page
		  if ($this->session->userdata('openness') != 'public'){
			  
			  $data['group'] = urldecode($group);
			  $data['title'] = urldecode($page_title);
			  
			  $this->load->view('header', $data);
			  $this->load->view('pages_view/entry_request', $data);
			  $this->load->view('footer');
			  return;
		  }
	  }
	  
	  // get the page information from the db.php
	  $this->load->model('Pages_model');
	  $page_details= $this->Pages_model->get_page(urldecode($group), URLdecode($page_title));
	  
	  $data['page_info'] = $page_details;
	  $data['user_id'] = $user_id;
	  
	  if($page_details) 
	  {
		// get the page elements
		$this->load->model('Elements_model');
		$this->load->model('Links_model');
		
		$page_elements = $this->Elements_model->get_all_elements($page_details->id);
		$data['page_elements'] = $page_elements;
		$data['title'] = urldecode($page_title);
		
		// load view with data
		$this->load->view('header', $data);
		$this->load->view('pages_view/page_view', $data);
		$this->load->view('pages_view/new_element_form');
		$this->load->view('pages_view/page_info_form');
		$this->load->view('pages_view/page_view_scripts');
		$this->load->view('footer');
	  } else {
		//Page was not found, so create a new one
		//$page_id=$this->Pages_model->insert_page(urldecode($group), urldecode($page_title));
		//redirect('/pages/view/'.urldecode($group).'/'.urldecode($page_title), 'location');
		// - No, dont create a new one! Tell people there is nothing there
		show_404('page');
		  
	  }
	}
	
	// updates the page_info and returns "1" if successful
	public function update()
	{
	  $this->load->model('Pages_model');
	  return $this->Pages_model->update();
	}
	
	// updates the page_info and returns "1" if successful
	public function add_page()
	{
	  $this->load->model('Pages_model');
	  return $this->Pages_model->add_page();
	}
	
	// updates the group database and returns "1" if successful
	public function add_group()
	{
	  $this->load->model('Groups_model');
	  return $this->Groups_model->add_group();
	}
	
	// displays success on uploading an image and the image name
	public function upload_image()
	{
	  echo '{"success":true, "name": "' . $_GET['name'] . '"}';
	}
	
}


/* End of file pages.php */
/* Location: ./application/controllers/pages.php */
