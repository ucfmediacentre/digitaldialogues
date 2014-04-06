<div id="add_audio_form_wrapper" class="hidden">
	
	<form id="add_audio_form" class="input_form">
		<h2>New Audio</h2>
		<p>Maximum size: 100Mb<br />Format: .mp3</p>
		<input type="file" name="audio_file" id="audio_file" />
		<br /><br />
		<?php if ($this->session->userdata('logged_in') == 1) echo '<input type="checkbox" name="element_editable" id="element_editable" value="editable" checked="TRUE">&nbsp;Editable by others'; ?>
		<input type="submit" id="submit_audio" value="Submit" class="submit_element"  />
		
		<div id="loadingPrompt">Loading...</div>
	</form>
</div>