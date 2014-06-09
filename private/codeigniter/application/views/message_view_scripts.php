
<script type="text/javascript" src="<?php echo base_url(); ?>libraries/fancybox2/source/jquery.fancybox.pack.js?v=2.1.5"></script>
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
		
		// submits Ajax for sending a message 
		$('#submit_message').click(function(e){
			// Stop the page from navigating away from this page
			e.preventDefault();		
			
		        // get the values from the form
			var fromVal = $('input[name="username"]').val();
			var toVal = $('select[name="recipient"]').val();
			var subjectVal = $('input[name="subject"]').val();
            var bodyVal = $('textarea[name="body"]').val();
			var currentUrl = window.location.href;
			
			// Post the values to the pages controller
            $.post(base_url + "index.php/messages/send_message", { toUser: toVal, fromUser: fromVal, subject: subjectVal, body: bodyVal },
				function( data ) {
					//Refresh the page
					window.location.href = currentUrl;
				});
		});
    
	});
	
	function delete_message(message_id, username) {
		var answer = confirm("Are you sure you want to delete this message?");
		if (answer) {
			window.location.replace("<?php echo base_url() . 'index.php/messages/delete_message/' ?>" + message_id + "/" + username);
		}
	}
	
	function mark_as_read(message_id, username) {
		window.location.replace("<?php echo base_url() . 'index.php/messages/mark_as_read/' ?>" + message_id + "/" + username);
	}
    
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


<script language="JavaScript1.2" type="text/javascript">
  <!--
  $( "#search" ).click(function() {
	  $( "#searchForm" ).submit();
  });
  //-->
</script>