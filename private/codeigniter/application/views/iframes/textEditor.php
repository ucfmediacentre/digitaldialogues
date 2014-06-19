<div id="editingContent">
  <form name="editorForm" id="editorForm" class="input_form">
	<br />
	<textarea name="contents" id="textContents"><?php echo $contents; ?></textarea><br />
	  <!--PAGE-->
	  <!--<label>
		Place on page:
	  </label>
	  <select name="pageTitle" id="pageTitle">
		<option>Home</option>
		<option>Sandpit</option>
		<option>Help</option>
		<!--<?php echo $pageOptions ?>
	  </select>//-->
	  <br />
	
	<div id="editingStyle">
	  <br />
	  <!--COLOUR-->
	  <label>
		<input type="radio" name="RadioGroup1" id="colorButton" value="color" checked="checked" />&nbsp;
		Colour
	  </label>
	  <input name="color" id="color" type="text" value="<?php echo $color; ?>" />
	  <br /><br />
	  <!--BACKGROUND COLOUR-->
	  <label>
		<input type="radio" name="RadioGroup1" id="backgroundColorButton" value="backgroundColor" />&nbsp;
		Background
	  </label>
	  <input name="backgroundColor" id="backgroundColor" type="text" value="<?php echo $backgroundColor; ?>" />
	  <br /><br />
	  <!--FONT SIZE-->
	  <label>
		<input type="radio" name="RadioGroup1" id="fontSizeButton" value="fontSize" />
		Font Size
	  </label>
	  <input name="fontSize" id="fontSize" type="text" value="<?php echo $fontSize; ?>" />&nbsp;
	  <br /><br />
	  <!--FONT FAMILY-->
	  <label>
		<input type="radio" name="RadioGroup1" id="fontFamilyButton" value="fontFamily" />
		Font Family
	  </label>
	  <input name="fontFamily" id="fontFamily" type="text" value="<?php echo $fontFamily; ?>" />&nbsp;
	  <br /><br />
	  <!--TEXT ALIGN-->
	  <label>
		<input type="radio" name="RadioGroup1" id="textAlignButton" value="textAlign" />
		Text Align
	  </label>
	  <input name="textAlign" id="textAlign" type="text" value="<?php echo $textAlign; ?>" />&nbsp;
	  <br /><br />
	  <div id="slider" style="width: 420px; margin-left: 10px; margin-right: 10px; margin-top: 5px;"></div>
	</div>
	<div id="editingObject"">
	  <br />
	  <!--OPACITY-->
	  <label>
		<input type="radio" name="RadioGroup1" id="opacityButton" value="opacity" />&nbsp;
		Opacity
	  </label>
	  <input id="opacity" name="opacity" id="opacity" type="text" value="<?php echo $opacity; ?>" />
	  <br /><br />
	  <!--WIDTH-->
	  <label>
		<input type="radio" name="RadioGroup1" id="widthButton" value="width" />&nbsp;
		Width
	  </label>
	  <input name="width" id="width" type="text" value="<?php echo $width; ?>" />
	  <br /><br />
	  <!--HEIGHT-->
	  <label>
		<input type="radio" name="RadioGroup1" id="heightButton" value="height" />&nbsp;
		Height
	  </label>
	  <input name="height" id="height" type="text" value="<?php echo $height; ?>" />
	  <br /><br />
	  <!--X-->
	  <label>
		<input type="radio" name="RadioGroup1" id="xButton" value="x" />&nbsp;
		X position
	  </label>
	  <input name="x" id="x" type="text" value="<?php echo $x; ?>" />
	  <br /><br />
	  <!--Y-->
	  <label>
		<input type="radio" name="RadioGroup1" id="yButton" value="y" />&nbsp;
		Y position
	  </label>
	  <input name="y" id="y" type="text" value="<?php echo $y; ?>" />
	  <br /><br /><br />
	  </div><br /><br />
	  <div id="editingSubmit"><br />
		<input type="submit" id="remove_element" value="Remove" class="submit_button"  />
		<input type="submit" id="copy_element" value="Copy" class="submit_button"  />
		<input type="submit" id="submit_element" value="Update" class="submit_button"  />
	  </div>
	  <br />
	</div>
	
	<!--all fields in element database//-->
	<input type="hidden" name="attribution" value="<?php echo $attribution; ?>">
	<input type="hidden" name="author" value="<?php echo $author; ?>">
	<!--<input type="hidden" name="backgroundColor" value="<?php echo $backgroundColor; ?>">
	<input type="hidden" name="color" value="<?php echo $color; ?>">
	<input type="hidden" name="contents" value="<?php echo $contents; ?>">//-->
	<input type="hidden" name="created" value="<?php echo $created; ?>">
	<input type="hidden" name="description" value="<?php echo $description; ?>">
	<input type="hidden" name="editable" value="<?php echo $editable; ?>">
	<input type="hidden" name="filename" value="<?php echo $filename; ?>">
	<!--<input type="hidden" name="fontFamily" value="<?php echo $fontFamily; ?>">
	<input type="hidden" name="fontSize" value="<?php echo $fontSize; ?>">//-->
	<input type="hidden" name="height" value="<?php echo $height; ?>">
	<input type="hidden" name="groupName" value="<?php echo $groupName; ?>">
	<input type="hidden" name="id" value="<?php echo $elementId; ?>">
	<input type="hidden" name="keywords" value="<?php echo $keywords; ?>">
	<input type="hidden" name="license" value="<?php echo $license; ?>">
	<input type="hidden" name="linkPageIds" value="<?php echo $linkPageIds; ?>">
	<!--<input type="hidden" name="opacity" value="<?php echo $opacity; ?>">//-->
	<input type="hidden" name="pages_id" value="<?php echo $pages_id; ?>">
	<input type="hidden" name="pageName" value="<?php echo $pageName; ?>">
	<input type="hidden" name="textAlign" value="<?php echo $textAlign; ?>">
	<input type="hidden" name="timeline" value="<?php echo $timeline; ?>">
	<input type="hidden" name="type" value="<?php echo $type; ?>">
	<!--<input type="hidden" name="width" value="<?php echo $width; ?>">
	<input type="hidden" name="x" value="<?php echo $x; ?>">
	<input type="hidden" name="y" value="<?php echo $y; ?>">//-->
	<input type="hidden" name="z" value="<?php echo $z; ?>">
  </form>
</div>
<script language="JavaScript" type="text/javascript">
  <!--
  $(function() {
	  //initialize the form with focus on color
	  updateSlider();
	  $( "#slider" ).css('background', '#c0c0e0');
	  $( "#slider .ui-slider-range" ).css('background', '#c0c0e0');
	  $( "#slider .ui-slider-handle" ).css('border-color', '#668');
  });
  
  $('#editorForm input').on('focus', function() {
	var $fieldFocus = $(':focus').attr("id");
	$("#"+$fieldFocus+"Button").prop("checked", true);
	updateSlider();
  });
  
  $('#editorForm input').on('change', function() {
	  var buttonName = $('input[name=RadioGroup1]:checked', '#editorForm').val();
	  updateSlider();
  });

$('#submit_element').click(function(e){
  e.preventDefault();
  
  calculateTextArea();
  
  // get the values from the form
  var authorVal = $('#author').val();
  var backgroundColorVal = $('#backgroundColor').val();
  var colorVal = $('#color').val();
  var contentsVal = $('textarea#textContents').val();
  var fontFamilyVal = $('#fontFamily').val();
  var fontSizeVal = $('input[name="fontSize"]').val();
  var heightVal = $('input[name="height"]').val();
  var idVal = $('input[name="id"]').val();
  var opacityVal = $('input[name="opacity"]').val();
  var pageTitleVal = $('input[name="pageTitle"]').val();
  var pagesIdVal = $('input[name="pages_id"]').val();
  var textAlignVal = $('#textAlign').val();
  var widthVal = $('input[name="width"]').val();
  var xVal = $('input[name="x"]').val();
  var yVal = $('input[name="y"]').val();
  
  // Post the values to the pages controller
  var base_url = "<?php echo base_url(); ?>";
  $.post(base_url + "index.php/elements/update", { author: authorVal, backgroundColor: backgroundColorVal, color: colorVal, contents: contentsVal, fontFamily: fontFamilyVal, fontSize: fontSizeVal, height: heightVal, id: idVal, opacity: opacityVal, pages_id: pagesIdVal, textAlign: textAlignVal, width: widthVal, x: xVal, y: yVal },
	function(data) {
	// Refresh page
	window.top.location.reload();
  });
});


$('#remove_element').click(function(e){
  e.preventDefault();
  removeElement();
});


$('#copy_element').click(function(e){
  e.preventDefault();
  
  var base_url = "<?php echo base_url(); ?>";
  var idVal = $('input[name="id"]').val();
  //change the action and method of the form and then submit it
  $("#editorForm").attr("action", base_url + "index.php/iframe/copyText/"+idVal);
  $("#editorForm").attr("method", "post");
  $("#editorForm").submit();
});


function updateSlider(){
  //check the field that is selected
  var buttonName = $('input[name=RadioGroup1]:checked', '#editorForm').val();
  
  switch(buttonName){
    case "backgroundColor":
      var coloursArray=new Array("", "Aqua", "Black", "Blue", "Fuchsia", "Gray", "Green", "Lime", "Maroon", "Navy", "Olive", "Purple", "Red", "Silver", "Teal", "White", "Yellow");
      for (i=0;i<17;i++){
        if (coloursArray[i].toUpperCase() == $("#"+buttonName).val().toUpperCase()) {
          break;
        }
      }
      $( "#slider" ).slider({
		min: 0,
		max: 16,
		value: i,
		slide: function( event, ui ) {
		  //if slider is moved, set appropriate value in the field
		  $("#backgroundColor").val(coloursArray[ui.value]);
		}
	  });
      break;
  	case "color":
      var coloursArray=new Array("Aqua", "Black", "Blue", "Fuchsia", "Gray", "Green", "Lime", "Maroon", "Navy", "Olive", "Purple", "Red", "Silver", "Teal", "White", "Yellow");
      for (i=0;i<16;i++){
        if (coloursArray[i].toUpperCase() == $("#"+buttonName).val().toUpperCase()) {
          break;
        }
      }
      $( "#slider" ).slider({
		min: 0,
		max: 15,
		value: i,
		slide: function( event, ui ) {
		  //if slider is moved, set appropriate value in the field
		  $("#color").val(coloursArray[ui.value]);
		}
	  });
      break;
    case "fontSize":
	  fontSize = $("#fontSize").val();
	  $( "#slider" ).slider({
		min: 0,
		max: 100,
		value: fontSize,
		slide: function( event, ui ) {
		  $("#fontSize").val( ui.value );
		}
	  });
      break;
    case "fontFamily":
      var fontArray=new Array("Arial", "Courier", "Georgia", "Helvetica", "Sans-serif", "Serif", "Tahoma", "Times New Roman", "Verdana");
      for (i=0;i<9;i++){
        if (fontArray[i].toUpperCase() == $("#"+buttonName).val().toUpperCase()){
          break;
        }
      }
      $( "#slider" ).slider({
		min: 0,
		max: 8,
		range: "min",
		value: i,
		slide: function( event, ui ) {
		  //if slider is moved, set appropriate value in the field
		  $("#fontFamily").val(fontArray[ui.value]);
		}
	  });
      break;
    case "height":
	  height = $("#height").val();
	  $( "#slider" ).slider({
		min: 0,
		max: 450,
		value: height,
		slide: function( event, ui ) {
		  $("#height").val( ui.value );
		}
	  });
      break;
    case "opacity":
	  opacity = $("#opacity").val();
	  $( "#slider" ).slider({
		min: 0,
		max: 100,
		value: opacity*100,
		slide: function( event, ui ) {
		  $("#opacity").val( ui.value/100 );
		}
	  });
      break;
    case "textAlign":
      var alignArray=new Array("Left", "Center", "Justify", "Right");
      for (i=0;i<4;i++){
        if (alignArray[i].toUpperCase() == $("#"+buttonName).val().toUpperCase()){
          break;
        }
      }
      $( "#slider" ).slider({
		min: 0,
		max: 3,
		range: "min",
		value: i,
		slide: function( event, ui ) {
		  //if slider is moved, set appropriate value in the field
		  $("#textAlign").val(alignArray[ui.value]);
		}
	  });
      break;
    case "width":
	  width = $("#width").val();
	  $( "#slider" ).slider({
		min: 0,
		max: 800,
		value: width,
		slide: function( event, ui ) {
		  $("#width").val( ui.value );
		}
	  });
      break;
    case "x":
	  x = $("#x").val();
	  $( "#slider" ).slider({
		min: 0,
		max: 1600,
		value: x,
		slide: function( event, ui ) {
		  $("#x").val( ui.value );
		}
	  });
      break;
    case "y":
	  y = $("#y").val()
	  $( "#slider" ).slider({
		min: 0,
		max: 900,
		value: height,
		slide: function( event, ui ) {
		  $("#y").val( ui.value );
		}
	  });
      break;
  }
}

function calculateTextArea(){
	  var text_form_text = $('#textContents').val();
	  var vFontSize = $("#fontSize").val();
	  vFontSize = vFontSize.toString()+"px";
	  window.parent.$("#textSizer").text(text_form_text);
	  window.parent.$("#textSizer").css("font-size", vFontSize);
	  if (window.parent.$("#textSizer").width()>320){
		window.parent.$("#textSizer").width(320);
	  }
	  var widthVal = window.parent.$("#textSizer").width()+20;
	  $("#width").val( widthVal );
	  var heightVal = window.parent.$("#textSizer").height()+20;
	  $("#height").val( heightVal );
}

function removeElement(elementId){
  inputClick=confirm("Are you sure you want to remove this text?");
  if (inputClick) {
	var base_url = "<?php echo base_url(); ?>";
    // Output when OK is clicked
    $.ajax({
		url		: base_url + 'index.php/elements/delete/' + elementId,
		type	: 'GET',
		success	: function(data, status)
		{
			window.top.location.reload();
		} 
	});
  } else {
    // Output when Cancel is clicked
    return false;
  }
}
//-->
</script>
</body>
</html>