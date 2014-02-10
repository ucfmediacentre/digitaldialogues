<a class="hidden" id="add_message_form_trigger" href="#add_message_form">&nbsp;</a>

<div id="add_message_form_wrapper" class="hidden">
	
	<form id="add_message_form" class="input_form">
		<h2>New Message</h2>	
		<label for="subject">Subject:</label>
		<input type="text" id="subject" /><br /><br />
		<label for="body">Body:</label>
		<textarea id="body"></textarea>
		<input type="submit" class="submit_message" id="submit_message" value="Submit" />
		<!-- hidden values -->
		
		<div id="loadingPrompt">Sending...</div>
	</form>
</div>