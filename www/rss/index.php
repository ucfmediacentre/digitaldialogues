<?php
    session_start();
    
    header("Content-Type: application/rss+xml; charset=ISO-8859-1");
    
	include '../../../dbInfoSwarmTV.php';
      
    DEFINE ('DB_USER', $_SESSION['userName']);  
	DEFINE ('DB_PASSWORD', $_SESSION['pword']);  
	DEFINE ('DB_HOST', $_SESSION['serverName']);  
	DEFINE ('DB_NAME', $_SESSION['databaseName']);
	
	$rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
	$rssfeed .= '<rss version="2.0">';
	$rssfeed .= '<channel>';
	$rssfeed .= '<title>FU Swarm TV RSS feed</title>';
	$rssfeed .= '<link>http://www.ucfmediacentre.co.uk/swarmtv/</link>';
	$rssfeed .= '<description>Latest edits on Swarm TV</description>';
	$rssfeed .= '<language>en-us</language>';
	$rssfeed .= '<copyright>Copyright (C) 2013 swarmtv.org</copyright>';
	$connection = @mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
        or die('Could not connect to database');
    mysql_select_db(DB_NAME)
        or die ('Could not select database');
 
    $query = "SELECT * FROM `updates` ORDER BY `pubDate` DESC LIMIT 0,50";
    $result = mysql_query($query) or die ("Could not execute query");
 
    while($row = mysql_fetch_array($result)) {
        extract($row);
 
        $rssfeed .= '<item>';
        $rssfeed .= '<title>' . $title . '</title>';//e.g. audio element moved
        $rssfeed .= '<description>' . $description . '</description>';// finer details about edit e.g. json array of element properties
        $rssfeed .= '<link>' . $link . '</link>';//link to page
        $rssfeed .= '<pubDate>' . date("D, d M Y H:i:s O", strtotime($pubDate)) . '</pubDate>';//time
        $rssfeed .= '</item>';
    }
 
    $rssfeed .= '</channel>';
    $rssfeed .= '</rss>';
 
    echo $rssfeed;
?>