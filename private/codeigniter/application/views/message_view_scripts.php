
<script type="text/javascript" src="<?php echo base_url(); ?>libraries/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>libraries/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>libraries/fineuploader.jquery-3.0/jquery.fineuploader-3.0.min.js"></script>
<script type="text/javascript">

(function($){

	// Save the base url as a a javascript variable
	var base_url = "<?php echo base_url(); ?>";
	
	$(document).ready(function(){
	  
		// sets click to open message fancy box
		$('#add_message_form_wrapper').click(function(e){
			$("a#add_message_form_trigger").trigger('click');
			//$('input[name="x"]').val(e.pageX);
			//$('input[name="y"]').val(e.pageY);
			$('textarea').focus();
			clearSelection();
		});
		
		// inits message fancy box
		$("a#add_message_form_trigger").fancybox({
			'overlayOpacity':0,
			'autoDimensions':true,
			'showCloseButton':false,
		});
		
		// submits Ajax for updating page info 
		$('#submit_message').click(function(e){
			// Stop the page from navigating away from this page
			e.preventDefault();		
			
		        // get the values from the form
			var idVal = $('input[name="id"]').val();
			var titleVal = $('input[name="title"]').val();
            var descriptionVal = $('textarea[name="description"]').val();
			var keywordsVal = $('input[name="keywords"]').val();
			var groupVal = $('input[name="group"]').val();
			
			// Post the values to the pages controller
                        $.post(base_url + "index.php/pages/update", { id: idVal , group: groupVal , title: titleVal , description: descriptionVal, keywords: keywordsVal},
		        function(data) {
				// Refresh page
                                window.location.href = base_url+"index.php/pages/view/"+groupVal+"/"+titleVal;
			});
            
		});
		
		// adds an element to the page with ajax when submit button is clicked
		$('#submit_element').click(function(e){
			e.preventDefault();
			
			$("#loadingPrompt").css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});
			$.fancybox.showActivity();
		
			// get all the form values
			
			//sort out which type of file should be sent. This is put into a hidden field in the element form
			var element_file;
			switch($('#mediaType').val())
			{
			case "image":
				element_file = $('#image_file').get(0).files[0];
				break;
			case "audio":
				element_file = $('#audio_file').get(0).files[0];
				break;
			case "video":
				element_file = $('#video_file').get(0).files[0];
				break;
			default:
			  element_file = $('#element_file').get(0).files[0];
			}
			
			var element_description = $('#element_text').val();
			var pages_id = $('input[name="pages_id"]').val();
			var x = $('input[name="x"]').val();
			var y = $('input[name="y"]').val();
			 
			// AJAX to server
			var uri = base_url + "index.php/elements/add";
			var xhr = new XMLHttpRequest();
			var fd = new FormData();
	
			xhr.open("POST", uri, true);
			
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					// Handle response.
                    if (xhr.responseText !== ""){
                        //An error can be triggered by the server not finding an .webm format which gives a blank alert
                        alert(xhr.responseText); // handle response.
                    }
					location.reload();
				}
			};
			
			// check to see if a file has been selected 
			// if there is a file the text box will become the description
			// if there is no file the textbox is the content
			
			if (typeof element_file !== "undefined")
			{
				fd.append('file', element_file);
				fd.append('description', element_description);
			}else
			{
				fd.append('contents', element_description);
			}
			
			fd.append('pages_id', pages_id);
			fd.append('x', x);
			fd.append('y', y);
			
			// Initiate a multipart/form-data upload
			xhr.send(fd);
            
			
		});
	});
    
})($);

function delete_message(message_id, username) {
	var answer = confirm("Are you sure you want to delete this message?");
	if (answer) {
		window.location.replace("<?php echo base_url() . 'index.php/messages/delete_message/' ?>" + message_id + "/" + username);
	}
}

function mark_as_read(message_id, username) {
	window.location.replace("<?php echo base_url() . 'index.php/messages/mark_as_read/' ?>" + message_id + "/" + username);
}
</script>