<a class="hidden" id="add_element_form_trigger" href="#add_element_form">&nbsp;</a>

<!-- omni-element box: will detect exactly what the user wants to do instead of forcing them to make so many choices -->
<div id="add_element_form_wrapper" class="hidden">
	
	<form id="add_element_form">
		<h2>New Element</h2>	
		<p id="element_file_info"></p>
		<label for="element_file">File:</label>
		<input type="file" name="element_file" id="element_file" /><br /><br />
		<label for="element_text">Text:</label>
		<textarea id="element_text"></textarea>
		<input type="submit" id="submit_element" value="Submit" class="submit_button"  />
		<!-- hidden values -->
		<input type="hidden" name="pages_id" value="<?php echo $page_info->id; ?>"/>
		<input type="hidden" name="x" value="400"/>
		<input type="hidden" name="y" value="400"/>
		
		<div id="loadingPrompt">Loading...</div>
	</form>
</div>
