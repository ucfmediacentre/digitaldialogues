<div id="add_page_form_wrapper" class="hidden">
	
	<form id="add_page_form" class="input_form">
		<h2>New Story</h2>	
		<!--Story Title //-->
		<label for="new_page_title">Story Title:</label>
		<input id="new_page_title" type="text" name="new_page_title" />
		<br /><br />
		<!-- simple color picker -->
		Color of text: <input id="text_colour" type="text" name="text_colour" value="#cccccc" />
		<br /><br />
		<!--Story Text //-->
		<label for="text_form_text">Story:</label>
		<textarea  id="text_form_text" name="text_form_text"></textarea>
		<br /><br />
		<!--Story Image //-->
		<label for="text_form_text">Image:</label>
		<br /><br />
		<p>Maximum size: 100Mb & 2048x1536<br />Formats: .gif, .jpg or .png</p>
		<input type="file" name="image_file" id="image_file" />
		<br /><br />
		<input type="submit" id="submit_new_page" value="Submit" class="submit_element"  />
		<!-- hidden values -->
		<input type="hidden" name="current_page_title" value="<?php echo $page_info->title; ?>"/>
		<input type="hidden" name="current_page_id" value="<?php echo $page_info->id; ?>"/>
		<input type="hidden" name="group" value="<?php echo $page_info->group; ?>"/>
		<input type="hidden" name="x" value="400"/>
		<input type="hidden" name="y" value="400"/>
		
		<div id="loadingPrompt">Loading...</div>
	</form>
</div>