<a class="hidden" id="add_element_form_trigger" href="#add_element_form">&nbsp;</a>

<!-- omni-element box: will detect exactly what the user wants to do instead of forcing them to make so many choices -->
<div id="add_element_form_wrapper" class="hidden">
	
	<form id="add_element_form" class="input_form">
		<h2>New Element</h2>	
		<label for="element_file">File:</label>
		<input type="file" id="element_file" /><br /><br />
<<<<<<< HEAD
		Text Colour:&nbsp;&nbsp;<input id="element_colour" type="text" name="element_colour" value="#cccccc" /><br />
		<label for="element_text">Text:</label>
		<textarea id="element_text"></textarea>
=======
		Text Colour:&nbsp;&nbsp;<input id="element_colour" class="colorPicker-picker" type="text" name="element_colour" value="#cccccc" /><br />
		<label for="element_text">Text:</label>
		<textarea id="element_text"></textarea>
		<?php if ($this->session->userdata('logged_in') == 1) echo '<input type="checkbox" name="element_editable" id="element_editable" value="editable" checked="checked">&nbsp;Editable by others'; ?>
>>>>>>> 6c98abe1772eba027aad12d429005e0cf1143103
		<input type="submit" class="submit_element" id="submit_element" value="Submit" />
		<!-- hidden values -->
		<input type="hidden" name="pages_id" id="element_pages_id" value="<?php echo $page_info->id; ?>"/>
		<input type="hidden" name="x" id="element_x" value="400"/>
		<input type="hidden" name="y" id="element_y" value="400"/>
		<input type="hidden" name="mediaType" id="mediaType" value=""/>
		
		<div id="loadingPrompt">Loading...</div>
	</form>
</div>
