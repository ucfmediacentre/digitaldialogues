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
	public function index($page_name = "home")
	{
	 	header('Location: ' . base_url() . 'index.php/pages/view/' . $group . '/' . $page_name);
	}
	
	
	// set up the page in HTML
	public function view($group, $page_title = NULL)
	{
		$this->load->helper('url');
		
		/*test to see if page requested is recent changes, if so go there
		if (strtoupper(urldecode($page_title)) === "RECENT CHANGES" | strtoupper ($page_title) === "RECENTCHANGES") {
			redirect('/'.$group.'/recentChanges', 'location');
		}*/
		
		if ($page_title === NULL){
				$page_title = "home";
				$group = "public";
				redirect('/pages/view/'.$group.'/'.$page_title, 'location');
		}
		
		// get the group information from the db.php
		$this->load->model('Groups_model');
		$group_details= $this->Groups_model->get_group_details($group);
		
		// check security (logged in)
		if ($group_details->openness == 'private'){
				$this->is_logged_in(URLdecode($group), URLdecode($page_title));
		}
		
		$user_id = $this->session->userdata('user_id');
		
		// check permissions for group
		$access = $this->Groups_model->check_user($group, $user_id);
		// check the user id in session vs the groups list of users
		
		//if (!$access) exit;
		
		// get the page information from the db.php
		$this->load->model('Pages_model');
		$page_details= $this->Pages_model->get_page($group, URLdecode($page_title));
		
		$data['page_info'] = $page_details;
		
		if($page_details) 
		{
			// get the page elements
			$this->load->model('Elements_model');
			$this->load->model('Links_model');
			
			$page_elements = $this->Elements_model->get_all_elements($page_details->id);
			$data['page_elements'] = $page_elements;
			
			// load view with data
			$this->load->view('header', $data);
			$this->load->view('pages_view/page_view');
			$this->load->view('pages_view/new_element_form');
			$this->load->view('pages_view/new_text_form');
			$this->load->view('pages_view/new_image_form');
			$this->load->view('pages_view/new_audio_form');
			$this->load->view('pages_view/new_video_form');
			$this->load->view('pages_view/new_page_form');
			$this->load->view('pages_view/new_group_form');
			$this->load->view('pages_view/page_info_form');
			$this->load->view('pages_view/page_view_scripts');
			$this->load->view('footer');
		}else
		{
			//Page was not found, so create a new one
			$page_id=$this->Pages_model->insert_page($group, $page_title);
			redirect('/pages/view/'.$group.'/'.$page_title, 'location');
			
		}
	}
	
	// updates the page_info and returns "1" if successful
	public function update()
	{
		$this->load->model('Pages_model');
		return $this->Pages_model->update();
		//redirect('/pages/view/'.$group.'/'.$page_title, 'location');
	}
	
	// updates the page_info and returns "1" if successful
	public function add_page()
	{
		$this->load->model('Pages_model');
		return $this->Pages_model->add_page();
		//redirect('/pages/view/'.$group.'/'.$page_title, 'location');
	}
	
	// updates the group database and returns "1" if successful
	public function add_group()
	{
		$this->load->model('Pages_model');
		return $this->Pages_model->add_group();
		//redirect('/pages/view/'.$group.'/'.$page_title, 'location');
	}
	
	// displays success on uploading an image and the image name
	public function upload_image()
	{
		echo '{"success":true, "name": "' . $_GET['name'] . '"}';
	}
	
}


/* End of file pages.php */
/* Location: ./application/controllers/pages.php */
