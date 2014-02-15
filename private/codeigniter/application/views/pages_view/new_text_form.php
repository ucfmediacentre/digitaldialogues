<div id="add_text_form_wrapper" class="hidden">
	
	<form id="add_text_form" class="input_form">
		<h2>New Text</h2>
		<!-- simple color picker -->
		Color of text: <input id="text_colour" type="text" name="text_colour" value="#cccccc" />
		<br /><br />
		<textarea  id="text_form_text" name="text_form_text"></textarea>
		<br /><br />
		<?php if ($this->session->userdata('logged_in') == 1) echo '<input type="checkbox" name="element_editable" id="element_editable" value="editable" checked="TRUE">&nbsp;Editable by others'; ?>
		<input type="submit" id="submit_text" class="submit_element" value="Submit" />
		
		<div id="loadingPrompt">Loading...</div>
	</form>
</div>