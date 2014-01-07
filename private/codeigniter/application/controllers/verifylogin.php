<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

  function __construct()
  {
    parent::__construct();
    $this->load->model('user','',TRUE);
  }

  function index($controller = null, $page = null)
  {
    //This method will have the credentials validation
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
	
    if($this->form_validation->run() == FALSE)
    {
      //Field validation failed.  User redirected to login page
      $this->load->view('login_view');
    }
    else
    {
	  $valid_user = $this->user->login($this->input->post('username'), $this->input->post('password'));
	  
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
		
		
		$controller = $this->input->post('controller');
		$title = $this->input->post('title');
		
		// redirect to private area
		//cpmr is hardcoded at the moment, and needs to be given by the variable in the URL OR the link itself?
		if (isset($controller) && isset($title)) header('Location: ' . base_url() . 'index.php/' . $controller . '/view/cpmr/' . $title );
				
		exit();
	  }
    }
    
  }
  
  function check_database($password)
  {
    //Field validation succeeded.  Validate against database
    $username = $this->input->post('username');
    
    //query the database
    $result = $this->user->login($username, $password);
    
    if($result)
    {
      $sess_array = array();
      foreach($result as $row)
      {
        $sess_array = array(
          'id' => $row->user_id,
          'user_email' => $row->user_email
        );
        $this->session->set_userdata('logged_in', $sess_array);
      }
      return TRUE;
    }
    else
    {
      $this->form_validation->set_message('check_database', 'Invalid username or password');
      return false;
    }
  }
  
  function log_out(){
	$this->session->sess_destroy();
	$this->index();
  }
}
?>