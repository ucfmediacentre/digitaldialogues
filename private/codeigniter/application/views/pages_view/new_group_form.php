<div id="add_group_form_wrapper" class="hidden">
	
	<form id="add_group_form" class="input_form">
		<h2>New Group</h2>	
		<label for="new_group_title">Group Title:</label>
		<input id="new_group_title" type="text" name="new_group_title" />
		<br /><br />
		<input type="radio" name="participation" value="public" > Public &nbsp;&nbsp;&nbsp;
		<input type="radio" name="participation" value="private" checked="checked" > Private 
		<br /><br />
		<input type="submit" id="submit_new_group" value="Submit" class="submit_element"  />
		<!-- hidden values -->
		<input type="hidden" name="current_page" value="<?php echo $page_info->title; ?>"/>
		<input type="hidden" name="current_page_id" value="<?php echo $page_info->id; ?>"/>
		<input type="hidden" name="current_group" value="<?php echo $page_info->group; ?>"/>
		<input type="hidden" name="userId" value="<?php echo $this->session->userdata('user_id'); ?>"/>
		
		<div id="loadingPrompt">Loading...</div>
	</form>
</div>