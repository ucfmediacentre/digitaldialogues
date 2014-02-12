<a class="hidden" id="add_message_form_trigger" href="#add_message_form">&nbsp;</a>

<div id="add_message_form_wrapper" class="hidden">
	
	<form id="add_message_form" class="input_form">
		<h2>New Message</h2>	
		<label for="subject">To:</label>
		<select name="recipient">
			<?php echo $members ?>
		</select>
		<br /><br />
		<label for="subject">Subject:</label>
		<input type="text" id="subject" name="subject" size="40" /><br /><br />
		<label for="body">Body:</label>
		<textarea id="body" name="body"></textarea>
		<input type="submit" class="submit_message" id="submit_message" value="Submit" />
		<!-- hidden values -->
		<input type="hidden" name="username" id="username" value="<?php echo $username; ?>"/>
		
		<div id="loadingPrompt">Sending...</div>
	</form>
</div>