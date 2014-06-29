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
<script type="application/javascript" src="../../../../../js/vendor/jquery-1.8.3.min.js"></script>
<script type="application/javascript" src="../../../../../js/popcorn.js"></script>
<script type="application/javascript" src="../../../../../js/videoExtension.js"></script>
<script type="text/javascript">

var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {
	$("#clipLabel").html('(<?php echo $filename ?>'+videoExtension+')');
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

function updateEdit(videoID){
	//alert("updateEdit:"+"updateClip.php?id="+videoID+"&altText="+altText+"&inPoint="+inPoint+"&outPoint="+outPoint);
	var altText = document.getElementsByName('videoCaption')[0].value;
	var inPoint = document.getElementsByName('videoInField')[0].value;
	var outPoint = document.getElementsByName('videoOutField')[0].value;
	var duration = document.getElementsByName('videoDuration')[0].value;
	
	
	$.ajax({
		url: base_url+"index.php/clip/update/"+videoID+"/"+altText+"/"+inPoint+"/"+outPoint+"/"+duration,
		success: function(data) {
			//alert(data);
			//alert('Load was performed.');
		}
	});
}

function setThumbnail(id){
	var currentPos = myClip.currentTime();
	var altText = document.getElementsByName('videoCaption')[0].value;
	var alert = (altText == "alert") ? 1 : 0;
	$.ajax({
		url: base_url+"index.php/clip/setThumbnail/"+id+"/"+currentPos,
		success: function(data) {
			if (alert == 1) alert(data);
			//alert(data);
			//alert('Load was performed.');
		}
	});
}
</script>
</head>

<body>
<table cellpadding="2">
	<tr>
		<td colspan="3" align="center">
			<video width="480" height="<?php echo intval(480*($height/$width)); ?>" id="clipToShow" controls>
				<source src="../../../../../assets/video/<?php echo $filename ?>.mp4">
				<source src="../../../../../assets/video/<?php echo $filename ?>.ogv">
			</video>
		</td>
	</tr>
	<tr>
		<td align="left" valign="bottom">
			<button type="button" id="setThumb" onClick="setThumbnail('<?php echo $id ?>');">Set Thumbnail</button><br />(This may take a minute to process)
		</td>
		<td>&nbsp;</td>
		<td align="right">
			Clip Description: <input type="text" name="videoCaption" id="videoCaption" value='<?php echo urldecode($description) ?>' />
			<button type="button" onClick="updateEdit('<?php echo $id ?>');">Update</button>
			<input type="hidden" name="videoDuration" id="videoDurationField" value='<?php echo $duration ?>');"/>
		</td>
	</tr>
	<tr>
		<td align="left" valign="bottom">
			<input type="text" name="videoInField" id="videoInField" value='<?php echo $in ?>' size="10"  onChange="updateIn('<?php echo $id ?>', this.value);" />
			<button type="button" onClick="setIn('<?php echo $id ?>', '<?php echo $in ?>');">Set In</button>
		</td>
		<td align="center"><span id="clipLabel"></span></td>
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