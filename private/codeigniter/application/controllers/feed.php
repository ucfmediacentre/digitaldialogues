<?php
class Feed extends CI_Controller {  
    
    public function __construct()
    {
	parent::__construct();
    }
    
    function index()  
    {	
	 
	$this->load->helper('xml');  
	$this->load->helper('text');  
	$this->load->helper('url');
	$this->load->model('Updates_model', 'updates');
	
	
	$group = $this->input->get('group');
	$data['feed_name'] = 'digitaldialogues.org';  
	$data['encoding'] = 'utf-8';  
	$data['feed_url'] = base_url() . "index.php/feed?group=" . $group;  
	$data['page_description'] = 'Digital Dialogues Recent Changes';  
	$data['page_language'] = 'en-en';  
	$data['creator_email'] = 'jemmmackay@gmail.com';  
	$data['updates'] = $this->updates->getUpdates($group);
	
	header("Content-Type: application/rss+xml");
	$this->load->view('rss', $data);  
    }  
}  

