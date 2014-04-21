<form id="add_text_form" class="input_form">
  <h2>New Text</h2>
  Color of text:
  <input id="text_colour" type="text" value="#cccccc" name="text_colour" style="visibility: hidden; position: absolute;">
  <br>
  <br>
  <textarea id="text_form_text" name="text_form_text"></textarea>
  <br>
  <br>
  <input id="submit_text" class="submit_element submit_button" type="submit" value="Submit">
  <input type="hidden" name="pages_id" id="element_pages_id" value="<?php echo $pageId; ?> "/>
  <input type="hidden" name="x" id="element_x" value="<?php echo rand (100, 640 ); ?>" />
  <input type="hidden" name="y" id="element_y" value="<?php echo rand (100, 480 ); ?>" />
  
  <div id="loadingPrompt">Loading...</div>
</form>
<script type="text/javascript">
  //Run the code when document ready
  $(function() {
	
	var base_url = "<?php echo base_url(); ?>";
	  
	// function for changing text colour
	$('#text_colour').colorPicker();
	
	$('#submit_text').click(function(e){
	  e.preventDefault();
	  $("#loadingPrompt").css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});
	  $.fancybox.showLoading();
	  
	  var text_form_text = $('#text_form_text').val();
	  var text_colour = $('#text_colour').val();
	  var currentPageIdVal = $('input[name="pages_id"]').val();
	  var xVal = $('input[name="x"]').val();
	  var yVal = $('input[name="y"]').val();
	  
	  $.ajax({
		type: "POST",
		url: base_url +"index.php/elements/add",
		data: { contents: text_form_text, color: text_colour, pages_id: currentPageIdVal, x: xVal, y: yVal }
	  })
	  .done(function( msg ) {
		window.top.location.reload();
	  });
	});
  });
</script>
</body>
<html>
