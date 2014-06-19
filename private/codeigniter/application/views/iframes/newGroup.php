
	<form id="add_group_form" class="input_form">
		<h2>New Group</h2>	
		<label for="new_group_title">Group Title:</label>
		<input id="new_group_title" type="text" name="new_group_title" />
		<br /><br />
		<input type="radio" name="participation" value="public" > Public &nbsp;&nbsp;&nbsp;
		<input type="radio" name="participation" value="private" checked="checked" > Private 
		<br /><br />
		<input type="submit" id="submit_new_group" value="Submit" class="submit_element"  />
		<!-- hidden values -->
		<input type="hidden" name="author" id="author" value="<?php echo $author; ?> "/>
		<input type="hidden" name="current_page" value="<?php echo $pageTitle; ?>"/>
		<input type="hidden" name="current_page_id" value="<?php echo $pageId; ?>"/>
		<input type="hidden" name="current_group" value="<?php echo $group; ?>"/>
		<input type="hidden" name="userId" value="<?php echo $userId; ?>"/>
		
		<div id="loadingPrompt">Loading...</div>
	</form>
	  
	<script>
	(function() {
	  
		// submits Ajax for updating new group into the database
		$('#submit_new_group').click(function(e){
			// Stop the page from navigating away from this page
			e.preventDefault();		
			
		    // get the values from the form
			var newGroupVal = $('input[name="new_group_title"]').val();
            var participationVal = $('input[name="participation"]:checked').val();
			var currentPageVal = $('input[name="current_page"]').val();
			var currentPageIdVal = $('input[name="current_page_id"]').val();
			var currentGroupVal = $('input[name="current_group"]').val();
			var userIdVal = $('input[name="userId"]').val();
			var base_url = "<?php echo base_url(); ?>";
			
			//alert(newGroupVal + " | " + participationVal + " | " + currentPageVal + " | " + currentGroupVal + " | " + currentPageIdVal);
			
			// Post the values to the pages controller
            $.post(base_url + "index.php/groups/add_group", { newGroup: newGroupVal, participation: participationVal, currentPage: currentPageVal, currentGroup: currentGroupVal, currentPageId: currentPageIdVal, userId: userIdVal },
		        function(data) {
					window.top.location.reload();
			});
            
		});
	
	})();       
	</script>
  
  </body>
<html>
