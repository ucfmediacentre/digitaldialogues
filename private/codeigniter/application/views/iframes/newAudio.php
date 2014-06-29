
	<form id="add_audio_form" class="input_form" action="<?php echo base_url(); ?>index.php/elements/add" method="post" enctype="multipart/form-data">
	  <h2>New Audio</h2>
	  <p>Maximum size: 100Mb<br />Formats: .mp3, or .wav</p>
	  <input type="file" name="file" id="file" />
	  <br /><br />
	  <label>Name:</label>
	  <input name="description" id="description" />
	  <input type="submit" id="submit_audio" value="Upload" class="submit_element submit_button"  />
	  <input type="hidden" name="author" id="author" value="<?php echo $author; ?> "/>
	  <input type="hidden" name="editable" id="editable" value="Y"/>
	  <input type="hidden" name="pages_id" id="element_pages_id" value="<?php echo $pageId; ?>"/>
	  <input type="hidden" name="x" id="element_x" value="<?php echo rand (100, 500 ); ?>" />
	  <input type="hidden" name="y" id="element_y" value="<?php echo rand (100, 500 ); ?>" />
	  
	  <div id="loadingPrompt">Loading...</div>
		
	</form>
	<br />
	<div id="progressbox" class="progress">
	  <div id="progressbar" class="bar"></div >
	  <div id="status" class="percent">0%</div >
	</div>
	
	<div id="status"></div>
	  
	<script>
	(function() {
			
	  var bar = $('.bar');
	  var percent = $('.percent');
	  var status = $('#status');
		 
	  $('#add_audio_form').ajaxForm({
		beforeSend: function() {
		  status.empty();
		  var percentVal = '0%';
		  bar.width(percentVal)
		  percent.html(percentVal);
		},
		uploadProgress: function(event, position, total, percentComplete) {
		  var percentVal = percentComplete + '%';
		  bar.width(percentVal)
		  percent.html(percentVal);
		  //console.log(percentVal, position, total);
		},
		success: function() {
		  var percentVal = '100%';
		  bar.width(percentVal)
		  percent.html(percentVal);
		},
		complete: function(xhr) {
		  status.html(xhr.responseText);
		  window.top.location.reload();
		}
	  }); 
	
	})();       
	</script>
  
  </body>
<html>
