<a class="hidden" id="page_info_form_trigger" href="#page_info_form">&nbsp;</a>

<div id="page_info_form_wrapper" class="hidden">
	<form id="page_info_form" class="input_form">
		<h2><?php echo $page_info->title; ?></h2>
		<input type="hidden" value="<?php echo $page_info->title; ?>" name="title" />
		<input type="hidden" value="<?php echo $page_info->id; ?>" name="id" />
		<label for="group"> Swarm TV: </label>
		<input id="group" type="text" name="group" value="<?php echo $page_info->group; ?>" /> <br /><br />
		<label for="description"> Description: </label>
		<textarea name="description"><?php echo $page_info->description; ?> </textarea>
		<br />
		<label for="keywords"> Keywords: </label>
		<input id="pageKeywords" type="text" name="keywords" value="<?php echo $page_info->keywords; ?>" /> <br /><br />
		<div>
			<input type="submit" value="Submit" id="submit_page_info" class="submit_element" />
			<!--&nbsp;<input type="button" value="Remove" id="remove_page" class="submit_element" />/-->
		</div>
    </form>
</div>