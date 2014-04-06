<!DOCTYPE html>
<html lang="en">
<head>
  
	<meta charset="UTF-8">
	<title>UCF Media Centre</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    
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
          <a class="brand" href="#">UCF Media Centre</a>
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
            <iframe src="http://localhost/~alcwynparker/wowzainterface/client/live.html" width="700" height="500" frameborder="0" allowtransparency="true" noresize="noresize" scrolling="no"></iframe>
            
            
          </div>
          </div>
          </div>

      <hr>

      <footer>
        <p>Rural Connective - 2012</p>
      </footer>

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
  </body>
</html>
