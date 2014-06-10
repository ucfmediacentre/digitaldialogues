<?php
class RecentChanges extends CI_Controller {  
    
    public function __construct()
    {
	parent::__construct();
    }
    
    function index()  
    {
		$this->load->helper('url');
		$this->load->library('simplepie');
		
		//Set up simplepie
		$data['group'] = $this->input->get('group');
		$feedUrl = "https://digitaldialogues.org/index.php/feed?group=community";
		//$feedUrl = base_url().'index.php/feed?group=' . $data['group'];
		$this->simplepie->set_feed_url($feedUrl);
		$this->simplepie->set_cache_location('/var/public_html/rss/cache');
		$this->simplepie->set_cache_duration(60);
		$this->simplepie->init();
		$this->simplepie->handle_content_type();
		$data['res_feed'] = $this->simplepie->get_items(0,5);
		$data['searchResults'] = $this->simplepie->get_items();

		
		//pass data into rssInHtml.php
		$this->load->view('rssInHtml', $data);
		
	}

}  