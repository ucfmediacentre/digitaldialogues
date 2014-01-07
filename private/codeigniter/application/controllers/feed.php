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
	
	$data['feed_name'] = 'ucfmediacentre.co.uk/swarmtv';  
	$data['encoding'] = 'utf-8';  
	$data['feed_url'] = base_url() . "index.php/feed";  
	$data['page_description'] = 'Swarm TV Recent Changes';  
	$data['page_language'] = 'en-en';  
	$data['creator_email'] = 'ucfmediacentre.co.uk@gmail.com';  
	$data['updates'] = $this->updates->getUpdates();
	
	header("Content-Type: application/rss+xml");
	$this->load->view('rss', $data);  
    }  
}  

