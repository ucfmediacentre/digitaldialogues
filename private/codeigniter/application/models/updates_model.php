<?php
class Updates_model extends CI_Model {  
    
    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
        $this->load->database();
        $this->load->helper('xml');
    }
    
    // get all postings  
    function getUpdates()  
    {
		$limit = 100;
        $this->db->order_by('pubDate', 'desc');
		return $this->db->get('updates', $limit);  
    }
	
	
	//return all the links from the current RSS feed
	function get_links_from_RSS()
	{

		$this->db->distinct();
		$this->db->select('page AS pagesTitle');
		$this->db->order_by("pubDate", "desc");
		$query = $this->db->get('updates');
		$result = $query->result_array();
		return $result;
	}
	
	//return last update from the current RSS feed
	function get_last_element_update($element_id)
	{
		$this->db->order_by("pubDate", "desc");
		$query = $this->db->get_where('updates', array('elements_id' => $element_id), 1);
		$HTMLInfo = "";
		foreach ($query->result() as $row)
		{
			$HTMLInfo = $row->elementInHtml;
		}
		return $HTMLInfo;
	}

}