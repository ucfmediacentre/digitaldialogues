<!DOCTYPE html>
<html lang="en">
<head>
  
	<meta charset="UTF-8">
	<title>Swarm TV Streaming video</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <link rel="stylesheet" href="../css/main.css" type="text/css" />
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
   


    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

   
  </head>
  
<body>
 

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Ableton Live</a>
		  <a id="main_home_button" href="../index.php/swarmtv/map/isea">&nbsp;</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Username: <a href="#" id="username"class="navbar-link"> </a>
            </p>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <div class="span3">
          <div class="well sidebar-nav">
            
				<br />
    			<h2>Chat box</h2>
    
    			<p id="name-area"></p>
    	
    			<div id="chat-wrap"><div id="chat-area"></div></div>
    
                <form id="send-message-area">
                   
                    <textarea id="send" maxlength = '100' placeholder="Your message:"></textarea>
                </form>
            
            
          </div><!--/.well -->
        </div><!--/span-->
        <div class="span9">
          <div class="hero-unit">
            <h2>Live Video</h2>
            <iframe src="http://www.ucfmediacentre.co.uk/wowzainterface/client/live.html" width="700" height="500" frameborder="0" allowtransparency="true" noresize="noresize" scrolling="no"></iframe>
            
		<p><b> Do not change the settings! </b>  Click <b>Play</b> to connect to the stream<br /> - The stream won't be active until - 10:00am (UK time) 28th May 2013</p>            
          </div>
          </div>
          </div>

    </div><!--/.fluid-container-->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!--
    <script src="js/bootstrap-transition.js"></script>
    <script src="js/bootstrap-alert.js"></script>
    <script src="js/bootstrap-modal.js"></script>
    <script src="js/bootstrap-dropdown.js"></script>
    <script src="js/bootstrap-scrollspy.js"></script>
    <script src="js/bootstrap-tab.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/bootstrap-popover.js"></script>
    <script src="js/bootstrap-button.js"></script>
    <script src="js/bootstrap-collapse.js"></script>
    <script src="js/bootstrap-carousel.js"></script>
    <script src="js/bootstrap-typeahead.js"></script>
	-->
     <script type="text/javascript" src="js/chat.js"></script>
        <!-- Google Analytics -->
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
          
            ga('create', 'UA-39728808-1', 'ucfmediacentre.co.uk');
            ga('send', 'stream');
          
        </script>
  </body>
</html>
