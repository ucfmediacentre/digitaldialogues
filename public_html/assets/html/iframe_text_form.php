<html>
<link rel="stylesheet" href="http://localhost/~media/swarmtvNet/public_html/css/normalize.css">
<link rel="stylesheet" href="http://localhost/~media/swarmtvNet/public_html/css/iframe.css">
<link rel="stylesheet" href="http://localhost/~media/swarmtvNet/public_html/css/videoPlayer.css">
<link rel="stylesheet" href="http://localhost/~media/swarmtvNet/public_html/libraries/fineuploader.jquery-3.0/fineuploader.css" type="text/css" media="screen" />
<link rel="stylesheet" href="http://localhost/~media/swarmtvNet/public_html/libraries/jquery-ui-1.9.2.custom/css/eggplant/jquery-ui-1.9.2.custom.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="http://localhost/~media/swarmtvNet/public_html/css/colorPicker.css" type="text/css" />
<script src="http://localhost/~media/swarmtvNet/public_html/js/vendor/jquery-1.8.3.min.js"></script>
<script src="http://localhost/~media/swarmtvNet/public_html/libraries/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="http://localhost/~media/swarmtvNet/public_html/js/vendor/jquery.ui.touch-punch.min.js"></script>
<script src="http://localhost/~media/swarmtvNet/public_html/js/vendor/modernizr-2.6.2.min.js"></script>
<script src="http://localhost/~media/swarmtvNet/public_html/js/jquery.colorPicker.min.js"></script>
<script type="text/javascript" src="http://localhost/~media/swarmtvNet/public_html/libraries/fancybox2/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript">
  //Run the code when document ready
  $(function() {
	
	var base_url = "http://localhost/~media/swarmtvNet/public_html/";
	  
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
<body>
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
  <input type="hidden" name="pages_id" id="element_pages_id" value="<?php echo $_GET["page_id"]; ?> "/>
  <input type="hidden" name="x" id="element_x" value="<?php echo rand (100, 640 ); ?>" />
  <input type="hidden" name="y" id="element_y" value="<?php echo rand (100, 480 ); ?>" />
  
  <div id="loadingPrompt">Loading...</div>
</form>
</body>
<html>
