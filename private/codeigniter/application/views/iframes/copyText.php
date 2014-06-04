<div id="editingContent">
  <form name="editorForm" id="editorForm" class="input_form">
	<br />
	<textarea name="textContents" id="textContents"><?php echo $contents; ?></textarea><br />
	<!--PAGE-->
	<label>
	  Place in group:
	</label>
	<select name="groupTitle" id="groupTitle">
	  <?php echo $groupString ?>
	</select>
	<br /><br />
	<label>
	  Place on page:
	</label>
	<select name="pageTitle" id="pageTitle">
	</select>
	<br />
	  <div id="editingSubmit"><br />
		<input type="submit" id="submit_element" value="Update" class="submit_button"  />
	  </div>
	
	<!--all fields needed to update in element database//-->
	<input type="hidden" name="backgroundColor" value="<?php echo $backgroundColor; ?>">
	<input type="hidden" name="color" value="<?php echo $color; ?>">
	<input type="hidden" name="contents" value="<?php echo $contents; ?>">
	<input type="hidden" name="fontFamily" value="<?php echo $fontFamily; ?>">
	<input type="hidden" name="fontSize" value="<?php echo $fontSize; ?>">
	<input type="hidden" name="groupname" value="<?php echo $groupName; ?>">
	<input type="hidden" name="height" value="<?php echo $height; ?>">
	<input type="hidden" name="id" value="<?php echo $elementId; ?>">
	<input type="hidden" name="opacity" value="<?php echo $opacity; ?>">
	<input type="hidden" name="pagename" value="<?php echo $pageName; ?>">
	<input type="hidden" name="pages_id" value="<?php echo $pages_id; ?>">
	<input type="hidden" name="textAlign" value="<?php echo $textAlign; ?>">
	<input type="hidden" name="width" value="<?php echo $width; ?>">
	<input type="hidden" name="x" value="<?php echo $x; ?>">
	<input type="hidden" name="y" value="<?php echo $y; ?>">
  </form>
</div>
<script language="JavaScript" type="text/javascript">
  <!--
  $(document).ready(function(){
	var optionNum = $('#groupTitle').children(":selected").attr("id");
	var groupsList = <?php echo json_encode($groupsList); ?>;
	//var groupsList = JSON.parse('[{"id":"23","title":"lisa","pages":"<option value=\"763\" >Home<\/option>"}]');
	$('#pageTitle').html(groupsList[optionNum]['pages']);
  });
  
  $('#groupTitle').on('change', function() {
	//update select option for pages
	var optionNum = $(this).children(":selected").attr("id");
	var groupsList = <?php echo json_encode($groupsList); ?>;
	$('#pageTitle').html(groupsList[optionNum]['pages']);
  });
  
  $('#submit_element').click(function(e){
	e.preventDefault();
	
	// get the values from the form
	var variableString = "";
	var backgroundColorVal = $('input[name="backgroundColor"]').val();
	variableString +="backgroundColorVal = "+backgroundColorVal+"\n";
	var colorVal = $('input[name="color"]').val();
	variableString += "colorVal = "+colorVal+"\n";
	var contentsVal = $('textarea#textContents').val();
	variableString +="contentsVal = "+contentsVal+"\n";
	var fontFamilyVal = $('input[name="fontFamily"]').val();
	variableString +="fontFamilyVal = "+fontFamilyVal+"\n";
	var fontSizeVal = $('input[name="fontSize"]').val();
	variableString +="fontSizeVal = "+fontSizeVal+"\n";
	var heightVal = $('input[name="height"]').val();
	variableString +="heightVal = "+heightVal+"\n";
	var idVal = $('input[name="id"]').val();
	variableString += "idVal = "+idVal+"\n";
	var opacityVal = $('input[name="opacity"]').val();
	variableString +="opacityVal = "+opacityVal+"\n";
	var pagesIdVal = $('select[name="pageTitle"]').val();
	variableString +="pagesIdVal = "+pagesIdVal+"\n";
	var textAlignVal = $('input[name="textAlign"]').val();
	variableString +="textAlignVal = "+textAlignVal+"\n";
	var widthVal = $('input[name="width"]').val();
	variableString +="widthVal = "+widthVal+"\n";
	var xVal = $('input[name="x"]').val();
	variableString +="xVal = "+xVal+"\n";
	var yVal = $('input[name="y"]').val();
	variableString +="yVal = "+yVal+"\n";
	//alert(variableString);
	
	
	var base_url = "<?php echo base_url(); ?>";
	$.ajax({
	  type: "POST",
	  url: base_url +"index.php/elements/add",
	  data: { backgroundColor: backgroundColorVal, color: colorVal, contents: contentsVal, fontFamily: fontFamilyVal, fontSize: fontSizeVal, height: heightVal, id: idVal, opacity: opacityVal, pages_id: pagesIdVal, textAlign: textAlignVal, width: widthVal, x: xVal, y: yVal }
	})
	.done(function( msg ) {
	  window.top.location.reload();
	});
	  
  });


  //-->
</script>
</body>
</html>