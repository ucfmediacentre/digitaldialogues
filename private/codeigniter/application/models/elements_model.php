<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elements_model extends CI_Model {

	var $file_errors = null;
	var $data_errors = null;
	var $file = false;				// is a file present on the server?
	var $valid_file = false;
	
	var $current_mime_type_index = -1;
	var $excepted_mime_types = array 	(
										array('image/jpeg;'	, 'image'),
										array('image/png;'	, 'image'),
										array('image/gif;'	, 'image'),
										array('image/jpg;'	, 'image'),
										array('audio/mpeg;'	, 'audio'),
										array('audio/x-wav;', 'audio'),
										array('audio/wav;'	, 'audio'),
										array('video/mp4;' 	, 'video')
										);
										
	var $data = array();
	
	function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        
        $this->load->database();
        $this->load->helper('url');
        
        $config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';

		$this->load->library('upload', $config);
    }
    
    // gets all of the elements for a specific page
    function get_all_elements($page_id)
    {
		$this->load->model('Pages_model');
    	$query = $this->db->get_where('elements', array('pages_id' => $page_id));
    	
    	// loop through each element and update the description
    	$elements = $query->result_array();
    	
    	for ($i = 0; $i < sizeof($elements); $i++)
    	{	
			$contents = $elements[$i]['contents'];
            $pages_id = $elements[$i]['pages_id'];
            $pages_title = $this->Pages_model->get_title($pages_id);
            $elements_id = $elements[$i]['id'];
            $dbContents = $elements[$i]['contents'];

			// piece the contents back together with the html links embedded
            $processed_contents = $this->Links_model->process_codes($contents, "forWeb", $pages_title, $elements_id);
        
            $editable_contents = $this->Links_model->process_codes($dbContents, "forEditing", $pages_title, $elements_id);
            
			//update the description
			$elements[$i]['contents'] = $processed_contents;
            $elements[$i]['editableContents'] = $editable_contents;
    	}
    	return $elements;
    }
    
    // gets a specific element by its id
    function get_element_by_id($id)
    {
    	$this->db->where('id', $id);
    	$query = $this->db->get('elements');
    	return $query->row();
    }

	// validates the file using magic-bytes
	function validate_file()
	{
		$file = $_FILES['file'];
		
		// Check there was no errors with the upload
		if ($file['error'] > 0) 
		{
			$this->file_errors = "There was an error uploading the file!";
			return false;
			exit;
		}
	
		// interesting article on magicbytes here: 
		// http://designshack.net/articles/php-articles/smart-file-type-detection-using-php/
		// Get the file mime type
		$file_info = new finfo(FILEINFO_MIME);  
		$mime_type_string = $file_info->buffer(file_get_contents($file['tmp_name']));
		$mime_type_parts = explode(' ', $mime_type_string);
		
		$file_mime_type = $mime_type_parts[0]; 
		
		// check mime type against a list of excepted mime types
		foreach($this->excepted_mime_types as  $index => $type) 
        { 
            if (in_array($file_mime_type, $type))
            {
            	$this->current_mime_type_index = $index;
            	break;
            }
        } 
		
		// send error if the file does not validate
		if ($this->current_mime_type_index < 0) 
		{
			$this->file_errors = "This file type is not allowed! - " . $file_mime_type;
			return false;
			exit;
		}
		return true;			// the file validates
	}
	
	
    // places the uploaded file into the correct directory
    function move_file()
	{	 
		// Consider creating a folder every new month so that elements are easier to find? 
		// construct the location from the data
		$folder_from_mime_type = $this->excepted_mime_types[$this->current_mime_type_index][1];  // image / audio / video folder
		$uploads_dir = base_url() . 'assets/' . $folder_from_mime_type . '/';
		
		$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		$unique_name = $folder_from_mime_type . '-' . uniqid();
		
		$full_name = $unique_name . '.' . $extension;
		
		$this->data['filename'] = $full_name;
		$this->data['type'] = $folder_from_mime_type;
		$success = move_uploaded_file($_FILES['file']['tmp_name'], 'assets/' . $folder_from_mime_type . '/' . $full_name);
        
        switch ($folder_from_mime_type) {
            case 'image':
                //get proportions of image uploaded
                $size = getimagesize('assets/image/' . $full_name);
                $ratio = $size[0]/$size[1];
                $this->data['width'] = '320';
                $this->data['height'] = 320/$ratio;
                break;
            case 'audio':
                //create OGA version
                //Jem's URL
                //$createOgvVersion = "/usr/local/bin/ffmpeg2theora ~/Sites/digitaldialogues/www/assets/audio/".$full_name;
                 
                //Public server's URL
                $createOgvVersion = "/usr/local/bin/ffmpeg2theora /var/www/assets/audio/".$full_name;
                
                $execute = shell_exec($createOgvVersion);
                $renameOgvToOga = "mv /var/www/assets/audio/".$unique_name.".ogv /var/www/assets/audio/".$unique_name.".oga";
                $execute = shell_exec($renameOgvToOga);
                break;
            case 'video':
                //create OGV version
                //Jem's URL
                //$createOgvVersion = "/usr/local/bin/ffmpeg2theora ~/Sites/digitaldialogues/www/assets/video/".$full_name;
                 
                //Public server's URL
                $createOgvVersion = "/usr/local/bin/ffmpeg2theora /var/www/assets/video/".$full_name;
                
                $execute = shell_exec($createOgvVersion);
                
                //set string variables for ffmpeg string
                $filename = $full_name;
                $filename = substr($filename, 0, -4);
                //Jem's URLs
                //$videoDirectory = "/Users/media/Sites/digitaldialogues/www/assets/video/";
                //$videopostersDirectory = "/Users/media/Sites/digitaldialogues/www/assets/videoposters/";
                
                //Public server URLs
                $videoDirectory = "/var/www/assets/video/";
                $videopostersDirectory = "/var/www/assets/videoposters/";
                $sizeString = "";
                
                //get width & height from the file
                $movieDetails = "/usr/bin/ffmpeg -i " . $videoDirectory . $filename . ".mp4 -vstats 2>&1";
                $output = shell_exec ( $movieDetails );
                $result = preg_match( '/ [0-9]+x[0-9]+[, ]/', $output, $matches );
                if (isset ( $matches[0] )) {  
                    $vals = (explode ( 'x', $matches[0] ));  
                    $width = $vals[0] ? trim($vals[0]) : null;  
                    $height = $vals[1] ? trim($vals[1]) : null;   
                    $this->data['width'] = $width;  
                    $this->data['height'] = $height;
                    
                    //create size string of thumbnail in original ratio
                    $widthString = intval((115*$width)/$height);
                    $sizeString = $widthString."x115";
                }
                
                if ($sizeString == "x115") $sizeString = "200x115";
                
                //create first frame jpg and put it in "assets/videoposters"
                $createFirstFrame = "/usr/bin/ffmpeg -i " . $videoDirectory . $filename . ".mp4";
                $createFirstFrame = $createFirstFrame . " -vframes 1 -an -s ".$sizeString." -ss 1 ";
                $createFirstFrame = $createFirstFrame . $videopostersDirectory . $filename . ".jpg";
                $execute = shell_exec($createFirstFrame);
                
                //get duration as well
                $result = preg_match('/Duration: (.*?),/', $output, $matches);
				$hours = 0;
				$mins = 0;
				$secs = 0;
                if (isset ( $matches[0] )) {  
                    $vals = (explode ( ':', $matches[1] ));  
                    $hours = $vals[0] ? trim($vals[0]) : 0;  
                    $mins = $vals[1] ? $vals[1] : 0;   
                    $secs = $vals[2] ? $vals[2] : 0;
                }
                $duration = ($hours * 3600) + ($mins * 60) + $secs;
                
                //create JSON string for timeline field
                $timeline = array(
                    "in" => 0,
                    "out" => $duration,
                    "duration" => $duration
                );
                $timelineJSON = json_encode($timeline);
                $this->data['timeline']=$timelineJSON;
                
                //by default the description will be the filename on the server
                $this->data['description']=$filename;
                
                break;
        }
		
		if ($success){
			$file = true;
		}else
		{
			$this->file_errors = "An error occurred when moving the file on the server!";
			return false;
			exit;
		} 
		return true;
	}
	
	public function add_recording($group = "public", $page = "sandpit", $media = "videoaudio")
	{
		// Consider creating a folder every new month so that elements are easier to find? 
		// construct the location from the data
		
		// prepare ffmpeg command string
		switch ($media) {
			case "video":
				//set the folder to video
				$folder = "video";
				$extension = "mp4";
				break;
			case "audio":
				// set the folder to audio
				$folder = "audio";
				$extension = "mp3";
				break;
			case "videoaudio":
				//set the folder to video
				$folder = "video";
				$extension = "mp4";
				break;
		}
		
		$uploads_dir = '/var/www/assets/' . $folder . '/';
		$unique_name = $folder . '-' . uniqid();
		$full_name = $unique_name . '.' . $extension;
		
		$this->data['filename'] = $full_name;
		$this->data['type'] = $folder;
		
		// create ffmpeg command string
		switch ($media) {
			case "video":
			case "audio":
				// specify either video OR audio recording
				$copyCommand = "/usr/bin/ffmpeg -i /usr/local/WowzaStreamingEngine/content/webcamrecording.flv " . $uploads_dir . $full_name;
				break;
			case "videoaudio":
				// specify video and audio recording
				$copyCommand = "/usr/bin/ffmpeg -async 1 -i /usr/local/WowzaStreamingEngine/content/webcamrecording.flv " . $uploads_dir . $full_name;
				//$convert2MP4 = "/usr/bin/ffmpeg -i /usr/local/red5/webapps/oflaDemo/streams/webcamrecording.flv -itsoffset 0.75 -map 0:0 -map 0:1 -acodec libmp3lame " . $uploads_dir . $full_name;
				//$success = shell_exec($convert2MP4);
				break;
		}
		$success = shell_exec($copyCommand);
		
		//set string variables for ffmpeg string
		$filename = $full_name;
		$filename = substr($filename, 0, -4);
        
        //create OGV version
		switch ($media) {
			case "audio":
                $createOggVersion = "/usr/local/bin/ffmpeg2theora /var/www/assets/audio/".$full_name;
                $execute = shell_exec($createOggVersion);
                $renameOgvToOga = "mv /var/www/assets/audio/".$unique_name.".ogv /var/www/assets/audio/".$unique_name.".oga";
                $execute = shell_exec($renameOgvToOga);
				$createOggVersion = "/usr/local/bin/ffmpeg2theora /var/www/assets/video/".$unique_name . ".mp4 -o /var/www/assets/video/".$unique_name . ".ogv";
				break;
			case "video":
			case "videoaudio":
				$createOggVersion = "/usr/local/bin/ffmpeg2theora /var/www/assets/video/".$unique_name . ".mp4 -o /var/www/assets/video/".$unique_name . ".ogv";
				$execute = shell_exec($createOggVersion);
				
				
				$videoDirectory = "/var/www/assets/video/";
				$videopostersDirectory = "/var/www/assets/videoposters/";
				$sizeString = "";
				
				//get width & height from the file
				$movieDetails = "/usr/bin/ffmpeg -i " . $videoDirectory . $filename . ".mp4 -vstats 2>&1";
				$output = shell_exec ( $movieDetails );
				$result = preg_match( '/ [0-9]+x[0-9]+[, ]/', $output, $matches );
				if (isset ( $matches[0] )) {  
					$vals = (explode ( 'x', $matches[0] ));  
					$width = $vals[0] ? trim($vals[0]) : null;  
					$height = $vals[1] ? trim($vals[1]) : null;   
					$this->data['width'] = $width;  
					$this->data['height'] = $height;
					
					//create size string of thumbnail in original ratio
					$widthString = intval((115*$width)/$height);
					$sizeString = $widthString."x115";
				}
				
				if ($sizeString == "x115") $sizeString = "200x115";
				
				//create first frame jpg and put it in "assets/videoposters"
				$createFirstFrame = "/usr/bin/ffmpeg -i " . $videoDirectory . $filename . ".mp4";
				$createFirstFrame = $createFirstFrame . " -vframes 1 -an -s ".$sizeString." -ss 1 ";
				$createFirstFrame = $createFirstFrame . $videopostersDirectory . $filename . ".jpg";
				$execute = shell_exec($createFirstFrame);
				
				//get duration as well
				$result = preg_match('/Duration: (.*?),/', $output, $matches);
				$hours = 0;
				$mins = 0;
				$secs = 0;
				if (isset ( $matches[0] )) {  
					$vals = (explode ( ':', $matches[1] ));  
					$hours = $vals[0] ? trim($vals[0]) : 0;  
					$mins = $vals[1] ? $vals[1] : 0;   
					$secs = $vals[2] ? $vals[2] : 0;
				}
				$duration = ($hours * 3600) + ($mins * 60) + $secs;
				
				//create JSON string for timeline field
				$timeline = array(
					"in" => 0,
					"out" => $duration,
					"duration" => $duration
				);
				$timelineJSON = json_encode($timeline);
				$this->data['timeline']=$timelineJSON;
				break;
		}
		
		
		//by default the description will be the filename on the server
		$this->data['description']=$filename;
		
		// load up all other variables needed
		$this->data['author']= $this->session->userdata('username');
		$this->data['filename'] = $filename . "." . $extension;
		$this->data['pages_id']= $this->Pages_model->get_page_id(urldecode($group), urldecode($page));
		$this->data['x']= intval(rand(200,500));
		$this->data['y']= intval(rand(150,400));
		
		//load new video element into elements database
		$this->db->insert('elements', $this->data);
		
		//return the new element id 
		return $this->db->insert_id();
	}
	
	
	// checks how the fancy box was used and load up the data array for future use
	function validate_element_data()
	{
        /* backgroundColor, color, content, filename, fontFamily, fontSize, height, width, timeline, 
	opacity, attribution, description, keywords, license, pages_id, textAlign, type, x, y, z*/
		// Check the basic data - then filter the rest later
		// filter main text
		$post_data = $this->input->post(NULL, TRUE); // return all post data filtered XSS - SCRIPT SAFE
        
        //if the description was used (i.e. not a text element)...
		if (array_key_exists('description', $post_data))
		{
			$description = $post_data['description'];
            //$description = htmlspecialchars($description, ENT_QUOTES); Do we need this?
            $description = str_replace ("\n", "<br>", $description );
            if ($description !== " " && $description !== "") {
                $this->data['description'] = $description;
            }
		}
		
        //if the contents was used (i.e. a text element)..
		if (array_key_exists('contents', $post_data))
		{
			$contents = $post_data['contents'];
			$colour = $post_data['color'];
            //$contents = htmlspecialchars($contents, ENT_QUOTES); Do we need this?
            $contents = str_replace ("\n", "<br>", $contents );
			
			$this->data['contents'] = $contents;
			$this->data['color'] = $colour;
			$this->data['type'] = 'text';
		}
		
        // if the contents was used (i.e. a text element)..
		if (array_key_exists('author', $post_data))
		{
			$author = $post_data['author'];
			$editable = $post_data['editable'];
			$this->data['author'] = $author;
			$this->data['editable'] = $editable;
		}
		
		// check pages_id
		if (array_key_exists('pages_id', $post_data))
		{	
			$pages_id = $post_data['pages_id'];
			$this->data['pages_id'] = $pages_id;
		}else
		{
			// should probably check to see if a page exist with this id as well?
			$this->data_errors = "There was no page assigned to the element!";
			return false;
			exit;
		}
		
		if (array_key_exists('x', $post_data) && array_key_exists('y', $post_data))
		{
			$x = $post_data['x'];
			$y = $post_data['y'];
			
			// check x and y are integers
			if (filter_var($x, FILTER_VALIDATE_INT) && filter_var($x, FILTER_VALIDATE_INT))
			{
				$this->data['x'] = $x;
				$this->data['y'] = $y;
			}else
			{
				$this->data_errors = "Position values are incorrect!";
				return false;
				exit;
			}
		}
		
		return true;
	}
	
	// inserts element into the database
    function add_element_to_database()
	{
		if (!$this->db->insert('elements', $this->data))
		{
			// should probably check to see if a page exist with this id as well?
			$this->data_errors = "There was an error adding this element to the database";
			//delete file if there was one?
			// *** IMPORTANT *** 
			if ($file) remove_orthan_file();
			return false;
			exit;
		} 
		
		//return the new element id 
		return $this->db->insert_id();
		
	}
	
	// updates the database with the new description
    function update_description($id, $description)
	{
		$data = array( 'description' => $description);

		$this->db->where('id', $id);
		$this->db->update('elements', $data); 
		
	}
	
	// constructs the data for the update
    function create_update($action, $elements_id)
	{   
        //get element data from elements_id provided
		$this->load->model('Elements_model');
		$this->load->model('Updates_model');
        $this->load->model('Links_model');
        $this->load->model('Pages_model');
        $lastUpdate = $this->Updates_model->get_last_element_update($elements_id);
        
		$element = $this->get_element_by_id($elements_id);
        
        $justName = substr(($element->filename), 0,strrpos(($element->filename),'.'));
        
        $pages_title = $this->Pages_model->get_title($element->pages_id);
        $pages_group = $this->Pages_model->get_group($element->pages_id);
        switch ($element->type) {
                    case 'text':
                        //sets description as the element displayed and then json array
                        //restores links in content
                        $processed_contents = $this->Links_model->process_codes($element->contents, "forEditing", $pages_title, $elements_id);
                        
                        $elementInHtml = '<div style="color: rgb(204, 204, 204); font-size: '.$element->fontSize.'px; font-family: Arial; height: auto; opacity: 1; text-align: center; width: '.$element->width.'px; ">'.$processed_contents.'</div>';
                        $jsonArray = json_encode($element);
                        break;
                    case 'image':
                        $elementInHtml = '<div style="height: '.$element->height.'px; width: '.$element->width.'px;"><img width="'.$element->width.'px" height="'.$element->height.'px" src="' . base_url() . 'assets/image/'.$element->filename.'"></div>';
                        $jasonArray = json_encode($element);
                        break;
                    case 'audio':
                        $elementInHtml = '<audio style="width:320px" controls tabindex="0"><source type="audio/mpeg" src="' . base_url() . 'assets/audio/'.$justName.'.mp3"></source><source type="audio/ogg" src="' . base_url() . 'assets/audio/'.$justName.'.oga"></source></audio>';
+                       $jasonArray = json_encode($element);
                        break;
                    case 'video':
                        $elementInHtml = '<video controls tabindex="0"><source type="video/mp4" src="' . base_url() . 'assets/video/'.$justName.'.mp4"></source><source type="video/webm" src="' . base_url() . 'assets/video/'.$justName.'.webm"></source><source type="video/ogg" src="' . base_url() . 'assets/video/'.$justName.'.ogv"></source></video>';
                        $jasonArray = json_encode($element);
                        break;
		}
        
        // checks to see if the same entry has already been inserted into the updates table
        if($lastUpdate === $elementInHtml) {
            // Its the same!
        } else {
            $this->load->model('Pages_model');
            $pages_title = $this->Pages_model->get_title($element->pages_id);
            
            //create array to insert into updates table
            $updates_data = array(
                'page' => $pages_title,
                'group' => $pages_group,
                'summary' =>  $element->type . " " . $action,
                'elementInHtml' => $elementInHtml,
                'jsonArray' => json_encode($element),
                'elements_id' => $elements_id,
                'pages_id' => $element->pages_id,
                'username' => $this->session->userdata('username')
            );
            
            //insert new record into updates table
            $this->db->insert('updates', $updates_data);
        }
        
	}
	
	// updates the database with an id's contents
    function update_contents($id, $contents)
	{
		$data = array( 'contents' => $contents);
        
        $this->db->where('id', $id);
        $this->db->update('elements', $data);
		
	}
	
	// deletes the global filename from the assets folder
    private function remove_orthan_file()
	{
        // clean up your mess mr parker... no file left behind
		unlink('assets/' . $this->type . '/' . $filename);	
	}
	
	// updates an element in the `element` table and creates a new update in the `updates` table
	public function update_element()
	{
        //If anything is updated get the post data
		$post_data = $this->input->post(NULL, TRUE); // return all post data filtered XSS - SCRIPT SAFE
		//finds the id of the element
   		$elementId = $this->input->post('id');

		if ($this->input->post('contents'))
		{
            //if it is a text element and therefore has contents ...
			$this->load->model('Links_model');
			$this->load->model('Pages_model');
            
            // gets the page title
			$pages_title = $this->Pages_model->get_page_from_element($elementId);
			
            // deletes all the links in the links database belonging to this element
			$this->Links_model->delete_links_by_element_id($elementId);
			
            // processes the text for any links again
			$contents = $this->Links_model->process_codes($post_data['contents'], "forDb", $pages_title, $elementId);
            
            // posts the new data with the coded links
			$post_data['contents'] = $contents;
		
		}
		
		$this->db->where('id', $elementId);
		$this->db->update('elements', $post_data);
        
        $affected_rows = $this->db->affected_rows();
        
        if ($this->input->post('contents')){
            //create a new record in table 'updates'
            $this->load->model('Elements_model');
            $update_elements_id = $elementId;
            $update_action = 'revised';
            $this->Elements_model->create_update($update_action, $update_elements_id);
        }
		
		return $affected_rows;
   	}
   
	// returns the description field if set, if not: "false"
    public function return_description()
	{
		if (isset($this->data['description']))
		{
			return $this->data['description'];
		}else
		{
			return false;
		}
	}
	
	// returns the contents field if set, if not: "false"
    public function return_contents()
	{
		if (isset($this->data['contents']))
		{
			return $this->data['contents'];
		}else
		{
			return false;
		}
	}
	
	// returns the current page_id
    public function return_pages_id()
	{
		return $this->data['pages_id'];
	}
	
	// deletes the element with specific id in `elements` table, creates it in the `deleted elements` table, and creates a new update in `updates` table
    public function delete($id)
	{
		$element = $this->get_element_by_id($id);
        
		// delete all links for this element
		$this->load->model('Links_model');
        $this->Links_model->delete_links_by_element_id($id);
		
		// create a new element in the deleted_elements **** make sure to add the old ID field
		//unlink($element->id);?? What does this do ??
        unset($element->id);
        $this->db->insert('deleted_elements', $element);
		//$this->db->insert('deleted_elements', $element);
		
		//create new record for updates table before it is deleted
		$update_elements_id = $id;
		$update_action = 'deleted';
		$this->create_update($update_action, $update_elements_id);
        
		// delete element
		$this->db->delete('elements', array('id' => $id));
				
		
	}
    
}
