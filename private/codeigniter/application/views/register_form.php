<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
  <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>Register</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width">
	<style type="text/css">td img {display: block;}</style>

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

	<link rel="stylesheet" href="<?php echo base_url(); ?>css/normalize.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/main.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/videoPlayer.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>libraries/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>libraries/fineuploader.jquery-3.0/fineuploader.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>libraries/jquery-ui-1.9.2.custom/css/eggplant/jquery-ui-1.9.2.custom.min.css" type="text/css" media="screen" />
	
	<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
	<script src="<?php echo base_url(); ?>js/vendor/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>libraries/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
	<script src="<?php echo base_url(); ?>js/vendor/jquery.ui.touch-punch.min.js"></script>
	<script src="<?php echo base_url(); ?>js/vendor/modernizr-2.6.2.min.js"></script>
	<script src="<?php echo base_url(); ?>js/popcorn.js"></script>
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<link rel="stylesheet" type="text/css" href="includes/videoPlayer_ie.css" />
	<![endif]-->
	<script language="JavaScript1.2" type="text/javascript">
	<!--
	function MM_findObj(n, d) { //v4.01
	  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
		d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
	  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
	  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
	  if(!x && d.getElementById) x=d.getElementById(n); return x;
	}
	function MM_swapImage() { //v3.0
	  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
	   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
	}
	function MM_swapImgRestore() { //v3.0
	  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
	}
	
	function MM_preloadImages() { //v3.0
	  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
		var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
		if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
	}
	//-->
	</script>
  </head>
  <body bgcolor="#ffe" onload="MM_preloadImages('../../img/logIn_s2.gif');">
	  <!--[if lt IE 7]>
		  <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
	  <![endif]-->
<div id="navbarBlocked">
  <table style="display: inline-table;" border="0" cellpadding="0" cellspacing="0" width="550">
  <tr>
   <td><img src="../../img/spacer.gif" width="125" height="1" alt="" /></td>
   <td><img src="../../img/spacer.gif" width="50" height="1" alt="" /></td>
   <td><img src="../../img/spacer.gif" width="50" height="1" alt="" /></td>
   <td><img src="../../img/spacer.gif" width="50" height="1" alt="" /></td>
   <td><img src="../../img/spacer.gif" width="50" height="1" alt="" /></td>
   <td><img src="../../img/spacer.gif" width="50" height="1" alt="" /></td>
   <td><img src="../../img/spacer.gif" width="1" height="1" alt="" /></td>
   <td><img src="../../img/spacer.gif" width="75" height="1" alt="" /></td>
   <td><img src="../../img/spacer.gif" width="50" height="1" alt="" /></td>
   <td><img src="../../img/spacer.gif" width="1" height="1" alt="" /></td>
   <td><img src="../../img/spacer.gif" width="1" height="1" alt="" /></td>
  </tr>

  <tr>
   <td><img name="logo" src="../../img/logoBlocked.gif" width="125" height="80" id="logo" alt="Website Home" /></td>
   <td><img name="recentChanges" src="../../img/recentChangesBlocked.gif" width="50" height="80" id="recentChanges" alt="Recent changes" /></td>
   <td><a href="../../index.php/verifylogin?controller=pages&group=connectedCommunities&title=home" onmouseout="MM_swapImgRestore();" onmouseover="MM_swapImage('logIn','','../../img/logIn_s2.gif',1);"><img name="logIn" src="../../img/logIn.gif" width="50" height="80" id="logIn" alt="Log in" /></a></td>
   <td><img name="mail" src="../../img/mailBlocked.gif" width="50" height="80" id="mail" alt="Mail" /></td>
   <td><img name="sandpit" src="../../img/sandpitBlocked.gif" width="50" height="80" id="sandpit" alt="Sandpit" /></td>
   <td><img name="help" src="../../img/helpBlocked.gif" width="50" height="80" id="help" alt="Help" /></td>
   <td><img name="digitalDialoguesBar_r1_c9EndBlocked" src="../../img/digitalDialoguesBar_r1_c9EndBlocked.gif" width="1" height="80" id="digitalDialoguesBar_r1_c9EndBlocked" alt="" /></td>
   <td><table><tr>
   <td id="searchFieldBlocked" class="searchForm" nowrap="nowrap" align="center"><form id="searchForm" id="filter_form">&nbsp;&nbsp;&nbsp;<input name="filter" value="" />&nbsp;&nbsp;&nbsp;</td>
   </tr>
	<tr>
	  <td><img src="../../img/spacer.gif" width="50" height="30" alt="" /></td>
	</tr>
   </table></td>
   <td><img name="search" src="../../img/searchBlocked.gif" width="50" height="80" id="search" alt="Search" /></form></td>
   <td><img name="digitalDialoguesBar_r1_c15b" src="../../img/digitalDialoguesBar_r1_c9EndBlocked.gif" width="1" height="80" id="digitalDialoguesBar_r1_c15b" alt="" /></td>
   <td><img src="../../img/spacer.gif" width="1" height="80" alt="" /></td>
  </tr>
</table>
</div>

	<div id="page_title_wrapper">
	  <h1 id="page_title">Register Details</h1>	
	  <p></p>
  </div>
	<div id="main_pages_wrapper">
	  <span class="error"><?php echo validation_errors(); ?></span>
	  <?php echo form_open('register'); ?>
	  <table>
		<tr>
		  <td align="right">
			<label for="username">Username:</label>
		  </td><td>
			<input type="text" size="36" id="username" name="username" value="<?php echo set_value('username'); ?>" />
			<br />
		  </td>
		</tr>
		<tr>
		  <td>
			&nbsp;
		  </td><td>
			&nbsp;
			<br />
		  </td>
		</tr>
		<tr>
		  <td align="right">
			<label for="email">E-mail:</label>
		  </td><td>
			<input type="text" size="36" id="email" name="email" value="<?php echo set_value('email'); ?>" />
			<br />
		  </td>
		</tr>
		<tr>
		  <td>
			&nbsp;
		  </td><td>
			&nbsp;
			<br />
		  </td>
		</tr>
		<tr>
		  <td align="right">
			<label for="password">Password:</label>
		  </td><td>
			<input type="password" size="36" id="password" name="password" value="<?php echo set_value('password'); ?>" />
			<br />
		  </td>
		</tr>
		<tr>
		  <td>
			&nbsp;
		  </td><td>
			&nbsp;
			<br />
		  </td>
		</tr>
		<tr>
		  <td align="right">
			<label for="passconf" style="white-space: nowrap">Confirm Password:</label>
		  </td><td>
			<input type="password" size="36" id="passconf" name="passconf" value="<?php echo set_value('passconf'); ?>" />
			<br />
			<input type="hidden" name="controller" value="<?php if (isset($controller)) echo $controller; ?>">
			<input type="hidden" name="title" value="<?php echo $title; ?>">
			<input type="hidden" name="group" value="<?php echo $group ?>">
		  </td>
		</tr>
		<tr>
		  <td></td><td  align="right">
			<br/>
			<input type="submit" value="Register" />
		  </td>
		</tr>
	  </table>
	  <br />
    </div>
    </form>
	<script>
		$( document ).ready(function() {
			$("#username").focus();
		});
	</script>
	<!-- Google Analytics -->
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	  
		ga('create', 'UA-47930876-1', 'digitaldialogues.org');
		ga('send', 'pageview');
	  
	</script>
  </body>
</html>
