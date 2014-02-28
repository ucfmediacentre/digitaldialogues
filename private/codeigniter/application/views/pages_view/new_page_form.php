<div id="add_page_form_wrapper" class="hidden">
	
	<form id="add_page_form" class="input_form">
		<h2>New Page</h2>	
		<label for="new_page_title">Page Title:</label>
		<input id="new_page_title" type="text" name="new_page_title" />
		<br /><br />
		<!--<label for="new_page_description"> Description: </label>
		<textarea name="new_page_description"></textarea>
		<br /><br />
		<label for="new_page_keywords"> Keywords: </label>
		<input id="pageKeywords" type="text" name="new_page_keywords" />
		<br /><br />-->
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