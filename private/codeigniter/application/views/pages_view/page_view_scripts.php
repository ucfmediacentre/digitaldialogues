
<script type="text/javascript" src="<?php echo base_url(); ?>libraries/fancybox2/source/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>libraries/fineuploader.jquery-3.0/jquery.fineuploader-3.0.min.js"></script>
<script type="text/javascript">

(function($){

	// Save the base url as a a javascript variable
	var base_url = "<?php echo base_url(); ?>";
	var username = "<?php if ($this->session->userdata('logged_in') == 1) {echo $this->session->userdata('username'); }else{ echo '';} ?>";
	
	$(document).ready(function(){
		
<<<<<<< HEAD
		// as soon as the page is ready initiate all elements on the page
		initElements();
        
		// sets dblclick to open page_info fancy box
		$('#page_title_wrapper').dblclick(function(e){
		        $("#page_info_form_trigger").trigger('click');
			$('textarea').focus();
			clearSelection();
		});
        
		// inits page_info fancy box
		$("a#page_info_form_trigger").fancybox({
			'overlayOpacity':0,
			'autoDimensions':true,
			'showCloseButton':false,
		});
        
		// sets click to open text fancy box
		$('#add_text_form_wrapper').click(function(e){
			$("a#add_text_form_trigger").trigger('click');
			$('input[name="x"]').val(e.pageX);
			$('input[name="y"]').val(e.pageY);
			clearSelection();
		});
		
		// inits text fancy box
		$("a#add_text_form_trigger").fancybox({
			'overlayOpacity':0,
			'autoDimensions':true,
			'showCloseButton':false,
			'afterShow': function(){
				$('#text_form_text').focus();
			}
		});
		
		// sets click to open image fancy box
		$('#add_image_form_wrapper').click(function(e){
			$("a#add_image_form_trigger").trigger('click');
			$('input[name="x"]').val(e.pageX);
			$('input[name="y"]').val(e.pageY);
			clearSelection();
		});
		
		// inits image fancy box
		$("a#add_image_form_trigger").fancybox({
			'overlayOpacity':0,
			'autoSize':true,
		});
		
		// sets click to open audio fancy box
		$('#add_audio_form_wrapper').click(function(e){
			$("a#add_audio_form_trigger").trigger('click');
			$('input[name="x"]').val(e.pageX);
			$('input[name="y"]').val(e.pageY);
			clearSelection();
		});
		
		// inits audio fancy box
		$("a#add_audio_form_trigger").fancybox({
			'overlayOpacity':0,
			'autoSize':true,
		});
		
		// sets click to open video fancy box
		$('#add_video_form_wrapper').click(function(e){
			$("a#add_video_form_trigger").trigger('click');
			$('input[name="x"]').val(e.pageX);
			$('input[name="y"]').val(e.pageY);
			clearSelection();
		});
		
		// inits video fancy box
		$("a#add_video_form_trigger").fancybox({
			'overlayOpacity':0,
			'autoSize':true,
		});
		
		// sets click to open page form fancy box
		$('#add_page_form_wrapper').click(function(e){
			$("a#add_page_form_trigger").trigger('click');
			$('input[name="x"]').val(e.pageX);
			$('input[name="y"]').val(e.pageY);
			clearSelection();
		});
		
		// inits page form fancy box
		$("a#add_page_form_trigger").fancybox({
			'overlayOpacity':0,
			'autoSize':true,
			'afterShow': function(){
				$('#new_page_title').focus();
			}
		});
		
		// sets click to open group form fancy box
		$('#add_group_form_wrapper').click(function(e){
			$("a#add_group_form_trigger").trigger('click');
			$('input[name="x"]').val(e.pageX);
			$('input[name="y"]').val(e.pageY);
			clearSelection();
		});
		
		// inits group form fancy box
		$("a#add_group_form_trigger").fancybox({
			'overlayOpacity':0,
			'autoSize':true,
			'afterShow': function(){
				$('#new_group_title').focus();
			}
=======
		
		var shiftPressed = false;
		
		$(window).keydown(function(evt) {
		  if (evt.which == 16) { // shift
			shiftPressed = true;
		  }
		}).keyup(function(evt) {
		  if (evt.which == 16) { // shift
			shiftPressed = false;
		  }
		});
		
		// as soon as the page is ready initiate all elements on the page
		initElements();
		
		$(".iframe").fancybox({
			'width':510,
			'type':'iframe',
			'autoScale':'false'
>>>>>>> 6c98abe1772eba027aad12d429005e0cf1143103
		});
	
		// triggers the element fancy box on double click
		$('#background').dblclick(function(e){
			$("a#add_element_form_trigger").trigger('click'); 
			$('input[name="x"]').val(e.pageX);
			$('input[name="y"]').val(e.pageY);
			clearSelection();
		});
		
		// inits element fancy box
		$("a#add_element_form_trigger").fancybox({
			'overlayOpacity':0,
			'autoSize':true,
			'afterShow': function(){
				$('#element_text').focus();
			}
		});
		
		// submits Ajax for updating page info 
		$('#submit_page_info').click(function(e){
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
		
<<<<<<< HEAD
		// submits Ajax for updating new page into database
		$('#submit_new_page').click(function(e){
			// Stop the page from navigating away from this page
			e.preventDefault();		
			
		        // get the values from the form
			var titleVal = $('input[name="new_page_title"]').val();
            //var descriptionVal = $('textarea[name="new_page_description"]').val();
			//var keywordsVal = $('input[name="new_page_keywords"]').val();
			var groupVal = $('input[name="group"]').val();
			var currentPageVal = $('input[name="current_page_title"]').val();
			var currentPageIdVal = $('input[name="current_page_id"]').val();
			
			// Post the values to the pages controller
                        $.post(base_url + "index.php/pages/add_page", { title: titleVal, group: groupVal, currentPageTitle: currentPageVal, currentPageId: currentPageIdVal },
		        function(data) {
                    window.location.href = base_url+"index.php/pages/view/"+groupVal+"/"+currentPageVal;
			});
            
		});
		
		// submits Ajax for updating new group into the database
		$('#submit_new_group').click(function(e){
			// Stop the page from navigating away from this page
			e.preventDefault();		
			
		    // get the values from the form
			var newGroupVal = $('input[name="new_group_title"]').val();
            var participationVal = $('input[name="participation"]:checked').val();
			var currentPageVal = $('input[name="current_page"]').val();
			var currentGroupVal = $('input[name="current_group"]').val();
			var currentPageIdVal = $('input[name="current_page_id"]').val();
			var userIdVal = $('input[name="userId"]').val();
			
			//alert(newGroupVal + " | " + participationVal + " | " + currentPageVal + " | " + currentGroupVal + " | " + currentPageIdVal);
			
			// Post the values to the pages controller
                        $.post(base_url + "index.php/groups/add_group", { newGroup: newGroupVal, participation: participationVal, currentPage: currentPageVal, currentGroup: currentGroupVal, currentPageId: currentPageIdVal, userId: userIdVal },
		        function(data) {
                window.location.href = base_url+"index.php/pages/view/"+currentGroupVal+"/"+currentPageVal;
			});
            
		});
		
		//fills out element form from TEXT submit 
		$('#submit_text').click(function(e){
			// Stop the page from navigating away from this page
			e.preventDefault();		
			
		        // get the values from the text form and put them into the element form
			$('#element_text').val($('#text_form_text').val());
			$('#element_colour').val($('#text_colour').val());
			// work out whether user's text should be editable.
			var text_editable;
			var loggedIn = <?php if ($this->session->userdata('logged_in') == 1) {echo '1'; }else{ echo '0';} ?>;
			text_editable = "N";
			$('#element_editable').val(text_editable);
			$('#element_x').val(parseInt(100+(Math.random()*200)));
			$('#element_y').val(parseInt(200+(Math.random()*300)));
			
			//trigger element form click
			$("#submit_element").trigger('click');    
            
		});
		
		//fills out element form from IMAGE submit 
		$('#submit_image').click(function(e){
			// Stop the page from navigating away from this page
			e.preventDefault();
			
		    // get the values from the image form and put them into the element form
			$('#mediaType').val("image");
			// work out whether user's image should be editable.
			var image_editable;
			var loggedIn = <?php if ($this->session->userdata('logged_in') == 1) {echo '1'; }else{ echo '0';} ?>;
			if (loggedIn != 1) {
				image_editable = "Y";
			} else if ($( "input:checked" ).length > 5) {
				//there are 6 checked items on the page - most of them are hidden
				image_editable = "Y";
			} else {
				image_editable = "N";
			}
			$('#element_editable').val(image_editable);
			$('#element_x').val(parseInt(100+(Math.random()*200)));
			$('#element_y').val(parseInt(200+(Math.random()*300)));
			
			//trigger element form click
			$("#submit_element").trigger('click');    
            
		});
		
		//fills out element form from AUDIO submit 
		$('#submit_audio').click(function(e){
			// Stop the page from navigating away from this page
			e.preventDefault();
			
		    // get the values from the audio form and put them into the element form
			$('#mediaType').val("audio");
			// work out whether user's audio should be editable.
			var audio_editable;
			var loggedIn = <?php if ($this->session->userdata('logged_in') == 1) {echo '1'; }else{ echo '0';} ?>;
			if (loggedIn != 1) {
				audio_editable = "Y";
			} else if ($( "input:checked" ).length > 5) {
				//there are 6 checked items on the page - most of them are hidden
				audio_editable = "Y";
			} else {
				audio_editable = "N";
			}
			$('#element_editable').val(audio_editable);
			$('#element_x').val(parseInt(100+(Math.random()*200)));
			$('#element_y').val(parseInt(200+(Math.random()*300)));
			
			//trigger element form click
			$("#submit_element").trigger('click');    
            
		});
		
		//fills out element form from VIDEO submit 
		$('#submit_video').click(function(e){
			// Stop the page from navigating away from this page
			e.preventDefault();
			
		    // get the values from the video form and put them into the element form
			$('#mediaType').val("video");
			// work out whether user's video should be editable.
			var video_editable;
			var loggedIn = <?php if ($this->session->userdata('logged_in') == 1) {echo '1'; }else{ echo '0';} ?>;
			if (loggedIn != 1) {
				video_editable = "Y";
			} else if ($( "input:checked" ).length > 5) {
				//there are 6 checked items on the page - most of them are hidden
				video_editable = "Y";
			} else {
				video_editable = "N";
			}
			$('#element_editable').val(video_editable);
			$('#element_x').val(parseInt(100+(Math.random()*200)));
			$('#element_y').val(parseInt(200+(Math.random()*300)));
			
			//trigger element form click
			$("#submit_element").trigger('click');    
            
		});
		
		// creates functions for double clicking elements
		$('.element').dblclick(function(){
=======
		// creates functions for double clicking elements
		$('.element').dblclick(function(){
		  
		  //if SHIFT is pressed then open full editing
		  if(shiftPressed){
			  $.fancybox.open({
				  padding : 20,
				  href:'<?php echo base_url(); ?>index.php/iframe/edit/textEditor/'+$(this).attr('id') ,
				  type: 'iframe',
				  'width':506,
				  'autoScale':'false'
			  });
		  } else {
>>>>>>> 6c98abe1772eba027aad12d429005e0cf1143103
			
			$(this).find('.delete_button').fadeIn();
			
			// Only allow inline editing for text elements
			if( $(this).hasClass('text') )
			{
				// updates text to editable state
				var jsonIndex = $(this).find('div').attr('jsonindex');
				var content_container = $(this).find('.text-content');
				$(content_container).html(page_elements_json[jsonIndex]['editableContents']); 
                
				// make content editable and disable drag
				$(this).find('.text-content').attr('contenteditable','true');
				$(this).find('.text-content').focus();
				$(this).draggable({ disabled: true });
				
				// listen for when the user shifts focus out of the box
				$(this).focusout(function(updateTextElementContent)
				{
                     
					// activates the drag and deactivate the content editable
					$(content_container).removeAttr('contenteditable');
					$(this).draggable({ disabled: false });
					
					// gets the content, creates a replica and fetches the id of the container
					var content_container = $(this).find('.text-content');
					var link_id = $(this).attr('id');
					var new_contents = $(content_container).html();
                    
                    // sends edit to database, but waits half a second so that the delete button can be checked
                    setTimeout(function(){
                        updateElement(link_id, 'text-content', new_contents);
                        
                        $(this).find('.delete_button').fadeOut();
                        // removes the event
                        $(this).unbind('focusout', updateTextElementContent);
                    },250);
				});
			}
<<<<<<< HEAD
=======
		  }
>>>>>>> 6c98abe1772eba027aad12d429005e0cf1143103
		});
		
		// adds an element to the page with ajax when submit button is clicked
		$('#submit_element').click(function(e){
			e.preventDefault();
			
			$("#loadingPrompt").css({opacity: 0.0, visibility: "visible"}).animate({opacity: 1.0});
			$.fancybox.showLoading();
		
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
			var element_colour = $('#element_colour').val();
			var element_editable;
			var loggedIn = <?php if ($this->session->userdata('logged_in') == 1) {echo '1'; }else{ echo '0';} ?>;
			if (loggedIn != 1) {
				element_editable = "Y";
			} else if ($( "input:checked" ).length > 5) {
				//there are 6 checked items on the page (most of them are hidden)
				element_editable = "Y";
			} else {
				element_editable = "N";
			}
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
<<<<<<< HEAD
			}else
			{
				fd.append('contents', element_description);
=======
			} else {
				fd.append('contents', element_description);
				
				var text_form_text = element_description;
				$("#textSizer").text(text_form_text);
				$("#textSizer").css("fontSize", "15px");
				if ($("#textSizer").width()>320){
				  $("#textSizer").width(320);
				}
				var widthVal = $("#textSizer").width()+20;
				var heightVal = $("#textSizer").height()+20;
				
				fd.append('width', widthVal);
				fd.append('height', heightVal);
>>>>>>> 6c98abe1772eba027aad12d429005e0cf1143103
			}
			
			fd.append('author', username);
			fd.append('pages_id', pages_id);
			fd.append('color', element_colour);
			fd.append('editable', element_editable);
			fd.append('x', x);
			fd.append('y', y);
			
			// Initiate a multipart/form-data upload
			xhr.send(fd);
            
			
		});
		
		// deletes an element with Ajax
        $('.delete_button').click(function(e){
		
			e.preventDefault();
			
			var element_id = $(this).attr('href');
            var r=confirm("Are you sure you want to delete this?");
            if (r==true)
            {
                $.ajax({
                    url		: base_url + 'index.php/elements/delete/' + element_id,
                    type	: 'GET',
                    success	: function(data, status)
                    {
                        location.reload();
                    } 
                });
            }
		});
		
		// updates preview if file is selected
		$('#element_file').change(function(){
			
			// check to see if a file has been selected
			var element_file = $('#element_file').get(0).files[0];
			if (typeof element_file !== "undefined") 
			{	
				$('#element_file_info').empty();
				
				var imageType = /image.*/;
		 
				if (element_file.type.match(imageType)) {
					
					// create thumbnail
					var img = document.createElement("img");
					img.classList.add("thumbnail");
					img.file = element_file;
					img.width = 100;
					$('#element_file_info').append(img);
					
					// load in image data 
					var reader = new FileReader();
					reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; }; })(img);
					reader.readAsDataURL(element_file);
				}	
				
				var info = '<br />Name: ' + element_file.name + "<br /> Size: " + element_file.size + " bytes";
				$('#element_file_info').append(info); 	
			}
		});
		
		
		
	});
	
	// CREATES ELEMENTS ON THE PAGE
	// output the elements as a json array
	var page_elements_json = <?php echo json_encode($page_elements); ?>;
	var page_elements = new Array();
	
    // creates each element on the page from a JSON array
	function initElements()
	{
		// Loop through all of the elements in the json array
		for (var i = 0; i < page_elements_json.length; i++)
		{
			// create the style object
			var style = { 
			    'background-color'	:   page_elements_json[i].backgroundColor,
			    'color'		        :   page_elements_json[i].color,
			    'font-size'		    :   page_elements_json[i].fontSize + 'px',
			    'font-family'	    :   page_elements_json[i].fontFamily,
			    'height'		    :   page_elements_json[i].height+'px',
			    'opacity'		    :   page_elements_json[i].opacity,
			    'text-align'	    :   page_elements_json[i].textAlign,
			    'width'		        :   page_elements_json[i].width+'px',
			    'left'		        :   page_elements_json[i].x+'px',
			    'top'		        :   page_elements_json[i].y+'px',
			    'z-index'  		    :   page_elements_json[i].z,
			    'position'		    :   'absolute'
			}
			
			if (page_elements_json[i].type === 'text') style.height = 'auto';
	
			// create the div to contain the elements content
			var elm = $('<div>');
			
			// add the id
			$(elm).attr('id', page_elements_json[i].id);
			
			// add some sneaky data to the container
			$(elm).data('page_id', page_elements_json[i].pages_id);
			$(elm).data('license', page_elements_json[i].license);
			
			// adds the style to the element and the generic class 
			$(elm).css(style);
			// Dont let the item become an element unless the author has specified it to be editable
			if (page_elements_json[i].editable == 'Y' || page_elements_json[i].author == username) {
				$(elm).addClass('element');
			}
			$(elm).addClass(page_elements_json[i].type);
			
			// customise the element depending on its content type
			switch (page_elements_json[i].type)
			{
				case 'text':
					initText(elm, i);
                    // see if shortcodes has introduced an iframe or object, and if so change the width of the text div to accommodate
                    if ($(elm).children().children().children().attr('width')){
                        $(elm).width(parseInt($(elm).children().children().children().attr('width'))+20);
                    };
					break;
				case 'image':
					initImage(elm, i);
					break;
				case 'audio':
					initAudio(elm, i);
					break;
				case 'video':
					initVideo(elm, i);
					break;
			}
			
			// MAKES DRAGGABLE unless the author specified that it shouldn't be editable
			if (page_elements_json[i].editable == 'Y' || page_elements_json[i].author == username) {
				$(elm).draggable({
<<<<<<< HEAD
=======
					//snap: "div", grid: [ 10, 10 ],
>>>>>>> 6c98abe1772eba027aad12d429005e0cf1143103
					stack: "div",
					stop: function(event, ui) {
						updateElement(ui.helper[0].id , 'position');
					}
				}).draggable({cancel : 'object'});
			}
			
			// *** GLOBAL VARIABLES CAUSING HAVOC WITH THIS FUNCTION
			// if the file type is neither audio nor video then add resize 
			if (page_elements_json[i].type !== 'audio' && page_elements_json[i].type !== 'video')
			{
				
				if (page_elements_json[i].editable == 'Y' || page_elements_json[i].author == username) {
					$(elm).resizable({
						create: function(event, ui) {
							
						},
						start: function(e, ui) {
							// Start function goes here
						},
						resize: function(e, ui) {
							// Resize function goes here
							if($(this).hasClass('text')){
									var textLength = $(this).text().length;
									var textRatio = $(this).width()/$(this).height();
									var textWidth = $(this).width();
									var newFontSize = textWidth/(Math.sqrt(textLength*textRatio));
									$(this).css("font-size", newFontSize);
									$(this).css("border", 0);
							}
	
						},
						stop: function(event, ui) {
							// Stop function goes here
							updateElement(ui.helper[0].id, 'size');
							if ($(this).hasClass('text')){
								$(this).css({'height':'auto'});
								$(this).css("border-width", "1px");
								$(this).css("border-color","#ccc");
								$(this).css("border-radius","10px");
								$(this).css("border-style","dashed");
							}
						}
					});
				}
			}		 
            
<<<<<<< HEAD
			if ($(elm).hasClass('video')) $(elm).css({'height':'195', 'width':'240'});
=======
			if ($(elm).hasClass('video')) $(elm).css({'height':'155', 'width':'240'});
>>>>>>> 6c98abe1772eba027aad12d429005e0cf1143103
            
			// Adds delete button unless the author made it uneditable
			
			if (page_elements_json[i].editable == 'Y' || page_elements_json[i].author == username) {
				var delete_button = $('<a href="' + page_elements_json[i].id + '">');
				$(delete_button).addClass("delete_button");
				$(elm).append(delete_button);
			}
			
			// adds new element to the array
			page_elements.push(elm);
		}
		
		// adds all the elements in the array to the page.
		$('body').append(page_elements);
	}
	
	
	// ----------------------------------------------- TEXT
	function initText(elm, index)
	{
		// display the content not the description
		$(elm).append('<div class="text-content" jsonindex="'+index+'">' + page_elements_json[index].contents + '</div>');
	}
	
	// ----------------------------------------------- IMAGE
	function initImage(elm, index)
	{
		$(elm).html('<img width="100%" height="100%" src="' + base_url + 'assets/image/' + page_elements_json[index].filename + '" />');
	}
	
	// ----------------------------------------------- AUDIO
	function initAudio(elm, index)
	{
        
<<<<<<< HEAD
		$(elm).css("height","30px");
=======
		$(elm).css("height","62px");
		$(elm).css("width", "352px"); 
>>>>>>> 6c98abe1772eba027aad12d429005e0cf1143103
		var filename_NoExt = page_elements_json[index].filename.split('.');
		var audio_html = '<audio controls preload="none" style="width:320px";>';
		audio_html = audio_html + '<source src="' + base_url + 'assets/audio/' + filename_NoExt[0] + '.mp3" type="audio/mpeg">';
		audio_html = audio_html + '<source src="' + base_url + 'assets/audio/' + filename_NoExt[0] + '.oga" type="audio/ogg">';
<<<<<<< HEAD
		audio_html = audio_html + '</audio>';	
=======
		audio_html = audio_html + '</audio><span>'+page_elements_json[index].description+'</span>';	
>>>>>>> 6c98abe1772eba027aad12d429005e0cf1143103
		//audio_html = audio_html + '<p><strong>Download Audio: </strong><a href="' + base_url + 'assets/audio/' + filename_NoExt[0] + '.mp3">MP3</a></p>';
		
		var audio_element = $(audio_html);
		$(elm).append(audio_element);
	}
	// ----------------------------------------------- VIDEO
	function initVideo(elm, index)
	{
<<<<<<< HEAD
=======
	  
>>>>>>> 6c98abe1772eba027aad12d429005e0cf1143103
		var filename_NoExt = page_elements_json[index].filename.split('.');
        var video_html = '<a class="videoLink" videofile="' + filename_NoExt[0];
		video_html = video_html + '" videowidth="640" videoheight="'+(Math.round((640/page_elements_json[index].width)*page_elements_json[index].height)+65)+'"';
		video_html = video_html + ' videocaption="' + page_elements_json[index].description + '"></a>';
        //video_html = video_html + '<p style="text-align:center;";><strong>Download Video: </strong><a href="' + base_url + 'assets/video/' + filename_NoExt[0] + '.mp4">MP4</a></p>';
        var video_element = $(video_html);
		
		$(elm).append(video_element);
	}
	
	// Updates only the changes that have been made
	function updateElement(elementId, change, alt)
    {
	
		// creates an object with only the id 
		var changes = {'id':elementId};
		
		// adds the specific changes to the object
		switch(change)
		{
			case 'size':
<<<<<<< HEAD
				// updates width and height
				changes.width = parseInt($('#' + elementId).css('width'), 10);
				changes.height = parseInt($('#' + elementId).css('height'), 10);
				// only update font size if the element type is text (found some problems with positions otherwise)
				if ($('#' + elementId).hasClass('text')) changes.fontSize = $('#' + elementId).css('font-size');
=======
				var textContents = $('#' + elementId).text();
				window.parent.$("#textSizer").text(textContents);
				window.parent.$("#textSizer").css("fontSize", $('#' + elementId).css('font-size')+"px");
				if (window.parent.$("#textSizer").width()>320){
				  window.parent.$("#textSizer").width(320);
				}
				var widthVal = window.parent.$("#textSizer").width()+20;
				var heightVal = window.parent.$("#textSizer").height()+20;
	  
	  
				// updates width and height
				changes.width = parseInt($("#textSizer").css('width'), 10);
				changes.height = parseInt($("#textSizer").css('height'), 10);
				// only update font size if the element type is text (found some problems with positions otherwise)
				if ($('#' + elementId).hasClass('text')) {
				  changes.fontSize = $('#' + elementId).css('font-size');
				}
>>>>>>> 6c98abe1772eba027aad12d429005e0cf1143103
				break;
			case 'position':
				// changes the x and y for left and top ( tut tut  for mixing up terminology from data base to css )
				changes.x = parseInt($('#' + elementId).css('left'), 10);
				changes.y = parseInt(	$('#' + elementId).css('top'), 10);
				break;
			case 'text-content':
                // puts the specified text (alt) into 'changes' object
				changes.contents = alt;
				break; 
		}
<<<<<<< HEAD
=======

>>>>>>> 6c98abe1772eba027aad12d429005e0cf1143103
		
		// Ajax the values to the pages controller  
		$.ajax({
			url		: base_url + 'index.php/elements/update',
			data	: changes,
			type	: 'POST',
			success	: function(data, status)
			{
				if (change=="text-content"){
                    window.location.href = window.location.href;
                }
			}
		});
	}
	
	// creates a div and sets its innerHTML to input specified, return length of nodes created
	function htmlDecode(input)
    {
	  var e = document.createElement('div');
	  e.innerHTML = input;
	  return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
	}
	
	// removes any selection
    function clearSelection() {
    	if(document.selection && document.selection.empty) {
        	document.selection.empty();
    	} else if(window.getSelection) {
        	var sel = window.getSelection();
        	sel.removeAllRanges();
    	}
	}
    
    // lists an object as a json string
    function jsonList(obj){
        var acc = []
        $.each(obj.html, function(index, value) {
            acc.push(index + ': ' + value);
        });
        return (JSON.stringify(acc));
    }
	
	// function for changing text colour
	$('#text_colour').colorPicker();
	$('#element_colour').colorPicker();
	
})($);
</script>
