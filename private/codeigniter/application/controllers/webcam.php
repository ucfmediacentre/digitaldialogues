<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Webcam extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	// processes an element and adds it to the `elements` and `updates` table
	public function addRecording($group = NULL, $page = NULL, $media = NULL)
	{
	  
		$this->load->model('Elements_model');
		$this->load->model('Pages_model');
		
		// add webrecording to page
		$elements_id = $this->Elements_model->add_recording($group, $page, $media);
		
		//creates the new record in table 'updates'
		$update_elements_id = $elements_id;
		$update_action = 'created';
		$this->Elements_model->create_update($update_action, $update_elements_id);
	}
}

/* End of file webcamRecording.php */
/* Location: ./application/controllers/webcamRecording.php */
