<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Iframe extends CI_Controller {

	public function index()
	{
		//
	}
	
	//
	public function view($toolName="newText", $pageTitle=NULL, $pageId=NULL, $group="public", $userId="1")
	{
	  $this->load->helper('url');
	  
	  $data['toolName'] = $toolName;
	  $data['pageTitle'] = $pageTitle;
	  $data['pageId'] = $pageId;
	  $data['group'] = $group;
	  $data['userId'] = $userId;
		
	  $this->load->view('iframes/iframe_header', $data);
	  $this->load->view('iframes/'.$toolName, $data);
	}
}

/* End of file codes.php */
/* Location: ./application/controllers/codes.php */

