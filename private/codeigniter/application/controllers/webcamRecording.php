<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elements extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	// processes an element and adds it to the `elements` and `updates` table
	public function index($group = "public", $page = "sandpit")
	{
		$this->load->model('Elements_model');
		$this->load->model('Pages_model');
		
		// add webrecording to page
		$element_id = $this->Elements_model->add_webrecording($group, $page);
		
		//creates the new record in table 'updates'
		$update_elements_id = $elements_id;
		$update_action = 'created';
		$this->Elements_model->create_update($update_action, $update_elements_id);
	}
}

/* End of file webcamRecording.php */
/* Location: ./application/controllers/webcamRecording.php */
