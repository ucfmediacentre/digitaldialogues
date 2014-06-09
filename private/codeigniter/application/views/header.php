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
        <title>Digital Dialogues: <?php echo urldecode($title); ?> </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
		<style type="text/css">td img {display: block;}</style>

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="<?php echo base_url(); ?>css/normalize.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/videoPlayer.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>libraries/fancybox2/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>libraries/fineuploader.jquery-3.0/fineuploader.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>libraries/jquery-ui-1.9.2.custom/css/eggplant/jquery-ui-1.9.2.custom.min.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>css/colorPicker.css" type="text/css" />
        
        <script src="<?php echo base_url(); ?>js/vendor/jquery-1.8.3.min.js"></script>
        <script src="<?php echo base_url(); ?>libraries/jquery-ui-1.9.2.custom/js/jquery-ui-1.9.2.custom.min.js"></script>
		<script src="<?php echo base_url(); ?>js/vendor/jquery.ui.touch-punch.min.js"></script>
        <script src="<?php echo base_url(); ?>js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="<?php echo base_url(); ?>js/popcorn.js"></script>
		<script src="<?php echo base_url(); ?>js/jquery.colorPicker.min.js"/></script>
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
    <body bgcolor="#ffe" onload="MM_preloadImages('../../../../img/logo_s2.gif','../../../../img/recentChanges_s2.gif','../../../../img/logOut_s2.gif','../../../../img/mail_s2.gif','../../../../img/sandpit_s2.gif','../../../../img/help_s2.gif','../../../../img/search_s2.gif','../../../../img/newPage_s2.gif','../../../../img/newText_s2.gif','../../../../img/newImage_s2.gif','../../../../img/newAudio_s2.gif','../../../../img/newVideo_s2.gif');">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->