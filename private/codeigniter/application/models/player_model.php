<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages_model extends CI_Model {

    public function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
        $this->load->database();
        $this->load->helper('url');
		
    }

    function get_element($id)
    {
   		$this->db->where('id', $id);
    	$query = $this->db->get('elements');
		if ($query->num_rows() > 0)
		{ 
   			return $query->result_array();
   		}else
   		{
   			return false;
   		}
    }
}