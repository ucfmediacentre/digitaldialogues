<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages_model extends CI_Model {

    //makes sure all functions load the database and url helper
	public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
        $this->load->database();
        $this->load->helper('url');
    }
    
    // returns the whole of the `pages` as an array
	function get_all_pages($group)
    {
    	$query = $this->db->get_where('pages', array('group' =>$group));
		if ($query->num_rows() > 0)
		{ 
   			return $query->result_array();
   		}else
   		{
   			return false;
   		}
    }
    
    // returns all the page names in the site as a list of hyperlinks
	function get_all_page_links($group)
    {
    	$query = $this->db->get_where('pages', array('group' =>$group));

		$listview = '';
		foreach ($query->result() as $row)
		{
    		$listview = $listview . '<a href="' . base_url("pages/view/" . $row->group . "/" . $row->title) . '">' . $row->title . '</a><br />';
		}
		return $listview;
    }
    
   // gets all the details of a specified page
   function get_page($group, $page_name)
   {
		$this->db->where('group', $group);
   		$result = $this->db->get_where('pages', array('title' =>$page_name), 1);
		
		if ($result->num_rows() > 0)
		{ 
   			return $result->row();
   		}else
   		{
   			return false;
   		}
   }
   
   // gets all the pages in an array that have something to do with a specified string
   function get_filtered_pages($group, $string)
   {
		if ($string != "") {
			//build up SQL statement that finds any page title that has something to do with the filtered string, including links!
			$sql = "SELECT DISTINCT pages.title ";
			$sql = $sql . "FROM pages ";
			$sql = $sql . "LEFT JOIN links ";
			$sql = $sql . "ON pages.title=links.pageTitle ";
			$sql = $sql . "LEFT JOIN elements ";
			$sql = $sql . "ON pages.id=elements.pages_id ";
			$sql = $sql . "WHERE (UPPER(elements.description) LIKE '%" . strtoupper($string) ."%' ";
			$sql = $sql . "OR UPPER(elements.contents) LIKE '%" . strtoupper($string) ."%' ";
			$sql = $sql . "OR UPPER(elements.keywords) LIKE '%" . strtoupper($string) ."%' ";
			$sql = $sql . "OR UPPER(links.linkTitle) LIKE '%" . strtoupper($string) ."%' ";
			$sql = $sql . "OR UPPER(pages.description) LIKE '%" . strtoupper($string) ."%' ";
			$sql = $sql . "OR UPPER(pages.keywords) LIKE '%" . strtoupper($string) ."%' ";
			$sql = $sql . "OR UPPER(pages.title) LIKE '%" . strtoupper($string) ."%') ";
			$sql = $sql . "AND pages.group = '" . $group ."' ";
			$sql = $sql . "ORDER BY pages.title";
			
		} else {
			$sql = "SELECT pages.title FROM pages ";
			$sql = $sql . "WHERE pages.group = '" . $group ."' ";
			$sql = $sql . "ORDER BY pages.title";
		}
		
   		$result = $this->db->query($sql);
   		
   		if ($result->num_rows() > 0)
		{ 
   			return $result->result_array();
   		}else
   		{
   			return false;
   		}
   }
   
   // gets all the pages in an array that have something to do with a specified string
   function get_filtered_list($group, $string)
   {
		if ($string != "") {
			//build up SQL statement that finds any page title that has something to do with the filtered string, including links!
			$sql = "SELECT DISTINCT pages.title ";
			$sql = $sql . "FROM pages ";
			$sql = $sql . "LEFT JOIN links ";
			$sql = $sql . "ON pages.title=links.pageTitle ";
			$sql = $sql . "LEFT JOIN elements ";
			$sql = $sql . "ON pages.id=elements.pages_id ";
			$sql = $sql . "WHERE (UPPER(elements.description) LIKE '%" . strtoupper($string) ."%' ";
			$sql = $sql . "OR UPPER(elements.contents) LIKE '%" . strtoupper($string) ."%' ";
			$sql = $sql . "OR UPPER(elements.keywords) LIKE '%" . strtoupper($string) ."%' ";
			$sql = $sql . "OR UPPER(links.linkTitle) LIKE '%" . strtoupper($string) ."%' ";
			$sql = $sql . "OR UPPER(pages.description) LIKE '%" . strtoupper($string) ."%' ";
			$sql = $sql . "OR UPPER(pages.keywords) LIKE '%" . strtoupper($string) ."%' ";
			$sql = $sql . "OR UPPER(pages.title) LIKE '%" . strtoupper($string) ."%') ";
			$sql = $sql . "AND pages.group = '" . $group ."' ";
			$sql = $sql . "ORDER BY pages.title";
			
		} else {
			$sql = "SELECT pages.title FROM pages ";
			$sql = $sql . "WHERE pages.group = '" . $group ."' ";
			$sql = $sql . "ORDER BY pages.title";
		}
		
   		$result = $this->db->query($sql);
   		

		$listview = '';
		foreach ($result->result() as $row)
		{
    		$listview = $listview . '<a href="' . base_url("index.php/pages/view/" . $group . "/" . $row->title ) . '">' . $row->title . '</a>&nbsp;|&nbsp;';
		}
		return $listview;
   }
   
   // returns a json array of all details to do with a specified page
   function get_titles($group)
   {
   		$this->db->select('title');
		$this->db->where('group', $group);
		$query = $this->db->get('pages');
		$result = $query->result_array();
		return json_encode($result);
   }
   
   // gets the page title of a page with a specified id
   function get_title($id)
   {
   		$this->db->where('id', $id);
   		$this->db->select('title');
   		$query = $this->db->get('pages');
		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
			return $row->title;
		}else
		{
			return null;
		}
   }
   
   // gets the page title of a page with a specified id
   function get_group($id)
   {
   		$this->db->where('id', $id);
   		$this->db->select('group');
   		$query = $this->db->get('pages');
		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
			return $row->group;
		}else
		{
			return null;
		}
   }
   
   // gets the page title of a page with a specified id
   function get_page_from_element($elementId)
   {
   		$this->db->where('id', $elementId);
   		$this->db->select('pages_id');
   		$query = $this->db->get('elements');
		
		if ($query->num_rows() > 0)
		{
			$row = $query->row(); 
			$pageId = $row->pages_id;
		} else
		{
			return null;
		}
		
   		$this->db->where('id', $pageId);
   		$this->db->select('title');
   		$query = $this->db->get('pages');
		
		if ($query->num_rows() > 0)
		{
			$row = $query->row(); 
			return $row->title;
		} else
		{
			return null;
		}
		
   }
   
   // creates a page with a specified title
   public function insert_page($group, $page_title)
   {
   		//$row = array('pages'=>'title','$page_title');
   		$data = array(
   			'group' => $group,
   			'title' => URLdecode($page_title)
   			);

		$this->db->insert('pages', $data); 
   		
   		return $this->db->insert_id();
   }
   
   // updates page_info in the `pages` table & returns "1" if successful
   public function update()
   {
	
   		$id = $this->input->post('id');
   		$group = $this->input->post('group');
   		$title = $this->input->post('title');
   		$description = $this->input->post('description');
   		$keywords = $this->input->post('keywords');
   		$public = $this->input->post('public');
   		
	   	$data = array(
               'group' => $group,
               'title' => $title,
               'description' => $description,
               'keywords' => $keywords,
               'public' => $public
            );

		$this->db->where('id', $id);
		$this->db->update('pages', $data);
		
		return "/pages/view/".$group."/".$title;
   }
}