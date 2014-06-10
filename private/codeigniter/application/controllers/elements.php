<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Elements extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}
	
	// processes an element and adds it to the `elements` and `updates` table
	public function add()
	{
		$this->load->model('Elements_model');
		$this->load->model('Links_model');
		$this->load->model('Pages_model');
		
		// checks if there is a file to process
		if(sizeof($_FILES) > 0){
       		
       		// checks if the file validates
			$this->Elements_model->validate_file() or exit($this->Elements_model->file_errors);
			
			// moves the file depending on its mime type
			$this->Elements_model->move_file() or exit($this->Elements_model->file_errors);
		}		
		
		$this->Elements_model->validate_element_data() or exit($this->Elements_model->data_errors);
		
		$elements_id = $this->Elements_model->add_element_to_database($this->Elements_model->data_errors) or exit();
		
		// processes links for element
		// *** PROCESS THE LINKS IN THE TEXT CONTENTS***
		
		// gets more page details
		$pages_id = $this->Elements_model->return_pages_id();
		$pages_title = $this->Pages_model->get_title($pages_id);
		$this->session->set_userdata('group', $this->Pages_model->get_group($pages_id));
		
		// gets the CONTENTS as a string
		$contents = $this->Elements_model->return_contents();
		
		// pieces the CONTENTS back together with the link ids instead of any link titles
		$processed_contents = $this->Links_model->process_codes($contents, "forDb", $pages_title, $elements_id);
			
		//updates the CONTENTS
		$this->Elements_model->update_contents($elements_id, $processed_contents);
		
		//creates the new record in table 'updates'
		$update_elements_id = $elements_id;
		$update_action = 'created';
		$this->Elements_model->create_update($update_action, $update_elements_id);
	}
	
	// updates element and creates new update and returns "1" if successful
	public function update()
	{
		$this->load->model('Elements_model');
		echo $this->Elements_model->update_element();
	}
	
	// deletes an element with a specific id
	public function delete($id)
	{
		$this->load->model('Elements_model');
		$this->Elements_model->delete($id);
	}
}

/* End of file Elements.php */
/* Location: ./application/controllers/Elements.php */
