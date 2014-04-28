<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Iframe extends CI_Controller {

	public function index()
	{
		//
	}
	
	//
	public function create($toolName="newText", $pageTitle=NULL, $pageId=NULL, $group="public", $userId="1")
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
	
	
	//
	public function edit($toolName="editText", $elementId=NULL)
	{
	  $this->load->helper('url');
	  $this->load->model('Elements_model');
	  
	  $data['toolName'] = $toolName;
	  $data['elementId'] = $elementId;
	  
	  $elementData = $this->Elements_model->get_element_by_id($elementId);
	  
	  $data['attribution'] = $elementData->attribution;
	  $data['author'] = $elementData->author;
	  $data['backgroundColor'] = $elementData->backgroundColor;
	  $data['color'] = $elementData->color;
	  $data['contents'] = $elementData->contents;
	  $data['created'] = $elementData->created;
	  $data['description'] = $elementData->description;
	  $data['editable'] = $elementData->editable;
	  $data['filename'] = $elementData->filename;
	  $data['fontFamily'] = $elementData->fontFamily;
	  $data['fontSize'] = $elementData->fontSize;
	  $data['height'] = $elementData->height;
	  $data['keywords'] = $elementData->keywords;
	  $data['license'] = $elementData->license;
	  $data['linkPageIds'] = $elementData->linkPageIds;
	  $data['opacity'] = $elementData->opacity;
	  $data['pages_id'] = $elementData->pages_id;
	  $data['textAlign'] = $elementData->textAlign;
	  $data['timeline'] = $elementData->timeline;
	  $data['type'] = $elementData->type;
	  $data['width'] = $elementData->width;
	  $data['x'] = $elementData->x;
	  $data['y'] = $elementData->y;
	  $data['z'] = $elementData->z ;

		
	  $this->load->view('iframes/iframe_header', $data);
	  $this->load->view('iframes/'.$toolName, $data);
	}
}

/* End of file codes.php */
/* Location: ./application/controllers/codes.php */

