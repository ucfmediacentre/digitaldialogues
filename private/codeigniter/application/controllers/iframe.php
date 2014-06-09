<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Iframe extends CI_Controller {

	public function index()
	{
		//
	}
	
	//
	public function create($toolName="newText", $pageTitle=NULL, $pageId=NULL, $group="community", $userId="1")
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
	public function edit($toolName="textEditor", $elementId=NULL)
	{
	  $this->load->helper('url');
	  $this->load->model('Elements_model');
	  
	  $urlString = $_SERVER['HTTP_REFERER'];
	  //echo "$ urlString = ".$urlString."<br />";
	  $urlParameters = explode('/', $urlString);
	  //print_r("$ urlParameters = ".$urlParameters."<br />");
	  $numOfParas = count($urlParameters);
	  //echo "$ numOfParas = ".$numOfParas."<br />";
	  $baseUrlParams = explode('/', base_url());
	  //print_r("$ baseUrlParams = ".$baseUrlParams."<br />");
	  $numOfBaseUrlParas = count($baseUrlParams);
	  //echo "$ numOfBaseUrlParas = ".$numOfBaseUrlParas."<br />";
	  $groupName = $urlParameters[$numOfBaseUrlParas+2];
	  //echo "$ groupName = ".$groupName."<br />";
	  $pageName = $urlParameters[$numOfBaseUrlParas+3];
	  //echo "$ pageName = ".$pageName."<br />";
	  
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
	  $data['groupName'] = "$groupName";
	  $data['height'] = $elementData->height;
	  $data['keywords'] = $elementData->keywords;
	  $data['license'] = $elementData->license;
	  $data['linkPageIds'] = $elementData->linkPageIds;
	  $data['opacity'] = $elementData->opacity;
	  $data['pages_id'] = $elementData->pages_id;
	  $data['pageName'] = "$pageName";
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
	
	// prepares a copy of an element in the `element` table and creates a new update in the `updates` table
	public function copyText($elementId=NULL)
	{
	  
	  $this->load->helper('url');
	  $this->load->model('Elements_model');
	  $this->load->model('Groups_model');
	  $this->load->model('Pages_model');
	  
	  $post_data = $this->input->post(NULL, TRUE); // return all post data filtered XSS - SCRIPT SAFE
	  
	  $groups_list= $this->Groups_model->list_all();
	  
	  $i = 0;
	  $groupsString = "";
	  
	  foreach ($groups_list as $group) {
		
		$pagesString = "";
		
		// print each group title as an selectable option 
		$groupsString =  $groupsString .'<option id="'.$i.'" value="'.$groups_list[$i]['id'].'" ';
		if (strtoupper($groups_list[$i]['title']) == strtoupper($post_data['groupName'])) {
		  // select the current group as default
		  $groupsString =  $groupsString .'selected';
		}
		$groupsString =  $groupsString.'>'.$groups_list[$i]['title'].'</option>';
		
		//get all pages from each group
		$pages_list = $this->Pages_model->get_all_pages($groups_list[$i]['title']);
		$j = 0;
		
		foreach ($pages_list as $page) {
		  $pagesString = $pagesString.'<option value="'.$pages_list[$j]['id'].'" ';
		  if ($pages_list[$j]['id'] == $post_data['pages_id']) {
			// select the current group as default
			$pagesString = $pagesString.'selected';
		  }
		  $pagesString = $pagesString.'>'.$pages_list[$j]['title'].'</option>';
		  
		  $j++;
		}
		
		//save each pages option string for each group
		$groups_list[$i]['pages'] = $pagesString;
		$data['groupString'] = $groupsString;
		
		$i++;
	  }
	  
	  $data['elementId'] = $elementId;
	  $data['groupsList'] = $groups_list;
	  
	  //$data['attribution'] = $post_data['attribution'];
	  //$data['author'] = $post_data['author'];
	  $data['backgroundColor'] = $post_data['backgroundColor'];
	  $data['color'] = $post_data['color'];
	  $data['contents'] = $post_data['contents'];
	  //$data['created'] = $post_data['created'];
	  //$data['description'] = $post_data['description'];
	  //$data['editable'] = $post_data['editable'];
	  //$data['filename'] = $post_data['filename'];
	  $data['fontFamily'] = $post_data['fontFamily'];
	  $data['fontSize'] = $post_data['fontSize'];
	  $data['groupName'] = $post_data['groupName'];
	  $data['height'] = $post_data['height'];
	  //$data['keywords'] = $post_data['keywords'];
	  //$data['license'] = $post_data['license'];
	  //$data['linkPageIds'] = $post_data['linkPageIds'];
	  $data['opacity'] = $post_data['opacity'];
	  $data['pages_id'] = $post_data['pages_id'];
	  $data['pageName'] = $post_data['pageName'];
	  $data['textAlign'] = $post_data['textAlign'];
	  //$data['timeline'] = $post_data['timeline'];
	  //$data['type'] = $post_data['type'];
	  $data['width'] = $post_data['width'];
	  $data['x'] = $post_data['x'];
	  $data['y'] = $post_data['y'];
	  //$data['z'] = $post_data['z'];
	  //print_r($data);

		
	  $this->load->view('iframes/iframe_header', $data);
	  $this->load->view('iframes/copyText', $data);
	}
}

/* End of file codes.php */
/* Location: ./application/controllers/codes.php */

