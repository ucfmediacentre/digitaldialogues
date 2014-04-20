<html>
  <head>
	<link rel="stylesheet" href="http://swarmtv.net/css/normalize.css">
	<link rel="stylesheet" href="http://swarmtv.net/css/iframe.css">
	<link rel="stylesheet" href="http://swarmtv.net/libraries/fineuploader.jquery-3.0/fineuploader.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="http://swarmtv.net/libraries/jquery-ui-1.9.2.custom/css/eggplant/jquery-ui-1.9.2.custom.min.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="http://swarmtv.net/css/colorPicker.css" type="text/css" />
	<script src="http://swarmtv.net/js/vendor/jquery-1.8.3.min.js"></script>
	<script src="http://swarmtv.net/libraries/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
	<script src="http://swarmtv.net/js/vendor/jquery.ui.touch-punch.min.js"></script>
	<script src="http://swarmtv.net/js/vendor/modernizr-2.6.2.min.js"></script>
	<script src="http://swarmtv.net/js/jquery.colorPicker.min.js"></script>
	<script type="text/javascript" src="http://swarmtv.net/libraries/fancybox2/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<script type="text/javascript" src="http://swarmtv.net/js/jquery.form.min.js"></script>
	
	<style>
	  form { display: block; margin: 20px auto; background: #eee; border-radius: 10px; padding: 15px }
	  .progress { position:relative; width:465px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; margin-left: auto ; margin-right: auto;}
	  .bar { background-color: #c0c0e0; width:0%; height:20px; border-radius: 3px; }
	  .percent { position:absolute; display:inline-block; top:3px; left:48%; }
	</style>
  </head>
  <body>
  
	<form id="add_page_form" class="input_form">
		<h2>New Page</h2>	
		<label for="new_page_title">Page Title:</label>
		<input id="new_page_title" type="text" name="new_page_title" />
		<br /><br />
		<input type="submit" id="submit_new_page" value="Submit" class="submit_element submit_button"  />
		<!-- hidden values -->
		<input type="hidden" name="current_page_title" value="<?php echo urldecode($_GET["title"]); ?> "/>
	  <input type="hidden" name="current_page_id" id="element_pages_id" value="<?php echo $_GET["id"]; ?> "/>
		<input type="hidden" name="group" value="<?php echo urldecode($_GET["group"]); ?> "/>
		
		<div id="loadingPrompt">Loading...</div>
	</form>
	  
	<script>
	(function() {
	  
	  // submits Ajax for updating new page into database
	  $('#submit_new_page').click(function(e){
		  // Stop the page from navigating away from this page
		  e.preventDefault();		
		  
			  // get the values from the form
		  var titleVal = $('input[name="new_page_title"]').val();
		  var groupVal = $('input[name="group"]').val();
		  var currentPageVal = $('input[name="current_page_title"]').val();
		  var currentPageIdVal = $('input[name="current_page_id"]').val();
		  var base_url = "http://swarmtv.net/";
		  
		  // Post the values to the pages controller
		  $.post(base_url + "index.php/pages/add_page", { title: titleVal, group: groupVal, currentPageTitle: currentPageVal, currentPageId: currentPageIdVal },
			  function(data) {
				  window.top.location.reload();
		  });
		  
	  });
	
	})();       
	</script>
  
  </body>
<html>
