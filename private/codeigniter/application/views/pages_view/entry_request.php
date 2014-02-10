<div id="background">
  <div id="page_title_wrapper">
	<h1 id="page_title"> <?php echo $group . " : " . $title; ?> is part of a private group.</h1><br />	
	<h3 id="page_description" >If you would like to request permission to join this group, please click Ok</h3>
			<input type="hidden" name="controller" value="<?php if (isset($controller)) echo $controller; ?>">
			<input type="hidden" name="title" value="<?php echo $title; ?>">
			<input type="hidden" name="group" value="<?php echo $group ?>">
			<br /><br />
			<input type="button" value="Cancel" onclick="goBack();" />
			<input type="submit" value="Ok"  onclick="notifyCreator(); alert('Your request has been sent to the creator of this group.'); goBack();" />
			<br /><br />
  <a href="../../../pages/view/public/home">public : Home</a>&nbsp;|&nbsp;<?php if ($this->session->userdata('logged_in') != 1){
		echo '<a href="../../../verifylogin/index/pages/' . $group . '/' . $title . '">Log In</a>';  
	} else {
		echo $this->session->userdata('username') . ' <a href="../../../pages/view/log_out/pages/' . $group . '/' . $title . '">Log Out</a>';
	} ?>&nbsp;|&nbsp;<a href="../../../pages/view/sandpit/home">Sandpit</a>&nbsp;|&nbsp;<a href="../../../pages/view/help/home">Help</a>
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
	  
		if (defined('window')) {
			window.history.back();
		} else {
			redirect(base_url().'index.php/pages/view/public/home', 'location');
		}
	}
</script>
