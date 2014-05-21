/* 
Created by: Kenrick Beckett

Name: Chat Engine
*/

var instanse = false;
var state;
var mes;
var file;

function Chat () {
    this.update = updateChat;
    this.send = sendChat;
	this.getState = getStateOfChat;
}

//gets the state of the chat
function getStateOfChat(){
	if(!instanse){
		 instanse = true;
		 $.ajax({
			   type: "POST",
			   url: "php/process.php",
			   data: {  
			   			'function': 'getState',
						'file': file
						},
			   dataType: "json",
			
			   success: function(data){
				   state = data.state;
				   instanse = false;
			   },
			});
	}	 
}

//Updates the chat
function updateChat(){
	console.log("boom");
	 if(!instanse){
		 instanse = true;
	     $.ajax({
			   type: "POST",
			   url: "php/process.php",
			   data: {  
			   			'function': 'update',
						'state': state,
						'file': file
						},
			   dataType: "json",
			   success: function(data){
				   if(data.text){
						for (var i = 0; i < data.text.length; i++) {
                            $('#chat-area').append($("<p>"+ data.text[i] +"</p>"));
                        }								  
				   }
				   document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
				   instanse = false;
				   state = data.state;
			   },
			});
	 }
	 else {
		 setTimeout(updateChat, 1500);
	 }
}

//send the message
function sendChat(message, nickname)
{       
    updateChat();
     $.ajax({
		   type: "POST",
		   url: "php/process.php",
		   data: {  
		   			'function': 'send',
					'message': message,
					'nickname': nickname,
					'file': file
				 },
		   dataType: "json",
		   success: function(data){
			   updateChat();
		   },
		});
}


//send the message
function updateUsers(nickname)
{
  $.ajax({
		type: "POST",
		url: "php/process.php",
		data: {  
				 'function': 'users',
				 'nickname': nickname,
				 'file': file
			  },
		dataType: "json",
		success: function(data){
		  //alert(data);
		},
	 });
}


// ask user for name with popup prompt    
var name = prompt("Enter your chat name:", "Guest");
	
	// default name is 'Guest'
	if (!name || name === ' ') {
	   name = "Guest";	
	}
	
	// strip tags
	name = name.replace(/(<([^>]+)>)/ig,"");
	
	updateUsers(name);
	
	// display name on page
	$("#username").html("<span>" + name + "</span>");
	
// instantiate chat
var chat =  new Chat();
	
$(function() {
	setInterval('chat.update()', 1000);
	chat.getState(); 
		 
	// watch textarea for key presses
	$("#sendie").keydown(function(event) {  
	
		var key = event.which;  
		
		//all keys including return.  
		if (key >= 33) {
		
			var maxLength = $(this).attr("maxlength");  
			var length = this.value.length;  
			
			// don't allow new content if length is maxed out
			if (length >= maxLength) {  
				event.preventDefault();  
			}  
		}  
																																															});
	// watch textarea for release of key press
	$('#send').keyup(function(e) {	
					 
		//on enter key			 
		if (e.keyCode == 13) { 
		
			var text = $(this).val();
			var maxLength = $(this).attr("maxlength");  
			var length = text.length; 
			 
			// send 
			if (length <= maxLength + 1) { 
			 
				chat.send(text, name);	
				$(this).val("");
				
			} else {
			
				$(this).val(text.substring(0, maxLength));
				
			}	
		}
	});
});