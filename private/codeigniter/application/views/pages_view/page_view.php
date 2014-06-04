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
	} ?>&nbsp;|&nbsp;<a href="../../../pages/view/community/sandpit">Sandpit</a>&nbsp;|&nbsp;<a href="../../../pages/view/community/help">Help</a>
	<form action="<?php echo base_url(); ?>index.php/search/map/<?php echo $page_info->group; ?>" method="get" enctype="multipart/form-data" id="filter_form">
	  <br />
	  <input name="filter" value="" onchange="submit();" />
	  <input type="submit" value="Search">
	</form>
  </div>
  <div id="editButtons">
	<p>Add:
	<a href="<?php echo base_url(); ?>index.php/iframe/create/newPage/<?php echo $page_info->title ?>/<?php echo $page_info->id ?>/<?php echo $user_id ?>" class="iframe">Page</a>&nbsp;|&nbsp;
	<a href="<?php echo base_url(); ?>index.php/iframe/create/newText/<?php echo $page_info->title ?>/<?php echo $page_info->id ?>/<?php echo $user_id ?>" class="iframe">Text</a>&nbsp;|&nbsp;
	<a href="<?php echo base_url(); ?>index.php/iframe/create/newImage/<?php echo $page_info->title ?>/<?php echo $page_info->id ?>/<?php echo $user_id ?>" class="iframe">Image</a>&nbsp;|&nbsp;
	<a href="<?php echo base_url(); ?>index.php/iframe/create/newAudio/<?php echo $page_info->title ?>/<?php echo $page_info->id ?>/<?php echo $user_id ?>" class="iframe">Audio</a>&nbsp;|&nbsp;
	<a href="<?php echo base_url(); ?>index.php/iframe/create/newVideo/<?php echo $page_info->title ?>/<?php echo $page_info->id ?>/<?php echo $user_id ?>" class="iframe">Video</a>
	<br /><br />
  </div>
  <span id="textSizer">textSizer</span>
</div>
