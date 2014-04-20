<!-- replaces old Page View look (page_view original.php) /-->
<div id="background">
  <div id="page_title_wrapper">
	<h1 id="page_title"> <span style="color:gray"><?php echo urldecode($page_info->group) . " : </span>" . $page_info->title; ?> </h1>	
	<p id="page_description" > <?php echo $page_info->description; ?> </p>
  </div>
  <div id="main_pages_wrapper">
	<a href="../../../pages/view/<?php echo $page_info->group; ?>/Home">Home</a>&nbsp;|&nbsp;<a href="../../../recentChanges?group=<?php echo $page_info->group; ?>">Recent Changes</a>&nbsp;|&nbsp;<?php if ($this->session->userdata('logged_in') != 1){
		echo '<a href="../../../verifylogin/index/pages/' . $page_info->group . '/' . $page_info->title . '">Log In</a>';  
	} else {
		if ($this->session->userdata('messageCount') == 1) {
			$messageLink = 'Message';
		} else {
			$messageLink = 'Messages';
		}
		
		echo $this->session->userdata('username') . ' <a href="../../../verifylogin/log_out/pages/' . $page_info->group . '/' . $page_info->title . '">Log Out</a>&nbsp;|&nbsp;' . $this->session->userdata('messageCount')  . '&nbsp;<a href="../../../messages/view/'.$this->session->userdata('username').'">'.$messageLink.'</a>';
	} ?>&nbsp;|&nbsp;<a href="../../../pages/view/public/sandpit">Sandpit</a>&nbsp;|&nbsp;<a href="../../../pages/view/public/help">Help</a>
	<form action="<?php echo base_url(); ?>index.php/search/map/<?php echo $page_info->group; ?>" method="get" enctype="multipart/form-data" id="filter_form">
	  <br />
	  <input name="filter" value="" onchange="submit();" />
	  <input type="submit" value="Search">
	</form>
  </div>
  <div id="editButtons">
	<p>Add: <a href="<?php echo base_url(); ?>assets/html/iframe_text_form.php?page_id=<?php echo $page_info->id ?>" class="iframe">Text</a>&nbsp;|&nbsp;
	<a href="<?php echo base_url(); ?>assets/html/iframe_image_form.php?page_id=<?php echo $page_info->id ?>" class="iframe">Image</a>&nbsp;|&nbsp;
	<a href="<?php echo base_url(); ?>assets/html/iframe_audio_form.php?page_id=<?php echo $page_info->id ?>" class="iframe">Audio</a>&nbsp;|&nbsp;
	<a href="<?php echo base_url(); ?>assets/html/iframe_video_form.php?page_id=<?php echo $page_info->id ?>" class="iframe">Video</a>&nbsp;|&nbsp;
	<a href="<?php echo base_url(); ?>assets/html/iframe_page_form.php?title=<?php echo urlencode($page_info->title) ?>&id=<?php echo $page_info->id ?>&group=<?php echo urlencode($page_info->group) ?>" class="iframe">Page</a>&nbsp;|&nbsp;
	<a href="<?php echo base_url(); ?>assets/html/iframe_group_form.php?title=<?php echo urlencode($page_info->title) ?>&id=<?php echo $page_info->id ?>&group=<?php echo $page_info->group ?>&uid=<?php echo $user_id; ?>" class="iframe">Group</a>
	<br /><br />
	<span style="font-size:10px;"><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://swarmtv.net/img/ccLogo.png" /></a><br />Any contributions made to this website will come under a <br /><a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/">Creative Commons License Attribution 3.0</a></span>
  </div>
</div>
