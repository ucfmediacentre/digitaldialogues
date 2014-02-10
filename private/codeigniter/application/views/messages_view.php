<?php
	
	$messagesList = '';
	if (count($messages) == 0){
		if ($type == 'All messages') {
			$messagesList = "<H2 style='color:gray;'>You have no messages</H2>";
		} else {
			$messagesList = "<H2 style='color:gray;'>You have no new messages</H2>";
		}
		$message_id="0";
	} else {
		foreach($messages as $item):
			//get details of each message
			$subject = $item['subject'];
			$fromName = $item['fromName'];
			$body = $item['body'];
			$dateTime = $item['dateTime'];
			$unread = $item['unread'];
			$message_id = $item['message_id'];
			
			// iterate through all the items found in the messages array and form output
			if ($type == "All messages") {
				$messagesList = $messagesList . "<H2 style='color:gray;'>" . $subject . "&nbsp;<input type='button' value='Delete' style='font-size:12px; width:4em;  height:0.5em;' onclick='delete_message($message_id, &#39;$username&#39;)'></H2>";
			} else {
				$messagesList = $messagesList . "<H2 style='color:gray;'>" . $subject . "&nbsp;<input type='button' value='Mark as read' style='font-size:12px; width:7em;  height:0.5em;' onclick='mark_as_read($message_id, &#39;$username&#39;)'></H2>";
			
			}
			$messagesList = $messagesList . "<span  style='color:gray;'><From: " . $fromName . "<br />";
			$messagesList = $messagesList . "Date: " . $dateTime . "</span><br /><br />";
			$messagesList = $messagesList . $body . "<br />";
			$messagesList = $messagesList . "<hr />";	
		endforeach; 
	}
?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Digital Dialogues : <?php echo $type ?> for <?php echo $username ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/normalize.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/main.css">
      
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
        <script src="<?php echo base_url(); ?>js/vendor/jquery-1.8.3.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>libraries/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
		<script src="<?php echo base_url(); ?>js/vendor/jquery.ui.touch-punch.min.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <div id="messagesTitle"><h1><?php echo $type ?> for <?php echo $username ?></h1><br /></div>
		<div id="main_pages_wrapper">
			<a href="../../pages/view/public/home">public : Home</a>&nbsp;|&nbsp;<a href="../../pages/view/sandpit/home">Sandpit</a>&nbsp;|&nbsp;<a href="../../pages/view/help/home">Help</a>
			<br />
			<a href="<?php echo base_url().'index.php/messages/view/'.$username ?>">View unread messages</a>&nbsp;|&nbsp;<a href="<?php echo base_url().'index.php/messages/view_all/'.$username ?>">View all messages</a><!--&nbsp;|&nbsp;<a id="add_message_form_trigger" href="#add_message_form">Create new message</a>/-->
		</div>
		
		<div>
			<div id="messages"><?php echo $messagesList; ?></div>
		</div>
		<script>
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

        <script src="<?php echo base_url(); ?>js/plugins.js"></script>
        <script src="<?php echo base_url(); ?>js/main.js"></script>

        <!-- Google Analytics -->
        <script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		
		  ga('create', 'UA-39728808-1', 'ucfmediacentre.co.uk');
		  ga('send', 'pageview');
		
		</script>
    </body>
</html>
