
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
</script>

<!-- Google Analytics -->
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  
	ga('create', 'UA-47930876-1', 'digitaldialogues.org');
	ga('send', 'pageview');
  
</script>
