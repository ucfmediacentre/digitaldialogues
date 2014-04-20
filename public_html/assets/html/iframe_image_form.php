<html>
  <head>
	<link rel="stylesheet" href="http://localhost/~media/swarmtvNet/public_html/css/normalize.css">
	<link rel="stylesheet" href="http://localhost/~media/swarmtvNet/public_html/css/iframe.css">
	<link rel="stylesheet" href="http://localhost/~media/swarmtvNet/public_html/libraries/fineuploader.jquery-3.0/fineuploader.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="http://localhost/~media/swarmtvNet/public_html/libraries/jquery-ui-1.9.2.custom/css/eggplant/jquery-ui-1.9.2.custom.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="http://localhost/~media/swarmtvNet/public_html/css/colorPicker.css" type="text/css" />
	<script src="http://localhost/~media/swarmtvNet/public_html/js/vendor/jquery-1.8.3.min.js"></script>
	<script src="http://localhost/~media/swarmtvNet/public_html/libraries/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
	<script src="http://localhost/~media/swarmtvNet/public_html/js/vendor/jquery.ui.touch-punch.min.js"></script>
	<script src="http://localhost/~media/swarmtvNet/public_html/js/vendor/modernizr-2.6.2.min.js"></script>
	<script src="http://localhost/~media/swarmtvNet/public_html/js/jquery.colorPicker.min.js"></script>
	<script type="text/javascript" src="http://localhost/~media/swarmtvNet/public_html/libraries/fancybox2/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<script type="text/javascript" src="http://localhost/~media/swarmtvNet/public_html/js/jquery.form.min.js"></script>
	<style>
	  form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }
	  .progress { position:relative; width:465px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; margin-left: auto ; margin-right: auto;}
	  .bar { background-color: #c0c0e0; width:0%; height:20px; border-radius: 3px; }
	  .percent { position:absolute; display:inline-block; top:3px; left:48%; }
	</style>
  </head>
  <body>
  
	<form id="add_image_form" class="input_form" action="http://localhost/~media/swarmtvNet/public_html/index.php/elements/add" method="post" enctype="multipart/form-data">
	  <h2>New Image</h2>
	  <p>Maximum size: 100Mb & 2048x1536<br />Formats: .gif, .jpg or .png</p>
	  <input type="file" name="file" id="file" />
	  <br /><br />
	  <input type="submit" id="submit_image" value="Upload" class="submit_element submit_button"  />
	  <input type="hidden" name="pages_id" id="element_pages_id" value="<?php echo $_GET["page_id"]; ?> "/>
	  <input type="hidden" name="x" id="element_x" value="<?php echo rand (100, 640 ); ?>" />
	  <input type="hidden" name="y" id="element_y" value="<?php echo rand (100, 480 ); ?>" />
	  
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
		 
	  $('#add_image_form').ajaxForm({
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
