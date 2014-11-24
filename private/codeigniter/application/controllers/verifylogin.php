<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('users_model','',TRUE);
  }

  function index($controller = null, $group = null, $title = null)
  {
	
    //This method will have the credentials validation
    $this->load->library('form_validation');
	
	if ($controller == null) $controller = $this->input->get('controller');
	if ($title == null) $title = $this->input->get('title');
	if ($group == null) $group = $this->input->get('group');
	
	$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
	
    if($this->form_validation->run() == FALSE)
    {
      //Field validation failed.  User redirected to login page
	  $data['controller'] = $controller;
	  $data['group'] = $group;
	  $data['title'] = $title;
	  $this->load->view('login_view', $data);
	  
    }
    else
    {
	  $valid_user = $this->users_model->login($this->input->post('username'), $this->input->post('password'));
	  
	  if ($valid_user == false){
		$this->index();
	  }else{
		// add session data
		$info = $valid_user[0];
	
		$data = array(
		  'username' => $this->input->post('username'),
		  'user_id' => $info->user_id,
		  'logged_in' => true
		);
		
		$this->session->set_userdata($data);
		
		$this->users_model->saveLoginToDatabase($data['username']);
		
		$controller = $this->input->post('controller');
		$title = $this->input->post('title');
		$group = $this->input->post('group');
		
		// redirect to private area
		if (isset($controller) && isset($title) && isset($group)) header('Location: ' . base_url() . 'index.php/' . $controller . '/view/' . $group . '/' . $title );
				
		exit();
	  }
    }
    
  }
  
  function check_database($password)
  {
    //Field validation succeeded.  Validate against database
    $username = $this->input->post('username');
    
    //query the database
    $result = $this->users_model->login($username, $password);
    
    if($result)
    {
		
		// Load up the session variables
		$sess_array = array();
		foreach($result as $row)
		{
			$sess_array = array(
				'id' => $row->user_id,
				'user_name' => $row->user_name,
			);
			$this->session->set_userdata('logged_in', $sess_array);
			
			// At the same time set the session variable of the count of unread messages at the moment
			$this->load->model('messages_model');
			$messageCount = $this->messages_model->get_new_messages_number($username);
			$this->session->set_userdata('messageCount', $messageCount);
		}
		return TRUE;
    }
    else
    {
      $this->form_validation->set_message('check_database', 'Invalid username or password');
      return FALSE;
    }
  }
  
  function log_out($controller, $group, $title){
	$this->session->sess_destroy();
	header('Location: ' . base_url() . 'index.php/' . $controller . '/view/' . $group . '/' . $title );
  }
}
?>