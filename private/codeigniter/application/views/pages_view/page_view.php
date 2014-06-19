
<div id="background">
  
  <!-- replaces old Page View look (page_view original.php) /-->
  <div id="navbar">
	<table style="display: inline-table;" border="0" cellpadding="0" cellspacing="0" width="800">
	  <tr>
	   <td><img src="../../../../img/spacer.gif" width="125" height="1" alt="" /></td>
	   <td><img src="../../../../img/spacer.gif" width="50" height="1" alt="" /></td>
	   <td><img src="../../../../img/spacer.gif" width="50" height="1" alt="" /></td>
	   <td><img src="../../../../img/spacer.gif" width="50" height="1" alt="" /></td>
	   <td><img src="../../../../img/spacer.gif" width="50" height="1" alt="" /></td>
	   <td><img src="../../../../img/spacer.gif" width="50" height="1" alt="" /></td>
	   <td><img src="../../../../img/spacer.gif" width="1" height="1" alt="" /></td>
	   <td><img src="../../../../img/spacer.gif" width="75" height="1" alt="" /></td>
	   <td><img src="../../../../img/spacer.gif" width="50" height="1" alt="" /></td>
	   <td><img src="../../../../img/spacer.gif" width="50" height="1" alt="" /></td>
	   <td><img src="../../../../img/spacer.gif" width="50" height="1" alt="" /></td>
	   <td><img src="../../../../img/spacer.gif" width="50" height="1" alt="" /></td>
	   <td><img src="../../../../img/spacer.gif" width="50" height="1" alt="" /></td>
	   <td><img src="../../../../img/spacer.gif" width="50" height="1" alt="" /></td>
	   <td><img src="../../../../img/spacer.gif" width="25" height="1" alt="" /></td>
	   <td><img src="../../../../img/spacer.gif" width="1" height="1" alt="" /></td>
	  </tr>
	  <tr>
		<td><a href="../../../pages/view/community/Home" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('logo','','../../../../img/logo_s2.gif',1);"><img name="logo" src="../../../../img/logo.gif" width="125" height="80" id="logo" alt="Website Home" /></a></td>
		<td><a href="../../../recentChanges?group=<?php echo $page_info->group; ?>" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('recentChanges','','../../../../img/recentChanges_s2.gif',1);"><img name="recentChanges" src="../../../../img/recentChanges.gif" width="50" height="80" id="recentChanges" alt="Recent changes" /></a></td>
		<td><a href="../../../verifylogin/log_out/pages/<?php echo $page_info->group . '/' . $page_info->title; ?>" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('logOut','','../../../../img/logOut_s2.gif',1);"><img name="logOut" src="../../../../img/logOut.gif" width="50" height="80" id="logOut" alt="Log out" /></a></td>
		<td><a href="../../../messages/view/<?php echo $this->session->userdata('username'); ?>" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('mail','','../../../../img/mail_s2.gif',1);"><img name="mail" src="../../../../img/mail.gif" width="50" height="80" id="mail" alt="Mail" /></a></td>
		<td><a href="../../../pages/view/community/sandpit" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('sandpit','','../../../../img/sandpit_s2.gif',1);"><img name="sandpit" src="../../../../img/sandpit.gif" width="50" height="80" id="sandpit" alt="Sandpit" /></a></td>
		<td><a href="../../../pages/view/community/help" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('help','','../../../../img/help_s2.gif',1);"><img name="help" src="../../../../img/help.gif" width="50" height="80" id="help" alt="Help" /></a></td>
		<td><img name="digitalDialoguesBar_r1_c9EndBlocked" src="../../../../img/digitalDialoguesBar_r1_c9EndBlocked.gif" width="1" height="80" id="digitalDialoguesBar_r1_c9EndBlocked" alt="" /></td>
		<td>
		  <table>
			<tr>
			  <td id="searchField" class="searchForm" nowrap="nowrap" align="center"><form id="searchForm" action="<?php echo base_url(); ?>index.php/search/map/<?php echo $page_info->group; ?>" method="get" enctype="multipart/form-data" id="filter_form">&nbsp;&nbsp;&nbsp;<input name="filter" value="" onchange="submit();" />&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr>
			  <td><img src="../../../../img/spacer.gif" width="50" height="30" alt="" /></td>
			</tr>
		  </table>
		</td>
		<td><a onmouseout="MM_swapImgRestore(); $('#searchField').css('background-color', '#339');" onmouseover="MM_swapImage('search','','../../../../img/search_s2.gif',1); $('#searchField').css('background-color', '#3c66b3');"><img name="search" src="../../../../img/search.gif" width="50" height="80" id="search" alt="Search" /></a></form></td>
		<td><a href="<?php echo base_url(); ?>index.php/iframe/create/newPage/<?php echo $page_info->title ?>/<?php echo $page_info->id ?>/<?php echo $page_info->group ?>/<?php echo $user_id ?>" class="iframe" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('newPage','','../../../../img/newPage_s2.gif',1);"><img name="newPage" src="../../../../img/newPage.gif" width="50" height="80" id="newPage" alt="New page" /></a></td>
		<td><a href="<?php echo base_url(); ?>index.php/iframe/create/newText/<?php echo $page_info->title ?>/<?php echo $page_info->id ?>/<?php echo $page_info->group ?>/<?php echo $user_id ?>" class="iframe" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('newText','','../../../../img/newText_s2.gif',1);"><img name="newText" src="../../../../img/newText.gif" width="50" height="80" id="newText" alt="New text" /></a></td>
		<td><a href="<?php echo base_url(); ?>index.php/iframe/create/newImage/<?php echo $page_info->title ?>/<?php echo $page_info->id ?>/<?php echo $page_info->group ?>/<?php echo $user_id ?>" class="iframe" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('newImage','','../../../../img/newImage_s2.gif',1);"><img name="newImage" src="../../../../img/newImage.gif" width="50" height="80" id="newImage" alt="New image" /></a></td>
		<td><a href="<?php echo base_url(); ?>index.php/iframe/create/newAudio/<?php echo $page_info->title ?>/<?php echo $page_info->id ?>/<?php echo $page_info->group ?>/<?php echo $user_id ?>" class="iframe" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('newAudio','','../../../../img/newAudio_s2.gif',1);"><img name="newAudio" src="../../../../img/newAudio.gif" width="50" height="80" id="newAudio" alt="New audio" /></a></td>
		<td><a href="<?php echo base_url(); ?>index.php/iframe/create/newVideo/<?php echo $page_info->title ?>/<?php echo $page_info->id ?>/<?php echo $page_info->group ?>/<?php echo $user_id ?>" class="iframe" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('newVideo','','../../../../img/newVideo_s2.gif',1);"><img name="newVideo" src="../../../../img/newVideo.gif" width="50" height="80" id="newVideo" alt="New video" /></a></td>
		<td><img name="digitalDialoguesBar_r1_c15b" src="../../../../img/digitalDialoguesBar_r1_c15.png" width="25" height="80" id="digitalDialoguesBar_r1_c15b" alt="" /></td>
		<td><img src="../../../../img/spacer.gif" width="1" height="80" alt="" /></td>
	  </tr>
	</table>
  </div>
  
	<div id="page_title_wrapper">
	  <h1 id="page_title"> <span style="color:gray"><?php echo urldecode($page_info->group) . " : </span>" . $page_info->title; ?> </h1>	
	  <!--<p id="page_description" > <?php echo $page_info->description; ?> </p>//-->
	</div>
	<div id="textSizer">textSizer</div>
  </div>

<script language="JavaScript1.2" type="text/javascript">
  <!--
  $( "#search" ).click(function() {
	  $( "#searchForm" ).submit();
  });
  //-->
</script>