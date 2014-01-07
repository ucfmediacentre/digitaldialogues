<?php

	$changesList = '';
	foreach($res_feed as $item):
		//get page name
		$url = $item->get_link();
		
		$directories = explode('/', $url);
		$page = $directories[sizeof($directories)-1];
		
		//iterate through all the items found in the rss feed and form output
		$changesList = $changesList . "<H2>" . $item->get_title() . " on <a href='" . $item->get_link() . "'>" . urldecode($page) . "</a></H2>";
		$changesList = $changesList . "Changed: " . $item->get_date() . "<br /><br />";
		$changesList = $changesList . $item->get_content() . "<br /><br />";
		$changesList = $changesList . "<hr />";	
	endforeach; 
?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>swarm tv: Recent Changes</title>
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
        <div id="recentChangesTitle"><h1>Recent Changes</h1></div>
		
		<div>
			<div id="recentChanges"><strong>RSS feed: http://ucfmediacentre.co.uk/swarmtv/index.php/feed</strong><br /><br /><?php echo $changesList; ?></div>
		</div>
		<a id="main_home_button" href="<?php echo base_url(); ?>index.php/swarmtv/map/isea">&nbsp;</a>

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
