<div id="add_video_form_wrapper" class="hidden">
	
	<form id="add_video_form" class="input_form">
		<h2>New Video</h2>
		<p>Maximum size: 100Mb<br />Format: .mp4</p>
		<input type="file" name="video_file" id="video_file" />
		<br /><br />
		<?php if ($this->session->userdata('logged_in') == 1) echo '<input type="checkbox" name="element_editable" id="element_editable" value="editable" checked="TRUE">&nbsp;Editable by others'; ?>
		<input type="submit" id="submit_video" value="Submit" class="submit_element"  />
		<!--<div style="padding:10px;"><iframe src="https://digitaldialogues.org/stream/client/webcamRecorder.html" width="340" height="292" frameborder="0" allowtransparency="true" noresize="noresize" scrolling="no"></iframe></div>-->
		<div id="loadingPrompt">Loading...</div>
	</form>
</div>