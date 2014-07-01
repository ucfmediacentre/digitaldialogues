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
    	$query = $this->db->get_where('pages', array('group' =>urldecode($group)));
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
    	$query = $this->db->get_where('pages', array('group' =>urldecode($group)));

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
		$this->db->where('group', urldecode($group));
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
			$sql = $sql . "AND pages.group = '" . urldecode($group) ."' ";
			$sql = $sql . "ORDER BY pages.title";
			
		} else {
			$sql = "SELECT pages.title FROM pages ";
			$sql = $sql . "WHERE pages.group = '" . urldecode($group) ."' ";
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
			$sql = $sql . "AND pages.group = '" . urldecode($group) ."' ";
			$sql = $sql . "ORDER BY pages.title";
			
		} else {
			$sql = "SELECT pages.title FROM pages ";
			$sql = $sql . "WHERE pages.group = '" . urldecode($group) ."' ";
			$sql = $sql . "ORDER BY pages.title";
		}
		
   		$result = $this->db->query($sql);
   		

		$listview = '';
		foreach ($result->result() as $row)
		{
    		$listview = $listview . '<a href="' . base_url("index.php/pages/view/" . urldecode($group) . "/" . $row->title ) . '">' . $row->title . '</a>&nbsp;|&nbsp;';
		}
		return $listview;
	}
	
	// returns a json array of all pages in a specified group
	function get_titles($group)
	{
   		$this->db->select('title');
		$this->db->where('group', urldecode($group));
		$query = $this->db->get('pages');
		$result = $query->result_array();
		return json_encode($result);
	}
	
	// gets the page title of a page with a specified page id
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
	
	// gets the page id of a page with a specified title
	function get_page_id($group, $page)
	{
   		$this->db->where('title', $page);
   		$this->db->where('group', urldecode($group));
   		$this->db->select('id');
   		$query = $this->db->get('pages');
		
		if ($query->num_rows() > 0)
		{
		   $row = $query->row(); 
			return $row->id;
		}else
		{
			return null;
		}
	}
	
	// gets the group details from a specified page id
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
		
		$row = $query->row(); 
		$pageId = $row->pages_id;
		
		$this->db->where('id', $pageId);
   		$this->db->select('title');
   		$query = $this->db->get('pages');
		
		if ($query->num_rows() > 0)
		{
			$row = $query->row(); 
			return $row->title;
		} else {
			return null;
		}
	}
	
	// gets the page title of a page with a specified id
	function get_group_from_element($elementId)
	{
	    
		$this->db->where('id', $elementId);
   		$this->db->select('pages_id');
   		$query = $this->db->get('elements');
		
		$row = $query->row(); 
		$pageId = $row->pages_id;
		
		$this->db->where('id', $pageId);
   		$this->db->select('group');
   		$query = $this->db->get('pages');
		
		if ($query->num_rows() > 0)
		{
			$row = $query->row(); 
			return $row->group;
		} else {
			return null;
		}
	}
	
	// creates a page with a specified title
	public function insert_page($group, $page_title)
	{
   		//$row = array('pages'=>'title','$page_title');
   		$data = array(
   			'group' => urldecode($group),
   			'title' => URLdecode($page_title)
   			);

		$this->db->insert('pages', $data); 
   		
   		return $this->db->insert_id();
	}
	
	// creates a page from a click on the Add: Page link
	public function add_page()
	{
		// first insert user's requirements in to database
		//collect variables from the form
   		$newTitle = $this->input->post('title');
		//$response = "$ newTitle = ".$newTitle."<br />";
   		$author = $this->input->post('author');
		//$response = "$ author = ".$author."<br />";
   		$group = $this->input->post('group');
		//$response = $response."$ group = ".$group."<br />";
   		$currentPageTitle = $this->input->post('currentPageTitle');
		//$response = $response."$ currentPageTitle = ".$currentPageTitle."<br />";
   		$description = $this->input->post('description');
		//$response = $response."$ description = ".$description."<br />";
   		$currentPageId = $this->input->post('currentPageId');
		//$response = $response."$ currentPageId = ".$currentPageId."<br />";
		//echo $response;
	    //exit;
		
		// check to see if this page name already exists
   		$this->db->where('title', $newTitle);
   		$this->db->where('group', urldecode($group));
   		$this->db->select('title');
   		$query = $this->db->get('pages');
		
		if ($query->num_rows() > 0)
		{
			// page already exists so don't insert new page into database
			// just insert links on the right pages
			$page_exists = "TRUE";
		    //return "A page called $title already exists in this group";
		} else {
			
			$data = array(
				'title' => URLdecode($newTitle),
				'description' => $description,
				'group' => urldecode($group)
			);
			
			$this->db->insert('pages', $data); 
			$added_page_id = $this->db->insert_id();
			
		}
			
		// then insert link on the current Page
		// first create the link to the new page
		$data = array(
			'linkTitle' => URLdecode($newTitle),
			'linkTitleGroup' => URLdecode($group),
			'pageTitle' => $currentPageTitle,
			'pageTitleGroup' => URLdecode($group)
		);
		$this->db->insert('links', $data);
		$linkAway_id = $this->db->insert_id();
		
		// now create the link coming back from the new page
		$data = array(
			'linkTitle' => URLdecode($currentPageTitle),
			'linkTitleGroup' => URLdecode($group),
			'pageTitle' => URLdecode($newTitle),
			'pageTitleGroup' => URLdecode($group)
		);
		$this->db->insert('links', $data);
		$linkBack_id = $this->db->insert_id();
		
		//Now create the elements with links in them
		// First the link away element with the correct link id
		$data = array(
			'contents' => "[[" . $linkAway_id . "]]",
			'pages_id' => $currentPageId,
			'type' => "text",
			'x' => rand(200,500),
			'y' => rand(150,400)
		);
		$this->db->insert('elements', $data);
		$elementAway_id = $this->db->insert_id();
		
		// update the elements_id in the links table
		$data = array(
			'elementsId' => $elementAway_id
		);
		$this->db->where('id', $linkAway_id);
		$this->db->update('links', $data);
		
		//Now create the link on the new page back to the original page
		// Then the link back element with the correct link id
		$data = array(
			'contents' => "[[" . $linkBack_id . "]]",
			'pages_id' => $added_page_id,
			'type' => "text",
			'x' => rand(200,500),
			'y' => rand(150,400)
		);
		$this->db->insert('elements', $data);
		$elementBack_id = $this->db->insert_id();
		
		// update the elements_id in the links table
		$data = array(
			'elementsId' => $elementBack_id
		);
		$this->db->where('id', $linkBack_id);
		$this->db->update('links', $data);
		
		//create new record for 'updates' table 
		$data = array(
			'pages_id' => $added_page_id,
			'group' => $group,
			'jsonArray' => json_encode($this->get_page($group, URLdecode($newTitle))),
			'summary' => "New page created: ".URLdecode($newTitle),
			'page' => URLdecode($newTitle),
			'elementInhtml' => "<div style='color: rgb(204, 204, 204); font-size: 15px; font-family: Arial; height: auto; opacity: 1; text-align: center; width: 320px; '>".URLdecode($newTitle)."</div>",
			'username' => $author
		);
		$this->db->insert('updates', $data);
		
		echo 'You have successfully created a page called "' . $newTitle . '"';
			
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
               'group' => URLdecode($group),
               'title' => $title,
               'description' => $description,
               'keywords' => $keywords,
               'public' => $public
            );

		$this->db->where('id', $id);
		$this->db->update('pages', $data);
		
		return "/pages/view/".URLdecode($group)."/".$title;
   }
}