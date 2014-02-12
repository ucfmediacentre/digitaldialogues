<!-- replaces old Page View look (page_view original.php) /-->
<div id="background">
  <div id="page_title_wrapper">
	<h1 id="page_title"> <?php echo $page_info->group . " : " . $page_info->title; ?> </h1>	
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
	<p>Add: <a id="add_text_form_trigger" href="#add_text_form">Text</a>&nbsp;|&nbsp;<a id="add_image_form_trigger" href="#add_image_form">Image</a>&nbsp;|&nbsp;<a id="add_audio_form_trigger" href="#add_audio_form">Audio</a>&nbsp;|&nbsp;<a id="add_video_form_trigger" href="#add_video_form">Video</a>&nbsp;|&nbsp;<a id="add_page_form_trigger" href="#add_page_form">Page</a>&nbsp;|&nbsp;<?php if ($this->session->userdata('logged_in') != 1){
		echo '<span  style="color:gray;">Group</span>';  
	} else {
		echo '<a id="add_group_form_trigger" href="#add_group_form">Group</a>';
	} ?></p>
  </div>
</div>
