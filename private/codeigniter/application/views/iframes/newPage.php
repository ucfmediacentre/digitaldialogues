
	<form id="add_page_form" class="input_form">
		<h2>New Page</h2>	
		<label for="new_page_title">Page Title:</label>
		<input id="new_page_title" type="text" name="new_page_title" />
		<br /><br />
		<label>Description:</label>
		<input name="description" id="description" />
		<input type="submit" id="submit_new_page" value="Submit" class="submit_element submit_button"  />
		<!-- hidden values -->
		<input type="hidden" name="current_page_title" value="<?php echo urldecode($pageTitle); ?> "/>
	    <input type="hidden" name="current_page_id" id="element_pages_id" value="<?php echo $pageId; ?> "/>
		<input type="hidden" name="group" value="<?php echo urldecode($group); ?> "/>
		
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
		  var descriptionVal = $('input[name="description"]').val();
		  var currentPageIdVal = $('input[name="current_page_id"]').val();
		  var base_url = "<?php echo base_url(); ?>";
		  
		  // Post the values to the pages controller
		  $.post(base_url + "index.php/pages/add_page", { title: titleVal, description: descriptionVal, group: groupVal, currentPageTitle: currentPageVal, currentPageId: currentPageIdVal },
			  function(data) {
				  window.top.location.reload();
		  });
		  
	  });
	
	})();       
	</script>
  
  </body>
<html>
