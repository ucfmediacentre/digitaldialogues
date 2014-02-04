<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Register extends CI_Controller

{
	public

	function __construct()
	{
		parent::__construct();
	}

	// setting up a new user in the database
	public function index($controller = null, $group = null, $title = null)
	{
		$this->load->helper(array(
			'form',
			'url'
		));
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
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('register_form', $data);
		}
		else {

			// insert new information into the database

			$this->load->model('Users_model');
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');

			$user_vericode=$this->Users_model->new_user_vericode($username, $email, $password);

			$this->load->library('email');
			$this->email->from('admin@digitaldialogues.org', 'Admin');
			$this->email->to($email);
			$this->email->subject('Digital Dialogues verification link');
			$message = '<html><body>In order to verify your registration for Digital Dialogues, please click on the following link: <a href="http://www.digitaldialogues.org/index.php/register/confirmation/' . $user_vericode . '">digitalDialogues.org/' . $user_vericode . '</a></body></html>';
			$this->email->message($message);
			$this->email->send();

			// view registration success page
			$this->load->view('register_success', $data);
		}
	}
	
	
	// setting up a new user in the database
	public function confirmation($user_vericode)
	{
		$this->load->database();
		$this->db->where('verification_code', $user_vericode);
		$data['Active_status'] = 1;
		$this->db->update('users', $data);

	}
}

/* End of file pages.php */
/* Location: ./application/controllers/pages.php */

