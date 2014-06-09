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
   <td><img src="../../../../img/spacer.gif" width="25" height="1" alt="" /></td>
   <td><img src="../../../../img/spacer.gif" width="75" height="1" alt="" /></td>
   <td><img src="../../../../img/spacer.gif" width="50" height="1" alt="" /></td>
   <td><img src="../../../../img/spacer.gif" width="25" height="1" alt="" /></td>
   <td><img src="../../../../img/spacer.gif" width="1" height="1" alt="" /></td>
  </tr>

  <tr>
   <td><a href="../../../pages/view/community/Home" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('logo','','../../../../img/logo_s2.gif',1);"><img name="logo" src="../../../../img/logo.gif" width="125" height="80" id="logo" alt="Website Home" /></a></td>
   <td><a href="../../../recentChanges?group=community" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('recentChanges','','../../../../img/recentChanges_s2.gif',1);"><img name="recentChanges" src="../../../../img/recentChanges.gif" width="50" height="80" id="recentChanges" alt="Recent changes" /></a></td>
   <td><a href="../../../verifylogin/log_out/pages/community/Home" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('logOut','','../../../../img/logOut_s2.gif',1);"><img name="logOut" src="../../../../img/logOut.gif" width="50" height="80" id="logOut" alt="Log out" /></a></td>
   <td><a href="../../../messages/view/<?php echo $this->session->userdata('username'); ?>" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('mail','','../../../../img/mail_s2.gif',1);"><img name="mail" src="../../../../img/mail.gif" width="50" height="80" id="mail" alt="Mail" /></a></td>
   <td><a href="../../../pages/view/community/sandpit" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('sandpit','','../../../../img/sandpit_s2.gif',1);"><img name="sandpit" src="../../../../img/sandpit.gif" width="50" height="80" id="sandpit" alt="Sandpit" /></a></td>
   <td><a href="../../../pages/view/community/help" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('help','','../../../../img/help_s2.gif',1);"><img name="help" src="../../../../img/help.gif" width="50" height="80" id="help" alt="Help" /></a></td>
   <td><img name="digitalDialoguesBar_r1_c9" src="../../../../img/digitalDialoguesBar_r1_c9.png" width="25" height="80" id="digitalDialoguesBar_r1_c9" alt="" /></td>
   <td><table><tr>
   <td id="searchField" class="searchForm" nowrap="nowrap" align="center"><form id="searchForm" action="<?php echo base_url(); ?>index.php/search/map/<?php echo $group; ?>" method="get" enctype="multipart/form-data" id="filter_form">&nbsp;&nbsp;&nbsp;<input name="filter" value="" onchange="submit();" />&nbsp;&nbsp;&nbsp;</td>
   </tr>
	<tr>
	  <td><img src="../../../../img/spacer.gif" width="50" height="30" alt="" /></td>
	</tr>
   </table></td>
   <td><a onmouseout="MM_swapImgRestore(); $('#searchField').css('background-color', '#339');" onmouseover="MM_swapImage('search','','../../../../img/search_s2.gif',1); $('#searchField').css('background-color', '#3c66b3');"><img name="search" src="../../../../img/search.gif" width="50" height="80" id="search" alt="Search" /></a></form></td>
   <td><img name="digitalDialoguesBar_r1_c15b" src="../../../../img/digitalDialoguesBar_r1_c15.png" width="25" height="80" id="digitalDialoguesBar_r1_c15b" alt="" /></td>
   <td><img src="../../../../img/spacer.gif" width="1" height="80" alt="" /></td>
  </tr>
</table>
</div>

<div id="background">
  <div id="page_title_wrapper">
	<h1 id="page_title"> <?php echo "<span style='color:gray;'>".urldecode($group) . " :</span> " . $title; ?></h1><h3 id="page_description" > is part of a private group. If you would like to request permission to join this group, please click Ok</h3>
			<input type="hidden" name="controller" value="<?php if (isset($controller)) echo $controller; ?>">
			<input type="hidden" name="title" value="<?php echo $title; ?>">
			<input type="hidden" name="group" value="<?php echo $group ?>">
			<br /><br />
			<input type="button" value="Cancel" onclick="goBack();" />
			<input type="submit" value="Ok"  onclick="notifyCreator(); alert('Your request has been sent to the creator of this group.'); goBack();" />
			<br /><br />
  </div>
</div>
<script>
	function notifyCreator(){
		$.ajax({
			type: "post",
			url: "<?php echo base_url(); ?>index.php/messages/group_request/<?php echo $this->session->userdata('username').'/'.$group; ?>",
			
			success:function(data){
				console.log(data);
			},
			error:function(data){
				console.log(data);
			}
			
		});
		
		
	}
	
	function goBack() {
	  
		if (window.jQuery) {
			window.history.back();
		} else {
			redirect(base_url()+'index.php/pages/view/public/home', 'location');
		}
	}
</script>

<script language="JavaScript1.2" type="text/javascript">
  <!--
  $( "#search" ).click(function() {
	  $( "#searchForm" ).submit();
  });
  //-->
</script>
