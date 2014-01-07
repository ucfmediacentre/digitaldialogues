<?php
session_start();
//normal page passes URL in the form of http://swarmtv.org/viewer.php?id=123
include_once "../../dbinfo.php";

//get variables from URL
$id = $_GET['id'];
$width = $_GET['width'];
$height = $_GET['height'];
$in = 0;
$out = null;

//connect to database
$db = mysql_connect($_SESSION['serverName'], $_SESSION['userName'], $_SESSION['pword']);
if (!$db) {
	echo "Error: Could not connect to database. Please try again later.";
	exit;
}
mysql_select_db($_SESSION['databaseName']);
$json = array();

$query = "SELECT * FROM `elements` WHERE `id` = '".$id."'";
//echo $query."<br>";
$result = mysql_query($query);
$record = mysql_fetch_assoc($result);
//echo $record['filename']."<br>";

$altText = $record['description'];
$timelineJSON = $record['timeline'];
$timeline = json_decode($timelineJSON);
$in = $timeline->in;
$out = $timeline->out;
$duration = $timeline->duration;
$filename=substr($record['filename'], 0 , -4);
//$height=$record['height'];
//$width=$record['width'];
//echo "altText = ".$altText;
//echo "filename = ".$filename;
//echo "height = ".$height;
//echo "width = ".$width;
//$json[]=array("name" => $record['filename'], "in" => $in, "out" => $out);

/*$myDirtyString=json_encode($json);
$jsonClip = str_replace("\/","/",$myDirtyString);
echo $jsonClip;
exit;*/
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Clip Player</title>
<style type="text/css">
body,td,th {
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-size: 10px;
	color: #666;
}</style>
<script type="application/javascript" src="js/vendor/jquery-1.8.3.min.js"></script>
<script type="application/javascript" src="js/popcorn.js"></script>
<script type="application/javascript" src="js/videoExtension.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	/*sDuration = <?php echo $out ?>;
	//alert(sDuration);
	sHours = Math.floor(sDuration/3600);
	if (sHours<10) {sDurationString="0"+sHours;}
	sMins = Math.floor((sDuration-(sHours*3600))/60);
	sDurationString=sDurationString+":";
	if (sMins<10) {sDurationString=sDurationString+"0"+sMins;} else {sDurationString=sDurationString+sMins;}
	sSecs = sDuration - ((sHours*3600)+sMins*60);
	sDurationString=sDurationString+":";
	if (sSecs<10) {sDurationString=sDurationString+"0"+sSecs;} else {sDurationString=sDurationString+sSecs;}*/
	//alert(sDurationString);
	$("#clipLabel").html('(<?php echo $filename ?>'+videoExtension+')');/*+sDurationString);*/
	
	// trigger the fancy box on double click
		/*$('#setThumb').click(function(){
			setThumbnail(<?php echo $id ?>);
		});*/
});

function setIn(videoID, videoIn){
	var In = myClip.currentTime()
	$('#videoInField').val(In);
	var altText = document.getElementsByName('videoCaption')[0].value;
	var inPoint = videoIn;
	var outPoint = document.getElementsByName('videoOutField')[0].value;
	var duration = document.getElementsByName('videoDuration')[0].value;
	updateEdit(videoID, altText, inPoint, outPoint, duration);
}

function setOut(videoID, videoOut){
	var Out = myClip.currentTime()
	$('#videoOutField').val(Out);
	var altText = document.getElementsByName('videoCaption')[0].value;
	var inPoint = document.getElementsByName('videoInField')[0].value;
	var outPoint = videoOut;
	var duration = document.getElementsByName('videoDuration')[0].value;
	updateEdit(videoID, altText, inPoint, outPoint, duration);
}

function updateIn(videoID, videoIn){
	//var In = myClip.currentTime()
	$('#videoInField').val(videoIn);
	var altText = document.getElementsByName('videoCaption')[0].value;
	var inPoint = videoIn;
	var outPoint = document.getElementsByName('videoOutField')[0].value;
	var duration = document.getElementsByName('videoDuration')[0].value;
	updateEdit(videoID, altText, inPoint, outPoint, duration);
}

function updateOut(videoID, videoOut){
	//var Out = myClip.currentTime()
	$('#videoOutField').val(videoOut);
	var altText = document.getElementsByName('videoCaption')[0].value;
	var inPoint = document.getElementsByName('videoInField')[0].value;
	var outPoint = videoOut;
	var duration = document.getElementsByName('videoDuration')[0].value;
	updateEdit(videoID, altText, inPoint, outPoint, duration);
}


function setText(videoID, altText){
	//alert("setText:"+"updateClip.php?id="+videoID+"&altText="+altText);
	var altText = document.getElementsByName('videoCaption')[0].value;
	var inPoint = document.getElementsByName('videoInField')[0].value;
	var outPoint = document.getElementsByName('videoOutField')[0].value;
	var duration = document.getElementsByName('videoDuration')[0].value;
	updateEdit(videoID, altText, inPoint, outPoint, duration);
}

function updateEdit(videoID, altText, inPoint, outPoint, duration){
	//alert("updateEdit:"+"updateClip.php?id="+videoID+"&altText="+altText+"&inPoint="+inPoint+"&outPoint="+outPoint);
	var altText = document.getElementsByName('videoCaption')[0].value;
	var inPoint = document.getElementsByName('videoInField')[0].value;
	var outPoint = document.getElementsByName('videoOutField')[0].value;
	var duration = document.getElementsByName('videoDuration')[0].value;
	$.ajax({
		url: "updateClip.php?id="+videoID+"&altText="+altText+"&inPoint="+inPoint+"&outPoint="+outPoint+"&duration="+duration,
		success: function(data) {
			//alert(data);
			//alert('Load was performed.');
		}
	});
}

function setThumbnail(id){
	var currentPos = myClip.currentTime();
	
	$.ajax({
		url: "setThumbnail.php?id="+id+"&currentPos="+currentPos,
		success: function(data) {
//			alert(data);
			//alert('Load was performed.');
		}
	});
}
</script>
</head>

<body>

<table cellpadding="2">
	<tr>
		<td colspan="3">
			<!--<video height="<?php echo $height-100 ?>" width="<?php echo $width-25 ?>" id="clipToShow" controls>-->
			<video height="<?php echo $height-100 ?>" width="<?php echo $width-25 ?>" id="clipToShow" controls>
				<source src="assets/video/<?php echo $filename ?>.mp4">
				<source src="assets/video/<?php echo $filename ?>.ogv">
			</video>
		</td>
	</tr>
	<tr>
		<td align="left" valign="bottom">
<!--			<button type="button" id="setThumb" onClick="setThumbnail('<?php echo $id ?>');">Set Thumbnail</button>-->
		</td>
		<td>&nbsp;</td>
		<td align="right">
			Clip Description: <input type="text" name="videoCaption" id="videoCaption" value='<?php echo $altText ?>' />
			<button type="button" onClick="updateEdit('<?php echo $id ?>');">Update</button>
			<input type="hidden" name="videoDuration" id="videoDurationField" value='<?php echo $duration ?>');"/>
		</td>
	</tr>
	<tr>
		<td align="left" valign="bottom">
			<input type="text" name="videoInField" id="videoInField" value='<?php echo $in ?>' size="10"  onChange="updateIn('<?php echo $id ?>', this.value);" />
			<button type="button" onClick="setIn('<?php echo $id ?>', '<?php echo $in ?>');">Set In</button>
		</td>
		<td><span id="clipLabel"></span></td>
		<td align="right"  valign="bottom">
			<input type="text" name="videoOutField"  id="videoOutField" value='<?php echo $out ?>' size="10"   onChange="updateOut('<?php echo $id ?>', this.value);"/>
			<button type="button" onClick="setOut('<?php echo $id ?>', '<?php echo $out ?>');">Set Out</button>
		</td>
	</tr>
</table>
    
<script type="text/javascript">

//create popcorn object
var myClip = Popcorn("#clipToShow");


myClip.mute();

if (<?php echo round($in) ?>!=0){
	myClip.exec( 0.001, function() {
		this.play( <?php echo round($in) ?> );
		myClip.unmute();
		//while were here, get the duration of the clip and store in the hidden field.
		duration = myClip.duration();
		document.getElementsByName('videoDuration')[0].value = duration;
	});
} else {
	myClip.unmute();
}

myClip.exec( <?php echo round($out) ?>, function() {
    this.pause();
});


// play the video
myClip.play();

</script>
</body>
</html>
