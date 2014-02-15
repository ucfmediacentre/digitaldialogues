<div id="add_image_form_wrapper" class="hidden">
	
	<form id="add_image_form" class="input_form">
		<h2>New Image</h2>
		<p>Maximum size: 100Mb & 1024x768<br />Formats: .gif, .jpg or .png</p>
		<input type="file" name="image_file" id="image_file" />
		<br /><br />
		<?php if ($this->session->userdata('logged_in') == 1) echo '<input type="checkbox" name="element_editable" id="element_editable" value="editable" checked="TRUE">&nbsp;Editable by others'; ?>
		<input type="submit" id="submit_image" value="Submit" class="submit_element"  />
		
		<div id="loadingPrompt">Loading...</div>
	</form>
</div>