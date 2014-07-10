<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Links_model extends CI_Model {

	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
        $this->load->database();
        $this->load->helper('url');
	$this->load->library('Shortcodes');
	
    }
	
	// saves the new links to the database
	function add_links($link_info, $page_title, $element_id)
	{
		$this->load->library('Shortcodes');
		$this->load->model('Pages_model');
		// adds a new key with array to link info
		$link_info['replace'] = array();
		// loop through each link
		for ($i = 0; $i < sizeof($link_info['links']); $i++)
		{
			// compile data
			$page_group = $this->Pages_model->get_group_from_element($element_id);
		
			$data = array(
   				'elementsId' => $element_id,
  				'linkTitle' =>  $link_info['links'][$i][0],
   				'pageTitle' => $page_title,
  				'pageTitleGroup' => $page_group,
  				'linkTitleGroup' => $page_group
			);
			
			// add to the database
			if($this->db->insert('links', $data))
			{
				// assign the new id to the link
				array_push($link_info['replace'], $this->db->insert_id());
			}
		}
		// return info array updated with each link id
		return ($link_info);
	}
	
	// recreates the content with the link ids instead of the page titles 
	function replace_titles_with_insert_ids($link_info)
	{
		// put the first part of the content in
		$content = $link_info['parts'][0];
		
		// loop through the links adding the link id then the next part
		for ($i = 0; $i < sizeof($link_info['links']); $i++)
		{
			$content = $content . $link_info['replace'][$i] . $link_info['parts'][$i+1];
		}
	}
	
	// swaps the link Titles for link ids from the `links` table
	function process_codes($string, $forWhat, $page_title, $element_id)
	{
		//print_r($pages_title);
		//echo "links_model.php<br />";
		
		$this->load->library('Shortcodes');
		$this->load->model('Pages_model');
		// creates an object with all the details about any shortcodes in the specified string
		$linksObj = $this->shortcodes->process_string($string);
		
		$page_group = $this->Pages_model->get_group_from_element($element_id);
		
		// compiles the common data string
		$data = array(
			'elementsId' => $element_id,
			'pageTitle' => $page_title,
			'pageTitleGroup' => $page_group,
			'linkTitleGroup' => $page_group
		);
		
		
		$i=0;
		foreach($linksObj as $link)
        {
				switch ($forWhat){
						case "forDb":
								switch ($link->getKey()) {
										case "internal":
												
												$data["linkTitle"] = $link->getValue();
												
												// adds the link details to the database if the shortcode is a link
												if($this->db->insert('links', $data))
												{
													// replaces the link title with the replacement code
													$this->shortcodes->replaceShortCode($i, "[[internal::".$this->db->insert_id()."]]");
												}
												
												$newPageGroup = $data["linkTitleGroup"];
												$newPageTitle = $data["linkTitle"];
												// create new page at the same time;
												$data = array(
													'group' => urldecode($this->session->userdata('group')),
													'title' => URLdecode($newPageTitle)
													);
										
												$this->db->insert('pages', $data); 
												
												break;
										case "external":
												
												$data["linkTitle"] = $link->getValue();
												// adds the link details to the database if the shortcode is a link
												if($this->db->insert('links', $data))
												{
														// replaces the link title with the replacement code
														$this->shortcodes->replaceShortCode($i, "[[external::".$this->db->insert_id()."]]");
												}
												
												break;
												
								}
								break;
						case "forWeb":
								switch ($link->getKey()) {
										case "internal":
												//echo "$ link->getValue()=".$link->getValue();
												// gets the linkTitle from the stored link id
												$linkDetails = $this->get_link_by_id($link->getValue());
												
												//print_r($linkDetails);
												
												$linkTitle = $linkDetails->linkTitle;
												// replaces the link id with replacement code
												$this->shortcodes->replaceShortCode($i, '<a href="' . $linkTitle . '">' . $linkTitle . '</a>');
												break;
										case "external":
												
												// gets the linkTitle from the stored link id
												$linkDetails = $this->get_link_by_id($link->getValue());
												$linkTitle = $linkDetails->linkTitle;
												//$linkTitle = $link->getValue();
												// replaces the link id with replacement code
												$this->shortcodes->replaceShortCode($i, '<a href="http://' . $linkTitle . '">' . $linkTitle . '</a>');
												break;
										case "bold":
												$this->shortcodes->replaceShortCode($i, '<b><span>' . $link->getValue() . '</span></b>');
												break;
										case "italic":
												$this->shortcodes->replaceShortCode($i, '<i><span>' . $link->getValue() . '</span></i>');
												break;
										case "bold italic":
												$this->shortcodes->replaceShortCode($i, '<b><i><span>' . $link->getValue() . '</span></i></b>');
												break;
										case "left":
												$this->shortcodes->replaceShortCode($i, '<div style="text-align:left">' . $link->getValue() . '</div>');
												break;
										case "centre":
												$this->shortcodes->replaceShortCode($i, '<div style="text-align:center">' . $link->getValue() . '</div>');
												break;
										case "center":
												$this->shortcodes->replaceShortCode($i, '<div style="text-align:center">' . $link->getValue() . '</div>');
												break;
										case "right":
												$this->shortcodes->replaceShortCode($i, '<div style="text-align:right">' . $link->getValue() . '</div>');
												break;
										case "highlight":
												$this->shortcodes->replaceShortCode($i, '<span style="background-color:#ffff66; color:#000";>' . $link->getValue() . '</span>');
												break;
										case "email":
												$this->shortcodes->replaceShortCode($i, '<a href='.chr(39).'mailto:' . $link->getValue() . chr(39).'>'.$link->getValue().'</a>');
												break;
										case "youtube":
												$this->shortcodes->replaceShortCode($i, '<div style="padding:10px;"><iframe width="320" height="300" src="https://www.youtube.com/embed/'.$link->getValue().'" frameborder="0" allowfullscreen></iframe></div>');
												break;
										case "vimeo":
												$this->shortcodes->replaceShortCode($i, '<iframe src="https://player.vimeo.com/video/'.$link->getValue().'" width="320" height="320" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>');
												break;
										case "livestream":
												$this->shortcodes->replaceShortCode($i, '<div style="padding:10px;"><iframe width="320" height="320" src="https://cdn.livestream.com/embed/'.$link->getValue().'?layout=4&amp;height=300&amp;width=320&amp;autoplay=false" style="border:0;outline:0" frameborder="0" scrolling="no"></iframe></div>');
												break;
										case "stream43":
												$this->shortcodes->replaceShortCode($i, '<div style="padding:10px;"><iframe src="'.base_url().'stream/client/live43.html" width="670" height="534" frameborder="0" allowtransparency="true" noresize="noresize" scrolling="no"></iframe></div>');
												break;
										case "webcam":
												$this->shortcodes->replaceShortCode($i, '<div style="padding:10px;"><iframe src="'.base_url().'stream/client/webcamRecorder.html" width="340" height="292" frameborder="0" allowtransparency="true" noresize="noresize" scrolling="no"></iframe></div>');
												break;
										case "stream169":
												$this->shortcodes->replaceShortCode($i, '<div style="padding:10px;"><iframe src="'.base_url().'stream/client/live169.html" width="670" height="414" frameborder="0" allowtransparency="true" noresize="noresize" scrolling="no"></iframe></div>');
												break;
										case "qik":
												$this->shortcodes->replaceShortCode($i, '<div style="padding:10px;"><object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="https://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,115,0" width="144" height="176x" id="qikPlayer" align="middle"><param name="allowScriptAccess" value="sameDomain" /><param name="allowFullScreen" value="true" /><param name="movie" value="https://assets0.qik.com/swfs/qikPlayer5.swf?1364300979" /><param name="quality" value="high" /><param name="bgcolor" value="#000000" /><param name="FlashVars" value="username='.$link->getValue().'" /><embed src="https://assets0.qik.com/swfs/qikPlayer5.swf?1364300979" quality="high" bgcolor="#000000" width="144" height="176" name="qikPlayer" align="middle" allowScriptAccess="sameDomain" allowFullScreen="true" type="application/x-shockwave-flash" pluginspage="https://www.macromedia.com/go/getflashplayer" FlashVars="username='.$link->getValue().'"></embed></object></div>');
												break;
										case "veetle":
												$this->shortcodes->replaceShortCode($i, '<iframe scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:320px; height:240px;" src="https://veetle.com/index.php/widget/index/CF05C791F0E4E3A659900B1D42B8C0ED/f6127861df5b559fbc917a700c9a9981/true/default/false"></iframe>');
												break;
										case "shortcode":
												$this->shortcodes->replaceShortCode($i, '[['.$link->getValue().']]');
												break;
										case "group":
												$linkGroup = $link->getValue();
												// test to see whether the user has access to this group
												// 1. test to see if group is public
												$this->load->model('Groups_model');
												$access = $this->Groups_model->isGroupPublic($linkGroup);
												if ($access == FALSE){
													// 2. test to see if user is included in groups access user_id list
													$this->load->model('Users_model');
													//check session username is not FALSE
													if ($this->session->userdata('username') == FALSE) $this->session->set_userdata('username', "");
													
													$currentUser_id = $this->Users_model->get_userId($this->session->userdata('username'));
													$access = $this->Groups_model->isUserInGroup($currentUser_id, $linkGroup);
													
												}
												
												if ($access == TRUE){
													$this->shortcodes->replaceShortCode($i, '<a href="' . base_url() . 'index.php/pages/view/' . $linkGroup . '/home">' . $linkGroup . ' : Home</a>');
												} else {
													$this->shortcodes->replaceShortCode($i, '<a href="' . base_url() . 'index.php/pages/view/' . $linkGroup . '/home">' . $linkGroup . ' : Home</a>&nbsp;<img src="' . base_url() . 'img/padlock.gif">');
												}
												break;
										case "twitter":
												$this->shortcodes->replaceShortCode($i, '<div style="padding:10px;"><a href="https://twitter.com/' . $link->getValue() . '" class="twitter-follow-button" data-show-count="false">Follow @' . $link->getValue() . '</a></div><script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "twitter-wjs");</script>');
												break;
										case "tweetimage":
												$this->shortcodes->replaceShortCode($i, '<div style="padding:10px;"><img width="437" height="328" title="View image on Twitter" alt="View image on Twitter" data-src-2x="https://pbs.twimg.com/media/' . $link->getValue() . ':large" src="https://pbs.twimg.com/media/' . $link->getValue() . ':large"></div>');
												break;
										case "facebookvideo":
												$this->shortcodes->replaceShortCode($i, '<div style="padding:10px;"><iframe src="https://www.facebook.com/video/embed?video_id=' . $link->getValue() . '" width="568" height="320" frameborder="0"></iframe></div>');
												break;
										case "facebooklike":
												$this->shortcodes->replaceShortCode($i, '<div style="padding:10px;"><iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2F' . $link->getValue() . '&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=true&amp;font&amp;colorscheme=dark&amp;action=like&amp;height=80" scrolling="no" width="450" height="80" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe></div>');
												break;
										
										
										
										
								}
								break;
						case "forEditing":
								switch ($link->getKey()) {
										case "internal":
												// gets the linkTitle from the stored link id
												$linkDetails = $this->get_link_by_id($link->getValue());
												$linkTitle = $linkDetails->linkTitle;
												// replaces the link id with replacement code
												$this->shortcodes->replaceShortCode($i, '[[internal::' . $linkTitle . ']]');
												break;
										case "external":
												// gets the linkTitle from the stored link id
												$linkDetails = $this->get_link_by_id($link->getValue());
												$linkTitle = $linkDetails->linkTitle;
												// replaces the link id with replacement code
												$this->shortcodes->replaceShortCode($i, '[[external::' . $linkTitle . ']]');
												break;
								}
								break;
				}
				$i++;
        }
		
		return ($this->shortcodes->getAdaptedString());
		
	}
	
	// gets all the details from the `links` table with a specific id
	function get_link_by_id($id)
	{
		$query = $this->db->get_where('links', array('id' => $id));
		if ($query->num_rows() > 0)
		{
   			$row = $query->row(); 
   			return $row;
		}else
		{
			return false;
		}	
	}
	
	// outputs all of the links as json
	function get_links()
	{
		$query = $this->db->get('links');
		$results = $query->result_array();
		$results = json_encode($results);
		return $results;
	}
	
	// gets only unique page titles from links
	function get_unique_page_titles()
	{
		$query = $this->db->query('SELECT DISTINCT linkTitle FROM links');
		$results = $query->result_array();
		$results = json_encode($results);
		return $results;
	}
	
	// return all the links for specific page
	function return_links_for_page($page_title)
	{
		$this->db->select('linkTitle');
		$this->db->where('UPPER(pageTitle)', strtoupper($page_title));
		$query = $this->db->get('links');
		$result = $query->result_array();
		return $result;
	}
	
	// deletes the element with specific id from the `links` table
	function delete_links_by_element_id($elements_id)
	{
		$this->db->delete('links', array('elementsId' => $elements_id)); 
		
	}
}
