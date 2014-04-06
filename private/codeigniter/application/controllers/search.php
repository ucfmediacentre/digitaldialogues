<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	public function index($group="public")
	{
		$this->load->helper('url');
		redirect('/search/map/'.$group, 'location');	
	}

	public function map($group)
	{
		$this->load->model('Links_model');
		$this->load->model('Pages_model');
		$this->load->model('Updates_model');
		$filter = $this->input->get('filter');
		
		// get pages that have something to do with the filter specified
		$pages = $this->Pages_model->get_filtered_pages(urldecode($group), $filter);
		$listview = $this->Pages_model->get_filtered_list(urldecode($group), $filter);


		if ($pages === false) {
			//if none are found, then retrieve all the pages
			$filter = "";
			$pages = array();
			$numberOfResults= 0;
		}
		
		$numberOfResults= count($pages);
		if ($numberOfResults===1){
			$data['searchResults'] = $numberOfResults." page found";
		} else {
			$data['searchResults'] = $numberOfResults." pages found";
		}		
		
		for ($i = 0; $i < sizeof($pages); $i++) {
			//create a list of links that come from these pages
			$linked_pages = $this->Links_model->return_links_for_page($pages[$i]['title']);
			
			$pages[$i]['link_tree'] = $linked_pages;
			
		}
		
		//add in Recent Changes
		$pages = json_encode($pages);
		$data['links'] = $pages;
		$data['filter'] = $filter;
		$data['group'] = urldecode($group);
		$data['listview'] = $listview;
		
		$this->load->view('search_home', $data);
	}
	
	public function stats()
	{
		//$this->load->view('welcome_message');
		
	}
}