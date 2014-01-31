<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
	{
	  parent::__construct();
	}
	
	// setting up a new user in the database
	public function index($controller = null, $group = null, $title = null)
	{
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]|max_length[12]|is_unique[users.user_name]|xss_clean');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.user_email]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconf]|xss_clean');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
		
		if ($controller == null) $controller = $this->input->get('controller');
		if ($title == null) $title = $this->input->get('title');
		if ($group == null) $group = $this->input->get('group');
		  
		$data['controller'] = $controller;
		$data['group'] = $group;
		$data['title'] = $title;

		if ($this->form_validation->run() == FALSE)
		{
		  $this->load->view('register_form', $data);
		}
		else
		{
		  // insert new information into the database
		  $this->load->model('Users_model');
		  
		  $username = $this->input->post('username');
		  $email = $this->input->post('email');
		  $password = $this->input->post('password');
		  
		  $user_id=$this->Users_model->new_user($username, $email, $password);
		  
		  //send email to registering user
		  $this->load->helper('email');
		  send_email('$email', 'Digital Dialogues registration link', 'In order to complete your registration, please click on the following link: <a href="digitaldialogues.org/index.php/register/confirmation/$username/$password">www.digitaldialogues.org/$username</a>');
		  
		  // view registration success page
		  $this->load->view('register_success', $data);
		}
	}
}


/* End of file pages.php */
/* Location: ./application/controllers/pages.php */