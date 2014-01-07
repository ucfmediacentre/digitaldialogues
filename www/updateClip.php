<?php
session_start();

$id=$_GET["id"];
$altText=$_GET["altText"];
$inPoint=$_GET["inPoint"];
$outPoint=$_GET["outPoint"];
$duration=$_GET["duration"];

//typical feed given: updateClip.php?id=457&altText=something&inPoint=0&outPoint=200
/*echo "id=".$id."\n";
echo "altText=".$altText."\n";
echo "inPoint=".$inPoint."\n";
echo "outPoint=".$outPoint."\n";
exit;*/

//connect to database
$db = mysql_connect($_SESSION['serverName'], $_SESSION['userName'], $_SESSION['pword']);
if (!$db) {
	echo "Error: Could not connect to database. Please try again later.";
	exit;
}
mysql_select_db($_SESSION['databaseName']);
$json = array();


$timeline = array(
				  "in" => $inPoint,
				  "out" => $outPoint,
				  "duration" => $duration
				  );

$timelineJSON = json_encode($timeline);

$query = "UPDATE `elements` SET `timeline`='".$timelineJSON."' WHERE `id` = '".$id."';";
//echo "query=".$query;
//exit;
mysql_query($query);

$query = "UPDATE `elements` SET `description`='".$altText."' WHERE `id` = '".$id."';";
mysql_query($query);

mysql_close($db);
//echo $query;
?>