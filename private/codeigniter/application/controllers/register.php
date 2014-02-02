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
		  
		  //$user_id=$this->Users_model->new_user($username, $email, $password);
		  
		  //send email to registering user
		  /*$config['protocol'] = 'postfix';
		  $config['mailpath'] = '/usr/sbin/postfix';
		  $config['charset'] = 'iso-8859-1';
		  $config['wordwrap'] = TRUE;*/
		  //$this->load->helper('email', $config);
		  
		  $this->load->library('email');
		  
		  $config['protocol'] = 'postfix';
$config['mailpath'] = '/usr/sbin/postfix';
$config['wordwrap'] = TRUE;

$this->email->initialize($config);

$this->email->from('admin@digitaldialogues.org', 'admin');
$this->email->to('jemmackay@gmail.com');
$this->email->cc('jem@swarmtv.org');
$this->email->bcc('info@jemmackay.co.uk');

$this->email->subject('Email Test');
$this->email->message('Testing the email class.');

$this->email->send();

echo $this->email->print_debugger();
		  
		  //send_email($email, 'Digital Dialogues registration link', 'In order to complete your registration, please click on the following link: <a href="digitaldialogues.org/index.php/register/confirmation/$username/$password">www.digitaldialogues.org/$username</a>');
		  //mail($email, 'Digital Dialogues registration link', 'In order to complete your registration, please click on the following link: <a href="digitaldialogues.org/index.php/register/confirmation/$username/$password">www.digitaldialogues.org/$username</a>');
		  /*$config = Array(
            'protocol' => 'postfix',
            'mailpath' => 'usr/sbin/postfix'
            );
$this->load->library('email', $config);
$this->email->set_newline("\r\n");

//Add file directory if you need to attach a file
//$this->email->attach($file_dir_name);

$this->email->from('admin@digitaldialogues.org', 'Admin');
$this->email->to('jemmackay@gmail.com'); 

$this->email->subject('Email Subject');
$this->email->message('Email Message'); 

if($this->email->send()){
   //Success email Sent
   echo $this->email->print_debugger();
}else{
   //Email Failed To Send
   echo $this->email->print_debugger();
}*/
		  
		  // view registration success page
		  $this->load->view('register_success', $data);
		}
	}
}


/* End of file pages.php */
/* Location: ./application/controllers/pages.php */