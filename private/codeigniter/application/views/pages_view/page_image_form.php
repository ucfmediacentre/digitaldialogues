<a class="hidden" id="add_image_form_trigger" href="#add_image_form">&nbsp;</a>

<div id="add_image_form_wrapper" class="hidden">
	
	<form id="add_image_form">
		<h2>New Image</h2>	
		<p id="image_file_info"></p>
		<textarea id="element_image"></textarea>
		<input type="submit" id="submit_element" value="Submit" class="submit_button"  />
		<!-- hidden values -->
		<input type="hidden" name="pages_id" value="<?php echo $page_info->id; ?>"/>
		<input type="hidden" name="x" value="400"/>
		<input type="hidden" name="y" value="400"/>
		
		<div id="loadingPrompt">Loading...</div>
	</form>
</div>
